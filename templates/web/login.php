<?php include("include/header.php"); ?>


<?php if (!empty($results['statusMessage'])) : ?>
	<div class="alert alert-success" role="alert">
		<?php echo $results['statusMessage']; ?>
	</div>
<?php endif; ?><div class="login_sec">
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">Login</li>
		</ol>
		<h2>Login</h2>

		<div class="col-md-6 log">
			<?php if (!empty($results['error'])) : ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $results['error']; ?>
				</div>
			<?php endif; ?>
			<form action="users.php?action=userLogin" method="POST">
				<h5>Email</h5>
				<input type="email" name="user_email" required>
				<h5>Password</h5>
				<input type="password" name="user_password" required>
				<input type="submit" value="Login" name="saveChanges">
				<a class="acount-btn" href="users.php?action=userRegister">Create an Account</a>
			</form>
			<a href="#">Forgot Password ?</a>
		</div>

		<div class="clearfix"></div>
	</div>
</div>

<?php include("include/footer.php"); ?>