<em>Template View</em>
<p>
	The default template view is located in app/views/template/default.php. A template is an HTML wrapper around the content returned from your controllers/views.
</p>

<em>Default Template Model</em>
<p>
	There is a model used by your template, which can be accessed using $templateModel->propertyName. Properties on the default model are <strong>title</strong> and <strong>content</strong>.
</p>

<p>
	title - Set by the $this->view->title() call in your controller.<br>
	content - Contains the HTML returned by your controller/view.
</p>

<em>Custom Template Model</em>
<p>
	The default template model is provided in the system folder. You can create a new class that extends templateModel in the models folder if you need to pass additional items to your template, 
	and tell the view engine to use your template model by calling templateModel().
</p>
<pre class="prettyprint">
// file -- app/models/myTemplateModel.php

class myTemplateModel extends templateModel
{
	public $currentMenu;
}
</pre>
<pre class="prettyprint">
$myTemplateModel = $this->loadModel('myTemplateModel');
$myTemplateModel->currentMenu = 1;

$this->view->templateModel($myTemplateModel)->title('My Page')->show();
</pre>

<em>Different Template</em>
<p>
	If you need to create a separate template for certain controller action methods, you can tell the view engine to use a different template by calling $this->view->template('templateName'); 
	templateName corresponds to a file name in app/views/templates/ without the .php.
</p>