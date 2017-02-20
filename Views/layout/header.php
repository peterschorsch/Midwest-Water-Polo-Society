<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?=base_url();?>home/index">Welcome, <?php $firstName = $this->session->userdata('FirstName'); echo (isset($firstName) ? $this->session->userdata('FirstName') : $this->session->userdata('TypeUser'));?>!</a>	
	</div>
	<div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="<?=base_url();?>home/index" data-toggle="tooltip" title="View Home Page"><span class="glyphicon glyphicon-home"></span> Home</a>
			</li>
			<?php
				$typeUser = $this->session->userdata('TypeUser'); 
				if($typeUser != 'Guest') { ?>		
					<li>
						<a href="<?=base_url();?>profile/index/<?=$this->session->userdata('UserID')?>" data-toggle="tooltip" title="View my Profile"><img style="border-radius: 10px" width="20px" length="20px" src="<?=base_url() . $this->profilePic?>"/> My Profile</span></a>
					</li>
					<li>
						<a href="<?=base_url();?>user/index" data-toggle="tooltip" title="View list of Users"><span class="glyphicon glyphicon-user"></span> Users <span class="badge" ><?=$this->userCount?></span></span></a>
					</li>
					<li> 
						<a href="<?=base_url();?>changerequest/index" data-toggle="tooltip" title="View Change Requests"><span class="glyphicon glyphicon-list-alt"></span> Change Requests <span class="badge"><?=$this->requestCount?></span></a>
					</li> 
					<li>
						<a href="#" id="messages" data-toggle="tooltip" title="View Messages"><span class="glyphicon glyphicon-envelope"></span> Messages <span class="badge"><?=$this->notificationCount?></span></a>
					</li>
					<li>
						<a href="<?=base_url();?>login/logout" data-toggle="tooltip" title="Logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
					</li>
			<?php		
				}//end of if
				else {
			?>
					<li>
						<a href="<?=base_url();?>login" data-toggle="tooltip" title="Login"><span class="glyphicon glyphicon-log-in"></span> Login</a>
					</li>
			<?php
				}//end of else  
			?>			
		</ul>
	</div>
</div>