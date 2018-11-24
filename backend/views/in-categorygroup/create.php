<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InCategorygroup */

$this->title = 'Add  Category Group';
$this->params['breadcrumbs'][] = ['label' => 'Category Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
<div class="in-categorygroup-create">

   
    <?= $this->render('_form', [
        'model' => $model,
        'tax_grouping' => $tax_grouping,
        'category_list' =>$category_list,
        'roomtype_list' => $roomtype_list,
    ]) ?>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
