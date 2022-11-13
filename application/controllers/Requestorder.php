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
        if ($this->session->userdata('role_id') == 3) {

            $this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Maaf Akses Terbatas!</strong> anda tidak diperkenankan menambah request.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('requestorder');
        }
        $data = [
            'title' => 'Form Request',
            'user' => $this->userModel->get_user_session(),
            'kodeotomatis' => $this->requestModel->AutoCode(),
            'detail' => $this->requestModel->get_all_detail()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('requestorder/tambahorder', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }
}
