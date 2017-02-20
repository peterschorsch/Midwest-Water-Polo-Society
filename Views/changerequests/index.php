<div class="container containerAlt">
	<a href="<?=base_url();?>home/index" class="h1Link"><h1>Midwest Water Polo Society (MWWPS)</h1></a><!--Header Link-->
	<nav class="navbar navbar-inverse"><?php $this->load->view('layout/navigation'); ?></nav>
	<h2 class="h2PageHeading">Change Requests</h2>
	<hr>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th class="linkHeaders"><a href="<?=base_url()?>changerequest/index/requestID" data-toggle="tooltip" title="Sort by ID#">Request ID#</a></th>
						<th class="linkHeaders" colspan="2" style="width: 110px;"><a href="<?=base_url()?>changerequest/index/name" data-toggle="tooltip" title="Sort by Submitter">Submitter</th>
						<th class="linkHeaders"><a href="<?=base_url()?>changerequest/index/page" data-toggle="tooltip" title="Sort by Page">Page</th>
						<th class="linkHeaders"><a href="<?=base_url()?>changerequest/index/date" data-toggle="tooltip" title="Sort by Date">Date</th>
						<th class="linkHeaders"><a href="<?=base_url()?>changerequest/index/status" data-toggle="tooltip" title="Sort by Status">Status</th>
						<th class="linkHeaders"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($CRs->result() as $item) { ?>
					<tr>
						<td class="tableInfo" style="vertical-align: middle"><?=$item->requestID?></td>
						<td class="tableInfo"><img class="changeRequestImage" src="<?=base_url() . $item->photoLink?>" style="width: 50px;"></td>
						<td class="tableInfo changeRequestSubmitter" style="width: 155px; vertical-align: middle"><?=$item->Submitter?></td>
						<td class="tableInfo" style="vertical-align: middle"><?=ucwords($item->affectedPage)?></td>
						<td class="tableInfo"><?=date("m/d/Y",strtotime($item->requestDateTime))?> <br /> <?=date("h:i:sA",strtotime($item->requestDateTime))?></td>
						<td class="tableInfo" style="vertical-align: middle"><?=$item->requestStatus?></td>
						<td>
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal<?=$item->requestID?>">
								View Request
							</button>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<script src="<?=base_url();?>public/js/changerequest-functions.js"></script>
			<?php foreach($CRs->result() as $item) { ?>
			<!-- Modal Change Request -->
			<div id="modal<?=$item->requestID?>" class="modal fade" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">

						<!-- Contains the change request header and request ID# -->
						<div class="modal-header modalHeading">
							<button type="button" class="close" data-dismiss="modal">
								&times;
							</button>
							<h3 class="modal-title">Change Request #<?=$item->requestID?></h3>
						</div>

						<!-- Body containing change request information -->
						<div id="modalbody" class="modal-body">
							<p>
								<div class="viewRequest">Submitted by:</div> <?=$item->Submitter?>
							</p>
							<p>
								<div class="viewRequest">Page:</div> <?=ucwords($item->affectedPage)?>
							</p>
							<p>
								<div class="viewRequest">Date:</div> 
								<?=date('l, F jS, Y', strtotime($item->requestDateTime))?><br />@<?=date('g:ia', strtotime($item->requestDateTime))?>
							</p>
							<p>
								<div class="viewRequest">Status:</div> <?=$item->requestStatus?>
							</p>
							<div class="form-group">
								<label for="comment">Request Text:</label>
								<textarea class="form-control" rows="5" id="comment" readonly><?=$item->requestContent?></textarea>
							</div>
						</div>

						<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
						<!-- Footer containing accept, back, and reject button -->
						<div id="modalfooter" class="modal-footer">
							<div class="row">
								<?php if ($item->requestStatus != 'Accepted') { ?>
								<div class="col-md-4 centervh">
									<button id="accept" type="button" class="btn btn-success" onclick="acceptRequest(<?=$item->requestID?>);">
										Approve Request
									</button>
								</div>
								<?php } else { echo '<div class="col-md-4"></div>'; }?>
								<div class="col-md-4 centervh">
									<button id="back" type="button" class="btn btn-default" onclick="resetRequest(<?=$item->requestID?>);" data-dismiss="modal" >
										Close
									</button>
								</div>
								<?php if ($item->requestStatus != 'Accepted') { ?>
								<div class="col-md-4 centervh">
									<button id="reject" type="button" class="btn btn-danger" onclick="rejectRequest(<?=$item->requestID?>);">
										Reject Request
									</button>
								</div>
								<?php } else { echo '<div class="col-md-4"></div>'; }?>
							</div>
						</div>
						<?php }
						else if ($TypeUser == 'Officer') { ?> 
						<div id="modalfooter" class="modal-footer">
							<div class="row">
								<div class="col-md-4 centervh">
								</div>
								<div class="col-md-4 centervh">
									<button id="back" type="button" class="btn btn-default" onclick="resetRequest(<?=$item->requestID?>);" data-dismiss="modal" >
										Close
									</button>
								</div>
								<?php if ($item->requestStatus != 'Accepted') { ?>
								<div class="col-md-4 centervh">
									<button id="delete" type="button" class="btn btn-danger" onclick="deleteRequest(<?=$item->requestID?>);">
										Delete Request
									</button>
								</div>
								<?php } else { echo '<div class="col-md-4"></div>'; }?>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>