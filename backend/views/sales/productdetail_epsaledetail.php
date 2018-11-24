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
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

			$i = 1;
			$vendor_name = "";
			$product_data = "";
			$rows = "";
			$stockreceivedata=Stockresponse::find()->where(['stockresponseid'=>$stockresponseid])->all();
			foreach ($stockreceivedata as $k) {
			$skdata = Stockmaster::find() -> where(['stockid'=>$k->stockid]) -> one();
			if($skdata)
				{
				  $pid=$skdata->productid;
				  $product_data = Product::find() -> where(['productid' => $pid]) -> one();
				  $hsncode=$product_data->hsn_code;
				}
				
				$composition = Composition::find() -> where(['composition_id' => $product_data -> composition_id]) -> one();
				
				$taxgroupdata=Taxgrouping::find()->where(['hsncode'=>$hsncode])->one();
				$tax=$taxgroupdata->tax;
				
				
				$unitlist=ArrayHelper::map(Unit::find()->where(['unitname'=>$product_data->product_typeid])->asArray()->all(), 'unitid', 'unitvalue');
				$custommrp=($k->mrpperunit)/(1+(0.01*$tax));
            ?>
			<tr id="productrowdata<?php echo $autonumber;
				$i = $autonumber;
			?>">
 <!-- <td><?php echo $autonumber;?></td>-->
  <td><?php echo $product_data -> productname;
	echo Html::input('hidden', 'productid[]', $pid);
?></td>
  <td width="150px"><?php echo $composition -> composition_name;
	echo Html::input('hidden', 'compositionid[]', $composition -> composition_id);
 ?></td>
  <td><?php echo $skdata -> brandcode;
	echo Html::input('hidden', 'brandcode[]', $skdata -> brandcode);
 ?></td>
<td><?php echo $skdata -> stockcode;
	echo Html::input('hidden', 'stock_code[]', $skdata -> stockcode);
 ?></td>
<td><?php echo $k -> batchnumber;
	echo Html::input('hidden', 'batchnumber[]', $k -> batchnumber);
	echo Html::input('hidden', 'expiredate[]', $k -> expiredate);
 ?></td>

 <td style="width:100px;">
 <input type="number" name="productqty[]"  value="0" class="form-control productqty_ep" dataincrement="<?php echo $i; ?>" id="quantity_ep<?php echo $i; ?>" required="true" placeholder="Quantity"/>
 <input type="hidden" min="0" name="stockid[]"   value="<?php echo $k->stockid;?>"/>
 <input type="hidden" min="0" name="stockresponseid[]"  value="<?php echo $k->stockresponseid;?>" />
  <input type="hidden" min="0" name="availablestockid[]"  dataincrement="<?php echo $i;?>"  id="availablestock<?php echo $i;?>" value="<?php echo $k->total_no_of_quantity;?>" />
 </td>
 <td>
 	
 <?php   
	echo  Html::dropDownList('unitid[]', null,$unitlist,['prompt'=>'--  Unit--','required'=>'true',
          'id'=>'unitid'.$i,'dataincrement'=>$i,'class'=>'unitid form-control',
           'onchange'=>'$.get( "'.Url::toRoute('transferstock/getunitquantity').'", { id: $(this).val(),dataid:$(this).attr("dataincrement") } )
                                                        .done(function( data ) {
                                                        	 $("#unitquantity'.$i.'").val(data);
															 var rq=$("#quantity_ep'.$i.'").val();
														          var uq= $("#unitquantity'.$i.'").val();
														          var tu=rq*uq;
														          $("#totalunits'.$i.'").val(tu);
															  } );']) ;									
														
														
	?>
 	<input type="hidden" name="unitquantity[]" id="unitquantity<?php echo $i; ?>" dataincrement="<?php echo $i; ?>" value="<?php echo $unitlist -> no_of_unit; ?>"/>
 </td>
  <td>
 <input type="text" min="0" name="totalunits[]" dataincrement="<?php echo $i; ?>"  value="0" class="form-control totalunits" required="true" readonly="true" placeholder="Total Units" id="totalunits<?php echo $i; ?>"  style="text-align:right;"/>
 
 </td>
 
 
  <td>
 <input type="text" min="0" name="priceperqty[]" dataincrement="<?php echo $i; ?>" value="<?php echo $custommrp; ?>" class="form-control itemprice" required="true" placeholder="Price" id="item_price_ep<?php echo $i; ?>"  style="text-align:right;"/>
 <input type="hidden" name="dataincrement[]" value="<?php echo $i; ?>"/>
 </td>
 
 <?php if($ptype==2)
 { ?>
 	<td style="width:100px;">
 <input type="text" min="0" name="gst[]" class="form-control gstpercent" dataincrement="<?php echo $i; ?>" placeholder="GST" value="<?php echo $tax; ?>"  required="true" id="gst_ep<?php echo $i; ?>"   style="text-align:right;"/>
 </td>
 
  <td style="width:100px;">
 <input type="text" min="0" readonly="true" name="gst_value[]" class="form-control gstvalue" dataincrement="<?php echo $i; ?>"  required="true" id="gst_value<?php echo $i; ?>"   style="text-align:right;"/>

 
 </td>
<?php }

	else
	{
 ?>
 	
 <input type="hidden" min="0" name="gst[]" class="form-control gstpercent" dataincrement="<?php echo $i; ?>" value="0" placeholder="GST" value="<?php echo $tax; ?>"  required="true" id="gst_ep<?php echo $i; ?>"   style="text-align:right;"/>

 <input type="hidden" min="0" readonly="true" name="gst_value[]" class="form-control gstvalue" value="0" dataincrement="<?php echo $i; ?>"  required="true" id="gst_value<?php echo $i; ?>"   style="text-align:right;"/>

<?php } ?>
  
 <td>
 	<table><tr><td>Flat <input class="discounttype" id="discounttype<?php echo $i; ?>" name="discounttype<?php echo $i; ?>" value="flat" type="radio"></td>
 		<td>% <input class="discounttype" id="discounttype<?php echo $i; ?>" name="discounttype<?php echo $i; ?>" value="percent"  type="radio" checked="true"></td></tr>
 				
 	</table>
 </td>
 
  <td>
 <input type="text" min="0" name="discount[]"  dataincrement="<?php echo $i; ?>" placeholder="Discount" class="form-control discountpercent discount_ep" required="true" id="discount_ep<?php echo $i; ?>" value="0"  style="text-align:right;"/>
 </td>
 <td style="width:100px;">
 <input type="text" min="0" readonly="true" name="discount_value[]" class="form-control discountvalue" dataincrement="<?php echo $i; ?>"  required="true" id="discount_value<?php echo $i; ?>"   value="0" style="text-align:right;"/>
 </td>
  <td style="width:100px;">
 <input type="text" name="price[]"  placeholder="Total Price"  value="0" class="form-control price_ep" id="total_price_ep<?php echo $i; ?>" required="true" readonly="true"  style="text-align:right;"/> 
 </td>
 <td><button type='button' data-id='productrowdata<?php echo $autonumber; ?>' dataincrement="<?php echo $i;?>" class='btn btn-sm btn-icon btn-danger waves-effect waves-light deleteproduct_ep' >
 <i class="fa fa-remove"></i></button>
 </td>
 </tr>

    <?php 
	}
?>
