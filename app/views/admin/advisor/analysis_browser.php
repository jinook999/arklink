<script>
$(function() {
	$(".r-date").datepicker({
		dateFormat: "yy-mm-dd"
	});
	$('.advisor_tab > li:first-child, .advisor_cont > .advisor_box:first-child').addClass('on');
	$('.advisor_tab > li').each(function(){
		$(this).click(function(){
			var adTab = $(this).attr('rel');
			$('.advisor_tab > li, .advisor_cont > .advisor_box').removeClass('on');
			$(this).addClass('on');
			$('#' + adTab).addClass('on');
		});
	});
	$('#dataReset, .data_reset_layer .btn_basic').click(function(){
		$('.data_reset_layer').toggleClass('on');
	});
	$(document).click(function(e){
		if (!$(e.target).is('#dataReset, .data_reset_layer, .data_reset_con')){
			$('.data_reset_layer').removeClass('on');
		}
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
		<input type="hidden" name="roundpage" value="">
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
								<input type="text" name="startDate" id="startDate" class="r-date" value="" placeholder="2020-11-01"><span>~</span><input type="text" name="endDate" id="endDate" class="r-date" value="" placeholder="2020-11-30">
							</div>
							<ul>
								<li><input type="radio" name="dayselect" id="dayselect_today" value=""><label for="dayselect_today">오늘</label></li>
								<li><input type="radio" name="dayselect" id="dayselect_yesterday" value=""><label for="dayselect_yesterday">어제</label></li>
								<li><input type="radio" name="dayselect" id="dayselect_7day" value=""><label for="dayselect_7day">7일</label></li>
								<li><input type="radio" name="dayselect" id="dayselect_15day" value=""><label for="dayselect_15day">15일</label></li>
								<li><input type="radio" name="dayselect" id="dayselect_1month" value=""><label for="dayselect_1month">1개월</label></li>
								<li><input type="radio" name="dayselect" id="dayselect_3month" value=""><label for="dayselect_3month">3개월</label></li>
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
			<li rel="ad1" class="on">운영체제 현황</li>
			<li rel="ad2">브라우저 현황</li>
		</ul>
		<div class="advisor_count_total">
			<dl>
				<dt>총 접속자수</dt>
				<dd><strong>356,849</strong><span>명</span></dd>
			</dl>
		</div>
		<div class="advisor_cont">
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
						foreach($result as $key => $value) :
						?>
							<tr>
								<td class="">1</td>
								<td align="left" class=""><?=$value['platform']?></td>
								<td class=""><?=number_format($value['cnt'])?>명</td>
								<td align="left" class="">
									<div class="advisor_graph">
										<strong>80%</strong><div class="advisor_bar"><div class="active" style="width:80%;"></div></div>
									</div>
								</td>
							</tr>
						<?php
						endforeach;
						?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="advisor_box advisor_device" id="ad2">
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
						<tbody id=''>
							<tr>
								<td class="">1</td>
								<td align="left" class="">Unknown Browser</td>
								<td class="">PC</td>
								<td class="">345,678명</td>
								<td align="left" class="">
									<div class="advisor_graph">
										<strong>80%</strong><div class="advisor_bar"><div class="active" style="width:80%;"></div></div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="">2</td>
								<td align="left" class="">Chrome</td>
								<td class="">PC</td>
								<td class="">1,678명</td>
								<td align="left" class="">
									<div class="advisor_graph">
										<strong>12%</strong><div class="advisor_bar"><div class="active" style="width:12%;"></div></div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="">3</td>
								<td align="left" class="">Mobile Browser</td>
								<td class="">PC</td>
								<td class="">808명</td>
								<td align="left" class="">
									<div class="advisor_graph">
										<strong>6%</strong><div class="advisor_bar"><div class="active" style="width:6%;"></div></div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="">4</td>
								<td align="left" class="">Firefox</td>
								<td class="">PC</td>
								<td class="">124명</td>
								<td align="left" class="">
									<div class="advisor_graph">
										<strong>1.2%</strong><div class="advisor_bar"><div class="active" style="width:1.2%;"></div></div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="">5</td>
								<td align="left" class="">Internet Explorer</td>
								<td class="">PC</td>
								<td class="">5명</td>
								<td align="left" class="">
									<div class="advisor_graph">
										<strong>0.02%</strong><div class="advisor_bar"><div class="active" style="width:0.02%;"></div></div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="">6</td>
								<td align="left" class="">Opera</td>
								<td class="">PC</td>
								<td class="">5명</td>
								<td align="left" class="">
									<div class="advisor_graph">
										<strong>0.02%</strong><div class="advisor_bar"><div class="active" style="width:0.02%;"></div></div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="">7</td>
								<td align="left" class="">Safari</td>
								<td class="">PC</td>
								<td class="">5명</td>
								<td align="left" class="">
									<div class="advisor_graph">
										<strong>0.02%</strong><div class="advisor_bar"><div class="active" style="width:0.02%;"></div></div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>