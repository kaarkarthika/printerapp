<?php
use yii\helpers\Html;
$this->title = Yii::t('app', 'Transfer Stock');
echo $this->render('_form', [ 'model' => $model, 'companylist'=>$companylist,'companylist1' => $companylist1,'vendorlist'=>$vendorlist,'productlist'=>$productlist]); ?>