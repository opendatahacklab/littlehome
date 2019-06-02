<?php 
require_once('../config.php');
require_once('classes/LDUtils.php');
require_once('classes/SocialAccounts.php');
require_once('classes/Organization.php');
require_once('classes/Logo.php');

session_start();

$o=new Organization();
$l=new Logo('../'.IMG_DIR);

if (!$o->readFromSession()){
	$o->readFromFile("../".ORGANIZATION_FILE);
	$l->storeOldLogoInSession($o->json);
}

//name is mandatory
$name=isset($o->json->{'foaf:name'}) ? $o->json->{'foaf:name'} : '';
$description=isset($o->json->{'dcterms:description'}) ? $o->json->{'dcterms:description'} : '';
$logo=isset($o->json->{'foaf:logo'}) ? $o->json->{'foaf:logo'}->{'@id'} : '';
$mail=isset($o->json->{'foaf:mbox'}) ? substr($o->json->{'foaf:mbox'}->{'@id'},7) : '';
?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title>Pagina di Amministrazione - Informazioni di Base</title>
	<meta charset="UTF-8" />
	 <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
	<h1>Pagina di Amministrazione - Informazioni di Base</h1>
	<form action="admin_logo.php" method="POST" enctype="multipart/form-data">
		<label for="name">Nome</label><input type="text" name="name" value="<?=$name?>" required />
		<label for="description">Descrizione</label>
<?php
if ($logo!=='')
	echo "\t\t<input type=\"hidden\" name=\"logo\" value=\"$logo\" />\n"
?>
		<textarea name="description" rows="10" cols="20"><?=$description?></textarea>
		<fieldset>
			<legend>Indirizzo</legend>
<?php
if (isset($o->json->{'org:hasPrimarySite'}) && isset($o->json->{'org:hasPrimarySite'}->{'locn:address'})){
	$address=$o->json->{'org:hasPrimarySite'}->{'locn:address'};
	$thoroughfareValueStr=isset($address->{'locn:thoroughfare'}) ? 'value="'.$address->{'locn:thoroughfare'}.'"' : ''; 
   	$locatorDesignatorValueStr=isset($address->{'locn:locatorDesignator'}) ? 'value="'.$address->{'locn:locatorDesignator'}.'"' : '';
	$poBoxValueStr=isset($address->{'locn:poBox'}) ? 'value="'.$address->{'locn:poBox'}.'"':'';
	$postNameValueStr=isset($address->{'locn:postName'}) ? 'value="'.$address->{'locn:postName'}.'"':'';
} else {
	$thoroughfareValueStr=''; 
	$locatorDesignatorValueStr='';
	$poBoxValueStr='';
	$postNameValueStr='';
}
?>
			<label for="thoroughfare">Via/Strada/Piazza</label> <input type="text" name="thoroughfare" <?=$thoroughfareValueStr?> />
			<label for="locatorDesignator">Numero Civico</label> <input type="text" name="locatorDesignator" <?=$locatorDesignatorValueStr?> />
			<label for="poBox"><abbr title="Codice di Avviamento Postale">CAP</abbr></label> <input type="text" name="poBox" <?=$poBoxValueStr?> />
		       	<label for="postName">Comune</label> <input type="text" name="postName" <?=$postNameValueStr?> />
		</fieldset>

		<fieldset>
			<legend>Contatti</legend>
			<label for="email">e-mail</label> (lasciare vuoto se non disponibile) <code>mailto:</code><input name="email" type="email" value="<?=$mail?>" />
<?php
$socialAccounts=new SocialAccounts();
foreach($socialAccounts->presentations as $service => $presentation){
	$serviceId=$presentation->accountTypeDescription;
	$account=$socialAccounts->getAccount($o->json,$service);
	$nameField=$presentation->nameField;
	$urlField=$presentation->urlField;
	echo "\t\t\t<fieldset>\n\t\t\t\t<legend>$serviceId</legend>\n";
	if ($account===NULL){
		echo "\t\t\t\t<label for=\"$nameField\">Nome dell'account</label><input type=\"text\" name=\"$nameField\" />\n";
		echo "\t\t\t\t<label for=\"$urlField\">indirizzo pubblico (URL) dell'account</label><input type=\"url\" name=\"$urlField\" />\n";
	} else {
		$accountName=$account->{'foaf:accountName'};
		$accountURL=$account->{'@id'};
		echo "\t\t\t\t<label for=\"$nameField\">Nome dell'account</label><input type=\"text\" name=\"$nameField\" value=\"$accountName\"/>\n";
		echo "\t\t\t\t<label for=\"$urlField\">indirizzo pubblico (URL) dell'account</label><input type=\"url\" name=\"$urlField\" value=\"$accountURL\"/>\n";
	}
	echo "\t\t\t</fieldset>\n";
}
?>			
		</fieldset>

		<input type="submit" name="fromInfo"  value="Avanti" />
	</form>
	<a href="admin_clear.php">Esci</a>
</body>
</html>