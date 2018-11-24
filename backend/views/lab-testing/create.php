<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LabTesting */

$this->title = 'Add Test Master';
$this->params['breadcrumbs'][] = ['label' => 'Lab Testings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-testing-create">
<div class="">
<div class="col-sm-6">
	<h4 class="page-title"> <?= Html::encode($this->title) ?></h4><ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
								</ol> 	</div>
		<div class="col-sm-6" >
								
							</div>
						</div>
	
  <div class="col-sm-12 ">
	<div class=" ">
		<div class="panel panel-border panel-custom">
			<div class="panel-heading">
					</div>
	<div class="panel-body">  

    <?= $this->render('_form',[
'model' => $searchModel, 
'catmodel'=>$catmodel, 
'subcatmodel' => $subcatmodel,
'unitmodel'=>$unitmodel,
'unitlist'=>$unitlist, 
'catgorylist' => $catgorylist,
'subcatgorylist' => $subcatgorylist,
'tax_grouping'=>$tax_grouping
]) ?>

</div>
</div>
</div>
</div>
