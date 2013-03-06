<!-- Création Cookies pour pseudo -->
<?php
if (isset($_COOKIE['pseudo'])) {
	echo 'session de ' . $_COOKIE['pseudo'];

} else {
	echo 'création d\'un cookies';
	setcookie('pseudo', '', time() + 365*24*3600, null, null, false, true);
}


?>



<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>MiniChat</title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	</head>
	
	<body>

		<p> formulaire de chat</p>
		<form method="post" action="minichat_post.php">
			Pseudo : <input type="text" name="pseudo" value="<?php echo $_COOKIE['pseudo'];?>" /></br>
			Message : <input type="text" name="message"/></br>
			<input type="submit" value="Envoyer"/>
		</form>

<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
	} catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}

	$reponse = $bdd->query('SELECT pseudo, message FROM minichat ORDER BY id DESC LIMIT 0, 10');
	while ($donnees = $reponse->fetch()) 
	{
		echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
	}
	$reponse->closeCursor();
?>

	</body>
</html>