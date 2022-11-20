<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        $this->load->model('userModel');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'valid_email' => 'format email tidak sesuai',
            'required' => 'anda belum mengisi email',
            'trim' => 'jangan ada spasi di awal dan akhir input anda'
        ]);

        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'trim' => 'jangan ada spasi di awal dan akhir input anda',
            'required' => 'anda belum mengisi password'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login-Page';
            $this->load->view('loginpage/index');
        } else {
            //validasi sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            //jika login berhasil
            if (password_verify($password, $user['password'])) {
                $data = [
                    'nama' => $user['nama'],
                    'nip' => $user['nip'],
                    'email' => $user['email'],
                    'no_hp' => $user['no_hp'],
                    'role_id' => $user['role_id'],
                    'id_divisi' => $user['id_divisi'],
                    'created_at' => $user['created_at']
                ];

                $this->session->set_userdata($data);
                redirect('home', $data);
                //jika salah password
            } else {
                $this->session->set_flashdata('msg', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>password tidak cocok!</strong> silahkan cek password yang anda isi.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>email tidak ditemukan!</strong> silahan cek email yang anda isi.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[user.email]|valid_email', [
            'is_unique' => 'email has been registered'
        ]);
        $this->form_validation->set_rules('nip', 'NIP', 'required|exact_length[8]|trim|numeric|is_unique[user.nip]', [
            'is_unique' => 'nip has been registered',
            'numeric' => 'nip should be numeric'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[10]', [
            'min_length' => 'alamat terlalu pendek'
        ]);
        $this->form_validation->set_rules('no_hp', 'no_hp', 'required|numeric|min_length[8]|max_length[14]', [
            'numeric' => 'masukan hanya angka untuk nomor handphone',
            'min_length' => 'nomor handphone tidak valid',
            'max_length' => 'nomor handphone tidak valid'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration Account';
            $this->load->view('loginpage/registerform');
        } else {
            //Qr code codingan
            $this->load->library('ciqrcode'); //pemanggilan library QR CODE
            $config['cacheable']    = true; //boolean, the default is true
            $config['cachedir']     = './assets/'; //string, the default is application/cache/
            $config['errorlog']     = './assets/'; //string, the default is application/logs/
            $config['imagedir']     = './assets/img/qr-sign/'; //direktori penyimpanan qr code
            $config['quality']      = true; //boolean, the default is true
            $config['size']         = '1024'; //interger, the default is 1024
            $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
            $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);

            $nip = $this->input->post('nip');
            $image_name = $nip . '.png'; //buat name dari qr code sesuai dengan nim
            $params['data'] = $nip; //data yang akan di jadikan QR CODE
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

            $data = [
                'nama' => $this->input->post('nama', true),
                'nip' => $this->input->post('nip', true),
                'email' => $this->input->post('email', true),
                'password' => password_hash(
                    $this->input->post('password'),
                    PASSWORD_DEFAULT
                ),
                'alamat_tinggal' => $this->input->post('alamat', true),
                'no_hp' => $this->input->post('no_hp', true),
                'role_id' => $this->input->post('role'),
                'id_divisi' => $this->input->post('id_divisi', true),
                'img_profile' => 'default.jpg',
                'qr_sign' => $image_name,
                'created_at' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('msg', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat !</strong> anda berhasil registrasi akun.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('webpage/get_login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('nip');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('img_profile');
        $this->session->unset_userdata('created_at');

        $this->session->set_flashdata('msg', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>anda berhasil logout</strong> silahkan login jika ingin kembali.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('webpage/get_login');
    }
}
