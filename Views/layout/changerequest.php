<!-- Change Request Form -->
<?php
$typeUser = $this->session->userdata('TypeUser'); 
if ($typeUser != 'Guest' AND preg_match('/^(?!availability|user|profile|changerequest|resetpassword|login|standings)/',uri_string())) {
?>
<div id="FormSlide">
	<p>
		Change Request
	</p>
	<div id="FormBox">
		<div class="row formBoxHeader">
			<div class="col-md-12 centervh">
				<h2 class="formBoxHeading">Change Request Form</h2>
			</div>
		</div>
		<br />
		<script src="<?=base_url();?>public/js/changerequest.js"></script>
		<div id="requestForm">
			Use this form to explain the issue experienced on this page. Once submitted, administrators will review your request.
			<form method="post" action="<?=base_url();?>changerequest/submitrequest/<?=str_replace('/', '-', uri_string());?>" id="CRsubmit">
				<br />
				<div class="form-group">
					<label for="description">Page Affected:</label>
					<?php $page = str_replace('/index', '', uri_string());
						  $newPage = ucfirst($page);
						  if($newPage==""){
						  	$newPage = "Home";
						  }
						  ?>
					<input class="form-control" id="description" name="description" type="text" readonly="readonly" value="<?=$newPage?>"/>
				</div>
				<div class="form-group">
					<label for="comment">Detailed Explanation of Request:</label>
					<textarea class="form-control textareaSize" rows="5" id="comment" name="comment" placeholder="Describe the issue experienced here."></textarea>
				</div>
				<div class="centervh">
					<button type="submit" class="btn btn-success">
						Submit
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php }
?>