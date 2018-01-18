<em>API</em>

<p>
	An API controller is a special controller that automaticaly json encodes the return value from the controller.
</p>

<pre class="prettyprint">
&lt;?php
// file - app/controllers/api.php
class apiController extends api
{
    public function index()
    {
        $exampleService = $this->core->loadService('example');
        $exampleService->getData();
        return $exampleService->getModel();
    }
}

// output: json encoded object containing the example service model
</pre>

