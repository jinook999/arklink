<?php /* Template_ 2.2.8 2025/10/16 16:41:40 /gcsd33_arklink/www/data/skin/respon_default/board/board_list.html 000007608 */ 
$TPL_preface_1=empty($TPL_VAR["preface"])||!is_array($TPL_VAR["preface"])?0:count($TPL_VAR["preface"]);?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php if($TPL_VAR["board_info"]['code']=='content'&&$TPL_VAR["CI"]->input->get('category')=='리포트'){?>
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('report');
</script>
<?php }?>
<?php if($TPL_VAR["board_info"]['code']=='content'&&$TPL_VAR["CI"]->input->get('category')=='소식'){?>
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('news');
</script>
<?php }?>
<?php if($TPL_VAR["board_info"]['code']=='content'&&$TPL_VAR["CI"]->input->get('category')=='인터뷰'){?>
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('interview');
</script>
<?php }?>
<?php if($TPL_VAR["board_info"]['code']=='content'&&$TPL_VAR["CI"]->input->get('category')=='칼럼'){?>
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('column');
</script>
<?php }?>
<?php if($TPL_VAR["board_info"]['code']=='content'&&$TPL_VAR["CI"]->input->get('category')=='캠페인'){?>
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('campaign');
</script>
<?php }?>
<?php if($TPL_VAR["board_info"]['code']=='content'&&!$TPL_VAR["CI"]->input->get('category')){?>
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('Contents');
</script>
<?php }?>
<?php if($TPL_VAR["board_info"]['code']=='patent'){?>
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('수상');
</script>
<?php }?>
<?php if($TPL_VAR["board_info"]['code']=='inquiry'){?>
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('실시간문의');
</script>
<?php }?>
<?php if($TPL_VAR["board_info"]['code']=='cert'){?>
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('인증');
</script>
<?php }?>
<?php if($TPL_VAR["board_info"]['code']=='qna'){?>
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('QnA');
</script>
<?php }?>
<?php if($TPL_VAR["board_info"]['code']=='campaign'){?>
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('피해지원캠페인');
</script>
<?php }?>
<?php if($TPL_VAR["board_info"]['code']=='review'){?>
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('해결후기');
</script>
<?php }?>

<script type="text/javascript">
	$(function() {
		$("form[name='frm']").validate({
			rules : {
				search : {required : true}
			}, messages : {
				search : {required : "검색어를 입력해주세요."}
			}
		});
	});
</script>



<div class="sub_cont">
<?php if($TPL_VAR["board_info"]['code']=='content'){?>
<?php if(count($TPL_VAR["preface"])> 0){?>
	<ul class="sub_nav">
		<li><a href="/board/board_list?code=content">전체</a></li>
<?php if($TPL_preface_1){foreach($TPL_VAR["preface"] as $TPL_V1){?>
		<li <?php echo set_select('category',$TPL_V1)?>><a href="/board/board_list?code=<?php echo $TPL_VAR["board_info"]['code']?>&category=<?php echo $TPL_V1?>"><?php echo $TPL_V1?></a></li>
<?php }}?>
	</ul>
<?php }?>
<?php }?>
	<div class="sub_board <?php if($TPL_VAR["board_info"]['code']=='patent'){?>sub_patent<?php }?>">
<?php if($TPL_VAR["board_info"]['code']!='patent'&&$TPL_VAR["board_info"]['code']!='cert'){?>
		<div class="search_wrap">
			<?php echo form_open('',$TPL_VAR["form_attribute"])?>

            <fieldset>
                <legend>게시글 검색</legend>
                <input type="hidden" name="code" value="<?php echo $TPL_VAR["board_info"]['code']?>" />
<?php if($TPL_VAR["board_info"]['code']!='content'){?>
<?php if(count($TPL_VAR["preface"])> 0){?>
                <ul class="preface_list">
                    <li><a href="/board/board_list?code=<?php echo $TPL_VAR["board_info"]['code']?>">전체</a></li>
<?php if($TPL_preface_1){foreach($TPL_VAR["preface"] as $TPL_V1){?>
                    <li <?php echo set_select('category',$TPL_V1)?>><a href="/board/board_list?code=<?php echo $TPL_VAR["board_info"]['code']?>&category=<?php echo $TPL_V1?>"><?php echo $TPL_V1?></a></li>
<?php }}?>
                </ul>
<?php }?>
<?php }?>
                <div class="cont">
                    <select name="search_type" id="search_type" title="검색할 항목을 선택하세요." class="select">
                        <option value="title" selected="selected">제목</option>
                        <option value="content" <?php echo set_select('search_type','content')?>>내용</option>
                        <option value="name" <?php echo set_select('search_type','name')?>>작성자</option>
                        <option value="userid" <?php echo set_select('search_type','userid')?>>아이디</option>
                    </select>
                    <div class="inp_box">
                        <label for="search" class="dn">검색어를 입력하세요.</label>
                        <input type="text" name="search" id="search" value="<?php echo set_value('search')?>" class="input_text" placeholder="검색어를 입력해주세요."/>
                        <input type="submit" value="검색" />
                    </div>
                </div>
            </fieldset>
			<?php echo form_close()?>

		</div>
<?php }?>
<?php $this->print_("board_display",$TPL_SCP,1);?>

		<div class="view_btn clear">
			<?php echo $TPL_VAR["board_list"]['pagination']?>

<?php if($TPL_VAR["board_info"]['is_write']){?>
			<div class="btn_wrap ta_right"><a href="/board/board_write?code=<?php echo $TPL_VAR["board_info"]['code']?>" class="btn"><?php if($TPL_VAR["board_info"]['code']=='review'){?>작성하기<?php }else{?>문의하기<?php }?></a></div>
<?php }?>
		</div>
	</div><!-- .sub_board -->
</div><!-- .sub_content -->
<?php $this->print_("footer",$TPL_SCP,1);?>