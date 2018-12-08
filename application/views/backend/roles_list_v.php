<table class="table table-striped table-bordered table-hover" id="mytable">
    <thead>
        <tr class="info">
            <th style="text-align: center;width: 40px;">No</th>
            <th>Nama Role</th>
            <th>Aktif</th>                                                                    
            <th>Aksi</th>                                                                        
        </tr>
    </thead>
</table>

<script type="text/javascript">
	$(document).ready( function () {
	    
		$('#mytable').DataTable( {
	        "processing": true,
	        "serverSide": true,
	        "order" : [],
	        "ajax": { 
	        	url : "<?php echo base_url('roles/data'); ?>",
	        	type : "POST"
	        }
	    } );

	} );
</script>
