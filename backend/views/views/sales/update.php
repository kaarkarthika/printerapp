<?php
use yii\helpers\Html;
$this->title = 'Update Sales';
?>
<section class="content-header">
 <h1> <?= Html::encode($this->title) ?> </h1>
<ol class="breadcrumb"><li><a href="<?php echo Yii::$app->request->BaseUrl;?>"><i class="fa fa-dashboard"></i>Home</a></li><li><a href="#"><?php echo $this->title;?></a></li></ol>
</section> 
    <?= $this->render('_form', [ 'model' => $model ]) ?>