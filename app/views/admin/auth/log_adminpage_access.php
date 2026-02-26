<link rel="stylesheet" href="/lib/admin/css/reset.css">
<link rel="stylesheet" href="/lib/admin/css/skin.css">
<link rel="stylesheet" href="/lib/admin/css/admin_css.css">
<style>
#contents { padding: 30px !important; }
#btn-submit, #btn-close { padding: 3px 20px; background: #000; color: #fff; font-size: 12px; }
.center { text-align: center; }
.fail { background: #ff5e5e !important; }
.fail td { color: #fff !important; }
.not-company-ip { background: #f00; color: #fff; }
</style>
<script src="/lib/js/jquery-2.2.4.min.js"></script>
<div id="contents">
	<form id="form" action="manage_admin_update" method="post" autocomplete="off">
		<input type="hidden" name="code" id="code" value="<?=$board['code']?>">
		<div class="table_write">
			<table>
				<colgroup>
					<col style="width: 60px;">
					<col style="width: 90px;">
					<col style="width: 90px;">
					<col style="width: 50px;">
					<col>
					<col style="width: 100px;">
					<col style="width: 130px;">
				</colgroup>
				<thead>
					<tr>
						<th>No</th>
						<th>사용한 아이디</th>
						<th>사용한 패스워드</th>
						<th>성공</th>
						<th>메시지</th>
						<th>아이피</th>
						<th>날짜</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$company_ip = ['210.121.177'];
				foreach($list as $key => $value) :
					$no = count($all) - $offset - $key;
					$compare_ip = in_array(substr($value['ip'], 0, 11), $company_ip) === false ? '<span class="not-company-ip">'.$value['ip'].'</span>' : $value['ip'];
					$is_fail = $value['is_success'] === 'n' ? ' class="fail"' : '';
				?>
					<tr<?=$is_fail?>>
						<td class="center"><?=$no?></td>
						<td class="center"><?=$value['userid']?></td>
						<td class="center"><?=$value['password']?></td>
						<td class="center"><?=$value['is_success'] === 'y' ? '성공' : '실패'?></td>
						<td class="center"><?=$value['reason']?></td>
						<td class="center"><?=$compare_ip?></td>
						<td class="center"><?=$value['regdate']?></td>
					</tr>
				<?php
				endforeach;
				?>
				</tbody>
			</table>
			<?=$pagination?>
		</div>
		<div style="margin-top: 10px; text-align: center;">
			<button type="button" id="btn-close" onclick="window.close()">닫기</button>
		</div>
	</form>
</div>