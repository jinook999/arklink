<?php /* Template_ 2.2.8 2025/09/18 17:19:43 /gcsd33_arklink/www/data/skin/respon_default/layout/main_patent.html 000001429 */ ?>
<?php if($TPL_VAR["patent_info"]['mainview']=='y'){?>
<?php if(isset($TPL_VAR["patent_list"]['board_list'])){?>
<div class="img_box" data-aos="fade-up">
	<ul>
<?php if(is_array($TPL_R1=$TPL_VAR["patent_list"]['board_list'])&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_V1["display_read"]=='y'){?>
		<li class="<?php if($TPL_I1=='0'){?>on<?php }?>" id="certificate0<?php echo $TPL_I1+ 1?>">
			<div class="img"><img src="<?php echo _UPLOAD?>/board/<?php echo $TPL_V1["upload_path"]?>/<?php echo $TPL_V1["board_file"]["thumbnail"][ 0]['fname']?>" alt="<?php echo $TPL_V1["title"]?>" onerror="this.src='/data/skin/respon_default/images/common/noimg.gif'">	</div>
			<p><?php echo $TPL_V1["title"]?></p>
		</li>
<?php }?>
<?php }}else{?>
		<li>게시글이 없습니다.</li>
<?php }?>
	</ul>
</div>
<ul class="list ver_pc" data-aos="fade-up">
<?php if(is_array($TPL_R1=$TPL_VAR["patent_list"]['board_list'])&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_V1["display_read"]=='y'){?>
	<li class="<?php if($TPL_I1=='0'){?>on<?php }?>" data-tab="certificate0<?php echo $TPL_I1+ 1?>"><span><?php echo $TPL_V1["title"]?></span></li>
<?php }?>
<?php }}else{?>
	<li>게시글이 없습니다.</li>
<?php }?>
</ul>
<?php }?>
<?php }?>