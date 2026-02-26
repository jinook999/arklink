<?php
$menu1 = explode('|', $allowed['menu1']);
$menu2 = explode('|', $allowed['menu2']);
?>
<style>
.adm_power input { margin-top: 0 !important; }
.adm_power dt { width: 160px !important; }
li.second-group { margin-bottom: 10px !important; width: 100%; }
.second-groups li input { margin-right: 5px !important; }
.third-groups li { display: inline-block; width: 160px; }
input.s-input, input.t-input { margin-right: 10px !important; }
#adminLevel option:disabled, #redirect option:disabled { background: #000; color: #fff; }
.adm_power dd ul { margin-left: 20px; }
li.second-group li { display: inline-block; margin-right: 20px; }
#setMenu { background: #2dbabc; color: #fff; padding: 5px; }
label.menu1 { width: 150px; border: 1px solid #ccc; text-align: center; cursor: pointer; }
.clicked { background: #000; color: #fff !important; }
#menus { width: 1000px; }
#contain-menus { display: flex; /*justify-content: space-between;*/ }
div.menus { width: 200px; }
</style>
<script>
	$(function() {
		$("form[name='frm']").validate({
			rules : {
				level : {required : true, number : true},
				gradenm : {required : true, rangelength: [1, 10]}
			}, messages : {
				level : {required : "레벨을 입력해주세요.", number : "숫자만 입력가능합니다."},
				gradenm : {required : "등급명을 입력해주세요.", rangelength: $.validator.format("등급명은 {0}~{1}자까지 입력가능합니다.")}
			}
		});

		$("#r-goods-goods_reg").on("click", function() {
			$("#r-goods-goods_list").attr("checked", $(this).is(":checked")).prop("checked", $(this).is(":checked"));
		});

		$(":checkbox").on("click", function() {
			var isChecked = $(this).is(":checked");
			if($(this).val().length === 2) $(this).closest("li").find("input:checkbox").prop("checked", isChecked);
			if($(this).val().length === 4) {
				if(isChecked === true) {
					$(this).closest("dd").siblings("dt").find("input:checkbox").prop("checked", true);
				} else {
					var l4_checked = $(this).closest("ul").find("input.s-input:checked").length;
					if(l4_checked === 0) $(this).closest("dd").siblings("dt").find("input:checkbox").prop("checked", false);
				}
				$(this).parent().siblings("ul").find("input:checkbox").prop("checked", isChecked);
			}
			if($(this).val().length === 6) {
				if(isChecked === true) {
					$(this).closest("dd").siblings("dt").find("input:checkbox").prop("checked", true);
					$(this).closest("ul").siblings("label").children("input.s-input").prop("checked", true);
				} else {
					var l6_checked = $(this).closest("ul").find("input.t-input:checked").length;
					if(l6_checked === 0) {
						var l4_checked = $(this).closest("dd").find("input.s-input:checked").length;
						if(l4_checked === 1) $(this).closest("dd").siblings("dt").find("input:checkbox").prop("checked", false);
						$(this).closest("ul").siblings("label").children("input.s-input").prop("checked", false);
					}
				}
			}
		});

		$("#btnSave").on("click", function(e) {
			e.preventDefault();
            $("input.first-menu:checked").each(function() {
                var v = $(this).val().split("|");
                var third = $(this).closest("dt").siblings("dd").find("input.third-menu:checked").val().split("|");
                var tmp1 = v[0] + "|" + v[1], tmp2 = third[0] + "|" + third[1];
                if(tmp1 != tmp2) {
                    $(this).val(third[0] + "|" + third[1] + "|" + v[2] + "|" + v[3]);
                }
            });
			$("#pForm").submit();
		});

		$("#setMenu").on("click", function(e) {
			e.preventDefault();
			window.open($(this).attr("href"), "set menu", "width=800, height=800, scrollbars=yes");
		});

		$(".menu1").on("click", function() {
			const sibling = $(this).siblings("input.menu-1");
			sibling.is(":checked") === false ? $(this).addClass("clicked") : $(this).removeClass("clicked");
			sibling.siblings("ul").find("input.menu-2").prop("disabled", sibling.is(":checked"));
			makes_menu();
		});

		$(".menu-2").on("click", function() {
			/*
			let opts = `<option value="main">메인</option>`;
			$("input.menu-1:checked").each(function() {
				const val1 = $(this).val();
				const name = $(this).siblings("label").text();
				opts += `<optgroup label="${name}">`;
				$(this).siblings("ul").children("li").each(function() {
					const checked = $(this).children("input.menu-2:checked");
					const checked_name = checked.siblings("label").text();
					if(checked.val() !== undefined) opts += `<option value="${val1}/${checked.val()}">${checked_name}</option>`;
				});
			});

			$("#move-after-login").html(opts);
			*/
			makes_menu();
		});

		const makes_menu = function() {
			let opts = `<option value="main">메인</option>`;
			setTimeout(function() {
				$("input.menu-1:checked").each(function() {
					if($(this).prop("disabled") === false) {}
					const val1 = $(this).val();
					const name = $(this).siblings("label").text();
					opts += `<optgroup label="${name}">`;
					$(this).siblings("ul").children("li").each(function() {
						const checked = $(this).children("input.menu-2:checked");
						const checked_name = checked.siblings("label").text();
						if(checked.val() !== undefined) opts += `<option value="${val1}/${checked.val()}">${checked_name}</option>`;
					});
				});
				$("#move-after-login").html(opts);
			}, 100);
		};
	});

	function authDelete() {
		if(!confirm("삭제하시겠습니까?")) {
			return false;
		}
		frm = $("form[name='frm']");

		frm.prop("action", "member_auth_delete");
		frm.submit();
	}

	function authSave() {
		var frm = $("form[name='frm']");

		if(!frm.valid()) {
			return false;
		}

		if($(":checkbox[name^='nav[']:checked", frm).length < 1) {
			alert("최소 한개이상 하위메뉴가 선택되있어야 합니다.");
			return false;
		}

		frm.prop("action", "");
		frm.submit();
	}

	function navChange(nav) {
		$(".left-tr").addClass("hide").filter("#left-"+ nav +"-tr").removeClass("hide");
	}
</script>
<div id="contents">
	<div class="contents_wrap">
		<div class="main_tit">
			<h2>관리자 등급 설정</h2>
			<div class="btn_right btn_num3">
				<?php
				if($this->_admin_member['level'] > $get['level']) :
					echo "<a href='javascript://' onclick='authDelete();' class='btn gray sel_minus'>삭제</a>";
				endif;
				?>
				<a href="admin_grade" class="btn gray">목록</a>
				<a href="#" id="btnSave" class="btn point"><?=$get['level'] > 0 ? '수정' : '저장'?></a>
			</div>
		</div>

		<form id="pForm" method="post" action="set_member_auth">
			<input type="hidden" name="mode" value="<?=$get['level'] > 0 ? 'modify' : 'insert'?>">
			<div class="table_write">
				<table cellpadding="0" cellspacing="0" border="0">
					<colgroup>
						<col width="11%">
						<col width="22%">
						<col width="11%">
						<col width="22%">
						<col width="11%">
						<col>
					</colgroup>
					<tbody>
						<tr>
							<th scope="col">레벨</th>
							<td>
							<?php
							if($get['level'] > 0) :
								echo $allowed['level'].'<input type="hidden" name="level" value="'.$get['level'].'">';
							else :
								echo '<select name="level" id="adminLevel">';
								for($lv = 98; $lv > 79; $lv--) :
									$selected = $lv == $this->input->get('level', true) ? ' selected' : '';
									$disabled = in_array($lv, $registerd) ? ' disabled' : '';
									echo '<option value="'.$lv.'"'.$selected.$disabled.'>'.$lv.'</option>';
								endfor;
								echo '</select>';
							endif;
							?>
							</td>
							<th scope="col">등급명</th>
							<td><input type="text" name="gradenm" value="<?=$allowed['gradenm']?>" style="width: 100%;" placeholder="관리자 등급 명칭 기입" /></td>
							<th>로그인 후 이동할 메뉴</th>
							<td>
								<select name="move_after_login" id="move-after-login" style="width: 100%;">
								<?php
								if($get['level'] > 0) :
									echo '<option value="main">메인</option>';
									foreach($menus as $key => $value) :
										if(in_array($key, $menu1) === true) :
											echo '<optgroup label="'.$value['name'].'">';
											foreach($menus[$key]['low_menu'] as $idx => $val) :
												if(in_array($val['segment'], $menu2) === true) :
													$redirect = $key.'/'.$val['segment'];
													$selected = $allowed['redirect'] === $redirect ? ' selected' : '';
													echo '<option value="'.$redirect.'"'.$selected.'>'.$val['name'].'</option>';
												endif;
											endforeach;
										endif;
									endforeach;
								else :
									echo '<option value="">메뉴를 먼저 선택해 주세요.</option>';
								endif;
								?>
								</select>
							</td>
						</tr>
						<tr>
							<th>메뉴</th>
							<td colspan="5">
								<div id="contain-menus">
								<?php
								foreach($menus as $key => $value) :
									if($key === 'auth') continue;
									if(isset($this->_admin_member['super']) === false) :
										if(in_array($key, ['design']) === true) continue;
									endif;
									$checked = $clicked = '';
									$disabled = ' disabled';
									if(in_array($key, $menu1) === true) :
										$checked = ' checked';
										$clicked = ' clicked';
										$disabled = '';
									endif;
									echo '<div class="menus">';
									echo '<input type="checkbox" name="menu1[]" id="menu1-'.$key.'" class="dn menu-1" value="'.$key.'"'.$checked.'><label for="menu1-'.$key.'" class="menu1'.$clicked.'">'.$value['name'].'</label><ul>';
									foreach($value['low_menu'] as $idx => $val) :
										if(isset($this->_admin_member['super']) === false) :
											if(in_array($val['segment'], ['admin_list', 'admin_grade', 'goods_field']) === true) continue;
										endif;
										$checked_menu2 = in_array($val['segment'], $menu2) === true ? ' checked' : '';
										echo '<li><input type="checkbox" name="menu2[]" id="menu2'.$key.$idx.'" class="menu-2" value="'.$val['segment'].'"'.$disabled.$checked_menu2.'><label for="menu2'.$key.$idx.'" class="menu2">'.$val['name'].'</label></li>';
									endforeach;
									echo '</ul></div>';
								endforeach;
								//debug($menus);
								?>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</form>
	</div>
</div>