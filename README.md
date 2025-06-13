# 하루 한문제 알고리즘 학습 플랫폼

이 웹사이트는 GCP 서버 위에서 운영되며, 알고리즘 학습을 위한 다양한 도구를 제공합니다. 사용자 로그인 기반으로 solved.ac 데이터를 연동하고, 문제 추천 및 자료구조 시각화, 수도코드 작성 기능까지 통합된 학습 환경을 제공합니다.

## 🚀 주요 기능

### ✅ 1. 사용자 로그인 / 회원가입
- PHP + MySQL 기반 로그인 및 회원가입
- 백준 ID 입력 시 solved.ac 데이터 연동

### ✅ 2. solved.ac 기반 문제 추천
- 사용자 solved.ac 티어에 맞는 난이도 자동 계산
- solved 문제 제외 필터링
- 추후 태그 선택 추천 확장 가능

### ✅ 3. 자료구조 그래프 시각화 툴 (`graph.php`)
- vis-network 기반 그래프 편집기
- 기능:
  - 노드 추가 / 삭제 (토글 모드)
  - 엣지 연결 (방향성 + 가중치 설정)
  - 간선 삭제 (토글 모드)
  - Reset All
- 반응형 레이아웃 + 툴바 가로 정렬 완성형 UI

### ✅ 4. 수도코드 작성기 (`pseudocode.php`)
- textarea 기반 수도코드 입력
- 클립보드 복사 버튼 제공
- 추후 저장/불러오기 기능 확장 가능

## 🌐 배포 환경

- 서버: Google Cloud Platform (GCP) Ubuntu VM
- 웹 서버: Apache2
- DB: MySQL
- 언어: PHP


## 📌 향후 추가 예정

- 그래프 저장/불러오기 (JSON)
- PNG 캡쳐 기능
- 수도코드 저장 기능
- 트리/링크드 리스트 전용 모드
-  HTTPS 적용
-  현재 solved.ac에서 최근 푼 문제가 불러오는것이 불가능해서 외부 db에 사용자 데이터 저장해서 처리 
  
---
## 접속 주소: http://34.22.99.197/solved_web/login.php
> Powered by GCP + PHP + solved.ac API + vis-network.js
