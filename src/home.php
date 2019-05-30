<?php 
require_once('classes/LDUtils.php');
require_once('classes/SocialAccounts.php');
require_once('classes/Organization.php');
require_once('classes/Styles.php');

$o=new Organization();
$o->readFromFile(ORGANIZATION_FILE);
$j=$o->json;
$s=new Styles();
$s->readFromFile(STYLES_FILE);

$title=htmlentities($j->{'foaf:name'});
$css=$s->json->selected;
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