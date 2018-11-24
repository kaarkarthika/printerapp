<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
  <div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-4">
    	
    	 <?= $form->field($model, 'receipt_number')->textInput(['maxlength' => true]) ?>
    </div>
              	<div class="col-md-4">
             <?php 
     		 echo $form->field($model, 'patient_type')   ->radioList(  ['1' => 'InPatient', "2" => 'OutPatient'],                   
     [ 'item' => function($index, $label, $name, $checked, $value) {
     	$class_checked='';
     	if($checked==$value){$class_checked='checked="checked"';}
$return ='<div class="radio radio-custom radio-inline"><input type="radio" name="' .$name. '" value="' .$value. '" tabindex="3" '.$class_checked.'><label style="font-size:11px;">'.ucwords($label).'</label></div>';
                                    return $return;
                                }
                            ]
                        )
                    ->label("Patient Type");
                    echo ' <div class="help-block"></div>';
   
                   
                    ?>
                           
    </div>

   <div class="col-md-4">

  

    <?= $form->field($model, 'payment_type')->textInput() ?>
   </div>
   <div class="col-md-4">
   	 <?= $form->field($model, 'invoicenumber')->textInput(['maxlength' => true]) ?>
   </div>
   <div class="col-md-4">
   	<?= $form->field($model, 'tax')->textInput() ?>
   </div>
   <div class="clearfix"></div>

    <div class="col-md-6">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-default' : 'btn btn-primary']) ?>
    </div>


 </div>
</div>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>