
<?php   require_once("Database_conn.php");  ?>

<h1 style="text-align:center;margin-bottom:30px;">Add New Fitness Center</h1>

   
<form class="form-horizontal" method="post">

       <?php 

       if($_SERVER['REQUEST_METHOD'] == "POST"){
            $name = $_POST['center_name'];
            $address = $_POST['center_address'];
            $locality = $_POST['localities'][0];
            $description = $_POST['description'];
            $category = $_POST['Categories'];
            $facility = $_POST['Facilities'];
            $contact = $_POST['contact'];
            $mem_type = $_POST['membership_type'];
        
       $result = $conn->query("INSERT INTO Fitness_centers VALUES ('', '$name', 'Male', '$description', '$address', '$locality', '$contact')");

       $last_id = $conn->insert_id;

        foreach ($category as $cat) {
              $conn->query("INSERT INTO centers_categories Values ('$cat', '$last_id')");
         }

        foreach ($facility as $fac) {
              $conn->query("INSERT INTO Centers_facilities Values ('$fac', '$last_id')");
         }
        
        foreach ($mem_type as $mem) {

                        if($mem === 'daily') $price=$_POST['daily'];
                        elseif ($mem === 'monthly')  $price=$_POST['monthly'];
                        elseif ($mem === 'quarterly')  $price=$_POST['quarterly'];
                        elseif ($mem === 'half-yearly')  $price=$_POST['half-yearly'];
                        elseif ($mem === 'yearly')  $price=$_POST['yearly'];

              $conn->query("INSERT INTO Centers_membership Values ('$mem', '$price', '$last_id')");

       }

  }
       ?>


 	<div class="form-group">
		    <label for="center_name" class="col-sm-2 control-label" >Add Name:</label>
		    <div class="col-sm-9">
		    <input type="text" class="form-control" name="center_name" id="center_name" placeholder="Name" required>
		    </div>
  	</div>

    <div class="form-group">
		    <label for="center_address" class="col-sm-2 control-label">Add Address:</label>
		    <div class="col-sm-9">
		    <textarea type="text" class="form-control" rows="2" name="center_address" id="center_address" placeholder="Address" required></textarea>
            </div>
    </div>

  <?php

     $result = $conn->query("SELECT id, location FROM Localities");
    
        echo "<div class=\"form-group\">
              <label for=\"localities\" class=\"col-sm-2 control-label\">Choose locality:</label>
              <div class=\"col-sm-9\">
              <select name=\"localities[]\" id=\"localities\" class=\"selectpicker form-control\" data-live-search=\"true\" required>";
     
       if($result->num_rows > 0){
         while($row = $result->fetch_assoc()) {
          echo "<option value='" .$row["id"]. "'>" .$row["location"]. "</option>";
        }
      }
      
      echo "</select>
            </div>
            </div>";
  ?>

   
  <div class="form-group">
  <label for="description" class="col-sm-2 control-label" id="g">Add Description:</label>
  <div class="col-sm-9">
  <textarea class="form-control" rows="3" name="description" id="description" placeholder="About Fitness Center...(Optional)"></textarea>
  </div>
  </div>


  <?php

     $result = $conn->query("SELECT id, type FROM Categories");
    
        echo "<div class=\"form-group\">
              <label for=\"Categories\" class=\"col-sm-2 control-label\">Choose Category:</label>
              <div class=\"col-sm-9\">
              <select name=\"Categories[]\" id=\"Categories\" class=\"selectpicker form-control\" multiple data-live-search=\"true\" required>";
     
       if($result->num_rows > 0){
         while($row = $result->fetch_assoc()) {
          echo "<option value='" .$row["id"]. "'>" .$row["type"]. "</option>";
        }
      }
      
      echo "</select>
            </div>
            </div>";


     $result = $conn->query("SELECT id, type FROM Facilities");
    
        echo "<div class=\"form-group\">
              <label for=\"Facilities\" class=\"col-sm-2 control-label\">Choose Facility:</label>
              <div class=\"col-sm-9\">
              <select name=\"Facilities[]\" id=\"Facilities\" class=\"selectpicker form-control\" multiple data-live-search=\"true\" required>";
     
       if($result->num_rows > 0){
         while($row = $result->fetch_assoc()) {
          echo "<option value='" .$row["id"]. "'>" .$row["type"]. "</option>";
        }
      }
      
      echo "</select>
            </div>
            </div>";
    
  ?>


  <div class="form-group">
  <label for="contact" class="col-sm-2 control-label">Add contact:</label>
  <div class="col-sm-4">
  <input type="tel" class="form-control" id="contact" placeholder="Landline(6,7,8 digit) or Mobile(10 digit)" name="contact" required maxlength="10">
  </div>
  </div>


  <div class="form-group">
  <label for="membership_type" class="col-sm-2 control-label">Membership Type:</label>
  <div class="col-sm-5">
  <select class="selectpicker form-control" id="membership_type" name="membership_type[]" multiple required onchange="add_membership_type()">
  <option value="daily">Daily</option>
  <option value="monthly">Monthly</option>
  <option value="quarterly">Quarterly</option>
  <option value="half-yearly">Half-Yearly</option>
  <option value="yearly">Yearly</option>
  </select>
  </div>
  </div>

  <div class="form-group" id="price">
  <label class="col-sm-offset-1 col-sm-3 control-label" >Add Price(In ruppees):</label>
  </div>
  
  <div class="form-group mem_type" id="daily">  
  <div class="col-sm-4 col-sm-offset-2" >
  <input type="text" class="form-control "  name="daily" placeholder="Daily" >
  </div>
  </div>


  <div class="form-group mem_type" id="monthly">  
  <div class="col-sm-offset-2 col-sm-4">
  <input type="text" class="form-control" name="monthly" placeholder="Monthly" >
  </div>
  </div>
  
  <div class="form-group mem_type" id="quarterly">  
  <div class="col-sm-4 col-sm-offset-2" >
  <input type="text" class="form-control col-sm-2" id="quarterly" placeholder="Quarterly" name="quarterly" >
  </div>
  </div>

  <div class="form-group mem_type" id="half-yearly">  
  <div class="col-sm-4 col-sm-offset-2" >
  <input type="text" class="form-control col-sm-2" id="half-yearly" placeholder="Half-Yearly" name="half-yearly" >
  </div>
  </div>

  <div class="form-group mem_type" id="yearly">  
  <div class="col-sm-4 col-sm-offset-2" >
  <input type="text" class="form-control col-sm-2" id="yearly" placeholder="Yearly" name="yearly" >
  </div>
  </div>

   <div class="form-group">
   <div class="col-sm-offset-2 col-sm-9">
   <button class="btn btn-primary" type="submit">Submit</button>
   </div>
   </div>
  </form>

