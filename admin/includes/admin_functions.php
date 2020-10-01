<?php
// Admin user variables
$admin_id = 0;
$isEditingUser = false;
$isAdmin = false;
$username = "";
$role = "";
$email = "";
//Tpoics variables
$topic_id = 0;
$isEditingTopic = false;
$topic_name = "";
// general variables
$errors = [];
// Admin users actions
// if user clicks the create admin button save user
if(isset($_POST['create_admin'])) {
	if($_SESSION['user']['role'] == "Admin"){
	createAdmin($_POST);
}else{
	array_push($errors,"Contact admin");
}
}
//  Edit admin button
if(isset($_GET['edit-admin'])) {
	if($_SESSION['user']['role'] == "Admin"){
		$isEditingUser = true;
		$admin_id = $_GET['edit-admin'];
		editAdmin($admin_id);
	}else{
		array_push($errors,"Contact admin");
	}
}
//update admin button
if(isset($_POST['update_admin'])) {
	if($_SESSION['user']['role'] == "Admin"){
		updateAdmin($_POST);
	}else{
		array_push($errors,"Contact admin");
	}
}
// Delete admin button
if(isset($_GET['delete-admin'])) {
	if($_SESSION['user']['role'] == "Admin"){
		$admin_id = $_GET['delete-admin'];
		deleteAdmin($admin_id);
	}else{
		array_push($errors,"Contact admin");
	}
}

/******************
***TOPIC ACTIONS **
******************/
//if user clicks create topic
if(isset($_POST['create_topic'])){
	if($_SESSION['user']['role'] == "Author" || "Admin"){
		createTopic($_POST);
	}else{
		array_push($errors,"Contact Admin");
	}
}

//if user clicks edit topic id button
if(isset($_POST['edit-topic'])){
if($_SESSION['user']['role'] == "Author"  || "Admin"){
		$isEditingTopic = true;
		$topic_id = $_GET['edit-topic'];
		editTopic($topic_id);
	}else{
		array_push($errors,"Contact Admin");
	}
}

//if user clicks update topic
if(isset($_POST['update_topic'])){
	if($_SESSION['user']['role'] == "Author" || "Admin"){
		updateTopic($_POST);
	}else{
		array_push($errors,"Contact Admin");
	}
}

//if user clicks delete topic
if(isset($_GET['delete-topic'])){
	if($_SESSION['user']['role'] ==  "Admin"){
		$topic_id = $_GET['delete-topic'];
		deleteTopic($topic_id);
	}else{
		array_push($errors,"Contact Admin");
	}
}

// Returns all admin users and their corresponding roles

function getAdminUsers(){
	global $conn, $roles;
	$sql = "SELECT * FROM users WHERE role='Author'";
	$result = mysqli_query($conn, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $users;
}
//get only admin
function getAdmin(){
	global $conn, $roles;
	$sql = "SELECT * FROM users WHERE role='Admin'";
	$result = mysqli_query($conn,$sql);
	$administrators = mysqli_fetch_all($result,MYSQLI_ASSOC);
	return $administrators;
}
/*
//ensure user is an admin befoer eiting or creating
function checkIfUserIsAdmin($admin_id){
	if
}
*/

// Escapes form submitted values
function charEsc(String $value){
  global $conn;
  $val = trim($value);
  $val = mysqli_real_escape_string($conn,$value);
  return $val;
}

//Receives new admin data from form
//Create new admin user
//Returns all admin users with their roles
function createAdmin($request_values){
	global $conn, $errors, $role, $username, $email;
	$username = charEsc($request_values['username']);
	$email = charEsc($request_values['email']);
	$password = charEsc($request_values['password']);
	$passwordConfirmation = charEsc($request_values['passwordConfirmation']);
  //check if role is set
  //escape to prevent user enumeration
  if(isset($request_values['role'])){
    $role = charEsc($request_values['role']);
  }
  //ensure form is well filled
  //if not push errors
  if(empty($username)){
     array_push($errors, "Username is Required");
   }
	if(empty($email)){
     array_push($errors, "Email is required");
   }
	if(empty($role)){
     array_push($errors, "Role not set");
   }
	if(empty($password)){
     array_push($errors, "Passord not set");
   }
   //ensure passwords match
	if($password != $passwordConfirmation){
     array_push($errors, "The two passwords do not match");
   }

	// Ensure that no user is registered twice.
	$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
	$result = mysqli_query($conn, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	if($user){
		if($user['username'] === $username){
      echo "Error user exists";
		  array_push($errors, "Username already exists");
		}

		if($user['email'] === $email){
      echo "error user email exists";
		  array_push($errors,"Email already exists");
		}
	}
	//ensure usser is admin
	if($user['role'] == $administrators['Admin']){
		//create the admin or Author
		// register user if there are no errors in the form
		if(count($errors) == 0){
			$password = md5($password);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, role, password, created_at, updated_at)
						VALUES('$username', '$email', '$role', '$password', now(), now())";
			mysqli_query($conn, $query);

			$_SESSION['message'] = "Admin user created successfully";
			header('location: users.php');
			exit(0);
		}
	}else{
		array_push($errors,"Contact the Admin to create Author");
	}

}
/*
//generate random username
function createAnonymousUser(){
  $random_username = "";
  $random_password = "";
  $min = 7;
  $max = 10;
  $
}
*/
//Takes admin id as parameter
// Fetches the admin from database
//sets admin fields on form for editing

function editAdmin($admin_id){
	global $conn, $username, $role, $isEditingUser, $admin_id, $email;

	$sql = "SELECT * FROM users WHERE id=$admin_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$admin = mysqli_fetch_assoc($result);

	// set form values ($username and $email) on the form to be updated
	$username = $admin['username'];
	$email = $admin['email'];
}

//Receives admin request from form and updates in database
function updateAdmin($request_values){
	global $conn, $errors, $role, $username, $isEditingUser, $admin_id, $email;
	// get id of the admin to be updated
	$admin_id = $request_values['admin_id'];
	// set edit state to false to prevent non edit user
	$isEditingUser = false;


	$username = charEsc($request_values['username']);
	$email = charEsc($request_values['email']);
	$password = charEsc($request_values['password']);
	$passwordConfirmation = charEsc($request_values['passwordConfirmation']);
	if(isset($request_values['role'])){
		$role = $request_values['role'];
	}
	// register user if there are no errors in the form
	if (count($errors) == 0){
		$password = md5($password);

		$query = "UPDATE users SET username='$username', email='$email', role='$role', password='$password' WHERE id=$admin_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Admin user updated successfully";
		header('location: users.php');
		exit(0);
	}
}

// delete admin user
function deleteAdmin($admin_id) {
	global $conn;
	$sql = "DELETE FROM users WHERE id=$admin_id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "User successfully deleted";
		header("location: users.php");
		exit(0);
	}
}

/***************************
****  TOPIC  FUNCTIONS  ****
***************************/

// get all topics from DB
function getAllTopics() {
	global $conn;
	$sql = "SELECT * FROM topics";
	$result = mysqli_query($conn, $sql);
	$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $topics;
}

//create topic
function createTopic($request_values){
	global $conn,$errors, $topic_name;
	$topic_name = charEsc($request_values['topic_name']);
	//slug topic
	$isEditingTopic = false;
	$topic_slug = makeSlug($topic_name);
	//ensure all parts are filed
	if(empty($topic_name)){
		array_push($errors,"Topic Name required");
	}
	//register topic if there are no errorsmin the form
	if(count($errors) == 0){
		$query = "INSERT INTO topics (name,slug) VALUES('$topic_name','$topic_slug')";
		mysqli_query($conn,$query);
		$_SESSION['message']="Topic created successfully";
		header('location:topics.php');
		exit(0);
	}
}

//edit topic
function editTopic($request_values){
	global $conn, $topic_name, $isEditingTopic, $topic_id;
	$topic_id = charEsc($request_values['topic_id']);
	$query = "SELECT * FROM topics WHERE id='$topic_id' LIMIT 1";
	$result = mysqli_query($conn,$query);
	$topic = mysqli_fetch_assoc($result);
	//update the form with the topic names
	$topic_name = $topic['name'];
}

//update a given topic
function updateTopic($request_values) {
	global $conn, $errors, $topic_name, $topic_id;
	$topic_name = charEsc($request_values['topic_name']);
	$topic_id =charEsc($request_values['topic_id']);
	// create slug: if topic is "Life Advice", return "life-advice" as slug
	$topic_slug = makeSlug($topic_name);
	// validate form
	if(empty($topic_name)){
		array_push($errors, "Topic name required");
	}
	// register topic if there are no errors in the form
	if(count($errors) == 0){
		$query = "UPDATE topics SET name='$topic_name', slug='$topic_slug' WHERE id='$topic_id'";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Topic updated successfully";
		header('location: topics.php');
		exit(0);
	}
}

//delete topic
function deleteTopic($topic_id){
	global $conn;
	$sql = "DELETE FROM topics WHERE id='$topic_id'";
	if(mysqli_query($conn,$sql)){
		$_SESSION['message'] = "Topic succesfully Deleted";
		header("location : topics.php");
		exit(0);
	}
}


// Receives a string like 'Some Sample String'
// and returns 'some-sample-string'
function makeSlug(String $string){
	$string = strtolower($string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}
?>
