<?php
session_start();
require_once('../config.php');
require('classes/Password.php');
require_once('classes/Article.php');


$p=new Password();
if (!$p->readFromFile('../'.PASSWORD_FILE))
	echo "<!-- HAIAIAIAIAI --\n";

function writeArticle(){
	$filename=(new DateTimeImmutable())->format('YmdHisu').'.md';
	$a=new Article();
	$a->readFromSession();
	return $a->writeToFile('../'.ARTICLES_DIR.'/'.$filename);
}

$p->secure("Nuovo Articolo","admin_article_preview.php",'writeArticle');
?>
