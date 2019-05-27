<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\InvoiceTable */
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
        color: blue;
        
}

.amount
{
    text-align: right;
}

textarea.form-control {
    min-height: 50px;
}

</style>

<?php $form = ActiveForm::begin(['id'=>'invoice-form','options'=> ['autocomplete'=>'off']]); ?>
<div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-border panel-custom">
                                    <div class="panel-heading">
                                        
                                    </div>
                                    <div class="panel-body">    

    <div class="col-md-12">

<div class="col-md-4">
    <?= $form->field($model, 'company_name')->textInput(['readonly'=> $model->isNewRecord ? false : true,'maxlength' => true,'class'=>'form-control typehead','onkeyup'=>'EmptyEsc(this.value,event);'])->label('COMPANY NAME') ?>
    <input type="hidden" id="custId" name="custId">
</div>
<div class="col-md-2">
    <?= $form->field($model, 'customer_name')->textInput(['readonly' => true,'required'=>true])->label('CUSTOMER NAME') ?>
</div>
<div class="col-md-2">
    <?= $form->field($model, 'gstin_no')->textInput(['readonly' => true,'required'=>true])->label('GSTIN NO') ?>
</div>
<div class="col-md-1">
            <?= $form->field($model, 'tax_type')->dropDownList(['GST'=>'GST','IGST'=>'IGST'],['class' => 'form-control gst_percent','id'=>'gst_percent','prompt'=>"SELECT"])->label('GST Type') ?>
        </div>
<div class="col-md-1">
            <?= $form->field($model, 'tax_id')->dropDownList($tax_master,['class' => 'form-control gst_percent','id'=>'gst_percent','prompt'=>"SELECT"])->label('GST (%)') ?>
        </div>
<div class="col-md-1">

    <?= $form->field($model, 'bill_number')->textInput(['readonly' => true])->label('BILL NO') ?>
</div>

<div class="col-md-1">
    <?= $form->field($model, 'bill_date')->textInput(['readonly'=>true,'value'=> $model->isNewRecord ? '' : date('d-m-Y H:i:s',strtotime($model->bill_date))])->label('BILL DATE') ?>
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

        <div class="col-md-1">
            <?= $form->field($invoice_ref, 'sac_code')->textInput(['class' => 'form-control sac_code','id'=>'sac_code'.$k,'name'=>'InvoiceRefTbl[sac_code][]'])->label('SAC CODE') ?>
        </div>

         <div class="col-md-8">
            <?= $form->field($invoice_ref, 'description')->textArea(['class' => 'form-control description','id'=>'description'.$k,'name'=>'InvoiceRefTbl[description][]'])->label('DESCRIPTION') ?>
        </div>

        

         <div class="col-md-2">
            <?= $form->field($invoice_ref, 'amount')->textInput(['data-index'=>$k,'class' => 'decimal_validated form-control amount','id'=>'amount'.$k,'name'=>'InvoiceRefTbl[amount][]'])->label('AMOUNT') ?>
        </div>

         <div class="col-md-1">
             <div class="form-group">
                <label class="control-label" for="description1" style="visibility: hidden;">DESCRIPTION</label>
                <?= Html::Button('<i class="fa fa-plus" aria-hidden="true"></i>', ['class' => 'btn btn-success btn-xs addclone','id'=>'addclone'.$k,'data-index'=>$k]) ?>
                <?= Html::Button('<i class="fa fa-remove" aria-hidden="true"></i>', ['class' => 'btn btn-danger  btn-xs removeclone','id'=>'removeclone'.$k,'data-index'=>$k]) ?>
            </div>
        </div>
        
    </div>
</div>

<?php } else {  
    $k=1;
    if(!empty($invoice_ref_fetch))
  {

    foreach ($invoice_ref_fetch as $key => $value) {
        


    ?>


   <div class="multi-field "> 
    <div class="col-md-12">

        <div class="col-md-1">
            <?= $form->field($invoice_ref, 'sac_code')->textInput(['class' => 'form-control sac_code','id'=>'sac_code'.$k,'name'=>'InvoiceRefTbl[sac_code][]','required'=>'true','value'=>$value['sac_code']])->label('SAC CODE') ?>
        </div>

         <div class="col-md-8">
            <?= $form->field($invoice_ref, 'description')->textArea(['class' => 'form-control description','id'=>'description'.$k,'name'=>'InvoiceRefTbl[description][]','required'=>'true','value'=>$value['description']])->label('DESCRIPTION') ?>
        </div>

        

         <div class="col-md-2">
            <?= $form->field($invoice_ref, 'amount')->textInput(['data-index'=>$k,'class' => 'decimal_validated form-control amount','id'=>'amount'.$k,'name'=>'InvoiceRefTbl[amount][]','required'=>'true','value'=>$value['amount']])->label('AMOUNT') ?>
        </div>

         <div class="col-md-1">
             
             <div class="form-group">
                <label class="control-label" for="description1" style="visibility: hidden;">DESCRIPTION</label>
                <?= Html::Button('<i class="fa fa-plus" aria-hidden="true"></i>', ['class' => 'btn btn-success btn-xs addclone','id'=>'addclone'.$k,'data-index'=>$k]) ?>
                 <?= Html::Button('<i class="fa fa-remove" aria-hidden="true"></i>', ['class' => 'btn btn-danger  btn-xs removeclone','id'=>'removeclone'.$k,'data-index'=>$k]) ?>
         </div>
      
        </div>
        <!--div class="col-md-1">

        </div-->
    </div>
</div>

<?php $k++; } } } ?>

</div>
</div>

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
 <div class="col-md-3 pull-right">
 
 <div class="form-group">
       
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['id'=>$model->isNewRecord ? 'saved' : 'updated' ,'class' => $model->isNewRecord ? 'btn btn-success pull-right tax' : 'btn btn-primary pull-right updatetax']) ?>
        
        <?= Html::Button( 'Clear'  , ['class' => 'btn btn-danger','id'=>'cleared','onclick'=>'ClearField();']) ?>
    </div>

  
 
    
    
    </div>
</div>
</div>
</div>
</div>
    <?php ActiveForm::end(); ?>


<script>
 jQuery(document).ready(function() {

    $('#cleared').attr('disabled','disabled');
    $('#invoicetable-company_name').focus();
$('.manage').each(function() {
 
 


    var $wrapper = $('.process', this);
    var current = '<?php echo $k; ?>';

   
        $(".addclone", $(this)).click(function(e) {


            current++;
            var clone =$('.multi-field:first', $wrapper).clone(true) 
            $(clone).appendTo($wrapper).find('input,select,hidden,textarea').val('');
            var newid=localStorage.count_item=Number(localStorage.count_item)+1
            jQuery(clone).find('.sac_code').attr('id', 'sac_code'+current);
            jQuery(clone).find('.description').attr('id', 'description'+current);
            jQuery(clone).find('.gst_percent').attr('id', 'gst_percent'+current);
            jQuery(clone).find('.amount').attr('id', 'amount'+current);
            jQuery(clone).find('.addclone').attr('id', 'addclone'+current);
            jQuery(clone).find('.removeclone').attr('id', 'removeclone'+current);


            jQuery(clone).find('.removeclone').attr('data-index',+current);
            jQuery(clone).find('.addclone').attr('data-index',+current);
            jQuery(clone).find('.amount').attr('data-index',+current);
            jQuery(clone).find('.gst_percent').attr('data-index',+current);
            
            $('#sac_code'+current).focus();
          
            
           
           
            if ($('.multi-field').length > 1) {
             
                $(this).parents('.addclone').hide();
                $(".removeclone").show();
            }
            
        });


        $(".removeclone").click(function(event) {
            if ($('.multi-field', $wrapper).length > 1) {
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
            $("#invoicetable-customer_name").val(item.customer);
            $("#invoicetable-gstin_no").val(item.gst);

            $('.sac_code').parents('.sac_code').focus();
            
        } 
    });


function EmptyEsc(data_val,event)
{
     var keycode = (event.keyCode ? event.keyCode : event.which);
     
     if(keycode === 27 || keycode === 8 || keycode === 46 || keycode === 32)
     {
        $('#invoicetable-company_name').val('');
        $('#invoicetable-customer_name').val('');
        $('#invoicetable-gstin_no').val('');
        $('#custId').val('');
     }

     if(data_val === null || data_val === '')
     {
        $('#invoicetable-company_name').val('');
        $('#invoicetable-customer_name').val('');
        $('#invoicetable-gstin_no').val('');
        $('#custId').val('');
     }
}



 jQuery(document).ready(function() {



$('#invoice-form').on('beforeSubmit', function(e) {
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
             $('#invoicetable-bill_number').val(obj[1]);
             $('#invoicetable-bill_date').val('<?php echo date('d-m-Y H:i:s'); ?>');
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


function ClearField()
{
    window.location.reload(true);
}

</script>