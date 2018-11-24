<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Salesreturn */
/* @var $form yii\widgets\ActiveForm */
?>


	  <div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">

    <?php $form = ActiveForm::begin(); ?>
    <!--<div class="col-md-3">
    	<?= $form->field($model, 'return_invoicenumber')->textInput(['maxlength' => true]) ?>

    </div>-->
   <div class="col-md-3">
    
    <?= $form->field($model, 'patient_type')->textInput() ?>
  </div>
   <div class="col-md-3">
    <?= $form->field($model, 'mrnumber')->textInput(['maxlength' => true]) ?>
  </div>
  
<div class="clearfix"></div>
    <div class="form-group col-md-3">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
</div>


