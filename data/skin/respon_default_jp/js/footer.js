$(document).ready(function(){
    //퀵메뉴
        function MainQuick(){
            setTimeout(function(){
                $('.main_quick').each(function(){
                    $(this).addClass('on');
                });
            }, 500)
        }
        MainQuick();
    
    //리사이징
        $(window).on('resize', function(){
            MainQuick();
        });
	//애니메이션
        AOS.init({
            offset: 0,
            debounceDelay: 50,
            throttleDelay: 99,
            easing: 'ease-in-quart',
        });
        onElementHeightChange(document.body, function(){
            AOS.refresh();
        });
        function onElementHeightChange(elm, callback) {
            var lastHeight = elm.clientHeight
            var newHeight;

            (function run() {
                newHeight = elm.clientHeight;      
                if (lastHeight !== newHeight) callback();
                lastHeight = newHeight;
                if (elm.onElementHeightChangeTimer) {
                        clearTimeout(elm.onElementHeightChangeTimer); 
                }
                elm.onElementHeightChangeTimer = setTimeout(run, 200);
            })();
        }
});
$(window).on('load', function () {
	//애니메이션
	    AOS.refresh(true);
});