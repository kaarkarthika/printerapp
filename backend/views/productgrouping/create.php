<?php
use yii\helpers\Html;
$this->title = 'Create Product Group';
?>
<div class="container">
 <div class="row">
<div class="col-sm-12">
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb"><li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li> <li><a href="#"><?php echo $this->title;?></a></li>
	
	<a class='btn btn-primary' style="float: right;" title="Back to Direct Stock" href="<?php echo Yii::$app->homeUrl . "?r=stockmaster/create";?>">Add Stock</a>
</ol>
</div>
</div>
<?= $this->render('_form', [  'model' => $model,    'productlist' => $productlist, 'vendorlist' => $vendorlist,'companylist'=>$companylist]); ?>
</div>