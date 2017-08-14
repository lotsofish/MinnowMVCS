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

class indexController extends controller
{
	// redirect to documentation
	public function index()
	{
		header('Location: /documentation');
	}

	// Example action method below which shows an example of a service, model, and config
	public function example()
	{
		// Creates a new instance of the example service 
		$exampleService = $this->core->loadService('example'); 

		// loads the model into the view, sets the title and shows the view
		$this->view->load($exampleService->getModel())->title('Example')->show();
	}
}