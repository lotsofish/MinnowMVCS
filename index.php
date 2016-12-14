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


/*** 
 *** update this variable to the directory where the app files reside
 *** app files can be placed outside of the public root for better security 
 **/

$appLocation = 'app';

/***
 *** array of files that will be automatically loaded
 *** these files are located in the library folder
 ***/

$autoLoadLibraries = array();

/*** load the app ***/

require_once $appLocation . '/system/core.php';

$core = new core($appLocation, $autoLoadLibraries);
$core->loadController(isset($_GET['route']) ? $_GET['route'] : '');
