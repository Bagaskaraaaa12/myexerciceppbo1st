<?php
// TaskCollection.php
declare(strict_types=1);
require_once __DIR__ . '/Task.php';

class TaskCollection implements IteratorAggregate
{
    /** @var Task[] */
    private array $tasks = [];
    private string $storageFile;

    public function __construct(string $storageFile)
    {
        $this->storageFile = $storageFile;
        $this->load();
    }

    public function add(Task $task): Task
    {
        $nextId = empty($this->tasks) ? 1 : (max(array_map(fn(Task $t) => (int)$t->getId(), $this->tasks)) + 1);
        $task->setId($nextId);
        $this->tasks[] = $task;
        $this->persist();
        return $task;
    }

    public function all(): array
    {
        return $this->tasks;
    }

    public function find(int $id): ?Task
    {
        foreach ($this->tasks as $t) {
            if ($t->getId() === $id) return $t;
        }
        return null;
    }

    public function update(Task $task): bool
    {
        foreach ($this->tasks as $i => $t) {
            if ($t->getId() === $task->getId()) {
                $this->tasks[$i] = $task;
                $this->persist();
                return true;
            }
        }
        return false;
    }

    public function delete(int $id): bool
    {
        foreach ($this->tasks as $i => $t) {
            if ($t->getId() === $id) {
                array_splice($this->tasks, $i, 1);
                $this->persist();
                return true;
            }
        }
        return false;
    }

    private function persist(): void
    {
        // store as JSON array for portability
        $arr = array_map(fn(Task $t) => $t->toArray(), $this->tasks);
        file_put_contents($this->storageFile, json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    private function load(): void
    {
        if (!file_exists($this->storageFile)) {
            $this->tasks = [];
            return;
        }
        $json = file_get_contents($this->storageFile);
        if (!$json) { $this->tasks = []; return; }
        $arr = json_decode($json, true);
        if (!is_array($arr)) { $this->tasks = []; return; }
        $this->tasks = array_map(fn($d) => Task::fromArray($d), $arr);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->tasks);
    }
}
