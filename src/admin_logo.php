<?php
session_start();
require_once('../config.php');
require_once('classes/LDUtils.php');
require_once('classes/SocialAccounts.php');
require_once('classes/Organization.php');
require_once('classes/Logo.php');

$utils=new LDUtils();
$o=new Organization();
$l=new Logo(IMG_DIR);

if ($o->readFromForm($_POST))
	$o->storeInSession();
else{
	$o->readFromSession();
	if ((isset($_POST['clearLogo'])) && (strcmp($_POST['clearLogo'],'Rimuovi')===0)){
		$l->clearTmpLogo(basename($o->json->{'foaf:logo'}->{'@id'}), '../'.IMG_DIR);
		unset($o->json->{'foaf:logo'});
	} else if (isset($_FILES['newlogo'])){
		$filename=$l->upload('newlogo','../'.IMG_DIR);
		if (isset($o->json->{'foaf:logo'}) && substr($o->json->{'foaf:logo'}->{'@id'}, 0, strlen(IMG_DIR)) === IMG_DIR)
			$l->clearTmpLogo(basename($o->json->{'foaf:logo'}->{'@id'}), '../'.IMG_DIR);
		$utils->addObjectTripleIfNotEmpty($o->json, 'foaf:logo', IMG_DIR.'/'.$filename);
		$o->storeInSession();
	}
}
if (!isset($o->json))
	echo "<!-- NOOO -->\n";
else
	echo "<!--".(json_encode($o->json))."-->\n";
?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title>Pagina di Amministrazione - Logo</title>
	<meta charset="UTF-8" />
	 <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
	<h1>Pagina di Amministrazione - Logo</h1>
	<nav>
		<a href="admin.php">Indietro</a>
		<a href="admin_css.php">Avanti</a>
		<a href="admin_clear.php">Esci</a>
	</nav>
<?php
?>		
	
	<form action="admin_logo.php" method="POST" enctype="multipart/form-data">
<?php
if (isset($o->json->{'foaf:logo'})){
	$logo=$o->json->{'foaf:logo'}->{'@id'};
	$logoFileName=basename($logo);
	echo "\t<p class=\"logopreview\">\n\t\t<img src=\"../$logo\" alt=\"$logo\"/>\n\t\t<em>$logoFileName</em></p>\n\t\t<label for=\"logo\">Modifica Logo</label>\n";
} else {
	echo "\t<p class=\"logopreview\">\n\t\t<em>Nessun logo specificato</em></p>\n\t\t<label for=\"logo\">Inserisci Logo</label>\n";
}
?>
		<input type="file" name="newlogo" onchange="submit()" />
		<input type="submit" name="clearLogo" value="Rimuovi" />
	</form>
</body>
</html>
 