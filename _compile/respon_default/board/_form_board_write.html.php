<?php /* Template_ 2.2.8 2025/10/27 13:15:01 /gcsd33_arklink/www/data/skin/respon_default/board/_form_board_write.html 000043103 */ ?>
<script src="<?php echo $TPL_VAR["js"]?>/js/custom_bak.js"></script>

<form name="frm" id="frm" action="/board/board_write" target="ifr_processor" method="POST">
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
        <table class="board_main_write" summary="게시글 작성, 제목, 작성자, 내용, 파일첨부 등등..">
            <caption>게시글 작성</caption>
            <colgroup>
                <col width="19%">
                <col >
            </colgroup>
            <tbody>
                <tr>
                    <td>
                        <strong>작성자</strong>
                        <input type="text" name="name" id="name" placeholder="NAME" value="<?php if($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer'){?><?php if(defined('_IS_LOGIN')){?><?php echo $TPL_VAR["member"]['name']?><?php }?><?php }else{?><?php echo $TPL_VAR["board_view"]['board_view']['name']?><?php }?>" <?php if($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer'){?><?php if(defined('_IS_LOGIN')){?>readonly<?php }?><?php }elseif($TPL_VAR["board_info"]['mode']=='modify'){?><?php if(defined('_IS_LOGIN')){?>readonly<?php }?><?php }?>/><label for="name" class="dn">작성자</label>
                    </td>
<?php if($TPL_VAR["board_info"]['yn_email']=='y'){?>
                    <td>
                        <strong>이메일</strong>
                        <input type="text" name="email" placeholder="MAIL" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['email']?>" required />
                    </td>
<?php }?>
                </tr>
<?php if($TPL_VAR["board_info"]['yn_mobile']=='y'){?>
                <tr>
                    <td colspan="2">
                        <strong>모바일</strong>
                        <input type="text" name="mobile" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['mobile']?>" />
                    </td>
                </tr>
<?php }?>
<?php if($TPL_VAR["board_info"]['yn_video']=='y'){?>
                <tr>
                    <td colspan="2">
                        <strong>동영상 주소</strong>
                        <input type="text" name="video_url" value="<?php echo $TPL_VAR["board_view"]['board_view']['video_url']?>" />
                    </td>
                </tr>
<?php }?>
                <tr>
                    <td <?php if(!defined('_IS_LOGIN')){?><?php }else{?>colspan="2"<?php }?>>
                        <strong>제목</strong>
                        <input type="text" name="title" id="title" placeholder="SUBJECT" value="<?php echo $TPL_VAR["board_view"]['board_view']['title']?>" /><label for="title" class="dn">제목</label>
                    </td>
<?php if(($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer')&&!defined('_IS_LOGIN')){?>
                    <!-- 글작성, 글답변작성 시 비회원유저 -->
                        <td>
                            <strong>비밀번호</strong>
                            <input type="password" name="password" placeholder="PASSWORD" id="password" /><label for="password" class="dn">게시글 비밀번호</label>
                        </td>
<?php }elseif($TPL_VAR["board_info"]['mode']=='modify'&&!$TPL_VAR["board_view"]['board_view']['userid']){?>
                    <!--  글수정 시 비회원 글 -->
                        <td class="hide">
                            <strong>비밀번호</strong>
                            <input type="password" name="password" id="password" placeholder="PASSWORD"  value="<?php echo $TPL_VAR["board_view"]['board_view']['password']?>" readonly /><label for="password" class="dn">게시글 비밀번호</label>
                        </td>
<?php }?>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="edit-box" style="width:100%;"><textarea name="content" id="contents" style="<?php if(!defined('_IS_LOGIN')){?>height:122px;<?php }else{?>height:154px;<?php }?>" title="내용을 입력하세요."><?php echo $TPL_VAR["board_view"]['board_view']['content']?></textarea></div>
                    </td>
                </tr>
<?php if($TPL_VAR["board_info"]['files']=='y'){?>
                <tr>
                    <td colspan="2">
                        <strong>파일첨부</strong>
                        <input type="file" name="file" id="file" /><label for="file" class="dn">파일첨부</label>
                        <input type="hidden" name="file_oname" value="<?php echo $TPL_VAR["board_view"]['board_view']['oname']?>" />
                        <input type="hidden" name="file_fname" value="<?php echo $TPL_VAR["board_view"]['board_view']['fname']?>" />
                        <input type="hidden" name="file_type" value="diagnosis" />
                        <input type="hidden" name="file_size" value="<?php echo $TPL_VAR["board_info"]['filesize']?>" />
                        <input type="hidden" name="file_folder" value="<?php echo _UPLOAD?>/board/<?php echo $TPL_VAR["board_info"]['code']?>" />
                        <span id="file_filezone">
                            <a href="/fileRequest/download?file=<?php echo urlencode('/board/'.$TPL_VAR["board_view"]['board_view']['upload_path'].'/'.$TPL_VAR["board_view"]['board_view']['fname'])?>" target="_blank" style="color:cornflowerblue;"><?php echo $TPL_VAR["board_view"]['board_view']['oname']?></a>
<?php if(isset($TPL_VAR["board_view"]['board_view']['oname'])&&$TPL_VAR["board_view"]['board_view']['oname']){?><a href="javascript://" onclick="uploadForm.uploadRemove('file')" class="file_no"><img src="/lib/images/btn_close.gif" alt="닫기"></a><?php }?>
                        </span>
                        <p>(*이미지 등록을 안하실 경우, 썸네일에 노이미지가 노출됩니다.)</p>
                    </td>
                </tr>
<?php }?>
<?php if(!defined('_IS_LOGIN')){?>
                <tr>
                    <td colspan="2" class="check_td">
<?php if($TPL_VAR["board_info"]['secret']=='2'){?>
                        <input type="checkbox" name="is_secret" id="is_secret-y" value="y" <?php if($TPL_VAR["board_view"]['board_view']['is_secret']=='y'){?>checked<?php }?>><label for="is_secret-y">비밀글로 작성</label>
<?php }elseif($TPL_VAR["board_info"]['secret']=='1'){?>
                        <input type="hidden" name="is_secret" value="y">
<?php }else{?>
                        <input type="hidden" name="is_secret" value="n">
<?php }?>
                        <!-- 개인정보 수집항목 동의 -->
                        <div class="policy_cont dis_inblock ml_20">
                            <div>
                                <input type="checkbox" name="nonMember" id="checkbox-nonMember" />
                                <label for="checkbox-nonMember">비회원 개인정보 수집항목 동의</label>
                                <a href="/service/usepolicy" target="_blank">전체보기 ></a>
                            </div>
                        </div><!-- .policy_cont -->
                    </td>
                </tr>
<?php }?>
<?php if(!$TPL_VAR["board_view"]["board_view"]["no"]){?>
<?php }?>
            </tbody>
        </table><!--board_write-->
        <button onclick="Common_Board.board_write(this.form); return false;"><a href="javascript://" class="btn_send_main">SEND MESSAGE</a></button>
<?php }else{?>
        <!-- 게시글 작성 페이지에서 게시글 작성시 사용하는 폼 -->
        <div class="bbs_wrap">
            <table class="bbs_write bbs_title"  summary="게시글 작성, 제목, 작성자">
                <caption>게시글 작성</caption>
                <colgroup>
                    <col width="15%">
                    <col width="85%">
                </colgroup>
                <tbody>
<?php if(($TPL_VAR["board_info"]['mode']=="write"||$TPL_VAR["board_info"]['mode']=="modify")&&$TPL_VAR["board_info"]['yn_preface']=="y"){?>
                    <tr>
                        <th>말머리</th>
                        <td>
                            <select name="preface">
                                <option value="">선택안함</option>
<?php if(is_array($TPL_R1=(explode(',',$TPL_VAR["board_info"]['preface_kor'])))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
                                    <option value="<?php echo $TPL_V1?>" <?php if($TPL_VAR["board_view"]['board_view']['preface']==$TPL_V1){?>selected<?php }?>><?php echo $TPL_V1?></option>
<?php }}?>
                            </select>
                        </td>
                    </tr>
<?php }?>
                    <tr>
                        <th scope="row">이름 <em>*</em></th>
                        <td><input type="text" name="name" id="name" value="<?php if($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer'){?><?php if(defined('_IS_LOGIN')){?><?php echo $TPL_VAR["member"]['name']?><?php }?><?php }else{?><?php echo $TPL_VAR["board_view"]['board_view']['name']?><?php }?>" <?php if($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer'){?><?php if(defined('_IS_LOGIN')){?>readonly<?php }?><?php }elseif($TPL_VAR["board_info"]['mode']=='modify'){?><?php if(defined('_IS_LOGIN')){?>readonly<?php }?><?php }?>/><label for="name" class="dn">이름</label></td>
                    </tr>
<?php if($TPL_VAR["board_info"]['yn_email']=='y'){?>
                    <tr>
                        <th>이메일</th>
                        <td><input type="text" name="email" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['email']?>" /></td>
                    </tr>
<?php }?>
<?php if($TPL_VAR["board_info"]['yn_mobile']=='y'){?>
                    <tr>
                        <th>전화번호 <em>*</em></th>
                        <td>
                            <input type="text" name="mobile" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['mobile']?>" />
                        </td>
                    </tr>
<?php }?>
<?php if(($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer')&&!defined('_IS_LOGIN')){?>
                    <!-- 글작성, 글답변작성 시 비회원유저 -->
                    <tr>
                        <th scope="row">비밀번호 <em>*</em></th>
                        <td>
                            <input type="password" name="password" id="password" /><label for="password" class="dn">게시글 비밀번호</label>
                        </td>
                    </tr>
<?php }elseif($TPL_VAR["board_info"]['mode']=='modify'&&!$TPL_VAR["board_view"]['board_view']['userid']){?>
                    <!--  글수정 시 비회원 글 -->
                    <tr class="hide">
                        <th scope="row">비밀번호 <em>*</em></th>
                        <td>
                            <input type="password" name="password" id="password" value="<?php echo $TPL_VAR["board_view"]['board_view']['password']?>" readonly /><label for="password" class="dn">게시글 비밀번호</label>
                        </td>
                    </tr>
<?php }?>
                    <tr>
                        <th scope="row">제목 <em>*</em></th>
                        <td><input type="text" name="title" id="title" value="<?php echo $TPL_VAR["board_view"]['board_view']['title']?>" /><label for="title" class="dn">제목</label></td>
                    </tr>
<?php if($TPL_VAR["board_info"]['yn_video']=='y'){?>
                    <tr>
                        <th>동영상 주소</th>
                        <td><input type="text" name="video_url" value="<?php echo $TPL_VAR["board_view"]['board_view']['video_url']?>" /></td>
                    </tr>
<?php }?>
                    <tr>
                        <th scope="row">내용 <em>*</em></th>
                        <td>
<?php if($TPL_VAR["board_info"]['secret']=='2'){?>
                            <label for="is_secret-y"><input type="checkbox" name="is_secret" id="is_secret-y" value="y" <?php if($TPL_VAR["board_view"]['board_view']['is_secret']=='y'){?>checked<?php }?>>비밀글로 작성</label>
<?php }elseif($TPL_VAR["board_info"]['secret']=='1'){?>
                            <input type="hidden" name="is_secret" value="y">
<?php }else{?>
                            <input type="hidden" name="is_secret" value="n">
<?php }?>
                            <div class="edit-box" style="width:100%;"><textarea name="content" id="contents" style="height:320px" title="내용을 입력하세요."><?php echo $TPL_VAR["board_view"]['board_view']['content']?></textarea></div>
                        </td>
                    </tr>
<?php if($TPL_VAR["board_info"]['thumbnail']=="y"){?>
<?php if(is_array($TPL_R1=range( 1,$TPL_VAR["board_info"]['thumbnail_count']))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
                        <tr>
<?php if($TPL_V1== 1){?><th scope="row" rowspan="<?php echo $TPL_VAR["board_info"]['thumbnail_count']?>">썸네일</th><?php }?>
                            <td>
                                <input type="file" name="thumbnail<?php echo $TPL_V1?>" id="thumbnail" /><label for="thumbnail" class="dn">썸네일</label>
                                <div class="dn">
                                <input type="checkbox" name="thumbnail<?php echo $TPL_V1?>_image" class="thumbnail_image" value="<?php echo $TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][$TPL_K1]['fname']?>" id="thumbnail_image<?php echo $TPL_V1?>" <?php if($TPL_VAR["board_view"]['board_view']['thumbnail_image']&&($TPL_VAR["board_view"]['board_view']['board_file']['thumbnail'][$TPL_K1]['fname']==$TPL_VAR["board_view"]['board_view']['thumbnail_image'])){?> checked <?php }?> <?php if($TPL_V1== 1){?> checked <?php }?>  onclick="thumbnail_image_choice('thumbnail<?php echo $TPL_V1?>');"/>
                                <label for="thumbnail_image<?php echo $TPL_V1?>">대표이미지 사용</label>
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
<?php if($TPL_V1== 1){?><th scope="row" rowspan="<?php echo $TPL_VAR["board_info"]['file_count']?>">파일첨부</th><?php }?>
                            <td>
                                <input type="file" name="file<?php echo $TPL_V1?>" id="file" /><label for="file" class="dn">파일첨부</label>
                                <input type="hidden" name="file<?php echo $TPL_V1?>_oname" value="<?php echo $TPL_VAR["board_view"]['board_view']['board_file']['file'][($TPL_K1)]['oname']?>" />
                                <input type="hidden" name="file<?php echo $TPL_V1?>_fname" value="<?php echo $TPL_VAR["board_view"]['board_view']['board_file']['file'][($TPL_K1)]['fname']?>" />
                                <input type="hidden" name="file<?php echo $TPL_V1?>_type" value="diagnosis" />
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

                    <!--SEO 설정 (관리자만)-->
<?php if(defined('_IS_LOGIN')&&$TPL_VAR["member"]['level']>= 9){?>
                    <tr>
                        <th colspan="2" style="background:#f5f5f5; padding:10px; text-align:left;">
                            <strong>🔍 SEO 설정 (검색엔진 최적화)</strong>
                            <label style="margin-left:10px;">
                                <input type="checkbox" name="use_seo" id="use_seo" value="y" <?php if($TPL_VAR["board_view"]['board_view']['use_seo']=='y'){?>checked<?php }?>>
                                SEO 사용
                            </label>
                        </th>
                    </tr>
                    <tr class="seo-field" style="display:<?php if($TPL_VAR["board_view"]['board_view']['use_seo']=='y'){?>table-row<?php }else{?>none<?php }?>;">
                        <th scope="row">SEO 제목</th>
                        <td>
                            <input type="text" name="seo_title" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['seo_title']?>" placeholder="검색 결과에 표시될 제목 (미입력시 게시글 제목 사용)" style="width:100%;" />
                            <small style="color:#666;">권장: 50-60자 이내</small>
                        </td>
                    </tr>
                    <tr class="seo-field" style="display:<?php if($TPL_VAR["board_view"]['board_view']['use_seo']=='y'){?>table-row<?php }else{?>none<?php }?>;">
                        <th scope="row">SEO 설명</th>
                        <td>
                            <textarea name="seo_description" class="input" placeholder="검색 결과에 표시될 설명 (미입력시 본문 일부 사용)" style="width:100%; height:60px;"><?php echo $TPL_VAR["board_view"]['board_view']['seo_description']?></textarea>
                            <small style="color:#666;">권장: 150-160자 이내</small>
                        </td>
                    </tr>
                    <tr class="seo-field" style="display:<?php if($TPL_VAR["board_view"]['board_view']['use_seo']=='y'){?>table-row<?php }else{?>none<?php }?>;">
                        <th scope="row">SEO 키워드</th>
                        <td>
                            <input type="text" name="seo_keywords" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['seo_keywords']?>" placeholder="키워드1, 키워드2, 키워드3 (쉼표로 구분)" style="width:100%;" />
                            <small style="color:#666;">예: 몸캠피싱, 해킹, 보안</small>
                        </td>
                    </tr>
                    <tr class="seo-field" style="display:<?php if($TPL_VAR["board_view"]['board_view']['use_seo']=='y'){?>table-row<?php }else{?>none<?php }?>;">
                        <th scope="row">SEO 작성자</th>
                        <td>
                            <input type="text" name="seo_author" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['seo_author']?>" placeholder="작성자명 (미입력시 기본값 사용)" style="width:100%;" />
                        </td>
                    </tr>
                    <script>
                    $(function() {
                        $('#use_seo').change(function() {
                            if($(this).is(':checked')) {
                                $('.seo-field').show();
                            } else {
                                $('.seo-field').hide();
                            }
                        });
                    });
                    </script>
<?php }?>

                    <!--추가 필드-->
<?php if($TPL_VAR["board_info"]['extraFl']=='y'&&!empty($TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
                            <tr class="<?php if($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='file'){?>input_file <?php }?> ">
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
                                            <textarea name="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>" id="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>" style="height:320px" title="내용을 입력하세요.">
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
                                        <span class="file_name" id="<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>_filezone">
<?php if(!empty($TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1])){?>
                                                <a href="/fileRequest/download?file=<?php echo urlencode('/board/'.$TPL_VAR["board_view"]['board_view']['upload_path'].'/'.$TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1.'_fname'])?>&save=<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1.'_oname']?>" target="_blank" style="color:cornflowerblue;">
                                                    <?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']][$TPL_K1.'_oname']?>

                                                </a>
                                                <a href="javascript://" onclick="uploadForm.uploadRemove('<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>')" class="file_no">
                                                    <img src="/lib/images/btn_close.gif" alt="닫기">
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
<?php }?>
<?php }?>
                </tbody>
            </table>
        </div>
<?php if(!defined('_IS_LOGIN')){?>
        <!-- 개인정보 수집항목 동의 -->
        <div class="policy_cont">
            <label for="checkbox-nonMember"><input type="checkbox" name="nonMember" id="checkbox-nonMember" /><em>(필수)</em> <?php echo $TPL_VAR["terms"]['nonMember']['title']?></label>
            <div class="area_box">
                <textarea cols="30" rows="5" align="left" class="" title="개인정보 수집항목 동의"><?php echo $TPL_VAR["terms"]['nonMember']['text']?></textarea>								
            </div>
        </div><!-- .policy_cont -->
<?php }?>
<?php if($TPL_VAR["board_info"]['code']=='inquiry'){?>
        <div class="btn_wrap ta_center">
            <button onclick="Common_Board.board_write(this.form); return false;"><a href="javascript://" class="btn btn_point">문의</a></button>
        </div><!--btn_center-->
<?php }else{?>
        <div class="btn_wrap ta_center">
            <button onclick="Common_Board.board_write(this.form); return false;"><a href="javascript://" class="btn btn_point">확인</a></button>
            <a href="/board/board_list?code=<?php echo $TPL_VAR["board_info"]['code']?>" class="btn btn_basic">취소</a>
        </div><!--btn_center-->

<?php }?>

<?php }?>
    </fieldset>
</form>
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
<?php if($TPL_VAR["board_info"]['yn_mobile']=='y'){?>mobile : {required : true, phoneValid : true},<?php }?>
<?php if($TPL_VAR["board_info"]['yn_email']=='y'){?>email : {required : false, email : false},<?php }?>
<?php if($TPL_VAR["board_info"]['yn_video']=='y'){?>video_url : {required : true, regUrlType : true},<?php }?>
				name : {required : true},
<?php if($TPL_VAR["board_info"]['mode']!='modify'){?>
				password : {required : true, rangelength : [4, 20]},
<?php }?>
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!='index_'){?>//메인에서 에디터 적용금지
<?php if($TPL_VAR["board_info"]["yn_editor"]==="y"){?>
				content : {editorRequired : {depends : function(){return !getSmartEditor("contents")}}},
<?php }else{?>
				content: "required",
<?php }?>
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
<?php }?>
			}, messages : {
				title : {required : "제목을 입력해주세요."},
<?php if($TPL_VAR["board_info"]['yn_mobile']=='y'){?>mobile : {required : "전화번호를 입력해주세요.", phoneValid : "올바른 전화번호를 입력해주세요. ex)000-0000-0000)"},<?php }?>
<?php if($TPL_VAR["board_info"]['yn_email']=='y'){?>email : {required : "이메일을 입력해주세요.", email : "올바른 이메일을 입력해주세요."},<?php }?>
<?php if($TPL_VAR["board_info"]['yn_video']=='y'){?>video_url : {required : "동영상 주소를 입력해주세요.", regUrlType : "올바른 url을 입력해주세요."},<?php }?>
				name : {required : "이름을 입력해주세요."},
<?php if($TPL_VAR["board_info"]['mode']!='modify'){?>
				password : {required : "비밀번호를 입력해주세요.", rangelength: $.validator.format("비밀번호는 {0}~{1}자입니다.")},
<?php }?>
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!='index_'){?>//메인에서 에디터 적용금지
<?php if($TPL_VAR["board_info"]["yn_editor"]==="y"){?>
					content : {editorRequired : "내용을 입력해주세요."},
<?php }else{?>
					content: "내용을 입력해 주세요.",
<?php }?>
<?php }?>
				file : {},
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!='index_'){?>//메인에서 태그 가져오지 못하는 오류 수정
				nonMember : {required : "<?php echo $TPL_VAR["terms"]['nonMember']['title']?>를 체크해주세요."},
<?php }else{?>
				nonMember : {required : "비회원 개인정보 수집항목 동의를 체크해주세요."},
<?php }?>
				// 추가필드 messages Start
<?php if($TPL_VAR["board_info"]['extraFl']=='y'&&!empty($TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
					<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?> : {
						editorRequired : "<?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]?>는 필수 항목입니다."
					},
<?php }}?>
<?php }?>
				// 추가필드 messages End
<?php if($TPL_VAR["board_info"]["use_captcha"]=="y"){?>
<?php }?>
			}
		});

<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!='index_'){?>//메인에서 에디터 적용금지
<?php if($TPL_VAR["board_info"]["yn_editor"]==="y"){?>attachSmartEditor("contents", "board");<?php }?>
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
		/*
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
		*/
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
                alert("선택된 파일이 없습니다.");
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