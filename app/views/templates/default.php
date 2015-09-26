<!doctype html>
<html>
<head>
<meta charset="utf-8" /> 
<title><?= $templateModel->title;?></title>
<style>
body{ background: #333; color:#eee; font-family: arial, sans-serif; }
body > div { background: #666; width: 600px; padding: 10px; margin: auto;}
body > div > em { display: block; color: #dda; margin-top: 15px; }
a { color: #dda; }
</style>
</head>

<body>
	<div>
		<h1><?= $templateModel->title; ?></h1>
		<?= $templateModel->content; ?>
	</div>
</body>
</html>