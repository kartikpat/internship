<!DOCTYPE html>
<html>
<head>
<title>Account - Admin Panel</title>

<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<style type="text/css">
.mem_type,#price {
        display: none;
}
body {
        padding-top: 50px;
}
</style>



</head>
<body>
	
	<?php require_once("functions.php"); ?>
	<?php include("navigation.php"); ?>

	<?php

		if(!loggedIn() || getUser_value("admin") != 1){
			header("location: index.php");
		}

	?>

	

<button class="btn btn-default" type="submit" onclick="add_center()">Add Fitness Center</button>

<div id="centers">
        

</div>




<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


 <script>



  function add_center() {
     $("#centers").load("add_center.php");
  }

    function add_membership_type() {

        var price=document.getElementById("price");
        var mem_type = document.getElementById("membership_type");

        var i=0;
        flag=0;
        while(i<5)
        {
                var x = document.getElementById(mem_type.options[i].value);
                if(mem_type.options[i].selected)
                {
                  x.style.display="block";
                  flag=1;
                }

                else
                {
                 x.style.display="none";        
                }

                i++;
        }

        if(flag==1)
        {
                price.style.display="block";
        }
        else{
                 price.style.display="none";
        }
   }

</script>

</body>
</html>