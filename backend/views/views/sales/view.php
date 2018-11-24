<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Sales */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-view">


    <?= DetailView::widget([
        'model' => $model,
       
        'attributes' => [
         //   'opsaleid',
            'name',
            ['attribute'=>'dob','format'=>'raw','value'=>function($model)
			{
				return date("d/m/Y",strtotime($model->dob));
			}],
            'gender',
            'mrnumber',
        	 'paid_status',
            'emailid:email',
            'phonenumber',
            'billnumber',
           ['attribute'=>'invoicedate','format'=>'raw','value'=>function($model)
			{
				return date("d-m-Y h:i:s",strtotime($model->invoicedate));
			}],
            ['attribute'=>'physicianname','format'=>'raw','value'=>function($model)
			{
				return $model->physician->physician_name;
			}],
			
        //    'updated_by',
        //    'updated_on',
        //    'updated_ipaddress',
        ],
    ]) ?>

</div>
