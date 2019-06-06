<?php 
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title>FriendlyHome - Amministrazione Sito - Arrivederci</title>
	<meta charset="UTF-8" />
	 <link rel="stylesheet" type="text/css" href="admin.css" />
	<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css" />
</head>
<body>
	<h1>Amministrazione Sito - Arrivederci</h1>
	<p>Tutte le modifiche sono state annullate.</p>
	<nav class="nextprev">
		<a href="admin.php" class="w3-btn w3-teal ">Torna alla pagina di amministrazione</a>
		<a href="../index.php" class="w3-btn w3-teal ">Vai al Sito</a>
	</nav>
</body>
</html>