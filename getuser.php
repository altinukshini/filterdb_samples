<?php

ini_set('display_errors',1); 
 error_reporting(E_ALL);

require_once("connect.php");


$id = $_GET['q'];

$qry = mysqli_query($con, "SELECT * FROM users WHERE users_id = $id");


echo "<table class='user_data'>";

while($user = mysqli_fetch_array($qry)){

  echo "<tr>";
	  echo "<td>" . $user['user_firstname'] . "</td>";
	  echo "<td>" . $user['user_lastname'] . "</td>";
	  echo "<td>" . $user['user_email'] . "</td>";
	  echo "<td>" . $user['user_about'] . "</td>";
	  echo "<td>" . $user['user_location'] . "</td>";
	  if ($user['user_gender'] == 1) {
	  	echo "<td>" . "Male" . "</td>";
	  }else if ($user['user_gender'] == 0){
	  	echo "<td>" . "Female" . "</td>";
	  }
  echo "</tr>";

}


echo "</table>";


?>