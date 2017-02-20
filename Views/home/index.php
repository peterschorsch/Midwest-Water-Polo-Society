<script src="<?=base_url();?>public/js/home/home.js" type="text/javascript"></script>

<!-- main content -->
<div class="container containerAlt">
	<table>
		<tr>
			<td>
				<a href="<?=base_url();?>home/index" class="h1Link"><h1>Midwest Water Polo Society (MWWPS)</h1></a><!--Header Link-->
			</td>
			<td class="carouselButton">
				<div class="editButton"><?php $data['id'] = "CarouselPhoto"; $data['buttonType'] = 'formEdit'; $this->load->view('layout/editbutton.php', $data); ?></div>
			</td>
		</tr>
	</table>
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Carousel Indictors -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
		</ol>
		
		<!-- Photo Slides -->
		<div class="carousel-inner" role="listbox">
			<?php for($i=0; $i<4; $i++) { ?>
				<div class="item <?=($i==0) ? 'active' : '';?>">
					<img class="img-responsive center-block carouselImage" src="<?=base_url().$carouselPics[$i]['photoLink']?>" alt=""> 
				</div>
			<?php }?> 	
		</div>
	</div>
	<!-- NAVIGATION ORIGINALLY WAS HERE -->
	<nav class="navbar navbar-inverse"><?php $this -> load -> view('layout/navigation'); ?></nav>
	<div class="row">
		<!-- Left Column -->
		<div class="col-md-7">
			<hr style="margin-bottom: 20px;"/>
			<?php $i=0;
			foreach($articles as $story) { ?>
				<div id="Article<?=$story['contentID']?>-Title">
					<div class="row">
						<div class="col-md-11">
							<h2 class="h2PageHeading"><?=$story['contentTitle']?></h2><h4><?=$time = date("l, F jS, Y", strtotime($story['timeCreated']));?></h4>
						</div>
						<div class="col-md-1">
							<?php echo '<div class="editButton">'; $data['id'] = "Article".$story['contentID']; $data['buttonType'] = 'edit'; $this->load->view('layout/editbutton.php', $data); echo '</div>'; ?>
						</div>
					</div>
				</div>
				<div id="Article<?=$story['contentID']?>-Text">
					<?=$story['contentText']?>
				</div>
				<hr style="margin-top: 30px; margin-bottom: 20px;">
				<?php $i++; 
					if($i==4){
						break;
					}//end of if
			} //end of foreach ?>
		</div>
	
		<!-- Right Column -->
		<div class="col-md-5">
			<!-- Recent Tournament Results -->
			<div class="row tournamentBackground">
				<div class="col-md-12">
					<h2 id="tournResultsHeader" class="centervh" style="color:white">Recent Tournament Results</h2>
				</div>
			</div>
			<div id="tournamentCarousel" class="carousel slide" data-ride="carousel" onchange="changeHeader();">
				<!-- Recent Results Slides -->
				<div class="carousel-inner" role="listbox">
					<?php for($i=0; $i<6; $i++) {?>
						<div class="item <?=($i==0) ? 'active' : '';?>">
							<div class="row">
								<div class="col-md-12">
									<h2 class="centervh headerMargin"><?=$sidebarInfo[$i]['tournamentTitle']?></h2>
									<h3 class="centervh headerMargin">@<?=$sidebarInfo[$i]['Home School']?></h3>
									<!--<h3 class="centervh headerMargin"><?=$sidebarInfo[$i]['schoolAddress']?>, <?=$sidebarInfo[$i]['schoolCity']?>, <?=$sidebarInfo[$i]['schoolState']?> <?=$sidebarInfo[$i]['schoolZip']?></h3>-->
								</div>
							</div>
							<hr/>
							<div class="row">
								<div class="col-md-12">
									<h3 class="centervh"><?=$time = date("l, F jS, Y", strtotime($sidebarInfo[$i]['gameDate']));?><br />
									@<?=$time = date("g:i a", strtotime($sidebarInfo[$i]['gameStartTime']));?></h3>															
								</div>
							</div>
							<br />							
							<div class="row" class="tournamentContent">
								<div class="col-md-5">
									<div class="tournamentDivImage">
										<img class="centervh tournamentImage" src="<?= base_url().$sidebarInfo[$i]['homePhoto'];?>" data-toggle="tooltip" title="<?=$sidebarInfo[$i]['Home School'] . " " . $sidebarInfo[$i]['Home Team']?>">
									</div>
									<?php if($sidebarInfo[$i]['homeTeamScore']>$sidebarInfo[$i]['awayTeamScore'] || $sidebarInfo[$i]['homeTeamScore']==$sidebarInfo[$i]['awayTeamScore']){ ?>
										<h2 class="centervh headerMargin" style="font-weight: 50px"><?=ltrim($sidebarInfo[$i]['homeTeamScore'], '0');?></h2>
									<?php } 
									else{ ?>
										<h2 class="centervh headerMargin"><?=ltrim($sidebarInfo[$i]['homeTeamScore'], '0');?></h2>
									<?php } ?>
								</div>
								<div class="col-md-2">
									<h2 class="centervh">vs.</h2>
								</div>
								<!-- Away Team -->
								<div class="col-md-5">
									<div class="tournamentDivImage">
										<img class="centervh tournamentImage" src="<?= base_url().$sidebarInfo[$i]['awayPhoto']; ?>" data-toggle="tooltip" title="<?=$sidebarInfo[$i]['Away School'] . " " . $sidebarInfo[$i]['Away Team']?>">
									</div>
									<?php if($sidebarInfo[$i]['homeTeamScore']<$sidebarInfo[$i]['awayTeamScore'] || $sidebarInfo[$i]['homeTeamScore']==$sidebarInfo[$i]['awayTeamScore']){ ?>
										<h2 class="centervh headerMargin" style="font-weight: 50px"><?=ltrim($sidebarInfo[$i]['awayTeamScore'], '0');?></h2>
									<?php } 
									else{ ?>
										<h2 class="centervh headerMargin"><?=ltrim($sidebarInfo[$i]['awayTeamScore'], '0');?></h2>
									<?php } ?>
								</div>						
							</div>		
						</div>					
				<?php } //end of for ?>	
				</div>
			</div>
			<!-- Social Media -->
			<div class="row socialHeader">
				<div class="col-md-12">
					<h2 class="centervh">Social Media</h2>
				</div>
			</div>
			<div class="row">
				<br />
				<!-- Facebook -->
				<div class="col-md-6">
					<a href="https://www.facebook.com/mwwwps" target="_blank" data-toggle="tooltip" title="Like us on Facebook! @mwwps"><img class="socialImage" src="<?= base_url(); ?>public/images/socialmedia/facebook.png"></a>
					<p class="centervh"><b>Facebook</b></p>
				</div>
				<!-- Twitter -->
				<div class="col-md-6">
					<a href="https://twitter.com/mwwps" target="_blank" data-toggle="tooltip" title="Follow us on Twitter! @mwwps"><img class="socialImage" src="<?=base_url(); ?>public/images/socialmedia/twitter.png"></a>
					<p class="centervh"><b>Twitter</b></p>
				</div>
				
			</div>
			<div class="row">
				<!-- Snapchat -->
				<div class="col-md-6">
					<a href="http://www.snapchat.com/add/mwwps" target="_blank" data-toggle="tooltip" title="Add us on Snapchat! @mwwps"><img class="socialImage" src="<?= base_url(); ?>public/images/socialmedia/snapchat.png"></a>
					<p class="centervh"><b><a href="http://www.snapchat.com/add/mwwps"></a><b>Snapchat</b></p>
				</div>
				<!-- Email -->
				<div class="col-md-6">
					<a href="mailto:officialmwwps@gmail.com" data-toggle="tooltip" title="Email us at officialmwwps@gmail.com!"><img class="socialImage" onclick="" src="<?= base_url(); ?>public/images/socialmedia/email.png"></a>
					<p class="centervh"><b><a href="mailto:officialmwwps@gmail.com"></a>Email</b></p>
				</div>
			</div>
			<br />
		</div>
	</div>
	<br />
</div>

<?php $this->load->view('home/modal-index'); // LOAD ALL MODALS IN THE FILE FOR THIS VIEW?>