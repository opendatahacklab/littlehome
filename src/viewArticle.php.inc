<?php
/**
  * The body of a page showing an article.
  */	

if (!$a) echo "<p>No such article</p>\n";
else {
	echo "<p class=\"orgName\"><a href=\"../index.php\">$orgName</a></p>\n";
	echo "<h1>$a->title</h1>\n";
	$dateStr=$a->getDateFormatted();
	if ($dateStr!==null){
		echo "<p class=\"date\">$dateStr</p>\n";
	}
	$c=$a->getContentAsHTML();
	echo "<p class=\"content\">\n$c\n</p>\n";
}
?>
