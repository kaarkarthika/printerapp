<?php
use yii\helpers\Html;
$this->title = Yii::t('app', 'Create Invoice');
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
    ]) ?>
</div>