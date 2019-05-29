<?php 
require_once('config.php');
require_once('classes/LDUtils.php');
require_once('classes/SocialAccounts.php');
require_once('classes/Organization.php');

session_start();

$o=new Organization();

if (!$o->readFromSession())
	$o->readFromFile(ORGANIZATION_FILE);

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
	<form action="admin_css.php" method="POST" enctype="multipart/form-data">
		<label for="name">Nome</label><input type="text" name="name" value="<?=$name?>" required />
		<label for="description">Descrizione</label>
		<textarea name="description" rows="10" cols="20"><?=$description?></textarea>
		<label for="logo">Logo</label>
<?php
if ($logo!==''){
		echo "\t\t\t<input type=\"hidden\" name=\"oldlogo\" value=\"$logo\" />\n";
		echo "\t\t\t<img src=\"$logo\" class=\"logo\" />\n";
}
?>
		<input type="file" name="logo" />
		
		<fieldset>
			<legend>Indirizzo</legend>
<?php
if (isset($o->json->{'org:hasPrimarySite'}) && isset($o->json->{'org:hasPrimarySite'}->{'locn:address'})){
	$address=$o->json->{'org:hasPrimarySite'}->{'locn:address'};
?>
	<label for="thoroughfare">Via/Strada/Piazza</label> <input type="text" name="thoroughfare" value="<?=$address->{'locn:thoroughfare'}?>" />
	<label for="locatorDesignator">Numero Civico</label> <input type="text" name="locatorDesignator" value="<?=$address->{'locn:locatorDesignator'}?>" />
	<label for="poBox"><abbr title="Codice di Avviamento Postale">CAP</abbr></label> <input type="text" name="poBox" value="<?=$address->{'locn:poBox'}?>" />
	<label for="postName">Comune</label> <input type="text" name="postName" value="<?=$address->{'locn:postName'}?>" />
<?php
} else {
?>
	<label for="thoroughfare">Via/Strada/Piazza/</label> <input type="text" name="thoroughfare" />
	<label for="locatorDesignator">Numero Civico</label> <input type="text" name="locatorDesignator" />
	<label for="poBox"><abbr title="Codice di Avviamento Postale">CAP</abbr></label> <input type="text" name="poBox" />
	<label for="postName">Comune <input type="text" name="postName" />
<?php
}		
?>	

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

		<input type="reset" />
		<input type="submit" name="fromInfo"  value="Avanti" />
	</form>
</body>
</html>