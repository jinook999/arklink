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
.reg { padding: 7px 10px; vertical-align: bottom; margin-left: 4px; }
#admin-accessible-ip, #client-blocked-ip { height: 30px; border: 1px solid #ccc; }
#ip-list li strong::after { content: " "; width: 20px; display: inline-block; }
.red { color: #f00; }
#blocked-ip-list {}
#blocked-ip-list a { display: block; }
</style>
<script>
$(function() {
	$(".block-ip").on("click", function(e) {
		e.preventDefault();
		if(confirm("해당 아이피를 차단하시겠습니까?")) {
		}
	});

	$("#allow-ip, #block-ip-user").on("input", function() {
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

	$("#btn-admin-accessible-ip").on("click", function(e) {
		e.preventDefault();
		const ip = $("#admin-accessible-ip").val();
		let fl = true;
		$(".admin-ip").each(function() {
			if($(this).text() === ip) fl = false;
		});
		
		if(fl === false) {
			alert("이미 등록된 아이피입니다.");
			return false;
		}
		$("#admin-form").submit();
	});

	$("#btn-log-adminpage-access").on("click", function(e) {
		e.preventDefault();
		const link = $(this).attr("href");
		window.open(link, "admin_page_access", "width=800, height=900, scrollbars=no");
	});

	$("#btn-client-blocked-ip").on("click", function(e) {
		e.preventDefault();
		let fl = true;
		const ip = $("#client-blocked-ip").val();
		$.each($("#blocked-ip").val().split("|"), function(i, v) {
			if(v === ip) fl = false;
		});

		if(fl === false) {
			alert("이미 등록된 아이피입니다.");
			return false;
		}

		$("#client-ip-form").submit();
	});

	$(".remove-ip").on("click", function(e) {
		e.preventDefault();
		if(confirm("해당 아이피를 차단 해제하시겠습니까?")) {
			$(this).children("input.ip").val("");
			//$(this).closest("li").remove();
			$("#ip-list").submit();
		}
	});
});
</script>
<div id="contents">
	<div class="main_tit">
		<h2>관리자 페이지 접근 관리</h2>
	</div>
	<div class="standard_wrap" style="margin-top: 0;">
		<div class="sub_tit"><h3>관리자 페이지 접근 가능한 아이피</h3><a href="log_adminpage_access" id="btn-log-adminpage-access">.</a></div>
		<div class="table_write_info">* 관리자 페이지에 접근할 수 있는 기능을 사용합니다.</div>
		<div class="table_write_info">* 등록되지 않은 아이피의 경우 관리자 페이지에 접근할 수 없습니다.</div>
		<div class="standard_box">
			<form action="manage_access_update" method="post">
				<input type="hidden" name="type" value="admin_accessible_ip">
				<input type="checkbox" name="use_admin_accessible_ip" id="use-admin-accessible-ip" value="y"<?=$manage['use_admin_accessible_ip'] === 'y' ? ' checked' : ''?>>
				<label class="standard_msg" for="use-admin-accessible-ip">접근 가능한 아이피 사용(관리자)</label>
				<button class="btn-submit">적용</button>
			</form>

			<?php
			if($manage['use_admin_accessible_ip'] === 'y') :
			?>
			<div class="standard_wrap" style="margin: 30px 0 10px;">
				<form id="admin-form" action="insert_admin_accessible_ip" method="post" autocomplete="off">
					<input type="text" name="ip" id="admin-accessible-ip" value="<?=$this->input->ip_address()?>" maxlength="15" required>
					<button type="button" id="btn-admin-accessible-ip" class="btn-submit reg">등록</button>
				</form>
			</div>
			<div class="table_write">
				<table cellpadding="0" cellspacing="0" border="0" style="width: 500px;">
					<colgroup>
						<col style="width: 70px;">
						<col style="width: 150px;">
						<col style="">
						<col style="width: 150px;">
					</colgroup>
					<thead>
						<tr>
							<th scope="col">-</th>
							<th scope="col">아이피</th>
							<th scope="col">등록한 아이디</th>
							<th scope="col">등록일</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if(count($admin) > 0) :
						foreach($admin as $value) :
					?>
						<tr>
							<td class="center"><a href="remove_ip?page=manage_access_admin&table=da_admin_accessible_ip&no=<?=$value['no']?>" class="btn-remove">삭제</a></td>
							<td class="center admin-ip"><?=$value['ip']?></td>
							<td class="center"><?=$value['reg_userid']?></td>
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

	<div class="standard_wrap" style="margin-top: 0;">
		<div class="sub_tit"><h3>사용자 아이피 차단</h3></div>
		<div class="table_write_info">* 차단된 아이피의 경우 강제로 404 페이지로 리다이렉션 됩니다.</div>
		<div class="standard_box">
			<form action="manage_access_update" method="post">
				<input type="hidden" name="type" value="client_blocked_ip">
				<input type="checkbox" name="use_client_blocked_ip" id="use-client-blocked-ip" value="y"<?=$manage['use_client_blocked_ip'] === 'y' ? ' checked' : ''?>>
				<label class="standard_msg" for="use-client-blocked-ip">사용자 아이피 차단 사용</label>
				<button class="btn-submit">적용</button>
			</form>

			<?php
			if($manage['use_client_blocked_ip'] === 'y') :
			?>
			<div class="standard_wrap" style="margin: 30px 0 10px;">
				<form id="client-ip-form" action="insert_client_blocked_ip" method="post" autocomplete="off">
					<input type="text" name="client_blocked_ip" id="client-blocked-ip" value="" maxlength="15" required>
					<input type="hidden" name="blocked_ip" id="blocked-ip" value="<?=$manage['blocked_ip']?>">
					<button type="button" id="btn-client-blocked-ip" class="btn-submit reg">등록</button>
				</form>
				<div style="width: 150px; height: 100px; margin-top: 5px; padding: 5px; overflow-y: scroll; border: 1px solid #ccc;">
					<form id="ip-list" action="update_client_blocked_ip" method="post">
						<ul id="blocked-ip-list">
						<?php
						if($manage['blocked_ip']) :
							$temp = explode('|', $manage['blocked_ip']);
							foreach($temp as $ip) :
								echo '<li class="li-ip"><a href="#" class="remove-ip"><input type="hidden" name="ip[]" class="ip" value="'.$ip.'">'.$ip.'</a></li>';
							endforeach;
						else :
							echo '<li>차단된 아이피가 없습니다.</li>';
						endif;
						?>
						</ul>
					</form>
				</div>
			</div>
			<?php
			endif;
			?>
		</div>
	</div>
</div>