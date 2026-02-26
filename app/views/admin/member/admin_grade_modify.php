<tr>
	<th scope="col">레벨</th>
	<td>
		<input type="hidden" name="level" value="<?=$member_grade_view['level']?>">
		<?=$member_grade_view['level']?>
	</td>
	<th scope="col">등급명</th>
	<td><input type="text" name="gradenm" style="width: 100%;" placeholder="관리자 등급 명칭 기입" value="<?=$member_grade_view['gradenm']?>" /></td>
	<th scope="col">로그인 후 이동할 메뉴</th>
	<td>
	<?php
	if($member_grade_view['codes']) :
		$codes = explode('|', $allowed['codes']);
		if($this->input->get('level', true) > 0) :
			echo '<select name="redirect" id="redirect" style="width: 100%;"><option value="main">메인(기본)</option>';
			foreach($menus as $key => $value) :
				if(!in_array($value['code'], $codes)) continue;
				if(strlen($value['code']) == 4) :
					echo '<option value="" disabled>'.$value['name'].'</option>';
					if($value['segment1'] == 'board') :
						foreach($board as $key => $value) :
							$selected = strpos($member_grade_view['redirect'], $value['code']) > -1 ? ' selected' : '';
							echo '<option value="board/board_list?code='.$value['code'].'"'.$selected.'>&nbsp;&nbsp;'.$value['name'].'</option>';
						endforeach;
					endif;
				endif;
				if(strlen($value['code']) == 6) :
					if($value['segment2'] === 'board_list') continue;
					$selected = $member_grade_view['redirect'] == $value['segment1']."/".$value['segment2'] ? " selected" : "";
					echo '<option value="'.$value['segment1'].'/'.$value['segment2'].'"'.$selected.'>&nbsp;&nbsp;'.$value['name'].'</option>';
				endif;
			endforeach;
			echo '</select>';
		else :
			echo '<input type="hidden" name="recirect" value="main">';
		endif;
	else :
		echo '접근 권한을 먼저 설정해 주세요.';
	endif;
	?>
	</td>
</tr>
<tr>
	<th style="vertical-align:top;padding-top:16px;">접근 권한 설정</th>
	<td colspan="5">
		<ul class="adm_power">
		<?php
		if(count($allowed_menus) > 0) :
			$current_level = explode('|', $allowed['codes']);
			$menus = [];

			foreach($allowed_menus as $key => $value) :
				if(strlen($value['code']) === 2) $menus['first'][] = $value;
				if(strlen($value['code']) === 4) $menus[substr($value['code'], 0, 2)][] = $value;
				if(strlen($value['code']) === 6) $menus[substr($value['code'], 0, 4)][] = $value;
			endforeach;

			foreach($menus['first'] as $k1 => $v1) :
				if(in_array($v1['code'], $admins_menus)) :
		?>
			<li>
				<dl>
					<dt>
						<label>
							<input type="checkbox" name="code[]" value="<?=$v1['code']?>"<?=in_array($v1['code'], $current_level) ? ' checked' : ''?>><?=$v1['name']?>
						</label>
					</dt>
					<dd>
						<ul>
						<?php
						foreach($menus[$v1['code']] as $k2 => $v2) :
							$checked2 = in_array($v2['code'], $current_level) ? ' checked' : '';
							echo '<li class="second-group"><label><input type="checkbox" name="code[]" class="s-input" value="'.$v2['code'].'"'.$checked2.'>'.$v2['name'].'</label>';
							echo '<ul>';
							foreach($menus[$v2['code']] as $k3 => $v3) :
								$checked3 = in_array($v3['code'], $current_level) ? ' checked' : '';
								echo '<li><label><input type="checkbox" name="code[]" class="t-input" value="'.$v3['code'].'"'.$checked3.'>'.$v3['name'].'</label></li>';
							endforeach;
							echo '</ul></li>';
						endforeach;
						?>
						</ul>
					</dd>
				</dl>
			</li>
		<?php
				endif;
			endforeach;
		else :
			echo '<a href="set_menu_auth?level='.$member_grade_view['level'].'" id="setMenu">현재 레벨의 접근 권한을 설정해 주세요.</a>';
		endif;
		?>
		</ul>
	</td>
</tr>