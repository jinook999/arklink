<?php
if(in_array($board_info['code'], ['diagnosis']) === true) {
	include_once 'view_'.$board_info['code'].'.php';
} else {
	include_once 'view.php';
}