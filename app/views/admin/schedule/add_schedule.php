<link rel="stylesheet" href="/lib/admin/css/reset.css">
<link rel="stylesheet" href="/lib/admin/css/skin.css">
<link rel="stylesheet" href="/lib/admin/css/jquery-ui.min.css">
<link rel="stylesheet" href="/lib/css/datepicker.css">
<link rel="stylesheet" href="/lib/admin/css/admin_css.css">
<style>
#contents { padding: 30px !important; }
</style>
<script src="/lib/js/jquery-2.2.4.min.js"></script>
<script src="/lib/js/jquery-ui.min.js"></script>
<script>
$(function() {
	$("#ymd").datepicker({
		dateFormat: "yy-mm-dd",
	});
});
</script>
<div id="contents">
	<div class="table_write">
		<table>
			<colgroup>
				<col style="width: 150px;">
				<col>
			</colgroup>
			<tr>
				<th>날짜</th>
				<td><input type="text" name="ymd" id="ymd" class="" value="<?=date('Y-m-d', strtotime($get['ymd']))?>" style="width: 100px; text-align: center;"></td>
			</tr>
			<tr>
				<th>제목</th>
				<td><input type="text" name="title" value="" style="max-width: 100%;"></td>
			</tr>
			<tr>
				<th>내용</th>
				<td><textarea name="content" style="min-height: 100px; padding: 5px;"></textarea></td>
			</tr>
		</table>
	</div>
</div>