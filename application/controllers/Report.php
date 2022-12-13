<?php

use Dompdf\Options;
use Dompdf\Dompdf;

defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //ini fungsi helper untuk mencegah login lewat url
        has_login();
        //cek apakah user payment tidak bisa akses
        if ($this->session->userdata('role_id') != 1) {
            redirect('home/error_choice');
        }
        $this->load->model('requestModel');
        $this->load->model('reportModel');
        $this->load->model('userModel');
        $this->load->helper(array('url', 'form'));
    }

    public function ro_filter()
    {
        $data = [
            'title' => 'Laporan Request Order',
            'user' => $this->userModel->get_user_session(),
            'divisi' => $this->db->get('divisi')->result_array(),
            'status' => $this->db->get('status')->result_array()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('report/ro_report', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function get_ro_report()
    {
        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);
        $divisi = $this->input->post('divisi');
        $status = $this->input->post('status');

        if ($divisi == 'all' and $status == 'all') {
            $hasil = $this->reportModel->get_ro($tgl_awal, $tgl_akhir);
        } elseif ($divisi != 'all' and $status == 'all') {
            $hasil = $this->reportModel->get_robyDiv($tgl_awal, $tgl_akhir, $divisi);
        } elseif ($divisi == 'all' and $status != 'all') {
            $hasil = $this->reportModel->get_robyStatus($tgl_awal, $tgl_akhir, $status);;
        } else {
            $hasil = $this->reportModel->get_robyFilters($tgl_awal, $tgl_akhir, $divisi, $status);
        }
        $data = [
            'title' => 'hasil pencarian laporan',
            'user' => $this->userModel->get_user_session(),
            'hasil_cari' => $hasil,
            'divisi' => $this->db->get('divisi')->result_array(),
            'status' => $this->db->get('status')->result_array(),
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('report/hasil_ro_report', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }
}
