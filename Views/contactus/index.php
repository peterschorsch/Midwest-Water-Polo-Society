<script src="<?=base_url();?>public/js/contactus/contactus-functions.js"></script>
<!-- Contact Us -->
<div class="container containerAlt">
	<?=(!empty($message)) ? '<div class="alert alert-success">'.$message.'</div>' : '';?>
	<a href="<?=base_url();?>home/index" class="h1Link"><h1>Midwest Water Polo Society (MWWPS)</h1></a><!--Header Link-->
	<nav class="navbar navbar-inverse"><?php $this->load->view('layout/navigation');?></nav>

	<div class="row">
		<div class="col-md-10">			
			<h2 class="h2PageHeading">Contact Us</h2>
		</div>
		<!-- Add team button -->
		<div class="col-md-2">
			<div class="editButton pull-right">
				<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTeamInfo">
					<span class="glyphicon glyphicon-plus"></span>
				</button>
				<?php } ?>
			</div>
		</div>
	</div>
	<hr />

	<div class="col-md-12 table-responsive">
		<table class="table table-striped table-hover" id="userTable">
			<thead>
				<tr>					
					<th class="infoHeader" colspan="12">Team Statistics</th>
				</tr>
			</thead>
				<tbody>
					<tr>
						<td class="statsCenter"><p><strong>Active Teams</strong> = <?php foreach($activeCount as $active){
							echo $active['COUNT']; ?></p>
						</td>
						<td class="statsCenter"><strong>Inactive Teams</strong> = <?php foreach($inactiveCount as $inactive){
								echo $inactive['COUNT']; 
							}//end of inactive foreach ?> </td>
						<td class="statsCenter"><strong>Total Teams</strong> = <?php echo $active['COUNT'] + $inactive['COUNT'];
							} //end of active foreach ?> </td>
					</tr>
				</tbody>
		</table>
		<br />
	</div>
	
	<div id="Content">
	<?php for($i=0; $i<sizeof($activeList); $i++) {?>
		<div class="row">
			<div class="col-md-10">
				<h2 class="h2SubHeading"><?=$activeList[$i]['schoolName']?></h2>
			</div>
			<div class="col-md-2">
				<!-- Edit / Remove team information buttons -->
				<div class="editButton pull-right">
					<?php $data['id'] = 'TeamInfo'.$activeList[$i]['teamID']; $data['buttonType'] = 'formEdit'; $this->load->view('layout/editbutton.php', $data); ?>
					<?php $data['id'] = 'TeamInfo'.$activeList[$i]['teamID']; $data['buttonType'] = 'delete'; $this->load->view('layout/editbutton.php', $data); ?>
				</div>
			</div>
		</div>
		<hr style="border-bottom: 2px double gray; margin-bottom: 20px;">	
		<!-- Displays team name, coach, captain, phone, and email -->
		<div class="row contentMargin">
			<div class="col-md-3 imgNoPad centervh">
				<img src="<?= base_url().$activeList[$i]['photoLink']; ?>" class="contactUsImg">
			</div>
			<div class="col-md-9 teamContactRow">
				<table class="contactTable">
					<tr><td><p class="largePara contactCell">Mascot:</p></td><td><p class="largePara">&nbsp; <?=$activeList[$i]['teamMascot']?></p></td></tr>
					<tr><td><p class="largePara contactCell">Coach:</p></td><td><p class="largePara">&nbsp; <?=$activeList[$i]['teamCoach']?></p></td></tr>
					<tr><td><p class="largePara contactCell">Captain:</p></td><td><p class="largePara">&nbsp; <?=$activeList[$i]['teamCaptain']?></p></td></tr>
					<tr><td><p class="largePara contactCell">Phone:</p></td><td><p class="largePara">&nbsp; <?="(".substr($activeList[$i]['teamPhone'], 0, 3).") ".substr($activeList[$i]['teamPhone'], 3, 3)."-".substr($activeList[$i]['teamPhone'],6)?></p></td></tr> 
					<tr><td><p class="largePara contactCell">Email:</p></td><td><p class="largePara">&nbsp; <?=$activeList[$i]['teamEmail']?></p></td></tr>
					<tr><td><p class="largePara contactCell">Team Website:</p></td><td><p class="largePara">&nbsp; <a href="<?=$activeList[$i]['teamWebsite']?>" target="_blank"><?=$activeList[$i]['teamWebsite']?></a></p></td></tr>
				</table>
			</div>
		</div>
	<?php }?>
	</div>
	
	<!--Inactive Teams -->
	<?php if($this->session->userdata('TypeUser') == 'Admin') { 
		foreach($inactiveCount as $inactive){
			if($inactive['COUNT']>0){ ?>
				<div class="row">
					<div class="col-md-12">			
						<h2 class="h2PageHeading">Inactive Teams</h2>
						<hr />
						<br />
					</div>	
				</div>
				<div id="Content">
					<?php for($i=0; $i<sizeof($inactiveList); $i++) {?>
						<div class="row">
							<div class="col-md-12">
								<h2 class="h2SubHeading"><?=$inactiveList[$i]['schoolName']?></h2>
							</div>
						</div>
						<hr style="border-bottom: 2px double gray; margin-bottom: 20px;">	
						<!-- Displays team name, coach, captain, phone, and email -->
						<div class="row contentMargin">
							<div class="col-md-3 imgNoPad centervh">
								<img src="<?= base_url().$inactiveList[$i]['photoLink']; ?>" class="contactUsImg">
							</div>
							<div class="col-md-9 teamContactRow">
								<table class="contactTable">
									<tr><td><p class="largePara contactCell">Mascot:</p></td><td><p class="largePara">&nbsp; <?=$inactiveList[$i]['teamMascot']?></p></td></tr>
									<tr><td><p class="largePara contactCell">Coach:</p></td><td><p class="largePara">&nbsp; <?=$inactiveList[$i]['teamCoach']?></p></td></tr>
									<tr><td><p class="largePara contactCell">Captain:</p></td><td><p class="largePara">&nbsp; <?=$inactiveList[$i]['teamCaptain']?></p></td></tr>
									<tr><td><p class="largePara contactCell">Phone:</p></td><td><p class="largePara">&nbsp; <?="(".substr($inactiveList[$i]['teamPhone'], 0, 3).") ".substr($inactiveList[$i]['teamPhone'], 3, 3)."-".substr($inactiveList[$i]['teamPhone'],6)?></p></td></tr> 
									<tr><td><p class="largePara contactCell">Email:</p></td><td><p class="largePara">&nbsp; <?=$inactiveList[$i]['teamEmail']?></p></td></tr>
									<tr><td><p class="largePara contactCell">Team Website:</p></td><td><p class="largePara">&nbsp; <a href="<?=$inactiveList[$i]['teamWebsite']?>" target="_blank"><?=$inactiveList[$i]['teamWebsite']?></a></p></td></tr>
								</table>
							</div>
						</div>
				<?php } ?>
				</div>
			<hr />
			<?php } //end of if
		}//end of inactive foreach 
	} //end of if ?>
</div>

<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>		
<!-- Add contact info -->
<div id="addTeamInfo" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<!-- Header -->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Add Contact Information</h3>
			</div>
			<!-- Body -->
			<form action="<?=base_url();?>contactus/addTeam" enctype="multipart/form-data" method="post" id="addTeam">
			<div class="modal-body">
				<div class="form-group">
					<label for="teamLogoAdd">Team Logo:</label><br/>
					<img id="teamLogoAdd" src="" class="img-thumbnail" alt="Uploaded Team Logo" style="height: 100px; width: 150px;"/><br />
					<div class="input-group">
		                <span class="input-group-btn">
		                    <span class="btn btn-primary btn-file">
		                        Browse <input type="file" name="teamLogo" accept="image/*"/>
		                    </span>
		                </span>
		                <input class="form-control" readonly="" type="text" name="teamLogoFilename">
            		</div>
				</div>
				<!-- Drop-down School Name -->
				<div class="form-group">
					<label for="addSchoolID">School Name:</label>
					<select id="addSchoolID" name="schoolID" class="form-control schoolID">
						<?php foreach($schoolInfo as $school) { ?>
							<option value="<?=$school['schoolID'];?>"><?=$school['schoolName'];?></option>
						<?php } ?>
					</select>
					<!-- Link takes users to form to add School name to list -->
					<a href="#" data-toggle="modal" data-target="#addSchool">School not Listed?</a>
				</div>
				<!-- Team Name -->
				<div class="form-group">
					<label for="team">Team Mascot:</label>
					<input type="text" class="form-control" name="teamName" placeholder="Cougars">
				</div>
				<!-- Team Coach -->
				<div class="form-group">
					<label for="team">Team Coach:</label>
					<input type="text" class="form-control" name="teamCoach" placeholder="Alex Smith">
				</div>
				<!-- Team Captain -->
				<div class="form-group">
					<label for="team">Team Captain:</label>
					<input type="text" class="form-control" name="teamCaptain" placeholder="John Doe">
				</div>
				<!-- Phone Number -->
				<div class="form-group">
					<label for="phone">Phone Number:</label>
					<input type="text" class="form-control" name="teamPhone" placeholder="0987654321">
				</div>
				<!-- Email Address -->
				<div class="form-group">
					<label for="email">Email Address:</label>
					<input type="text" class="form-control" name="teamEmail" placeholder="alexsmith@school.edu">
				</div>
			</div>
			<!-- Footer -->
			<div class="modal-footer">
				<div class="form-group">
						<!-- Accept Changes -->
						<button type="submit" class="btn btn-success" >Accept Changes</button>
						<!-- Close without saving -->
						<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.reload();">
							Quit without saving
						</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>

<?php foreach($activeList as $team) { ?>
<!-- Change contact info -->
<div id="editTeamInfo<?=$team['teamID']?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<!-- Header -->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Change Contact Information</h3>
			</div>
			<!-- Body -->
			<form action="<?=base_url();?>contactus/updateTeamInfo/<?=$team['teamID']?>" enctype="multipart/form-data" method="post" class="updateTeam">
			<div class="modal-body">
				<div class="form-group">
					<label for="teamLogo<?=$team['teamID']?>">Team Logo:</label><br/>
					<img id="teamLogo<?=$team['teamID']?>" src="<?=base_url().$team['photoLink']?>" class="img-thumbnail" alt="Uploaded Team Logo" style="height: 100px; width: 150px;"/>
					<p>Images should be 300x200px for best results.</p>
					<div class="input-group">
		                <span class="input-group-btn">
		                    <span class="btn btn-primary btn-file">
		                        Browse <input type="file" name="teamLogo" accept="image/*"/>
		                    </span>
		                </span>
		                <input class="form-control" readonly="" type="text" name="teamLogoFilename" value="<?=isset($team['photoLink']) ? end((explode('/', $team['photoLink']))) : '';?>" />
            		</div>
				</div>
				<!-- School Name -->
				<div class="form-group">
					<label for="schoolID<?=$team['teamID']?>">School Name:</label>
					<select id="schoolID<?=$team['teamID']?>" name="schoolID" class="form-control schoolID">
						<?php foreach($activeList as $school) { ?>
							<option value="<?=$school['schoolID'];?>" <?=($school['schoolName'] == $team['schoolName'])? 'selected' : ''?>><?=$school['schoolName'];?></option>
						<?php } ?>
					</select>
				</div>
				<!-- Team Name -->
				<div class="form-group">
					<label for="teamName">Team Mascot:</label>
					<input type="text" class="form-control" name="teamName" value="<?=$team['teamMascot']?>">
				</div>
				<!-- Team Coach -->
				<div class="form-group">
					<label for="teamCoach">Team Coach:</label>
					<input type="text" class="form-control" name="teamCoach" value="<?=$team['teamCoach']?>">
				</div>
				<!-- Team Captain -->
				<div class="form-group">
					<label for="teamCaptain">Team Captain:</label>
					<input type="text" class="form-control" name="teamCaptain" value="<?=$team['teamCaptain']?>">
				</div>
				<!-- Phone Number -->
				<div class="form-group">
					<label for="teamPhone">Phone Number:</label>
					<input type="text" class="form-control" name="teamPhone" value="<?=$team['teamPhone']?>">
				</div>
				<!-- Email Address -->
				<div class="form-group">
					<label for="teamEmail">Email Address:</label>
					<input type="text" class="form-control" name="teamEmail" value="<?=$team['teamEmail']?>">
				</div>
			</div>
	
			<!-- Footer -->
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
			</div>
			</form>
		</div>
	</div>
</div>
<?php } // end foreach ?>

<?php foreach($activeList as $team) { ?>
<!-- Delete contact info -->
<div id="deleteTeamInfo<?=$team['teamID']?>" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<!-- Header -->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Delete Contact Information</h3>
			</div>
			<!-- Body -->
			<div class="modal-body">
				<p>Please confirm that you want to delete the team info for <b><?=$team['teamMascot']?></b>. Note that this cannot be undone!</p>
			</div>

			<!-- Footer -->
			<div class="modal-footer">
				<!-- Accept Changes -->
				<button type="button" class="btn btn-success" data-dismiss="modal" onclick="submitDelete(<?=$team['teamID']?>);">
					Accept Changes
				</button>
				<!-- Close without saving -->
				<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.reload();">
					Quit Without Saving
				</button>
				<!-- Delete Team -->
			</div>
		</div>
	</div>
</div>
<?php } // end foreach 
} //end if
$this->load->view('layout/addschool');
?>



