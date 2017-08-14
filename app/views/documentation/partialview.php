<em>Including a Partial View</em>
<p>
	You can include content from another view file from within the current view, by calling $this->partial($model, 'viewFile');
</p>
<pre class="prettyprint">
&lt;div&gt;
	&lt;?= $this->partial($model, 'partialView'); ?&gt;
&lt;/div&gt;

&lt;div&gt;
	&lt;?= $this->partial($model->partialModel, 'partialView'); // limit model in partial view to a property on this view's model ?&gt; 
&lt;/div&gt;
</pre>

<em>Calling Another Controller from a View</em>
<p>
	You can also call another controller action method and include the entire content from inside your view. 
</p>

<pre class="prettyprint">
&lt;?php $this->core->loadController('menu/index'); ?&gt;
</pre>

<p>
	The parameter passed into loadController is the 'route path', which is equivalent to the url after the domain name.<br>
	<br>
	Ex: You have a controller named userController with an action method called profile with a parameter of $userId.
</p>
<pre class="prettyprint">
&lt;?php $this->core->loadController('user/profile/1'); ?&gt;
</pre>