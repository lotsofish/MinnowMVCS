<em>Example</em>
<pre class="prettyprint">
&lt;?php
// file - app/models/user.php

class userModel extends model
{
	public $username;
	public $email;
}
</pre>

<em>Model name</em>
<p>
	The model name should exactly match the file name, with 'Model' added to it. The class should extend model.
</p>

<em>Models hold data (Data Model)</em>
<p>
	While you are not limited on what you can do in a model since afterall they are just a PHP class, it is recommended that your models only contain public properties. Models will be populated 
	by a service.
</p>

<em>Subdirectories</em>
<p>
	You can put your model files in a subdirectory in the models folder. Your model name will become {folderName}{className}Model.
</p>
<pre class="prettyprint">
&lt;?php
// file - app/models/user/customer.php

class usercustomerModel extends model
{
	// ...
}
</pre>

<em>Loading a model</em>
<p>To create an instance of your model, call $this->core->loadModel('modelName');
<pre class="prettyprint">
&lt;?php
$userModel = $this->core->loadModel('user');

// loading a model in a subdirectory
$userprofileModel = $this->core->loadModel('user/profile');
</pre>

<em>Loading a model from POST data</em>
<p>You can fill a model from an HTTP POST by using the <strong>populateFromPost()</strong> method.</p>
<pre class="prettyprint">
&lt;?php
// in controller - $_POST contains data
$myModel = $this->core->loadModel('myModel');
$myModel->populateFromPost();
?&gt;
</pre>