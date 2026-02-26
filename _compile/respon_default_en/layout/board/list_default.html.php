<?php /* Template_ 2.2.8 2025/04/15 09:59:32 /gcsd33_arklink/www/data/skin/respon_default_en/layout/board/list_default.html 000003173 */ ?>
<div class="bbs_num">Total of <strong><?php echo $TPL_VAR["board_list"]['total_rows']?></strong>posts</div>
<table class="bbs_list" summary="게시글 제목, 작성자, 작성일, 조회수, 게시글 내용 등..">
	<caption>게시글 내용</caption>
	<colgroup>
		<col width="7%">
		<col >
	</colgroup>
	<thead>
		<tr>
			<th scope="col">No.</th>
			<th scope="col">Title</th>
		</tr>
	</thead>
	<tbody>
<?php if(isset($TPL_VAR["board_list"]['notice_list'])){?>
<?php if(count($TPL_VAR["board_list"]['notice_list'])> 0){?>
<?php if(is_array($TPL_R1=$TPL_VAR["board_list"]['notice_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
		<tr class="board_notice">
			<td>Notice</td>
			<td class="left">
				<div class="board_tit">
<?php if($TPL_V1["is_read"]=='s'){?><a href="board_secret?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>&page=view"><?php }else{?><a href="board_view?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>"><?php }?>
						<div class="board_ico">
<?php if($TPL_V1["display_read"]=='s'){?><img src="/data/skin/respon_default_en/images/common/icon_secret.gif" alt="Secret post"><?php }?>
<?php if(count($TPL_V1["board_file"]['file'])> 0){?><img src="/lib/images/icon_attach_file.png" alt="Attachments"><?php }?>
						</div>
						<h3>
							<strong><?php echo $TPL_V1["title"]?> </strong>
<?php if($TPL_VAR["board_info"]['comment']=='y'){?>
<?php if($TPL_V1["comment"]>'0'){?>[<?php echo $TPL_V1["comment"]?>]<?php }?>
<?php }?>
						</h3>
					</a>
				</div>
			</td>
		</tr>
<?php }}?>
<?php }?>
<?php }?>
<?php if(isset($TPL_VAR["board_list"]['board_list'])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["board_list"]['board_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
		<tr>
			<td><?php echo $TPL_VAR["board_list"]['total_rows']-$TPL_K1-$TPL_VAR["board_info"]['offset']?></td>
			<td class="left">
				<div class="board_tit">
<?php if($TPL_V1["is_read"]=='s'){?><a href="board_secret?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>&page=view"><?php }else{?><a href="board_view?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>"><?php }?>
						<div class="board_ico">
<?php if($TPL_V1["clevel"]>'0'){?><img src="/data/skin/respon_default_en/images/common/icon_re.gif" alt="reply"><?php }?>
<?php if($TPL_V1["display_read"]=='s'){?><img src="/data/skin/respon_default_en/images/common/icon_secret.gif" alt="Secret post"><?php }?>
<?php if(count($TPL_V1["board_file"]['file'])> 0){?><img src="/lib/images/icon_attach_file.png" alt="Attachments"><?php }?>
						</div>
						<h3>
							<strong><?php echo $TPL_V1["title"]?> </strong>
<?php if($TPL_VAR["board_info"]['comment']=='y'){?>
<?php if($TPL_V1["comment"]>'0'){?>[<?php echo $TPL_V1["comment"]?>]<?php }?>
<?php }?>
						</h3>
					</a>
				</div>
			</td>
		</tr>
<?php }}?>
<?php }else{?>
<?php if(count($TPL_VAR["board_list"]['notice_list'])< 1){?>
		<tr>
			<td colspan="2">No posts found.</td>
		</tr>
<?php }?>
<?php }?>
	</tbody>
</table><!--board_list-->