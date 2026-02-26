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
			<input type="hidden" name="only_one" value="<?=$level?>">
			<table class="tableA" style="border-collapse: collapse; width: 100%;">
				<colgroup>
					<col style="width: 300px;">
					<col style="width: 20px;">
				</colgroup>
				<thead>
					<tr>
						<th>메뉴</th>
						<th><?=$level?></th>
					</tr>
				</thead>
				<tbody>
				<?php
				$current = $codes = [];
				foreach($groups as $key => $value) :
					if($value['level'] === $level) :
						$current = $value;
						$codes = explode('|', $value['codes']);
					endif;
				endforeach;

				foreach($menus as $key => $value) :
					$depth = strlen($value['code']) / 2;
					if(!$this->_admin_member['super']) :
						$not = ['0102', '010201', '010202', '0103', '010301', '010302', '0104', '010401', '010402'];
						if(in_array($value['code'], $not)) continue;
					endif;
				?>
					<tr data-code="<?=$value['code']?>">
						<td class="menu-depth<?=$depth > 0 ? $depth : ''?>"><?=$value['name']?></td>
						<td class="center"><input type="checkbox" name="groups[<?=$value['no']?>]" class="i-<?=$value['code'].'-'.$level?>" value="<?=$level?>" data-code="<?=$value['code']?>"></td>
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