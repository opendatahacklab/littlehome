<?php 
require_once('../config.php');
?>

<!DOCTYPE html>
<html lang="it">
<head>
	<title>LittleHome - Amministrazione Sito </title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css" />
	<link id="style" rel="stylesheet" type="text/css" href="admin.css" />
</head>
<body>
	<h1>Amministrazione Sito</h1>
<?php
if (file_exists('../'.ORGANIZATION_FILE)){
?>
	<nav class="nextprev">
		<a href="admin_info.php" class="w3-btn w3-teal ">Informazioni</a>
		<a href="admin_articles_list.php" class="w3-btn w3-teal ">Articoli</a>
		<a href="admin_clear.php" class="w3-btn w3-teal ">Esci &#10006;</a>
	</nav>
<?php
} else {
?>
	<p>Per rendere visibile il sito &egrave; necessario inserire le informazioni dell'associazione. Queste potranno essere modificate in qualsiasi momento.</p>
	<nav class="nextprev">
		<a href="admin_info.php" class="w3-btn w3-teal ">Inserisci informazioni</a>
		<a href="admin_clear.php" class="w3-btn w3-teal ">Esci &#10006;</a>
	</nav>
<?php
}
?>
	<section class="w3-panel w3-card-4">
		<h2 class="w3-container w3-blue">Informativa sui Cookie</h2>
		<p class="w3-container">Questa sezione del sito utilizza 
		<a href="https://www.garanteprivacy.it/cookie" title="Cookie e privacy: dalla parte degli utenti">
		cookie tecnici</a> per gestire la sessione utente.
		Tali cookie non vengono mai utilizzati a fini di profilazione e vengono rimossi al termine della sessione,
		ossia quando viene premuto il tasto <em>ESCI</em>.</p> 
	</section>
</body>
</html>
