$(document).ready(function(){
	//피해 진단
	function createStepSwiper(stepClass, stepId) {
		const $stepContainer = $('.diagnosis_cont.' + stepClass);
		const itemCnt = $stepContainer.find('.item').length;

		if (itemCnt) {
			const $stepWrapper = $(`
				<div class="stepSwiper" id="${stepId}">
					<ol class="diagnosis_step swiper-wrapper"></ol>
				</div>
			`);

			for (let i = 0; i < itemCnt; i++) {
				$stepWrapper.find('.diagnosis_step').append('<li class="swiper-slide"><span></span></li>');
			}

			$stepContainer.prepend($stepWrapper);

			return new Swiper(`#${stepId}`, {
				slidesPerView: 'auto',
			});
		}

		return null;
	}
	
	function updateStepSwiperIndicators(stepClass) {
		const $stepContainer = $('.diagnosis_cont.' + stepClass);
		const $indicator = $stepContainer.find('.diagnosis_step');

		if ($indicator.length) {
			const itemCnt = $stepContainer.find('.item').length;

			$indicator.empty();

			for (let i = 0; i < itemCnt; i++) {
				$indicator.append('<li class="swiper-slide"><span></span></li>');
			}
		}
	}

	// 각각의 Swiper 초기화
	const stepSwiper01 = createStepSwiper('step01', 'step01');
	const stepSwiper02 = createStepSwiper('step02', 'step02');
	
	

	// 단계별 컨트롤
	$('.diagnosis_cont').each(function () {
		const $container = $(this);
		const stepClass = $container.attr('class').split(' ').filter(cls => cls !== 'diagnosis_cont')[0]; // 'step01' or 'step02'
		const $step = $container.find('.diagnosis_step');

		function goToStep(index) {
			const $items = $container.find('.item');
			const $steps = $step.find('li');

			if ($items.eq(index).length) {
				$items.removeClass('on').eq(index).addClass('on');
				$steps.removeClass('on').eq(index).addClass('on');

				if (stepClass === 'step01' && typeof stepSwiper01 !== 'undefined') {
					stepSwiper01.slideTo(index);
				}
				if (stepClass === 'step02' && typeof stepSwiper02 !== 'undefined') {
					stepSwiper02.slideTo(index);
				}

				if (stepClass === 'step01' && index === 0) {
					$container.find('.return').hide();
				} else {
					$container.find('.return').show();
				}
			}
		}
		
		function findCommentNode(container, keyword) {
			const iterator = document.createNodeIterator(container[0], NodeFilter.SHOW_COMMENT, null, false);
			let currentNode;

			while ((currentNode = iterator.nextNode())) {
				if (currentNode.nodeValue.includes(keyword)) {
					return currentNode;
				}
			}

			return null;
		}

		function insertItemAfterComment($container, commentKeyword, $element, selector) {
			if (!$container.find(selector).length) {
				const commentNode = findCommentNode($container, commentKeyword);
				if (commentNode) $(commentNode).after($element);
			}
		}

		const $iphoneItem = $('.iphone_item').detach();

		const $contactItem01 = $('.contact_item01').detach(); // 피해 당시 휴대폰에 저장
		const $contactItem02 = $('.contact_item02').detach(); // 가해자로부터 받은 링크
		const $contactItem03 = $('.contact_item03').detach(); // 링크 주소를 입력하세요
		const $contactItem04 = $('.contact_item04').detach(); // 초대코드

		const $snsItem01 = $('.sns_item01').detach();
		const $snsItem02 = $('.sns_item02').detach();

		function toggleStep02Items() {
			const phoneVal = $('.phone_model select[name="ex2_kor"]').val();
			const snsVal = $('.sns_friend select[name="ex4_kor"]').val();
			const $linkVal = $('.contact_item02 select[name="ex10_kor"]').val();
			const $step02 = $('.diagnosis_cont.step02');
			

			if (phoneVal === '아이폰') {
				insertItemAfterComment($step02, '아이클라우드', $iphoneItem, '.iphone_item');
			} else {
				$step02.find('.iphone_item').remove();
			}

			if (snsVal === '제 연락처 목록을 알고 있습니다.' || snsVal === '둘 다 알고 있습니다.') {
				insertItemAfterComment($step02, '피해 당시 휴대폰에 저장', $contactItem01, '.contact_item01');
				insertItemAfterComment($step02, '가해자로부터 받은 링크', $contactItem02, '.contact_item02');

				const $linkVal = $contactItem02.find('select[name="ex10_kor"]').val();
				if ($linkVal === '링크를 전달 받았습니다.' || $linkVal === '둘 다 받았습니다.' ) {
					insertItemAfterComment($step02, '링크 주소를 입력하세요.', $contactItem03, '.contact_item03');
				} else {
					$step02.find('.contact_item03').remove();
				}

				insertItemAfterComment($step02, '초대코드', $contactItem04, '.contact_item04');
			} else {
				$step02.find('.contact_item01, .contact_item02, .contact_item03, .contact_item04').remove();
			}

			if (snsVal === '제 SNS 친구 목록을 알고 있습니다.') {
				insertItemAfterComment($step02, '피해 당시 sns 친구', $snsItem01, '.sns_item01');
				insertItemAfterComment($step02, '의뢰인 sns 아이디', $snsItem02, '.sns_item02');
			} else {
				$step02.find('.sns_item').remove();
			}
		}

		$('select[name="ex2_kor"], select[name="ex4_kor"]').on('change', toggleStep02Items);
		toggleStep02Items();
		function toggleContactItem03WithStepUpdate() {
			const $step02 = $('.diagnosis_cont.step02');
			const $linkVal = $('.contact_item02 select[name="ex10_kor"]').val();

			if ($linkVal === '링크를 전달 받았습니다.' || $linkVal === '둘 다 받았습니다.') {
				if (!$step02.find('.contact_item03').length) {
					const commentNode = findCommentNode($step02, '링크 주소를 입력하세요.');
					if (commentNode) $(commentNode).after($contactItem03);

					updateStepSwiperIndicators('step02'); // ✅ 삽입 후 indicator 재생성
				}
			} else {
				if ($step02.find('.contact_item03').length) {
					$step02.find('.contact_item03').remove();
					updateStepSwiperIndicators('step02'); // ✅ 제거 후 indicator 재생성
				}
			}
			const $currentItem = $('.diagnosis_cont').find('.item.on');
			const index = $currentItem.index();
			
			goToStep(6);
		}
		$('select[name="ex10_kor"]').on('change', function () {
			toggleContactItem03WithStepUpdate();
		});

		$container.find('.btn_point').on('click', function (e) {
			e.preventDefault();

			const $currentItem = $container.find('.item.on');
			const $title = $currentItem.find('.sub_title h4');
			const hasRequiredMark = $title.find('em').length > 0;
			const $input = $currentItem.find('input, select, textarea').first();
			const value = $input.val()?.trim();

			if (hasRequiredMark && (!value || value === '')) {
				alert(`${$title.text().trim()}는 필수 항목입니다.`);
				$input.focus();
				return;
			}
			else if ($('.item_birth').hasClass('on') && $('#wrap .diagnosis_cont input.ex_birth').val().length < 14) {
				alert('올바른 생년월일을 입력해주세요.');
				
				$input.focus();
				return;
			}
			else if ($currentItem.find('select[name="gender"]').length > 0 && $currentItem.find('select[name="gender"]').val() === '') {
				alert('성별을 선택해주세요.');
				$currentItem.find('select[name="gender"]').focus();
				return;
			}
			else if ($('.item_tel').hasClass('on') && $('#wrap .diagnosis_cont input[name="mobile"]').val().length < 13) {
				alert('올바른 전화번호를 입력해주세요.');
				
				$input.focus();
				return;
			}
								
			const index = $currentItem.index();
			goToStep(index);

			// step01 → step02 전환
			if (stepClass === 'step01' && $currentItem.hasClass('step1_last')) {
				$('.step01').hide();
				$('.step02').show();
				updateStepSwiperIndicators('step02');
				$('.step02 .item').removeClass('on');
				$('.step2_first').addClass('on');
				$('.step02 .diagnosis_step li').removeClass('on').eq(0).addClass('on');
				$('.sub_diagnosis .page_title h5').text('STEP02');

				if (stepSwiper02) stepSwiper02.slideTo(0);
				return;
			}
			
			if($container.find('.last_item').hasClass('on')){
				$container.find('.btn_next').hide();
	            $container.find('.btn_submit').show();
			}
			else{
				$container.find('.btn_next').show();
	            $container.find('.btn_submit').hide();
			}
			
		});
		

		$container.find('.return').on('click', function (e) {
			e.preventDefault();

			const $currentItem = $container.find('.item.on');
			const index = $currentItem.index();
			
			if (stepClass === 'step02' && $currentItem.hasClass('step2_first')) {
				$('.step02').hide();
				$('.step01').show();
				$('.sub_diagnosis .page_title h5').text('STEP01');

				const $step01Items = $('.step01 .item');
				$step01Items.removeClass('on').last().addClass('on');
				$('.step01 .diagnosis_step li').removeClass('on').last().addClass('on');

				if (typeof stepSwiper01 !== 'undefined') {
					stepSwiper01.slideTo($step01Items.length - 1);
				}

				return; 
			}
			
			goToStep(index - 2);
			
		});

		// 초기 return 숨김
		const firstIndex = $container.find('.item.on').index();
		if (stepClass === 'step01' && firstIndex === 1) {
			$container.find('.return').hide();
		}
	});

	//핸드폰 번호
	$('.diagnosis_cont [name="mobile"]').on('input', function () {
        let val = $(this).val().replace(/[^0-9]/g, '');
        let format = '';
        if (val.length <= 3) {
            format = val;
        } else if (val.length <= 7) {
            format = val.substring(0, 3) + '-' + val.substring(3);
        } else {
            format = val.substring(0, 3) + '-' + val.substring(3, 7) + '-' + val.substring(7, 11);
        }
        $(this).val(format);
    });
	
	//생년월일
    $('.diagnosis_cont .ex_birth').on('input', function () {
        let raw = $(this).val().replace(/[^0-9]/g, '');
        if (raw.length > 4) {             
            let mm = raw.substr(4, 2);    
            if (mm.length === 2) {
                let m = parseInt(mm, 10) || 1;
                if (m > 12) m = 12;
                mm = ('0' + m).slice(-2);  
                raw = raw.substr(0, 4) + mm + raw.substr(6);
            }
        }
        if (raw.length > 6) {               
            let dd = raw.substr(6, 2); 
            if (dd.length === 2) {
                let d = parseInt(dd, 10) || 1;
                if (d > 31) d = 31;
                dd = ('0' + d).slice(-2);
                raw = raw.substr(0, 6) + dd + raw.substr(8);
            }
        }
        let formatted = '';
        if (raw.length <= 4) {
            formatted = raw;
        } else if (raw.length <= 6) {
            formatted = raw.substring(0, 4) + ' / ' + raw.substring(4);
        } else {
            formatted = raw.substring(0, 4) + ' / ' + raw.substring(4, 6) + ' / ' + raw.substring(6, 8);
        }
        $(this).val(formatted);
    });
	
	//피해일시
	var selSet = ({
        slidesPerView : '1', 
        direction: "vertical", 
        mousewheel: true,
        freeMode : true,
    });
    if($('.diagnosis_cont .sel_info:has(.on)').length){
        var selSwiper = new Swiper('.diagnosis_cont .sel_info:has(.on) .selSwiper', selSet);
    }   
    
    $('.diagnosis_cont .sel_info dt').on('click', function(){
        $(this).toggleClass('on');
        selSwiper = new Swiper('.diagnosis_cont .sel_info:has(.on) .selSwiper', selSet);
    });
    $(document).on('mouseup', function(e){
		$('.diagnosis_cont .sel_info dt').each(function(){
			if (!$(e.target).closest(this).length) {
				$(this).removeClass('on');
			}
			if($('.selSwiper .swiper-slide-active').length){
				selSwiper.destroy();
			}
			
		});
		
		$('.diagnosis_cont .sel_info dd a').on('click', function(){
			var thisTxt = $(this).text();
			$(this).closest('.sel_info').find('dt').removeClass('on').find('span').text(`${thisTxt}`);
			if($(this).closest('.sel_info').next('.sel_info').length){
				$(this).closest('.sel_info').next('.sel_info').find('dt').addClass('on');
			} else {
				$(this).closest('.data_list > li').next('li').find('.sel_info').eq(0).find('dt').addClass('on');
			}
			
			var joinVal = '';
			$('.diagnosis_cont .sel_info dt').each(function(idx){
				var val = $(this).text().trim();  
				joinVal += val + '';
				if(idx === 2) joinVal += ' ';
				$('.diagnosis_cont .flatpickr-input').val(joinVal.trim());
			});
			if($('.selSwiper .swiper-slide-active').length){
				selSwiper.destroy();
			}
			selSwiper = new Swiper('.diagnosis_cont .sel_info:has(.on) .selSwiper', selSet);
			return false;
		});
	});

    flatpickr(".flatpickr_date", {
        enableTime: true,
        dateFormat: "Y.m.d K h:i",
        time_24hr: false,
        locale: "ko",
    });
		
	$('.diagnosis_cont .file_wrap .btn').on('click', function(){
		$(this).siblings('[type="file"]').trigger('click');
		return false;
	});
	$('.diagnosis_cont .file_wrap [type="file"]').change(function(e){
		$(this).siblings(".inp_name").val(e.target.files[0].name);
	});
	$('.diagnosis_cont .add_desc [type="radio"]').on('change', function(){
		if($(this).val() == '있음'){
			$(this).closest('.add_desc').find('.file_wrap').addClass('on');
		} else {
			$(this).closest('.add_desc').find('.file_wrap').removeClass('on');
		}
	});
	
	$('.diagnosis_cont .btn_submit').click(function(){
		$('.loader_box').addClass('on');
	});
});