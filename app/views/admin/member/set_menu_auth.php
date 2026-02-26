<link rel="stylesheet" href="/lib/admin/css/skin.css">
<style>
form { margin: 0; }
td { text-align: left !important; }
.btn-act { background: #000; color: #fff; padding: 2px 10px; }
.menu-depth1 { padding-left: 10px !important; }
.menu-depth2 { padding-left: 30px !important; }
.menu-depth3 { padding-left: 60px !important; }
.label-groups { margin-right: 10px; }
.center { text-align: center !important; }
.btn-update { padding: 10px 20px; background: #00f; color: #fff; border: 0; }
.left { text-align: left !important; }
</style>
<script src="/lib/js/jquery-2.2.4.min.js"></script>
<script>
$(function() {
	$(".level").on("click", function() {
		var fl = $(this).is(":checked"), v = $(this).val();
		$("input.groups").each(function() {
			if($(this).val() === v) $(this).prop("checked", fl);
		});
	});

    $("input[class^='i-']").on("click", function() {
        var v = $(this).val(),
            code = $(this).data("code"),
            checked = $(this).is(":checked"),
            n = code.length - 2;

        $("input[class^='i-" + code + "']").each(function() {
            if(v === $(this).val()) $(this).prop("checked", checked);
        });

        if(code.substring(0, 4) > 3) {
            if(checked === true) {
                $("input[class='i-" + code.substring(0, 2) + "-" + v + "']").prop("checked", true);
                $("input[class='i-" + code.substring(0, 4) + "-" + v + "']").prop("checked", true);
            } else {
                console.log(code.substring(0, 3));
                console.log($("input[class^='i-010']").length);
            }
        }
    });

    $(".btn-update").on("click", function() {
        $("#mForm").submit();
    });
});
</script>
<div id="contents" style="padding-top: 0;">
	<div class="board_top sub_tit" style="padding-bottom: 0;">
		<h3>관리자 메뉴</h3>
	</div>
	<div class="table_list bbs_table_list">
		<form id="mForm" method="post">
			<input type="hidden" name="mode" value="modify">
			<table class="tableA" style="border-collapse: collapse; width: 100%;">
				<colgroup>
					<col style="width: 300px;">
					<?php
					foreach($groups as $key => $value) :
						echo '<col style="width: 20px;">';
					endforeach;
					?>
					<!-- col style="width: 50px;" -->
				</colgroup>
				<thead>
					<tr>
						<th>메뉴</th>
						<?php
						foreach($groups as $key => $value) :
							echo '<th>'.$value['level'].'</th>';
						endforeach;
						?>
						<!-- th>로그</th -->
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($menus as $key => $value) :
					$depth = strlen($value['code']) / 2;
					if(!$this->session->__get('admin_member')['super']) :
						if(substr($value['code'], 0, 2) == '01') continue;
					endif;
				?>
					<tr data-code="<?=$value['code']?>">
						<td class="menu-depth<?=$depth > 0 ? $depth : ''?>">
							<input type="hidden" name="no" value="<?=$value['no']?>">
							<input type="text" name="name[<?=$value['no']?>]" class="left" value="<?=$value['name']?>">
						</td>
						<?php
						foreach($groups as $k => $v) :
                            $checked = strpos($value['open_level'], $v['level']) > -1 ? ' checked' : '';
							echo '<td class="center"><input type="checkbox" name="groups['.$value['no'].'][]" class="i-'.$value['code'].'-'.$v['level'].'" value="'.$v['level'].'"'.$checked.' data-code="'.$value['code'].'"></td>';
						endforeach;
						?>
						<td class="center dn">
						<?php
						if(strlen($value['code']) !== 6) continue;
						$checked = $value['use_log'] === 'y' ? ' checked' : '';
						echo '<input type="checkbox" name="log['.$value['no'].']" value="y"'.$checked.'>';
						?>
						</td>
					</tr>
				<?php
				endforeach;
				?>
				</tbody>
			</table>
		</form>
	</div>
	<div style="margin: 10px 0 50px;">
		<button type="button" class="btn-update">수정</button>
	</div>
</div>