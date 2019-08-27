<?php 
require_once('classes/SocialAccounts.php');
require_once('classes/Address.php');

//name is mandatory
$name=htmlentities($j->{'foaf:name'});
$css=isset($_GET['bw']) ? 'styles/bw.css' :  'styles/cyangray.css';
$utils=new LDUtils();

?>
	<header>
<?php
	if (isset($logo)){
?>
		<img class="logo" src="<?=$logo?>" />
<?php } ?>
		<h1><?=$name?></h1>
<?php
	if (isset($j->{'org:hasPrimarySite'})){
		$jsonSite=$j->{'org:hasPrimarySite'};
		if (isset($jsonSite->{'locn:address'}))
			echo "\t\t".'<p class="indirizzo">'.Address::jsonToString($jsonSite->{'locn:address'})."</p>\n";
	}
?>
	</header>

<?php
	if (isset($j->{'dcterms:description'})){
		$description=htmlentities($j->{'dcterms:description'});
?>
	<section>
		<h2>Chi Siamo</h2>
		<p class="description">
<?=$description?>
		</p>
	</section>
<?php
}

if (isset($j->{'foaf:mbox'}) || isset($j->{'foaf:account'}) || isset($j->{'foaf:phone'}) ){
?>
	<section>
		<h2>Contatti</h2>
		<ul class="contacts">
<?php
	if (isset($j->{'foaf:mbox'})){
			$mail=str_replace('mailto:','',$j->{'foaf:mbox'}->{'@id'});
			echo "\t\t".'<li><img src="https://upload.wikimedia.org/wikipedia/commons/8/8b/PICOL_icon_Mail.svg" /> e-mail <a href="mailto:'.$mail.'">'.$mail.'</a></li>'."\n";
	}

	if (isset($j->{'foaf:phone'})){
			$phone=str_replace('tel:','',$j->{'foaf:phone'}->{'@id'});
			echo "\t\t".'<li><img src="'.$srcpath.'/icons/iconfinder_Call01_928412.svg" /> tel <a href="tel:'.$phone.'">'.$phone.'</a></li>'."\n";
	}

	$socialAccounts=new SocialAccounts();
	if (isset($j->{'foaf:account'}))
		foreach($j->{'foaf:account'} as $account){
			$service=$account->{'foaf:accountServiceHomepage'}->{'@id'};
			$name=$account->{'foaf:accountName'};
			$url=$account->{'@id'};
			$p=$socialAccounts->presentations[$service];
			$iconUrl=$p->serviceIcon;
			if (!$utils->isAbsoluteURL($iconUrl))
				$iconUrl=$srcpath.'/'.$iconUrl;
			$desc=$p->accountTypeDescription;
			echo "\t\t\t<li><img src=\"$iconUrl\"/> $desc <a href=\"$url\">$name</a></li>\n";
		}
?>
		</ul>
	</section>
<?php
	}
	if (isset($l->json->{'rss:items'}->{'rdf:li'})){
?>
	<section>
		<h2>Articoli</h2>
		<ol>
<?php
	$articles=$l->json->{'rss:items'}->{'rdf:li'};
	$n=min(count($articles),2);
	for($i=0; $i<$n;$i++){
		$a=$articles[$i];
		$title=$a->{'rss:title'};
		$url=$a->{'@id'};
		$date=DateTime::createFromFormat(DateTimeInterface::ISO8601, $a->{'dc:date'})->format('d/m/Y');
		if (!$utils->isAbsoluteURL($url))
			$url=$srcpath.'/viewArticle.php?url='.urlencode('../'.$url);
		echo "<li><em class=\"date\">$date</em> <a href=\"$url\">$title</a></li>\n";
	}
?>
		</ol>
<?php 
	if (count($articles)>2)
		echo "\t\t<p><a href=\"$srcpath/listArticles.php\">vedi altri articoli</a></p>\n";
?>
	</section>
<?php
	}
?>	

	<section>
		<h2>Credits</h2>
		<ul>
			<li> PICOL, PIctorial COmmunication Language <a href="https://creativecommons.org/licenses/by/3.0">CC BY 3.0</a></li>
			<li>Subhashish Panigrahi <a href="https://creativecommons.org/licenses/by-sa/4.0">CC BY-SA 4.0</a></li>
			<li>Ellipol <a href="https://creativecommons.org/licenses/by-sa/4.0">CC BY-SA 4.0</a></li>
			<!-- <a title="Ellipol [CC BY-SA 4.0 (https://creativecommons.org/licenses/by-sa/4.0)], via Wikimedia Commons" href="https://commons.wikimedia.org/wiki/File:1195445181899094722molumen_phone_icon.svg.hi.png"><img width="512" alt="1195445181899094722molumen phone icon.svg.hi" src="https://upload.wikimedia.org/wikipedia/commons/1/15/1195445181899094722molumen_phone_icon.svg.hi.png"></a> -->
		</ul>
	</section>
