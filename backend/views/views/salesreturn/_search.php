<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SalesreturnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salesreturn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo  $form->field($model, 'return_id') ?>

    <?= $form->field($model, 'return_invoicenumber') ?>

    <?= $form->field($model, 'patient_type') ?>

    <?= $form->field($model, 'mrnumber') ?>

    <?= $form->field($model, 'return_quantity') ?>

  

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
