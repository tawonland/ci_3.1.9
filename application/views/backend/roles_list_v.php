

<div class="row">
	<div class="col-md-12">
		
	</div>
</div>		
<div class="row">
	<div class="col-md-12">
		
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<ul class="list-inline ">
				<?php
					
				  ?>
				    <li>
				    	<a class="btn btn-success" href="<?php echo base_url().$ctl; ?>/add"><i class="fa fa-plus"></i> Tambah</a>
				    </li>
				  <?php
				
				?>
				</ul>

              <div class="box-tools">
              	<?php
              		echo form_open(base_url().$ctl.'/search', array('id' => 'form_search'));
                ?>

                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="table_search" class="form-control " placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" data-toggle="tooltip" title="Cari"><i class="fa fa-search"></i></button>
                    <a class="btn btn-success" href="<?php echo base_url().$ctl; ?>" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
                  </div>
                </div>

                <?php 
                echo form_close(); 
                // end form 
                ?>

              </div>             

			</div>
			<!-- /.box-header -->
			<!-- form start -->
			<?php 
				echo form_open('', array('id' => 'form_list')); 
				echo formx_hidden(['id' => 'key', 'name' => 'key']);

				$this->load->view('inc_alert');

				echo $table_generate;
			?>

			
			<!-- /.box-body -->
			<?php echo form_close(); ?>

			<div class="box-footer clearfix">
              	
				<div class="row">
					<div class="col-sm-5">
						<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
							Menampilkan <?=$showing?> dari <?=$showingof?> baris data
						</div>
					</div>
					<div class="col-sm-7">
						<?php
						// echo '<pre>';
						// print_r($pagination);
						// echo '</pre>';

						echo $pagination;
						?>
					</div>
				</div>
            </div>
			<!-- /.box-footer -->
		</div>
		<!-- /.box -->
	</div>
<div class="row">

<script type="text/javascript">

var formlist;
var base_url = '<?=base_url($ctl)?>';

$(document).ready(function () {
    formlist = $("#form_list");

});

$("[data-type='detail']").click(function () {
    if (typeof (list) != "undefined")
        sessionStorage.setItem(detpage + ".list", list);

    location.href = base_url + "/detail/" + $(this).attr("data-id");
});

$("[data-type='edit']").click(function () {
    if (typeof (list) != "undefined")
        sessionStorage.setItem(detpage + ".list", list);

    location.href = base_url + "/edit/" + $(this).attr("data-id");
});

$("[data-type='delete']").click(function () {
    id = $(this).attr("data-id");
    thisdata = this;
    bootbox.confirm("Apakah anda yakin akan menghapus data ini?", function (result) {
        if (result) {
            formlist.find("#key").val(id);
            formlist.attr("action", base_url + "/delete");
	        goSubmit(thisdata, "delete");
        }
    });
});

</script>