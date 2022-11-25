<?php

use SebastianBergmann\Type\TrueType;

defined('BASEPATH') or exit('No direct script access allowed');

class Webpage extends CI_Controller
{

	public function index()
	{
		$this->load->view('webpage/layouts/header');
		$this->load->view('webpage/about');
		$this->load->view('webpage/layouts/footer');
	}

	public function service()
	{
		$this->load->view('webpage/layouts/header');
		$this->load->view('webpage/service');
		$this->load->view('webpage/layouts/footer');
	}

	public function contact()
	{
		$this->load->view('webpage/layouts/header');
		$this->load->view('webpage/contact');
		$this->load->view('webpage/layouts/footer');
	}

	public function tracking_page()
	{
		$this->load->view('webpage/layouts/header');
		$this->load->view('webpage/tracking');
		$this->load->view('webpage/layouts/footer');
	}

	public function get_login()
	{
		$this->load->view('loginpage/index');
	}

	public function get_registration()
	{
		$this->load->view('loginpage/registerform');
	}

	public function track($id = null)
	{
		if ($id == true) {
			$this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Maaf Akses Terbatas!</strong> anda tidak diperkenankan menambah request.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');

			redirect('webpage/track');
		}

		$this->load->model('requestModel');

		$id = $this->input->post('trackid', true);
		$result = $this->requestModel->get_requestbyKode($id);

		$data = [
			'id' => $id,
			'result_kode' => $result
		];

		// var_dump($data);
		// die;

		if ($result == null) {
			$this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Maaf Akses Terbatas!</strong> anda tidak diperkenankan menambah request.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');

			redirect('webpage/track');
		} else {
			$this->load->view('webpage/layouts/header');
			$this->load->view('webpage/tracked', $data);
			$this->load->view('webpage/layouts/footer');
		}
	}
}
