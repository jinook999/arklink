<style>
dl#type-call-page label { font-weight: 700 !important; }
dl#type-call-page dd { margin-left: 20px; }
.preview { background: #000; color: #fff; line-height: 25px !important; height: 25px !important; font-size: 12px !important; }
#btn-duplication { background: #000; color: #fff; padding: 6px 10px; font-size: 12px; margin-left: 4px; }
.w100 { width: 100% !important; }
</style>
<script type="text/javascript" src="/lib/smarteditor2-master/workspace/static/js/service/HuskyEZCreator.js" charset="utf-8"></script>
<script>
$(function() {
	$("#btn-save").on("click", function(e) {
		e.preventDefault();
		getSmartEditor("content");
		$("#page-form").validate({
			rules: {
				title: "required",
				call_page: "required",
				page_name: "required",
				check_duplication: "required",
				content_file: "required",
			},
			messages: {
				title: { required: "제목을 입력해 주세요." },
				call_page: { required: "페이지 호출 방식을 선택해 주세요." },
				page_name: { required: "페이지 이름을 입력해 주세요." },
				check_duplication: { required: "페이지 이름 중복 확인을 해 주세요." },
				content_file: { required: "파일을 첨부해 주세요." },
			}
		});
		$("#page-form").submit();
	});

	$("#include-header").on("click", function() {
		const fl = $(this).is(":checked"), use_yn = $("#use-seo-n").is(":checked");
		$("#seo-table").find("input").attr("disabled", !fl);
		if(fl === true) $("#seo-title, #seo-author, #seo-description, #seo-keywords").attr("disabled", use_yn);
	});

	$(".use-seo").on("click", function() {
		const v = $(this).val();
		const fl = v === "y" ? false : true;
		$("#seo-title, #seo-author, #seo-description, #seo-keywords").attr("disabled", fl);
	});

	$(".call-pages").on("click", function() {
		const v = $(this).val(), fl = $(this).val() === "number" ? true : false;
		$("#check-duplication, #page-name").attr("disabled", fl);
		//$("#check-duplication, #page-name, #content-file").attr("disabled", fl);
	});

	$("#remove-attachment").on("click", function() {
		const fl = $(this).is(":checked");
		$("#content-file").attr("disabled", !fl);
	});

	$(".page-type").on("click", function() {
		const type = $(this).val(), iframe = $("#page-editor").find("iframe").css("height");
		$("#page-editor, #page-file").addClass("dn");
		$(".editor, .file").attr("disabled", true);
		$(`#page-${type}`).removeClass("dn");
		$(`.${type}`).attr("disabled", false);
		if(iframe === "0px") attachSmartEditor("content", "page_editor");
	});

	$("#btn-duplication").on("click", function() {
		$("#check-duplication").val("");
		$.get("get_duplication", {
			page_name: $("#page-name").val()
		}, function(res) {
			const result = JSON.parse(res);
			if(res === "null") {
				alert("중복 확인이 되었습니다.");
				$("#check-duplication").val("y");
			} else {
				if(result.no > 0) {
					alert("이미 등록된 이름입니다. 다른 이름으로 입력해 주세요.");
					$("#check-duplication, #page-name").val("");
					return false;
				}
			}
		});
	});

	$("#btn-remove").on("click", function(e) {
		e.preventDefault();
		const link = $(this).attr("href");
		if(confirm("삭제하시겠습니까?")) $(location).attr("href", link);
	});
});
</script>
<div id="contents">
	<div class="main_tit">
		<h2 class="board-name">페이지 관리</h2>
		<div class="btn_right btn_num2">
			<a class="btn gray" href="page_list">목록</a>
			<a href="#" id="btn-save" class="btn point">저장</a>
			<?php
			if($get['no'] > 0) :
				echo '<a href="remove_page?no='.$get['no'].'" id="btn-remove" class="btn red">삭제</a>';
			endif;
			?>
		</div>
	</div>
	<form name="pform" id="page-form" method="post" action="<?=$get['no'] > 0 ? 'page_update' : 'page_insert'?>" enctype="multipart/form-data">
		<input type="hidden" name="no" id="no" value="<?=$get['no']?>">
		<?php
		$check_duplication_disabled = ' disabled';
		if($get['no'] > 0) :
			$check_duplication_disabled = $write['call_page'] === 'number' ? ' disabled' : '';
		endif;
		?>
		<div class="table_write">
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<colgroup>
					<col width="12%">
					<col width="*">
				</colgroup>
				<tr>
					<th class="ta_left">제목</th>
					<td><input type="text" name="title" id="title" value="<?=$write['title']?>" style="width: 400px;"></td>
				</tr>
				<tr>
					<th>기존 헤더 / 푸터 포함 여부</th>
					<td>
						<input type="checkbox" name="include_header" id="include-header" value="y"<?=$write['include_header'] === 'y' ? ' checked' : ''?>><label for="include-header">헤더 포함</label>
						<input type="checkbox" name="include_footer" id="include-footer" value="y"<?=$write['include_footer'] === 'y' ? ' checked' : ''?>><label for="include-footer">푸터 포함</label>
					</td>
				</tr>
				<tr>
					<th>페이지 호출 방식</th>
					<td>
						<dl id="type-call-page">
							<dt><input type="radio" name="call_page" id="call-page-number" class="call-pages" value="number"<?=(!$get['no'] || $write['call_page'] === 'number') ? ' checked' : ''?>><label for="call-page-number">숫자로</label></dt>
							<dd style="margin-bottom: 10px;">숫자로 할 경우 따로 설정할 필요가 없으며 주소창에 표시되는 형식은 아래와 같습니다.<br><?=$this->input->server('HTTP_HOST')?><span style="color: #f00; font-weight: bold;">/page?no=1</span></dd>
							<dt><input type="radio" name="call_page" id="call-page-name" class="call-pages" value="name"<?=$write['call_page'] === 'name' ? ' checked' : ''?>><label for="call-page-name">파일명으로</label></dt>
							<dd>
								<input type="hidden" name="check_duplication" id="check-duplication" value="<?=$write['page_name'] ? 'y' : ''?>"<?=$check_duplication_disabled?>>
								<?php
								$page_name_disabled = ' disabled';
								if($get['no'] > 0) :
									$page_name_disabled = $write['call_page'] === 'number' ? ' disabled' : '';
								endif;
								?>
								파일명을 선택할 경우 이름이 중복되지 않게 입력하셔야 합니다.<br>
								아래 경로에서 company 부분에 해당하는 단어를 지정해 주시면 됩니다.<br>
								주소창에 표시되는 형식은 아래와 같습니다.<br>
								ex1) <?=$this->input->server('HTTP_HOST')?><span style="color: #f00; font-weight: bold;">/page?file=company</span><br>
								ex2) <?=$this->input->server('HTTP_HOST')?><span style="color: #f00; font-weight: bold;">/page?file=test.html</span><br>
								<input type="text" name="page_name" id="page-name" value="<?=$write['page_name']?>" style="width: 200px;" placeholder="한글 입력하지 마세요."<?=$page_name_disabled?>><button type="button" id="btn-duplication">중복 확인</button>
							</dd>
						</dl>
					</td>
				</tr>
				<tr>
					<th>내용 입력 방식</th>
					<td>
						<input type="radio" name="page_type" id="page-type-editor" class="page-type" value="editor" checked><label for="page-type-editor">에디터</label>
						<input type="radio" name="page_type" id="page-type-file" class="page-type" value="file" style="margin-left: 20px;"<?=$write['page_type'] === 'file' ? ' checked' : ''?>><label for="page-type-file">파일 업로드</label>
					</td>
				</tr>
				<tr id="page-editor"<?=isset($write['no']) === true && $write['page_type'] !== 'editor' ? ' class="dn"' : ''?>>
					<th>내용</th>
					<td><textarea name="content" id="content" class="editor" style="height: 470px;"<?=$write['page_type'] === 'file' ? ' disabled' : ''?>><?=$write['content']?></textarea></td>
				</tr>
				<tr id="page-file"<?=isset($write['no']) === false || $write['page_type'] === 'editor' ? ' class="dn"' : ''?>>
					<th>파일로 대체</th>
					<td>
						<input type="file" name="content_file" id="content-file" class="file"<?=isset($write['no']) === false || $write['page_type'] === 'editor' || $write['original'] ? ' disabled' : ''?>>
						<?php
						if($write['rename']) :
							$qs = $write['call_page'] === 'number' ? '?no='.$write['no'] : '?file='.$write['page_name'];
							echo '<div style="margin-top: 10px;"><a href="/page'.$qs.'" class="btn preview" target="_blank">'.$write['original'].'</a><br><input type="checkbox" name="remove_attachment" id="remove-attachment" value="/upload/page_attachment/'.$write['rename'].'"><label for="remove-attachment">첨부 파일을 삭제나 변경할 경우 반드시 체크해 주세요.</label></div>';
						endif;
						?>
					</td>
				</tr>
				<tr>
					<th>SEO</th>
					<td>
						<table id="seo-table">
							<colgroup>
								<col style="width: 200px;">
							</colgroup>
							<tr>
								<th>개별 SEO 사용</th>
								<td>
									<?php
									$disabled = ' disabled';
									if($write['include_header'] === 'y') $disabled = '';
									?>
									<input type="radio" name="use_seo" id="use-seo-n" class="use-seo" value="n" checked<?=$disabled?>><label for="use-seo-n">사용안함</label>
									<input type="radio" name="use_seo" id="use-seo-y" class="use-seo" value="y"<?=$write['use_seo'] === 'y' ? ' checked' : ''?><?=$disabled?>><label for="use-seo-y">사용</label>
								</td>
							</tr>
							<tr>
								<th>타이틀(Title)</th>
								<td><input type="text" name="seo_title" id="seo-title" class="w100" value="<?=$write['seo_title']?>"<?=$write['include_header'] !== 'y' || $write['use_seo'] !== 'y' ? ' disabled' : ''?>></td>
							</tr>
							<tr>
								<th>작성자(Author)</th>
								<td><input type="text" name="seo_author" id="seo-author" class="w100" value="<?=$write['seo_author']?>"<?=$write['seo_title']?>"<?=$write['include_header'] !== 'y' || $write['use_seo'] !== 'y' ? ' disabled' : ''?>></td>
							</tr>
							<tr>
								<th>설명(Description)</th>
								<td><input type="text" name="seo_description" id="seo-description" class="w100" value="<?=$write['seo_description']?>"<?=$write['seo_title']?>"<?=$write['include_header'] !== 'y' || $write['use_seo'] !== 'y' ? ' disabled' : ''?>></td>
							</tr>
							<tr>
								<th>키워드(Keywords)</th>
								<td><input type="text" name="seo_keywords" id="seo-keywords" class="w100" value="<?=$write['seo_keywords']?>"<?=$write['seo_title']?>"<?=$write['include_header'] !== 'y' || $write['use_seo'] !== 'y' ? ' disabled' : ''?>></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</form>
</div>
<script>
attachSmartEditor("content", "page_editor");
//disableEditor("content", "y");
</script>