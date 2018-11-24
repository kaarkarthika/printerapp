<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuthUserRoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Roles';

 $session = Yii::$app->session;
// print_r($session[Yii::$app->controller->id]);
 //die;
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
  echo Html::button(' Add Role',['class' => 'btn btn-default  addrole waves-effect waves-light']);
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
              <?php Pjax::begin(['id'=>'userrole-grid']); ?>  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'tableOptions'=>['class'=>'table table-bordered table-hover'],
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','headerOptions' => ['style' => 'color:#337ab7;'],],

           // 'ur_autoid',
            'rolename',
            'rolecode',
           // 'sortorder',
           // 'timestamp',

                 ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
               'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{view}{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                              	 $session = Yii::$app->session;
								 if($session[Yii::$app->controller->id]!=""){
								 if(in_array('v', $session[Yii::$app->controller->id])) {
                              	//print_r($session[Yii::$app->controller->id]);
								
                                   
                                   // return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url,'style'=>'margin-right:4px;margin-bottom:4px;','class' => 'btn btn-primary btn-sm btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								 }}  }, 
                              'update' => function ($url, $model) {
                              	 $session = Yii::$app->session;
								 if($session[Yii::$app->controller->id]!=""){
                              	if(in_array('e', $session[Yii::$app->controller->id])) {     
                                return Html::button('<span class="fa fa-edit"></span>', [
                                        'value' => $url,
                                        'name' => 'Category Update',
                                        'title' => Yii::t('yii', 'Update'),
                                        'class' => 'btn btn-warning btn-sm btn-xs gridbtncustom updatedata',
                                        'data-toggle'=> 'tooltip',
                                        'style'=>'margin-bottom:4px;margin-right:4px;',
                                        
                                ]);                                
            					}}
								  }, 
                             
                                'delete' => function ($url, $model, $key) {
                                	 $session = Yii::$app->session;
									 if($session[Yii::$app->controller->id]!=""){
                                       if(in_array('d', $session[Yii::$app->controller->id])) {
                                       // return Html::a('<span class="fa fa-trash"></span>', $url, $options);
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url,'style'=>'margin-bottom:4px;', 'class' => 'btn btn-danger btn-sm btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
									   } } },
                          ] ],
        ],
    ]); ?><?php Pjax::end(); ?>  
</div>
</div>
</div>
</div>
</div>


<script>
    $(document).ready(function(){

         	$('body').on("click",".addrole",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=auth-user-role/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add User Role</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
         
      
     $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Role</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });

 
 	 $('body').on("click",".updatedata",function(){
             var PageUrl = $(this).attr('value');
       // $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-edit"></i>Update User Role</span>');
                 //  $('#textContent').html('<h4>Are you sure you want to <span style="color:red;">DELETE</span> this item ?</h4>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });


    });

</script>

