<?php
$r1 = $this->uri->rsegments[1];
$r2 = $this->uri->rsegments[2];
$m1 = explode('|', $this->_admin_member['menu1']);
$m2 = explode('|', $this->_admin_member['menu2']);
include_once __DIR__.'/left/'.$r1.'.php';
?>
<div id="leftmenu">
	<h2><?=$this->_adm_menu[$r1]['name']?></h2>
	<ul>
	<?php
	if($r1 === 'board') {
		$allowed = explode('|', $this->boards['manage_admin']);
		$active = $r2 === 'board_all' ? ' class="active"' : '';
		echo '<li class="on"><h3>게시판</h3><ul>';
		foreach($this->boards as $value) :
			$active = $this->_board['code'] === $value['code'] ? ' class="active"' : '';
			echo '<li'.$active.'><a href="board_list?code='.$value['code'].'">'.$value['name'].'</a></li>';
		endforeach;
		echo '</ul></li>';
	} else if($r1 === 'member') {
		foreach($sub as $key => $value) :
			echo '<li class="on"><h3>'.$key.'</h3><ul>';
			foreach($value as $k => $v) :
				$active = in_array($r2, $v) === true ? ' class="active"' : '';
				if($k == "관리자 등급 관리" && $this->session->userdata['admin_member']['level'] < 99) continue;//관리자 등급 오픈 수정
				echo '<li'.$active.'><a href="'.$v[0].'">'.$k.'</a></li>';
			endforeach;
			echo '</ul></li>';
		endforeach;
	} else {
		foreach($sub as $key => $value) :
			echo '<li class="on"><h3>'.$key.'</h3><ul>';
			foreach($value as $k => $v) :
				$active = in_array($r2, $v) === true ? ' class="active"' : '';
				echo '<li'.$active.'><a href="'.$v[0].'">'.$k.'</a></li>';
			endforeach;
			echo '</ul></li>';
		endforeach;
	}
	?>
	</ul>
</div>