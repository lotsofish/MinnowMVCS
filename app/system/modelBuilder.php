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

class modelBuilder extends service
{
	private $_modelInstance;

	public function __construct($core)
	{		
		parent::__construct($core);
	
		if(defined('static::MODEL_NAME'))
		{
			$this->setModel(static::MODEL_NAME);
		}
	}

	final public function __set($name, $value)
	{
		if($this->_modelInstance == null)
		{
			throw new Exception('Model is not set');
		}

		if(property_exists($this->_modelInstance, $name))
		{
			$this->_modelInstance->$name = $value;
		}
	}

	final public function __get($name)
	{
	    if($this->_modelInstance == null)
		{
			throw new Exception('Model is not set');
		}

		if(property_exists($this->_modelInstance, $name))
		{
			return $this->_modelInstance->$name;
		}	
	}

	public function setModel($modelNameOrInstance)
	{
		if(is_string($modelNameOrInstance))
		{
			if(!class_exists($modelNameOrInstance))
			{
				$this->_modelInstance = $this->core->loadModel(preg_replace('/Model$/', '' , $modelNameOrInstance));
			}
			else
			{
				$this->_modelInstance = new $modelNameOrInstance();
			}
		}
		else
		{
			if($this->_modelInstance == null || (get_class($this->_modelInstance) == get_class($modelNameOrInstance)))
			{
				$this->_modelInstance = $modelNameOrInstance;
			}
			else
			{
				throw new Exception('Setting model type ' . get_class($modelNameOrInstance) . ' does not match set model type of ' . get_class($this->_modelInstance));
			}
		}
	}

	public function getModel()
	{
		return $this->_modelInstance;
	}

	public function isModelSet()
	{
		return $this->_modelInstance != null;
	}
}