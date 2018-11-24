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
use backend\models\Taxgrouping;
use backend\models\Stockresponse;
use backend\models\Sales;


$vendor_name = "";
$product_name = "";
$rows = "";	
$salesdata=Saledetail::find()->where(['opsale_detailid'=>$id])->all();
$data=Sales::find()->where(['opsaleid'=>$saledata->opsaleid])->one();
$totalprice=$data->total;

if($salesdata)
{
			foreach ($salesdata as $key => $value) {
				  $pid=$value->productid;
				  $product_data = Product::find() -> where(['productid' => $pid]) -> one();
				$composition = Composition::find() -> where(['composition_id' => $value -> compositionid]) -> one();
				$unitlist = Unit::find() -> where(['unitid' => $value -> unit]) -> one();
				$tax=$value->gstrate;
            ?>
			<tr id="productrowdata<?php echo $autonumber;$i=$autonumber;?>">
 <!-- <td><?php echo $autonumber;?></td>-->
  <td><?php echo $product_data ->productname; echo Html::input('hidden', 'productid[]', $pid);?></td>
  <td><?php echo $composition -> composition_name;echo Html::input('hidden', 'compositionid[]', $composition -> composition_id); ?></td>
  <td><?php echo $value->brandcode; echo Html::input('hidden', 'brandcode[]', $value->brandcode); ?></td>
<td><?php echo $value->stock_code; echo Html::input('hidden', 'stock_code[]', $value->stock_code); ?></td>
<td><?php echo $value->batchnumber; echo Html::input('hidden', 'batchnumber[]', $value->batchnumber);echo Html::input('hidden', 'expiredate[]', $value->expiredate); ?></td>
<td style="width:150px;">
 <input type="text" name="productqty[]"  class="form-control productqty_rp" dataincrement="<?php echo $i;?>" id="quantity_rp<?php echo $i;?>" 
 value="<?php echo $value->productqty;?>" required="true" placeholder="Quantity" />
 
 <input type="hidden" name="stockid[]" value="<?php echo $value->stockid;?>" /> 
<input type="hidden" name="stockresponseid[]"   value="<?php echo $value->stockresponseid;?>"/> 
<input type="hidden" name="returndetailid[]"   value=""/> 
 
 
 </td>
 <td><?php echo $unitlist -> unitvalue; echo Html::input('hidden', 'unitid[]',  $unitlist -> unitid);
 	echo Html::input('hidden', 'saleid',  $value->opsaleid);
 	
 	?></td>
 

  <td>
 <input type="text" min="0" name="priceperqty[]"  value="<?php echo number_format($value->priceperqty,2);?>" dataincrement="<?php echo $i;?>" placeholder="Price" class="form-control itemprice" id="item_price_rp<?php echo $i;?>"   style="text-align:right;"/>
 </td>
  <td style="width:150px;">
 <input type="text" min="0" name="gst[]"  value="<?php echo $value->gstrate;?>" dataincrement="<?php echo $i;?>" class="form-control gstpercent" id="gst_rp<?php echo $i;?>"   style="text-align:right;"/>
 </td>
  <td style="width:150px;">
 <input type="text" min="0" name="gst_value[]" value="<?php echo $value->gstvalue;?>" readonly="true" dataincrement="<?php echo $i;?>" class="form-control gstvalue" id="gst_valuerp<?php echo $i;?>"   style="text-align:right;"/>
 <input type="hidden" name="dataincrement[]" value="<?php echo $i;?>"/>
 </td>
 <td>
 	<table><tr><td>Flat <input class="discounttype" id="discounttype<?php echo $i;?>" <?php if ($value>discount_type == 'flat') echo 'checked="checked"'; ?> name="discounttype<?php echo $i;?>" value="flat" type="radio" ></td>
 		<td>% <input class="discounttype" id="discounttype<?php echo $i;?>" <?php if ($value->discount_type == 'percent') echo 'checked="checked"'; ?> name="discounttype<?php echo $i;?>" value="percent"  type="radio"></td></tr>
 		
  					
 	</table>
 </td>
  <td style="width:100px;">
 <input type="text" min="0" name="discount[]" placeholder="Discount" dataincrement="<?php echo $i;?>" value="<?php echo $value->discountrate;?>" class="form-control discountpercent" id="discount_rp<?php echo $i;?>"   style="text-align:right;"/>
 </td>
  <td style="width:100px;">
 <input type="text" min="0" name="discount_value[]" placeholder="Discount Value" readonly="true" dataincrement="<?php echo $i;?>" value="<?php echo $value->discountvalue;?>" class="form-control discountvalue" id="discount_valuerp<?php echo $i;?>"   style="text-align:right;"/>
 </td>
  <td style="width:150px;">
 <input type="text" name="price[]"  placeholder="Total Price" dataincrement="<?php echo $i;?>" class="form-control price_rp" id="total_price_rp<?php echo $i;?>" value="<?php echo $value->price;?>" required="true" readonly="true" /> 
 </td>
 <td><button type='button' data-id='productrowdata<?php echo $i;?>' dataincrement="<?php echo $i;?>" class='btn btn-sm btn-icon btn-danger waves-effect waves-light deleteproduct_rp' >
 <i class="fa fa-remove"></i></button>
 </td>
   </tr>

    <?php
	
	}
	}
				
?>
