<div id="leftmenu">
<?php
$r1 = $this->uri->rsegments[1];
$r2 = $this->uri->rsegments[2];
$m1 = explode('|', $this->_admin_member['menu1']);
$m2 = explode('|', $this->_admin_member['menu2']);

include_once __DIR__.'/left/'.$r1.'.php';
/*
if(file_exists(__DIR__.'/left/'.$r1.'.php')) :
else :
	echo '<ul class="second-menu">';
	foreach($menus as $key => $value) :
		if($key === 'first') :
			foreach($value as $kk => $vv) :
				echo '<li class="on" data-code="'.$vv['code'].'"><h3>'.$vv['name'].'</h3>';
				if(count($menus[$vv['code']]) > 0) :
					echo '<ul>';
					foreach($menus[$vv['code']] as $k => $v) :
						$active = $r2 === $v['segment2'] ? ' class="active"' : '';
						echo '<li'.$active.'><a href="/admin/'.$v['segment1'].'/'.$v['segment2'].'" class="admin-menu-tl" data-code="'.$v['code'].'"><em>'.$v['name'].'</em></a></li>';
					endforeach;
					echo '</ul>';
				endif;
				echo '</li>';
			endforeach;
		endif;
	endforeach;
	echo '</ul>';
endif;
*/
if($r1 == "main") :
?>
	<h2>관리자메인</h2>
	<ul class="left_main">
		<li>
			<ul>
			<?php
			if(in_array('02', $codes)) echo '<li><a href="/admin/policy/conf_reg"><em>기본 정책</em></a></li>';
            if(in_array('04', $codes)) echo '<li><a href="/admin/member/member_list"><em>회원 관리</em></a></li>';
			if(in_array('05', $codes)) echo '<li><a href="/admin/board/board_list"><em>게시판 관리</em></a></li>';
			if(in_array('08', $codes)) echo '<li><a href="/admin/advisor/analysis_all"><em>접속통계</em></a></li>';
			?>
			</ul>
		</li>
	</ul>
<?php
endif;
?>
</div>