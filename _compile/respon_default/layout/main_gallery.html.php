<?php /* Template_ 2.2.8 2025/09/18 17:19:43 /gcsd33_arklink/www/data/skin/respon_default/layout/main_gallery.html 000001619 */ ?>
<?php if($TPL_VAR["gallery_info"]['mainview']=='y'){?>
<ul class="swiper-wrapper">
<?php if(isset($TPL_VAR["gallery_list"]['board_list'])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["gallery_list"]['board_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
<?php if($TPL_V1["display_read"]=='y'){?>
	<li class="swiper-slide">
<?php if($TPL_V1["is_read"]=='s'){?><a href="/board/board_secret?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>&page=view" alt="<?php echo $TPL_V1["title"]?>"><?php }else{?><a href="/board/board_view?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>" alt="<?php echo $TPL_V1["title"]?>"><?php }?></a>
		<div class="thumb">
<?php if($TPL_V1["preface"]){?><div class="pre" title="<?php echo $TPL_V1["preface"]?>"><span><?php echo $TPL_V1["preface"]?></span></div><?php }?>
			<div class="img">
				<img src="<?php echo _UPLOAD?>/board/<?php echo $TPL_V1["upload_path"]?>/<?php echo $TPL_V1["board_file"]["thumbnail"][ 0]['fname']?>" alt="<?php echo $TPL_V1["title"]?>" onerror="this.src='/data/skin/respon_default/images/common/noimg.gif'">	
			</div>
		</div>
		<div class="txt">
			<strong class="title"><?php echo $TPL_V1["title"]?></strong>
			<p class="des"><?php echo strip_tags(htmlspecialchars_decode($TPL_V1["content"]))?></p>
			<p class="date"><?php echo date("Y.m.d",strtotime($TPL_V1["regdt_date"]))?></p>
		</div>
	</li>
<?php }?>
<?php }}?>
<?php }else{?>
	<li>게시글이 없습니다.</li>
<?php }?>
</ul>
<?php }?>