<? /*include "../../../../cms/common.php";*/
 	$sFileInfo = '';
	$headers = array();

	foreach($_SERVER as $k => $v) {
		if(substr($k, 0, 9) == "HTTP_FILE") {
			$k = substr(strtolower($k), 5);
			$headers[$k] = $v;
		}
	}

	$filename = rawurldecode($headers['file_name']);
	$filename_ext = strtolower(array_pop(explode('.',$filename)));
	$allow_file = array("jpg", "png", "bmp", "gif");

	if(!in_array($filename_ext, $allow_file)) {
		echo "NOTALLOW_".$filename;
	} else {
		$file = new stdClass;
		$file->name = date("YmdHis").mt_rand().".".$filename_ext;
		$file->content = file_get_contents("php://input");
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

		$newPath = $uploadDir ."/". $file->name;

		if(file_put_contents($newPath, $file->content)) {
			$sFileInfo .= "&bNewLine=true";
			$sFileInfo .= "&sFileName=".$filename;
			$sFileInfo .= "&sFileURL=http://". $_SERVER["HTTP_HOST"] ."/upload/smarteditor". $folder ."/". $file->name;
		}

		echo $sFileInfo;
	}
?>