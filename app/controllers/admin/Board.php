<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends ADMIN_Controller {
	public $_board;
	public $boards = [];
	public function __construct() {
		parent::__construct();
		$this->load->model("Admin_Board_model");
		$this->lang->load('common_lang', 'kor');

		try {
			$arr_where = [];
			$arr_where[] = array('adminview', 'y');
			$arr_orderby = array('name asc');
			//$get_data = $this->Admin_Board_model->get_board_manege($arr_where, null, 1, null, $arr_orderby);
			$get_data = $this->Admin_Board_model->get_board_manege($arr_where, null, null, null, $arr_orderby);
			foreach($get_data['board_manage_list'] as $value) {
				if(!$this->_admin_member['super']) {
					if($value['admin']) {
						$temp_manage = explode(',', $value['admin']);
						if(in_array($this->_admin_member['userid'], $temp_manage) === false) continue;
					}
				}
				$this->boards[] = [
					'code' => $value['code'],
					'name' => $value['name'],
					'admin' => $value['admin'],
				];
			}

			$code = $this->input->get_post('code', true);
			if(isset($code) === false) {
				$code = $this->_admin_member['super'] ? $get_data['board_manage_list'][0]['code'] : $this->boards[0]['code'];
			}

			$this->Admin_Board_model->initialize($code);
			$this->_board = $this->Admin_Board_model->get_board();
			if(!$this->_admin_member['super']) {
				if($this->_board['admin']) {
					$is_allowed = explode(',', $this->_board['admin']);
					if(in_array($this->_admin_member['userid'], $is_allowed) === false) throw new Exception(print_language('do_not_have_permission'));
				}
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function board_list() {
		try{
			$this->load->library("form_validation");
			$this->load->library("pagination");
            $manage = $this->dm->get('da_manage')[0];

			$arr_orderby = array("name asc");

            // 관리자 사용여부 추가에 따른 튜닝 (리스트에서 미노출)
			$get_data = $this->Admin_Board_model->get_board_manege(array(array("adminview", "y")), null, null, null, $arr_orderby);
			//$get_data = $this->Admin_Board_model->get_board_manege(null, null, null, null, $arr_orderby);
			$arr_where = array();

			$arr_like = array();
			$files = $this->input->get("files", true);
			$language = $this->input->get("language", true);
			$search_type = $this->input->get("search_type", true);
			$search = $this->input->get("search", true);
			$limit = $this->input->get("roundpage", true);

			if(!isset($limit)) {
				$limit = $this->_board["roundpage"];
				//$limit = 10;
			}

			if($language) {
				$arr_where[] = array("language", $language);
			}

			if($files == "y") {
				$arr_where[] = array("fname", "y", "=");
			} else if($files == "n") {
				$arr_where[] = array("fname", "y", "!=", "OR", "(,");
				$arr_where[] = array("fname", null, "=", "OR", ")");
			}

			if(isset($search_type)) {
				if($search) {
					if($search_type) {
                        /*
						if($search_type == "title"){
							$arr_like[] = array("CONCAT('[',BOARD.preface,']',BOARD.title)", $search);
						}else {
							$arr_like[] = array($search_type, $search);
						}
                        */
                        $arr_like[] = array($search_type, $search);
					} else {
						$arr_like[] = array("userid", $search, null, "or", array("("));
						$arr_like[] = array("name", $search, null, "or");
						$arr_like[] = array("title", $search, null, "or");
						$arr_like[] = array("CONCAT('[',BOARD.preface,']',BOARD.title)", $search, null, "or");
						$arr_like[] = array("content", $search, null, "or");
						$arr_like[] = array("userip", $search, null, "or", array(")"));
					}
				}
			}

			$per_page = $this->input->get("per_page", true);

			if(!$per_page) {
				$per_page = 1;
			}

			$offset = ($per_page - 1) * $limit;

			$get_data = array_merge($get_data, $this->Admin_Board_model->get_list_board($arr_where, $arr_like, $limit, $offset));

			$roundpage = $this->input->get("roundpage", true) ? $this->input->get("roundpage", true) : $this->_board['roundpage'];
			$config = array(
				"total_rows" => $get_data["total_rows"],
				"per_page" => $limit,
				"first_url" => "?code=". $this->_board["code"]."&language=". $language ."&search_type=". $search_type ."&search=". $search  ."&files=". $files . "&roundpage=". $roundpage,
				"suffix" => "&code=". $this->_board["code"]."&language=". $language ."&search_type=". $search_type ."&search=". $search ."&files=". $files . "&roundpage=". $roundpage,
			);

			$this->pagination->initialize($config);
			$get_data["pagination"] = $this->pagination->create_links();
			$get_data["board_info"] = $this->_board;
			$get_data["offset"] = $offset;
            $get_data['manage'] = $manage;

			$this->set_view("admin/board/board_list", $get_data);
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function board_view() {
		try {
			if(!$this->input->get("no", true)) {
				throw new Exception("게시글의 정보를 찾을 수 없습니다.");
			}

			$this->load->library("form_validation");
			$no = $this->input->get("no", true);
			$arr_where = array();
			$arr_where[] = array("no", $no);

			$get_data = $this->Admin_Board_model->get_view_board($arr_where);
			if($this->_board["comment"] == "y") { //댓글달기 yes일경우
				$board_comment = $this->Admin_Board_model->get_list_board_comment($arr_where);
				$get_data = array_merge($get_data, $board_comment);
			}
			$get_data["board_info"] = $this->_board;
			foreach($get_data["board_view"]['extraFieldInfo'] as $key => $val){
				foreach($val as $skey => $sval){
					if($this->_board['extraFieldInfo']["option"][$key][$skey]["type"] == "file") {
						$file_fname = explode('^|^', $sval)[0];
						$file_oname = explode('^|^', $sval)[1];
						$get_data["board_view"]['extraFieldInfo'][$key][$skey] = $file_fname;
						$get_data["board_view"]['extraFieldInfo'][$key][$skey."_oname"] = $file_oname;
					}
				}
			}

			$ref = [];
			foreach($this->input->get(null, true) as $key => $value) {
				//if($key == "no") continue;
				if($key == "roundpage") {
					$ref[] = $value > 0 ? $key."=".$value : $key."=".$this->_board['roundpage'];
				} else {
					$ref[] = $key."=".$value;
				}
			}

			$get_data['ref'] = implode("&", $ref);

			$this->set_view("admin/board/board_view", $get_data);
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function board_inquire_answer_delete(){
		$no = $this->input->get("no");
		$code = $this->input->get("code");

		if(empty($no) || empty($code)){
			msg("게시글 답변 탐색에 실패했습니다.\n\n잠시후 다시 시도해주세요.", "board_view?code=". $code ."&no=". $no);
		}

		if($this->Admin_Board_model->board_inquire_answer_delete($code, $no)){
			msg("답변글을 삭제했습니다.", "board_view?code=". $code ."&no=". $no);
		}else{
			msg("답변글 삭제에 실패했습니다\n\n잠시후 다시 시도해주세요.", "board_view?code=". $code ."&no=". $no);
		}
	}
	public function board_write() {
		$this->load->library("form_validation");
		$mode = $this->input->post("mode", true);
        
		if($mode) {
			try {
				$this->form_validation->set_rules("no", print_language("board_no"), "trim|xss_clean|is_natural_no_zero");
				if(in_array($mode, array("write", "modify", "answer"))) {
					$this->form_validation->set_rules("title", "제목", "trim|required|xss_clean");
					$this->form_validation->set_rules("language", "언어", "trim|required|xss_clean");
					$this->form_validation->set_rules("name", "작성자", "trim|required|xss_clean");
					$this->form_validation->set_rules("content", "내용", "trim|required");
					$this->form_validation->set_rules("is_secret", "비밀글 추가", "trim|xss_clean");
                    if($this->_board["thumnail_count"]) {
                        for($i=1; $this->_board["thumnail_count"] >= $i; $i++){
                            $this->form_validation->set_rules("thumnail$i_fname", "썸네일첨부$i", "trim|xss_clean");
                            $this->form_validation->set_rules("thumnail$i_oname", "썸네일첨부$i", "trim|xss_clean");
                            $this->form_validation->set_rules("thumnail$i_image", "대표이미지$i", "trim|xss_clean");
                        }
                    }
                    if($this->_board["file_count"]) {
                        for($i=1; $this->_board["file_count"] >= $i; $i++){
                            $this->form_validation->set_rules("file$i_fname", "파일첨부$i", "trim|xss_clean");
                            $this->form_validation->set_rules("file$i_oname", "파일첨부$i", "trim|xss_clean");
                        }
                    }
					if($this->_board["yn_mobile"] == "y") {
						$this->form_validation->set_rules("mobile", "모바일", "trim|required|xss_clean");
					}

					if($this->_board["yn_email"] == "y") {
						$this->form_validation->set_rules("email", "이메일", "trim|required|valid_email|xss_clean");
					}

					if($this->_board["yn_video"] == "y") {
						$this->form_validation->set_rules("video_url", "동영상 주소", "trim|required|xss_clean");
					}
					$this->form_validation->set_rules("preface", "말머리", "trim|xss_clean");



                    // 답글의 경우 추가필드 사용 x -> 추가필드 유효성 검사 x 2020-06-25
                    $arr_where = array();
                    $arr_where[] = array("no", $this->input->post("no", true));
                    $get_data = $this->Admin_Board_model->get_view_board($arr_where);
                    $isNotReply = ($get_data['board_view']['clevel'] == 0);
                    unset($arr_where);
                    unset($get_data);

					// 추가 필드
					if($isNotReply && in_array($mode, array("write", "modify"))){
						for($idx=1;$idx<=10;$idx++){
							if($this->_site_language["multilingual"]){
								$selectLanguage = $this->input->post("language");
							}else{
								$selectLanguage = "kor";
							}
							foreach($this->_site_language["set_language"] as $languageKey => $languageVal){
								if($languageKey == $selectLanguage && !empty($this->_board["extraFieldInfo"]["use"][$languageKey]["ex".$idx])){
									$this->form_validation->set_rules("ex".$idx."_".$selectLanguage . ((isset($this->_board["extraFieldInfo"]["option"][$selectLanguage]["ex".$idx]["type"]) && $this->_board["extraFieldInfo"]["option"][$selectLanguage]["ex".$idx]["type"] == "file") ? "_fname" : ""), $this->_board["extraFieldInfo"]["name"][$selectLanguage]["ex".$idx], "trim". ($this->_board["extraFieldInfo"]["option"][$selectLanguage]["ex".$idx]["type"] != "editor" ? "|xss_clean" : "") . (isset($this->_board["extraFieldInfo"]["use"][$selectLanguage]["ex".$idx]) && isset($this->_board["extraFieldInfo"]["require"][$selectLanguage]["ex".$idx]) ? "|required" : ""));
									if($this->_board["extraFieldInfo"]["option"][$selectLanguage]["ex".$idx]["type"] == "file"){
										$_POST["ex".$idx."_".$selectLanguage] = $_POST["ex".$idx."_".$selectLanguage."_fname"];
									}
								}else{
									unset($_POST["ex".$idx."_".$languageKey]);
								}
							}

						}
					}
				} else if(in_array($mode, array("inquire_answer_write", "inquire_answer_modify"))) {
					$this->form_validation->set_rules("answer_title", "답변제목", "trim|required|xss_clean");
					$this->form_validation->set_rules("answer_content", "답변내용", "trim|required");
				}

				if($this->form_validation->run()){
					$data = $this->input->post(null, false);
					//2020-03-17 Inbet Matthew 첨부파일 로직 수정 기존 로직은 게시판 생성시 첨부파일 사용 갯수로 체크했는데 이럴 경우 첨부파일은 사용하지만 파일을 선택하지 않았을때도 첨부파일이 있다고 리스트에 아이콘이 노출되어 수정함 (기존 로직이 주석처리된 코드)

					/*if($this->_board["file_count"] > 0){
						$data['fname'] = 'y';
					}else{
						$data['fname'] = '';
					}*/
					$fileExistStatusArr = [];
					if($this->_board["file_count"] > 0) {
						for($i = 1; $i <= $this->_board["file_count"]; $i++) {
							if($data["file".$i."_oname"] != '') {
								$fileExistStatusArr[$i] = 'y';
							}else{
								$fileExistStatusArr[$i] = 'n';
							}
						}
					}
					$fileCnt = array_count_values($fileExistStatusArr);

					if($fileCnt['y'] > 0) {
						$data['fname'] = 'y';
					}else{
						$data['fname'] = '';
					}
					//Matthew end
					$no = $this->Admin_Board_model->board_write($data, $mode);
					if($no) {
						if($mode == 'inquire_answer_write') {
							if($this->_board['yn_send_mail'] == 'y') {
								$this->load->library('Sendemail');
								$reply = $this->dm->get('da_board_'.$data['code'], [], ['no' => $no])[0];
								$to[] = ['email' => $reply['email'], 'name' => $reply['name']];
								/*
								$this->sendemail->setup('mail_answer.html', [
									'title' => $reply['answer_title'],
									'qustion_title' => $reply['title'],
									'qustion_content' => $reply['content'],
									'answer_content' => $reply['answer_content'],
								], $to);
								*/
								$this->sendemail->setup([
									'language' => 'kor',
									'types' => 'answer',
									'mailto' => ['name' => $reply['name'], 'email' => $reply['email']],
									'extrainfos' => [
										//'qustion_title' => $reply['title'],
										'qustion_content' => $reply['content'],
										'answer_content' => $reply['answer_content'],
									]
								], $to);
							}
						}

						if($mode == "write") {
							go("board_view?code=".$this->_board["code"]."&no=". $no, "parent");
						} else {
							go("board_view?".$this->input->post("ref", true), "parent");
						}
					} else {
						msg("글을 작성하지 못 하였습니다.\n\n잠시후 다시 시도해주세요.");
					}
				} else {
					if(validation_errors()) {
						msg(validation_errors());
					}
				}
			} catch(Exception $e) {
				msg($e->getMessage(), -1, "parent");
			}
		} else {
			try {
				if($this->input->get("cref", true)) {
					$mode = "answer"; // 답글쓰기
				} else if($this->input->get("answer_status", true) == "n") {
					$mode = "inquire_answer_write"; // 답변작성
				} else if($this->input->get("answer_status", true) == "y") {
					$mode = "inquire_answer_modify"; // 답변수정
				} else if($this->input->get("no", true)) {
					$mode = "modify"; // 수정
				} else {
					$mode = "write"; // 작성
				}
				$get_data	= array();

				$this->_board["mode"] = $mode;
				if(in_array($mode, array("inquire_answer_modify", "modify", "answer"))) {
					$no = $this->input->get("no", true);
					$arr_where = array();
					$arr_where[] = array("no", $no);
					$get_data = $this->Admin_Board_model->get_view_board($arr_where);

                    // 글 수정시 추가파일 정보 가공 추가 2020-06-24
                    foreach($get_data["board_view"]['extraFieldInfo'] as $key => $val){
                        foreach($val as $skey => $sval){
                            if($this->_board['extraFieldInfo']["option"][$key][$skey]["type"] == "file") {
                                $file_fname = explode('^|^', $sval)[0];
                                $file_oname = explode('^|^', $sval)[1];
                                $get_data["board_view"]['extraFieldInfo'][$key][$skey] = $file_fname;
                                $get_data["board_view"]['extraFieldInfo'][$key][$skey."_oname"] = $file_oname;
                            }
                        }
                    }

					if($mode == "answer") {
						if(isset($get_data["board_view"])) {
							$is_secrect = $get_data["board_view"]['is_secret'];
							$originLanguage = $get_data["board_view"]["language"];
							unset($get_data);
							$get_data['board_view'] = array("is_secret" => $is_secrect, "language" => $originLanguage);
						}

                        $this->_board['extraFl'] = 'n'; // 답글 수정일때 추가필드 입력폼 노출 x 20200427
					}

                    if($mode == "modify") {
                        if($get_data['board_view']['cref'] != $get_data['board_view']['no']) {
                            $this->_board['extraFl'] = 'n'; // 답글 수정일때 추가필드 입력폼 노출 x 20200427
                        }
                    }

				}

				$get_data["board_info"] = $this->_board;
				$get_data["form_attribute"] = array(
					"name" => "frm",
					"id" => "frm",
					"target" => "ifr_processor",
				);

				$this->config->load("cfg_boardField");
				$get_data["boardField"] = $this->config->item("boardField");
				$get_data['ref'] = http_build_query($this->input->get(null, true));

				$this->set_view("admin/board/board_write", $get_data);
			} catch(Exception $e) {
				msg($e->getMessage(), -1);
			}
		}
	}

	public function board_delete() {
		try {
			if(!$this->input->get("no", true)) {
				throw new Exception("게시글의 정보를 찾을 수 없습니다.");
			}

			$no = $this->input->get("no", true);
			$arr_where = array();
			$arr_where[] = array("no", $no);

			$result = $this->Admin_Board_model->board_delete($arr_where);

			if($result) {
                $board_data = array();
                $board_data["master_no"] = $no;
                $board_data["code"] = $this->input->get("code", true);
                $this->Admin_Board_model->board_file_delete($board_data);

                // 댓글 삭제
				$coment_where = array();
				$coment_where[] = array("code", $this->input->get("code", true));
				$coment_where[] = array("no", $no);
				$this->Admin_Board_model->board_comment_delete($coment_where);

				msg("글이 삭제되었습니다.", "board_list?code=". $this->_board["code"]);
			} else {
				throw new Exception("게시글의 삭제를 실패하였습니다.\n\n잠시후 다시 시도해주세요.");
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function board_comment_write() {
		try {
			if(!defined("_IS_AJAX")) {
				throw new Exception("접근할 수 없는 페이지입니다.");
			}

			$this->load->library("form_validation");

			$this->form_validation->set_rules("mode", "호출타입", "trim|required|xss_clean");
			$this->form_validation->set_rules("no", "게시글번호", "trim|required|xss_clean|is_natural_no_zero");
			$this->form_validation->set_rules("name", "작성자", "trim|required|xss_clean");
			$this->form_validation->set_rules("content", "내용", "trim|required|xss_clean");
			$this->form_validation->set_rules("file_fname", "파일첨부", "trim|xss_clean");
			$this->form_validation->set_rules("file_oname", "파일첨부", "trim|xss_clean");

			if($this->form_validation->run()){
				$mode = $this->input->post("mode", true);
				$data = $this->input->post(null, true);
				$this->Admin_Board_model->board_comment_write($data, $mode);
				if($mode == "write") {
					echo json_encode(array("code" => true, "msg" => "댓글을 등록하였습니다."));
				} else {
					echo json_encode(array("code" => true, "msg" => "댓글을 수정하였습니다."));
				}
			} else {
				if(validation_errors()) {
					throw new Exception(validation_errors());
				}
			}

		} catch(Exception $e) {
			echo json_encode(array("code" => false, "error" => $e->getMessage()));
		}
	}


	public function board_comment_delete() {
		try {
			if(!defined("_IS_AJAX")) {
				throw new Exception("접근할 수 없는 페이지입니다.");
			}
			$this->load->library("form_validation");

			$this->form_validation->set_rules("no", "게시글번호", "trim|required|xss_clean|is_natural_no_zero");
			$this->form_validation->set_rules("idx", "게시글", "trim|required|xss_clean|is_natural_no_zero");

			if($this->form_validation->run()){
				$arr_where = array();
				$arr_where[] = array("code", $this->_board["code"]);
				$arr_where[] = array("no", $this->input->post("no", true));
				$arr_where[] = array("idx", $this->input->post("idx", true));
				$result = $this->Admin_Board_model->board_comment_delete($arr_where);

				if($result) {
					echo json_encode(array("code" => true, "msg" => "댓글을 삭제하였습니다."));
				} else {
					throw new Exception("게시글의 삭제를 실패하였습니다.\n\n잠시후 다시 시도해주세요.");
				}
			} else {
				if(validation_errors()) {
					throw new Exception(validation_errors());
				}
			}
		} catch(Exception $e) {
			echo json_encode(array("code" => false, "error" => $e->getMessage()));
		}
	}

	public function board_proc() {
		try {
			$mode = $this->input->post("mode", true);
			$no = $this->input->post("no", true);
			$proc_type = $this->input->post("proc_type", true);
			$proc_code = $this->input->post("proc_code", true);
			$search_type = $this->input->post("search_type", true);
			$search = $this->input->post("search", true);
			$files = $this->input->post("files", true);

			if(!$mode) {
				throw new Exception("게시판의 정보를 찾을 수 없습니다.");
			}

			if(!proc_type) {
				throw new Exception("게시판의 정보를 찾을 수 없습니다.");
			}

			if($proc_type == "select") {
				if(!$no) {
					throw new Exception("게시판의 정보를 찾을 수 없습니다.");
				}
			}

			$arr_where = array();

			if($proc_type == "search") {
				// @todo 수정필요
				if($files == "y") {
					$arr_where[] = array("fname", "y", "=");
				} else if($files == "n") {
					$arr_where[] = array("fname", "y", "!=", "OR", "(,");
					$arr_where[] = array("fname", null, "=", "OR", ")");
				}

				if(isset($search_type)) {
					if($search) {
						if($search_type) {
							$arr_like[] = array($search_type, $search);
						} else {
							$arr_like[] = array("userid", $search, null, "or", array("("));
							$arr_like[] = array("name", $search, null, "or");
							$arr_like[] = array("title", $search, null, "or");
							$arr_like[] = array("content", $search, null, "or");
							$arr_like[] = array("userip", $search, null, "or", array(")"));
						}
					}
				}

				if($mode != "delete") {
					$this->db->where("no", "cref", false);
				}
				$data = $this->db->from("da_board_". $this->_board["code"])->get()->result_array();
				$no = array();
				foreach($data as $value) {
					$no[] = $value["no"];
				}
				$arr_where[] = array("no", $no, "IN");
			} else {
				$arr_where[] = array("no", $no, "IN");
			}

			$table = "da_board_". $proc_code;

			$arr_include = array(
				"no",
				"language",
				"userid",
				"name",
				"password",
				"title",
				"content",
				"fname",
				"oname",
				"userip",
				"fixed",
				"clevel",
				"cstep",
				"hit",
				"is_secret",
				"upload_path",
				"email",
				"mobile",
				"video_url",
				"video_thumbnail_url",
				"answer_status",
				"answer_regdt",
				"answer_updatedt",
				"answer_title",
				"answer_content",
				"answer_userid",
				"answer_name",
			);
			//	"extraFieldInfo",

			if($mode == "move") {
				if(!$this->db->table_exists($table)) {
					throw new Exception("게시판의 정보를 찾을 수 없습니다.");
				}

				$this->db->select($arr_include);
				$set_data = $this->db->from("da_board_". $this->_board["code"])->where_in("no", $no)->get()->result_array();
				foreach($set_data as $key => $value) {
					$value["origin_no"] = $value["no"];
					$value["origin_code"] = $this->_board["code"];
					$value['regdt'] = date("Y-m-d H:i:s");

					$get_data = table_data_match($table, $value);
					unset($get_data["no"]);
					unset($get_data["cref"]);
					$this->db->set("cref", "(SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '". $table ."')", false);
					$result = $this->db->insert($table, $get_data);
					if($result) {
						$new_no = $this->db->insert_id();
                        // 첨부파일 이동
                        $this->db->update("da_board_file", array("master_no" => $new_no, "code" => $proc_code), array("master_no" => $value["origin_no"], "code" => $value["origin_code"]));

						$this->db->select(implode(", ", $arr_include).", '". $new_no ."' cref, '". $this->_board["code"] ."' origin_code, no origin_no, sysdate() regdt", false);
						$this->db->from("da_board_". $this->_board["code"]);
						$this->db->where("cref", $value["origin_no"]);
						$this->db->where("no !=", $value["origin_no"]);
						$insert_data = $this->db->get()->result_array();
						foreach ($insert_data as $insert_value) {
							unset($insert_value["no"]);
							$insert_result = $this->db->insert($table, $insert_value);
                            // 답글 첨부파일 이동
                            $insert_no = $this->db->insert_id();
                            $this->db->update("da_board_file", array("master_no" => $insert_no, "code" => $proc_code), array("master_no" => $insert_data["origin_no"], "code" => $insert_data["origin_code"]));
						}

						$delete_result = $this->db->where(array("no" => $value["origin_no"]))->or_where(array("cref" => $value["origin_no"]))->delete("da_board_". $this->_board["code"]);
					} else {
						throw new Exception("게시글의 이동 진행 중 ". ($key + 1) ."번째에서 실패하였습니다.\n\n잠시후 다시 시도해주세요.");
					}
				}
				msg("글이 이동되었습니다.", "board_list?code=". $this->_board["code"]);
			} else if($mode == "copy") {

				if(!$this->db->table_exists($table)) {
					throw new Exception("게시판의 정보를 찾을 수 없습니다.");
				}

				$this->db->select($arr_include);
				$set_data = $this->db->from("da_board_". $this->_board["code"])->where_in("no", $no)->get()->result_array();

				foreach($set_data as $key => $value) {
					$value["origin_no"] = $value["no"];
					$value["origin_code"] = $this->_board["code"];
					$value['regdt'] = date("Y-m-d H:i:s");

					$get_data = table_data_match($table, $value);

					unset($get_data["no"]);
					unset($get_data["cref"]);
					$this->db->set("cref", "(SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '". $table ."')", false);
					$result = $this->db->insert($table, $get_data);
					if($result) {
						$new_no = $this->db->insert_id();

						$insert_data_file = $this->db->from("da_board_file")->where(array("code" => $this->_board["code"], "master_no"=> $value["origin_no"]))->get()->result_array();
						foreach ($insert_data_file as $insert_value_file) {
							unset($insert_value_file['no']);
							$insert_value_file['code'] = $proc_code;
							$insert_value_file['master_no'] = $new_no;
							$insert_result = $this->db->insert("da_board_file", $insert_value_file);
						}

						$this->db->select(implode(", ", $arr_include).", '". $new_no ."' cref, '". $this->_board["code"] ."' origin_code, no origin_no, sysdate() regdt", false);
						$this->db->from("da_board_". $this->_board["code"]);
						$this->db->where("cref", $value["origin_no"]);
						$this->db->where("no !=", $value["origin_no"]);
						$insert_data = $this->db->get()->result_array();
						foreach ($insert_data as $insert_value) {
							$insert_data_file = $this->db->from("da_board_file")->where(array("code" => $this->_board["code"], "master_no"=> $insert_value["no"]))->get()->result_array();
							unset($insert_value["no"]);
							$insert_result = $this->db->insert($table, $insert_value);
                            // 답글 첨부파일 복사
                            $insert_no = $this->db->insert_id();

							foreach ($insert_data_file as $insert_value_file) {
								unset($insert_value_file['no']);
								$insert_value_file['code'] = $proc_code;
								$insert_value_file['master_no'] = $insert_no;
								$insert_result = $this->db->insert("da_board_file", $insert_value_file);
							}
						}
					} else {
						throw new Exception("게시글의 복사 진행 중 ". ($key + 1) ."번째에서 실패하였습니다.\n\n잠시후 다시 시도해주세요.");
					}
				}
				msg("글이 복사되었습니다.", "board_list?code=". $this->_board["code"]);
			} else if($mode == "delete") {
				$result = $this->Admin_Board_model->board_delete($arr_where);
				if($result) {
					msg("글이 삭제되었습니다.", "board_list?code=". $this->_board["code"]);
				} else {
					throw new Exception("게시글의 삭제를 실패하였습니다.\n\n잠시후 다시 시도해주세요.");
				}
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

    public function client_blocked_ip() {
        try {
            $post = $this->input->post(null, true);
            $temp = explode('|', $post['blocked_ip']);
            array_push($temp, $post['client_ip']);
            $result = array_filter($temp);
            $this->dm->update('da_manage', ['no' => 1], ['blocked_ip' => implode('|', $result)]);
            msg('해당 아이피를 정상적으로 차단하였습니다.', 'board_list?code='.$post['code'].'&'.$post['qs']);
        } catch(Exception $e) {
            msg($e->getMessage(), -1);
        }
    }

	public function manage_admin() {
		$data = [];
		$code = $this->input->get('code', null);
		$data['board'] = $this->dm->get('da_board_manage', [], ['code' => $code])[0];
		$data['admin'] = $this->dm->get('da_member', [], ['level >' => 79], [], [], ['name' => 'ASC']);
		
		$this->load->view('admin/board/manage_admin', $data);
	}

	public function manage_admin_update() {
		$post = $this->input->post(null, true);
		$admin = implode(',', $post['admin']);
		$this->dm->update('da_board_manage', ['code' => $post['code']], ['admin' => $admin]);
		msg('정상적으로 적용되었습니다', 'manage_admin?code='.$post['code']);
	}

	public function sort_order_update() {
		try {
			if(!defined("_IS_AJAX")) {
				throw new Exception("접근할 수 없는 페이지입니다.");
			}
			$code = $this->input->post('code', true);
			$no   = (int)$this->input->post('no', true);
			$dir  = $this->input->post('direction', true);

			if(!in_array($code, ['cert', 'patent']) || !$no || !in_array($dir, ['up', 'down'])) {
				throw new Exception("잘못된 요청입니다.");
			}

			$table = 'da_board_' . $code;

			// 현재 게시글의 sort_order 가져오기
			$current = $this->db->select('no, sort_order')->get_where($table, ['no' => $no])->row_array();
			if(!$current) throw new Exception("게시글을 찾을 수 없습니다.");

			$cur_order = (int)$current['sort_order'];

			// 인접 게시글 찾기 (sort_order ASC, no ASC 기준)
			if($dir === 'up') {
				// 현재보다 앞에 있는 것 중 가장 마지막 (바로 위)
				$target = $this->db->query(
					"SELECT no, sort_order FROM `$table` WHERE sort_order < ? OR (sort_order = ? AND no < ?) ORDER BY sort_order DESC, no DESC LIMIT 1",
					[$cur_order, $cur_order, $no]
				)->row_array();
			} else {
				// 현재보다 뒤에 있는 것 중 가장 처음 (바로 아래)
				$target = $this->db->query(
					"SELECT no, sort_order FROM `$table` WHERE sort_order > ? OR (sort_order = ? AND no > ?) ORDER BY sort_order ASC, no ASC LIMIT 1",
					[$cur_order, $cur_order, $no]
				)->row_array();
			}

			if(!$target) {
				echo json_encode(['code' => false, 'msg' => '더 이상 이동할 수 없습니다.']);
				return;
			}

			$tgt_order = (int)$target['sort_order'];
			$tgt_no    = (int)$target['no'];

			// sort_order swap
			$this->db->update($table, ['sort_order' => $tgt_order], ['no' => $no]);
			$this->db->update($table, ['sort_order' => $cur_order], ['no' => $tgt_no]);

			echo json_encode(['code' => true]);
		} catch(Exception $e) {
			echo json_encode(['code' => false, 'msg' => $e->getMessage()]);
		}
	}
}