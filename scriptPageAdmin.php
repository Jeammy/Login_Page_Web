<?php
	//Inspiré de https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
	require_once 'config.php';

	$username = $password = $realName = $sex ="";
	$username_err = $password_err = $realName_err = $sex_err ="";
	$sex = 'M';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//check username is not empty
		if(empty(trim($_POST["username"]))){
    	    $username_err = "Please enter a username.";
		}else{
			// Prepare a select statement
	        $sql = "SELECT Utili_Nom FROM Utilisateur WHERE Utili_Nom = ?";
	        
	        if($stmt = mysqli_prepare($bd, $sql)){
	            // Bind variables to the prepared statement as parameters
	            mysqli_stmt_bind_param($stmt, "s", $param_username);
	            
	            // Set parameters
	            $param_username = trim($_POST["username"]);
	            
	            // Attempt to execute the prepared statement
	            if(mysqli_stmt_execute($stmt)){
	                /* store result */
	                mysqli_stmt_store_result($stmt);
	                
	                if(mysqli_stmt_num_rows($stmt) == 1){
	                    $username_err = "This username is already taken.";
	                } else{
	                    $username = trim($_POST["username"]);
	                }
	            } else{
	                echo "Oops! Something went wrong. Please try again later.";
	            }
	        }
	         
	        // Close statement
	        mysqli_stmt_close($stmt);
		}
		//check password is not empty
		if(empty(trim($_POST["mot_de_passe"]))){
				$password_err = "Please enter a password.";     
	    } elseif(strlen(trim($_POST['mot_de_passe'])) < 6){
	        $password_err = "Password must have atleast 6 characters.";
	        echo "less than six characters";
	    } else{
	        $password = trim($_POST['mot_de_passe']);
	    }

		//check if real name is not empty
		if(empty(trim($_POST["real_name"]))){
    	    $username_err = "Please enter your name.";
		}else{
			$realName = trim($_POST['real_name']);	
		}

	    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
	        // Prepare an insert statement
			$sql = "INSERT INTO `utilisateur` (`Utili_Nom`, `Utili_Mot_De_Passe`, `Utili_Nom_Personnel`, `Categorie_Code`) VALUES (?, ?, ?, ?)";
	         
	        if($stmt = mysqli_prepare($bd, $sql)){
	            // Bind variables to the prepared statement as parameters
	            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_realName, $sex);
	            
	            // Set parameters
	            $param_username = $username;
	            $param_password = $password;
	            $param_realName = $realName;
	            
	            // Attempt to execute the prepared statement
	            echo "Attempt to execute"; 
	            if(mysqli_stmt_execute($stmt)){
	                // Redirect to login page
	                header("location: pageLoginAccueil.html");
	            } else{
	                echo "Something went wrong. Please try again later.";
	            }
		        // Close statement
		        mysqli_stmt_close($stmt);
	        }
	         
		}
	    // Close connection
	    mysqli_close($bd);
    }
?>