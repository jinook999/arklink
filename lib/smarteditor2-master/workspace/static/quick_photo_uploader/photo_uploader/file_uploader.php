<?/* include "../../../../cms/common.php";*/


if ($_SERVER['CONTENT_LENGTH'] && !$_FILES && !$_POST) {
    // PHP 최대 허용 용량을 초과하면 글로벌변수 FILES에서 에러검출이 불가능합니다. 다른 방식으로 검사 후 에러 메시지 출력.
    echo '<script>alert("서버 업로드 허용 용량을 초과했습니다.");</script>';
    exit;
}

// default redirection
$url = 'callback.html?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if($bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];

	$filename_ext = strtolower(array_pop(explode('.',$name)));
	$allow_file = array("jpg", "png", "bmp", "gif");

	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$name;
	} else {
		$folder = "/etc";
		if($_REQUEST["folder"]) {
			$folder = "/". $_REQUEST["folder"];
		}
		$uploadDir = $_SERVER['DOCUMENT_ROOT'] ."/upload/smarteditor". $folder;
		$check = '';
		foreach(explode("/", $uploadDir) as $path){
			$check .= "/".$path;
			if(!is_dir($check)){
				@mkdir($check, 0777);
			}
		}

		$file_name = date('YmdHis').'_'.mt_rand(1000 ,9999) .".". $filename_ext;
		$newPath = $uploadDir ."/". urlencode($file_name);

		@move_uploaded_file($tmp_name, $newPath);

		$url .= "&bNewLine=true";
		$url .= "&sFileName=".urlencode(urlencode($file_name));
		$url .= "&sFileURL=http://". $_SERVER["HTTP_HOST"] ."/upload/smarteditor". $folder ."/". urlencode(urlencode($file_name));
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}

header('Location: '. $url);
?>