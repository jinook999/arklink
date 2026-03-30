<?/* include "../../../../cms/common.php";*/


if ($_SERVER['CONTENT_LENGTH'] && !$_FILES && !$_POST) {
    // PHP 최대 허용 용량을 초과하면 글로벌변수 FILES에서 에러검출이 불가능합니다. 다른 방식으로 검사 후 에러 메시지 출력.
    echo '<script>alert("서버 업로드 허용 용량을 초과했습니다.");</script>';
    exit;
}

// default redirection
$url = 'callback.html?callback_func='.$_REQUEST["callback_func"];

// 파일 업로드 에러 체크
if (!isset($_FILES['Filedata']) || $_FILES['Filedata']['error'] !== UPLOAD_ERR_OK) {
	$errCode = isset($_FILES['Filedata']) ? $_FILES['Filedata']['error'] : -1;
	$errMsgs = array(
		-1 => '파일이 전송되지 않았습니다.',
		UPLOAD_ERR_INI_SIZE => '서버 허용 용량을 초과했습니다 (upload_max_filesize).',
		UPLOAD_ERR_FORM_SIZE => '폼 허용 용량을 초과했습니다.',
		UPLOAD_ERR_PARTIAL => '파일이 일부만 업로드되었습니다.',
		UPLOAD_ERR_NO_FILE => '파일이 선택되지 않았습니다.',
		UPLOAD_ERR_NO_TMP_DIR => '서버 임시 폴더가 없습니다.',
		UPLOAD_ERR_CANT_WRITE => '서버 디스크 쓰기 실패.',
		UPLOAD_ERR_EXTENSION => 'PHP 확장에 의해 업로드가 중단되었습니다.'
	);
	$errMsg = isset($errMsgs[$errCode]) ? $errMsgs[$errCode] : '알 수 없는 오류 (code:'.$errCode.')';
	$url .= '&errstr='.urlencode($errMsg);
	header('Location: '. $url);
	exit;
}

$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if($bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];

	$parts = explode('.', $name);
	$filename_ext = strtolower(array_pop($parts));
	$allow_file = array("jpg", "jpeg", "png", "bmp", "gif");

	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.urlencode('허용되지 않는 파일 형식입니다: '.$name);
	} else {
		$folder = "/etc";
		if($_REQUEST["folder"]) {
			$folder = "/". $_REQUEST["folder"];
		}
		$uploadDir = $_SERVER['DOCUMENT_ROOT'] ."/upload/smarteditor". $folder;
		if(!is_dir($uploadDir)){
			@mkdir($uploadDir, 0777, true);
		}

		$file_name = date('YmdHis').'_'.mt_rand(1000 ,9999) .".". $filename_ext;
		$newPath = $uploadDir ."/". urlencode($file_name);

		if(!@move_uploaded_file($tmp_name, $newPath)){
			$url .= '&errstr='.urlencode('파일 저장 실패. 업로드 폴더 권한을 확인해주세요.');
		} else {
			$url .= "&bNewLine=true";
			$url .= "&sFileName=".urlencode(urlencode($file_name));
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
			$url .= "&sFileURL=".$protocol."://". $_SERVER["HTTP_HOST"] ."/upload/smarteditor". $folder ."/". urlencode(urlencode($file_name));
		}
	}
}
// FAILED
else {
	$url .= '&errstr='.urlencode('파일 업로드 검증 실패.');
}

header('Location: '. $url);
?>
