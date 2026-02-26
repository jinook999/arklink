<?php /* Template_ 2.2.8 2025/04/15 09:59:03 /gcsd33_arklink/www/data/skin/respon_default_en/board/board_write.html 000000739 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<div class="sub_content">
	<div class="sub_board">
<?php if($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='modify'||$TPL_VAR["board_info"]['mode']=='answer'){?>
		<?php echo include_('board_write','board/_form_board_write.html')?>

<?php }elseif($TPL_VAR["board_info"]['mode']=='answer_write'||$TPL_VAR["board_info"]['mode']=='answer_modify'){?>
		<?php echo include_('board_answer_write','board/_form_board_answer_write.html')?>

<?php }?>
	</div><!-- .sub_cont -->
</div><!--content_sub-->
<?php $this->print_("footer",$TPL_SCP,1);?>