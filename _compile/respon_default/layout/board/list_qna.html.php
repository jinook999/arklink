<?php /* Template_ 2.2.8 2025/09/18 17:19:43 /gcsd33_arklink/www/data/skin/respon_default/layout/board/list_qna.html 000001837 */ ?>
<?php if(isset($TPL_VAR["board_list"]['notice_list'])){?>
<ul class="qa_list">
<?php if(count($TPL_VAR["board_list"]['notice_list'])> 0){?>
<?php if(is_array($TPL_R1=$TPL_VAR["board_list"]['notice_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
    <li>
<?php if($TPL_V1["is_read"]=='s'){?><a href="/board/board_secret?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>&page=view" title="<?php echo $TPL_V1["title"]?>" class="link"><?php }else{?><a href="/board/board_view?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>" title="<?php echo $TPL_V1["title"]?>" class="link"><?php }?></a>
        <dl class="desc">
            <dt>[공지]</dt>
            <dd><?php echo $TPL_V1["title"]?></dd>
        </dl>
    </li>
<?php }}?>
<?php }?>
</ul>
<?php }?>
<?php if(isset($TPL_VAR["board_list"]['board_list'])){?>
<ul class="qa_list">
<?php if(is_array($TPL_R1=$TPL_VAR["board_list"]['board_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
    <li>
<?php if($TPL_V1["is_read"]=='s'){?><a href="/board/board_secret?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>&page=view" title="<?php echo $TPL_V1["title"]?>" class="link"><?php }else{?><a href="/board/board_view?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>" title="<?php echo $TPL_V1["title"]?>" class="link"><?php }?></a>
        <dl class="desc">
            <dt>[<?php if($TPL_V1["preface"]){?><?php echo $TPL_V1["preface"]?><?php }else{?><?php echo $TPL_VAR["cfg_site"]["nameEng"]?><?php }?>]</dt>
            <dd><?php echo $TPL_V1["title"]?></dd>
        </dl>
    </li>
<?php }}?>
</ul>
<?php }else{?>
<div class="no_data">게시글이 없습니다.</div>
<?php }?>