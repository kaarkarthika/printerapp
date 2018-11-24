<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = $model->vendor_gst_id;
echo DetailView::widget([  'model' => $model, 'attributes' => [ 'vendor_id',  'state',  'gst_tax', 'is_active'] ]) ?>
   
