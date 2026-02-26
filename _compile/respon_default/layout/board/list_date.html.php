<?php /* Template_ 2.2.8 2025/06/30 10:58:48 /gcsd33_arklink/www/data/skin/respon_default/layout/board/list_date.html 000002790 */ ?>
<table class="bbs_table" summary="게시글 제목, 작성자, 작성일, 조회수, 게시글 내용 등..">
	<caption>게시글 내용</caption>
	<colgroup>
		<col width="10%">
		<col>
		<col width="14.3%">
	</colgroup>
	<thead>
		<tr>
			<th scope="col">번호</th>
			<th scope="col">제목</th>
			<th scope="col">작성일</th>
		</tr>
	</thead>
	<tbody>
<?php if(isset($TPL_VAR["board_list"]['notice_list'])){?>
<?php if(count($TPL_VAR["board_list"]['notice_list'])> 0){?>
<?php if(is_array($TPL_R1=$TPL_VAR["board_list"]['notice_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
		<tr class="board_notice">
			<td>공지</td>
			<td class="left">
<?php if($TPL_V1["is_read"]=='s'){?><a href="/board/board_secret?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>&page=view"><?php }else{?><a href="/board/board_view?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>&search_type=<?php echo $TPL_VAR["req"]['search_type']?>&search=<?php echo $TPL_VAR["req"]['search']?>"><?php }?>
<?php if($TPL_V1["preface"]){?><em>[<?php echo $TPL_V1["preface"]?>]</em><?php }?><?php echo $TPL_V1["title"]?>

<?php if($TPL_V1["display_read"]=='s'){?><img src="/data/skin/respon_default/images/common/icon_secret.gif" alt="비밀글"><?php }?>
                </a>
			</td>
            <td><?php echo date("Y.m.d",strtotime($TPL_V1["regdt_date"]))?></td>
		</tr>
<?php }}?>
<?php }?>
<?php }?>
<?php if(isset($TPL_VAR["board_list"]['board_list'])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["board_list"]['board_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
		<tr>
			<td><?php echo $TPL_VAR["board_list"]['total_rows']-$TPL_K1-$TPL_VAR["board_info"]['offset']?></td>
			<td class="left">
<?php if($TPL_V1["is_read"]=='s'){?><a href="/board/board_secret?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>&page=view"><?php }else{?><a href="/board/board_view?code=<?php echo $TPL_V1["code"]?>&no=<?php echo $TPL_V1["no"]?>&search_type=<?php echo $TPL_VAR["req"]['search_type']?>&search=<?php echo $TPL_VAR["req"]['search']?>"><?php }?>
<?php if($TPL_V1["preface"]){?><em>[<?php echo $TPL_V1["preface"]?>]</em><?php }?><?php echo $TPL_V1["title"]?>

                </a>
<?php if($TPL_V1["display_read"]=='s'){?><img src="/data/skin/respon_default/images/sub/icon_secret.svg" alt="비밀글"><?php }?>
			</td>
            <td><?php echo date("Y.m.d",strtotime($TPL_V1["regdt_date"]))?></td>
		</tr>
<?php }}?>
<?php }else{?>
<?php if(count($TPL_VAR["board_list"]['notice_list'])< 1){?>
		<tr>
			<td colspan="3">게시글이 없습니다.</td>
		</tr>
<?php }?>
<?php }?>
	</tbody>
</table><!--board_list-->