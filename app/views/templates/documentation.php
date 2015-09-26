<!doctype html>
<html>
<head>
<meta charset="utf-8" /> 
<title><?= $templateModel->title;?></title>
<style>
body{ background: #333; color:#eee; font-family: arial, sans-serif; }
body > section { width: 800px; margin: 0 auto; position: relative; left: -100px; }
body > section > div { background: #666; width: 600px; padding: 10px; margin-left: 200px; }
body > section > div > em { display: block; color: #dda; margin-top: 15px; }
li, p { font-size: 13px; }
nav { float: left; background: #555; width: 180px; margin-top: 40px; border-radius: 4px 0 0 4px; padding: 10px; }
nav a { color: #dda; text-decoration: none; font-size: 13px; }
nav a:hover { text-decoration: underline; }
nav ul { list-style: none; padding: 0; margin: 0; }
</style>

<script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.js" type="text/javascript"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.css" type="text/css">
<style>
	/* desert scheme ported from vim to google prettify */
	pre.prettyprint { display: block; background-color: #333; tab-size:4; -moz-tab-size: 4; -o-tab-size:  4; white-space: pre-wrap; }
	pre .nocode { background-color: none; color: #000 }
	pre .str { color: #ffa0a0 } /* string  - pink */
	pre .kwd { color: #f0e68c; font-weight: bold }
	pre .com { color: #87ceeb } /* comment - skyblue */
	pre .typ { color: #98fb98 } /* type    - lightgreen */
	pre .lit { color: #cd5c5c } /* literal - darkred */
	pre .pun { color: #fff }    /* punctuation */
	pre .pln { color: #fff }    /* plaintext */
	pre .tag { color: #f0e68c; font-weight: bold } /* html/xml tag    - lightyellow */
	pre .atn { color: #bdb76b; font-weight: bold } /* attribute name  - khaki */
	pre .atv { color: #ffa0a0 } /* attribute value - pink */
	pre .dec { color: #98fb98 } /* decimal         - lightgreen */

	/* Specify class=linenums on a pre to get line numbering */
	ol.linenums { margin-top: 0; margin-bottom: 0; color: #AEAEAE } /* IE indents via margin-left */
	li.L0,li.L1,li.L2,li.L3,li.L5,li.L6,li.L7,li.L8 { list-style-type: none }
	/* Alternate shading for lines */
	li.L1,li.L3,li.L5,li.L7,li.L9 { }

	@media print {
	  pre.prettyprint { background-color: none }
	  pre .str, code .str { color: #060 }
	  pre .kwd, code .kwd { color: #006; font-weight: bold }
	  pre .com, code .com { color: #600; font-style: italic }
	  pre .typ, code .typ { color: #404; font-weight: bold }
	  pre .lit, code .lit { color: #044 }
	  pre .pun, code .pun { color: #440 }
	  pre .pln, code .pln { color: #000 }
	  pre .tag, code .tag { color: #006; font-weight: bold }
	  pre .atn, code .atn { color: #404 }
	  pre .atv, code .atv { color: #060 }
	}
</style>
</head>

<body>
<section>
	<nav>
		<p>MinnowMVCS Documentation</p>
		<ul>
			<li><a href="/documentation/index">Documentation Home</a></li>
			<li><a href="/documentation/controller">Controller</a></li>
			<li><a href="/documentation/routing">Routing</a></li>
			<li><a href="/documentation/model">Model</a></li>
			<li><a href="/documentation/view">View</a></li>
			<li><a href="/documentation/template">Template</a></li>
			<li><a href="/documentation/partialview">Partial View/loadController</a></li>
			<li><a href="/documentation/service">Service</a></li>
			<li><a href="/documentation/modelbuilder">Model Builder</a></li>
			<li><a href="/documentation/configurable">Configurable (custom config)</a></li>
			<li><a href="/documentation/db">DB</a></li>
		</ul>

		<p>Additional</p>
		<ul>
			<li><a href="/documentation/addonservices">Add-on Services</a></li>
		</ul>
	</nav>
	<div>
	<h1><?= $templateModel->title; ?></h1>
	<?= $templateModel->content; ?>
	</div>
</section>
</body>
</html>