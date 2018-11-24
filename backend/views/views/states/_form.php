<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\States */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="states-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'state_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isactive')->textInput() ?>

    <?= $form->field($model, 'updatedby')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updatedon')->textInput() ?>

    <?= $form->field($model, 'updatedipaddress')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-life-ring"></i>Save' : '<i class="fa fa-fw fa-wrench "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
