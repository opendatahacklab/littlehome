<?php
/**
  * The body of a page showing an article.
  */	


if (!$a) 
	die("No such article");

$dateStr=$a->getDateFormatted();
$c=$a->getContentAsHTML();
$title=htmlentities($a->title);
?>
	<header>
<?php
	if ($logo){
?>
		<a href="../index.php" title="pagina principale"><img class="logo" src="<?=$logo?>" /></a>
<?php } ?>
		<p class="orgname"><?=$orgName?></p>
<?php
	if ($address)
		echo "\t\t<p class=\"indirizzo\">$address</p>\n";
?>
	</header>
	<nav> <a href="listArticles.php">&lt;&lt; articoli</a></nav>
	
	<section>
<?php
	if ($dateStr!==null){
		echo "<p class=\"date\">$dateStr</p>\n";
	}
?>
		<h1 class="title"><?=$title?></h1>
		<?=$c?>
	</section>
