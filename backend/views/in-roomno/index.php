<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InRoomnoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\bootstrap\Modal;

$this->title = 'Room No Master';
$this->params['breadcrumbs'][] = $this->title;
?>


<link rel="stylesheet" type="text/css" media="screen" href="ubold/dist/css/select2.css" />
<script  src="ubold/dist/js/select2.js"></script>


<style>
.btn-right{
  float:right;	position: relative;
    top: -13px;
}
table.table.table-striped.table-bordered tbody td:last-child {
    text-align: center;
}
	.modal .modal-dialog .modal-content .modal-body {
    	padding: 0px;
	}
	button.close {
    	padding: 2px 7px;
    	background: #ff0c0c;
    	color: #fff;
    	border-radius: 27px;
	}
	
	button.close:hover {    	color: #fff;	}
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
	</div>
						
			
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-border panel-custom">
			<div class="panel-heading">
					</div>
	<div class="panel-body">  
			
<div class="in-roomno-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Room No', ['create'], ['class' => 'btn btn-success addcat btn-right']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'autoid',
            'room_no',
          // 'room_no',
             ['attribute' => 'floorname', 
            	'label' => 'Floor',
             	
            ],
            ['attribute' => 'roomtype1', 
            	'label' => 'Room',
             	
            ],
            
			
			
           // 'created_date',
            //'updated_date',
            //'user_id',
            //'user_role',
            //'ipaddress',

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
<?php 
    Modal::begin([
                    'header' => '<h3 id="operationalheader"> </h3>',
                    'id' => 'operationalmodal', 
                    'size' => 'modal-lg',

                ]);
      echo "<div id='modalContenttwo'>
            <div id='customtwo'><input type='hidden' class='data2'></div>
        </div>";
    Modal::end();

?>
<script>
    $(document).ready(function(){
	
         	$('body').on("click",".addcat",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=in-roomno/create';
             
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Room No</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false; });
     $('body').on("click",".modalView",function(){
          
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Room No</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;  });

 	  $('body').on("click",".updatedata",function(){
            
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-sitemap"></i> Update Room No</span>');
                  $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;});
            
 });
 
 
  
</script>