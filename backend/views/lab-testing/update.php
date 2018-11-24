<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LabTesting */

$this->title = 'Update Test Master';
$this->params['breadcrumbs'][] = ['label' => 'Lab Testings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
//echo"<pre>";print_r($mulmodel); die;
?>
<div class="lab-testing-create">
<div class="row">
<div class="col-sm-6">
	<h4 class="page-title"> <?= Html::encode($this->title) ?></h4> <ol class="breadcrumb"  >
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
								</ol>	</div>
		<div class="col-sm-6" >
								
							</div>
						</div>
	
  <div class="row">
	<div class="col-sm-12">
		<div class="panel panel-border panel-custom">
			<div class="panel-heading">
					</div>
	<div class="panel-body">  
<div class="lab-testing-update">
	
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?= $this->render('_form', [
       'model' => $model,
			            'catgorylist' => $catgorylist,
			            'subcatgorylist'=>$subcatgorylist,
			            'catmodel'=>$catmodel,
			            'subcatmodel' => $subcatmodel,
			            'unitmodel'=>$unitmodel,
			            'unitlist'=>$unitlist,
			            'tax_grouping'=>$tax_grouping,
			            'refmodel' => $refmodel,
			               'mulmodel' => $mulmodel,
    ]) ?>

</div>
</div>
</div>
</div>
</div>
