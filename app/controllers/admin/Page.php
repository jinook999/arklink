<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends ADMIN_Controller {
	private $attachment;

	public function __construct() {
		parent::__construct();
		$this->attachment = FCPATH.'upload/page_attachment/';
	}

	public function page_list () {
        $this->load->library('pagination');
        $get = $this->input->get(null, true);
		$data = $where = $like = [];
        $limit = !isset($get['limit']) ? 20 : $get['limit'];
        $per_page = !$get['per_page'] ? 1 : $get['per_page'];
        $offset = ($per_page - 1) * $limit;
        $data['offset'] = $offset;
        $data['get'] = $get;

        $sort['no'] = 'DESC';

        $data['all'] = $this->dm->get('da_page', [], $where, $like);
		$data['list'] = $this->dm->get('da_page', [], $where, $like, [], $sort, [$limit, $offset]);

        $qs = [];
        foreach($get as $key => $value) {
            if($key !== 'per_page') $qs[] = $key.'='.$value;
        }

        $this->pagination->initialize([
            'total_rows' => count($data['all']),
            'per_page' => $limit,
            'first_url' => '?'.implode('&', $qs),
            'suffix' => '&'.implode('&', $qs),
        ]);
        $data['pagination'] = $this->pagination->create_links();
		$this->set_view('admin/page/page_list', $data);
	}

	public function page_write () {
		$get = $this->input->get(null, true);
		$data = [];
		$data['get'] = $get;
		$data['write'] = $this->dm->get('da_page', [], ['no' => $get['no']])[0];
		$this->set_view('admin/page/page_write', $data);
	}

	public function page_insert() {
		$post = $this->input->post(null, true);
		$this->load->library('upload', [
			'upload_path' => $this->attachment,
			'allowed_types' => 'html',
			'encrypt_name' => true,
		]);
		$this->upload->do_upload('content_file');
		$upload = $this->upload->data();
		$include_header = $post['include_header'] === 'y' ? 'y' : 'n';
		$include_footer = $post['include_footer'] === 'y' ? 'y' : 'n';
		$no = $this->dm->insert('da_page', [
			'title' => $post['title'],
			'include_header' => $include_header,
			'include_footer' => $include_footer,
			'original' => $upload['orig_name'],
			'rename' => $upload['file_name'],
			'content' => $post['content'],
			'use_seo' => $post['use_seo'],
			'seo_title' => $post['seo_title'],
			'seo_author' => $post['seo_author'],
			'seo_description' => $post['seo_description'],
			'seo_keywords' => $post['seo_keywords'],
		], true);
		//debug($this->db->last_query());
		msg('정상적으로 등록되었습니다.', 'page_write?no='.$no);
	}

	public function page_update() {
		$post = $this->input->post(null, true);
		$this->load->library('upload', [
			'upload_path' => $this->attachment,
			'allowed_types' => 'html',
			'encrypt_name' => true,
		]);
		$this->upload->do_upload('content_file');
		$upload = $this->upload->data();
		$include_header = $post['include_header'] === 'y' ? 'y' : 'n';
		$include_footer = $post['include_footer'] === 'y' ? 'y' : 'n';

		$this->dm->update('da_page', ['no' => $post['no']], [
			'title' => $post['title'],
			'include_header' => $include_header,
			'include_footer' => $include_footer,
			//'original' => $upload['orig_name'],
			//'renam' => $upload['file_name'],
			'content' => $post['content'],
			'use_seo' => $post['use_seo'],
			'seo_title' => $post['seo_title'],
			'seo_author' => $post['seo_author'],
			'seo_description' => $post['seo_description'],
			'seo_keywords' => $post['seo_keywords'],
		]);
		debug($this->db->last_query());
		//msg('정상적으로 수정되었습니다.', 'page_write?no='.$post['no']);
	}
}