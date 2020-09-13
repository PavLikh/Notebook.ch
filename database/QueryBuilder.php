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

	//Add new one item in database
	function store($table, $data)
	{	
		//для корректной работы нужны создать динамическую строку корректного sql запроса
		// 1. get keys // 
		$keys = array_keys($data);
		// 2. create string  title, content // 
		$stringOfKeys = implode(',', $keys);
		// 3. сформировать метки :*...
		$placeholders = ":".implode(', :', $keys);

		$sql = "INSERT INTO $table ($stringOfKeys) VALUES($placeholders)"; //передали метки :title...
		$statement = $this->pdo->prepare($sql);
		//$statement->bindParam(":title", $_POST["title"]); // привязали метки bindParam
		//$statement->bindParam(":content", $_POST["content"]);
		//$statement->execute();
		$statement->execute($data); //чтобы не использовать bindParam для каждой метки

	}

	//Get one task for show on display
	function getOne($table, $id)
	{
		$statement = $this->pdo->prepare("SELECT * FROM $table WHERE id=:id");
		$statement->bindParam(":id", $id);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	function update($table, $data)
	{	
		// формируем динамическую строку для sql запроса 
		$fields = '';
		
		foreach($data as $key => $value) {
			$fields .= $key . "=:" . $key . ",";
		}
		$fields = rtrim($fields, ','); //удаляем запятую справа

		
		$sql = "UPDATE $table SET $fields WHERE id=:id";
		$statement = $this->pdo->prepare($sql);
		$statement->execute($data);
	}

	//Delete task
	function delete($table, $id)
	{
		$sql = "DELETE FROM $table WHERE id=:id";
		$statement = $this->pdo->prepare($sql);
		$statement->bindParam("id", $id);
		$statement->execute();
	}
}