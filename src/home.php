<?php 
require_once('classes/LDUtils.php');
require_once('classes/SocialAccounts.php');
require_once('classes/Organization.php');
require_once('classes/Styles.php');
require_once('classes/ConfigHelper.php');

$c=new ConfigHelper(ORGANIZATION_FILE, STYLES_FILE);
$j=$c->organization->json;

$title=htmlentities($j->{'foaf:name'});
$css=$c->styles->json->selected;

if (isset($j->{'foaf:logo'}))
	$logo=$j->{'foaf:logo'}->{'@id'};

$srcpath='src';
?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title><?=$title?></title>
	<meta charset="UTF-8" />
	 <link rel="stylesheet" type="text/css" href="<?=$css?>">
</head>
<body>
<?php
require('home.php.inc');
?>
</body>
</html>