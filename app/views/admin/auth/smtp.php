<link rel="stylesheet" href="/lib/admin/css/admin_css.css">
<link rel="stylesheet" href="/lib/admin/css/bbs.css">
<link rel="stylesheet" href="/lib/admin/css/skin.css">
<link rel="stylesheet" href="/lib/admin/css/jquery-ui.min.css">
<link rel="stylesheet" href="/lib/css/common.css">
<style>
#contents { padding: 0 20px; }
table { width: 100%; }
#smtp-secure { width: 100px !important; }
#smtp-port { width: 50px !important; text-align: center; }
.sub_tit { padding: 0; }
.btn-group { text-align: center; margin-top: 10px; }
.btn-submit, .btn-close { padding: 4px 10px; border: 0; background: #000; color: #fff; }
</style>
<script src="/lib/js/jquery-2.2.4.min.js"></script>
<script>
$(function() {
	$("#smtp-list").on("change", function() {
		const opts = $("option:selected", this).data("option").split("|");
		$("#smtp-secure").val(opts[1]);
		$("#smtp-port").val(opts[2]);
		$("#smtp-host").val(opts[3]);
	});
});
</script>
<div id="contents">
	<div class="sub_tit">
		<h3>SMTP 설정</h3>
	</div>
	<div class="contents_wrap">
		<form id="smtpForm" method="post">
			<div class="table_write">
				<table cellpadding="0" cellspacing="0" border="0">
					<colgroup>
						<col style="width: 150px;">
						<col>
					</colgroup>
					<tbody>
						<tr>
							<th>외부 SMTP 사용</th>
							<td>
								<select name="use_smtp" id="useSmtp">
									<option value="n">사용안함</option>
									<option value="y"<?=$manage['use_smtp'] === 'y' ? ' selected' : ''?>>사용함</option>
								</select>
								<select id="smtp-list" style="width: 150px;">
								<?php
								$smtp = [
									'' => '직접 입력',
									'naver' => '네이버|ssl|465|smtp.naver.com',
									'gmail' => '지메일|ssl|465|smtp.gmail.com',
									'office365' => '오피스365|tls|587|smtp.office365.com'
								];
								foreach($smtp as $key => $value) :
									$tmp = explode('|', $value);
									$selected = $manage['smtp_host'] === $tmp[3] ? ' selected' : '';
									echo '<option value="'.$key.'" data-option="'.$value.'"'.$selected.'>'.$tmp[0].'</option>';
								endforeach;
								?>
								</select>
							</td>
						</tr>
						<!-- tr>
							<th>보내는 사람</th>
							<td><input type="text" name="smtp_send_name" value="<?=$manage['smtp_send_name']?>"></td>
						</tr -->
						<tr>
							<th>보안 연결</th>
							<td>
								<select name="smtp_secure" id="smtp-secure">
									<option value="ssl">ssl</option>
									<option value="tls"<?=$manage['smtp_secure'] === 'tls' ? ' selected' : ''?>>tls</option>
								</select>
								<input type="text" name="smtp_port" id="smtp-port" value="<?=$manage['smtp_port']?>" maxlength="3">
							</td>
						</tr>
						<tr>
							<th>호스트</th>
							<td><input type="text" name="smtp_host" id="smtp-host" value="<?=$manage['smtp_host']?>"></td>
						</tr>
						<tr>
							<th>아이디</th>
							<td><input type="text" name="smtp_userid" value="<?=$manage['smtp_userid']?>"></td>
						</tr>
						<tr>
							<th>패스워드</th>
							<td><input type="text" name="smtp_password" value="<?=$manage['smtp_password']?>"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="btn-group">
				<button id="btnSubmit" class="btn-submit">확인</button>
				<button type="button" class="btn-close" onclick="window.close()">닫기</button>
			</div>
		</form>
	</div>
</div>