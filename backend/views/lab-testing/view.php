<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LabTesting */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Lab Testings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="lab-testing-view">

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'autoid',
            'test_name',
           // 'testgroupid',
           ['attribute' => 'category_name', 
            	'label' => 'Category',
             	
             	],
           
           //['attribute' => 'lab_subcategory','label' => 'Sub Category ',	],
             ['attribute' => 'unit_name', 
            	 'label' => 'Unit ',
             ],
            ['attribute' => 'price', 
            	'label' => 'Cost ',
             	
            ],
            ['attribute' => 'hsncode', 
            	'label' => 'HSN Code ',
             	
            ],
            ['attribute' => 'method', 
            	'label' => 'Method ',
             	
            ],
            ['attribute' => 'description', 
            	'label' => 'Description ',
             	
            ],
            ['attribute' => 'isactive', 
            	'label' => 'Active',
             	'value'=> function($model)
				{ 
					if($model->isactive=='1'){
						return "Active";
					}else{
						return "InActive";
					}
				}
             	],
            
           // 'referencevalue',
            //'isactive',
            // 'created_at',
            // 'created_date',
            // 'updated_date',
            // 'updated_at',
        ],
    ]) ?>
   
    <!-- ss code start-->
    <?php //echo"<pre>"; print_r($mulmodel); die; 
		if($model->result_type == "numeric"){
	 ?>
	  <h3>Result Type</h3>
    <table class="table table-striped table-bordered detail-view">
    	<thead>
    		<tr>
    					<td>Reference</td>
					  	<td>Gender</td>
					  	<td>Age Range </td>
					  	<td>Normal Range  </td>
			</tr>
    		</thead>
    		<tbody>
    <?php  
    if(!empty($refmodel)){ //echo "<pre>"; print_r($refmodel); die;
    	 foreach ($refmodel as $key => $value) {
	 		?>
	 		<tr>
	 			<td style="text-transform: capitalize"><?php echo $value ->reference_name ?>	</td>	
	 			<td style="text-transform: capitalize"><?php echo $value ->gender ?></td>
	 			<td><?php echo $value ->age ?><?php  echo $value ->agefrom_cal ?>- <?php echo $value ->range;?> <?php  echo $value ->ageto_cal ?></td>
	 			<td><?php echo $value ->ref_from ?>-<?php echo $value ->ref_to;  ?> </td>
	 			
	 		</tr>	 
		<?php }
    	}else{ ?>
    		<tr>
	 			<td> No Records	</td><td></td>	
	 		</tr>
     <?php	}     	?>
     </tbody>
</table>
 <?php } else if($model->result_type == "multichoice"){ ?>
 	 <h3>Result Type</h3>
 	  <table class="table table-striped table-bordered detail-view multichoice">
    	<thead>
    		<tr>
    			<td>S.No</td>
    			<td>Multichoice Name</td>
    			<td>Normal Value</td>
			</tr>
    		</thead>
    		<tbody>
    <?php  
    if(!empty($mulmodel)){  $i=1;
    	 foreach ($mulmodel as $key => $value) {
	 		?>
	 		<tr>
	 			<td style="text-transform: capitalize"><?php echo $i++; ?>	</td>
	 			<td style="text-transform: capitalize"><?php echo $value ->mulname ?>	</td>
	 			<?php if($value ->normal_value==1){?>
	 				<td style="text-transform: capitalize"> Yes </td>
	 			<?php } else{ ?>
	 				<td style="text-transform: capitalize"> - </td> 
	 		 	 <?php } ?>
	 				
	 		</tr>	 
		<?php }
    	}else{ ?>
    		<tr>
	 			<td> No Records	</td><td></td>	
	 		</tr>
     <?php	}     	?>
     </tbody>
</table>
 <?php } ?>
 </tbody>
	</table>
</div>
<style>
	table.table.table-striped.table-bordered.detail-view thead td {
	    /* background: #ff7272;*/
	    background: #4682b4;
 	   color: #fff;
	}
	.modal-dialog {
	    width: 900px !important;
   }
   table.multichoice {
    	width: 40%;    text-align: center;   
	}
</style>

<!-- ss code end -->
