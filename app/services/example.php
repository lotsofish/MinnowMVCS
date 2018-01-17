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
    
class example extends modelBuilder
{
	use configurable;

	const MODEL_NAME = 'exampleModel';

	public function __construct($core)
	{
		parent::__construct($core);
		
		// service constructor
		$this->getData();
	}

	// load the model
	public function getData()
	{
		// get configuration object from app/config/example.php
		$config = $this->getConfig();

		// sets model properties using the pseudo-property overrides from modelBuilder
		$this->name = $config->name;
		$this->email = $config->email;
		$this->html = '<h3>Some embeded HTML</h3>';
	}
}