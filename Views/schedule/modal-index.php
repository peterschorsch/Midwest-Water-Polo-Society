<!-- Add Season -->
<div id="addSeason" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal Header-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Add Season</h3>
			</div>

			<!-- Modal content-->
			<form method="post" action="<?=base_url();?>schedule/addSeason" id="addSeasonForm">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Season Year -->
						<div class="form-group">
							<label for="tournName">Season Year:</label>
								<?php
								$endingYear = date("Y");
								$startingYear = $endingYear-50;
								
								for($startingYear; $startingYear <= $endingYear; $startingYear++) {
    								$years[] = '<option value="'.$startingYear.'">'.$startingYear.'</option>';
								}
								rsort($years);
								?>
					
								<select class="form-control">
								    <option value="" disabled selected>Please select a year</option>
								    <?php echo implode("\n\r", $years);  ?>
								</select> 
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
						<button type="button" class="btn btn-danger" data-dismiss="modal">
							Quit Without Saving
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Schedule Add Tournament -->
<div id="addTournament" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal Header-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Add Tournament</h3>
			</div>

			<!-- Modal content-->
			<form method="post" action="<?=base_url();?>schedule/addTournament/<?//need seasonID?>" id="addTournamentForm">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Season -->
						<div class="form-group">
							<label for="seasonYr">Season Year:</label>
							<select class="form-control" id="seasonYear" name="seasonYear">
								<option value="" disabled selected>Please select a year</option>
								<?php 
								foreach($seasonYr as $yr){?>
									<option><?=$yr['seasonYear']?></option>
								<?php } ?>
							</select>
						</div>
						<!-- Tournament Name -->
						<div class="form-group">
							<label for="tournName">Tournament Name:</label>
							<input type="text" class="form-control" id="tournName" name="tournamentName" placeholder="Hooligans Tournament">
						</div>
						<!-- Tournament/School Location -->
						<div class="form-group">
							<label for="tournZip">Tournament Location:</label>
							<select id="home" name="tournamentLocation" class="form-control">
								<option value="" disabled selected>Please select the hosting team</option>
								<?php foreach($schoolInfo as $school) { ?>
									<option value="<?=$school['schoolID']?>"><?=$school['schoolName'];?></option>
								<?php } ?>
							</select>
						</div>
						<!-- Change the Date -->
						<div class="form-group">
							<label for="tournDate">Tournament Date:</label>	
							<input type="text" class="form-control" id="datepicker" name="tournamentDate" placeholder="Click to choose a date"> 
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
						<button type="button" class="btn btn-danger" data-dismiss="modal">
							Quit Without Saving
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Add Game Info -->
<div id="addGame" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Add Game</h3>
			</div>

			<!-- Modal content-->
			<form method="post" action="<?=base_url();?>schedule/addGame" id="addGameForm">
				<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Time of the game -->
						<div class="form-group">
							<label for="time">Time:</label>
							<!--Time Picker-->
							<input type="text" class="form-control timepicker" id="timepicker" name="gameTime" placeholder="Click to choose a time">
						</div>
						<!-- Home team of the tournament game-->
						<div class="form-group">
							<label for="home">Home Team:</label>
							<select id="home" name="homeTeam" class="form-control">
								<option value="" disabled selected>Please select a team</option>
								<?php foreach($schoolInfo as $school) { ?>
									<option value="<?=$school['schoolID']?>"><?=$school['schoolName'];?></option>
								<?php } ?>
							</select>
						</div>
						<!-- Final score of the home team -->
						<div class="form-group">
							<label for="score">Home Team Score:</label>
							<input class="form-control" id="homescore" type="number" min="0" max="40" step="1" name="homeTeamScore" value="0"> 			
						</div>
						<!-- Away team of the tournament game -->
						<div class="form-group">
							<label for="away">Away Team:</label>
							<select id="away" name="awayTeam" class="form-control">
								<option value="" disabled selected>Please select a team</option>
								<?php foreach($schoolInfo as $school) { ?>
									<option value="<?=$school['schoolID']?>"><?=$school['schoolName'];?></option>
								<?php } ?>
							</select>
						</div>
						<!-- Final score of the away team -->
						<div class="form-group">
							<label for="score">Away Team Score: </label>
							<input class="form-control" id="awayscore" type="number" min="0" max="40" step="1" name="awayTeamScore" value="0"> 					
						</div>
					</div>
				</div>
			</div>
			<!-- Modal Footer-->
			<div class="modal-footer">
					<div class="form-group">
						<button type="submit" class="btn btn-success">
							Accept Changes
						</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">
							Quit without Saving
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Edit Season -->
<?php foreach($schedule as $season) { ?>
<div id="editSeason<?=$season['seasonID']?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<form method="post" action="<?=base_url();?>schedule/updateSeason/<?=$season['seasonID']?>" class="editSeason">
		<!-- Modal content-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Edit Game</h3>
			</div>

			<!-- Modal content-->
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">							
						<!-- Change the Season-->
						<div class="form-group">
							<!-- Season Year -->
						<div class="form-group">
							<label for="tournName">Season Year:</label>
								<?php
								$endingYear = date("Y");
								$startingYear = $endingYear-50;
								
								for($startingYear; $startingYear <= $endingYear; $startingYear++) {
    								$years[] = '<option value="'.$startingYear.'">'.$startingYear.'</option>';
								}
								rsort($years);
								?>
					
								<select class="form-control">
								    <?php echo implode("\n\r", $years);  ?>
								</select> 
						</div>
						
					</div>
				</div>
			</div>
			<!-- Modal Footer-->
			<div class="modal-footer">
				<div class="form-group">
					<button type="submit" class="btn btn-success">
						Accept Changes
					</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						Quit without Saving
					</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
<?php } // end foreach  ?>

<?php foreach($schedule as $season) { ?>
<!-- Edit Tournament Info -->
<div id="editTournament<?=$season['tournamentID']?>" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Edit Tournament</h3>
			</div>
		<form method="post" action="<?=base_url();?>schedule/updateTournament/<?=$season['tournamentID']?>" class="editTournament">
			<!-- Modal content-->
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Tournament Name -->
						<div class="form-group">
							<label for="tournName">Tournament Name:</label>
							<input type="text" class="form-control" id="tournName" value="<?=$season['tournamentTitle']?>" name="tournamentName">
						</div>
						<!-- Tournament Location -->
						<div class="form-group">
							<label for="tournLocation">Tournament Location:</label>
							<input type="text" class="form-control" id="tournLocation" value="<?=$season['tournamentLocation']?>" name="tournamentLocation">
						</div>
						<!-- Tournament City -->
						<div class="form-group">
							<label for="tournCity">Tournament City:</label>
							<input type="text" class="form-control" id="tournCity" value="<?=$season['tournamentCity']?>" name="tournamentCity">
						</div>
						<!-- Tournament State -->
						<div class="form-group">
							<label for="tournState">Tournament State:</label>
							<select class="form-control" name="tournamentState">       				         
					           <?php $states = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "DC", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY");
								
								foreach($states as $list){
									if($list==$season['tournamentState']){?>
							            <option value="<?=$season['tournamentState']?>" selected><?=$list?></option>
							  		<?php }
							  		else{ ?>
							  			<option><?=$list?></option>
							  		<?php }?>
								<?php } ?> 	 	
							</select>
						</div>
						<!-- Tournament Zip -->
						<div class="form-group">
							<label for="tournZip">Tournament Zip:</label>
							<input type="text" class="form-control" id="tournZip" maxlength="10" value="<?=$season['tournamentZip']?>" name="tournamentZip">
						</div>
						<!-- Change the Date FORMAT DATE-->
						<div class="form-group">
							<label for="tournDate">Tournament Date:</label>
							<?php $date = new DateTime($season['tournamentDate']);?>
							<input type="text" class="form-control" id="datepicker<?=$season['tournamentID']?>" name="tournamentDate" value="<?=$date->format('m/d/Y');?>">							
						</div>
					</div>
				</div>
			</div>
			<!-- Modal Footer-->
			<div class="modal-footer">
				<div class="form-group">
					<button type="submit" class="btn btn-success">
						Accept Changes
					</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						Quit without Saving
					</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div> 
<? } ?>

<!-- Edit Game Info -->
<?php foreach($schedule as $season) { ?>
<div id="editGame<?=$season['gameID']?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<form method="post" action="<?=base_url();?>schedule/updateGame/<?=$season['gameID']?>" class="editGame">
		<!--Also add gameID to form above-->
		
		<!-- Modal content-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Edit Game</h3>
			</div>

			<!-- Modal content-->
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Change the time of the tournament game -->
						<div class="form-group">
							<label for="time">Time:</label>
							<input type="text" class="form-control timepicker" id="timepicker" name="gameTime" placeholder="Click to choose a time" value="<?=$time = date("g:i A", strtotime($season['gameStartTime']))?>">
						</div>
						<!-- Change the Home team of the tournament game-->
						<div class="form-group">
							<label for="away">Home Team:</label>
							<select class="form-control" name="homeTeam"> 
								<?php foreach($schoolInfo as $school) { ?>
									<?php if($season['Home School']==$school['schoolName']){?>
										<option selected value="<?=$school['schoolID']?>"><?=$school['schoolName'];?></option>
									<?php } else{ ?>
										<option value="<?=$school['schoolID']?>"><?=$school['schoolName'];?></option>
									<?php }	?>
								<?php } ?>
							</select>
						</div>
						<!-- Change the final score of the home team -->
						<div class="form-group">
							<label for="score">Home Team Score:</label>
							<input class="form-control" id="homescore" type="number" min="0" max="40" step="1" value ="<?=$season['homeTeamScore']?>" name="homeTeamScore"> 			
						</div>
						<!-- Change the Away team of the tournament game -->
						<div class="form-group">
							<label for="away">Away Team:</label>
							<select class="form-control" name="awayTeam"> 
								<?php foreach($schoolInfo as $school) { 
									if($season['Away School']==$school['schoolName']){?>
										<option selected value="<?=$school['schoolID']?>"><?=$school['schoolName'];?></option>
									<?php } else{ ?>
										<option value="<?=$school['schoolID']?>"><?=$school['schoolName'];?></option>
									<?php }	?>
								<?php } ?>
							</select>
						</div>
						<!-- Change the final score of the away team -->
						<div class="form-group">
							<label for="score">Away Team Score: </label>
							<input class="form-control" id="awayscore" type="number" min="0" max="40" step="1" value ="<?=$season['awayTeamScore']?>" name="awayTeamScore"> 					
						</div>
					</div>
				</div>
			</div>
			<!-- Modal Footer-->
			<div class="modal-footer">
				<div class="form-group">
					<button type="submit" class="btn btn-success">
						Accept Changes
					</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						Quit without Saving
					</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
<?php } // end foreach  ?>

<!-- Delete Season -->
<?php foreach($schedule as $season) { ?>
<div id="deleteSeason<?=$season['seasonID']?>" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Delete Season</h3>
			</div>

			<!-- Modal content-->
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<h3 class="centervh">Are you sure you want to delete this season?</h3>
						<p class="centervh">Once it has been deleted, it cannot be recovered.</p>
					</div>
				</div>
			</div>
			<!-- Modal Footer-->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="submitDeleteSeason(<?=$season['seasonID']?>);">
					Delete Season
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Quit without Saving
				</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<!-- Delete Tournament -->
<?php foreach($schedule as $season) { ?>
<div id="deleteTournament<?=$season['tournamentID']?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Delete Tournament</h3>
			</div>

			<!-- Modal content-->
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<h3 class="centervh">Are you sure you want to delete this tournament?</h3>
						<p class="centervh">Once it has been deleted, it cannot be recovered.</p>
					</div>
				</div>
			</div>
			<!-- Modal Footer-->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="submitDeleteTournament(<?=$season['tournamentID']?>);">
					Delete Tournament
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Quit without Saving
				</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<!-- Delete Game Info -->
<?php foreach($schedule as $season) { ?>
<div id="deleteGame<?=$season['gameID']?>" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Delete Game</h3>
			</div>

			<!-- Modal content-->
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<h3 class="centervh">Are you sure you want to delete this game?</h3>
						<p class="centervh">Once it has been deleted, it cannot be recovered.</p>
					</div>
				</div>
			</div>
			<!-- Modal Footer-->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="submitDeleteGame(<?=$season['gameID']?>);">
					Delete Game
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Quit without Saving
				</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>