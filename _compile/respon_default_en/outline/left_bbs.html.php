<?php /* Template_ 2.2.8 2025/04/15 09:59:04 /gcsd33_arklink/www/data/skin/respon_default_en/outline/left_bbs.html 000000856 */ ?>
<div class="sub_menu">
	<dl>
		<dt class=""><?php echo $TPL_VAR["lm"]["name"]?></dt>
<?php if($TPL_VAR["lm"]["menu"]){?>
			<!-- 메뉴관리 1차 하위 2차메뉴 있을 때 -->
<?php if(is_array($TPL_R1=$TPL_VAR["lm"]["menu"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
			<dd class="menu0<?php echo $TPL_K1?> <?php if(strpos($TPL_V1["url"],$TPL_VAR["current"])> - 1){?>on<?php }?>"><a href="<?php echo $TPL_V1["url"]?>"><?php echo $TPL_V1["name"]?></a></dd>
<?php }}?>
<?php }else{?>
			<!-- 메뉴관리 1차 하위 2차메뉴 없을 때, 나 자신 가져오기 -->
			<dd class="on"><strong><?php echo $TPL_VAR["on"]?></strong></dd>
<?php }?>
	</dl>
<?php $this->print_("left_bnr",$TPL_SCP,1);?>

</div>