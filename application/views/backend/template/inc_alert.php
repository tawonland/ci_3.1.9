<?php

$danger = $this->session->flashdata('danger');

if(isset($danger)){
?>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
                <?php echo $danger; ?>
             </div>	    
	    </div>
   	</div>
<?php
}

$info = $this->session->flashdata('info');

if(isset($info)){
?>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> Info!</h4>
                <?php echo $info; ?>
             </div>	    
	    </div>
   	</div>
<?php
}

$warning = $this->session->flashdata('warning');

if(isset($warning)){
?>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
                <?php echo $warning; ?>
             </div>	    
	    </div>
   	</div>
<?php
}

$success = $this->session->flashdata('success');

if(isset($success)){
?>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                <?php echo $success; ?>
             </div>	    
	    </div>
   	</div>
<?php
}

?>