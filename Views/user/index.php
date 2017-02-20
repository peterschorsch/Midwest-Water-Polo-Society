<div class="container containerAlt">
	<a href="<?=base_url();?>home/index" class="h1Link"><h1>Midwest Water Polo Society (MWWPS)</h1></a><!--Header Link-->
	<nav class="navbar navbar-inverse"><?php $this->load->view('layout/navigation'); ?></nav>
	<div class="row">
		<div class="col-md-10">
			<div class="col-md-3">
				<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
					<h2 class="h2PageHeading">Active Users</h2>
				<?php } else{ ?>
					<h2 class="h2PageHeading">Users</h2>
				<?php } ?>
			</div>				
		</div>
		<div class="col-md-2 pull-right">
			<?php if($this->session->userdata('TypeUser') == 'Admin') {?>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser" id="addUserbutton" data-toggle="tooltip" title="Add user">
					<span class="glyphicon glyphicon-plus"></span> Add User
				</button>				
			<?php }?>
		</div>		
	</div>
	<hr />
	
	<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>	
			<div>
				<hr />
				<div class="col-md-6 table-responsive">
				<table class="table table-striped table-hover" id="userTable">
					<thead>
						<tr>					
							<th class="infoHeader" colspan="6">User Statistics</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="tableInfo">Total Users</th>
							<td class="linkHeaders" id="tableBorder">
								<?foreach($totalUsers as $userCount){
									echo $userCount['Count'];
								} ?>
							</td>
							<th class="linkHeaders">Admins</th>
							<td class="linkHeaders" id="tableBorder">
								<?foreach($adminTotal as $count){
									echo $count['Count'];
								} ?>
							</td>
							<th class="linkHeaders">Officers</th>	
								<td class="linkHeaders">
									<?foreach($officerTotal as $count){
										echo $count['Count'];
									} ?>
								</td>
						</tr>
						<tr>
							<th class="tableInfo">Active Users</th>
							<td class="linkHeaders" id="tableBorder">
								<?foreach($activeTotal as $count){
									echo $count['Count'];
								} ?>
							</td>				
							<th class="linkHeaders">Active Admins</th>
								<td class="linkHeaders" id="tableBorder"><?foreach($activeAdminTotal as $count){
										echo $count['Count'];
									} ?>
								</td>
							<th class="linkHeaders">Active Officers</th>
							<td class="linkHeaders">
								<?foreach($activeOfficerTotal as $count){
									echo $count['Count'];
								} ?>
							</td>
						</tr>
						<tr>
							<th class="tableInfo">Inactive Users</th>
							<td class="linkHeaders" id="tableBorder">
								<?foreach($inactiveTotal as $count){
									echo $count['Count'];
								} ?>
							</td>
							
							<th class="linkHeaders">Inactive Admins</th>
							<td class="linkHeaders" id="tableBorder">
								<?foreach($inactiveAdminTotal as $count){
									echo $count['Count'];
								} ?>
							</td>
							
							<th class="linkHeaders">Inactive Officers</th>
							<td class="linkHeaders">
								<?foreach($inactiveOfficerTotal as $count){
									echo $count['Count'];
								} ?>
							</td>		
						</tr>				
					</tbody>
					<div>
				</div>
				</table>
				<br />
			</div>
		</div>
	<?php } ?>

	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table table-striped table-hover" id="myTable">
				<thead>
					<tr>					
						<th class="linkHeaders"><a href="<?=base_url()?>user/index/userID" data-toggle="tooltip" title="Sort by ID#">ID#</a></th>
						<th class="linkHeaders"><a href="<?=base_url()?>user/index/name" data-toggle="tooltip" title="Sort by Name">Name</a></th>
						<th class="linkHeaders" colspan="2"><a href="<?=base_url()?>user/index/team" data-toggle="tooltip" title="Sort by Team" style="margin-left: 20px;">Team Affiliation</a></th>
						<th class="linkHeaders" colspan="2"><a href="<?=base_url()?>user/index/typeuser" data-toggle="tooltip" title="Sort by User Type">User Type</a></th>
						<th class="linkHeaders"></th>
						<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
							<th class="linkHeaders"></th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php $row=" ";
					foreach($activeList as $info) {
						if($this->session->userdata('UserID')==$info['userID']){
							$row = "th";
						} else{
							$row = "td";
						} ?>
							<tr>
								<<?=$row?> class="tableInfo" style="vertical-align: middle;"><?=$info['userID']?></<?=$row?>>
								<<?=$row?> class="tableInfo" style="vertical-align: middle;"><?=$info['userFirstName']?> <?=$info['userLastName']?></th>
								<td class="tableInfo"><img src="<?=base_url() . $info['photoLink']; ?>" class="userListLogo"/></td>
								<<?=$row?> class="tableTeamInfo" style="vertical-align: middle;"><?=$info['schoolName']?> <?=$info['teamMascot']?></th>
								<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
										<form method="post" action="<?=base_url();?>user/updateUserType/<?=$info['userID']?>">
											<<?=$row?> style="vertical-align: middle;">
												<select name="userTypeInput" class="form-control">
													<?php if($info['userType']=="Admin"){?>
														<option selected="" value="Admin">Admin</option>
														<option value="Officer">Officer</option>
													<?php } else { ?>
														<option value="Admin">Admin</option>
														<option selected="" value="Officer">Officer</option>
													<?php }?>
												</select>
											</<?=$row?>>
											<<?=$row?> style="vertical-align: middle;"><button type="submit" class="btn btn-info">Save</button></<?=$row?>>
										</form>
								<?php } 
									else{ ?>
										<<?=$row?> class="tableInfo" style="vertical-align: middle;"><?=$info['userType']?></<?=$row?>>
								<?php } ?>
								<td style="vertical-align: middle;">
									<button class="btn btn-warning" style="width: 100px; vertical-align: middle;" onclick="location.href='/profile/index/<?=$info['userID']?>'" data-toggle="tooltip" title="View my Profile">My Profile</button>
								</td>
								<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
									<td style="vertical-align: middle;">  
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUser" data-toggle="tooltip" title="Remove User">
											<span class="glyphicon glyphicon-trash"></span>
										</button>
									</td>
								<?php }//end of if ?>
							<?php }//end of foreach ?>
						</tr>	
				</tbody>
			</table>
		</div>	
	</div>

	<!--Inactive List-->
	<div class="row">
	<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
		<br />
		<div class="col-md-12">
			<h2 class="h2PageHeading">Inactive Users</h2>
			<hr />
		</div>
		<div class="col-md-12 table-responsive">
			<table class="table table-striped table-hover" id="myTable">
				<thead>
					<tr>					
						<th class="linkHeaders idWidth"><a href="<?=base_url()?>user/index/userID" data-toggle="tooltip" title="Sort by ID#">ID#</a></th>
						<th class="linkHeaders nameWidth"><a href="<?=base_url()?>user/index/name" data-toggle="tooltip" title="Sort by Name">Name</a></th>
						<th class="linkHeaders schoolWidth" colspan="2"><a href="<?=base_url()?>user/index/team" data-toggle="tooltip" title="Sort by Team" style="margin-left: 20px;">Team Affiliation</a></th>						
						<th class="linkHeaders" colspan="2">Change User Status</th>
						<th class="linkHeaders"></th>
						<th class="linkHeaders"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($inactiveList as $info) { ?>
						<tr>
							<td class="tableInfo"><?=$info['userID']?></td>
							<td class="tableInfo"><?=$info['userFirstName']?> <?=$info['userLastName']?></td>
							<td class="tableInfo"><img src="<?=base_url() . $info['photoLink']; ?>" class="userListLogo"/></td>
							<td class="tableTeamInfo "><?=$info['schoolName']?> <?=$info['teamMascot']?></td>
							<form method="post" action="<?=base_url();?>user/updateUserStatus/<?=$info['userID']?>">
								<td style="width: 119px">
									<select name="userStatus" class="form-control">
										<?php if($info['userStatus']=="Inactive"){?>
												<option value="Active">Active</option>
												<option selected="" value="Inactive">Inactive</option>
											<?php } else { ?>
												<option selected="" value="Active">Active</option>
												<option value="Inactive">Inactive</option>
											<?php }?>
									</select>
								</td>
								<td style="width: 82px"><button type="submit" class="btn btn-info">Save</button></td>
							</form>
							<td><button class="btn btn-primary" style="width: 100px;" onclick="location.href='/profile/index/<?=$info['userID']?>'" data-toggle="tooltip" title="View Profile">View Profile</button></td>
							<td></td>
					<?php }//end of foreach ?>
					</tr>							
				</tbody>
			</table>
		</div>
		<?php } //end of if ?>
	</div>
</div>

<!-- Add User -->
<div id="addUser" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal Header-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Add New User</h3>
			</div>

			<!-- Modal content-->
			<form class="addUser" method="post" action="<?=base_url();?>user/addUser">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<!-- First Name -->
						<div class="form-group">
							<label for="firstName">First Name:</label>
							<input type="text" class="form-control" id="firstName" name="schoolName" placeholder="Mike">
						</div>				
						<!-- Last Name -->
						<div class="form-group">
							<label for="lastName">Last Name:</label>
							<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Smith">
						</div>
						<!-- User Email -->
						<div class="form-group">
							<label for="userEmail>">Email:</label>
							<input type="text" class="form-control" id="userEmail" name="userEmail" placeholder="mikeSmith@school.edu">
						</div>
						<!-- User Phone Number -->
						<div class="form-group">
							<label for="phoneNumber">Phone Number:</label>
							<input type="text" class="form-control" id="phoneNumber" name="phoneNumber" maxlength="10" placeholder="3379582785">
						</div>
						<!-- Password -->
						<div class="form-group">
							<label for="password">Password must be:
								<ul>
									<li>
										A minimum of 8 characters in length.
									</li>
									<li>
										Contain at least 1 capital/lowercase letter.
									</li>
									<li>
										Contain at least 1 number.
									</li>
									<li>
										Contain at least 1 special character.
									</li>
								</ul>	
							</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Please enter a password" min="8">
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Footer-->
			<div class="modal-footer">
					<div class="form-group">
						<!-- Accept Changes -->
						<button type="submit" class="btn btn-success">
							Accept Changes
						</button>
						<!-- Close without saving -->
						<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.reload();">
							Quit Without Saving
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Edit User Info-->
<?php foreach($activeList as $info) {?>
<div id="updateUser" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal Header-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Edit User Information</h3>
			</div>

			<!-- Modal content-->
			<form class="updateUser" method="post" action="<?=base_url();?>user/updateUser/<?=$userID?>">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Change the First Name -->
						<div class="form-group">
							<label for="firstName">First Name:</label>
							<input type="text" class="form-control" id="firstName" name="schoolName" value="<?=$info['userFirstName']?>">
						</div>				
						<!-- Change the Last Name -->
						<div class="form-group">
							<label for="lastName">Last Name:</label>
							<input type="text" class="form-control" id="lastName" name="lastName" <?=$info['userLastName']?>>
						</div>
						<!-- Change the Email -->
						<div class="form-group">
							<label for="userEmail>">Email:</label>
							<input type="text" class="form-control" id="userEmail" name="userEmail" <?=$info['userEmail']?>>
						</div>
						<!-- Change the Phone number -->
						<div class="form-group">
							<label for="phoneNumber">Phone Number:</label>
							<input type="text" class="form-control" id="phoneNumber" name="phoneNumber" maxlength="10" <?=$info['userPhoneNumber']?>>
						</div>
						<!-- Change the password -->
						<div class="form-group">
							<label for="password">Password must be:
								<ul>
									<li>
										A minimum of 8 characters in length.
									</li>
									<li>
										Contain at least 1 capital/lowercase letter.
									</li>
									<li>
										Contain at least 1 number.
									</li>
									<li>
										Contain at least 1 special character.
									</li>
								</ul>	
							</label>
							<input type="password" class="form-control" id="password" name="password" <?=$info['password']?>>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Footer-->
			<div class="modal-footer">
					<div class="form-group">
						<!-- Accept Changes -->
						<button type="submit" class="btn btn-success">
							Accept Changes
						</button>
						<!-- Close without saving -->
						<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.reload();">
							Quit Without Saving
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<?php foreach($activeList as $info) {?>
<!-- Delete contact info -->
<div id="removeUser<?=$info['userID']?>" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<!-- Header -->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Delete User</h3>
			</div>
			<!-- Body -->
			<div class="modal-body">
				<p>Please confirm that you want to remove user, <?=$info['userFirstName']?> . " " . <?=$info['userLastName']?>?</b>. Note that this cannot be undone!</p>
			</div>

			<!-- Footer -->
			<div class="modal-footer">
				<!-- Accept Changes -->
				<button type="button" class="btn btn-success" data-dismiss="modal" onclick="submitDelete(<?=$info['userID']?>);">
					Accept Changes
				</button>
				<!-- Close without saving -->
				<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.reload();">
					Quit Without Saving
				</button>
			</div>
		</div>
	</div>
</div>
<?php } // end foreach ?>
