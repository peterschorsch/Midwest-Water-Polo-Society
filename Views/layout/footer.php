<div class="row footerContainer">
	<div class="col-md-6">
		<?php foreach($this->footer as $item){ ?>
			<h3>Contact MWWPS</h3>
			Midwest Water Polo Society<br />
			<?=$item['schoolAddress'];?><br />
			<?=$item['schoolCity'];?>,
			<?=$item['schoolState'];?> 		
			<?=$item['schoolZip'];?> 		
			<br />Phone: <?="(".substr($item['schoolFacilityPhone'], 0, 3).") ".substr($item['schoolFacilityPhone'], 3, 3)."-".substr($item['schoolFacilityPhone'],6)?> </br>
			Email: officialmwwps@gmail.com<br /><br />
			Webmaster: Peter Schorsch<br />
			Email: peteschorsch@gmail.com
		<?php } ?>
	</div>
	<div class="col-md-6 footerAlign">
		<div class="row">
			<div class="col-md-12">
				<h3 class="shareUs">Follow Us!</h3>
			</div>
		</div>
		<div class="row">
			<!-- Facebook and Twitter-->
			<div class="col-md-12">
				<a href="https://www.facebook.com/mwwwps" target="_blank" data-toggle="tooltip" title="Like us on Facebook! @mwwps"><img class="footerSocial" src="<?= base_url(); ?>public/images/socialmedia/facebook.png"></a>
				<a href="https://twitter.com/mwwps" target="_blank" data-toggle="tooltip" title="Follow us on Twitter! @mwwps"><img class="footerSocial" src="<?=base_url(); ?>public/images/socialmedia/twitter.png"></a>
			</div>
		</div>
		<br />
		<div class="row">
			<!-- Snapchat and Email -->
			<div class="col-md-12">
				<a href="http://www.snapchat.com/add/mwwps" target="_blank" data-toggle="tooltip" title="Add us on Snapchat! @mwwps"><img class="footerSocial" src="<?= base_url(); ?>public/images/socialmedia/snapchatGhost.png"></a>
				<a href="mailto:officialmwwps@gmail.com" data-toggle="tooltip" title="Email us at officialmwwps@gmail.com"><img class="footerSocial" src="<?= base_url(); ?>public/images/socialmedia/email.png"></a>
			</div>
		</div>
	</div>
</div>
