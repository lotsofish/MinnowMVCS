<p>
	If you are writing a service class, you may need configuration settings associated with that service. 'configurable' is defined as a trait, which can be included in any class (though a service is
	the most likely use.)
</p>

<pre class="prettyprint">
&lt;?php

class user extends modelBuilder
{
	use configurable;

	private _saveModelToWebService()
	{
		$config = $this->getConfig();

		$wsUrl = $config->wsUrl;

		//...
	}
}
</pre>
<pre class="prettyprint">
// file - app/config/user.php

$userConfig = array(
	'wsUrl' => 'http://www.example.com', 
	'timeout' => 30
);
</pre>

<em>Naming</em>
<p>
	The name of the file should match the name of the class you are configuring. The file should define an array assigned to the class name you are calling it from + 'Config';
</p>

<em>use configurable;</em>
<p>
	configurable is defined as a trait, which adds the getConfig() method to the class you include use configurable in. 
</p>

<em>Config object</em>
<p>
	getConfig() reads the array in your config file, and converts it to an object.
</p>