<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Stockreturn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stockreturn-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'stockrequestid')->textInput() ?>

    <?= $form->field($model, 'request_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stockid')->textInput() ?>

    <?= $form->field($model, 'branch_id')->textInput() ?>

    <?= $form->field($model, 'batchnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receivedquantity')->textInput() ?>

    <?= $form->field($model, 'total_no_of_quantity')->textInput() ?>

    <?= $form->field($model, 'unitid')->textInput() ?>

    <?= $form->field($model, 'receiveddate')->textInput() ?>

    <?= $form->field($model, 'purchaseprice')->textInput() ?>

    <?= $form->field($model, 'priceperquantity')->textInput() ?>

    <?= $form->field($model, 'manufacturedate')->textInput() ?>

    <?= $form->field($model, 'expiredate')->textInput() ?>

    <?= $form->field($model, 'purchasedate')->textInput() ?>

    <?= $form->field($model, 'stock_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'returndate')->textInput() ?>

    <?= $form->field($model, 'returnquantity')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'updated_ipaddress')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
