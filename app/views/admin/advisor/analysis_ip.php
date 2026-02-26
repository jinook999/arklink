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
		<h2>접속자 IP 분석</h2>
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
			<a href="#;" class="btn btn_basic">전체목록</a>
		</div>
		</form>
	</div>

	<div class="advisor_count_total">
		<dl>
			<dt>총 접속자수</dt>
			<dd><strong>356,849</strong><span>명</span></dd>
		</dl>
	</div>
	<div class="advisor_ip_wrap">
		<div class="table_list">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr>
						<th>접속시간</th>
						<th>접속 IP</th>
						<th>웹브라우저</th>
						<th>운영체제</th>
						<th>접속형태</th>
						<th>접속자수</th>
						<th>방문경로</th>
					</tr>
				</thead>
				<tbody id=''>
					<tr>
						<td class="">2020-11-26 11:29:32</td>
						<td class="">203.217.240.14</td>
						<td class="">Chrome</td>
						<td class="">Mac OS X</td>
						<td class="">PC</td>
						<td class="">345,678명</td>
						<td class="">즐겨찾기나 직접방문</td>
					</tr>
					<tr>
						<td class="">2020-11-26 11:29:32</td>
						<td class="">203.217.240.14</td>
						<td class="">Chrome</td>
						<td class="">Mac OS X</td>
						<td class="">PC</td>
						<td class="">345,678명</td>
						<td class="">즐겨찾기나 직접방문</td>
					</tr>
					<tr>
						<td class="">2020-11-26 11:29:32</td>
						<td class="">203.217.240.14</td>
						<td class="">Chrome</td>
						<td class="">Mac OS X</td>
						<td class="">PC</td>
						<td class="">345,678명</td>
						<td class="">즐겨찾기나 직접방문</td>
					</tr>
					<tr>
						<td class="">2020-11-26 11:29:32</td>
						<td class="">203.217.240.14</td>
						<td class="">Chrome</td>
						<td class="">Mac OS X</td>
						<td class="">PC</td>
						<td class="">345,678명</td>
						<td class="">즐겨찾기나 직접방문</td>
					</tr>
					<tr>
						<td class="">2020-11-26 11:29:32</td>
						<td class="">203.217.240.14</td>
						<td class="">Chrome</td>
						<td class="">Mac OS X</td>
						<td class="">PC</td>
						<td class="">345,678명</td>
						<td class="">즐겨찾기나 직접방문</td>
					</tr>
					<tr>
						<td class="">2020-11-26 11:29:32</td>
						<td class="">203.217.240.14</td>
						<td class="">Chrome</td>
						<td class="">Mac OS X</td>
						<td class="">PC</td>
						<td class="">345,678명</td>
						<td class="">즐겨찾기나 직접방문</td>
					</tr>
					<tr>
						<td class="">2020-11-26 11:29:32</td>
						<td class="">203.217.240.14</td>
						<td class="">Chrome</td>
						<td class="">Mac OS X</td>
						<td class="">PC</td>
						<td class="">345,678명</td>
						<td class="">즐겨찾기나 직접방문</td>
					</tr>
					<tr>
						<td class="">2020-11-26 11:29:32</td>
						<td class="">203.217.240.14</td>
						<td class="">Chrome</td>
						<td class="">Mac OS X</td>
						<td class="">PC</td>
						<td class="">345,678명</td>
						<td class="">즐겨찾기나 직접방문</td>
					</tr>
					<tr>
						<td class="">2020-11-26 11:29:32</td>
						<td class="">203.217.240.14</td>
						<td class="">Chrome</td>
						<td class="">Mac OS X</td>
						<td class="">PC</td>
						<td class="">345,678명</td>
						<td class="">즐겨찾기나 직접방문</td>
					</tr>
					<tr>
						<td class="">2020-11-26 11:29:32</td>
						<td class="">203.217.240.14</td>
						<td class="">Chrome</td>
						<td class="">Mac OS X</td>
						<td class="">PC</td>
						<td class="">345,678명</td>
						<td class="">즐겨찾기나 직접방문</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="paging">
			<span><a class="page_num on" href="#"><b>1</b></a></span><span><a href="#" data-ci-pagination-page="2">2</a></span><span><a href="#" data-ci-pagination-page="3">3</a></span><span class="arrow next"><a href="#" data-ci-pagination-page="2" rel="next">다음<img src="../../lib/admin/images/paging_next.gif" alt="다음"></a></span>
		</div>
	</div>
	<div class="btn_right btn_content">
		<a href="#;" id="dataReset" class="btn btn_grey">분석 초기화</a>
		<div class="data_reset_layer">
			<p class="data_reset_con">접속자분석 <strong class="data_reset_con">모든 데이타가 삭제</strong>됩니다.<br/>정말 초기화 하시겠습니까?</p>
			<div class="btn_center data_reset_con"><a href="#;" class="btn btn_point data_reset_con">초기화</a><a href="#;" class="btn btn_basic">취소</a></div>
		</div>
	</div>
</div>
</div>