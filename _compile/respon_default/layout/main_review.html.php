<?php /* Template_ 2.2.8 2025/09/18 17:19:44 /gcsd33_arklink/www/data/skin/respon_default/layout/main_review.html 000000988 */ ?>
<?php if($TPL_VAR["review_info"]['mainview']=='y'){?>
<ul class="swiper-wrapper">
<?php if(isset($TPL_VAR["review_list"]['board_list'])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["review_list"]['board_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
	<li class="swiper-slide">
<?php if($TPL_V1["is_read"]=='s'){?><a href="/board/board_secret?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>&page=view" alt="<?php echo $TPL_V1["title"]?>"><?php }else{?><a href="/board/board_view?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>" alt="<?php echo $TPL_V1["title"]?>"><?php }?></a>
		<div class="txt">
			<strong><?php echo $TPL_V1["title"]?></strong>
			<p><?php echo date("y.m.d",strtotime($TPL_V1["regdt_date"]))?> </p>
		</div>
	</li>
<?php }}?>
<?php }else{?>
	<li>게시글이 없습니다.</li>
<?php }?>
</ul>
<?php }?>