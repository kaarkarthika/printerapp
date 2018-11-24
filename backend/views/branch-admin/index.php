<?php


use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Users';


 $session = Yii::$app->session;

?>	
 
<div class="container">

					
						<div class="row">
							<div class="col-sm-12">
                                <div class="btn-group pull-right m-t-15">
                                	
             
                	 <?php
                	
                	 if($session[Yii::$app->controller->id]!=""){
                	 
                	 if(in_array('a', $session[Yii::$app->controller->id])) {
                	 
                	 echo Html::Button(' Add User',['class' => 'btn btn-default  addbranchadmin ']);
						 
					
					 } } ?>
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
										
									
										<?php Pjax::begin(['id'=>'branchadmin-grid']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=>['class'=>'table table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'headerOptions'=>['style'=>'color:#337ab7;']],
         

         ['attribute'=>'authUserRole',
						'label'=>'Role',
						  'value'=>'role',
						],
             'ba_name',
         
            
        ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
                 'headerOptions'=>['style'=>'width:120px;color:#337ab7;'],
               'template'=>'{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) { 
                                   // return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  }}  }, 
                              'update' => function ($url, $model) {
                              	$session = Yii::$app->session;
								if($session[Yii::$app->controller->id]!=""){
                              	if(in_array('e', $session[Yii::$app->controller->id])) {     
                                return Html::button('<span class="fa fa-edit"></span>', [
                                        'value' => $url,
                                        'name' => 'Category Update',
                                        'title' => Yii::t('yii', 'Update'),
                                        'class' => 'btn btn-warning btn-xs update gridbtncustom updatedata',
                                        'data-toggle'=> 'tooltip',
                                        'style'=>'margin-left:10px;',
                                ]);                                
            
            } }  }, 
                            
                                'delete' => function ($url, $model, $key) {
                                	$session = Yii::$app->session;
									 if($session[Yii::$app->controller->id]!=""){
                                   if(in_array('d', $session[Yii::$app->controller->id])) {    
                                       // return Html::a('<span class="fa fa-trash"></span>', $url, $options);
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-left:10px;','class' => 'btn btn-danger btn-xs modalDelete gridbtncustom', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
								   } } },
                          ] ],

    ],    
  ]);   ?>
<?php Pjax::end(); ?>

										</div>
									</div>
								</div>
							</div>
							</div>
						

 
    <script>
    $(document).ready(function(){

         	$('body').on('click', '.addbranchadmin', function() {
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=branch-admin/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i> Branch Admin</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
         
         

     $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Account</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });

 
 	$('body').on("click",".updatedata",function(){
             var PageUrl = $(this).attr('value');
       // $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-edit"></i> Branch Admin</span>');
                 //  $('#textContent').html('<h4>Are you sure you want to <span style="color:red;">DELETE</span> this item ?</h4>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
   

    });
</script>

