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

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <!-- <p>
        <?= Html::a('Update', ['update', 'id' => $model->autoid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->autoid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'autoid',
            'test_name',
           // 'testgroupid',
           ['attribute' => 'category_name', 
            	'label' => 'Category',
             	
             	],
           
           ['attribute' => 'lab_subcategory', 
            	'label' => 'Sub Category ',
             	],
            ['attribute' => 'unit_name', 
            	'label' => 'Unit ',
             	
            ],
            ['attribute' => 'price', 
            	'label' => 'Cost ',
             	
            ],
            ['attribute' => 'hsncode', 
            	'label' => 'HSN Code ',
             	
            ],
            ['attribute' => 'isactive', 
            	'label' => 'Active',
             	'value'=> function($model)
				{ 
					if($model->isactive=='1'){
						return Active;
					}else{
						return InActive;
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
    
    
    <table class="table table-striped table-bordered detail-view">
    	<thead>
    		<tr>
    					<td>Reference Name</td>
					  	<td>Gender</td>
					  	 	<td>Age To</td>
					  	<td>Range from </td>
					  	<td>Range from </td>
					  	<td>Range To </td>
				
    		</tr>
    		</thead>
    		<tbody>
    <?php  
    if(!empty($refmodel)){ //echo "<pre>"; print_r($refmodel); die;
    	 foreach ($refmodel as $key => $value) {
	 		?>
	 		<tr>
	 			<td><?php echo $value ->reference_name ?>	</td>	
	 			<td><?php echo $value ->gender ?>	</td>
	 			<td><?php echo $value ->age ?>	</td>
	 			<td><?php echo $value ->range ?>	</td>
	 			<td><?php echo $value ->ref_from ?>	</td>
	 			<td><?php echo $value ->ref_to ?>	</td>
	 		</tr>	 
		<? }
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
    background: #ff7272;
    color: #fff;
}
</style>
