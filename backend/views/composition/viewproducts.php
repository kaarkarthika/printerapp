<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Product;
use backend\models\Manufacturermaster;
use backend\models\Composition;
$productdata=Product::find()->where(['composition_id'=>$model->composition_id])->all();
$cdata=Composition::find()->where(['composition_id'=>$model->composition_id])->one();
echo ' <table class="table table-bordered"><thead><tr><th>#</th>	<th>Product </th><th>Manufacture</th></tr></thead><tbody>';
  $i=1;
	foreach ($productdata as $key => $value)
{
	$pname=$value->productname;
	$pid=$value->productid;
	$productgroupdata=Product::find()->select(['manufacturer_id'])->distinct()->where(['productid'=>$pid])->all();
	if($productgroupdata)
	{
	foreach($productgroupdata as $k)
	{
	$mid=$k->manufacturer_id;
	$mdata=Manufacturermaster::find()->where(['id'=>$mid])->one();
	$mname=$mdata->manufacturer_name;
	if(!empty($mname)){$manuname=$mname;}
	else{$manuname="Not Declared";}													
     echo "<tr><td>".$i."</td><td>".$pname."</td><td>".$manuname."</td>  </tr>";
     ++$i;
    } 
   }
 else{ echo " <tr><td>".$i."</td><td>".$pname."</td><td>----</td>  </tr>"; }
   } ?>
<tr><td colspan="3"><?php  echo Html::a('<i class="fa fa-file-excel-o"></i> Export Excel ', ['composition/exceldownload','id'=>$model->composition_id,'name'=>$cdata->composition_name], ['class' => 'btn btn-primary btn-sm pull-right']); ?></td></tr>

<?php
echo '</tbody></table>';