/**
 * 폼 유효성 검사 모듈
 * 요구사항 7.2: 필수 필드 검사 및 연락처 형식 검사
 */

const FormValidation = {
  /**
   * 전화번호 형식 검증
   * 유효한 형식: 010-XXXX-XXXX, 01X-XXX-XXXX, 010XXXXXXXX, 01XXXXXXXXX
   * 속성 2: 연락처 형식 검증 - 요구사항 7.2
   */
  isValidPhone: function(phone) {
    // 공백 제거
    const cleanPhone = phone.replace(/\s/g, '');
    const phonePatterns = [
      /^01[0-9]-\d{3,4}-\d{4}$/,  // 010-1234-5678, 011-123-4567
      /^01[0-9]\d{7,8}$/          // 01012345678, 0111234567
    ];
    return phonePatterns.some(pattern => pattern.test(cleanPhone));
  },

  /**
   * 이메일 형식 검증
   */
  isValidEmail: function(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
  },

  /**
   * 연락처 검증 (전화번호 또는 이메일)
   */
  isValidContact: function(contact) {
    return this.isValidPhone(contact) || this.isValidEmail(contact);
  },

  /**
   * 필수 필드 검증
   */
  isNotEmpty: function(value) {
    return value && value.trim().length > 0;
  },

  /**
   * 폼 전체 유효성 검사
   * @returns {Object} { isValid: boolean, errors: Object }
   */
  validateForm: function(formData) {
    const errors = {};

    // 이름 검증
    if (!this.isNotEmpty(formData.name)) {
      errors.name = '이름을 입력해주세요.';
    }

    // 연락처 검증
    if (!this.isNotEmpty(formData.contact)) {
      errors.contact = '연락처를 입력해주세요.';
    } else if (!this.isValidContact(formData.contact)) {
      errors.contact = '올바른 전화번호 또는 이메일을 입력해주세요.';
    }

    // 개인정보 동의 검증
    if (!formData.privacyAgreed) {
      errors.privacy = '개인정보 처리방침에 동의해주세요.';
    }

    return {
      isValid: Object.keys(errors).length === 0,
      errors: errors
    };
  },

  /**
   * 오류 메시지 표시
   */
  showError: function(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorElement = document.getElementById(fieldId + '-error');
    
    if (field) {
      field.classList.add('error');
    }
    if (errorElement) {
      errorElement.textContent = message;
    }
  },

  /**
   * 오류 메시지 제거
   */
  clearError: function(fieldId) {
    const field = document.getElementById(fieldId);
    const errorElement = document.getElementById(fieldId + '-error');
    
    if (field) {
      field.classList.remove('error');
    }
    if (errorElement) {
      errorElement.textContent = '';
    }
  },

  /**
   * 모든 오류 메시지 제거
   */
  clearAllErrors: function() {
    this.clearError('name');
    this.clearError('contact');
    this.clearError('privacy');
  },

  /**
   * 폼 데이터 수집
   */
  getFormData: function(form) {
    return {
      name: form.querySelector('#name').value,
      contact: form.querySelector('#contact').value,
      damageType: form.querySelector('#damageType').value,
      message: form.querySelector('#message').value,
      privacyAgreed: form.querySelector('#privacyAgreed').checked
    };
  }
};

// 전역으로 내보내기
if (typeof window !== 'undefined') {
  window.FormValidation = FormValidation;
}

// Node.js 환경에서 모듈 내보내기 (테스트용)
if (typeof module !== 'undefined' && module.exports) {
  module.exports = FormValidation;
}
