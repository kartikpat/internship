<html>
<head>
<title>Create Account - Admin Panel</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
	<?php require_once("functions.php"); ?>
	<?php include("navigation.php"); ?>

	<?php

		if(loggedIn()){
			header("location: account.php");
		}

	?>

	<h3>Create A New Account</h3>

	<form method="POST">

	<?php
        
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			$name = $_POST["name"];
			$password = $_POST["password"];
			$confirm_password = $_POST["confirm_password"];
			$email = $_POST["email"];
			$gender = $_POST["gender"];
			$contact = $_POST["contact"];

			if(empty($name) || empty($password) || empty($confirm_password)){

				$error = "Fields Were Empty.";

			} else {

				$sql = "INSERT INTO Users (id, name, email, password, gender, Mobile, admin) VALUES ('', '$name', '$email', '$password', '$gender', '$contact', '')";


				if($conn->query($sql) === TRUE){

					$error = "User Created";
				} else {

					$error = "Error in creating Account. Please Contact Admin About THis.";

				}

			}

			echo "<p>$error</p>";

		}
      
	?>

		Name : <br/>
		<input type="text" name="name" />
		<br/><br/>

		Email : <br/>
		<input type="email" name="email" />
		<br/><br/>

		Password : <br/>
		<input type="password" name="password" />
		<br/><br/>

		Confirm Password : <br/>
		<input type="password" name="confirm_password" />
		<br/><br/>

		Gender : <br/>
		<select name="gender">
		  <option value="Male">Male</option>
		  <option value="Female">Female</option>
		  <option value="Others">Others</option>
		</select>
		<br/><br/>

		Contact : <br/>
		<input type="tel" name="contact" />
		<br/><br/>

		<input type="submit" value="Create Account " />
	</form>

</body>
</html>