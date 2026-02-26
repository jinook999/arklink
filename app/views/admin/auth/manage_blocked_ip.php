<style>
.center { text-align: center; }
.block-ip { color: #f00; }
.paging { width: 500px; }
.ip-list { overflow-y: scroll; }
.ip-list li { padding: 5px; }
.ip-list li:nth-child(odd) { background: #f1f1f1; }
.btn-submit { background: #9b9b9b; color: #fff; padding: 3px 10px; font-size: 12px; border-radius: 3px; vertical-align: top; }
.btn-remove { background: #ff6565; color: #fff; padding: 2px 6px; font-size: 10px !important; border-radius: 3px; }
.ml5 { margin-left: 5px; }
.w1200 { width: 1200px; }
.reg { padding: 6px 10px; vertical-align: middle; margin-left: 4px; }
#admin-accessible-ip, #client-blocked-ip { height: 30px; border: 1px solid #ccc; }
#ip-list li strong::after { content: " "; width: 20px; display: inline-block; }
.red { color: #f00; }
</style>
<script>
$(function() {
	$(".block-ip").on("click", function(e) {
		e.preventDefault();
		if(confirm("해당 아이피를 차단하시겠습니까?")) {
		}
	});

	$("#client-blocked-ip").on("input", function() {
		const numbers = $(this).val().replace(/[^0-9.]/g, "");
		$(this).val(numbers);
	});

	$(".btn-remove").on("click", function(e) {
		e.preventDefault();
		const link = $(this).attr("href");
		if(confirm("삭제하시겠습니까?")) {
			$(location).attr("href", link);
		}
	});

	$(".btn-submit").on("click", function() {
		/*
		const id = $(this).data("id");
		const v = $(`#${id}`).val();
		const table = $(this).data("table");
		let temp;
		if(table === "da_manage") {
			const vv = $(`#${id}`).is(":checked") === true ? "y" : "n";
			if(id === "use-block-login") {
				const cnt = $("#block-login-count").val()
				if($("#use-block-login").is(":checked") === true && (cnt < 1)) {
					alert("횟수를 지정해 주세요.");
					return false;
				}
				temp = `<input type="text" name="use_block_login" value="${vv}"><input type="text" name="block_login_count" value="${cnt}">`;
			}
			if(id === "use-allow-admin") temp = ``;
			if(id === "use-block-user") temp = ``;
		}
		if(table === "da_ip_allowed_admin") temp = `<input type="hidden" name="ip" value="${v}">`;
		if(table === "da_ip_blocked") temp = `<input type="text" name="ip" value="${v}">`;
		temp += ``;

		$("#t-form").append(temp).submit();
		*/
	});
});
</script>
<div id="contents">
	<div class="main_tit">
		<h2>사용자 페이지 아이피 차단 관리</h2>
	</div>

	<div class="standard_wrap" style="margin-top: 0;">
		<div class="sub_tit"><h3>사용자 페이지 차단된 아이피</h3></div>
		<div class="table_write_info">* 등록된 아이피의 경우 강제로 404 페이지로 리다이렉션 됩니다.</div>
		<div class="standard_box">
			<form id="t-form" action="manage_access_update" method="post">
				<input type="hidden" name="page" value="manage_blocked_ip">
				<input type="checkbox" name="use_client_blocked_ip" id="use-client-blocked-ip" value="y"<?=$manage['use_client_blocked_ip'] === 'y' ? ' checked' : ''?>>
				<label class="standard_msg" for="use-client-blocked-ip">사용자 아이피 차단 사용</label>
				<button class="btn-submit">적용</button>
			</form>

			<?php
			if($manage['use_client_blocked_ip'] === 'y') :
			?>
			<div class="standard_wrap" style="margin: 30px 0 10px;">
				<form action="insert_client_blocked_ip" method="post" autocomplete="off">
					<input type="text" name="ip" id="client-blocked-ip" value="" maxlength="15" required>
					<button class="btn-submit reg">등록</button>
				</form>
			</div>
			<div class="table_write">
				<table cellpadding="0" cellspacing="0" border="0" style="width: 500px;">
					<colgroup>
						<col style="width: 70px;">
						<col style="width: 150px;">
						<col style="width: 150px;">
					</colgroup>
					<thead>
						<tr>
							<th scope="col">-</th>
							<th scope="col">아이피</th>
							<th scope="col">등록일</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if(count($client) > 0) :
						foreach($client as $value) :
					?>
						<tr>
							<td class="center"><a href="remove_ip?no=<?=$value['no']?>&table=ip_allowed_admin" class="btn-remove">삭제</a></td>
							<td class="center"><?=$value['ip']?></td>
							<td class="center"><?=$value['regdate']?></td>
						</tr>
					<?php
						endforeach;
					else :
						echo '<tr><td colspan="4" class="center">등록된 아이피가 없습니다.</td></tr>';
					endif;
					?>
					</tbody>
				</table>
			</div>
			<?php
			endif;
			?>
		</div>
	</div>
</div>