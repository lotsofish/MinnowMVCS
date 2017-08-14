<p>
	A service is a class that contains program logic. It can contain code that handles business rule logic, database access, or anything else that doesn't belong in your presentation layer code.
</p>

<em>Basic service definition</em>
<pre class="prettyprint">
&lt;?php
// file - app/services/user.php

class user extends service
{
	private $username; 

	public __construct($core, $username='')
	{
		parent::__construct($core);
		$this->username = $username;
	}

	public function getData()
	{
		return 'data';
	}
}
</pre>

<em>Constructor</em>
<p>Your service should extend the service class. If you need a constructor in your service, use the standard __construct name accepting $core as the first argument. Call parent::__construct($core); on the first line of your constructor.
</p>

<em>Instantiate a service</em>
<p>
	You can create an instance of your service class by calling $this->core->loadService('serviceName');
</p>
<pre class="prettyprint">
$userService = $this->core->loadService('user');
</pre>

<em>Passing in constructor parameters</em>
<p>
	Additional parameters to loadService will be passed in to the constructor.
</p>
<pre class="prettyprint">
$userService = $this->core->loadService('user', 'johndoe');
</pre>