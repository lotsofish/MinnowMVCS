<em>Example</em>
<pre class="prettyprint">
&lt;?php
// file - app/controllers/example.php

class exampleController extends controller
{
	public function user($username)
	{
		$this->view->title($username)->show();
	}
}
</pre>

<p>
	All routes are formatted as follows:
</p>
<p>
	{Controller}/{Action Method}/{Parameters...}
</p>
<p>
	If no {Controller}/{Action Method} is supplied, it will default to indexController.index.
</p>

<em>Parameters</em>
<p>
	Any URL parts past the controller and action method will become parameters to the action method. Query string parameters can still be accessed using $_GET.
</p>

<pre class="prettyprint">
// http://www.example.com/example/user/johndoe/55/male
// equivalent to calling
$exampleController->user('johndoe', 55, 'male');
</pre>