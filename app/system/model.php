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

class model 
{
	private $_rawData;

	public function __construct()
	{
		$this->_rawData = array();
	}

	public function htmlEncoded()
	{
		if(count($this->_rawData) == 0)
		{
			foreach(get_object_vars($this) as $propertyName => $propertyValue)
			{
				if($propertyName != '_rawData') 
				{ 
					$this->_rawData[$propertyName] = $propertyValue;
				}
			}
		}

		foreach($this->_rawData as $propertyName => $propertyValue)
		{
			$this->$propertyName = htmlentities($propertyValue, ENT_QUOTES);
		}

		return $this;
	}

	public function raw($propertyName)
	{
		return $this->_rawData[$propertyName];
	}
}