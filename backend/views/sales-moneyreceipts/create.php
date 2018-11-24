<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SalesMoneyreceipts */

$this->title = 'Create Sales Moneyreceipts';
$this->params['breadcrumbs'][] = ['label' => 'Sales Moneyreceipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.btn-right{
  float:right;	position: relative;
    top: -13px;
}

	.modal .modal-dialog .modal-content .modal-body {
    	/* padding: 0px; */
	}
	button.close {
    	padding: 2px 7px;
    	background: #ff0c0c;
    	color: #fff;
    	border-radius: 27px;
	}
	
	button.close:hover {    	color: #fff;	}
	.category-pannel.row {    	padding: 5px 0;	}
	.section-cat{		margin-bottom: 25px;	}
</style>
<div class="container">
	<div class="panel panel-border panel-custom">
			<div class="panel-heading">
					</div>
	<div class="panel-body">
<div class="sales-moneyreceipts-create">

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>
</div>