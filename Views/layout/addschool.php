<!-- School Not Listed Content -->
<div id="addSchool" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal Header-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Add School</h3>
			</div>

			<form id="addSchoolForm" action="<?=base_url();?>contactus/addschool" method="post">
			<!-- Modal content-->
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Enter School Name -->
						<div class="form-group">
							<label for="school">School Name:</label>
							<input type="text" class="form-control" name="schoolName" placeholder="Gotham University">
						</div>
						<!-- Change the building -->
						<div class="form-group">
							<label for="building">Name of Facility:</label>
							<input type="text" class="form-control" name="schoolFacility" placeholder="Student Recreation Center">
						</div>
						<!-- Change the address -->
						<div class="form-group">
							<label for="address">Address:</label>
							<input type="text" class="form-control" name="schoolAddress" placeholder="5277 5th Street">
						</div>
						<!-- Change the city -->
						<div class="form-group">
							<label for="city">City:</label>
							<input type="text" class="form-control" name="schoolCity" placeholder="Montgomery">
						</div>
						<!-- Change the state -->
						<div class="form-group">
							<label for="state">State:</label>
							<select name="addSchoolState" class="form-control">       				         
					           <?php $states = array('AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut','DE'=>'Delaware','DC'=>'District of Columbia','FL'=>'Florida','GA'=>'Georgia','HI'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois','IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts','MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada','NH'=>'New Hampshire','NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota','OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota','TN'=>'Tennessee','TX'=>'Texas','UT'=>'Utah','VT'=>'Vermont','VA'=>'Virginia','WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming'); ?> 
								<option selected="" disabled="disabled">Please select the state your facility is located</option>
								<?php foreach($states as $abbr => $name){ ?>
									<option><?=$name?></option>
								<?php } ?> 	 	
							</select>
						</div>
						<!-- Change the zip -->
						<div class="form-group">
							<label for="zip">Zip:</label>
							<input type="text" class="form-control" name="schoolZip" placeholder="36109">
						</div>
						<!-- Change the phone -->
						<div class="form-group">
							<label for="buildingPhone">Facility Phone:</label>
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
							Add School
						</button>
						<!-- Close without saving -->
						<button type="button" class="btn btn-danger" data-dismiss="modal">
							Close Modal Without Submitting
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>