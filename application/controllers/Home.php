<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //ini fungsi helper untuk mencegah login lewat url
        has_login();
        //panggil model userModel
        $this->load->model('userModel');
    }

    public function index()
    {
        $data = [
            'title' => 'Home Page',
            'user' => $this->userModel->get_user_session()
        ];

        if ($this->session->userdata('role_id') == 1) {
            $this->load->view('homepage/layouts/header', $data);
            $this->load->view('homepage/layouts/sidebar', $data);
            $this->load->view('homepage/layouts/topbar', $data);
            $this->load->view('homepage/db_admin', $data);
            $this->load->view('homepage/layouts/footer', $data);
        } elseif ($this->session->userdata('role_id') == 2) {
            $this->load->view('homepage/layouts/header', $data);
            $this->load->view('homepage/layouts/sidebar', $data);
            $this->load->view('homepage/layouts/topbar', $data);
            $this->load->view('homepage/db_user_req', $data);
            $this->load->view('homepage/layouts/footer', $data);
        } else if ($this->session->userdata('role_id' == 3)) {
            echo "ini approval";
        }
    }




    public function profile()
    {
        $data = [
            'title' => 'Profile Page',
            'user' => $this->userModel->get_user_session()
        ];
        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('homepage/profile', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function error_choice()
    {
        $data = [
            'title' => 'Error Page',
            'user' => $this->userModel->get_user_session()
        ];
        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('homepage/error', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }
}
