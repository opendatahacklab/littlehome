<?php 
require_once('classes/LDUtils.php');
require_once('classes/SocialAccounts.php');
require_once('classes/Organization.php');
require_once('classes/Styles.php');
require_once('classes/ConfigHelper.php');
require_once('classes/Articles.php');

$c=new ConfigHelper(ORGANIZATION_FILE, STYLES_FILE);
$j=$c->organization->json;

$title=$c->getName();
$css=$c->getCSS();

if (isset($j->{'foaf:logo'}))
	$logo=$j->{'foaf:logo'}->{'@id'};

$l=new Articles();
$l->readFromFile(ARTICLES_FILE) or die('unable to read '.ARTICLES_FILE); 

$utils=new LDUtils();
$srcpath='src';
$uri=$utils->getCurrentPageURI();
$disablelinktxt='';
?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title><?=$title?></title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="<?=$css?>" />
	<meta property="og:url" content="<?=$uri?>" />	
	<meta property="og:title" content="<?=$title?>" />
	<meta property="og:type" content="website" />
</head>
<body>
<?php
require('home.php.inc');
include('fbshare.php.inc');
?>
</body>
</html>
