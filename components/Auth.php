<?php

class Auth
{	
	public $db;

	public function __construct(QueryBuilder $db)
	{
		$this->db = $db;
	}
	public function register($email, $password)
	{
		$this->db->store('users', [
			'email' => $email,
			'password' => md5($password)
		]);
	}

	public function login($email, $password)
	{
		$sql = "SELECT * FROM users WHERE email=:email AND password=:password LIMIT 1";
		$statement = $this->db->pdo->prepare($sql);
		$statement->bindParam(":email", $email);
		$statement->bindParam(":password", md5($password));
		$statement->execute();
		$user = $statement->fetch(PDO::FETCH_ASSOC);
		
		//$user = $this->db->selectUser($email, $password);
		if ($user) {
			$_SESSION['user'] = $user;
			return true;
		}

		return false;
	}

	public function logout()
	{
		unset($_SESSION['user']);
	}

	public function check()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}

		return false;
	}

	public function currentUser()
	{
		//if ($this->check()) {
		if (isset($_SESSION['user'])) {
			return $_SESSION['user'];
		}
	}

	public function fullName()
	{
		$user = $this->currentUser();
		return $user['name'] . ' ' . $user['surname'];
	}

	// ban()
	// unban()
	// getUserStatus() --> "banned" / "noraml"
	// isBanned() --> true
	// isNormal () --> false
	// remove()
	// uploadAvatar // use ImageManager

}

// ImageManager
	// upload ($image)
	// delete ($path)
