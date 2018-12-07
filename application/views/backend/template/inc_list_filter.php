<?php
echo form_open(base_url().$ctl.'/search', array('id' => 'form_search'));
?>

	<div class="input-group input-group-sm" style="width: 250px;">
	<input type="text" name="table_search" class="form-control " placeholder="Search">

	<div class="input-group-btn input-group-sm">
	<button type="submit" class="btn btn-default" data-toggle="tooltip" title="Cari"><i class="fa fa-search"></i></button>
	<a class="btn btn-success" href="<?php echo base_url().$ctl; ?>" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
	</div>
	</div>
<?php 
echo form_close(); 
// end form 
?>