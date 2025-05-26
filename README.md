# 하루한문제 WEB FrontEnd 레포지토리

이 레포지토리는 하루한문제 프로젝트의 프론트엔드를 담당하고 있는 레포지토리입니다.

## 🌐 배포 환경

- 서버: Google Cloud Platform (GCP) Ubuntu VM
- 웹 서버: Apache2
- DB: MySQL
- 언어: PHP

## 🔒 HTTPS 적용

1. 무료 도메인 연결 (Freenom 또는 DuckDNS)
2. Certbot 설치 및 인증서 발급
3. Apache 자동 HTTPS 리디렉션 + SSL 인증서 자동 갱신 cron 설정

## 📁 주요 파일 구조

```
/solved_web/
├── index.php
├── login.php / register.php / logout.php
├── dashboard.php
├── mypage.php
├── recommend.php
├── graph.php  # 자료구조 시각화
├── pseudocode.php  # 수도코드 작성기
├── includes/
│   ├── db.php
│   └── auth.php
├── assets/
│   └── style.css
```

## 📌 향후 추가 예정

- 그래프 저장/불러오기 (JSON)
- PNG 캡쳐 기능
- 수도코드 저장 기능
- 트리/링크드 리스트 전용 모드

---

> Powered by GCP + PHP + solved.ac API + vis-network.js
