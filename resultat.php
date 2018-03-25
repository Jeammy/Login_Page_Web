<?php
	session_start();
	echo "username: " . $_SESSION["username"];
	echo '<br>';
	echo "password: " . $_SESSION["password"];
?>