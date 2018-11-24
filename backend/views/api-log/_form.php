<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ApiLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="api-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'event_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'response_data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'A' => 'A', 'I' => 'I', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'modified_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
