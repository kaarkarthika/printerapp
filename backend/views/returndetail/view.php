<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Returndetail */

$this->title ='View Return';

?>
<div class="returndetail-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'return_detailid',
         //   'return_id',
           ['attribute'=>'returndate','format'=>'raw','value'=>function($model)
			{
				return date("d/m/Y",strtotime($model->returndate));
			}],
            'product_name',
            'stock_code',
            'composition_name',
            'unitname',
            'productqty',
            ['attribute'=>'priceperqty','format'=>'raw','value'=>function($model)
			{
				return "Rs.".($model->priceperqty);
			}],
			['attribute'=>'updated_ipaddress','format'=>'raw','label'=>'Total','value'=>function($model)
			{
				return  "Rs. " .($model->priceperqty*$model->productqty);
			}],
              ['attribute'=>'gstvalueperquantity','format'=>'raw','label'=>'Gst','value'=>function($model)
			{
				return  "Rs. " .($model->gstvalueperquantity*$model->productqty);
			}],
			 ['attribute'=>'discountvalueperquantity','format'=>'raw','label'=>'Discount','value'=>function($model)
			{
				return  "Rs. " .($model->discountvalueperquantity*$model->productqty);
			}],
            ['attribute'=>'price','format'=>'raw','label'=>'Total Price','value'=>function($model)
			{
				return "Rs. " .$model->price;
			}],
           
           
        ],
    ]) ?>

</div>
