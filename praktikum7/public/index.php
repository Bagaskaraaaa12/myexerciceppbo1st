<?php
require_once __DIR__ . '/../src/Models/NoteCollection.php';
require_once __DIR__ . '/../src/Models/Note.php';

$storage = __DIR__ . '/../storage/notes.db';
if(!file_exists($storage)) file_put_contents($storage,'[]');
$notes = new NoteCollection($storage);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true) ?? [];

if(str_starts_with($uri,'/api')){
    switch($uri){
        case '/api/notes':
            if($_SERVER['REQUEST_METHOD']==='GET'){ echo json_encode(iterator_to_array($notes)); exit; }
            if($_SERVER['REQUEST_METHOD']==='POST'){ $notes->add(new Note($data['title']??'', $data['content']??'', $data['important']??false)); echo json_encode(['status'=>'ok']); exit; }
            break;
        default:
            if(preg_match('#^/api/notes/([^/]+)/toggle$#',$uri,$m)){
                $notes->toggleImportant($m[1]);
                echo json_encode(['status'=>'ok']); exit;
            }
            if(preg_match('#^/api/notes/([^/]+)$#',$uri,$m)){
                $id=$m[1];
                if($_SERVER['REQUEST_METHOD']==='DELETE'){ $notes->delete($id); echo json_encode(['status'=>'ok']); exit; }
                if($_SERVER['REQUEST_METHOD']==='PATCH'){ $notes->update($id,$data['title']??'',$data['content']??''); echo json_encode(['status'=>'ok']); exit; }
            }
    }
    http_response_code(404); echo json_encode(['status'=>'error']); exit;
}

// HTML + frontend
?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Notes Manager</title>
<style>
body{font-family:sans-serif;background:#f0f2f5;margin:0;padding:20px;}
h1{text-align:center;margin-bottom:20px;}
.container{max-width:700px;margin:auto;}
#message{display:none;padding:10px;border-radius:6px;margin-bottom:10px;}
#message.success{background:#2ecc71;color:white;}
#message.error{background:#e74c3c;color:white;}
.note{background:#fff;padding:15px;border-radius:10px;box-shadow:0 3px 10px rgba(0,0,0,0.1);margin-bottom:10px;transition:0.2s;position:relative;}
.note.important{border-left:5px solid #e74c3c;}
.note:hover{box-shadow:0 5px 15px rgba(0,0,0,0.15);}
.note h3{margin:0 0 5px 0;cursor:text;}
.note p{margin:0 0 5px 0;cursor:text;}
.buttons{display:flex;gap:8px;position:absolute;top:10px;right:10px;}
button{padding:5px 10px;border:none;border-radius:6px;cursor:pointer;}
button.delete{background:#e74c3c;color:white;}
button.edit{background:#3498db;color:white;}
button.toggle{background:#f39c12;color:white;}
#newTitle,#newContent{width:100%;padding:8px;margin:5px 0;border-radius:6px;border:1px solid #ccc;}
#addBtn{background:#2ecc71;color:white;width:100%;padding:10px;border:none;border-radius:8px;cursor:pointer;}
#addBtn:hover{background:#27ae60;}
</style>
</head>
<body>
<h1>Notes Manager</h1>
<div class="container">
<div id="message"></div>
<input type="text" id="newTitle" placeholder="Title">
<textarea id="newContent" placeholder="Content" rows="3"></textarea>
<label><input type="checkbox" id="newImportant"> Mark as Important</label>
<button id="addBtn">Add Note</button>
<div id="notesList"></div>
</div>

<script>
const notesList=document.getElementById('notesList');
const message=document.getElementById('message');

function showMessage(text,type='success'){
    message.textContent=text;
    message.className=type;
    message.style.display='block';
    setTimeout(()=>message.style.display='none',2000);
}

let notes=[];

async function fetchNotes(){
    const res=await fetch('/api/notes');
    notes=await res.json();
    renderNotes();
}

function renderNotes(){
    notesList.innerHTML='';
    notes.forEach(n=>{
        const div=document.createElement('div');
        div.className='note'+(n.important?' important':'');
        div.dataset.id=n.id;
        div.innerHTML=`<h3 contenteditable="true">${n.title}</h3>
            <p contenteditable="true">${n.content}</p>
            <div class="buttons">
                <button class="edit">Save</button>
                <button class="delete">Delete</button>
                <button class="toggle">${n.important?'Unmark':'Mark'} Important</button>
            </div>`;
        const h3=div.querySelector('h3');
        const p=div.querySelector('p');
        div.querySelector('.edit').onclick=async ()=>{
            await fetch('/api/notes/'+n.id,{method:'PATCH',headers:{'Content-Type':'application/json'},body:JSON.stringify({title:h3.textContent,content:p.textContent})});
            showMessage('Note updated!');
            fetchNotes();
        };
        div.querySelector('.delete').onclick=async ()=>{
            await fetch('/api/notes/'+n.id,{method:'DELETE'});
            showMessage('Note deleted!');
            fetchNotes();
        };
        div.querySelector('.toggle').onclick=async ()=>{
            await fetch('/api/notes/'+n.id+'/toggle',{method:'POST'});
            showMessage('Important status changed!');
            fetchNotes();
        };
        notesList.appendChild(div);
    });
}

document.getElementById('addBtn').onclick=async ()=>{
    const title=document.getElementById('newTitle').value.trim();
    const content=document.getElementById('newContent').value.trim();
    const important=document.getElementById('newImportant').checked;
    if(!title || !content){showMessage('Please fill both fields','error'); return;}
    await fetch('/api/notes',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({title,content,important})});
    document.getElementById('newTitle').value='';
    document.getElementById('newContent').value='';
    document.getElementById('newImportant').checked=false;
    showMessage('Note added!');
    fetchNotes();
};

fetchNotes();
</script>
</body>
</html>
