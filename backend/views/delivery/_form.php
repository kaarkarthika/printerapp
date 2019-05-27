<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Delivery */
/* @var $form yii\widgets\ActiveForm */


if(!empty($customer_master))
{
    foreach ($customer_master as $key => $value) 
    {

        $productlist_col_val[] = array('company' => $value['company_name'],'customer' => $value['customer_name'],'gst'=> $value['gst'],'primary_id' => $value['auto_id'],'state_code'=>$value['state_code'],'state'=>$value['state'],'address'=>$value['address'].','.$value['city'].','.$value['state'].'-'.$value['pincode']);
    }
}
        $productlist_col_json = json_encode($productlist_col_val);  



$transport_array=array(0=>'For Sale/Purchase',1=>'For Shipment',2=>'Transfer to Branch',3=>'For Execution of works contract',4=>'For Labour Work Processing');




?>

<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>/select2/css/select2.css" />
 <script  src="<?php echo Url::base(); ?>/select2/js/select2.js"></script>

<style type="text/css">
    
textarea.form-control,#delivery-address {
    min-width: 150px !important;

    height: 70px;
    resize: none;
}

#description{
   min-width: 100px !important;

    height: 70px !important;
    resize: none;
}

#delivery-remarks{
   min-width: 100px !important;

    height: 70px !important;
    resize: none;
}

ul.typeahead.dropdown-menu {
    width: 96%;
}
ul.typeahead.dropdown-menu>li>a{
    font-size: 16px;
        color: blue;
        
}

.amount
{
    text-align: right;
}

</style>
    <?php $form = ActiveForm::begin(['id'=>'delivery-form','options'=> ['autocomplete'=>'off','onsubmit'=>"return false;"]]); ?>


 <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-border panel-custom">
                                    <div class="panel-heading">
                                        
                                    </div>
                                    <div class="panel-body">                              

    
<div class="ot-job-form">

  <div class="col-md-12">

<div class="col-md-4">

    <?= $form->field($model, 'company_name')->textInput(['autocomplete'=>'off','readonly'=> $model->isNewRecord ? false : true,'maxlength' => true,'class'=>'form-control input-sm typehead','onkeyup'=>'EmptyEsc(this.value,event);'])->label('COMPANY NAME') ?>
    <?php if($model->isNewRecord) { ?>
     <input type="hidden" id="custId" name="custId">
   <?php }else if(!$model->isNewRecord) { ?>
     <input type="hidden" id="custId" name="custId" value="<?php echo $model->cust_id; ?>">
   <?php } ?>
      <?= $form->field($model, 'cust_name')->hiddenInput(['readonly' => true])->label(false) ?>
</div>

<div class="col-md-2">
    <?= $form->field($model, 'gstin_no')->textInput(['readonly' => true])->label('GSTIN') ?>
</div>

<div class="col-md-2">
          <?= $form->field($model, 'gst_type')->dropDownList(['GST'=>'GST','IGST'=>'IGST'],['class' => 'form-control input-sm gst_percent','id'=>'gst_percent','prompt'=>"SELECT"])->label('GST Type') ?>
      </div>
<?php if(!$model->isNewRecord) { ?>

<div class="col-md-2">
  
    <label>Serial NO</label>
    <br/>
    <div><b style="color: blue;"><?php echo $model->bill_no;?></b></div></div>
  
 <?//= $form->field($model, 'bill_no')->textInput(['readonly' => true])->label('Serial NO') ?>

 <div class="col-md-2">
   
    <label>Date</label>
    <br/>
    
      <b style="color: blue;"><?php echo date('d-m-Y',strtotime($model->bill_date));?></b>
  
       <?//= $form->field($model, 'bill_date')->textInput(['readonly' => true,'value'=> $model->isNewRecord ? '' : date('d-m-Y H:i:s',strtotime($model->bill_date))])->label('DATE') ?>

</div>
<?php } ?>
</div>
</div>

<div class="col-md-12">
<!--div class="col-md-2">
    <?//= $form->field($model, 'state')->textInput(['readonly' => true])->label('STATE') ?>
</div-->
<!--div class="col-md-2">
    <?//= $form->field($model, 'state_code')->textInput(['readonly' => true])->label('STATE CODE') ?>
</div-->

<div class="col-md-12">
    <?= $form->field($model, 'address')->textArea(['readonly' => true])->label('Billing Address') ?>
</div>




   

</div>
 <div class="col-md-12">
 <hr style="width:100%;border-top:2px solid #4682b4;opacity:10;">
</div>

 <div class="col-md-12">

<div class="col-md-5">
    <?= $form->field($model, 'delivery_select')->dropDownList([],['onchange'=>'DeliveryAddress(this.value);'])->label('Select Delivery Address') ?>
</div>


<div class="col-md-7">
    <?= $form->field($model, 'delivery_address')->textArea(['readonly' => true])->label('Delivery Address') ?>
</div>


 </div>




 <div class="col-md-12">
 <hr style="width:100%;border-top:2px solid #4682b4;opacity:10;">
</div>
<div class="manage ">
    <div class="fields  process">




  <div class="multi-field "> 

<div class="col-md-12">

        <div class="col-md-6">
            <?= $form->field($delivery_ref, 'description')->textArea(['class' => 'form-control input-sm description','id'=>'description','name'=>'DeliveryRef[description][]'])->label('Description') ?>
        </div>

         <div class="col-md-1">
            <?= $form->field($delivery_ref, 'qty')->textInput(['class' => 'decimal_validated form-control input-sm qty','id'=>'qty','name'=>'DeliveryRef[qty][]'])->label('Qty') ?>
        </div>


         <div class="col-md-2">
            <?= $form->field($delivery_ref, 'hsn')->textInput(['class' => 'decimal_validated form-control input-sm hsn','id'=>'hsn','name'=>'DeliveryRef[hsn][]'])->label('HSN CODE') ?>
        </div>

        <div class="col-md-1">
            <?= $form->field($delivery_ref, 'gst_rate')->dropDownList($tax_master,['prompt'=>'-SELECT-','class' => 'form-control input-sm gst_rate','id'=>'gst_rate','name'=>'DeliveryRef[gst_rate][]'])->label('GST RATE') ?>
        </div>

        <div class="col-md-1">
            <?= $form->field($delivery_ref, 'amount')->textInput(['class' => 'decimal_validated form-control input-sm no-padding amount','id'=>'amount','name'=>'DeliveryRef[amount][]'])->label('Amount') ?>
        </div>
        

         <div class="col-md-1">
             <div class="form-group">
                <?= Html::Button('<i class="fa fa-plus" aria-hidden="true"></i> Add To Grid', ['class' => 'btn btn-success mt-25 btn-xs','id'=>'add_to_grid','onclick'=>'Add_To_Grid();']) ?>
            </div>
        </div>
       
    </div>
</div>







</div></div>
    








 <div class="col-md-12">
<hr style="width:100%;border-top:2px solid #4682b4;opacity:10;">
</div>
<div class="ot-job-form">
    <div class="col-md-12">
            <div class="col-md-12">

             <table class="table table-bordered  ">
            <thead>
              <tr>
                <th style="text-align: center;width: 3%;">SI NO</th>
                <th style="text-align: center;width: 60%;">Description</th>
                <th style="text-align: center;width: 9%;">Qty</th>
                <th style="text-align: center;width: 10%;">HSN Code</th>
                <th style="text-align: center;width: 10%;">GST Rate</th>
                <th style="text-align: center;width: 10%;">Amount</th>
                <th style="text-align: center;width: 3%;">Action</th>
              </tr>
            </thead>
            <tbody id='fetch_estimte'>
            <?php

    if($model->isNewRecord)
    {
        $k=1;
?>



      <?php } else {  
    $k=1;
    if(!empty($findDeliveryRef))
  {

    foreach ($findDeliveryRef as $key => $value) {
        


    ?>

 



<tr data-id='<?php echo $k; ?>' id="row_id<?php echo $k; ?>" class="row_id">
    <td data-id='<?php echo $k; ?>' id="sl_id<?php echo $k; ?>" class="sl_id"><?php echo $k; ?></td>
    <td><input type="text" class="form-control input-sm description_table disabled_field"  id="description_table<?php echo $k; ?>" required value="<?php echo $value['description']; ?>" name="DeliveryRef[description_table][]"/></td>


    <td><input type="text" class="form-control input-sm qty_table disabled_field decimal_validated"  id="qty_table<?php echo $k; ?>" value="<?php echo $value['qty']; ?>" required name="DeliveryRef[qty_table][]"/></td>


    <td><input type="text" class="form-control input-sm hsn_table disabled_field " readonly id="hsn_table<?php echo $k; ?>" value="<?php echo $value['hsn']; ?>" name="DeliveryRef[hsn_table][]"/></td>



    <td>
      <?= $form->field($delivery_ref, 'gst_rate')->dropDownList($tax_master,['options' => [$value['gst_rate'] => ['Selected'=>'selected']],'prompt'=>'-SELECT-','class' => 'form-control input-sm gst_rate','id'=>'gstrate_table'.$k,'name'=>'DeliveryRef[gst_rate_table][]','required'=>true])->label(false) ?>
      <!--input type="hidden" class="form-control input-sm hsn_table disabled_field" id="gstrate_table"  name="DeliveryRef[gst_rate_table][]"/-->
    </td>
    <!--td><div> <?php //echo $tax_master_index[$value['gst_rate']]['taxvalue']; ?></div><input type="hidden" class="form-control input-sm hsn_table disabled_field" readonly id="gstrate_table<?php //echo $k; ?>" value="<?php //echo $value['gst_rate']; ?>" name="DeliveryRef[gst_rate_table][]"/></td-->

      <td><input type="text" style="text-align:right;" class="form-control input-sm amount_table disabled_field" readonly id="amount_table<?php echo $k; ?>" value=" <?php echo $value['amount']; ?>" name="DeliveryRef[amount_table][]"/></td>

    <td style="text-align:center;"><button type="button" class="btn btn-danger btn-xs disabled_field" style="text-align:center;" onclick="Remove('<?php echo $k; ?>');">Remove</button></td></tr>

<?php $k++; } } } ?>
            </tbody>
            <tfoot id="tfoot_total_amount">
                <tr>

                  <td>
                        
                    </td>
                  <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td style="text-align: right;">
                       <b> Total Amount </b>
                    </td>
                    <td style="text-align: right;color: blue;" id="total_amount_add">
                        <?php  if(!$model->isNewRecord)
                            {  ?>     

                           <?php echo  $model['tot_amt']; ?>
                        <?php   }
                                ?>
                    </td>
                    <td>
                        
                    </td>
                </tr>
            </tfoot>
          </table>
        </div> 
    </div>
</div>



 <div class="col-md-12">
 <hr style="width:100%;border-top:2px solid #4682b4;opacity:10;">
</div>
<div class="col-md-12">

     <div class="col-md-3">
    <?= $form->field($model, 'transport')->dropDownList($transport_array,['prompt'=>'--SELECT--','class' => 'form-control input-sm'])->label('Purpose Of Transport') ?>
</div>

  <div class="col-md-5">
      <?= $form->field($model, 'vehicle_num')->textInput(['class' => 'form-control input-sm'])->label('To Whom delivered for Transport and Vehicle No if any') ?>
</div>

 <div class="col-md-4">
      <?= $form->field($model, 'remarks')->textArea(['class' => 'form-control input-sm'])->label('Remarks') ?>
</div>


   
 </div>


<div class="col-md-12">
 <hr style="width:100%;border-top:2px solid #4682b4;opacity:10;">
</div>
<div class="col-md-12">
 <div class="pull-right">
    
        <label class="control-label" style="visibility: hidden;" for="delivery-remarks">Remarks</label>
         <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save & Print' : '<i class="fa fa-fw fa-edit "></i>Update & Print', ['value'=>'yes','id'=>$model->isNewRecord ? 'savedprint' : 'updatedprint' ,'class' => $model->isNewRecord ? 'btn btn-success pull-right tax' : 'btn btn-success updatetax']) ?>
     </div>
 <div class="pull-right">
 
        <label class="control-label" style="visibility: hidden;" for="delivery-remarks">Remarks</label>
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['value'=>'no','id'=>$model->isNewRecord ? 'saved' : 'updated' ,'class' => $model->isNewRecord ? 'btn btn-primary pull-right tax' : 'btn btn-primary updatetax']) ?>
  </div>
   <div class="pull-right">
   <?= Html::submitButton('<i class="fa fa-eye"></i>  Preview', ['class' => 'btn btn-danger','id'=>'preview_button','value'=>'preview']) ?>
    </div>
</div>


</div>
</div>
</div></div>
<span id="load" style="display: none;"><img src="<?= Url::to('@web/loader1.gif') ?>" /></span>
     <span id="loadtex" style="display: none; "></span>





    <?php ActiveForm::end(); ?>


<script>

$("#delivery-delivery_select").select2({ placeholder: "Select Delivery Address"}); 

<?php if(!empty($Deliveryaddress_update)) { ?>

var deliveryaddress_update=$.parseJSON('<?php echo $Deliveryaddress_update; ?>');

if(deliveryaddress_update !== null)
{
   var deliveryaddress='<option  value="">Select Delivery Address</option>';
   for (y in deliveryaddress_update)
   {
       deliveryaddress+='<option data-batch-no="'+deliveryaddress_update[y]['auto_id']+'" value="'+deliveryaddress_update[y]['auto_id']+'">'+deliveryaddress_update[y]['delivery_address']+'</option>';
       
   }
   $('#delivery-delivery_select').append(deliveryaddress);
}

<?php } ?>
var tax_type=$.parseJSON('<?php echo $tax_master_index_json; ?>');


$('#delivery-company_name').focus();

 jQuery(document).ready(function() {

    var fetch_estimte=$('#fetch_estimte tr').length;

    if(fetch_estimte === 0)
    {
        $('#tfoot_total_amount').hide();
    }



    $('#cleared').attr('disabled','disabled');
    $('#invoicetable-company_name').focus();
$('.manage').each(function() {
 
 


    var $wrapper = $('.process', this);
    var current = '<?php echo $k; ?>';

   
        $(".addclone", $(this)).click(function(e) {


            current++;
            var clone =$('.multi-field:first', $wrapper).clone(true) 
            $(clone).appendTo($wrapper).find('input,select,hidden').val('');
            var newid=localStorage.count_item=Number(localStorage.count_item)+1
           
            jQuery(clone).find('.description').attr('id', 'description'+current);
            jQuery(clone).find('.qty').attr('id', 'qty'+current);
            jQuery(clone).find('.hsn').attr('id', 'hsn'+current);



            jQuery(clone).find('.gst_rate').attr('id', 'gst_rate'+current);
            jQuery(clone).find('.amount').attr('id', 'amount'+current);
            jQuery(clone).find('.addclone').attr('id', 'addclone'+current);
            jQuery(clone).find('.removeclone').attr('id', 'removeclone'+current);


            jQuery(clone).find('.removeclone').attr('data-index',+current);
            jQuery(clone).find('.addclone').attr('data-index',+current);

            jQuery(clone).find('.amount').attr('data-index',+current);
            jQuery(clone).find('.qty').attr('data-index',+current);
            
            $('#description'+current).focus();
          
            
           
           
            if ($('.multi-field').length > 1) {
             
                $(this).parents('.addclone').hide();
                $(".removeclone").show();
            }
            
        });


        $(".removeclone").click(function(event) {
            if ($('.multi-field', $wrapper).length > 1) 
            {
                event.preventDefault();
                $(this).parents('.multi-field').remove();
            }

        });

});


jQuery("body").on('keypress', '.decimal_validated', function (e) 
            {
              //if the letter is not digit then display error and don't type anything
              if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
              {
                return false;
              }
            });

<?php 

    if($model->isNewRecord)
    {  ?>
        
       var comments_save='Are You Sure to Save ?'; 
       var comments_print='Are You Sure to Save & Print ?'; 

       var print_url='<?php echo Yii::$app->homeUrl ?>?r=delivery/printsave';
       var save_url='<?php echo Yii::$app->homeUrl ?>?r=delivery/create';

    <?php } else if(!$model->isNewRecord) {
    ?>

       var comments_save='Are You Sure to Update ?'; 
       var comments_print='Are You Sure to Update & Print ?'; 

       var print_url='<?php echo Yii::$app->homeUrl ?>?r=delivery/updateprint&id='+'<?php echo $model->id; ?>';
       var save_url='<?php echo Yii::$app->homeUrl ?>?r=delivery/update&id='+'<?php echo $model->id; ?>';

<?php } ?>

$('#delivery-form').on('beforeSubmit', function(e) {


  var fetch_estimte=$('#fetch_estimte tr').length;
    if(fetch_estimte === 0)
    {
        $('#description').focus();
        alert('No Product Will Be Add');
        return false;
    }

    $('#delivery-form').unbind('submit').submit();
   

    $('#delivery-form button').on('click', function(){

    var validated=$(this).val();

    if(validated === 'yes')
    {

            if (confirm(comments_print)) {
            
            $.ajax({
                url: print_url,
                type: 'POST',
                data:  $('#delivery-form').serialize(),
                success: function (data) {
               
                
                var obj=$.parseJSON(data);

                if(obj[0] == 'okay')
                {
                  
                    <?php if($model->isNewRecord) {?>
                        
                    var url_print='<?php echo Yii::$app->homeUrl ?>?r=delivery/print&id='+obj[1];
                    window.open(url_print,'_blank');  

                    var url='<?php echo Yii::$app->homeUrl ?>?r=delivery/reindex';
                    window.open(url,'_self');


                    <?php } else if(!$model->isNewRecord) { ?>
                        
                        
                       var url_print='<?php echo Yii::$app->homeUrl ?>?r=delivery/print&id='+'<?php echo $model->id; ?>';  
                          window.open(url_print,'_blank');  

                      var url='<?php echo Yii::$app->homeUrl ?>?r=delivery/reindex';
                      window.open(url,'_self');
                    <?php } ?>
                }
               
                },
                error: function () {
                    alert("Something went wrong");
                }
            }); }

    }
    else if(validated === 'no')
    {
            if (confirm(comments_save)) {
          
             $.ajax({
                url: save_url,
                type: 'POST',
                data: $('#delivery-form').serialize(),
                success: function (data) {
              
                
                var obj=$.parseJSON(data);

                if(obj[0] == 'okay')
                {
                  
                      <?php if($delivery_ref->isNewRecord) {?>
                   

                      var url='<?php echo Yii::$app->homeUrl ?>?r=delivery/reindex';
                      window.open(url,'_self');


                      <?php } else if(!$delivery_ref->isNewRecord) { ?>
                    
                      var url='<?php echo Yii::$app->homeUrl ?>?r=delivery/reindex';
                      window.open(url,'_self');
                    <?php } ?>
                }
               
                },
                error: function () {
                    alert("Something went wrong");
                }
            }); }
    }
    else if(validated === 'preview')
    {
          var array_data=JSON.stringify($('#delivery-form').serializeArray());
          var url='<?php echo Yii::$app->homeUrl ?>?r=delivery/printpreview&data='+array_data;
          window.open(url,'_blank');      

    }

}).on('submit', function(e){
    e.preventDefault();
});

    });

     







    });


 var availableTags = <?= $productlist_col_json; ?>;

    $(".typehead").typeahead({

        minLength: 1,
        delay: 5,
        source: availableTags,
        autoSelect: true,
        displayText: function(item)
        {
             return item.company;
        },
        afterSelect: function(item) 
        {
            $('#custId').val(item.primary_id);
            $("#delivery-cust_name").val(item.customer);
            $("#delivery-gstin_no").val(item.gst);
            $('#delivery-state').val(item.state);
            $('#delivery-state_code').val(item.state_code);
            $('#delivery-address').val(item.address);
            
            $('#delivery-delivery_address').val(item.address);
            

            //$('.description').parents('.description').focus();
            
            if(item.primary_id !== null || item.primary_id !== '')
            {
                $.ajax({
                url: '<?php echo Yii::$app->homeUrl ?>?r=delivery/deliveryaddress&id='+item.primary_id,
                type: 'POST',
                success: function (data) {
                    var obj=$.parseJSON(data);

                    $('#delivery-delivery_select').html('');
                    if(obj !== null)
                    {
                        var batch_no='<option  value="">Select Delivery Address</option>';
                       for (y in obj)
                       {

                           batch_no+='<option data-batch-no="'+obj[y]['auto_id']+'" value="'+obj[y]['auto_id']+'">'+obj[y]['delivery_address']+'</option>';
                           
                       }
                       $('#delivery-delivery_select').append(batch_no);
                    }
                }
              });
            }
            



        } 
    });




function DeliveryAddress(data_val)
{
  var value = $('#delivery-delivery_select').children("option:selected").html();
  
  $('#delivery-delivery_address').val(value);
  $('#description').focus();
}



function EmptyEsc(data_val,event)
{
     var keycode = (event.keyCode ? event.keyCode : event.which);
     
     if(keycode === 27 || keycode === 8 || keycode === 46 || keycode === 32)
     {
        $('#delivery-company_name').val('');
        $('#delivery-cust_name').val('');
        $('#delivery-gstin_no').val('');
        $('#delivery-state').val('');
        $('#delivery-state_code').val('');
        $('#custId').val('');
        $('#delivery-address').val('');
     }

     if(data_val === null || data_val === '')
     {
        $('#delivery-cust_name').val('');
        $('#delivery-gstin_no').val('');
        $('#delivery-state').val('');
        $('#delivery-state_code').val('');
        $('#custId').val('');
        $('#delivery-address').val('');
     }
}

function ClearField()
{
    window.location.reload(true);
}


var current = '<?php echo $k; ?>';
function Add_To_Grid()
{
    var hsn=$('#hsn').val();
    var description=$('#description').val();
    var amount=parseFloat($('#amount').val());
    var qty=parseInt($('#qty').val());
    var gst=$('#gst_rate').val();
   /* if(hsn === null || hsn === '')
    {   
        $('#hsn').focus();
        alert('Enter HSN Code');
        return false;
    }*/

    if(description === null || description === '')
    {
        $('#description').focus();
        alert('Enter DESCRIPTION');
        return false;
    }

    if(isNaN(amount))
    {
        /*$('#description').focus();
        alert('In-Valid Amount Entering');
        return false;*/
        amount=0;
    }

    if(isNaN(qty))
    {
        $('#qty').focus();
        alert('In-Valid Qty Entering');
        return false;
    }

    if(gst === null || gst === '')
    {
        $('#gst_rate').focus();
        alert('Select GST Rate');
        return false;
    }
    var batch_no='';
     <?php if(!empty($tax_master_index_json)) {

      ?>
    var taxmaster=$.parseJSON('<?php echo $tax_master_index_json; ?>');

    if(taxmaster !== null)
    {
        
       for (y in taxmaster)
       {
           batch_no+='<option value='+taxmaster[y]['taxid']+'>'+taxmaster[y]['taxgroup']+'</option>';
       }
       
    }
  <?php } else if(empty($tax_master_index_json)) { ?>

     var taxmaster=[];
  <?php }?>


    /*var append_string='<tr data-id='+current+' id="row_id'+current+'" class="row_id">'+
    '<td data-id='+current+' id="sl_id'+current+'" class="sl_id"></td>'+
    '<td><div> '+description+'</div><input type="hidden" class="form-control input-sm description_table disabled_field" readonly id="description_table'+current+'" value="'+description+'" name="DeliveryRef[description_table][]"/></td>'+


    '<td><div> '+qty+'</div><input type="hidden" class="form-control input-sm qty_table disabled_field" readonly id="qty_table'+current+'" value="'+qty+'" name="DeliveryRef[qty_table][]"/></td>'+


    '<td><div> '+hsn+'</div><input type="hidden" class="form-control input-sm hsn_table disabled_field" readonly id="hsn_table'+current+'" value="'+hsn+'" name="DeliveryRef[hsn_table][]"/></td>'+


    '<td><div> '+tax_type[gst]['taxvalue']+'</div><input type="hidden" class="form-control input-sm hsn_table disabled_field" readonly id="gstrate_table'+current+'" value="'+gst+'" name="DeliveryRef[gst_rate_table][]"/></td>'+

      '<td><div style="text-align:right;"> '+amount+'</div><input type="hidden" class="form-control input-sm amount_table disabled_field" readonly id="amount_table'+current+'" value="'+amount+'" name="DeliveryRef[amount_table][]"/></td>'+

    '<td style="text-align:center;"><button type="button" class="btn btn-danger btn-xs disabled_field" style="text-align:center;" onclick="Remove('+current+');">Remove</button></td>'+
    '</tr>';*/

        var append_string='<tr data-id="'+current+'" id="row_id'+current+'" class="row_id">'+
    '<td data-id="'+current+'" id="sl_id'+current+'" class="sl_id">'+current+'</td>'+
    '<td><input type="text" class="form-control input-sm description_table disabled_field" required id="description_table'+current+'" name="DeliveryRef[description_table][]" value="'+description+'"></td>'+
    '<td><input type="text" class="form-control input-sm qty_table disabled_field decimal_validated" id="qty_table'+current+'" name="DeliveryRef[qty_table][]" value="'+qty+'" required></td>'+
    '<td><input type="text" class="form-control input-sm hsn_table disabled_field" id="hsn_table'+current+'" name="DeliveryRef[hsn_table][]" readonly value="'+hsn+'"></td>'+
    '<td><select id="gstrate_table'+current+'" class="form-control input-sm gst_rate" required name="DeliveryRef[gst_rate_table][]">'+
    '<option value="">-SELECT-</option>'+batch_no+'</select></td><td><input type="text" id="amount_table'+current+'" class="decimal_validated form-control input-sm no-padding amount" name="DeliveryRef[amount_table][]" value="'+amount+'"></td><td style="text-align:center;"><button type="button" class="btn btn-danger btn-xs disabled_field" style="text-align:center;" onclick="Remove('+current+');">Remove</button></td></tr>';


    
    $('#fetch_estimte').append(append_string);

    $('#gstrate_table'+current).val(gst);


   


    $('#hsn').val('');
    $('#description').val('');
    $('#amount').val('');
    $('#qty').val('')
    $('#gst_rate').val('');
    $('#description').focus();
    $('#tfoot_total_amount').show();
    current++;
    TotalAmount();
}

function TotalAmount()
{
    var total_amount=0;
    var insert_id=1;    
    $(".row_id").each(function() 
    {
        var data_id=$(this).attr('data-id');

        var amount=parseFloat($('#amount_table'+data_id).val());
        if(!isNaN(amount))
        {
            total_amount=total_amount+amount;    
        }


        $('#sl_id'+data_id).html(insert_id);
        insert_id++;
    });

    $('#total_amount_add').html(total_amount);
}


function Remove(data_val)
{
    $('#row_id'+data_val).remove();

    TotalAmount();

    var fetch_estimte=$('#fetch_estimte tr').length;

    if(fetch_estimte === 0)
    {
        $('#tfoot_total_amount').hide();
    }
}
</script>