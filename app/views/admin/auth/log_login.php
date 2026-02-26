<style>
.center { text-align: center; }
.block-ip { color: #f00; }
.paging { width: 1000px; }
</style>
<script>
$(function() {
	$(".block-ip").on("click", function(e) {
		e.preventDefault();
		if(confirm("해당 아이피를 차단하시겠습니까?")) {
			$(location).attr("href", 
		}
	});
});
</script>
<div id="contents">
	<div class="main_tit">
		<h2>로그인 정보</h2>
	</div>

	<div class="standard_wrap" style="margin-top: 70px;">
		<div class="standard_box">
			<div>
				<input type="checkbox" id="use-block-login" value="y"<?=$manage['use_block_login'] === 'y' ? ' checked' : ''?>>
				<label class="standard_msg" for="use-block-login">일정 횟수 이상 로그인 시도할 경우 차단(사용자)</label>
				<select id="block-login-count" style="margin-left: 20px; vertical-align: top;">
					<option value="0">횟수</option>
					<?php
					foreach([3, 5] as $value) :
						$selected = (int)$manage['block_login_count'] === $value ? ' selected' : '';
						echo '<option value="'.$value.'"'.$selected.'>'.$value.'회</option>';
					endforeach;
					?>
				</select>
				<button class="btn-submit" data-id="use-block-login" data-table="da_manage">적용</button>
			</div>
		</div>
	</div>
	<div>- <strong class="red">일정 횟수 이상 로그인 시도할 경우 차단</strong> 사용을 할 경우 로그인 실패 시마다 카운트가 되며 정해진 횟수를 초과할 경우 로그인이 차단됩니다.</div>

	<div class="table_write">
		<table cellpadding="0" cellspacing="0" border="0" style="width: 1000px;">
			<colgroup>
				<col style="width: 70px;">
				<col style="width: 100px;">
				<col style="width: 150px;">
				<col style="width: 100px;">
				<col style="width: 70px;">
				<col style="width: ">
				<col style="width: 150px;">
				<col style="width: 150px;">
			</colgroup>
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">아이디</th>
					<th scope="col">시도한 패스워드</th>
					<th scope="col">접속 분류</th>
					<th scope="col">성공 여부</th>
					<th scope="col">메시지</th>
					<th scope="col">아이피</th>
					<th scope="col">날짜</th>
				</tr>
			</thead>
			<tbody id="divList">
			<?php
			foreach($list as $key => $value) :
				$no = count($all) - $offset - $key;
			?>
				<tr>
					<td class="center"><?=$no?></td>
					<td class="center"><?=$value['userid']?></td>
					<td class="center"><?=$value['password']?></td>
					<td class="center"><?=$value['page'] === 'admin' ? '관리자 페이지' : '사용자 페이지'?></td>
					<td class="center"><?=$value['is_success'] === 'y' ? '성공' : '실패'?></td>
					<td class="center"><?=$value['reason']?></td>
					<td class="center"><?=$value['ip']?><a href="block_ip?page=log_login&per_page=<?=$get['per_page']?>&ip=<?=$value['ip']?>" class="block-ip">[차단]</a></td>
					<td class="center"><?=$value['regdate']?></td>
				</tr>
			<?php
			endforeach;
			?>
			</tbody>
		</table>
	</div>
	<div class="paging"><?=$pagination?></div>
	<div class="terms_privecy_box">
		<ul>
			<li>- 시도한 패스워드의 경우는 로그인 실패 시에 입력했던 패스워드입니다. 로그인 성공 시엔 기록되지 않습니다.</li>
		</ul>
	</div>
</div>