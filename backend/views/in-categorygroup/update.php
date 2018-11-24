<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InCategorygroup */

$this->title = 'Update Category Group';
$this->params['breadcrumbs'][] = ['label' => 'In Categorygroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<style>
.btn-right{
  float:right;	position: relative;
    top: -13px;
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
	.in-categorygroup-update table#list1 {
    display: block;
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
<div class="in-categorygroup-update">


    <?= $this->render('_form', [
        'model' => $model,
         'tax_grouping' => $tax_grouping,
            'category_list' =>$category_list,
            'roomtype_list'=>$roomtype_list,
            'cat_ref'=>$cat_ref,
            'room_typeval'=>$room_typeval,
    ]) ?>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
