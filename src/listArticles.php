<?php
/**
  * Show an article whose source is written in MarkDown.
  */
require_once('../config.php');
require_once('classes/LDUtils.php');
require_once('classes/Organization.php');
require_once('classes/Styles.php');
require_once('classes/ConfigHelper.php');
require_once('classes/Articles.php');

$c=new ConfigHelper('../'.ORGANIZATION_FILE, '../'.STYLES_FILE);
$orgName=$c->getName();
$css=$c->getCss('../');

$l=new Articles();
$l->readFromFile('../'.ARTICLES_FILE) or die('unable to read ../'.ARTICLES_FILE); 

$utils=new LDUtils();
?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title><?=$orgName;?> - Articoli</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="<?=$css?>">
</head>
<body>
	<header>
		<h1><?=htmlentities($orgName)?> - Articoli</h1>		
	</header>
	
	<ol>
<?php
	foreach($l->json->{'rss:items'}->{'rdf:li'} as $a){
		$title=$a->{'rss:title'};
		$url=$a->{'@id'};
		$date=DateTime::createFromFormat(DateTimeInterface::ISO8601, $a->{'dc:date'})->format('d/m/Y');
		if (!$utils->isAbsoluteURL($url))
			$url='viewArticle.php?url='.urlencode('../'.$url);
		echo "<li><em class=\"date\">$date</em> <a href=\"$url\">$title</a></li>\n";
	}
?>		
	</ol>

</body>
</html>