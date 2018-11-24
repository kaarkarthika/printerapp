<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Sales */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-view">
<style>
.modal-content {
    

    position:absolute;
    width:1400px;
    top: 50%;
    left: 50%;
    margin-left: -700px; // 1/2 width
    margin-top: -40px; // 1/2 height
   
	   
}
</style>
<?php
    echo $result_string; 
?>
</div>

	<script type="text/javascript">
    $(function () {
        $(".opsale_id").bind("click", function () 
        {
        	var data=$(this).attr('data_id');
        	var url='<?php echo Yii::$app->homeUrl . "?r=sales/create&data=";?>'+encodeURIComponent(data);
        	window.location.href = url;
        });
    });
</script>
