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

class mysql implements iDbAccess
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function select($table, $primaryKey, $where = null)
	{
		$parameters = null;
		if(is_numeric($where))
		{
			$this->_validatePrimaryKey($primaryKey, $table);
			$where = ' where `' . $primaryKey . '`=' . $where;
		}
		else if(is_array($where))
		{
			$clauses = array();
			$parameters = array();
			foreach($where as $key => $value)
			{
				array_push($clauses, '`' . $key . '` = ?');
				array_push($parameters, $value);
			}

			$where = ' where ' . implode(' and ', $clauses);
		}
		else
		{
			$where = '';
		}

		return $this->db->query("select * from `" . $table . "`" . $where, $parameters);
	} 

	public function add($table, $model, $primaryKey)
	{
		$this->_validatePrimaryKey($primaryKey, $table);

		$setArray = array();
		$parameters = array();

		foreach(get_class_vars(get_class($model)) as $field => $value)
		{
			if($field != $primaryKey)
			{
				array_push($setArray, '`' . $field . '`=?');
				array_push($parameters, $model->$field);
			}
		}
		$set = implode(',', $setArray);
		return $this->db->query('insert into `' . $table . '` set ' . $set, $parameters);
	}

	public function update($table, $model, $primaryKey)
	{
		$this->_validatePrimaryKey($primaryKey, $table);

		$setArray = array();
		$parameters = array();

		foreach(get_class_vars(get_class($model)) as $field => $value)
		{
			if($field != $primaryKey)
			{
				array_push($setArray, '`' . $field . '`=?');
				array_push($parameters, $model->$field);
			}
		}
		$set = implode(',', $setArray);
		return $this->db->query('update `' . $table . '` set ' . $set . ' where `' . $primaryKey . '`=' . db::getDbo()->quote($model->$primaryKey), $parameters);
	}

	public function delete($table, $id, $primaryKey)
	{
		$this->_validatePrimaryKey($primaryKey, $table);
		return $this->db->query('delete from `' . $table . '` where `' . $primaryKey . '`=?', array($id));
	}

	public function getPrimaryKey($tableName)
	{
		$primaryKey = '';
		$result = db::getDbo()->query("show columns from " . $tableName . " where `Key`='PRI'");

		if($result->rowCount())
		{
			$primaryKey = $result->fetch()['Field'];
		}
		return $primaryKey;
	}

	private function _validatePrimaryKey($primaryKey, $table)
	{
		if($primaryKey == '')
		{
			throw new Exception('DB table ' . $table . ' does not define a primary key.');
		}
	}
}
