document.addEventListener("DOMContentLoaded", function () {
	if($('.sub_nav').length){
		const subNav = document.querySelector('.sub_nav');
		const onItem = subNav.querySelector('.on');

		// 모바일일 때만 작동
		
		if (onItem && window.innerWidth <= 479) {
			const leftOffset = onItem.offsetLeft;
			subNav.scrollTo({
				left: leftOffset,
				behavior: 'smooth' // 원하면 'auto'로 바꿔도 됩니다
			});
		}
	}
});
