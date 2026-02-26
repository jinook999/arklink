<style>
.btn-modify, .btn-remove { background: #000; color: #fff; padding: 5px 10px; font-size: 12px; }
.btn-remove { background: #f00; }
.copy-this-string { position: relative; margin-left: 2px; }
#tooltip { position:absolute; left: 40px; top: 20px; z-index:9999; color:#fff; font-weight:10px; width:60px; line-height:20px; background-color:#000; padding:5px; border-radius:3px; opacity:.8; text-align:center; }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.11/clipboard.min.js"></script>
<script>
$(function() {
	$("#add-banner").on("click", function(e) {
		e.preventDefault();
		window.open("banner_write", "banner_write", "width=600, height=350, scrollbars=no");
	});

	$("a.btn-modify").on("click", function(e) {
		e.preventDefault();
		const link = $(this).attr("href");
		window.open(link, "banner_write", "width=600, height=350, scrollbars=no");
	});

	$("a.btn-remove").on("click", function(e) {
		e.preventDefault();
		const link = $(this).attr("href");
		if(confirm("삭제하시겠습니까?")) $(location).attr("href", link);
	});

	
	$("a.copy-this-string").on("click", function(e) {
		e.preventDefault();
		const clipboard = new ClipboardJS(".copy-this-string");
		clipboard.on("success", function(e) {
			if($("#tooltip").length > 0) return false;
			$(e.trigger).append("<div id='tooltip'>Copied!!</div>");
			setTimeout(function() {
				$("#tooltip").fadeOut(500);
				$("#tooltip").remove();
			}, 500);
		});
	});
});
</script>
<div id="contents">
	<div class="main_tit">
		<h2>배너 관리</h2>
		<div class="btn_right btn_num2">
		<?php
		if($this->_admin_member['userid'] === 'superman') :
			echo '<a href="banner_write" id="add-banner" class="btn point new_plus">+ 배너 등록</a>';
		endif;
		?>
		</div>
	</div>
	<div class="table_list">
		<table width="100%" cellpadding="0" cellspacing="0" border="0" id="banner-list">
			<colgroup>
				<col style="width: 80px;">
				<col style="width: 200px;">
				<col style="width: 200px;">
				<col style="width:;">
				<?php
				if($this->_admin_member['userid'] === 'superman') :
					echo '<col style="width: 200px;">';
				endif;
				?>
				<col style="width: 200px;">
				<col style="width: 150px;">
			</colgroup>
			<thead>
				<tr>
					<th scope="col">No.</th>
					<th scope="col">배너</th>
					<th scope="col">제목</th>
					<th scope="col">링크</th>
					<?php
					if($this->_admin_member['userid'] === 'superman') :
						echo '<th scope="col">치환코드</th>';
					endif;
					?>
					<th scope="col">등록일</th>
					<th scope="col">관리</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(count($lists) > 0) :
					foreach($lists as $key => $list) :
						$no = count($all) - $offset - $key;
				?>
				<tr>
					<td><?=$no?></td>
					<td><img src="<?=$list['image_rename']?>" alt="<?=$list['image_alt']?>" style="height: 50px;"></td>
					<td><?=$list['title']?></td>
					<td class="left"><?=$list['link']?></td>
					<?php
					if($this->_admin_member['userid'] === 'superman') :
						echo '<td><a href="#" class="copy-this-string" data-clipboard-text="{ =include_display_banner('.$list['no'].') }">{ =include_display_banner('.$list['no'].') }</a></td>';
					endif;
					?>
					<td><?=$list['regdate']?></td>
					<td>
						<a href="banner_write?no=<?=$list['no']?>" class="btn-modify">수정</a>
						<?php
						if($this->_admin_member['userid'] === 'superman') :
							echo '<a href="banner_remove?no='.$list['no'].'" class="btn-remove">삭제</a>';
						endif;
						?>
					</td>
				</tr>
				<?php
					endforeach;
				else :
					$colspan = $this->_admin_member['userid'] === 'superman' ? 7 : 6;
					echo '<tr><td colspan="'.$colspan.'">등록된 배너가 없습니다.</td></tr>';
				endif;
				?>
			</tbody>
		</table>
	</div><!--table_list-->
	<div class="btn_paging">
		<?=$pagination?>
	</div><!--btn_paging-->
</div>