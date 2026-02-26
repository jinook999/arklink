$(document).ready(function() {
	
	function bindAwardEvent() {
		// 기존 이벤트 제거
		$('.main_award .cont .list li').off('mouseover click');

		// 1024px 이상일 때
		if ($(window).width() > 1024) {
			$('.main_award .cont .list li').on('mouseover', function(){
				var imgTab = $(this).attr('data-tab');
				$('.main_award .cont .img_box ul li, .main_award .cont .list li').removeClass('on');
				$(this).addClass('on');
				$('#' + imgTab).addClass('on');
				return false;
			});
		} 
		// 1024px 이하일 때
		else {
			$('.main_award .cont .list li').on('click', function(){
				var imgTab = $(this).attr('data-tab');
				$('.main_award .cont .img_box ul li, .main_award .cont .list li').removeClass('on');
				$(this).addClass('on');
				$('#' + imgTab).addClass('on');
				return false;
			});
		}
	}
	
	//solution wrapping
	function toggleSubSectionBg() {
        if ($(window).width() < 1024) {
            if ($(".sub_section_bg").length === 0) {
            $("#section04, #section05").wrapAll('<div class="sub_section_bg"></div>');
            }
        } else {
            if ($(".sub_section_bg").length) {
            $(".sub_section_bg").children().unwrap();
            }
        }
	}

	$(window).on("resize load", toggleSubSectionBg);
	
	
		
	//풀페이지
		if($(window).width() < 1024){
			//fullpage_api.destroy('all');
			bindAwardEvent();
		}else{
			/* fullpage 3.0.0 */
			var myFullpage = new fullpage('#fullpage', {
				//Navigation
				anchors:['MAIN', 'secondPage', '3rdPage','4thPage','5thPage','6thPage','7thPage'],
				navigation: true,
				navigationPosition: 'left',
				navigationTooltips: ['MAIN', 'CONTACT US', 'Awards', 'SPECIALIST', 'Why ARKLINK', 'SOLUTION', 'CONTENTS'],
                showActiveTooltip: true,
				scrollOverflow:true,
				loopBottom: false,

				//events
				afterLoad: function(origin, destination, direction){
					var cur_page = destination.index+1;
					$('.cur').text('0'+cur_page);
					if ( destination.index == 0) {
						$('#header, #fp-nav').removeClass("main");	
					}
					else if ( destination.index == 2 || destination.index == 3 || destination.index == 4 || destination.index == 5 || destination.index == 6) {
						$('#header, #fp-nav').addClass("main");
					}
					else if (destination.index == 7) {
						$('#header').addClass("main");
						$('#fp-nav').removeClass("main");
					}
					else {
						$('#header, #fp-nav').removeClass("main");
					}
					
					if(destination.item.id === 'section03'){
						bindAwardEvent();
					}
					
					toggleSubSectionBg();
					
					if(destination.item.id === 'section05'){
						runCounter();
					}
					
					if(destination.item.id === 'section08'){
						$('#header').addClass("on");
					    // 모든 active 제거
                        $('#fp-nav ul li a').removeClass('active');
					    // 7번째(li:eq(6))에 active 추가
                        $('#fp-nav ul li a').eq(6).addClass('active');
					}
				},
			});
			
		}

		function scrollToTop() {
            fullpage_api.moveTo(1);
        }

		$(window).resize(function() {
			if($(window).width() < 1024){
                if($('.fp-enabled').length){
                    fullpage_api.destroy('all');
                }
				bindAwardEvent();
			}else{
				/* fullpage 3.0.0 */
				var myFullpage = new fullpage('#fullpage', {
					//Navigation
					anchors:['MAIN', 'secondPage', '3rdPage','4thPage','5thPage','6thPage','7thPage'],
					navigation: true,
					navigationPosition: 'left',
					navigationTooltips: ['MAIN', 'CONTACT US', 'Awards', 'SPECIALIST', 'Why ARKLINK', 'SOLUTION', 'CONTENTS'],
					showActiveTooltip: true,
					scrollOverflow:true,
					loopBottom: false,

					//events
					afterLoad: function(origin, destination, direction){
						var cur_page = destination.index+1;
						$('.cur').text('0'+cur_page);
						if ( destination.index == 0) {
							$('#header, #fp-nav').removeClass("main");	
						}
						else if ( destination.index == 2 || destination.index == 3 || destination.index == 4 || destination.index == 5 || destination.index == 6) {
							$('#header, #fp-nav').addClass("main");
						}
						else if (destination.index == 7) {
							$('#header').addClass("main");
							$('#fp-nav').removeClass("main");
						}
						else {
							$('#header, #fp-nav').removeClass("main");
						}
						if(destination.item.id === 'section03'){
							bindAwardEvent();
						}
						
						toggleSubSectionBg();
						
						if(destination.item.id === 'section08'){
							$('#header').addClass("on");
						  // 모든 active 제거
						  $('#fp-nav ul li a').removeClass('active');
						  // 7번째(li:eq(6))에 active 추가
						  $('#fp-nav ul li a').eq(6).addClass('active');
						}
					},
				});
				
			}
		});

	
	
	//award
	var awardSwipers = [];

	$('.main_award .tab a').click(function(){
		var awardTab = $(this).attr('data-tab');

		// 탭 전환 시 section03 클래스 토글
		$('#section03').toggleClass('on');

		// 기존 on 클래스 제거 및 선택된 요소 on 클래스 추가
		$('.main_award .tab a, .main_award .cont > div, .main_award .cont .img_box ul li, .main_award .cont .list li').removeClass('on');
		$(this).addClass('on');
		$('#' + awardTab).addClass('on');
		$('#' + awardTab).find('.img_box ul li:nth-child(1), .list li:nth-child(1)').addClass('on');
		
		return false;

		// 기존 스와이퍼 모두 제거
		awardSwipers.forEach(function(swiper){
			swiper.destroy(true, true);
		});
		awardSwipers = [];

		// 활성화된 탭 안의 스와이퍼 다시 생성
		$('#' + awardTab).find('.swiper-container').each(function(){
			$(this).find('.list_container li').addClass('swiper-slide');
			var newSwiper = new Swiper(this, {
				slidesPerView : 'auto',
				spaceBetween: 25,
				speed: 700,
				freeMode:true,
				observer: true,
				observeParents: true,
			});
			awardSwipers.push(newSwiper);
		});

		
	});

	// 페이지 로드 시 초기화용
	$('.main_award .cont > div').each(function(){
		var awardContainer = $(this).find('.swiper-container'); 
		$(this).find('.list_container li').addClass('swiper-slide');
		var awardTabSwiper = new Swiper(awardContainer.get(0), {
			slidesPerView : 'auto',
			spaceBetween: 25,
			speed: 700,
			freeMode:true,
			observer: true,
			observeParents: true,
		});
		awardSwipers.push(awardTabSwiper);
	});
	
	//board
	$('.main_contact .board_box').each(function(){
		var boardContainer = $(this).find('.swiper-container');
		var nextBtn = $(this).find('.next').get(0);
		var prevBtn = $(this).find('.prev').get(0);

		var boardSwiper = new Swiper(boardContainer.get(0), {
			direction: 'vertical',
			slidesPerView : 5,  
			spaceBetween: 0,
			speed: 700,
			loop: true,
			navigation: {
                nextEl: nextBtn,
                prevEl: prevBtn,
			},
			touchRatio : 0,
			autoplay: {
                delay: 1500,
                disableOnInteraction: false,
			},
		});
	});
	
	//counter
	let counterRan = false; 

	function runCounter(){
        if(counterRan) return; 

        $('.main_percent dl').each(function(index){
            var countIdx = $(this).find('.n-count');
            countIdx.addClass('item' + index);
            var suCount = countIdx.attr('data-count');
            countIdx.text(suCount);
            
            $(countIdx).counterUp({
                delay: 10,
                time: 1500,
            });
        });

        counterRan = true; 
	}

	$(window).on('scroll', function(){
        var sectionTop = $('#section05').offset().top;
        var scrollTop = $(window).scrollTop();
        var windowHeight = $(window).height();

        if(scrollTop + windowHeight > sectionTop + 100){
            runCounter();
        }
	});

	//solution
	$('.main_solution .solution_box .list.ver_pc li').click(function(){
		var solutionTab = $(this).attr('data-tab');
		$('.main_solution .solution_box .list li, .main_solution .cont li')	.removeClass('on');
		$(this).addClass('on');
		$('#' + solutionTab).addClass('on');
	});
	
	$('.main_solution .solution_box .list.ver_m li').click(function(){
		$(this).toggleClass('on').find('.solution_cont').stop().slideToggle().parents('li').siblings('li').removeClass('on').find('.solution_cont').stop().slideUp();
	});
	if($(window).width() < 1024){
		$('.main_solution .solution_box .list li:nth-child(1)').addClass('on').find('.solution_cont').stop().slideDown();
	}
	$(window).on('resize', function(){
		if($(window).width() < 1024){
			$('.main_solution .solution_box .list li:nth-child(1)').addClass('on').find('.solution_cont').stop().slideDown();
		}	
	});
	
	

	//gallery
	var projectSwiper = new Swiper(".main_gallery .swiper-container", {
		slidesPerView : 4,	
		spaceBetween: 32,
		speed:800,
		loop: true,
		navigation : {
			nextEl : '.main_gallery .next',
			prevEl : '.main_gallery .prev',
		},
		
		breakpoints: {
			1024: {
				slidesPerView: 4,  
				spaceBetween: 32,
			},
			860: {
				slidesPerView: 3,  
				spaceBetween: 20,
			},
			640: {
				slidesPerView: 2.5,  
				spaceBetween: 20,
			},
			0: {
				slidesPerView: 1.5,  
				spaceBetween: 15,
			},
        },
	});
});