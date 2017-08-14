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

class view 
{
	protected $core;
	protected $_viewFile;
	private $_template;
	private $_templateModel;
	protected $_model;

	public function __construct($core)
	{
		$this->core = $core;
		$this->_template = 'default';
		$this->_templateModel = $this->core->loadModel('template');
	}

	public function load($model, $viewFile='')
	{		
		$this->_model = $model->htmlEncoded();

		if($viewFile != '')
		{
			$this->_viewFile = $viewFile;
		}

		return $this;
	}

	public function template($templateName)
	{
		$this->_template = $templateName;

		return $this;
	}

	public function templateModel($templateModel)
	{
		$this->_templateModel = $templateModel;

		return $this;
	}

	public function getTemplateModel()
	{
		return $this->_templateModel;
	}

	public function title($title)
	{
		$this->_templateModel->title = $title;
		return $this;
	}

	public function show()
	{
		if($this->_viewFile == null) 
		{ 
			$backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1];
			$this->_viewFile = preg_replace('/Controller$/', '', $backtrace['class']) . '/' . $backtrace['function'];
		}

		$this->_templateModel->content = $this->_getViewContent();
		$templateModel = $this->_templateModel;

		require $this->core->rootDir() . '/views/templates/' . $this->_template . '.php';
	}

	public function partial($model, $viewFile)
	{
		$partial = new partialView($this->core);
		return $partial->include($model, $viewFile);
	}

	protected function _getViewContent()
	{
		$model = $this->_model;

		ob_start();
		require $this->_getPath();
		return ob_get_clean();
	}

	protected function _getPath()
	{
		$filePath = $this->core->rootDir() . '/views/' . $this->_viewFile . '.php';

		return $filePath;
	}
}
