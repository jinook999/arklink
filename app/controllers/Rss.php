<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rss extends FRONT_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Database_model', 'dm');
	}

	public function index() {
		$code = $this->input->get('code', true);
		
		if(!$code) {
			show_404();
			return;
		}
		
		header('Content-Type: application/rss+xml; charset=utf-8');
		
		// 게시판 정보 가져오기
		$board = $this->dm->get('da_board_manage', [], ['code' => $code, 'adminview' => 'y'])[0];
		
		if(!$board) {
			show_404();
			return;
		}
		
		$base_url = 'https://www.arklink.co.kr';
		$table_name = 'da_board_' . $code;
		
		// RSS 헤더
		$rss = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		$rss .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . "\n";
		$rss .= '<channel>' . "\n";
		$rss .= "\t<title><![CDATA[" . $board['name'] . " - 아크링크(Arklink)]]></title>\n";
		$rss .= "\t<link>" . $base_url . "/board/board_list?code=" . $code . "</link>\n";
		$rss .= "\t<description><![CDATA[" . $board['name'] . " 게시판의 최신 글]]></description>\n";
		$rss .= "\t<language>ko</language>\n";
		$rss .= "\t<atom:link href=\"" . $base_url . "/rss?code=" . $code . "\" rel=\"self\" type=\"application/rss+xml\" />\n";
		
		// 최근 게시글 가져오기 (최대 20개)
		if($this->db->table_exists($table_name)) {
			$posts = $this->dm->get($table_name, [], ['fixed' => 0, 'is_secret' => 'n'], [], 20, [], ['regdt' => 'DESC']);
			
			foreach($posts as $post) {
				$link = $base_url . '/board/board_view?code=' . $code . '&no=' . $post['no'];
				$pubDate = date('D, d M Y H:i:s O', strtotime($post['regdt']));
				
				// 본문에서 HTML 태그 제거하고 요약
				$description = strip_tags($post['content']);
				$description = mb_substr($description, 0, 200, 'UTF-8');
				if(mb_strlen($post['content'], 'UTF-8') > 200) {
					$description .= '...';
				}
				
				$rss .= "\t<item>\n";
				$rss .= "\t\t<title><![CDATA[" . $post['title'] . "]]></title>\n";
				$rss .= "\t\t<link>" . $link . "</link>\n";
				$rss .= "\t\t<guid>" . $link . "</guid>\n";
				$rss .= "\t\t<description><![CDATA[" . $description . "]]></description>\n";
				$rss .= "\t\t<pubDate>" . $pubDate . "</pubDate>\n";
				$rss .= "\t\t<author><![CDATA[" . $post['name'] . "]]></author>\n";
				
				// 썸네일 이미지가 있으면 추가
				if($post['thumbnail_image']) {
					$image_url = $base_url . '/upload/board/' . $code . '/' . $post['thumbnail_image'];
					$rss .= "\t\t<enclosure url=\"" . $image_url . "\" type=\"image/jpeg\" />\n";
				}
				
				$rss .= "\t</item>\n";
			}
		}
		
		$rss .= '</channel>' . "\n";
		$rss .= '</rss>';
		
		echo $rss;
	}
}
