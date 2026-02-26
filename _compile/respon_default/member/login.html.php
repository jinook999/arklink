<?php /* Template_ 2.2.8 2025/04/15 09:59:01 /gcsd33_arklink/www/data/skin/respon_default/member/login.html 000002105 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<!-- <script type="text/javascript" src="/lib/js/common_member.js"></script> -->
<script type="text/javascript" src="<?php echo $TPL_VAR["js"]?>/js/common_member.js"></script>
<script type="text/javascript">
	var Common_Member = new common_member({
		is_login : "<?php echo defined('_IS_LOGIN')?>"
	});

	$(function() {
		$("form[name='frm']").validate({
			submitHandler : function(form) {
				var set_data = {
					userid : form.userid.value,
					password : form.password.value
				};

				if(Common_Member.dormant_check(set_data) ) {
					form.submit();
				}
			}, rules : {
				userid : {required : true},
				password : {required : true}
			}, messages : {
				userid : {required : "아이디를 입력해주세요."},
				password : {required : "비밀번호를 입력해주세요."}
			}
		});
	});

</script>
<div class="sub_content">
	<div class="sub_login">
		<div class="login_box">
			<?php echo form_open('member/login','name=frm')?>

			<fieldset>
			<legend>회원 로그인 아이디/비밀번호 입력</legend>
			<input type="hidden" name="encrypt" value="p2" />
			<input type="hidden" name="return_url" value="<?php echo $TPL_VAR["return_url"]?>" />
			<ul>
				<li><input type="text" name="userid" id="userid" placeholder="아이디"><label for="userid" class="dn">회원아이디</label></li>
				<li><input type="password" name="password" id="password" placeholder="비밀번호"><label for="password" class="dn">회원비밀번호</label></li>
				<li><button type="submit" class="btn_wd btn_point">LOGIN</button></li>
			</ul>
			</fieldset>
			<?php echo form_close()?>

			<ul class="login_link">
				<li class="first"><a href="/member/find_id">아이디찾기</a></li>
				<li><a href="/member/find_pw">비밀번호찾기</a></li>
				<li><a href="/member/join_agreement">회원가입</a></li>
			</ul>
		</div><!--login_box-->

	</div>
</div><!--sub_content-->
<?php $this->print_("footer",$TPL_SCP,1);?>