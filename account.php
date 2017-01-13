<html>
<head>
<title>Account - Admin Panel</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body style="padding: 50px;text-align: center; ">
	
	<?php require_once("functions.php"); ?>
	<?php include("navigation.php"); ?>

	<?php

		if(!loggedIn()){
			header("location: login.php");
		}



	?>

	<h3><?php echo "WELCOME " .getUser_value("name"); ?></h3>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>