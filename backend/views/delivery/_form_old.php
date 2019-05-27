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
<style type="text/css">
    
textarea.form-control {
     min-height: 50px;
     min-width: 150px; 
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
    <?php $form = ActiveForm::begin(['id'=>'delivery-form','options'=> ['autocomplete'=>'off']]); ?>


 <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-border panel-custom">
                                    <div class="panel-heading">
                                        
                                    </div>
                                    <div class="panel-body">                              

    
<div class="ot-job-form">

  <div class="col-md-12">

<div class="col-md-3">

    <?= $form->field($model, 'company_name')->textInput(['readonly'=> $model->isNewRecord ? false : true,'maxlength' => true,'class'=>'form-control input-sm typehead','onkeyup'=>'EmptyEsc(this.value,event);'])->label('COMPANY NAME') ?>

     <input type="hidden" id="custId" name="custId">

</div>
<div class="col-md-3">

    <?= $form->field($model, 'cust_name')->textInput(['readonly' => true])->label('CUSTOMER NAME') ?>
</div>
<div class="col-md-3">
    <?= $form->field($model, 'gstin_no')->textInput(['readonly' => true])->label('GST') ?>
</div>
<div class="col-md-3">
    <?= $form->field($model, 'state')->textInput(['readonly' => true])->label('STATE') ?>
</div>
</div>
<div class="col-md-12">
<div class="col-md-3">
    <?= $form->field($model, 'state_code')->textInput(['readonly' => true])->label('STATE CODE') ?>
</div>

<div class="col-md-3">
    <?= $form->field($model, 'address')->textArea(['readonly' => true])->label('Address') ?>
</div>

<div class="col-md-3">
 <?= $form->field($model, 'bill_no')->textInput(['readonly' => true])->label('BILL NO') ?>

</div>


    <div class="col-md-3">
       <?= $form->field($model, 'bill_date')->textInput(['readonly' => true])->label('BILL DATE') ?>
</div> 

<div class="col-md-3">
   
</div></div>



    

</div>
</div>
</div>
</div>
<span id="load" style="display: none;"><img src="<?= Url::to('@web/loader1.gif') ?>" /></span>
     <span id="loadtex" style="display: none; "></span>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        
    </div>
<div class="panel-body">    

<div class="manage ">
    <div class="fields  process">

<?php

    if($model->isNewRecord)
    {
        $k=1;
?>


  <div class="multi-field "> 

<div class="col-md-12">

        <div class="col-md-3">
            <?= $form->field($delivery_ref, 'description')->textInput(['class' => 'form-control input-sm description','id'=>'description'.$k,'name'=>'DeliveryRef[description][]','required'=>'true'])->label('Description') ?>
        </div>

         <div class="col-md-1">
            <?= $form->field($delivery_ref, 'qty')->textInput(['class' => 'decimal_validated form-control input-sm qty','id'=>'qty'.$k,'name'=>'DeliveryRef[qty][]','required'=>'true'])->label('Qty') ?>
        </div>


         <div class="col-md-2">
            <?= $form->field($delivery_ref, 'hsn')->textInput(['data-index'=>$k,'class' => 'decimal_validated form-control input-sm hsn','id'=>'hsn'.$k,'name'=>'DeliveryRef[hsn][]','required'=>'true'])->label('HSN CODE') ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($delivery_ref, 'gst_rate')->dropDownList($tax_master,['data-index'=>$k,'class' => 'form-control input-sm gst_rate','id'=>'gst_rate'.$k,'name'=>'DeliveryRef[gst_rate][]','required'=>'true'])->label('GST RATE') ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($delivery_ref, 'amount')->textInput(['data-index'=>$k,'class' => 'decimal_validated form-control input-sm amount','id'=>'amount'.$k,'name'=>'DeliveryRef[amount][]','required'=>'true'])->label('Amount') ?>
        </div>
        

         <div class="col-md-1">
             <div class="form-group">
                <?= Html::Button('<i class="fa fa-plus" aria-hidden="true"></i>', ['class' => 'btn btn-success mt-25 btn-xs addclone','id'=>'addclone'.$k,'data-index'=>$k]) ?>
            </div>
        </div>
        <div class="col-md-1">
             <div class="form-group">
                <?= Html::Button('<i class="fa fa-remove" aria-hidden="true"></i>', ['class' => 'btn btn-danger mt-25 btn-xs removeclone','id'=>'removeclone'.$k,'data-index'=>$k]) ?>
            </div>
        </div>
    </div>
</div>

<?php } else {  
    $k=1;
    if(!empty($findDeliveryRef))
  {

    foreach ($findDeliveryRef as $key => $value) {
        


    ?>

 <div class="multi-field "> 

<div class="col-md-12">

        <div class="col-md-3">
            <?= $form->field($delivery_ref, 'description')->textInput(['class' => 'form-control input-sm description','id'=>'description'.$k,'name'=>'DeliveryRef[description][]','required'=>'true','value'=>$value['description']])->label('Description') ?>
        </div>

         <div class="col-md-1">
            <?= $form->field($delivery_ref, 'qty')->textInput(['class' => 'decimal_validated form-control input-sm qty','id'=>'qty'.$k,'name'=>'DeliveryRef[qty][]','required'=>'true','value'=>$value['qty']])->label('Qty') ?>
        </div>


         <div class="col-md-2">
            <?= $form->field($delivery_ref, 'hsn')->textInput(['data-index'=>$k,'class' => 'decimal_validated form-control input-sm hsn','id'=>'hsn'.$k,'name'=>'DeliveryRef[hsn][]','required'=>'true','value'=>$value['hsn']])->label('HSN CODE') ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($delivery_ref, 'gst_rate')->dropDownList($tax_master,['options' => [$value['gst_rate'] => ['Selected'=>'selected']],'data-index'=>$k,'class' => 'form-control input-sm gst_rate','id'=>'gst_rate'.$k,'name'=>'DeliveryRef[gst_rate][]','required'=>'true'])->label('GST RATE') ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($delivery_ref, 'amount')->textInput(['data-index'=>$k,'class' => 'decimal_validated form-control input-sm amount','id'=>'amount'.$k,'name'=>'DeliveryRef[amount][]','required'=>'true','value'=>$value['amount']])->label('Amount') ?>
        </div>
        

         <div class="col-md-1">
             <div class="form-group">
                <?= Html::Button('<i class="fa fa-plus" aria-hidden="true"></i>', ['class' => 'btn btn-success mt-25 btn-xs addclone','id'=>'addclone'.$k,'data-index'=>$k]) ?>
            </div>
        </div>
        <div class="col-md-1">
             <div class="form-group">
                <?= Html::Button('<i class="fa fa-remove" aria-hidden="true"></i>', ['class' => 'btn btn-danger mt-25  btn-xs removeclone','id'=>'removeclone'.$k,'data-index'=>$k]) ?>
            </div>
        </div>
    </div>
</div>

<?php $k++; } } } ?>





</div></div>


</div>
</div>
</div>
</div>


<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
    <div class="panel-heading">
        
    </div>
<div class="panel-body">  
<div class="col-md-12">

     <div class="col-md-3">
    <?= $form->field($model, 'transport')->dropDownList($transport_array,['prompt'=>'--SELECT--','class' => 'form-control input-sm'])->label('Purpose Of Transport') ?>
</div>

  <div class="col-md-3">
      <?= $form->field($model, 'vehicle_num')->textInput(['class' => 'form-control input-sm'])->label('To Whom delivered for Transport and Vehicle No if any') ?>
</div>

 <div class="col-md-3">
      <?= $form->field($model, 'remarks')->textArea(['class' => 'form-control input-sm'])->label('Remarks') ?>
</div>


    <div class="col-md-1">
 <div class="form-group">
       
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['id'=>$model->isNewRecord ? 'saved' : 'updated' ,'class' => $model->isNewRecord ? 'btn btn-success pull-right tax' : 'btn btn-primary pull-right updatetax']) ?>

    </div></div>
 <div class="col-md-1">
     <div class="form-group">
        <?= Html::Button( 'Clear'  , ['class' => 'btn btn-danger','id'=>'cleared','onclick'=>'ClearField();']) ?>
    </div>
    </div> </div>
</div>
</div>
</div>
</div>



    <?php ActiveForm::end(); ?>


<script>

$('#delivery-company_name').focus();

 jQuery(document).ready(function() {

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



$('#delivery-form').on('beforeSubmit', function(e) {
    $("#load").show();
   e.preventDefault();
    var form = $(this);
    var formData = form.serialize();
    
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        $("#load").hide(4);
        
        var obj=$.parseJSON(data);

        if(obj[0] == 'okay')
        {
            <?php if($model->isNewRecord) {?>
             $('#saved').attr('disabled','disabled');
             $('#cleared').removeAttr('disabled','disabled');
             $('#delivery-bill_no').val(obj[1]);
             $('#delivery-bill_date').val('<?php echo date('d-m-Y H:i:s'); ?>');
             alert('Record Saved Successfully');
             $("#load").hide();
            <?php } else { ?>
             $('#updated').attr('disabled','disabled');
             $('#cleared').removeAttr('disabled','disabled');
             alert('Record Saved Successfully');
             $("#load").hide();

            <?php } ?>
        }
        else
        {
            
        } 
        },
        error: function () {
            alert("Something went wrong");
        }
    });
}).on('submit', function(e){
    e.preventDefault();
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
            
            $('.description').parents('.description').focus();
            
        } 
    });


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
</script>