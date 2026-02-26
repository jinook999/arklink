/**
 * 상단 간편 상담 폼 처리
 */

(function() {
  'use strict';

  function initQuickForm() {
    const form = document.getElementById('quickInquiryForm');
    if (!form) return;

    form.addEventListener('submit', handleQuickSubmit);
  }

  async function handleQuickSubmit(event) {
    event.preventDefault();
    
    const form = event.target;
    const name = form.querySelector('#quick-name').value.trim();
    const contact = form.querySelector('#quick-contact').value.trim();
    const damageType = form.querySelector('#quick-damageType').value;
    const privacy = form.querySelector('#quick-privacy').checked;

    // 유효성 검사
    if (!name) {
      alert('이름을 입력해주세요.');
      form.querySelector('#quick-name').focus();
      return;
    }

    if (!contact) {
      alert('연락처를 입력해주세요.');
      form.querySelector('#quick-contact').focus();
      return;
    }

    if (!privacy) {
      alert('개인정보 수집 및 이용에 동의해주세요.');
      return;
    }

    // 제출 버튼 비활성화
    const submitBtn = form.querySelector('.banner-btn');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '신청 중...';

    try {
      // FormSubmit으로 전송
      const response = await fetch('https://formsubmit.co/ajax/channel@arklink.co.kr', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          name: name,
          contact: contact,
          damageType: damageType || '미선택',
          message: '내용 없음',
          type: '간편상담',
          submittedAt: new Date().toISOString(),
          _subject: '[아크링크] 간편 상담 신청',
          _template: 'table'
        })
      });

      if (response.ok) {
        // 신청완료 페이지로 이동
        window.location.href = '/ads/complete';
      } else {
        throw new Error('서버 오류');
      }
    } catch (error) {
      alert('신청 중 오류가 발생했습니다.\n전화로 문의해주세요: 1666-5706');
    } finally {
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;
    }
  }

  // DOM 로드 후 초기화
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initQuickForm);
  } else {
    initQuickForm();
  }
})();
