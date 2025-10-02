<?php
require_once __DIR__ . "/../src/TaskCollection.php";
require_once __DIR__ . "/../src/Task.php";

$storage = __DIR__ . "/../storage/tasks.db";
if(!file_exists($storage)) file_put_contents($storage, '[]');
$tasks = new TaskCollection($storage);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if(str_starts_with($uri,'/api')){
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];
    $data = json_decode(file_get_contents('php://input'), true) ?? [];

    // GET all
    if($method==='GET' && $uri==='/api/tasks'){
        echo json_encode($tasks->all());
        exit;
    }
    // POST add
    if($method==='POST' && $uri==='/api/tasks'){
        $tasks->add(new Task($data['title'] ?? ''));
        echo json_encode(['status'=>'ok']);
        exit;
    }
    // POST toggle
    if(preg_match('#^/api/tasks/([^/]+)/toggle$#',$uri,$m)){
        $tasks->toggle($m[1]);
        echo json_encode(['status'=>'ok']);
        exit;
    }
    // DELETE
    if(preg_match('#^/api/tasks/([^/]+)$#',$uri,$m) && $method==='DELETE'){
        $tasks->delete($m[1]);
        echo json_encode(['status'=>'ok']);
        exit;
    }
    // PATCH update title
    if(preg_match('#^/api/tasks/([^/]+)$#',$uri,$m) && $method==='PATCH'){
        $tasks->updateTitle($m[1], $data['title'] ?? '');
        echo json_encode(['status'=>'ok']);
        exit;
    }
    // POST reorder
    if($uri==='/api/tasks/reorder' && $method==='POST'){
        $tasks->reorder($data['order'] ?? []);
        echo json_encode(['status'=>'ok']);
        exit;
    }

    http_response_code(404);
    echo json_encode(['status'=>'error']);
    exit;
}

// Default: serve HTML UI
?><!DOCTYPE html>
<html>
<head>
<title>To-Do List</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{font-family:sans-serif;background:#f4f4f6;margin:0;padding:20px;}
h1{text-align:center;}
.container{max-width:600px;margin:auto;background:#fff;padding:20px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.1);}
.task{display:flex;align-items:center;justify-content:space-between;padding:10px;margin:8px 0;background:#f9f9f9;border-radius:8px;cursor:grab;}
.task.completed span{text-decoration:line-through;color:gray;}
.task span{flex:1;cursor:text;}
.buttons button{margin-left:8px;border:none;border-radius:6px;padding:6px 10px;cursor:pointer;}
.buttons .toggle{background:#4caf50;color:white;}
.buttons .delete{background:#e74c3c;color:white;}
#newTask{width:70%;padding:10px;border-radius:8px;border:1px solid #ccc;}
#addBtn{padding:10px 15px;border:none;border-radius:8px;background:#3498db;color:white;cursor:pointer;margin-left:8px;}
#addBtn:hover{background:#2980b9;}
</style>
</head>
<body>
<h1>To-Do List</h1>
<div class="container">
<div>
<input type="text" id="newTask" placeholder="Add new task..."/>
<button id="addBtn">Add</button>
</div>
<div id="taskList"></div>
</div>

<script>
let tasks = [];
const taskList = document.getElementById('taskList');

async function fetchTasks(){
    const res = await fetch('/api/tasks');
    tasks = await res.json();
    renderTasks();
}

function renderTasks(){
    taskList.innerHTML='';
    tasks.forEach(t=>{
        const div = document.createElement('div');
        div.className='task'+(t.completed?' completed':'');
        div.draggable=true;
        div.dataset.id=t.id;
        div.innerHTML=`<input type="checkbox"${t.completed?' checked':''}>
            <span contenteditable="true">${t.title}</span>
            <div class="buttons">
                <button class="toggle">${t.completed?'Undo':'Done'}</button>
                <button class="delete">Delete</button>
            </div>`;
        // events
        const checkbox=div.querySelector('input');
        checkbox.onchange=async ()=>{await fetch('/api/tasks/'+t.id+'/toggle',{method:'POST'});fetchTasks();};
        div.querySelector('.toggle').onclick=async ()=>{await fetch('/api/tasks/'+t.id+'/toggle',{method:'POST'});fetchTasks();};
        div.querySelector('.delete').onclick=async ()=>{await fetch('/api/tasks/'+t.id,{method:'DELETE'});fetchTasks();};
        const span = div.querySelector('span');
        span.onblur=async ()=>{await fetch('/api/tasks/'+t.id,{method:'PATCH',headers:{'Content-Type':'application/json'},body:JSON.stringify({title:span.textContent})});fetchTasks();};
        taskList.appendChild(div);
    });
    enableDragDrop();
}

// Add new task
document.getElementById('addBtn').onclick=async ()=>{
    const title=document.getElementById('newTask').value;
    if(!title)return;
    await fetch('/api/tasks',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({title})});
    document.getElementById('newTask').value='';
    fetchTasks();
};

// Drag & Drop reorder
function enableDragDrop(){
    let dragged=null;
    taskList.querySelectorAll('.task').forEach(task=>{
        task.ondragstart=e=>{dragged=task;e.dataTransfer.effectAllowed='move';};
        task.ondragover=e=>{e.preventDefault();task.style.borderTop='2px solid #3498db';};
        task.ondragleave=e=>{task.style.borderTop='';};
        task.ondrop=async e=>{
            e.preventDefault();
            task.style.borderTop='';
            taskList.insertBefore(dragged, task);
            const order=Array.from(taskList.children).map(d=>d.dataset.id);
            await fetch('/api/tasks/reorder',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({order})});
            fetchTasks();
        };
        task.ondragend=e=>{task.style.borderTop='';};
    });
}

fetchTasks();
</script>
</body>
</html>
