<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Vendor;
use backend\models\Product;
use backend\models\Composition;
use backend\models\Unit;
use backend\models\Stockmaster;
use backend\models\Saledetail;

	  $form = ActiveForm::begin(); ?>
<table id="datatable-buttons" class="table table-striped table-bordered">
   <thead>  <tr>
   	 <th>#</th>  
   	 <th>Product</th>
   	 <th>Composition</th> 
   	
   	  <th>Sale Quantity</th>
   	    <th>Unit</th> 
   	     <th>Total Units</th> 
   	 <th>Return Quantity</th> 
   	 <th>Price/Qty</th>  
   	 <th>Total Price</th> 
   	  </tr>   
 </thead>   <tbody> 
 	<?php
      $i=1;
		$vendor_name="";
		$product_name="";
		$rows="";
		foreach ($productid as $key => $value) {
				
		
			$product_name=Product::find()->where(['productid'=>$value])->one();
			$composition=Composition::find()->where(['composition_id'=>$product_name->composition_id])->one();
			$unitlist=Unit::find()->where(['unitid'=>$product_name->unit])->one();
			$salelist=Saledetail::find()->where(['productid'=>$value])->one();
			 $rows = Stockmaster::find()->where(['productid'=>$value])->andwhere(['branch_id'=>$branch])->andwhere(['is_active'=>1])->one();?>
<tr><td><?php echo $i;?></td>  <td><?php echo $product_name->productname;?></td>
<td><?php echo $composition->composition_name;
echo $form->field($model, 'compositionid[]')->hiddenInput(['value'=>$composition->composition_id])->label(false);?></td>
 
 <td style="text-align:right;"><?php echo $salelist->productqty;?></td>
 <td><?php echo $unitlist->unitvalue;
 echo $form->field($model, 'unitid[]')->hiddenInput(['value'=>$unitlist->unitid])->label(false);?></td>
 <td style="text-align:right;"><?php echo $form->field($model, 'productqty[]')->textInput(['name'=>'productqty'.$i,'id'=>'productqty'.$i,'required'=>true,'class'=>'form-control productqty','datacls'=>'calcprice'.$i,'dataprice'=>$rows->priceperqty])->label(false);?></td>
<td  ><?php echo $form->field($model, 'priceperqty[]')->textInput(['class'=>'form-control priceperqty','readonly'=>'true','style'=>"text-align:right;",'value'=>$rows->priceperqty,'datacls'=>'calcprice'.$i,'dataprice'=>$rows->priceperqty])->label(false);?></td>
<td style="text-align:right;"><?php echo $form->field($model, 'price[]')->textInput(['id'=>'calcprice'.$i.'1','class'=>'form-control pricez','style'=>"text-align:right;",'readonly'=>true,])->label(false);?>
	
	<input  type="hidden" id="availablestock<?php echo $i;?>" name="availablestock<?php echo $i;?>"  />
	
</td>
</tr><?php $i++;
		}
?>
<td></td><td></td><td></td><td></td><td></td><td></td>
<td style="text-align:right;" >Total</td><td style="text-align:right;"><span id="total">0</span><input  type="hidden" id="totalprice" name="totalprice" /></td>
		</tbody> 
		</table>

	  <?php  ActiveForm::end(); ?>
