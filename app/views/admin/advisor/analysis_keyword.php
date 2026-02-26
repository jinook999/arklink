<?php
$type = $this->input->get("type", true) == "browser" ? "browser" : "os";
$total = count($total);
$day = $this->input->get("dayselect", true);
?>
<style>
.dayselect { display: none; }
</style>
<script>
$('#leftmenu >ul > li:nth-of-type(1)').addClass('on');
$(function() {
	$(".r-date").datepicker({
		dateFormat: "yy-mm-dd"
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
		<h2>검색키워드 분석</h2>
	</div>
	<div class="sub_tit"><h3>접속통계 검색</h3></div>
	<div class="bbs_list_top clear">
		<form>
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
			<tr>
				<th>검색엔진</th>
				<td>
					<select name="advisorEngine">
						<option value="">검색엔진 선택</option>
						<option value="naver.com"<?=$this->input->get("advisorEngine", true) == "naver.com" ? " selected" : ""?>>네이버</option>
						<option value="daum.net"<?=$this->input->get("advisorEngine", true) == "daum.net" ? " selected" : ""?>>다음</option>
					</select>
				</td>
			</tr>
		</table><!--/ board_search_table -->
		<div class="btn_center">
			<button type="submit" class="btn btn_point">검색</button>
			<a href="?type=<?=$type?>" class="btn btn_basic">전체목록</a>
		</div>
		</form>
	</div>
	
	<div class="advisor_key_wrap">
		<div class="table_list">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr>
						<th>검색순위</th>
						<th>검색엔진</th>
						<th>검색키워드</th>
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
						<td class="">
						<?php
						if(strpos($value['referer'], "daum.net") > -1) echo "다음";
						if(strpos($value['referer'], "naver.com") > -1) echo "네이버";
						?>
						</td>
						<td align="left" class=""><?=$value['words']?></td>
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
		<div class="paging dn">
			<span><a class="page_num on" href="#"><b>1</b></a></span><span><a href="#" data-ci-pagination-page="2">2</a></span><span><a href="#" data-ci-pagination-page="3">3</a></span><span class="arrow next"><a href="#" data-ci-pagination-page="2" rel="next">다음<img src="../../lib/admin/images/paging_next.gif" alt="다음"></a></span>
		</div>
	</div>
	<div class="terms_privecy_box">
		<dl>
			<dt> 포털사에서 유입될 때, 어떤 검색어를 통해서 유입되었는지를 순위별로 안내해드립니다.</dt>
			<dd>
			지원 포털사는 네이버, 다음이며 구글은 구글사의 정책상 검색키워드를 제공해주지 않으므로 키워드 분석 서비스가 제공되지 않습니다.<br/><br/>
			</dd>
		</dl>
	</div>
</div>
</div>