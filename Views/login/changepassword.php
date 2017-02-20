<!-- Change Password -->
<?php 
if(isset($error)) {
	echo '<div class="container alert alert-danger"><p>'.$error.'</p></div>';
}
?>
<div class="container passwordBox">
	<div class="row">
		<div class="col-md-12">
			<h2>Create New Password</h2>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<form role="form" method="post" action="<?=base_url();?>login/validatePassword">
				<div class="form-group has-feedback">
					<label for="pwd">Enter a new password for your account:</label>
					<input type="password" class="form-control" id="pwd" name="password" min="8" placeholder="Enter your new password" autofocus/>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<label for="confirmpassword">Re-Enter Password</label>
					<input type="password" class="form-control" name="confirmpassword" id="confpwd" min="8" placeholder="Re-enter your new password"/>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					
				</div>
				<hr/><br/>
				<input type="submit" class="btn btn-success" value="Change Password" />
			</form>
		</div>
		<div class="col-md-6">
			<p>
				Requirements:
			</p>
			<ul>
				<li>
					Minimum 8 characters in length.
				</li>
				<li>
					Contains at least 1 capital/lowercase letter.
				</li>
				<li>
					Contains at least 1 number.
				</li>
				<li>
					Contains at least 1 special character.
				</li>
			</ul>
		</div>
	</div>
	<br />
</div>