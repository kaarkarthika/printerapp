<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


$this->title = Yii::t('app', 'Manufacturer Masters');
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
 	
 echo Html::button(' Add Manufacturer',['class' => 'btn btn-default  waves-effect waves-light addmanufacturer']);
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
<?php Pjax::begin(['id'=>'manufacturer-grid']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'tableOptions'=>['class'=>'table table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',  'headerOptions' => ['style' => 'color:#337ab7;']],

            ['attribute' => 'manufacturer_name', 'format'=>'raw', 'value' => function($model){return ucfirst($model->manufacturer_name);}],
             ['attribute' => 'manufacturer_description', 'format'=>'raw', 'value' => function($model){return ucfirst($model->manufacturer_description);}],
            ['attribute' => 'is_active', 'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {	return "Yes";  }
							    else{  	return "No"; }
							 
                        }],
        
         
          

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

















<!--<div class="manufacturermaster-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Manufacturermaster'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'manufacturer_name',
            'manufacturer_description',
            'is_active',
            'updatedby',
            // 'updatedon',
            // 'updated_ipaddress',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>-->
<script>
    $(document).ready(function(){

         	$('body').on("click",".addmanufacturer",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=manufacturermaster/create';
             
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i> Manufacturer</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false(); });
     $('body').on("click",".modalView",function(){
          
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Manufacturer</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false();  });

 	  $('body').on("click",".updatedata",function(){
            
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-sitemap"></i> Manufacturer</span>');
                  $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false();});
            
 });
</script>