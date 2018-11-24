<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthorityMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="authority-master-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'authorityname')->textInput(['maxlength' => true,'required'=>"required"]) ?>
    <!-- <?= $form->field($model, 'isactive')->textInput() ?> -->
    
     	<?php 
     	if($model->isNewRecord){$model->isactive = 1;	}?> 
		 <?= $form->field($model, 'isactive', [
    		'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
			])->checkbox([],false) ?>
			

    <!-- <?= $form->field($model, 'created_at')->textInput() ?>
    <?= $form->field($model, 'updated_at')->textInput() ?>
    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'user_role')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?> -->
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
