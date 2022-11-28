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
		$data = [
			'title' => 'tracking order'
		];

		$this->load->view('webpage/layouts/header');
		$this->load->view('webpage/tracking', $data);
		$this->load->view('webpage/layouts/footer');
	}

	public function get_login()
	{
		$this->load->view('loginpage/index');
	}

	public function track()
	{
		$this->load->model('requestModel');
		$id = $this->input->post('trackid', true);
		$result = $this->requestModel->get_requestbyKode($id);
		$data = [
			'id' => $id,
			'result_kode' => $result
		];

		if ($result == null) {
			$this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Maaf!</strong> kode pencarian tidak ditemukan</div>');

			redirect('webpage/tracking_page');
		} else {
			$this->load->view('webpage/layouts/header');
			$this->load->view('webpage/tracked', $data);
			$this->load->view('webpage/layouts/footer');
		}
	}
}
