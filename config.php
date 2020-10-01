<?php
  session_start();
//conn to db
 $conn = mysqli_connect("localhost","el","password","campusKe");
 if(!$conn){
   die("Error connecting to db: " . mysqli_connect_error());
 }
//global constants
  define('ROOT_PATH',realpath(dirname(__FILE__)));
  define('BASE_URL', 'http://localhost/CampusKe/');

?>
