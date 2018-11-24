<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\SubVisit */

$this->title = $model->sub_id;
$this->params['breadcrumbs'][] = ['label' => 'Sub Visits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-visit-view">
<?php
if($model->patient->temporary_blocked == 'N')
{
	echo Html::a('<i class="fa fa-ban" aria-hidden="true"></i> Block', Url::to(['sub-visit/temporaryblock', 'id' => urlencode(base64_encode($model->sub_id)),'pat_id'=>urlencode(base64_encode($model->	pat_id))]), [
                   'title' => 'Block',
                   'class' => 'pull-left detail-button btn btn-danger',
                   'data' => [
                       'confirm' => 'Are You Sure this Patient Temporary Blocked?',            
                       'method' => 'post',
                   ]
           ]);
}
else if($model->patient->temporary_blocked == 'Y') {
	echo Html::a('<i class="fa fa-unlock" aria-hidden="true"></i> Un-Block', Url::to(['sub-visit/unblock', 'id' => urlencode(base64_encode($model->sub_id)),'pat_id'=>urlencode(base64_encode($model->	pat_id))]), [
                   'title' => 'Un-Block',
                   'class' => 'pull-left detail-button btn btn-success',
                   'data' => [
                       'confirm' => 'Are You Sure this Patient an Un-Block?',            
                       'method' => 'post',
                   ]
           ]);
}

?>

<br><br><br>
<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'sub_id',
            //'pat_id',
            //'cons_status',
            
            
            
            
            'mr_number',
            'sub_visit',
            
			
            [	'attribute' => 'pat_name',
                'label' => 'Patient Name',  
	       	  	'value' => function($model)
	       	  	{
	                if($model->patient->patientname != '')
					{
							return $model->patient->patientname;  
					}
					else if($model->patient->patientname == '')
					{
						  	return 'NIL';  
					}
			}],
			
			
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
			
			
			[	'attribute' => 'created_at',
                'label' => 'Patient Register Date', 
	       	  	'value' => function($model)
	       	  	{
	                if($model->created_at != '')
					{
						return date('d-m-Y H:i:s',strtotime($model->created_at));
					}
					else {
						return '-';
					}
					
			}],
			
            
           [	'attribute' => 'patient_date',
                'label' => 'Patient Entry Date', 
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
                'label' => 'UCIL Issue Date', 
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
			
			[	'attribute' => 'ucil_date',
                'label' => 'Expired Date', 
	       	  	'value' => function($model)
	       	  	{
	                if($model->ucil_date != '')
					{
						if($model->ucil_date == '1970-01-01')
						{
							return '-';
						}
						else{
							$issue_date=date_create(date('Y-m-d',strtotime($model->ucil_date)));
   							date_add($issue_date,date_interval_create_from_date_string("10 days"));
							$issue_date=date_format($issue_date,"d-m-Y");
							return $issue_date;
						}
					}
					
					else {
						return   '-';
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
