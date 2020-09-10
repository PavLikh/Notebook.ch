<?php

class QueryBuilder
{
	public $pdo;
	function __construct()
	{
		// 1. Connect
		$this->pdo = new PDO("mysql:host=localhost; dbname=notebook", "root", "");
	}
	//Tasks list
	// function getAllTasks()
	// {
		
	// 	// 2. Prepare the statement
	// 	$statement = $this->pdo->prepare("SELECT * FROM tasks"); //подготовить
	// 	$result = $statement->execute(); //выполнить
	// 	$tasks = $statement->fetchAll(PDO::FETCH_ASSOC);//die; // получаем массив fetchAll() ["id"]=>"16", [0]=> "16" .../ fetchAll(2) ["id"]=>"16" .../  то же что константа PDO::FETCH_ASSOC = 2

	// 	return $tasks;
	// }

	// List for everything
	function all($table)
	{
		
		// 2. Prepare the statement
		$statement = $this->pdo->prepare("SELECT * FROM $table"); //подготовить (двойные ковычки позволяют использовать переменные(парсинг))
		$statement->execute(); //выполнить
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);//die; // получаем массив fetchAll() ["id"]=>"16", [0]=> "16" .../ fetchAll(2) ["id"]=>"16" .../  то же что константа PDO::FETCH_ASSOC = 2

		return $results;
	}

	//Add new task in database
	function addTask($data)
	{	
		$sql = "INSERT INTO tasks (title, content) VALUES(:title, :content)"; //передали метки :title...
		$statement = $this->pdo->prepare($sql);
		//$statement->bindParam(":title", $_POST["title"]); // привязали метки bindParam
		//$statement->bindParam(":content", $_POST["content"]);
		//$statement->execute();
		$statement->execute($data); //чтобы не использовать bindParam для каждой метки

	}

	//Get one task for show on display
	function getTask($id)
	{
		$statement = $this->pdo->prepare("SELECT * FROM tasks WHERE id=:id");
		$statement->bindParam(":id", $id);
		$statement->execute();
		$task = $statement->fetch(PDO::FETCH_ASSOC);

		return $task;
	}

	function updateTask($data)
	{
		$sql = "UPDATE tasks SET title=:title, content=:content WHERE id=:id";
		$statement = $this->pdo->prepare($sql);
		$statement->execute($data);
	}

	//Delete task
	function deleteTask($id)
	{
		$sql = "DELETE FROM tasks WHERE id=:id";
		$statement = $this->pdo->prepare($sql);
		$statement->bindParam("id", $id);
		$statement->execute();
	}
}