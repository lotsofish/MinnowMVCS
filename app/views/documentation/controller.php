<em>Basic controller definition</em>

<pre class="prettyprint">
&lt;?php
// file - app/controllers/example.php

class exampleController extends controller
{
	public function index()
	{
		$this->view->title('Example')->show();
	}
}
</pre>

<em>Controller Name</em>
<p>
	The controller name should be exactly matching to the file name, with 'Controller' added to it. 
	The class should extend controller.
</p>

<em>Action Methods</em>
<p>
	All public methods are action methods. 
</p>

<em>Showing the View</em>
<p>
	In this basic example, we are setting the title of the page to 'Example' and showing the view. No model is used in this example.
</p>
