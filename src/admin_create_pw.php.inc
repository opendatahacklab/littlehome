<!DOCTYPE html>
<html lang="it">
<head>
	<title>FriendlyHome - Amministrazione Sito - Password</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css" />
	<link id="style" rel="stylesheet" type="text/css" href="admin.css" />
</head>
<body>
	<h1>Amministrazione Sito - Password</h1>
	<div class="w3-card-4">
		<form action="admin_pwd.php" class="w3-container" method="POST">
			<p>Per completare la creazione del sito &egrave; necessario indicare una password che potr&agrave; essere usata in futuro per effetturare modifiche.</p>
			<?=$message?>
			<p><label>Password</label> <input type="password" name="password" class="w3-input w3-border" required /></p>
			<p><label>Conferma Password</label> <input type="password" name="confirm" class="w3-input w3-border" required /></p>
			<nav class="nextprev">
					<a href="admin_css.php" class="w3-btn w3-teal ">&#10094; Indietro</a>
					<a href="admin_clear.php" class="w3-btn w3-teal">Esci &#10006;</a>
					<input type="submit" class="w3-btn w3-teal " value="Avanti &#10095;" />
			</nav>
		</form>
	</div>
</body>
</html>
