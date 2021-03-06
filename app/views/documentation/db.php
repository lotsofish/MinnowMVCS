<em>Optional Service</em>
<p>
	Database access is commonly necessary, so this service is provided as a way to simplify access using PHP's PDO library. Use of this service is not required.
</p>

<em>DB Config</em>

<p>
	The db class uses PHP PDO for data access. Currently, MySQL is supported (The add, update, and delete require DB specific code to calculate the primary key.)
</p>

<pre class="prettyprint">
// file - app/config/db.php

$dbConfig = array(
	'connectionString' => 'mysql:dbname={database_name};host=localhost',
	'user' => '{username}',
	'pass' => '{password}',
	'driverOptions' => null
);
</pre>

<em>DB Model</em>
<p>
	Database models are just like any other model you will define. The db service does not use the modelBuilder class, but it will return model objects from it's methods.
</p>

<em>Instantiating a DB class object</em>
<p>
You can instantiate a new db object by calling loadService. The first parameter is the service name: 'db', the second parameter is the table you are working with, and the third parameter is the path to the model you are using. The tableName parameter is optional. If not supplied, you will only be able to use the query() method.
</p>

<p>
The PDO object is static and reused for all db instances, so working with multiple copies of db will not cause additional connections to the database.
</p>

<pre class="prettyprint">
$db = $this->core->loadService('db', 'user', db/user');
</pre>

<em>Sending SQL to the DB</em>
<p>
Queries should use question marks in place of values, and pass in the values in an array. This uses PDO's prepared statements to prevent SQL injection attacks.
</p>
<p>
The return value is a PDOStatement object.
</p>

<pre class="prettyprint">
$db->query('insert into user (username, email) values (?, ?)', array($value1, $value2));
</pre>

<pre class="prettyprint">
$users = $db->query('select * from user'); // get all users
for($users as $user)
{
	echo $user->username . '&lt;br/&gt;';
}
</pre>

<em>Select, Add, Update, Delete</em>
<p>
If you are working with a single table that defines a primary key (autoincrement field) and pass the table name to the db service's loadService call, you can use the select, add, update and delete methods to simplify data access. 
</p>

<pre class="prettyprint">
$db = $this->core->loadService('db', 'user', 'db/user');
$data = $db->select($id); // $id == primary key value
$users = $db->select(); // select all users
$usersNamedJoe = $db->select(array('name'=>'joe')); // select * from user where name = 'joe';

$userModel = $this->core->loadModel('db/user');
$userModel->user = 'JohnDoe':
$userModel->email = 'johndoe@example.com';
$db->add($userModel);

$userModel->id = $db->insertId(); // get the last inserted id
$userModel->email = 'jd@example.com';
$db->update($userModel);

$db->delete(4); // delete id == 4
</pre>