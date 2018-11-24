<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\HtvAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\Modal;
//AppAsset::register($this);
HtvAsset::register($this);
$this->title = 'SolnWiz';
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
        .vcenter {
            display: inline-block;
            vertical-align: middle;
            float: none;
     }
      .input-group[class*=col-]{float:left}
      .input-group-btn{padding:0}
      .dropdown-menu{min-width:705px}

    </style>
</head>
<body>
<?php $this->beginBody() ?>
<div id="main-wrapper" class="homepage-four">
<?= $this->render('solnwiz_header', [
        'model' => $model,
    ]) ?>
<?= $this->render('solnwiz_slider_banner', [
        'model' => $model,
    ]) ?>


     <?= $content ?>  
         
</div><!--/#main-wrapper--> 
    <?= $this->render('solnwiz_footer', [
        'model' => $model,
    ]) ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<!-- Success Modal -->
  <div class="modal fade" id="successmodel" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">SolnWiz Message</h4>
        </div>
        <div class="modal-body" id="alertmodalContent">
            <p align="justify" style="padding: 25px; font-size: 20px;"> </p>

            <!-- <a href="#" class="">Click here if you want to change your contact Numbers.</a> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  