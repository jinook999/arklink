<style>
.types, .subject, .files { width: 100% !important; }
.center { text-align: center; }
</style>
<script>
$(function() {
	$(".view-origin").on("click", function(e) {
		e.preventDefault();
		window.open($(this).attr("href"), "view_origin", "width=1400, height=800, scrollbars=yes");
	});

	$(".preview").on("click", function(e) {
		e.preventDefault();
		window.open($(this).attr("href"), "preview", "width=860, height=800, scrollbars=yes");
	});

	$(".modify").on("click", function(e) {
		e.preventDefault();
		const types = $(this).closest("tr").find("select.types").val();
		const subject = $(this).closest("tr").find("input.subject").val();
		const file = $(this).closest("tr").find("select.files").val();
		$("#no").val($(this).data("no"));
		$("#types").val(types);
		$("#subject").val(subject);
		$("#file").val(file);
		$("#t-form").submit();
	});

	$("#btn-smtp").on("click", function(e) {
		e.preventDefault();
		window.open("smtp", "set smtp", "width=500, height=350, scrollbars=no");
	});
});
</script>
<div id="contents">
	<div class="main_tit">
		<h2>메일 설정</h2>
		<div class="lang_icon_tab">
			<ul>
			<?php
			$language = $this->input->get('language') ? $this->input->get('language') : 'kor';
			foreach($this->_site_language['set_language'] as $eng => $kor) :
				$on = $eng === $language ? ' on' : '';
				echo '<li class="lang_'.$eng.$on.'"><a href="?language='.$eng.'">'.$kor.'</a></li>';
			endforeach;
			?>
			</ul>
		</div>
		<div class="btn_right">
				<a href="#" id="btn-smtp" class="btn point">SMTP 설정</a>
		</div>
	</div>

	<form method="post" id="t-form" action="set_manage_mail">
		<input type="hidden" name="mode" value="modify" />
		<input type="hidden" name="no" id="no" value="">
		<input type="hidden" name="language" value="<?=$language?>">
		<input type="hidden" name="types" id="types" value="">
		<input type="hidden" name="subject" id="subject" value="">
		<input type="hidden" name="file" id="file" value="">
	</form>
	<div class="table_write">
		<table cellpadding="0" cellspacing="0" border="0">
			<colgroup>
				<col style="width: 300px;">
				<col>
				<col style="width: 300px;">
				<col style="width: 200px;">
				<col style="width: 200px;">
			</colgroup>
			<thead>
				<tr>
					<th scope="col">분류</th>
					<th scope="col">제목</th>
					<th scope="col">스킨</th>
					<th scope="col">수정일</th>
					<th scope="col">상세보기</th>
				</tr>
			</thead>
			<tbody id="divList">
			<?php
			foreach($list as $value) :
			?>
				<tr>
					<td class="center">
						<select class="types">
						<?php
						$types = ['bbs' => '게시판 관리자', 'find_id' => '아이디 찾기', 'find_pw' => '패스워드 찾기', 'answer' => '메일 답변', 'admin' => '관리자에게 메일'];
						foreach($types as $type => $name) :
							$selected = $value['types'] === $type ? ' selected' : '';
							echo '<option value="'.$type.'"'.$selected.'>'.$name.'</option>';
						endforeach;
						?>
						</select>
					</td>
					<td><input type="text" class="subject" value="<?=$value['subject']?>"></td>
					<td class="">
						<select class="files">
							<option value="">스킨 선택</option>
							<?php
							foreach($files as $file) :
								$selected = $value['file'] === $file ? ' selected' : '';
								echo '<option value="'.$file.'"'.$selected.'>'.$file.'</option>';
							endforeach;
							?>
						</select>
					</td>
					<td class="center"><?=$value['mod_date']?></td>
					<td class="center">
						<a href="view_origin?no=<?=$value['no']?>" class="btn_mini view-origin">원본</a>
						<a href="view_skin?no=<?=$value['no']?>" class="btn_mini preview">보기</a>
						<a href="#" class="btn_mini modify" data-no="<?=$value['no']?>">수정</a>
					</td>
				</tr>
			<?php
			endforeach;
			?>
			</tbody>
		</table>
	</div>
	<div class="terms_privecy_box">
		<ul>
			<li>- 제목에 없는 값을 추가해야 할 경우엔 개발이 필요합니다.</li>
			<li>- 분류를 추가해야 할 경우 개발이 필요합니다.</li>
			<li>- 스킨 위치는 /data/mail_form/<?=$language?>입니다. 필요한 스킨은 ftp를 통해 해당 경로에 업로드를 하시면 됩니다.</li>
			<li>- 원본 버튼을 클릭하시면 해당 파일을 직접 수정이 가능합니다.</li>
			<li>- 보기 버튼을 클릭하시면 현재 메일 스킨을 보실 수가 있습니다.</li>
		</ul>
	</div>
</div>