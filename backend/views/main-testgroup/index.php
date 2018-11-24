<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MainTestgroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Main Testgroups';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
	.modal .modal-dialog .modal-content .modal-body {
    	/* padding: 0px; */
	}
	.btn-right {
    float: right;
    position: relative;
    top: 20px;
    background-color: #4682b4 !important;
    border: 1px solid #4682b4 !important;
}
	
	.category-pannel.row {    	padding: 5px 0;	}
	.section-cat{		margin-bottom: 25px;	}
</style>
<div class="container">
<div class="row">
<div class="col-sm-6">
	<h4 class="page-title"> <?= Html::encode($this->title) ?></h4> <ol class="breadcrumb"  >
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
								</ol>	</div>
		<div class="col-sm-6" >
								 <?= Html::a('Add New', ['create'], ['class' => 'btn btn-default btn-right addcat']) ?>
							</div>
						</div>
	
						
			
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-border panel-custom">
			<div class="panel-heading">
					</div>
	<div class="panel-body">  
<div class="testgroup-index">

    
    <?php Pjax::begin(); ?>
    <p style="float:right;    position: relative;    top: -8px;">
       
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'testgroupname', 
            	'label' => 'Test Group Name ',
             	],
             	
         /*  ['attribute' => 'price', 
            	'label' => 'Price',
             	],
           
		   ['attribute' => 'hsncode', 
            	'label' => 'HSN Code',
             	],*/
            
            ['attribute' => 'price', 
            	'label' => 'Price ',
             	'value'=> function($model)
				{
						if($model->price==""){
							return "-";	
						}else{
							return $model->price;
						}
				}
             	],
             	
               ['attribute' => 'hsncode', 
            	'label' => 'HSN Code',
             	'value'=> function($model)
				{
						if($model->hsncode==""){
							return "-";	
						}else{
							return $model->hsncode;
						}
				}
             	],
             	
            ['attribute' => 'isactive', 
            	'label' => 'Active ',
             	'value'=> function($model)
				{
						if($model->isactive=="1"){
							return "Active";	
						}else{
							return "InActive";
						}
						
					
				}
             	],
            //'created_at',
            //'created_date',
            //'updated_at',
            //'updated_date',

            // ['class' => 'yii\grid\ActionColumn'],
             ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
                 'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{view}{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                               
                                   // return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', [
                                   'value' => $url, 
                                   'style'=>'margin-right:4px;',
                                   'class' => 'btn btn-primary btn-xs view view gridbtncustom modalView',
                                    'data-toggle'=>'tooltip', 'title' =>'View' ]);
								}, 
                              'update' => function ($url, $model) {
                                   
                                return Html::button('<span class="fa fa-edit"></span>', [
                                        'value' => $url,
                                        'name' => 'Category Update',
                                        'title' => Yii::t('yii', 'Update'),
                                        'class' => 'btn btn-warning btn-xs gridbtncustom updatedata',
                                        'data-toggle'=> 'tooltip',
                                        'style'=>'margin-right:4px;',
                                ]);                                
            
           }, 
                                'delete' => function ($url, $model, $key) {
                                   
                                    
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
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
</div>
</div>
<script>
 $('body').on("click",".addcat",function(){ 
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=main-testgroup/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i> Main Group Master</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });
         $('body').on("click",".modalView",function(){
     		
             var url = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Group Master</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(url);
             return false;
         });
          $('body').on("click",".updatedata",function(){
             var url = $(this).attr('value');
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-edit"></i> Main Group Master</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(url);
             return false;

         });
	</script>