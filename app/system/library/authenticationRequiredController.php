<?php

class authenticationRequiredController extends authenticationController
{
	public function authenticationRequiredController($core)
	{
		parent::__construct($core);

		$userService = $this->core->loadService('user');
		if(!$userService->isLoggedIn())
		{
			header('Location: /');
			exit;
		}
	}
}