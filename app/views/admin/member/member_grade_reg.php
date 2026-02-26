<style>
.already { background: #000; color: #fff; }
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
	});

	function gradeDelete() {
		if(!confirm("삭제하시겠습니까?")) {
			return false;
		}

		frm = $("form[name='frm']");
		
		frm.prop("action", "member_grade_delete");
		frm.submit();
	}

	function gradeSave() {
		var frm = $("form[name='frm']");

		if(!frm.valid()) {
			return false;
		}

		frm.prop("action", "");
		frm.submit();
	}
</script>
<div id="contents">
	<div class="main_tit">
		<h2>회원 등급 <? if($this->input->get("level", true)) : echo "수정"; else : echo "등록"; endif; ?></h2>
		<div class="btn_right btn_num3">
			<? if($this->input->get("level", true)) : ?><a href="javascript://" onclick="gradeDelete();" class="btn gray sel_minus">삭제</a><? endif; ?>
			<a href="member_grade" class="btn gray">목록</a>
			<a href="javascript://" onclick="gradeSave();" class="btn point"><? if($this->input->get("level", true)) : echo "수정"; else : echo "저장"; endif; ?></a>
		</div>
	</div>
	<?=form_open("", array("name" => "frm"));?>
		<input type="hidden" name="mode" value="<?=$mode?>" />
		<div class="table_write">
			<table cellpadding="0" cellspacing="0" border="0">
				<colgroup>
					<col width="10%" />
					<col width="40%" />
					<col width="10%" />
					<col width="40%" />
				</colgroup>
				<tbody>
					<tr>
						<th scope="col">레벨</th>
						<td>
						<?php
						if($get['level'] > 0) :
							echo '<input type="hidden" name="level" value="'.$member_grade_view['level'].'">'.$member_grade_view['level'];
						else :
							echo '<select name="level">';
							$grade = [];
							foreach($member_grade_list as $key => $value) :
								$grade[] = $value['level'];
							endforeach;
							for($i = 1; $i < 80; $i++) :
								$already = in_array($i, $grade) ? ' class="already" disabled' : '';
								echo '<option value="'.$i.'"'.$already.'>'.$i.'</option>';
							endfor;
							echo '</select>';
						endif;
						?>
						</td>
						<th scope="col">등급명</th>
						<td><input type="text" class="inq_w50p" name="gradenm" placeholder="등급명을 기입해주세요" value="<?if(isset($member_grade_view["gradenm"])) :?><?=$member_grade_view["gradenm"]?><?endif?>" /></td>
					</tr>
				</tbody>
			</table>
		</div>
	<?=form_close();?>
	<div class="terms_privecy_box dn">
		<dl>
			<dt>- "레벨" 주의사항</dt>
			<dd>
			<em class="point">"레벨"</em> 은 <em>1부터 79이하의 숫자</em>만 사용 가능합니다.<br/><br/>
			</dd>
		</dl>
	</div>
</div>