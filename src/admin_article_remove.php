<?php
session_start();
require_once('../config.php');
require('classes/Password.php');
require_once('classes/LDUtils.php');
require_once('classes/JsonHelper.php');
require_once('classes/Articles.php');


$p=new Password();
$p->readFromFile('../'.PASSWORD_FILE);

function removeArticle(){
	$url=$_GET['url'];
	$l=new Articles();
	if ($l->readFromFile('../'.ARTICLES_FILE)==FALSE) return FALSE;
	return $l->remove($_GET['url']) && $l->writeToFile('../'.ARTICLES_FILE);
}

$p->secure("Eliminazione Articolo","admin_articles_list.php",'removeArticle');
?>
