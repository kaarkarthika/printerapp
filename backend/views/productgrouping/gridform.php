<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\Vendor;
use backend\models\Product;
 $form = ActiveForm::begin([ 'action'=>['saveproductgroup'], 'id'=>'productgroup-form1'  ]); ?>
 
 <table id="datatable-fix-col" class="table table-striped table-bordered">
 <tr><td><b>Vendor : <?php echo $vendorname;?></b></td><td></td></tr>	
 </table>
<table id="datatable-buttons" class="table table-bordered table-striped table-hover"><thead><tr><th>#</th><th>Product</th><th>Stock Code</th><th>Brand Code</th></tr></thead>
 <tbody>
 <?php $i=1;
$productids=$productid;
$vendorid=$vendorid;
foreach ($productids as $key => $value) {
$stockcode=$stockcode+1;
$stock_code="SKC".$stockcode;
$brandcode=$brandcode+1;
$brand_code="B".$brandcode;
$product_name=Product::find()->where(['productid'=>$value])->one();
if($product_name)
{
	
?>
<tr><td ><?php echo $i;echo $form->field($model, 'vendorid')->hiddenInput(['value'=>$vendorid])->label(false);?></td>
<td><?php echo $product_name->productname.$form->field($model, 'productid[]')->hiddenInput(['value'=>$value])->label(false);?></td>
<td style="width:150px;">
<?php echo $form->field($model, 'stockcode[]')->textInput(['name'=>'stockcode'.$i,'id'=>'stockcode'.$i,'value'=>$stock_code,'readonly'=>true])->label(false);?>
</td>
<td style="width:100px;">
	<?php echo $form->field($model, 'brandcode[]')->textInput(['name'=>'brandcode'.$i,'id'=>'brandcode'.$i,'readonly'=>true,'value'=>$brand_code])->label(false);?>
	</td>   
            </tr>
		<?php	
		$i++;
		}
else{$k=1;}
		} ?>
	</tbody> </table>
     <div class="form-group pull-right" >
       <?php  echo Html::Button('Save', ['class' => 'btn btn-primary waves-effect waves-light save_productgroupform']);?>
         </div>
	 <?php   ActiveForm::end(); ?>