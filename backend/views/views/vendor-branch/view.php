<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\VendorBranch */

$this->title = $model->vendor_branchid;
$this->params['breadcrumbs'][] = ['label' => 'Vendor Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-branch-view">

 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'vendor_branchid',
              ['attribute' => 'vendorid', 'format'=>'raw', 'value' => function($model){return $model->vendor->vendorname;}],
            'branchcode',
            'branchname',
            ['attribute' => 'is_headoffice', 'format'=>'raw', 'value' => function($model){
                               if($model->is_headoffice==1)
							   {
							   	return "Yes";
							   }
							   else{
							   	return "No";
							   }
                        }],
            'address1',
            'address2',
          
            'city',
           ['attribute' => 'state', 'format'=>'raw', 'value' => function($model){return $model->states->state_name;}],
            'pincode',
            'gstnumber',
            'branch_phonenumber',
             'branch_emailid',
           ['attribute' => 'is_active', 'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {
							   	return "Yes";
							   }
							   else{
							   	return "No";
							   }
                        }],
        'bankname',
             'ifsccode',
             'accnumber',
               'contact_person',
            'person_mobilenumber',
        ],
    ]) ?>

</div>
