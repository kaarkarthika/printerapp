<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\Stockrequest;
use backend\models\Stockmaster;
use backend\models\Stockreturn;
$this->title=" Stock Return";
use backend\models\Unit;
?>
<style>
	#load{
		display: none;
position: fixed;
left: 128px;
top: 27px;
width: 100%;
height: 100%;
z-index: 9999;
margin-top: 20%; 
	}
	
	input.error{
		background: rgb(251, 227, 228);
border: 1px solid #fbc2c4;
color: #8a1f11;

	}
</style>
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="btn-group pull-right m-t-15">
</div>
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php echo $this->title;?></a></li>
</ol>
</div>
</div>
 <?php $form = ActiveForm::begin([
	 'id'=>'addform',
       
        'method' => 'post',
    ]); ?>
<div id="load"  align="center"><img src="<?= Url::to('@web/dmc2.gif') ?>" />Loading...</div>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body">
	
	
   
    <div class="col-md-4">
    	<label>Vendor</label>
   
     	<?= $form->field($model1, 'vendor_name')->textinput(['readonly'=>true])->label(false) ?>
    </div>
	
    
    <div class="col-md-4">
			<label>Request Code</label>
   <?= $form->field($model, 'request_code')->textinput(['readonly'=>true,'value'=>$model1->requestcode])->label(false); ?>
    </div>
    
    <div class="col-md-4">
			<label>Return Date</label>
   <?= $form->field($model1, 'requestdate')->textinput(['readonly'=>true,'value'=>date('d-m-Y')])->label(false); ?>
    </div>
   
   
</div>

	
	 <div class="panel-body">
	 	
	
	 	<table  class="table table-striped table-bordered">
             <thead>
             <tr>
             <th>#</th>
            <th>Product Name</th>
            
            
             <th>Received Quantity</th>
              <th>Unit</th>
               <th>Batch Number</th>
            
          
             <th>Expiry Date</th>
             <th>Return Quantity</th>
              <th>Total Units</th>
             
             </tr>
             </thead>
             <tbody>
             	<!--?php
             	$i=1;
				
				if(count($model3)>0){
				foreach ($model3 as $key => $value) {
				 $modelz = Stockrequest::find()->where(['requestid'=>$value->stockrequestid])->one();	 
					$returnz=Stockreturn::find()->where(['stockrequestid'=>$value->stockrequestid])->one();
					if($returnz)
					{
						$unitdata=Unit::find()->where(['unitid'=>$value->unitid])->one();
						    	echo'<tr>
             <td>'.$i.'</td>
             <td>'.$modelz->product_name.$form->field($model, 'stockrequestid[]')->hiddenInput(['value'=>$value->stockrequestid])->label(false).$form->field($model, 'stockrequestid')->hiddenInput(['name'=>'stockid[]','value'=>$value->stockid])->label(false).'</td>
                
            
               
               <td>'.$form->field($model, 'receivedquantity[]')->textInput(['id'=>'receivedquantity'.$i,'name'=>'receivedquantity'.$i,'readonly'=>'true','placeholder'=>'Received Quantity','class'=>'form-control', 'onkeypress'=>'return isNumber(event)', 'required'=>true,'value'=>$value->receivedquantity])->label(false).'</td>
           <td>'.$unitdata->unitvalue.$form->field($model, 'unitid[]')->hiddenInput(['value'=>$unitdata->unitid])->label(false).'</td>
           
		     <td>'.$form->field($model, 'batchnumber[]')->textInput(['id'=>'batchnumber'.$i,'name'=>'batchnumber'.$i,'readonly'=>'true','placeholder'=>'Batch Number','class'=>'form-control', 'required'=>true,'value'=>$value->batchnumber])->label(false).'</td>';
			 
             echo $form->field($model, 'manufacturedate[]')->hiddenInput(['id'=>'manufacturedate'.$i,'name'=>'manufacturedate'.$i,'readonly'=>'true','class' => 'form-control datepicker3', 'placeholder' => 'DD-MM-YYYY','onkeypress'=>'return false', 'bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true,'value'=>date('d-m-Y',strtotime($value->manufacturedate))])->label(false);
            echo $form->field($model, 'purchasedate[]')->hiddenInput(['id'=>'purchasedate'.$i,'readonly'=>'true','name'=>'purchasedate'.$i,'class' => 'form-control datepicker3', 'placeholder' => 'DD-MM-YYYY', 'onkeypress'=>'return false', 'bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true,'value'=>date('d-m-Y',strtotime($value->purchasedate))])->label(false);
	 
	 
            echo $form->field($model, 'purchaseprice[]')->hiddenInput(['id'=>'purchaseprice'.$i,'readonly'=>'true','name'=>'purchaseprice'.$i,'placeholder'=>'Purchase Price', 'class'=>"form-control",'required'=>true,'value'=>$value->purchaseprice])->label(false).'
             <td>'.$form->field($model, 'expiredate[]')->textInput(['id'=>'expiredate'.$i,'name'=>'expiredate'.$i,'readonly'=>'true','class' => 'form-control datepicker3', 'placeholder' => 'DD-MM-YYYY', 'onkeypress'=>'return false','bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true,'value'=>date('d-m-Y',strtotime($value->expiredate))])->label(false).'</td>     
             <td>'.$form->field($model, 'updated_ipaddress[]')->textInput(['id'=>'returnquantity'.$i,'name'=>'returnquantity'.$i,
             'dataincrement'=>$i,
             'placeholder'=>'Return Quantity','class'=>'form-control returnqty', 'onkeypress'=>'return isNumber(event)','value'=>$returnz->returnquantity,'required'=>true])->label(false).'</td>
             <td>'.$form->field($model, 'total_no_of_quantity[]')->textInput(['id'=>'totalunits'.$i,'readonly'=>'true', 'dataincrement'=>$i,'name'=>'totalunits'.$i,'placeholder'=>'Total Return Quantity','class'=>'form-control', 
             'onkeypress'=>'return isNumber(event)', 'required'=>true,'value'=>$returnz->total_no_of_quantity])->label(false).'</td>
			
			 </tr>';
			 ?-->
			 <!--input type="hidden" name="unitquantity<?php echo $i;?>" id="unitquantity<?php echo $i;?>"  value="<?php echo $unitdata->no_of_unit;?>"/-->
			<!--?php  $i++;
					}
           else
					{
						$unitdata=Unit::find()->where(['unitid'=>$value->unitid])->one();
						
						
						    	echo'<tr>
             <td>'.$i.'</td>
             <td>'.$modelz->product_name.$form->field($model, 'stockrequestid[]')->hiddenInput(['value'=>$value->stockrequestid])->label(false).$form->field($model, 'stockrequestid')->hiddenInput(['name'=>'stockid[]','value'=>$value->stockid])->label(false).'</td>
                
            
               
               <td>'.$form->field($model, 'receivedquantity[]')->textInput(['id'=>'receivedquantity'.$i,'name'=>'receivedquantity'.$i,'readonly'=>'true','placeholder'=>'Received Quantity','class'=>'form-control', 'onkeypress'=>'return isNumber(event)', 'required'=>true,'value'=>$value->receivedquantity])->label(false).'</td>
           <td>'.$unitdata->unitvalue.$form->field($model, 'unitid[]')->hiddenInput(['value'=>$unitdata->unitid])->label(false).'</td>
           
		     <td>'.$form->field($model, 'batchnumber[]')->textInput(['id'=>'batchnumber'.$i,'name'=>'batchnumber'.$i,'readonly'=>'true','placeholder'=>'Batch Number','class'=>'form-control', 'required'=>true,'value'=>$value->batchnumber])->label(false).'
           '.$form->field($model, 'manufacturedate[]')->hiddenInput(['id'=>'manufacturedate'.$i,'name'=>'manufacturedate'.$i,'readonly'=>'true','class' => 'form-control datepicker3', 'placeholder' => 'DD-MM-YYYY','onkeypress'=>'return false', 'bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true,'value'=>date('d-m-Y',strtotime($value->manufacturedate))])->label(false).'
             '.$form->field($model, 'purchasedate[]')->hiddenInput(['id'=>'purchasedate'.$i,'readonly'=>'true','name'=>'purchasedate'.$i,'class' => 'form-control datepicker3', 'placeholder' => 'DD-MM-YYYY', 'onkeypress'=>'return false', 'bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true,'value'=>date('d-m-Y',strtotime($value->purchasedate))])->label(false).'</td>
             '.$form->field($model, 'purchaseprice[]')->hiddenInput(['id'=>'purchaseprice'.$i,'readonly'=>'true','name'=>'purchaseprice'.$i,'placeholder'=>'Purchase Price', 'class'=>"form-control",'required'=>true,'value'=>$value->purchaseprice])->label(false).'
             <td>'.$form->field($model, 'expiredate[]')->textInput(['id'=>'expiredate'.$i,'name'=>'expiredate'.$i,'readonly'=>'true','class' => 'form-control datepicker3', 'placeholder' => 'DD-MM-YYYY', 'onkeypress'=>'return false','bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true,'value'=>date('d-m-Y',strtotime($value->expiredate))])->label(false).'</td>     
             <td>'.$form->field($model, 'updated_ipaddress[]')->textInput(['id'=>'returnquantity'.$i, 
             'dataincrement'=>$i,'name'=>'returnquantity'.$i,'placeholder'=>'Return Quantity','class'=>'form-control returnqty', 'onkeypress'=>'return isNumber(event)', 'required'=>true])->label(false).'</td>
              <td>'.$form->field($model, 'total_no_of_quantity[]')->textInput(['id'=>'totalunits'.$i,'readonly'=>'true', 'dataincrement'=>$i,'name'=>'totalunits'.$i,'placeholder'=>'Total Return Quantity','class'=>'form-control', 'onkeypress'=>'return isNumber(event)', 'required'=>true])->label(false).'</td>
            
			
			 </tr>';?-->
			 <!--input type="hidden" name="unitquantity<?php echo $i;?>" id="unitquantity<?php echo $i;?>"  value="<?php echo $unitdata->no_of_unit;?>"/-->
			 
			<!--?php  $i++;
					}
					
					 
         
              }	
				}
             ?-->
             
             
             <?php
             
            if(!empty($model1))
            {
             	
				
				
             }
             
             ?>
             
             
             
             
             	</tbody>
                </table>
                 <div class="form-group pull-right" >
        <?= Html::Button('<i class="fa fa-edit"></i> Update', ['class' => 'btn btn-primary waves-effect waves-light update_req',]) ?>
    
    </div>
      </div>
        <?php ActiveForm::end(); ?>
		</div>
		</div>
		</div>
</div>          
   
  <script src="ubold/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
  <script src="ubold/plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script> 
   <script type="text/javascript">
   $('body').on("click",'.update_req',function(){
   	
   	$form_container=$("#addform");
   	 $form_container.validate().settings.ignore = ":disabled,:hidden";
   var chkform=$form_container.valid();
   if(chkform==true){
   	$form_container.submit();
   }
   });
     jQuery(function($) {
		      $('.autonumber').autoNumeric('init');    
		  });
		  
	$(document).on('change keyup click', '.returnqty', function ()
   {
  	      var inc=$(this).attr('dataincrement');
          var rq=$("#returnquantity" + inc).val();
          var uq=$("#unitquantity" + inc).val();
          var tu=rq*uq;
        
          $("#totalunits" + inc).val(tu).toFixed(2);

   
  });
		  
		  
		  
        </script>