<!DOCTYPE html>
<html lang="it">
<head>
	<title>Pagina di Amministrazione - Creazione Password</title>
	<meta charset="UTF-8" />
	<link id="style" rel="stylesheet" type="text/css" href="admin.css" />
</head>
<nav>
	<a href="admin_css.php">Indietro</a>
</nav>
<body>
	<h1>Pagina di Amministrazione - Creazione Password</h1>
	<p>Per completare la creazione del sito &egrave; necessario indicare una password che potr&agrave; essere usata in futuro per effetturare modifiche.</p>
	<?=$message?>
	<form action="admin_pwd.php" method="POST">
		<label>Password</label> <input type="password" name="password" required />
		<label>Conferma Password</label> <input type="password" name="confirm" required />
		<input type="submit" value="Avanti" />
	</form>
</body>
</html>
