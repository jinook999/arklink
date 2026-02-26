<?php /* Template_ 2.2.8 2025/09/18 17:19:37 /gcsd33_arklink/www/data/skin/respon_default/board/view.html 000016391 */ 
$TPL_extraFieldData_1=empty($TPL_VAR["extraFieldData"])||!is_array($TPL_VAR["extraFieldData"])?0:count($TPL_VAR["extraFieldData"]);?>
<?php $this->print_("header",$TPL_SCP,1);?>

<!-- <script type="text/javascript" src="/lib/js/common_board.js"></script> -->
<script type="text/javascript" src="<?php echo $TPL_VAR["js"]?>/js/common_board.js"></script>
<script type="text/javascript" >
	var Common_Board = new common_board({
		code : "<?php echo $TPL_VAR["board_info"]['code']?>",
		no : "<?php echo $TPL_VAR["board_view"]['board_view']['no']?>",
		is_login : "<?php echo defined('_IS_LOGIN')?>",
		nonMember_title : "<?php echo $TPL_VAR["terms"]['nonMember']['title']?>",
	});

	$(function() {
		$("form[name='comment_frm']").validate({
			rules : {
				name : {required : true},
				password : {required : true, rangelength : [4, 20]},
				//content : {required : {depends : function(){return !getSmartEditor("comment");}}},
				content : {required : true},
				file : {}
			}, messages : {
				name : {required : "작성자를 입력해주세요."},
				password : {required : "비밀번호를 입력해주세요.", rangelength: $.validator.format("비밀번호는 {0}~{1}자입니다.")},
				content : {required : "내용을 입력해주세요."},
				file : {}
			}
		});
	});

	function comment_modify_display(idx, is_display) {
		var display_comment = $("#display_comment_"+ idx);

		if(is_display) {
			$("#modify_comment_content_"+ idx +", #modify_comment_btn_"+ idx, display_comment).removeClass("hide");
			$("#view_comment_btn_"+ idx + ", #view_comment_content_"+ idx, display_comment).addClass("hide");
		} else {
			$("#modify_comment_content_"+ idx +", #modify_comment_btn_"+ idx, display_comment).addClass("hide");
			$("#view_comment_btn_"+ idx + ", #view_comment_content_"+ idx, display_comment).removeClass("hide");
		}
	}

	function comment_modify_check(idx, is_secret) {
		var display_comment = $("#display_comment_"+ idx);
		$("[name='mode_"+ idx +"']", display_comment).val("modify");

		if(is_secret == 'y') {
			comment_modify_display(idx, true);
		} else {
			$("#layer_password_"+ idx, display_comment).addClass("modify").removeClass("hide").find(":password").focus();
		}
	}

	function comment_delete_check(idx, is_secret) {
		var display_comment = $("#display_comment_"+ idx);
		$("[name='mode_"+ idx +"']", display_comment).val("delete");

		if(is_secret == 'y') {
			Common_Board.board_comment_delete(idx);
		} else {
			$("#layer_password_"+ idx, display_comment).removeClass("modify").removeClass("hide").find(":password").focus();
		}
	}

	function comment_password_layer_close(idx) {
		var display_comment = $("#display_comment_"+ idx);
		$("#layer_password_"+ idx).addClass("hide");
		$("[name='password_"+ idx +"']", display_comment).val("");
	}

	function comment_password_enter(idx) {
		if (event.keyCode == 13) {
			Common_Board.board_comment_password_check(idx);
		}
	}
</script>
<div class="sub_content">
	<div class="sub_board">
		<div class="bbs_view">
			<div class="view_tit">
				<h3><?php if($TPL_VAR["board_view"]['board_view']['preface']){?>[<?php echo $TPL_VAR["board_view"]['board_view']['preface']?>] <?php }?><?php echo $TPL_VAR["board_view"]['board_view']['title']?></h3>
<?php if($TPL_VAR["board_info"]['code']=='content'){?>
                    <p><?php echo date("Y.m.d",strtotime($TPL_VAR["board_view"]["board_view"]["fdate"]))?></p>
<?php }?>
			</div>
<?php if($TPL_VAR["board_info"]['yn_mobile']=='y'||$TPL_VAR["board_info"]['yn_email']=='y'){?>
			<div class="view_etc dn">
<?php if($TPL_VAR["board_info"]['yn_mobile']=='y'){?><span><em>연락처</em><?php echo $TPL_VAR["board_view"]['board_view']['mobile']?></span><?php }?>
<?php if($TPL_VAR["board_info"]['yn_email']=='y'){?><span><em>이메일</em><?php echo $TPL_VAR["board_view"]['board_view']['email']?></span><?php }?>
			</div>
<?php }?>
<?php if($TPL_VAR["board_info"]['code']!='diagnosis'){?>
			<div class="yui3-cssreset view_box">
<?php if($TPL_VAR["board_info"]['yn_video']=='y'){?>
                    <div class="view_video"><?php echo htmlspecialchars_decode($TPL_VAR["board_view"]['board_view']['video_html'])?></div>
<?php }?>
<?php if($TPL_VAR["board_info"]['thumbnail']=='y'){?>
<?php if(count($TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'])){?>
                            <div class="thumb_img_wrap">
<?php if(is_array($TPL_R1=$TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
<?php if($TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][$TPL_K1]['fname']==$TPL_VAR["board_view"]['board_view']['thumbnail_image']){?><!-- //대표 썸네일 제외시 사용 -->
                                        <img src="<?php echo _UPLOAD?>/board/<?php echo $TPL_VAR["board_view"]['board_view']['upload_path']?>/<?php echo $TPL_VAR["board_view"]['board_view']['thumbnail_image']?>" alt=""/>
<?php }else{?>
                                        <img src="<?php echo _UPLOAD?>/board/<?php echo $TPL_VAR["board_view"]['board_view']['upload_path']?>/<?php echo $TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][$TPL_K1]['fname']?>" alt=""/>
<?php }?>
<?php }}?>
                            </div>
<?php }?>
<?php }?>
<?php if($TPL_VAR["board_info"]["yn_editor"]==="y"){?>
                    <?php echo htmlspecialchars_decode($TPL_VAR["board_view"]['board_view']['content'])?>

<?php }else{?>
                    <?php echo nl2br($TPL_VAR["board_view"]["board_view"]["content"])?>

<?php }?>
<?php if($TPL_VAR["board_info"]['files']=='y'){?>
<?php if(count($TPL_VAR["board_view"]['board_view']['board_file']['file'])){?>
					<div class="extra_editor_wrap">
						<h4>첨부파일</h4>
						<div class="extra_cont">
<?php if(is_array($TPL_R1=$TPL_VAR["board_view"]['board_view']['board_file']['file'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
							<span><a href="/fileRequest/download?file=<?php echo urlencode('/board/'.$TPL_VAR["board_view"]['board_view']['upload_path'].'/'.$TPL_VAR["board_view"]['board_view']['board_file']['file'][$TPL_K1]['fname'])?>&save=<?php echo urlencode($TPL_VAR["board_view"]['board_view']['board_file']['file'][$TPL_K1]['oname'])?>" target="_blank" download><?php echo $TPL_VAR["board_view"]['board_view']['board_file']['file'][$TPL_K1]['oname']?></a></span>
<?php }}?>
						</div>
					</div>
<?php }?>
<?php }?>
			</div>
<?php }?>

<?php if($TPL_VAR["board_info"]['thumbnail']=='y'){?>
<?php if(count($TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'])){?>
				<h4 class="dn">
					<span>썸네일</span>
<?php if(is_array($TPL_R1=$TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
						<a href="/fileRequest/download?file=<?php echo urlencode('/board/'.$TPL_VAR["board_view"]['board_view']['upload_path'].'/'.$TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][$TPL_K1]['fname'])?>&save=<?php echo urlencode($TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][$TPL_K1]['oname'])?>" target="_blank" style="color:cornflowerblue;" download><?php echo $TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][$TPL_K1]['oname']?><?php if($TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][$TPL_K1]['fname']==$TPL_VAR["board_view"]['board_view']['thumbnail_image']){?> (대표)<?php }?></a>
<?php }}?>
				</h4>
<?php }?>
<?php }?>
			<!--예비필드 노출-->
<?php if($TPL_VAR["board_info"]['extraFl']=='y'&&$TPL_VAR["extraFieldData"]){?>
<?php if($TPL_extraFieldData_1){foreach($TPL_VAR["extraFieldData"] as $TPL_V1){?>
					<div class="extra_editor_wrap">
						<h4><?php echo $TPL_V1["name"]?></h4>
						<div class="extra_cont <?php if($TPL_V1["type"]=='editor'){?>view_cont yui3-cssreset<?php }?>">
<?php if($TPL_V1["type"]=='all'){?>
							<a href="<?php echo $TPL_V1["link"]?>&save=<?php echo urlencode($TPL_V1["original_file_name"])?>" style="color:cornflowerblue;" download/><?php echo $TPL_V1["original_file_name"]?></a>
<?php }elseif($TPL_V1["type"]=='video'){?>
							<video id="" src="<?php echo $TPL_V1["link"]?>" controls width="100%"></video>
<?php }else{?>
							<?php echo $TPL_V1["value"]?>

<?php }?>
						</div>
					</div>
<?php }}?>
<?php }?>
		</div><!--bbs_view-->
<?php if($TPL_VAR["board_info"]['QNA_BOARD']==$TPL_VAR["board_info"]['board_type']){?>
<?php if($TPL_VAR["board_view"]['board_view']['answer_status']=='y'){?>
			<!-- 답변 내용 -->
			<div class="bbs_view">
				<div class="view_tit">
					<h3><?php echo $TPL_VAR["board_view"]['board_view']['answer_title']?></h3>
				</div>
				<div class="view_cont yui3-cssreset"><?php echo htmlspecialchars_decode($TPL_VAR["board_view"]['board_view']['answer_content'])?></div><!--view_cont-->
			</div><!--bbs_view-->
<?php }?>
<?php }?>
<?php if($TPL_VAR["board_info"]['comment']=='y'){?>
<?php if($TPL_VAR["board_view"]['is_comment_write']){?>
			<?php echo form_open('','name=comment_frm')?>

			<fieldset>
				<legend>게시글에대한 코멘트 작성</legend>
				<div class="board_comment">
					<div class="comment_name clear">
						<span>이름<input type="text" name="name" id="name" value="<?php if(defined('_IS_LOGIN')){?><?php echo $TPL_VAR["member"]['name']?><?php }?>" <?php if(defined('_IS_LOGIN')){?>readonly<?php }?>/><label for="name" class="dn">코멘트 작성자</label></span>
<?php if(!defined('_IS_LOGIN')){?><span>비밀번호<input type="password" name="password" id="password" label="비밀번호"><label for="password" class="dn">비밀번호 : </label></span><?php }?>
					</div>
					<div class="comment_memo clear">
						<textarea name="content" allowBlank="false" label="댓글" title="댓글 내용을 작성헤주세요." ></textarea>
						<input type="hidden" name="file_fname" />
						<input type="hidden" name="file_oname" />
						<a href="javascript://" onclick="Common_Board.board_comment_write(document.comment_frm);" class="btn_lg btn_point">댓글달기</a>
					</div>
<?php if(!defined('_IS_LOGIN')){?>
					<!-- 개인정보 수집항목 동의 -->
					<div class="policy_cont">
						<div>
							<input type="checkbox" name="nonMember" id="checkbox-nonMember" />
							<label for="checkbox-nonMember"><?php echo $TPL_VAR["terms"]['nonMember']['title']?></label>
							<a href="/service/usepolicy" target="_blank" class="btn_sm btn_info">전체보기 ></a>
						</div>
						<textarea readonly cols="30" rows="5" align="left" title="개인정보 수집항목"><?php echo $TPL_VAR["terms"]['nonMember']['text']?></textarea>
					</div><!-- .policy_cont -->
<?php }?>
				</div><!-- .board_comment -->
			</fieldset>
			<?php echo form_close()?>

<?php }?>
<?php if(isset($TPL_VAR["board_view"]['board_list_comment'])){?>
			<div class="board_comment_list">
				<div class="comment_title">댓글 <span><?php echo $TPL_VAR["board_view"]['total_rows_comment']?></span>개</div>
<?php if(is_array($TPL_R1=$TPL_VAR["board_view"]['board_list_comment'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
				<div class="comment" id="display_comment_<?php echo $TPL_V1["idx"]?>">
					<input type="hidden" name="idx_<?php echo $TPL_V1["idx"]?>" value="<?php echo $TPL_V1["idx"]?>" />
					<input type="hidden" name="mode_<?php echo $TPL_V1["idx"]?>" value="" />
					<div class="clear">
						<div class="comment_writer"><?php echo $TPL_V1["name"]?> <span class="board_line"></span> <?php echo $TPL_V1["regdt"]?></div>
						<div class="com_btn">
							<div id="view_comment_btn_<?php echo $TPL_V1["idx"]?>">
<?php if($TPL_V1["is_comment_modify"]=='y'||$TPL_V1["is_comment_modify"]=='s'){?>
								<a class="btn_more" href="javascript://" onclick="comment_modify_check('<?php echo $TPL_V1["idx"]?>', '<?php echo $TPL_V1["is_comment_modify"]?>');">수정</a>
								<span class="board_line"></span>
<?php }?>

<?php if($TPL_V1["is_comment_delete"]=='y'||$TPL_V1["is_comment_delete"]=='s'){?>
								<a class="btn_more" href="javascript://" onclick="comment_delete_check('<?php echo $TPL_V1["idx"]?>', '<?php echo $TPL_V1["is_comment_delete"]?>')">삭제</a>
<?php }?>

<?php if($TPL_V1["is_comment_modify"]=='s'||$TPL_V1["is_comment_delete"]=='s'){?>
								<div id="layer_password_<?php echo $TPL_V1["idx"]?>" class="comment_password hide">
									<span>비밀번호</span>
									<input type="password" name="password_<?php echo $TPL_V1["idx"]?>" onkeyup="comment_password_enter('<?php echo $TPL_V1["idx"]?>');" />
									<a href="javascript://" onclick="Common_Board.board_comment_password_check('<?php echo $TPL_V1["idx"]?>');" class="btn_sm btn_info">확인</a>
									<a class="close" href="javascript://" onclick="comment_password_layer_close('<?php echo $TPL_V1["idx"]?>');">닫기</a>
								</div>
<?php }?>
							</div>
							<div id="modify_comment_btn_<?php echo $TPL_V1["idx"]?>" class="hide" >
								<a href="javascript://" onclick="comment_modify_display('<?php echo $TPL_V1["idx"]?>', false);comment_password_layer_close('<?php echo $TPL_V1["idx"]?>');">취소</a>
							</div>
						</div>
					</div>
					<div id="view_comment_content_<?php echo $TPL_V1["idx"]?>"class="com_txt"><?php echo htmlspecialchars_decode($TPL_V1["content"])?></div>
					<div id="modify_comment_content_<?php echo $TPL_V1["idx"]?>" class="com_modify hide">
						<textarea name="content_<?php echo $TPL_V1["idx"]?>" title="댓글을 수정해주세요"><?php echo htmlspecialchars_decode($TPL_V1["content"])?></textarea>
						<input type="hidden" name="name_<?php echo $TPL_V1["idx"]?>" value="<?php echo $TPL_V1["name"]?>" />
						<input type="hidden" name="password_<?php echo $TPL_V1["idx"]?>" />
						<input type="hidden" name="file_fname_<?php echo $TPL_V1["idx"]?>" />
						<input type="hidden" name="file_oname_<?php echo $TPL_V1["idx"]?>" />
						<a href="javascript://" onclick="Common_Board.board_comment_modify('<?php echo $TPL_V1["idx"]?>')" class="btn_lg btn_default">수정</a>
					</div>
					<div class="com_txt_reply hide"></div>
				</div>
<?php }}?>
			</div>
<?php }?>
<?php }?>
		<div class="view_btn">
			<div class="btn_wrap ta_left">
<?php if($TPL_VAR["board_info"]['code']!='diagnosis'){?>
				<a href="/board/board_list?code=<?php echo $TPL_VAR["board_info"]['code']?>" class="btn">목록으로</a>
<?php }?>
<?php if($TPL_VAR["board_view"]['is_modify']=='y'){?>
				<a href="/board/board_write?code=<?php echo $TPL_VAR["board_info"]['code']?>&no=<?php echo $TPL_VAR["board_view"]['board_view']['no']?>" class="btn_basic btn">수정</a>
<?php }elseif($TPL_VAR["board_view"]['is_modify']=='s'){?>
				<a href="/board/board_secret?code=<?php echo $TPL_VAR["board_info"]['code']?>&no=<?php echo $TPL_VAR["board_view"]['board_view']['no']?>&page=write" class="btn_basic btn">수정</a>
<?php }?>
<?php if($TPL_VAR["board_view"]['is_delete']=='y'){?>
				<a href="/board/board_delete?code=<?php echo $TPL_VAR["board_info"]['code']?>&no=<?php echo $TPL_VAR["board_view"]['board_view']['no']?>" class="btn_basic btn">삭제</a>
<?php }elseif($TPL_VAR["board_view"]['is_modify']=='s'){?>
				<a href="/board/board_secret?code=<?php echo $TPL_VAR["board_info"]['code']?>&no=<?php echo $TPL_VAR["board_view"]['board_view']['no']?>&page=delete" class="btn_basic btn">삭제</a>
<?php }?>
<?php if($TPL_VAR["board_info"]['tree']=='y'){?>
<?php if($TPL_VAR["board_view"]['is_answer_write']=='y'){?>
				<a href="/board/board_write?code=<?php echo $TPL_VAR["board_info"]['code']?>&no=<?php echo $TPL_VAR["board_view"]['board_view']['no']?>&cref=<?php echo $TPL_VAR["board_view"]['board_view']['no']?>" class="btn_basic btn">답글</a>
<?php }?>
<?php }?>
<?php if($TPL_VAR["board_info"]['QNA_BOARD']==$TPL_VAR["board_info"]['board_type']){?>
<?php if($TPL_VAR["board_info"]['is_inquire_answer']){?>
				<a href="/board/board_write?code=<?php echo $TPL_VAR["board_info"]['code']?>&no=<?php echo $TPL_VAR["board_view"]['board_view']['no']?>&answer_status=<?php echo $TPL_VAR["board_view"]['board_view']['answer_status']?>" class="btn_basic btn"><?php if($TPL_VAR["board_view"]['board_view']['answer_status']=="y"){?>답변수정<?php }else{?>답변등록<?php }?></a>
<?php }?>
<?php }?>
			</div>
		</div><!--view_btn-->
	</div>
</div>
<?php $this->print_("footer",$TPL_SCP,1);?>