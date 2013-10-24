<?php
  require_once("connect.php");
?>

<html>

  <head>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script>!window.jQuery && document.write(unescape('%3Cscript src="js/jquery-1.7.2.min.js"%3E%3C/script%3E'))</script>

     <script>
          function showUser(str){
                if (str==""){
                  document.getElementById("txtHint").innerHTML="";
                  return;
                }

                if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp=new XMLHttpRequest();
                }else{// code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.onreadystatechange=function(){
                  if (xmlhttp.readyState==4 && xmlhttp.status==200){
                      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
                  }
                }

                xmlhttp.open("GET","getuser.php?q="+str,true);
                xmlhttp.send();
          }
    </script>

    <link rel="stylesheet" type="text/css" href="style.css" />

  </head>


  <body>

<h2>User Data</h2>

    <div class="field check">
        <label for="filter_type">Select the filter type below:</label><br />
        <div class="check-display">
            <input type="checkbox" name="filter_type" value="filter-dd" id="filter-dd" class="filtertype"/><label id="label_filter-dd">Filter by selecting from dropdown</label>
        </div>
        <div class="check-display">
            <input type="checkbox" name="filter_type" value="filter-srch" id="filter-srch" class="filtertype"/><label id="label_filter-srch">Show all & filter</label>
        </div>
        <div class="check-display">
            <input type="checkbox" name="filter_type" value="filter-srch" id="filter-lsrch" class="filtertype"/><label id="label_filter-lsrch">Live Search / Filter</label>
        </div>
    </div>




<div id="dd-result" class="hide if-check-filter-dd">
<br><br>
  <form>
    <select name="users" onchange="showUser(this.value)">
      <?php 

          $qry = mysqli_query($con, "SELECT * FROM users ");

          echo "<option value='0'>Chose User</option>";
          while ($user = mysqli_fetch_array($qry)){
              echo "<option value='{$user['users_id']}'>" . $user['user_firstname'] . " " . $user['user_lastname'] . "</option>";
          }


      ?>
    </select>
  </form>

  <br>
  <table class="table-header">
  <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>About</th>
    <th>Location</th>
    <th>Gender</th>
  </tr>
  </table>
  <div id="txtHint"><label id="txtHint-label"><b>User data will show here...</b></label></div>

</div>






<div id="all-result" class="hide if-check-filter-srch">

  <br><br>
  <input type="text" id="searchInput" placeholder="Type to filter">
  <br/><br/>

  <?php 

      $qry2 = mysqli_query($con, "SELECT * FROM users");

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

      while($user = mysqli_fetch_array($qry2)){
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

</div>



<div id="livesearch" class="hide if-check-filter-lsrch">
<br><br>
    Search by First Name or Last Name: <br />
    <input type="text" id="search" autocomplete="off" placeholder="Type to search">

    <br><br>
    <span id="results-text">Showing results for: <strong id="search-string"></strong></span>
    <br><br>
    <div id="results"></div>

</div>



<script type="text/javascript" src="js/custom.js"></script>

  </body>
</html> 


<?php

mysqli_close($con);

?>