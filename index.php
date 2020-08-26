<?php

$tasks = [
	[
		"id" => 15,
		"title" => "Go to the store",
		"content" => "asdasdasd"

	],

];


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<title>Notebook</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>All Tasks</h1>
				<a href="#" class="btn btn-success">Add Task</a>
				<table class="table">
					<thead>
						<tr>
							<th><?=$task['id'];?></th>
							<th><?=$task['title'];?></th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($tasks as $task):?>
							<tr>
								<td>1</td>
								<td>Go to the store</td>
								<td>
									<a href="#" class="btn btn-warning">
										Edit
									</a>
									<a href="#" class="btn btn-danger">
										Delete
									</a>
								</td>
							</tr>	
						<?php endforeach;?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</body>
</html>