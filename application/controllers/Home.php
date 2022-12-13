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
        $this->load->helper('url', 'form');
    }

    public function index()
    {
        $email = $this->session->userdata('email');
        $data = [
            'title' => 'Home Page',
            'user' => $this->userModel->get_user_session(),
            'user_info' => $this->userModel->get_user_info($email)
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
        } else if ($this->session->userdata('role_id') == 3) {
            $this->load->view('homepage/layouts/header', $data);
            $this->load->view('homepage/layouts/sidebar', $data);
            $this->load->view('homepage/layouts/topbar', $data);
            $this->load->view('homepage/db_user_app', $data);
            $this->load->view('homepage/layouts/footer', $data);
        } else {
            $this->load->view('homepage/layouts/header', $data);
            $this->load->view('homepage/layouts/sidebar', $data);
            $this->load->view('homepage/layouts/topbar', $data);
            $this->load->view('homepage/db_user_pay', $data);
            $this->load->view('homepage/layouts/footer', $data);
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

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Profile',
            'user' => $this->userModel->get_user_session(),
            'data_user' => $this->userModel->get_byID($id)
        ];
        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('homepage/edit_profile', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function update($id)
    {
        $prev_foto = $this->db->select('img_profile')->from('user')->where('id_user', $id)->get()->row_array();
        $prev = $prev_foto['img_profile'];
        $path = './assets/img/profile/' . $prev;

        $config['upload_path'] = './assets/img/profile/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '5000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $config['file_name'] = 'img-profile-' . date('dmY_His') . '.jpg';
        $this->load->library('upload', $config);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nip', 'Nip', 'required|min_length[6]|max_length[10]|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No_hp', 'required|numeric|max_length[15]');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Edit Profile',
                'user' => $this->userModel->get_user_session(),
                'data_user' => $this->userModel->get_byID($id)
            ];
            $this->load->view('homepage/layouts/header', $data);
            $this->load->view('homepage/layouts/sidebar', $data);
            $this->load->view('homepage/layouts/topbar', $data);
            $this->load->view('homepage/edit_profile', $data);
            $this->load->view('homepage/layouts/footer', $data);
        } else {
            if (!$this->upload->do_upload('img_profile')) {
                $error_msg = $this->upload->display_errors();
                $this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>' . $error_msg . '</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
                redirect('home/edit/' . $id, $error_msg);
            } else {
                if ($prev == 'default.jpg') {
                    $image = $this->upload->data();
                    $gambar = $image['file_name'];
                    $data = [
                        'nama' => $this->input->post('nama', true),
                        'nip' => $this->input->post('nip', true),
                        'email' => $this->input->post('email', true),
                        'alamat_tinggal' => $this->input->post('alamat', true),
                        'no_hp' => $this->input->post('no_hp', true),
                        'role_id' => $this->input->post('role'),
                        'id_divisi' => $this->input->post('id_divisi', true),
                        'img_profile' => $gambar
                    ];
                    $this->userModel->update_user($data, $id);
                    $this->session->set_flashdata('msg', '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat !</strong> anda berhasil merubah data.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>');
                    redirect('home/profile');
                } else {
                    unlink($path);
                    $image = $this->upload->data();
                    $gambar = $image['file_name'];
                    $data = [
                        'nama' => $this->input->post('nama', true),
                        'nip' => $this->input->post('nip', true),
                        'email' => $this->input->post('email', true),
                        'alamat_tinggal' => $this->input->post('alamat', true),
                        'no_hp' => $this->input->post('no_hp', true),
                        'role_id' => $this->input->post('role'),
                        'id_divisi' => $this->input->post('id_divisi', true),
                        'img_profile' => $gambar
                    ];
                    $this->userModel->update_user($data, $id);
                    $this->session->set_flashdata('msg', '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat !</strong> anda berhasil merubah data.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>');
                    redirect('home/profile');
                }
            }
        }
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
