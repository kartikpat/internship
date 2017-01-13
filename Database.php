<?php

require_once("Database_conn.php");

$query = "CREATE TABLE IF NOT EXISTS States
(
  id INT NOT NULL AUTO_INCREMENT,
  state VARCHAR(15) NOT NULL,
  PRIMARY KEY (id)
);";

$query .= "CREATE TABLE IF NOT EXISTS Cities
(
  id INT NOT NULL AUTO_INCREMENT,
  city VARCHAR(15) NOT NULL,
  state_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (state_id) REFERENCES States(id)
);";

$query .= "CREATE TABLE IF NOT EXISTS Localities
(
  id INT NOT NULL AUTO_INCREMENT,
  location VARCHAR(20) NOT NULL,
  city_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (city_id) REFERENCES Cities(id)
);";

$query .= "CREATE TABLE IF NOT EXISTS Fitness_centers
(
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  gender ENUM('Male', 'Female', 'Unisex') NOT NULL,
  about TEXT(5000),
  address VARCHAR(100) NOT NULL,
  contact VARCHAR(20) NOT NULL,
  locality_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (locality_id) REFERENCES Localities(id)
);";

$query .= "CREATE TABLE IF NOT EXISTS Categories
(
  id INT NOT NULL AUTO_INCREMENT,
  type VARCHAR(20) NOT NULL,
  description TEXT(500),
  PRIMARY KEY (id)
);";

$query .= "CREATE TABLE IF NOT EXISTS centers_categories
(
  category_id INT NOT NULL,
  center_id INT NOT NULL,
  PRIMARY KEY (category_id, center_id),
  FOREIGN KEY (category_id) REFERENCES Categories(id),
  FOREIGN KEY (center_id) REFERENCES Fitness_centers(id)
);";

$query .= "CREATE TABLE IF NOT EXISTS Users
(
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(30) NOT NULL,
  email VARCHAR(60) NOT NULL,
  password VARCHAR(20) NOT NULL,
  gender ENUM('Male', 'Female', 'Others') NOT NULL,
  Mobile VARCHAR(15) NOT NULL,
  admin TINYINT DEFAULT 0,
  PRIMARY KEY (id)
);";

$query .= "CREATE TABLE IF NOT EXISTS Users_rating
(
  lifestyle INT NOT NULL,
  location INT NOT NULL,
  services INT NOT NULL,
  crowd INT NOT NULL,
  user_id INT NOT NULL,
  center_id INT NOT NULL,
  PRIMARY KEY (user_id, center_id),
  FOREIGN KEY (user_id) REFERENCES Users(id),
  FOREIGN KEY (center_id) REFERENCES Fitness_centers(id)
);";

$query .= "CREATE TABLE IF NOT EXISTS Facilities
(
  id INT NOT NULL AUTO_INCREMENT,
  type VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
);";

$query .= "CREATE TABLE IF NOT EXISTS Centers_facilities
(
  facility_id INT NOT NULL,
  center_id INT NOT NULL,
  PRIMARY KEY (facility_id, center_id),
  FOREIGN KEY (facility_id) REFERENCES Facilities(id),
  FOREIGN KEY (center_id) REFERENCES Fitness_centers(id)
);";

$query .= "CREATE TABLE IF NOT EXISTS Admin_rating
(
  brandvalue INT NOT NULL,
  infrastructure INT NOT NULL,
  hospitality INT NOT NULL,
  economy INT NOT NULL,
  locality INT NOT NULL,
  facilities INT NOT NULL,
  amenities INT NOT NULL,
  equipment_quality INT NOT NULL,
  center_id INT NOT NULL,
  PRIMARY KEY (center_id),
  FOREIGN KEY (center_id) REFERENCES Fitness_centers(id)
);";

$query .= "CREATE TABLE IF NOT EXISTS Contact
(
 
  center_id INT NOT NULL,
  PRIMARY KEY (contact, center_id),
  FOREIGN KEY (center_id) REFERENCES Fitness_centers(id)
);";

$query .= "CREATE TABLE IF NOT EXISTS Centers_membership
(
  type ENUM('Daily', 'Monthly', 'Quarterly', 'Half-Yearly', 'Yearly') NOT NULL,
  price VARCHAR(15) NOT NULL,
  center_id INT NOT NULL,
  PRIMARY KEY (type, center_id),
  FOREIGN KEY (center_id) REFERENCES Fitness_centers(id)
);";

$query .= "CREATE TABLE IF NOT EXISTS Timings
(
  day_of_week ENUM('Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat') NOT NULL,
  opening_hours TIME NOT NULL,
  closing_hours TIME NOT NULL,
  center_id INT NOT NULL,
  PRIMARY KEY (day_of_week, center_id),
  FOREIGN KEY (center_id) REFERENCES Fitness_centers(id)
);";

if($conn->multi_query($query)){
  echo "Tables Created Successfully";
}
else{
  echo "Error creating table: " . $conn->error;
}

$conn->close();

?>