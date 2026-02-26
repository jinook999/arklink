$(document).ready(function(){
	//lnb 2depth
	$('#header .header_cont .hd_lnb > li').each(function(){
		$(this).mouseenter(function(){
			$(this).addClass('slide_on');

			if ( $(this).hasClass('slide_on') ){
			$('.hd_lnb_dep2').stop().slideUp(300);
			$(this).children('.hd_lnb_dep2').stop().slideDown(300);
		} else {
			$(this).children('.hd_lnb_dep2').stop().slideUp(300);
		};
		});
		$(this).mouseleave(function(){
			$(this).removeClass('slide_on');
			$(this).children('.hd_lnb_dep2').stop().slideUp(300);
		});
		
	});

	//전체 카테고리
	$(document).on("click", "#header .all_cate", function(){
		$("#aside").addClass("on");
		return false;
	});
	$("#aside .close_btn").on("click", function(){
		$("#aside").removeClass("on");
		return false;
	});
	
	// header on
	//var containerBottom = $('#container').offset().top + $('#container').outerHeight();
	var windowHeight = $(window).height();

	if ( $(this).scrollTop() > 1 ) {
		$('#header, .ft_top').addClass('on');
	} else {
		$('#header, .ft_top').removeClass('on');
	}
	$(window).scroll(function(){
		if ( $(this).scrollTop() > 1 ) {
			$('#header, .ft_top').addClass('on');
		} else {
			$('#header, .ft_top').removeClass('on');
		}

		if ($(this).scrollTop() + windowHeight /* >= containerBottom */) {
			$('.ft_top').addClass('main');
		} else {
			$('.ft_top').removeClass('main');
		}
	});
});