<script src="<?=base_url();?>public/js/aboutus/aboutus-functions.js"></script>
<div class="container containerAlt">
	<!-- About Us -->
	<a href="<?=base_url();?>home/index" class="h1Link"><h1>Midwest Water Polo Society (MWWPS)</h1></a><!--Header Link-->
		
	<nav class="navbar navbar-inverse"><?php $this -> load -> view('layout/navigation'); ?></nav>
	<img src="<?=base_url(); ?>public/images/mwwpslogo.jpg" class="aboutImage img-responsive"> 
		
	<!-- About Us Content -->
	<?php foreach ($conferenceInfo as $section) { ?>
		<div class="row">
			<div class="col-md-10" id="<?=$section['contentID']?>-Title">
				<h2 class="aboutArticleHeading"><?=$section['contentTitle']?></h2>
			</div>
			<div class="col-md-2 pull-right">
				<div class="editButton pull-right"><?php $data['id'] = $section['contentID']; $data['buttonType'] = 'edit'; $this->load->view('layout/editbutton.php', $data); ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 aboutArticleContent" id="<?=$section['contentID']?>-Text">
				<?=$section['contentText']?>
			</div>
		</div>
		<br />
	<?php } ?>
	<br />

	<?php foreach ($conferenceInfo as $section) { ?>
		<!-- Modals for managing content -->
		<div id="edit<?=$section['contentID']?>" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<!-- Modal Header-->
					<div class="modal-header modalHeading">
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
						<h3 class="modal-title">Edit Content</h3>
					</div>
					<!-- Modal content-->
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
		
								<!-- Change the title of the article -->
								<div class="form-group">
									<label for="title">Title of Content:</label>
									<input type="text" class="form-control" id="title<?=$section['contentID'];?>" value='<?=$section['contentTitle'];?>'>
								</div>
		
								<!-- Change the content of the article -->
								<label for="title">Article Content:</label>
								<div id="summernote<?=$section['contentID']?>"></div>
								<script></script>
							</div>
						</div>
					</div>
					<!-- Modal Footer-->
					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-dismiss="modal" onclick="submitChanges(<?=$section['contentID']?>);">
							Accept Changes
						</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.reload();">
							Quit without Saving
						</button>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>