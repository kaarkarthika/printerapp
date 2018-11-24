<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\InFloormasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\bootstrap\Modal;

$this->title = 'Floor Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.btn-right{
  float:right;	position: relative;
    top: 20px;
	background-color: #4682b4 !important;
    border: 1px solid #4682b4 !important;
}
table.table.table-striped.table-bordered tbody td:last-child {
    text-align: center;
}
	.modal .modal-dialog .modal-content .modal-body {
    	/* padding: 0px; */
	}
	button.close {
    	/* padding: 2px 7px;
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
<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
								</ol>	</div>
								
								
								
		<div class="col-sm-6" >
						 
        <?= Html::a('Add Floor Master', ['create'], ['class' => 'btn btn-default addcat btn-right']) ?>
    		
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
			
<div class="lab-test-index">
<div class="in-floormaster-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
<?php Pjax::begin(['id'=>'floor-grid']); ?>   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'autoid',
            'floor_no',
          //  'is_active',
            
			  ['attribute' => 'is_active', 'filter'=>array("1"=>'Yes',"0"=>'No'),'format'=>'raw', 'value' => function($model){
                               if($model->is_active==1)
							   {	return "Yes";  }
							    else{  	return "No"; }
							 
                        }],
            //'created_date',
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
            
           },         'delete' => function ($url, $model, $key) 
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

<?php 
    Modal::begin([
                    'header' => '<h4 id="operationalheader"> </h4>',
                    'id' => 'operationalmodal', 
                    'size' => 'modal-md',

                ]);
      echo "<div id='modalContenttwo'>
            <div id='customtwo'><input type='hidden' class='data2'></div>
        </div>";
    Modal::end();

?>
<script>
    $(document).ready(function(){

         	$('body').on("click",".addcat",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=in-floormaster/create';
             
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Floor</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false; });
     $('body').on("click",".modalView",function(){
          
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Floor</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;  });

 	  $('body').on("click",".updatedata",function(){
            
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-sitemap"></i> Update Floor</span>');
                  $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false;});
            
 });
</script>