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
    min-height: 50px !important;

    height: 60px;
    resize: none;
}

</style>

<?php $form = ActiveForm::begin(['id'=>'invoice-form','options'=> ['autocomplete'=>'off','onsubmit'=>"return false;"]]); ?>
<div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-border panel-custom">
                                    <div class="panel-heading">
                                        
                                    </div>
                                    <div class="panel-body">    

    <div class="col-md-12">

<div class="col-md-3">
    <?= $form->field($model, 'company_name')->textInput(['readonly'=> $model->isNewRecord ? false : true,'maxlength' => true,'class'=>'form-control input-sm typehead','onkeyup'=>'EmptyEsc(this.value,event);'])->label('COMPANY NAME') ?>
    <?php if($model->isNewRecord) { ?>
    <input type="hidden" id="custId" name="custId">
<?php } else if(!$model->isNewRecord) { ?>

     <input type="hidden" id="custId" name="custId" value="<?php echo $model->company_id; ?>">
<?php } ?>

     <?= $form->field($model, 'customer_name')->hiddenInput(['readonly' => true,'required'=>true])->label(false) ?>

</div>

<div class="col-md-2">
    <?= $form->field($model, 'gstin_no')->textInput(['readonly'=> !$model->isNewRecord ? true : false])->label('GSTIN NO') ?>
</div>
<div class="col-md-2">
            <?= $form->field($model, 'tax_type')->dropDownList(['GST'=>'GST','IGST'=>'IGST'],['class' => 'form-control input-sm gst_percent','id'=>'gst_percent','prompt'=>"SELECT"])->label('GST Type') ?>
        </div>
<div class="col-md-1">
            <?= $form->field($model, 'tax_id')->dropDownList($tax_master,['class' => 'form-control no-padding input-sm gst_percent','id'=>'gst_percent'])->label('GST (%)') ?>
        </div>

<?php if(!$model->isNewRecord){ ?>

<div class="col-md-2">
    <label>SERIAL NO</label>
    <br/>
    <div><b style="color: blue;"><?php echo $model->bill_number; ?></b></div>
    <?//= $form->field($model, 'bill_number')->textInput(['readonly' => true])->label('BILL NO') ?>
</div>

<div class="col-md-2">
     <label>Date</label>
    <br/>
    <div><b style="color: blue;"><?php echo date('d-m-Y',strtotime($model->bill_date)); ?></b></div>
    <?//= $form->field($model, 'bill_date')->textInput(['class' => 'form-control no-padding','readonly'=>true,'value'=> $model->isNewRecord ? '' : date('d-m-Y H:i:s',strtotime($model->bill_date))])->label('BILL DATE') ?>
</div>
<?php }?>        
</div>
 <div class="col-md-12">
<hr style="width:100%;border-top:2px solid #4682b4;opacity:10;">
</div>
<div class="manage ">
    <div class="fields  process">



            <div class="multi-field "> 
    <div class="col-md-12">

        <!--div class="col-md-2">
            <?//= $form->field($invoice_ref, 'sac_code')->textInput(['class' => 'form-control input-sm sac_code','id'=>'sac_code','name'=>'InvoiceRefTbl[sac_code][]','maxlength'=>10])->label('SAC CODE') ?>
        </div-->

         <div class="col-md-9">
            <?= $form->field($invoice_ref, 'description')->textArea(['class' => 'form-control input-sm description','id'=>'description','name'=>'InvoiceRefTbl[description][]'])->label('DESCRIPTION') ?>
        </div>

        

         <div class="col-md-2">
            <?= $form->field($invoice_ref, 'amount')->textInput(['class' => 'decimal_validated form-control input-sm amount','id'=>'amount','name'=>'InvoiceRefTbl[amount][]'])->label('AMOUNT') ?>
        </div>

         <div class="col-md-1">
             <div class="form-group">
                <label class="control-label" for="description1" style="visibility: hidden;">DESCRIPTION</label>
                <?= Html::Button('Add To Grid', ['class' => 'btn btn-success btn-xs','id'=>'add_to_grid','onclick'=>"Add_To_Grid();"]) ?>
               
            </div>
        </div>
        
    </div>
</div>



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
                <th style="text-align: center;width: 5%;">SI NO</th>
                <!--th style="text-align: center;width: 10%;">SAC CODE</th-->
                <th style="text-align: center;width: 75%;">DESCRIPTION</th>
                <th style="text-align: center;width: 10%;">AMOUNT</th>
                <th style="text-align: center;width: 10%;">Action</th>
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
    if(!empty($invoice_ref_fetch))
  {

    foreach ($invoice_ref_fetch as $key => $value) {
        


    ?>

<tr data-id='<?php echo $k; ?>' id="row_id<?php echo $k; ?>" class="row_id">
    <td data-id='<?php echo $k; ?>' id="sl_id<?php echo $k; ?>" class="sl_id" style="text-align: left;width: 5%;"><?php echo $k; ?></td>
    <!--td><div> <?//php echo $value['sac_code']; ?></div><input type="hidden" class="form-control input-sm sac_code_table disabled_field" readonly id="sac_code_table<?//php echo $k; ?>" value="<?//php echo $value['sac_code']; ?>" name="InvoiceRefTbl[sac_code_table][]"/></td-->

    <td style="text-align: left;width: 75%;"> <input type="text" class="form-control input-sm description_table disabled_field"  style="text-align:left;" required id="description_table<?php echo $k; ?>" value="<?php echo $value['description']; ?>" name="InvoiceRefTbl[description_table][]"></td>

    <td s="sl_id" style="text-align: right;width: 10%;"><input type="text" class="form-control input-sm amount_table disabled_field"  style="text-align:right;" readonly id="amount_table<?php echo $k; ?>" value="<?php echo $value['amount']; ?>" name="InvoiceRefTbl[amount_table][]"></td>

    <td style="text-align:center;width: 10%;"><button type="button" class="btn btn-danger btn-xs disabled_field" style="text-align:center;" onclick="Remove('<?php echo $k; ?>');">Remove</button></td></tr>


<?php $k++; } } } ?>
            </tbody>
            <tfoot id="tfoot_total_amount">
                <tr>
                    
                    <td>
                        
                    </td>
                    <td style="text-align: right;">
                       <b> Total Amount </b>
                    </td>
                    <td style="text-align: right;color: blue;" id="total_amount_add">
                        <?php  if(!$model->isNewRecord)
                            {  ?>     

                           <?php echo  $model['total_ampunt']; ?>
                        <?php   }
                                ?>
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
 <div class="pull-right">
 
 
       
        <?= Html::submitButton('<i class="fa fa-eye"></i> Preview', ['class' => 'btn btn-danger','id'=>'preview_button','value'=>'preview']) ?>
        
         <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-print"></i>Save & Print' : '<i class="fa fa-fw fa-print "></i>Update & Print', ['value'=>'yes','id'=>$model->isNewRecord ? 'saved_print' : 'updated_print' ,'class' => $model->isNewRecord ? 'btn btn-success tax' : 'btn btn-success ']) ?>
        
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['value'=>'no','id'=>$model->isNewRecord ? 'saved' : 'updated' ,'class' => $model->isNewRecord ? 'btn btn-primary tax' : 'btn btn-primary updatetax']) ?>
      
        <?//= Html::Button( 'Clear'  , ['class' => 'btn btn-danger','id'=>'cleared','onclick'=>'ClearField();']) ?>


  
 
    
    
    </div>


    
</div>
</div>
</div>
</div>
  <span id="load" style="display: none;"><img src="<?= Url::to('@web/loader1.gif') ?>" /></span>
     <span id="loadtex" style="display: none; "></span>





    <?php ActiveForm::end(); ?>


<script>


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



<?php 

    if($model->isNewRecord)
    {  ?>
        
       var comments_save='Are You Sure to Save ?'; 
       var comments_print='Are You Sure to Save & Print ?'; 

       var print_url='<?php echo Yii::$app->homeUrl ?>?r=invoice-table/printsave';
       var save_url='<?php echo Yii::$app->homeUrl ?>?r=invoice-table/create';

    <?php } else if(!$model->isNewRecord) {
    ?>

       var comments_save='Are You Sure to Update ?'; 
       var comments_print='Are You Sure to Update & Print ?'; 

       var print_url='<?php echo Yii::$app->homeUrl ?>?r=invoice-table/update&id='+'<?php echo $model->id; ?>';
       var save_url='<?php echo Yii::$app->homeUrl ?>?r=invoice-table/updateprint&id='+'<?php echo $model->id; ?>';

<?php } ?>
    
        $('#invoice-form').on('beforeSubmit', function(e) {

    var fetch_estimte=$('#fetch_estimte tr').length;
    if(fetch_estimte === 0)
    {
        $('#estimate-particular_field').focus();
        alert('No Product Will Be Add');
        return false;
    }
  $('#invoice-form').unbind('submit').submit();

   $('#invoice-form button').on('click', function(){

      var validated=$(this).val();
    if(validated === 'yes')
    {
        if (confirm(comments_print)) {
   
        $.ajax({
        url: print_url,
        type: 'POST',
        data: $('#invoice-form').serialize(),
        success: function (data) {
      
        
        var obj=$.parseJSON(data);

        if(obj[0] == 'okay')
        {
            <?php if($model->isNewRecord) {?>

             var print_url='<?php echo Yii::$app->homeUrl ?>?r=invoice-table/print&id='+obj[1];
              window.open(print_url,'_blank');


             var url='<?php echo Yii::$app->homeUrl ?>?r=invoice-table/reindex';
              window.open(url,'_self');
            <?php } else { ?>
                
              var print_url='<?php echo Yii::$app->homeUrl ?>?r=invoice-table/print&id='+obj[1];
              window.open(print_url,'_blank');   

              var url='<?php echo Yii::$app->homeUrl ?>?r=invoice-table/reindex';
              window.open(url,'_self');
            <?php } ?>
        }
        
        },
        error: function () {
            alert("Something went wrong");
        }
    });}
    }
    else if(validated === 'no')
    {
        if (confirm(comments_save)) {
   
        $.ajax({
        url: save_url,
        type: 'POST',
        data: $('#invoice-form').serialize(),
        success: function (data) {
      
        
        var obj=$.parseJSON(data);

        if(obj[0] == 'okay')
        {
            <?php if($model->isNewRecord) {?>
            
              var url='<?php echo Yii::$app->homeUrl ?>?r=invoice-table/reindex';
              window.open(url,'_self');
            
            <?php } else { ?>
           
              var url='<?php echo Yii::$app->homeUrl ?>?r=invoice-table/reindex';
              window.open(url,'_self');
            <?php } ?>
        }
        else
        {
            
        } 
        },
        error: function () {
            alert("Something went wrong");
        }
    });}
    }
    else if(validated === 'preview')
    {
        var array_data=JSON.stringify($('#invoice-form').serializeArray());
        var url='<?php echo Yii::$app->homeUrl ?>?r=invoice-table/printpreview&data='+array_data;
        window.open(url,'_blank');
    }


   });
  
}).on('submit', function(e){
    e.preventDefault();
});
    
   

//$('.form-group.field-invoicetable-bill_date').addClass('w-75');


});


function ClearField()
{
    window.location.reload(true);
}

var current = '<?php echo $k; ?>';
function Add_To_Grid()
{
   // var sac_code=$('#sac_code').val();
    var description=$('#description').val();
    var amount=parseFloat($('#amount').val());
    
   /* if(sac_code === null || sac_code === '')
    {   
        $('#sac_code').focus();
        alert('Enter SAC Code');
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
        $('#description').focus();
        alert('In-Valid Amount Entering');
        return false;
    }

    var append_string='<tr data-id='+current+' id="row_id'+current+'" class="row_id">'+
    '<td data-id='+current+' id="sl_id'+current+'" class="sl_id" style="text-align: left;width: 5%;"></td>'+

    /*'<td><div> '+sac_code+'</div><input type="hidden" class="form-control input-sm sac_code_table disabled_field" readonly id="sac_code_table'+current+'" value="'+sac_code+'" name="InvoiceRefTbl[sac_code_table][]"/></td>'+*/

    '<td style="text-align: left;width: 75%;"><input type="text" class="form-control input-sm description_table disabled_field"  style="text-align:left;" required id="description_table'+current+'" value="'+description+'" name="InvoiceRefTbl[description_table][]"></td>'+

    '<td style="text-align: right;width: 10%;"><input type="text" class="form-control input-sm amount_table disabled_field"  style="text-align:right;" readonly id="amount_table'+current+'" value="'+amount+'" name="InvoiceRefTbl[amount_table][]"></td>'+



    '<td style="text-align:center;width: 10%;"><button type="button" class="btn btn-danger btn-xs disabled_field" style="text-align:center;" onclick="Remove('+current+');">Remove</button></td>'+
    '</tr>';

    $('#fetch_estimte').append(append_string);


    $('#sac_code').val('');
    $('#description').val('');
    $('#amount').val('');
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