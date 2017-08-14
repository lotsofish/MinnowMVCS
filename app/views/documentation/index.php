<em>What is this?</em>
<p>
	MinnowMVCS is a lightweight, fully object oriented PHP MVCS framework that simplifies the use of basic data models 
	and service layer classes to populate them.
</p>

<p>
	The main goals are:
</p>

<ul>
	<li>Truely lightweight - Today's &quot;lightweight&quot; MVC frameworks for PHP aren't really that lightweight anymore.</li>
	<li>Make it easy to develop using models for data only. - Recommended design pattern is to use models as data models and place all business logic and data access code into 
	separate service layer classes, and the framework has objects to help make this easier.</li>
	<li>Minimal learning curve - Let developers write code. With a minimal set of core functionality as a starting point, you'll get up and running faster.</li>
	<li>Provide a complete MVCS framework - Routing, controllers, models, views, service layer integration, partial views, templating, and configuration access are all included. 
	A database access class (currently working with MySql) is also provided to make working with PHP's PDO library easier.</li>
</ul>

<em>Requirements</em>
<p>
	Current requirements:
	<ul>
		<li>Apache Server (.htaccess rewrite rules are necessary)</li>
		<li>PHP 5.4 or higher</li>
	</ul>
</p>

<em>Getting started</em>
<p>
	Download the package and upload the entire framework to your web root. Make sure your server supports .htaccess overrides and allows Apache rewrite rules. 
	The default download should load and display this documentation.
</p>

<p>
	You can load an example action method at <a href="/index/example">/index/example</a>. This shows basic usage of a controller, action method, model, service, and config. Before beginning your project, 
	you may want to remove the example files and the documentation files.
</p>

<em>Version Info</em>
<ul>
	<li>
		<em>0.14 - August 13, 2017</em>
		<p>Many updates and improvements to modelBuilder, service, db. Minor bug fixes.</p>
	</li>
	<li>
		<em>0.13 - July 24, 2017</em>
		<p>Add populateFromPost() model method and DB updates</p>
	</li>
	<li>
		<em>0.12 - December 14, 2016</em>
		<p>Add user login service</p>
	</li>
	<li>
		<em>0.11 - Februrary 6, 2016</em>
		<p>Bug fixes for HTML encoding view models</p>
	</li>
	<li>
		<em>0.1 - September 25, 2015</em>
		<p>Initial release. Code should be usable, but new.</p>
	</li>
</ul>