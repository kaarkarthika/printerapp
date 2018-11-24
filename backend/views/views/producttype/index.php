<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProducttypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Type';

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
                	 
                	 echo Html::button(' Add ProductType',['class' => 'btn btn-default  addproducttype waves-effect waves-light',]);
					
					 } }} ?>
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
<?php Pjax::begin(['id'=>'producttype-grid']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
          'tableOptions'=>['class'=>'table table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',  'headerOptions' => ['style' => 'color:#337ab7;']],

            'product_type',
      
                      ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
                 'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                                 $session = Yii::$app->session;
								 if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('v', $session[Yii::$app->controller->id])) {   
                                   // return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								  } }  }, 
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
                              
                                'delete' => function ($url, $model, $key) {
                                    $session = Yii::$app->session;
									if($session[Yii::$app->controller->id]!=""){
                                  if(in_array('d', $session[Yii::$app->controller->id])) {    
                                    
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
								  } }},
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

         	$('body').on("click",".addproducttype",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=producttype/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Product Type</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
            
             return false;

         });
     $('body').on("click",".modalView",function(){
     		
             var url = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>Product Type</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(url);
             return false;
         });

 	  $('body').on("click",".updatedata",function(){
             var url = $(this).attr('value');
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-edit"></i> Update Product Type</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(url);
             return false;

         });
    });

</script>

