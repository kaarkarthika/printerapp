<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
 
// Usage with ActiveForm and model

?>
  <div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>
 <div class="col-md-3">
 	<?= $form->field($model, 'bulkproductname')->textInput(); ?>
 </div>
   
   <div class=" col-md-3">
						<?php 

// Normal select with ActiveForm & model
echo $form->field($model, 'productidz')->widget(Select2::classname(), [
    'data' => $productlist,
     'value' => $model->productidz,
   
    'options' => ['placeholder' => 'Select Product','multiple' => true],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
						
						
						
						?>
				
   </div>
<!--  
<div class="clearfix">
</div> -->
    <div class="form-group col-sm-2" style="margin-top:25px;">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
 <div class="clearfix"></div>
</div>
</div>
</div>
</div>