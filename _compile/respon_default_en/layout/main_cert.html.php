<?php /* Template_ 2.2.8 2025/06/25 08:59:34 /gcsd33_arklink/www/data/skin/respon_default_en/layout/main_cert.html 000003561 */ ?>
<?php if($TPL_VAR["cert_info"]['mainview']=='y'){?>
<!-- <div class="img_box" data-aos="fade-up">
	<ul>
		<li class="on" id="award01">
			<div class="img"><img src="/data/skin/respon_default_en/layout/images/skin/main_award01.png" alt="main_award01"></div>
			<p>디지털 이노베이션 IT/보안 부문 대상</p>
		</li>
		<li id="award02">
			<div class="img"><img src="/data/skin/respon_default_en/layout/images/skin/main_award02.png" alt="main_award02"></div>
			<p>한국을 이끄는 혁신 리더 경영혁신 부문</p>
		</li>
		<li id="award03">
			<div class="img"><img src="/data/skin/respon_default_en/layout/images/skin/main_award03.png" alt="main_award03"></div>
			<p>KBS N 브랜드 어워즈 디지털 보안 및 몸캠피싱 해결 부문</p>
		</li>
		<li id="award04">
			<div class="img"><img src="/data/skin/respon_default_en/layout/images/skin/main_award04.png" alt="main_award04"></div>
			<p>2025 혁신리더대상 국회의원 표창장 수상</p>
		</li>
	</ul>
</div>		
<ul class="list ver_pc" data-aos="fade-up">
	<li class="on" data-tab="award01"><span>디지털 이노베이션 IT/보안 부문 대상</span></li>
	<li data-tab="award02"><span>한국을 이끄는 혁신 리더 경영혁신 부문</span></li>
	<li data-tab="award03"><span>KBS N 브랜드 어워즈 디지털 보안 및 몸캠피싱 해결 부문</span></li>
	<li data-tab="award04"><span>2025 혁신리더대상 국회의원 표창장 수상</span></li>
</ul>
<div class="list_container ver_m swiper-container" data-aos="fade-up">
	<ul class="list swiper-wrapper">
		<li class="on" data-tab="award01"><span>디지털 이노베이션 IT/보안 부문 대상</span></li>
		<li data-tab="award02"><span>한국을 이끄는 혁신 리더 경영혁신 부문</span></li>
		<li data-tab="award03"><span>KBS N 브랜드 어워즈 디지털 보안 및 몸캠피싱 해결 부문</span></li>
		<li data-tab="award04"><span>2025 혁신리더대상 국회의원 표창장 수상</span></li>
	</ul>	
</div> -->
<ul class="swiper-wrapper">
<?php if(isset($TPL_VAR["cert_list"]['board_list'])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["cert_list"]['board_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
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