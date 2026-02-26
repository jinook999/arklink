<?php 
if(in_array($this->_board['code'], ['campaign', 'content'])) {
	include_once 'date_list.php';
} else {
	include_once 'list.php';
}