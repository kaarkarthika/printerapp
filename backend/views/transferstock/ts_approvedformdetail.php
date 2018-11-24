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
use backend\models\Transferstock;
$approveddata=Stockresponse::find()->where(['stockresponseid'=>$id])->all();
$transferstockdata=Transferstock::find()->where(['transferstockid'=>$transferstockid])->one();
$qty=$transferstockdata->transferstockquantity;
$unit=$transferstockdata->unit;
$unitdata=Unit::find()->where(['unitid'=>$unit])->one();
$i=$autonumber;
foreach($approveddata as $data)
{  
	$stockid=$data->stockid;
	$stockdata=Stockmaster::find()->where(['stockid'=>$stockid])->one();
	$productid=$stockdata->productid;
	$productdata=Product::find()->where(['productid'=>$productid])->one();
	$productname=$productdata->productname;
	 $vendordata=Vendor::find()->where(['vendorid'=>$stockdata->vendorid])->one();
				 $vendorname=$vendordata->vendorname;
	?>
	<tr> <td><?php echo $productname;?></td>
		  <td><?php echo $vendorname;?></td>
		 <td><?php echo $qty."-".$unitdata->unitvalue;?></td>
		
        <td><?php echo $data->batchnumber;?></td> 
               <td><input type="text" class="form-control approvedqty" required="" id="approvedquantity<?php echo $i;?>" dataincrement="<?php echo $i;?>" name="approvedquantity[]"  placeholder="quantity"/>
        	<input type="hidden"  name="transferstockid[]"  value="<?php echo $transferstockid;?>" />
        	<input type="hidden"  name="responseid[]"  value="<?php echo $data->stockresponseid;?>" />
        	<input type="hidden"  name="vendorid[]"  value="<?php echo $stockdata->vendorid;?>" />
        </td>
         <td><?php echo $unitdata->unitvalue;?>
         	<input type="hidden"  name="unit[]"  value="<?php echo $unitdata->unitid;?>" />
         	<input type="hidden"  name="unitquantity[]" id="unitquantity<?php echo $i;?>" value="<?php echo $unitdata->no_of_unit;?>" />
         	<input type="hidden"  name="totalstock[]" id="totalstock<?php echo $i;?>" value="<?php echo $data->total_no_of_quantity;?>" />
         	
         </td>
         <td><input type="text"  name="totalunits[]"   id="totalunits<?php echo $i;?>" readonly="true" class="form-control" placeholder="quantity"/></td>
      <td><input type="text" class="form-control priceperqty" dataincrement="<?php echo $i;?>" name="priceperquantity[]" id="priceperquantity<?php echo $i;?>" value="<?php echo $data->mrpperunit;?>" placeholder="Price Per Quantity"/></td>
          <td><input type="text" class="form-control" name="totalprice[]" id="totalprice<?php echo $i;?>" readonly="true"/></td>
          <td><button type='button' dataincrement="<?php echo $i;?>" data-id='productrowdata<?php echo $i;?>' class='btn btn-sm btn-icon btn-danger waves-effect waves-light deleteproduct' >
 <i class="fa fa-remove"></i></button>
 </td>
       </tr>
       
<?php } ?>
<script>
$(document).ready(function()
{
$(".deleteproduct").click(function(){
$(this).parent().parent().remove();
var inc=$(this).attr('dataincrement');
var rowCount = $('#approvedgrid tr').length;
 $("#btnsubmit"+ inc).prop('disabled', false);
 
if(rowCount<=3)
{
	 $('#approvedform_theaddata').show();
}
});
});
 $(document).on('change keyup click', '.approvedqty', function ()
   {
  
  	      var inc=$(this).attr('dataincrement');
          var rq=$("#approvedquantity" + inc).val();
          var uq=$("#unitquantity" + inc).val();
          var tu=rq*uq;
          $("#totalunits" + inc).val(tu);
           var rq_1=$("#priceperquantity" + inc).val();
          
          var uq_1=$("#totalunits" + inc).val();
          var tu_1=rq_1*uq_1;
          tu_2= tu_1.toFixed(2);
          $("#totalprice" + inc).val(tu_2);
          var totalstock=parseInt($("#totalstock" + inc).val());
          if(uq_1>totalstock)
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
          
          
  });
  $(document).on('change keyup click', '.priceperqty', function ()
   {
  	      var inc=$(this).attr('dataincrement');
          var rq=$("#priceperquantity" + inc).val();
          var uq=$("#totalunits" + inc).val();
          var tu=rq*uq;
          $("#totalprice" + inc).val(tu).toFixed(2);
  });
</script>