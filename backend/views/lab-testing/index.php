<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LabTestingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Test Master'; 
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.btn-right {
    float: right;
    position: relative;
    top: 20px;
    background-color: #4682b4 !important;
    border: 1px solid #4682b4 !important;
}
	.modal .modal-dialog .modal-content .modal-body {
    	/* padding: 0px; */
	}
	.panel-border .panel-body {
    	min-height: 510px !important;
	}
	a.btn.btn-warning.btn-xs.update.gridbtncustom {
    	margin-right: 4px;
	}
	.category-pannel.row {    	padding: 5px 0;	}
	.section-cat{		margin-bottom: 25px;	}
</style>
<div class="container">
<div class="row">
<div class="col-sm-6">
	<h4 class="page-title"> <?= Html::encode($this->title) ?></h4> <ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
								</ol>	</div>
		<div class="col-sm-6" >
								<?= Html::a('Add New', ['create'], ['class' => 'btn btn-default btn-right']) ?> 
							</div>
						</div>
	
						
			
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-border panel-custom">
			<div class="panel-heading">
					</div>
	<div class="panel-body" style="min-height:510px;">  
			
<div class="lab-testing-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <p style="float:right;position: relative;top:-10px;">           </p> 

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'test_name',
             ['attribute' => 'shortcode', 
            	'label' => 'Test Code',
            	'value'=> function($model)
				{
						if($model->shortcode==""){
							return "-";	
						}else{
							return $model->shortcode;
						}
				}
             	], 
             	
             ['attribute' => 'category_name', 
            	'label' => 'Category',
             ],
             
            ['attribute' => 'unit_name', 
            	'label' => 'Unit ',
             	
            ],
             ['attribute' => 'hsncode', 
            	'label' => 'HSN Code ',
            ],
            ['attribute' => 'price', 
            	'label' => 'Price',
            ], 
            //'referencevalue',
            //'isactive',
            //'created_at',
            //'created_date',
            //'updated_date',
            //'updated_at',

           // ['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
                 'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{view}{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                               
                                   // return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
								}, 
                             'update' => function ($url, $model, $key) {
                                        $options = array_merge([
                                            'class' => 'btn btn-warning btn-xs update gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Update'),
                                            'aria-label' => Yii::t('yii', 'Update'),
                                            'data-pjax' => '0',
                                        ]);
                                        return Html::a('<span class="fa fa-edit"></span>', $url, $options);
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

         $('body').on("click",".modalView",function(){
     		
             var url = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i> View Test Master</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(url);
             return false;
         });
           $('body').on("click",".updatedata",function(){
              var url = $(this).attr('value');
             // var id= <?php echo $autoid; ?>
               alert(url); 
               $.ajax({
        			url: url,
        		});
            // $('#operationalheader').html('<span> <i class="fa fa-fw fa-edit"></i> Update Category</span>');
             // $('#operationalmodal').modal('show').find('#modalContenttwo').load(url);
             // return false;
			// 
          });
	</script>