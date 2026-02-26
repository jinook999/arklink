<?php
$type = $this->input->get("type", true) ? $this->input->get("type", true) : "hour";
$day = $this->input->get("dayselect", true);
?>
<style>
#ad1 { padding-top: 10px; }
.dayselect { display: none; }
</style>
<link rel="stylesheet" href="/lib/admin/css/Chart.css">
<script src="/lib/admin/js/Chart.js"></script>
<script src="/lib/admin/js/chartjs-plugin-labels.js"></script>
<script>
$(function() {
	$(".r-date").datepicker({
		dateFormat: "yy-mm-dd"
	});
/*
	$('.advisor_tab > li:first-child, .advisor_cont > .advisor_box:first-child').addClass('on');
	$('.advisor_tab > li').each(function(){
		$(this).click(function(){
			var adTab = $(this).attr('rel');
			$('.advisor_tab > li, .advisor_cont > .advisor_box').removeClass('on');
			$(this).addClass('on');
			$('#' + adTab).addClass('on');
		});
	});
*/
	$('#dataReset, .data_reset_layer .btn_basic').click(function(){
		$('.data_reset_layer').toggleClass('on');
	});

/* 레이어 외 클릭시 레이어 없애는 부분 감춤
	$(document).click(function(e){
		if (!$(e.target).is('#dataReset, .data_reset_layer, .data_reset_con')){
			$('.data_reset_layer').removeClass('on');
		}
	});
*/
	$("a.data_reset_con").on("click", function(e) {
		e.preventDefault();
		$(location).attr("href", "remove_all");
	});

	$(".dayselect").on("click", function() {
		var dt = $(this).data("v").split("/");
		$("#startDate").val(dt[0]);
		$("#endDate").val(dt[1]);
	});
});
</script>
<div id="contents">
<div class="contents_wrap">
	<input type="hidden" name="language" value="<?=$this->_site_language['default']?>">
	<div class="main_tit">
		<h2>접속자 분석</h2>
	</div>
	<div class="sub_tit"><h3>접속통계 검색</h3></div>
	<div class="bbs_list_top clear">
		<form autocomplete="off">
		<input type="hidden" name="type" value="<?=$type?>">
		<table class="board_search_table">
			<colgroup>
				<col width="150px">
			</colgroup>
			<tr>
				<th>접속 기간</th>
				<td>
					<fieldset>
						<div class="day_search_form">
							<div class="day_text">
								<input type="text" name="startDate" id="startDate" class="r-date" value="<?=$this->input->get("startDate", true)?>" placeholder="<?=date("Y-m-d")?>"><span>~</span><input type="text" name="endDate" id="endDate" class="r-date" value="<?=$this->input->get("endDate", true)?>" placeholder="<?=date("Y-m-d")?>">
							</div>
							<ul>
								<li><input type="radio" name="dayselect" id="dayselect_today" class="dayselect" value="t" data-v="<?=date("Y-m-d")?>/<?=date("Y-m-d")?>"<?=$day == "t" ? " checked" : ""?>><label for="dayselect_today">오늘</label></li>
								<li><input type="radio" name="dayselect" id="dayselect_yesterday" class="dayselect" value="y" data-v="<?=date("Y-m-d", strtotime("-1 days"))?>/<?=date("Y-m-d")?>"<?=$day == "y" ? " checked" : ""?>><label for="dayselect_yesterday">어제</label></li>
								<li><input type="radio" name="dayselect" id="dayselect_7day" class="dayselect" value="7d" data-v="<?=date("Y-m-d", strtotime("-7 days"))?>/<?=date("Y-m-d")?>"<?=$day == "7d" ? " checked" : ""?>><label for="dayselect_7day">7일</label></li>
								<li><input type="radio" name="dayselect" id="dayselect_15day" class="dayselect" value="15d" data-v="<?=date("Y-m-d", strtotime("-15 days"))?>/<?=date("Y-m-d")?>"<?=$day == "15d" ? " checked" : ""?>><label for="dayselect_15day">15일</label></li>
								<li><input type="radio" name="dayselect" id="dayselect_1month" class="dayselect" value="1m" data-v="<?=date("Y-m-d", strtotime("-1 months"))?>/<?=date("Y-m-d")?>"<?=$day == "1m" ? " checked" : ""?>><label for="dayselect_1month">1개월</label></li>
								<li><input type="radio" name="dayselect" id="dayselect_3month" class="dayselect" value="3m" data-v="<?=date("Y-m-d", strtotime("-3 months"))?>/<?=date("Y-m-d")?>"<?=$day == "3m" ? " checked" : ""?>><label for="dayselect_3month">3개월</label></li>
							</ul>
						</div>
					</fieldset>
				</td>
			</tr>
		</table><!--/ board_search_table -->
		<div class="btn_center">
			<button type="submit" class="btn btn_point">검색</button>
			<a href="?type=<?=$type?>" class="btn btn_basic">전체목록</a>
		</div>
		</form>
	</div>

	<div class="advisor_tab_wrap">
		<ul class="advisor_tab">
			<li rel="ad1"<?=$type == "hour" ? " class='on'" : ""?>><a href="?type=hour">시간대별 현황</a></li>
			<li rel="ad2"<?=$type == "day" ? " class='on'" : ""?>><a href="?type=day">일별 현황</a></li>
			<li rel="ad3"<?=$type == "week" ? " class='on'" : ""?>><a href="?type=week">요일별 현황</a></li>
			<li rel="ad4"<?=$type == "month" ? " class='on'" : ""?>><a href="?type=month">월별 현황</a></li>
		</ul>
		<div class="advisor_cont advisor_charts">
		<?php
		if($type == "hour") :
		?>
			<div class="advisor_box on" id="ad1" data-str='<?=$hours?>'>
				<canvas id="myChart" width="1500" height="400"></canvas>
				<script>
				var time = [];
				var datas = [];
				var json = $("#ad1").data("str");
				var n = 0;
				for(var h = 0; h < 24; h++) {
					time.push(h + "시");
					n = json[h] > 0 ? datas.push(json[h]) : datas.push(0);
				}

				var ctx = document.getElementById('myChart').getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: time,
						datasets: [{
							label: '시간별',
							data: datas,
							backgroundColor: 'rgba(81, 194, 255, 0.7)',
							borderColor: 'rgba(54, 162, 235, 1)',
							borderWidth: 1
						}]
					},
					options: {
						responsive: false,
						tooltips: {
							enabled: false
						},
						scales: {
							yAxes: [{
								ticks: {
									max: $("#ad1").data("max"),
									stepSize: $("#ad1").data("step"),
									beginAtZero: true
								}
							}]
						},
						maintainAspectRatio: false,
						plugins: {
							labels: {
								render: 'value'
							}
						}
					}
				});
				</script>
			</div>
		<?php
		endif;
		if($type == "day") :
		?>
			<div class="advisor_box on" id="ad2" data-str='<?=$days?>'>
				<canvas id="myChart" width="1500" height="400"></canvas>
				<script>
				var time = [];
				var datas = [];
				var json = $("#ad2").data("str");
				var n = 0;
				for(var d = 1; d < 32; d++) {
					time.push(d + "일");
					n = json[d] > 0 ? datas.push(json[d]) : datas.push(0);
				}

				var ctx = document.getElementById('myChart').getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: time,
						datasets: [{
							label: '일별',
							data: datas,
							backgroundColor: 'rgba(81, 194, 255, 0.7)',
							borderColor: 'rgba(54, 162, 235, 1)',
							borderWidth: 1
						}]
					},
					options: {
						responsive: false,
						tooltips: {
							enabled: false
						},
						scales: {
							yAxes: [{
								ticks: {
									//max: $("#ad2").data("max"),
									//stepSize: $("#ad2").data("step"),
									beginAtZero: true
								}
							}]
						},
						maintainAspectRatio: false,
						plugins: {
							labels: {
								render: 'value'
							}
						}
					}
				});
				</script>
			</div>
		<?php
		endif;
		if($type == "week") :
		?>
			<div class="advisor_box on" id="weekArea" data-str='<?=$weeks?>'>
				<canvas id="myChart" width="1500" height="400"></canvas>
				<script>
				var time = [];
				var datas = [];
				var json = $("#weekArea").data("str");
				var n = 0;
				for(var w = 0; w < 24; w++) {
					n = json[w] > 0 ? datas.push(json[w]) : datas.push(0);
				}

				var ctx = document.getElementById("myChart").getContext("2d");
				var myChart = new Chart(ctx, {
					type: "bar",
					data: {
						labels: ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"],
						datasets: [{
							label: "요일별",
							data: datas,
							backgroundColor: "rgba(81, 194, 255, 0.7)",
							borderColor: "rgba(54, 162, 235, 1)",
							borderWidth: 1
						}]
					},
					options: {
						responsive: false,
						tooltips: {
							enabled: false
						},
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero: true
								}
							}]
						},
						maintainAspectRatio: false,
						plugins: {
							labels: {
								render: "value"
							}
						}
					}
				});
				</script>
			</div>
		<?php
		endif;
		if($type == "month") :
		?>
			<div class="advisor_box on" id="monthArea" data-str='<?=$months?>'>
				<canvas id="myChart" width="1500" height="400"></canvas>
				<script>
				var time = [];
				var datas = [];
				var json = $("#monthArea").data("str");
				var n = 0;
				for(var m = 1; m < 13; m++) {
					time.push(m + "월");
					n = json[m] > 0 ? datas.push(json[m]) : datas.push(0);
				}

				var ctx = document.getElementById('myChart').getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: time,
						datasets: [{
							label: '월별',
							data: datas,
							backgroundColor: 'rgba(81, 194, 255, 0.7)',
							borderColor: 'rgba(54, 162, 235, 1)',
							borderWidth: 1
						}]
					},
					options: {
						responsive: false,
						tooltips: {
							enabled: false
						},
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero: true
								}
							}]
						},
						maintainAspectRatio: false,
						plugins: {
							labels: {
								render: 'value'
							}
						}
					}
				});
				</script>
			</div>
		<?php
		endif;
		?>
		</div>
	</div>
	<div class="advisor_number">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tbody>
				<tr>
					<th>총 접속자</th>
					<td><strong><?=number_format($total)?></strong><span>명</span></td>
					<th>평균 접속자</th>
					<td><strong><?=number_format($average)?></strong><span>명</span></td>
				</tr>
				<tr>
					<th>오늘 접속자</th>
					<td><strong><?=number_format($today)?></strong><span>명</span></td>
					<th>어제 접속자</th>
					<td><strong><?=number_format($yesterday)?></strong><span>명</span></td>
				</tr>
				<tr>
					<th>이번달 접속자</th>
					<td><strong><?=number_format($this_month)?></strong><span>명</span></td>
					<th>이번달 평균 접속자</th>
					<td><strong><?=number_format($average_this_month)?></strong><span>명</span></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="btn_right btn_content">
		<a href="#;" id="dataReset" class="btn btn_grey">분석 초기화</a>
		<div class="data_reset_layer">
			<p class="data_reset_con">접속자분석 <strong class="data_reset_con">모든 데이타가 삭제</strong>됩니다.<br/>정말 초기화 하시겠습니까?</p>
			<div class="btn_center data_reset_con"><a href="#" class="btn btn_point data_reset_con">초기화</a><a href="#" class="btn btn_basic">취소</a></div>
		</div>
	</div>
</div>
</div>