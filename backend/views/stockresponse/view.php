<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Stockresponse */

$this->title = $model->stockresponseid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stockresponses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
require('../../vendor/tcpdf/tcpdf.php');
require ('../../vendor/tcpdf/tcpdf_barcodes_1d.php');

require ('../../vendor/tcpdf/tcpdf_barcodes_2d.php');
?>
<div class="stockresponse-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'stockresponseid',
              [
            'attribute'=>'stockrequestid', 
          
            'value'=>function ($model) { 
                 return $model->stockrequestcode->requestcode;
            },
           
           
        ],
         [
            'attribute'=>'companybranch', 
          
           
           
        ],
        
		
            ['attribute'=>'productname', 'headerOptions' => ['style' => 'width:120px;color:#337ab7;']],
             ['attribute'=>'vendorname', 'headerOptions' => ['style' => 'width:120px;color:#337ab7;']],
         
          
          
             ['attribute' => 'stockid', 'format'=>'raw', 'value' => function($model){
                                return $model->stockbrandcode->brandcode;
                        }],
            'batchnumber',
      
            ['attribute'=>'receivedquantity'],
            ['attribute'=>'unitid','format'=>'raw','value'=>function($model)
    	{
    		return $model->unittype->unitvalue;
    	}],
           
             'purchaseprice',
            'priceperquantity',
            ['attribute' => 'receiveddate', 'format'=>'raw', 'value' => function($model){
                              
							   $receiveddate=date("d-m-Y",strtotime($model->receiveddate));
							   return $receiveddate;
                        }],
                        ['attribute' => 'manufacturedate', 'format'=>'raw', 'value' => function($model){
                              
							   $manufacturedate=date("d-m-Y",strtotime($model->manufacturedate));
							   return $manufacturedate;
                        }],
           
            ['attribute' => 'expiredate', 'format'=>'raw', 'value' => function($model){
                              
							   $manufacturedate=date("d-m-Y",strtotime($model->manufacturedate));
							   return $manufacturedate;
                        }],
           ['attribute' => 'purchasedate', 'format'=>'raw', 'value' => function($model){
                              
							   $purchasedate=date("d-m-Y",strtotime($model->purchasedate));
							   return $purchasedate;
                        }],
                                          ['label'=>'Barcode',  'headerOptions' => ['style' => 'width:120px;color:#337ab7;'],'format' => 'raw','value'=>function($model)
		{
			
			$barcode=$model->stockbrandcode->brandcode.$model->batchnumber.$model->receivedquantity;
			$barcodeobj = new TCPDFBarcode(($barcode), 'C128');
				return $barcodeobj->getBarcodeHTML(1, 30, 'black');
		}],	
		
		['label'=>'QRCODE',  'format' => 'raw','value'=>function($model)
		{
			
			
			$qrcode=$model->stockbrandcode->brandcode.$model->batchnumber.$model->receivedquantity;
			
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
