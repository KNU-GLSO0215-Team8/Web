# Contributing to 알고리즘 학습 플랫폼

🙌 환영합니다! 이 프로젝트에 기여해주셔서 감사합니다.

---

## 📦 프로젝트 구조
```
/solved_web/
├── includes/       # 공통 모듈 (DB, 인증, 설정 등)
├── assets/         # CSS, JS 등 정적 파일
├── graph.php       # 자료구조 시각화
├── pseudocode.php  # 수도코드 작성기
└── ...             # 기타 페이지
```

---

## 💡 기여 가이드라인

### 1. 이슈 확인
- 작업 전 Issue 탭에서 중복 확인
- 새로운 아이디어는 먼저 제안해주세요.

### 2. 코드 스타일
- PHP: PSR-12 기준을 지향합니다.
- HTML/CSS/JS: 들여쓰기 2칸, 의미 있는 class 명명
- 파일 경로/URL은 includes/config.php에서 변수로 관리

### 3. 기능 추가 시
- 반드시 기능 설명 주석을 달아주세요
- config.php에 URL 또는 설정 추가 시, 충돌 없는 방식으로 작성해주세요
- 새 페이지 추가 시 dashboard.php에 링크도 꼭 추가해주세요

### 4. 커밋 메시지 스타일
- `[기능] solved.ac 문제 추천 개선`
- `[버그] 로그인 에러 해결`
- `[리팩토링] graph.php 구조 정리`



## 🔐 주의사항

- 개인정보(DB 비밀번호 등) Git에 절대 올리지 마세요
- 인증/보안 관련 로직 변경 시 반드시 리뷰 요청해주세요

---

## ✅ 예시 워크플로우

```bash
# 1. 저장소 포크 & 클론
git clone https://github.com/KNU-GLSO0215-Team8/Web.git

# 2. 브랜치 생성
git checkout -b feat/new-feature

# 3. 코드 작성 및 커밋
git add .
git commit -m "[기능] 새로운 페이지 추가"

# 4. 푸시 후 PR 생성
git push origin feat/new-feature
```

---

감사합니다! 🎉  
이 프로젝트가 많은 사람들의 알고리즘 학습에 도움이 되길 바랍니다!