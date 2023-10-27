<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load_info();
	}
	public function index()
	{
		$data = $this->data;
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
