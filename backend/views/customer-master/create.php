<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CustomerMaster */

$this->title = 'Customer Master';
$this->params['breadcrumbs'][] = ['label' => 'Customer Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
   <div class="row">
<div class="col-sm-12">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<?php
  
    $session = Yii::$app->session;
    
    echo Html::a('Manage Customer Master', ['index'],['class' => 'btn btn-primary waves-effect waves-light pull-right']);
   ?>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
						</div>

    <?= $this->render('_form', [
        'model' => $model,
        'contactable' => $contactable,
        'delivery_address_master' => $delivery_address_master,
    ]) ?>

</div>
