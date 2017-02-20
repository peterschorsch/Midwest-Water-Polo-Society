<!-- Login Screen -->
<?php 
if(isset($success)) {
	echo '<div class="container alert alert-success"><p>'.$success.'</p></div>';
}
if(isset($error)) {
	echo '<div class="container alert alert-danger"><p>'.$error.'</p></div>';
} ?>
<div class="container loginBox">
	<div class="row">
		<div class="col-md-12 center-block">
			<a href="<?=base_url();?>home/index"><img src="<?=base_url();?>public/images/waterpolologo.jpg" class="centervh loginImage"></a>
			<hr />
			<h1 class="centervh">User Login</h1>
			<div class="row">
				<div class="col-md-12">
					<form method="post" action="<?=base_url();?>login/validatelogin">
						<div class="form-group has-feedback">
							<label for="email">Email address:</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="email@email.com" value="<?=set_value('email');?>" autofocus />
							<span class="glyphicon glyphicon-user form-control-feedback"></span>
						</div>
						<div class="form-group has-feedback">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Please enter your password"/>
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						</div>
						<button type="submit" class="btn btn-success center-block">
							Login
						</button>
					</form>
				</div>
			</div>
			<br />
			<p class="centervh">
				Forgot password? <a href="<?=base_url();?>login/resetpassword">Click here</a>
			</p>
		</div>
	</div>
</div>