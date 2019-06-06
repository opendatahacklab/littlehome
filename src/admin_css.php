<?php 
session_start();
require_once('../config.php');
require_once('classes/LDUtils.php');
require_once('classes/SocialAccounts.php');
require_once('classes/Organization.php');
require_once('classes/Styles.php');

$o=new Organization();
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

if (isset($j->{'foaf:logo'}))
	$logo=$utils->isAbsoluteUrl($j->{'foaf:logo'}->{'@id'}) ? $j->{'foaf:logo'}->{'@id'} : '../'.$j->{'foaf:logo'}->{'@id'};

?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title>FriendlyHome - Amministrazione Sito - Stile</title>
	<meta charset="UTF-8" />
  	 <link id="style" rel="stylesheet" type="text/css" href="<?=$css?>" />
  	 <link id="style" rel="stylesheet" type="text/css" href="admin_css.css" />
</head>
<body>
<nav class="friendlyhome_admin_css">
	<a href="admin_logo.php" class="w3-btn w3-teal">&#10094; Indietro</a>
	<form  method="POST">
		<!-- a href="admin.php">Indietro</a -->
		<label for="style">Seleziona uno stile</label>
		<select name="style" onchange="submit()" class="w3-input">
<?php
	foreach($s->json->available as $style){
		$selectedStr=strcmp($style->url, $s->json->selected)===0 ? 'selected' : '';
		echo "\t\t\t<option value=\"$style->url\" $selectedStr>$style->label</option>\n";
	}
?>
		</select> 
	</form>
	<a href="admin_clear.php" class="w3-btn w3-teal">Esci &#10006;</a>
	<a href="admin_pwd.php" class="w3-btn w3-teal">Avanti &#10095;</a>
</nav>
<?php
require('home.php.inc');
?>
</body>
</html>
