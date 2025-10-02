<?php
require_once __DIR__ . '/Task.php';

class TaskCollection {
    private array $tasks = [];
    private string $storageFile;

    public function __construct(string $storageFile) {
        $this->storageFile = $storageFile;
        if (file_exists($storageFile)) {
            $data = file_get_contents($storageFile);
            if ($data) {
                $this->tasks = unserialize($data);
            }
        }
    }

    public function add(Task $task): void {
        $this->tasks[] = $task;
        $this->save();
    }

    public function all(): array {
        return $this->tasks;
    }

    private function save(): void {
        file_put_contents($this->storageFile, serialize($this->tasks));
    }
}
