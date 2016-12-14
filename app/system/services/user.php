<?php
session_start();

class user extends modelBuilder
{
	use configurable;

	const MODEL_NAME = 'userModel';

	private $_config;
	private $_db;

	function constructor()
	{		
		$this->_config = $this->getConfig();
		$this->_db = $this->core->loadService('db', $this->getModel());
	}

	public function login($username, $password, $passwordHashed = false, $rememberCookie = false)
	{
		$password = $passwordHashed ? $password : $this->makePassword($password);
		$user = $this->_db->select(array('username'=>$username, 'password'=>$password));

		if(count($user) > 0) 
		{
			$this->setModel($user[0]);
			$_SESSION['username'] = $user[0]->username;
			$_SESSION['email'] = $user[0]->email;
			$_SESSION['userId'] = $user[0]->id;
			$_SESSION['verified'] = $user[0]->verified;

			if($this->_config->rememberCookie || $rememberCookie)
			{
				setcookie('userSession', base64_encode(serialize(array($username, $password))), time() + $this->_config->cookieTimeout, '/');
			}
		}
		return count($user) > 0;
	}

	public function logout()
	{
		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', 1,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
		    );
		}

		session_destroy();

		setcookie('userSession', '', 1, '/');
	}

	public function createUser($username, $email, $password, $verified = 1)
	{
		$user = $this->core->loadModel('user');
		$user->username = $username;
		$user->email = $email;
		$user->password = $this->makePassword($password);
		$user->verified = $verified;

		$this->_db->setModel($user);
		$this->_db->add();

		return $this->_db->insertId();
	}

	public function updateUser($id, $username, $email, $password, $verified = 1)
	{
		$user = $this->core->loadModel('user');
		$user->id = $id;
		$user->username = $username;
		$user->email = $email;
		$user->password = $this->makePassword($password);
		$user->verified = $verified;

		$this->_db->setModel($user);
		$this->_db->update();
	}

	public function isLoggedIn()
	{
		if(!$_SESSION['username'] && $_COOKIE['userSession'])
		{
			$userSession = unserialize(base64_decode($_COOKIE['userSession']));
			$this->login($userSession[0], $userSession[1], true);
		}
		return isset($_SESSION['username']) && $_SESSION['verified'];
	}

	public function getUsername()
	{
		return $_SESSION['username'];
	}

	public function getEmail()
	{
		return $_SESSION['email'];
	}

	public function getId()
	{
		return $_SESSION['userId'];
	}

	private function makePassword($password)
	{
		return md5($this->_config->salt . $password);
	}
}