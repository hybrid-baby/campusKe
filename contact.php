


	<?php  include('config.php'); ?>
	<?php  include('includes/header.php'); ?>
		<title>Campus Blog | CONTACT US</title>
	</head>
	<body>
		<div class="container">
			<!-- Navbar -->
			<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
			<!-- // Navbar -->
			<!-- check if user is signed in so as not to show or show banner -->
			<?php if(isset($_SESSION['user']['username'])){ ?>
				<!-- user is set show only admin contacts -->
				<?php  include(ROOT_PATH . '/includes/admin_contact.php'); ?>
				<?php include(ROOT_PATH . '/includes/contact_form.php'); ?>
			<!-- else user not set, show admin contact and sample form plus sign in banner-->
		<?php }else{ ?>
			<?php include(ROOT_PATH . '/includes/banner.php'); ?>
			<?php include(ROOT_PATH . '/includes/admin_contact.php'); ?>
			<?php include(ROOT_PATH . '/includes/contact_form.php'); ?>
		<!-- end if statement -->
	<?php } ?>

		<!-- Footer -->
			<?php include( ROOT_PATH . '/includes/footer.php'); ?>
		<!-- // Footer -->
