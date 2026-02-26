<?php /* Template_ 2.2.8 2025/04/15 09:59:03 /gcsd33_arklink/www/data/skin/respon_default_en/board/_form_board_write.html 000032312 */ ?>
<!-- <script type="text/javascript" src="/lib/js/common_board.js"></script> -->
<script type="text/javascript" src="<?php echo $TPL_VAR["js"]?>/js/common_board.js"></script>
<script type="text/javascript" src="/lib/smarteditor2-master/workspace/static/js/service/HuskyEZCreator.js" charset="utf-8"></script>
<script>
	var Common_Board = new common_board({
		code : "<?php echo $TPL_VAR["board_info"]['code']?>",
		no : "<?php echo $TPL_VAR["board_view"]['board_view']['no']?>",
		is_login : "<?php echo defined('_IS_LOGIN')?>"
	});

	$(function() {
		$("form[name='frm']").validate({
			rules : {
				title : {required : true},
<?php if($TPL_VAR["board_info"]['yn_mobile']=='y'){?>mobile : {required : true, onlyNumHyphenValid : true},<?php }?>
<?php if($TPL_VAR["board_info"]['yn_email']=='y'){?>email : {required : true, email : true},<?php }?>
<?php if($TPL_VAR["board_info"]['yn_video']=='y'){?>video_url : {required : true, regUrlType : true},<?php }?>
				name : {required : true},
<?php if($TPL_VAR["board_info"]['mode']!='modify'){?>
				password : {required : true, rangelength : [4, 20]},
<?php }?>
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!='index_'){?>//메인에서 에디터 적용금지
				content : {editorRequired : {depends : function(){return !getSmartEditor("contents")}}},
<?php }?>
				file : {},
				nonMember : {required : {depends : function(){return <?php if(!defined('_IS_LOGIN')){?>true<?php }else{?>false<?php }?>}}},
				// 추가필드 rules Start
<?php if($TPL_VAR["board_info"]['extraFl']=='y'&&!empty($TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
						<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?> : {
							editorRequired : {
								depends : function(){
<?php if(!empty($TPL_VAR["board_info"]['extraFieldInfo']['require'][$TPL_VAR["cfg_site"]['language']][$TPL_K1])){?>
<?php if($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='editor'){?>
											return !getSmartEditor("<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>");
<?php }elseif($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='file'){?>
											if(!$("[name=<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>_fname]").val()){
												return true;
											}
<?php }elseif($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='checkbox'||$TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='radio'){?>
											if(!$("[name=<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>]:checked").val()){
												return true;
											}
<?php }else{?>
											if(!$("[name=<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>]").val()){
												return true;
											}
<?php }?>
										return false;
<?php }else{?>
<?php if($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='editor'){?>
											getSmartEditor("<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>");
<?php }?>
										return false;
<?php }?>
								}
							}
						},
<?php }}?>
<?php }?>
				// 추가필드 rules End
<?php if($TPL_VAR["board_info"]["use_captcha"]=="y"){?>
				captcha: { required: true }
<?php }?>
			}, messages : {
				title : {required : "Please enter the title."},
<?php if($TPL_VAR["board_info"]['yn_mobile']=='y'){?>mobile : {required : "Please enter the mobile phone number.", onlyNumHyphenValid : "mobile is only available in numbers and Hyphen."},<?php }?>
<?php if($TPL_VAR["board_info"]['yn_email']=='y'){?>email : {required : "Please enter your e-mail.", email : "Please enter a valid email."},<?php }?>
<?php if($TPL_VAR["board_info"]['yn_video']=='y'){?>video_url : {required : "Please enter the URL of the video.", regUrlType : "Please enter the correct url."},<?php }?>
				name : {required : "Please enter the author of the post."},
<?php if($TPL_VAR["board_info"]['mode']!='modify'){?>
				password : {required : "Please enter a password.", rangelength: $.validator.format("The password is between {0}~{1} characters.")},
<?php }?>
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!='index_'){?>//메인에서 에디터 적용금지
				content : {editorRequired : "Please enter your content."},
<?php }?>
				file : {},
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!='index_'){?>//메인에서 태그 가져오지 못하는 오류 수정
				nonMember : {required : "please check <?php echo $TPL_VAR["terms"]['nonMember']['title']?>."},
<?php }else{?>
				nonMember : {required : "Please check the consent for nonmember personal data collection items."},
				
<?php }?>
				// 추가필드 messages Start
<?php if($TPL_VAR["board_info"]['extraFl']=='y'&&!empty($TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
					<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?> : {
						editorRequired : "<?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]?> is required."
					},
<?php }}?>
<?php }?>
				// 추가필드 messages End
<?php if($TPL_VAR["board_info"]["use_captcha"]=="y"){?>
				captcha: { required: "Please enter the automatic registration prevention code." }
<?php }?>
			}
		});

<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!='index_'){?>//메인에서 에디터 적용금지
		attachSmartEditor("contents", "board");
<?php if($TPL_VAR["board_info"]['extraFl']=='y'&&!empty($TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
<?php if($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='editor'){?>
						// 추가필드 에디터 적용
						attachSmartEditor("<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>", "board");
<?php }?>
<?php }}?>
<?php }?>
<?php }?>
		uploadForm.init(document.frm);

		$("#refreshCode").on("click", function() {
			$.ajax({
				url : "/captchaRequest/get", 
				datatype : "json",
				type : "POST",
				data : {"page" : "write"},
				success : function(response, status, request){
					if(status == "success") {
						if(request.readyState == "4" && request.status == "200") {
							var result = JSON.parse(response);
							if(result.code) {
								$("#captcha_box").html(result.captcha.image);
							} else {
								alert(result.error);
							}
						}
					}
				}, error : function(request, status, error){
					alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}
			});
		});
	});

    function thumbnail_image_choice(value) {
        var file_fname = $('[name="'+value+'_fname"]').val();

        if ($('[name="'+value+'_image"]').is(":checked") === true) {
            if (file_fname == "" || typeof file_fname === "undefined")
            {
                $('[name="'+value+'_image"]').prop("checked", false);
                alert("No files selected.");
                return false;
            } else {
                if ($(".thumbnail_image:checked").length > 1) {
                    $('[name="'+value+'_image"]').prop("checked", false);
                }else {
                    $('[name="'+value+'_image"]').prop("checked", true);
                    $('[name="'+value+'_image"]').val(file_fname);
                }
            }
        }
    }
</script>
	<form name="frm" id="frm" action="/en/board/board_write" target="ifr_processor" method="POST">
		<fieldset>
			<legend>게시글 작성</legend>
			<input type="hidden" name="write_userid" value="<?php echo $TPL_VAR["board_view"]['board_view']['userid']?>" />
			<input type="hidden" name="code" value="<?php echo $TPL_VAR["board_info"]['code']?>" />
			<input type="hidden" name="mode" value="<?php echo $TPL_VAR["board_info"]['mode']?>" />
			<input type="hidden" name="no" value="<?php echo $TPL_VAR["board_view"]['board_view']['no']?>" />
			<input type="hidden" name="cref" value="<?php echo $TPL_VAR["board_view"]['board_view']['cref']?>" />
			<input type="hidden" name="upload_path" value="<?php echo $TPL_VAR["board_view"]['board_view']['upload_path']?>" />
			<!-- 메인에서 게시글 작성시 사용하는 폼 -->
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]=='index_'){?>
			<table class="board_main_write" summary="Compose Post, Title, Author, Details, File Attachments, etc.">
				<caption>Compose Post</caption>
				<colgroup>
					<col width="262">
					<col >
				</colgroup>
				<tbody>
					<tr>
						<td>
							<strong>Author</strong>
							<input type="text" name="name" id="name" placeholder="NAME" value="<?php if($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer'){?><?php if(defined('_IS_LOGIN')){?><?php echo $TPL_VAR["member"]['name']?><?php }?><?php }else{?><?php echo $TPL_VAR["board_view"]['board_view']['name']?><?php }?>" <?php if($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer'){?><?php if(defined('_IS_LOGIN')){?>readonly<?php }?><?php }elseif($TPL_VAR["board_info"]['mode']=='modify'){?><?php if(defined('_IS_LOGIN')){?>readonly<?php }?><?php }?>/><label for="name" class="dn">Author</label>
						</td>
<?php if($TPL_VAR["board_info"]['yn_email']=='y'){?>
						<td>
							<strong>e-mail</strong>
							<input type="text" name="email" placeholder="MAIL" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['email']?>" required />
						</td>
<?php }?>
					</tr>
<?php if($TPL_VAR["board_info"]['yn_mobile']=='y'){?>
					<tr>
						<td colspan="2">
							<strong>Mobile</strong>
							<input type="text" name="mobile" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['mobile']?>" />
						</td>
					</tr>
<?php }?>
<?php if($TPL_VAR["board_info"]['yn_video']=='y'){?>
					<tr>
						<td colspan="2">
							<strong>Video URL</strong>
							<input type="text" name="video_url" value="<?php echo $TPL_VAR["board_view"]['board_view']['video_url']?>" />
						</td>
					</tr>
<?php }?>
					<tr>
						<td <?php if(!defined('_IS_LOGIN')){?><?php }else{?>colspan="2"<?php }?>>
							<strong>title</strong>
							<input type="text" name="title" id="title" placeholder="SUBJECT" value="<?php echo $TPL_VAR["board_view"]['board_view']['title']?>" /><label for="title" class="dn">title</label>
						</td>
<?php if(($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer')&&!defined('_IS_LOGIN')){?>
						<!-- 글작성, 글답변작성 시 비회원유저 -->
							<td>
								<strong>password</strong>
								<input type="password" name="password" placeholder="PASSWORD" id="password" /><label for="password" class="dn">Posts password</label>
							</td>
<?php }elseif($TPL_VAR["board_info"]['mode']=='modify'&&!$TPL_VAR["board_view"]['board_view']['userid']){?>
						<!--  글수정 시 비회원 글 -->
							<td class="hide">
								<strong>password</strong>
								<input type="password" name="password" id="password" placeholder="PASSWORD"  value="<?php echo $TPL_VAR["board_view"]['board_view']['password']?>" readonly /><label for="password" class="dn">Posts password</label>
							</td>
<?php }?>
					</tr>
					<tr>
						<td colspan="2">
							<div class="edit-box" style="width:100%;"><textarea name="content" id="contents" style="<?php if(!defined('_IS_LOGIN')){?>height:122px;<?php }else{?>height:154px;<?php }?>" title="Please enter your content."><?php echo $TPL_VAR["board_view"]['board_view']['content']?></textarea></div>
						</td>
					</tr>
<?php if($TPL_VAR["board_info"]['files']=='y'){?>
					<tr>
						<td colspan="2">
							<strong>File attachment</strong>
							<input type="file" name="file" id="file" /><label for="file" class="dn">File attachment</label>
							<input type="hidden" name="file_oname" value="<?php echo $TPL_VAR["board_view"]['board_view']['oname']?>" />
							<input type="hidden" name="file_fname" value="<?php echo $TPL_VAR["board_view"]['board_view']['fname']?>" />
							<input type="hidden" name="file_type" value="all" />
							<input type="hidden" name="file_size" value="<?php echo $TPL_VAR["board_info"]['filesize']?>" />
							<input type="hidden" name="file_folder" value="<?php echo _UPLOAD?>/board/<?php echo $TPL_VAR["board_info"]['code']?>" />
							<span id="file_filezone">
								<a href="/fileRequest/download?file=<?php echo urlencode('/board/'.$TPL_VAR["board_view"]['board_view']['upload_path'].'/'.$TPL_VAR["board_view"]['board_view']['fname'])?>" target="_blank" style="color:cornflowerblue;"><?php echo $TPL_VAR["board_view"]['board_view']['oname']?></a>
<?php if(isset($TPL_VAR["board_view"]['board_view']['oname'])&&$TPL_VAR["board_view"]['board_view']['oname']){?><a href="javascript://" onclick="uploadForm.uploadRemove('file')" class="file_no"><img src="/lib/images/btn_close.gif" alt="닫기"></a><?php }?>
							</span>
							<p>(*If you do not register your image, no image will be shown in your thumbnail.)</p>
						</td>
					</tr>
<?php }?>
<?php if(!defined('_IS_LOGIN')){?>
					<tr>
						<td colspan="2" class="check_td">
<?php if($TPL_VAR["board_info"]['secret']=='2'){?>
							<input type="checkbox" name="is_secret" id="is_secret-y" value="y" <?php if($TPL_VAR["board_view"]['board_view']['is_secret']=='y'){?>checked<?php }?>><label for="is_secret-y">Write as a secret post.</label>
<?php }elseif($TPL_VAR["board_info"]['secret']=='1'){?>
							<input type="hidden" name="is_secret" value="y">
<?php }else{?>
							<input type="hidden" name="is_secret" value="n">
<?php }?>
							<!-- 개인정보 수집항목 동의 -->
							<div class="policy_cont dis_inblock ml_20">
								<div>
									<input type="checkbox" name="nonMember" id="checkbox-nonMember" />
									<label for="checkbox-nonMember">Consent for Nonmember Personal Data Collection Items</label>
									<a href="/service/usepolicy" target="_blank">See All ></a>
								</div>
							</div><!-- .policy_cont -->
						</td>
					</tr>
<?php }?>
				</tbody>
			</table><!--board_write-->
			<button onclick="Common_Board.board_write(this.form); return false;"><a href="javascript://" class="btn_send_main">SEND MESSAGE</a></button>
<?php }else{?>
			<!-- 게시글 작성 페이지에서 게시글 작성시 사용하는 폼 -->

			<table class="bbs_write bbs_title" summary="Compose Post, Title, Author">
				<caption>Compose Post</caption>
				<colgroup>
					<col width="15%">
					<col >
				</colgroup>
				<tbody>
					<tr>
						<th scope="row">Title</th>
						<td><input type="text" name="title" id="title" value="<?php echo $TPL_VAR["board_view"]['board_view']['title']?>" /><label for="title" class="dn">Title</label></td>
					</tr>
					<tr>
						<th scope="row">Author</th>
						<td><input type="text" name="name" id="name" value="<?php if($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer'){?><?php if(defined('_IS_LOGIN')){?><?php echo $TPL_VAR["member"]['name']?><?php }?><?php }else{?><?php echo $TPL_VAR["board_view"]['board_view']['name']?><?php }?>" <?php if($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer'){?><?php if(defined('_IS_LOGIN')){?>readonly<?php }?><?php }elseif($TPL_VAR["board_info"]['mode']=='modify'){?><?php if(defined('_IS_LOGIN')){?>readonly<?php }?><?php }?>/><label for="name" class="dn">Author</label></td>
					</tr>
<?php if($TPL_VAR["board_info"]['yn_email']=='y'){?>
					<tr>
						<th>E-mail</th>
						<td>
							<input type="text" name="email" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['email']?>" />
						</td>
					</tr>
<?php }?>
<?php if($TPL_VAR["board_info"]['yn_mobile']=='y'){?>
					<tr>
						<th>Mobile</th>
						<td>
							<input type="text" name="mobile" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['mobile']?>" />
						</td>
					</tr>
<?php }?>
<?php if($TPL_VAR["board_info"]['yn_video']=='y'){?>
					<tr>
						<th>Video URL</th>
						<td><input type="text" name="video_url" value="<?php echo $TPL_VAR["board_view"]['board_view']['video_url']?>" /></td>
					</tr>
<?php }?>
<?php if(($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer')&&!defined('_IS_LOGIN')){?>
					<!-- 글작성, 글답변작성 시 비회원유저 -->
					<tr>
						<th scope="row">Password</th>
						<td>
							<input type="password" name="password" id="password" /><label for="password" class="dn">password for the post</label>
						</td>
					</tr>

<?php }elseif($TPL_VAR["board_info"]['mode']=='modify'&&!$TPL_VAR["board_view"]['board_view']['userid']){?>
					<!--  글수정 시 비회원 글 -->
					<tr class="hide">
						<th scope="row">Password</th>
						<td>
							<input type="password" name="password" id="password" value="<?php echo $TPL_VAR["board_view"]['board_view']['password']?>" readonly /><label for="password" class="dn">password for the post</label>
						</td>
					</tr>
<?php }?>
				</tbody>
			</table>
			<table class="bbs_write bbs_content"  summary="details">
				<caption>details</caption>
				<colgroup>
					<col width="15%">
					<col>
				</colgroup>
				<tbody>
					<tr>
						<th scope="row">Details</th>
						<td>
<?php if($TPL_VAR["board_info"]['secret']=='2'){?>
							<input type="checkbox" name="is_secret" id="is_secret-y" value="y" <?php if($TPL_VAR["board_view"]['board_view']['is_secret']=='y'){?>checked<?php }?>><label for="is_secret-y">Write as a secret post </label>
<?php }elseif($TPL_VAR["board_info"]['secret']=='1'){?>
							<input type="hidden" name="is_secret" value="y">
<?php }else{?>
							<input type="hidden" name="is_secret" value="n">
<?php }?>
							<div class="edit-box" style="width:100%;"><textarea name="content" id="contents" style="height:320px" title="Please enter your content."><?php echo $TPL_VAR["board_view"]['board_view']['content']?></textarea></div>
						</td>
					</tr>
				</tbody>
			</table>	
			<table class="bbs_write bbs_bottom"  summary="etc">
				<caption>etc</caption>
				<colgroup>
					<col width="15%">
					<col>
				</colgroup>
				<tbody>
<?php if($TPL_VAR["board_info"]['thumbnail']=="y"){?>
<?php if(is_array($TPL_R1=range( 1,$TPL_VAR["board_info"]['thumbnail_count']))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
						<tr>
<?php if($TPL_V1== 1){?><th scope="row" rowspan="<?php echo $TPL_VAR["board_info"]['thumbnail_count']?>">thumbnail</th><?php }?>
							<td>
								<input type="file" name="thumbnail<?php echo $TPL_V1?>" id="thumbnail" /><label for="thumbnail" class="dn">thumbnail</label>
								<div class="dn">
								<input type="checkbox" name="thumbnail<?php echo $TPL_V1?>_image" class="thumbnail_image" value="<?php echo $TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][$TPL_K1]['fname']?>" id="thumbnail_image<?php echo $TPL_V1?>" <?php if($TPL_VAR["board_view"]['board_view']['thumbnail_image']&&($TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][$TPL_K1]['fname']==$TPL_VAR["board_view"]['board_view']['thumbnail_image'])){?> checked <?php }?> <?php if($TPL_V1== 1){?> checked <?php }?>  onclick="thumbnail_image_choice('thumbnail<?php echo $TPL_V1?>');"/>
								<label for="thumbnail_image<?php echo $TPL_V1?>">Use representative images</label>
								</div>
								<input type="hidden" name="thumbnail<?php echo $TPL_V1?>_oname" value="<?php echo $TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][($TPL_K1)]['oname']?>" />
								<input type="hidden" name="thumbnail<?php echo $TPL_V1?>_fname" value="<?php echo $TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][($TPL_K1)]['fname']?>" />
								<input type="hidden" name="thumbnail<?php echo $TPL_V1?>_type" value="image" />
								<input type="hidden" name="thumbnail<?php echo $TPL_V1?>_size" value="<?php echo $TPL_VAR["board_info"]['filesize']?>" />
								<input type="hidden" name="thumbnail<?php echo $TPL_V1?>_folder" value="<?php echo _UPLOAD?>/board/<?php echo $TPL_VAR["board_info"]['code']?>" />
								<span id="thumbnail<?php echo $TPL_V1?>_filezone">
									<a href="/fileRequest/download?file=<?php echo urlencode('/board/'.$TPL_VAR["board_view"]['board_view']['upload_path'].'/'.$TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][($TPL_K1)]['fname'])?>" target="_blank" style="color:cornflowerblue;"><?php echo $TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][($TPL_K1)]['oname']?></a>
<?php if(isset($TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][($TPL_K1)]['oname'])&&$TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][($TPL_K1)]['oname']){?><a href="javascript://" onclick="uploadForm.uploadRemove('thumbnail<?php echo $TPL_V1?>')" class="file_no"><img src="/lib/images/btn_close.gif" alt="닫기"></a><?php }?>
								</span>
								<!-- <p>(*이미지 등록을 안하실 경우, 썸네일에 노이미지가 노출됩니다.)</p> -->
							</td>
						</tr>
<?php }}?>
<?php }?>
<?php if($TPL_VAR["board_info"]['files']=="y"){?>
<?php if(is_array($TPL_R1=range( 1,$TPL_VAR["board_info"]['file_count']))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
						<tr>
<?php if($TPL_V1== 1){?><th scope="row" rowspan="<?php echo $TPL_VAR["board_info"]['file_count']?>">File Attachments</th><?php }?>
							<td>
								<input type="file" name="file<?php echo $TPL_V1?>" id="file" /><label for="file" class="dn">File Attachments</label>
								<input type="hidden" name="file<?php echo $TPL_V1?>_oname" value="<?php echo $TPL_VAR["board_view"]['board_view']['board_file']['file'][($TPL_K1)]['oname']?>" />
								<input type="hidden" name="file<?php echo $TPL_V1?>_fname" value="<?php echo $TPL_VAR["board_view"]['board_view']['board_file']['file'][($TPL_K1)]['fname']?>" />
								<input type="hidden" name="file<?php echo $TPL_V1?>_type" value="all" />
								<input type="hidden" name="file<?php echo $TPL_V1?>_size" value="<?php echo $TPL_VAR["board_info"]['filesize']?>" />
								<input type="hidden" name="file<?php echo $TPL_V1?>_folder" value="<?php echo _UPLOAD?>/board/<?php echo $TPL_VAR["board_info"]['code']?>" />
								<span id="file<?php echo $TPL_V1?>_filezone">
									<a href="/fileRequest/download?file=<?php echo urlencode('/board/'.$TPL_VAR["board_view"]['board_view']['upload_path'].'/'.$TPL_VAR["board_view"]['board_view']['board_file']['file'][($TPL_K1)]['fname'])?>" target="_blank" style="color:cornflowerblue;"><?php echo $TPL_VAR["board_view"]['board_view']['board_file']['file'][($TPL_K1)]['oname']?></a>
<?php if(isset($TPL_VAR["board_view"]['board_view']['board_file']['file'][($TPL_K1)]['oname'])&&$TPL_VAR["board_view"]['board_view']['board_file']['file'][($TPL_K1)]['oname']){?><a href="javascript://" onclick="uploadForm.uploadRemove('file<?php echo $TPL_V1?>')" class="file_no"><img src="/lib/images/btn_close.gif" alt="닫기"></a><?php }?>
								</span>
							</td>
						</tr>
<?php }}?>
<?php }?>
					
					<!--추가 필드-->
<?php if($TPL_VAR["board_info"]['extraFl']=='y'&&!empty($TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
							<tr>
								<th scope="row"><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]?></th>
								<td>
<?php if($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='checkbox'){?>
<?php if(is_array($TPL_R2=$TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['item'])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_K2=>$TPL_V2){?>
											<input type="checkbox" id="<?php echo $TPL_K1?>-<?php echo $TPL_VAR["cfg_site"]['language']?>-<?php echo $TPL_K2?>" name="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>" value="<?php echo $TPL_V2?>">
											<label for="<?php echo $TPL_K1?>-<?php echo $TPL_VAR["cfg_site"]['language']?>-<?php echo $TPL_K2?>">
												<?php echo $TPL_V2?>

											</label>
<?php }}?>
<?php }elseif($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='radio'){?>
<?php if(is_array($TPL_R2=$TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['item'])&&!empty($TPL_R2)){$TPL_I2=-1;foreach($TPL_R2 as $TPL_K2=>$TPL_V2){$TPL_I2++;?>
											<input type="radio" id="<?php echo $TPL_K1?>-<?php echo $TPL_VAR["cfg_site"]['language']?>-<?php echo $TPL_K2?>" name="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>" value="<?php echo $TPL_V2?>"
<?php if($TPL_V2==$TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]||(!$TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]&&$TPL_I2== 0)){?>
												checked = "checked"
<?php }?>
											>
											<label for="<?php echo $TPL_K1?>-<?php echo $TPL_VAR["cfg_site"]['language']?>-<?php echo $TPL_K2?>">
												<?php echo $TPL_V2?>

											</label>
											
<?php }}?>
<?php }elseif($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='select'){?>
										<select name="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>">
<?php if(is_array($TPL_R2=$TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['item'])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
												<option value="<?php echo $TPL_V2?>"
<?php if($TPL_V2==$TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]){?>
														selected
<?php }?>
												>
													<?php echo $TPL_V2?>

												</option>
<?php }}?>
										</select> 
<?php }elseif($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='editor'){?>
										<div class="edit-box" style="width:100%;">
											<textarea name="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>" id="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>" style="height:320px" title="Please enter your content.">
												<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]?>

											</textarea>
										</div>
<?php }elseif($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='file'){?>
										<input type="file" name="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>" />
										<input type="hidden" name="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>_oname" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1.'_oname']?>" />
										<input type="hidden" name="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>_fname" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1.'_fname']?>" />
										<input type="hidden" name="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>_type" value="<?php echo $TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['file_type']?>" />
										<input type="hidden" name="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>_size" value="<?php echo $TPL_VAR["board_info"]['extra_file_size']?>" />
										<input type="hidden" name="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>_folder" value="<?=_UPLOAD?>/board/<?php echo $TPL_VAR["board_info"]['code']?>" />
<?php if($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['file_type']=='image'){?>
<?php if($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['width']){?>
												<input type="hidden" name="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>_height" value="board_info['extraFieldInfo']['option'][cfg_site['language']][.key_]['width']">
<?php }?>
<?php if($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['height']){?>
												<input type="hidden" name="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>_height" value="board_info['extraFieldInfo']['option'][cfg_site['language']][.key_]['height']">
<?php }?>
<?php }?>
										<span id="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>_filezone">
<?php if(!empty($TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1])){?>
												<a href="/fileRequest/download?file=<?php echo urlencode('/board/'.$TPL_VAR["board_view"]['board_view']['upload_path'].'/'.$TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1.'_fname'])?>&save=<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1.'_oname']?>" target="_blank" style="color:cornflowerblue;">
													<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1.'_oname']?>

												</a>
												<a href="javascript://" onclick="uploadForm.uploadRemove('<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>')" class="file_no">
													<img src="/lib/images/btn_close.gif" alt="Close">
												</a>
<?php }?>
										</span>
<?php }else{?>
										<input type="text" name="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]?>" />
<?php }?>
								</td>
							</tr>
<?php }}?>
<?php }?>
<?php if($TPL_VAR["board_info"]["use_captcha"]=="y"){?>
<?php if(!$TPL_VAR["board_view"]["board_view"]["no"]){?>
					<tr>
						<th scope="row">CAPTCHA</th>
						<td>
							<span id="captcha_box"><?php echo $TPL_VAR["captcha"]["image"]?></span>
							<input type="text" name="captcha" id="captcha" class="input">
							<label for="captcha" class="dn">Enter CAPTCHA Code</label>
							<span class="btn_sm btn_reset" id="refreshCode"> Refresh</span>
						</td>
					</tr>
<?php }?>
<?php }?>
<?php if(!defined('_IS_LOGIN')){?>
					<tr>
						<td colspan="2">
							<!-- 개인정보 수집항목 동의 -->
							<div class="policy_cont">
								<div>
									<input type="checkbox" name="nonMember" id="checkbox-nonMember" />
									<label for="checkbox-nonMember"><?php echo $TPL_VAR["terms"]['nonMember']['title']?></label>
									<a href="/service/usepolicy" target="_blank" class="btn_sm btn_info">See All ></a>
									<textarea cols="30" rows="5" align="left" class="write" title="개인정보 수집항목 동의"><?php echo $TPL_VAR["terms"]['nonMember']['text']?></textarea>
								</div>
							</div><!-- .policy_cont -->
						</td>
					</tr>
<?php }?>
				</tbody>
			</table><!--board_write-->
			<div class="btn_wrap ta_center">
				<button onclick="Common_Board.board_write(this.form); return false;"><a href="javascript://" class="btn_point btn">OK</a></button>
				<a href="/en/board/board_list?code=<?php echo $TPL_VAR["board_info"]['code']?>" class="btn btn_basic">Cancel</a>
			</div><!--btn_center-->
<?php }?>
		</fieldset>
	</form>