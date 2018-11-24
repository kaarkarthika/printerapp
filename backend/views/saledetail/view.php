<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Saledetail */

$this->title = $model->opsale_detailid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Saledetails'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saledetail-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'opsale_detailid',
         //   'opsaleid',
           ['attribute'=>'saledate','format'=>'raw','value'=>function($model)
			{
				return date("d-m-Y h:i:s",strtotime($model->saledate));
			}],
            'product_name',
            'stock_code',
            'composition_name',
            'unitname',
            'productqty',
           ['attribute'=>'priceperqty','format'=>'raw','value'=>function($model)
			{
				return "Rs.".number_format(($model->priceperqty),2);
			}],
			['attribute'=>'updated_ipaddress','format'=>'raw','label'=>'Total','value'=>function($model)
			{
				return  "Rs. " .number_format(($model->priceperqty*$model->productqty),2);
			}],
              ['attribute'=>'gstvalueperquantity','format'=>'raw','label'=>'Gst','value'=>function($model)
			{
				return  "Rs. " .number_format(($model->gstvalueperquantity*$model->productqty),2);
			}],
			 ['attribute'=>'discountvalueperquantity','format'=>'raw','label'=>'Discount','value'=>function($model)
			{
				return  "Rs. " .number_format(($model->discountvalueperquantity*$model->productqty),2);
			}],
            ['attribute'=>'price','format'=>'raw','label'=>'Total Price','value'=>function($model)
			{
				return "Rs. " .$model->price;
			}],
           
           
            
        ],
    ]) ?>

</div>
