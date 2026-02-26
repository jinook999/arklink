<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Ajax extends FRONT_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Database_model', 'dm');
	}

	public function check_it() {
		$get = $this->input->get(null, true);
		$exists = $this->dm->get('da_member', [], ['language' => $get['language'], $get['col'] => $get['value']])[0];
		echo $exists['userid'] ? 'exists' : 'not_exists';
	}
}