<table class="table table-striped table-bordered table-hover" id="datatable">
    <thead>
        <tr class="info">
            <th style="text-align: center;width: 40px;">No</th>
            <th>Kode Negara</th>
            <th>Negara</th>                                                                    
            <th>Aksi</th>                                                                        
        </tr>
    </thead>
</table>

<script type="text/javascript">
	$(document).ready( function () {
	    
		var dataTable = $('#datatable').DataTable( {
	        "processing" : true,
	        "serverSide" : true,
	        "order" : [],
	        "ajax": { 
	        	url : "<?php echo base_url('countries/fetch_data'); ?>",
	        	type : "POST"
	        },
	        "columnDefs" : [
	        	{
	        		"targets" : [0,3],
	        		"orderable" : false
	        	}
	        ]
	    } );

	} );

</script>
