<?php /* Template_ 2.2.8 2025/10/20 13:41:39 /gcsd33_arklink/www/data/skin/respon_default/page/index.html 000002605 */ ?>
<?php if($TPL_VAR["view"]["include_header"]==='y'){?><?php $this->print_("header",$TPL_SCP,1);?><?php }?>
<?php if($TPL_VAR["view"]["no"]=='1'){?>
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('기업소개');
</script>

<style>
    #contents_wrap { width: 100%; max-width: 100%; }
    .sub_nav { margin-bottom: 101px; }

    @media screen and (max-width: 1023px){
        .sub_nav { margin-bottom: clamp(40px, 10vw, 101px); }
    }
</style>
<!--{ : ? view.no == '2'}-->
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('DeepCoding');
</script>
<!--{ : ? view.no == '3'}-->
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('Data_Swapjack');
</script>
<!--{ : ? view.no == '4'}-->
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('Ridentify');
</script>
<!--{ : ? view.no == '5'}-->
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('DeterOS');
</script>
<!--{ : ? view.no == '6'}-->
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('Aegis');
</script>
<!--{ : ? view.no == '7'}-->
<!-- 카카오 픽셀 스크립트 -->
<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/kas/static/kp.js"></script>
<script type="text/javascript">
  kakaoPixel('5590299396849158438').pageView('DeepScan');
</script>
<?php }else{?>
<style>
    #container { padding-bottom: 0; }
    #contents_wrap { width: 100%; max-width: 100%; }
</style>
<?php }?>
<?php echo $TPL_VAR["view"]["content"]?>

<?php if($TPL_VAR["view"]["include_footer"]==='y'){?><?php $this->print_("footer",$TPL_SCP,1);?><?php }?>