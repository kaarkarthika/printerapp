<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Salesreturn;
use backend\models\Sales;
use backend\models\Stockmaster;
use backend\models\Vendor;
use backend\models\Stockrequest;
use backend\models\Product;
use backend\models\ReturnDetail;
use backend\models\Composition;
use backend\models\Unit;
use backend\models\Producttype;
use backend\models\Saledetail;

use yii\helpers\Url;


?>
<style>
.kv-editable-link{border-bottom: 0px !important;}.pagination{display:none;}
</style>
<div class="container">
   <div class="row">
<div class="col-sm-12">
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#">Update Return</a></li>
								</ol>
							</div>
						</div>
<div class="panel panel-border panel-inverse">
<div class="panel-heading">
 </div>
 <div class="panel-body">
    <?php $form = ActiveForm::begin(['id'=>'returnform']);?>

   	<table class="table table-striped table-hover table-bordered">
 		<thead>
 			<th>Meidcal Record Number</th>
 			<th>Return Invoice number</th>
 			<th>Patient Name</th>
 			<th>Return Date</th>
 		</thead>
 
 <?php 
 
  $returndata=Salesreturn::find()->where(['return_id'=>$saledata->return_id])->one();
  if($returndata)
  {
  
  	 $patientdata=Sales::find()->where(['mrnumber'=>$returndata->mrnumber])->one();
  }

 
 ?>

 <td>

<?= $form->field($model, 'mrnumber')->textInput(['maxlength' => true,'class'=>'required form-control' ,'id'=>'mr','readonly'=>true,'value'=>$patientdata->mrnumber])->label(false);?>

 </td>
  <td>
 
<?= $form->field($model, 'return_invoicenumber')->textInput(['maxlength' => true,'class'=>'required form-control','id'=>'name','readonly'=>true,'value'=>$returndata->return_invoicenumber])->label(false);?>
 </td>
  <td>
 
<?= $form->field($model, 'updated_by')->textInput(['maxlength' => true,'class'=>'required form-control','id'=>'name','readonly'=>true,'value'=>$patientdata->name])->label(false);?>
 </td>
  <td>
 
<?= $form->field($model, 'updated_on')->textInput(['maxlength' => true,'class'=>'required form-control','id'=>'name','readonly'=>true,'value'=>date("d/m/Y")])->label(false);?>
 </td>
 
 	</table>
 	
 	 <table id="datatable-responsive" class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
						<th>Action</th>
						<th>Stock</th>
						<th>Composition</th>
						<th>Brand /Stock Code</th>
						<th>Batch Number</th>
						<th>Sale Qty</th>
						<th>PriceperQty</th>
						<th>Gst</th>
						<th>Disc</th>
						<th>Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                	<?php $i=1;
									
									$datatables=Saledetail::find()->where(["opsaleid"=>$id])->all();
								
                                	foreach ($datatables as $key => $value)
									 {
									 	
										$productid[]=$value->productid;
										$newproductdata=array_intersect_key($productlist, array_flip($productid));
									    $productval=array_values($newproductdata);
										//composition
										
										$compositionid[]=$value->compositionid;
										$newcompositiondata=array_intersect_key($compositionlist, array_flip($compositionid));
									    $compositionval=array_values($newcompositiondata);
										
										
										$saleid=$value->opsaleid;
										
										//unit
										$unitid[]=$value->unitid;
										$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
									    $unitval=array_values($newunitdata);
										
										
									 	echo "<tr>";
										 echo"<td><button type='button' id='buttonsubmit".$i."' dataincrement='".$i."' class='btn btn-xs btn-sm btn-icon btn-default waves-effect waves-light return_sale' 
										 data-id='".$value->opsale_detailid."'>
									 <i class='fa fa-plus'></i>
									 </button></td>";
										echo "<td>".$productval[0]."</td>";
										echo "<td>".$compositionval[0]."</td>";
										echo "<td>".$value->brandcode."/".$value->stock_code."</td>";
										echo "<td>".$value->batchnumber."</td>";
										echo "<td>".$value->productqty."-".$unitval[0]."</td>";
										echo "<td>".number_format($value->priceperqty,2)."</td>";
										echo "<td>".$value->gstrate."</td>";
										echo "<td>".$value->discountrate."</td>";
										echo "<td>".number_format($value->price,2)."</td>";
										
										echo "</tr>";
									$newproductdata=array(); $productid=array();$productval="";
									$newcompositiondata=array(); $compositionid=array();$compositionval="";
									$newunitdata=array(); $unitid=array();$stockcodeval="";
									
									
										++$i;
										
									 }
									
									?>
                                
                                </tbody>
                            </table>
                            
                            
                                            <div class="row">
                                                	<div class="panel panel-border panel-inverse">
                                                		<div class="panel-heading">
                                                		
                                                		</div>
                                                		<div class="panel-body">      
                                                			 <div  style="white-space: nowrap;
  overflow-x: visible;
  overflow-y: hidden;

  width: auto; ">             
                             <table id="returngrid" class="table table-striped table-hover table-bordered">
             <thead id="return_theaddata" >
           <!--  <th>S.No</th>-->
            
<th>Stock Info</th>
              
              
              
             <th>Quantity</th>
              <th>Unit</th>
                
             <th>Price/Qty</th>
              <th>GST %</th>
               <th>GST Value</th>
               <th>Discount Type</th>
              <th> Discount Rate</th>
               <th> Discount value</th>
             <th>Total Price</th><th></th>
             </thead>  
<tbody id="formdetails_return">
	
<?php 	
	
$vendor_name = "";
$product_name = "";
$rows = "";	
$salesdata=Returndetail::find()->where(['return_id'=>$saledata->return_id])->all();
$data=Salesreturn::find()->where(['return_id'=>$saledata->return_id])->one();
$totalprice=$data->total;
if($salesdata)
{
	        $autonumber=1;
			foreach ($salesdata as $key => $value) {
				  $pid=$value->productid;
				  $product_data = Product::find() -> where(['productid' => $pid]) -> one();
				$composition = Composition::find() -> where(['composition_id' => $value -> compositionid]) -> one();
				$unitlist = Unit::find() -> where(['unitid' => $value -> unit]) -> one();
				$tax=$value->gstrate;
            ?>
			<tr id="productrowdata<?php echo $autonumber;$i=$autonumber;?>">
 
  <td><?php echo "Stockname:".$product_data ->productname; echo Html::input('hidden', 'productid[]', $pid);echo "<br>";
      echo "Drug:".$composition -> composition_name; echo Html::input('hidden', 'compositionid[]', $composition -> composition_id); echo "<br>";
    echo "brandcode : ".$value->brandcode; echo Html::input('hidden', 'brandcode[]', $value->brandcode); echo "&nbsp;&nbsp;&nbsp;&nbsp;";
  echo "Stockcode : ".$value->stock_code; echo Html::input('hidden', 'stock_code[]', $value->stock_code); echo "<br>";
 echo "Batchnumber : ".$value->batchnumber; echo Html::input('hidden', 'batchnumber[]', $value->batchnumber);echo Html::input('hidden', 'expiredate[]', $value->expiredate); ?></td>
<td style="width:150px;">
 <input type="text" name="productqty[]"  class="form-control productqty_rp" dataincrement="<?php echo $i;?>" id="quantity_rp<?php echo $i;?>" 
 value="<?php echo $value->productqty;?>" required="true" placeholder="Quantity" />
 <input type="hidden" name="stockid[]" value="<?php echo $value->stockid;?>" /> 
<input type="hidden" name="stockresponseid[]"   value="<?php echo $value->stockresponseid;?>"/> 
 <input type="hidden" name="returndetailid[]"   value="<?php echo $value->return_detailid;?>"/> 
 </td>
 <td><?php echo $unitlist -> unitvalue; echo Html::input('hidden', 'unitid[]',  $unitlist -> unitid);
 	echo Html::input('hidden', 'saleid',  $saledata->saleid);
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
 <td><button type='button' data-id='productrowdata<?php echo $i;?>' dataincrement="<?php echo $i;?>" class='btn btn-xs btn-sm btn-icon btn-danger waves-effect waves-light deleteproduct_rp' >
 <i class="fa fa-remove"></i></button>
 </td>
   </tr>

    <?php
    $autonumber++;
	
	}
	}
				
?>
	
	
	
</tbody>
<tr id="total_price_return" > <td></td><td></td><td></td><td></td><td></td>
	<td style="text-align:right;"><span id="totalgstrp">Total Gst Rs.<?php echo $returndata->totalgstvalue;?></span></td>
	<td></td><td></td>
<td style="text-align:right;"><span id="total_discountreturn">Total Discount Rs.<?php echo $returndata->totaldiscountvalue;?></span></td>
<td style="text-align:right;"><span id="total_return">Total Price Rs.<?php echo $returndata->total;?></span><input type="hidden" value="<?php echo $returndata->total;?>" id="totalprice_return" name="totalprice" /></td><td></td></tr>


<tr id="totalprice_rp_cgst" >  <td></td><td></td><td></td><td></td><td></td>
	<td ><span id="totalcgstrp">Total CGST Rs.<?php echo $returndata->totalcgstvalue;?></span></td>
	<td></td><td></td><td></td>
<td></td>
<td ></td></tr>


<tr id="totalprice_rp_sgst" > <td></td><td></td><td></td><td></td><td></td>
	<td ><span id="totalsgstrp">Total SGST :Rs.<?php echo $returndata->totalsgstvalue;?></span></td>
	<td></td>
<td ></td><td></td><td></td>
<td></td></tr>

<tr id="btn_return" ><td colspan="9" align="right">
	 <span id="loadtex" ></span>
	 <?= Html::Button($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-save "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success returnmedicines' : 'btn btn-success  returnmedicines']) ?>
	
    
</td> <td ><p id="return" style="display:none;"></p>
    
	</td><td></td></tr>
 </table>
</div>
</div>
</div>
</div>
   
   
    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
<script>
 $(document).ready(function()
 {
 		$(".dt-buttons").hide();
	$('body').on("click",'.return_sale',function(){
		
	var dataid=$(this).attr('data-id');
	var inc = $(this).attr('dataincrement');
	$("#load").show();
	$("#buttonsubmit"+ inc).prop('disabled', true);
	$.ajax({
        url:'<?php echo Yii::$app->homeUrl ?>?r=salesreturn/returnproductdetail&id='+dataid+'&autonumber='+inc,
        type: "post",
        success: function (data) {
    
        $('#return_theaddata').show();
         $("#load").hide();
         $('#total_price_return').show();
           $('#totalprice_rp_cgst').show();
             $('#totalprice_rp_sgst').show();
         
         $('#btn_return').show();
       $("#formdetails_return").append(data);
        
        }
     });
	})
 	
	 $("#datatable-responsive").length && $("#datatable-responsive").DataTable({
            lengthMenu: [[3,5,10, 25, 50, -1], [3,5,10, 25, 50, "All"]],
            "paging": true,
            scrollX:true,
       });
       
		 $('body').on("click",'.returnmedicines',function(){
 var form = $("#returnform");
 var formData = form.serialize();
 $form_container=$("#returnform");
   	 $form_container.validate().settings.ignore = ":disabled,:hidden";
   var chkform=$form_container.valid();
   if(chkform==true){
$.ajax({
        url:'<?php echo Yii::$app->homeUrl ?>?r=returndetail/update&id=<?php echo $id;?>',
        type: 'post',
       data: formData,
        success: function (data) {
        	
           var data1=data.split("=")[0];
        	var data2=data.split("=")[1];
        	$("#load").show();
        if(data1=="Y")
	    {
	    $("#load").hide();
		$("#loadtex").text("Successfully Saved.");
		$("#loadtex").css('color','green ');
	    $("#loadtex").show(4);
	    $("#return").show();
	    $("#return").find('a.btn').remove();
	    $("#return").append("<a target='_blank' class='btn btn-default' href='<?php echo Yii::$app->homeUrl ?>?r=salesreturn/invoice&id="+data2+"'>Invoice</a>" );
		}
        }
     });
    }
	});
	
	$(".deleteproduct_rp").click(function(){

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
				var price = $("#item_price_rp" + inc).val();
				
				
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
