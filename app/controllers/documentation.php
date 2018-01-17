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

class documentationController extends controller
{
	public function index()
	{
		$this->view->template('documentation')->title('Documentation')->show();
	}

	public function controller()
	{
		$this->view->template('documentation')->title('Controller')->show();
	}

	public function routing()
	{
		$this->view->template('documentation')->title('Routing')->show();
	}

	public function model()
	{
		$this->view->template('documentation')->title('Model')->show();
	}

	public function view()
	{
		$this->view->template('documentation')->title('View')->show();
	}

	public function template()
	{
		$this->view->template('documentation')->title('Template')->show();
	}

	public function partialview()
	{
		$this->view->template('documentation')->title('Partial View and loadController')->show();
	}

	public function service()
	{
		$this->view->template('documentation')->title('Service')->show();
	}

	public function modelbuilder()
	{
		$this->view->template('documentation')->title('ModelBuilder')->show();
	}

	public function configurable()
	{
		$this->view->template('documentation')->title('Configurable')->show();
	}

	public function db()
	{
		$this->view->template('documentation')->title('DB')->show();
	}

	public function addonservices()
	{
		$this->view->template('documentation')->title('Additional Services')->show();
	}
}