<?php
$year = date('Y');
$month = date('m');
list($week, $last_day) = preg_split('[-]', date('w-t', mktime(0, 0, 1, $month, 1, $year)));
$get_number_of_days = date('w', strtotime($year.'-'.$month.'-'.$last_day));
$limit_day = $get_number_of_days < 6 ? ($last_day + (6 - $get_number_of_days)) : $last_day;
?>
<style>
.day { height: 100px !important; padding-left: 5px !important; text-align: left !important; vertical-align: top !important; border-right: 1px solid #ccc; }
.day:nth-child(7) { border-right: 0; }
</style>
<script src="/lib/js/monthpicker.js"></script>
<script>
$(function() {
	$("a.add-schedule").on("click", function(e) {
		e.preventDefault();
		const ymd = $(this).data("ymd");
		window.open(`schedule/add_schedule?ymd=${ ymd }`, "add-schedule", "width=600, height=600, left=500, top=200, scrollbars=yes");
	});
});
</script>
<div id="contents">
	<div class="main_tit">
		<h2>일정 관리</h2>
		<div class="btn_right btn_num2 dn">
			<a href="add_schedule" class="btn point new_plus">+ 일정 등록</a>
		</div><!--btn_right-->
	</div>
	<h1><?=$year.'년 '.(int)$month?>월</h1>
	<div class="table_list">
		<table>
			<thead>
				<tr>
					<th>일</th>
					<th>월</th>
					<th>화</th>
					<th>수</th>
					<th>목</th>
					<th>금</th>
					<th>토</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<?php
				$j = 1;
				for($i = (1 - $week); $i <= $limit_day; $i++) {
					echo '<td class="day"><a href="#" class="add-schedule" data-ymd="'.$year.$month.sprintf('%02d', $i).'">'.(($i > 0 && $i <= $last_day) ? $i : '').'</a></td>';
					if($j % 7 == 0) echo '</tr><tr>';
					$j++;
				}
				?>
				</tr>
			</tbody>
		</table>
	</div>
</div>