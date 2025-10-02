<?php
require_once __DIR__ . '/Note.php';

class NoteCollection implements Iterator {
    private array $notes = [];
    private string $storage;
    private int $position = 0;

    public function __construct(string $storage) {
        $this->storage = $storage;
        if(file_exists($storage)){
            $data = json_decode(file_get_contents($storage), true) ?? [];
            foreach($data as $n){
                $note = new Note($n['title'],$n['content'],$n['important']);
                $reflection = new ReflectionClass($note);
                $idProp = $reflection->getProperty('id');
                $idProp->setAccessible(true);
                $idProp->setValue($note,$n['id']);
                $this->notes[] = $note;
            }
        }
    }

    public function add(Note $note): void { $this->notes[] = $note; $this->save(); }
    public function delete(string $id): void { $this->notes = array_filter($this->notes, fn($n)=>$n->getId()!==$id); $this->notes = array_values($this->notes); $this->save(); }
    public function update(string $id, string $title, string $content): void {
        foreach($this->notes as $n){ if($n->getId() === $id){ $n->setTitle($title); $n->setContent($content); $this->save(); return; } }
    }
    public function toggleImportant(string $id): void {
        foreach($this->notes as $n){ if($n->getId() === $id){ $n->toggleImportant(); $this->save(); return; } }
    }

    private function save(): void {
        $arr = array_map(fn($n)=>[
            'id'=>$n->getId(),
            'title'=>$n->getTitle(),
            'content'=>$n->getContent(),
            'important'=>$n->isImportant()
        ], $this->notes);
        file_put_contents($this->storage,json_encode($arr,JSON_PRETTY_PRINT));
    }

    // Iterator
    public function current(): mixed { return $this->notes[$this->position]; }
    public function key(): mixed { return $this->position; }
    public function next(): void { $this->position++; }
    public function rewind(): void { $this->position=0; }
    public function valid(): bool { return isset($this->notes[$this->position]); }
}
