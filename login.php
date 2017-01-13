<html>
<head>
<title>Login - Admin Panel</title>
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

	<h3>Login Account</h3>

	<form method="POST">


	<?php

		if($_SERVER['REQUEST_METHOD'] == "POST"){

			$name = $_POST["name"];
			$password = $_POST["password"];

			if(empty($name) || empty($password)){

				$error = "Fields Were Empty.";

			} else {

				$sql = "SELECT id FROM Users WHERE name='$name' AND password='$password'";

				$result = $conn->query($sql);

				if($result->num_rows == 1){


					$row = $result->fetch_assoc();

					$user_id = $row['id'];
					$_SESSION['user_id'] = $user_id;

					$error = "You Can Login";

					header("location: account.php");

				} else {

					$error = "Username or Password Incorrect.";

				}

			}

			echo "<p>$error</p>";

		}

		?>

		Name : <br/>
		<input type="text" name="name" />
		<br/><br/>

		Password : <br/>
		<input type="password" name="password" />
		<br/><br/>

		<input type="submit" value="Login" />
	</form>

</body>
</html>