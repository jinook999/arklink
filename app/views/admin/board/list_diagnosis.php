<?php
$qs = [];
foreach($this->input->get() as $key => $value) :
	$qs[] = $key.'='.$value;
endforeach;
$blocked_ip = explode('|', $manage['blocked_ip']);
?>
<style>
.blocked { text-decoration: line-through; }
.gender-info { font-weight: bold; color: #007cba; }
</style>
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
		<h2>피해 진단 관리</h2>
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
	<div class="sub_tit"><h3>피해 진단 검색</h3></div>
	<div class="bbs_list_top clear">
	    <?=form_open("", array("name" => "search_frm", "id" => "search_frm", "method"=>"GET"));?>
		<input type="hidden" name="code" value="<?=$board_info["code"]?>" />
		<input type="hidden" name="roundpage" value="<?=$this->input->get("roundpage", true)?>" />
		<table class="board_search_table" cellpadding="0" cellspacing="0" border="0" width="100%">
			<colgroup>
				<col width="10%">
				<col width="*">
			</colgroup>
			<?php if($this->_site_language["multilingual"]) : ?>
			<tr>
				<th>언어</th>
				<td>
					<ul class="lang_tab">
						<li <?php if($this->input->get("language", true) == "" || $this->input->get("language", true) == "kor") : ?>class="on"<?php endif; ?>><a href="javascript://" onclick="language_change('kor',this);">한국어</a></li>
						<li <?php if($this->input->get("language", true) == "eng") : ?>class="on"<?php endif; ?>><a href="javascript://" onclick="language_change('eng',this);">영어</a></li>
						<li <?php if($this->input->get("language", true) == "chn") : ?>class="on"<?php endif; ?>><a href="javascript://" onclick="language_change('chn',this);">중국어</a></li>
						<li <?php if($this->input->get("language", true) == "jpn") : ?>class="on"<?php endif; ?>><a href="javascript://" onclick="language_change('jpn',this);">일어</a></li>
					</ul>
					<select name="language" class="dn">
						<option value="kor" <?php if($this->input->get("language", true) == "kor") : ?>selected<?php endif; ?>>한국어</option>
						<option value="eng" <?php if($this->input->get("language", true) == "eng") : ?>selected<?php endif; ?>>영어</option>
						<option value="chn" <?php if($this->input->get("language", true) == "chn") : ?>selected<?php endif; ?>>중국어</option>
						<option value="jpn" <?php if($this->input->get("language", true) == "jpn") : ?>selected<?php endif; ?>>일어</option>
					</select>
				</td>
			</tr>
			<?php endif ?>
			<tr>
				<th>검색어</th>
				<td>
					<fieldset>
						<select name="search_type" style="margin-left: 0;">
							<option value="" <?php if($this->input->get("search_type", true) == "") : ?>selected<?php endif; ?>>전체</option>
							<option value="userid" <?php if($this->input->get("search_type", true) == "userid") : ?>selected<?php endif; ?>>아이디</option>
							<option value="name" <?php if($this->input->get("search_type", true) == "name") : ?>selected<?php endif; ?>>작성자</option>
							<option value="gender" <?php if($this->input->get("search_type", true) == "gender") : ?>selected<?php endif; ?>>성별</option>
							<option value="title" <?php if($this->input->get("search_type", true) == "title") : ?>selected<?php endif; ?>>제목</option>
							<option value="content" <?php if($this->input->get("search_type", true) == "content") : ?>selected<?php endif; ?>>내용</option>
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
			<h3>피해 진단 목록</h3>
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
					<col width="8%" />
					<col width="10%" />
					<?php
					if($manage['use_client_blocked_ip'] === 'y' && $this->_admin_member['userid'] === 'superman') echo '<col width="7%">';
					?>
				</colgroup>
				<thead>
					<tr>
						<th scope="col"><input type="checkbox" onchange="checkToggle(this, 'no[]');" /></th>
						<th scope="col">번호</th>
						<?php
						if($this->_site_language['multilingual']) echo '<th scope="col">언어</th>';
						?>
						<th scope="col">제목</th>
						<th scope="col">작성자</th>
						<th scope="col">성별</th>
						<th scope="col">등록일</th>
						<?php
						if($manage['use_client_blocked_ip'] === 'y') echo '<th scope="col">아이피</th>';
						?>
					</tr>
				</thead>
				<tbody id="divList">
					<?=$curpage?>
					<?php if(isset($board_list)) : ?>
						<?php foreach($board_list as $key => $value) : ?>
							<tr>
								<td><input type="checkbox" name="no[]" value="<?=$value["no"]?>" /></td>
								<td><?=$total_rows - $key - $offset?></td>
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
								<td><span class="gender-info"><?=!empty($value["gender"]) ? $value["gender"] : '-'?></span></td>
								<td><?=$value["regdt_date"]?></td>
								<?php
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
					<?php endif ?>
				</tbody>
			</table>
		</div><!--table_list-->
		<div class="btn_paging">
			<?=$pagination?>
		</div><!--btn_paging-->
		<div class="btn_bottom">
			<select name="proc_type">
				<option value="select">선택한 항목만</option>
				<option value="all">검색된 전체</option>
			</select>
			<a href="javascript://" onclick="codeProc(document.frm, 'delete');" class="btn gray sel_minus">삭제</a>
		</div><!--btn_bottom-->
	<?=form_close()?>
</div><!-- //contents END -->
