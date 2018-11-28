<?php
 
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use backend\models\LabReport;
use backend\models\NewPatient; 
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LabPaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lab Payments';
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
   				<?= Html::a('Out Source Test', ['laboutsourcegrid'], ['class' => 'btn btn-success']) ?>
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
			 ['attribute' => 'dr_name', 
            	'label' => ' Physician Name',
           
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
               'template'=>'{viewlab}{report}{samplecollect}',
                            'buttons'=>[
                             'viewlab' => function ($url, $model, $key) {
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
							  }, 
								   
							  'samplecollect' => function ($url, $model, $key) {
							  	  if($model->sample_test==0){
                                   return Html::button('Sample <br>Collection ', ['value' => $url, 'style'=>'margin-right:4px;font-size: 13px;','class' => 'btn btn-primary btn-xs view view gridbtncustom sampletest', 'data-toggle'=>'tooltip', 'title' =>'Sample Collection' ]);
								  }
							  }, 	   
                              'report' => function ($url, $model) {
                              	
								$session = Yii::$app->session;
							
                                  if($model->sample_test){
                                	return Html::a('Report',$url, [
                                        'value' => $url,
                                        'name' => 'Category Update',
                                        'title' => Yii::t('yii', 'Report'),
                                        'class' => 'btn btn-warning btn-xs gridbtncustom updatedata',
                                        'data-toggle'=> 'tooltip',
                                        'style'=>'margin-right:4px;',
                               			 ]);  	
                                  }
                               	
								 },  // ss code start 
							'print' => function ($url, $model, $key) 
								   {
                                        $options = array_merge([
                                            'class' => 'btn btn-danger btn-xs pdf gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'print'),
                                            'aria-label' => Yii::t('yii', 'print'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                            'target'=>'_blank'
                                        ]);
										  if($model->sample_test){
									    return Html::a('<span class="fa fa-print"></span>', $url, $options);
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
       
 
</script>