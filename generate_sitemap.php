<?php
/**
 * Sitemap 생성 스크립트
 * 이 파일을 직접 실행하거나 크론잡으로 실행하여 sitemap.xml을 업데이트합니다.
 * 
 * 실행 방법:
 * 1. 브라우저: https://www.arklink.co.kr/generate_sitemap.php
 * 2. CLI: php generate_sitemap.php
 * 3. 크론잡: 0 0 * * * /usr/bin/php /path/to/generate_sitemap.php
 */

// CodeIgniter 환경 로드
define('BASEPATH', __DIR__ . '/system/');
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['SCRIPT_NAME'] = '/index.php';

require_once __DIR__ . '/index.php';

$CI =& get_instance();
$CI->load->database();

// Sitemap 시작
$sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

$base_url = 'https://www.arklink.co.kr';

// 메인 페이지
$sitemap .= add_url($base_url . '/', date('Y-m-d'), 'daily', '1.0');

// 게시판 목록
try {
	$query = $CI->db->query("SELECT code, name FROM da_board_manage WHERE adminview = 'y' AND yn_display_list = 'y'");
	$boards = $query->result_array();
	
	// 색인에서 제외할 게시판 코드
	$excluded_boards = ['diagnosis', 'download', 'gallery', 'notice'];
	
	foreach($boards as $board) {
		// 제외 목록에 있는 게시판은 건너뛰기
		if(in_array($board['code'], $excluded_boards)) {
			continue;
		}
		
		// 게시판 리스트 페이지
		$sitemap .= add_url(
			$base_url . '/board/board_list?code=' . $board['code'],
			date('Y-m-d'),
			'daily',
			'0.8'
		);
		
		// 게시판 글 목록
		$table_name = 'da_board_' . $board['code'];
		
		if($CI->db->table_exists($table_name)) {
			try {
				$query2 = $CI->db->query("
					SELECT no, regdt, updatedt 
					FROM {$table_name} 
					WHERE (is_secret != 'y' OR is_secret IS NULL)
					ORDER BY regdt DESC 
					LIMIT 100
				");
				$posts = $query2->result_array();
				
				foreach($posts as $post) {
					$lastmod = !empty($post['updatedt']) ? $post['updatedt'] : $post['regdt'];
					$sitemap .= add_url(
						$base_url . '/board/board_view?code=' . $board['code'] . '&no=' . $post['no'],
						date('Y-m-d', strtotime($lastmod)),
						'weekly',
						'0.6'
					);
				}
			} catch(Exception $e) {
				// 테이블 에러 무시
			}
		}
	}
} catch(Exception $e) {
	echo "Error: " . $e->getMessage() . "\n";
}

$sitemap .= '</urlset>';

// sitemap.xml 파일로 저장
$result = file_put_contents(__DIR__ . '/sitemap.xml', $sitemap);

if($result !== false) {
	echo "✅ Sitemap 생성 완료!\n";
	echo "파일 위치: " . __DIR__ . "/sitemap.xml\n";
	echo "URL: https://www.arklink.co.kr/sitemap.xml\n";
	echo "생성된 URL 개수: " . substr_count($sitemap, '<url>') . "개\n";
} else {
	echo "❌ Sitemap 생성 실패!\n";
	echo "파일 권한을 확인하세요.\n";
}

function add_url($loc, $lastmod, $changefreq, $priority) {
	$url = "\t<url>\n";
	$url .= "\t\t<loc>" . htmlspecialchars($loc) . "</loc>\n";
	$url .= "\t\t<lastmod>" . $lastmod . "</lastmod>\n";
	$url .= "\t\t<changefreq>" . $changefreq . "</changefreq>\n";
	$url .= "\t\t<priority>" . $priority . "</priority>\n";
	$url .= "\t</url>\n";
	return $url;
}
