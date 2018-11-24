<?php
use yii\helpers\Html;
$this->title = Yii::t('app', 'Create Stockmaster');
echo $this->render('_form', [  'model' => $model, 'list'=>$vendorlist]) ?>