<?php
   use yii\helpers\Html;
   use yii\widgets\ActiveForm;
   use yii\helpers\Url;
   /* @var $this yii\web\View */
   /* @var $model backend\models\ProductPackagemaster */
   /* @var $form yii\widgets\ActiveForm */
   ?>
   
 <script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
 <script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>  
 
   
<style>
   #load{display:none;position:fixed;left:128px;top:27px;width:100%;height:100%;z-index:9999;margin-top:20%}input.error{background:#fbe3e4;border:1px solid #fbc2c4;color:#8a1f11}
   .panel{margin-bottom: 4px;}
</style>
<?php $form = ActiveForm::begin(); ?>
<div class="container" style="height:500px;">
   <div id="load"  align="center"><img src="<?= Url::to('@web/dmc2.gif') ?>" />Loading...
   </div>
   <div class="row" >
      <div class="col-sm-12">
         <div class="panel panel-border panel-custom">
            <div class="panel-heading">
            </div>
            <div class="panel-body  panel-padding">
			<div class="row">
               <div class=" col-md-3">
                  <?= $form->field($model, 'pack_name')->textInput(['required' => true,'readonly'=>true]) ?>
               </div>
               <div class=" col-md-3 hide">
                  <?php 
                     if($model->isNewRecord)
                     {
                     $model->is_active = 1;
                     echo $form->field($model, 'is_active', ['template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
                     ])->checkbox([],false);
                     }
                     
                     else{
                     echo $form->field($model, 'is_active',[ 'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
                     ])->checkbox([],false);
                     }
                     ?>
               </div>
               </div>
			   
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-9">
         <div class="panel panel-border panel-custom">
            <div class="panel-heading">
            </div>
            <div class="panel-body  panel-padding">
               <div class="col-sm-8">
                  <?= $form->field($package_log, 'product_id')->textInput(['maxlength' => true,'id'=>'typehead'])->label('Product Name') ?>
                  <input type="hidden" class="form-control total_quantity ansrefrsh"  id="productname">
                  <input type="hidden" class="form-control total_quantity ansrefrsh" name="PACKID" id="pack_id" value="<?php echo $model->id; ?>">
                  
               </div>
               <div class="col-sm-2">
                  <?= $form->field($package_log, 'qty')->textInput(['maxlength' => true,'class'=>'form-control number','onkeyup'=>'ProductQty(this.value,event);'])->label('Product Qty') ?>
               </div>
               <div class="col-sm-1" style="margin-top: 26px;">
                  <?= Html::Button( 'Add To Grid' , ['class' =>  'btn btn-xs btn-success','id'=>'add_to_grid','onclick'=>'Add_to_grid();' ]) ?>
               </div>
			   
			   <div class="col-sm-12">
                 <table class="table-bordered table-striped tbl-scrol" id="tbUser">
                     <thead>
                        <tr>
                           <th class="text-center">Product Name</th>
                           <th class="text-center" >Product Qty</th>
                           <th class="text-center" >Action</th>
                        </tr>
                     </thead>
                     <tbody id="fetch_table">
                        
                         <?php echo $result_string;?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
	  <div class="col-sm-2">
	  
	   <div class="panel panel-border panel-custom">
            <div class="panel-heading">
            </div>
            <div class="panel-body   ">
	  
	  
	    <div class="col-sm-12">
                  <div class="form-group  ">
                     <?= Html::Button('Save',['class' => 'btn btn-success b-width hide','onclick'=>'SaveProduct();']) ?>
                  </div>
				  
				  <div class="form-group">
				    <button type="button" class="btn inp btn-default b-width ">Clear</button></div>
				 
				  
				  <div class="form-group">
				    <button type="button" class="btn inp btn-default b-width  ">Cancel</button></div>
					<div class="form-group">
						     <button type="button" class="btn btn-bk btn-default b-width" onclick="GridTable();">Grid</button> 
                    </div> 
					
					
				  </div>
				  </div>
               </div>
	  </div>
	  </div>
	  </div>
	  
	  
	  
   </div>
 
</div>
</div>
</div>
</div>
</div>
<?php ActiveForm::end(); ?>

<script>
	
$(document).ready(function(){
	
	$('#productpackagemaster-pack_name').focus();
	
	$("body").on('keypress', '.number', function (e) 
	{
      //if the letter is not digit then display error and don't type anything
      if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
      {
        return false;
      }
	});
});

var availableTags = <?= $productlist_col_json; ?>;

    $("#typehead").typeahead({

        minLength: 1,
        delay: 5,
  		source: availableTags,
  		autoSelect: true,
 		displayText: function(item)
 		{
 			 return item.productname;
 		},
  		afterSelect: function(item) 
  		{
  			$("#productname").val(item.productid);
  			$('#productpackagelog-qty').focus();
  		} 
	});

function ProductQty(data,event)
{
var keycode = (event.keyCode ? event.keyCode : event.which);

var productid=$("#productname").val();
var productname=$('#typehead').val();
if(productid === '')
{
	alert('Enter Product Name');
	return false;
}

if(data === '')
{
alert('Enter Quantity');
return false;
}

if(isNaN(data))	
{
	alert('Enter Valid Quantity');
	return false;
}

if(keycode === 13 && data !== '')
{
$('#add_to_grid').focus();
}
}

function Add_to_grid()
{
var productid=$("#productname").val();
var productname=$('#typehead').val();
var data=$('#productpackagelog-qty').val();

var pack_name=$('#productpackagemaster-pack_name').val();
pack_name=pack_name.trim();
if(pack_name === '')
{
	$('#productpackagemaster-pack_name').focus();
	alert('Enter Package Name');
	return false;
}

if(productid === '')
{
	alert('Enter Product Name');
	return false;
}	
if(data === '')
{
alert('Enter Quantity');
return false;
}

if(isNaN(data))	
{
alert('Enter Valid Quantity');
return false;
}	

var tbl_length=$('#fetch_table tr').length;

if(tbl_length > 0)
{var valid=false;
$('.producttbl').each(function() {
	var prime_id = $(this).attr('data-id');
	if(prime_id === productid)
	{
		alert('Product Already Exist in Grid Table');
		$("#productname").val('');
		$("#typehead").val('');
		$('#productpackagelog-qty').val('');
		$("#typehead").focus();
		valid=false;
		return false;
	}
	else
	{
		valid=true;
	}	
});
}
else
{
	var valid=true;
}

if(valid === true)
{	
/*var fetch_data='<tr id="producttbl'+productid+'" class="producttbl" data-id='+productid+'><td class="text-center"><input type="hidden"  data-id='+productid+' name="ProductID[]" class="form-control productid" id="productid'+productid+'" value='+productid+'>'+
'<input type="text"  data-id='+productid+' style="text-align:center;" readonly value="'+productname+'" name="ProductName[]" class="form-control productname" id="productname'+productid+'"></td>'+
'<td class="text-center"><input type="text"  data-id='+productid+' style="text-align:center;" readonly name="ProductQty[]" value='+data+' class="form-control productqty" id="productqty'+productid+'"></td>'+
'<td class="text-center"><button data-id='+productid+' onclick="ProductRemove('+productid+',0);" class="remove btn btn-danger btn-xs productremove" id="productremove'+productid+'" type="button"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></button></td>'+
'</tr>';
	*/
var pack_id=$('#pack_id').val();
$.ajax({
type: "POST",
url: "<?php echo Yii::$app->homeUrl . "?r=product-packagemaster/savedproduct&id=";?>"+pack_id,
data: {'productid':productid,'productname':productname,'qty':data,'pack_name':pack_name},
success: function (result) 
{
	var obj = $.parseJSON(result);
 	if(obj[0] === 'save')
	{
	$('#fetch_table tr').remove();
	
	$('#fetch_table').append(obj[1]);
 		
 	}
}
});	
	
//$('#fetch_table').append(fetch_data);

$("#productname").val('');
$('#typehead').val('');
$('#productpackagelog-qty').val('');

$('#typehead').focus();
}	
}

function ProductRemove(data,saved_id)
{
	var pack_name=$('#productpackagemaster-pack_name').val();
	pack_name=pack_name.trim();
	if(pack_name === '')
	{
		$('#productpackagemaster-pack_name').focus();
		alert('Enter Package Name');
		return false;
	}
	
	
	
	var dialog=confirm("Are You Sure to Delete");
	
	if(dialog === true) 
	{
		if(saved_id !== 0)
		{
			var pack_id=$('#pack_id').val();
			$.ajax({
			type: "POST",
			url: "<?php echo Yii::$app->homeUrl . "?r=product-packagemaster/deleteproduct&id=";?>"+saved_id+'&packid='+pack_id,
			//data: formData,
			success: function (result) 
			{
				var obj = $.parseJSON(result);
			 	if(obj[0] === 'save')
			 	{
			 		$('#fetch_table tr').remove();
			 		
			 		$('#fetch_table').append(obj[1]);
			 		
			 	}
			 }
			 });
		}
		else
		{
			$('#producttbl'+data).remove();
		}
	}
	else
	{
		
	}
}

function SaveProduct()
{
	
var validated=$('#w0').valid();	
if(validated === true)
{
var tbl_length=$('#fetch_table tr').length;

if(tbl_length === 0)
{
	alert('Add Product in Grid Table');
	return false;
}
else
{	
var form = $('#w0');
var formData = form.serialize();

$.ajax({
 type: "POST",
 url: "<?php echo Yii::$app->homeUrl . "?r=product-packagemaster/create";?>",
 data: formData,
 success: function (result) 
 {
 	//var obj=$.parseJSON(result);
 	if(result === 'save')
 	{
 		alert('Saved Successfully');
 		window.location.reload(true);
 	}
 }
 });


	
}

}
}

function GridTable()
{
	var url='<?php echo Yii::$app->homeUrl ?>?r=product-packagemaster/index';
 	window.open(url,'_self');
}
</script>