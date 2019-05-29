<!DOCTYPE html>
<html lang="it">
<head>
	<title>Pagina di Amministrazione - Conferma Modifiche</title>
	<meta charset="UTF-8" />
	<link id="style" rel="stylesheet" type="text/css" href="admin.css" />
</head>
<nav>
	<a href="admin_css.php">Indietro</a>
</nav>
<body>
	<h1>Pagina di Amministrazione - Conferma Modifiche</h1>
	<p>Per confermare le modifiche &egrave; necessario inserire la password.</p>
	<?=$message?>
	<form action="admin_pwd.php" method="POST">
		<label>Password</label><input type="password" name="password" />
		<input type="submit" value="Avanti" />
	</form>
</body>
</html>
