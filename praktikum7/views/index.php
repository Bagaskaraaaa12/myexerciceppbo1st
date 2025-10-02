<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
</head>
<body>
    <h1>My Tasks</h1>

    <form method="POST" action="/">
        <input type="text" name="title" placeholder="Enter task..." required>
        <button type="submit">Add Task</button>
    </form>

    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <?= htmlspecialchars($task->getTitle()) ?>
                <?= $task->isCompleted() ? "(Done)" : "" ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
