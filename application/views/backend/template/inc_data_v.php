<?php

$this->load->view('backend/template/inc_alert');

?>
<div class="row">
	<div class="col-md-12">
		
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
			  	<ul class="list-inline text-center">
				    <li>
				    	<a class="btn btn-info" href="<?php echo base_url().$ctl; ?>"><i class="fa fa-list"></i> Kembali ke Daftar</a>
				    </li>
				</ul>
			</div>
			<!-- /.box-header -->
			<!-- form start -->
			<?php echo form_open_multipart($form_action, array('id' => 'form_data', 'class' => 'form-horizontal')); ?>
			<div class="box-body">
				<?php
					$this->load->view($form_data);
				?>
			</div>
			<div class="box-footer">
				<?php
				if($c_edit)
				{
				?>
				<button type="reset" class="btn btn-default">Reset</button>
				<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
				<?php
				}
				?>

			</div>
			<!-- /.box-footer -->

			  <!-- /.box-footer -->
			<?php echo form_close(); ?>
		</div>
		<!-- /.box -->
	</div>
<div class="row">
