<?php
require_once "Book.php";

$storageFile = __DIR__ . "/storage.json";

// load data
$collection = new BookCollection();
if(file_exists($storageFile)) {
    $raw = json_decode(file_get_contents($storageFile), true);
    foreach($raw as $b) {
        $book = new Book($b['title'], $b['author']);
        if($b['borrowed']) $book->lend();
        $collection->add($book);
    }
}

// handle actions
if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["title"], $_POST["author"])) {
        $book = new Book($_POST["title"], $_POST["author"]);
        $collection->add($book);
    }
    if(isset($_POST["delete"])) {
        $collection->remove($_POST["delete"]);
    }
    file_put_contents($storageFile, json_encode($collection->all(), JSON_PRETTY_PRINT));
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Library Manager</title>
    <style>
        body{font-family:sans-serif;background:#f4f6f8;margin:20px;}
        h1{text-align:center;color:#2c3e50;}
        .book{background:white;padding:15px;margin:10px;border-radius:10px;box-shadow:0 4px 10px rgba(0,0,0,0.1);}
        .book h3{margin:0;}
        .book small{color:gray;}
        .actions{margin-top:10px;}
        .actions button{padding:5px 10px;margin-right:5px;border:none;border-radius:6px;cursor:pointer;}
        .add-form{margin:auto;max-width:400px;background:white;padding:20px;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,0.1);}
        input{width:100%;padding:10px;margin:5px 0;border-radius:6px;border:1px solid #ccc;}
        button.add{background:#2ecc71;color:white;width:100%;}
        button.delete{background:#e74c3c;color:white;}
    </style>
</head>
<body>
    <h1>📚 Library Manager</h1>

    <div class="add-form">
        <form method="post">
            <input type="text" name="title" placeholder="Judul Buku" required>
            <input type="text" name="author" placeholder="Penulis" required>
            <button type="submit" class="add">Tambah Buku</button>
        </form>
    </div>

    <h2>Daftar Buku</h2>
    <?php foreach($collection as $book): ?>
        <?php $b = $book->jsonSerialize(); ?>
        <div class="book">
            <h3><?= htmlspecialchars($b['title']) ?></h3>
            <small><?= htmlspecialchars($b['author']) ?> | <?= $b['created'] ?></small>
            <div class="actions">
                <form method="post" style="display:inline;">
                    <button type="submit" name="delete" value="<?= $b['id'] ?>" class="delete">Hapus</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
