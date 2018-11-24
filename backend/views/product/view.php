<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = $model->productid;

?>




    <?= DetailView::widget([
    
        'model' => $model,
        
        'attributes' => [
       
            'productname',
           ['attribute' => 'product_typeid', 'format'=>'raw', 'value' => function($model){
                                return $model->producttype->product_type;
                        }],
           ['attribute' => 'is_active', 'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {
							   	return "Yes";
							   }
							   else{
							   	return "No";
							   }
                        }],
                        'product_code',
                       // 'hsn_code',
                     
					 
					 	 ['attribute' => 'hsn_code', 'format'=>'raw', 'value' => function($model){
                               if($model->taxgroup->hsncode!='')
							   {
							  		return $model->taxgroup->hsncode;
							   }
							   else{
							   	//print_r($model->composition_id)
							   	return "NIL";
							   }
                        }],
					 
					 
                       
                        ['attribute' => 'compositionname', 'format'=>'raw', 'value' => function($model){
                               if($model->composition_id!='')
							   {
							  		return $model->composition->composition_name;
							   }
							   else{
							   	//print_r($model->composition_id)
							   	return "NIL";
							   }
                        }],
                       
                        'sort_description',
                        'minstock',
                        'reorderlevelstock',
                        'maxstock',
        ],
    ]) ?>

</div>
