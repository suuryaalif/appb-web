<?php
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

	public function get_login()
	{
		$this->load->view('loginpage/index');
	}

	public function get_registration()
	{
		$this->load->view('loginpage/registerform');
	}
}
