<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Stockmaster;
use backend\models\Vendor;
use backend\models\Stockrequest;
use backend\models\Product;
use backend\models\Sales;
use backend\models\Salesreturn;
use yii\helpers\Url;
use backend\models\Saledetail;


?>
<style>
.kv-editable-link{border-bottom: 0px !important;}.pagination{display:none;}
</style>
<div class="panel panel-border panel-inverse">
<div class="panel-heading">
	<h3 class="panel-title">Search Your Medicines from Sales :</h3>
 </div>
 <div class="panel-body">
 <?php	$form = ActiveForm::begin(['id'=>'returnform']);?>
 	<table class="table table-striped table-hover table-bordered">
 		<thead>
 			<th>Meidcal Record Number</th>
 			<th>Return Invoice number</th>
 			<th>Patient Name</th>
 			<th>Return Date</th>
 		</thead>
 
 <?php 
  
  $salesdata=Sales::find()->where(['opsaleid'=>$id])->one();
  $returndatainc=	Salesreturn::find()->orderBy(['return_id' => SORT_DESC])->one();
  $returnincrement=$returndatainc->returnincrement+1;
  $type=$salesdata->billnumber;
   if (preg_match("/\bIP\b/i", $type, $match)) {
   	$returninv='P/RETURN/IP/'.date("Y").'/'.date("m").'/'.($returnincrement);
   }
   else{
   $returninv='P/RETURN/OP/'.date("Y").'/'.date("m").'/'.($returnincrement);
   }
 ?>

 <td>

<?= $form->field($model, 'mrnumber')->textInput(['maxlength' => true,'class'=>'required form-control' ,'id'=>'mr','readonly'=>true,'value'=>$salesdata->mrnumber])->label(false);?>

 </td>
  <td>
 
<?= $form->field($model, 'return_invoicenumber')->textInput(['maxlength' => true,'class'=>'required form-control','id'=>'name','readonly'=>true,'value'=>$returninv])->label(false);?>
 </td>
  <td>
 
<?= $form->field($model, 'updated_by')->textInput(['maxlength' => true,'class'=>'required form-control','id'=>'name','readonly'=>true,'value'=>$salesdata->name])->label(false);?>
 </td>
  <td>
 
<?= $form->field($model, 'updated_on')->textInput(['maxlength' => true,'class'=>'required form-control','id'=>'name','readonly'=>true,'value'=>date("d/m/Y")])->label(false);?>
 </td>
 
 	</table>
           <div class="row">
 <table id="datatable-responsive" class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                	 
                                	<th>#</th>
						<th style="width:100px;">Action</th>
						<th>Stock</th>
						<th>Composition</th>
						<th>Brand Code</th>
						<th>Stock Code</th>
						<th>Batch Number</th>
						<th>Sale Qty</th>
						<th>Unit</th>
						<th>Price/Qty</th>
						<th>Gst</th>
						<th>Disc</th>
						<th>Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                	<?php $i=1;
									
									$datatables = Saledetail::find()->joinwith(['sales'])->andWhere(['saledetail.opsaleid'=>$id])->all();
									
									
									
                                	foreach ($datatables as $key => $value)
									 {
									 	
										$productid[]=$value->productid;
										$newproductdata=array_intersect_key($productlist, array_flip($productid));
									    $productval=array_values($newproductdata);
										//composition
										
										$compositionid[]=$value->compositionid;
										$newcompositiondata=array_intersect_key($compositionlist, array_flip($compositionid));
									    $compositionval=array_values($newcompositiondata);
										
										//unit
										$unitid[]=$value->unitid;
										$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
									    $unitval=array_values($newunitdata);
										
										
									 	echo "<tr><td>".$i."</td>";
										 echo"<td><button type='button' id='buttonsubmit".$i."' dataincrement='".$i."' class='btn btn-sm btn-icon btn-default waves-effect waves-light return_sale' 
										 data-id='".$value->opsale_detailid."'>
									 <i class='fa fa-plus'></i>
									 </button></td>";
										echo "<td>".$productval[0]."</td>";
										echo "<td>".$compositionval[0]."</td>";
										echo "<td>".$value->brandcode."</td>";
										echo "<td>".$value->stock_code."</td>";
										echo "<td>".$value->batchnumber."</td>";
										echo "<td>".$value->productqty."</td>";
										echo "<td>".$unitval[0]."</td>";
										echo "<td>".$value->priceperqty."</td>";
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
             <thead id="return_theaddata" style="display:none;">
           <!--  <th>S.No</th>-->
             <th>Product</th>
             
             <th>Composition</th>
             <th>Brand Code</th>
              <th>Stock Code</th>
              <th>Batch Number</th>
             <th>Quantity</th>
              <th>Unit</th>
                
             <th>Price/Qty</th>
              <th>GST rate</th>
               <th>GST Value</th>
               <th>Discount Type</th>
              <th> Discount Rate</th>
               <th> Discount value</th>
             <th>Total Price</th>
             </thead>  
<tbody id="formdetails_return">
</tbody>
<tr id="total_price_return" style="display:none;"> <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
	<td style="text-align:right;"><span id="totalgstrp">Total Gst Rs.<?php echo $salesdata->totalgstvalue;?></span></td>
	<td></td><td></td>
<td style="text-align:right;"><span id="total_discountreturn">Total Discount Rs.<?php echo $salesdata->totaldiscountvalue;?></span></td>
<td style="text-align:right;"><span id="total_return">Total Price Rs.<?php echo $salesdata->total;?></span><input type="hidden" value="<?php echo $salesdata->total;?>" id="totalprice_return" name="totalprice" /></td></tr>


<tr id="totalprice_rp_cgst" style="display:none;">  <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
	<td ><span id="totalcgstrp">Total CGST Rs.<?php echo $salesdata->totalcgstvalue;?></span></td>
	<td></td><td></td>
<td></td>
<td ></td></tr>


<tr id="totalprice_rp_sgst" style="display:none;"> <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
	<td ><span id="totalsgstrp">Total SGST :Rs.<?php echo $salesdata->totalsgstvalue;?></span></td>
	<td></td>
<td ></td><td></td>
<td></td></tr>

<tr id="btn_return" style="display:none;"><td colspan="13" align="right">
	 <span id="loadtex" style="display: none; "></span>
	 <?= Html::Button($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-save "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success returnmedicines' : 'btn btn-primary  returnmedicines']) ?>
	
    
</td> <td ><p id="return" style="display:none;"></p>
    
	</td></tr>
 </table>
</div>
</div>
</div>
</div>
 
 </div>
 <?php ActiveForm::end(); ?>
</div>
<script>
 $(document).ready(function()
 {
 		
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
 	

       
		 $('body').on("click",'.returnmedicines',function(){
 var form = $("#returnform");
 var formData = form.serialize();
 $form_container=$("#returnform");
   	 $form_container.validate().settings.ignore = ":disabled,:hidden";
   var chkform=$form_container.valid();
   if(chkform==true)
   {
   	   	   	 	var k=0;
var inps = document.getElementsByName('dataincrement[]');
for (var i = 0; i <inps.length; i++) {
var inp=inps[i];
var inc=inp.value;
var totalstock1=parseFloat($("#availablestock" + inc).val());
var uq_2=parseFloat($("#quantity_rp" + inc).val());
if(uq_2>totalstock1)
{
var k=1;
}
}	
   if(k==0)
    {
        $.ajax({
        url:'<?php echo Yii::$app->homeUrl ?>?r=salesreturn/savesalesreturn',
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
	else{
		 swal({
                title: "Are you sure?",
                text: "Check Your Return Units is greater than Sale Quantity",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: "Yes",
                closeOnConfirm: false
            });
	  }	
    }
	});
    });
</script>	