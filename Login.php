<?php
	//Inspiré de https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
	require_once 'config.php';

	$username = $password = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//check username is not empty
		if(!empty(trim($_POST["username"]))){
			$username = trim($_POST['username']);
		}
		//check password is not empty
		if(!empty(trim($_POST["mot_de_passe"]))){
			$password = trim($_POST['mot_de_passe']);
		}
		//requête SQL
		$sql = "SELECT Utili_Nom, Utili_Mot_De_Passe FROM utilisateur WHERE Utili_Nom = ?";
		//traitement sur la bd.
		if ($stmt = mysqli_prepare($bd, $sql)) {
			//parametre ? de la requête.
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			$param_username = $username;
			if (mysqli_stmt_execute($stmt)) {
				mysqli_stmt_store_result($stmt);
				//doit avoir qu'un occurence dans la bd.
				if (mysqli_stmt_num_rows($stmt) == 1) {
					//met le resultat de la requete dans les variables.
					mysqli_stmt_bind_result($stmt, $username,$bd_password);
					if (mysqli_stmt_fetch($stmt)) {
						if ($password == $bd_password){
							session_start();
							$_SESSION['username'] = $username;
							$_SESSION['password'] = $password;
							header("location: resultat.php");
						}else{
							echo"erreur password";
							session_start();
							$SESSION['username'] = $username;
							header("location: pageLoginAccueil.html");
						}
					}
				}else{
					echo"erreur username";
					session_start();
					header("location: pageLoginAccueil.html");
				}
			}else{
				echo"erreur connexion";
			}
		}
		mysqli_stmt_close($stmt);

	}
	mysqli_close($bd);
?>