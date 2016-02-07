<?php
/***********************************************************************
    Copyright (C) 2015 Andrew Rinderknecht
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

class core
{
	private $_rootDir;

	function __construct($rootDir)
	{
		$this->_rootDir = $rootDir;

		// load required classes
		require_once 'controller.php';
		require_once 'model.php';
		require_once 'view.php';
		require_once 'partialView.php';
		require_once 'modelBuilder.php';
		require_once 'configurable.php';
	}

	public function loadController($route)
	{
		$parts = explode('/', $route, 3);
		$controllerName = isset($parts[0]) && $parts[0] != '' ? $parts[0] : 'index';
		$controllerClass = $controllerName . 'Controller';
		$methodName = isset($parts[1]) ? $parts[1] : 'index';
		$options = isset($parts[2]) ? explode('/', $parts[2]) : array();

		$this->_requireFile('controllers/' . $controllerName);

		$controller = new $controllerClass($this);
		if(method_exists($controller, $methodName))
		{
			call_user_func_array(array($controller, $methodName), $options);
		}
		else
		{
			header('HTTP/1.0 404 Not Found');
			echo '404 Not Found';
		}
	}

	public function loadModel($modelName)
	{
		$this->_requireFile('models/' . $modelName);
		$modelName = str_replace('/', '', $modelName);
		$modelName .= 'Model';
		return new $modelName();
	}

	public function loadService($serviceName)
	{
		$this->_requireFile('services/' . $serviceName);
		$args = func_get_args();
		array_shift($args);
		return new $serviceName($this, $args);
	}

	public function rootDir() { return $this->_rootDir; }

	private function _validateFilename($fileName)
	{
		// don't allow periods 
		if(strpos($fileName, '.') !== FALSE) { die(); }
	}

	private function _requireFile($fileName)
	{
		$this->_validateFilename($fileName);

		$systemLocation = $this->_rootDir . '/system/' . $fileName . '.php';
		$userLocation = $this->_rootDir . '/' . $fileName . '.php';
		
		if(file_exists($systemLocation))
		{
			require_once $systemLocation;
		}
		else if(file_exists($userLocation))
		{
			require_once $userLocation;
		}
		else
		{
			throw new Exception('Requested file not found: ' . $fileName . '.php');
		}
	}
}