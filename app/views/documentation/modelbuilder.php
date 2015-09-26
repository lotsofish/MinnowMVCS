<p>
	By extending the modelBuilder class, your service class can work more easily with a model. Each service class should only deal with one model if it extends modelBuilder.
</p>

<em>Example</em>
<pre class="prettyprint">
&lt;?php

class user extends modelBuilder
{
	public const MODEL_NAME = 'userModel';

	public constructor()
	{
		$this->load();
	}

	public function load()
	{
		// this could be a call to a web service, etc...
		$this->username = 'johndoe';
		$this->email = 'johndoe@example.com';
	}

	public function updateName($username)
	{
		$this->username = $username;
	}

	public function save()
	{
		// save the model
	}
}
</pre>
<pre class="prettyprint">
&lt;?php
class exampleController extends controller
{
	public function index()
	{
		$userService = $this->core->loadService('user');
		$this->view->load($userService->getModel())->title('Example')->show();

		// getModel() returns a userModel object
	}

	public function setUsername($username)
	{
		$userService = $this->core->loadService('user');
		$userService->updateName($username);

		$this->view->load($userService->getModel())->title('Example')->show();
	}
}
</pre>

<em>MODEL_NAME constant</em>
<p>
	By setting the MODEL_NAME constant, the service will automatically instantiate and work with that model. The value should be set to the class name of your model.
	This is optional and can be set later by calling setModel(), but in most cases it makes sense to use it.
</p>

<em>getModel()</em>
<p>
	Returns the model object.
</p>

<em>setModel()</em>
<p>
	You can pass in an already instatiated model to setModel(), or if a model has not been set, you can pass in a string to set the model. The path would be the same used in loadModel().
</p>
<pre class="prettyprint">
$userModel = $this->core->loadModel('user');
$userService = $this->core->loadService('user');
$userService->setModel($userModel);
</pre>

<em>Model pseudo-properties</em>
<p>
	The modelBuilder class allows you to set properties on the service that update the model instance it's working with. As shown in the example above, the load() method sets 
	$this->username and $this->email, which internally updates those properties on the model instance.
</p>
<p>
	<strong>Note: You cannot have public properties on your service object if it extends modelBuilder.</strong>
</p>

<em>constructor() instead of __construct()</em>
<p>
	If you need to define a constructor for your service, <strong>and it extends modelBuilder</strong>, you must use the name constructor() instead of the default __construct().
	This is necessary to keep constructor parameters defined as you normally would. You do not have to call parent::__construct() from constructor().
</p>