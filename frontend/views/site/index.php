<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Tansi';
?>
<div class="site-index">
	<?php echo "Hai";die;?>

    <div class="jumbotron">
        <center> <span class="logo-mini"><img src=<?= Url::to('@web/backend/web/images/Tansi_Honda_Logo1.png') ?> width="300px" height="50px"> </span> 
             <div style="padding-top:30px">
        	 <p><a class="btn btn-lg btn-primary"  href='<?= Url::base().'/backend/web'; ?>'>Go to Reconcile Admin Portal</a></p>
			</div>
        </center>

           </div>


</div>
