<?php /* Template_ 2.2.8 2025/11/07 14:02:33 /gcsd33_arklink/www/data/skin/respon_default/outline/header.html 000013029 */ ?>
<!DOCTYPE html>
<html lang="ko">

<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-WQ2Z2JV2');</script>
	<!-- End Google Tag Manager -->

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-VRD9KW4STQ"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());

		gtag('config', 'G-VRD9KW4STQ');
		gtag('config', 'AW-16708640716');
	</script>

	<!-- Google Ads 전환 측정 스크립트 -->
	<script>
		// 전화걸기 전환 측정 (아크링크 전화 버튼 클릭)
		function gtag_report_conversion_call(url) {
			var callback = function () {
				if (typeof (url) != 'undefined') {
					window.location = url;
				}
			};
			gtag('event', 'conversion', {
				'send_to': 'AW-16708640716/_3zACOSkhK4bEMy_pp8-',
				'value': 1.0,
				'currency': 'KRW',
				'event_callback': callback
			});
			return false;
		}

		// 채널톡 문의 전환 측정
		function gtag_report_conversion_chat(url) {
			var callback = function () {
				if (typeof (url) != 'undefined') {
					window.location = url;
				}
			};
			gtag('event', 'conversion', {
				'send_to': 'AW-16708640716/xSj2CJ3k7twaEMy_pp8-',
				'value': 1.0,
				'currency': 'KRW',
				'event_callback': callback
			});
			return false;
		}

		// 기존 호환성을 위한 함수 (전화걸기로 기본 설정)
		function gtag_report_conversion(url) {
			return gtag_report_conversion_call(url);
		}
	</script>

	<!-- Naver Analytics Script -->
	<script type="text/javascript" src="//wcs.naver.net/wcslog.js"> </script>
	<script type="text/javascript">
		if (!wcs_add) var wcs_add = {};
		wcs_add["wa"] = "s_503125a9c9a9";
		if (!_nasa) var _nasa = {};
		if (window.wcs) {
			wcs.inflow();
			wcs_do();
		}
	</script>

	<title><?php if($TPL_VAR["seo"]['title']){?><?php echo $TPL_VAR["seo"]['title']?><?php }else{?><?php echo $TPL_VAR["cfg_site"]['title']?><?php }?></title>
	<link rel="icon" type="image/x-icon" href="/favicon.ico" />
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon.png" />
	<link rel="icon" type="image/png" sizes="192x192" href="/favicon.png" />
	<link rel="apple-touch-icon" sizes="180x180" href="/favicon.png" />

	<!-- RSS Feed -->
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]=='board'&&$TPL_VAR["CI"]->input->get('code')){?>
	<link rel="alternate" type="application/rss+xml" title="RSS Feed" href="/rss?code=<?php echo $TPL_VAR["CI"]->input->get('code')?>" />
<?php }?>

	<!-- Canonical URL -->
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]=='board'&&$TPL_VAR["CI"]->uri->rsegments[ 2]=='board_view'){?>
	<link rel="canonical"
		href="https://www.arklink.co.kr/board/board_view?code=<?php echo $TPL_VAR["CI"]->input->get('code')?>&no=<?php echo $TPL_VAR["CI"]->input->get('no')?>" />
<?php }elseif($TPL_VAR["CI"]->uri->rsegments[ 1]=='board'&&$TPL_VAR["CI"]->uri->rsegments[ 2]=='board_list'){?>
	<link rel="canonical" href="https://www.arklink.co.kr/board/board_list?code=<?php echo $TPL_VAR["CI"]->input->get('code')?>" />
<?php }else{?>
	<link rel="canonical" href="https://www.arklink.co.kr<?php echo $TPL_VAR["CI"]->uri->uri_string?>" />
<?php }?>

	<meta charset="UTF-8">
	<meta name="title" content="<?php echo $TPL_VAR["seo"]['title']?>" />
	<meta name="keywords" content="<?php echo $TPL_VAR["seo"]['keywords']?>">
	<meta name="description" content="<?php echo $TPL_VAR["seo"]['description']?>">
	<meta name="author" content="<?php echo $TPL_VAR["seo"]['author']?>">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<meta name="format-detection" content="telephone=no" /><!--애플전화번호링크자동설정해제-->
	<meta property="og:title" content="<?php echo $TPL_VAR["seo"]['og_title']?>" />
	<meta property="og:description" content="<?php echo $TPL_VAR["seo"]['description']?>" />
	<meta property="og:image" content="<?php if($TPL_VAR["seo"]['og_image']){?><?php echo $TPL_VAR["seo"]['og_image']?><?php }?>" />
	<meta property="twitter:title" content="<?php echo $TPL_VAR["seo"]['og_title']?>" />
	<meta property="twitter:description" content="<?php echo $TPL_VAR["seo"]['description']?>" />
	<meta property="twitter:image" content="<?php if($TPL_VAR["seo"]['og_image']){?><?php echo $TPL_VAR["seo"]['og_image']?><?php }?>" />

	<link rel="stylesheet" type="text/css" href="/lib/css/common.css" />
	<link rel="stylesheet" type="text/css" href="/data/skin/respon_default/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="/data/skin/respon_default/css/aos.css" />
	<link rel="stylesheet" type="text/css" href="/data/skin/respon_default/css/animate.min.css" />
	<link rel="stylesheet" type="text/css" href="/data/skin/respon_default/css/common.css" /><!-- 서브 공통 css ｜ custom 금지 css -->
	<link rel="stylesheet" type="text/css" href="/data/skin/respon_default/css/sub.css" /><!-- 서브 공통 custom 요소 css ｜ 개별페이지 css -->
	<link rel="stylesheet" type="text/css" href="/data/skin/respon_default/css/sub_b.css" />
	<link rel="stylesheet" type="text/css" href="/data/skin/respon_default/css/skin.css" /><!-- 스킨 css ｜ 상하단·메인 -->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- <script src="/lib/js/jquery-2.2.4.min.js"></script> -->
	<script src="/lib/js/jquery.validate.min.js"></script>
	<script src="/lib/js/common.js"></script>
	<!-- <script src="/lib/js/jquery-ui.min.js"></script> -->
	<script src="/lib/js/moment-with-locales.min.js"></script>
	<script
		src="<?php if(defined('_IS_SSL')){?>//ssl.daumcdn.net/dmaps<?php }else{?>//dmaps.daum.net<?php }?>/map_js_init/postcode.v2.js"></script>
	<link rel="stylesheet" type="text/css" href="/data/skin/respon_default/css/slick.css">

	<script src="<?php echo $TPL_VAR["js"]?>/js/slick.js"></script>
	<!--#script src="../js/ui_common.js"></script-->
	<script src="<?php echo $TPL_VAR["js"]?>/js/aos.js"></script>

	<!-- swiper -->
	<link rel="stylesheet" type="text/css" href="/data/skin/respon_default/css/swiper-bundle.min.css" />

	<script src="<?php echo $TPL_VAR["js"]?>/js/swiper-bundle.min.js"></script>
	<!-- swiper -->

	<script src="<?php echo $TPL_VAR["js"]?>/js/header.js"></script>
	<script src="<?php echo $TPL_VAR["js"]?>/js/footer.js"></script>

<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]=="index_"){?>
	<script src="<?php echo $TPL_VAR["js"]?>/js/main.js"></script>
	<script src="<?php echo $TPL_VAR["js"]?>/js/js.cookie.min.js"></script>
	<script src="<?php echo $TPL_VAR["js"]?>/js/jquery.waypoints.min.js"></script>
	<script src="<?php echo $TPL_VAR["js"]?>/js/jquery.counterup.min.js"></script>
<?php }?>

<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!="index_"){?>
	<script src="<?php echo $TPL_VAR["js"]?>/js/custom.js"></script>
	<script src="<?php echo $TPL_VAR["js"]?>/js/sub.js"></script>
<?php }?>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/static/pretendard.css">
	<script src="<?php echo $TPL_VAR["js"]?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript">
		var CURRENT_DATE = "<?php echo CURRENT_DATE?>";
		$(function () {
			$.validator.setDefaults({
				onkeyup: false,
				onclick: false,
				onfocusout: false,
				ignore: '.ignore',
				showErrors: function (errorMap, errorList) {
					if (errorList.length < 1) {
						return;
					}
					alert(errorList[0].message);
					errorList[0].element.focus();
				}
			});

			//데이터 피커
			$(".startdate").datepicker({
				changeMonth: true,
				changeYear: true,
				showButtonPanel: true,
				showMonthAfterYear: true,
				dateFormat: "yy-mm-dd",
				monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
				monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
				dayNames: ['일', '월', '화', '수', '목', '금', '토'],
				dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
				dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
				onClose: function (selectedDate) {
					$(".enddate").datepicker('option', 'minDate', selectedDate);
				}
			});

			$(".enddate").datepicker({
				changeMonth: true,
				changeYear: true,
				showButtonPanel: true,
				showMonthAfterYear: true,
				dateFormat: "yy-mm-dd",
				monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
				monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
				dayNames: ['일', '월', '화', '수', '목', '금', '토'],
				dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
				dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
				onClose: function (selectedDate) {
					$(".startdate").datepicker("option", "maxDate", selectedDate);
				}
			});

			$(".datepicker").datepicker({
				changeMonth: true,
				changeYear: true,
				showButtonPanel: true,
				showMonthAfterYear: true,
				dateFormat: "yy-mm-dd",
				monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
				monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
				dayNames: ['일', '월', '화', '수', '목', '금', '토'],
				dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
				dayNamesMin: ['일', '월', '화', '수', '목', '금', '토']
			});
		});
	</script>
	<link rel="stylesheet" type="text/css" href="/data/skin/respon_default/css/cssreset-context-min.css"><!-- 에디터 css -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ko.js"></script>
	<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
	<!-- BORAWARE LOG SCRIPT. -->
	<script type="text/javascript">
		var protect_id = 'h501';
	</script>
	<script async type="text/javascript" src="//script.boraware.kr/protect_script_v2.js"></script>
	<!-- END OF BORAWARE LOG SCRIPT -->
</head>

<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WQ2Z2JV2"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	
	<div class="skip_nav">
		<a href="#header" class="skip_nav_link">상단메뉴 바로가기</a>
		<a href="#content" class="skip_nav_link">본문 바로가기</a>
		<a href="#sub_nav" class="skip_nav_link">본문 하위메뉴 바로가기</a>
		<a href="#footer" class="skip_nav_link">하단 바로가기</a>
	</div><!-- 웹접근성용 바로가기 링크 모음 -->
	<article id="wrap"
		class="clear <?php if($TPL_VAR["CI"]->uri->rsegments[ 1]=='board'){?>sub_board sub_<?php echo $TPL_VAR["board_info"]['code']?><?php }elseif($TPL_VAR["CI"]->uri->rsegments[ 1]!='index_'){?> sub_<?php echo $TPL_VAR["CI"]->uri->rsegments[ 1]?> <?php echo $TPL_VAR["CI"]->uri->rsegments[ 1]?>_<?php echo $TPL_VAR["CI"]->uri->rsegments[ 2]?> <?php }else{?>main_index<?php }?>">
<?php if($TPL_VAR["header_hidden"]!='y'){?>
<?php $this->print_("nav",$TPL_SCP,1);?>

<?php }?>
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!="index_"){?>
		<article id="container" class="clear">
			<div class="w_custom">
				<div class="page_title">
					<h2><?php if($TPL_VAR["lm"]["name"]){?><?php echo $TPL_VAR["lm"]["name"]?><?php }elseif($TPL_VAR["current_page_name"]){?><?php echo $TPL_VAR["current_page_name"]?><?php }elseif($TPL_VAR["board_info"]['name']){?><?php echo $TPL_VAR["board_info"]['name']?><?php }else{?><?php echo $TPL_VAR["page_title"]?><?php }?>
					</h2>
<?php if($TPL_VAR["board_info"]['code']=='diagnosis'){?>
<?php if($TPL_VAR["CI"]->uri->uri_string=='board/board_write'){?>
					<h5>STEP 01</h5>
<?php }?>
<?php }?>
				</div>
<?php if($TPL_VAR["lm"]["menu"]){?>
				<ul class="sub_nav <?php if($TPL_VAR["CI"]->uri->rsegments[ 1]=='company'){?>company_nav<?php }?>">
<?php if(is_array($TPL_R1=$TPL_VAR["lm"]["menu"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
<?php if($TPL_V1["use"]=='y'){?>
					<li class="<?php if(strpos($TPL_V1["url"],$TPL_VAR["current"])> - 1){?>on<?php }?>"><a href="<?php echo $TPL_V1["url"]?>"><?php echo $TPL_V1["name"]?></a></li>
<?php }?>
<?php }}?>
				</ul>
<?php }?>
			</div>
			<div id="contents_wrap" class="clear">
<?php }?>