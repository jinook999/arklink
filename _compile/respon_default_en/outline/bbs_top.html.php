<?php /* Template_ 2.2.8 2025/04/15 09:59:04 /gcsd33_arklink/www/data/skin/respon_default_en/outline/bbs_top.html 000000574 */ ?>
<?php if(isset($TPL_VAR["board_nav"]['board_manage_list'])){?>
<ul id="sub_nav" class="submenu dn">
<?php if(is_array($TPL_R1=$TPL_VAR["board_nav"]['board_manage_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
	<li><a href="/board/board_list?code=<?php echo $TPL_V1["code"]?>" <?php if($TPL_VAR["board_info"]['code']==$TPL_V1["code"]){?>class="on"<?php }?>><?php echo $TPL_V1["name"]?></a></li>
<?php }}?>
</ul><!--submenu-->
<?php }?>