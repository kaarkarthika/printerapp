<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
 $form = ActiveForm::begin([ 'action' => ['poreceive'],'method' => 'get']);
 
 $requestcode="";$vendorid="";$requestdate="";
if(isset($_GET['StockresponseSearch']['request_code']) && ($_GET['StockresponseSearch']['request_code']!="")){
	$requestcode=$_GET['StockresponseSearch']['request_code'];
}  ?>
<div class="row">
<div class="col-md-4">
	  <?= $form->field($model, 'request_code')->dropdownlist($requestcodelist,['prompt'=>'Select Requestcode', 'class'=>'selectpicker', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom",'value'=>$requestcode]); ?>
</div>
 <!-- <div class="clearfix"></div> -->

    <div class="form-group col-md-2" style="margin-top:25px;">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Reset'), Url::toRoute([]), ['class' => 'btn btn-warning']) ?>
    </div>
    </div>
    <?php


     
 if(isset($_GET['StockresponseSearch']['request_code']) && ($_GET['StockresponseSearch']['request_code']!="")){
      	echo '<table class="table  table-striped">';
      	echo '<tr><td class="pull-right">';
       echo Html::a('<i class="fa fa-file-excel-o"></i> Export Excel ', ['report/poconfirmexcelexport' ,'request_code'=>$requestcode, 
       ], ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
      echo '</td>';
	  
	  echo '<td class="pull-right">';
       echo Html::a('<i class="fa fa-file-excel-o"></i> Export Pdf ', ['report/poconfirmpdfexport' ,'request_code'=>$requestcode, 
       ], ['class' => 'btn btn-danger btn-sm ','target'=>'_blank']); 
      echo '</td>';
		
	echo '</tr>
</table>';
	   }
    ActiveForm::end(); ?>
    <div class="clearfix"></div>
