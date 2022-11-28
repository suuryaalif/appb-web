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
