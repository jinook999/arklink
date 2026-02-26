<link rel="stylesheet" href="/lib/admin/css/reset.css">
<link rel="stylesheet" href="/lib/admin/css/skin.css">
<link rel="stylesheet" href="/lib/admin/css/admin_css.css">
<style>
#contents { padding: 30px !important; }
.attach-file { background: #000; color: #fff; padding: 5px 10px; cursor: pointer; }
#btn-submit, #btn-close { background: #000; color: #fff; padding: 5px 20px; font-size: 12px; }
a.remove-image { font-weight: 600; color: #f00; }
#remove-first { color: #f00; }
</style>
<script src="/lib/js/jquery-2.2.4.min.js"></script>
<script>
$(function() {
    $(".fake-files").on("change", function() {
        const _this = $(this);
		const file = this.files[0];
        const formData = new FormData();
        formData.append("upload", file);
        formData.append("dir", "banner");
        formData.append("allowed_types", "jpeg|jpg|png");
        $.ajax({
            url: "upload",
            type: "post",
            mimeType: "multipart/form-data",
            data: formData,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                if(res.fl == "success") {
                    _this.siblings(".oname").val(res.oname);
                    _this.siblings(".rname").val("/upload/banner/" + res.rname);
                    _this.siblings("span.str").html(`<a href="/fileRequest/download?file=/banner/${res.rname}&save=${file.name}">${res.oname}</a> <a href="remove_image?image=${res.rname}" class="remove-image" data-saved="n">X</a>`);
					$("#attach-file").prop("disabled", true);
					$("#remove-first").text("(이미지를 변경하시려면 첨부된 이미지를 먼저 삭제하셔야 합니다)");
                } else {
                    alert(res.fl);
                }
            }
        });
    });
	
	$(document).on("click", "a.remove-image", function(e) {
		e.preventDefault();
		const link = $(this).prop("href"), saved = $(this).data("saved");
		if(confirm("삭제하시겠습니까?")) {
			$.get(link, function(res) {
				opener.location.reload();
			});
		}

		$("#attach-file").prop("disabled", false);
		$(".oname, .rname").val("");
		$(".str, #remove-first").html("");
	});
});
</script>
<div id="contents">
	<div class="table_write">
		<form method="post" action="banner_<?=$write['no'] > 0 ? 'update' : 'insert'?>">
			<input type="hidden" name="no" id="no" value="<?=$write['no']?>">
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<colgroup>
					<col style="width: 140px;">
					<col width="*">
				</colgroup>
				<tbody>
					<tr>
						<th>제목</th>
						<td><input type="text" name="title" value="<?=$write['title']?>"></td>
					</tr>
					<tr>
						<th>이미지</th>
						<td>
							<div style="margin-bottom: 5px;">
								<input type="hidden" name="image_original" class="oname" value="<?=$write['image_original']?>">
								<input type="hidden" name="image_rename" class="rname" value="<?=$write['image_rename']?>">
								<input type="file" id="attach-file" class="fake-files dn">
								<label for="attach-file" class="attach-file">파일 첨부</label>
								<span class="str">
								<?php
								if($write['image_rename']) :
									echo '<a href="/fileRequest/download?file='.str_replace('/upload', '', $write['image_rename']).'&save='.$write['image_original'].'">'.$write['image_original'].'</a><a href="remove_image?no='.$write['no'].'&image='.$write['image_rename'].'" class="remove-image" data-saved="y">X</a>';
								endif;
								?>
								</span>
								<p id="remove-first"><?=$write['image_rename'] ? '(이미지를 변경하시려면 첨부된 이미지를 먼저 삭제하셔야 합니다)' : ''?></p>
							</div>
							<input type="text" name="image_alt" value="<?=$write['image_alt']?>" size="30" placeholder="이미지 alt">
						</td>
					</tr>
					<tr>
						<th>링크</th>
						<td>
							<div>
								<input type="checkbox" name="link_target" id="link-target" value="_blank"<?=$write['link_target'] === '_blank' ? ' checked' : ''?>>
								<label for="link-target">링크를 새 창으로 띄웁니다.</label>
							</div>
							<input type="text" name="link" value="<?=$write['link']?>" style="width: 100%;">
						</td>
					</tr>
				</tbody>
			</table>
			<div style="text-align: center; margin-top: 10px;">
				<button id="btn-submit"><?=$write['no'] > 0 ? '수정' : '등록'?></button>
				<button type="button" id="btn-close" onclick="window.close()">닫기</button>
			</div>
		</form>
	</div>
</div>