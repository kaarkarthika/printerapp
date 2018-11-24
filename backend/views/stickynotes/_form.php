<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Stickynotes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stickynotes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'notetitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notedesc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_active')->textInput() ?>

    <?= $form->field($model, 'colorscheme')->dropDownList([ 'red' => 'Red', 'blue' => 'Blue', 'green' => 'Green', '' => '', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'updated_ipaddress')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
