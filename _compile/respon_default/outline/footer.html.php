<?php /* Template_ 2.2.8 2025/11/20 13:15:16 /gcsd33_arklink/www/data/skin/respon_default/outline/footer.html 000006355 */ ?>
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!="index_"){?>
        </div><!-- #contents_wrap -->
    </article><!-- #container -->
<?php }?>

<?php if($TPL_VAR["footer_hidden"]!='y'){?>
	<footer id="footer">
		<div class="ft_info_box main_w_custom">
			<div class="info_box">
				<div class="ft_logo"><img src="/data/skin/respon_default/images/skin/ft_logo.svg" alt="ft_logo"></div>
				<ul class="ft_menu">
					<li><a href="https://arklink.co.kr/board/board_list?code=qna">자주 묻는 질문</a></li>
					<li><a href="https://arklink.co.kr/board/board_view?code=campaign&no=3&search_type=&search=">피해 지원 캠페인</a></li>
					<li><a href="https://arklink.co.kr/board/board_list?code=inquiry">실시간 해결 문의</a></li>
					<li><a href="../service/usepolicy"><strong>개인정보처리방침</strong></a></li>
				</ul>
				<div class="info">
					<span><strong><?php echo $TPL_VAR["cfg_site"]["compName"]?></strong></span>
					<span>대표 : <?php echo $TPL_VAR["cfg_site"]["ceoName"]?></span>
					<span>TEL : <a href="callto:<?php echo $TPL_VAR["cfg_site"]["compPhone"]?>" onclick="naver_call_tracking();"><?php echo $TPL_VAR["cfg_site"]["compPhone"]?></a></span>
					<span>주소 : <?php echo $TPL_VAR["cfg_site"]["address"]?></span>
					<br>
					<span>사업자등록번호 : <?php echo $TPL_VAR["cfg_site"]["compSerial"]?> <a href="https://bizno.net/article/3788803382'" target="_blank">[사업자정보확인]</a></span>
					<span>개인정보관리 책임자 : <?php echo $TPL_VAR["cfg_site"]["adminName"]?></span>
					<span>E-MAIL : <a href="mailto:contact@arklink.co.kr">contact@arklink.co.kr</a></span>
				</div>
				<p class="copyright">Copyright &copy; 2025 <?php echo $TPL_VAR["cfg_site"]["nameEng"]?>. ALL RIGHTS RESERVED. <a href="//www.designart.co.kr/new/index.php" target="_blank">designed by DESIGNART</a></p>
			</div>
					<ul class="ft_sns">
			<li><a href="https://blog.naver.com/arklink-official" target="_blank"><img src="/data/skin/respon_default/images/skin/ft_sns01.svg" alt="네이버"></a></li>
			<li><a href="https://www.instagram.com/arklink_official" target="_blank"><img src="/data/skin/respon_default/images/skin/ft_sns02.png" alt="인스타그램"></a></li>
			<li><a href="https://blog.arklink.co.kr/" target="_blank"><img src="/data/skin/respon_default/images/skin/ft_sns03.png" alt="인블로그"></a></li>
			<li><a href="https://www.youtube.com/@arklink_official" target="_blank"><img src="/data/skin/respon_default/images/skin/ft_sns04.svg" alt="유튜브"></a></li>
		</ul>
		</div>
	</footer><!-- #footer 하단영역 -->
<?php }?>
</article><!-- #wrap 전체영역 -->

<div class="loader_box">
	<div class="loader"></div>	
</div>
<ul class="main_quick">
	<li><a href="tel:<?php echo $TPL_VAR["cfg_site"]["compPhone"]?>" class="scr_cs" onclick="naver_call_tracking(); gtag_report_conversion_call(); if(!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) { return false; } return true;"><span>전화하기</span></a></li>
	<li>
		<a href="#" class="scr_top ver_pc" onclick="<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]=='index_'){?>fullpage_api.moveTo(1) <?php }else{?>$('html, body').stop().animate( { scrollTop : '0' }, 800 ); return false;<?php }?>" title="상단 이동"><img src="/data/skin/respon_default/images/skin/ft_top.svg" alt="top"></a>
		<a href="#" class="scr_top ver_m" onclick="$('html, body').stop().animate( { scrollTop : '0' }, 800 ); return false;" title="상단 이동"><img src="/data/skin/respon_default/images/skin/ft_top.svg" alt="top"></a>
	</li>
</ul>
<iframe name="ifr_processor" id="ifr_processor" title="&nbsp;" width="0" height="0" frameborder="0" style="display:none;"></iframe>

<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView();
  kakaoPixel('5590299396849158438').purchase('messageOn');
</script>

<script>  // 채널톡 설치 스크립트
  (function(){var w=window;if(w.ChannelIO){return w.console.error("ChannelIO script included twice.");}var ch=function(){ch.c(arguments);};ch.q=[];ch.c=function(args){ch.q.push(args);};w.ChannelIO=ch;function l(){if(w.ChannelIOInitialized){return;}w.ChannelIOInitialized=true;var s=document.createElement("script");s.type="text/javascript";s.async=true;s.src="https://cdn.channel.io/plugin/ch-plugin-web.js";var x=document.getElementsByTagName("script")[0];if(x.parentNode){x.parentNode.insertBefore(s,x);}}if(document.readyState==="complete"){l();}else{w.addEventListener("DOMContentLoaded",l);w.addEventListener("load",l);}})();

  // 채널톡 부트(초기화)
  ChannelIO('boot', {
    "pluginKey": "ce371656-7ab2-430a-ba86-68515eb25aa9"
  });

  // 채널톡 전환 추적 설정
  var conversionTracked = false;
  
  // Naver Analytics 전환 추적 함수
  function naver_conversion_tracking() {
    if(window.wcs) {
      if(!wcs_add) var wcs_add = {};
      wcs_add['wa'] = 's_503125a9c9a9';
      var _conv = {};
      _conv.type = 'lead';
      wcs.trans(_conv);
    }
  }
  
  // Naver Analytics 전화 전환 추적 함수
  function naver_call_tracking() {
    if(window.wcs) {
      if(!wcs_add) var wcs_add = {};
      wcs_add['wa'] = 's_503125a9c9a9';
      var _conv = {};
      _conv.type = 'call';
      wcs.trans(_conv);
    }
  }
  
  // 카카오 픽셀 전환 추적 함수
  function kakao_conversion_tracking() {
    if(window.kakaoPixel) {
      kakaoPixel('5590299396849158438').purchase('messageOn');
    }
  }
  
  ChannelIO('onSendMessage', function(data) {
    if (!conversionTracked) {
      gtag_report_conversion_chat(); // Google Ads 전환
      naver_conversion_tracking(); // Naver Analytics 전환
      kakao_conversion_tracking(); // 카카오 픽셀 전환
      conversionTracked = true;
    }
  });
  
  ChannelIO('onCreateChat', function(data) {
    if (!conversionTracked) {
      gtag_report_conversion_chat(); // Google Ads 전환
      naver_conversion_tracking(); // Naver Analytics 전환
      kakao_conversion_tracking(); // 카카오 픽셀 전환
      conversionTracked = true;
    }
  });
</script>
</body>
</html>