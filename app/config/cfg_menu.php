<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'cfg_menu' => array(
		'chn' => array(
			'0' => array(
				'use' => 'y',
				'name' => '중_갤러리',
				'url' => '/cn/board/board_list?code=gallery',
				'sort' => '0',

			),
			'1' => array(
				'use' => 'y',
				'name' => '중문_1:1문의',
				'url' => '/cn/board/board_write?code=inquiry',
				'menu' => array(
					'1' => array(
						'use' => 'y',
						'name' => '목록페이지',
						'url' => '/cn/board/board_list?code=inquiry',

					),
				),
			),
			'2' => array(
				'use' => 'y',
				'name' => '중문_비디오',
				'url' => '/cn/board/board_list?code=video',

			),
			'5' => array(
				'use' => 'y',
				'name' => '중) 대메뉴',
				'url' => '/cn/board/board_list?code=add',
				'menu' => array(
					'1' => array(
						'use' => 'y',
						'name' => '중) 서브',
						'url' => '/cn/board/board_list?code=add',

					),
				),
			),
			'9' => array(
				'use' => 'y',
				'name' => '중_카테고리',
				'url' => '/cn/goods/goods_list?cate=001',

			),
			'10' => array(
				'use' => 'y',
				'name' => '중_개별',
				'url' => '/cn/company/about',
				'menu' => array(
					'1' => array(
						'use' => 'y',
						'name' => '중_회사소개',
						'url' => '/cn/company/about',

					),
					'2' => array(
						'use' => 'y',
						'name' => '중_연혁',
						'url' => '/cn/company/history',

					),
					'3' => array(
						'use' => 'y',
						'name' => '중_오는길',
						'url' => '/cn/company/location',

					),
					'4' => array(
						'use' => 'y',
						'name' => '중_추가페이지1',
						'url' => '/cn/test/test1',

					),
					'5' => array(
						'use' => 'y',
						'name' => '중_추가페이지2',
						'url' => '/cn/test/test2',

					),
					'6' => array(
						'use' => 'y',
						'name' => '중_추가페이지3',
						'url' => '/cn/test/test3',

					),
				),
			),
			'12' => array(
				'use' => 'y',
				'name' => '중_추가필드',
				'url' => '/cn/board/board_list?code=add',
				'menu' => array(
					'1' => array(
						'use' => 'y',
						'name' => '0320 중문3-2',
						'url' => '/cn/board/board_list?code=notice',

					),
				),
			),
			'13' => array(
				'use' => 'y',
				'name' => '테스트',
				'url' => '/cn/board/board_list?code=testtesttest',

			),

		),
		'eng' => array(
			'0' => array(
				'use' => 'y',
				'name' => 'Gallery',
				'url' => '/en/board/board_list?code=gallery',
				'sort' => '0',

			),
			'1' => array(
				'use' => 'y',
				'name' => 'Video',
				'url' => '/en/board/board_list?code=video',

			),
			'2' => array(
				'use' => 'y',
				'name' => 'Notice',
				'url' => '/en/board/board_list?code=notice',

			),
			'3' => array(
				'use' => 'y',
				'name' => 'Category',
				'url' => '/en/goods/goods_list?cate=001',

			),
			'4' => array(
				'use' => 'y',
				'name' => 'About',
				'url' => '/en/page?no=10',
				'menu' => array(
					'1' => array(
						'use' => 'y',
						'name' => '개별',
						'url' => '/en/company/about',

					),
					'2' => array(
						'use' => 'y',
						'name' => '연혁',
						'url' => '/en/company/history',

					),
					'3' => array(
						'use' => 'y',
						'name' => '오시는길',
						'url' => '/en/page?no=10',

					),
				),
			),

		),
		'jpn' => array(
			'0' => array(
				'use' => 'y',
				'name' => '일_갤러리',
				'url' => '/jp/board/board_list?code=gallery',
				'sort' => '0',

			),
			'1' => array(
				'use' => 'y',
				'name' => '일문_1:1문의',
				'url' => '/jp/board/board_write?code=inquiry',
				'menu' => array(
					'2' => array(
						'use' => 'n',
						'name' => '목록페이지',
						'url' => '/jp/board/board_list?code=inquiry',

					),
				),
			),
			'2' => array(
				'use' => 'y',
				'name' => '일문_비디오',
				'url' => '/jp/board/board_list?code=video',

			),
			'3' => array(
				'use' => 'y',
				'name' => '일문_추가',
				'url' => '/jp/board/board_list?code=add',
				'menu' => array(
					'1' => array(
						'use' => 'y',
						'name' => '일문_공지사항',
						'url' => '/jp/board/board_list?code=notice',

					),
				),
			),
			'4' => array(
				'use' => 'y',
				'name' => '일문_카테고리',
				'url' => '/jp/goods/goods_list?cate=001',

			),
			'5' => array(
				'use' => 'y',
				'name' => '일문_개별페이지',
				'url' => '/jp/company/about',
				'menu' => array(
					'1' => array(
						'use' => 'y',
						'name' => '회사소개',
						'url' => '/jp/company/about',

					),
					'2' => array(
						'use' => 'y',
						'name' => '오시는길',
						'url' => '/jp/company/location',

					),
					'3' => array(
						'use' => 'y',
						'name' => '연혁',
						'url' => '/jp/company/history',

					),
				),
			),
			'7' => array(
				'use' => 'y',
				'name' => '일) 대메뉴',
				'url' => '/jp/goods/goods_list?cate=001',

			),
			'8' => array(
				'use' => 'y',
				'name' => '테스트',
				'url' => '/jp/board/board_list?code=testtesttest',

			),

		),
		'kor' => array(
			'0' => array(
				'use' => 'y',
				'name' => '기업소개',
				'url' => '/page?no=1',
				'sort' => '0',
				'menu' => array(
					'1' => array(
						'use' => 'y',
						'name' => '기업소개',
						'url' => '/page?no=1',

					),
					'2' => array(
						'use' => 'y',
						'name' => '수상',
						'url' => '/board/board_list?code=patent',

					),
					'3' => array(
						'use' => 'y',
						'name' => '인증',
						'url' => '/board/board_list?code=cert',

					),
				),
			),
			'1' => array(
				'use' => 'y',
				'name' => '솔루션',
				'url' => '/page?no=2',
				'menu' => array(
					'1' => array(
						'use' => 'y',
						'name' => 'Deep-Coding',
						'url' => '/page?no=2',

					),
					'2' => array(
						'use' => 'y',
						'name' => 'Data-Swapjack',
						'url' => '/page?no=3',

					),
					'3' => array(
						'use' => 'y',
						'name' => 'Ridentify',
						'url' => '/page?no=4',

					),
					'4' => array(
						'use' => 'y',
						'name' => 'DeterOS',
						'url' => '/page?no=5',

					),
					'5' => array(
						'use' => 'y',
						'name' => 'Aegis',
						'url' => '/page?no=6',

					),
					'6' => array(
						'use' => 'y',
						'name' => 'DeepScan',
						'url' => '/page?no=7',

					),
				),
			),
			'2' => array(
				'use' => 'y',
				'name' => '고객지원',
				'url' => '/board/board_list?code=qna',
				'menu' => array(
					'1' => array(
						'use' => 'y',
						'name' => '자주 묻는 질문',
						'url' => '/board/board_list?code=qna',

					),
					'2' => array(
						'use' => 'y',
						'name' => '피해 지원 캠페인',
						'url' => '/board/board_list?code=campaign',

					),
					'3' => array(
						'use' => 'y',
						'name' => '실시간 문의',
						'url' => '/board/board_list?code=inquiry',

					),
					'4' => array(
						'use' => 'y',
						'name' => '해결 후기',
						'url' => '/board/board_list?code=review',

					),
				),
			),
			'3' => array(
				'use' => 'y',
				'name' => '콘텐츠룸',
				'url' => '/board/board_list?code=content',
				'menu' => array(
					'1' => array(
						'use' => 'n',
						'name' => '소식',
						'url' => '/board/board_list?code=content&category=소식',

					),
					'2' => array(
						'use' => 'n',
						'name' => '이벤트',
						'url' => '/board/board_list?code=content&category=이벤트',

					),
					'3' => array(
						'use' => 'n',
						'name' => '리포트',
						'url' => '/board/board_list?code=content&category=리포트',

					),
					'4' => array(
						'use' => 'n',
						'name' => '인터뷰',
						'url' => '/board/board_list?code=content&category=인터뷰',

					),
					'5' => array(
						'use' => 'n',
						'name' => '칼럼',
						'url' => '/board/board_list?code=content&category=칼럼',

					),
				),
			),
			'4' => array(
				'use' => 'y',
				'name' => '매거진',
				'url' => 'https://blog.arklink.co.kr/',

			),

		),
	),
);