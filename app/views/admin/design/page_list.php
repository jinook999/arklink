<style>
.underline { text-decoration: underline; text-underline-offset: 3px; }
.copy-this-string { position: relative; margin-left: 2px; }
#tooltip { position:absolute; left: -25px; top: 15px; z-index:9999; color:#fff; font-weight:10px; width:60px; line-height:20px; background-color:#000; padding:5px; border-radius:3px; opacity:.8; text-align:center; }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.11/clipboard.min.js"></script>
<script>
$(function() {
	const clipboard = new ClipboardJS(".copy-this-string");
	clipboard.on("success", function(e) {
		if($("#tooltip").length > 0) return false;
		$(e.trigger).append(`<div id="tooltip">Copied!!</div>`);
		setTimeout(function() {
			$("#tooltip").fadeOut(500);
			$("#tooltip").remove();
		}, 500);
	});
});
</script>
<div id="contents">
	<div class="main_tit">
		<h2>페이지</h2>
		<div class="btn_right btn_num2">
			<a href="page_write" class="btn point new_plus">+ 페이지 등록</a>
		</div><!--btn_right-->
	</div>
	<div class="table_write_info dn">* 팝업은 메인페이지에서만 노출되며, PC/모바일 동시 노출됩니다<a href="map?type=s" class="set-map"></a></div>
	<div class="main_search dn">
		<fieldset>
			<select name="search_type">
				<option value="title">제목</option>
			</select>
			<input type="text" class="searchBox" name="search">
			<button>검색</button>
		</fieldset>
	</div>
	<div class="table_list">
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="tableA">
			<colgroup>
				<col width="5%" />
				<col />
				<col width="13%" />
				<col width="7%" />
				<col width="7%" />
				<col width="7%" />
				<col width="7%" />
				<col width="10%" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">제목</th>
					<th scope="col">링크</th>
					<th scope="col">기존 헤더</th>
					<th scope="col">기존 푸터</th>
					<th scope="col">페이지 노출 방식</th>
					<th scope="col">미리 보기</th>
					<th scope="col">등록일</th>
				</tr>
			</thead>
			<tbody>
			<?php
			if(count($list) > 0) :
				foreach($list as $key => $value) :
					$no = count($all) - $offset - $key;
					$page = $value['call_page'] === 'number' ? 'no='.$value['no'] : 'file='.$value['page_name'];
			?>
				<tr>
					<td><?=$no?></td>
					<td class="left"><a href="page_write?no=<?=$value['no']?>" class="underline"><?=$value['title']?></a></td>
					<td><button type="button" class="copy-this-string" data-clipboard-text="/page?<?=$page?>">/page?<?=$page?></button></td>
					<td><?=$value['include_header'] === 'y' ? '사용함' : '사용안함'?></td>
					<td><?=$value['include_footer'] === 'y' ? '사용함' : '사용안함'?></td>
					<td><?=$value['page_type'] === 'editor' ? '에디터' : '첨부 파일'?></td>
					<td><a href="/page?<?=$page?>" class="underline" target="_blank">미리 보기</a></td>
					<td><?=$value['regdate']?></td>
				</tr>
			<?
				endforeach;
			else :
				echo '<tr><td colspan="9">등록된 페이지가 없습니다.</td></tr>';
			endif;
			?>
			</tbody>
		</table>
	</div><!--table_list-->
	<div class="btn_paging">
		<div class="paging"><?=$pagination?></div><!--paging-->
	</div><!--btn_paging-->
</div><!-- // contents -->