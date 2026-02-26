# Arklink - Claude Code Instructions

## 필수 준수 사항

### 1. 한국어 사용
- 한국어로 사고하고, 한국어로 소통할 것

### 2. 프로젝트 정보

| 분류 | 기술 |
|------|------|
| **프레임워크** | CodeIgniter 3.x (PHP) |
| **언어** | PHP 7.x+ |
| **데이터베이스** | MySQL (mysqli 드라이버) |
| **웹서버** | Apache (.htaccess URL 리라이팅) |
| **프로젝트 유형** | 몸캠피싱 해결 전문 기업 웹사이트 |
| **다국어 지원** | 한국어(기본), 영어(en), 일본어(jp), 중국어(cn) |

### 3. 프로젝트 구조

```
arklink/
├── app/                          # CodeIgniter application 디렉토리
│   ├── config/                   # 설정 파일 (database.php, routes.php, cfg_*.php)
│   ├── controllers/              # 컨트롤러 (admin/, cn/, en/, jp/ 하위 포함)
│   │   ├── admin/                # 관리자 컨트롤러
│   │   ├── cn/                   # 중국어 컨트롤러
│   │   ├── en/                   # 영어 컨트롤러
│   │   └── jp/                   # 일본어 컨트롤러
│   ├── models/                   # 모델 (Admin_*, Front_*, 일반)
│   ├── views/                    # 뷰 (admin/ 하위 포함)
│   ├── helpers/                  # 커스텀 헬퍼
│   ├── libraries/                # 커스텀 라이브러리
│   ├── core/                     # Core 확장 (MY_Controller, FRONT_Controller, ADMIN_Controller)
│   ├── hooks/                    # CI 훅 (CodeIgniter 자체 훅)
│   └── language/                 # 다국어 파일 (kor, eng, chn, jpn)
├── system/                       # CodeIgniter 시스템 코어 (수정 금지)
├── lib/                          # 프론트엔드 에셋 (css/, js/, fonts/, images/)
│   ├── admin/                    # 관리자 에셋
│   └── smarteditor2-master/      # WYSIWYG 에디터
├── upload/                       # 업로드 파일 저장소
├── data/                         # 데이터 파일 (메일폼, 스킨)
├── index.php                     # CI 프론트 컨트롤러
└── .htaccess                     # Apache URL 리라이팅
```

### 4. 자동 검증 의무

모든 코드 작업 완료 후:
1. PHP 문법 검증 실행: `php -l [파일경로]`
2. 실패 시 자동 수정 (최대 3회)

### 5. 행동 원칙
- 질문보다 실행 우선
- 오류 발생 시 자체 해결 시도 (최대 3회)
- TodoWrite로 진행 상황 추적

### 6. 코딩 스타일
- CodeIgniter 3 컨벤션 준수
- 모델명: `[기능]_model.php` (예: `Board_model.php`, `Admin_Board_model.php`)
- 컨트롤러명: PascalCase (예: `Board.php`, `Member.php`)
- 뷰 파일은 `app/views/` 하위 디렉토리 구조 유지
- SQL 쿼리는 Active Record(Query Builder) 패턴 사용 권장
- 설정 파일은 `cfg_` 접두사 사용 (기존 패턴 따르기)
- 한국어 주석 허용

### 7. 보안 주의사항
- `database.php`, `cfg_adm_auth.php` 등 인증 정보 포함 파일 절대 커밋 금지
- `.sample.php` 파일로 템플릿만 커밋
- XSS/SQL Injection 방어: CI3 내장 기능 활용 (`$this->input->post()`, `$this->db->escape()` 등)
- `system/` 디렉토리 직접 수정 금지

### 8. Agent Teams 운영
- SSOT 파일 (동시 수정 금지): `app/config/routes.php`, `app/config/autoload.php`, `app/config/config.php`

---

## /autonomous Phase 확장 설정

> autonomous.md의 Phase에서 "CLAUDE.md Phase 확장 참조"라고 나오면 여기를 봅니다.

### Phase 0 확장: 기술문서

| 문서 | 경로 | 용도 |
|------|------|------|
| **프로젝트 규칙** | `CLAUDE.md` (이 파일) | 코딩 컨벤션, 구조 정보 |
| **라우팅 설정** | `app/config/routes.php` | URL → 컨트롤러 매핑 |
| **설정 목록** | `app/config/cfg_*.php` | 사이트 설정, 메뉴, 필드 정의 |

### Phase 0 확장: 섹션 매핑

| 작업 유형 | 참조 섹션 |
|----------|---------|
| 컨트롤러 수정 | 프로젝트 구조 > controllers |
| 모델 수정 | 프로젝트 구조 > models |
| 뷰 수정 | 프로젝트 구조 > views |
| 설정 변경 | 프로젝트 구조 > config |
| 다국어 작업 | 프로젝트 구조 > language |
| 프론트엔드 에셋 | 프로젝트 구조 > lib |
| 관리자 기능 | app/controllers/admin/, app/views/admin/ |

### Phase 2 확장: 파일->문서 매핑

| 수정 영역 | 업데이트 섹션 |
|----------|-------------|
| `app/config/routes.php` | CLAUDE.md > 프로젝트 구조 |
| `app/controllers/` 새 컨트롤러 | CLAUDE.md > 프로젝트 구조 |
| `app/models/` 새 모델 | CLAUDE.md > 프로젝트 구조 |
| 전체 아키텍처 변경 | CLAUDE.md > 프로젝트 정보 |

### Phase 7 확장: 검증 명령어

```bash
# PHP 문법 검증 (변경된 파일만)
git diff --name-only HEAD | grep '\.php$' | xargs -I{} php -l {}

# PHP 문법 검증 (전체)
find /home/arklink/Develop/SERVER/arklink/app -name "*.php" -exec php -l {} \; 2>&1 | grep -v "No syntax errors"
```

**Phase 7 주의사항 (PHP 프로젝트 특화)**:
- `npm test`, `pnpm build` 등 Node.js 명령은 사용하지 않음
- CodeIgniter 3에는 내장 테스트 프레임워크가 없음 → `php -l`이 기본 검증
- 브라우저 검증이 필요한 경우 playwright MCP 활용

### Phase 6.5 확장: 배포

```bash
# Git push (배포 = push)
git push origin master
```
