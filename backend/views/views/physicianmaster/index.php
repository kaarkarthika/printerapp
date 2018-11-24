<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\Specialistdoctor;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PhysicianmasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Physician Masters');
$this->params['breadcrumbs'][] = $this->title;
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
 	
 echo Html::button(' Add Physician',['class' => 'btn btn-default waves-effect waves-light addphysician']);
 }
 } ?>
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
<?php Pjax::begin(['id'=>'physician-grid']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'tableOptions'=>['class'=>'table table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',  'headerOptions' => ['style' => 'color:#337ab7;']],

            ['attribute' => 'physician_name', 'format'=>'raw', 'value' => function($model){return ucfirst($model->physician_name);}],
            ['attribute' => 'qualification', 'format'=>'raw', 'value' => function($model){return ucfirst($model->qualification);}],
            
            
            //['attribute' => 'specialist', 'format'=>'raw', 'value' => function($model){return ucfirst($model->specialist);}],
            
              [
            'attribute'=>'specialist', 
            'width'=>'250px',
                        'value'=>function ($model, $key, $index, $widget) { 
                return $model->special->specialist;
            },
           
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Specialistdoctor::find()->asArray()->all(), 's_id', 'specialist'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'--Specialist--'],
           
        ], 
            
            
            
            
            ['attribute' => 'is_active', 'filter'=>array("1"=>Yes,"0"=>No),'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {	return "Yes";  }
							    else{  	return "No"; }
							 
                        }],
        
         
          

                      ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
             'headerOptions' => ['style' => 'color:#337ab7;'],
               'template'=>'{update}{delete}{timetable}',
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
                             
							 
							 	 'timetable' => function ($url, $model, $key) {
                              	
                                        $options = array_merge([
                                            'class' => 'btn btn-default btn-xs update gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Timetable'),
                                            'aria-label' => Yii::t('yii', 'Update'),
                                            'data-pjax' => '0',
                                            'style'=>'margin-right:4px;',
                                        ]);
										
										$url= Url::to(['physicianmaster/timetable', 'id' =>  urlencode(base64_encode($model -> id))]);
										
										
                                        return Html::a('<i class="fa fa-calendar" aria-hidden="true"></i>', $url, $options);
									  },
							 
							 
							 
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




<?php 
    Modal::begin([
                    'header' => '<h3 id="operationalheader"> </h3>',
                    'id' => 'operationalmodal', 
                    'size' => 'modal-lg',

                ]);
      echo "<div id='modalContenttwo'>
            <div id='customtwo'><input type='hidden' class='data2'></div>
        </div>";
    Modal::end();

?>













<!--<div class="physicianmaster-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Physicianmaster'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'physician_name',
            'qualification',
            'specialist',
            'is_active',
            // 'updatedby',
            // 'updatedon',
            // 'updated_ipaddress',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>-->
<script>
    $(document).ready(function(){

         	$('body').on("click",".addphysician",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=physicianmaster/create';
             
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Physician</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false; });
     $('body').on("click",".modalView",function(){
          
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Physician</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;  });

 	  $('body').on("click",".updatedata",function(){
            
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-sitemap"></i> Update Physician</span>');
                  $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;});
            
 });
</script>