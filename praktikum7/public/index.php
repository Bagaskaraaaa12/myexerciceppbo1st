<?php
// public/index.php
declare(strict_types=1);
require_once __DIR__ . '/../TaskCollection.php';
require_once __DIR__ . '/../Task.php';

// storage file
$storage = __DIR__ . '/../storage/tasks.db';
if (!is_dir(dirname($storage))) mkdir(dirname($storage), 0755, true);
if (!file_exists($storage)) file_put_contents($storage, ''); // create if missing

$collection = new TaskCollection($storage);

// Simple router for API
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if (str_starts_with($uri, '/api')) {
    header('Content-Type: application/json; charset=utf-8');
    // parse segments
    $parts = array_values(array_filter(explode('/', $uri)));
    // parts[0] == 'api'
    try {
        // GET /api/tasks
        if ($method === 'GET' && $uri === '/api/tasks') {
            $data = array_map(fn($t) => $t->toArray(), $collection->all());
            echo json_encode(['ok' => true, 'tasks' => $data]);
            exit;
        }

        // POST /api/tasks  -- create
        if ($method === 'POST' && $uri === '/api/tasks') {
            $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $title = trim((string)($input['title'] ?? ''));
            if ($title === '') throw new Exception('title required', 400);
            $task = new Task($title);
            $task = $collection->add($task);
            echo json_encode(['ok' => true, 'task' => $task->toArray()], JSON_UNESCAPED_SLASHES);
            exit;
        }

        // PUT /api/tasks/{id}  -- update (title)
        if (($method === 'PUT' || $method === 'PATCH') && preg_match('#^/api/tasks/(\d+)$#', $uri, $m)) {
            $id = (int)$m[1];
            $task = $collection->find($id);
            if (!$task) throw new Exception('not found', 404);
            $input = json_decode(file_get_contents('php://input'), true) ?? [];
            if (isset($input['title'])) $task->setTitle((string)$input['title']);
            if (isset($input['done'])) { if ($input['done']) $task->toggleDone(); else { /* set explicit false - toggle only if current true */ if ($task->isDone()) $task->toggleDone(); } }
            $collection->update($task);
            echo json_encode(['ok' => true, 'task' => $task->toArray()]);
            exit;
        }

        // POST /api/tasks/{id}/toggle  -- toggle done
        if ($method === 'POST' && preg_match('#^/api/tasks/(\d+)/toggle$#', $uri, $m)) {
            $id = (int)$m[1];
            $task = $collection->find($id);
            if (!$task) throw new Exception('not found', 404);
            $task->toggleDone();
            $collection->update($task);
            echo json_encode(['ok' => true, 'task' => $task->toArray()]);
            exit;
        }

        // DELETE /api/tasks/{id}
        if ($method === 'DELETE' && preg_match('#^/api/tasks/(\d+)$#', $uri, $m)) {
            $id = (int)$m[1];
            $ok = $collection->delete($id);
            echo json_encode(['ok' => $ok]);
            exit;
        }

        // fallback
        http_response_code(404);
        echo json_encode(['ok' => false, 'error' => 'Unknown API route']);
        exit;
    } catch (Exception $e) {
        http_response_code((int)($e->getCode() >= 400 ? $e->getCode() : 400));
        echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
        exit;
    }
}

// If not API, serve the single-page UI
$initialTasks = json_encode(array_map(fn($t) => $t->toArray(), $collection->all()), JSON_UNESCAPED_SLASHES);
?><!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Notion-style To-Do — Praktikum7</title>
  <style>
    /* === Basic Notion-like UI styles === */
    :root{
      --bg:#f6f7fb;
      --card:#ffffff;
      --muted:#8a8f98;
      --accent:#4f46e5;
      --accent-600:#4338ca;
      --done:#10b981;
      --shadow: 0 6px 20px rgba(15,23,42,0.06);
      --glass: linear-gradient(135deg, rgba(255,255,255,0.85), rgba(250,250,255,0.85));
    }
    *{box-sizing:border-box;font-family: Inter, ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial}
    html,body{height:100%;background:var(--bg);margin:0}
    .app{display:flex;height:100vh;gap:24px;padding:28px}
    /* sidebar */
    .sidebar{width:260px;background:var(--card);border-radius:12px;padding:18px;box-shadow:var(--shadow);display:flex;flex-direction:column;gap:12px}
    .brand{font-weight:700;color:var(--accent);font-size:18px}
    .section-title{font-size:12px;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em}
    .nav{display:flex;flex-direction:column;gap:8px;margin-top:8px}
    .nav a{padding:10px;border-radius:8px;text-decoration:none;color:#222;display:flex;align-items:center;gap:8px}
    .nav a:hover{background:#f3f4ff}
    .create-btn{display:inline-flex;align-items:center;gap:8px;background:var(--accent);color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:600;box-shadow: 0 6px 18px rgba(79,70,229,0.12)}
    /* main */
    .main{flex:1;display:flex;flex-direction:column;gap:18px}
    .topbar{display:flex;justify-content:space-between;align-items:center}
    .search{flex:1;max-width:540px;padding:10px;border-radius:10px;border:1px solid #e8e8ef;background:#fff}
    .board{display:grid;grid-template-columns: repeat(auto-fill,minmax(260px,1fr));gap:16px}
    .card{background:var(--card);padding:14px;border-radius:12px;box-shadow:var(--shadow);min-height:120px;display:flex;flex-direction:column;gap:10px;position:relative;transition:transform .12s ease, box-shadow .12s}
    .card:hover{transform:translateY(-6px)}
    .task-title{font-weight:600;font-size:15px}
    .task-meta{font-size:12px;color:var(--muted)}
    .task-actions{display:flex;gap:8px;margin-top:auto;align-items:center}
    .btn-ghost{background:transparent;border:none;padding:6px 8px;border-radius:8px;cursor:pointer}
    .btn-ghost:hover{background:#f3f4ff}
    .done-badge{padding:6px 8px;border-radius:999px;background:rgba(16,185,129,0.12);color:var(--done);font-weight:600;font-size:12px}
    /* inline edit */
    .title-input{width:100%;padding:8px;border-radius:8px;border:1px solid #e6e7ee}
    /* empty */
    .empty{padding:28px;text-align:center;color:var(--muted)}
    /* small responsive */
    @media (max-width:880px){
      .sidebar{display:none}
      .app{padding:12px}
    }
  </style>
</head>
<body>
  <div class="app">
    <aside class="sidebar" aria-label="Sidebar">
      <div style="display:flex;justify-content:space-between;align-items:center">
        <div>
          <div class="brand">Praktikum 7 — Notion ToDo</div>
          <div style="font-size:13px;color:var(--muted)">Project & Tasks</div>
        </div>
      </div>

      <div>
        <div class="section-title">Pages</div>
        <nav class="nav" aria-label="pages">
          <a href="/index.php">Home</a>
          <a href="/praktikum7/public/index.php" style="font-weight:600;color:var(--accent)">Praktikum 7</a>
        </nav>
      </div>

      <div style="margin-top:auto">
        <a class="create-btn" id="btnNew">+ New Task</a>
        <div style="margin-top:10px;font-size:12px;color:var(--muted)">Tip: Double-click title to edit inline</div>
      </div>
    </aside>

    <main class="main" role="main">
      <div class="topbar">
        <div style="display:flex;gap:12px;align-items:center">
          <h2 style="margin:0">My Tasks</h2>
          <div style="color:var(--muted)">— organized like pages</div>
        </div>

        <div style="display:flex;gap:12px;align-items:center">
          <input class="search" id="q" placeholder="Search tasks or press 'n' to add" />
        </div>
      </div>

      <section id="board" class="board" aria-live="polite">
        <!-- cards injected here -->
      </section>

      <div id="empty" class="empty" style="display:none">
        <p>No tasks yet. Create your first task with the <strong>New Task</strong> button.</p>
      </div>
    </main>
  </div>

<script>
/* ===== Frontend app (vanilla JS) ===== */
const endpoint = '/api/tasks';
let tasks = <?php echo $initialTasks; ?> || [];

const board = document.getElementById('board');
const emptyEl = document.getElementById('empty');
const q = document.getElementById('q');
const btnNew = document.getElementById('btnNew');

function render(){
  board.innerHTML = '';
  if (!tasks.length) { emptyEl.style.display = 'block'; return; } else { emptyEl.style.display = 'none'; }

  // filter from search
  const term = q.value.trim().toLowerCase();

  tasks.filter(t => !term || t.title.toLowerCase().includes(term)).forEach(t => {
    const card = document.createElement('article');
    card.className = 'card';
    card.dataset.id = t.id;

    const title = document.createElement('div');
    title.className = 'task-title';
    title.textContent = t.title;
    title.title = 'Double-click to edit';
    title.style.cursor = 'text';

    // inline editing
    title.ondblclick = () => {
      const input = document.createElement('input');
      input.className = 'title-input';
      input.value = t.title;
      input.onkeydown = (e) => {
        if (e.key === 'Enter') { input.blur(); }
        if (e.key === 'Escape') { input.value = t.title; input.blur(); }
      };
      input.onblur = async () => {
        const v = input.value.trim();
        if (v && v !== t.title) {
          await updateTask(t.id, { title: v });
        }
        renderAll();
      };
      title.replaceWith(input);
      input.focus();
      // place caret at end
      input.setSelectionRange(input.value.length, input.value.length);
    };

    const meta = document.createElement('div');
    meta.className = 'task-meta';
    meta.innerHTML = `Created: ${new Date(t.createdAt).toLocaleString()}` + (t.updatedAt ? ` • Updated: ${new Date(t.updatedAt).toLocaleString()}` : '');

    const actions = document.createElement('div');
    actions.className = 'task-actions';

    const btnToggle = document.createElement('button');
    btnToggle.className = 'btn-ghost';
    btnToggle.innerHTML = t.done ? '<span class="done-badge">Done</span>' : 'Mark done';
    btnToggle.onclick = async () => { await toggleTask(t.id); renderAll(); };

    const btnDelete = document.createElement('button');
    btnDelete.className = 'btn-ghost';
    btnDelete.innerText = 'Delete';
    btnDelete.onclick = async () => { if (confirm('Delete this task?')) { await deleteTask(t.id); renderAll(); } };

    actions.appendChild(btnToggle);
    actions.appendChild(btnDelete);

    card.appendChild(title);
    card.appendChild(meta);
    card.appendChild(actions);

    if (t.done) {
      // subtle style
      card.style.opacity = '0.85';
      title.style.textDecoration = 'line-through';
      title.style.color = '#6b7280';
    }

    board.appendChild(card);
  });
}

async function fetchTasks(){
  try{
    const res = await fetch(endpoint);
    const json = await res.json();
    if (json.ok) tasks = json.tasks;
    else tasks = [];
  }catch(e){ console.error(e); tasks = []; }
}

async function createTask(title){
  const res = await fetch(endpoint, {
    method: 'POST',
    headers: {'Content-Type':'application/json'},
    body: JSON.stringify({ title })
  });
  return res.json();
}

async function updateTask(id, data){
  const res = await fetch(`${endpoint}/${id}`, {
    method: 'PUT',
    headers: {'Content-Type':'application/json'},
    body: JSON.stringify(data)
  });
  return res.json();
}

async function toggleTask(id){
  const res = await fetch(`${endpoint}/${id}/toggle`, { method: 'POST' });
  return res.json();
}

async function deleteTask(id){
  const res = await fetch(`${endpoint}/${id}`, { method: 'DELETE' });
  return res.json();
}

async function renderAll(){
  await fetchTasks();
  render();
}

/* initial render */
renderAll();

/* UI interactions */
btnNew.onclick = async () => {
  const title = prompt('New Task title');
  if (!title) return;
  await createTask(title);
  await renderAll();
};

/* quick add with "n" key and search */
document.addEventListener('keydown', async (e) => {
  if (e.key === 'n' && (document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA')) {
    e.preventDefault();
    btnNew.click();
  }
  if ((e.ctrlKey||e.metaKey) && e.key === 'k') {
    e.preventDefault();
    q.focus();
  }
});

/* realtime search */
q.addEventListener('input', () => render());

</script>
</body>
</html>
