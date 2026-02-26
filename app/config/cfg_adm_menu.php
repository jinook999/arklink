<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'adm_menu' => array(
		'auth' => array(
			'name' => '기본설정',
			'default' => 'conf_reg',
			'low_menu' => array(
                array(
					'name' => '기본 정보 설정',
					'segment' => 'conf_reg',
				), array(
					'name' => '검색엔진 최적화(SEO)',
					'segment' => 'search_engine_opt',
				), array(
					'name' => '약관 및 개인정보정책',
					'segment' => 'terms_list',
				), array(
					'name' => '사용 언어설정',
					'segment' => 'language_reg',
				), array(
					'name' => '국가 정보 설정',
					'segment' => 'country_manage',
				), array(
					'name' => '스킨 설정',
					'segment' => 'manage_skin',
				), array(
					'name' => '메일 설정',
					'segment' => 'manage_mail',
				), array(
					'name' => '메뉴 설정',
					'segment' => 'menu_manage',
				), array(
					'name' => '메인 상품진열',
					'segment' => 'display_main_list',
				), array(
					'name' => '회원 필드세팅',
					'segment' => 'member_field',
				), array(
					'name' => '게시판 관리',
					'segment' => 'board_manage',
				), array(
					'name' => '로그인 정보',
					'segment' => 'log_login',
				), array(
					'name' => '관리자 페이지 접근 관리',
					'segment' => 'manage_admin',
				), array(
					'name' => '아이피 차단',
					'segment' => 'manage_access_admin',
				), array(
					'name' => '개발자모드',
					'segment' => 'debug_mode',
				)
			)
		),
		'menu' => array(
			'name' => '메인 슬라이드 관리',
			'default' => 'main_image_slide',
			'low_menu' => array(
				//array(
					//'name' => '메인관리',
					//'segment' => '',
				//),
				array(
					'name' => '메인 슬라이드 설정',
					'segment' => 'main_image_slide',
				)
			)
		),
		'member' => array(
			'name' => '회원',
			'default' => 'member_list',
			'low_menu' => array(
				array(
					'name' => '회원 관리',
					'segment' => 'member_list',
				),
				//array('name' => '회원 등록', 'segment' => 'member_reg'),
				array(
					'name' => '회원 등급 관리',
					'segment' => 'member_grade',
				),
				array(
					'name' => '탈퇴 회원 관리',
					'segment' => 'member_withdrawal_list',
				),
				array(
					'name' => '관리자 관리',
					'segment' => 'admin_list',
				),
				//array('name' => '관리자 등록', 'segment' => 'admin_reg'),
				array(
					'name' => '관리자 등급 관리',
					'segment' => 'admin_grade',
				),
				//array('name' => '관리자 등급 등록', 'segment' => 'admin_grade_reg'),
			),
		),
		'board' => array(
			'name' => '게시판',
			'default' => 'board_list',
			'low_menu' => array(
				array(
					'name' => '게시글 관리',
					'segment' => 'board_list',
				),
			)
		),
		'goods' => array(
			'name' => '상품',
			'default' => 'goods_list',
			'low_menu' => array(
				array(
					'name' => '상품 필드 세팅',
					'segment' => 'goods_field',
				),
				array(
					'name' => '상품 리스트',
					'segment' => 'goods_list',
				),
				//array('name' => '상품 등록', 'segment' => 'goods_reg'),
				array(
					'name' => '분류 등록',
					'segment' => 'category_reg',
				),
				array(
					'name' => '분류 수정',
					'segment' => 'category_list',
				),
			)
		),
		'popup' => array(
			'name' => '팝업 설정',
			'default' => 'popup_list',
			'low_menu' => array(
				array(
					'name' => '팝업 관리',
					'segment' => 'popup_list',
				),
				//array('name' => '팝업 등록', 'segment' => 'popup_reg'),
			)
		),
		'design' => array(
			'name' => '디자인 관리',
			'default' => 'banner_list',
			'low_menu' => array(
				array(
					'name' => '배너 관리',
					'segment' => 'banner_list',
				),
				array(
					'name' => '페이지 관리',
					'segment' => 'page_list',
				),
			),
		),
	),
);