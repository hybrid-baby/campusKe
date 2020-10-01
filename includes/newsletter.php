<?php
/*
**************************************************************************
**** USE LESS BUT TO BE USED PROBALY LATER      **************************
**** MEANWHILE NEWSLETTER SUBSCRITION IS AT registration_login.PHP   *****
**************************************************************************
//vars
$email = "";

//reg subscriber to our NEWSLETTER
if(isset($_POST['news-letter'])){
	global $conn;
  $email = charEsc($_POST['news-letter']);
  $query = "INSERT INTO subscribers (email) VALUES('$email')";
  mysqli_query($conn,$query);
  $_SESSION['message'] = "Successfully subscribed";
  //  header('location' : BASE_URL . 'index.php');
  header('location: ' . BASE_URL . 'index.php');

}else{
	$_SESSION['message'] = "Email is required";
  echo header('location: ' . BASE_URL . 'index.php');
}

// escape value from form
function charEsc(String $value){
  // bring the global db connect object into function
  global $conn;

  // remove empty space sorrounding string
  $val = trim($value);
  $val = mysqli_real_escape_string($conn, $value);

  return $val;
}
*/
 ?>
