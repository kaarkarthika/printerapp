<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LabUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unit Master';
$this->params['breadcrumbs'][] = $this->title;

?>
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
	</div>
						
			
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-border panel-custom">
			<div class="panel-heading">
					</div>
	<div class="panel-body">
<div class="lab-subcategory-index">

<div class="lab-unit-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p style="float:right;position: relative;   top: -13px;">
        <?= Html::a('Add New', ['create'], ['class' => 'btn btn-success addunit']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'unit_name', 
            	'label' => 'Unit Name',
            	],
            
             ['attribute' => 'unit_value', 
            	'label' => 'Unit Value',
            	],
             ['attribute' => 'isactive', 
            	'label' => 'Status ',
             	'value'=> function($model)
				{
					if($model->isactive!=''){
						if($model->isactive=="1"){
							return Active;	
						}else{
							return InActive;
						}
						
					}else{
						return '-';
					}
				}
             	],
            //'created_at',
            //'created_date',
            //'update_at',
            //'update_date',

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
<script>
 $('body').on("click",".addunit",function(){ 
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=lab-unit/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Unit</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });
         $('body').on("click",".modalView",function(){
     		
             var url = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>Unit</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(url);
             return false;
         });
          $('body').on("click",".updatedata",function(){
             var url = $(this).attr('value');
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-edit"></i> Update Unit</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(url);
             return false;

         });
	</script>