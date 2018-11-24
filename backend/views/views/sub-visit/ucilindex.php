<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\Physicianmaster;
use backend\models\Specialistdoctor;
use backend\models\PatientType;
use backend\models\Insurance;
use backend\models\BranchAdmin;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SubVisitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sub Visits';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>

table.kv-grid-table.table.table-bordered.table-striped.kv-table-wrap {
    width: 2500px;
}
table.kv-grid-table.table.table-bordered.table-striped.kv-table-wrap th {
    width: 5% !important;
}
table.kv-grid-table.table.table-bordered.table-striped.kv-table-wrap th:first-child {
    width: 2% !important;
}

.select2-container--krajee .select2-selection--single .select2-selection__clear {
    right: 4rem;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    line-height: unset !important;
    padding-left: 0px !important;
}

.panel-success > .panel-heading {
    background-color: #5fbeaa;
}

h4.panel-title,.panel-heading .pull-right .summary{
    color: #fff;
}

.panel.panel-success .kv-panel-after {
    width: 135px;
    float: left;
}

.bootstrap-dialog.type-warning .modal-header {
    background-color: #5fbeaa;
    padding: 10px 17px !important;
}

table.kv-grid-table th a,table.kv-grid-table td {
    font-size: 12px;
}
</style>
<div class="container">
<div class="row">
<div class="col-sm-12">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
								</ol>
							</div></div>

<div class="row">
<div class="col-sm-12">
<!--div class="panel panel-border panel-custom">
<div class="panel-heading">

</div-->


<div class="newpatient-index">
 <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
     'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
			/*['class' => '\kartik\grid\ActionColumn',
        'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']],*/
        
        [
            'attribute'=>'created_at', 
            'width'=>'310px',
            'value'=>function ($model, $key, $index, $widget) { 
                 return date('d-m-Y',strtotime($model->created_at));
            },
            'group'=>true, 
            'groupedRow'=>true,                    // move grouped column to a single grouped row
            'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
            'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
           
           
        ],
        
         ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
             'contentOptions' => ['style' => 'width:5%;color:#337ab7;'],
               'template'=>'{view}{update}',
                            'buttons'=>[
                             	  
								    'view' => function ($url, $model, $key) {
                                  		   $url = Url::toRoute(['sub-visit/ucilview', 'id' => $model->sub_id]);
                                           return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  }, 	
									
									
								   'update' => function ($url, $model) 
								   {
                                		return Html::button('<span class="fa fa-edit"></span>', [
                                        'value' => $url,
                                        'name' => 'Category Update',
                                        'title' => Yii::t('yii', 'Update'),
                                        'class' => 'btn btn-warning btn-xs gridbtncustom updatedata',
                                        'data-toggle'=> 'tooltip',
                                        'style'=>'margin-right:4px;',
                                	]);                                
            						},
            			    ] ],
        
         //  'sub_id',
            //'pat_id',
            //'cons_status',
            'mr_number',
            'sub_visit',
            //'consultant_time',
          
            
            [
            'attribute'=>'consultant_doctor', 
            'headerOptions' => ['style' => 'color:#337ab7;'],
             'label'=>'Physican Name',
            'width'=>'8% !important',
            'value'=>function ($model, $key, $index, $widget) { return $model->physician->physician_name;},
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Physicianmaster::find()->asArray()->all(), 'id', 'physician_name'), 
            'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],
            'filterInputOptions'=>['placeholder'=>'--Physican--'],
          ],
          
		  [
            'attribute'=>'department', 
            'headerOptions' => ['style' => 'color:#337ab7;'],
             'label'=>'Department Name',
            'width'=>'8% !important',
            'value'=>function ($model, $key, $index, $widget) { return $model->specialist->specialist;},
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Specialistdoctor::find()->asArray()->all(), 's_id', 'specialist'), 
            'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],
            'filterInputOptions'=>['placeholder'=>'--Specialist--'],
          ],
            
            
            
            //'con_turn',
            
            
            [
            'attribute'=>'patient_type', 
            'headerOptions' => ['style' => 'color:#337ab7;'],
             'label'=>'Patient Type',
            'width'=>'8% !important',
            'value'=>function ($model, $key, $index, $widget) { return $model->patienttype->patient_type;},
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(PatientType::find()->asArray()->all(), 'type_id', 'patient_type'), 
            'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],
            'filterInputOptions'=>['placeholder'=>'--Patient Type--'],
          ],
            
		  [
            'attribute'=>'insurance_type', 
            'headerOptions' => ['style' => 'color:#337ab7;'],
             'label'=>'Insurance Type',
            'width'=>'8% !important',
            
            'value'=>function ($model, $key, $index, $widget) 
            {
            	 if($model->insurance->insurance_type != '')
				 {
				 	return $model->insurance->insurance_type;
				 } 
				 else 
				 {
					return '-'; 
				 }
			},
           
		    'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Insurance::find()->asArray()->all(), 'insurance_typeid', 'insurance_type'), 
            'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],
            'filterInputOptions'=>['placeholder'=>'--Insurance--'],
          ],
            
          
       	  [	'attribute' => 'ucil_letter_status', 
       	  	'filter'=>array("YES"=>Yes,"NO"=>No),
       	  	//'format'=>'raw', 
       	  	'value' => function($model)
       	  	{
                if($model->ucil_letter_status == 'YES')
				{
						return "YES";  
				}
				else if($model->ucil_letter_status == 'NO')
				{
					  	return "NO"; 
				}
				else if($model->ucil_letter_status == '')
				{
					  	return "-"; 
				}
		  }],
           
		  [	'attribute' => 'ucil_emp_id', 
       	  	//'filter'=>array("1"=>Yes,"0"=>No),
       	  	//'format'=>'raw', 
       	  	'value' => function($model)
       	  	{
                if($model->ucil_emp_id != '')
				{
						return $model->ucil_emp_id;  
				}
				else if($model->ucil_emp_id == '')
				{
					  	return '-';  
				}
				
		  }],
		  
		  [	'attribute' => 'patient_date', 
       	  	//'filter'=>array("1"=>Yes,"0"=>No),
       	  	//'format'=>'raw', 
       	  	'value' => function($model)
       	  	{
                if($model->patient_date != '1970-01-01')
				{
						return date('d-m-Y',strtotime($model->patient_date));  
				}
				
				
		  }],
		  
		  [	'attribute' => 'ucil_date', 
       	  	//'filter'=>array("1"=>Yes,"0"=>No),
       	  	//'format'=>'raw', 
       	  	'value' => function($model)
       	  	{
                if($model->ucil_date != '1970-01-01')
				{
						return date('d-m-Y',strtotime($model->ucil_date));  
				}
				
				
		  }],
		  
		  [	'attribute' => 'status_given', 
       	  	'filter'=>array("Y"=>Yes),
       	  	'format'=>'raw', 
       	  	'value' => function($model)
       	  	{
                if($model->status_given != '')
				{
					return 'Yes';	
				}
				else 
				{
					return '-';	
				}
		   }],
		   
		   [	'attribute' => 'claim_status', 
       	  	'filter'=>array("Y"=>Yes,"N"=>No),
       	  	'format'=>'raw', 
       	  	'value' => function($model)
       	  	{
                if($model->claim_status != '')
				{
					if($model->claim_status == 'N')
					{
						return 'No';
					}
					else if($model->claim_status == 'Y')
					{
						return 'Yes';
					}
						
				}
				else 
				{
					return '-';	
				}
		   }], 
          
            'total_amount',
            //'less_disc_percent',
            //'less_disc_flat',
            //'net_amt',
            //'paid_amt',
            //'due_amt',
            //'pay_mode',
            //'disc_by',
            //'remarks',
            
            [	'attribute' => 'created_at', 
       	  	//'filter'=>array("Y"=>Yes),
       	  	//'format'=>'raw', 
       	  	'value' => function($model)
       	  	{
                if($model->created_at != '')
				{
					return date('d-m-Y H:i:s',strtotime($model->created_at));	
				}
				
		   }],
            
          //  'created_at',
            //'updated_at',
            
            [
            'attribute'=>'user_id', 
            'headerOptions' => ['style' => 'color:#337ab7;'],
             'label'=>'User Name',
            'width'=>'8% !important',
            
            'value'=>function ($model, $key, $index, $widget) 
            {
            	 if($model->branch->ba_name != '')
				 {
				 	return $model->branch->ba_name;
				 } 
				 else 
				 {
					return '-'; 
				 }
			},
           
		    'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(BranchAdmin::find()->asArray()->all(), 'ba_autoid', 'ba_name'), 
            'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],
            'filterInputOptions'=>['placeholder'=>'--User Name--'],
          ],
            
            //'user_id',
            //'updated_ipaddress',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
        
		'responsive'=>true,
    'hover'=>true,
    //'floatHeader'=>true,
    //'floatHeaderOptions'=>['scrollingTop'=>'50'],
		
		
		'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="fa fa-bed"></i> Sub Visit</h3>',
        'type'=>'success',
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['ucilindex'], ['class' => 'btn btn-info']),
        
		'resizableColumns'=>true,
    'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
     'pjax'=>true,
    'pjaxSettings'=>[
        'neverTimeout'=>true,
        'beforeGrid'=>'My fancy content before.',
        'afterGrid'=>'My fancy content after.',
    ]
		
    	],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
 <script type="text/javascript">
  $(document).ready(function(){
$("#wrapper").addClass("enlarged");
      $("#wrapper").addClass("forced");   			
    //  $(".list-unstyled > li").removeClass("active1 active");
        $(".list-unstyled").css("display","none");
  });
</script>

<script>
  $(document).ready(function()
  {
	 $('body').on("click",".modalView",function()
     {
         $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>UCIL Form</span>');
         $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
         return false;  
 	  });
  });
</script>
