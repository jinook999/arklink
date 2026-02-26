/**
 * 성능 최적화 스크립트
 * - 이미지 lazy loading 지원
 * - 네이티브 lazy loading 폴백
 */

(function() {
  'use strict';

  // 네이티브 lazy loading 지원 확인
  if ('loading' in HTMLImageElement.prototype) {
    // 네이티브 지원 시 이미지에 loaded 클래스 추가
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(function(img) {
      if (img.complete) {
        img.classList.add('loaded');
      } else {
        img.addEventListener('load', function() {
          img.classList.add('loaded');
        });
      }
    });
  } else {
    // 네이티브 미지원 시 Intersection Observer 사용
    if ('IntersectionObserver' in window) {
      const lazyImages = document.querySelectorAll('img[loading="lazy"]');
      
      const imageObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            const img = entry.target;
            if (img.dataset.src) {
              img.src = img.dataset.src;
            }
            img.classList.add('loaded');
            observer.unobserve(img);
          }
        });
      }, {
        rootMargin: '50px 0px',
        threshold: 0.01
      });

      lazyImages.forEach(function(img) {
        imageObserver.observe(img);
      });
    } else {
      // Intersection Observer 미지원 시 즉시 로드
      const lazyImages = document.querySelectorAll('img[loading="lazy"]');
      lazyImages.forEach(function(img) {
        if (img.dataset.src) {
          img.src = img.dataset.src;
        }
        img.classList.add('loaded');
      });
    }
  }

  // 성능 측정 (개발용)
  if (window.performance && window.performance.timing) {
    window.addEventListener('load', function() {
      setTimeout(function() {
        const timing = window.performance.timing;
        const pageLoadTime = timing.loadEventEnd - timing.navigationStart;
        const domContentLoaded = timing.domContentLoadedEventEnd - timing.navigationStart;
        
        // 콘솔에 성능 정보 출력 (프로덕션에서는 제거 가능)
        if (console && console.log) {
          console.log('페이지 로드 시간:', pageLoadTime + 'ms');
          console.log('DOM 로드 시간:', domContentLoaded + 'ms');
        }
      }, 0);
    });
  }
})();
