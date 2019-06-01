<?php 
require_once('classes/SocialAccounts.php');
require_once('classes/Address.php');

//name is mandatory
$name=htmlentities($j->{'foaf:name'});
$css=isset($_GET['bw']) ? 'styles/bw.css' :  'styles/cyangray.css';
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

if (isset($j->{'foaf:mbox'}) || isset($j->{'foaf:account'})){
?>
	<section>
		<h2>Contatti</h2>
		<ul class="contacts">
<?php
	if (isset($j->{'foaf:mbox'})){
			$mail=str_replace('mailto:','',$j->{'foaf:mbox'}->{'@id'});
			echo "\t\t".'<li><img src="https://upload.wikimedia.org/wikipedia/commons/8/8b/PICOL_icon_Mail.svg" /> e-mail <a href="mailto:'.$mail.'">'.$mail.'</a></li>'."\n";
	}

	$socialAccounts=new SocialAccounts();
	if (isset($j->{'foaf:account'}))
		foreach($j->{'foaf:account'} as $account){
			$service=$account->{'foaf:accountServiceHomepage'}->{'@id'};
			$name=$account->{'foaf:accountName'};
			$url=$account->{'@id'};
			$p=$socialAccounts->presentations[$service];
			$iconUrl=$p->serviceIcon;
			$desc=$p->accountTypeDescription;
			echo "\t\t\t<li><img src=\"$iconUrl\"/> $desc <a href=\"$url\">$name</a></li>\n";
		}
?>
		</ul>
	</section>
<?php
	}
?>	
	<section>
		<h2>Credits</h2>
		<ul>
			<li> PICOL, PIctorial COmmunication Language <a href="https://creativecommons.org/licenses/by/3.0">CC BY 3.0</a></li>
			<li>Subhashish Panigrahi <a href="https://creativecommons.org/licenses/by-sa/4.0">CC BY-SA 4.0</a></li>
		</ul>
	</section>
