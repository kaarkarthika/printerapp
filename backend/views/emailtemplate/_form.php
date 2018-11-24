<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Emailtemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emailtemplate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userfrom')->textInput() ?>

    <?= $form->field($model, 'userto')->textInput() ?>

    <?= $form->field($model, 'isread')->textInput() ?>

    <?= $form->field($model, 'datesent')->textInput() ?>

    <?= $form->field($model, 'attachment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
