<?php /* Template_ 2.2.8 2025/06/13 20:36:14 /gcsd33_arklink/www/data/skin/respon_default_en/outline/footer.html 000003336 */ ?>
<!-- ** layout정리190513  ** -->
					<!-- #서브 컨텐츠 끝 -->

				</div><!-- #contents -->
				<!-- 컨텐츠 끝 #contents -->

			</div><!-- #contents_box -->

		</div><!-- .contents_wrap -->
	</div><!-- .warpper -->
<!-- ** layout정리190513  ** -->

<?php if($TPL_VAR["footer_hidden"]!='y'){?>
	<footer id="footer">
		<div class="ft_inner">
			<ul class="footer_nav">
				<li class="first"><a href="/company/about">about</a></li>
				<li><a href="/service/agreement">agreement</a></li>
				<li><a href="/service/usepolicy">usepolicy</a></li>
				<li><a href="/company/location">location</a></li>
			</ul><!--footer_nav-->
			<div class="logo">
				<h2><?php echo $TPL_VAR["cfg_site"]["compName"]?></h2>
				<p class="copyright">Copyright, <?php echo $TPL_VAR["cfg_site"]["nameEng"]?> All Rights Reserved.</p>
			</div>
			<div class="info">
				<p>CEO : <?php echo $TPL_VAR["cfg_site"]["ceoName"]?> / Business License : <?php echo $TPL_VAR["cfg_site"]["retailBusiness"]?> </p>
				<p>Address : <?php echo $TPL_VAR["cfg_site"]["address"]?></p>
				<p>Email : <?php echo $TPL_VAR["cfg_site"]["adminEmail"]?> / TEL : <?php echo $TPL_VAR["cfg_site"]["compFax"]?> / FAX : <?php echo $TPL_VAR["cfg_site"]["compFax"]?></p>
			</div>
		</div><!--/ ft_inner -->
	</footer><!-- #footer 하단영역 -->
<?php }?>
	<div id="popup_contents">
<?php $this->print_("popup_open",$TPL_SCP,1);?>

	</div>
</article><!-- #wrap 전체영역 -->
<script>
$(document).ready(function(){
		//애니메이션
				AOS.init({
						offset: 0,
						debounceDelay: 50,
						throttleDelay: 99,
						easing: 'ease-in-quart',
				});
				onElementHeightChange(document.body, function(){
						AOS.refresh();
				});
				function onElementHeightChange(elm, callback) {
						var lastHeight = elm.clientHeight
						var newHeight;

						(function run() {
								newHeight = elm.clientHeight;      
								if (lastHeight !== newHeight) callback();
								lastHeight = newHeight;
								if (elm.onElementHeightChangeTimer) {
										clearTimeout(elm.onElementHeightChangeTimer); 
								}
								elm.onElementHeightChangeTimer = setTimeout(run, 200);
						})();
				}
});
$(window).on('load', function () {
		//애니메이션
				AOS.refresh(true);
});
</script>
<iframe name="ifr_processor" id="ifr_processor" title="&nbsp;" width="0" height="0" frameborder="0" style="display:none;"></iframe>

<script>  // 채널톡 설치 스크립트
  (function(){var w=window;if(w.ChannelIO){return w.console.error("ChannelIO script included twice.");}var ch=function(){ch.c(arguments);};ch.q=[];ch.c=function(args){ch.q.push(args);};w.ChannelIO=ch;function l(){if(w.ChannelIOInitialized){return;}w.ChannelIOInitialized=true;var s=document.createElement("script");s.type="text/javascript";s.async=true;s.src="https://cdn.channel.io/plugin/ch-plugin-web.js";var x=document.getElementsByTagName("script")[0];if(x.parentNode){x.parentNode.insertBefore(s,x);}}if(document.readyState==="complete"){l();}else{w.addEventListener("DOMContentLoaded",l);w.addEventListener("load",l);}})();

  // 채널톡 부트(초기화)
  ChannelIO('boot', {
    "pluginKey": "ce371656-7ab2-430a-ba86-68515eb25aa9"
  });
</script>

</body>
</html>