<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LabAddgroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-addgroup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mastergroupid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'testgroupid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'update_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
