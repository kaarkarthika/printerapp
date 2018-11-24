<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\LabSubcategory;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LabCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lab Test';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
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
			<?php  echo $this->render('_labform', ['model' => $searchModel,  'subcatmodel' => $subcatmodel,'unitmodel'=>$unitmodel,'unitlist'=>$unitlist, 'catgorylist' => $catgorylist,'subcatgorylist' => $subcatgorylist]); ?>
<div class="lab-test-index">
<div class="lab-category-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>        <?= Html::a('Create Lab Category', ['create'], ['class' => 'btn btn-success']) ?>    </p> -->



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'auto_id',
            'category_name',
            'isactive',
            'created_at',
            'created_date',
            //'update_at',
            //'update_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>
</div>
</div>
</div>
<script>
 $('body').on("click",".addcat",function(){ 
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=labmaster/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Category</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });
         $('body').on("click",".addsubcat",function(){ 
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=labmaster/subcatcreate';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Sub Category</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false;

         });
	</script>