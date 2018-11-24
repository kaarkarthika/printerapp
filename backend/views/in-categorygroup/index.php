<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InCategorygroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Category Group';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.btn-right{
  float:right;	position: relative;
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
	<h4 class="page-title"> <?= Html::encode($this->title) ?></h4> <ol class="breadcrumb" >
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
								</ol>	</div>
		<div class="col-sm-6" >
					<p>
        <?= Html::a('Mange Category Group', ['create'], ['class' => 'btn btn-default addcat btn-right']) ?>
    </p>			
							</div>
						</div>
	<div class="row">
	</div>
						
			
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-border panel-custom">
			<div class="panel-heading">
					</div>
	<div class="panel-body">  
<div class="in-categorygroup-index">

  
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'autoid',
          ['attribute' => 'categoryname', 
            	'label' => 'Category Name',
            ],
             ['attribute' => 'roomtypename', 
            	'label' => 'Room Type',
            ],
            ['attribute' => 'total', 
            	'label' => 'Total',
            ],
            ['attribute' => 'is_active', 'filter'=>array("1"=>'Yes',"0"=>'No'),'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {	return "Yes";  }
							    else{  	return "No"; }
							 
            }],
          //  'category_id',
          //  'room_typeid',
          //  'total',
           // 'is_active',
            //'created_date',
            //'updated_date',
            //'user_id',
            //'user_role',
            //'ipaddress',

         //  ['class' => 'yii\grid\ActionColumn'],
          ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
             'headerOptions' => ['style' => 'color:#337ab7;'],
               'template'=>'{view}{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key)
							   {
                                
                                  return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', [
                                 'value' => $url,
                                  'style'=>'margin-right:4px;',
                                  'class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 
                                  'data-toggle'=>'tooltip', 
                                  'title' =>'View' ]);
								  
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
                             
							    'delete' => function ($url, $model, $key) 
                                {
                                	$session = Yii::$app->session;
									
                                        return Html::button('<i class="fa fa-trash"></i>', [
                                        'value' => $url, 
                                        'style'=>'margin-right:4px;',
                                        'class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 
                                        'data-toggle'=>'tooltip', 
                                        'title' =>'Delete' 
                                        ]);
                                        
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
    $(document).ready(function(){

         	
     $('body').on("click",".modalView",function(){
          
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i> View Category Group Master </span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;  });

 	
 });
</script>