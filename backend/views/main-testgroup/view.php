<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MainTestgroup */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Main Testgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-testgroup-view">

       <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'autoid',
           
           ['attribute' => 'testgroupname', 
            	'label' => 'Master Group Name ',
             	],
             	
           ['attribute' => 'price', 
            	'label' => 'Price',
             	],
             ['attribute' => 'hsncode', 
            	'label' => 'HSN Code',
             	],
            ['attribute' => 'isactive', 
            	'label' => 'Active ',
             	'value'=> function($model)
				{
						if($model->isactive=="1"){
							return "Active";	
						}else{
							return "InActive";
						}
					
				}
             	]
           // 'testnameid',
            
            // 'isactive',
            // 'created_at',
            // 'created_date',
            // 'updated_at',
            // 'updated_date',
        ],
    ]) ?>
    
    
   
     <table class="table table-striped table-bordered detail-view">
    	<thead>
    		<tr>
    			<td>S.No</td>
    			<td>Group List</td>
    		</tr>
    		</thead>
    		<tbody>
    <?php  $i=1; 
    if(!empty($testname_det_index)){
    	 foreach ($testname_det_index as $key => $value) {
	 		?>
	 		<tr>
	 			<td><?php echo $i++ ?>	</td>	
	 			<td><?php echo $value->testgroupname  ?>	</td>
	 		</tr>	 
		<?php }
    	}else{ ?>
    		<tr>
	 			<td> No Records	</td><td></td>	
	 		</tr>
     <?PHP	}
    	?>
     </tbody>
</table>
</div>
<style>
table.table.table-striped.table-bordered.detail-view thead td {
   /* background: #ff7272; */
    background: #4682b4;
    color: #fff;
}
</style>

</div>
