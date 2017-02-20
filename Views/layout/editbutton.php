<?php if($this->session->userdata('TypeUser') == 'Admin') { ?>
			<?php if($buttonType == 'edit') { ?>
				<button type="button" class="btn btn-info" onclick="createSummernoteInstance('<?=$id?>');" data-toggle="modal" data-target="#edit<?=$id?>" data-toggle="tooltip" title="Edit">
					<span class="glyphicon glyphicon-cog"></span>
				</button>
			<?php } // end buttonType == edit
			if($buttonType == 'formEdit') { ?>
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit<?=$id?>" data-toggle="tooltip" title="Edit">
					<span class="glyphicon glyphicon-cog"></span>
				</button>
			<?php } // end buttonType == formEdit
			if($buttonType == 'delete') { ?>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$id?>" data-toggle="tooltip" title="Delete">
					<span class="glyphicon glyphicon-trash"></span>
				</button>
			<?php } //end buttonType == delete?>
<?php } //end typeUser == admin ?>