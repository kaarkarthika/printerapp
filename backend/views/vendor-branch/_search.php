<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VendorBranchSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-branch-search row">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //echo $form->field($model, 'vendor_branchid') ?>
<div class="col-md-4">

    <?= $form->field($model, 'vendorid')->dropDownList($vendorlist,['prompt' => 'Choose Vendor','id'=>'vendorid', 'data-style'=>'btn-default','onchange'=>'this.form.submit()'])->label(false) ?>
   </div>

    <?php // echo $form->field($model, 'branchcode') ?>

    <?php // echo $form->field($model, 'branchname') ?>

    <?php // echo $form->field($model, 'is_headoffice') ?>

    <?php // echo $form->field($model, 'address1') ?>

    <?php // echo $form->field($model, 'address2') ?>

    <?php // echo $form->field($model, 'address3') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'pincode') ?>

    <?php // echo $form->field($model, 'gstnumber') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'updated_ipaddress') ?>
    <div class="clearfix"></div>

  <!--  <div class="form-group col-md-6">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <!--<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>-->
   <!-- </div>-->

    <?php ActiveForm::end(); ?>

</div>
