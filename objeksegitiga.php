<?php
require_once "class_segitiga.php";

$segitiga1 = new Segitiga(10, 8, 6, 8, 6);

$segitiga2 = new Segitiga(5, 4.33, 5, 5, 5);

?><!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><title>Info Segitiga</title></head>
<body>
<pre><?php
echo $segitiga1->tampilkanInfo();
echo "\n";
echo $segitiga2->tampilkanInfo();
?></pre>
</body>
</html>