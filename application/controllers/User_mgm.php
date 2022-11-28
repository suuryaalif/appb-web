<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_mgm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        has_login();
        //cek apakah user payment tidak bisa akses
        if ($this->session->userdata('role_id') != 1) {
            redirect('home/error_choice');
        }
        $this->load->model('userModel');
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $data = [
            'title' => 'info User',
            'user_data' => $this->userModel->get_all(),
            'user' => $this->userModel->get_user_session()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('userMgm/index', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function user_add_form()
    {
        $data = [
            'title' => 'Tambah User',
            'user_data' => $this->userModel->get_all(),
            'user' => $this->userModel->get_user_session()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('userMgm/registrasi_user', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function add_new()
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
            $data = [
                'title' => 'Tambah User',
                'user_data' => $this->userModel->get_all(),
                'user' => $this->userModel->get_user_session()
            ];
            $this->load->view('homepage/layouts/header', $data);
            $this->load->view('homepage/layouts/sidebar', $data);
            $this->load->view('homepage/layouts/topbar', $data);
            $this->load->view('userMgm/registrasi_user', $data);
            $this->load->view('homepage/layouts/footer', $data);;
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
            redirect('user_mgm');
        }
    }

    public function edit_user($id)
    {
        $data = [
            'title' => 'Edit User',
            'user' => $this->userModel->get_user_session(),
            'data_user' => $this->userModel->get_byID($id)
        ];

        $this->load->view('userMgm/editUser', $data);
    }
}
