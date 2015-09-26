<p>
	A service is a class that contains program logic. It can contain code that handles business rule logic, database access, or anything else that doesn't belong in your presentation layer code.
</p>

<em>Basic service definition</em>
<pre class="prettyprint">
&lt;?php
// file - app/services/user.php

class user
{
	private $username; 

	public __construct($username='')
	{
		$this->username = $username;
	}

	public function getData()
	{
		return 'data';
	}
}
</pre>

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
// equivalent to
$userService = new user('johndoe');
</pre>