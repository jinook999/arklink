<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solution extends FRONT_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
/*
	public $menus = [];
	public function _construct() {
		$this->load->model("Menu_model");
		$get_menus = $this->Menu_model->get_menus($this->_site_language, null);
	}
*/
	public function deep() {
		$this->template_print($this->template_path());
	}

	public function data() {
		$this->template_print($this->template_path());
	}

	public function ridentify() {
		$this->template_print($this->template_path());
	}

	public function deteros() {
		$this->template_print($this->template_path());
	}
	public function aegis() {
		$this->template_print($this->template_path());
	}

	public function scan() {
		$this->template_print($this->template_path());
	}
}