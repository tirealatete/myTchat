<?php
// enregistrement du pseudo dans le cookies
setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);

try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
	}catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}

	if (($_POST['pseudo'] != "") AND ($_POST['message'] !='')) {
		$req = $bdd->prepare('INSERT INTO minichat(pseudo, message) VALUES (:pseudo, :message)');
		$req->execute(array(
			'pseudo' => $_POST['pseudo'],
			'message' => $_POST['message']
		));
		$req->closeCursor();

	// Puis rediriger vers minichat.php comme ceci :
	header('Location: minichat.php');
		
	} else {
		echo 'Remplissez les 2 champs';
	}


?>
