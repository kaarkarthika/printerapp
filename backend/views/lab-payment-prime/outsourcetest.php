<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use backend\models\LabReport;
use backend\models\NewPatient;
use backend\models\LabPaymentPrime; 
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LabPaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Out Source Test';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
 	<div class="row">
		<div class="col-sm-12">
         <div class="btn-group pull-left m-t-15">
                        <h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
							
	 <div class="btn-group pull-right m-t-15">
   <?= Html::a('Back', ['lab-index-grid'], ['class' => 'btn btn-success']) ?>
</div>
						</div>
						

						
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-border panel-custom">
			<div class="panel-heading">
					</div>
	<div class="panel-body"> 
    <?php Pjax::begin();  ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  
		
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'mr_number', 
            	'label' => 'Registration Number ',
             	],
             ['attribute' => 'mr_number', 
            	'label' => 'MR Number ',
             	],
         	['attribute' => 'name', 
            	'label' => 'Name',
             	],
            [
            'attribute'=>'Age/Gender', 
            'width'=>'120px',
            'value'=>function ($model, $key, $index, $widget) {
        	  $newpatient=Newpatient::find()->where(['mr_no'=>$model->mr_number])->asArray()->one();
		 	  $age=$newpatient['dob'];
			  $dob = new \DateTime($age);
			  $now = new \DateTime();
			  $difference = $now->diff($dob);
			  $age1 = $difference->y;
			 return $age1.' / '.$newpatient['pat_sex'];		
			 
            },], 
            	
			['attribute' => 'ph_number', 
            	'label' => 'Phone Number ',
             	],
			 ['attribute' => 'physican_name', 
            	'label' => 'Physician Name ',
             	],
          [   	
          'attribute'=>'payment_status', 
            'width'=>'150px',
                    'value'=>function ($model, $key, $index, $widget) {
                	if($model->payment_status == 'P')
					{
						 return 'Paid';		
					} 
               },], 
             ['attribute' => 'Sample Collect On',
                'width'=>'180px',
            	 'value'=>function ($model, $key, $index, $widget) {
                	if($model->sample_date != "0000-00-00 00:00:00")
					{
					  return date("d-m-Y H:i A", strtotime($model->sample_date));		
					}else{
						 return '-';
					} 
				 }
             	],
            ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
                'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{viewlab}{report}{samplecollect}{samplereceived}{reportreceived}{download}',
                            'buttons'=>[
                             'viewlab' => function ($url, $model, $key) {
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
							  }, 
								   
							  'samplecollect' => function ($url, $model, $key) {
							  	  if($model->sample_test==0){
                                   return Html::button('Sample <br>Collection ', ['value' => $url, 'style'=>'margin-right:4px;font-size: 13px;','class' => 'btn btn-primary btn-xs view view gridbtncustom sampletest', 'data-toggle'=>'tooltip', 'title' =>'Sample Collection' ]);
								  }
							  }, 
							  'samplereceived' => function ($url, $model, $key) {
							  	  if($model->outsourcetest==1 && $model->status=="pending"){
                                	   return Html::button('Sample <br> Received ', ['value' => $url, 'style'=>'margin-right:4px;font-size: 13px;','class' => 'btn btn-primary btn-xs view view gridbtncustom samplerecived', 'data-toggle'=>'tooltip', 'title' =>'Sample Received' ]);
								  }
							  },
							  'reportreceived' => function ($url, $model, $key) {
							  	if($model->file_path==""){
							  	  if($model->status=="report_received"){
                                	   return Html::button('Report <br> Received ', ['value' => $url, 'style'=>'margin-right:4px;font-size: 13px;','class' => 'btn btn-warning btn-xs view view gridbtncustom reportrecived', 'data-toggle'=>'tooltip', 'title' =>'Report Received' ]);
								  }
								 }else{
								 	   return Html::button('Update ', ['value' => $url, 'style'=>'margin-right:4px;font-size: 13px;','class' => 'btn btn-warning btn-xs view view gridbtncustom reportrecived', 'data-toggle'=>'tooltip', 'title' =>'Report Received' ]);
								 }
							  },
							 'download' => function ($url, $model, $key) { 
							  	$dowpmodel=LabPaymentPrime::find()->where(['lab_id'=>$model->lab_id])->one();
								if($dowpmodel){
									$upload=$dowpmodel->file_path;
								if($upload!=""){
									if($model->file_path!=""){
										return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', $url, [
			                                'title' => Yii::t('app', 'Download '),      
                                			'data-method' => 'post',
                                			'class' => 'btn btn-primary download', 'data-toggle'=>'tooltip', 'title' =>'Download'
                    					]);
									
									//	$return_btu=" ".Html::a('<i class="fa fa-fw fa-download"></i> Download', ['value' => Url::to(['lab-payment-prime/downdata', 'id' => $model->lab_id] ), 'class' => 'btn bg-gray btn-flat btn-xs gallerymultiples', 'data-id' => $model->lab_id]);
									//	return $return_btu; 
									}
									}else{
										return "";
									}
								}else{
									return "";
								} 
								},  
                           
                         ] ],
           
           
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    
   
    <?php 
    Modal::begin([
                    'header' => '<h4 id="operationalheader_large"> </h4>',
                    'id' => 'operationalmodal_large', 
                    'size' => 'modal-lg',

                ]); 
				
      echo "<div id='modalContenttwo_large'>
            <div id='customtwo_large'><input type='hidden' class='data2'></div>
        </div>";
    Modal::end();

	?>
    
</div>
</div>
</div>
<style>
.select2-container .select2-selection--single .select2-selection__rendered {
    line-height: 24px !important;
    padding-left: 0 !important;
}
.view_right{
	    text-align: center;
    width: 9%;
    float: right;
    margin-top: 0 !important;
    background: #807e7e;
    color: #f3f3f3;
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

.btn-toolbar.kv-grid-toolbar.toolbar-container.pull-right>textarea {
    display: none;
}

.panel.panel-success .kv-panel-after {
    width: 135px;
    float: left;
}

i.fa.fa-info-circle {
    color: #000;
}

.bootstrap-dialog.type-warning .modal-header {
    background-color: #5fbeaa;
    padding: 10px 17px !important;
}

table.table.table-striped.table-hover.kv-grid-table.table-bordered.kv-table-wrap td {
    background: #fff;
}
table.table.table-striped.table-hover.kv-grid-table.table-bordered.kv-table-wrap tbody tr td {
    position: relative;
    top: 10px !important;
}
table.table.table-striped .empty {
    font-weight: 700;
    text-align: center;
    color: red;
}
a.btn.btn-primary.download {
    padding: 0px 6px;
}
.modal .modal-dialog .modal-content {
    min-height: 415px;
}
</style>

 <script>
 
$("#wrapper").addClass("enlarged");
$("#wrapper").addClass("forced");
$(".list-unstyled").css("display","none");
 
    $(document).ready(function(){
     $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             
             $('#operationalheader_large').html('<span> <i class="fa fa-fw fa-th-large"></i> Lab Report</span>');
             $('#operationalmodal_large').modal('show').find('#modalContenttwo_large').load(PageUrl);
             return false;
         });
     });  
     
     $(document).ready(function(){
     $('body').on("click",".sampletest",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader_large').html('<span> <i class="fa fa-fw fa-th-large"></i> Sample Collection </span>');
             $('#operationalmodal_large').modal('show').find('#modalContenttwo_large').load(PageUrl);
             return false;
         });
     });   
     
    $(document).ready(function(){
     $('body').on("click",".samplerecived",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader_large').html('<span> <i class="fa fa-fw fa-th-large"></i> Sample Received </span>');
             $('#operationalmodal_large').modal('show').find('#modalContenttwo_large').load(PageUrl);
             return false;
         });
     });   
     $(document).ready(function(){
     $('body').on("click",".reportrecived",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader_large').html('<span> <i class="fa fa-fw fa-th-large"></i> Report Received </span>');
             $('#operationalmodal_large').modal('show').find('#modalContenttwo_large').load(PageUrl);
             return false;
         });
     });   
       
 
</script>