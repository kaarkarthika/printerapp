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
								<?php 
								  $visible=0;
								  $session = Yii::$app->session;
								   if($session[Yii::$app->controller->id]!=""){
                			  
								  if(in_array('et', $session[Yii::$app->controller->id])) {
                                 	?>	
                                  	<div class="col-md-10">						
                                  		 <?php  echo Html::a('<i class="fa fa-file-excel-o"></i> Export Products ', ['composition/excelexportproducts'], ['class' => 'btn btn-default btn-sm pull-right']); ?>
    
</div>
									
                                       <div class="col-md-2">		
                                       	 <?php  echo Html::a('<i class="fa fa-file-excel-o"></i> Export All ', ['composition/excelexport'], ['class' => 'btn btn-default btn-sm pull-right']); ?>				
    
</div>
<?php }
						    } ?>
<div class="clearfix"></div>
<?php 
 Pjax::begin(['id'=>'composition-grid']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'tableOptions'=>['class'=>'table table-striped table-hover'],
        'columns' => [
        
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
				        	if(data=="Y")
				        	{
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