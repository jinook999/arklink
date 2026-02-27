<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Auth extends ADMIN_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it"s displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    //삭제 불가 기본 게시판
    private $_basic_board = array("inquiry", "gallery", "notice", "review");

	public function __construct() {
		parent::__construct();
		$this->load->library("form_validation");
		$this->load->model("Auth_model");
        $this->load->model('Database_model', 'dm');
	}

    // 언어설정
	public function language_reg() {
		try{
			$mode = $this->input->post("mode", true);
			$this->load->library("form_validation");

			if(isset($mode)) {
				$language = $this->input->post("language", true);

				if(!isset($language)) {
					throw new Exception("언어 정보가 없습니다.");
				}

                // 기본언어 세팅
                if(!$language["multilingual"]) {
                    $language["set_language"]['kor'] = '한국';
                } else {
                    $language["set_language"] = array_flip($language["set_language"]);
                    foreach($language["set_language"] as $key => $val) {
                        $language["set_language"][$key] = $this->_site_language["support_language"][$key];
                    }
                }

				$set_data = "";
				$set_data .= "<?php\n";
				$set_data .= "defined('BASEPATH') OR exit('No direct script access allowed');\n\n";

				$set_data .= "\$config = array(\n";
				$set_data .= "\t'site_language' => array(\n";
				$set_data .= "\t\t'multilingual' => ". intval($language["multilingual"]) .",\n";
				$set_data .= "\t\t'set_language' => array(\n";
                foreach($language["set_language"] as $lang => $text) {
					$set_data .= "\t\t\t'$lang'	=> '$text',\n";
                }
				$set_data .= "\t\t),\n";
				$set_data .= "\t\t'support_language' => array(\n";
				foreach ($this->_site_language["support_language"] as $key => $value) {
					$set_data .= "\t\t\t'$key'	=> '$value',\n";
				}
				$set_data .= "\t\t),\n";
				$set_data .= "\t),\n";
				$set_data .= ");\n";

				$this->load->library("qfile");
				$this->qfile->open(APPPATH."/config/cfg_siteLanguage.php");
				$this->qfile->write($set_data);
				$this->qfile->close();

				msg("저장되었습니다", "language_reg");
			} else {
				$get_data = array();
				$get_data["mode"] = "register";
				$this->set_view("admin/auth/language_reg", $get_data);
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

    // 회원필드셋팅
	public function member_field() {
		try{
			$mode = $this->input->post("mode", true);
			if(isset($mode)) {
				$nameField = $this->input->post("nameField", true);
				$useField = $this->input->post("useField", true);
				$reqField = $this->input->post("reqField", true);
				$typeField = $this->input->post("typeField", true);
				$optionField = $this->input->post("optionField", true);

				//2020-03-19 Inbet Matthew 자동가입 방지 문구 사용함 체크시 필수함 자동 체크되도록 변경
				foreach ($nameField as $lkey => $lval) {
					if(array_key_exists('auto_regist_prevention_text', $useField[$lkey])) {
						$reqField[$lkey]['auto_regist_prevention_text'] = 'checked';
					}else{
						unset($reqField[$lkey]['auto_regist_prevention_text']);
					}
					if(array_key_exists('address', $useField[$lkey])){
						$nameFieldIdx = 0;
						foreach ($nameField[$lkey] as $skey => $sval) {
							if($skey == 'address') {
								$arr_front = array_slice($nameField[$lkey], 0, $nameFieldIdx);
								$arr_end = array_slice($nameField[$lkey], $nameFieldIdx);
								$arr_front['zip'] = '';
								if($lkey != 'kor') {
									$arr_front['country'] = '';
									$arr_front['city'] = '';
									$arr_front['state_province_region'] = '';
								}
								$nameField[$lkey] = array_merge($arr_front, $arr_end);
							}
							$nameFieldIdx++;
						}
						$useFieldIdx = 0;
						foreach ($useField[$lkey] as $skey => $sval) {
							if($skey == 'address') {
								$arr_front = array_slice($useField[$lkey], 0, $useFieldIdx);
								$arr_end = array_slice($useField[$lkey], $useFieldIdx);
								$arr_front['zip'] = '';
								if($lkey != 'kor') {
									$arr_front['country'] = '';
									$arr_front['city'] = '';
									$arr_front['state_province_region'] = '';
								}
								$useField[$lkey] = array_merge($arr_front, $arr_end);
							}
							$useFieldIdx++;
						}
						$typeFieldIdx = 0;
						foreach ($typeField[$lkey] as $skey => $sval) {
							if($skey == 'address') {
								$arr_front = array_slice($typeField[$lkey], 0, $typeFieldIdx);
								$arr_end = array_slice($typeField[$lkey], $typeFieldIdx);
								$arr_front['zip'] = '';
								if($lkey != 'kor') {
									$arr_front['country'] = '';
									$arr_front['city'] = '';
									$arr_front['state_province_region'] = '';
								}
								$typeField[$lkey] = array_merge($arr_front, $arr_end);
							}
							$typeFieldIdx++;
						}
						$useField[$lkey]['zip'] = 'checked';
						$typeField[$lkey]['zip'] = 'text';
						switch($lkey) {
							case 'kor':
								#$nameField[$lkey]['zip'] = '우편번호';
								break;
							case 'eng':
								#$nameField[$lkey]['zip'] = 'POSTAL_CODE';
								$useField[$lkey]['country'] = 'checked';
								$typeField[$lkey]['country'] = 'select';
								#$nameField[$lkey]['country'] = 'COUNTRY';
								$useField[$lkey]['city'] = 'checked';
								$typeField[$lkey]['city'] = 'text';
								#$nameField[$lkey]['city'] = 'CITY';
								$useField[$lkey]['state_province_region'] = 'checked';
								$typeField[$lkey]['state_province_region'] = 'text';
								#$nameField[$lkey]['state_province_region'] = 'STATE_PROVINCE_REGION';
								break;
							case 'chn':
								#$nameField[$lkey]['zip'] = '邮政编码';
								$useField[$lkey]['country'] = 'checked';
								$typeField[$lkey]['country'] = 'select';
								#$nameField[$lkey]['country'] = '国家';
								$useField[$lkey]['city'] = 'checked';
								$typeField[$lkey]['city'] = 'text';
								#$nameField[$lkey]['city'] = '城市';
								$useField[$lkey]['state_province_region'] = 'checked';
								$typeField[$lkey]['state_province_region'] = 'text';
								#$nameField[$lkey]['state_province_region'] = '州/省/地区';
								break;
							case 'jpn':
								#$nameField[$lkey]['zip'] = '郵便番号';
								$useField[$lkey]['country'] = 'checked';
								$typeField[$lkey]['country'] = 'select';
								#$nameField[$lkey]['country'] = '配送国';
								$useField[$lkey]['city'] = 'checked';
								$typeField[$lkey]['city'] = 'text';
								#$nameField[$lkey]['city'] = '都市';
								$useField[$lkey]['state_province_region'] = 'checked';
								$typeField[$lkey]['state_province_region'] = 'text';
								#$nameField[$lkey]['state_province_region'] = '州/県/地域';
								break;
							}
					}else{
						unset($nameField[$lkey]['zip']);
						unset($nameField[$lkey]['country']);
						unset($nameField[$lkey]['city']);
						unset($nameField[$lkey]['state_province_region']);
						unset($useField[$lkey]['zip']);
						unset($useField[$lkey]['country']);
						unset($useField[$lkey]['city']);
						unset($useField[$lkey]['state_province_region']);
						unset($typeField[$lkey]['zip']);
						unset($typeField[$lkey]['country']);
						unset($typeField[$lkey]['city']);
						unset($typeField[$lkey]['state_province_region']);
					}
				}
				//Matthew end

				if(!isset($nameField) || !isset($nameField) || !isset($reqField) || !isset($optionField)) {
					throw new Exception("회원필드 정보가 없습니다.");
				}
				$set_data = "";
				$set_data .= "<?php\n";
				$set_data .= "defined('BASEPATH') OR exit('No direct script access allowed');\n\n";

				$set_data .= "\$config = array(\n";
				$set_data .= "\t'memberField' => array(\n";
				$set_data .= "\t\t'name' => array(\n";
				foreach ($nameField as $language_key => $language_value) {
					$set_data .= "\t\t\t'$language_key'	=> array(\n";
					foreach ($language_value as $key => $value) {
						$set_data .= "\t\t\t\t'$key'	=> '$value',\n";
					}
					$set_data .= "\t\t\t),\n";
				}
				$set_data .= "\t\t),\n";

				$set_data .= "\t\t'use' => array(\n";
				foreach ($useField as $language_key => $language_value) {
					if($language_key == 'auto_regist_prevention_text') {
						$set_data .= "\t\t\t'$language_key'	=> '$language_value',\n";
						continue;
					}
					$set_data .= "\t\t\t'$language_key'	=> array(\n";
					foreach ($language_value as $key => $value) {
						$set_data .= "\t\t\t\t'$key'	=> '$value',\n";
					}
					$set_data .= "\t\t\t),\n";
				}
				$set_data .= "\t\t),\n";
				$set_data .= "\t\t'require' => array(\n";
				foreach ($reqField as $language_key => $language_value) {
					if($language_key == 'auto_regist_prevention_text') {
						$set_data .= "\t\t\t'$language_key'	=> '$language_value',\n";
						continue;
					}
					$set_data .= "\t\t\t'$language_key'	=> array(\n";
					foreach ($language_value as $key => $value) {
						$set_data .= "\t\t\t\t'$key'	=> '$value',\n";
					}
					$set_data .= "\t\t\t),\n";
				}
				$set_data .= "\t\t),\n";

				// 신규 type 데이터
				$set_data .= "\t\t'type' => array(\n";
				foreach ($typeField as $language_key => $language_value) {
					$set_data .= "\t\t\t'$language_key'	=> array(\n";
					foreach ($language_value as $key => $value) {
						$set_data .= "\t\t\t\t'$key'	=> '$value',\n";
					}
					$set_data .= "\t\t\t),\n";
				}
				$set_data .= "\t\t),\n";

				$set_data .= "\t\t'option' => array(\n";
				foreach($optionField as $key => $value) {
					$set_data .= "\t\t\t'$key'	=> array(\n";
					foreach($value as $secondKey => $secondValue) {
						if(!is_array($secondValue)) {
							$set_data .= "\t\t\t\t'$secondKey'	=> '$secondValue',\n";
						}
					}
					$set_data .= "\t\t\t\t'item'	=> array(\n";
					foreach($value as $language_key => $language_value) {
						$set_data .= "\t\t\t\t\t'$language_key'	=> array(\n";
						if(isset($language_value["itemName"]) && isset($language_value["itemValue"])) {
							for($i = 0; $i < count($language_value["itemName"]); $i++) {
								$set_data .= "\t\t\t\t\t'". $language_value["itemName"][$i]. "'	=> '". $language_value["itemValue"][$i] ."',\n";
							}
						}
						$set_data .= "\t\t\t\t\t),\n";
					}
					$set_data .= "\t\t\t\t),\n";
					$set_data .= "\t\t\t),\n";
				}

				$set_data .= "\t\t),\n";
				$set_data .= "\t),\n";
				$set_data .= ");\n";

				$this->load->library("qfile");
				$this->qfile->open(APPPATH."/config/cfg_memberField.php");
				$this->qfile->write($set_data);
				$this->qfile->close();

				msg("저장되었습니다", "/admin/auth/member_field");
			} else {
				$this->config->load("cfg_memberField");
				$get_data = array();
				$get_data["memberField"] = $this->config->item("memberField");
				$get_data["arr_ex"] = array("ex1", "ex2", "ex3", "ex4", "ex5", "ex6", "ex7", "ex8", "ex9", "ex10",
							"ex11", "ex12", "ex13", "ex14", "ex15", "ex16", "ex17", "ex18", "ex19", "ex20"); // 관리자 커스텀 필드

				$get_data["readonly"] = array("sex", "birth", "yn_mailling", "yn_sms", "email", "fax", "zip", "address", "address2", "mobile"); //변경불가
				$get_data["radio"] = array(
					"sex" => array(
						"m" => "남자",
						"w" => "여자"
					),
					"yn_mailling" => array(
						"y" => "수신동의",
						"n" => "수신거부"
					),
					"yn_sms" => array(
						"y" => "수신동의",
						"n" => "수신거부"
					),
				);

				//2020-04-07 Inbet Matthew 기본으로 제공되는 이메일 주소 정의
				$emailDefaultAddrArr = [];
				foreach($get_data['memberField']['name'] as $languageKey => $languageVal){
					switch($languageKey) {
						case 'kor':
							$emailDefaultAddrArr[$languageKey] = [
								'직접입력',
								'naver.com',
								'hanmail.net',
								'daum.net',
								'nate.com',
								'hotmail.com',
								'gmail.com',
								'icloud.com'
							];
							break;
						case 'eng':
							$emailDefaultAddrArr[$languageKey] = [
								'Direct input',
								'naver.com',
								'hanmail.net',
								'daum.net',
								'nate.com',
								'hotmail.com',
								'gmail.com',
								'icloud.com'
							];
							break;
						case 'chn':
							$emailDefaultAddrArr[$languageKey] = [
								'直接输入',
								'naver.com',
								'hanmail.net',
								'daum.net',
								'nate.com',
								'hotmail.com',
								'gmail.com',
								'icloud.com'
							];
							break;
						case 'jpn':
							$emailDefaultAddrArr[$languageKey] = [
								'直接入力',
								'naver.com',
								'hanmail.net',
								'daum.net',
								'nate.com',
								'hotmail.com',
								'gmail.com',
								'icloud.com'
							];
							break;
					}
				}
				$get_data['emailDefaultAddr'] = $emailDefaultAddrArr;
				//Matthew end

				$get_data["fieldset"] = array(
					"default"	=> array( // 기본
						"userid",
						"name",
						"password",
					), "hidden" => array( // 숨김처리
						"level",
						"group",
						"password_moddt",
						"password_skip_cnt",
						"regdt",
						"last_login",
						"last_login_ip",
						"cnt_login",
						"withdrawal_reason",
						"withdrawal_dt",
						"yn_dormant_mail",
						"dormant_mail_dt"
					), "etc" => array( // 기타
						"auto_regist_prevention_text",
						"sex",
						"birth",
						"email",
						"address",
						"address2",
						"mobile",
						"fax",
						"yn_mailling",
						"yn_sms",
						"ex1",
						"ex2",
						"ex3",
						"ex4",
						"ex5",
						"ex6",
						"ex7",
						"ex8",
						"ex9",
						"ex10",
						"ex11",
						"ex12",
						"ex13",
						"ex14",
						"ex15",
						"ex16",
						"ex17",
						"ex18",
						"ex19",
						"ex20",
					)
				);
				$get_data["mode"] = "register";
				$this->set_view("admin/auth/member_field", $get_data);
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	/**
	 * 게시판필드셋팅
	 * @author James
	 */
	public function board_field() {
		try{
			$mode = $this->input->post("mode", true);
			if(isset($mode)) {
				$nameField = $this->input->post("nameField", true);
				$useField = $this->input->post("useField", true);
				$reqField = $this->input->post("reqField", true);
				$optionField = $this->input->post("optionField", true);

				if(empty($nameField) || empty($optionField)){
					throw new Exception("게시판필드 정보가 없습니다.");
				}

				$set_data = "";
				$set_data .= "<?php\n";
				$set_data .= "defined('BASEPATH') OR exit('No direct script access allowed');\n\n";

				$set_data .= "\$config = array(\n";
				$set_data .= "\t'boardField' => array(\n";
				$set_data .= "\t\t'name' => array(\n";
				foreach ($nameField as $language_key => $language_value) {
					$set_data .= "\t\t\t'$language_key'	=> array(\n";
					foreach ($language_value as $key => $value) {
						$set_data .= "\t\t\t\t'$key'	=> '$value',\n";
					}
					$set_data .= "\t\t\t),\n";
				}
				$set_data .= "\t\t),\n";

				$set_data .= "\t\t'use' => array(\n";
				foreach ($useField as $language_key => $language_value) {
					$set_data .= "\t\t\t'$language_key'	=> array(\n";
					foreach ($language_value as $key => $value) {
						$set_data .= "\t\t\t\t'$key'	=> '$value',\n";
					}
					$set_data .= "\t\t\t),\n";
				}
				$set_data .= "\t\t),\n";

				$set_data .= "\t\t'require' => array(\n";
				foreach ($reqField as $language_key => $language_value) {
					$set_data .= "\t\t\t'$language_key'	=> array(\n";
					foreach ($language_value as $key => $value) {
						$set_data .= "\t\t\t\t'$key'	=> '$value',\n";
					}
					$set_data .= "\t\t\t),\n";
				}
				$set_data .= "\t\t),\n";

				$set_data .= "\t\t'option' => array(\n";
				foreach($optionField as $language_key => $language_value) {
					$set_data .= "\t\t\t'$language_key'	=> array(\n";
					foreach($language_value as $columnKey => $columnValue){
						$set_data .= "\t\t\t\t'$columnKey'	=> array(\n";
						foreach($columnValue as $key => $value){
							if($key != "itemValue" && $key != "itemName"){
								$set_data .= "\t\t\t\t\t'$key' => '$value',\n";
							}
						}
						$set_data .= "\t\t\t\t\t'item' => array(\n";
						if(!empty($columnValue["itemName"]) && !empty($columnValue["itemValue"]) && is_array($columnValue["itemName"]) && is_array($columnValue["itemValue"])){
							for($i = 0; $i < count($columnValue["itemName"]); $i++){
								$set_data .= "\t\t\t\t\t\t'".$columnValue['itemName'][$i]."' => '".$columnValue['itemValue'][$i]."',\n";
							}
						}
						$set_data .= "\t\t\t\t\t),\n";
						$set_data .= "\t\t\t\t),\n";
					}
					$set_data .= "\t\t\t),\n";
				}
				$set_data .= "\t\t),\n";
				$set_data .= "\t),\n";
				$set_data .= ");\n";

				$this->load->library("qfile");
				$this->qfile->open(APPPATH."/config/cfg_boardField.php");
				$this->qfile->write($set_data);
				$this->qfile->close();

				msg("저장되었습니다.", "/admin/auth/board_field");
			} else {
				$this->config->load("cfg_boardField");
				$this->config->load("cfg_uploadValidate");

				$get_data = array();
				$get_data["boardField"] = $this->config->item("boardField");

				$uploadValidate = $this->config->item("cfg_uploadValidate");
				$extension = array_keys($uploadValidate["extension"]);
				$get_data["extension"] = array_diff($extension, array("favicon", "snsImage", "sitemap"));
				$get_data["fieldSet"] = array(
					"ex1",
					"ex2",
					"ex3",
					"ex4",
					"ex5",
					"ex6",
					"ex7",
					"ex8",
					"ex9",
					"ex10",
					"ex11",
					"ex12",
					"ex13",
					"ex14",
					"ex15",
					"ex16",
					"ex17",
					"ex18",
					"ex19",
					"ex20",
					"ex21",
					"ex22",
					"ex23",
					"ex24",
					"ex25",
					"ex26",
					"ex27",
					"ex28",
					"ex29",
					"ex30",
				);

				$this->set_view("admin/auth/board_field", $get_data);
			}
		}catch(Exception $e){
			msg($e->getMessage(), -1);
		}
	}

    // 게시판관리
	public function board_manage() {
		try{
			$this->load->library("pagination");

			$per_page = $this->input->get("per_page", true);

			if(!$per_page) {
				$per_page = 1;
			}

			$limit = 20;
			$offset = ($per_page - 1) * $limit;

			$this->load->model("Admin_Board_model");

			#$arr_orderby = array("name asc");
			$arr_orderby = array("regdt desc");
			$get_data = $this->Admin_Board_model->get_board_manege(null, null, $limit, $offset, $arr_orderby);
			$get_data["offset"] = $offset;

			$config = array(
				"total_rows" => $get_data["total_rows_manage"],
				"per_page" => $limit,
			);

			$this->pagination->initialize($config);
			$get_data["pagination"] = $this->pagination->create_links();

			$this->set_view("admin/auth/board_manage", $get_data);
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function board_manage_reg() {
		try {
			$this->load->dbforge();
			$code = $this->input->get("code", true);
			$mode = $this->input->post("mode", true);
			//2020-05-25 Inbet Matthew 게시판 id가 file global comment manage 일 경우 해당 게시판을 삭제하면 da_board_manage, da_board_file 등 모든 게시판이 공통으로 사용하는 테이블이 삭제되기 때문에 만약 기능이 추가되어 공통으로 사용되는 테이블이 추가된다면 반드시 아래$not_register_code와 front ftp(27):/www/app/views/admin/auth/board_manage_reg.php 페이지도 validate 추가할 것
			$not_register_code = array('file', 'global', 'comment', 'manage');

			if(isset($mode)) {

				if($mode == "register"){
					$code = $this->input->post("code", true);
					$this->form_validation->set_rules("code", "게시판코드", "required|trim|xss_clean|is_unique[da_board_manage.code]");

					if(in_array($code, $not_register_code)) {
						throw new Exception("게시판 아이디로 사용이 불가능한 문자열(manage, global, file, comment)을 사용하셨습니다. 다른 문자열로 게시판 아이디를 생성해주세요.");
					}
				} else if($mode == "modify") {
					$this->form_validation->set_rules("code", "게시판코드", "required|trim|xss_clean");
				}
				$this->form_validation->set_rules("name", "게시판명", "required|trim|xss_clean");
                foreach($this->_site_language["set_language"] as $key => $val) {
				    $this->form_validation->set_rules("name_$key", "노출명 $val", "required|trim|xss_clean");
                }

				$this->form_validation->set_rules("board_type", "게시판 유형", "required|trim|xss_clean");
				$this->form_validation->set_rules("read_auth", "글읽기 권한", "required|trim|xss_clean|is_natural");
				$this->form_validation->set_rules("write_auth", "글쓰기 권한", "required|trim|xss_clean|is_natural");
				$this->form_validation->set_rules("tree", "답글하기 여부", "required|trim|xss_clean");
				$this->form_validation->set_rules("anwrite_auth", "답글하기 권한", "trim|xss_clean|is_natural");
				$this->form_validation->set_rules("comment", "댓글달기 여부", "required|trim|xss_clean");
				$this->form_validation->set_rules("comment_auth", "댓글달기 권한", "trim|xss_clean|is_natural");
				$this->form_validation->set_rules("files", "첨부파일 여부", "required|trim|xss_clean");
				$this->form_validation->set_rules("filesize", "첨부파일 용량제한", "trim|xss_clean|is_natural_no_zero");
				$this->form_validation->set_rules("file_count", "첨부파일 갯수제한", "trim|xss_clean|is_natural_no_zero");
				$this->form_validation->set_rules("roundpage", "페이지당 글 갯수", "required|trim|xss_clean|is_natural_no_zero");
				$this->form_validation->set_rules("sort_type", "게시판 정렬", "required|trim|xss_clean");
				$this->form_validation->set_rules("skin_type", "게시판 스킨", "required|trim|xss_clean");
				$this->form_validation->set_rules("secret", "게시판 비밀글설정", "required|trim|xss_clean|is_natural");
				$this->form_validation->set_rules("yn_mobile", "휴대폰 작성", "required|trim|xss_clean");
				$this->form_validation->set_rules("yn_email", "이메일 작성", "required|trim|xss_clean");
				$this->form_validation->set_rules("yn_video", "동영상주소 작성", "required|trim|xss_clean");
				$this->form_validation->set_rules("yn_send_mail", "답변 메일발송", "trim|xss_clean");
				$this->form_validation->set_rules("mail_form", "메일폼", "trim|xss_clean");
				$this->form_validation->set_rules("yn_display_list", "리스트 노출", "required|trim|xss_clean");
				$this->form_validation->set_rules("yn_preface", "말머리 여부", "required|trim|xss_clean");
				$this->form_validation->set_rules("preface_kor", "말머리", "trim|xss_clean");
				$this->form_validation->set_rules("preface_eng", "말머리", "trim|xss_clean");
				$this->form_validation->set_rules("preface_chn", "말머리", "trim|xss_clean");
				$this->form_validation->set_rules("preface_jpn", "말머리", "trim|xss_clean");
				$this->form_validation->set_rules("thumbnail", "썸네일 여부", "required|trim|xss_clean");
				$this->form_validation->set_rules("thumbnail_count", "썸네일 갯수제한", "trim|xss_clean|is_natural_no_zero");
				$this->form_validation->set_rules("thumbnail_width", "썸네일 가로사이즈", "trim|xss_clean|is_natural_no_zero");
				$this->form_validation->set_rules("thumbnail_height", "썸네일 세로사이즈", "trim|xss_clean|is_natural_no_zero");
				$this->form_validation->set_rules("extraFl", "추가필드 사용여부", "required|trim|xss_clean");
				$this->form_validation->set_rules("use_captcha", "캡챠 사용여부", "required|trim|xss_clean");

				if($this->form_validation->run()) {
					$set_data = $this->input->post(null, true);
                    $set_data['admin'] = implode(',', $this->input->post('admin', true));

                    // 말머리 재가공
                    if(ib_isset($set_data)) {
                        //$arrPreface = explode(",",$set_data['preface']);
                        //$filterPreface = array_filter(array_map('trim',$arrPreface));
						/*
                        if(count($filterPreface) > 5) {
							throw new Exception("말머리는 최대 5개 까지 등록 가능합니다.");
                        }
						*/
                        //$set_data['preface'] = implode(",",$filterPreface);
						foreach(['kor', 'eng', 'chn', 'jpn'] as $lang) {
							$set_data['preface_'.$lang] = !empty($set_data[$lang]) && is_array($set_data[$lang]) ? implode(',', $set_data[$lang]) : '';
						}

						// extraField 재가공
						$extraFieldInfo = array(
							'use' => $this->input->post('useField'),
							'require' => $this->input->post('reqField'),
							'name' => $this->input->post('nameField'),
							'option' => array(),
						);

						foreach($this->input->post('optionField') as $languageKey => $languageVal){

							foreach($languageVal as $columnKey => $columnVal){
								$extraFieldInfo['option'][$languageKey][$columnKey] = array();
								foreach($columnVal as $key => $val){
									if($key != 'itemValue' && $key != 'itemName'){
										$extraFieldInfo['option'][$languageKey][$columnKey][$key] = $val;
									}
								}

								$extraFieldInfo['option'][$languageKey][$columnKey]['item'] = array();
								if(!empty($columnVal['itemName']) && !empty($columnVal['itemValue']) && is_array($columnVal['itemName']) && is_array($columnVal['itemValue'])){

									for($i = 0; $i < COUNT($columnVal['itemName']); $i++){
										$extraFieldInfo['option'][$languageKey][$columnKey]['item'][$columnVal['itemName'][$i]] = $columnVal['itemValue'][$i];
									}
								}
							}
						}

						$set_data['extraFieldInfo'] = json_encode($extraFieldInfo, JSON_UNESCAPED_UNICODE);
					}

                    // 다국어 저장
                    if(ib_isset($this->_site_language["set_language"])) {
                        $result = $this->db->delete("da_board_global", array("code" => $set_data["code"]));
                        if($result) {
                            $set_language_data["code"] = $set_data["code"];
                            foreach($this->_site_language["set_language"] as $key => $val) {
                                $set_language_data["language"] = $key;
                                $set_language_data["name"] = $set_data["name_".$key];
                                $get_language_data = table_data_match("da_board_global", $set_language_data);
                                $result = $this->db->insert("da_board_global", $get_language_data);
                            }
                        }
                    }

					if($mode == "register"){
						$this->config->load("cfg_dbTable");
						$table = $this->config->item("dbTable");
						$this->dbforge->add_field($table["da_board"]);
						$this->dbforge->add_key("no", true);
						$result = $this->dbforge->create_table("da_board_". $set_data["code"], true);

						if($result) {
							$set_data["regdt"] = date('Y-m-d H:i:s');
							$set_data["mainview"] = 'n';
							$get_data = table_data_match("da_board_manage", $set_data);
							$result = $this->db->insert("da_board_manage", $get_data);
							if($result) {
								redirect("/admin/auth/board_manage_reg?code=". $set_data["code"]);
							} else {
								$this->dbforge->drop_table("da_board_". $set_data["code"]);
								throw new Exception("오류가 발생하였습니다.\n\n잠시후 다시시도해주세요.");
							}
						}
					} else if($mode == "modify") {
						$set_data["updatedt"] = date('Y-m-d H:i:s');
						$get_data = table_data_match("da_board_manage", $set_data);
						$result = $this->db->update("da_board_manage", $get_data, array("code" => $set_data["code"]));
						if($result) {
							msg("수정되었습니다.", "/admin/auth/board_manage_reg?code=". $set_data["code"]);
						}
					}
				} else {
					if(validation_errors()) {
						throw new Exception(validation_errors());
					}
				}
			} else {
				$get_data = array();
				if(isset($code)) {
					$this->load->model("Admin_Board_model");
					$this->Admin_Board_model->initialize($code);

					$get_data["board_manage"] = $this->Admin_Board_model->get_board();
					$get_data["mode"] = "modify";
				} else {
					$get_data["mode"] = "register";
				}
				$arr_where = array();
				//$arr_where[] = array("level", array_keys($this->_adm_auth), "NOTIN");
				#$get_data["member_grade_read_list"] = get_list_member_grade($arr_where);
				#$get_data["member_grade_write_list"] = get_list_member_grade();

				$grade_read_list = get_list_member_grade($arr_where);
				$grade_write_list = get_list_member_grade();

				$get_data["member_grade_read_list"] = $get_data["admin_grade_read_list"] = array();
				foreach($grade_read_list as $key => $val){
					if(in_array($val["level"], array_keys($this->_adm_auth))){
						$get_data["admin_grade_read_list"][] = $val;
					}else{
						$get_data["member_grade_read_list"][] = $val;
					}
				}

				$get_data["member_grade_write_list"] = $get_data["admin_grade_write_list"] = array();
				foreach($grade_write_list as $key => $val){
					if(in_array($val["level"], array_keys($this->_adm_auth))){
						$get_data["admin_grade_write_list"][] = $val;
					}else{
						$get_data["member_grade_write_list"][] = $val;
					}
				}

				$arr_skin = @scandir(APPPATH. "../data/skin/".$this->_skin."/layout/board");
				foreach($arr_skin as $key => $val){
					if(strpos($val, "html") === false){
						unset($arr_skin[$key]);
					}
				}
				$get_data["skin_files"] = $arr_skin;

				$this->config->load("cfg_mailForm");
				$this->config->load("cfg_boardField");

				$get_data["mail_form"] = $this->config->item("cfg_mailForm");
				$get_data["boardField"] = $this->config->item("boardField");

				$this->config->load('cfg_uploadValidate');
				$uploadValidate = $this->config->item("cfg_uploadValidate");
				$extension = array_keys($uploadValidate["extension"]);
				$get_data["extension"] = array_diff($extension, array("favicon", "snsImage", "sitemap"));

				$get_data['extraField'] = array(
					'ex1',
					'ex2',
					'ex3',
					'ex4',
					'ex5',
					'ex6',
					'ex7',
					'ex8',
					'ex9',
					'ex10',
					'ex11',
					'ex12',
					'ex13',
					'ex14',
					'ex15',
					'ex16',
					'ex17',
					'ex18',
					'ex19',
					'ex20',
					'ex21',
					'ex22',
					'ex23',
					'ex24',
					'ex25',
					'ex26',
					'ex27',
					'ex28',
					'ex29',
					'ex30',
				);

                // 게시판 관리자 @20250204
                $get_data['manage_board_admin'] = $this->dm->get('da_member', ['userid', 'level', 'name'], ['level > 79' => null, 'yn_status' => 'y'], [], [], ['level' => 'ASC']);

				$this->set_view("admin/auth/board_manage_reg", $get_data);
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function board_manage_delete() {
		try{
			if(!$this->input->get("code", true)) {
				throw new Exception("게시판의 정보를 찾을 수 없습니다.");
			}

			$code = $this->input->get("code", true);

			/*매니저 레코드만 삭제
			$this->load->dbforge();
			$result = $this->dbforge->drop_table("da_board_". $code, true);*/

			$result = $this->db->delete("da_board_manage", array("code" => $code));
			if($result) {
				msg("게시판이 삭제되었습니다.", "/admin/auth/board_manage");
			} else {
				throw new Exception("게시판의 삭제를 실패하였습니다.\n\n잠시후 다시 시도해주세요.");
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function board_mainview() {
		try{
			if(!defined("_IS_AJAX")) {
				throw new Exception("접근 할 수 없는 페이지입니다.");
			}

			$this->form_validation->set_rules("code", "게시판코드", "required|trim|xss_clean");
			$this->form_validation->set_rules("mainview", "메인뷰", "required|trim|xss_clean");
			$this->form_validation->set_rules("mainview_count", "게시물 수", "required|trim|xss_clean|is_natural_no_zero");

			$code = $this->input->post("code", true);
			$mainview = $this->input->post("mainview", true);
			$mainview_count = $this->input->post("mainview_count", true);
			if($this->form_validation->run()) {
				$set_data = $this->input->post(null, true);
				$get_data = table_data_match("da_board_manage", $set_data);
				$result = $this->db->update("da_board_manage", $get_data, array("code" => $set_data["code"]));

				if($result) {
					echo json_encode(array("code" => true));
				} else {
					echo json_encode(array("code" => false, "msg" => $this->db->_error_message()));
				}
			} else {
				if(validation_errors()) {
					throw new Exception(validation_errors());
				}
				throw new Exception("게시판 정보가 없습니다.");
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function board_adminview() {
		try{
			if(!defined("_IS_AJAX")) {
				throw new Exception("접근 할 수 없는 페이지입니다.");
			}

			$this->form_validation->set_rules("code", "게시판코드", "required|trim|xss_clean");
			$this->form_validation->set_rules("adminview", "메인뷰", "required|trim|xss_clean");

			if($this->form_validation->run()) {
				$set_data = $this->input->post(null, true);
				$get_data = table_data_match("da_board_manage", $set_data);
				$result = $this->db->update("da_board_manage", $get_data, array("code" => $set_data["code"]));

				if($result) {
					echo json_encode(array("code" => true));
				} else {
					echo json_encode(array("code" => false, "msg" => $this->db->_error_message()));
				}
			} else {
				if(validation_errors()) {
					throw new Exception(validation_errors());
				}
				throw new Exception("게시판 정보가 없습니다.");
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function board_delete() {
		try{
			if(!defined("_IS_AJAX")) {
				throw new Exception("접근 할 수 없는 페이지입니다.");
			}

			if(!$this->input->post("code", true)) {
				throw new Exception("게시판의 정보를 찾을 수 없습니다.");
			}

            // 초기 게시판 제외 코드
            // @TODO Exception 정상적으로 반영되지 못함
            if(in_array($this->input->post("code", true), $this->_basic_board)) {
                throw new Exception("기본 게시판은 삭제할 수 없습니다.");
            }

			$this->form_validation->set_rules("code", "게시판코드", "required|trim|xss_clean");

			if($this->form_validation->run()) {

			    $code = $this->input->post("code", true);
                $this->load->dbforge();
                $result = $this->dbforge->drop_table("da_board_". $code, true);

				if($result) {
                    $result = $this->db->delete("da_board_manage", array("code" => $code));
                    if($result) {
                        // 첨부파일 삭제
                        $this->db->delete("da_board_file", array("code" => $code));
                        //댓글 삭제
                        $this->db->delete("da_board_comment", array("code" => $code));
					    echo json_encode(array("code" => true));
                    } else {
					    echo json_encode(array("code" => false, "msg" => $this->db->_error_message()));
                    }
				} else {
					echo json_encode(array("code" => false, "msg" => $this->db->_error_message()));
				}
			} else {
				if(validation_errors()) {
					throw new Exception(validation_errors());
				}
				throw new Exception("게시판 정보가 없습니다.");
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	//메뉴관리
	public function menu_manage() {
		try{
			$mode = $this->input->post("mode", true);
			$this->load->library("form_validation");

			if(isset($mode)) {
				$front_menu = $this->input->post("front_menu", true);

				if(!isset($front_menu)) {
					throw new Exception("메뉴 정보가 없습니다.");
				}
				$set_front_menu = array();

				foreach($front_menu as $language_key => $language_value) {
					foreach($language_value as $value1) {
						foreach($value1 as $key2 => $value2) {
							if(is_array($value2)) {
								foreach($value2 as $value3) {
									foreach($value3 as $key4 => $value4) {
										if(is_array($value4)) {
											foreach($value4 as $value5) {
												foreach($value5 as $key6 => $value6) {
													//2020-02-18 Inbet Matthew 4뎁스의 대한 순위 변경과 validation이 없어서 4뎁스에 대한 로직 추가
													if(is_array($value6)) {
														foreach($value6 as $key7 => $value7){
															if(isset($set_front_menu[$language_key][$value1["sort"]]["menu"][$value3["sort"]][$key4][$value5["sort"]][$key6][$value7['sort']])) {
																throw new Exception('같은 등급의 메뉴를 동일한 번호로 순서를 입력할 수 없습니다.');
															}
															$set_front_menu[$language_key][$value1["sort"]]["menu"][$value3["sort"]][$key4][$value5["sort"]][$key6][$value7['sort']] = $value7;
														}
													}else{
														if(isset($set_front_menu[$language_key][$value1["sort"]]["menu"][$value3["sort"]][$key4][$value5["sort"]][$key6])) {
															throw new Exception('같은 등급의 메뉴를 동일한 번호로 순서를 입력할 수 없습니다.');
														}
														$set_front_menu[$language_key][$value1["sort"]]["menu"][$value3["sort"]][$key4][$value5["sort"]][$key6] = $value6;
													}
													//Matthew End
													/*if(isset($set_front_menu[$language_key][$value1["sort"]]["menu"][$value3["sort"]][$key4][$value5["sort"]][$key6])) {
														throw new Exception('같은 등급의 메뉴를 동일한 번호로 순서를 입력할 수 없습니다.');
													}
													$set_front_menu[$language_key][$value1["sort"]]["menu"][$value3["sort"]][$key4][$value5["sort"]][$key6] = $value6;*/
												}
											}
										} else {
											if(isset($set_front_menu[$language_key][$value1["sort"]]["menu"][$value3["sort"]][$key4])) {
												throw new Exception('같은 등급의 메뉴를 동일한 번호로 순서를 입력할 수 없습니다.');
											}
											$set_front_menu[$language_key][$value1["sort"]]["menu"][$value3["sort"]][$key4] = $value4;
										}
									}
								}
							} else {
								if(isset($set_front_menu[$language_key][$value1["sort"]][$key2])) {
									throw new Exception('같은 등급의 메뉴를 동일한 번호로 순서를 입력할 수 없습니다.');
								}
								$set_front_menu[$language_key][$value1["sort"]][$key2] = $value2;
							}
						}
					}
				}
				// 1단계
				$set_data = "";
				$set_data .= "<?php\n";
				$set_data .= "defined('BASEPATH') OR exit('No direct script access allowed');\n\n";
				$result = ksort($set_front_menu);
				$set_data .= "\$config = array(\n";
				$set_data .= "\t'cfg_menu' => array(\n";

				//2020-02-18 Inbet Matthew 1차 뎁스 정렬 안되는 오류 해결 로직
				foreach($set_front_menu as $language_key => $language_value){
					ksort($set_front_menu[$language_key]);
				}
				//Matthew End

				foreach ($set_front_menu as $language_key => $language_value) { //처음
					$set_data .= "\t\t'$language_key' => array(\n"; // NAV
					foreach ($language_value as $key1 => $value1) { //처음
						$set_data .= "\t\t\t'$key1' => array(\n"; // NAV
						if($value1["sort"]) {
							unset($value1["sort"]);
						}
						if($value1["menu"]) {
							ksort($value1["menu"]);
						}
						foreach ($value1 as $key2 => $value2) {
							//2단계
							if(is_array($value2)) {
								$set_data .= "\t\t\t\t'$key2' => array(\n"; // NAV
									foreach ($value2 as $key3 => $value3) {
										if($value3["sort"]) {
											unset($value3["sort"]);
										}
										if($value3["menu"]) {
											ksort($value3["menu"]);
										}
										$set_data .= "\t\t\t\t\t'$key3' => array(\n";
										foreach ($value3 as $key4 => $value4) {
											//3단계
											if(is_array($value4)) {
												$set_data .= "\t\t\t\t\t\t'$key4' => array(\n"; // NAV
													foreach ($value4 as $key5 => $value5) {
														if($value5["sort"]) {
															unset($value5["sort"]);
														}
														if($value5["menu"]) {
															ksort($value5["menu"]);
														}
														$set_data .= "\t\t\t\t\t\t\t'$key5' => array(\n";
														foreach ($value5 as $key6 => $value6) {
															//4단계
															if(is_array($value6)) {
																$set_data .= "\t\t\t\t\t\t\t\t'$key6' => array(\n"; // NAV
																	foreach ($value6 as $key7 => $value7) {
																		if($value7["sort"]) {
																			unset($value7["sort"]);
																		}
																		if($value7["menu"]) {
																			ksort($value7["menu"]);
																		}
																		$set_data .= "\t\t\t\t\t\t\t\t\t'$key7' => array(\n";
																		foreach ($value7 as $key8 => $value8) {

																			$set_data .= "\t\t\t\t\t\t\t\t\t\t'$key8' => '$value8',\n";
																		}
																		$set_data .= "\n\t\t\t\t\t\t\t\t\t),\n";
																	}
																$set_data .= "\t\t\t\t\t\t\t\t),";
															} else {
																$set_data .= "\t\t\t\t\t\t\t\t'$key6' => '$value6',\n";
															}
														//3단계
														}
														$set_data .= "\n\t\t\t\t\t\t\t),\n";
													}
												$set_data .= "\t\t\t\t\t\t),";
											} else {
												$set_data .= "\t\t\t\t\t\t'$key4' => '$value4',\n";
											}
										//2단계
										}
										$set_data .= "\n\t\t\t\t\t),\n";
									}
								$set_data .= "\t\t\t\t),";
							} else {
								$set_data .= "\t\t\t\t'$key2' => '$value2',\n";
							}
						//1단계
						}
						$set_data .= "\n\t\t\t),\n";
					}
					$set_data .= "\n\t\t),\n";
				}
				$set_data .= "\t),\n";
				$set_data .= ");";

				$this->load->library("qfile");
				$this->qfile->open(APPPATH."/config/cfg_menu.php");
				$this->qfile->write($set_data);
				$this->qfile->close();

				msg("저장되었습니다", "/admin/auth/menu_manage");
			} else {
				$this->config->load("cfg_menu");
				$get_data = array();
				$get_data["cfg_menu"] = $this->config->item("cfg_menu");
				$get_data["mode"] = "register";
				$this->set_view("admin/auth/menu_manage", $get_data);
			}
		} catch(Exception $e) {
			msg($e->getMessage(), "/admin/auth/menu_manage");
		}
	}

	public function menu_manage2() {
		try {
			$lang = $this->input->get("lang");
			//$get_data['menus'] = $this->Auth_model->manage_menu($lang);
			$menus = [];
			foreach($this->Auth_model->manage_menu($lang) as $key => $value) {
				if(strlen($value['code']) == 2) {
					$menus[substr($value['code'], 0, 2)] = [
						'no' => $value['no'],
						'code' => $value['code'],
						'name' => $value['name'],
						'url' => $value['url'],
						'use' => $value['use']
					];
				}

				if(strlen($value['code']) > 2) {
					$menus[substr($value['code'], 0, 2)]['sub'][] = [
						'no' => $value['no'],
						'code' => $value['code'],
						'name' => $value['name'],
						'url' => $value['url'],
						'use' => $value['use']
					];
				}
			}
			$get_data['menus'] = $menus;
			$this->set_view("admin/auth/menu_manage2", $get_data);
		} catch(Exception $e) {
			msg($e->getMessage(), "/admin/auth/menu_manage2");
		}
	}

    // 개발자모드
	public function debug_mode() {
		try{
			$mode = $this->input->post("mode", true);

			if(isset($mode)) {
				$this->form_validation->set_rules("debug_mode", "디버그모드", "trim|xss_clean");

				if($this->form_validation->run()) {
					$debug_mode = $this->input->post("debug_mode", true);
					$set_data = "";
					$set_data .="<?php\r\n";
					$set_data .="defined('BASEPATH') OR exit('No direct script access allowed');\r\n\r\n";

					$set_data .="\$config = array(\r\n";
					$set_data .="\t'cfg_debug' => array(\r\n";
					$set_data .="\t\t'debug_mode' => ". intval($debug_mode) ."\r\n";
					$set_data .="\t),\r\n";
					$set_data .=");\r\n";

					$this->load->library("qfile");
					$this->qfile->open(APPPATH."/config/cfg_debug.php");
					$this->qfile->write($set_data);
					$this->qfile->close();
					msg("변경되었습니다.", "/admin/auth/debug_mode");
				} else {
					if(validation_errors()) {
						throw new Exception(validation_errors());
					}
				}
				throw new Exception("디버그모드 정보가 없습니다.");
			} else {
				$this->config->load("cfg_debug");
				$get_data = $this->config->item("cfg_debug");
				$get_data["mode"] = "register";
				$this->set_view("admin/auth/debug_mode", $get_data);
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

    // 홈페이지 정보설정
	public function conf_reg() {
		try{
			$mode = $this->input->post("mode", true);
			$this->load->library("form_validation");
			$this->load->library('qfile');
			$post = $this->input->post(null, true);

			// instagram
			/*
			if($post['token'])  {
				$this->load->library('MY_Instagram', ['update' => 'f', 'token' => $post['token']]);
				$feed = $this->my_instagram->get_my_feed();
				$json_instagram = APPPATH.'/config/json_instagram.json';
				$this->qfile->open($json_instagram);
				$json = $this->qfile->read($json_instagram);
				$json = json_decode($json);

				$instagram = [
					'yn_use' => $post['yn_use'],
					'url' => $post['instagram_url'],
					'feed_limit' => $post['feed_limit'],
					'data' => $feed,
					'last_data_update' => date('Y-m-d H:i:s'),
					'token' => $post['token'],
					'last_token_update' => date('Y-m-d H:i:s'),
				];
				$this->qfile->write(json_encode($instagram));
				$this->qfile->close();
			}
			*/

			if(isset($mode)) {
				$conf = $this->input->post("conf", true);
				$standard_mall = $this->input->post("standard_mall",true);
				$cfg_site = $this->_cfg_site;

				if(!isset($conf)) {
					throw new Exception("사이트 정보가 없습니다.");
				}else if(!isset($standard_mall)){
					throw new Exception("기준몰이 설정되있지 않습니다.");
				}

				$set_data = "";
				$set_data .= "<?php\n";
				$set_data .= "defined('BASEPATH') OR exit('No direct script access allowed');\n\n";

				$set_data .= "\$config = array(\n";
				$set_data .= "\t'cfg_site' => array(\n";
				$set_data .= "\t\t\t'standard_mall'	=>	'$standard_mall',\n";
				//언어별로 저장하도록 변경
				foreach ($conf as $language_key => $language_value) {
					$set_data .= "\t\t\t'$language_key'	=> array(\n";
					foreach ($language_value as $key => $value) {
						$set_data .= "\t\t\t\t'$key'	=> '$value',\n";
					}
					$set_data .= "\t\t\t),\n";
				}

				//seo
				$set_data .= "\t\t'seo' => array(\n";
				foreach($cfg_site["seo"] as $key => $val){
					$set_data .= "\t\t\t'$key'	=> '$val',\n";
				}
				$set_data .= "\t\t),\n";

				$set_data .= "\t),\n";
				$set_data .= ");\n";

				$this->qfile->open(APPPATH."/config/cfg_site.php");
				$this->qfile->write($set_data);
				$this->qfile->close();

				/*
				$this->dm->update('da_manage', ['no' => 1], [
					'smtp_send_name' => $post['smtp_send_name'],
					'smtp_secure' => $post['smtp_secure'],
					'smtp_port' => $post['smtp_port'],
					'smtp_host' => $post['smtp_host'],
					'smtp_userid' => $post['smtp_userid'],
					'smtp_password' => $post['smtp_password'],
				]);
				*/

				msg("저장되었습니다", "conf_reg");
			} else {
				$get_data = array();
				$get_data["cfg_site"] = $this->_cfg_site;
				$get_data["mode"] = "register";

				// smtp
				$get_data['smtp'] = $this->dm->get('da_manage')[0];
				$this->set_view("admin/auth/conf_reg", $get_data);
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}
	function debug($data)
{
		print "<xmp style=\"display:block;font:9pt 'Bitstream Vera Sans Mono, Courier New';background:#202020;color:#D2FFD2;padding:10px;margin:5px;\">";
		print_r($data);
		print "</xmp>";
}
    // 약관 및 개인정보정책 설정
	public function terms_list() {
		try{
			$this->config->load("cfg_terms");
			$cfg_terms = $this->config->item("cfg_terms");

		    $this->load->model("Terms_model");

			$get_data = array();

			$get_data["terms"] = $this->Terms_model->getTermsList();

			$this->set_view("admin/auth/terms_list", $get_data);
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function terms_reg() {
		try{
			$this->load->library("form_validation");
			$this->config->load("cfg_terms");
			$cfg_terms = $this->config->item("cfg_terms");

		    $this->load->model("Terms_model");

			$code = $this->input->get_post("code", true);
			$mode = $this->input->post("mode", true);
			$language = $this->input->post("language",true);
			if(!isset($cfg_terms[$code])) {
				throw new Exception("잘못된 접근입니다.");
			}

			if(isset($mode)) {
				$this->form_validation->set_rules("code", "코드", "required|trim|xss_clean");
				$this->form_validation->set_rules("title", "레벨", "required|trim|xss_clean");
				$this->form_validation->set_rules("text", "레벨", "required|trim|xss_clean");

				if($this->form_validation->run()) {

					//2018-10-04 James ini 저장 => DB 저장으로 변경
					$result = $this->Terms_model->setTermsData($this->input->post(null, true));
					msg("저장되었습니다.", "terms_reg?code=". $code."&language=".$language);
				} else {
					throw new Exception(validation_error());
				}
				throw new Exception("약관정보가 없습니다.");
			} else {
				$get_data = array();
				$get_data["terms"] = $this->Terms_model->getTermsData($this->input->get(null, true));

				$get_data["mode"] = "register";
				$this->set_view("admin/auth/terms_reg", $get_data);
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

    // 검색엔진 최적화(SEO) 설정
	public function search_engine_opt() {
        $this->load->library("form_validation");
		try{
            $post = $this->input->post(null, true);
            if($post['mode']) {
                $upload = '/upload/conf/';
                $favicon = $post['favicon_fname'] ? $upload.$post['favicon_fname'] : '';
                $ogimage = $post['og_fname'] ? $upload.$post['og_fname'] : '';
                $values = [
                    'language' => $post['language'],
                    'favicon' => $favicon,
                    'author' => $post['author'],
                    'description' => $post['description'],
                    'keywords' => $post['keywords'],
                    'og_image' => $ogimage,
                    'og_title' => $post['og_title'],
                    'og_description' => $post['og_description']
                ];
                if($post['mode'] == 'update') $this->dm->update('da_seo', ['language' => $post['language']], $values);
                if($post['mode'] == 'insert') $this->dm->insert('da_seo', $values);
                msg('저장되었습니다.', 'search_engine_opt?lang='.$post['language']);
            } else {
                $language = $this->input->get('lang', true) ? $this->input->get('lang', true) : 'kor';
                $data = $this->dm->get('da_seo', [], ['language' => $language])[0];
				$this->set_view("admin/auth/search_engine_opt", $data);
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function display_main_list() {
		try {
			$this->load->library("pagination");
			$this->load->model("Admin_Goods_model");

			$arr_like = array();
			$language = $this->input->get("language", true);
			$search_type = $this->input->get("search_type", true);
			$search = $this->input->get("search", true);

			$limit = 10;

			if(isset($search_type)) {
				if($search) {
					if($search_type) {
						$arr_like[] = array($search_type, $search);
					} else {
						$arr_like[] = array("theme_name", $search, null, "or");
						$arr_like[] = array("theme_description", $search, null, "or");
					}
				}
			}

			$per_page = $this->input->get("per_page", true);

			if(!$per_page) {
				$per_page = 1;
			}

			$offset = ($per_page - 1) * $limit;

			$get_data = $this->Admin_Goods_model->get_list_display_theme($arr_where, $arr_like, $limit, $offset);
			$config = array(
				"total_rows" => $get_data["total_rows"],
				"per_page" => $limit,
				"first_url" => "?code=". $this->_board["code"]."&language=". $language ."&search_type=". $search_type ."&search=". $search  ."&files=". $files,
				"suffix" => "&code=". $this->_board["code"]."&language=". $language ."&search_type=". $search_type ."&search=". $search ."&files=". $files,
			);
			$this->pagination->initialize($config);
			$get_data["pagination"] = $this->pagination->create_links();
			$get_data["board_info"] = $this->_board;
			$get_data["offset"] = $offset;
			$get_data["offset"] = $search;

			$this->set_view("admin/auth/display_main_list", $get_data);
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function display_main_reg() {
		try {
			$no = $this->input->get("no", true);
			$mode = $this->input->post("mode", true);
			$this->load->model("Admin_Goods_model");

			if(isset($mode)) {
				if($mode == "modify") {
					$this->form_validation->set_rules("no", "진열번호", "required|trim|xss_clean");
				}
				$this->form_validation->set_rules("theme_name", "진열명", "required|trim|xss_clean");
				$this->form_validation->set_rules("theme_description", "진열설명", "required|trim|xss_clean");
				$this->form_validation->set_rules("skin_type", "게시판 스킨", "required|trim|xss_clean");

				if($this->form_validation->run()) {
					$set_data = $this->input->post(null, true);

					if($mode == "register"){
						$set_data["regdt"] = date('Y-m-d H:i:s');
						$set_data["mainview"] = 'n';
						$get_data = table_data_match("da_display_theme", $set_data);
						$result = $this->db->insert("da_display_theme", $get_data);
						if($result) {
							//$no = $this->db->insert_id();
							redirect("/admin/auth/display_main_list");
						} else {
							$this->dbforge->drop_table("da_board_". $set_data["code"]);
							throw new Exception("오류가 발생하였습니다.\n\n잠시후 다시시도해주세요.");
						}
					} else if($mode == "modify") {
						$set_data["moddt"] = date('Y-m-d H:i:s');
						$get_data = table_data_match("da_display_theme", $set_data);
						$result = $this->db->update("da_display_theme", $get_data, array("no" => $set_data["no"]));

						if($result) {
							msg("수정되었습니다.", "/admin/auth/display_main_list");
						}
					}
				} else {
					if(validation_errors()) {
						throw new Exception(validation_errors());
					}
				}

				throw new Exception("진열 정보가 없습니다.");
			} else {
				$get_data = array();
				if(isset($no)) {
					$arr_where = $arr_goods_where =array();
					$arr_where[] = array("no", $no);
					$arr_goods_where[] = array("display_theme_no", $no);

					$get_data = $this->Admin_Goods_model->get_view_display_theme($arr_where);
					$get_data = array_merge($get_data, $this->Admin_Goods_model->get_display_theme_goods_data($arr_goods_where, "seq ASC"));

					$get_data["mode"] = "modify";
				} else {
					$get_data["mode"] = "register";
				}

				$arr_skin = @scandir(APPPATH. "../data/skin/".$this->_skin."/layout/display");
				foreach($arr_skin as $key => $val){
					if(strpos($val, "html") === false){
						unset($arr_skin[$key]);
					}
				}

				$get_data["skin_files"] = $arr_skin;

				//
				$this->load->library("pagination");
				$this->load->model("Admin_Goods_model");
				$per_page = $this->input->get("per_page", true);
				if(!$per_page) $per_page = 1;
				$limit = 10;
				$offset = ($per_page - 1) * $limit;
				$arrWhere = $arrLike = [];
				if($this->input->get("category", true)) $category = $this->input->get("category", true);
				$goods = $this->Admin_Goods_model->get_list_goods($category, $arrWhere, $arrLike, $limit, $offset, "regDt DESC");
				$goods["offset"] = $offset;
				$goods["search"] = $search;

				$config = array(
					"total_rows" => $goods["total_rows"],
					"per_page" => $limit,
					"first_url" => "?no=".$this->input->get("no", true)."&search_type=". $search_type ."&search=". $search."&sort_type=".$sort_type."&category=".$category,
					"suffix" => "&no=".$this->input->get("no", true)."&search_type=". $search_type ."&search=". $search."&sort_type=".$sort_type."&category=".$category,
				);

				$this->pagination->initialize($config);
				$goods["pagination"] = $this->pagination->create_links();
				$get_data['goods'] = $goods;
				$this->load->model("Etc_model");
				$get_data['categories'] = $this->Etc_model->get_1st_category();
				$this->set_view("admin/auth/display_main_reg", $get_data);
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function delete_display_theme() {
		try{
			if(!$this->input->post("no", true)) {
				throw new Exception("상품진열의 정보를 찾을 수 없습니다.");
			}

			$no = $this->input->post("no", true);
			$arr_where = array();
			$arr_where[] = array("no", $no, "IN");

			$this->load->model("Admin_Goods_model");
			$result = $this->Admin_Goods_model->delete_display_theme($arr_where);

			if($result) {
				$this->load->model("Admin_Goods_model");
				$this->Admin_Goods_model->delete_display_theme_goods($arr_where);
				msg("상품진열이 삭제되었습니다.", "display_main_list");
			} else {
				throw new Exception("상품진열의 삭제를 실패하였습니다.\n\n잠시후 다시 시도해주세요.");
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}

	}

	public function country_manage() {
		try{
			$mode = $this->input->post("mode", true);
			$this->load->library("form_validation");

			if(isset($mode)) {
				$country_info = $this->input->post('country_info', true);
				$default_country_Info = $this->input->post('default_country_Info', true);
				foreach($this->_site_language["support_language"] as $language_key => $language_value){
					if($language_key != 'kor') {
						foreach($country_info['name'][$language_key] as $skey => $sval){
							if($sval == '') {
								throw new Exception("국가명(".$language_key.")를 입력해주세요.");
							}
						}
						foreach($default_country_Info['name'][$language_key] as $skey => $sval){
							if($sval == '') {
								throw new Exception("국가명(".$language_key.")를 입력해주세요.");
							}
						}
					}
				}
				foreach($country_info['mark'] as $skey => $sval){
					if($sval == '') {
						throw new Exception("표기명을 입력해주세요.");
					}
				}
				foreach($default_country_Info['mark'] as $skey => $sval){
					if($sval == '') {
						throw new Exception("표기명을 입력해주세요.");
					}
				}
				foreach($country_info['code'] as $skey => $sval){
					if($sval == '') {
						throw new Exception("국가코드를 입력해주세요.");
					}
				}
				foreach($default_country_Info['code'] as $skey => $sval){
					if($sval == '') {
						throw new Exception("국가코드를 입력해주세요.");
					}
				}
				$set_data = "";
				$set_data .= "<?php\n";
				$set_data .= "defined('BASEPATH') OR exit('No direct script access allowed');\n\n";

				$set_data .= "\$config = array(\n";
				$set_data .= "\t'country_info' => array(\n";
				foreach($country_info['mark'] as $key => $val){
					$set_data .= "\t\t'".$key."' => array(\n";
					$set_data .= "\t\t\t'name' => array(\n";
					foreach($this->_site_language["support_language"] as $language_key => $language_value){
						if($language_key == 'kor') continue;
						$set_data .= "\t\t\t\t'".$language_key."' => '".$country_info['name'][$language_key][$key]."',\n";
					}
					$set_data .= "\t\t\t),\n";
					$set_data .= "\t\t\t'mark' => '".$val."',\n";
					$set_data .= "\t\t\t'code' => '".$country_info['code'][$key]."',\n";
					$set_data .= "\t\t),\n";
				}

				$set_data .= "\t),\n";
				$set_data .= "\t'default_country_Info' => array(\n";
				foreach($default_country_Info['mark'] as $key => $val){
					$set_data .= "\t\t'".$key."' => array(\n";
					$set_data .= "\t\t\t'name' => array(\n";
					foreach($this->_site_language["support_language"] as $language_key => $language_value){
						if($language_key == 'kor') continue;
						$set_data .= "\t\t\t\t'".$language_key."' => '".$default_country_Info['name'][$language_key][$key]."',\n";
					}
					$set_data .= "\t\t\t),\n";
					$set_data .= "\t\t\t'mark' => '".$val."',\n";
					$set_data .= "\t\t\t'code' => '".$default_country_Info['code'][$key]."',\n";
					$set_data .= "\t\t),\n";
				}

				$set_data .= "\t),\n";
				$set_data .= ");";

				$this->load->library("qfile");
				$this->qfile->open(APPPATH."/config/cfg_country_info.php");
				$this->qfile->write($set_data);
				$this->qfile->close();

				msg("저장되었습니다", "country_manage");
			} else {
				$this->config->load("cfg_country_info");
				$get_data = array();
				$get_data["country_info"] = $this->config->item("country_info");
				$get_data["default_country_Info"] = $this->config->item("default_country_Info");
 				$get_data["mode"] = "register";

				if(empty($get_data["default_country_Info"]) || !is_array($get_data["default_country_Info"])) {

					$default_country_name['eng'] = array('Albania','Algeria','Argentina','Armenia','Australia','Austria','Azerbaijan','Bahrain','Bangladesh','Belarus','Belgium','Bhutan','Bosnia and Herzegovina','Botswana','Brazil','Brunei Darussalam','Bulgaria','Burma (Myanmar)','Cambodia','Canada','Cape Verde','Chile','China','Costa Rica','Croatia (Hrvatska)','Cuba','Cyprus','Czech Republic','Denmark','Djibouti','Dominican Republic','Ecuador','Egypt','Estonia','Ethiopia','Fiji','Finland','France','Georgia','Germany','Greece','Hong Kong','Hungary','India','Indonesia','Iran','Ireland','Israel','Japan','Jordan','Kazakhstan','Kenya','Laos','Latvia','Luxembourg','Macau','Macedonia','Malaysia','Maldives','Mauritius','Mexico','Mongolia','Morocco','Mozambique','Nepal','Netherlands','Netherlands Antilles','New Zealand (Aotearoa)','Nigeria','Norway','Oman','Pakistan','Panama','Peru','Philippines','Poland','Portugal','Qatar','Romania','Russia','Rwanda','Saudi Arabia','Singapore','Slovak Republic','Slovenia','Spain','Sri Lanka','Sweden','Switzerland','Taiwan','Tanzania','Thailand','Tunisia','Turkey','Ukraine','United Arab Emirates','United Kingdom','United States','Uzbekistan','Viet Nam','Zambia');

					$default_country_name['chn'] = array('阿尔巴尼亚','阿尔及利亚','阿根廷','亚美尼亚','澳大利亚','奥地利','阿塞拜疆','巴林','孟加拉国','白俄罗斯','比利时','丁烷','波斯尼亚和黑塞哥维那','博茨瓦纳','巴西','文莱','保加利亚','缅甸(缅甸)','柬埔寨','加拿大','佛得角','智利','中国','哥斯达黎加','克罗地亚','古巴','塞浦路斯','捷克共和国','丹麦','吉布提','多米尼加共和国','厄瓜多尔','埃及','爱沙尼亚','埃塞俄比亚','斐济','芬兰','法国','格鲁吉亚','德国','希腊','香港','匈牙利','印度','印尼','伊朗','爱尔兰','以色列','日本','乔丹','哈萨克斯坦','肯尼亚','老挝','拉脱维亚','卢森堡','澳门','马其顿','马来西亚','马尔代夫','毛里求斯','墨西哥','蒙古','摩洛哥','莫桑比克','尼泊尔','荷兰','荷属安的列斯肯尼思不应该','新西兰(新西兰)','尼日利亚','挪威','阿曼','巴基斯坦','巴拿马','秘鲁','菲律宾','波兰','葡萄牙','卡塔尔','罗马尼亚','俄罗斯','卢旺达','沙特阿拉伯','新加坡','斯洛伐克共和国','斯洛文尼亚','西班牙','斯里兰卡','瑞典','瑞士','台湾','坦桑尼亚','泰国','突尼斯','土耳其','乌克兰','阿拉伯联合酋长国','英国','美国','乌兹别克斯坦','越南','赞比亚');

					$default_country_name['jpn'] = array('アルバニア','アルジェリア','アルゼンチン','アルメニア','オーストラリア','オーストリア','アゼルバイジャン','バーレーン','バングラデシュ','ベラルーシ','ベルギー','ブータン','ボスニア・ヘルツェゴビナ','ボツワナ','ブラジル','ブルネイ','ブルガリア','ミャンマー','カンボジア','カナダ','カーボベルデ','チリ','中国','コスタリカ','クロアチア','キューバ','キプロス','チェコ共和国','デンマーク','ジブチ','ドミニカ共和国','エクアドル','エジプト','エストニア','エチオピア','フィジー','フィンランド','フランス','ジョージア','ドイツ','ギリシャ','香港','ハンガリー','インド','インドネシア','とは','アイルランド','イスラエル','日本','ヨルダン','カザフスタン','ケニア','ラオス','ラトビア','ルクセンブルク','マカオ','マケドニア共和国','マレーシア','モルディブ','モーリシャス','メキシコ','モンゴル','モロッコ','モザンビーク','ネパール','オランダ','オランダ領アンアンティル','ニュージーランド','ナイジェリア','ノルウェー','オマーン','パキスタン','パナマ','ペルー','フィリピン','ポーランド','ポルトガル','カタル','ルーマニア','ロシア','ルワンダ','サウジアラビア','シンガポール','スロバキア','スロベニア','スペイン','スリランカ','スウェーデン','スイス','台湾','タンザニア','タイ','チュニジア','トルコ','ウクライナ','アラブ首長国連邦','イギリス','美國','ウズベキスタン','ベトナム','ザンビア');

					$default_country_mark = array('(Albania)','(Algeria)','(Argentina)','(Armenia)','(Australia)','(Austria)','(Azerbaijan)','(Bahrain)','(Bangladesh)','(Belarus)','(Belgium)','(Bhutan)','(Bosnia and Herzegovina)','(Botswana)','(Brazil)','(Brunei Darussalam)','(Bulgaria)','(Burma (Myanmar))','(Cambodia)','(Canada)','(Cape Verde)','(Chile)','(China)','(Costa Rica)','(Croatia (Hrvatska))','(Cuba)','(Cyprus)','(Czech Republic)','(Denmark)','(Djibouti)','(Dominican Republic)','(Ecuador)','(Egypt)','(Estonia)','(Ethiopia)','(Fiji)','(Finland)','(France)','(Georgia)','(Germany)','(Greece)','(Hong Kong)','(Hungary)','(India)','(Indonesia)','(Iran)','(Ireland)','(Israel)','(Japan)','(Jordan)','(Kazakhstan)','(Kenya)','(Laos)','(Latvia)','(Luxembourg)','(Macau)','(Macedonia)','(Malaysia)','(Maldives)','(Mauritius)','(Mexico)','(Mongolia)','(Morocco)','(Mozambique)','(Nepal)','(Netherlands)','(Netherlands Antilles)','(New Zealand (Aotearoa))','(Nigeria)','(Norway)','(Oman)','(Pakistan)','(Panama)','(Peru)','(Philippines)','(Poland)','(Portugal)','(Qatar)','(Romania)','(Russia)','(Rwanda)','(Saudi Arabia)','(Singapore)','(Slovak Republic)','(Slovenia)','(Spain)','(Sri Lanka)','(Sweden)','(Switzerland)','(Taiwan)','(Tanzania)','(Thailand)','(Tunisia)','(Turkey)','(Ukraine)','(United Arab Emirates)','(United Kingdom)','(United States)','(Uzbekistan)','(Viet Nam)','(Zambia)');

					$default_country_code = array('(+355)','(+213)','(+54)','(+374)','(+61)','(+43)','(+994)','(+973)','(+880)','(+375)','(+32)','(+975)','(+387)','(+267)','(+55)','(+673)','(+359)','(+95)','(+855)','(+1)','(+238)','(+56)','(+86)','(+506)','(+385)','(+53)','(+357)','(+420)','(+45)','(+253)','(+1)','(+593)','(+20)','(+372)','(+251)','(+679)','(+358)','(+33)','(+995)','(+49)','(+30)','(+852)','(+36)','(+91)','(+62)','(+98)','(+353)','(+972)','(+81)','(+962)','(+7)','(+254)','(+856)','(+371)','(+352)','(+853)','(+389)','(+60)','(+960)','(+230)','(+52)','(+976)','(+212)','(+258)','(+977)','(+31)','(+599)','(+64)','(+234)','(+47)','(+968)','(+92)','(+507)','(+51)','(+63)','(+48)','(+351)','(+974)','(+40)','(+7)','(+250)','(+966)','(+65)','(+421)','(+386)','(+34)','(+94)','(+46)','(+41)','(+886)','(+255)','(+66)','(+216)','(+90)','(+380)','(+971)','(+44)','(+1)','(+998)','(+84)','(+260)');

					foreach($default_country_mark as $key => $val){
						$tempArr['mark'] = $val;
						$tempArr['code'] = $default_country_code[$key];
						foreach($this->_site_language["support_language"] as $language_key => $language_value){
							if($language_key != 'kor') {
								$tempArr['name'][$language_key] = $default_country_name[$language_key][$key];
							}
						}
						$get_data["default_country_Info"][] = $tempArr;
					}
				}
				$this->set_view("admin/auth/country_manage", $get_data);
			}
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}

	}

	public function add_display() {
		$theme_no = $this->input->post("theme_no", true);
		$goods_no = $this->input->post("goods_no", true);
		if($this->Auth_model->add_display($theme_no, $goods_no)) {
			msg("추가되었습니다.", "display_main_reg?no=".$theme_no);
		}
	}

	public function sort_display() {
		$theme_no = $this->input->post("theme_no", true);
		$goods = explode("|", $this->input->post("orderby", true));
		$datas = [];
		for($i = 0; $i < count($goods); $i++) {
			$tmp = explode(":", $goods[$i]);
			$datas[] = [
				"no" => $tmp[1],
				"seq" => ($i + 1)
			];
		}
		$this->Auth_model->sort_display($datas);
	}

	public function remove_display_from_main() {
		$theme_no = $this->input->post("no", true);
		$goodsNo = $this->input->post("goodsNo", true);
		if($this->Auth_model->remove_display_from_main($theme_no, $goodsNo)) {
			msg("삭제되었습니다.", "display_main_reg?no=".$theme_no);
		} else {
			msg("오류가 발생하였습니다.", -1);
		}
	}

	public function has_child() {
		$code = $this->input->get("code", true);
		echo $this->Auth_model->has_child($code);
	}

	public function remove_menu() {
		$data = $this->input->get(null, true);
		if($this->Auth_model->remove_menus($data)) {
			msg("삭제되었습니다.", "menu_manage2?lang=".$data['lang']);
		}
	}

	public function add_menu() {
		$data = $this->input->post(null, true);
		if($this->Auth_model->add_menu($data)) {
			msg("등록되었습니다.", "menu_manage2?lang=".$data['lang']);
		}
	}

	public function change_use() {
		$no = $this->input->get("no", true);
		$yn = $this->input->get("yn", true) == "true" ? "y" : "n";
		$this->Auth_model->change_use($no, $yn);
	}

	public function put_menu() {
		$data = $this->input->get(null, true);
		$this->Auth_model->put_menu($data);
	}

	public function manage_skin() {
		$val = $this->input->post("kor_skin", true);
		if($val) {
			$set_data = "";
			$set_data .= "<?php\n";
			$set_data .= "defined('BASEPATH') OR exit('No direct script access allowed');\n\n";
			$set_data .= "\$config = array(\n";
			$set_data .= "\t'cfg_skin' => array(\n";
			$set_data .= "\t\t'kor' => array(\n";
			$set_data .= "\t\t\t'skin' => '".$this->input->post("kor_skin", true)."',\n";
			$set_data .= "\t\t\t'mobile_skin' => '".$this->input->post("kor_mobile_skin", true)."',\n";
			$set_data .= "\t\t),\n";
			$set_data .= "\t\t'eng' => array(\n";
			$set_data .= "\t\t\t'skin' => '".$this->input->post("eng_skin", true)."',\n";
			$set_data .= "\t\t\t'mobile_skin' => '".$this->input->post("eng_mobile_skin", true)."',\n";
			$set_data .= "\t\t),\n";
			$set_data .= "\t\t'chn' => array(\n";
			$set_data .= "\t\t\t'skin' => '".$this->input->post("chn_skin", true)."',\n";
			$set_data .= "\t\t\t'mobile_skin' => '".$this->input->post("chn_mobile_skin", true)."',\n";
			$set_data .= "\t\t),\n";
			$set_data .= "\t\t'jpn' => array(\n";
			$set_data .= "\t\t\t'skin' => '".$this->input->post("jpn_skin", true)."',\n";
			$set_data .= "\t\t\t'mobile_skin' => '".$this->input->post("jpn_mobile_skin", true)."',\n";
			$set_data .= "\t\t),\n";
			$set_data .= "\t),\n";
			$set_data .= ");";
			$this->load->library("qfile");
			$this->qfile->open(APPPATH."/config/cfg_skin.php");
			$this->qfile->write($set_data);
			$this->qfile->close();
			msg("저장되었습니다", "manage_skin");
		} else {
			$get_data = [];
			$this->load->helper("directory");
			$skins = [];
			foreach(directory_map("./data/skin/", true) as $value) {
				$skins[] = str_replace("/", "", $value);
			}
			$get_data['skins'] = $skins;

			$this->config->load("cfg_skin");
			$get_data['current'] = $this->config->item("cfg_skin");
			$this->set_view("admin/auth/manage_skin", $get_data);
		}
	}

	public function test_mail() {
		$this->load->library('qfile');
		$this->load->library('MY_Email');
		$this->qfile->open(APPPATH.'/config/json_smtp.json');
		$file = $this->qfile->read(APPPATH.'/config/json_smtp.json');
		$data = json_decode($file);
		$this->my_email->setFrom($data->userid, $data->sender);
		$this->my_email->AddAddress($data->userid, $data->sender);
		$this->my_email->Subject = '테스트로 보내는 메일입니다.';
		$this->my_email->msgHTML('이 메일은 테스트로 보내는 메일입니다.');
		$this->my_email->send();
		//msg('['.$data->userid.']로 메일을 보냈습니다.\n메일이 오지 않았다면 설정값을 다시 확인해 보시고 그래도 안 온다면 관리자에게 문의해 주세요.', 'set_email');
	}

	public function check_duplicate() {
		$get = $this->input->get(null, true);
		$is_code = $this->dm->get('da_board_manage', [], ['code' => $get['code']]);
		$msg = 'okay';
		if($is_code[0]['code']) $msg = 'exist';
		echo $msg;
	}

    public function manage_mail() {
        $get_data = [];
        $get = $this->input->get(null, true);
        $language = $get['language'] ? $get['language'] : 'kor';
        $dir = FCPATH.'/data/mail_form/'.$language;
        $get_data['files'] = array_diff(scandir($dir), ['.', '..']);
        $get_data['list'] = $this->dm->get('da_mailskins', [], ['language' => $language]);
        $this->set_view('admin/auth/manage_mail', $get_data);
    }

    public function set_manage_mail() {
        $post = $this->input->post(null, true);
        if($post['mode'] === 'modify') {
            $this->dm->update('da_mailskins', [
                'no' => $post['no']
            ], [
                'types' => $post['types'],
                'subject' => $post['subject'],
                'file' => $post['file'],
                'mod_date' => date('Y-m-d H:i:s')
            ]);
        }
        msg('정상적으로 수정이 되었습니다.', 'manage_mail');
    }

    public function view_skin() {
        try {
            $no = $this->input->get('no', true);
            $tmp = $this->dm->get('da_mailskins', [], ['no' => $no])[0];
            $mail_skin = FCPATH.'data/mail_form/'.$tmp['language'].'/'.$tmp['file'];
            if(file_exists($mail_skin) === false) throw new Exception('스킨을 확인해 주세요.');
            $message = '';
            $title = $tmp['subject'];
            ob_start();
            include_once $mail_skin;
            $message = ob_get_contents();
            ob_end_clean();

            $cfg_site = $this->config->config['cfg_site']['kor'];
            $site_info = [
                'nameKor' => $cfg_site['nameKor'],
                'address' => '['.$cfg_site['zipcode'].']'.$cfg_site['address'],
                'ceoName' => $cfg_site['ceoName'],
                'compSerial' => $cfg_site['compSerial'],
                'compFax' => $cfg_site['compFax'],
                'compPhone' => $cfg_site['compPhone'],
                'adminEmail' => $cfg_site['adminEmail'],
                'nameEng' => $cfg_site['nameEng'],
                'base_url' => base_url(),
                'dormant_dt' => date('Y-m-d H:i:s'),
                'dormant_release_dt' => date('Y-m-d H:i:s'),
                'find_id' => 'test',
                'find_password' => 'abcd1234',
                'qustion_title' => '질문에 대한 답변...',
                'qustion_content' => '<p>언덕 가득 별 당신은 하늘에는 버리었습니다. 너무나 이름자 별에도 어머니 북간도에 어머니, 이런 사랑과 다하지 까닭입니다. 계절이 시인의 이름자 나의 있습니다. 무덤 어머니 라이너 하나에 듯합니다. 나는 패, 않은 동경과 하나에 노새, 이름자를 나는 이름을 봅니다. 부끄러운 어머니, 언덕 아름다운 마디씩 까닭이요, 이름과, 때 듯합니다. 위에 피어나듯이 시와 청춘이 다 그리고 버리었습니다. 까닭이요, 써 이름과 하나 아무 계집애들의 피어나듯이 어머니, 까닭입니다. 위에도 시와 이네들은 별들을 이런 않은 이제 봅니다. 지나가는 이국 내일 라이너 이름을 계십니다.</p><p>잠, 하나에 별 이름과, 있습니다. 어머니, 이국 까닭이요, 버리었습니다. 사랑과 동경과 하나에 별 이름을 무엇인지 했던 나는 봅니다. 덮어 가을 했던 이런 북간도에 같이 옥 이름을 별이 있습니다. 이름과 슬퍼하는 무성할 위에 가난한 헤는 봅니다. 다 소학교 속의 듯합니다. 별 밤이 패, 봅니다. 별 내린 나는 까닭입니다. 내 별 별에도 별들을 내일 별 가슴속에 위에 별 계십니다.</p><p>청춘이 걱정도 이런 가난한 봅니다. 걱정도 쓸쓸함과 내 별 별이 멀리 아이들의 않은 있습니다. 걱정도 책상을 하나 이제 아침이 봄이 까닭입니다. 않은 이웃 무덤 사람들의 거외다. 나는 잠, 덮어 흙으로 벌레는 이웃 봅니다. 비둘기, 무덤 추억과 별 내린 나는 피어나듯이 토끼, 오면 있습니다. 하나에 둘 까닭이요, 거외다. 하나의 어머니, 같이 하나에 새겨지는 써 계십니다. 한 벌써 이름을 자랑처럼 이웃 너무나 봄이 언덕 까닭입니다.</p>',
                'answer_content' => '<p>헤는 패, 비둘기, 계절이 까닭입니다. 별빛이 밤이 하나에 없이 비둘기, 시인의 소녀들의 것은 위에 있습니다. 어머니, 내 밤을 이제 청춘이 시와 거외다. 이름과, 이 오는 듯합니다. 언덕 그리워 어머니 까닭입니다. 된 위에 이 이름과, 버리었습니다.</p>',
                'board_name' => '묻고 답하기',
                'title' => '게시판의 제목입니다.',
                'writer' => '작성자',
                'content' => '<p>멀리 사람들의 하나에 쓸쓸함과 듯합니다. 까닭이요, 한 이제 내 하나에 시와 별 불러 하나에 있습니다. 별 책상을 동경과 노루, 노새, 봅니다. 그리워 무성할 릴케 부끄러운 책상을 이런 거외다. 밤을 무덤 시와 나는 않은 별 이런 별 봅니다. 슬퍼하는 릴케 가난한 거외다. 쉬이 말 보고, 마디씩 이름과, 그리고 피어나듯이 불러 옥 까닭입니다. 이런 많은 아스라히 보고, 까닭이요, 불러 나의 밤을 이름을 까닭입니다. 많은 별이 노새, 계십니다. 나의 사랑과 오면 밤이 경, 있습니다. 나는 말 슬퍼하는 소녀들의 버리었습니다.</p>',
                'email' => 'test@test.com',
                'mobile' => '010-1234-5678',
            ];

            foreach($site_info as $key => $value) {
                $message = str_replace("{\$".$key."}", $value, $message);
            }

            foreach(['name' => '홍길동', 'board_name' => '묻고 답하기', 'category' => '질문'] as $key => $value) {
                $title = str_replace("{\$".$key."}", $value, $title);
            }
            $get_data['title'] = $title;
            $get_data['body'] = $message;
            $this->load->view('admin/auth/view_skin', $get_data);
        } catch(Exception $e) {
            msg($e->getMessage(), 'close');
        }
    }

    public function view_origin() {
        try {
            $this->load->library('qfile');
            $no = $this->input->get('no', true);
            $tmp = $this->dm->get('da_mailskins', [], ['no' => $no])[0];
            $mail_skin = '/data/mail_form/'.$tmp['language'].'/'.$tmp['file'];
            //if (file_exists($mail_skin) === false) throw new Exception('스킨을 확인해 주세요.');
            $this->qfile->open(FCPATH.$mail_skin);
            $mail['body'] = $this->qfile->read();
            $mail['skin'] = $mail_skin;
            $this->load->view('admin/auth/view_origin', $mail);
        } catch (Exception $e) {
            msg($e->getMessage(), 'close');
        }
    }

    public function update_content() {
        try {
            $this->load->library('qfile');
            $post = $this->input->post(null, true);
            $mail_skin = FCPATH.$post['skin'];
            if(file_exists($mail_skin) === false) throw new Exception('스킨을 확인해 주세요.');
            $temp = explode("\n", html_entity_decode($post['content']));
            $html = [];
            for($i = 0; $i < count($temp); $i++) {
                $html[] = str_replace("\\t", "\t", $temp[$i]);
            }
            $this->qfile->open($mail_skin);
            $this->qfile->write(implode('', $html));
            $this->qfile->close();
            msg('정상적으로 수정되었습니다.', 'close');
        } catch(Exception $e) {
            msg($e->getMessage(), -1);
        }
    }

    public function smtp() {
        $post = $this->input->post(null, true);
        if(isset($post['use_smtp'])) {
            $this->dm->update('da_manage', ['no' => 1], [
                'use_smtp' => $post['use_smtp'],
                'smtp_send_name' => $post['smtp_send_name'],
                'smtp_secure' => $post['smtp_secure'],
                'smtp_port' => $post['smtp_port'],
                'smtp_host' => $post['smtp_host'],
                'smtp_userid' => $post['smtp_userid'],
                'smtp_password' => $post['smtp_password']
            ]);
            msg('정상적으로 수정이 되었습니다.', 'smtp');
        } else {
            $get_data['manage'] = $this->dm->get('da_manage', [], ['no' => 1])[0];
            $this->load->view('admin/auth/smtp', $get_data);
        }
    }

    public function log_login() {
        $get_data = [];
        $get_data['get'] = $this->input->get(null, true);
        $this->load->library('Pagination');
        $limit = !isset($get_data['get']['limit']) ? 20 : $get_data['get']['limit'];
        $per_page = !$get_data['get']['per_page'] ? 1 : $get_data['get']['per_page'];
        $offset = ($per_page - 1) * $limit;
        $get_data['all'] = $this->dm->get('da_log_login');
        $get_data['list'] = $this->dm->get('da_log_login', [], [], [], [], ['no' => 'DESC'], [$limit, $offset]);
        $get_data['offset'] = $offset;
        $this->pagination->initialize([
            'total_rows' => count($get_data['all']),
            'per_page' => $limit,
        ]);
        $get_data['pagination'] = $this->pagination->create_links();

        $this->set_view('admin/auth/log_login', $get_data);
    }

    public function manage_access_admin() {
        $get_data = [];
        $get_data['manage'] = $this->dm->get('da_manage')[0];
        $get_data['admin'] = $this->dm->get('da_admin_accessible_ip', [], [], [], [], ['no' => 'ASC']);
        //$get_data['blocked'] = $this->dm->get('da_ip_blocked', [], [], [], [], ['no' => 'ASC']);
        $this->set_view('admin/auth/manage_access_admin', $get_data);
    }

    public function manage_blocked_ip() {
        $get_data = [];
        $get_data['manage'] = $this->dm->get('da_manage')[0];
        $get_data['client'] = $this->dm->get('da_client_blocked_ip', [], [], [], [], ['no' => 'ASC']);
        $this->set_view('admin/auth/manage_blocked_ip', $get_data);
    }

    public function manage_access_update() {
        $post = $this->input->post(null, true);

        $str = $yn = '';
        if($post['type'] === 'admin_accessible_ip') {
            $value = $post['use_admin_accessible_ip'] === 'y' ? 'y' : 'n';
            $this->dm->update('da_manage', ['no' => 1], ['use_admin_accessible_ip' => $value]);
            $yn = $post['use_admin_accessible_ip'] === 'y' ? '' : '비';
            $str = '접근 가능한 아이피 사용 기능이 '.$yn.'활성화되었습니다.';
        }

        if($post['type'] === 'client_blocked_ip') {
            $value = $post['use_client_blocked_ip'] === 'y' ? 'y' : 'n';
            $this->dm->update('da_manage', ['no' => 1], ['use_client_blocked_ip' => $value]);
            $yn = $post['use_client_blocked_ip'] === 'y' ? '' : '비';
            $str = '사용자 아이피 차단 기능이 '.$yn.'활성화되었습니다.';
        }
        msg($str, 'manage_access_admin');
    }

    public function insert_admin_accessible_ip() {
        $post = $this->input->post(null, true);
        $this->dm->insert('da_admin_accessible_ip', ['reg_userid' => $this->_admin_member['userid'], 'ip' => $post['ip']]);
        msg('정상적으로 등록되었습니다.', 'manage_access_admin');
    }

    public function insert_client_blocked_ip() {
        $post = $this->input->post(null, true);
        $temp = explode('|', $post['blocked_ip']);
        array_push($temp, $post['client_blocked_ip']);
        $this->dm->update('da_manage', ['no' => 1], ['blocked_ip' => implode('|', $temp)]);
        msg('해당 아이피가 정상적으로 차단되었습니다.', 'manage_access_admin');
    }

    public function update_client_blocked_ip() {
        $post = $this->input->post(null, true);
        $ip = [];
        foreach($post['ip'] as $value) {
            if($value) $ip[] = $value;
        }
        $this->dm->update('da_manage', ['no' => 1], ['blocked_ip' => implode('|', $ip)]);
        msg('정상적으로 차단 해제되었습니다.', 'manage_access_admin');
    }

    public function remove_ip() {
        $pg = $this->input->post_get(null, true);
        $this->dm->remove($pg['table'], ['no' => $pg['no']]);
        msg('정상적으로 삭제되었습니다.', $pg['page']);
    }

    /*
    public function manage_blocked_ip() {
        $get_data = [];
        $get_data['manage'] = $this->dm->get('da_manage')[0];
        $get_data['blocked'] = $this->dm->get('da_ip_blocked', [], [], [], [], ['no' => 'ASC']);
        $this->set_view('admin/auth/manage_blocked_ip', $get_data);
    }
    */

    public function manage_ip() {
        $post = $this->input->post(null, true);
        if(in_array($post['table'], ['da_ip_allowed_admin', 'da_ip_blocked']) === true) {
            $data['ip'] = $post['ip'];
            $data['regdate'] = date('Y-m-d H:i:s');
            if($post['table'] === 'da_ip_allowed_admin') $data['reg_userid'] = $this->_admin_member['userid'];
            $this->dm->insert($post['table'], $data);
            msg('정상적으로 등록되었습니다.', 'manage_access');
        }

        if($post['table'] === 'da_manage') {
            $data = [];
            if($post['use_allowed_admin_ip']) $data = ['use_allowed_admin_ip' => $post['use_allowed_admin_ip']];
            if($post['use_blocked_user_ip']) $data = ['use_blocked_user_ip' => $post['use_blocked_user_ip']];
            if($post['use_block_login']) $data = ['use_block_login' => $post['use_block_login'], 'block_login_count' => $post['block_login_count']];
            $this->dm->update($post['table'], ['no' => 1], $data);
            msg('정상적으로 적용되었습니다.', 'manage_access');
        }
    }

    public function block_ip() {
        try {
            $get = $this->input->get(null, true);
            $qs = [];
            foreach($get as $key => $value) {
                if(in_array($key, ['ip', 'cm']) === false) $qs[] = $key.'='.$value;
            }
            $ret_url = $get['cm'].'?'.implode('&', $qs);

            $is_blocked = $this->dm->get('da_ip_blocked', [], ['ip' => $get['ip']], [], [], ['no' => 'DESC'])[0];
            if(count($is_blocked) > 0) throw new Exception('이미 차단된 아이피입니다.\n차단일 : '.$is_blocked['regdate']);
            $this->dm->insert('da_ip_blocked', ['ip' => $get['ip'], 'regdate' => date('Y-m-d H:i:s')]);
            msg('정상적으로 차단이 되었습니다.', $ret_url);
        } catch(Exception $e) {
            msg($e->getMessage(), $ret_url);
        }
    }

    /*
    public function remove_ip() {
        try {
            $get = $this->input->get(null, true);
            $this->dm->remove('da_'.$get['table'], ['no' => $get['no']]);
            msg('정상적으로 삭제되었습니다.', 'manage_access');
        } catch(Exception $e) {
            msg($e->getMessage(), -1);
        }
    }
    */

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

    public function log_adminpage_access() {
        $this->load->library('pagination');
        $get = $this->input->get(null, true);
        $data = $where = $like = [];
        $data['variables'] = $this->variables;
        $limit = !isset($get['limit']) ? 20 : $get['limit'];
        $per_page = !$get['per_page'] ? 1 : $get['per_page'];
        $sort = ['no' => 'DESC'];
        $offset = ($per_page - 1) * $limit;
        $data['offset'] = $offset;
        $data['get'] = $get;
        $data['all'] = $this->dm->get('da_log_admin_login', [], $where, $like);
        $data['list'] = $this->dm->get('da_log_admin_login', [], $where, $like, [], $sort, [$limit, $offset]);
        $this->pagination->initialize([
            'total_rows' => count($data['all']),
            'per_page' => $limit,
            //'first_url' => '?'.implode('&', $qs),
            //'suffix' => '&'.implode('&', $qs),
        ]);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('admin/auth/log_adminpage_access', $data);
    }
}