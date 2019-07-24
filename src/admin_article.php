<?php
	$date=date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="it">
<head>
	<title>LittleHome - Amministrazione Sito - Nuovo Articolo</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css" />
	<link rel="stylesheet" type="text/css" href="admin.css" />
</head>
<body>
	<h1>Amministrazione Sito - Nuovo Articolo</h1>
	<div class="w3-card-4">
		<form action="admin_logo.php" method="POST" enctype="multipart/form-data">
			<fieldset class="w3-container">
				<p><label for="title">Titolo</label><input type="text" class="w3-input w3-border" name="title" value="" required /></p>
				<p><label for="date">Data</label><input type="date" class="w3-input w3-border" name="date" value="<?=$date?>" required /></p>
				<p><label for="content">Testo</label>
				<textarea name="content" class="w3-input w3-border" rows="10"></textarea></p>
			</fieldset>
		</form>
	</div>

		<nav class="nextprev">
			<a href="admin_clear.php" class="w3-btn w3-teal ">Esci &#10006;</a>
			<input type="submit" name="fromInfo"  value="Avanti &#10095;" class="w3-btn w3-teal " />
		</nav>
	</form>
</body>
</html>