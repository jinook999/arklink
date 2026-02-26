<?php /* Template_ 2.2.8 2025/09/18 17:19:37 /gcsd33_arklink/www/data/skin/respon_default/board/board_view.html 000000330 */ ?>
<?php if($TPL_VAR["board_info"]["code"]==='diagnosis'){?>
<?php echo include_('board_view','board/view_diagnosis.html')?>

<?php }else{?>
<?php echo include_('board_view','board/view.html')?>

<?php }?>