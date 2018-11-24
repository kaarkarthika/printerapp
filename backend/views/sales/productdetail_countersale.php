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
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
$vendor_name = "";
$product_name = "";
$rows = "";
 $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];

$stockreceivedata=Stockresponse::find()->where(['stockresponseid'=>$stockresponseid])->all();
$saledata=Sales::find()->where(['paid_status'=>'UnPaid'])->andwhere(['branch_id'=>$companybranchid])->all();

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
				
				$currentqty=0;
										foreach($saledata as $kk)
										{
										  $saleid=$kk->opsaleid;
										$saledetaildata=Saledetail::find()->where(['opsaleid'=>$saleid])->andwhere(['stockresponseid'=>$k->stockresponseid])->all();
											foreach($saledetaildata as $l)
											{
											$currentqty+=$l->productqty;	
										    }
										}
										$availableqty=($k->total_no_of_quantity)-$currentqty;
				
				
				
				
				
            ?>
			<tr id="productrowdata<?php echo $autonumber;$i=$autonumber;?>">
 <!-- <td><?php echo $autonumber;?></td>-->
  <td><?php echo "<b>stockname: </b>".$product_data ->productname; echo Html::input('hidden', 'productid[]', $pid);echo "<br>";
          echo "<b>Drug :</b>".$composition -> composition_name;echo Html::input('hidden', 'compositionid[]', $composition -> composition_id); echo "<br>";
      echo "<b>Brandcode : </b>".$skdata->brandcode;echo "<b>Stock Code : </b>";echo $skdata->stockcode;  echo Html::input('hidden', 'brandcode[]', $skdata->brandcode); 
echo Html::input('hidden', 'stock_code[]', $skdata->stockcode); echo "<br>";
 echo "<b>Batch Number : </b>".$k->batchnumber;    echo "<b>Avail Qty  : </b>".$availableqty;

echo Html::input('hidden', 'batchnumber[]', $k->batchnumber);echo Html::input('hidden', 'expiredate[]', $k->expiredate); ?></td>


<td style="width:150px;">
 <input type="number" name="productqty[]" value="0" class="form-control productqty_np" dataincrement="<?php echo $i;?>" id="quantity_np<?php echo $i;?>" required="true" placeholder="Quantity" />
 </td>
 <td>
 	 <?php   
	echo  Html::dropDownList('unitid[]', null,$unitlist,['prompt'=>'--  Unit--','required'=>'true',
          'id'=>'unitid'.$i,'dataincrement'=>$i,'class'=>'unitid form-control',
           'onchange'=>'$.get( "'.Url::toRoute('transferstock/getunitquantity').'", { id: $(this).val(),dataid:$(this).attr("dataincrement") } )
                                                        .done(function( data ) {
                                                        	 $("#unitquantity'.$i.'").val(data);
															 var rq=$("#quantity_np'.$i.'").val();
														          var uq= $("#unitquantity'.$i.'").val();
														          var tu=rq*uq;
														          $("#totalunits'.$i.'").val(tu);
															  } );']) ;									
														
														
	?>
 	
 	<input type="hidden" name="unitquantity[]" id="unitquantity<?php echo $i; ?>" dataincrement="<?php echo $i; ?>"/>
 </td>
  <td>
 <input type="text" min="0" name="totalunits[]" dataincrement="<?php echo $i; ?>" value="0" class="form-control totalunits" required="true" readonly="true" placeholder="Total Units" id="totalunits<?php echo $i; ?>"  style="text-align:right;"/>
 <input type="hidden" min="0" name="stockid[]"   value="<?php echo $k->stockid;?>"/>
 <input type="hidden" min="0" name="stockresponseid[]"  value="<?php echo $k->stockresponseid;?>" />
 <input type="hidden" min="0" name="availablestockid[]"  dataincrement="<?php echo $i;?>"  id="availablestock<?php echo $i;?>" value="<?php echo $availableqty;?>" />
 
 
 </td>
 
  <td>
 <input type="text" min="0" name="priceperqty[]"  value="<?php echo $custommrp;?>" dataincrement="<?php echo $i;?>" required="true" placeholder="Price" class="form-control itemprice_np" id="item_price_np<?php echo $i;?>"   style="text-align:right;"/>

<input type="hidden" min="0" name="realmrp[]"  value="<?php echo $k->mrpperunit;?>" 
 dataincrement="<?php echo $i;?>" required="true" placeholder="Price" class="form-control " id="item_price_realnp<?php echo $i;?>"   style="text-align:right;"/>

<input type="hidden" min="0" name="taxableamount[]"  
 dataincrement="<?php echo $i;?>" required="true" placeholder="Price" class="form-control " id="taxableamount<?php echo $i;?>"   style="text-align:right;"/>
 </td>
 

  <td style="width:150px;">
 <input type="text" min="0" name="gst[]" value="<?php echo $tax;?>" required="true"  dataincrement="<?php echo $i;?>" class="form-control gstpercent_np" id="gst_np<?php echo $i;?>"   style="text-align:right;"/>
 </td>
  <td style="width:100px;">
 <input type="text" min="0" readonly="true" name="gst_value[]" class="form-control gstvalue_np" dataincrement="<?php echo $i;?>"  required="true" id="gst_value_np<?php echo $i;?>"   style="text-align:right;"/>
 </td>
  <td>
 	<table><tr><td>Flat <input class="discounttype_np" id="discounttype_np<?php echo $i;?>" name="discounttype_np<?php echo $i;?>" value="flat" type="radio"></td>
 		<td>% <input class="discounttype_np" id="discounttype_np<?php echo $i;?>" name="discounttype_np<?php echo $i;?>" value="percent"  type="radio" checked="true"></td></tr>
 	</table>
 </td>
  <td style="width:100px;">
 <input type="text" name="discount[]" placeholder="Discount" class="form-control discountpercent_np" required="true" dataincrement="<?php echo $i;?>"  id="discount_np<?php echo $i;?>"  value="0" style="text-align:right;"/>
 </td>
 <td style="width:100px;">
 <input type="text"  readonly="true" name="discount_value[]" value="0" class="form-control discountvalue_np" dataincrement="<?php echo $i;?>"  required="true" id="discount_value_np<?php echo $i;?>"   style="text-align:right;"/>
 <input type="hidden" name="dataincrement[]" value="<?php echo $i;?>"/>
 </td>
  <td style="width:150px;">
 <input type="text" name="price[]"  placeholder="Total Price" required="true"  dataincrement="<?php echo $i;?>" value="0" class="form-control price_np" id="total_price_np<?php echo $i;?>" required="true" readonly="true" /> 
 </td>
 <td><button type='button' data-id='productrowdata<?php echo $i;?>' dataincrement="<?php echo $i;?>" class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light deleteproduct_np' >
 <i class="fa fa-remove"></i></button>
 </td>
   </tr>
    <?php
	}		
?>
<script>
$(document).ready(function()
{
	
$(".deleteproduct_np").click(function()
{
	var rowCount = $('#productgrid_np tr').length-4;
	if(rowCount<=5)
{
 $('#np_theaddata').hide();
 $('#totalprice_np_row').hide();
 $('#btn_np').hide();
 $('#totalprice_np_cgst').hide();
 $('#totalprice_np_sgst').hide();
 $('#ovaralltotalprice_np').hide();
 $('#totalprice_np_label').hide();
  
}
$(this).parent().parent().remove();
var inc = $(this).attr('dataincrement');
$("#btnsubmit"+ inc).prop('disabled', false);
var e = 0;
$('.price_np').each(function(){e+= parseFloat(this.value) || 0;});
var totalprice1=e.toFixed(2);
$("#total_np").text("Rs."+totalprice1);
$("#totalprice_np").val(totalprice1);
var overalldiscount = $("#overalldiscountpercent").val();
var overalldiscounttype = $("#wizard-validation-form input[name='overalldiscounttype']:checked").val();
if (overalldiscounttype == "percent") 
{
var overalldiscountrate = overalldiscount / 100;
overalldiscountvalue = (totalprice1 * overalldiscountrate).toFixed(2);
} 
else 
{
	overalldiscountvalue = overalldiscount;
}
var overalltotal = (totalprice1-(overalldiscountvalue)).toFixed(2);
$("#overalldiscountamount").val(overalldiscountvalue);
$("#overalltotal").val(overalltotal);
});


$(function() {

			$('body').on("input blur change", '.productqty_np,.totalunits,.itemprice_np,.gstpercent_np,.discountpercent_np,.overalldiscountpercent', function(e) {
				var inc = $(this).attr('dataincrement');
				var unitquantity = $("#unitquantity" + inc).val();
				var quan = $("#quantity_np" + inc).val();
				var customprice = $("#item_price_realnp" + inc).val();
				var gstpercent = $("#gst_np" + inc).val();
				mrpprice=customprice/(1+(0.01*gstpercent));				
				$("#item_price_np" + inc).val(mrpprice);
				var price = mrpprice;
				var totalunit = (quan * unitquantity);
				$("#totalunits" + inc).val(totalunit);
			      total = totalunit * price;
				$("#taxableamount" + inc).val(total);
				var discount = $("#discount_np" + inc).val();
				
				if (gstpercent == "") {
					gstvalue = 0;
				} else {
					gstvalue = ((total * gstpercent) / 100).toFixed(2);
					$("#gst_value_np" + inc).val(gstvalue);
				}
				var discounttype = $("#wizard-validation-form input[name='discounttype_np" + inc + "']:checked").val();
				if (discounttype == "percent") {
					var discountrate = discount / 100;
					discountvalue = (total * discountrate).toFixed(2);
				} else {
					discountvalue = discount;
				}
				var newtotal = total + parseFloat(gstvalue) - (discountvalue);
				rowtotal = newtotal.toFixed(2);
				$("#total_price_np" + inc).val(rowtotal);
				$("#discount_value_np" + inc).val(discountvalue);
				var e = 0;
				
				
				$('.price_np').each(function() {
					e += parseFloat(this.value) || 0;
				});
				
				
				$("#total_np").text("Total Price :Rs." + e.toFixed(2));
				var totalstock=$("#availablestock" + inc).val();
				
			
				
          if(totalunit>totalstock)
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
				
				
				var totaldiscount = 0;
				$('.discountvalue_np').each(function() {
					totaldiscount += parseFloat(this.value) || 0;
				});
				$("#totaldiscountnp").text("Total Discount: Rs." + totaldiscount.toFixed(2));

				var totalgst = 0;
				$('.gstvalue_np').each(function() {
					totalgst += parseFloat(this.value) || 0;
				});

				$("#totalgstnp").text("Rs." + totalgst.toFixed(2));
				var totalcgstnp = totalgst / 2;

				$("#totalcgstnp").text("Rs." + totalcgstnp.toFixed(2));
				$("#totalsgstnp").text("Rs." + totalcgstnp.toFixed(2));
				var totalprice1=e.toFixed(2);
				$("#totalprice_np").val(totalprice1);
				//overall calc
				
			    var overalldiscount = $("#overalldiscountpercent").val();
				var overalldiscounttype = $("#wizard-validation-form input[name='overalldiscounttype']:checked").val();
				if (overalldiscounttype == "percent") 
				{
					var overalldiscountrate = overalldiscount / 100;
					overalldiscountvalue = (totalprice1 * overalldiscountrate).toFixed(2);
				} 
				else 
				{
					overalldiscountvalue = overalldiscount;
				}
				var overalltotal = (totalprice1-(overalldiscountvalue)).toFixed(2);
				rowtotal = newtotal.toFixed(2);
				$("#total_price_np" + inc).val(rowtotal);
				$("#discount_value_np" + inc).val(discountvalue);
				$("#overalldiscountamount").val(overalldiscountvalue);
				$("#overalltotal").val(overalltotal);
			});
		});

	});
</script>