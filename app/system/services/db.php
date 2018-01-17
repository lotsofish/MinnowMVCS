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


class db extends service
{
	use configurable;
	private static $_dbo;
	private $_database;
	private $_primaryKey;
	private $_lastQuery;
	private $_model;

	public function __construct($core, $modelName, $tableName = null)
	{
		parent::__construct($core);
		require_once 'db/iDbAccess.php';
		require_once 'db/mysql.php';
		
		$config = $this->getConfig();

		if(db::$_dbo == null)
		{
			db::$_dbo = new PDO($config->connectionString, $config->user, $config->pass, $config->driverOptions);
		}
	
		$dbType = db::$_dbo->getAttribute(PDO::ATTR_DRIVER_NAME);
		switch($dbType)
		{
			case 'mysql':
				$this->_database = new mysql($this);
				break;

			default:
				throw new Exception('DB ' . $dbType . ' not implemented.');
		}

		$this->_tableName = $tableName;
		$this->_modelName = $this->_getModelName($modelName);
		if(!class_exists($this->_modelName))
		{
			$this->core->loadModel($modelName);
		}
	}

	public static function getDbo()
	{
		return db::$_dbo;
	}

	public function query($query, $parameters=null)
	{
		$statement = db::$_dbo->prepare($query);
		if(!$statement->execute($parameters))
		{
			$errorInfo = $statement->errorInfo();
			echo '<pre>';
			var_dump($errorInfo);
			echo '</pre>';

			error_log('Query failed: ' . var_export($errorInfo, true));
			return false;
		}
		$this->_lastQuery = $query . ' : ' . (is_array($parameters) ? implode($parameters, ', ') : 'no parameters');
		return $statement->fetchAll(PDO::FETCH_CLASS, $this->_modelName);
	}

	public function select($where = null)
	{
		if($this->_tableName == null) { throw new Exception('Table name is not set.'); }
		return $this->_database->select($this->_tableName, $this->_getPrimaryKey(), $where);
	}

	public function add($object)
	{
		if($this->_tableName == null) { throw new Exception('Table name is not set.'); }
		return $this->_database->add($this->_tableName, $object, $this->_getPrimaryKey());
	}

	public function update($object)
	{
		if($this->_tableName == null) { throw new Exception('Table name is not set.'); }
		return $this->_database->update($this->_tableName, $object, $this->_getPrimaryKey());
	}

	public function delete($id)
	{
		if($this->_tableName == null) { throw new Exception('Table name is not set.'); }
		return $this->_database->delete($this->_tableName, $id, $this->_getPrimaryKey());
	}
	
	public function insertId()
	{
		return db::$_dbo->lastInsertId();
	}

	public function lastQuery()
	{ 
		return $this->_lastQuery;
	}

	private function _getPrimaryKey()
	{
		if($this->_primaryKey != null)
		{
			return $this->_primaryKey;
		}
		else
		{
			return $this->_primaryKey = $this->_database->getPrimaryKey($this->_tableName);
		}
	}

	private function _getModelName($model)
	{		
		$modelName = str_replace('/', '', $model);
		$modelName .= 'Model';
		return $modelName;
	}
}