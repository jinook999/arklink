<div id="header">
	<div class="header_cont">
		<div class="hd_top">
			<div class="hd_top_box">
				<h1 class="logo"><a href="/admin/main"><em><?=$this->_cfg_site["kor"]["nameKor"]?></em></a></h1>
				<dl>
					<dd><a href="<?=base_url()?>" target="_blank" class="gohome"><img src="/lib/admin/images/icon_home.png" alt="홈페이지"></a><span><?=$this->_admin_member["name"]?>(<?=$this->_admin_member['userid']?>)</span>님</dd>
					<dd><a href="/admin/logout">로그아웃</a></dd>
				</dl>
			</div>
		</div>
		<div class="nav">
			<ul>
			<?php
			$menu1 = explode('|', $this->_admin_member['menu1']);
			$menu2 = explode('|', $this->_admin_member['menu2']);
			foreach($this->_adm_menu as $key => $value) :
				$current_active_menu = $this->uri->rsegments[1] === $key ? ' class="active"' : '';
				if($this->_admin_member['userid'] !== 'superman') :
					$first = '';
					foreach($this->_adm_menu[$key]['low_menu'] as $menu) :
						if(in_array($menu['segment'], $menu2) === true) :
							$first = $menu['segment'];
							break;
						endif;
					endforeach;
					if(in_array($key, $menu1) === true) :
						echo '<li'.$current_active_menu.'><a href="/admin/'.$key.'/'.$first.'" class="admin-menu-tl">'.$value['name'].'</a></li>';
					endif;
				else :
					echo '<li'.$current_active_menu.'><a href="/admin/'.$key.'/'.$value['default'].'" class="admin-menu-tl">'.$value['name'].'</a></li>';
				endif;
			endforeach;
			?>
			</ul>
		</div>
	</div><!--header_cont-->
</div><!--header-->
<?php
foreach($this->_adm_menu['member']['low_menu'] as $menu) :
	//debug($menu);
endforeach;