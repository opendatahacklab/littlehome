<?php
require_once('../config.php');
require('classes/Password.php');
require_once('classes/LDUtils.php');
require_once('classes/SocialAccounts.php');
require_once('classes/Organization.php');
require_once('classes/Styles.php');
require_once('classes/Logo.php');

session_start();
$p=new Password();
if (isset($_POST['password'])){
		$password=$_POST['password'];
		$o=new Organization();
		$o->readFromSession();

		$s=new Styles();
		$s->readFromSession();

		$l=new Logo('../'.IMG_DIR);
		$l->getTmpLogoFromOrgJson($o->json);

		if ($p->readFromFile('../'.PASSWORD_FILE))
			if ($p->check($password)){
				$o->writeToFile('../'.ORGANIZATION_FILE);
				$s->writeToFile('../'.STYLES_FILE);
				$l->handleTmpLogoConfirmed();
				session_destroy();
				include('admin_save.php.inc');
			} else {
				$message="<p>Password Errata</p>\n";
				include('admin_pwd.php.inc');
			}
		else {
			if (strcmp($password, $_POST['confirm'])===0){
				$p->writeToFile($password,'../'.PASSWORD_FILE);		
				$o->writeToFile('../'.ORGANIZATION_FILE);
				$s->writeToFile('../'.STYLES_FILE);
				session_destroy();
				include('admin_save.php.inc');
			} else {
				$message="<p>Le due password non coincidono</p>";
				include('admin_create_pw.php.inc');
			}
		}
} else if ($p->readFromFile('../'.PASSWORD_FILE)){
	$message="";
	include('admin_pwd.php.inc');
} else {
	$message="";
	include('admin_create_pw.php.inc');
}
?>
