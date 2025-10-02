<?php
require_once __DIR__ . '/../TaskCollection.php';

$taskCollection = new TaskCollection(__DIR__ . '/../storage/tasks.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    if ($title) {
        $taskCollection->add(new Task($title));
    }
    header("Location: /");
    exit;
}

$tasks = $taskCollection->all();
include __DIR__ . '/../views/index.php';
