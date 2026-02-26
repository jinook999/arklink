<?php
$get = $this->input->get(null, true);
$btn_list = [];
foreach($get as $key => $value) :
	if($key === 'no') continue;
	$btn_list[] = $key.'='.$value;
endforeach;
$return_url = array_merge($btn_list, ['no='.$get['no']]);
?>
<script type="text/javascript" src="/lib/admin/js/admin_member.js"></script>
<script>
$(function() {
	$("#btnCheckDuplicateId").on("click", function(e) {
		e.preventDefault();
		if(!$("#userId").val()) {
			alert("아이디를 입력해 주세요.");
			return false;
		}

		$.ajax({
			url: "/ajax/check_it",
			data: {
				language: $("#language").val(),
				col: "userid",
				value: $("#userId").val()
			},
			success: function(res) {
				if(res == "not_exists") {
					alert("사용 가능한 아이디입니다.");
					$("#useridDuplicate").val("y");
				} else {
					alert("사용 중인 아이디입니다. 다시 입력해 주세요.");
					$("#userId").val("").focus();
					return false;
				}
			}
		});
	});

	$("#btnRegistAdmin").on("click", function(e) {
		e.preventDefault();
		$("#frm").submit();
	});

	$("#frm").validate({
		submitHandler: function() {
			return true;
		},
		rules: {
			userid: { required: true },
			userid_duplicate: { required: true },
			name: { required: true },
			password: { required: true, minlength: 4 },
			password_re: { required: true, equalTo: "#userPassword_re" },
		},
		messages: {
			userid: { required: "아이디를 입력해 주세요." },
			userid_duplicate: { required: "아이디 중복 확인을 해주세요." },
			name: { required: "이름을 입력해 주세요." },
			password: { required: "비밀번호를 입력해 주세요.", minlength: "비밀번호는 최소 {0}자 이상으로 입력해 주세요." },
			password_re: { required: "비밀번호를 확인해 주세요.", equalTo: "비밀번호가 일치하지 않습니다." },
		},
	});

	$("#changePassword").on("click", function() {
		var fl = $(this).is(":checked");
		$("#userPassword, #userPassword_re").prop("disabled", !fl);
	});

	$("#setLink").on("click", function(e) {
		e.preventDefault();
		var lev = $("#adminLevel").val();
		if(lev === "99") return false;
		window.open("admin_grade_reg?level=" + lev);
	});

	$("#removeAdmin").on("click", function(e) {
		e.preventDefault();
		if(confirm("삭제할 경우 복구가 불가능합니다.\n삭제하시겠습니까?")) {
			$(location).attr("href", $(this).attr("href"));
		}
	});
/*
	$("#btnRegistAdmin").on("click", function(e) {
		e.preventDefault();
        $("#frm").validate({
            rules: {
				userid: { required: true },
				userid_duplicate: { required: true },
				name: { required: true },
				password: { required: true },
				password_re: { required: true, equalTo: "#userPassword_re" },
			},
			messages: {
				userid: { required: "아이디를 입력해 주세요." },
				userid_duplicate: { required: "아이디 중복 확인을 해주세요." },
				name: { required: "이름을 입력해 주세요." },
				password: { required: "비밀번호를 입력해 주세요." },
				password_re: { required: "비밀번호 확인을 입력해 주세요.", equalTo: "비밀번호가 일치하지 않습니다." },
			},
			submitHandler: function() {
				//$("#frm").submit();
				return true;
			}
		});
	});*/
});
</script>
<div id="contents">
    <div class="contents_wrap">
        <div class="main_tit">
            <h2>관리자 정보</h2>
            <div class="btn_right btn_num2">
                <!-- a href="javascript://" onclick="history.back();" class="btn gray">취소</a -->
				<?php
				if($get['userid']) :
					echo '<a href="admin_remove?userid='.$get['userid'].'" id="removeAdmin" class="btn" style="background: #f00;">삭제</a>';
				endif;
				?>
                <a href="#" id="btnRegistAdmin" class="btn point"><?=$get['no'] > 0 ? '수정' : '저장'?></a>
                <a href="admin_list?<?=implode('&', $ref)?>" class="btn gray">목록</a>
            </div><!--btn_right-->
        </div>
        <?php
        $config = $this->config->config['memberField'];
        if($get['userid']) :
            $language = $member_view['language'];
        else :
            $language = $get['language'] ? $get['language'] : 'kor';
        endif;
        echo form_open('', ['name' => 'frm', 'id' => 'frm', /*"target"=>"ifr_processor",*/ 'autocomplete' => 'off']);
        ?>
        <input type="hidden" name="mode" id="mode" value="<?=$get['userid'] ? 'modify' : 'insert'?>" />
        <input type="hidden" name="ref" value="<?=implode('&', $return_url)?>">
        <input type="hidden" name="language" id="language" value="kor">

        <div class="table_write write_member">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <colgroup>
                    <col width="13.5%" />
                    <col width="36.5%" />
                    <col width="13.5%" />
                    <col width="36.5%" />
                </colgroup>
                <tbody>
                <tr>
                    <th align="left">등급</th>
                    <td colspan="3">
                        <select name="level" id="adminLevel" style="width: 200px;">
						<?php
						foreach($member_grade_list as $key => $value) :
							$selected = $member_view['level'] === $value['level'] ? ' selected' : '';
							if($this->session->userdata['admin_member']['level'] >= $value['level'] || $this->session->userdata['admin_member']['level'] == 99) {//관리자 생성시 자신보다 하위 관리자 등급만 설정할 수 있게 함.
								echo '<option value="'.$value['level'].'"'.$selected.'>'.$value['level'].' - '.$value['gradenm'].'</option>';
							}
						endforeach;
						?>
                        </select>
						<?php
						if($this->_admin_member['level'] === 99) echo '<a href="#" id="setLink">[설정]</a>';
						?>
                    </td>
                </tr>
                <tr>
                    <th>아이디<strong class="est">*</strong></th>
                    <td>
                        <?php
                        if($this->input->get('userid', true)) :
                            echo trim($member_view['userid']);
                        endif;
                        ?>
                        <input type="<?=$this->input->get('userid', true) ? 'hidden' : 'text'?>" name="userid" id="userId" value="<?=$member_view['userid']?>">
                        <a href="#" id="btnCheckDuplicateId" class="btn_mini point<?=$this->input->get('userid', true) ? " dn" : ""?>">아이디 중복 확인</a>
                        <input type="hidden" name="userid_duplicate" id="useridDuplicate" value="<?=$get['userid'] ? 'y' : ''?>">
                    </td>
                    <th>이름<strong class="est">*</strong></th>
                    <td colspan="3"><input type="text" name="name" id="userName" value="<?=$member_view['name']?>"></td>
                </tr>
                <tr>
                    <th>비밀번호<strong class="est">*</strong></th>
                    <td>
						<input type="password" name="password" id="userPassword"<?=$member_view['userid'] ? ' disabled' : ''?>>
						<?php
						if($member_view['userid']) echo '<input type="checkbox" id="changePassword"><label for="changePassword">비밀번호 변경</label>';
						?>
					</td>
                    <th>비밀번호 확인<strong class="est">*</strong></th>
                    <td><input type="password" name="password_re" id="userPassword_re"<?=$member_view['userid'] ? ' disabled' : ''?>></td>
                </tr>
                <tr>
                    <th>이메일</th>
                    <td><input type="text" name="email" value="<?=$member_view['email']?>" size="50"></td>
                    <th>연락처</th>
                    <td><input type="text" name="mobile" value="<?=$member_view['mobile']?>" size="15"></td>
                </tr>
                </tbody>
            </table>
        </div>
        <?=form_close();?>
    </div>
</div>