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

$utils=new LDUtils(); 
$c=new ConfigHelper('../'.ORGANIZATION_FILE, '../'.STYLES_FILE);
//$orgName=$c->organization->json->{'foaf:name'};
$orgName=$c->getName();
$css=$c->getCss('../');
$logo=$c->getLogo('../');
$address=$c->getAddress('../');
$a=Article::readFromGETParameterURL();
$title=$a->title;
$uri=$utils->getCurrentPageURI();
?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title><?=$orgName;?></title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="<?=$css?>">
	<meta property="og:title" content="<?=title?>" />
	<meta property="og:type" content="article" />
</head>
<body>
<?php
include('viewArticle.php.inc');
?>

<p class="share">
<!-- see https://developers.facebook.com/docs/plugins/share-button/ -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/it_IT/sdk.js#xfbml=1&version=v4.0"></script>
<div class="fb-share-button" data-href="<?=$uri?>" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=urlencode($uri)?>%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Condividi</a></div>
</p>

</body>
</html>
