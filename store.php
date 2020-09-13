<?php


require 'database/QueryBuilder.php';

//$data = $_POST;
$data = [
	'title' => $_POST['title'],
	'content' => $_POST['content']
];// $data это просто $_POST записано по ключам массива для понимания
$db = new QueryBuilder;

//$db->addTask($_POST);
$db->store("tasks", $data);

header("Location: /"); exit;