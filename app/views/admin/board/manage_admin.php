<link rel="stylesheet" href="/lib/admin/css/reset.css">
<link rel="stylesheet" href="/lib/admin/css/skin.css">
<link rel="stylesheet" href="/lib/admin/css/admin_css.css">
<style>
#contents { padding: 30px !important; }
#btn-submit, #btn-close { padding: 3px 20px; background: #000; color: #fff; font-size: 12px; }
</style>
<script src="/lib/js/jquery-2.2.4.min.js"></script>
<div id="contents">
	<form id="form" action="manage_admin_update" method="post" autocomplete="off">
		<input type="hidden" name="code" id="code" value="<?=$board['code']?>">
		<div class="table_write">
			<table>
				<colgroup>
					<col style="width: 100px;">
				</colgroup>
				<tr>
					<th>게시판</th>
					<td><?=$board['name']?></td>
				</tr>
				<tr>
					<th>관리자</th>
					<td>
						<ul>
						<?php
						$temp_admin = explode(',', $board['admin']);
						foreach($admin as $value) :
							$checked = in_array($value['userid'], $temp_admin) ? ' checked' : '';
							echo '<li><input type="checkbox" name="admin[]" id="'.$value['userid'].'" class="userid" value="'.$value['userid'].'"'.$checked.'><label for="'.$value['userid'].'">'.$value['name'].'('.$value['userid'].')</lable></li>';
						endforeach;
						?>
						</ul>
					</td>
				</tr>
			</table>
		</div>
		<div style="margin-top: 10px; text-align: center;">
			<button id="btn-submit">확인</button>
			<button type="button" id="btn-close" onclick="window.close()">닫기</button>
		</div>
	</form>
</div>