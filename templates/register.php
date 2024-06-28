<?php include './include/user_header.php' ?>
<!-- //header -->
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Register</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>Register Here</h2>
			<div class="login-form-grids">
				<h5>profile information</h5>
				<form action="insert.php" method="post">
					<input type="text" name="user_name" placeholder="Full Name" required=" " >
					<input type="email" name="user_email" placeholder="Email Address" required=" " >
					<input type="password" name="user_password" placeholder="Password" required=" " >
					<input type="text" name="user_contact_no" placeholder="Contact Number" required=" " >
					<input type="text" name="user_country_code" placeholder="Country Code" required=" " >
					<input type="date" name="user_birthdate" placeholder="Birthdate" required=" " >
					<input type="submit" value="Register">
				</form>
			</div>
			<div class="register-home">
				<a href="index.php">Home</a>
			</div>
		</div>
	</div>
<!-- //register -->
<!-- footer -->
<?php include './include/user_footer.php' ?>