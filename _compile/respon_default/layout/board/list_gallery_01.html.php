<?php /* Template_ 2.2.8 2025/09/18 17:19:43 /gcsd33_arklink/www/data/skin/respon_default/layout/board/list_gallery_01.html 000004998 */ ?>
<?php if(isset($TPL_VAR["board_list"]['notice_list'])){?>
<?php if(count($TPL_VAR["board_list"]['notice_list'])> 0){?>
<ul class="gallery_notice">
<?php if(is_array($TPL_R1=$TPL_VAR["board_list"]['notice_list'])&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
	<li class="<?php if((($TPL_I1% 3)+ 1)=='3'){?>last<?php }?> ">
<?php if($TPL_V1["is_read"]=='s'){?><a href="/board/board_secret?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>&page=view" alt="<?php echo $TPL_V1["title"]?>"><?php }else{?><a href="/board/board_view?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>" alt="<?php echo $TPL_V1["title"]?>"><?php }?></a>
		<div class="thumb">
			<img src="<?php echo _UPLOAD?>/board/<?php echo $TPL_V1["upload_path"]?>/<?php echo $TPL_V1["board_file"]["thumbnail"][ 0]['fname']?>" alt="<?php echo $TPL_V1["title"]?>" onerror="this.src='/data/skin/respon_default/images/common/noimg.gif'">
		</div>
		<div class="txt_info">
			<b>공지</b>
			<div class="board_tit">
				<div class="board_ico">
<?php if($TPL_V1["display_read"]=='s'){?><img src="/data/skin/respon_default/images/common/icon_secret.gif" alt="비밀글"><?php }?>
<?php if(count($TPL_V1["board_file"]['file'])> 0){?><img src="/lib/images/icon_attach_file.png" alt="첨부파일"><?php }?>
				</div>
				<h3>
					<strong><?php if($TPL_V1["preface"]){?>[<?php echo $TPL_V1["preface"]?>]<?php }?> <?php echo mb_strimwidth(($TPL_V1["title"]), 0, 150,"...")?></strong>
<?php if($TPL_VAR["board_info"]['comment']=='y'){?>
<?php if($TPL_V1["comment"]>'0'){?>[<?php echo $TPL_V1["comment"]?>]<?php }?>
<?php }?>
				</h3>
			</div>
			<p><?php echo $TPL_V1["name"]?><span></span><?php echo $TPL_V1["regdt_date"]?></p>
<?php if($TPL_VAR["extra"][$TPL_V1["no"]]['ex1']){?>
			<p><?php echo $TPL_VAR["extra"][$TPL_V1["no"]]['ex1']?></p>
<?php }?>
		</div>
	</li>
<?php }}?>
</ul>
<?php }?>
<?php }?>

<?php if($TPL_VAR["board_info"]['code']=='patent'||$TPL_VAR["board_info"]['code']=='cert'){?>
<?php if(isset($TPL_VAR["board_list"]['board_list'])){?>
    <ul class="gall_list patent">
<?php if(is_array($TPL_R1=$TPL_VAR["board_list"]['board_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
        <li>
<?php if($TPL_V1["is_read"]=='s'){?><a href="/board/board_secret?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>&page=view" title="<?php echo $TPL_V1["title"]?>" class="link"><?php }else{?><a href="/board/board_view?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>" title="<?php echo $TPL_V1["title"]?>" class="link"><?php }?></a>
            <div class="thumb">
                <img src="<?php echo _UPLOAD?>/board/<?php echo $TPL_V1["upload_path"]?>/<?php echo $TPL_V1["board_file"]["thumbnail"][ 0]['fname']?>" alt="<?php echo $TPL_V1["title"]?>" onerror="this.src='/data/skin/respon_default/images/sub/noimg.jpg'">
            </div>
            <dl class="desc">
                <dt><?php echo $TPL_V1["title"]?></dt>
            </dl>
        </li>
<?php }}?>
    </ul><!--gallery_list-->
<?php }else{?>
<?php if(count($TPL_VAR["board_list"]['notice_list'])< 1){?>
    <ul class="gallery_list gallery_list_top ta_center">게시글이 없습니다.</ul>
<?php }?>
<?php }?>
<?php }else{?>
<?php if(isset($TPL_VAR["board_list"]['board_list'])){?>
    <ul class="gall_list">
<?php if(is_array($TPL_R1=$TPL_VAR["board_list"]['board_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
        <li>
<?php if($TPL_V1["is_read"]=='s'){?><a href="/board/board_secret?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>&page=view" title="<?php echo $TPL_V1["title"]?>" class="link"><?php }else{?><a href="/board/board_view?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>" title="<?php echo $TPL_V1["title"]?>" class="link"><?php }?></a>
            <div class="thumb">
                <img src="<?php echo _UPLOAD?>/board/<?php echo $TPL_V1["upload_path"]?>/<?php echo $TPL_V1["board_file"]["thumbnail"][ 0]['fname']?>" alt="<?php echo $TPL_V1["title"]?>" onerror="this.src='/data/skin/respon_default/images/sub/noimg.jpg'">
                <em class="preface" title="<?php if($TPL_V1["preface"]){?><?php echo $TPL_V1["preface"]?><?php }?>">
<?php if($TPL_V1["preface"]){?>
                    <?php echo $TPL_V1["preface"]?>

<?php }else{?>
                    <?php echo $TPL_VAR["cfg_site"]["nameEng"]?>

<?php }?>
                </em>
            </div>
            <dl class="desc">
                <dt><?php echo $TPL_V1["title"]?></dt>
                <dd><?php echo strip_tags(htmlspecialchars_decode($TPL_V1["content"]))?></dd>
            </dl>
        </li>
<?php }}?>
    </ul><!--gallery_list-->
<?php }else{?>
<?php if(count($TPL_VAR["board_list"]['notice_list'])< 1){?>
    <div class="no_data">게시글이 없습니다.</div>
<?php }?>
<?php }?>
<?php }?>