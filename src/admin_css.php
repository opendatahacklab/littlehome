<?php 
session_start();
require_once('../config.php');
require_once('classes/LDUtils.php');
require_once('classes/SocialAccounts.php');
require_once('classes/Organization.php');
require_once('classes/Styles.php');
require_once('classes/Articles.php');

$o=new Organization();
$o->readFromSession();
$j=$o->json;
$utils=new LDUtils();

$s=new Styles();
if (!($s->readFromSession())){
	$baseStyles = new Styles();
	$baseStyles->readFromFile('styles_base.json'); 
	if (!($s->readFromFile("../".STYLES_FILE)))
		$s=$baseStyles;
	else
		//here we import new available styles but with preserving selected
		$s->json->available=$baseStyles->json->available;
	$selected=$s->json->selected;
	$s->storeInSession();
} else if ($s->readSelectedFromForm($_POST))
	$s->storeInSession();

$utils=new LDUtils();
$css= $utils->isAbsoluteUrl($s->json->selected) ? $s->json->selected : '../'.$s->json->selected ;

if (isset($j->{'foaf:logo'}))
	$logo=$utils->isAbsoluteUrl($j->{'foaf:logo'}->{'@id'}) ? $j->{'foaf:logo'}->{'@id'} : '../'.$j->{'foaf:logo'}->{'@id'};

$l=new Articles();
$l->readFromFile('../'.ARTICLES_FILE); 

$srcpath='.';
$disablelinktxt='onclick="return false"';

?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title>LittleHome - Amministrazione Sito - Stile</title>
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
