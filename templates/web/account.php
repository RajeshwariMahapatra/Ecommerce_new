<?php include("include/header.php"); ?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.html">Home</a></li>
		<li class="active">Account</li>
	</ol>
	<div class="registration">
		<div class="registration_left">
			<h2>new user? <span> create an account </span></h2>
			<div class="registration_form">

				<?php if (!empty($results['errorMessage'])) : ?>
					<div class="alert alert-danger" role="alert">
						<?php echo $results['errorMessage']; ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($results['statusMessage'])) : ?>
					<div class="alert alert-success" role="alert">
						<?php echo $results['statusMessage']; ?>
					</div>
				<?php endif; ?>
				<!-- Form -->
				<form action="users.php?action=userRegister" method="POST">
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label>
									<input class="form-control" placeholder="Name" name="user_name" type="text" tabindex="1" required>
								</label>
							</div>
							<div class="form-group mt-4">
								<label>
									<input class="form-control" placeholder="Email Address" name="user_email" type="email" tabindex="2" required>
								</label>
							</div>
							<div class="form-group mt-4">
								<label>
									<input class="form-control" placeholder="Password" name="user_password" type="password" tabindex="3" required>
								</label>
							</div>
							<div class="form-group mt-4">
								<label>
									<input class="form-control" placeholder="Country Code" name="user_country_code" type="text" tabindex="4" required>
								</label>
							</div>
							<div class="form-group mt-4">
								<label>
									<input class="form-control" placeholder="Contact No" name="user_contact_no" type="text" tabindex="5" required>
								</label>
							</div>
							<div class="form-group mt-4">
								<label>
									<input class="form-control" placeholder="Birthdate (YYYY-MM-DD)" name="user_birthdate" type="date" tabindex="6" required>
								</label>
							</div>
						</div>
						<div class="col-md-2"></div> <!-- Empty column for spacing -->
						<div class="col-md-5">
							<div class="form-group">
								<label>
									<input class="form-control" placeholder="Address Line 1" name="user_address_line1" type="text" tabindex="7" required>
								</label>
							</div>
							<div class="form-group mt-4">
								<label>
									<input class="form-control" placeholder="Address Line 2" name="user_address_line2" type="text" tabindex="8">
								</label>
							</div>
							<div class="form-group mt-4">
								<label>
									<input class="form-control" placeholder="City" name="user_address_city" type="text" tabindex="9" required>
								</label>
							</div>
							<div class="form-group mt-4">
								<select name="user_address_state_id" id="user_address_state_id" class="form-control" required>
									<?php foreach ($results['states'] as $state) { ?>
										<option value="<?php echo htmlspecialchars($state->state_id); ?>" <?php echo ($state->state_id == $results['user']->user_address_state_id) ? 'selected' : ''; ?>>
											<?php echo htmlspecialchars($state->state_name); ?>
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group mt-4">
								<select name="user_address_country_id" id="user_address_country_id" class="form-control" required>
									<?php foreach ($results['countries'] as $country) { ?>
										<option value="<?php echo htmlspecialchars($country->country_id); ?>" <?php echo ($country->country_id == $results['user']->user_address_country_id) ? 'selected' : ''; ?>>
											<?php echo htmlspecialchars($country->country_name); ?>
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group mt-4">
								<label>
									<input class="form-control" placeholder="Pin Code" name="user_address_pin_code" type="text" tabindex="12" required>
								</label>
							</div>
						</div>
					</div>
					<div class="form-group mt-4">
						<input type="submit" value="Create an Account" name="saveChanges" id="saveChanges" class="btn btn-primary">
					</div>
					<div class="sky-form mt-3">
						<label class="checkbox"><input type="checkbox" name="terms" required><i></i>I agree to the Terms & Conditions &nbsp;<a class="terms" href="#">terms of service</a> </label>
					</div>
				</form>
				<!-- /Form -->
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<?php include("include/footer.php"); ?>