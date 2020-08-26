<?php
$sql = "INSERT INTO tasks (title, content) VALUES(:title, :content)"; //передали метки :title...
$pdo = new PDO("mysql:host=localhost; dbname=notebook", "root", "");		
$statement = $pdo->prepare($sql);
$statement->bindParam(":title", $_POST["title"]); // привязали метки bindParam
$statement->bindParam(":content", $_POST["content"]);
$statement->execute();

header("Location: /");
