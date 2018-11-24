<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SubVisit */

$this->title = $model->sub_id;
$this->params['breadcrumbs'][] = ['label' => 'Sub Visits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-visit-view">

<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'sub_id',
            //'pat_id',
            //'cons_status',
            'mr_number',
            'sub_visit',
            'consultant_time',
            [	'attribute' => 'consultant_doctor',
                'label' => 'Physican Name',  
	       	  	'value' => function($model)
	       	  	{
	                if($model->physician->physician_name != '')
					{
							return $model->physician->physician_name;  
					}
					else if($model->physician->physician_name == '')
					{
						  	return 'NIL';  
					}
			}],
			
			 [	'attribute' => 'department',
                'label' => 'Specialist', 
	       	  	'value' => function($model)
	       	  	{
	                if($model->specialist->specialist != '')
					{
							return $model->specialist->specialist;  
					}
					else if($model->specialist->specialist == '')
					{
						  	return 'NIL';  
					}
			}],
            
            
           // 'con_turn',
           [	'attribute' => 'patient_type',
                'label' => 'Patient Type', 
	       	  	'value' => function($model)
	       	  	{
	                if($model->patienttype->patient_type != '')
					{
							return $model->patienttype->patient_type;  
					}
					else if($model->patienttype->patient_type == '')
					{
						  	return 'NIL';  
					}
			}],
			
			[	'attribute' => 'insurance_type',
                'label' => 'Insurance Type', 
	       	  	'value' => function($model)
	       	  	{
	                if($model->insurance->insurance_type != '')
					{
							return $model->insurance->insurance_type;  
					}
					else if($model->insurance->insurance_type == '')
					{
						  	return 'NIL';  
					}
			}],
			
			[	'attribute' => 'insurance_type',
                'label' => 'Insurance Type', 
	       	  	'value' => function($model)
	       	  	{
	                if($model->insurance->insurance_type != '')
					{
							return $model->insurance->insurance_type;  
					}
					else if($model->insurance->insurance_type == '')
					{
						  	return 'NIL';  
					}
			}],
			
			[	'attribute' => 'ucil_letter_status',
                'label' => 'Letter Status', 
	       	  	'value' => function($model)
	       	  	{
	                if($model->ucil_letter_status != '')
					{
							return $model->ucil_letter_status;  
					}
					else {
						return '-';
					}
					
			}],
			
			[	'attribute' => 'ucil_emp_id',
                'label' => 'UCIL Employee ID', 
	       	  	'value' => function($model)
	       	  	{
	                if($model->ucil_emp_id != '')
					{
							return $model->ucil_emp_id;  
					}
					else {
						return '-';
					}
					
			}],
            
           [	'attribute' => 'patient_date',
                'label' => 'Entry Date', 
	       	  	'value' => function($model)
	       	  	{
	                if($model->patient_date != '')
					{
							if($model->patient_date == '1970-01-01')
							{
								return '-';
							}
							else 
							{
								return date('d-m-Y',strtotime($model->patient_date));
							}
							  
					}
					else {
						return '-';
					}
					
			}],
			
			[	'attribute' => 'ucil_date',
                'label' => 'Expiry Date', 
	       	  	'value' => function($model)
	       	  	{
	                if($model->ucil_date != '')
					{
						if($model->ucil_date == '1970-01-01')
							{
								return '-';
							}
							else 
							{
								return date('d-m-Y',strtotime($model->ucil_date));  
							}
							
					}
					else {
						return '-';
					}
					
			}],
			
			[	'attribute' => 'status_given',
                'label' => 'Updated Letter Status', 
	       	  	'value' => function($model)
	       	  	{
	                if($model->status_given == 'N')
					{
							return   'NO';
					}
					else if($model->status_given == 'Y') {
						return   'YES';
					}
					else {
						return   '-';
					}
					
			}],
			
			[	'attribute' => 'claim_status',
                'label' => 'Amount Claim Status', 
	       	  	'value' => function($model)
	       	  	{
	                if($model->claim_status == 'N')
					{
							return   'NO';
					}
					else if($model->claim_status == 'Y') {
						return   'YES';
					}
					else {
						return   '-';
					}
					
			}],
			
			
           
		   
           // 'total_amount',
            //'less_disc_percent',
            //'less_disc_flat',
            //'net_amt',
            //'paid_amt',
            //'due_amt',
            //'pay_mode',
            //'disc_by',
            //'remarks',
            //'created_at',
            //'updated_at',
            //'user_id',
            //'updated_ipaddress',
        ],
    ]) ?>

</div>
