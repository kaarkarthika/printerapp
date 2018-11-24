<?php
use yii\helpers\Html;
$this->title = Yii::t('app', 'Add Vendor Gst');
echo $this->render('_form', [ 'model' => $model, 'vendorlist'=>$vendorlist,'statelist'=>$statelist]);?>