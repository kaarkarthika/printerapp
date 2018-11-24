<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use backend\models\Vendor;
use backend\models\Product;
use backend\models\Composition;
use backend\models\Unit;
use backend\models\Stockmaster;


	 $form = ActiveForm::begin();?>
			<table id="datatable-buttons" class="table table-striped table-bordered">
             <thead>
             <tr>
             <th>S.No</th>
             <th>Vendor</th>
             <th>Product</th>
            
             <th>Composition</th>
             <th>Unit</th>
             <th>Quantity</th>
             <th>Price/Qty</th>
             <th>Price</th>
             
             </tr>
             </thead>
             <tbody>

	<?php		
			$vendor_name = "";
			$product_name = "";
			$rows = "";
			
			foreach ($product as $key => $value) {
				$product_name = Product::find() -> where(['productid' => $value]) -> one();
				$composition = Composition::find() -> where(['composition_id' => $product_name -> composition_id]) -> one();
				$unitlist = Unit::find() -> where(['unitid' => $product_name -> unit]) -> one();
				$rows = Stockmaster::find() -> where(['productid' => $value]) -> andwhere(['branch_id' => $branch]) -> andwhere(['is_active' => 1]) -> one();
				$vendorrows = Productgrouping::find() -> where(['productid' => $value])  -> andwhere(['is_active' => 1]) -> one();
				foreach ($vendorrows as $vendorkey => $vendorvalue) {
            ?>
			<tr>
    <td><?php echo $i;?></td>
     <td><?php echo $vendorvalue -> vendorid ;
  echo $form -> field($model, 'vendorid[]') -> hiddenInput(['value' => $vendorvalue -> vendorid]) -> label(false);?></td>
  <td><?php echo $product_name -> productname ;
  echo $form -> field($model, 'productid[]') -> hiddenInput(['value' => $value]) -> label(false);?></td>
  
  
   <td><?php echo $composition -> composition_name;echo $form -> field($model, 'compositionid[]') -> hiddenInput(['value' => $composition -> composition_id]) -> label(false);?></td>
 <td><?php echo $unitlist -> unitvalue;
      echo $form -> field($model, 'unitid[]') -> hiddenInput(['value' => $unitlist -> unitid]) -> label(false);?></td>
   <td><?php echo $form -> field($model, 'productqty[]') -> textInput(['id' => 'productqty' . $i, 'name' => 'productqty' . $i, 'class' => 'form-control productqty', 'required' => true, 'placeholder' => 'Quantity', 'datacls' => 'calcprice' . $i, 'dataprice' => $rows -> priceperqty]) -> label(false);?></td>
   <td>Rs.<?php echo $rows -> priceperqty;
   	 echo $form -> field($model, 'priceperqty[]') -> hiddenInput(['id' => 'priceperqty' . $i, 'name' => 'priceperqty' . $i,'value' => $rows -> priceperqty]) -> label(false);
   	?></td>
    <td><?php echo $form -> field($model, 'price[]') -> textInput(['id' => 'calcprice' . $i . '1', 'class' => 'form-control pricez','style'=>"text-align:right;",'readonly'=>true,]) -> label(false);?>
    	</td>
    </tr>
    <?php
				$i++;

			}  
			
			
			}?>
<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
<td style="text-align:right;">Total</td>
<td style="text-align:right;"><span id="total">Rs.0</span><input type="hidden" id="totalprice" name="totalprice" /></td></tbody>
		 </table>
          </div>
         
		<?php	ActiveForm::end();?>
		
	