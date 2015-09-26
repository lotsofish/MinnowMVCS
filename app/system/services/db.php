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

require_once 'db/iDbAccess.php';
require_once 'db/mysql.php';

class db extends modelBuilder
{
	use configurable;
	private static $_dbo;
	private $_database;
	private $_primaryKey;

	public function constructor($model=null)
	{
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


		if($model != null)
		{
			$this->setModel($model);
		}
	}

	public static function getDbo()
	{
		return db::$_dbo;
	}

	public function query($query, $parameters=null)
	{
		if(!$this->isModelSet()) { throw new Exception('Model is not set.'); }

		$statement = db::$_dbo->prepare($query);
		$statement->execute($parameters);
		return $statement->fetchAll(PDO::FETCH_CLASS, get_class($this->getModel()));
	}

	public function select($where)
	{
		if(!$this->isModelSet()) { throw new Exception('Model is not set.'); }

		return $this->_database->select($this->_getTableNameFromModel(), $this->_getPrimaryKey(), $where);
	}

	public function add()
	{
		if(!$this->isModelSet()) { throw new Exception('Model is not set.'); }

		$this->_database->add($this->_getTableNameFromModel(), $this->getModel(), $this->_getPrimaryKey());
	}

	public function update()
	{
		if(!$this->isModelSet()) { throw new Exception('Model is not set.'); }

		$this->_database->update($this->_getTableNameFromModel(), $this->getModel(), $this->_getPrimaryKey());
	}

	public function delete($id)
	{
		if(!$this->isModelSet()) { throw new Exception('Model is not set.'); }

		$this->_database->delete($this->_getTableNameFromModel(), $id, $this->_getPrimaryKey());
	}
	
	public function insertId()
	{
		return db::$_dbo->lastInsertId();
	}

	public function setModel($model)
	{
		parent::setModel($model);
		$this->_primaryKey = null;
	}

	private function _getPrimaryKey()
	{
		if($this->_primaryKey != null)
		{
			return $this->_primaryKey;
		}
		else
		{
			return $this->_primaryKey = $this->_database->getPrimaryKey($this->_getTableNameFromModel());
		}
	}

	private function _getTableNameFromModel()
	{
		if(!$this->isModelSet()) { throw new Exception('Model is not set.'); }

		return preg_replace('/^(db)?(.*)Model$/', '$2', get_class($this->getModel()));
	}
}