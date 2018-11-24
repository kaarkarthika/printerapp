<?php
 
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InTreatmentOverall */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="in-treatment-overall-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'refund_status')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dob')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'physicianname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mrnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subvisit_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subvisit_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'insurancetype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phonenumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'billnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoicedate')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'tot_no_of_items')->textInput() ?>

    <?= $form->field($model, 'tot_quantity')->textInput() ?>

    <?= $form->field($model, 'total_gst_percent')->textInput() ?>

    <?= $form->field($model, 'total_cgst_percent')->textInput() ?>

    <?= $form->field($model, 'total_sgst_percent')->textInput() ?>

    <?= $form->field($model, 'totalgstvalue')->textInput() ?>

    <?= $form->field($model, 'totalcgstvalue')->textInput() ?>

    <?= $form->field($model, 'totalsgstvalue')->textInput() ?>

    <?= $form->field($model, 'totaldiscountvalue')->textInput() ?>

    <?= $form->field($model, 'overalldiscounttype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'overalldiscountpercent')->textInput() ?>

    <?= $form->field($model, 'overalldiscountamount')->textInput() ?>

    <?= $form->field($model, 'overall_due_amount')->textInput() ?>

    <?= $form->field($model, 'overall_sub_total')->textInput() ?>

    <?= $form->field($model, 'subtotval')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'overall_net_amount')->textInput() ?>

    <?= $form->field($model, 'overalltotal')->textInput() ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'discount_authority')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_role')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
