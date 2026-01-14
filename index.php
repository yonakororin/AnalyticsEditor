<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: http://localhost:8001/?redirect_uri=http://localhost:8002/callback.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visual SQL Builder</title>
    <link rel="stylesheet" href="style.css">
    <!-- Google Fonts for premium feel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>

</head>

<body>
    <header style="height: 60px; background: var(--header-bg); border-bottom: 1px solid var(--node-border); display: flex; align-items: center; justify-content: space-between; padding: 0 20px; z-index: 200; position: relative;">
        <div style="display: flex; align-items: center; gap: 15px;">
            <div onclick="document.getElementById('sidebar').classList.toggle('open')" style="cursor:pointer; font-size:24px; color:white;">&#9776;</div>
            <h1 style="font-size: 1.2rem; margin: 0; color: var(--text-color);">Visual SQL Builder</h1>
        </div>
        <div class="user-dropdown">
            <div class="user-btn">
                <span style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">User:</span>
                <strong><?= htmlspecialchars($_SESSION['user']) ?></strong>
                <span style="font-size: 0.8rem;">▼</span>
            </div>
            <div class="dropdown-content">
                <a href="http://localhost:8001/change_password.php?redirect_uri=http://localhost:8002/">Change Password</a>
                <a href="logout.php" style="color: #f87171;">Logout</a>
            </div>
        </div>
    </header>

    <div id="sidebar">
        <h3>Nodes</h3>

        <div class="node-btn" onclick="app.addNode('table')">Table Source</div>
        <div class="node-btn" onclick="app.addNode('file')">File Source</div>
        <div class="node-btn" onclick="app.addNode('query')">SQL Query</div>
        <div class="node-btn" onclick="app.addNode('join')">Filtering Node</div>
        <div class="node-btn" onclick="app.addNode('display')">Results View</div>
        <hr style="border-color: var(--node-border); width: 100%;">
        <div class="node-btn" onclick="app.clear()">Clear Graph</div>
        <div class="node-btn" onclick="new DbBrowserModal()">DB Browser</div>
        <div class="node-btn" style="color: #f87171;" onclick="app.cleanup()">Cleanup Cache</div>
        <div style="margin-top:20px; border-top:1px solid #444; padding-top:10px;">
            <div style="margin-bottom: 10px;">
                <label for="font-size-select"
                    style="font-size: 0.8em; color: #aaa; display: block; margin-bottom: 4px;">Font Size</label>
                <select id="font-size-select" onchange="app.setFontSize(this.value)"
                    style="width: 100%; background: #252526; color: #eee; border: 1px solid #444; padding: 4px; border-radius: 4px;">
                    <option value="14px">Small</option>
                    <option value="16px" selected>Normal</option>
                    <option value="18px">Large</option>
                    <option value="20px">Extra Large</option>
                </select>
            </div>
            <div style="margin-bottom: 10px;">
                <label for="theme-select"
                    style="font-size: 0.8em; color: #aaa; display: block; margin-bottom: 4px;">Theme</label>
                <select id="theme-select" onchange="app.setTheme(this.value)"
                    style="width: 100%; background: #252526; color: #eee; border: 1px solid #444; padding: 4px; border-radius: 4px;">
                    <option value="default" selected>Default (Slate)</option>
                    <option value="midnight">Midnight (Indigo)</option>
                    <option value="forest">Forest (Teal)</option>
                    <option value="sunset">Sunset (Rose)</option>
                    <option value="retro">Retro (One Dark)</option>
                    <option value="light">Light (Slate)</option>
                </select>
            </div>
            <button id="save-btn" style="width:100%; margin-bottom:5px; background:#444; color:white;">Save
                Graph</button>
            <button id="load-btn" style="width:100%; margin-bottom:5px; background:#444; color:white;">Load
                Graph</button>
            <button id="explain-btn"
                style="width:100%; margin-bottom:5px; background:#0ea5e9; color:white; font-weight:bold;">Show
                Explanation</button>
            <button id="help-btn" style="width:100%; background:#8b5cf6; color:white; font-weight:bold;"
                onclick="new ReadmeModal()">Show Help</button>
        </div>
    </div>

    <div id="canvas-container">
        <div class="screen-title-container"
            style="position: absolute; top: 20px; right: 20px; display:flex; flex-direction:column; align-items:flex-end; pointer-events: none; z-index: 100;">
            <div style="display:flex; align-items:center; gap:10px; pointer-events: auto;">
                <div id="current-file" class="screen-title">Unsaved</div>
                <button id="edit-info-btn"
                    style="background:rgba(0,0,0,0.6); color:white; border:1px solid rgba(148,163,184,0.2); border-radius:4px; cursor:pointer; padding:5px 8px;">✏️</button>
            </div>
            <div id="graph-description"
                style="color:rgba(255,255,255,0.7); font-size:0.9em; margin-top:5px; background:rgba(0,0,0,0.6); padding:5px; border-radius:4px; display:none; max-width: 300px; text-align:right;">
            </div>
        </div>
        <div id="nodes-layer"></div>
        <svg class="connections" id="connections-layer" style="z-index: 100; pointer-events: none;"></svg>
    </div>

    <script type="module" src="script.js"></script>
</body>

</html>
