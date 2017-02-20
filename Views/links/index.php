<div class="container containerAlt">
	<a href="<?=base_url();?>home/index" class="h1Link"><h1>Midwest Water Polo Society (MWWPS)</h1></a><!--Header Link-->
	<nav class="navbar navbar-inverse"><?php $this->load->view('layout/navigation'); ?></nav>
	<div class="row">
		<div class="col-md-10">
			<h2 class="h2PageHeading">Useful Links</h2>
		</div>
		<div class="col-md-2 pull-right">
			<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addLink" id="addLinkButton" data-toggle="tooltip" title="Add Link">
					<span class="glyphicon glyphicon-plus"></span> 
				</button>				
			<?php }?>
		</div>		
	</div>	
	<div class="col-md-12">
		<p>Here are some helpful links:</p>
		<table class="table table-striped table-hover" id="userTable">
			<tbody>
				<?php foreach($links as $info){ ?>
					<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
					<tr>
						<th class="col-md-2 tableInfo links" style="vertical-align: middle;"><a href="<?=$info['linkURL']?>" target="_blank" data-toggle="tooltip" title="<?=$info['linkURL']?>"><?=$info['linkName']?></a></th>
						<td class="col-md-3 linkHeaders" style="vertical-align: middle;">
							<?php if($info['linkDescription']==NULL){
								echo "-";
							} else{
								echo $info['linkDescription'];
							} ?> 
						</td>
						<th class="col-md-1 tableInfo"  style="vertical-align: middle;">Posted by:</th>
						<td class="col-md-1 linkHeaders" style="vertical-align: middle;"><?=$info['userFirstName']?><br /> <?=$info['userLastName']?></td>
						<td class="col-md-2 linkHeaders" style="vertical-align: middle;"><?=$info['schoolName']?></td>
						<td class="col-md-1 linkHeaders" style="vertical-align: middle;"><?=date("m/d/Y",strtotime($info['linkDateTime']))?> <?=date("h:i:sA",strtotime($info['linkDateTime']))?></td>
						<td class="col-md-2 linkButtons">
							<div class="editButton pull-right" style="margin-top: 10px">
								<?php $data['id'] = "Link".$info['linkID']; $data['buttonType'] = 'formEdit'; $this->load->view('layout/editbutton.php', $data); ?>
								<?php $data['id'] = "Link".$info['linkID']; $data['buttonType'] = 'delete'; $this->load->view('layout/editbutton.php', $data); ?>
							</div>
						</td>
						<?php } else{ ?>
							<th class="tableInfo links" style="vertical-align: middle;"><a href="<?=$info['linkURL']?>" target="_blank" target="_blank" data-toggle="tooltip" title="<?=$info['linkURL']?>"><?=$info['linkName']?></a></th>
							<td class="linkHeaders" style="vertical-align: middle;">
								<?php if($info['linkDescription']==NULL){
									echo "-";
								} else{
									echo $info['linkDescription'];
								} ?> 
							</td>
						<?php } ?>
					</tr>
				<?php } ?>						
			</tbody>
		</table>
		<?php if($this->session->userdata('TypeUser') == 'Guest') { ?>
			<p>If you'd like to add links, email: </p>
			<p>&nbsp&nbsp&nbspPeter Schorsch <br />&nbsp&nbsp&nbsppeteschorsch@gmail.com</p>		
		<?php } //end of if ?>			
	</div>	
</div>

<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
<!-- Link Add Content -->
<div id="addLink" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal Header-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Add a Link</h3>
			</div>

			<!-- Modal content-->
			<form method="post" action="<?=base_url();?>links/addLink" id="addLinkForm">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Link Name -->
						<div class="form-group">
							<label for="addLinkName">Link Name:</label>
							<input type="text" class="form-control" name="linkName" id="linkName" placeholder="Water Polo continues to grow in the midwest"/>
						</div>
						
						<!-- Link Description -->
						<div class="form-group">
							<label for="addLinkDescription">Link Description:</label>
							<textarea class="form-control" placeholder="This article describes how water polo is growing in the midwest"></textarea>
						</div>
						<!-- Link URL -->
						<div class="form-group">
							<label for="addLinkURL">Link URL:</label>
							<input type="text" class="form-control" name="linkURL" placeholder="www.huffingtonpost.com/fr5t758y3">
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

<?php foreach($links as $info) {?>
<!-- Link Edit Content -->
<div id="editLink<?=$info['linkID']?>" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal Header-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Edit Link Content</h3>
			</div>

			<!-- Modal content-->
			<form class="updateLink" method="post" action="<?=base_url();?>links/updateLink/<?=$info['linkID']?>">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<!-- Link Name -->
						<div class="form-group">
							<label for="addLinkName">Link Name:</label>
							<input type="text" class="form-control" name="linkName" id="linkName" value="<?=$info['linkName']?>">
						</div>
						
						<!-- Link Description -->
						<div class="form-group">
							<label for="addLinkDescription">Link Description:</label>
							<textarea class="form-control" name="linkDescription"><?=$info['linkDescription']?></textarea>
						</div>
						<!-- Link URL -->
						<div class="form-group">
							<label for="addLinkURL">Link URL:</label>
							<input type="text" class="form-control" name="linkURL" value="<?=$info['linkURL']?>">
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

<?php foreach($links as $info) { ?>
<!-- Delete link -->
<div id="deleteLink<?=$info['linkID']?>" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<!-- Header -->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Delete Link</h3>
			</div>
			<!-- Body -->
			<div class="modal-body">
				<p>Please confirm that you want to delete the link, <b><?=$info['linkName']?></b>. Note that this cannot be undone!</p>
			</div>

			<!-- Footer -->
			<div class="modal-footer">
				<!-- Accept Changes -->
				<button type="button" class="btn btn-success" data-dismiss="modal" onclick="submitDelete(<?=$info['linkID']?>);">
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
<?php } // end foreach 
} //end  ?>