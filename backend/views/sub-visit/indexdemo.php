<?php

use yii\helpers\Html;
//use yii\grid\GridView;

use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\Physicianmaster;
use backend\models\Specialistdoctor;
use backend\models\PatientType;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SubVisitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sub Visits';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
	table.table.table-striped.table-bordered {
    width: 1300px;
    
    max-width: 100%;
}
.panel.panel-border.panel-custom{
	overflow-x: scroll !important;
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
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>


<div class="newpatient-index">
 <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
		'filterSelector' => 'select[name="per-page"]',
		 
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
			['class' => '\kartik\grid\ActionColumn',
        'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']],
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
            'width'=>'30px',
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
            'width'=>'10px',
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
            'width'=>'10px',
            'value'=>function ($model, $key, $index, $widget) { return $model->patienttype->patient_type;},
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(PatientType::find()->asArray()->all(), 'type_id', 'patient_type'), 
            'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],
            'filterInputOptions'=>['placeholder'=>'--Patient Type--'],
          ],
            
            
           // 'patient_type',
            'insurance_type',
            'ucil_letter_status',
            'ucil_emp_id',
            'patient_date',
            'ucil_date',
            'status_given',
            'claim_status',
            'total_amount',
            //'less_disc_percent',
            //'less_disc_flat',
            //'net_amt',
            //'paid_amt',
            //'due_amt',
            //'pay_mode',
            //'disc_by',
            //'remarks',
            'created_at',
            //'updated_at',
            'user_id',
            //'updated_ipaddress',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
        
		'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Countries</h3>',
        'type'=>'success',
        'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        'footer'=>false
    	],
        
    ]); ?>
    <?php Pjax::end(); ?>
</div>
