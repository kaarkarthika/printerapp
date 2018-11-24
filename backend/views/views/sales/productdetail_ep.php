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
use backend\models\Sales;

			$i = 1;
			$vendor_name = "";
			$product_data = "";
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
				if(count($taxgroupdata)>0)
				{
					$tax=$taxgroupdata->tax;
				}
				else {
					$tax=0;
				}
				
				
				$unitlist=ArrayHelper::map(Unit::find()->where(['unitname'=>$product_data->product_typeid])->asArray()->all(), 'unitid', 'unitvalue');
			
				if(($k->mrpperunit)>0)
				{
					$custommrp=($k->mrpperunit)/(1+(0.01*$tax));
				}
				else {
					$custommrp=0;
				}
				
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
			<tr id="productrowdata<?php echo $autonumber;
				$i = $autonumber;
			?>">
 <!-- <td><?php echo $autonumber;?></td>-->
  <td><?php echo $product_data -> productname; echo "<BR>"; echo "--------------------------"; echo "<br>";
  $text_line = $composition -> composition_name;
$text_line = explode(",",$text_line);
  
   

for ($start=0; $start < count($text_line); $start++) {echo $text_line[$start]."</br>";
	}  
  
	echo Html::input('hidden', 'productid[]', $pid);

	echo Html::input('hidden', 'compositionid[]', $composition -> composition_id);
 ?></td>
  <td><?php echo $skdata -> brandcode."<br>";echo "---------";echo "<br>";echo $skdata -> stockcode;
	echo Html::input('hidden', 'brandcode[]', $skdata -> brandcode);
    echo Html::input('hidden', 'stock_code[]', $skdata -> stockcode);
 ?></td>
<td><?php echo $k -> batchnumber."<br>--------<br>".$availableqty;
	echo Html::input('hidden', 'batchnumber[]', $k -> batchnumber);
	echo Html::input('hidden', 'expiredate[]', $k -> expiredate);
 ?></td>
 

 <td >
 <input type="text" name="productqty[]"  value="0" class="form-control productqty_ep" dataincrement="<?php echo $i; ?>" id="quantity_ep<?php echo $i; ?>" required="true" placeholder="Quantity"/>
 <input type="hidden" min="0" name="stockid[]"   value="<?php echo $k->stockid;?>"/>
 <input type="hidden" min="0" name="stockresponseid[]"  value="<?php echo $k->stockresponseid;?>" />
  <input type="hidden" min="0" name="availablestockid[]"  dataincrement="<?php echo $i;?>"  id="availablestock<?php echo $i;?>" value="<?php echo $availableqty;?>" />
 </td>
 <td>
 	
 <?php   
 //print_r($unitlist);die;
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
 <input type="text"  name="totalunits[]" dataincrement="<?php echo $i; ?>"  value="0" class="form-control totalunits" required="true" readonly="true" placeholder="Total Units" id="totalunits<?php echo $i; ?>"  style="text-align:right;"/>
 
 </td>
 
 
  <td>
 <input type="text"  name="priceperqty[]" dataincrement="<?php echo $i; ?>" value="<?php echo number_format($custommrp,2); ?>" class="form-control itemprice" required="true" placeholder="Price" id="item_price_ep<?php echo $i; ?>"  
 style="text-align:right;"/>
 <input type="hidden" name="dataincrement[]" value="<?php echo $i; ?>"/>
 
  <input type="hidden"  name="realmrp_ep[]"  value="<?php echo $k->mrpperunit;?>" 
 dataincrement="<?php echo $i;?>" required="true" placeholder="Price" class="form-control " id="item_price_realep<?php echo $i;?>"   style="text-align:right;"/>

<input type="hidden"  name="taxableamountep[]"  
 dataincrement="<?php echo $i;?>" required="true" placeholder="Price" class="form-control " id="taxableamountep<?php echo $i;?>"   style="text-align:right;"/>
 
 </td>
 
 <?php if($ptype==2)
 { ?>
 	<td >
 <input type="text" min="0" name="gst[]" class="form-control gstpercent" dataincrement="<?php echo $i; ?>" placeholder="GST" value="<?php echo $tax; ?>"  required="true" id="gst_ep<?php echo $i; ?>"   style="text-align:right;"/>
 </td>
 
  <td>
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
 	Flat <input class="discounttype"  name="discounttype<?php echo $i; ?>" value="flat" type="radio" checked="true"><br>
 	% <input class="discounttype"  name="discounttype<?php echo $i; ?>" value="percent"  type="radio" >
 
 </td>
 
  <td>
 <input type="text" min="0" name="discount[]"  dataincrement="<?php echo $i; ?>" placeholder="Discount" class="form-control discountpercent discount_ep" required="true" id="discount_ep<?php echo $i; ?>" value="0"  style="text-align:right;"/>
 </td>
 <td >
 <input type="text" min="0" readonly="true" name="discount_value[]" class="form-control discountvalue" dataincrement="<?php echo $i; ?>"  required="true" id="discount_value<?php echo $i; ?>"   value="0" style="text-align:right;"/>
 </td>
  <td >
 <input type="text" name="price[]"  placeholder="Total Price"  value="0" class="form-control price_ep" id="total_price_ep<?php echo $i; ?>" required="true" readonly="true"  style="text-align:right;"/> 
 </td>
 <td><button type='button' data-id='productrowdata<?php echo $autonumber; ?>' dataincrement="<?php echo $i;?>" class='btn-xs btn-sm btn-icon btn-danger waves-effect waves-light deleteproduct_ep' >
 <i class="fa fa-remove"></i></button>
 </td>
 </tr>
    <?php 
	}
?>
<script>
	$(document).ready(function() {
		
			$(function() {
			$('body').on("blur input change", '.productqty_ep,.itemprice,.gstpercent,.discountpercent,.overalldiscountpercentep', function(e) 
			{
				var inc = $(this).attr('dataincrement');
				var unitquantity = $("#unitquantity" + inc).val();
				var quan = $("#quantity_ep" + inc).val();
				var customprice = $("#item_price_realep" + inc).val();
				var gstpercent = $("#gst_ep" + inc).val();
				mrpprice=customprice/(1+(0.01*gstpercent)).toFixed(2);				
				$("#item_price_ep" + inc).val(mrpprice);
				var price = mrpprice;
				var totalunit = (quan * unitquantity);
				$("#totalunits" + inc).val(totalunit);
			      total = totalunit * price;
				$("#taxableamountep" + inc).val(total);
				var discount = $("#discount_ep" + inc).val();
				if (gstpercent == "") {
					gstvalue = 0;
				} else {
					gstvalue = ((total * gstpercent) / 100).toFixed(2);
					$("#gst_value" + inc).val(gstvalue);
				}
				var discounttype = $("#wizard-validation-form1 input[name='discounttype" + inc + "']:checked").val();
				if (discounttype == "percent") {
					var discountrate = discount / 100;
					discountvalue = (total * discountrate).toFixed(2);
				} else {
					discountvalue = discount;
				}
				var newtotal = total + parseFloat(gstvalue) - (discountvalue);
				rowtotal = newtotal.toFixed(2);
				$("#total_price_ep" + inc).val(rowtotal);
				$("#discount_value" + inc).val(discountvalue);
				var e = 0;
				$('.price_ep').each(function() {
					e += parseFloat(this.value) || 0;
				});
				$("#total_ep").text("Rs." + e.toFixed(2));
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
				$('.discountvalue').each(function() {
					totaldiscount += parseFloat(this.value) || 0;
				});
				$("#totaldiscountep").text("Rs." + totaldiscount.toFixed(2));
				var totalgst = 0;
				$('.gstvalue').each(function() {
					totalgst += parseFloat(this.value) || 0;
				});
				$("#totalgstep").text("Rs." + totalgst.toFixed(2));
				var totalcgstep = totalgst / 2;
				$("#totalcgstep").text("Rs." + totalcgstep.toFixed(2));
				$("#totalsgstep").text("Rs." + totalcgstep.toFixed(2));
				var totalprice1=e.toFixed(2);
				$("#totalprice_ep").val(totalprice1);
				var overalldiscount = $("#overalldiscountpercentep").val();
				var overalldiscounttype = $("#wizard-validation-form1 input[name='overalldiscounttypeep']:checked").val();
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
				$("#overalldiscountamountep").val(overalldiscountvalue);
				$("#overalltotalep").val(overalltotal);
			});
		});
		
		
		$(".deleteproduct_ep").click(function()
		 {
			var inc = $(this).attr('dataincrement');
            $("#buttonsubmit"+ inc).prop('disabled', false);
		    $("#buttonsubmit"+ inc).removeClass("btn-danger");
		    $("#buttonsubmit"+ inc).addClass("btn-default");
			var patienttype = "<?php echo $ptype;?>";
			$(this).parent().parent().remove();
			if(patienttype==1)
			{
				var rowCount = $('#productgrid_ep tr').length;
			if (rowCount <= 5) {
				$('#ep_theaddata').hide();
				$('#totalprice_ep_row').hide();
				$('#totalprice_ep_cgst').hide();
				$('#totalprice_ep_sgst').hide();
				$('#btn_ep').hide();
				$('#totalprice_ep_label').hide();
                $("#ovaralltotalprice_ep").hide();
			}
			}
				else
			{
				var rowCount = $('#productgrid_ep tr').length
				
			if (rowCount <= 5) {
				$('#ep_theaddata').hide();
				$('#totalprice_ep_row').hide();
				$('#totalprice_ep_cgst').hide();
				$('#totalprice_ep_sgst').hide();
				$('#totalprice_ep_label').hide();
                $("#ovaralltotalprice_ep").hide();
				$('#btn_ep').hide();
			}
			}
			
			var e = 0;
			$('.price_ep').each(function() {
				e += parseFloat(this.value) || 0;
			});
			 var totalprice1=e.toFixed(2);
			$("#total_ep").text("Rs." +totalprice1);
			$("#totalprice_ep").val(totalprice1);
			var overalldiscount = $("#overalldiscountpercentep").val();
			var overalldiscounttype = $("#wizard-validation-form1 input[name='overalldiscounttypeep']:checked").val();
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
			$("#overalldiscountamountep").val(overalldiscountvalue);
			$("#overalltotalep").val(overalltotal);
		});
	}); 
</script>

