<?php
	$bd = mysqli_connect("localhost", "root", "", "authentification");
	if (mysqli_connect_errno($bd)) {
	    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
	}
?>