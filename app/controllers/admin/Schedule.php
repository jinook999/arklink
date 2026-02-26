<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends ADMIN_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data = [];
		$this->set_view('admin/schedule/index', $data);
	}

	public function add_schedule() {
		$get = $this->input->get(null, true);
		$data['get'] = $get;
		$this->load->view('admin/schedule/add_schedule', $data);
	}
}