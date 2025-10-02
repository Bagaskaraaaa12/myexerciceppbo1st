<?php
require_once __DIR__ . "/Task.php";

class TaskCollection {
    private string $storage;
    private array $tasks = [];

    public function __construct(string $storage) {
        $this->storage = $storage;
        if (file_exists($storage)) {
            $data = json_decode(file_get_contents($storage), true) ?? [];
            foreach ($data as $t) {
                $task = new Task($t['title'], $t['position'], $t['completed']);
                $task->id = $t['id'];
                $this->tasks[] = $task;
            }
            // Sort by position
            usort($this->tasks, fn($a,$b) => $a->position <=> $b->position);
        }
    }

    public function all(): array { return $this->tasks; }

    public function add(Task $task): void {
        $task->position = count($this->tasks);
        $this->tasks[] = $task;
        $this->save();
    }

    public function toggle(string $id): void {
        foreach ($this->tasks as $task) {
            if ($task->id === $id) {
                $task->completed = !$task->completed;
                $this->save();
                return;
            }
        }
    }

    public function delete(string $id): void {
        $this->tasks = array_filter($this->tasks, fn($t) => $t->id !== $id);
        $this->tasks = array_values($this->tasks); // reindex
        $this->save();
    }

    public function updateTitle(string $id, string $title): void {
        foreach ($this->tasks as $task) {
            if ($task->id === $id) {
                $task->title = $title;
                $this->save();
                return;
            }
        }
    }

    public function reorder(array $orderedIds): void {
        $map = [];
        foreach ($this->tasks as $task) $map[$task->id] = $task;
        $this->tasks = [];
        foreach ($orderedIds as $i => $id) {
            if(isset($map[$id])) {
                $map[$id]->position = $i;
                $this->tasks[] = $map[$id];
            }
        }
        $this->save();
    }

    private function save(): void {
        $arr = array_map(fn($t)=>[
            "id"=>$t->id,
            "title"=>$t->title,
            "completed"=>$t->completed,
            "position"=>$t->position
        ], $this->tasks);
        file_put_contents($this->storage, json_encode($arr, JSON_PRETTY_PRINT));
    }
}
