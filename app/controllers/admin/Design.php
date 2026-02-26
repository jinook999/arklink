<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Design extends ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->attachment = FCPATH.'upload/page_attachment/';
		$this->load->library('pagination');
	}

	public function banner_list() {
        $get = $this->input->get(null, true);
		$data = $where = $like = [];
        $limit = !isset($get['limit']) ? 5 : $get['limit'];
        $per_page = !$get['per_page'] ? 1 : $get['per_page'];
        $offset = ($per_page - 1) * $limit;
        $data['offset'] = $offset;
        $data['get'] = $get;

		$data['all'] = $this->dm->get('da_banner', [], $where, $like);
		$data['lists'] = $this->dm->get('da_banner', [], $where, $like, [], ['no' => 'DESC'], [$limit, $offset]);

        $this->pagination->initialize([
            'total_rows' => count($data['all']),
            'per_page' => $limit,
            'first_url' => '?'.implode('&', $qs),
            'suffix' => '&'.implode('&', $qs),
        ]);
        $data['pagination'] = $this->pagination->create_links();

		$this->set_view('admin/design/banner_list', $data);
	}

	public function banner_write() {
		$no = $this->input->get('no', true);
		$data['write'] = $this->dm->get('da_banner', [], ['no' => $no])[0];
		$this->load->view('admin/design/banner_write', $data);
	}

	public function banner_insert() {
		try {
			$post = $this->input->post(null, true);
			$data = [
				'title' => $post['title'],
				'image_original' => $post['image_original'],
				'image_rename' => $post['image_rename'],
				'image_alt' => $post['image_alt'],
				'link' => $post['link'],
				'link_target' => $post['link_target'],
			];
			$this->dm->insert('da_banner', $data);
			echo '<script>alert("정상적으로 등록되었습니다."); opener.location.reload(); window.close();</script>';
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function banner_update() {
		$post = $this->input->post(null, true);
		$this->dm->update('da_banner', ['no' => $post['no']], [
			'title' => $post['title'],
			'image_original' => $post['image_original'],
			'image_rename' => $post['image_rename'],
			'image_alt' => $post['image_alt'],
			'link' => $post['link'],
			'link_target' => $post['link_target'],
		]);
		echo '<script>alert("정상적으로 수정되었습니다."); opener.location.reload(); location.replace("banner_add?no='.$post['no'].'");</script>';
	}

	public function banner_remove() {
		try {
			$get = $this->input->get(null, true);
			if($this->_admin_member['level'] < 99) throw new Exception('권한이 없습니다.');

			$banner = $this->dm->get('da_banner', [], ['no' => $get['no']])[0];
			if(file_exists(FCPATH.$banner['image_rename']) === true) unlink(FCPATH.$banner['image_rename']);
			$this->dm->remove('da_banner', ['no' => $get['no']]);
			msg('정상적으로 삭제되었습니다.', 'banner_list');
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

    public function upload() {
        $return = [];
        $post = $this->input->post(null, true);
        $this->load->library('upload', [
            'upload_path' => './upload/'.$post['dir'].'/',
            'allowed_types' => $post['allowed_types'],
            'max_size' => 5000,
            'encrypt_name' => true,
        ]);

        if($this->upload->do_upload('upload')) {
            $return = [
                'fl' => 'success',
                'oname' => $this->upload->data('orig_name'),
                'rname' => $this->upload->data('file_name'),
                'link' => '/fileRequest/download?file=/'.$post['dir'].'/'.$this->upload->data('file_name').'&save='.urldecode($this->upload->data('orig_name')),
            ];
        } else {
            $return['fl'] = strip_tags($this->upload->display_errors());
        }

        echo json_encode($return);
    }

	public function remove_image() {
		$get = $this->input->get(null, true);
		$image = FCPATH.'/upload/banner/'.$get['image'];
		if($get['no']) $this->dm->update('da_banner', ['no' => $get['no']], ['image_original' => '', 'image_rename']);
		if(file_exists($image) === true) unlink($image);
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
		$this->set_view('admin/design/page_list', $data);
	}

	public function page_write () {
		$get = $this->input->get(null, true);
		$data = [];
		$data['get'] = $get;
		$data['write'] = $this->dm->get('da_page', [], ['no' => $get['no']])[0];
		$this->set_view('admin/design/page_write', $data);
	}

	public function page_insert() {
		$post = $this->input->post(null, true);
		$include_header = $post['include_header'] === 'y' ? 'y' : 'n';
		$include_footer = $post['include_footer'] === 'y' ? 'y' : 'n';
		$data = [
			'title' => $post['title'],
			'include_header' => $include_header,
			'include_footer' => $include_footer,
			'call_page' => $post['call_page'],
			'page_type' => $post['page_type'],
			'page_name' => $post['page_name'],
			'content' => $post['content'],
			'use_seo' => $post['use_seo'],
			'seo_title' => $post['seo_title'],
			'seo_author' => $post['seo_author'],
			'seo_description' => $post['seo_description'],
			'seo_keywords' => $post['seo_keywords'],
		];
		$this->load->library('upload', [
			'upload_path' => $this->attachment,
			'allowed_types' => 'html',
			'encrypt_name' => true,
		]);
		$this->upload->do_upload('content_file');
		$upload = $this->upload->data();
		if($upload['file_name']) {
			$data['original'] = $upload['orig_name'];
			$data['rename'] = $upload['file_name'];
		}

		$no = $this->dm->insert('da_page', $data, true);
		//debug($this->db->last_query());
		msg('정상적으로 등록되었습니다.', 'page_write?no='.$no);
	}

	public function page_update() {
		$post = $this->input->post(null);
		$include_header = $post['include_header'] === 'y' ? 'y' : 'n';
		$include_footer = $post['include_footer'] === 'y' ? 'y' : 'n';

		$data = [
			'title' => $post['title'],
			'include_header' => $include_header,
			'include_footer' => $include_footer,
			'call_page' => $post['call_page'],
			'page_type' => $post['page_type'],
			'page_name' => $post['page_name'],
			'content' => $post['content'],
			'use_seo' => $post['use_seo'],
			'seo_title' => $post['seo_title'],
			'seo_author' => $post['seo_author'],
			'seo_description' => $post['seo_description'],
			'seo_keywords' => $post['seo_keywords'],
		];

		if($post['remove_attachment']) {
			unlink(FCPATH.$post['remove_attachment']);
			$data['original'] = '';
			$data['rename'] = '';
		}

		$this->load->library('upload', [
			'upload_path' => $this->attachment,
			'allowed_types' => 'html',
			'encrypt_name' => true,
		]);
		$this->upload->do_upload('content_file');
		$upload = $this->upload->data();
		if($upload['file_name']) {
			$data['original'] = $upload['orig_name'];
			$data['rename'] = $upload['file_name'];
		}

		$this->dm->update('da_page', ['no' => $post['no']], $data);
		msg('정상적으로 수정되었습니다.', 'page_write?no='.$post['no']);
	}

	public function get_duplication() {
		$get = $this->input->get(null, true);
		$is = $this->dm->get('da_page', [], ['page_name' => $get['page_name']])[0];
		echo json_encode($is);
	}

	public function remove_page() {
		$get = $this->input->get(null, true);
		$data = $this->dm->get('da_page', [], ['no' => $get['no']])[0];
		if($data['rename']) unlink(FCPATH.'upload/page_attachment/'.$data['rename']);
		$this->dm->remove('da_page', ['no' => $get['no']]);
		msg('정상적으로 삭제하였습니다.', 'page_list');
	}
}