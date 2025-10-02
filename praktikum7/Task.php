<?php
class Task {
    public string $id;
    public string $title;
    public bool $completed;
    public int $position;

    public function __construct(string $title, int $position = 0, bool $completed = false) {
        $this->id = uniqid();
        $this->title = $title;
        $this->completed = $completed;
        $this->position = $position;
    }
}
