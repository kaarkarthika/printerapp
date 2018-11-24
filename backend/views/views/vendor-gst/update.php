<?php
use yii\helpers\Html;
$this->title = "Update Vendot Gst";
echo $this->render('_form', [  'model' => $model, 'vendorlist'=>$vendorlist,'statelist'=>$statelist ]) ?>