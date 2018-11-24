<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Stockmaster */

$this->title = $model->stockid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stockmasters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
require('../../vendor/tcpdf/tcpdf.php');
require ('../../vendor/tcpdf/tcpdf_barcodes_1d.php');

require ('../../vendor/tcpdf/tcpdf_barcodes_2d.php');

?>
<div class="stockmaster-view">

    

    <?= DetailView::widget([
   
        'model' => $model,
        'attributes' => [
        
         'serialnumber', 'stock_code', 'vendor_name','product_name', 'compositionname', 'brandcode','quantity',
         ['attribute'=>'quantity', 'label'=>'Total Quanity','value'=>function($model)
{
	return $model->total_no_of_quantity;
}
],
['attribute'=>'expiredate','value'=>function($model)
{
	$exp=$model->stockresponse->expiredate;
	return date("d/m/Y",strtotime($exp));
}
],
['attribute'=>'batchnumber','value'=>function($model)
{
	return $model->stockresponse->batchnumber;
	
}
],

['attribute'=>'priceperqty', 'value'=>function($model)
{
	return $model->stockresponse->priceperquantity;
}
],

['attribute'=>'price', 'headerOptions' =>['style'=>'text-align:right;width:80px;'],'value'=>function($model)
{
	return $model->stockresponse->purchaseprice;
}
],
    	
           ['label'=>'Barcode',  'headerOptions' => ['style' => 'width:120px;color:#337ab7;'],'format' => 'raw','value'=>function($model)
		{
			$barcodeobj = new TCPDFBarcode(($model->brandcode.$model->quantity), 'C128');
				return $barcodeobj->getBarcodeHTML(1, 30, 'black');
		}],	
		
		['label'=>'QRCODE',  'format' => 'raw','value'=>function($model)
		{
			
	$exp= date("d/m/Y",strtotime($model->stockresponse->expiredate));
			
			$qrcode=$model->product_name."/".$model->compositionname."/".$exp."/".$model->stockresponse->total_no_of_quantity."/".$model->stockresponse->batchnumber;
			
       $style = array(
    'border' => 2,
    'padding' => 'auto',
    'fgcolor' => array(0,0,255),
    'bgcolor' => array(255,255,64)
);



$barcodeobj=new TCPDF2DBarcode($qrcode, 'QRCODE,M', 20, 30, 10, 10, $style, 'N');
return $barcodeobj->getBarcodeHTML();



		}],	
		
		
		
		
		
          
        ],
         
    ]) ?>

</div>
