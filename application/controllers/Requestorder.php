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


    //=============================================================//
    //========================FUNGSI FUNGSI TAMPIL=================//

    //ini fungsi menampilkan semua order berdasarkan nipnya
    public function index()
    {
        $id_div = $this->session->userdata('id_divisi');
        if ($this->session->userdata('role_id') == 1) {
            $data = [
                'title' => 'Request Order',
                'user' => $this->userModel->get_user_session(),
                'request' => $this->requestModel->get_allRequest()
            ];
        } elseif ($this->session->userdata('role_id') == 3) {
            $data = [
                'title' => 'Request Order',
                'user' => $this->userModel->get_user_session(),
                'request' => $this->requestModel->get_requestbyDiv($id_div)
            ];
        } else {
            $where = $this->session->userdata('nip');
            $data = [
                'title' => 'Request Order',
                'user' => $this->userModel->get_user_session(),
                'request' => $this->requestModel->get_requestbyID($where)
            ];
        }

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('requestorder/index', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    //ini fungsi dapetin id order (table)
    public function detail()
    {
        //ambil id berupa kode_ro dari view masukin ke URL segment
        $id = $this->uri->segment(3);
        $verify_empty = $this->requestModel->check_empty_status($id);
        $verify_approved = $this->requestModel->check_approved_status($id);
        $divisi = $this->session->userdata('id_divisi');
        $usr_apr = $this->requestModel->get_user_approval($divisi);
        $data = [
            'title' => 'Detail Order',
            'user' => $this->userModel->get_user_session(),
            //olah kode_ro yang dari view masuk ke requestModel
            'request' => $this->requestModel->get_requestbyKode($id),
            'detail' => $this->requestModel->joinDetail($id),
            'user_req' => $this->requestModel->joinRequest(['kode_ro' => $id]),
            'verify_approved' => $verify_approved->num_rows(),
            'verify_empty' => $verify_empty->num_rows(),
            'user_approve' => $usr_apr
        ];

        // var_dump($data);
        // die;

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
    //fungsi menampilkan form edit requestnya
    public function edit_request()
    {
        $kode_ro = $this->uri->segment(3);
        if ($this->session->userdata('role_id') == 3) {
            $this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Maaf Akses Terbatas!</strong> anda tidak diperkenankan menambah request.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('requestorder');
        } {
            $data = [
                'title' => 'Edit Request',
                'user' => $this->userModel->get_user_session(),
                //olah kode_ro yang dari view masuk ke requestModel
                'request' => $this->requestModel->get_requestbyKode($kode_ro),
                'detail' => $this->requestModel->joinDetail($kode_ro),
                'user_req' => $this->requestModel->joinRequest(['kode_ro' => $kode_ro]),
            ];
        }
        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('requestorder/open_detail', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }
    //fugnsi manggil tampilan edit data
    public function get_data_edit()
    {
        $kode_ro = $this->uri->segment(3);
        if ($this->session->userdata('role_id') == 3) {
            $this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Maaf Akses Terbatas!</strong> anda tidak diperkenankan menambah request.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('requestorder');
        } {
            $data = [
                'title' => 'Edit Request',
                'user' => $this->userModel->get_user_session(),
                //olah kode_ro yang dari view masuk ke requestModel
                'request' => $this->requestModel->get_requestbyKode($kode_ro),
                'detail' => $this->requestModel->joinDetail($kode_ro),
                'user_req' => $this->requestModel->joinRequest(['kode_ro' => $kode_ro]),
            ];
        }
        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('requestorder/open_detail', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    //fungsi menampilkan formuler edit detailnya dulu
    public function form_edit_detail()
    {
        if ($this->session->userdata('role_id') == 3) {
            $this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Maaf Akses Terbatas!</strong> anda tidak diperkenankan menambah request.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('requestorder');
        } {
            $id = $this->uri->segment(3);
            $data = [
                'title' => 'Edit Request',
                'user' => $this->userModel->get_user_session(),
                //olah kode_ro yang dari view masuk ke requestModel
                'detail' => $this->requestModel->get_detailbyID($id),
            ];
        }
        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('requestorder/edit_detail', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    //fungsi nampilin form edit request
    public function form_edit_request()
    {
        $where = $this->uri->segment(3);
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
            'title' => 'Edit Request Order',
            'user' => $this->userModel->get_user_session(),
            'request' => $this->requestModel->get_requestbyKode($where),
            'detail' => $this->requestModel->get_detailbyKode($where)
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('requestorder/edit_request', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function get_add_byedit()
    {
        $kode_ro = $this->uri->segment(3);
        $data = [
            'title' => 'request order',
            'user' => $this->userModel->get_user_session(),
            'request' => $this->requestModel->get_requestbyKode($kode_ro)
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('requestorder/add_by_edit', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }
    //===========================selesai fungsi tampil======================//

    //=========================Fungsi Manipulasi Tambah/Edit/Hapus======================//

    //==========================================Fungsi Add==============================//
    //fungsi ini buat nambahin detail barang di temp table
    public function add_temp_detail()
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
            if (!$this->upload->do_upload('foto_order')) {
                $error = array('error' => $this->upload->display_errors());
                redirect('requestorder/get_pre_request', $error);
            } else {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
                // $this->upload->do_upload('foto_order');

                $data = [
                    'kode_order' => $this->input->post('kode_order', true),
                    'jenis_barang' => $this->input->post('jenis_barang', true),
                    'desk_barang' => $this->input->post('desk_barang', true),
                    'qty_order' => $this->input->post('qty_order', true),
                    'sat_order' => $this->input->post('sat_order', true),
                    'img_order' => $gambar,
                    'status_detail' => '1'
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
    }
    //fungsi nambahin detail order dari pilihan edit
    public function add_new_detail()
    {
        $kode_ro = $this->uri->segment(3);
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
            if (!$this->upload->do_upload('foto_order')) {
                $error = array('error' => $this->upload->display_errors());
                redirect('requestorder/get_pre_request', $error);
            } else {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
                // $this->upload->do_upload('foto_order');
                $data = [
                    'kode_order' => $this->input->post('kode_order', true),
                    'jenis_barang' => $this->input->post('jenis_barang', true),
                    'desk_barang' => $this->input->post('desk_barang', true),
                    'qty_order' => $this->input->post('qty_order', true),
                    'sat_order' => $this->input->post('sat_order', true),
                    'img_order' => $gambar,
                    'status_detail' => '1'
                ];
                $this->requestModel->insert_detail($data, 'detail_request');
                $this->session->set_flashdata('msg', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                data barang telah ditambahkan di table bawah, silahkan tambahkan lagi jika ingin.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>');
                redirect('requestorder/get_data_edit/' . $kode_ro);
            }
        }
    }
    //==================================APPROVAL=======================================//
    //fungsi approve detail
    public function approve_detail()
    {
        $id = $this->uri->segment(3);
        $kode = $this->db->select('kode_order')->from('detail_request')->where('id_detail', $id)->get()->row_array();
        $kd = $kode['kode_order'];

        $this->requestModel->approve_det($id);
        $this->session->set_flashdata('msg', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        Barang Telah Disetujui.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');

        //ini di redirect ke halaman detail order lagi
        redirect('requestorder/detail/' . $kd);
    }

    //fungsi reject detail
    public function reject_detail()
    {
        $id = $this->uri->segment(3);
        $kode = $this->db->select('kode_order')->from('detail_request')->where('id_detail', $id)->get()->row_array();
        $kd = $kode['kode_order'];

        $this->requestModel->reject_det($id);
        $this->session->set_flashdata('msg', '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Barang Telah Direject.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');

        redirect('requestorder/detail/' . $kd);
    }

    //untuk approve request order
    public function ro_approval()
    {
        $this->requestModel->approve_ro();

        $this->session->set_flashdata('msg', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        Permintaan Telah Disetujui.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');

        // var_dump($id);
        // die;
        redirect('requestorder');
    }

    //reject request order
    public function ro_reject()
    {
        $this->requestModel->reject_ro();

        $this->session->set_flashdata('msg', '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Permintaan Telah Ditolak.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('requestorder');
    }
    //============================================================QQ==============//
    //===========================SAVE/INSERT======================================//
    //funsi ini buat masukin inputan request_order
    public function save_requestorder()
    {
        $kode_ro = $this->uri->segment(3);
        $nip = $this->session->userdata('nip');
        $id_div = $this->session->userdata('id_divisi');

        $data = [
            'kode_ro' => $this->input->post('kode_order', true),
            'alasan_req' => $this->input->post('alasan_req', true),
            'submit_date' => $this->input->post('submit_date', true),
            'status_pengajuan' => 1,
            'divisi' => $id_div,
            'id_user' => $nip,
        ];

        $this->requestModel->insert_request($data, 'request_order');
        $this->requestModel->post_detail($kode_ro);
        $this->requestModel->delete_temp();
        $this->requestModel->joinDetail($kode_ro);
        $this->session->set_flashdata('msg', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil Diajukan!</strong> Pastikan anda mendownload/Mencetak Request Order Sebelum Kembali.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');

        redirect('requestorder/detail/' . $kode_ro);
    }

    //fungsi simpan editan data detail request
    public function save_edit_detail()
    {
        $id = $this->uri->segment(3);
        $kode_ro = $this->db->select('kode_order')->from('detail_request')->where('id_detail', $id)->get()->row_array();
        $kd_ro = $kode_ro['kode_order'];
        $old_image = $this->db->select('img_order')->from('detail_request')->where('id_detail', $id)->get()->row_array();
        $old_img = $old_image['img_order'];

        $config['upload_path'] = './assets/img/foto-order/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1260';
        $config['max_height'] = '1260';
        $config['file_name'] = 'img-order' . date('dmYHis') . '.jpg';
        $this->load->library('upload', $config);

        $image = $this->upload->data();
        $gambar = $image['file_name'];

        if (!$this->upload->do_upload('foto_order')) {
            $error = array('error' => $this->upload->display_errors());
            redirect('requestorder/get_pre_request', $error);
        } else {
            $path = './assets/img/foto-order/' . $old_img;
            unlink($path);
            $this->upload->do_upload('foto_order');
            $data = [
                'kode_order' => $this->input->post('kode_order', true),
                'jenis_barang' => $this->input->post('jenis_barang', true),
                'desk_barang' => $this->input->post('desk_barang', true),
                'qty_order' => $this->input->post('qty_order', true),
                'sat_order' => $this->input->post('sat_order', true),
                'img_order' => $gambar,
            ];
        }

        $this->requestModel->update_detail($data, $id);
        $this->session->set_flashdata('msg', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Telah diubah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('requestorder/edit_request/' . $kd_ro);
    }

    //ini fungsi untuk save edit request
    public function save_edit_request()
    {
        $kode_ro = $this->uri->segment(3);
        $nip = $this->session->userdata('nip');
        $id_div = $this->session->userdata('id_divisi');

        $data = [
            'kode_ro' => $this->input->post('kode_order', true),
            'alasan_req' => $this->input->post('alasan_req', true),
            'submit_date' => $this->input->post('submit_date', true),
            'status_pengajuan' => 1,
        ];

        $this->requestModel->update_request($data, $kode_ro);

        $this->session->set_flashdata('msg', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Edit Berhasil!</strong> Silahkan menunggu hasil approve berikutnya.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');

        redirect('requestorder');
    }
    //=================================================QQ====================================//
    //=========================================DELETE/TRUNCATE=====================================//
    //fungsi delete request order data seluruhnya
    public function delete_req_data()
    {
        $kode_ro = $this->uri->segment(3);
        $data = $this->requestModel->get_imagebyKode($kode_ro);
        foreach ($data as $img) {
            $path = './assets/img/foto-order/' . $img['img_order'];
            unlink($path);
        }

        $this->requestModel->delete_detail($kode_ro);
        $this->requestModel->delete_request($kode_ro);

        $this->session->set_flashdata('msg', '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Berhasil dihapus!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');

        redirect('requestorder');
    }

    //fungsi dibawah ini buat menghapus salah satu dari detail barang
    public function delete_temp_detail()
    {
        $id = $this->uri->segment(3);
        //ini khusus buat ngapus foto pada direktori
        $data = $this->requestModel->get_temp_detail($id)->row();
        $path = './assets/img/foto-order/' . $data->img_order;
        unlink($path);

        $this->requestModel->delete_temp_detail($id);
        $this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            data barang telah berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
        redirect('requestorder/get_pre_request');
    }

    public function delete_detailByID()
    {
        $id = $this->uri->segment(3);
        //ini khusus buat ngapus foto pada direktori
        $detail = $this->requestModel->get_detailbyID($id)->row();
        $kode_ro = $detail->kode_order;
        $row = $this->db->select('*')->from('detail_request')->where('kode_order', $kode_ro)->get()->num_rows();

        $path = './assets/img/foto-order/' . $detail->img_order;
        unlink($path);

        if ($row > 1) {
            $this->requestModel->delete_detailByID($id);

            $this->session->set_flashdata('msg', '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            data barang telah berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');

            redirect('requestorder/get_data_edit/' . $kode_ro);
        } else {
            $this->requestModel->delete_detailByID($id);
            $this->requestModel->delete_request($kode_ro);

            $this->session->set_flashdata('msg', '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            data request berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');

            redirect('requestorder');
        }
    }
    //===============================fungsi manipulasi selesai========================

    //====================================fungsi cetak================================
    public function save_pdf()
    {
        $where = $this->session->userdata('nip');
        $kode_ro = $this->uri->segment(3);
        $divisi = $this->session->userdata('id_divisi');
        $usr_apr = $this->requestModel->get_user_approval($divisi);

        $data['nama'] = $this->session->userdata('nama');
        $data['title'] = 'Print Request Order';
        $data['user'] = $this->userModel->get_user_session();
        $data['request'] = $this->requestModel->get_requestbyKode($kode_ro);
        $data['detail'] = $this->requestModel->get_detailbyKode($kode_ro);
        $data['user_approve'] = $usr_apr;

        $sroot      = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/appb-web/application/third_party/dompdf/autoload.inc.php";
        $dompdf = new Dompdf\Dompdf();
        $this->load->view('requestorder/pdf_requestorder', $data);
        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'potrait'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $dompdf->setPaper($paper_size, $orientation);
        //Convert to PDF
        $dompdf->loadHtml($html);
        $dompdf->render();
        ob_end_clean();
        $dompdf->stream("requestorder.pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan
    }
}
