<?php /* Template_ 2.2.8 2025/06/26 11:36:08 /gcsd33_arklink/www/data/skin/respon_default/board/view_diagnosis.html 000006957 */ ?>
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
			<!--예비필드 노출-->
<?php if(is_array($TPL_R1=array('ex1','ex2','ex20','ex3','ex4','ex5','ex6','ex7','ex8','ex17','ex18','ex9','ex10','ex21','ex11','ex12','ex13','ex14','ex15','ex16'))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
<?php if($TPL_VAR["extraFieldData"][$TPL_V1]){?>
				<div class="extra_editor_wrap">
					<h4><?php echo $TPL_VAR["extraFieldData"][$TPL_V1]['name']?></h4>
					<div class="extra_cont <?php if($TPL_VAR["extraFieldData"][$TPL_V1]['type']=='editor'){?>view_cont yui3-cssreset<?php }?>">
<?php if($TPL_V1["type"]=='all'){?>
						<a href="<?php echo $TPL_V1["link"]?>&save=<?php echo urlencode($TPL_V1["original_file_name"])?>" style="color:cornflowerblue;" download/><?php echo $TPL_V1["original_file_name"]?></a>
<?php }elseif($TPL_V1["type"]=='video'){?>
						<video id="" src="<?php echo $TPL_V1["link"]?>" controls width="100%"></video>
<?php }else{?>
						<?php echo $TPL_VAR["extraFieldData"][$TPL_V1]['value']?>

<?php }?>
					</div>
				</div>
<?php }?>
<?php }}?>
<?php if(is_array($TPL_R1=array('ex25','ex27','ex29'))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
<?php if($TPL_VAR["extraFieldData"][$TPL_V1]){?>
			<div class="extra_editor_wrap">
				<h4><?php echo $TPL_VAR["extraFieldData"][$TPL_V1]['name']?></h4>
				<div class="extra_cont <?php echo $TPL_VAR["extraFieldData"][$TPL_V1]['no']?>">
<?php if($TPL_VAR["extraFieldData"][$TPL_V1]['name']=='악성 파일 업로드'){?>
					<a href="<?php echo $TPL_VAR["extraFieldData"]['ex26']['link']?>" style="color:cornflowerblue;" download/><?php echo $TPL_VAR["extraFieldData"]['ex26']['original_file_name']?></a>
<?php }elseif($TPL_VAR["extraFieldData"][$TPL_V1]['name']=='대화 내용 업로드'){?>
					<a href="<?php echo $TPL_VAR["extraFieldData"]['ex28']['link']?>" style="color:cornflowerblue;" download/><?php echo $TPL_VAR["extraFieldData"]['ex28']['original_file_name']?></a>
<?php }elseif($TPL_VAR["extraFieldData"][$TPL_V1]['name']=='방문 기록 업로드'){?>
					<a href="<?php echo $TPL_VAR["extraFieldData"]['ex30']['link']?>" style="color:cornflowerblue;" download/><?php echo $TPL_VAR["extraFieldData"]['ex30']['original_file_name']?></a>
<?php }?>
				</div>
			</div>
<?php }?>
<?php }}?>
		</div><!--bbs_view-->
		<div class="view_btn">
			<div class="btn_wrap ta_left">
<?php if($TPL_VAR["board_info"]['code']!='diagnosis'){?>
				<a href="/board/board_list?code=<?php echo $TPL_VAR["board_info"]['code']?>" class="btn">목록으로</a>
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