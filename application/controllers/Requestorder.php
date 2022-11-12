<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Requestorder extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //ini fungsi helper untuk mencegah login lewat url
        has_login();
        //cek apakah user payment tidak bisa akses
        if ($this->session->userdata('role_id') == 4) {
            redirect('home/error_choice');
        }
        $this->load->model('requestModel');
        $this->load->model('userModel');
    }

    public function index()
    {
        $data = [
            'title' => 'Request Order',
            'user' => $this->userModel->get_user_session(),
            'request' => $this->requestModel->get_all_request()
        ];
        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('requestorder/index', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }
    public function get_id()
    {
        //ambil id berupa kode_ro dari view masukin ke URL segment
        $id = $this->uri->segment(3);
        $data = [
            'title' => 'Detail Order',
            'user' => $this->userModel->get_user_session(),
            //olah kode_ro yang dari view masuk ke requestModel
            'detail' => $this->requestModel->joinDetail(['kode_ro' => $id])
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('requestorder/detailorder', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function get_form_tambah()
    {
        //ambil id berupa kode_ro dari view masukin ke URL segment
        $id = $this->uri->segment(3);
        $data = [
            'title' => 'Detail Order',
            'user' => $this->userModel->get_user_session(),
            //olah kode_ro yang dari view masuk ke requestModel
            'detail' => $this->requestModel->joinDetail(['kode_ro' => $id])
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('requestorder/detailorder', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }
}
