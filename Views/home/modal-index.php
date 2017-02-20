<?php
$typeUser = $this->session->userdata('TypeUser');
if ($typeUser == 'Admin') { ?>
<!-- Carousel Edit Content -->
<div id="editCarouselPhoto" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<!-- Modal Header-->
			<div class="modal-header modalHeading">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h3 class="modal-title">Edit Carousel Pictures</h3>
			</div>

			<!-- Modal content-->
			<form method="post" action="<?=base_url();?>home/updateCarousel" enctype="multipart/form-data" id="updateCarousel">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<?php for($i=0; $i<4; $i++) { ?>
							<div class="form-group">
								<label for="carouselPhoto<?=$i+1?>">Photo #<?=$i+1?>:</label><br/>
								<img id="carouselPhoto<?=$i+1?>" src="<?=isset($carouselPics[$i]['photoLink']) ? base_url().$carouselPics[$i]['photoLink'] : '';?>" class="img-thumbnail centervh" alt="Uploaded Carousel Photo" style="height: 100px; width: 335px;"/>
								<p class="centervh lightGray">Image should be 1138px by 350px for best results</p>
								<div class="input-group">
					                <span class="input-group-btn">
					                    <span class="btn btn-primary btn-file">
					                        Browse <input type="file" name="carouselPhoto<?=$i+1?>" accept="image/*" id="<?=$i?>" />
					                    </span>
					                </span>
					                <input class="form-control" readonly="" type="text" name="carouselFilename<?=$i+1?>" value="<?=isset($carouselPics[$i]['photoLink']) ? end((explode('/', $carouselPics[$i]['photoLink']))) : '';?>">
			            		</div>
							</div>		
							<div class="form-group">
			            		<input class="form-control" name="carouselDescription<?=$i+1?>" type="text" placeholder="Enter Description for Photo #<?=$i+1?>..." value="<?=isset($carouselPics[$i]['photoDescription']) ? $carouselPics[$i]['photoDescription'] : '';?>"/>
			            	</div>				
						<?php } ?>			
					</div>
				</div>
			</div>

			<!-- Modal Footer-->
			<div class="modal-footer">
					<div class="form-group">
						<button type="submit" class="btn btn-success">
							Accept Changes
						</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" onchange="window.location.reload();">
							Quit without Saving
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php foreach($articles as $story) { ?>
	<!-- Change the contents of a given article -->
	<div id="editArticle<?=$story['contentID'];?>" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<!-- Modal Header-->
				<div class="modal-header modalHeading">
					<button type="button" class="close" data-dismiss="modal">
						&times;
					</button>
					<h3 class="modal-title">Edit Article Content</h3>
				</div>

				<!-- Modal content-->
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">

							<!-- Change the title of the article -->
							<div class="form-group">
								<label for="title<?=$story['contentID']?>">Title of Content:</label>
								<input type="text" class="form-control" id="title<?=$story['contentID']?>" name="articleTitle" value="<?=$story['contentTitle']?>">
							</div>

							<!-- Change the content of the article -->
							<label for="title">Article Content:</label>
							<div id="summernoteArticle<?=$story['contentID'];?>"></div>
						</div>
					</div>
				</div>

				<!-- Modal Footer-->
				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-dismiss="modal" onclick="submitChanges(<?=$story['contentID']?>);">
						Accept Changes
					</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.reload();">
						Quit without Saving
					</button>
				</div>
			</div>
		</div>
	</div>
<?php } //end foreach 
} // end if user == admin?>