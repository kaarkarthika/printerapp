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
			<tr id="productrowdata<?php echo $autonumber;$i=$autonumber;?>">
 <!-- <td><?php echo $autonumber;?></td>-->
  <td><?php echo $product_name ->productname; echo Html::input('hidden', 'productid[]', $pid);?></td>
  <td><?php echo $composition -> composition_name;echo Html::input('hidden', 'compositionid[]', $composition -> composition_id); ?></td>
  <td><?php echo $branddata->brandcode; echo Html::input('hidden', 'brandcode[]', $branddata->brandcode); ?></td>
<td><?php echo $branddata->stock_code; echo Html::input('hidden', 'stock_code[]', $branddata->stock_code); ?></td>
<td><?php echo $unitlist -> unitvalue; echo Html::input('hidden', 'unitid[]',  $unitlist -> unitid);?></td>
<td>
 <input type="number" name="productqty<?php echo $i;?>" min="0" class="form-control productqty_np" id="quantity_np<?php echo $i;?>" required="true" placeholder="Quantity" />
 </td>
  <td>
 <input type="text" min="0" name="pricnperqty<?php echo $i;?>" class="form-control" id="item_price_np<?php echo $i;?>"   style="text-align:right;"/>
 </td>
  <td>
 <input type="text" name="price<?php echo $i;?>"  class="form-control price_np" id="total_price_np<?php echo $i;?>" required="true" readonly="true"  style="text-align:right;"/> 
 </td>
 <td><button type='button' data-id='productrowdata<?php echo $autonumber;?>' class='btn btn-sm btn-icon btn-danger waves-effect waves-light deleteproduct_np' >
 <i class="fa fa-remove"></i></button>
 </td>
   </tr>
   <script type="text/javascript">
    $(document).ready(function()
  {
  $(function() {  
    	
        $('body').on("input",'#quantity_np<?php echo $i;?>,#item_price_np<?php echo $i;?>',function(evt)
        {		
          var quan = $("#quantity_np<?php echo $i;?>").val() != "" ? parseFloat($("#quantity_np<?php echo $i;?>").val()) : 1; 
          var  pric = $("#item_price_np<?php echo $i;?>").val() != "" ? parseFloat($("#item_price_np<?php echo $i;?>").val()) : 0;  
            $('#total_price_np<?php echo $i;?>').val(pric*quan).toFixed(2);
         
        });       
            });
    $('#quantity_np<?php echo $i;?>,#item_price_np<?php echo $i;?>') .on('change keyup click', function(e) {
   var e = 0;
   $('.price_np').each(function(){e+= parseFloat(this.value) || 0;});
$("#total_np").text("Rs."+e);
$("#totalprice_np").val(e);
 });
 
    });   
</script>
    <?php
	} 
?>
<script>
$(document).ready(function()
{
$(".deleteproduct_ep").click(function(){
$(this).parent().parent().remove();
var e = 0;
$('.price_np').each(function(){e+= parseFloat(this.value) || 0;});
$("#total_np").text("Rs."+e);
$("#totalprice_np").val(e);
});
});
</script>
