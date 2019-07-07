<?php
/**
  * Show an article whose source is written in MarkDown.
  */
require_once('../config.php');
require_once('classes/LDUtils.php');
require_once('classes/Organization.php');
require_once('classes/Styles.php');
require_once('classes/ConfigHelper.php');
require_once('classes/Michelf/MarkdownInterface.php');
require_once('classes/Michelf/Markdown.php');
require_once('classes/Article.php');

$c=new ConfigHelper('../'.ORGANIZATION_FILE, '../'.STYLES_FILE);
//$orgName=$c->organization->json->{'foaf:name'};
$orgName=$c->getName();
$css=$c->getCss('../');
$a=Article::readFromGETParameterURL();
?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title><?=$orgName;?></title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="<?=$css?>">
</head>
<body>
<?php
if (!$a) echo "<p>No such article</p>\n";
else {
	echo "<p class=\"orgName\"><a href=\"../index.php\">$orgName</a></p>\n";
	echo "<h1>$a->title</h1>\n";
	$dateStr=$a->getDateFormatted();
	if ($dateStr!==null){
		echo "<p class=\"date\">$dateStr</p>\n";
	}
	echo $a->content;
}
?>
</body>
</html>