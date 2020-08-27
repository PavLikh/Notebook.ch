<?php

$pdo = new PDO("mysql:host=localhost; dbname=notebook", "root", "");
$statement = $pdo->prepare("SELECT * FROM tasks WHERE id=:id");
$statement->bindParam(":id", $_GET['id']);
$statement->execute();
$task = $statement->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<title>Page</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1><?= $task['title']; ?></h1>
					<p><?= $task['content'];?>
					</p>
					<a href="/">Go Back</a>	
			</div>
		</div>
	</div>
</body>
</html>