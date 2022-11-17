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
        $this->load->helper(array('url', 'form'));
    }

    //ini fungsi menampilkan semua order berdasarkan nipnya
    public function index()
    {
        if ($this->session->userdata('role_id') == 1) {
            $data = [
                'title' => 'Request Order',
                'user' => $this->userModel->get_user_session(),
                'request' => $this->requestModel->get_all_request()
            ];
        } else {
            $where = $this->session->userdata('nip');
            $data = [
                'title' => 'Request Order',
                'user' => $this->userModel->get_user_session(),
                'request' => $this->requestModel->get_request($where)
            ];
        }

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('requestorder/index', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    //ini fungsi dapetin id order (table)
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
        $this->load->view('requestorder/data_detailorder', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function get_pre_request()
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
            'detail' => $this->requestModel->get_temp_detail()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('requestorder/form_Pre_request', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }
    public function get_fin_request()
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
            'title' => 'Form Request2',
            'user' => $this->userModel->get_user_session(),
            'kodeotomatis' => $this->requestModel->AutoCode(),
            'detail' => $this->requestModel->get_temp_detail()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('requestorder/form_Fin_request', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }
    //fungsi ini buat nambahin detail barang di temp table
    public function add_new_detail()
    {
        $this->form_validation->set_rules('desk_barang', 'Desk_barang', 'required|min_length[5]', [
            'required' => 'wajib diisi',
            'min_length[5]' => 'dekripsi terlalu pendek'
        ]);
        $this->form_validation->set_rules('qty_order', 'Qty_order', 'required|numeric', [
            'numeric' => 'wajib diisi dengan angka'
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/foto-order/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1260';
        $config['max_height'] = '1260';
        $config['file_name'] = 'img-order' . date('dmYHis') . '.jpg';

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            redirect('requestorder/get_pre_request');
        } else {
            $image = $this->upload->data();
            $gambar = $image['file_name'];
            $this->upload->do_upload('foto_order');
            $data = [
                'kode_order' => $this->input->post('kode_order', true),
                'jenis_barang' => $this->input->post('jenis_barang', true),
                'desk_barang' => $this->input->post('desk_barang', true),
                'qty_order' => $this->input->post('qty_order', true),
                'sat_order' => $this->input->post('sat_order', true),
                'img_order' => $gambar,
                'status_detail' => 'belum di proses'
            ];
            $this->requestModel->insert_detail($data, 'temp_order');
            $this->session->set_flashdata('msg', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                data barang telah ditambahkan di table bawah, silahkan tambahkan lagi jika ingin.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>');
            redirect('requestorder/get_pre_request');
        }
    }
    //fungsi dibawah ini buat menghapus salah satu dari detail barang
    public function delete_detail()
    {
        $id = $this->uri->segment(3);
        //ini khusus buat ngapus foto pada direktori
        $data = $this->requestModel->get_temp_detail($id)->row();
        $path = './assets/img/foto-order/' . $data->img_order;
        unlink($path);

        $this->requestModel->delete_detail($id);
        $this->session->set_flashdata('msg', '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        data barang telah berhasil dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('requestorder/get_pre_request');
    }

    //funsi ini buat masukin inputan request_order
    public function insert_fin_request()
    {
        $kode_ro = $this->uri->segment(3);
        $nip = $this->session->userdata('nip');

        $data = [
            'kode_ro' => $this->input->post('kode_order', true),
            'alasan_req' => $this->input->post('alasan_req', true),
            'submit_date' => $this->input->post('submit_date', true),
            'status_pengajuan' => 'belum diproses',
            'id_user' => $nip
        ];

        $this->requestModel->insert_request($data, 'request_order');
        $this->requestModel->post_detail($kode_ro);
        // $this->requestModel->delete_temp();
        $this->requestModel->joinDetail(['kode_ro' => $kode_ro]);
        $this->session->set_flashdata('msg', '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Satu langkah lagi!</strong> Pastikan anda mendownload/Mencetak Request Order Sebelum Kembali.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');

        redirect('requestorder/result_request');
    }

    //fungsi ini menampilkan hasil terkahir dari booking request
    public function result_request()
    {
        $where = $this->session->userdata('nip');
        $data['nama'] = $this->session->userdata('nama');
        $data['title'] = 'Print Request Order';
        $data['user'] = $this->userModel->get_user_session();
        $data['request'] = $this->requestModel->result_last_request($where);
        $data['items'] = $this->requestModel->get_temp_detail();


        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('requestorder/fin_info_request', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }


    //ini buat balik ke dashboard request
    public function finish_request()
    {
        //disini fungsi buat ngapus seluruh isi tabel temp
        $this->requestModel->delete_temp();

        $this->session->set_flashdata('msg', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Selamat!</strong>Request Anda Telah Diajukan.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');

        redirect('requestorder');
    }
}
