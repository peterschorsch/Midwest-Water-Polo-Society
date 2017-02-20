<!-- Original task.js script, now included in the calendar.js file -->
<script src="<?= base_url(); ?>public/js/calendar/task.js"></script>
<script src="<?= base_url(); ?>public/js/calendar/calendar.js"></script>
<script src="<?=base_url()?>public/js/schedule/availability-functions.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="<?= base_url(); ?>public/css/bootstrap-3.3.5-dist/css/calendar/calendar.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<!-- Multi-browser support datepicker-->
<script>
	$(function() {
		$("#datepicker").datepicker();
	}); 
</script>

<!-- Availability Content -->
<div class="container containerAlt">
	<a href="<?= base_url(); ?>home/index" class="h1Link"><h1>Midwest Water Polo Society (MWWPS)</h1></a><!--Header Link-->
	<nav class="navbar navbar-inverse"><?php $this -> load -> view('layout/navigation'); ?></nav>
	
	<!-- Availability Page Heading -->
	<div class="row">
		<div class="col-md-12">
			<h2 class="h2PageHeading">Availability</h2>
			<hr><br />
		</div>
	</div>
	<div class="row">
		<div class="col-md-0">
    			<input type="text" id="myday" hidden onchange="buildCalendar();" />
    				<select id="mymonth" hidden onchange="buildCalendar();">
    					<option value="0">January</option>
    					<option value="1">February</option>
    					<option value="2">March</option>
						<option value="3">April</option>
						<option value="4">May</option>
						<option value="5">June</option>
						<option value="6">July</option>
						<option value="7">August</option>
						<option value="8">September</option>
						<option value="9">October</option>
						<option value="10">November</option>
						<option value="11">December</option>
					</select>
    			<!--<input type="number" id="myyear" hidden onchange="buildCalendar();" />
   			
    			
  
   			<div id="calendarDisplay">
    			<!-- render calendar with js 
    			
   			</div>-->
		</div>
	
		<!-- Form to pick team availability for a given date -->
		<div class="col-md-12">
			<form id="addAvailability" method="post" action="<?= base_url(); ?>availability/insertWeekend">
				<h3 class="h3SubHeading centervh">Pick Available Weekend</h3>
				<div class="centervh">
					<table class="availabilityTable">
						<tr>
							<th id="tableInfo">
								<!-- Pick the date using JQuery datepicker -->
								<div class="form-group">
									<label class="formLabel">Date:</label>
								</div>
							</th>
							<td>
								<input type="date" id="datepicker" name="availabilityDate" required="required" onchange="" title="An available date must be informed" class="form-control" style="width: 100px;">						
							</td>
						</tr>
						<tr>
							<th id="tableInfo">
								<!-- Input Dropdown for availability -->
								<div class="form-group">
									<label class="formLabel" id="">Available:</label>
								</div>	
							</th>
							<td>
								<div class="form-group">
									<select id="yesNo" name="availabilityValue" class="form-control" style="width: 90px;">
										<option value="Yes">Yes</option>
										<option value="Maybe">Maybe</option>
										<option value="No">No</option> 
									</select>
								</div>	
							</td>							
						</tr>						
					</table>	
					<br />
					<!-- Submit Form -->
					<button type="submit" class="btn btn-success"> <!--insert onclick with schoolName session variable-->
						Submit
					</button>
				</div>
			</form>
			<br />
		</div>
	</div>
	
	<!--LIST OF AVAILABILITY-->
	<div class="row">
		<div class="col-md-12" id="currentAvailability">
			<h2 class="h2SubHeading">Date Availability</h2>
			<hr>
	<?php foreach($availability as $list){?>
		<?php $date = date("m/d/Y", strtotime($list['availabilityDate'])); 
			  $yearDate = date("Y", strtotime($list['availabilityDate'])); 
			  $computerDate = date("Y"); 
			  $row = " ";
		if($yearDate==$computerDate){ ?>
			<h3><?=$time = date("l, F jS, Y", strtotime($list['availabilityDate']));?></h3>
			<?php if(date("m/d/Y",strtotime($list['availabilityDate']))==$date){?>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th class="col-md-3" id="tableInfo">School</th>
							<th class="col-md-2" id="tableInfo">Availability</th>
							
							<!-- If admin, show extra details -->
							<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
								<th class="col-md-2" id="tableInfo">Time Created</th>
								<th class="col-md-1" id="tableInfo">User ID</th>
								<th class="col-md-2" colspan="2" id="tableInfo">Name</th>
								<th class="col-md-1" id="tableInfo">User Type</th>
							<?php } //end of if ?>
						</tr>
						<?php if($this->session->userdata('UserID')==$list['userID']){
							$row = "th";
						} else{
							$row = "td";
						} ?>
						<tr>
							<!-- School Name -->
							<<?=$row?>><img src ="<?=base_url() . $list['photoLink']; ?>" class="schoolLogo" /><?=$list['schoolName'];?></<?=$row?>>
							<!-- Availability Choice -->
							<<?=$row?> id="tableInfo">
								<!--CHANGE PAST SUBMISSION BASED ON USER'S SCHOOL-->
								<?php if($list['schoolName']==$this->session->userdata('SchoolName')){ ?>
									<div class="form-group" id="availabilityChoice">
										<form class="updateAvailability" method="post" action="<?=base_url(); ?>availability/updateWeekend">
											<input name="availabilityDate" type="text" hidden value="<?=$list['availabilityDate']?>"/>
											<select name="availabilityValue" class="form-control" style="width: 90px; float: left;">
												<option value="Yes" <?=$list['availabilityLevel'] == 'Yes' ? 'selected' : ''?>>Yes</option>
												<option value="Maybe" <?=$list['availabilityLevel'] == 'Maybe' ? 'selected' : ''?>>Maybe</option>
												<option value="No" <?=$list['availabilityLevel'] == 'No' ? 'selected' : ''?>>No</option>
											</select>
											<button type="submit" class="btn btn-info">Save</button>
										</form>
									</div>
								<?php } //end of if
								else{ ?>
									<?=$list['availabilityLevel']?>
								<?php }//end of else ?>
							</<?=$row?>>
							
						<!-- If Admin, show extra details -->
						<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
							<!-- Time Created -->
							<<?=$row?> id="tableInfo"><?= date("m/d/Y @ h:iA", strtotime($list['timeOfCreation'])); ?></td>
						
							<!-- User ID -->
							<<?=$row?> id="tableInfo"><?= $list['userID']; ?></td>
						
							<!-- User Name -->
							<td id="tableInfo"><img class="changeRequestImage" src="<?=base_url() . $list['ProfilePic']?>" style="width: 50px;"></td>
							<<?=$row?> id="tableInfo"><?= $list['userFirstName']; ?> <?= $list['userLastName']; ?></<?=$row?>>
						
							<!-- User Type -->
							<<?=$row?> id="tableInfo"><?= $list['userType']; ?></<?=$row?>>
						<?php } //end of if ?>
					</tr>
				<?php }//end of if
						else{ ?>
							<tr>
								<!-- School Name -->
								<<?=$row?> id="tableInfo"><?= $list['schoolName']; ?></<?=$row?>>
								<!-- Availability Choice -->
								<<?=$row?> id="tableInfo">
									<!--CHANGE PAST SUBMISSION BASED ON USER'S SCHOOL-->
									<?php if($list['schoolName']==$this->session->userdata('SchoolName')){ ?>
										<form class="updateAvailability" method="post" action="<?= base_url(); ?>availability/updateWeekend">
											<input name="availabilityDate" type="text" hidden value="<?=$list['availabilityDate']?>" id="tableInfo"/>
											<select name="availabilityValue" id="tableInfo">
												<option value="Yes" <?=$list['availabilityLevel'] == 'Yes' ? 'selected' : ''?>>Yes</option>
												<option value="Maybe" <?=$list['availabilityLevel'] == 'Maybe' ? 'selected' : ''?>>Maybe</option>
												<option value="No" <?=$list['availabilityLevel'] == 'No' ? 'selected' : ''?>>No</option>
											</select>
											<button type="submit" class="btn btn-info"> Save </button>
										</form>
									<?php } else { //end of if ?>
										<?=$list['availabilityLevel']; ?>
									<?php } ?>
								</<?=$row?>>
								
								<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
									<!-- Time Created -->
									<<?=$row?> id="tableInfo"><?= date("m/d/Y @h:iA", strtotime($list['timeOfCreation'])); ?></<?=$row?>>
									
									<!-- User ID -->
									<<?=$row?> id="tableInfo"><?= $list['userID']; ?></td>
									
									<!-- User Name -->
									<<?=$row?> id="tableInfo"><?= $list['userFirstName']; ?> <?= $list['userLastName']; ?></<?=$row?>>
									
									<!-- User Type -->
									<<?=$row?> id="tableInfo"><?=$list['userType']; ?></<?=$row?>>
								<?php } //end of if ?>
							</tr>	
						<?php } //end of else ?>
					</table>
				</div>
			<?php }//end of if 
			else{
				echo "No availability to show for this year";
			} ?>
		<?php }//end of foreach ?>
		</div>
	</div>
</div>