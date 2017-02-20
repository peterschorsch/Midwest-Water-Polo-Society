<div class="container-fluid">
	<ul class="nav navbar-nav">
	<?php foreach($this->navOptions as $item => $value) {?> 
		<li class="navbarCorners <?=(uri_string() == $value) ? 'active' : ''?>">
			<a href="<?php echo base_url().$value; ?>" data-toggle="tooltip" title="View the <?=$item?> page"><?php echo $item; ?></a>
		</li>
	<?php } ?>
	</ul>
</div>



