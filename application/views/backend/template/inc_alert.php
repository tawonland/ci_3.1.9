<?php

$msg = $this->session->flashdata('success');

if(isset($msg)){
	echo '<div class="row">';
		echo '<div class="col-md-12">';
	    	echo '<div class="alert alert-success">'.$msg.'</div>';
	    echo '</div>';
    echo '</div>';
}

$err = $this->session->flashdata('danger');

if(isset($err)){
	echo '<div class="row">';
		echo '<div class="col-md-12">';
	    	echo '<div class="alert alert-danger">'.$err.'</div>';
	    echo '</div>';
    echo '</div>';
}
?>