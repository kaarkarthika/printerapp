<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LabCategory */


$this->title = Yii::t('app', 'Create Category');
   echo $this->render('_form', [ 'model' => $model])
?>
