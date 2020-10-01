
<?php include('../config.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php
$admins = getAdminUsers();
$realAdmin = getAdmin();
$roles  = ['Author','Admin'];
?>

<?php include(ROOT_PATH . '/admin/includes/header.php'); ?>
	<title>ADMIN | USER MANAGER </title>

</head>

<body>
 <!-- navbar -->
 <?php include(ROOT_PATH . '/admin/includes/navbar.php'); ?>
 <!-- body container -->
 <div class="container content">
	 <!-- left side menu -->
	 <?php include(ROOT_PATH . '/admin/includes/menu.php'); ?>
	 <!-- middle form to create and edit Users -->
	 <div class="action">
		 <h1 class="page-title"> Create/Edit Admin User </h1>
		 <form method="post" action="users.php">
			 <!-- validate the error' -->
			 <?php include(BASE_URL . '/includes/errors.php'); ?>
			 <!-- identify user to allow creating admin -->
			 <?php if($isEditingUser === true): ?>
				 <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
			<?php endif ?>
			<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
			<input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
			<input type="password" name="password" placeholder="Password">
			<input type="password" name="passwordConfirmation" placeholder="Password confirmation">
			<select name="role">
				<option value="" selected disabled>
					<?php foreach($roles as $key => $role): ?>
						<option value="<?php echo $role; ?>"><?php echo $role; ?></option>
					<?php endforeach ?>
			</select>
			<!-- @TODO -->
			<!-- refactored such that only admin should create or delete user -->
			<?php if($isEditingUser === true): ?>
				<button type="submit" class="btn" name="update_admin">UPDATE</button>
			<?php else : ?>
			<button type="submit" class="btn" name="create_admin">CREATE USER</button>
		  <?php endif ?>
		 </form>
	 </div>

	 <!-- Display records from DB-->
	 <div class="table-div">
		 <!-- Display notification message -->
		 <?php include(ROOT_PATH . '/includes/messages.php') ?>

		 <?php if (empty($admins)): ?>
			 <h1>No admins in the database.</h1>
		 <?php else: ?>
			 <table class="table">
				 <thead>
					 <th>N</th>
					 <th>Author</th>
					 <th>Role</th>
					 <th colspan="2">Action</th>
				 </thead>
				 <tbody>
				 <?php foreach ($admins as $key => $admin): ?>
					 <tr>
						 <td><?php echo $key + 1; ?></td>
						 <td>
							 <?php echo $admin['username']; ?>, &nbsp;
							 <?php echo $admin['email']; ?>
						 </td>
						 <td><?php echo $admin['role']; ?></td>
						 <td>
							 <a class="fa fa-pencil btn edit"
								 href="users.php?edit-admin=<?php echo $admin['id'] ?>">
							 </a>
						 </td>
						 <td>
							 <a class="fa fa-trash btn delete"
									 href="users.php?delete-admin=<?php echo $admin['id'] ?>">
							 </a>
						 </td>
					 </tr>
				 <?php endforeach ?>
				 </tbody>
			 </table>
		 <?php endif ?>
	 </div>
	 <!-- // Display records from DB -->
 </div>
 </div>

</body>
</html>
