<?php

require_once("connect.php");


// Get search
$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = $con->real_escape_string($search_string);

// Check length if more than one character
if (strlen($search_string) >= 1 && $search_string !== ' ') {

	$query = 'SELECT * FROM users WHERE user_firstname LIKE "%'.$search_string.'%" OR user_gender LIKE "%'.$search_string.'%" OR user_location LIKE "%'.$search_string.'%" OR user_lastname LIKE "%'.$search_string.'%" OR user_email LIKE "%'.$search_string.'%" OR user_about LIKE "%'.$search_string.'%"';

	// Search
	$result = $con->query($query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}

	// Check if there are results
	if (isset($result_array)) {

	$use_query = mysqli_query($con, $query);

	      echo "<table class='table-header' >
	        <tr>
	          <th>First Name</th>
	          <th>Last Name</th>
	          <th>Email</th>
	          <th>About</th>
	          <th>Location</th>
	          <th>Gender</th>
	        </tr>
	        </table>";

	      echo "<table id='fbody' class='user_data' >";

	      while($user = mysqli_fetch_array($use_query)){
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

	}else{

		echo "No results found!";
	
	}
}

?>