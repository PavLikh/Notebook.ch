<?php
$id = $_GET['id'];

$sql = "DELETE FROM tasks WHERE id=:id";
$pdo =new PDO("mysql:host=localhost; dbname=notebook", "root", "");
$statement = $pdo->prepare($sql);
$statement->bindParam("id", $id);
$statement->execute();

header("Location: /"); exit;