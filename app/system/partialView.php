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

class partialView extends view
{
	public function __construct($core)
	{
		parent::__construct($core);
	}

	public function get($model, $viewFile)
	{		
		$this->_model = $model;
		$this->_viewFile = $viewFile;
		
		return $this->_getViewContent();		
	}

	public function load($model, $viewFile='') { throw new Exception('Not implemented for partial view.'); }

	public function show() { throw new Exception('Not implemented for partial view.'); }
	
	public function template($templateName) { throw new Exception('Not implemented for partial view.'); }

	public function templateModel($templateModel) { throw new Exception('Not implemented for partial view.'); }
	
	public function title($title) { throw new Exception('Not implemented for partial view.'); }
	
}