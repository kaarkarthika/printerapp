<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\TaxgroupingLog;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InRoomtypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Room Type Master';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.btn-right{
  float:right;	position: relative;
    top: 20px;
	background-color: #4682b4 !important;
    border: 1px solid #4682b4 !important;
}

	.modal .modal-dialog .modal-content .modal-body {
    	/* padding: 0px; */
	}
	button.close {
    	   /*  padding: 2px 7px 4px;
    	background: #ff0c0c;
    	color: #fff;
    	border-radius: 27px; */
	}
	
	button.close:hover {    	/* color: #fff; */	}
	.category-pannel.row {    	padding: 5px 0;	}
	.section-cat{		margin-bottom: 25px;	}
</style>
<div class="container">
<div class="row">
<div class="col-sm-6">
	<h4 class="page-title"> <?= Html::encode($this->title) ?></h4> 

      <ol class="breadcrumb" >
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
								</ol>
   
	</div>
		<div class="col-sm-6" >
								 <p>
        <?= Html::a('Add Room Types', ['create'], ['class' => 'btn btn-primary addcat btn-right']) ?>
    </p>
							</div>
						</div>
	<div class="row">
	</div>
						
			
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-border panel-custom ">
			  <div class="panel-heading">
					</div>  
	<div class="panel-body">  
			
<div class="in-roomtypes-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'autoid',
         ['attribute' => 'room_types', 
            	'label' => 'Room Type',
             	
            ],
        [
            'attribute'=>'hsn_code', 
            'headerOptions' => ['style' => 'color:#337ab7;'],
             'label'=>'HSN Code',
            'width'=>'310px',
            'value'=>function ($model, $key, $index, $widget) { return $model->hsncodemaster->hsncode;},
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(TaxgroupingLog::find()->asArray()->all(), 'taxgroupid', 'hsncode'), 
            'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],
            'filterInputOptions'=>['placeholder'=>'--Search HSN--'],
        ],
         ['attribute' => 'price', 
            	'label' => 'Price',
             	
            ],
             ['attribute' => 'is_active', 'filter'=>array("1"=>'Yes',"0"=>'No'),'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {	return "Yes";  }
							    else{  	return "No"; }
							 
                        }],
            //'room_types',
            //'hsn_code',
            //'price',
          /*   ['attribute' => 'is_active', 
            	'label' => 'Status ',
             	'value'=> function($model)
				{
					if($model->is_active=="1"){
						return "Active";	
					}else{
						return "InActive";
					}
				}
             	],*/
            //'created_date',
            //'updated_date',
            //'user_id',
            //'userrole',
            //'ipaddress',

         //   ['class' => 'yii\grid\ActionColumn'],
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
<script>
 $('body').on("click",".addcat",function(){ 
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=in-roomtypes/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Room Type Master</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });
         $('body').on("click",".modalView",function(){
     		
             var url = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Room Type Master</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(url);
             return false;
         });
          $('body').on("click",".updatedata",function(){
             var url = $(this).attr('value');
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-edit"></i> Update Room Type Master</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(url);
             return false;

         });
	</script>