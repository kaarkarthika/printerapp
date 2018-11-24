<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;
use backend\models\Physicianmaster;
use backend\models\SubVisit;
use backend\models\Specialistdoctor;
use backend\models\Patienttype;
use backend\models\Newpatient;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\NewpatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Patients';
$this->params['breadcrumbs'][] = $this->title;


?>
<style>

</style>
<div class="container">
<div class="row">
<div class="col-sm-12">
	 <div class="btn-group pull-right m-t-15">
	<?= Html::a('Sub-Visit', ['sub-visit-new'], ['class' => 'btn btn-primary']) ?>
	</div>
 <div class="btn-group pull-right m-t-15">
  	
  	
    <?= Html::a('Add New Patients', ['createshort'], ['class' => 'btn btn-success','style'=>'margin-right: 10px;']) ?>
 
</div>
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

</div>


<div class="newpatient-index"-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

       		/* [
            'attribute'=>'create_at', 
            'width'=>'310px',
            'value'=>function ($model) { 
                 return date('d-m-Y',strtotime($model->create_at));
            },
            'group'=>true, 
            'groupedRow'=>true,                    // move grouped column to a single grouped row
            'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
            'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
           
           
        ],*/
            
			['attribute' => 'mr_no', 
            	'label' => 'MR No',
             	'value'=> function($model)
				{
					if($model->mr_no!=''){
					return $model->mr_no;
					}else{
						return '-';
					}
				}
             	],
            
			['attribute' => 'patientname', 
            	'label' => 'Patient Name',
             	'value'=> function($model)
				{
					if($model->patientname!=''){
					return $model->patientname;
					}else{
						return '-';
					}
				}
             	],
			
           
			  ['attribute' => 'pat_mobileno', 
            	'label' => 'Mobile No',
             	'value'=> function($model)
				{
					if($model->pat_mobileno!=''){
					return $model->pat_mobileno;
					}else{
						return '-';
					}
				}
             	],
             	
				
				 ['attribute' => 'doctor_name', 
            	'label' => 'Last Patient Type',
             	'value'=> function($model)
				{
					if($model->mr_no!='')
					{
						$subvisit_last_date = SubVisit::find()->where(['mr_number'=>$model->mr_no])->orderBy(['sub_id'=>SORT_DESC])->asArray()->one();
						$patient_type_id=$subvisit_last_date['patient_type'];
						$patient_type=Patienttype::find()->where(['is_active'=>1])->andWhere(['type_id'=>$patient_type_id])->asArray()->one();
						return $patient_type['patient_type'];
						
					}else
					{
						return '-';
					}
				}
             	],
            
          
             	
				 ['attribute' => 'doctor_name', 
            	'label' => 'Gender/Age',
             	'value'=> function($model)
				{
					if($model->pat_sex!='' && $model->pat_age!='')
					{
						$dob_date=new Newpatient();
						$get_dob= $dob_date->Getage($model->dob);
						return $model->pat_sex.'/'.$get_dob;
					}else
					{
						return '-';
					}
				}
             	],
				
				    ['attribute' => 'doctor_name', 
            	'label' => 'Last Consulting Doctor',
             	'value'=> function($model)
				{
					if($model->mr_no!='')
					{
						$subvisit_last_date = SubVisit::find()->where(['mr_number'=>$model->mr_no])->orderBy(['sub_id'=>SORT_DESC])->asArray()->one();
						$consulted_id=$subvisit_last_date['consultant_doctor'];
						$pysican_doctor=Physicianmaster::find()->where(['is_active'=>1])->andWhere(['id'=>$consulted_id])->asArray()->one();
						$specialist=Specialistdoctor::find()->where(['is_active'=>1])->andWhere(['s_id'=>$subvisit_last_date['patient_type']])->asArray()->one();
						return $pysican_doctor['qualification'].' '.$pysican_doctor['physician_name'].'/'.date('d-m-Y h:i A',strtotime($subvisit_last_date['created_at']));
						
					}else
					{
						return '-';
					}
				}
             	],           	
				

            ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
              'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{view}{update}{sub-visit}{pdf}{sub-visit-report}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                  $session = Yii::$app->session;
								  if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) {  
                                   // return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  } }}, 
                               'update' => function ($url, $model, $key) {
                              	//print_r($url);die;
                                        $options = array_merge([
                                            'class' => 'btn btn-warning btn-xs update gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Update'),
                                            'aria-label' => Yii::t('yii', 'Update'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                        ]);
                                        return Html::a('<span class="fa fa-edit"></span>', $url, $options);
                                    },
                                    
									
									'sub-visit' => function ($url, $model, $key) {
                              	
                                        $options = array_merge([
                                            'class' => 'btn btn-default btn-xs update gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'SUB VISIT'),
                                            'aria-label' => Yii::t('yii', 'SUB VISIT'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                        ]);
										
										$url= Url::to(['newpatient/sub-visit', 'id' =>  urlencode(base64_encode($model -> patientid))]);
										
                                        return Html::a('<span class="fa fa-plus-square"></span>', $url, $options);
                                    },
                                    
									
								 'pdf' => function ($url, $model, $key) 
								   {
                                        $options = array_merge([
                                            'class' => 'btn btn-danger btn-xs pdf gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Report'),
                                            'aria-label' => Yii::t('yii', 'Report'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                            'target'=>'_blank'
                                        ]);
										
										$url= Url::to(['newpatient/report', 'id' =>  urlencode(base64_encode($model -> patientid))]);
										
                                        return Html::a('<span class="fa fa-print"></span>', $url, $options);
                                    },	
                                    
								'sub-visit-report' => function ($url, $model, $key) 
								{
									//$url= Url::to(['newpatient/sub-visit-report', 'id' =>  urlencode(base64_encode($model -> patientid))]);
                                  	$id=urlencode(base64_encode($model -> patientid));
                                  	return Html::button('<i class="fa fa-money"></i>', ['onclick'=>'SubVisitReport(this.value);','value' => $id, 'style'=>'margin-right:4px;','class' => 'btn btn-info btn-xs view view gridbtncustom modalSubVisit', 'data-toggle'=>'tooltip', 'title' =>'Sub-Visit Report' ]);
								},
                             
                                'delete' => function ($url, $model, $key) {
                                       return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'class' => 'btn btn-danger btn-sm btn-xs delete gridbtncustom', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
									  
									     },
                          ] ],
                          
						  
						  
        ],
        
		'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="fa fa-bed"></i> Manage Patients</h3>',
        'type'=>'success',
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        
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
    
    <?php 
    Modal::begin([
                    'header' => '<h3 id="operationalheader_large"><span> <i class="fa fa-fw fa-th-large"></i>Visiting details</span> </h3>',
                    'id' => 'operationalmodal_large', 
                    'size' => 'modal-lg',

                ]);
				
				
      echo "<div id='modalContenttwo_large'>
            <div id='customtwo_large'>
            
            </div>
        </div>";
    Modal::end();

?>
</div></div>
<script>
    $(document).ready(function(){

         	$('body').on("click",".addcompany",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=company/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Company</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });
         
         
      


     $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>Patient details</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });

	
 	 

	
	   $('.delete').click(function () {
 	 	var url=$(this).val();
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this module!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
            	
            	
            	 $.ajax({
        url: url,
        type: 'post',
       
        success: function (data) {
        	if(data=="Y"){
        		 $.pjax.reload({container:"#projectmodule-grid"});
        	  swal("Deleted!", "Your module has been deleted.", "success");
        	 }
        	
        	
        }
       
     });	
              
            });
        });
	

    });
	
	
	function SubVisitReport(patient_id)
	{
		if(patient_id != '')
		{
			  $.ajax({
					type: 'POST',
			        url: "<?php echo Yii::$app->homeUrl . "?r=newpatient/sub-visit-report&id=";?>"+patient_id, 
			        success: function (result) 
			        {
			        	var obj = $.parseJSON(result);
			        	$('#customtwo_large').html(obj);
			        	$modal=$('#operationalmodal_large');
			        	$('#operationalmodal_large').modal('show');
			        },
			        error: function () 
			        {
			            alert("Something went wrong");
			        }
		   	  });
		}
		
	}
</script>
 <script type="text/javascript">
  $(document).ready(function(){
$("#wrapper").addClass("enlarged");
      $("#wrapper").addClass("forced");   			
    //  $(".list-unstyled > li").removeClass("active1 active");
        $(".list-unstyled").css("display","none");
  });
</script>