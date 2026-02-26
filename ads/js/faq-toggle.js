/**
 * FAQ 아코디언 토글 기능
 * 요구사항 8.2: 방문자가 질문을 클릭하면, 랜딩페이지는 답변을 펼쳐서 보여줘야 한다
 */

(function() {
  'use strict';

  /**
   * FAQ 토글 초기화
   */
  function initFAQToggle() {
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    if (faqQuestions.length === 0) {
      return;
    }

    faqQuestions.forEach(function(question) {
      question.addEventListener('click', handleFAQClick);
    });
  }

  /**
   * FAQ 질문 클릭 핸들러
   * @param {Event} event - 클릭 이벤트
   */
  function handleFAQClick(event) {
    const question = event.currentTarget;
    const faqItem = question.closest('.faq-item');
    
    if (!faqItem) {
      return;
    }

    toggleFAQItem(faqItem, question);
  }

  /**
   * FAQ 항목 토글
   * @param {HTMLElement} faqItem - FAQ 항목 요소
   * @param {HTMLElement} question - 질문 버튼 요소
   */
  function toggleFAQItem(faqItem, question) {
    const isActive = faqItem.classList.contains('active');
    const isExpanded = question.getAttribute('aria-expanded') === 'true';

    // 토글 상태 변경
    faqItem.classList.toggle('active');
    question.setAttribute('aria-expanded', !isExpanded);
  }

  // DOM 로드 완료 후 초기화
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initFAQToggle);
  } else {
    initFAQToggle();
  }

  // 외부에서 접근 가능하도록 전역 객체에 추가 (테스트용)
  window.FAQToggle = {
    init: initFAQToggle,
    toggle: toggleFAQItem
  };
})();
