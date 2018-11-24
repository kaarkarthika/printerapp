<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\SwimAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use backend\models\SwimBranchAdmin;
//AppAsset::register($this);
SwimAsset::register($this);
$this->title = 'SWiM | Branch';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .main-page{
        width:100%;
        float:left;
        padding-top:15em;
        }
        .abnasa {
        border-right: 1px solid;
        height: 180px;
        }
       .abnasainfo h2
       {

       font-size:20px;
       color:#000;
      
       }
       .abnasainfo h4{
       font-size:15px;
       padding-bottom:3em;
       color:#595959;
       
       }
       .bg{
  background-image: url('<?= Url::to('@web/frontend/web/images/bg.png') ?>');
  background-repeat: no-repeat;
  padding: 50px;
  width:100%;
  margin-top:-93px;
  height: 100%;
}
        </style>
        <script type="text/javascript" src="<?= Url::to('@web/frontend/web/nasastyles/js/jquery.min.js') ?>"></script>
</head>
<body>
<?php $this->beginBody() ?>
<?= $this->render('frontheader', [
        //'model' => $model,
    ]) ?>

     <?=  $content ?>  
   <?= $this->render('frontfooter', [
        //'model' => $model,
    ]) ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
