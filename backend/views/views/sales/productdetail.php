<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use backend\models\Vendor;
use backend\models\Product;
use backend\models\Composition;
use backend\models\Unit;
use backend\models\Stockmaster;
use backend\models\Productgrouping;
use backend\models\Saledetail;


	 $form = ActiveForm::begin();
			echo '<table id="datatable-buttons" class="table table-striped table-bordered">
             <thead>
             <tr>
             <th>S.No</th>
             <th>Product</th>
             
             <th>Composition</th>
             <th>Brandcode</th>
              <th>Stockcode</th>
             <th>Unit</th>
             <th>Quantity</th>
             <th>Price/Qty</th>
             <th>Price</th>
             
             </tr>
             </thead>
             <tbody>';

			$i = 1;
			$vendor_name = "";
			$product_name = "";
			$rows = "";
		
			foreach ($brandcode as $key => $value) {
				
				$branddata = Productgrouping::find() -> where(['brandcode'=>$value]) -> one();
				
			if($branddata)
				{
				    	
					$pid=$branddata->productid;
					
					$product_name = Product::find() -> where(['productid' => $pid]) -> one();
					
				}
				
				$composition = Composition::find() -> where(['composition_id' => $product_name -> composition_id]) -> one();
				$unitlist = Unit::find() -> where(['unitid' => $product_name -> unit]) -> one();
				$rows = Stockmaster::find() -> where(['productid' => $pid]) -> andwhere(['branch_id' => $branch]) -> andwhere(['is_active' => 1]) -> one();
            ?>
			<tr>
  <td><?php echo $i;?></td>
  <td><?php echo $product_name ->productname;echo $form -> field($model, 'productid[]')->hiddenInput(['value'=>$pid])->label(false);?></td>
  <td><?php echo $composition -> composition_name;echo $form -> field($model, 'compositionid[]') -> hiddenInput(['value' => $composition -> composition_id]) -> label(false);?></td>
    <td><?php echo $branddata->brandcode;echo $form -> field($model, 'brandcode[]')->hiddenInput(['value'=>$branddata->brandcode])->label(false);?></td>
      <td><?php echo $branddata->stock_code;echo $form -> field($model, 'stock_code[]')->hiddenInput(['value'=>$branddata->stock_code])->label(false);?></td>
  <td><?php echo $unitlist -> unitvalue; echo $form -> field($model, 'unitid[]') -> hiddenInput(['value' => $unitlist -> unitid]) -> label(false);?></td>
  <td><?php echo $form -> field($model, 'productqty[]') -> textInput(['id' => 'productqty' . $i, 'name' => 'productqty' . $i, 'class' => 'form-control productqty1', 'required' => true, 'placeholder' => 'Quantity', 'datacls1' => 'calcpricz' . $i, 'dataprice1' => $price]) -> label(false);?></td>
  <td>Rs.<?php echo $price;echo $form -> field($model, 'priceperqty[]') -> hiddenInput(['id' => 'priceperqty' . $i, 'name' => 'priceperqty' . $i,'value' => $price]) -> label(false);?></td>
  <td><?php echo $form -> field($model, 'price[]') -> textInput(['id' => 'calcpricz' . $i . '1', 'class' => 'form-control pricez1','style'=>"text-align:right;",'readonly'=>true,]) -> label(false);?></td>
 <?php echo  $form -> field($model, 'branch[]') -> hiddenInput(['id' => 'branch' . $i, 'name' => 'branch' . $i,'value' => $branch_id]) -> label(false);?>
    </tr>
    <?php
				$i++;

			} 
echo ' <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
<td style="text-align:right;">Total</td>
<td style="text-align:right;"><span id="total1">Rs.0</span><input type="hidden" id="totalprice1" name="totalprice" /></td></tbody>
		 </table>
          ';
         
		ActiveForm::end();?>
		
	