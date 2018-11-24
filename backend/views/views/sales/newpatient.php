<?php

use backend\models\Productgrouping;
use backend\models\Product;
use backend\models\Composition;
use backend\models\Unit;
use backend\models\Stockmaster;

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php 
?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-border panel-custom">
			<div class="panel-heading"></div>
			<div class="panel-body">
				<table id="datatable-fixed-col" class="table table-striped table-bordered">
					<thead>
						<tr>
             				<th>S.No</th>
				             <th>Product</th>
				             
				             <th>Composition</th>
				             <th>Brandcode</th>
				              <th>Stockcode</th>
				             <th>Unit</th>
				             <th>Quantity</th>
				             <th>Price/Qty</th>
				             <th>Price</th>
				             
             				</tr>
					</thead>
					<tbody>

				<?php 
	$i = 1;
	foreach ($datatables as $key => $value) { 
		?>
	<!--<tr>
	<td><?php echo $i;?></td>
	<td><?php echo $value -> patienttype -> patient_typename;?></td>
	<td><?php echo $value -> patient_number;?></td>
	<td><?php echo $value -> firstname . $value -> lastname;?></td>
	<td><?php echo $value -> medicalrecord_number;?></td>
	<td><?php echo $value -> age;?></td>
	<td><?php echo $value -> physicianname;?></td>

	<td><button type='button' class='btn btn-default btn-custom waves-effect waves-light chooseaction' data-id='<?php echo $value -> patient_id;?>'>Choose</button></td>
	</tr>-->

<?php	$i++;
	}
?>
						

			</tbody>
					</table>
					</div>
					</div>
					</div>
					</div>';
						ActiveForm::end();?>
					<script type="text/javascript">
    $(document).ready(function () {
        
      
        var table = $('#datatable-fixed-col').DataTable({
            scrollY: "250px",
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
					
					