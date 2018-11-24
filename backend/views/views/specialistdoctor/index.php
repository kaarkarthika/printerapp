<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SpecialistdoctorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Specialistdoctors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
   <div class="row">
<div class="col-sm-12">
 <div class="btn-group pull-right m-t-15">
 <?php echo Html::button('Add Specialist',['class' => 'btn btn-default waves-effect waves-light addspecial']); ?>
</div>
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
<div class="panel-body">
   <?php Pjax::begin(['id'=>'special-grid']); ?>
     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 's_id',
           // 'specialist',
             
			  ['attribute' => 'specialist', 'format'=>'raw', 'value' => function($model){return ucfirst($model->specialist);}],
			 
			 ['attribute' => 'consult_amount', 'format'=>'raw', 'value' => function($model){return ucfirst($model->consult_amount);}],
			 
			 
			 ['attribute' => 'is_active', 'filter'=>array("1"=>Yes,"0"=>No),'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {	return "Yes";  }
							    else{  	return "No"; }
							 
                        }],
            //'updated_by',
            //'updated_at',
            //'created_at',
            //'ip_address',

            ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
             'headerOptions' => ['style' => 'color:#337ab7;'],
               'template'=>'{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key)
							   {
                                 $session = Yii::$app->session;
								 if(!empty($session[Yii::$app->controller->id]) &&(in_array('v', $session[Yii::$app->controller->id])))
								 {
                                  return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', [
                                 'value' => $url,
                                  'style'=>'margin-right:4px;',
                                  'class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 
                                  'data-toggle'=>'tooltip', 
                                  'title' =>'View' ]);
								   }
							 }, 
								   
                                      'update' => function ($url, $model) {
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('e', $session[Yii::$app->controller->id])) {      
                                return Html::button('<span class="fa fa-edit"></span>', [
                                        'value' => $url,
                                        'name' => 'Category Update',
                                        'title' => Yii::t('yii', 'Update'),
                                        'class' => 'btn btn-warning btn-xs gridbtncustom updatedata',
                                        'data-toggle'=> 'tooltip',
                                        'style'=>'margin-right:4px;',
                                ]);                                
            
            } } }, 
                             
                                'delete' => function ($url, $model, $key) 
                                {
                                	$session = Yii::$app->session;
									 if(!empty($session[Yii::$app->controller->id]) && (in_array('d', $session[Yii::$app->controller->id])))
									
                                       {
                                        return Html::button('<i class="fa fa-trash"></i>', [
                                        'value' => $url, 
                                        'style'=>'margin-right:4px;',
                                        'class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 
                                        'data-toggle'=>'tooltip', 
                                        'title' =>'Delete' 
                                        ]);
                                        } 
								 },
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

         	$('body').on("click",".addspecial",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=specialistdoctor/create';
             
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Specialist</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
            
             return false; });
     $('body').on("click",".modalView",function(){
          
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Specialist</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;  });

 	  $('body').on("click",".updatedata",function(){
            
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-sitemap"></i> Update Specialist</span>');
                  $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;});
            
 });
</script>
