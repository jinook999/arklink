<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FRONT_Controller extends MY_Controller {
	public $_member;
	public $lang_member;
	public $_skin;
	public $_site_language;
	public $_skin_language;
	public $_template_tpl;
	public $_skin_mode;
	public $_cfg_siteLanguage;
	public $_set_language;

	public function __construct() {
		parent::__construct();

        $this->load->model('Database_model', 'dm');
        $manage = $this->dm->get('da_manage')[0];
        if($manage['use_client_blocked_ip'] === 'y') {
            $ip_list = explode('|', $manage['blocked_ip']);
            if(in_array($this->input->ip_address(), $ip_list) === true ) {
                header('HTTP/1.0 404 Not Found');
                exit;
            }
        }

		// 접속페이지 확인체크
		define("_CONNECT_PAGE", "FRONT");

		// 언어
		$this->config->load("cfg_siteLanguage");
		$this->_cfg_siteLanguage = $this->config->item("site_language");

		//세팅된 언어 저장
		$this->_set_language = implode(',', array_keys($this->_cfg_siteLanguage['set_language']));

		// 사이트 설정
		$cfg_site = $this->config->item('cfg_site');

		// 메뉴 정보 가져오기
		$this->config->load('cfg_menu');
		$cfg_menu = $this->config->item('cfg_menu');

		// 스킨 설정
		$this->config->load('cfg_skin');
		$cfg_skin = $this->config->item('cfg_skin');

		// 메뉴 페이지에 지정 안 된 페이지 제목 @20201112
		$this->config->load("cfg_pageTitles");
		$this->pageTitles = $this->config->item("pageTitles");
        $this->load->model('Database_model', 'dm');

		// 다국어 검사 (사용 여부)
		if($this->_cfg_siteLanguage['multilingual'] === 1) {
            // 사용자 언어설정 (사용자가 요청한 Language가 있을경우 우선처리)
            $getLanguage = $this->input->get('language', true) ? $this->input->get('language', true) : $this->session->__get('site_language');

            // geoip 기준 language
            if(!isset($getLanguage)) {
                // geoip helper class
                $this->load->helper('geoip');
                $localLanguage = get_country_code(); // 국가 코드 가져오는 사용자 함수

                // 기본언어 세팅
                switch($localLanguage) {
                    case 'US' :
                    case 'GB' :
                        $getLanguage = 'eng';
                    break;
                    case 'CN' : // 중문 간체
                        $getLanguage = 'chn';
                    break;
                    case 'JP' :  // 일어
                        $getLanguage = 'jpn';
                    break;
                    case 'KR' :  // 한국어
                        $getLanguage = 'kor';
                    break;
                    default:
                        $getLanguage = $cfg_site['standard_mall'];
                    break;
                }
            }
            if(isset($this->_cfg_siteLanguage['set_language'][$getLanguage])) {
				$language = $getLanguage;
            } elseif(isset($this->_cfg_siteLanguage['set_language'][$cfg_site['standard_mall']])) {
                $language = $cfg_site['standard_mall'];
            } else {
                reset($this->_cfg_siteLanguage['set_language']);
                $language = key($this->_cfg_siteLanguage['set_language']);
            }
            unset($getLanguage);

			//if($this->session->__get('set_language') && $this->session->__get('set_language') != $this->_set_language) {
			if($this->session->__get('set_language') != $this->_set_language) {
				//reset($this->_cfg_siteLanguage['set_language']);
                //$language = key($this->_cfg_siteLanguage['set_language']);
			}

            $this->_site_language = $language;
            $this->_skin_language = $language;
        } else {
            // 사용안함일 경우 한국어
            $this->_site_language = "kor";
            $this->_skin_language = "kor";
        }

		// 언어 관련 재정의 @20250103
		$this->_skin_language = 'kor';
		$seg1 = isset($this->uri->segments[1]) ? $this->uri->segments[1] : '';
		if(in_array($seg1, ['en', 'cn', 'jp']) === true) {
			$languages = ['en' => 'eng', 'cn' => 'chn', 'jp' => 'jpn'];
			$this->_skin_language = $languages[$seg1];
		}
		$this->_site_language = $this->_skin_language;

		if(isset($cfg_menu[$this->_site_language]) && is_array($cfg_menu[$this->_site_language])) {
			ksort($cfg_menu[$this->_site_language]);

			foreach($cfg_menu[$this->_site_language] as $fkey => $fval){
				if(isset($fval['menu']) && is_array($fval['menu'])){
					ksort($fval['menu']);
					$cfg_menu[$this->_site_language][$fkey]['menu'] = $fval['menu'];
				}
			}
		}

		if($this->session->__get('site_language') != $this->_site_language) {
			$this->session->set_userdata(array('site_language' => $this->_site_language));
		}

		if($this->session->__get('skin_language') != $this->_skin_language) {
			$this->session->set_userdata(array('skin_language' => $this->_skin_language));
		}

		//2020-03-11 Inbet Matthew 언어설정이 바뀔 경우 제일 첫번째 순서의 언어로 변경하기 위해 변경전 언어 설정 데이터 session에 저장
		if($this->session->__get('set_language') != $this->_set_language) {
			$this->session->set_userdata(array('set_language' => $this->_set_language));
		}
		//Matthew End

		$standard_mall = $cfg_site['standard_mall'];
		$cfg_site = array_merge($cfg_site[$this->_site_language],$cfg_site['seo']);
		$cfg_site['standard_mall'] = $standard_mall;
		$cfg_site['language'] = $this->_site_language;
		$cfg_site['languagename_kr'] = $this->_cfg_siteLanguage['support_language'][$this->_site_language];
        // 링크 연동 추가
        $cfg_site['languagelink'] = $this->_cfg_siteLanguage['set_language'];

		$cfg_skin['skin_language'] = $this->_skin_language;
		$this->_skin = $cfg_skin[$this->_skin_language]['skin'];
        # 범인 2020-04-03
		$this->config->set_item("language", $this->_site_language);
		$this->lang->load('common', $this->_site_language);
		// 다국어 설정 끝

		// 유저 로그인체크
        $this->lang_member = $this->session->__get('member');
		$this->_member = $this->lang_member[$this->_site_language];
		if(isset($this->_member)) {
			define('_IS_LOGIN', true);
			$this->template_->assign('member', $this->_member);

			/*
				yn_change_password 회원db조회 날짜를 통해 6개월 초과시 y
				password_change_status 비밀번호변경 or 다음에변경을 했을경우 y
				@20200925 로그인 시에 한 번만 실행
			*/
		}

		if(isset($_GET['pc'])) {
			$this->session->set_userdata(array('skin_mode' =>'pc'));
		}

		if(isset($_GET['mobile'])) {
			$this->session->set_userdata(array('skin_mode' => 'mobile'));
		}

		$this->_skin_mode = $this->session->__get('skin_mode');

		$this->load->model("category_model");
		$categoryList = $this->category_model->get_list_category_low([["yn_use", "y"]]);
		$categoryList = array_merge($categoryList, $this->category_model->get_list_category_same([["yn_use", "y"]]), $this->category_model->get_list_category_top([["yn_use", "y"]]));//190618 변경
		$this->template_->assign("categories", $categoryList);

		// Menu
		/*
		$menus = [];
		$this->load->model("Menu_model");
		$get_menus = $this->Menu_model->get_menus($this->_site_language, null);
		foreach($get_menus as $key => $value) {
			if(strlen($value['code']) == 2) {
				$menus[$value['code']] = $value;
			} else {
				$menus[substr($value['code'], 0, 2)]['sub'][] = $value;
			}
		}
		$this->template_->assign("menus", $menus);
		*/

		// 모바일 체크
		$this->load->library('user_agent');
		if($this->agent->is_mobile()) {
			define('_MOBILE', true);
			if(!$this->_skin_mode) {
				$this->_skin_mode = 'mobile';
			}
			$this->template_->assign("agent", 'mobile');
		} else {
			if(!$this->_skin_mode) {
				$this->_skin_mode = 'pc';
			}
			$this->template_->assign("agent", 'pc');
		}

		if($this->_skin_mode == 'mobile') {
			$this->_skin = $cfg_skin[$this->_skin_language]['mobile_skin'];
			$this->template_->assign("isMobile", true);
		} else {
			$this->_skin = $cfg_skin[$this->_skin_language]['skin'];
			$this->template_->assign("isMobile", false);
		}

		$this->get_user_agent();

		$this->config->load('skin');
		$get_skin = $this->config->item('skin');
		$cfg_skin['skinname_kr'] = $get_skin[$this->_skin];

		// 현재 페이지 이름 갖고 오기 추가 190513
		$menus = [];
		$lm = [];
		$current = "";
		$curr = isset($this->uri->rsegments[1]) && $this->uri->rsegments[1] == "board" ? "code=".$this->input->get("code", true) : implode("/", (array)$this->uri->rsegments);
		$on = "";// 개선
		$idx = null;
		$page_name = "";
		if(isset($cfg_menu[$this->_skin_language]) && is_array($cfg_menu[$this->_skin_language])) {
			foreach($cfg_menu[$this->_skin_language] as $key => $value) {
				if(isset($value['menu']) && is_array($value['menu'])) {
					foreach($value['menu'] as $k => $v) {
						$menus[$v['url']] = $v['name'];
						if(strpos($v['url'], "code=") > -1) {
							$url = explode("?", $v['url']);
							$keys = $url[1];
						} else {
							$keys = $v['url'];
						}
						if(strpos($this->input->server('REQUEST_URI'), $keys) > -1){
							$idx = $key;
							$current = $keys;
						}
					}
				}
				if(isset($value['url']) && strpos($value['url'], $this->input->get("code", true)) > -1) $on = $value['name'];// 개선
			}// 일반 페이지 제외하고 현재 게시판에 해당하는 메뉴 on
		}

		$this->template_->assign("on", $on);// 개선
		$lm = ($idx !== null && isset($cfg_menu[$this->_skin_language][$idx])) ? $cfg_menu[$this->_skin_language][$idx] : array();
		if(isset($this->uri->rsegments[1]) && $this->uri->rsegments[1] != "board") $page_name = isset($menus["/".implode("/", (array)$this->uri->rsegments)]) ? $menus["/".implode("/", (array)$this->uri->rsegments)] : "";
		$this->template_->assign("current_page_name", $page_name);
		$this->template_->assign("lm", $lm);
		$this->template_->assign("current", $current);
		// 현재 페이지 이름 갖고 오기 추가 190513
		$this->set_header();
		$cfg = array();
		$cfg['cfg_site'] = $cfg_site;
		$cfg['cfg_menu'] = get_active_menu($cfg_menu[$this->_site_language]);
		$cfg['cfg_skin'] = $cfg_skin;

        // seo
		$seo = get_seo($this->_site_language, $cfg_site);
		if($this->input->ip_address() === '210.121.177.87') {}

        $this->template_->assign($cfg);
        $this->template_->assign('seo', $seo);
		$this->template_->assign("CI", get_instance());
		$this->template_->assign("multilingual",$this->_cfg_siteLanguage["multilingual"]);
		$this->_template_tpl['header'] = $this->_skin .'/outline/header.html';
		$this->_template_tpl['nav'] = $this->_skin .'/outline/nav.html';
		$this->_template_tpl['footer'] = $this->_skin .'/outline/footer.html';
		//layout정리190513
		$this->_template_tpl['left_bbs'] = $this->_skin .'/outline/left_bbs.html'; //게시판 측면
		$this->_template_tpl['left_member'] = $this->_skin .'/outline/left_member.html'; //member & service 폴더관련 페이지 측면
		$this->_template_tpl['left_goods'] = $this->_skin .'/outline/left_goods.html'; //goods 폴더관련 페이지 측면
		$this->_template_tpl['left_bnr'] = $this->_skin .'/outline/left_bnr.html'; //측면 공통요소 모음(이미지베너 혹은 정보
		$this->_template_tpl['bbs_top'] = $this->_skin .'/outline/bbs_top.html'; //게시판 상단
		//layout정리190513

		$this->template_->assign("js", "/data/skin/".$this->_skin);

		$this->template_->define("popup_open", $this->_skin. "/layout/popup.html"); //팝업 태그를 index.html->footer.html로 옮겨서 에러 안나게 하기위해 index_.php->FRONT_Controller로 이동했음.
		if($_SERVER['SERVER_PORT'] == "443") {
			define("_IS_SSL", true);
		}

		$this->template_->assign("req", $this->input->get(null, true));
	}

	public function template_print($template_path) {
		$this->_template_tpl['content'] = $this->_skin .DIRECTORY_SEPARATOR. $template_path;

		$this->template_->define($this->_template_tpl);
		$this->template_->print_('content');
	}

	public function template_path() {
		if($this->uri->rsegments[1] == 'index_') {
			return 'index.html';
		}
		return strtolower(implode(DIRECTORY_SEPARATOR, $this->uri->rsegments)).'.html';
	}

	public function set_header() {
		$this->output->set_header('HTTP/1.0 200 OK');
		$this->output->set_header('HTTP/1.1 200 OK');
		$this->output->set_header('charset: utf-8');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header('Expires: -1');
		$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		$this->output->set_header('X-UA-Compatible: IE=edge');
	}

	protected function _get_seddo($current) {
		$get = $this->input->get(null, true);
		$where = [];

		switch($current) {
			case 'page' :
				if(isset($get['no'])) $where['no'] = $get['no'];
				if(isset($get['file'])) $where['original'] = $get['file'];
				$page = $this->dm->get('da_page', [], $where)[0];
				if($page['use_seo'] === 'y') {
					return [
						'title' => $page['seo_title'],
						'author' => $page['seo_author'],
						'description' => $page['seo_description'],
						'keywords' => $page['seo_keywords'],
						'og_image' => '',
						'og_title' => $page['seo_title'],
						'og_description' => $page['seo_description']
					];
	            }
				break;
			
			case 'goods_view' :
				$goods = $this->dm->get('da_goods', [], ['no' => $get['no']])[0];
				if($goods['use_seo'] === 'y') {
					$tmp = json_decode($goods['img1']);
					$goods_seo = $this->dm->get('da_goods_seo', [], ['language' => $this->_site_language, 'goodsno' => $goods['no']])[0];
					return [
						'title' => $goods_seo['title'],
						'author' => $goods_seo['author'],
						'description' => $goods_seo['description'],
						'keywords' => $goods_seo['keywords'],
						'og_image' => '/upload/goods/img1/'.$tmp->fname,
						'og_title' => $goods_seo['title'],
						'og_description' => $goods_seo['description'],
					];
				}
				break;
			
			case 'board_view' :
				$board = $this->dm->get('da_board_'.$get['code'], [], ['no' => $get['no']])[0];
				if($board['use_seo'] === 'y') {
					return [
						'title' => $board['seo_title'],
						'author' => $board['seo_author'],
						'description' => $board['seo_description'],
						'keywords' => $board['seo_keywords'],
						'og_image' => '/upload/board/'.$get['code'].'/'.$board['thumbnail_image'],
						'og_title' => $board['seo_title'],
						'og_description' => $board['seo_description'],
					];
				}
				break;
			
			default :
				$default = $this->dm->get('da_seo', [], ['language' => $this->_site_language])[0];
				return [
					'title' => $cfg['cfg_site']['title'],
					'author' => $default['author'],
					'description' => $default['description'],
					'keywords' => $default['keywords'],
					'og_image' => $default['og_image'],
					'og_title' => $cfg['cfg_site']['title'],
					'og_description' => $default['og_description'],
				];
				break;
		}
	}

	public function get_user_agent() {
		$this->load->library('User_agent');
		$this->load->helper('cookie');
		$host = $this->input->server('HTTP_HOST');
		$datas = [];

		//if(strpos($this->agent->referrer(), $host) > -1) {
		if(strpos($this->agent->referer, $host) > -1) {
			return false;
		} else {
			$cookie = $this->input->cookie('onlyStatistics');
			if($cookie) {
				return false;
			} else {
				$cookie_info = [
					'name' => 'onlyStatistics',
					'value' => $this->input->server('REMOTE_ADDR'),
					'expire' => 60 * 30,
					'domain' => '.'.$this->input->server('HTTP_HOST'),
					'path' => '/'
				];

				$words = "";
				if($this->agent->referrer()) {
					$parse = parse_url($this->agent->referrer());
					parse_str($parse['query'], $result);
					foreach($result as $key => $value) {
						if(in_array($key, ['query', 'q'])) {
							$words = $value;
						}
					}
				}

				$this->input->set_cookie($cookie_info);
				$this->load->model('Statistics_model');
				$datas['user_agent'] = $this->agent->agent;
				$datas['platform'] = $this->agent->platform;
				$datas['browser'] = $this->agent->browser;
				$datas['version'] = $this->agent->version;
				$datas['mobile'] = $this->agent->mobile;
				$datas['robot'] = $this->agent->robot;
				$datas['ip'] = $this->input->server('REMOTE_ADDR');
				$datas['words'] = $words;
				$datas['referer'] = $this->agent->referrer();
				$datas['reg_date'] = date('Y-m-d H:i:s');
				$this->Statistics_model->insert($datas);
			}
		}
	}
}