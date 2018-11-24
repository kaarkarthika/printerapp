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
 
 
 <input type="hidden" name="availablestock[]"  class="form-control productqty_as" dataincrement="<?php echo $i;?>" id="availablestock<?php echo $i;?>" 
 value="<?php echo $value->productqty;?>"  />
 
 <input type="hidden" name="stockid[]" value="<?php echo $value->stockid;?>" /> 
<input type="hidden" name="stockresponseid[]"   value="<?php echo $value->stockresponseid;?>"/> 
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
 <input type="hidden" name="dataincrement[]" value="<?php echo $i;?>"/>
 
 </td>
 <td><button type='button' data-id='productrowdata<?php echo $i;?>' dataincrement="<?php echo $i;?>" class='btn btn-sm btn-icon btn-danger waves-effect waves-light deleteproduct_rp' >
 <i class="fa fa-remove"></i></button>
 </td>
   </tr>

    <?php
	
	}
	}
				
?>
<script>
$(document).ready(function()
{
$(".deleteproduct_rp").click(function()
{

var inc = $(this).attr('dataincrement');
$("#buttonsubmit"+ inc).prop('disabled', false);
	var rowCount = $('#returngrid tr').length;
	

	if(rowCount<=7)
{
	   $('#return_theaddata').hide();
       $('#totalprice_rp_sgst').hide();
       $('#total_price_return').hide();
       $('#btn_return').hide();
       $('#totalprice_rp_cgst').hide();
       
}
$(this).parent().parent().remove();

var e = 0;
$('.price_rp').each(function(){e+= parseFloat(this.value) || 0;});
$("#total_return").text("Rs."+e.toFixed(2));
$("#totalprice_return").val(e).toFixed(2);
});



$(function() {

			$('body').on("input blur change", '.productqty_rp,.itemprice,.gstpercent,.discountpercent', function(e) {
				var inc = $(this).attr('dataincrement');
				var quan = $("#quantity_rp" + inc).val();
				var as = $("#availablestock" + inc).val();
				var price = $("#item_price_rp" + inc).val();
				   if(quan>as)
             {
	          	    swal({
	                title: "Are you sure?",
	                text: "Check Your Units is greater than Available Stock",
	                type: "warning",
	                showCancelButton: true,
	                confirmButtonClass: 'btn-danger',
	                confirmButtonText: "Yes",
	                closeOnConfirm: false
            });
          }
				
				
				var total = quan * price;
				var discount = $("#discount_rp" + inc).val();
				var gstpercent = $("#gst_rp" + inc).val();
				if (gstpercent == "") {
					gstvalue = 0;
				} else {
					gstvalue = ((total * gstpercent) / 100).toFixed(2);
					$("#gst_valuerp" + inc).val(gstvalue);
				}
				var discounttype = $("#returnform input[name='discounttype" + inc + "']:checked").val();
				if (discounttype == "percent") {
					var discountrate = discount / 100;
					discountvalue = (total * discountrate).toFixed(2);
				} else {
					discountvalue = discount;
				}
				var newtotal = total + parseFloat(gstvalue) - (discountvalue);
				rowtotal = newtotal.toFixed(2);
				
				$("#total_price_rp" + inc).val(rowtotal);
				$("#discount_valuerp" + inc).val(discountvalue);
				var e = 0;
				$('.price_rp').each(function() {
					e += parseFloat(this.value) || 0;
				});
				$("#total_return").text("Total Price :Rs." + e.toFixed(2));
				
				
				var totaldiscount = 0;
				$('.discountvalue').each(function() {
					totaldiscount += parseFloat(this.value) || 0;
				});
				$("#total_discountreturn").text("Total Discount: Rs." + totaldiscount.toFixed(2));

				var totalgst = 0;
				$('.gstvalue').each(function() {
					totalgst += parseFloat(this.value) || 0;
				});

				$("#totalgstrp").text("Total Gst :Rs." + totalgst.toFixed(2));
				var totalcgstrp = totalgst / 2;

				$("#totalcgstrp").text("Total CGst :Rs." + totalcgstrp.toFixed(2));
				$("#totalsgstrp").text("Total SGst :Rs." + totalcgstrp.toFixed(2));
				$("#totalprice_return").val(e).toFixed(2);
				
		

			});
		});


});
</script>
