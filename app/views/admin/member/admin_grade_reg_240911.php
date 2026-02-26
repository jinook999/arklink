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
					<?php
					if($get['level'] > 0) :
						include_once 'admin_grade_modify.php';
					else :
					?>
						<tr>
							<th scope="col">레벨</th>
							<td>
								<select name="level" id="adminLevel">
								<?php
								for($lv = 98; $lv > 79; $lv--) :
									$selected = $lv == $this->input->get('level', true) ? ' selected' : '';
									$disabled = in_array($lv, $registerd) ? ' disabled' : '';
									echo '<option value="'.$lv.'"'.$selected.$disabled.'>'.$lv.'</option>';
								endfor;
								?>
								</select>
							</td>
							<th scope="col">등급명</th>
							<td><input type="text" name="gradenm" style="width: 100%;" placeholder="관리자 등급 명칭 기입" /></td>
							<th></th>
							<td></td>
						</tr>
					<?php
					endif;
					?>
					</tbody>
				</table>
			</div>
		</form>
	</div>
</div>