<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = $model->productgroupid;
echo DetailView::widget([
        'model' => $model,
        'attributes' => [ 'product_name',  'vendor_name',   'brandcode', 
   ['attribute' =>'is_active','format'=>'raw','value'=>function($model){if($model->is_active==1){return "Yes";}else{return "No";} }]
                        ]
                        ]) ;?>