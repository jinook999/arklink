<?php
$qs = [];
foreach($this->input->get() as $key => $value) :
	$qs[] = $key.'='.$value;
endforeach;
$blocked_ip = explode('|', $manage['blocked_ip']);
?>
<style>
.blocked { text-decoration: line-through; }
</style>
<script>
<?php if(in_array($board_info['code'], ['cert', 'patent'])) : ?>
	function sortOrderMove(direction) {
		var checked = $("input[name='no[]']:checked");
		if(checked.length !== 1) {
			alert("순서를 변경할 게시글을 하나만 선택해주세요.");
			return;
		}
		var no = checked.val();
		$.ajax({
			url: "/admin/board/sort_order_update",
			type: "POST",
			data: { code: "<?=$board_info['code']?>", no: no, direction: direction },
			dataType: "json",
			success: function(res) {
				if(res.code) {
					// 두 행의 순서 셀만 교체 (체크 유지)
					var $curRow = checked.closest("tr");
					var $curOrderCell = $curRow.find("td:nth-child(2)");

					if(direction === 'up') {
						var $targetRow = $curRow.prev("tr");
					} else {
						var $targetRow = $curRow.next("tr");
					}

					if($targetRow.length) {
						var $targetOrderCell = $targetRow.find("td:nth-child(2)");
						var curVal = $curOrderCell.text();
						var tgtVal = $targetOrderCell.text();
						$curOrderCell.text(tgtVal);
						$targetOrderCell.text(curVal);

						// 행 자체를 이동
						if(direction === 'up') {
							$curRow.insertBefore($targetRow);
						} else {
							$curRow.insertAfter($targetRow);
						}
					}
				} else {
					alert(res.msg || "순서 변경에 실패했습니다.");
				}
			},
			error: function() {
				alert("오류가 발생했습니다.");
			}
		});
	}
<?php endif ?>
</script>
<script>
	$(function(){
		language_change("<?=$this->input->get('language', true)?>");

		$('#roundpage').on('change', function() {
			$('input[name="roundpage"]').val($(this).val());
			$('#search_frm').submit();
		});

		$("a.block-this-ip").on("click", function(e) {
			e.preventDefault();
			const ip = $(this).data("ip");
			const qs = $("#qs").val();
			if(confirm("해당 아이피를 차단하시겠습니까?")) {
				$("#client-ip").val(ip);
				$("#frm").attr("action", "client_blocked_ip").submit();
			}
		});

		$("#manage-admin").on("click", function(e) {
			e.preventDefault();
			const lnk = $(this).attr("href");
			window.open(lnk, "manage admin", "width=400, height=400, scrollbars=yes");
		});
	});

	function codeProc(form, mode) {
		form.mode.value = mode;

		form.search_type.value = $("[name='files'] option:selected", "[name='search_frm']").val()
		form.search.value = $("[name='search']", "[name='search_frm']").val()
		form.files.value =  $("[name='files'] option:selected", "[name='search_frm']").val();

		var proc_type = $("[name='proc_type'] option:selected", form).val();

		if(proc_type == "select" && !$("[name='no[]']").is(":checked")) {
			alert("선택된 항목이 없습니다.");
			return false;
		}

		if(<?=$total_rows?> < 1) {
			alert("검색된 항목이 없습니다.");
			return false;
		}
		//2020-03-11 Inbet Matthew 선택 게시글 삭제시 컨펌 기능 추가
		if (mode == 'delete'){
			if(!confirm("선택한 게시글을 삭제하시겠습니까? 삭제된 게시글은 복구하실 수 없습니다.")) {
				return false;
			}
		}
		//Matthew End
		form.submit();
	}

	function code_change(form, code) {
		var query_string = '';
		<?php if($this->_site_language["multilingual"]) : ?>
		query_string = "&"+ form.language.options[form.language.selectedIndex].value
		<?php endif ?>
		location.href = "board_list?code="+ code +"&roundpage=10" + query_string;
	}

	function language_change(language,obj) {
        if(typeof language != "undefined" && language != null) {
            $("[name='language']").val(language).prop("selected",true);
        }

		if(obj){
			$(".lang_tab").find("li").each(function(i,e){
			if($(e).hasClass("on")){
				$(e).removeClass("on");
				}
			});

			$(obj).closest("li").addClass("on");
            document.search_frm.submit();
		}
	}
</script>
<div id="contents">
	<div class="main_tit">
		<h2>게시글 관리</h2>
		<div class="btn_right">
			<?php
			if($this->_admin_member['userid'] === 'superman') :
				echo '<a href="/admin/auth/board_manage_reg?code='.$this->_board['code'].'" class="btn point" target="_blank">게시판 설정</a>';
			endif;
			
			if($this->_admin_member['level'] > 98) :
				echo '<a href="manage_admin?code='.$this->_board['code'].'" id="manage-admin" class="btn point" target="_blank">관리자 설정</a>';
			endif;
			?>
			<a href="/board/board_list?code=<?=$board_info['code']?>" class="btn point" target="_blank">미리보기</a>
			<a href="board_write?code=<?=$board_info["code"]?>" class="btn point new_plus">+ 게시글 쓰기</a>
		</div>
	</div>
	<div class="sub_tit"><h3>게시판 검색</h3></div>
	<div class="bbs_list_top clear">
	    <?=form_open("", array("name" => "search_frm", "id" => "search_frm", "method"=>"GET"));?>
		<input type="hidden" name="roundpage" value="<?=$this->_board['roundpage']?>">
		<!-- input type="hidden" id="qs" value="<?=implode('&', $qs)?>" -->
		<table class="board_search_table">
			<colgroup>
				<col width="150px">
			</colgroup>
			<tr>
				<th>게시판 검색</th>
				<td>
					<select name="code" onchange="code_change(this.form, this.value);">
						<?php foreach($board_manage_list as $value) : ?>
							<option value="<?=$value['code']?>" <?php if($board_info["code"] == $value['code']) : ?>selected<? endif; ?>><?=$value['name']?>(<?=$value['code']?>)</option>
						<?php endforeach; ?>
					</select>
					<?php if($this->_site_language["multilingual"]) : ?>
						<select name="language" onchange="this.form.submit();">
							<option value="" >언어선택</option>
							<?php foreach($this->_site_language["support_language"] as $key => $value) :?>
								<option value="<?=$key?>" <?=$this->input->get("language", true) == $key ? "selected" : ""?>><?=$value?></option>
							<?php endforeach ?>
						</select>
					<?php endif ?>
				</td>
			</tr>
			<tr>
				<th>검색어</th>
				<td>
					<fieldset>
						<!-- select name="comment" style="margin-right: 10px;">
							<option value="">관리자 답변</option>
							<option value="y" <?php echo set_select('comment', 'y'); ?>>응답</option>
							<option value="n" <?php echo set_select('comment', 'n'); ?>>미응답</option>
						</select -->
						<select name="files" class="dn">
							<option value="">첨부파일 유무</option>
							<option value="y" <?php if($this->input->get("files", true) == "y") : ?>selected<?php endif; ?>>첨부</option>
							<option value="n" <?php if($this->input->get("files", true) == "n") : ?>selected<?php endif; ?>>미첨부</option>
						</select>
						<select name="search_type" style="margin-left: 0;">
							<option value="" <?php if($this->input->get("search_type", true) == "") : ?>selected<?php endif; ?>>전체</option>
							<option value="userid" <?php if($this->input->get("search_type", true) == "userid") : ?>selected<?php endif; ?>>아이디</option>
							<option value="name" <?php if($this->input->get("search_type", true) == "name") : ?>selected<?php endif; ?>>작성자</option>
							<option value="title" <?php if($this->input->get("search_type", true) == "title") : ?>selected<?php endif; ?>>제목</option>
							<option value="content" <?php if($this->input->get("search_type", true) == "content") : ?>selected<?php endif; ?>>내용</option>
							<!-- option value="userip" <?php if($this->input->get("search_type", true) == "userip") : ?>selected<?php endif; ?>>아이피</option -->
						</select>
						<input type="text" name="search" value="<?=$this->input->get("search", true)?>" />
						<button>검색</button>
					</fieldset>
				</td>
			</tr>
		</table><!--/ board_search_table -->
		<?=form_close()?>
	</div>
	<?php
	$langs = ['kor' => '한국어', 'eng' => '영어', 'chn' => '중국어', 'jpn' => '일어'];
	echo form_open("/admin/board/board_proc", array("name" => "frm", "id" => "frm", "method" => "POST"));
	?>
		<input type="hidden" name="code" value="<?=$board_info["code"]?>" />
		<input type="hidden" name="mode" />
		<input type="hidden" name="search_type" />
		<input type="hidden" name="search" />
		<input type="hidden" name="files" />
		<input type="hidden" name="client_ip" id="client-ip">
		<input type="hidden" name="qs" id="qs" value="<?=implode('&', $qs)?>">
		<input type="hidden" name="blocked_ip" value="<?=$manage['blocked_ip']?>">
		<div class="board_top sub_tit">
			<h3>게시글 목록</h3>
			<?php if(in_array($board_info['code'], ['cert', 'patent'])) : ?>
			<div style="display:inline-block; margin-right:10px;">
				<a href="javascript://" onclick="sortOrderMove('up');" class="btn btnline1">▲ 위로</a>
				<a href="javascript://" onclick="sortOrderMove('down');" class="btn btnline1">▼ 아래로</a>
			</div>
			<?php endif ?>
			<select id="roundpage" class="roundpage">
				<option value="10" <?php if($this->input->get("roundpage", true) == "10") : ?>selected<?php endif; ?>>10개씩 보기</option>
				<option value="20" <?php if($this->input->get("roundpage", true) == "20") : ?>selected<?php endif; ?>>20개씩 보기</option>
				<option value="30" <?php if($this->input->get("roundpage", true) == "30") : ?>selected<?php endif; ?>>30개씩 보기</option>
				<option value="50" <?php if($this->input->get("roundpage", true) == "50") : ?>selected<?php endif; ?>>50개씩 보기</option>
				<option value="100" <?php if($this->input->get("roundpage", true) == "100") : ?>selected<?php endif; ?>>100개씩 보기</option>
			</select>
		</div><!--/ board_top -->
		<div class="table_list">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="tableA">
				<colgroup>
					<col width="3%" />
					<col width="7%" />
					<?php
					if($this->_site_language['multilingual']) echo '<col width="7%">';
					?>
					<col width="*%" />
					<col width="10%" />
					<col width="10%" />
					<?php
					if($board_info["DEFAULT_BOARD"] == $board_info["board_type"]) echo '<col width="10%" />';
					if($board_info["QNA_BOARD"] == $board_info["board_type"]) echo '<col width="10%" />';
					if($manage['use_client_blocked_ip'] === 'y' && $this->_admin_member['userid'] === 'superman') echo '<col width="7%">';
					?>
				</colgroup>
				<thead>
					<tr>
						<th scope="col"><input type="checkbox" onchange="checkToggle(this, 'no[]');" /></th>
						<th scope="col"><?php echo in_array($board_info['code'], ['cert', 'patent']) ? '순서' : '번호' ?></th>
						<?php
						if($this->_site_language['multilingual']) echo '<th scope="col">언어</th>';
						?>
						<th scope="col">제목</th>
						<th scope="col">작성자</th>
						<th scope="col">등록일</th>
						<?php
						if($board_info["DEFAULT_BOARD"] == $board_info["board_type"]) echo '<th scope="col">조회수</th>';
						if($board_info["QNA_BOARD"] == $board_info["board_type"]) echo '<th scope="col">상태</th>';
						if($manage['use_client_blocked_ip'] === 'y') echo '<th scope="col">아이피</th>';
						?>
					</tr>
				</thead>
				<tbody id="divList">
					<?php if(isset($notice_list)) : ?>
						<?php foreach($notice_list as $key => $value) : ?>
							<?php if ($value['language'] == $this->input->get("language", true) || $this->input->get("language", true) == '') { ?>
							<tr class="board-notice">
								<td><input type="checkbox" name="no[]" value="<?=$value["no"]?>" /></td>
								<td>공지</td>
								<?php
								if($this->_site_language['multilingual']) echo '<td>'.$langs[$value['language']].'</td>';
								?>
								<td class="left">
									<?php if($value["is_secret"] == "y") : ?><img src="/lib/images/icon_secret.gif" alt="비밀글"><?php endif ?>
									<a href="board_view?code=<?=$value["code"]?>&no=<?=$value["no"]?>"><?=$value["title"]?></a> <?php if($board_info["comment"] == "y" && $value["comment"] > "0") : ?>[<?=$value["comment"]?>]<?php endif ?>
									<?php if($board_info['files'] == 'y') : ?>
										<?php if(count($value["board_file"]["file"])) : ?><!-- 첨부파일이 있을 때 -->
											&nbsp;<img src="/lib/images/icon_attach_file.png" alt="첨부파일">
										<?php endif ?>
									<?php endif ?>
									<?php if($board_info['thumbnail'] == 'y') : ?>
										<?php if(count($value["board_file"]["thumbnail"])) : ?><!-- 섬네일이 있을 때 -->
											&nbsp;<img src="/lib/images/icon_attach_img.png" alt="썸네일">
										<?php endif ?>
									<?php endif ?>
								</td>
								<td><?=$value["name"]?></td>
								<td><?=$value["regdt_date"]?></td>
								<?php
								if($board_info["DEFAULT_BOARD"] == $board_info["board_type"]) echo '<td>'.$value["hit"].'</td>';
								if($board_info["QNA_BOARD"] == $board_info["board_type"]) echo '<td>'.($value["answer_stuats"] == "y" ? "완료" : "대기").'</td>';
								if($manage['use_client_blocked_ip'] === 'y') :
									if(in_array($value['userip'], $blocked_ip) === true) :
										echo '<td><span class="blocked">'.$value['userip'].'</span></td>';
									else :
										echo '<td><a href="#" class="block-this-ip" data-ip="'.$value['userip'].'">'.$value['userip'].'</a></td>';
									endif;
								endif;
								?>
							</tr>
							<?php } ?>
						<?php endforeach ?>
					<?php endif ?>
					<?=$curpage?>
					<?php if(isset($board_list)) : ?>
						<?php foreach($board_list as $key => $value) : ?>
							<tr>
							<td><input type="checkbox" name="no[]" value="<?=$value["no"]?>" /></td>
							<td><?php if(in_array($board_info['code'], ['cert', 'patent'])) : ?><?=isset($value['sort_order']) ? $value['sort_order'] : '-'?><?php else : ?><?=$total_rows - $key - $offset?><?php endif ?></td>
								<?php
								if($this->_site_language['multilingual']) echo '<td>'.$langs[$value['language']].'</td>';
								?>
								<td class="left">
									<?php if($value["clevel"] > "0") : ?><img src="/lib/images/icon_re.gif" alt="답글"><?php endif ?>
									<?php if($value["is_secret"] == "y") : ?><img src="/lib/images/icon_secret.gif" alt="비밀글"><?php endif ?>
									<?php if($value["origin_no"] == "") : ?>[원글이 삭제된 답글]<?php endif ?> 
									<a href="board_view?code=<?=$value["code"]?>&no=<?=$value["no"]?>&per_page=<?=$this->input->get("per_page", true)?>&language=<?=$this->input->get("language", true)?>&search_type=<?=$this->input->get("search_type", true)?>&search=<?=urlencode($this->input->get("search", true))?>&files=<?=$this->input->get("files", true)?>&roundpage=<?=$this->input->get("roundpage", true)?>"><?php if(ib_isset($value['preface'])) :?>[<?=$value['preface']?>] <?php endif?><?=$value["title"]?></a> <?php if($board_info["comment"] == "y" && $value["comment"] > "0") : ?>[<?=$value["comment"]?>]<?php endif ?>
									<?php if($board_info['files'] == 'y') : ?>
										<?php if(count($value["board_file"]["file"])) : ?><!-- 첨부파일이 있을 때 -->
											&nbsp;<img src="/lib/images/icon_attach_file.png" alt="첨부파일">
										<?php endif ?>
									<?php endif ?>
									<?php if($board_info['thumbnail'] == 'y') : ?>
										<?php if(count($value["board_file"]["thumbnail"])) : ?><!-- 섬네일이 있을 때 -->
											&nbsp;<img src="/lib/images/icon_attach_img.png" alt="썸네일">
										<?php endif ?>
									<?php endif ?>
								</td>
								<td><?=$value["name"]?></td>
								<td><?=$value["regdt_date"]?></td>
								<?php
								if($board_info["DEFAULT_BOARD"] == $board_info["board_type"]) echo '<td>'.$value["hit"].'</td>';
								if($board_info["QNA_BOARD"] == $board_info["board_type"]) echo '<td'.($value['answer_status'] != "y" ? " class='answer_no'" : " class='answer_ok'").'>'.($value["answer_status"] == "y" ? "완료" : "대기").'</td>';
								if($manage['use_client_blocked_ip'] === 'y') :
									if(in_array($value['userip'], $blocked_ip) === true) :
										echo '<td><span class="blocked">'.$value['userip'].'</span></td>';
									else :
										echo '<td><a href="#" class="block-this-ip" data-ip="'.$value['userip'].'">'.$value['userip'].'</a></td>';
									endif;
								endif;
								?>
							</tr>
						<?php endforeach ?>
					<?php else : ?>
						<tr>
							<td colspan="6">게시글이 없습니다.</td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div><!--table_list-->
		<div class="bbs_list_btm clear">
			<div class="bbs_btn_del">선택한 게시글 <a href="javascript://" onclick="codeProc(document.frm, 'delete');" class="btn btnline1">삭제</a></div>
			<div class="bbs_btn_move">
				<select name="proc_type">
					<option value="select">선택한 게시글</option>
					<option value="search">검색된 게시글</option>
				</select>
				<span class="titles">&nbsp;을&nbsp;&nbsp;</span>
				<select name="proc_code">
					<?php foreach($board_manage_list as $value) : ?>
							<option value="<?=$value['code']?>"><?=$value['name']?>(<?=$value['code']?>)</option>
					<?php endforeach; ?>
				</select>
				<span class="titles">&nbsp;로&nbsp;&nbsp;</span>
				<a href="javascript://" onclick="codeProc(document.frm, 'move');" class="btn btnline1">이동</a>
				<a href="javascript://" onclick="codeProc(document.frm, 'copy');" class="btn btnline1">복사</a>
			</div>
		</div>
		<div class="table_write_info">** 게시글 이동/복사시 추가필드는 복사가 되지 않습니다. **</div>
		<?=$pagination?>
	<?=form_close()?>
</div><!-- // contents -->