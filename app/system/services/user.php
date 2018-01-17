<?php
/***********************************************************************
    Copyright (C) 2018 Andrew Rinderknecht
    https://github.com/lotsofish/MinnowMVCS

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 ***********************************************************************/
    
session_start();

class user extends modelBuilder
{
	use configurable;

	const MODEL_NAME = 'userModel';

	private $_config;
	private $_db;

	public function __construct($core)
	{		
		parent::__construct($core);
		$this->_config = $this->getConfig();
		$this->_db = $this->core->loadService('db', 'user', 'user');

		if(isset($_SESSION['userId']))
		{
			$this->_populateModelFromDb();
		}
	}

	public function login($username, $password, $passwordHashed = false, $rememberCookie = false)
	{
		$password = $passwordHashed ? $password : $this->makePassword($password);
		$user = $this->_db->select(array('username'=>$username, 'password'=>$password, 'verified'=>1));

		if(count($user) > 0) 
		{
			$this->setModel($user[0]);
			$_SESSION['userId'] = $user[0]->id;

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
		$usernameMatch = $this->_db->select(array('username'=>$username));
		if(count($usernameMatch) > 0) { return false; }

		$emailMatch = $this->_db->select(array('email'=>$email));
		if(count($usernameMatch) > 0) { return false; }
		
		$this->username = $username;
		$this->email = $email;
		$this->password = $this->makePassword($password);
		$this->verified = $verified;

		$this->_db->add($this->getModel());

		return $this->_db->insertId();
	}

	public function updateUser($id, $username, $email, $password, $verified = 1)
	{
		$this->id = $id;
		$this->username = $username;
		$this->email = $email;
		$this->password = $this->makePassword($password);
		$this->verified = $verified;

		$this->_db->update($this->getModel());
	}

	public function isLoggedIn()
	{
		if(!isset($_SESSION['userId']) && isset($_COOKIE['userSession']))
		{
			$userSession = unserialize(base64_decode($_COOKIE['userSession']));
			$this->login($userSession[0], $userSession[1], true);
		}
		return isset($_SESSION['userId']);
	}

	private function _populateModelFromDb()
	{
		$user = $this->_db->select(array('id'=>$_SESSION['userId'], 'verified'=>1))[0];
		$this->setModel($user);
	}

	private function makePassword($password)
	{
		return md5($this->_config->salt . $password);
	}
}