/**
 * 간편 상담 폼 처리 (상단 배너 + 모바일 모달)
 * FormSubmit 전통 form POST 방식 사용
 */

(function() {
  'use strict';

  var CHANNEL_URL = 'https://formsubmit.co/channel@arklink.co.kr';
  var MARKETING_URL = 'https://formsubmit.co/ajax/marketing@arklink.co.kr';
  var NEXT_URL = 'https://arklink.co.kr/ads/complete';

  function initQuickForm() {
    var form = document.getElementById('quickInquiryForm');
    if (form) form.addEventListener('submit', handleQuickSubmit);

    var modalForm = document.getElementById('modalQuickForm');
    if (modalForm) modalForm.addEventListener('submit', handleModalSubmit);
  }

  /**
   * 숨겨진 form을 생성해서 FormSubmit으로 POST 전송
   * AJAX 대신 전통 방식으로 확실하게 메일 전송
   */
  function submitViaForm(fields, formType) {
    var now = new Date().toISOString();
    var dtype = fields.damageType || '미선택';

    // marketing@ 비동기 전송 (실패 무시)
    try {
      fetch(MARKETING_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify({
          damageType: dtype, message: '내용 없음', submittedAt: now,
          _subject: '[아크링크] 간편 상담 신청', _template: 'table'
        }),
        keepalive: true
      }).catch(function() {});
    } catch(e) {}

    // channel@ 전통 form POST
    var hiddenForm = document.createElement('form');
    hiddenForm.method = 'POST';
    hiddenForm.action = CHANNEL_URL;
    hiddenForm.style.display = 'none';

    var data = {
      name: fields.name,
      contact: fields.contact,
      damageType: dtype,
      message: '내용 없음',
      type: formType,
      submittedAt: now,
      _subject: '[아크링크] 간편 상담 신청',
      _template: 'table',
      _captcha: 'false',
      _next: NEXT_URL
    };

    for (var key in data) {
      var input = document.createElement('input');
      input.type = 'hidden';
      input.name = key;
      input.value = data[key];
      hiddenForm.appendChild(input);
    }

    document.body.appendChild(hiddenForm);
    hiddenForm.submit();
  }

  function handleModalSubmit(event) {
    event.preventDefault();

    var form = event.target;
    var name = form.querySelector('#modal-name').value.trim();
    var contact = form.querySelector('#modal-contact').value.trim();
    var damageType = form.querySelector('#modal-damageType').value;
    var privacy = form.querySelector('#modal-privacy').checked;

    if (!name) { alert('이름을 입력해주세요.'); form.querySelector('#modal-name').focus(); return; }
    if (!contact) { alert('연락처를 입력해주세요.'); form.querySelector('#modal-contact').focus(); return; }
    if (!privacy) { alert('개인정보 수집 및 이용에 동의해주세요.'); return; }

    var submitBtn = form.querySelector('.btn-submit');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '신청 중...';

    submitViaForm({ name: name, contact: contact, damageType: damageType }, '모바일간편상담');
  }

  function handleQuickSubmit(event) {
    event.preventDefault();

    var form = event.target;
    var name = form.querySelector('#quick-name').value.trim();
    var contact = form.querySelector('#quick-contact').value.trim();
    var damageType = form.querySelector('#quick-damageType').value;
    var privacy = form.querySelector('#quick-privacy').checked;

    if (!name) { alert('이름을 입력해주세요.'); form.querySelector('#quick-name').focus(); return; }
    if (!contact) { alert('연락처를 입력해주세요.'); form.querySelector('#quick-contact').focus(); return; }
    if (!privacy) { alert('개인정보 수집 및 이용에 동의해주세요.'); return; }

    var submitBtn = form.querySelector('.banner-btn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '신청 중...';

    submitViaForm({ name: name, contact: contact, damageType: damageType }, '간편상담');
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initQuickForm);
  } else {
    initQuickForm();
  }
})();
