<div class="container containerAlt">
	<a href="<?=base_url();?>home/index" class="h1Link"><h1>Midwest Water Polo Society (MWWPS)</h1></a><!--Header Link-->
	<nav class="navbar navbar-inverse"><?php $this->load->view('layout/navigation'); ?></nav>
	<div class="row">
		<div class="col-md-3 leftcol">
			<ul class="nav nav-tabs nav-stacked liStyle" data-spy="affix" data-offset-top="180" data-offset-bottom="300">
				<?php foreach($years as $year){?>
					<li><a href="#<?=$year['seasonYear']?>"><?=$year['seasonYear']?></a></li>
				<?php } ?>
				<!--<?php if($this->session->userdata('TypeUser') == 'Admin' || $this->session->userdata('TypeUser') == 'Officer') { ?>
					<li><button class="btn btn-primary" href="#calendar" onclick="location.href='/availability/index'">Choose Availability</button></li>
				<?php } ?>-->
			</ul>			
		</div>
		
		<!-- Tournament Schedule Information -->
		<div class="col-md-10">
			
			<!-- Page Header -->
			<div class="row">
				<div class="col-md-12">
					<h2 class="h2PageHeading">Tournament Schedules</h2>
						<div class="editButton pull-right">
							<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSeasonForm" data-toggle="tooltip" title="Add season">
								<span class="glyphicon glyphicon-plus"></span> Add Season
							</button>
							<?php } ?>
						</div>
					<hr class="hrListMargin">
				</div>
			</div>
			
			<?php $tDate = new DateTime();
			
			foreach($schedule as $season){  // Andrey is testing ?>
				<?php if($tDate != new DateTime() && $tDate != new DateTime($season['tournamentDate'])) { 
					//IF tDate IS NOT THE SAME?> 		
					</table>
					</div>
					
					<div class="editButton pull-left">
						<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addGameForm" data-toggle="tooltip" title="Add game">
								<span class="glyphicon glyphicon-plus"></span> Add Game
							</button>
						<?php } ?>
					</div>
					<br />
					<div class="linkBackToTop">
						<a href="#" class="linkBackToTop">Back to Top</a>
					</div>
					
					</section>
				<?php } ?>
			
				<section id="<?=$season['seasonYear']; ?>">
					<div class="row">
						<!-- Shows the year schedule header -->
						<div class="col-md-10">
								<?php if($year == $season['seasonYear']){?>
										<?php $year = $season['seasonYear'];
										
									}//end of if 
									else{ ?>
										<h2 class="h3SubHeading"><?=$season['seasonYear'] . " Season";?></h2>
										<?php $year = $season['seasonYear']; ?>
									<?php }//end of else ?>
						</div>
					</div>
				<?php if($year == $season['seasonYear']){ //IF YEAR IS THE SAME  ?>
					<div class="row">
						<?php if($tDate != new DateTime($season['tournamentDate'])){?>
						<!-- Shows Tournament Location and Date -->
						<div class="col-md-10">
							<h2 class="headerMargin"><?=$season['tournamentTitle']?></h2>
							<h3 class="headerMargin">@<?=$season['Home School']?></h3>
							<h4 class="headerMargin"><?=$season['schoolAddress']?>, <?=$season['schoolCity']?>, <?=$season['schoolState']?> <?=$season['schoolZip']?></h4> <br />
							<h3><?=date('l, F jS, Y', strtotime($season['tournamentDate']))?></h3>
						</div>
						
						<!-- If logged in as Admin, show manage content controls -->
						<div class="col-md-2">
							<?php $typeUser = $this->session->userdata('TypeUser'); 
								if($typeUser == 'Admin') {?>
									<div class="editButton pull-right">
										<button type="button" data-toggle="tooltip" title="Edit Tournament" class="btn btn-info" data-toggle="modal" data-target="#editTournament">
											<span class="glyphicon glyphicon-cog"></span>
										</button>
										<button type="button" data-toggle="tooltip" title="Delete Tournament" class="btn btn-danger" data-toggle="modal" data-target="#deleteTournament">
											<span class="glyphicon glyphicon-trash"></span>
										</button>
									</div>
								<?php }?>
						</div>
					</div>	
				
				<!-- Game Table -->
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Time</th>
								<th>Home Team</th>
								<th>vs.</th>
								<th>Away Team</th>
								<th>Final Score</th>
								<!-- If user == admin -->
								<?php $typeUser = $this->session->userdata('TypeUser'); 
									if($typeUser == 'Admin') {?>
										<th>Actions</th>						
								<?php } ?>
							</tr>
						</thead>
				
						<!-- Game Information -->
						<tr>
							<!-- Game Starting Time -->
							<td><?php $time = date("g:i a", strtotime($season['gameStartTime']));?> <?=$time?></td>
							
							<!-- Home Team Name -->
							<?php if($season['homeTeamScore']>$season['awayTeamScore']){ ?>
									<!-- Home Team Name -->
									<th><?=$season['Home School']?></th>
									
									<td>vs.</td>
									
									<!-- Away Team Name -->
									<td><?=$season['Away School']?></td>
									<td>
										<!-- Home Team Score -->
										<strong><?=$season['homeTeamScore']?> </strong>
										- 
										<!-- Away Team Score -->
										<?=$season['awayTeamScore']?>
									</td>
								<?php } else if ($season['homeTeamScore']<$season['awayTeamScore']){ ?>
									<!-- Home Team Name -->
									<td><?=$season['Home School']?></td>
									
									<td>vs.</td>
									
									<!-- Away Team Name -->
									<th><?=$season['Away School']?></th>
									<td>
										<!-- Home Team Score -->
										<?=$season['homeTeamScore']?> 
										- 
										<!-- Away Team Score -->
										<strong><?=$season['awayTeamScore']?></strong>
									</td>	
								<?php } else { ?>
									<!-- Home Team Name -->
									<th><?=$season['Home School']?></th>
									
									<td>vs.</td>
									
									<!-- Away Team Name -->
									<th><?=$season['Away School']?></th>
									<td>
										<!-- Home Team Score -->
										<strong><?=$season['homeTeamScore']?></strong>
										- 
										<!-- Away Team Score -->
										<strong><?=$season['awayTeamScore']?></strong>
									</td>		
								<?php }?>
														
							<!-- If user == admin -->
							<?php $typeUser = $this->session->userdata('TypeUser'); 
								if($typeUser == 'Admin') {?>
									<td>
										<!--<a type="button" data-toggle="tooltip" title="View Stats" class="btn btn-warning" onclick="location.href='/availability/index'"><span class="glyphicon glyphicon-list-alt"></span></a>-->
										<a type="button" data-toggle="tooltip" title="Edit Game" class="btn btn-info" data-toggle="modal" data-target="#editGame" >
											<span class="glyphicon glyphicon-cog"></span>
										</a>
										<a type="button" data-toggle="tooltip" title="Delete Game" class="btn btn-danger" data-toggle="modal" data-target="#deleteGame">
											<span class="glyphicon glyphicon-trash"></span>
										</a>
									</td>
							<?php }?>
						</tr>
	
					<?php $tDate = new DateTime($season['tournamentDate']); 
					} // end of tournament check if
					else { ?>
							<!-- Tournament Information -->
							<tr>
								<!-- Game Starting Time -->
								<td><?php $time = date("g:i a", strtotime($season['gameStartTime']));?> <?=$time?></td>
								
								<!-- Home Team Name -->
								<?php if($season['homeTeamScore']>$season['awayTeamScore']){ ?>
									<!-- Home Team Name -->
									<th><?=$season['Home School']?></th>
									
									<td>vs.</td>
									
									<!-- Away Team Name -->
									<td><?=$season['Away School']?></td>
									<td>
										<!-- Home Team Score -->
										<strong><?=$season['homeTeamScore']?> </strong>
										- 
										<!-- Away Team Score -->
										<?=$season['awayTeamScore']?>
									</td>
								<?php } else if ($season['homeTeamScore']<$season['awayTeamScore']){ ?>
									<!-- Home Team Name -->
									<td><?=$season['Home School']?></td>
									
									<td>vs.</td>
									
									<!-- Away Team Name -->
									<th><?=$season['Away School']?></th>
									<td>
										<!-- Home Team Score -->
										<?=$season['homeTeamScore']?> 
										- 
										<!-- Away Team Score -->
										<strong><?=$season['awayTeamScore']?></strong>
									</td>	
								<?php } else { ?>
									<!-- Home Team Name -->
									<th><?=$season['Home School']?></th>
									
									<td>vs.</td>
									
									<!-- Away Team Name -->
									<th><?=$season['Away School']?></th>
									<td>
										<!-- Home Team Score -->
										<strong><?=$season['homeTeamScore']?></strong>
										- 
										<!-- Away Team Score -->
										<strong><?=$season['awayTeamScore']?></strong>
									</td>		
								<?php }?>
															
								<!-- If user == admin -->
								<?php $typeUser = $this->session->userdata('TypeUser'); 
									if($typeUser == 'Admin') {?>
										<td>
											<!--<a type="button" data-toggle="tooltip" title="View Stats" class="btn btn-warning" onclick="location.href='/availability/index'"><span class="glyphicon glyphicon-list-alt"></span></a>-->
											<a type="button" data-toggle="tooltip" title="Edit Game" class="btn btn-info" data-toggle="modal" data-target="#editGame">
												<span class="glyphicon glyphicon-cog"></span>
											</a>
											<a type="button" data-toggle="tooltip" title="Delete Game" class="btn btn-danger" data-toggle="modal" data-target="#deleteGame">
												<span class="glyphicon glyphicon-trash"></span>
											</a>
										</td>
								<?php }?>
							</tr>
							<?php $tDate = new DateTime($season['tournamentDate']);?>
					<?php }//end of else 
				
				} //end of if 
		
			 }//end of foreach ?>
			 </table>
			
		</div>
		
		<div class="editButton pull-left">
			<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addGameForm" data-toggle="tooltip" title="Add game">
					<span class="glyphicon glyphicon-plus"></span> Add Game
				</button>
			<?php } ?>
		</div>
		<br>		
		<div class="linkBackToTop">
			<a href="#" class="linkBackToTop">Back to Top</a>
		</div>
	</div>
</div>

<?php $this->load->view('schedule/modal-index'); // LOAD ALL MODALS IN THE FILE FOR THIS VIEW ?>
