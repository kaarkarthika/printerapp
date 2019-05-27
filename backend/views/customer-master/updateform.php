<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerMaster */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Update Customer Master';
$this->params['breadcrumbs'][] = ['label' => 'Customer Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$k=1;
?>


<style type="text/css">
    
textarea.form-control {
   min-height: 90px;
     min-width: 250px; 
    resize: none;
}

#customermaster-company_name{
  text-transform: uppercase;
  color: blue;
  font-weight: bold;
}

#customermaster-customer_name{
  text-transform: uppercase;
  font-weight: bold;
}
</style>
<?php $form = ActiveForm::begin(['options'=>['autocomplete'=>'off']]); ?>

<div class="container">
   <div class="row">
<div class="col-sm-12">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<?php
  
    $session = Yii::$app->session;
    
    echo Html::a('Manage Customer Master', ['index'],['class' => 'btn btn-primary waves-effect waves-light pull-right']);
   ?>
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
  
 

<div class="col-md-3">
    <?= $form->field($model, 'company_name')->textInput(['class'=>'form-control input-sm disabledfield','required' => true])->label('COMPANY NAME') ?>
</div>
<div class="col-md-3">
      <?= $form->field($model, 'customer_name')->textInput(['class'=>'form-control input-sm disabledfield','required' => true])->label('CUSTOMER NAME') ?>
    
</div>
<div class="col-md-3">
 <?= $form->field($model, 'phone_no')->textInput(['maxlength'=>10,'class'=>'form-control input-sm number disabledfield','required' => true])->label('PHONE NO') ?>
</div>
<div class="col-md-3">
     <?= $form->field($model, 'gst')->textInput(['class'=>'form-control input-sm disabledfield','maxlength' => true])->label('GST') ?>
 
    </div>
    <!--div class="col-md-2">
            <?//= $form->field($model, 'state_code')->textInput(['class'=>'form-control input-sm disabledfield','maxlength' => true])->label('STATE CODE') ?>
    </div-->
</div>
  <div class="col-md-12">
    <div class="col-md-6">
    <?= $form->field($model, 'address')->textarea(['class'=>'form-control input-sm disabledfield','row' => 3,'cols' => 50])->label('SHIPPING ADDRESS') ?>
    </div>

     <div class="col-md-2">
            <?= $form->field($model, 'city')->textInput(['class'=>'form-control input-sm disabledfield','maxlength' => true])->label('CITY') ?>
    </div>
     <div class="col-md-2">
            <?= $form->field($model, 'state')->textInput(['class'=>'form-control input-sm disabledfield','maxlength' => true])->label('STATE') ?>
    </div>
    <div class="col-md-2">
            <?= $form->field($model, 'pincode')->textInput(['class'=>'form-control input-sm number disabledfield','maxlength' => true])->label('PINCODE') ?>
    </div>
    
 
</div>

 <div class="col-md-12">
  <hr style="width:100%;border-top:2px solid #4682b4;opacity:10;">
</div>


<div class="manage ">
    <div class="fields  process">

      <?php if(!empty($delivery_address_master_fetch)) { 

        foreach ($delivery_address_master_fetch as $key => $value) {
        ?>

      <div class="multi-field ">
    <div class="col-md-12">
    
     <div class="col-md-5">
    <?= $form->field($delivery_address_master, 'delivery_address')->textarea(['class'=>'delivery_address form-control input-sm disabledfield','row' => 3,'cols' => 50,'id'=>'delivery_address'.$k,'name'=>'DeliveryAddressMaster[delivery_address][]','value'=>$value['delivery_address']])->label('DELIVERY ADDRESS') ?>
    </div>  

     <div class="col-md-2">
    <?= $form->field($delivery_address_master, 'city')->textInput(['class'=>'form-control disabledfield delivery_city','id'=>'delivery_city'.$k,'name'=>'DeliveryAddressMaster[city][]','value'=>$value['city']])->label('City') ?>
    </div>  

    <div class="col-md-2">
    <?= $form->field($delivery_address_master, 'state')->textInput(['class'=>'form-control disabledfield delivery_state','id'=>'delivery_state'.$k,'name'=>'DeliveryAddressMaster[state][]','value'=>$value['state']])->label('State') ?>
    </div>        
    
     <div class="col-md-2">
    <?= $form->field($delivery_address_master, 'pincode')->textInput(['class'=>'form-control disabledfield delivery_pincode','id'=>'delivery_pincode'.$k,'name'=>'DeliveryAddressMaster[pincode][]','maxlength'=>6,'value'=>$value['pincode']])->label('Pincode') ?>
    </div>        
     <div class="col-md-1">
      <label class="control-label" for="delivery_pincode" style="visibility: hidden;">Pincode</label>
     <?= Html::Button('<i class="fa fa-plus" aria-hidden="true"></i>', ['class' => 'btn btn-success btn-xs disabledfield addclone','id'=>'addclone'.$k]) ?>

     <?= Html::Button('<i class="fa fa-times" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-xs disabledfield removeclone','id'=>'removeclone'.$k]) ?>
   </div>
 

</div>
    </div>

     <?php $k++; }    }else if(empty($delivery_address_master_fetch)){ ?>
       <div class="multi-field ">
    <div class="col-md-12">
    
     <div class="col-md-5">
    <?= $form->field($delivery_address_master, 'delivery_address')->textarea(['class'=>'delivery_address form-control input-sm disabledfield','row' => 3,'cols' => 50,'id'=>'delivery_address'.$k,'name'=>'DeliveryAddressMaster[delivery_address][]','value'=>$value['delivery_address']])->label('DELIVERY ADDRESS') ?>
    </div>  

     <div class="col-md-2">
    <?= $form->field($delivery_address_master, 'city')->textInput(['class'=>'form-control disabledfield delivery_city','id'=>'delivery_city'.$k,'name'=>'DeliveryAddressMaster[city][]','value'=>$value['city']])->label('City') ?>
    </div>  

    <div class="col-md-2">
    <?= $form->field($delivery_address_master, 'state')->textInput(['class'=>'form-control disabledfield delivery_state','id'=>'delivery_state'.$k,'name'=>'DeliveryAddressMaster[state][]','value'=>$value['state']])->label('State') ?>
    </div>        
    
     <div class="col-md-2">
    <?= $form->field($delivery_address_master, 'pincode')->textInput(['class'=>'form-control disabledfield delivery_pincode','id'=>'delivery_pincode'.$k,'name'=>'DeliveryAddressMaster[pincode][]','maxlength'=>6,'value'=>$value['pincode']])->label('Pincode') ?>
    </div>        
     <div class="col-md-1">
      <label class="control-label" for="delivery_pincode" style="visibility: hidden;">Pincode</label>
     <?= Html::Button('<i class="fa fa-plus" aria-hidden="true"></i>', ['class' => 'btn btn-success btn-xs disabledfield addclone','id'=>'addclone'.$k]) ?>

     <?= Html::Button('<i class="fa fa-times" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-xs disabledfield removeclone','id'=>'removeclone'.$k]) ?>
   </div>
 

</div>
    </div>

     <?php } ?>
  </div>
</div>


</div>
  
<div class="col-md-12">
   <hr style="width:100%;border-top:2px solid #4682b4;opacity:10;">
</div>
  <div class="col-md-12">

   <table class="table table-bordered">
    <thead>
      <tr>
        <th>CONTACT PERSON</th>
        <th>CONTACT PHONE NUMBER</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody id='fetch_contact'>
      
      <?php
       $auto_increment=1;
    if($contactable_fetch[0] == 'okay')
    {
     
        foreach ($contactable_fetch[1] as $key => $value) 
        {
      ?>
        <tr  class="row_id" id="row_id<?php echo $auto_increment;?>" data-id="<?php echo $auto_increment;?>">
          <td> <?= $form->field($contactable, 'contact_name')->textInput(['class'=>'form-control input-sm disabledfield','name'=>'ContactTable[contact_name][]','id' => 'contact_name'.$auto_increment,'data-id'=>$auto_increment,'value'=>$value['contact_name']])->label(false) ?> </td>
           <td> <?= $form->field($contactable, 'contact_number')->textInput(['maxlength'=>12,'class'=>'form-control input-sm disabledfield number','name'=>'ContactTable[contact_number][]','id' => 'contact_number'.$auto_increment,'data-id'=>$auto_increment,'value'=>$value['contact_number']])->label(false) ?> </td>
           <td>  
            <?= Html::Button('Add', ['class' => 'btn btn-primary btn-xs disabledfield','onclick'=>'AddColumn('.$auto_increment.');']) ?>

            <?= Html::Button('Del', ['class' => 'btn btn-danger btn-xs disabledfield','onclick'=>'DeleteColumn('.$auto_increment.');']) ?>
         </td>
        </tr>
    <?php $auto_increment++;} } ?>
    </tbody>
  </table>

   </div>


<div class="col-md-12">
 <hr style="width:100%;border-top:2px solid #4682b4;opacity:10;">
</div>
<div class="col-md-2 pull-right">

   <?= Html::submitButton('Update', ['class' => 'btn btn-primary disabledfield']) ?>

   <?//= Html::Button('Edit', ['class' => 'btn btn-danger','onclick'=>'ClearButton();']) ?>


   </div>







</div>
</div>




</div>
</div>


   




 








</div>



  <?php ActiveForm::end(); ?>


<script type="text/javascript">
    
var auto_increment='<?php echo $auto_increment; ?>';

//$('.disabledfield').attr('disabled','disabled');

function AddColumn(data_val) 
{
    

    auto_increment++;
    
    var append_string='<tr class="row_id" id="row_id'+auto_increment+'" data-id='+auto_increment+'><td><div class="form-group field-contact_name'+auto_increment+'">'+
    '<input type="text" id="contact_name'+auto_increment+'" class="form-control input-sm disabledfield" name="ContactTable[contact_name][]" data-id='+auto_increment+'><div class="help-block"></div></div></td>'+
    
    '<td> <div class="form-group field-contact_number'+auto_increment+'">'+
    '<input type="text" id="contact_number'+auto_increment+'" class="form-control input-sm number disabledfield" name="ContactTable[contact_number][]" data-id='+auto_increment+'><div class="help-block" maxlength="12"></div></div> </td>'+

    '<td><button type="button" class="btn btn-primary btn-xs disabledfield" onclick="AddColumn('+auto_increment+');">Add</button>&nbsp;'+
     '<button type="button" class="btn btn-danger btn-xs disabledfield" onclick="DeleteColumn('+auto_increment+');">Del</button></td></tr>';

    $('#fetch_contact').append(append_string);

}



function DeleteColumn(data_val)
{
    var table_length=$('#fetch_contact tr').length;
    
    if(table_length === 1)
    {

        return false;
    }

    $('#row_id'+data_val).remove(); 
}

function UpdateButton()
{
    //$('#load1').show();
    var approve=true;
    $(".row_id").each(function() 
    {
        var data_id=$(this).attr('data-id');
        var contact_name=$('#contact_name'+data_id).val();
        var contact_number=$('#contact_number'+data_id).val();
        
        if(contact_name === null || contact_name === '')
        {
            $('#contact_name'+data_id).focus();
            alert('Contact Person Not Empty');
            approve=false;
            return false;
        }

        if(contact_number === null || contact_number === '')
        {
            $('#contact_number'+data_id).focus();
            alert('Contact Number Not Empty');
            approve=false;
            return false;
        }

    });

    if(approve === true)
    {
      var valid=$("#w0").valid();

      if(valid == true)
      {

           if (confirm('Are You Sure to Update ?')) {
           
              var update_id='<?php echo $model->auto_id; ?>';
              
              
          $.ajax({
                  type: "POST",
                  url: "<?php echo Yii::$app->homeUrl . "?r=customer-master/update&id=";?>"+update_id,
                  data: $("#w0").serialize(),
                  success: function (result) 
                  { 
                      
                      var obj = $.parseJSON(result);
                      if(obj[0] === 'okay')
                      {   
                          $('.disabledfield').attr('disabled','disabled');
                          alert('Customer Record Update Successfully');
                      }
                   }
                 
             });
          }
      }
    }
    

}


function ClearButton()
{
    $('.disabledfield').removeAttr('disabled','disabled');
    $('#customermaster-company_name').focus();
}

$("body").on('keypress', '.number', function (e) 
{
  //if the letter is not digit then display error and don't type anything
  if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
  {
    return false;
  }
});


 jQuery(document).ready(function() {


$('.manage').each(function() {
 
 


    var $wrapper = $('.process', this);
    var current = '<?php echo $k; ?>';

   
        $(".addclone", $(this)).click(function(e) {


            current++;
            var clone =$('.multi-field:first', $wrapper).clone(true) 
            $(clone).appendTo($wrapper).find('input,select,hidden,textarea').val('');
            var newid=localStorage.count_item=Number(localStorage.count_item)+1
            jQuery(clone).find('.delivery_address').attr('id', 'delivery_address'+current);
            jQuery(clone).find('.delivery_city').attr('id', 'delivery_city'+current);
            jQuery(clone).find('.delivery_state').attr('id', 'delivery_state'+current);
            jQuery(clone).find('.delivery_pincode').attr('id', 'delivery_pincode'+current);
            jQuery(clone).find('.addclone').attr('id', 'addclone'+current);
            jQuery(clone).find('.removeclone').attr('id', 'removeclone'+current);


            
            $('#delivery_address'+current).focus();
          
            
           
           
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













$('#w0').on('beforeSubmit', function(e) {

   if (confirm('Are You Sure to Update ?')) {
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

        
        if(obj[0] === 'okay')
        {   
             var url='<?php echo Yii::$app->homeUrl ?>?r=customer-master/reindex';
              window.open(url,'_self');
           // $('.disabledfield').attr('disabled','disabled');
            //alert('Customer Record Updated Successfully');
        }
           
        
         
        },
        error: function () {
            alert("Something went wrong");
        }
    }); }
}).on('submit', function(e){
    e.preventDefault();
});

});

</script>