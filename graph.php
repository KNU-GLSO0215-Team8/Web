<<<<<<< HEAD
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>자료구조 그래프 에디터</title>
    <link rel="stylesheet" href="assets/style.css">
    <script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        nav {
            background-color: #212529;
            padding: 10px 20px;
            color: white;
            display: flex;
            align-items: center;
        }

        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            color: #0d6efd;
        }

        #toolbar {
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: auto;
            white-space: nowrap;
            background-color: #f8f9fa;
            padding: 5px 10px;
            border-bottom: 1px solid #dee2e6;
        }

        #toolbar button {
            margin: 4px;
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            background-color: #0d6efd;
            color: white;
            cursor: pointer;
            font-size: 11px;
            flex-shrink: 0;
            max-width: 110px;
            white-space: nowrap;
        }

        #toolbar button:hover {
            background-color: #0b5ed7;
        }

        #mynetwork {
            width: 100%;
            height: calc(100vh - 90px); /* nav + toolbar 제외한 화면 전체 */
            background-color: #ffffff;
            border: none;
        }
    </style>
</head>
<body>
<nav>
    <a href="<?php echo $URLS['dashboard']; ?>">Dashboard</a>
    <a href="mypage">내 solved.ac 정보</a>
    <a href="recommand">문제 추천</a>
    <a href="graph">자료구조 시각화</a>
    <a href="<?php echo $URLS['logout']; ?>">로그아웃</a>
</nav>

<div id="toolbar">
    <button onclick="addNode()">노드 추가</button>
    <button id="connectBtn" onclick="toggleConnectMode()">노드 연결</button>
    <button id="weightBtn" onclick="toggleWeightMode()">가중치 OFF</button>
    <button id="directionBtn" onclick="toggleDirectionMode()">방향 ON</button>
    <button id="deleteNodeBtn" onclick="toggleDeleteNodeMode()">노드 삭제 OFF</button>
    <button id="deleteEdgeBtn" onclick="toggleDeleteEdgeMode()">간선 삭제 OFF</button>
    <button onclick="resetAll()">초기화</button>
</div>

<div id="mynetwork"></div>

<script>
    const nodes = new vis.DataSet([]);
    const edges = new vis.DataSet([]);
    let selectedNodes = [];
    let connectMode = false;
    let edgeWeighted = false;
    let edgeDirected = false;
    let deleteNodeMode = false;
    let deleteEdgeMode = false;

    const container = document.getElementById('mynetwork');
    const data = { nodes: nodes, edges: edges };
    const options = {
        manipulation: false,
        physics: true,
        edges: { arrows: { to: { enabled: true } }, font: { align: 'middle' } }
    };
    const network = new vis.Network(container, data, options);

    network.on("selectNode", function(params) {
        if (deleteNodeMode) {
            nodes.remove({ id: params.nodes[0] });
            edges.remove(edge => edge.from === params.nodes[0] || edge.to === params.nodes[0]);
            network.unselectAll();
        } else if (connectMode) {
            selectedNodes.push(params.nodes[0]);
            if (selectedNodes.length === 2) {
                let weight = "1";
                if (edgeWeighted) {
                    weight = prompt("엣지 가중치를 입력하세요:", "1") || "1";
                }
                edges.add({
                    from: selectedNodes[0],
                    to: selectedNodes[1],
                    label: edgeWeighted ? weight : '',
                    arrows: edgeDirected ? 'to' : ''
                });
                selectedNodes = [];
            }
        }
    });

    network.on("selectEdge", function(params) {
        if (deleteEdgeMode) {
            edges.remove(params.edges[0]);
            network.unselectAll();
        }
    });

    function addNode() {
        const label = prompt("노드 이름 입력:");
        if (label) nodes.add({ id: nodes.length + 1 + Math.floor(Math.random() * 1000), label });
    }

    function toggleConnectMode() {
        connectMode = !connectMode;
        deleteNodeMode = deleteEdgeMode = false;
        selectedNodes = [];
        document.getElementById('connectBtn').style.backgroundColor = connectMode ? "#28a745" : "";
        document.getElementById('deleteNodeBtn').style.backgroundColor = "";
        document.getElementById('deleteEdgeBtn').style.backgroundColor = "";
    }

    function toggleWeightMode() {
        edgeWeighted = !edgeWeighted;
        document.getElementById('weightBtn').innerText = edgeWeighted ? "가중치 ON" : "가중치 OFF";
    }

    function toggleDirectionMode() {
        edgeDirected = !edgeDirected;
        document.getElementById('directionBtn').innerText = edgeDirected ? "방향 ON" : "방향 OFF";
    }

    function toggleDeleteNodeMode() {
        deleteNodeMode = !deleteNodeMode;
        deleteEdgeMode = connectMode = false;
        selectedNodes = [];
        document.getElementById('deleteNodeBtn').innerText = deleteNodeMode ? "노드 삭제 ON" : "노드 삭제 OFF";
        document.getElementById('deleteNodeBtn').style.backgroundColor = deleteNodeMode ? "#dc3545" : "";
        document.getElementById('deleteEdgeBtn').style.backgroundColor = "";
        document.getElementById('connectBtn').style.backgroundColor = "";
    }

    function toggleDeleteEdgeMode() {
        deleteEdgeMode = !deleteEdgeMode;
        deleteNodeMode = connectMode = false;
        selectedNodes = [];
        document.getElementById('deleteEdgeBtn').innerText = deleteEdgeMode ? "간선 삭제 ON" : "간선 삭제 OFF";
        document.getElementById('deleteEdgeBtn').style.backgroundColor = deleteEdgeMode ? "#dc3545" : "";
        document.getElementById('deleteNodeBtn').style.backgroundColor = "";
        document.getElementById('connectBtn').style.backgroundColor = "";
    }

    function resetAll() {
        nodes.clear();
        edges.clear();
        selectedNodes = [];
        connectMode = deleteNodeMode = deleteEdgeMode = false;
        document.getElementById('connectBtn').style.backgroundColor = "";
        document.getElementById('deleteNodeBtn').style.backgroundColor = "";
        document.getElementById('deleteEdgeBtn').style.backgroundColor = "";
    }
</script>
</body>
</html>
=======
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>자료구조 그래프 에디터</title>
    <link rel="stylesheet" href="assets/style.css">
    <script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        nav {
            background-color: #212529;
            padding: 10px 20px;
            color: white;
            display: flex;
            align-items: center;
        }

        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            color: #0d6efd;
        }

        #toolbar {
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: auto;
            white-space: nowrap;
            background-color: #f8f9fa;
            padding: 5px 10px;
            border-bottom: 1px solid #dee2e6;
        }

        #toolbar button {
            margin: 4px;
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            background-color: #0d6efd;
            color: white;
            cursor: pointer;
            font-size: 11px;
            flex-shrink: 0;
            max-width: 110px;
            white-space: nowrap;
        }

        #toolbar button:hover {
            background-color: #0b5ed7;
        }

        #mynetwork {
            width: 100%;
            height: calc(100vh - 90px); /* nav + toolbar 제외한 화면 전체 */
            background-color: #ffffff;
            border: none;
        }
    </style>
</head>
<body>
<nav>
    <a href="<?php echo $URLS['dashboard']; ?>">Dashboard</a>
    <a href="mypage">내 solved.ac 정보</a>
    <a href="recommand">문제 추천</a>
    <a href="graph">자료구조 시각화</a>
    <a href="<?php echo $URLS['logout']; ?>">로그아웃</a>
</nav>

<div id="toolbar">
    <button onclick="addNode()">노드 추가</button>
    <button id="connectBtn" onclick="toggleConnectMode()">노드 연결</button>
    <button id="weightBtn" onclick="toggleWeightMode()">가중치 OFF</button>
    <button id="directionBtn" onclick="toggleDirectionMode()">방향 ON</button>
    <button id="deleteNodeBtn" onclick="toggleDeleteNodeMode()">노드 삭제 OFF</button>
    <button id="deleteEdgeBtn" onclick="toggleDeleteEdgeMode()">간선 삭제 OFF</button>
    <button onclick="resetAll()">초기화</button>
</div>

<div id="mynetwork"></div>

<script>
    const nodes = new vis.DataSet([]);
    const edges = new vis.DataSet([]);
    let selectedNodes = [];
    let connectMode = false;
    let edgeWeighted = false;
    let edgeDirected = false;
    let deleteNodeMode = false;
    let deleteEdgeMode = false;

    const container = document.getElementById('mynetwork');
    const data = { nodes: nodes, edges: edges };
    const options = {
        manipulation: false,
        physics: true,
        edges: { arrows: { to: { enabled: true } }, font: { align: 'middle' } }
    };
    const network = new vis.Network(container, data, options);

    network.on("selectNode", function(params) {
        if (deleteNodeMode) {
            nodes.remove({ id: params.nodes[0] });
            edges.remove(edge => edge.from === params.nodes[0] || edge.to === params.nodes[0]);
            network.unselectAll();
        } else if (connectMode) {
            selectedNodes.push(params.nodes[0]);
            if (selectedNodes.length === 2) {
                let weight = "1";
                if (edgeWeighted) {
                    weight = prompt("엣지 가중치를 입력하세요:", "1") || "1";
                }
                edges.add({
                    from: selectedNodes[0],
                    to: selectedNodes[1],
                    label: edgeWeighted ? weight : '',
                    arrows: edgeDirected ? 'to' : ''
                });
                selectedNodes = [];
            }
        }
    });

    network.on("selectEdge", function(params) {
        if (deleteEdgeMode) {
            edges.remove(params.edges[0]);
            network.unselectAll();
        }
    });

    function addNode() {
        const label = prompt("노드 이름 입력:");
        if (label) nodes.add({ id: nodes.length + 1 + Math.floor(Math.random() * 1000), label });
    }

    function toggleConnectMode() {
        connectMode = !connectMode;
        deleteNodeMode = deleteEdgeMode = false;
        selectedNodes = [];
        document.getElementById('connectBtn').style.backgroundColor = connectMode ? "#28a745" : "";
        document.getElementById('deleteNodeBtn').style.backgroundColor = "";
        document.getElementById('deleteEdgeBtn').style.backgroundColor = "";
    }

    function toggleWeightMode() {
        edgeWeighted = !edgeWeighted;
        document.getElementById('weightBtn').innerText = edgeWeighted ? "가중치 ON" : "가중치 OFF";
    }

    function toggleDirectionMode() {
        edgeDirected = !edgeDirected;
        document.getElementById('directionBtn').innerText = edgeDirected ? "방향 ON" : "방향 OFF";
    }

    function toggleDeleteNodeMode() {
        deleteNodeMode = !deleteNodeMode;
        deleteEdgeMode = connectMode = false;
        selectedNodes = [];
        document.getElementById('deleteNodeBtn').innerText = deleteNodeMode ? "노드 삭제 ON" : "노드 삭제 OFF";
        document.getElementById('deleteNodeBtn').style.backgroundColor = deleteNodeMode ? "#dc3545" : "";
        document.getElementById('deleteEdgeBtn').style.backgroundColor = "";
        document.getElementById('connectBtn').style.backgroundColor = "";
    }

    function toggleDeleteEdgeMode() {
        deleteEdgeMode = !deleteEdgeMode;
        deleteNodeMode = connectMode = false;
        selectedNodes = [];
        document.getElementById('deleteEdgeBtn').innerText = deleteEdgeMode ? "간선 삭제 ON" : "간선 삭제 OFF";
        document.getElementById('deleteEdgeBtn').style.backgroundColor = deleteEdgeMode ? "#dc3545" : "";
        document.getElementById('deleteNodeBtn').style.backgroundColor = "";
        document.getElementById('connectBtn').style.backgroundColor = "";
    }

    function resetAll() {
        nodes.clear();
        edges.clear();
        selectedNodes = [];
        connectMode = deleteNodeMode = deleteEdgeMode = false;
        document.getElementById('connectBtn').style.backgroundColor = "";
        document.getElementById('deleteNodeBtn').style.backgroundColor = "";
        document.getElementById('deleteEdgeBtn').style.backgroundColor = "";
    }
</script>
</body>
</html>
>>>>>>> 014391d (Add files via upload)
