<?php

$con = mysqli_connect('localhost', 'altin', 'password', 'user_profile');
if (!$con) {
    die('Could not connect: ' . mysqli_error());
}

?> 