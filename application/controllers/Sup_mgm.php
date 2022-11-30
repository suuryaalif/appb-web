<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sup_mgm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //ini fungsi helper untuk mencegah login lewat url
        has_login();
        if ($this->session->userdata('role_id') != 1) {
            redirect('home/error_choice');
        }
        //panggil model
        $this->load->model('userModel');
        $this->load->model('supplierModel');
        $this->load->helper(array('url', 'form'));
    }

    //menampilkan semua data supplier
    public function index()
    {

        $data = [
            'title' => 'supplier management',
            'data_supp' => $this->supplierModel->get_data(),
            'user' => $this->userModel->get_user_session()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('supplierMgm/index', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    //menampilkan formulir tambah data
    public function new_form()
    {
        $data = [
            'title' => 'supplier management',
            'data_supp' => $this->supplierModel->get_data(),
            'user' => $this->userModel->get_user_session()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('supplierMgm/tambahSup', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    //fungsi simpan data baru atau data yang di edit
    public function add_new($id = null)
    {
        $this->form_validation->set_rules('nama_sup', 'Nama_sup', 'required', [
            'required' => 'nama wajib diisi'
        ]);
        $this->form_validation->set_rules('pic_sup', 'pic', 'required', [
            'required' => 'nama wajib diisi'
        ]);
        $this->form_validation->set_rules('tlp_sup', 'Tlp_sup', 'required|trim|numeric|max_length[15]', [
            'required' => 'wajib diisi',
            'trim' => 'kjangan ada spasi',
            'max_length[15]' => 'jumlah digit tidak sesuai'
        ]);
        $this->form_validation->set_rules('required|trim|is_unique[supplier.email_sup]|valid_email', [
            'is_unique[supplier.email_sup]' => 'alamat email telah didaftarkan'
        ]);
        $this->form_validation->set_rules('alamat_sup', 'Alamat_sup', 'required|min_length[5]', [
            'required' => 'alamat wajib diisi',
            'min_length[5]' => 'terlalu pendek'
        ]);
        $this->form_validation->set_rules('nama_bank_sup', 'Nama_bank_sup', 'required', [
            'required' => 'mohon isikan nama bank'
        ]);
        $this->form_validation->set_rules('no_rek', 'No_rek', 'required', [
            'required' => 'nomor rekening wajib diisi'
        ]);
        //jika falidasi gagal
        if ($this->form_validation->run() == false) {
            //jika ada parameter ID atau Metode Edit
            if ($id != null) {
                $data = [
                    'title' => 'supplier management',
                    'data_sup' => $this->supplierModel->get_data($id),
                    'user' => $this->userModel->get_user_session()
                ];

                $this->load->view('homepage/layouts/header', $data);
                $this->load->view('homepage/layouts/sidebar', $data);
                $this->load->view('homepage/layouts/topbar', $data);
                $this->load->view('supplierMgm/editSup', $data);
                $this->load->view('homepage/layouts/footer', $data);
            } else {
                //jika gak ada dia langsung masuk ke fungsi nambahin
                $data = [
                    'title' => 'supplier management',
                    'data_supp' => $this->supplierModel->get_data(),
                    'user' => $this->userModel->get_user_session()
                ];

                $this->load->view('homepage/layouts/header', $data);
                $this->load->view('homepage/layouts/sidebar', $data);
                $this->load->view('homepage/layouts/topbar', $data);
                $this->load->view('supplierMgm/tambahSup', $data);
                $this->load->view('homepage/layouts/footer', $data);
            }
        } else {
            if ($id != null) {
                //jika validasi salah dan ada parameter ID atau metod edit validasi salah
                $data = [
                    'nama_sup' => $this->input->post('nama_sup', true),
                    'pic_sup' => $this->input->post('pic_sup', true),
                    'tlp_sup' => $this->input->post('tlp_sup', true),
                    'email_sup' => $this->input->post('email_sup', true),
                    'alamat_sup' => $this->input->post('alamat_sup', true),
                    'nama_bank_sup' => $this->input->post('nama_bank_sup', true),
                    'no_rek' => $this->input->post('no_rek', true),
                    'created_at' => time()
                ];

                $this->supplierModel->update_sup($data, $id);
                $this->session->set_flashdata('msg', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat !</strong> anda berhasil mengedit supplier.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>');
                redirect('sup_mgm');
            } else {
                //jika validasi berhasil tanpa paremeter tinggal tambah
                $data = [
                    'nama_sup' => $this->input->post('nama_sup', true),
                    'pic_sup' => $this->input->post('pic_sup', true),
                    'tlp_sup' => $this->input->post('tlp_sup', true),
                    'email_sup' => $this->input->post('email_sup', true),
                    'alamat_sup' => $this->input->post('alamat_sup', true),
                    'nama_bank_sup' => $this->input->post('nama_bank_sup', true),
                    'no_rek' => $this->input->post('no_rek', true),
                    'created_at' => time()
                ];

                $this->db->insert('supplier', $data);
                $this->session->set_flashdata('msg', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat !</strong> anda berhasil menambahkan supplier.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
                redirect('sup_mgm');
            }
        }
    }

    //fungsi nampilin form edit
    public function edit($id)
    {
        $data = [
            'title' => 'supplier management',
            'data_sup' => $this->supplierModel->get_data($id),
            'user' => $this->userModel->get_user_session()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('supplierMgm/editSup', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function delete($id)
    {
        $this->supplierModel->delete_byid($id);
        $this->session->set_flashdata('msg', '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data Dihapus !</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('sup_mgm');
    }
}
