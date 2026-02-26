// 숫자 카운트업 애니메이션
document.addEventListener('DOMContentLoaded', function() {
  const counters = document.querySelectorAll('.stat-number[data-target]');
  
  const formatNumber = (num) => {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  };

  const animateCounter = (counter) => {
    const target = parseFloat(counter.dataset.target);
    const suffix = counter.dataset.suffix || '';
    const decimal = parseInt(counter.dataset.decimal) || 0;
    const duration = 2000;
    const startTime = performance.now();
    
    const updateCounter = (currentTime) => {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);
      const easeOut = 1 - Math.pow(1 - progress, 3);
      const current = target * easeOut;
      
      if (decimal > 0) {
        counter.textContent = current.toFixed(decimal) + suffix;
      } else {
        counter.textContent = formatNumber(Math.floor(current)) + suffix;
      }
      
      if (progress < 1) {
        requestAnimationFrame(updateCounter);
      }
    };
    
    requestAnimationFrame(updateCounter);
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(counter => observer.observe(counter));
});
