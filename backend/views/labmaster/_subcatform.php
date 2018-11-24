<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LabCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">
<div class="lab-category-form">

</div>
<div class="panel-body" >
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lab_subcategory')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
</div>
</div>
