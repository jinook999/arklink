<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends FRONT_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Database_model', 'dm');
	}

	public function index() {
		$this->content();
	}

	public function content() {
		$get = $this->input->get(null, true);
		if($get['no']) $where['no'] = $get['no'];
		if($get['file']) $where['page_name'] = $get['file'];
		$view = $this->dm->get('da_page', [], $where)[0];

		if($view['page_type'] === 'file') $view['content'] = file_get_contents(FCPATH.'upload/page_attachment/'.$view['rename']);

		$this->template_->assign('view', $view);
		$this->template_print($this->template_path());
	}
}