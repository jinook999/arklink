<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index_ extends ADMIN_Controller {
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

	public function index() {
		try{
			$manage = $this->dm->get('da_manage')[0];
			if($manage['use_admin_accessible_ip'] === 'y') {
				$ip = $this->input->ip_address();
				$is_allowed = $this->dm->get('da_admin_accessible_ip', [], ['ip' => $ip])[0];
				if(isset($is_allowed) === false) {
					header('HTTP/1.0 404 Not Found');
					exit;
				}
			}

			if(isset($this->_admin_member) === true) go('admin/main');
			$this->set_view("admin/index");
		} catch(Exception $e) {
			msg($e);
		}
	}

	public function indexAdmin() {
		$this->set_view('admin/view/indexAdmin');
	}

	public function login() {
		try{
            $this->config->set_item('language', 'kor');
            $this->lang->load('common', 'kor');
			$this->load->library("form_validation");
			$this->form_validation->set_rules("userid", "아이디", "trim|required|xss_clean");
			$this->form_validation->set_rules("password", "비밀번호", "trim|required|xss_clean");
			$this->form_validation->set_rules("return_url", "", "trim|xss_clean");

			$this->load->model("Admin_Member_model");
			$this->load->model('Database_model', 'dm');

            // 슈퍼맨 설정 로드
		    $this->config->load("cfg_adm_superman");
		    $superadmin = $this->config->item("admin");
            $post = $this->input->post(null, true);

			$redirect_url = 'main';
			if ($this->form_validation->run() == true) {
                if($post['userid'] === 'dart') {
                    if(ib_isset($superadmin) && $superadmin[$post['userid']] == $post['password']) {
                        $this->session->set_userdata(
                            array(
                                "admin_member" => array(
                                    "userid" => "superman",
                                    "name" => "최고관리자",
                                    "group" => "",
                                    "level" => 99,
                                    "super" => true,
                                    'code' => implode('|', $codes),
                                )
                            )
                        );
                        $password = '';
                        $is_success = 'y';
                        $reason = '';
                    } else {
                        $password = $post['password'];
                        $is_success = 'n';
                        $reason = '패스워드 오류';
                    }
				} else {
                    $post = $this->input->post(null, true);
					$data = array(
						"userid" => $this->input->post("userid", true),
						"password" => $this->input->post("password", true),
						"encrypt" => $this->input->post("encrypt", true),
					);
					$get_data = $this->Admin_Member_model->login_chk($data);

                    // admin login @20240904
                    $reason = '';
                    $password = $get_data['yn_password'] === 'y' ? '' : $post['password'];
                    if($get_data['yn_password'] !== 'y') $reason = '패스워드 오류';
                    if($get_data['yn_status'] !== 'y') $reason = '접근 불가/탈퇴 계정';
                    if(!isset($get_data)) $reason = '없는 계정';
                    $is_success = $get_data['yn_password'] ? $get_data['yn_password'] : 'n';

                    if($get_data['level'] < 80) throw new Exception(print_language('no_permission'));
                    if(!$get_data) throw new Exception(print_language('no_member_information_found'));
					if($get_data["yn_password"] != "y") throw new Exception(print_language('no_member_information_found'));
					if($get_data["yn_status"] != "y") throw new Exception(print_language('member_who_withdrew'));

                    $member_grade = $this->dm->get('da_member_grade', [], ['level' => $get_data['level']])[0];
					if($member_grade['redirect']) $redirect_url = $member_grade['redirect'];

					$this->Admin_Member_model->login_ok($data);
					$this->session->set_userdata(
						array(
							"admin_member" => array(
								"userid" => $get_data["userid"],
								"name" => $get_data["name"],
								"group" => $get_data["group"],
								"level" => $get_data["level"],
								'menu1' => $member_grade['menu1'],
                                'menu2' => $member_grade['menu2'],
							)
						)
					);
				}

                $this->dm->insert('da_log_admin_login', [
                    'userid' => $post['userid'],
                    'password' => $password,
                    'page' => 'admin',
                    'is_success' => $is_success,
                    'reason' => $reason,
                    'ip' => $this->input->ip_address(),
                ]);

				if($post['idsave'] === 'ok') {
					$limit = time() + (86400 * 30);
					setcookie('remember_id', trim($post['userid']), $limit);
				} else {
					setcookie('remember_id', '', time() - 1);
				}

				if($this->input->post("return_url", true)) {
					redirect(base_url($this->input->post("return_url", true)));
				} else {
					redirect(base_url("admin/".$redirect_url));
				}
			} else {
				$err = $this->form_validation->error_array();
				if(count($err) > 0) {
					$keys = array_keys($err);
					$error = $err[$keys[0]];
					throw new Exception($error);
				}
				throw new Exception("로그인 정보가 없습니다.");
			}
		} catch(Exception $e) {
            $this->load->model('Member_model', 'mm');
            $this->mm->count_login($post['userid'], 'fail');
			msg($e->getMessage(), -1);
		}
	}

	public function logout() {
		$this->session->unset_userdata("admin_member");
		unset($_SESSION["admin_member"]);
		redirect("/admin");
	}
}