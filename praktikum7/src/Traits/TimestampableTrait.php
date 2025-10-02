<?php
trait TimestampableTrait {
    private string $createdAt;
    private string $updatedAt;

    public function setTimestamps(): void {
        $now = date('Y-m-d H:i:s');
        if(empty($this->createdAt)) $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    public function getCreatedAt(): string { return $this->createdAt; }
    public function getUpdatedAt(): string { return $this->updatedAt; }
}
