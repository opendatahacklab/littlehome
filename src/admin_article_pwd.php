<?php
session_start();
require_once('../config.php');
require('classes/Password.php');
require_once('classes/Article.php');
require_once('classes/LDUtils.php');
require_once('classes/JsonHelper.php');
require_once('classes/Articles.php');
require_once('classes/AdminArticleUtils.php');


$p=new Password();
$p->readFromFile('../'.PASSWORD_FILE);

function writeArticle(){
	$filename=(new DateTimeImmutable())->format('YmdHisu').'.md';
	$a=new Article();
	$a->readFromSession();
	session_destroy();
	$u=new AdminArticleUtils(ARTICLES_DIR, ARTICLES_FILE);
	return $u->addArticle($filename, $a, '..');
}

$p->secure("Nuovo Articolo","admin_article_preview.php",'writeArticle');
?>
