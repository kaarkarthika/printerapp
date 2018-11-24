<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Patient */

$this->title = "View Patient";

?>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'patient_id',
            'patient_number',
             ['attribute' => 'patient_type', 'format'=>'raw', 'value' => function($model){   return $model->patienttype->patient_typename;   }],
                       
            'firstname',
            'lastname',
           ['attribute' => 'dob', 'format'=>'raw', 'value' => function($model){
							   $dob=date("d-m-Y",strtotime($model->dob));
							   return $dob;
                        }],
            'age',
            'medicalrecord_number',
            'address',
            'gender',
            'emailid:email',
            'patient_mobilenumber',
            'guardian_name',
            'guardian_mobilenumber',
            'physicianname',
            'billnumber',
          ['attribute' => 'invoicedate', 'format'=>'raw', 'value' => function($model){
                               $invoice=$model->invoicedate;
							   $invoice=date("d-m-Y",strtotime($invoice));
							   return $invoice;
                        }],
            'notes',
         //   'is_active',
          //  'updated_by',
          //  'updated_on',
          //  'updated_ipaddress',
        ],
    ]) ?>
