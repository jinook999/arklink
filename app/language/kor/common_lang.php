<?php
/**
 * System messages translation for CodeIgniter(tm)
 *
 * @author CodeIgniter community
 * @author HyeongJoo Kwon
 * @copyright Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://codeigniter.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/* COMMON */
$lang['inaccessible_pages'] = '접근할 수 없는 페이지입니다.';
$lang['please_try_again'] = '잠시후 다시 시도해주세요.';
$lang['an_error_has_occurred'] = '오류가 발생하였습니다.';


/* MEMBER.CONTROLLER */
$lang['new'] = '새로운';
$lang['confirm'] = '확인';
$lang['prevent_automatic_subscription'] = '자동가입 방지';
$lang['prevent_automatic_does_not_match'] = '%s를 정확히 입력해주세요.';
$lang['already_signed_in'] = '이미 로그인 중입니다.';
$lang['does_not_exist'] = '존재하지 않는 %s입니다.';
$lang['does_not_match'] = '%s가 일치하지 않습니다.';
$lang['member_who_withdrew'] = '이미 탈퇴한 회원입니다.';
$lang['no_member_information_found'] = '회원정보를 찾을 수 없습니다.';
$lang['already_member'] = '이미 가입된 회원입니다.';
$lang['go_to_the_login_page'] = '로그인 페이지로 이동합니다.';
$lang['edit_membership_information'] = '회원정보가 수정되었습니다.';
$lang['change_password'] = '비밀번호가 변경되었습니다.';
$lang['member_withdrawal_processing'] = '회원탈퇴가 처리되었습니다.';
$lang['already_registered'] = '이미 등록된 %s입니다.';
$lang['available'] = '사용 가능한 %s입니다.';
$lang['password_validation'] = '%s는 영어/숫자/특수문자를 2종류 이상 혼용하여 사용해야 합니다.';
$lang['dormant_release_process_fail'] = '휴면해제 처리가 정상적으로 이루어지지 않았습니다.';
$lang['dormant_release_notification_message'] = "%s님의 계정은 휴면상태 계정입니다.\n휴면계정을 해제 후 서비스를 이용할 수 있습니다.\n해제 후 재로그인이 필요합니다. 휴면계정을 해제하시겠습니까?";
$lang['join_under_14'] = '14세 미만 회원가입 시 법정대리인의 동의가 필요합니다. 고객센터로 문의해주세요.';
$lang['not_category_information_found'] = "카테고리의 정보를 찾을 수 없습니다.";


/* BOARD.CONTROLLER */
$lang['board_mode'] = '호출타입';
$lang['board_title'] = '제목';
$lang['board_name'] = '작성자';
$lang['board_content'] = '내용';
$lang['board_password'] = '비밀번호';
$lang['board_is_secret'] = '비밀글 추가';
$lang['board_file'] = '파일첨부';
$lang['board_no'] = '게시글번호';
$lang['board_idx'] = '게시글';
$lang['board_email'] = '이메일';
$lang['board_mobile'] = '휴대폰';
$lang['board_video_url'] = '동영상 주소';
$lang['board_answer_title'] = '답변제목';
$lang['board_answer_content'] = '답변내용';
$lang['no_information_found_in_the_post'] = '게시글의 정보를 찾을 수 없습니다.';
$lang['password_does_not_match'] = '비밀번호가 일치하지 않습니다.';
$lang['add_comment'] = '댓글을 등록하였습니다.';
$lang['modify_comment'] = '댓글을 수정하였습니다.';
$lang['delete_comment'] = '댓글을 삭제하였습니다.';
$lang['failed_to_delete_post'] = '게시글의 삭제를 실패하였습니다.';
$lang['could_not_write'] = '글을 작성하지 못 하였습니다.';
$lang['delete_post'] = '게시글을 삭제하였습니다.';
$lang['no_bulletin_board_information_found'] = '게시판의 정보를 찾을 수 없습니다.';
$lang['failed_to_comment'] = '댓글 작성에 실패하였습니다.';
$lang['comment_modify_failed'] = '댓글 수정이 실패하였습니다.';
$lang['do_not_have_permission'] = '권한이 없습니다.';
$lang['could_not_find_information_in_the_comment'] = '댓글의 정보를 찾지 못 하였습니다.';
$lang['inquiry_is_registered'] = '문의가 등록되었습니다.';
$lang['inquiry_is_registered02'] = '피해 진단 입력이 완료 되었습니다.';
$lang['do_no_have_is_secret_permission'] = '비밀글을 열람할 권한이 없습니다.';
$lang['wrong_approach'] = "잘못된 접근입니다.";

/* GOODS.CONTROLLER */
$lang['could_not_get_the_goods_information'] = '상품정보를 가져오지 못 했습니다.';
$lang['category_permission_denied'] = "해당 카테고리에 대한 접근권한이 없습니다.";


/* FILEREQUEST.CONTROLLER */
$lang['filerequest_folder'] =  '파일업로드경로';
$lang['filerequest_type'] = '파일확장자';
$lang['filerequest_size'] = '파일사이즈';
$lang['filerequest_width'] = '파일크기';
$lang['filerequest_height'] = '파일크기';
$lang['filerequest_file_name'] = '파일명';
$lang['no_files_selected'] = '선택된 파일이 없습니다.';
$lang['no_file_information_to_download'] = '다운로드할 파일정보가 없습니다.';
$lang['no_files_to_download'] = '다운로드할 파일 없습니다.';
$lang['file_can_not_be_downloaded'] = '다운로드할 수 없는 파일입니다.';
$lang['upload_path_cannot_be_uploaded'] = '이 경로는 업로드 할 수 없습니다.';
$lang['download_path_cannot_be_downloaded'] = '이 경로는 다운로드 할 수 없습니다.';
$lang['download_path_does_not_exist'] = '다운로드 경로가 존재하지 않습니다.';
$lang['upload_size_over_php'] = '허용된 파일 크기(%smb)를 초과하였습니다.';
$lang['file_name_is_required'] = '파일명은 필수 입니다.';
$lang['no_files_on_the_route'] = '해당 경로에 파일이 존재하지 않습니다.';
