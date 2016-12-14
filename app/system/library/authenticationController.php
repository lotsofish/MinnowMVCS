<?php

class authenticationController extends controller
{
	function __construct($core)
	{		
		parent::__construct($core);
		$authenticationTemplateModel = $this->core->loadModel('authenticationTemplate');

		$userService = $this->core->loadService('user');
		$isLoggedIn = $userService->isLoggedIn();
		$authenticationTemplateModel->loginLink = $isLoggedIn ? '/login/logout' : '/login';
		$authenticationTemplateModel->loginText = $isLoggedIn ? 'Log Out' : 'Log In';
		$authenticationTemplateModel->isLoggedIn = $isLoggedIn;

		$this->view->templateModel($authenticationTemplateModel);
	}
}