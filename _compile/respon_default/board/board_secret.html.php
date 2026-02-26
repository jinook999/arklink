<?php /* Template_ 2.2.8 2025/09/18 17:19:37 /gcsd33_arklink/www/data/skin/respon_default/board/board_secret.html 000001748 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

	<script type="text/javascript">
		$(function() {
			$("form[name='frm']").validate({
				rules : {
					password : {required : true, rangelength : [4, 20]}
				}, messages : {
					password : {required : "비밀번호를 입력해주세요.", rangelength: $.validator.format("비밀번호는 {0}~{1}자입니다.")}
				}
			});
		});

		function secret_chk(form) {
			if(!$(form).valid()){
				return false;
			}
			form.submit();
		}
	</script>
<?php if($TPL_VAR["board_info"]['code']=='diagnosis'){?>
    <script>
        $(function() {
            $('#wrap .sub_pw_input .ok_box [type="password"]').val('1234');
            $('[type="submit"]').trigger('click');
        });
    </script>
    <style>
        #container{opacity: 0;}
    </style>
<?php }?>
	<div class="sub_content ">
		<div class="sub_board">
		<div class="sub_pw_input">
			<?php echo form_open($TPL_VAR["form_attribute"]['action'],$TPL_VAR["form_attribute"]['attribute'])?>

			<fieldset>
				<legend>게시글 비밀번호 입력</legend>
				<div class="ok_box">
					<h2>작성시 입력하셨던 비밀번호를 입력해주세요.</h2>
					<div class="input_box"><input type="password" name="password"  value="1234"/></div>
                    <div class="btn_wrap">
                        <button type="submit" onclick="secret_chk(document.frm);" class="btn">확인</button>
                    </div>
				</div><!--login_box-->
			</fieldset>
			<?php echo form_close()?>

		</div><!--sub_ok-->
	</div><!-- .sub_cont -->
</div><!--content_sub-->

<?php $this->print_("footer",$TPL_SCP,1);?>