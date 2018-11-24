<?php

use yii\helpers\Html;
$this->title = Yii::t('app', 'Update Return ', ['modelClass' => 'Returndetail']);
echo $this->render('_form', [
	'model' => $model,
	'id' => $id,
	'companylist'=>$companylist,
	'productlist'=>$productlist,
	'saledetailmodel'=>$saledetailmodel,
	'searchModel'=>$searchModel,
	'dataProvider'=>$dataProvider,'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,'saledata'=>$saledata,
	'unitlist'=>$unitlist,
	
	]); ?>