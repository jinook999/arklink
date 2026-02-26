<script>
	function authDelete(form) {
		if(!confirm("삭제하시겠습니까?")) {
			return false;
		}

		form.submit();
	}

$(function() {
	$("#setMenu").on("click", function(e) {
		e.preventDefault();
		window.open($(this).attr("href"), "set menu", "width=800, height=800, scrollbars=yes");
	});

	$("a.btn-remove").on("click", function(e) {
		e.preventDefault();
		if(confirm("해당 등급을 삭제하시겠습니까?")) {
			$(location).attr("href", $(this).attr("href"));
		}
	});
});
</script>
<div id="contents">
	<div class="contents_wrap">
		<div class="main_tit">
			<h2>관리자 등급 리스트</h2>
			<div class="btn_right">
				<?php
				//if($this->_admin_member['userid'] === 'superman') echo '<a href="set_menu_auth" id="setMenu" class="btn point">권한 설정</a>';
				?>
				<a href="admin_grade_reg" class="btn point new_plus">관리자 등급 등록</a>
			</div>
		</div>
		<div class="table_write">
			<table cellpadding="0" cellspacing="0" border="0">
				<colgroup>
					<col width="7%" />
					<col width="10%" />
					<col width="*" />
					<col width="10%" />
					<col width="13%" />
					<col width="10%" />
					<col width="8%" />
				</colgroup>
				<thead>
					<tr>
						<th scope="col">번호</th>
						<th scope="col">레벨</th>
						<th scope="col">등급명</th>
						<th scope="col">인원수</th>
						<th scope="col">로그인 시 이동할 메뉴</th>
						<th scope="col">변경일</th>
						<th scope="col">관리</th>
					</tr>
				</thead>
				<tbody id="divList">
					<?php
					foreach($member_grade_list as $key => $value) :
						if($value['super']) :
							//if(!$this->session->__get('admin_member')['super']) continue;
						endif;
					?>
					<tr>
						<td align="center"><?//=count($member_grade_list) - $key?><?=$key + 1?></td>
						<td align="center"><?=$value['level']?></td>
						<td align="left"><?=$value['gradenm']?></td>
						<td align="center"><?=$value['cnt']?></td>
						<td align="center">
						<?php
						if($value['redirect']) :
							$tmp = explode('/', $value['redirect']);
							echo $tmp[0] === 'main' ? '메인' : $menus['1st'][$tmp[0]].' > '.$menus[$value['redirect']];
						endif;
						?>
						</td>
						<td align="center"><?=$value['moddt']?></td>
						<td>
							<a href="admin_grade_reg?level=<?=$value['level']?>" class="btn_mini on">관리</a>
							<?php
							if(($this->_admin_member['super'] || $this->_admin_member['level'] > $value['level']) && $value['level'] != 99) :
								echo '<a href="admin_grade_remove?level='.$value['level'].'" class="btn_mini btn-remove">삭제</a>';
							endif;
							?>
						</td>
					</tr>
					<? endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="terms_privecy_box dn">
			<dl>
				<dt> 관리자 등급 관리 유의사항</dt>
				<dd>
				관리자 최고 레벨인 99레벨 이상은 만들 수 없고, 99레벨은 삭제가 불가능한 등급입니다.<br><br>
				</dd>
			</dl>
		</div>
	</div>
</div>