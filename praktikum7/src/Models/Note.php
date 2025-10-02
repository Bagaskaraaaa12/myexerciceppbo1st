<?php
require_once __DIR__ . '/../Traits/TimestampableTrait.php';

class Note {
    use TimestampableTrait;

    private string $id;
    private string $title;
    private string $content;
    private bool $important;

    public function __construct(string $title, string $content, bool $important = false) {
        $this->id = uniqid();
        $this->title = $title;
        $this->content = $content;
        $this->important = $important;
        $this->setTimestamps();
    }

    public function getId(): string { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function getContent(): string { return $this->content; }
    public function isImportant(): bool { return $this->important; }

    public function setTitle(string $title): void { $this->title = $title; $this->setTimestamps(); }
    public function setContent(string $content): void { $this->content = $content; $this->setTimestamps(); }
    public function toggleImportant(): void { $this->important = !$this->important; $this->setTimestamps(); }

    public function __toString(): string {
        return $this->title . ': ' . substr($this->content,0,30) . '...';
    }

    public function __clone() {
        $this->id = uniqid();
        $this->setTimestamps();
    }
}
