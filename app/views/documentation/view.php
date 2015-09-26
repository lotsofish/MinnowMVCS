<em>Controller</em>
<p>
	Building on our previous examples, we will create a controller action method, load a model, and show a view.
</p>

<pre class="prettyprint">
&lt;?php
// file - app/controllers/example.php

class exampleController extends controller
{
	public function index()
	{
		$userModel = $this->core->loadModel('user');

		// example only, populate model
		// this would normally go in a service
		$userModel->username = 'johndoe';
		$userModel->email = 'johndoe@example.com';

		$this->view->load($userModel)->title('Example')->show();
	}
}
</pre>

<em>The View file</em>
<pre class="prettyprint">
&lt;!-- file - app/views/example/index.php --&gt;

&lt;h1&gt;Welcome &lt;?= $model->username; ?&gt;&lt;/h1&gt;
</pre>

<em>File name and location</em>
<p>
	The View file should be named to match the action method. The file should be placed in a folder matching the controller name in the app/views folder.
</p>

<em>Accessing the Model</em>
<p>
	In the controller example above, we pass in a userModel object to the load() method. This sets the model for the view. In your view file, you can access the
	model's properties using $model.
</p>
<pre class="prettyprint">
&lt;?= $model->propertyname; ?&gt;
</pre>

<p>
	After calling $this->view->load(), properties on the model are converted to html encoded values to prevent XSS attacks. You can get the original values by calling raw() in your view.
</p>
<pre class="prettyprint">
&lt;?= $model->raw('propertyName'); ?&gt;
</pre>

<em>Setting the Title</em>
<p>
	In your controller, call $this->view->title() to set the title of the page.
</p>
<p>
	Note: The calls to methods on $this->view are all chainable.
</p>

<pre class="prettyprint">
$this->view->title('My Page')->show();
</pre>

