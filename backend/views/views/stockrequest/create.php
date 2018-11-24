<?php
use yii\helpers\Html;
$this->title = Yii::t('app', 'Add Stock Request');
echo $this->render('_form', ['model' => $model,  'list'=>$list,'unitlist'=>$unitlist, 'companylist'=>$companylist ,'vendorbranch' =>$vendorbranch ]); 
?>