<?php /* Template_ 2.2.8 2025/04/15 09:59:04 /gcsd33_arklink/www/data/skin/respon_default_en/outline/nav.html 000008944 */ 
$TPL_cfg_menu_1=empty($TPL_VAR["cfg_menu"])||!is_array($TPL_VAR["cfg_menu"])?0:count($TPL_VAR["cfg_menu"]);?>
<div id="header" class="">
	<div class="header_cont">
		<h1 class="hd_logo"><a href="/en" title="Logo"><?php echo $TPL_VAR["cfg_site"]["compName"]?></a></h1>
		<ul class="hd_lnb">
<?php if(isset($TPL_VAR["cfg_menu"])){?>
<?php if($TPL_cfg_menu_1){$TPL_I1=-1;foreach($TPL_VAR["cfg_menu"] as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_V1["use"]=='y'){?>
			<li class="<?php if(($TPL_I1+ 1)=='1'){?>infoLocation<?php }?>">
				<a href="<?php echo $TPL_V1["url"]?>" class=""><?php echo $TPL_V1["name"]?></a>
			</li>
<?php }?>
<?php }}?>
<?php }?>
		</ul>
		<div class="hd_right">
			<ul class="hd_lang">
				<li><a href="/">kor</a></li>
				<li><a href="/en">eng</a></li>
				<li><a href="/cn">chn</a></li>
				<li><a href="/jp">jpn</a></li>
			</ul>
			<ul class="hd_gnb">
<?php if(defined('_IS_LOGIN')){?>
				<li><a href="/en/member/logout">logout</a></li>
				<li><a href="/en/member/mypage">modify</a></li>
<?php }else{?>
				<li><a href="/en/member/login">login</a></li> 
				<li><a href="/en/member/join_agreement">join</a></li>
<?php }?>
			</ul>
			<a class="menu-trigger" href="#">
				<span></span>
				<span></span>
				<span></span>
			</a>
		</div>
	</div>
</div>
<div class="aside_bg dn"></div>
<aside id="aside">
	<div class="aside_box for_pc">
		<div class="btn_aside_close"><a class="menu-trigger2 active-1" href="#"><span></span><span></span><span></span></a></div>
		<h1 class="aside_logo"><a href="/en"><?php echo $TPL_VAR["cfg_site"]['title']?></a></h1>
<?php if(isset($TPL_VAR["cfg_menu"])){?>
		<ul class="aside_menu">
<?php if($TPL_cfg_menu_1){foreach($TPL_VAR["cfg_menu"] as $TPL_V1){?>
<?php if($TPL_V1["use"]=='y'){?>
			<li class="dep1_li"><a href="<?php echo $TPL_V1["url"]?>" class="dep1_a"><?php echo $TPL_V1["name"]?></a>
<?php if(isset($TPL_V1["menu"])){?>
				<ul class="dep2">
<?php if(is_array($TPL_R2=$TPL_V1["menu"])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
<?php if($TPL_V2["use"]=='y'){?>
					<li><a href="<?php echo $TPL_V2["url"]?>"><?php echo $TPL_V2["name"]?></a></li>
<?php }?>
<?php }}?>
				</ul>
<?php }?>
			</li>
<?php }?>
<?php }}?>
		</ul><!--slidemenu-->
<?php }?>
		<div class="aside_btm">
			<div class="aside_call"><?php echo $TPL_VAR["cfg_site"]["compPhone"]?></div>
		</div><!--/ gnb -->
	</div>
	<div class="aside_box for_m">
		<div class="btn_aside_close"><a class="menu-trigger2 active-1" href="#"><span></span><span></span><span></span></a></div>
		<h1 class="aside_logo"><a href="/en"><?php echo $TPL_VAR["cfg_site"]['title']?></a></h1>
		<ul class="aside_gnb">
<?php if(defined('_IS_LOGIN')){?>
			<li class=""><a href="/en/member/logout" class="">LOGOUT</a></li>
<?php }else{?>
			<li><a href="/en/member/login">LOGIN</a></li>
			<li><a href="/en/member/join_agreement">JOIN</a></li>
<?php }?>
			<li class=""><a href="/en/member/mypage" class="">MODIFY</a></li>
		</ul><!--/ gnb -->
<?php if($TPL_VAR["multilingual"]){?>
		<ul class="aside_lang">
<?php if(is_array($TPL_R1=$TPL_VAR["cfg_site"]['languagelink'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
			<li><a href="/?language=<?php echo $TPL_K1?>"><?php echo $TPL_K1?></a></li>
<?php }}?>
		</ul>
<?php }?>
		<div class="aside_search">
			<form name="" action="/goods/goods_search">
				<fieldset>
				<legend>카테고리 상품 검색</legend>
				<label for="search" class="dn">검색어 입력박스</label>
				<input id="search" type="text" name="search" placeholder="" class="search_input">
				<button type="submit" class="search_enter"></button>
				</fieldset>
			</form>
		</div><!--/ aside_search -->
		<div class="aside_tab_wrap">
			<ul class="aside_tab">
				<li class="on"><span>category</span></li>
				<li><span>product</span></li>
			</ul>
			<div class="aside_tab0">
<?php if(isset($TPL_VAR["cfg_menu"])){?>
				<ul class="slide menu slidemenu">
<?php if($TPL_cfg_menu_1){foreach($TPL_VAR["cfg_menu"] as $TPL_V1){?>
<?php if($TPL_V1["use"]=='y'){?>
<?php if(isset($TPL_V1["menu"])){?>
						<li class="group_tit dep1_li"><a href="<?php echo $TPL_V1["url"]?>" class="dep1_a"><?php echo $TPL_V1["name"]?></a>
						<ul class="depth2 depth">
							<li><a href="<?php echo $TPL_V1["url"]?>">전체보기</a></li>
<?php if(is_array($TPL_R2=$TPL_V1["menu"])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
<?php if($TPL_V2["use"]=='y'){?>
<?php if(isset($TPL_V2["menu"])){?>
								<li class="group_tit"><a href="<?php echo $TPL_V2["url"]?>"><?php echo $TPL_V2["name"]?></a>
								<ul class="depth3 depth">
										<li><a href="<?php echo $TPL_V2["url"]?>">전체보기</a></li>
<?php if(is_array($TPL_R3=$TPL_V2["menu"])&&!empty($TPL_R3)){foreach($TPL_R3 as $TPL_V3){?>
<?php if($TPL_V3["use"]=='y'){?>
<?php if(isset($TPL_V3["menu"])){?>
										<li class="group_tit"><a href="<?php echo $TPL_V3["url"]?>"><?php echo $TPL_V3["name"]?></a>
										<ul class="depth4 depth">
												<li><a href="<?php echo $TPL_V3["url"]?>">전체보기</a></li>
<?php if(is_array($TPL_R4=$TPL_V3["menu"])&&!empty($TPL_R4)){foreach($TPL_R4 as $TPL_V4){?>
<?php if($TPL_V4["use"]=='y'){?>
												<li><a href="<?php echo $TPL_V4["url"]?>"><?php echo $TPL_V4["name"]?></a></li>
<?php }?>
<?php }}?>
										</ul>
<?php }?>
										</li>
<?php }?>
<?php }}?>
								</ul>
<?php }else{?>
								<li class=""><a href="<?php echo $TPL_V2["url"]?>"><?php echo $TPL_V2["name"]?></a><!-- 하위메뉴 없을 때 -->
<?php }?>
								</li>
<?php }?>
<?php }}?>
						</ul>
<?php }else{?>
						<li class="dep1_li"><a href="<?php echo $TPL_V1["url"]?>" class="dep1_a"><?php echo $TPL_V1["name"]?></a><!-- 하위메뉴 없을 때 -->
<?php }?>
						</li>
<?php }?>
<?php }}?>
				</ul>
<?php }?>
			</div>
			<div class="aside_tab1">
				<ul class="slide menu slidemenu">
<?php if(isset($TPL_VAR["categories"]['top_category_list'])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["categories"]['top_category_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
					<li class="group_tit dep1_li">
						<a href="/goods/goods_list?cate=<?php echo $TPL_V1["category"]?>&display_type=<?php echo $TPL_VAR["display_type"]?>" class="dep1_a">
<?php if($TPL_V1["multi_category"]){?>
						<?php echo $TPL_V1["multi_category"]?>

<?php }else{?>
						<?php echo $TPL_V1["categorynm"]?>

<?php }?>
						</a>
					</li>
<?php }}?>
<?php }?>
				</ul>
			</div>
		</div>
	</div>
</aside><!-- #aside 상단영역 -->

<script>
$(document).ready(function(){

	var itval;

	// aside close 
		function aside_close() {
			$('#aside').removeClass('on');
			$('.aside_bg').removeClass('on');
			clearTimeout(itval);
			itval = setTimeout(function () {
				$('.aside_bg').addClass('dn');
				$('body').css({'overflow':'inherit','height':'auto'});
			}, 800);
		}
	
	// aside open
		function aside_open() {
			$('#aside').addClass('on');
			$('.aside_bg').removeClass('dn');
			clearTimeout(itval);
			$('body').css({'overflow':'hidden','height':'100%'});
			itval = setTimeout(function () {
				$('.aside_bg').addClass('on');
			}, 20);
		}
	
	// aside on/off 
		$('.menu-trigger, .btn_aside_close').each(function(index){
			$(this).on('click', function(e){
				e.preventDefault();
				$('.menu-trigger').toggleClass('active-1');
				if ($('#aside').hasClass('on')) {
					aside_close();
				} else {
					aside_open();
				}
			});
			$('.aside_bg').click(function(){
				$('.menu-trigger').removeClass('active-1');
				aside_close();
			});
		});
		
	// aside category on/off
		$("li.group_tit a").on("click", function(e) {
			//e.preventDefault();
			$(this).parent().siblings().children().next().slideUp(function() {
				$(this).siblings("a").removeClass("on");
			});
			$(this).addClass("on");
			$(this).siblings("ul").slideToggle(function() {
				if($(this).is(":visible") == false) $(this).siblings("a").removeClass("on");
			});
			
			if($(this).parent().closest('li').find('ul').children().length == 0) {
				return true;	
			} else {
				return false;
			}	
		});

	// aside tab 
		var tabmenu_idx = 0;
		$('.aside_tab_wrap .aside_tab li').on({
			'click':function(){
				var idx = $(this).index();
				if(tabmenu_idx == idx) return; 
				tabmenu_idx = idx;
				$('.aside_tab_wrap .aside_tab li').removeClass('on');
				$(this).addClass('on');
				$('.aside_tab_wrap .aside_tab0, .aside_tab1').hide();
				$('.aside_tab_wrap .aside_tab'+idx).fadeIn('fast', function(){
				});
				
				
			}
		});


	// container top padding 
		var hd_h = $('#wrap #header').outerHeight();
		$('#wrap #container').css({'padding-top':hd_h});
	
	// header animate 
		$('#wrap #header').addClass('hd_move');

	$(window).resize(function() {
		// 컨텐츠 상단 padding 
			var hd_h = $('#wrap #header').outerHeight();
			$('#wrap #container').css({'padding-top':hd_h});
	});


});
</script>