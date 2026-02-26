<?php /* Template_ 2.2.8 2025/04/15 09:59:04 /gcsd33_arklink/www/data/skin/respon_default_en/outline/header.html 000011086 */ ?>
<!DOCTYPE html>
<html lang="ko">
<head>
<title><?php echo $TPL_VAR["cfg_site"]['title']?></title>
<link rel="shortcut icon" href="<?php echo _UPLOAD.'/conf/'.$TPL_VAR["cfg_site"]['favicon']?>" type="image/x-icon" />
<link rel="icon" href="<?php echo _UPLOAD.'/conf/'.$TPL_VAR["cfg_site"]['favicon']?>" type="image/x-icon" />

<meta charset="UTF-8">
<meta name="title" content="<?php echo $TPL_VAR["cfg_site"]['title']?>" />
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
<link rel="stylesheet" type="text/css" href="/data/skin/respon_default_en/css/reset.css" />
<link rel="stylesheet" type="text/css" href="/data/skin/respon_default_en/css/aos.css" />
<link rel="stylesheet" type="text/css" href="/data/skin/respon_default_en/css/animate.min.css" />
<link rel="stylesheet" type="text/css" href="/data/skin/respon_default_en/css/common.css" /><!-- 서브 공통 css ｜ custom 금지 css -->
<link rel="stylesheet" type="text/css" href="/data/skin/respon_default_en/css/sub.css" /><!-- 서브 공통 custom 요소 css ｜ 개별페이지 css -->
<link rel="stylesheet" type="text/css" href="/data/skin/respon_default_en/css/skin.css" /><!-- 스킨 css ｜ 상하단·메인 -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="/lib/js/jquery.validate.min.js"></script>
<script src="/lib/js/common.js"></script>
<script src="/lib/js/jquery-ui.min.js"></script>
<script src="/lib/js/moment-with-locales.min.js"></script>
<script src="<?php if(defined('_IS_SSL')){?>//ssl.daumcdn.net/dmaps<?php }else{?>//dmaps.daum.net<?php }?>/map_js_init/postcode.v2.js"></script>
<link rel="stylesheet" type="text/css" href="/data/skin/respon_default_en/css/slick.css">
<script src="<?php echo $TPL_VAR["js"]?>/js/slick.js"></script>
<script src="<?php echo $TPL_VAR["js"]?>/js/aos.js"></script>
<script src="<?php echo $TPL_VAR["js"]?>/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript">
	var CURRENT_DATE = "<?php echo CURRENT_DATE?>";
	$(function() {
		$.validator.setDefaults({
			onkeyup: false,
			onclick: false,
			onfocusout: false,
			ignore : '.ignore',
			showErrors: function(errorMap, errorList) {
				if(errorList.length < 1) {
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
			monthNames : ['1Month', 'February', 'March', 'April', 'May', 'June', 'July', 'August', '9Month', 'October', 'November', 'December'],
			monthNamesShort : ['1Month', 'February', 'March', 'April', 'May', 'June', 'July', 'August', '9Month', 'October', 'November', 'December'],
			dayNames : ['Sun', 'Month', 'Tue', 'Wed', 'Throat', 'Fri', 'Sat'],
			dayNamesShort : ['Sun', 'Month', 'Tue', 'Wed', 'Throat', 'Fri', 'Sat'],
			dayNamesMin : ['Sun', 'Month', 'Tue', 'Wed', 'Throat', 'Fri', 'Sat'],
			onClose : function (selectedDate){
				$(".enddate").datepicker( 'option', 'minDate', selectedDate );
			}
		});

		$(".enddate").datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showMonthAfterYear: true,
			dateFormat: "yy-mm-dd",
			monthNames : ['1Month', 'February', 'March', 'April', 'May', 'June', 'July', 'August', '9Month', 'October', 'November', 'December'],
			monthNamesShort : ['1Month', 'February', 'March', 'April', 'May', 'June', 'July', 'August', '9Month', 'October', 'November', 'December'],
			dayNames : ['Sun', 'Month', 'Tue', 'Wed', 'Throat', 'Fri', 'Sat'],
			dayNamesShort : ['Sun', 'Month', 'Tue', 'Wed', 'Throat', 'Fri', 'Sat'],
			dayNamesMin : ['Sun', 'Month', 'Tue', 'Wed', 'Throat', 'Fri', 'Sat'],
			onClose : function(selectedDate) {
				$(".startdate").datepicker( "option", "maxDate", selectedDate );
			}
		});

		$(".datepicker").datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			showMonthAfterYear: true,
			dateFormat: "yy-mm-dd",
			monthNames : ['1Month', 'February', 'March', 'April', 'May', 'June', 'July', 'August', '9Month', 'October', 'November', 'December'],
			monthNamesShort : ['1Month', 'February', 'March', 'April', 'May', 'June', 'July', 'August', '9Month', 'October', 'November', 'December'],
			dayNames : ['Sun', 'Month', 'Tue', 'Wed', 'Throat', 'Fri', 'Sat'],
			dayNamesShort : ['Sun', 'Month', 'Tue', 'Wed', 'Throat', 'Fri', 'Sat'],
			dayNamesMin : ['Sun', 'Month', 'Tue', 'Wed', 'Throat', 'Fri', 'Sat']
		});
	});
</script>
<link rel="stylesheet" type="text/css" href="/data/skin/respon_default_en/css/cssreset-context-min.css"><!-- 에디터 css -->

</head>
<body>
<div class="skip_nav">
	<a href="#header" class="skip_nav_link">Top menu shortcut</a>
	<a href="#content" class="skip_nav_link">Go to Body</a>
	<a href="#sub_nav" class="skip_nav_link">Body Submenu Shortcut</a>
	<a href="#footer" class="skip_nav_link">Bottom</a>
</div><!-- 웹접근성용 바로가기 링크 모음 -->
<article id="wrap" class="clear <?php if($TPL_VAR["CI"]->uri->rsegments[ 1]=='board'){?>sub_board sub_<?php echo $TPL_VAR["board_info"]['code']?><?php }elseif($TPL_VAR["CI"]->uri->rsegments[ 1]!='index_'){?> sub_<?php echo $TPL_VAR["CI"]->uri->rsegments[ 1]?> <?php echo $TPL_VAR["CI"]->uri->rsegments[ 1]?>_<?php echo $TPL_VAR["CI"]->uri->rsegments[ 2]?> <?php }else{?>main_index<?php }?>">
<?php if($TPL_VAR["header_hidden"]!='y'){?>
<?php $this->print_("nav",$TPL_SCP,1);?>

<?php }?>
		
	<!-- ** layout정리190513  ** -->
	<article id="container" class="clear">
		<div id="contents_wrap" class="clear">
			<!-- 측면 시작 #aside -->
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!="index_"){?>
<?php if($TPL_VAR["CI"]->uri->uri_string!="goods/goods_search"){?>
				<div id="side_box" class="dn">
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]=="member"||$TPL_VAR["CI"]->uri->rsegments[ 1]=="service"){?>
<?php $this->print_("left_member",$TPL_SCP,1);?>

<?php }elseif($TPL_VAR["CI"]->uri->rsegments[ 1]=="goods"){?>
<?php $this->print_("left_goods",$TPL_SCP,1);?>

<?php }else{?>
<?php $this->print_("left_bbs",$TPL_SCP,1);?>

<?php }?>
				</div><!-- #aside -->
<?php }?>
<?php }?>
			<!-- 측면 끝 #aside -->
			<div id="contents_box">
				<!-- #네비게이션 시작 .nav_wrap -->
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!="index_"){?>
					<!-- outline/header -->
					<div class="nav_wrap">
						<div class="nav_box">
							<h2><?php if($TPL_VAR["page_title"]){?><?php echo $TPL_VAR["page_title"]?><?php }else{?><?php echo $TPL_VAR["current_page_name"]?><?php }?></h2>
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!="goods"){?>
							<p>
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]=="company"){?>
									This is <?php echo $TPL_VAR["current_page_name"]?> page.
<?php }elseif($TPL_VAR["CI"]->uri->rsegments[ 1]=="board"){?>
									This is <?php echo $TPL_VAR["board_info"]['name']?> board.
<?php }elseif($TPL_VAR["CI"]->uri->uri_string=="member/login"){?>
									If you are not a member, please use it after signing up.
<?php }elseif($TPL_VAR["CI"]->uri->uri_string=="member/find_id"){?>
									Did you forget your ID? Please enter the information entered at the time of signing up.
<?php }elseif($TPL_VAR["CI"]->uri->uri_string=="member/find_pw"){?>
									Did you forget your password? Please enter the information entered at the time of signing up.
<?php }elseif($TPL_VAR["CI"]->uri->uri_string=="service/usepolicy"){?>
									This is the privacy policy page.
<?php }elseif($TPL_VAR["CI"]->uri->uri_string=="service/agreement"){?>
									This is the Terms and Conditions page.
<?php }?>
							</p>
<?php }?>
							<ul>
								<li><a href="/en" class="home">Home</a> ></li>
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!=="member"){?>
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!=="service"){?>
<?php if($TPL_VAR["lm"]["menu"]){?>
									<li><a href="<?php if(is_array($TPL_R1=$TPL_VAR["lm"]["menu"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?><?php if($TPL_K1=='0'){?><?php echo $TPL_V1["url"]?><?php }?><?php }}?>"><?php echo $TPL_VAR["lm"]["name"]?></a> > </li>
<?php }?>
<?php }?>
<?php }?>
								<li>
									<strong>
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]=="goods"){?>
<?php if($TPL_VAR["CI"]->uri->uri_string!=="goods/goods_search"){?>
										<div class="navi_select">
											<strong class="navi_tit"><?php echo $TPL_VAR["category_info"]['categorynm']?><!-- 카테고리명 노출 --></strong>
											<ul>
<?php if(is_array($TPL_R1=$TPL_VAR["category_list"]['top_category_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
												<li class="">
													<a href="/en/goods/goods_list?cate=<?php echo $TPL_V1["category"]?>&display_type=<?php echo $TPL_VAR["display_type"]?>">
<?php if($TPL_V1["multi_category"]){?>
													<?php echo $TPL_V1["multi_category"]?>

<?php }else{?>
													<?php echo $TPL_V1["categorynm"]?>

<?php }?>
													</a>
												</li>
<?php }}?>
											</ul>
										</div>
<?php }?>
<?php }elseif($TPL_VAR["page_title"]){?>
									<?php echo $TPL_VAR["page_title"]?>

<?php }else{?>
									<?php echo $TPL_VAR["current_page_name"]?>

<?php }?>
									</strong>
								</li>
							</ul>
						</div>
					</div>
<?php }?>
				<!-- #네비게이션 끝 .nav_wrap -->

				<!-- 컨텐츠 시작 #contents -->
				<div id="content" class="clear ">
					<!-- #공통 상단요소 시작 -->
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]=="board"){?>
<?php $this->print_("bbs_top",$TPL_SCP,1);?>

<?php }elseif($TPL_VAR["CI"]->uri->rsegments[ 1]=="goods"){?>
<?php if($TPL_VAR["CI"]->uri->uri_string=="goods/goods_list"||$TPL_VAR["CI"]->uri->uri_string=="goods/goods_view"){?>
<?php }elseif($TPL_VAR["CI"]->uri->uri_string=="goods/goods_search"){?>
<?php }?>
<?php }?>
					<!-- #공통 상단요소 끝 -->

					

					<!-- #서브 컨텐츠 시작 -->

<!-- ** layout정리190513  ** -->