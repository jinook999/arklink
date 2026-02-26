<?php
/**
 * 서버 환경 확인 스크립트
 * 브라우저에서 실행: https://www.arklink.co.kr/check_server.php
 */

echo "<h1>🔍 서버 환경 정보</h1>";
echo "<style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    table { border-collapse: collapse; width: 100%; max-width: 800px; }
    th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
    th { background-color: #4CAF50; color: white; }
    tr:nth-child(even) { background-color: #f2f2f2; }
    .success { color: green; font-weight: bold; }
    .warning { color: orange; font-weight: bold; }
    .error { color: red; font-weight: bold; }
    .code { background: #f4f4f4; padding: 10px; border-radius: 5px; margin: 10px 0; }
</style>";

echo "<h2>1. 기본 정보</h2>";
echo "<table>";
echo "<tr><th>항목</th><th>값</th></tr>";

// PHP 버전
echo "<tr><td>PHP 버전</td><td>" . phpversion() . "</td></tr>";

// 서버 소프트웨어
echo "<tr><td>서버 소프트웨어</td><td>" . $_SERVER['SERVER_SOFTWARE'] . "</td></tr>";

// 운영체제
echo "<tr><td>운영체제</td><td>" . PHP_OS . "</td></tr>";

// 서버 관리자
echo "<tr><td>서버 관리자</td><td>" . $_SERVER['SERVER_ADMIN'] . "</td></tr>";

// 문서 루트
echo "<tr><td>문서 루트</td><td>" . $_SERVER['DOCUMENT_ROOT'] . "</td></tr>";

// 현재 스크립트 경로
echo "<tr><td>현재 파일 경로</td><td>" . __FILE__ . "</td></tr>";

echo "</table>";

// PHP CLI 경로 찾기
echo "<h2>2. PHP CLI 경로</h2>";
$php_paths = [
    '/usr/bin/php',
    '/usr/local/bin/php',
    '/opt/php/bin/php',
    '/usr/bin/php7',
    '/usr/bin/php8',
];

echo "<table>";
echo "<tr><th>경로</th><th>상태</th></tr>";
foreach($php_paths as $path) {
    $exists = file_exists($path);
    $status = $exists ? '<span class="success">✅ 존재</span>' : '<span class="error">❌ 없음</span>';
    echo "<tr><td>{$path}</td><td>{$status}</td></tr>";
}
echo "</table>";

// which php 명령어 실행 (가능한 경우)
if(function_exists('shell_exec') && !in_array('shell_exec', explode(',', ini_get('disable_functions')))) {
    echo "<h3>which php 결과:</h3>";
    $which_php = shell_exec('which php 2>&1');
    echo "<div class='code'>" . htmlspecialchars($which_php) . "</div>";
}

// 크론 설정 가능 여부
echo "<h2>3. 크론잡 설정 방법</h2>";

$has_cpanel = file_exists('/usr/local/cpanel/version');
$has_plesk = file_exists('/usr/local/psa/version');
$has_directadmin = file_exists('/usr/local/directadmin/conf/directadmin.conf');

echo "<table>";
echo "<tr><th>제어판</th><th>상태</th></tr>";
echo "<tr><td>cPanel</td><td>" . ($has_cpanel ? '<span class="success">✅ 설치됨</span>' : '<span class="warning">❌ 없음</span>') . "</td></tr>";
echo "<tr><td>Plesk</td><td>" . ($has_plesk ? '<span class="success">✅ 설치됨</span>' : '<span class="warning">❌ 없음</span>') . "</td></tr>";
echo "<tr><td>DirectAdmin</td><td>" . ($has_directadmin ? '<span class="success">✅ 설치됨</span>' : '<span class="warning">❌ 없음</span>') . "</td></tr>";
echo "</table>";

// 권한 확인
echo "<h2>4. 파일 권한</h2>";
$files_to_check = [
    'cron_sitemap.php',
    'generate_sitemap.php',
    'sitemap.xml'
];

echo "<table>";
echo "<tr><th>파일</th><th>존재</th><th>권한</th><th>쓰기 가능</th></tr>";
foreach($files_to_check as $file) {
    $filepath = __DIR__ . '/' . $file;
    $exists = file_exists($filepath);
    $perms = $exists ? substr(sprintf('%o', fileperms($filepath)), -4) : 'N/A';
    $writable = $exists ? (is_writable($filepath) ? '✅' : '❌') : 'N/A';
    $exists_text = $exists ? '✅' : '❌';
    
    echo "<tr><td>{$file}</td><td>{$exists_text}</td><td>{$perms}</td><td>{$writable}</td></tr>";
}
echo "</table>";

// 추천 설정 방법
echo "<h2>5. 추천 크론잡 설정 방법</h2>";

if($has_cpanel) {
    echo "<div class='code'>";
    echo "<strong>✅ cPanel 사용 가능</strong><br>";
    echo "cPanel → Cron Jobs 메뉴에서 설정하세요.";
    echo "</div>";
} elseif($has_plesk) {
    echo "<div class='code'>";
    echo "<strong>✅ Plesk 사용 가능</strong><br>";
    echo "Plesk → 도구 및 설정 → 예약된 작업에서 설정하세요.";
    echo "</div>";
} elseif($has_directadmin) {
    echo "<div class='code'>";
    echo "<strong>✅ DirectAdmin 사용 가능</strong><br>";
    echo "DirectAdmin → 고급 기능 → Cron Jobs에서 설정하세요.";
    echo "</div>";
} else {
    echo "<div class='code'>";
    echo "<strong>⚠️ 제어판이 감지되지 않았습니다.</strong><br><br>";
    echo "<strong>다음 방법 중 하나를 사용하세요:</strong><br><br>";
    
    echo "<strong>방법 1: SSH 접속 (권장)</strong><br>";
    echo "1. SSH로 서버 접속<br>";
    echo "2. <code>crontab -e</code> 명령어 실행<br>";
    echo "3. 다음 줄 추가:<br>";
    echo "<code>0 2 * * * /usr/bin/php " . __DIR__ . "/cron_sitemap.php</code><br><br>";
    
    echo "<strong>방법 2: 호스팅 업체 문의</strong><br>";
    echo "호스팅 업체에 크론잡 설정을 요청하세요.<br><br>";
    
    echo "<strong>방법 3: 외부 크론 서비스 사용</strong><br>";
    echo "- EasyCron (https://www.easycron.com/)<br>";
    echo "- cron-job.org (https://cron-job.org/)<br>";
    echo "URL: https://www.arklink.co.kr/generate_sitemap.php<br>";
    echo "</div>";
}

// 테스트 실행
echo "<h2>6. 즉시 테스트</h2>";
echo "<div class='code'>";
echo "<a href='generate_sitemap.php' target='_blank' style='background: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Sitemap 생성 테스트</a>";
echo "</div>";

// 호스팅 업체 정보
echo "<h2>7. 호스팅 업체 확인</h2>";
$server_name = $_SERVER['SERVER_NAME'];
$server_ip = $_SERVER['SERVER_ADDR'] ?? gethostbyname($server_name);

echo "<table>";
echo "<tr><th>항목</th><th>값</th></tr>";
echo "<tr><td>도메인</td><td>{$server_name}</td></tr>";
echo "<tr><td>서버 IP</td><td>{$server_ip}</td></tr>";
echo "</table>";

echo "<p><strong>💡 팁:</strong> 호스팅 업체를 모르시면 위 IP 주소로 검색하거나, 호스팅 계약서를 확인하세요.</p>";

?>
