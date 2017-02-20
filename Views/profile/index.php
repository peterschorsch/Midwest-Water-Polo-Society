<div class="container containerAlt">
	<a href="<?=base_url();?>home/index" class="h1Link"><h1>Midwest Water Polo Society (MWWPS)</h1></a><!--Header Link-->
	<nav class="navbar navbar-inverse"><?php $this->load->view('layout/navigation'); ?></nav>
	<?php foreach($profile as $info) { ?>
		<div>
			<div class="col-md-10">
				<h2 class="h2PageHeading"><?=$info['userFirstName']?> <?=$info['userLastName']?></h2>
			</div>
			<div class="col-md-2 pull-right">
				<?php if($this->session->userdata('TypeUser')=='Admin' || $this->session->userdata('UserID')==$info['userID']) {?> 
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#editUser" style="margin-left: 120px;" data-toggle="tooltip" title="Edit Profile">
						<span class="glyphicon glyphicon-cog"></span>
					</button>
				<?php } ?>
			</div>			
		</div>
		
		<div class="row">
			<div class="col-md-3">
				<img src="<?= base_url() . $info['photoLink']; ?>" class="centervh profileImg" />	
			</div>
			<div class="col-md-9">
				<table class="table table-striped table-hover table-responsive">
					<tbody>
						<tr>
							<th>Team Affiliation:</th>
							<td><?=$info['schoolName']?> <?=$info['teamMascot']?></th>
						</tr>
						<tr>
							<th>User Type:</th>
							<td><?=$info['userType']?></th>
						</tr>
						<tr>
							<th>Email:</th>	
							<td><?=$info['userEmail']?></th>
						</tr>
						<tr>
							<th>Phone:</th>	
							<td><?="(".substr($info['userPhoneNumber'], 0, 3).") ".substr($info['userPhoneNumber'], 3, 3)."-".substr($info['userPhoneNumber'],6)?></th>
						</tr>
						<tr>	
							<th>Password Expiration Date:</th>
							<td><?php $dateTime = strtotime($info['passEffectiveDate']);?><?=date("m/d/Y", $dateTime)?></th>
						</tr>
						<tr>	
							<th>Last login:</th>
							<td><?=date("m/d/Y",strtotime($info['userLastLogin']))?><br><?=date("h:i:sA",strtotime($info['userLastLogin']))?></th>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	<?php } ?>
</div>