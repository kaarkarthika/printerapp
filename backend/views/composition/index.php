<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Product;
$this->title = 'Composition';
?>
<div class="container">
	
 	<div class="row">
							<div class="col-sm-12">
                                <div class="btn-group pull-right m-t-15">
                                	
                            
                	 <?php
                	 $session = Yii::$app->session;
                	 if($session[Yii::$app->controller->id]!=""){
                	 	if($companycount==0){
                	 if(in_array('a', $session[Yii::$app->controller->id])) {
                	 
                	 echo Html::button(' Add Composition',['class' => 'btn btn-default  waves-effect waves-light addcomposition']);
					 } }} ?>
                                </div>
                                <div class="btn-group pull-right m-t-15"> 
                                <?php 
								  $visible=0;
								  $session = Yii::$app->session;
								   if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('da', $session[Yii::$app->controller->id])) {
                                  	$visible=1; 	?>	
										<form id="deleteall-form">
                                       <div class="col-md-3">						
                         <?=Html::Button('Delete All', ['class' => 'deleteall btn btn-danger waves-effect waves-light']); ?>
</div>
<?php }
								  
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
									<div class="panel-body" >
								
<div class="clearfix"></div>
<?php 
 Pjax::begin(['id'=>'composition-grid']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'tableOptions'=>['class'=>'table table-striped table-hover'],
        'columns' => [
          ['class' => '\yii\grid\CheckboxColumn','visible'=>$visible],
            ['class' => 'yii\grid\SerialColumn',  'headerOptions' => ['style' => 'color:#337ab7;']],
            'composition_name','agestart', 'age_end',
                      ['class' => 'yii\grid\ActionColumn',
               'header'=> 'No of Products',
                  'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{viewproduct}',
                            'buttons'=>['viewproduct' => function ($url, $model, $key) {
                                   $session = Yii::$app->session;
                                   return Html::button('<span class="badge badge-pink">'.Product::find()->where(['composition_id' => $model->composition_id])->count().'</span></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-success btn-xs view view gridbtncustom modalViewproducts', 'data-toggle'=>'tooltip', 'title' =>'View Products' ]);
								  }, 
                          ] ],
            ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
                  'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{view}{update}{delete}{viewproduct}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                   $session = Yii::$app->session;
								   if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) { 
                                 
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  }  }}, 
								  
								  
								  
								  
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
            
            }} }, 
                            
                                'delete' => function ($url, $model, $key) {
                                       $session = Yii::$app->session;
									   if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('d', $session[Yii::$app->controller->id])) { 
                                     
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
                                        } } },
                                
                          ] ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function(){

         	$('body').on("click",".addcomposition",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=composition/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Composition</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
         
          $('body').on("click",".modalView",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>Composition Details</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
          $('body').on("click",".modalViewproducts",function(){
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>Products Details</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
         
         
         
 
 	$('body').on("click",".updatedata",function(){
             var PageUrl = $(this).attr('value');
     $('#operationalheader').html('<span> <i class="fa fa-fw fa-edit"></i>Update Composition</span>');
     
     $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();

         });
      
 	 $('.deleteall').click(function () {
 	 	 var url = '<?php echo Yii::$app->homeUrl;?>?r=composition/bulkdelete';
 	 	  var form = $("#deleteall-form");
 var formData = form.serialize();
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this product!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
            	
            	 $.ajax({
			        url: url,
			        type: 'post',
			        data:formData,
                     success: function (data) {
				        	if(data=="Y"){
				        	  swal("Deleted!", "Selected  Composition has been deleted.", "success");
				        	  $.pjax.reload('#composition-grid');
				        	   location.reload();
				        	          }
				                             }
   					  });	
              
            });
           
        });
});
</script>