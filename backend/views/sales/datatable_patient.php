<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-border panel-inverse ">
			<div class="panel-heading"></div>
			<div class="panel-body">
				<table id="datatable-fixed-col1" class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							 No Records Found.
						</tr>
					</thead>
					<tbody class="nicescroll">
				<?php 
	$i = 1;
	foreach ($datatables as $key => $value)
	 { ?>
	<tr>
	<td><?php echo $value -> firstname . $value -> lastname;?></td>
	<td><?php echo $value -> medicalrecord_number;?></td>
	<td><?php echo $value -> patient_mobilenumber;?></td>
	<td>
	<button type="button" class="btn btn-default waves-effect waves-light w-sm chooseaction" data-id='<?php echo $value -> patient_id;?>'>Choose
                                                   <span class="btn-label btn-label-right"><i class="fa fa-arrow-right"></i>
                                                   </span>
                                                </button>
	</td>
	</tr>

<?php	$i++;
	}
						?>
			</tbody>
					</table>
					</div>
					</div>
					</div>
					</div>
					
					
					
					<script type="text/javascript">
    $(document).ready(function ()
     {
        var table = $('#datatable-fixed-col1').DataTable({
            scrollY: "120px",
            scrollX: false,
            scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1
            }
        });
    });
    TableManageButtons.init();
</script>
					