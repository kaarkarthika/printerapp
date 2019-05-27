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


$this->title = 'Update Estimate Slip';
$this->params['breadcrumbs'][] = ['label' => 'Estimates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>

<style type="text/css">
    

ul.typeahead.dropdown-menu {
    width: 96%;
}
ul.typeahead.dropdown-menu>li>a{
    font-size: 16px;
        color: blue;
        
}

 
textarea.form-control {
    min-height: 51px;
}
</style>


  <?php $form = ActiveForm::begin(['options'=> ['autocomplete'=>'off','onsubmit'=>"return false;"]]); ?>

<div class="container">
   <div class="row">
<div class="col-sm-12">
<?php
  
    $session = Yii::$app->session;
    
    echo Html::a('Manage Estimate', ['index'],['class' => 'btn btn-primary waves-effect waves-light pull-right']);
   ?>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
                <ol class="breadcrumb">
                   <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
                   <li><a href="#"><?php echo $this->title;?></a></li>
                  
                </ol>
              </div>
            </div>



 <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-border panel-custom">
                                    <div class="panel-heading">
                                        
                                    </div>
                                    <div class="panel-body">                              

    
<div class="ot-job-form">

<div class="col-md-12">
    <div class="col-md-6">
        <?= $form->field($estimate_main_tbl_create, 'company_name')->textInput(['readonly' => true,'class'=>'form-control typehead input-sm disabled_field','onkeyup'=>'EmptyEsc(this.value,event);'])->label('COMPANY NAME') ?>
         <input type="hidden" id="custId" name="custId" value='<?php echo $estimate_main_tbl_create->customer_id; ?>'>

            <?= $form->field($estimate_main_tbl_create, 'customer_name')->hiddenInput(['readonly' => true,'class'=>'form-control input-sm disabled_field','value'=>$customer_master_single_fetch['customer_name']])->label(false) ?>
     </div>
    
       <!--div class="col-md-2">
        <?//= $form->field($estimate_main_tbl_create, 'sac')->textInput(['required'=>true,'class'=>'form-control input-sm disabled_field','maxlength'=>10])->label('SAC CODE') ?>
     </div-->
     <div class="col-md-2">
        <?= $form->field($estimate_main_tbl_create, 'gst_type')->dropDownList(['GST'=>'GST','IGST'=>'IGST'],['class' => 'form-control input-sm','prompt'=>"-SELECT-"])->label('GST TYPE') ?>
     </div>
     <div class="col-md-2">
        <?= $form->field($estimate_main_tbl_create, 'gst')->dropDownList($tax_master,['required'=>true,'class' => 'form-control input-sm no-padding','required'=>'true'])->label('GST RATE') ?>
     </div>
     <div class="col-md-2">
      <div>
        <label>Bill NUMBER</label>
        <br/>
        <b style="color: blue;"><?php echo $estimate->bill_number; ?></b>
      </div>
        <?//= $form->field($estimate, 'bill_number')->textInput(['readonly' => true,'class'=>'form-control input-sm disabled_field'])->label('BILL NUMBER') ?>
     </div>
 </div>
</div> 
<div class="col-md-12">
<hr style="width:100%;border-top:2px solid #4682b4;opacity:10;"> 
</div>
<div class="ot-job-form">
<div class="col-md-12">
    <div class="col-md-9">
        <?= $form->field($model, 'particular_field')->textArea(['maxlength' => true,'onkeyup'=>'Particular(this.value,event);','class'=>'form-control input-sm disabled_field'])->label('PARTICULAR')?>
     </div>
      <div class="col-md-2">
        <?= $form->field($model, 'amount')->textInput(['maxlength' => true,'style'=>'text-align:right;','onkeyup'=>'AMOUNT(this.value,event);','class'=>'form-control input-sm disabled_field'])->label('AMOUNT') ?>
      </div> 
      <div class="col-md-1">
         <label class="control-label" for="estimate-amount" style="visibility: hidden;">ssss</label>
        <?= Html::Button('Add To Grid', ['class' => 'btn btn-primary btn-xs disabled_field','onclick'=>'AddToGrid();','id'=>'AddToGridID']) ?>
     </div> 
</div> 
<div class="col-md-12">
<hr style="width:100%;border-top:2px solid #4682b4;opacity:10;"> 
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
              <?php 
                $auto_increment=1;
                if(!empty($Estimate))
                {
                    foreach ($Estimate as $key => $value) 
                    {
              ?>
                    <tr data-id='<?php echo $auto_increment; ?>' id="row_id<?php echo $auto_increment; ?>" class="row_id">
    <td style="text-align: left;width:80%;"><input type="text" class="form-control input-sm estimate_data_val disabled_field" required id="estimate_data_val<?php echo $auto_increment; ?>"  name="EstimateTypeValue[]" value='<?php echo $value['particular_field']; ?>'></td>

    <td style="text-align: left;width:10%;"><input type="text" class="form-control input-sm estimate_amount disabled_field"  style="text-align:right;" readonly id="estimate_amount<?php echo $auto_increment; ?>" value="<?php echo $value['amount']; ?>" name="EstimateAmount[]"></td>

    <td style="text-align:center;width:10%;"><button type="button" class="btn btn-danger btn-xs disabled_field" style="text-align:center;" onclick="Remove(<?php echo $auto_increment; ?>);">Remove</button></td>
    </tr>
          <?php  $auto_increment++; } } ?>
            </tbody>
            <tfoot id="tfoot_total_amount">
                <tr>
                    <td style="text-align: right;">
                       <b> Total Amount </b>
                    </td>
                    <td  id="total_amount_add" style="text-align: right;color: blue;">
                        <?php echo $estimate->total_amount; ?>
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
</div>

 <div class="row">
                   
 <div id="load1" style='display:none;text-align: center;'><img  class="load-image"  src="<?= Url::to('@web/loader1.gif') ?>" /></div>

 <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-border panel-custom">
                                    <div class="panel-heading">
                                        
                                    </div>
                                    

<div class="panel-body">  
            <div class="pull-right">
            
          <?= Html::submitButton('<i class="fa fa-eye"></i> Preview', ['class' => 'btn btn-danger','id'=>'preview_button','value'=>'preview']) ?>
             
         <?= Html::submitButton('<i class="fa fa-fw fa-print"></i> Update & Print', ['class' => 'btn btn-success disabled_field','id'=>'save_print_button','value'=>'yes']) ?> 
        <?= Html::submitButton('<i class="fa fa-fw fa-edit"></i> Update', ['class' => 'btn btn-primary disabled_field','id'=>'save_button','value'=>'no']) ?>
        
     </div>
 <!--div class="col-md-1 pull-right">
     <?//= Html::Button('Edit', ['class' => 'btn btn-danger','onclick'=>'ClearButton();','id'=>'update_button']) ?>
       </div-->
</div>

</div>


</div>
</div>
</div>

<!-- <div class="row">
<div class="col-sm-8">
    <div class="panel panel-border panel-custom">
        <div class="panel-heading">
            
        </div>
       
</div>
</div>
</div> -->
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
            $("#estimate-customer_name").val(item.customer);
            $("#estimate-particular_field").focus();

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


var auto_increment='<?php echo $auto_increment; ?>';    
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
    '<td style="width:80%;"><input type="text" class="form-control input-sm estimate_data_val disabled_field" required id="estimate_data_val'+auto_increment+'" name="EstimateTypeValue[]" value="'+estimate_data_val+'"></td>'+
    '<td style="width:10%;"><input type="text" class="form-control input-sm estimate_amount disabled_field"  style="text-align:right;" readonly id="estimate_amount'+auto_increment+'" value="'+estimate_amount+'" name="EstimateAmount[]"></td>'+
    '<td style="text-align:center;width:10%;"><button type="button" class="btn btn-danger btn-xs disabled_field" style="text-align:center;" onclick="Remove('+auto_increment+');">Remove</button></td>'+
    '</tr>';

    $('#fetch_estimte').append(append_string);
        
   // $('#estimate_data_val'+auto_increment).text(estimate_data_val);

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
    var company_name=$('#estimate-company_name').val();
    if(company_name === null || company_name === '')
    {
        $('#estimate-particular_field').val('');
        $('#estimate-company_name').focus();
        alert('Company Name Required');
        return false;
    }

    if(data_val === null || data_val === '')
    {
        return false;
    }

    if(keycode === 13)
    {
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

function SaveButton()
{

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

var valid=$('#w0').valid();

if(valid === true)
{
    if (confirm('Are You Sure to Update ?')) {

        var prime_id='<?php echo $estimate->id; ?>';

    $.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=estimate/update&id=";?>"+prime_id,
        data: $("#w0").serialize(),
        success: function (result) 
        {
            var obj = $.parseJSON(result);
            if(obj[0] === 'okay')
            {
                $('#update_button').removeAttr('disabled','disabled');
                $('.disabled_field').attr('disabled','disabled');
                $('#estimate-bill_number').val(obj[1]);
                alert('Record Updated Successfully');
            }
            else if(obj[0] === 'invalid')
            {
                alert('In-Valid Customer Name');
            }
        }
     });
    }
}

}
// $('.disabled_field').attr('disabled','disabled');
function ClearButton()
{
     
   //  $('.disabled_field').val('');
     $('.disabled_field').removeAttr('disabled','disabled');
     //$('#fetch_estimte tr').remove();
     //$('#tfoot_total_amount').hide();
     //$('#total_amount_add').html('');
     $('#estimate-particular_field').focus();
     $('#update_button').attr('disabled','disabled');
}



jQuery(document).ready(function() {

  var inc=1;
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
    
   $('#w0').unbind('submit').submit();
   
     $(':button').click(function() {

    
      
          var validated=$(this).val();
        
        if(inc === 1)
      {
        if(validated === 'yes')
        {
             if (confirm('Are You Sure to Update & Print ?')) { 
    
               e.preventDefault();
               
                
                $.ajax({
                    url: '<?php echo Yii::$app->homeUrl ?>?r=estimate/updateprint&id='+'<?php echo $estimate_main_tbl_create->id; ?>',
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
              if (confirm('Are You Sure to Update ?')) { 
                e.preventDefault();
               
                
                $.ajax({
                    url: '<?php echo Yii::$app->homeUrl ?>?r=estimate/update&id='+'<?php echo $estimate_main_tbl_create->id; ?>',
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
      }
  });
}).on('submit', function(e){
    e.preventDefault();
});

});




</script>