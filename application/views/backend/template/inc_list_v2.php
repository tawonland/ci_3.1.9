<!-- Default box -->
<div class="box">

	<div class="box-header with-border">
		<h3 class="box-title"><?php echo isset($title) ? $title : '' ; ?></h3>

		<div class="box-tools pull-right">			
			<ul class="list-inline ">
				<?php
					
				  ?>
				    <li>
				    	<a class="btn btn-success" href="<?php echo base_url().$ctl; ?>/add"><i class="fa fa-plus"></i> Tambah</a>
				    </li>				    
				  <?php				
				?>
			</ul>
		</div>
	</div>

	<div class="box-body">
		<?php
		$this->load->view('backend/template/inc_alert');
		$this->load->view('backend/'.$list_view);
		?>		
	</div>
	<!-- /.box-body -->
	<div class="box-footer">
	<?php echo isset($footer) ? $footer : '' ; ?>
	</div>
	<!-- /.box-footer-->
</div>
<!-- /.box -->

<script type="text/javascript">
	var url = '<?php echo base_url($ctl); ?>';

	$('#datatable').on('click', '[data-type="detail"]', function(){
		var id = $(this).attr("data-id");

		location.href = url + "/detail/" + id;

	});

	$('#datatable').on('click', '[data-type="edit"]', function(){
		var id = $(this).attr("data-id");

		location.href = url + "/edit/" + id;

	});

</script>