<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TestgroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Testgroups';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
	.modal .modal-dialog .modal-content .modal-body {
    	padding: 0px;
	}
	
	.category-pannel.row {    	padding: 5px 0;	}
	.section-cat{		margin-bottom: 25px;	}
</style>
<div class="container">
<div class="row">
<div class="col-sm-6">
	<h4 class="page-title"> <?= Html::encode($this->title) ?></h4> 	</div>
		<div class="col-sm-6" >
								<ol class="breadcrumb" style="float:right">
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
<div class="testgroup-index">

    
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php  echo $this->render('_form', ['model' => $searchModel,'testingmodel' => $testingmodel, 'testlist' => $testlist,'testgrouplist'=>$testgrouplist ]); ?>
    <?=  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'autoid',
            'testgroupname',
             ['attribute' => 'test_name', 
            	'label' => 'Test Name ',
             	],
             	 'price',
            
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

         $('body').on("click",".modalView",function(){
     		
             var url = $(this).attr('value');
             
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View TestGroup</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(url);
             return false;
         });
          $('body').on("click",".updatedata",function(){
             var url = $(this).attr('value');
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-edit"></i> Update TestGroup</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(url);
             return false;

         });
	</script>