<!-- Forgot Password -->
<?php 
if(isset($error)) {
	echo '<div class="container alert alert-danger"><p>'.$error.'</p></div>';
}
?>
<div class="container passwordBox">
	<div class="row">
		<div class="col-md-12">
			<a href="<?=base_url();?>home/index" class="h1Link"><h1>Midwest Water Polo Society (MWWPS)</h1></a><!--Header Link-->
			<hr />
			<h2>Forgot Password</h2>
			<br />
			<p>
				Enter your email address and a new password will be sent to your email
			</p>
			<br />
		</div>
	</div>
	<form method="post" action="<?=base_url();?>login/validateemail">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group has-feedback">
					<label for="email">Email address:</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Please enter the email associated with the account" value="<?=set_value('email');?>">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<button type="submit" class="btn btn-success">
					Send Email
				</button>
			</div>
		</div>
	</form>
	<br />
</div>