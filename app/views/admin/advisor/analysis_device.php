<?php
$type = $this->input->get("type", true) == "browser" ? "browser" : "os";
$total = count($total);
$day = $this->input->get("dayselect", true);
?>
<style>
.dayselect { display: none; }
</style>
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
	$(document).click(function(e){
		if (!$(e.target).is('#dataReset, .data_reset_layer, .data_reset_con')){
			$('.data_reset_layer').removeClass('on');
		}
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
	<input type = "hidden" name = "language" value = "<?=$this->_site_language['default']?>">
	<div class="main_tit">
		<h2>접속자 환경분석</h2>
	</div>
	<div class="sub_tit"><h3>접속통계 검색</h3></div>
	<div class="bbs_list_top clear">
		<form>
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
			<li rel="ad1"<?=$type == "os" ? " class='on'" : ""?>><a href="?type=os">운영체제 현황</a></li>
			<li rel="ad2"<?=$type == "browser" ? " class='on'" : ""?>><a href="?type=browser">브라우저 현황</a></li>
		</ul>
		<div class="advisor_count_total">
			<dl>
				<dt>총 접속자수</dt>
				<dd><strong><?=number_format($total)?></strong><span>명</span></dd>
			</dl>
		</div>
		<div class="advisor_cont">
		<?php
		if($type == "os") :
		?>
			<div class="advisor_box advisor_device on" id="ad1">
				<div class="table_list">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<thead>
							<tr>
								<th>접속순위</th>
								<th>운영체제</th>
								<th>접속자수</th>
								<th>그래프 (비율%)</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						foreach($list as $key => $value) :
							$percent = ($value['cnt'] / $total) * 100;
						?>
							<tr>
								<td class=""><?=$no?></td>
								<td align="left" class=""><?=$value['platform']?></td>
								<td class=""><?=number_format($value['cnt'])?>명</td>
								<td align="left" class="">
									<div class="advisor_graph">
										<strong><?=number_format($percent)?>%</strong><div class="advisor_bar"><div class="active" style="width:<?=$percent?>%;"></div></div>
									</div>
								</td>
							</tr>
						<?php
							$no++;
						endforeach;
						?>
						</tbody>
					</table>
				</div>
			</div>
		<?php
		endif;
		if($type == "browser") :
		?>
			<div class="advisor_box advisor_device on" id="ad2">
				<div class="table_list">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<thead>
							<tr>
								<th>접속순위</th>
								<th>웹브라우저</th>
								<th>접속디바이스</th>
								<th>접속자수</th>
								<th>그래프 (비율%)</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						foreach($list as $key => $value) :
							$percent = ($value['cnt'] / $total) * 100;
						?>
							<tr>
								<td class=""><?=$no?></td>
								<td align="left" class=""><?=$value['browser']?></td>
								<td class=""><?=in_array($value['platform'], ['Android', 'iOS']) ? "Mobile" : "PC"?></td>
								<td class=""><?=number_format($value['cnt'])?>명</td>
								<td align="left" class="">
									<div class="advisor_graph">
										<strong><?=number_format($percent)?>%</strong><div class="advisor_bar"><div class="active" style="width:<?=$percent?>%;"></div></div>
									</div>
								</td>
							</tr>
						<?php
							$no++;
						endforeach;
						?>
						</tbody>
					</table>
				</div>
			</div>
		<?php
		endif;
		?>
		</div>
	</div>
</div>
</div>