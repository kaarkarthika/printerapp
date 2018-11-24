<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Testgroup */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Testgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testgroup-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
           // 'autoid',
           
           ['attribute' => 'testgroupname', 
            	'label' => 'Test Group Name ',
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
							return Active;	
						}else{
							return InActive;
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
    			<td>Test Name List</td>
    		</tr>
    		</thead>
    		<tbody>
    <?php  $i=1;
    if(!empty($testname_det_index)){
    	 foreach ($testname_det_index as $key => $value) {
	 		?>
	 		<tr>
	 			<td><?php echo $i++ ?>	</td>	
	 			<td><?php echo $value->test_name  ?>	</td>
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

</div>
