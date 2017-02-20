<!-- Google Dev API https://developers.google.com/maps/documentation/javascript/examples/map-simple-->
<!-- Map code built @ http://staticmapmaker.com/google/ -->
<script src="<?=base_url();?>public/js/travel/travel-functions.js"></script>
<div class="container containerAlt">
	<?= isset($message) ? '<div class="alert alert-success">'.$message.'</div>' : ''; ?>
	<a href="<?=base_url();?>home/index" class="h1Link"><h1>Midwest Water Polo Society (MWWPS)</h1></a><!--Header Link-->
	<nav class="navbar navbar-inverse"><?php $this->load->view('layout/navigation'); ?></nav>
	<div class="row">
		<div class="col-md-10">
			<h2 class="h2PageHeading">Travel</h2>
		</div>
		<!-- Add team button -->
		<div class="col-md-2">
			<div class="editButton pull-right">
				<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTravel" data-toggle="tooltip" title="Add new team">
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
	
	<?php foreach($activeList as $active) { ?>
		<div class="row">
			<!-- Individual Team Travel Information -->
			<div class="col-md-10">
				<h2 class="h2SubHeading" style="margin-top: 5px; float: left; margin-top: 15px;"><?=ucwords($active['schoolName'])?></h2>
				<img src="<?=base_url() . $active['photoLink']; ?>" class="travelListLogo"/>
			</div>
			<div class="col-md-2">
			<!-- Edit / Remove team information buttons -->
				<div class="editButton pull-right" style="margin-top: 15px">
					<?php $data['id'] = "Travel".$active['schoolID']; $data['buttonType'] = 'formEdit'; $this->load->view('layout/editbutton.php', $data); ?>
					<?php $data['id'] = "Travel".$active['schoolID']; $data['buttonType'] = 'delete'; $this->load->view('layout/editbutton.php', $data); ?>
				</div>
			</div>
		</div>	
		<div style="margin-top: 10px;">
			<div class="row contentMargin" style="margin-bottom: 40px;">
				<div class="col-md-6 table-responsive" style="margin-top: 10px;">
					<table id="myTable">
						<tbody>
							<tr>	
								<th class="largeParaTravel travelHeadings">Facility:</th>
								<td class="largeParaTravel"><?=$active['schoolFacility']?></td>				
							</tr>
							<tr>
								<th class="largeParaTravel travelHeadings">Address:</th>
								<td class="largeParaTravel"><?=$active['schoolAddress']?><br /><?=$active['schoolCity']?>, <?=$active['schoolState']?> <?=$active['schoolZip']?></td>
							</tr>
							<tr>
								<th class="largeParaTravel travelHeadings">Facility Phone:</th>
								<td class="largeParaTravel"><?="(".substr($active['schoolFacilityPhone'], 0, 3).") ".substr($active['schoolFacilityPhone'], 3, 3)."-".substr($active['schoolFacilityPhone'],6)?></td>
							</tr>
							<tr>
								<th class="largeParaTravel travelHeadings">More Information:</th>
								<td class="largeParaTravel"><a href="<?=$active['schoolFacilityWebsite']?>" target="_blank"><?=$active['schoolFacilityWebsite']?></a></td>
							</tr>
						</tbody>
					</table>
				</div>
						
				<!-- Map Data -->
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12 centervh">
							<!-- Enter google minimap and button here -->
							<img style="width: 100%" src="http://maps.googleapis.com/maps/api/staticmap?size=600x300&maptype=roadmap&markers=size:mid|color:0xff0000|label:1|<?=$active['schoolAddress']?>+<?=$active['schoolCity']?>+<?=$active['schoolState']?>+<?=$active['schoolZip']?>&sensor=false">
							<!-- dir or place -->
							<?php if(($this->session->userdata('TypeUser') == 'Admin') || ($this->session->userdata('TypeUser') == 'Officer')) {?>
								 <a href="http://www.google.com/maps/dir/<?=$this->session->userdata('SchoolAddress')?>+<?=$this->session->userdata('SchoolCity')?>+<?=$this->session->userdata('SchoolState')?>+<?=$this->session->userdata('SchoolZip')?>/<?=$active['schoolAddress']?>+<?=$active['schoolCity']?>+<?=$active['schoolState']?>+<?=$active['schoolZip']?>" target="_blank"><button type="button" class="btn btn-info getDirectionBtn" data-toggle="tooltip" title="Get directions to <?=ucwords($active['schoolName'])?>">Get Directions</button></a>
							<?php } //end of if
							else{ ?>
								<a href="http://www.google.com/maps/place/<?=$active['schoolAddress']?>+<?=$active['schoolCity']?>+<?=$active['schoolState']?>+<?=$active['schoolZip']?>" target="_blank"><button type="button" class="btn btn-info getDirectionBtn data-toggle="tooltip" title="Get directions to <?=ucwords($active['schoolName'])?>"">Get Directions</button></a>
							<?php }	//end of else?>						
								<a href="https://www.google.com/maps/search/hotels+near+<?=$active['schoolAddress']?>+<?=$active['schoolCity']?>+<?=$active['schoolState']?>+<?=$active['schoolZip']?>" target="_blank"><button type="button" class="btn btn-success getDirectionBtn" data-toggle="tooltip" title="Find Hotels near <?=ucwords($active['schoolFacility'])?>">Find Hotels</button></a>
						</div>
					</div>
				</div>
			</div>	
		</div>
	<?php } //end of foreach ?>
	
<?php if($this->session->userdata('TypeUser') == 'Admin') {
	foreach($inactiveCount as $inactive){
			if($inactive['COUNT']>0){ ?> 
				<div class="row">
					<div class="col-md-12">
						<h2 class="h2PageHeading">Inactive Teams</h2>
					</div>
				</div>
				<?php foreach($inactiveTeams as $inactive) { ?>
					<hr>
					<div class="row">
						<!-- Individual Team Travel Information -->
						<div class="col-md-10">
							<h2 class="h2SubHeading" style="margin-top: 5px; float: left; margin-top: 15px;"><?=ucwords($inactive['schoolName'])?></h2>
							<img src="<?=base_url() . $inactive['photoLink']; ?>" class="travelListLogo"/>
						</div>
					</div>	
					<div style="margin-top: 10px;">
						<div class="row contentMargin" style="margin-bottom: 40px;">
							<div class="col-md-6 table-responsive" style="margin-top: 10px;">
								<table id="myTable">
									<tbody>
										<tr>	
											<th class="largeParaTravel travelHeadings">Facility:</th>
											<td class="largeParaTravel"><?=$inactive['schoolFacility']?></td>				
										</tr>
										<tr>
											<th class="largeParaTravel travelHeadings">Address:</th>
											<td class="largeParaTravel"><?=$inactive['schoolAddress']?><br /><?=$inactive['schoolCity']?>, <?=$inactive['schoolState']?> <?=$inactive['schoolZip']?></td>
										</tr>
										<tr>
											<th class="largeParaTravel travelHeadings">Facility Phone:</th>
											<td class="largeParaTravel"><?="(".substr($inactive['schoolFacilityPhone'], 0, 3).") ".substr($inactive['schoolFacilityPhone'], 3, 3)."-".substr($inactive['schoolFacilityPhone'],6)?></td>
										</tr>
										<tr>
											<th class="largeParaTravel travelHeadings">More Information:</th>
											<td class="largeParaTravel"><a href="<?=$inactive['schoolFacilityWebsite']?>" target="_blank"><?=$inactive['schoolFacilityWebsite']?></a></td>
										</tr>
									</tbody>
								</table>
							</div>
									
							<!-- Map Data -->
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12 centervh">
										<!-- Enter google minimap and button here -->
										<img style="width: 100%" src="http://maps.googleapis.com/maps/api/staticmap?size=600x300&maptype=roadmap&markers=size:mid|color:0xff0000|label:1|<?=$inactive['schoolAddress']?>+<?=$inactive['schoolCity']?>+<?=$inactive['schoolState']?>+<?=$inactive['schoolZip']?>&sensor=false">
										<!-- dir or place -->
										<?php if(($this->session->userdata('TypeUser') == 'Admin') || ($this->session->userdata('TypeUser') == 'Officer')) {?>
											 <a href="http://www.google.com/maps/dir/<?=$this->session->userdata('SchoolAddress')?>+<?=$this->session->userdata('SchoolCity')?>+<?=$this->session->userdata('SchoolState')?>+<?=$this->session->userdata('SchoolZip')?>/<?=$inactive['schoolAddress']?>+<?=$inactive['schoolCity']?>+<?=$inactive['schoolState']?>+<?=$inactive['schoolZip']?>" target="_blank"><button type="button" class="btn btn-info getDirectionBtn" data-toggle="tooltip" title="Get directions to <?=ucwords($inactive['schoolName'])?>">Get Directions</button></a>
										<?php } //end of if
										else{ ?>
											<a href="http://www.google.com/maps/place/<?=$inactive['schoolAddress']?>+<?=$inactive['schoolCity']?>+<?=$inactive['schoolState']?>+<?=$inactive['schoolZip']?>" target="_blank"><button type="button" class="btn btn-info getDirectionBtn data-toggle="tooltip" title="Get directions to <?=ucwords($inactive['schoolName'])?>"">Get Directions</button></a>
										<?php }	//end of else?>						
											<a href="https://www.google.com/maps/search/hotels+near+<?=$inactive['schoolAddress']?>+<?=$inactive['schoolCity']?>+<?=$inactive['schoolState']?>+<?=$inactive['schoolZip']?>" target="_blank"><button type="button" class="btn btn-success getDirectionBtn" data-toggle="tooltip" title="Find Hotels near <?=ucwords($inactive['schoolFacility'])?>">Find Hotels</button></a>
									</div>
								</div>
							</div>
						</div>	
					</div>
		<?php } //end of foreach
		} //end of if 
	} //end of foreach 
} //end of if ?>	
</div>		
	
<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
<!-- Travel Add Content -->
<div id="addTravel" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal Header-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Add Travel Content</h3>
			</div>

			<!-- Modal content-->
			<form method="post" action="<?=base_url();?>travel/addTravel" id="addTravelForm">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Drop-down School Name -->
						<div class="form-group">
							<label for="addSchoolName">School Name:</label>
							<input type="text" class="form-control" name="schoolName" id="addSchoolName" placeholder="Gotham University"/>
						</div>
						
						<!-- Change the facility of travel info -->
						<div class="form-group">
							<label for="addSchoolFacility">Name of Facility:</label>
							<input type="text" class="form-control" name="schoolFacility" placeholder="Student Recreation Center">
						</div>
						<!-- Change the address of travel info -->
						<div class="form-group">
							<label for="addSchoolAddress">Address:</label>
							<input type="text" class="form-control" name="schoolAddress" placeholder="5277 5th Street">
						</div>
						<!-- Change the city of travel info -->
						<div class="form-group">
							<label for="addSchoolCity">City:</label>
							<input type="text" class="form-control" name="schoolCity" placeholder="Montgomery">
						</div>
						<!-- Change the state of travel info -->
						<div class="form-group">
							<label for="addSchoolState">State:</label>
							<select name="addSchoolState" class="form-control">       				         
					           <?php $states = array('AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut','DE'=>'Delaware','DC'=>'District of Columbia','FL'=>'Florida','GA'=>'Georgia','HI'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois','IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts','MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada','NH'=>'New Hampshire','NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota','OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota','TN'=>'Tennessee','TX'=>'Texas','UT'=>'Utah','VT'=>'Vermont','VA'=>'Virginia','WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming'); ?> 
								<option selected="" disabled="disabled">Please select the state your facility is located</option>
								<?php foreach($states as $abbr => $name){ ?>
									<option><?=$name?></option>
								<?php } ?> 	 	
							</select>
						</div>
						<!-- Change the zip of travel info -->
						<div class="form-group">
							<label for="addSchoolZip">Zip Code:</label>
							<input type="text" class="form-control" name="schoolZip" placeholder="36109">
						</div>
						<!-- Change the phone of travel info -->
						<div class="form-group">
							<label for="addSchoolFacilityPhone">Facility Phone Number:</label>
							<input type="text" class="form-control" name="schoolFacilityPhone" placeholder="1234567890">
						</div>
						<!-- Change the url of facility -->
						<div class="form-group">
							<label for="schoolFacilityWebsite">Facility Website:</label>
							<input type="text" class="form-control" name="schoolFacilityWebsite" placeholder="http:\\www.studentreccenter.com">
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
						<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="">
							Quit Without Saving
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php for($i=0; $i<sizeof($activeList); $i++){ ?>
<!-- Travel Edit Content -->
<div id="editTravel<?=$activeList[$i]['schoolID']?>" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal Header-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Edit Travel Content</h3>
			</div>

			<!-- Modal content-->
			<form class="updateTravel" method="post" action="<?=base_url();?>travel/updateTravel/<?=$activeList[$i]['schoolID']?>">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Drop-down School Name -->
						<div class="form-group">
							<label for="schoolName<?=$i?>">School Name:</label>
							<input type="text" class="form-control" id="schoolName<?=$i?>" name="schoolName" value="<?=$activeList[$i]['schoolName']?>" />
						</div>				
						<!-- Change the facility of travel info -->
						<div class="form-group">
							<label for="schoolFacility<?=$i?>">Name of Facility:</label>
							<input type="text" class="form-control" id="schoolFacility<?=$i?>" name="schoolFacility" value="<?=$activeList[$i]['schoolFacility']?>">
						</div>
						<!-- Change the address of travel info -->
						<div class="form-group">
							<label for="schoolAddress<?=$i?>">Address:</label>
							<input type="text" class="form-control" id="schoolAddress<?=$i?>" name="schoolAddress" value="<?=$activeList[$i]['schoolAddress']?>">
						</div>
						<!-- Change the city of travel info -->
						<div class="form-group">
							<label for="schoolCity<?=$i?>">City:</label>
							<input type="text" class="form-control" id="schoolCity<?=$i?>" name="schoolCity" value="<?=$activeList[$i]['schoolCity']?>">
						</div>
						<!-- Change the state of travel info -->
						<div class="form-group">
							<label for="schoolState<?=$i?>">State:</label>
							<select name="tournState" class="form-control">       				         
					           <?php $states = array('AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut','DE'=>'Delaware','DC'=>'District of Columbia','FL'=>'Florida','GA'=>'Georgia','HI'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois','IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts','MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada','NH'=>'New Hampshire','NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota','OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota','TN'=>'Tennessee','TX'=>'Texas','UT'=>'Utah','VT'=>'Vermont','VA'=>'Virginia','WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming');
								
								foreach($states as $abbr => $name){
									if($activeList[$i]['schoolState']==$abbr){ ?>
										<option selected=""><?=$name?></option>
									<?php } else{ ?>
										<option><?=$name?></option>
									<?php } ?>									
								<?php } ?> 	 	
							</select>
						</div>
						<!-- Change the zip of travel info -->
						<div class="form-group">
							<label for="schoolZip<?=$i?>">Zip Code:</label>
							<input type="text" class="form-control" id="schoolZip<?=$i?>" name="schoolZip" value="<?=$activeList[$i]['schoolZip']?>">
						</div>
						<!-- Change the phone of travel info -->
						<div class="form-group">
							<label for="schoolFacilityPhone<?=$i?>">Facility Phone Number:</label>
							<input type="text" class="form-control" id="schoolFacilityPhone<?=$i?>" name="schoolFacilityPhone" value="<?=$activeList[$i]['schoolFacilityPhone']?>">
						</div>
						<!-- Change the url of facility -->
						<div class="form-group">
							<label for="schoolFacilityWebsite<?=$i?>">Facility Website:</label>
							<input type="text" class="form-control" id="schoolFacilityPhone<?=$i?>" name="schoolFacilityWebsite" value="<?=$activeList[$i]['schoolFacilityWebsite']?>">
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


<?php foreach($activeList as $school) { ?>
<!-- Delete contact info -->
<div id="deleteTravel<?=$school['schoolID']?>" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<!-- Header -->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Delete Travel Information</h3>
			</div>
			<!-- Body -->
			<div class="modal-body">
				<p>Please confirm that you want to delete the travel info for <b><?=$school['schoolName']?></b>. Note that this cannot be undone!</p>
			</div>

			<!-- Footer -->
			<div class="modal-footer">
				<!-- Accept Changes -->
				<button type="button" class="btn btn-success" data-dismiss="modal" onclick="submitDelete(<?=$school['schoolID']?>);">
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
<?php } //end of foeach 
} //end  ?>
