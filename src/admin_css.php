<?php 
session_start();
require_once('../config.php');
require_once('classes/LDUtils.php');
require_once('classes/SocialAccounts.php');
require_once('classes/Organization.php');
require_once('classes/Styles.php');

$o=new Organization();
if ($o->readFromForm($_POST))
	$o->storeInSession();
else
	$o->readFromSession();

$j=$o->json;

$s=new Styles();
if (!($s->readFromSession())){
	if (!($s->readFromFile("../".STYLES_FILE)))
		$s->readFromFile('styles_base.json');
	$selected=$s->json->selected;
	$s->storeInSession();
} else if ($s->readSelectedFromForm($_POST))
	$s->storeInSession();

$utils=new LDUtils();
$css= $utils->isAbsoluteUrl($s->json->selected) ? $s->json->selected : '../'.$s->json->selected ;
?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title>Pagina di Amministrazione - Stile di Presentazione</title>
	<meta charset="UTF-8" />
  	 <link id="style" rel="stylesheet" type="text/css" href="<?=$css?>" />
</head>
<body>
<nav>
	<a href="admin.php">Indietro</a>
	<form  method="POST">
		<!-- a href="admin.php">Indietro</a -->
		<label for="style">Seleziona uno stile</label>
		<select name="style" onchange="submit()">
<?php
	foreach($s->json->available as $style){
		$selectedStr=strcmp($style->url, $s->json->selected)===0 ? 'selected' : '';
		echo "\t\t\t<option value=\"$style->url\" $selectedStr>$style->label</option>\n";
	}
?>
		</select> 
	</form>
	<a href="admin_pwd.php">Avanti</a>
</nav>
<?php
require('home.php.inc');
?>
</body>
</html>
