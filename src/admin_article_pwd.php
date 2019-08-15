<?php
session_start();
require_once('../config.php');
require('classes/Password.php');
require_once('classes/Article.php');
require_once('classes/LDUtils.php');
require_once('classes/JsonHelper.php');
require_once('classes/Articles.php');


$p=new Password();
$p->readFromFile('../'.PASSWORD_FILE);

function writeArticle(){
	$filename=(new DateTimeImmutable())->format('YmdHisu').'.md';
	$a=new Article();
	$a->readFromSession();
	session_destroy();
	if ($a->writeToFile('../'.ARTICLES_DIR.'/'.$filename)==FALSE)
		return FALSE;

	$l=new Articles();
	if ($l->readFromFile('../'.ARTICLES_FILE)==FALSE) return FALSE;
	$l->add(ARTICLES_DIR.'/'.$filename,$a);
	$res=$l->writeToFile('../'.ARTICLES_FILE);
	return $res;
}

$p->secure("Nuovo Articolo","admin_article_preview.php",'writeArticle');
?>
