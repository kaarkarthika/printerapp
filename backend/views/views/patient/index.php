<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Patient');

?>
<div class="container">
   <div class="row">
<div class="col-sm-12">
 <div class="btn-group pull-right m-t-15">
  <?php
  $session = Yii::$app->session;
 if($session[Yii::$app->controller->id]!="")
 {
 if(in_array('a', $session[Yii::$app->controller->id])) 
 {
 echo Html::a(Yii::t('app', 'Add Patient'), ['create'], ['class' => 'btn btn-default  waves-effect waves-light']);
 }
 } ?>
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
						</div>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' =>['class' => 'table table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          ['attribute' => 'patient_type', 'format'=>'raw', 'value' => function($model){
                                return $model->patienttype->patient_typename;
                        },
                        
                         'filter' => Html::activeDropDownList($searchModel, 'patient_type', $patienttype,['class'=>'form-control','style'=>'width:120px;','prompt' => 'Type']),  
                        ],
           
              'medicalrecord_number',
            
            'firstname',
            'lastname',
          // ['attribute' => 'dob', 'format'=>'raw', 'value' => function($model){
                               // $dob=$model->dob;
							   // $dob=date("d-m-Y",strtotime($dob));
							   // return $dob;
                        // }],
             'age',
           
            // 'address',
            // 'gender',
            // 'emailid:email',
             'patient_mobilenumber',
            // 'guardian_name',
            // 'guardian_mobilenumber',
             'physicianname',
            // 'is_active',
            // 'updated_by',
            // 'updated_on',
            // 'updated_ipaddress',

                   ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Actions',
               'headerOptions'=>['style'=>'width:120px;'],
               'template'=>'{view}{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                 $session = Yii::$app->session;
								 if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) {   
                                   // return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  }    }}, 
                              'update' => function ($url, $model) {
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('e', $session[Yii::$app->controller->id])) {      
                                return Html::a('<span class="fa fa-edit btn btn-warning btn-xs  gridbtncustom" style="margin-right:5px;"></span>', $url,$value);
                               
            }  } }, 
                             
                                'delete' => function ($url, $model, $key) {
                                  $session = Yii::$app->session;
								  if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('d', $session[Yii::$app->controller->id])) {      
                                       // return Html::a('<span class="fa fa-trash"></span>', $url, $options);
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
                                        } } },
                          ] ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function(){

         	$('body').on("click",".addtax",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=taxmaster/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Patient</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
     $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Patient</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
         
 	  $('body').on("click",".updatedata",function(){
             var PageUrl = $(this).attr('value');
      
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-sitemap"></i> Update Tax</span>');
      
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
    });

</script>