<?php
// Task.php
declare(strict_types=1);

final class Task
{
    private ?int $id;
    private string $title;
    private bool $done;
    private ?string $createdAt;
    private ?string $updatedAt;

    public function __construct(string $title, ?int $id = null, bool $done = false, ?string $createdAt = null, ?string $updatedAt = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->done = $done;
        $this->createdAt = $createdAt ?? date('c');
        $this->updatedAt = $updatedAt;
    }

    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): void { $this->title = $title; $this->touch(); }

    public function isDone(): bool { return $this->done; }
    public function toggleDone(): void { $this->done = !$this->done; $this->touch(); }

    public function getCreatedAt(): string { return $this->createdAt ?? date('c'); }
    public function getUpdatedAt(): ?string { return $this->updatedAt; }

    private function touch(): void { $this->updatedAt = date('c'); }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'done' => $this->done,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }

    public static function fromArray(array $data): Task
    {
        return new Task(
            $data['title'] ?? '',
            isset($data['id']) ? (int)$data['id'] : null,
            isset($data['done']) ? (bool)$data['done'] : false,
            $data['createdAt'] ?? null,
            $data['updatedAt'] ?? null
        );
    }
}
