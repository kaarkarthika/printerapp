<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
$form = ActiveForm::begin(['action' => ['audit'],'method' => 'get']); ?>
 <div class="row">
							<div class="col-sm-12">
								<div class="panel panel-border panel-custom">
									<div class="panel-heading">
										
									</div>
									<div class="panel-body">
										<div class="col-xs-2">
	
    <?= $form->field($model, 'stock_code')->textInput(); ?>
</div>
<div class="col-xs-2">
	
    <?= $form->field($model, 'brandcode')->textInput(); ?>
</div>
   
 <div class="col-xs-3">
    <?= $form->field($model, 'productid')->dropdownlist($productlist,['prompt'=>'Select Product','class'=>'selectpicker', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom"]); ?>
   </div>
<div class="col-xs-2">
	
    <?= $form->field($model, 'vendorid')->dropdownlist($vendorlist,['prompt'=>'Select Vendor', 'class'=>'selectpicker', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom",]); ?>
</div>
<div class="col-xs-3">
	
    <?= $form->field($model, 'updated_ipaddress')->textInput(['id'=>"reportrange",'class'=>"form-control input-daterange-datepicker", 'value'=>''
   ])->label('Expire Date'); ?>
</div>
<div class="col-xs-4">
    <?= $form->field($model, 'compositionid')->dropdownlist($compositionlist,['prompt'=>'--Select Composition--', 'class'=>'selectpicker', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom"])->label("Composition Name"); ?>
</div>

    <div class="col-md-6" style="margin-top:30px;">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-default']) ?>
        <?= Html::a(Yii::t('app', 'Reset'), Url::toRoute([]), ['class' => 'btn btn-warning']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</div></div>
</div>