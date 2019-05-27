<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Estimate */
/* @var $form yii\widgets\ActiveForm */

if(!empty($customer_master))
{
    foreach ($customer_master as $key => $value) 
    {
        $productlist_col_val[] = array('company' => $value['company_name'],'customer' => $value['customer_name'],'gst'=> $value['gst'],'primary_id' => $value['auto_id'],'state_code'=>$value['state_code']);
    }
}
        $productlist_col_json = json_encode($productlist_col_val);  
?>

<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>

<style type="text/css">
    

ul.typeahead.dropdown-menu {
    width: 96%;
}
ul.typeahead.dropdown-menu>li>a{
    font-size: 16px;
        color: #031d33;
        font-weight: bold;
        
}

.table>tbody>tr>td
{
    padding: 0px;
}

textarea.form-control {
    min-height: 51px;
}
</style>


  <?php $form = ActiveForm::begin(['options'=> ['autocomplete'=>'off','onsubmit'=>"return false;"]]); ?>
 <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-border panel-custom">
                                    <div class="panel-heading">
                                        
                                    </div>
                                    <div class="panel-body">                              

    
<div class="ot-job-form">

<div class="col-md-12">
    <div class="col-md-6">
        <?= $form->field($estimate_main_tbl_create, 'company_name')->textInput(['maxlength' => true,'class'=>'form-control  input-sm typehead disabled_field','onkeyup'=>'EmptyEsc(this.value,event);'])->label('COMPANY NAME') ?>
         <input type="hidden" id="custId" name="custId">
          <?= $form->field($estimate_main_tbl_create, 'customer_name')->hiddenInput(['readonly' => true,'class'=>'form-control input-sm disabled_field'])->label(false) ?>
     </div>
    
      <!--div class="col-md-2">
        <?//= $form->field($estimate_main_tbl_create, 'sac')->textInput(['class'=>'form-control input-sm disabled_field','maxlength'=>10])->label('SAC CODE') ?>
     </div-->
      <div class="col-md-3">
        <?= $form->field($estimate_main_tbl_create, 'gst_type')->dropDownList(['GST'=>'GST','IGST'=>'IGST'],['class' => 'form-control input-sm','prompt'=>"-SELECT-"])->label('GST TYPE') ?>
     </div>
     <div class="col-md-3">
        <?= $form->field($estimate_main_tbl_create, 'gst')->dropDownList($tax_master,['required'=>true,'class' => 'form-control input-sm no-padding'])->label('GST RATE') ?>
     </div>
     <!--div class="col-md-2">
        <?//= $form->field($model, 'bill_number')->textInput(['readonly' => true,'class'=>'form-control input-sm disabled_field'])->label('SERIAL NUMBER') ?>
     </div-->
 </div>
</div> 

<div class="col-md-12">
<hr style="width:100%;border:1px solid #4682b4;opacity:10;">  
</div>
<div class="ot-job-form">
<div class="col-md-12">
    <div class="col-md-9">
        <?= $form->field($model, 'particular_field')->textArea(['row'=>1,'maxlength' => true,'onkeyup'=>'Particular(this.value,event);','class'=>'form-control input-sm disabled_field'])->label('PARTICULAR')?>
     </div>
      <div class="col-md-2">
        <?= $form->field($model, 'amount')->textInput(['maxlength' => true,'style'=>'text-align:right;','onkeyup'=>'AMOUNT(this.value,event);','class'=>'form-control input-sm disabled_field'])->label('AMOUNT') ?>
      </div> 
      <div class="col-md-1">
        <label class="control-label" for="estimate-amount"></label>
        <?= Html::Button('Add To Grid', ['class' => 'btn btn-primary btn-xs disabled_field','onclick'=>'AddToGrid();','id'=>'AddToGridID']) ?>
     </div> 
</div> 



</div>
<div class="col-md-12">
<hr style="width:100%;border:1px solid #4682b4;opacity:10;">
</div>
<div class="ot-job-form">
    <div class="col-md-12">
            <div class="col-md-12">

             <table class="table table-bordered  ">
            <thead>
              <tr>
                <th style="text-align: center;width:80%;">Estimate Details</th>
                <th style="text-align: center;width:10%;">Amount</th>
                <th style="text-align: center;width:10%;">Action</th>
              </tr>
            </thead>
            <tbody id='fetch_estimte'>
              
            </tbody>
            <tfoot id="tfoot_total_amount">
                <tr>
                    <td style="text-align: right;">
                       <b> Total Amount </b>
                    </td>
                    <td style="text-align: right;color: blue;" id="total_amount_add">
                        
                    </td>
                    <td>
                        
                    </td>
                </tr>
            </tfoot>
          </table>
        </div> 
    </div>
</div>


</div>
</div>
</div>
</div>

                            

    


 <div id="load1" style='display:none;text-align: center;'><img  class="load-image"  src="<?= Url::to('@web/loader1.gif') ?>" /></div>

 <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-border panel-custom">
                                    <div class="panel-heading">
                                        
                                    </div>
                                    

<div class="panel-body">  

     <div class="pull-right">
         <!--a onclick="document.getElementById('w0').submit();" target="_blank">Preview</a-->
         <?= Html::submitButton('<i class="fa fa-eye"></i>  Preview', ['class' => 'btn btn-danger','id'=>'preview_button','value'=>'preview']) ?>
        <?= Html::submitButton('<i class="fa fa-fw fa-print"></i> Save & Print', ['class' => 'btn btn-success disabled_field save_button_click','id'=>'save_print_button','value'=>'yes','name'=>'SaveButton']) ?>  
        <?= Html::submitButton('<i class="fa fa-fw fa-save"></i> Save', ['class' => 'btn btn-primary disabled_field save_button_click','id'=>'save_button','value'=>'no','name'=>'SaveButton']) ?>  
       
       
     </div>
</div>

</div>


</div>
</div>


   <?php ActiveForm::end(); ?>


<script type="text/javascript">


//$('#load1').show();

var fetch_estimte=$('#fetch_estimte tr').length;

if(fetch_estimte === 0)
{
    $('#tfoot_total_amount').hide();
}


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
            $("#estimatemaintbl-customer_name").val(item.customer);
            $("#estimatemaintbl-sac").focus();

            $('#fetch_estimte tr').remove();
        } 
    });


function EmptyEsc(data_val,event)
{
     var keycode = (event.keyCode ? event.keyCode : event.which);

     if(keycode === 27 || keycode === 8 || keycode === 46 || keycode === 32)
     {
        $('#estimatemaintbl-company_name').val('');
        $('#estimatemaintbl-customer_name').val('');
        $('#custId').val('');
     }

     if(data_val === null || data_val === '')
     {
        $('#estimatemaintbl-company_name').val('');
        $('#estimatemaintbl-customer_name').val('');
        $('#custId').val('');
     }
}


var auto_increment=1;    
function AddToGrid() 
{
    var estimate_data_val=$('#estimate-particular_field').val();



    if(estimate_data_val === null || estimate_data_val === '')
    {
        $('#estimate-particular_field').focus();
        alert('Estimate Field Not Empty');
        return false;
    }

    var estimate_amount=parseFloat($('#estimate-amount').val());

    if(isNaN(estimate_amount))
    {
        $('#estimate-amount').focus()
        alert('In-Valid Amount');
        return false;
    }

    var append_string='<tr data-id='+auto_increment+' id="row_id'+auto_increment+'" class="row_id">'+
    '<td style="width:80%;"><input type="text"  class="form-control input-sm estimate_data_val disabled_field" required id="estimate_data_val'+auto_increment+'" value="'+estimate_data_val+'" name="EstimateTypeValue[]"/></td>'+
    '<td style="width:10%;"><input type="text" class="form-control input-sm estimate_amount disabled_field decimal_validated"  style="text-align:right;" readonly id="estimate_amount'+auto_increment+'" value="'+estimate_amount+'" name="EstimateAmount[]"></td>'+
    '<td style="text-align:center;width:10%;"><button type="button" class="btn btn-danger btn-xs disabled_field" style="text-align:center;" onclick="Remove('+auto_increment+');">Remove</button></td>'+
    '</tr>';

    $('#fetch_estimte').append(append_string);
    
  

    $('#estimate-amount').val('');
    $('#estimate-particular_field').val('');
    $('#estimate-particular_field').focus();
     $('#tfoot_total_amount').show();
    auto_increment++;
    TotalAmount();
}


function TotalAmount()
{
    var total_amount=0;    
    $(".row_id").each(function() 
    {
        var data_id=$(this).attr('data-id');

        var amount=parseFloat($('#estimate_amount'+data_id).val());
        if(!isNaN(amount))
        {
            total_amount=total_amount+amount;    
        }
        
    });

    $('#total_amount_add').html(total_amount);
}


function Particular(data_val,event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    var company_name=$('#estimatemaintbl-company_name').val();
    if(company_name === null || company_name === '')
    {
        $('#estimate-particular_field').val('');
        $('#estimatemaintbl-company_name').focus();
        alert('Company Name Required');
        return false;
    }

    if(data_val === null || data_val === '')
    {
        return false;
    }

    if(keycode === 13)
    {   
        event.preventDefault();
        $('#estimate-amount').focus();
    }
}

function AMOUNT(data_val,event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);

     if(keycode === 13)
    {
        $('#AddToGridID').focus();
    }
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




function ClearButton()
{
     
     $('.disabled_field').val('');
     $('.disabled_field').removeAttr('disabled','disabled');
     $('#fetch_estimte tr').remove();
     $('#tfoot_total_amount').hide();
     $('#total_amount_add').html('');
     $('#estimate-company_name').focus();
}



jQuery(document).ready(function() {

  $('#w0').on('beforeSubmit', function(e) {

    var company_name=$('#estimate-company_name').val();

    if(company_name === null || company_name === '')
    {
        $('#estimate-company_name').focus();
        alert('Company Name Required');
        return false;
    }

    var fetch_estimte=$('#fetch_estimte tr').length;
    if(fetch_estimte === 0)
    {
        $('#estimate-particular_field').focus();
        alert('No Product Will Be Add');
        return false;
    }
    

    //save_button
   // save_print_button
   $('#w0').unbind('submit').submit();
   

    $('#w0 button').on('click', function(){

          var validated=$(this).val();
        
      
        if(validated === 'yes')
        {
             if (confirm('Are You Sure to Save & Print ?')) { 
    
               e.preventDefault();
               
                
                $.ajax({
                    url: '<?php echo Yii::$app->homeUrl ?>?r=estimate/saveprint',
                    type: 'POST',
                    data: $('#w0').serialize(),
                    success: function (data) {
                  
                    
                    var obj=$.parseJSON(data);
                    
                    if(obj[0] === 'okay')
                    {   
                        
                        var print='<?php echo Yii::$app->homeUrl ?>?r=estimate/print&id='+obj[1];
                        window.open(print,'_blank');

                        var url='<?php echo Yii::$app->homeUrl ?>?r=estimate/reindex';
                        window.open(url,'_self');
                    }
                    },
                    error: function () {
                        alert("Something went wrong");
                    }
                });
              }
        }
        else if(validated === 'no')
        {
              if (confirm('Are You Sure to Save ?')) { 
                e.preventDefault();
               
                
                $.ajax({
                    url: '<?php echo Yii::$app->homeUrl ?>?r=estimate/create',
                    type: 'POST',
                    data: $('#w0').serialize(),
                    success: function (data) {
                    $("#load").hide(4);
                    
                    var obj=$.parseJSON(data);
                    
                    if(obj[0] === 'okay')
                    {   
                      

                        var url='<?php echo Yii::$app->homeUrl ?>?r=estimate/reindex';
                        window.open(url,'_self');
                    }
                    },
                    error: function () {
                        alert("Something went wrong");
                    }
                });
              }
        }
        else if(validated === 'preview')
        {
              var array_data=JSON.stringify($('#w0').serializeArray());
             var url='<?php echo Yii::$app->homeUrl ?>?r=estimate/printpreview&data='+array_data;
             window.open(url,'_blank');
        }




       

      
     });

    
}).on('submit', function(e){
    e.preventDefault();
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


 

</script>