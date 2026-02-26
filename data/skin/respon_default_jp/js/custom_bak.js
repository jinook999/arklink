$(document).ready(function(){
	//피해 진단
    if($('.diagnosis_cont.step01 .item').length){
        $('#contents_wrap').prepend('<div class="stepSwiper" id="step01"><ol class="diagnosis_step swiper-wrapper"></ol></div>')
    }
    $('.diagnosis_step').each(function(){
        var itemCnt = $('.diagnosis_cont.step01 .item').length;
        for (var i = 0; i < itemCnt; i++) {
            $(this).append('<li class="swiper-slide"><span></span></li>');
        }
    });
    if($('.stepSwiper').length){
        var stepSwiper = new Swiper('.stepSwiper', {
            slidesPerView : 'auto',
        });
    }
    $(document).on('click', '.diagnosis_step > li:has(~ li.on)', function(){
        var i = $(this).index();
        var id = $(this).closest('.stepSwiper').attr('id');
        $(this).addClass('on').siblings().removeClass('on');
        $(`.diagnosis_cont.${id} .item`).eq(i).addClass('on').siblings().removeClass('on');
        stepSwiper.slideTo(i-1, 500, false);
    });
    $('.diagnosis_cont .btn_wrap a.return').on('click', function(){
        var i = $(this).closest('.item').index();
        $('.diagnosis_step > li').eq(i-1).trigger('click');
        return false;
    });
    $('.diagnosis_cont .btn_wrap a.first_return').on('click', function(){
        $('.stepSwiper').remove();
        $(this).closest('.item').removeClass('on');
        $('.diagnosis_cont.step01').show();
        $('#contents_wrap').prepend('<div class="stepSwiper" id="step01"><ol class="diagnosis_step swiper-wrapper"></ol></div>')
        $('.diagnosis_step').each(function(){
            var itemCnt = $('.diagnosis_cont.step01 .item').length;
            for (var i = 0; i < itemCnt; i++) {
                $(this).append('<li class="swiper-slide"><span></span></li>');
            }
        });
        stepSwiper = new Swiper('.stepSwiper', {
            slidesPerView : 'auto',
        });
        var last = stepSwiper.slides.length - 1;
        stepSwiper.slideTo(last, 500, false);
        $('.diagnosis_step > li:last-child').addClass('on');
        $('.page_title h5').text('SETP 01')
        return false;
    });
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
    $('.diagnosis_cont [name="ex1_kor"]').on('input', function () {
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
    $('.diagnosis_cont.step01 .item:has(.single) .btn_wrap a.btn_point').on('click', function(){
        var i = $(this).closest('.item').index();
        if(i == 5){
            $('.diagnosis_cont.step01').hide();
            $('.stepSwiper').remove();
            $('.page_title h5').text('SETP 02')
            if($('[name="ex2_kor"]').val() == '아이폰' && ($('[name="ex4_kor"]').val() == '제 연락처 목록을 알고 있습니다.' || $('[name="ex4_kor"]').val() == '둘 다 알고 있습니다.')){
                $('.diagnosis_cont.step02 .item').eq(0).addClass('on');
                $('#contents_wrap').prepend('<div class="stepSwiper" id="step02"><ol class="diagnosis_step swiper-wrapper"></ol></div>')
                $('.diagnosis_step').each(function(){
                    var itemCnt = $('.diagnosis_cont.step02 .item').length;
                    for (var i = 0; i < itemCnt; i++) {
                        $(this).append('<li class="swiper-slide"><span></span></li>');
                    }
                });
                stepSwiper = new Swiper('.stepSwiper', {
                    slidesPerView : 'auto',
                });
                $('.diagnosis_cont:is(.step03, .step04)').remove();
            } else if($('[name="ex4_kor"]').val() == '제 SNS 친구 목록을 알고 있습니다.'){
                $('.diagnosis_cont.step04 .item').eq(0).addClass('on');
                $('#contents_wrap').prepend('<div class="stepSwiper" id="step04"><ol class="diagnosis_step swiper-wrapper"></ol></div>')
                $('.diagnosis_step').each(function(){
                    var itemCnt = $('.diagnosis_cont.step04 .item').length;
                    for (var i = 0; i < itemCnt; i++) {
                        $(this).append('<li class="swiper-slide"><span></span></li>');
                    }
                });
                stepSwiper = new Swiper('.stepSwiper', {
                    slidesPerView : 'auto',
                });
            } else {
                $('.diagnosis_cont.step03 .item').eq(0).addClass('on');
                $('#contents_wrap').prepend('<div class="stepSwiper" id="step03"><ol class="diagnosis_step swiper-wrapper"></ol></div>')
                $('.diagnosis_step').each(function(){
                    var itemCnt = $('.diagnosis_cont.step03 .item').length;
                    for (var i = 0; i < itemCnt; i++) {
                        $(this).append('<li class="swiper-slide"><span></span></li>');
                    }
                });
                stepSwiper = new Swiper('.stepSwiper', {
                    slidesPerView : 'auto',
                });
            }
        } else if ($(this).closest('.item').find('.sub_title h4 em').length && ($(this).closest('.item').find('select, input').val() == '선택' || $(this).closest('.item').find('select, input').val() == '')){
            var alertTxt = $(this).closest('.item').find('.sub_title h4').text();
            alert(`${alertTxt}는 필수 항목입니다.`);
        } else if ($(this).closest('.item').find('[name="mobile"]').length && $(this).closest('.item').find('[name="mobile"]').val().length < 13){
            alert('올바른 전화번호를 입력해주세요.');
        } else if ($(this).closest('.item').find('[name="ex1_kor"]').length && $(this).closest('.item').find('[name="ex1_kor"]').val().length < 14){
            alert('올바른 생년월일을 입력해주세요.')
        } else {
            $('.diagnosis_step > li').eq(i+1).addClass('on').siblings().removeClass('on');
            $('.diagnosis_cont .item').eq(i+1).addClass('on').siblings().removeClass('on');
            
            stepSwiper.slideTo(i, 500, false);
        }
        
        return false;
    });
    $('.diagnosis_cont:not(.step01) .item:has(.single) .btn_wrap a.btn_point').on('click', function(){
        var i = $(this).closest('.item').index();
        if ($(this).closest('.item').find('.sub_title h4 em').length && ($(this).closest('.item').find('select, input').val() == '선택' || $(this).closest('.item').find('select, input').val() == '')){
            var alertTxt = $(this).closest('.item').find('.sub_title h4').text();
            alert(`${alertTxt}는 필수 항목입니다.`)
        } else {
            $('.diagnosis_step > li').eq(i+1).addClass('on').siblings().removeClass('on');
            $(this).closest('.item').next('.item').addClass('on').siblings().removeClass('on');
            stepSwiper.slideTo(i, 500, false);
        }
        return false;
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
});