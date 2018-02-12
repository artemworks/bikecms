<h1 class="display-4">Registration</h1>
	<form method="POST">
				<div class="row">
					<div class="form-group col-md-6">
					  <label for="email">Your Login</label>
					  <input class="form-control" name="reg_name" type="text" aria-describedby="loginHelp" placeholder="Enter Your Login">
					  <small id="loginHelp" class="form-text text-muted">Desired login in latin.</small>
					</div>

					<div class="form-group col-md-6">
					  <label for="email">Real Name</label>
					  <input class="form-control" name="reg_real" type="text" aria-describedby="nameHelp" placeholder="Enter Your Real Name">
					  <small id="nameHelp" class="form-text text-muted">Real name. May be in cyrillic.</small>
					</div>

					<div class="form-group col-md-6">
					  <label for="email">Password</label>
					  <input class="form-control" name="reg_pass" type="password" aria-describedby="passHelp" placeholder="Enter Your Password">
					  <small id="passHelp" class="form-text text-muted">At least 6 characters long.</small>
					</div>

					<div class="form-group col-md-6">
					  <label for="email">Email address</label>
					  <input class="form-control" type="email" name="reg_email" aria-describedby="emailHelp" placeholder="Enter email@youremail">
					  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
					</div>
				</div>
				<input type="submit" class="btn btn-outline-primary" name="submit" value="Register">
				<input type="submit" class="btn btn-outline-secondary" name="cancel" value="Cancel">
</form>