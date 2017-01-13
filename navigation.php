<nav  class="navbar navbar-default navbar-fixed-top" >
  <ul class="nav navbar-nav">
	<li><a href="index.php">Home</a></li>  

	<?php
		if(loggedIn()){
	?>

	<li><a href="account.php">Profile</a></li>  
	<li><a href="logout.php">Log Out</a></li>

	<?php

		if(getUser_value("admin") == 1){

			?>

			<li><a href="admin.php">Admin Panel</a></li>  

			<?php


		}

	?>

	<?php
		} else {
	?>
	<li><a href="login.php">Login</a></li> 
	<li><a href="register.php">Create Account</a></li>

	<?php
		}
	?>
	</ul>
</nav>