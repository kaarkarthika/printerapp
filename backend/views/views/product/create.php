<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
   <div class="row">
<div class="col-sm-12">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
						</div>
  

    <?= $this->render('_form', [
        'model' => $model,
        'items'=>$items,
        'composition'=>$composition,
        'product_max'=>$product_max,
         'unit'=>$unit,
          'manufacturerlist'=>$manufacturerlist,
          'page'=>$page,
          'perpage'=>$perpage,
          'taxgrouping'=>$taxgrouping,
    ]) ?>


</div>