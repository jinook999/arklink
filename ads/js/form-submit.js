/**
 * 폼 제출 처리 모듈
 * 요구사항 7.4: 제출 성공 시 확인 메시지 표시
 * 요구사항 7.6: 데이터 서버 저장 또는 이메일 전송
 */

const FormSubmit = {
  // FormSubmit 서비스 엔드포인트
  FORMSUBMIT_URL: 'https://formsubmit.co/ajax/channel@arklink.co.kr',
  MARKETING_URL: 'https://formsubmit.co/ajax/marketing@arklink.co.kr',
  
  // 제출 상태
  isSubmitting: false,

  /**
   * 폼 초기화
   */
  init: function() {
    const form = document.getElementById('inquiryForm');
    if (form) {
      form.addEventListener('submit', this.handleSubmit.bind(this));
      
      // 실시간 유효성 검사
      this.setupRealtimeValidation(form);
    }
  },

  /**
   * 실시간 유효성 검사 설정
   */
  setupRealtimeValidation: function(form) {
    const nameField = form.querySelector('#name');
    const contactField = form.querySelector('#contact');
    const privacyField = form.querySelector('#privacyAgreed');

    if (nameField) {
      nameField.addEventListener('blur', function() {
        if (!FormValidation.isNotEmpty(this.value)) {
          FormValidation.showError('name', '이름을 입력해주세요.');
        } else {
          FormValidation.clearError('name');
        }
      });
    }

    if (contactField) {
      contactField.addEventListener('blur', function() {
        if (!FormValidation.isNotEmpty(this.value)) {
          FormValidation.showError('contact', '연락처를 입력해주세요.');
        } else if (!FormValidation.isValidContact(this.value)) {
          FormValidation.showError('contact', '올바른 전화번호 또는 이메일을 입력해주세요.');
        } else {
          FormValidation.clearError('contact');
        }
      });
    }

    if (privacyField) {
      privacyField.addEventListener('change', function() {
        if (!this.checked) {
          FormValidation.showError('privacy', '개인정보 처리방침에 동의해주세요.');
        } else {
          FormValidation.clearError('privacy');
        }
      });
    }
  },

  /**
   * 폼 제출 핸들러
   */
  handleSubmit: async function(event) {
    event.preventDefault();

    if (this.isSubmitting) {
      return;
    }

    const form = event.target;
    const formData = FormValidation.getFormData(form);
    
    // 유효성 검사
    FormValidation.clearAllErrors();
    const validation = FormValidation.validateForm(formData);

    if (!validation.isValid) {
      this.displayValidationErrors(validation.errors);
      return;
    }

    // 제출 시작
    this.setSubmitting(true);

    try {
      const result = await this.submitForm(formData);
      
      if (result.success) {
        this.showSuccessMessage();
      } else {
        this.showErrorMessage(result.error);
      }
    } catch (error) {
      console.error('폼 제출 오류:', error);
      this.showErrorMessage('네트워크 오류가 발생했습니다.');
    } finally {
      this.setSubmitting(false);
    }
  },

  /**
   * 유효성 검사 오류 표시
   */
  displayValidationErrors: function(errors) {
    if (errors.name) {
      FormValidation.showError('name', errors.name);
    }
    if (errors.contact) {
      FormValidation.showError('contact', errors.contact);
    }
    if (errors.privacy) {
      FormValidation.showError('privacy', errors.privacy);
    }
  },

  /**
   * 제출 상태 설정
   */
  setSubmitting: function(isSubmitting) {
    this.isSubmitting = isSubmitting;
    const submitBtn = document.querySelector('.btn-submit');
    
    if (submitBtn) {
      submitBtn.disabled = isSubmitting;
      submitBtn.classList.toggle('loading', isSubmitting);
      submitBtn.textContent = isSubmitting ? '' : '상담 신청하기';
    }
  },

  /**
   * 폼 데이터 서버로 전송 (hidden form POST 방식 - CORS 우회)
   */
  submitForm: async function(formData) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'https://formsubmit.co/channel@arklink.co.kr';
    form.style.display = 'none';

    const fields = {
      name: formData.name,
      contact: formData.contact,
      damageType: formData.damageType || '미선택',
      message: formData.message || '내용 없음',
      submittedAt: new Date().toISOString(),
      _subject: '[아크링크] 새로운 상담 신청',
      _template: 'table',
      _cc: 'marketing@arklink.co.kr',
      _next: window.location.origin + '/ads/complete'
    };

    Object.keys(fields).forEach(function(key) {
      var input = document.createElement('input');
      input.type = 'hidden';
      input.name = key;
      input.value = fields[key];
      form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();

    // form.submit()은 페이지를 이동시키므로 여기 이후 코드는 실행되지 않음
    return { success: true };
  },

  /**
   * 성공 메시지 표시
   */
  showSuccessMessage: function() {
    window.location.href = '/ads/complete';
  },

  /**
   * 오류 메시지 표시
   */
  showErrorMessage: function(message) {
    const errorMessage = document.getElementById('errorMessage');
    
    if (errorMessage) {
      const errorText = errorMessage.querySelector('p:first-child');
      if (errorText && message) {
        errorText.textContent = message;
      }
      errorMessage.style.display = 'block';
    }
  },

  /**
   * 오류 메시지 숨기기
   */
  hideErrorMessage: function() {
    const errorMessage = document.getElementById('errorMessage');
    if (errorMessage) {
      errorMessage.style.display = 'none';
    }
  },

  /**
   * 폼 리셋 (다시 작성하기)
   */
  resetForm: function() {
    const form = document.getElementById('inquiryForm');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');

    if (form) {
      form.reset();
      form.style.display = 'block';
      FormValidation.clearAllErrors();
    }
    if (successMessage) {
      successMessage.style.display = 'none';
    }
    if (errorMessage) {
      errorMessage.style.display = 'none';
    }
  }
};

// DOM 로드 후 초기화
document.addEventListener('DOMContentLoaded', function() {
  FormSubmit.init();
});

// 전역으로 내보내기
if (typeof window !== 'undefined') {
  window.FormSubmit = FormSubmit;
}

// Node.js 환경에서 모듈 내보내기 (테스트용)
if (typeof module !== 'undefined' && module.exports) {
  module.exports = FormSubmit;
}
