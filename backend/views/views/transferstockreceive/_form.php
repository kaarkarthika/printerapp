<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\Transferstock;
use backend\models\Stockmaster;
use backend\models\Stockresponse;
use backend\models\CompanyBranch;
$this->title="Approve Transfer Stock Request";
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
	
	
   
    <div class="col-md-3">
    	<label>Vendor</label>
   
     	<?= $form->field($model1, 'vendor_name')->textinput(['readonly'=>true])->label(false) ?>
    </div>
	
  
    <div class="col-md-3">
			<label>Transfer Stock Request Code</label>
   <?= $form->field($model, 'transferstock_requestcode')->textinput(['readonly'=>true,'value'=>$model1->transferstock_requestcode])->label(false); ?>
    </div>
    
    <div class="col-md-3">
			<label>Transfer Stock Request Date</label>
   <?= $form->field($model1, 'transferstockdate')->textinput(['readonly'=>true,'value'=>date('d-m-Y',strtotime($model1->transferstockdate))])->label(false); ?>
    </div>
    <div class="col-md-3">
			<label>Receive Date</label>
   <?= $form->field($model, 'receiveddate')->textinput(['readonly'=>true,'value'=>date('d-m-Y'),])->label(false); ?>
    </div>
    <div class="col-md-3">
			<label>From Branch</label>
			<?php $frombranchdata = CompanyBranch::find()->where(['branch_id'=>$model1->frombranch])->one();
			 echo $frombranchdata->branch_name;?>
			
   <?= $form->field($model, 'frombranch')->hiddeninput(['readonly'=>true,'value'=>$model1->frombranch,])->label(false); ?>
    </div>
    <div class="col-md-3">
			<label>To Branch</label>
			<?php $tobranchdata = CompanyBranch::find()->where(['branch_id'=>$model1->tobranch])->one();
			 echo $tobranchdata->branch_name;?>
   <?= $form->field($model, 'tobranch')->hiddeninput(['readonly'=>true,'value'=>$model1->tobranch,])->label(false); ?>
    </div>
   
</div>

	
	 <div class="panel-body">
	 	
	
	 	<table  class="table table-striped table-bordered">
             <thead>
             <tr>
             <th>#</th>
            <th>Product Name</th>
             <th>Transfer Stock Request Quantity</th>
              <th>Available Overall Stock  Quantity</th>
                <th>Available  Stock  Quantity for this batch Number</th>
            
            
           
               <th>Batch Number</th>
             <th>Manufacture Date</th>
             <th>Purchase Date</th>
              <th>Expire Date</th>
              <th>Approved Quantity</th>
               <th>Price/Qty</th>
             <th>Purchase Price</th>
            
             
             </tr>
             </thead>
             <tbody>
             	<?php
             	$i=1;
				
				if(count($model3)>0){
				foreach ($model3 as $key => $value) {
				 $modelz = Stockrequest::find()->where(['requestid'=>$value->stockrequestid])->one();	 
					 
             	echo'<tr>
             <td>'.$i.'</td>
             <td>'.$modelz->product_name.$form->field($model, 'stockrequestid[]')->hiddenInput(['value'=>$value->stockrequestid])->label(false).$form->field($model, 'stockrequestid')->hiddenInput(['name'=>'stockid[]','value'=>$value->stockid])->label(false).'</td>
                
             <td>'.$modelz->quantity.'</td>
               
               <td>'.$form->field($model, 'receivedquantity[]')->textInput(['id'=>'receivedquantity'.$i,'name'=>'receivedquantity'.$i,'placeholder'=>'Received Quantity','class'=>'form-control', 'onkeypress'=>'return isNumber(event)', 'required'=>true,'value'=>$value->receivedquantity])->label(false).'</td>
               
			   
           <td>'.$modelz->unit.$form->field($model, 'unitid[]')->hiddenInput(['value'=>$value->unitid])->label(false).'</td>
		     <td>'.$form->field($model, 'batchnumber[]')->textInput(['id'=>'batchnumber'.$i,'name'=>'batchnumber'.$i,'placeholder'=>'Batch Number','class'=>'form-control', 'required'=>true,'value'=>$value->batchnumber])->label(false).'</td>
             <td>'.$form->field($model, 'manufacturedate[]')->textInput(['id'=>'manufacturedate'.$i,'name'=>'manufacturedate'.$i,'class' => 'form-control datepicker3', 'placeholder' => 'DD-MM-YYYY','onkeypress'=>'return false', 'bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true,'value'=>date('d-m-Y',strtotime($value->manufacturedate))])->label(false).'</td>
             <td>'.$form->field($model, 'purchasedate[]')->textInput(['id'=>'purchasedate'.$i,'name'=>'purchasedate'.$i,'class' => 'form-control datepicker3', 'placeholder' => 'DD-MM-YYYY', 'onkeypress'=>'return false', 'bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true,'value'=>date('d-m-Y',strtotime($value->purchasedate))])->label(false).'</td>
             <td>'.$form->field($model, 'purchaseprice[]')->textInput(['id'=>'purchaseprice'.$i,'name'=>'purchaseprice'.$i,'placeholder'=>'Purchase Price', 'class'=>"form-control",'required'=>true,'value'=>$value->purchaseprice])->label(false).'</td>
             <td>'.$form->field($model, 'expiredate[]')->textInput(['id'=>'expiredate'.$i,'name'=>'expiredate'.$i,'class' => 'form-control datepicker3', 'placeholder' => 'DD-MM-YYYY', 'onkeypress'=>'return false','bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true,'value'=>date('d-m-Y',strtotime($value->expiredate))])->label(false).'</td>     
             </tr>';
			 $i++;
              }	
				}
				
				
				else{
             	foreach ($model2 as $key => $value) {
             		
				
				 $modelstock = Stockmaster::find()->where(['productid'=>$value->productid])->andwhere(['vendorid'=>$value->vendorid])->andwhere(['branch_id'=>$model1->frombranch])
				 ->one();	 
				 $stockid=$modelstock->stockid;
				
				if($stockid)
				{
					
				
				 $originalstock=Stockresponse::find()->where(['stockid'=>$stockid])->andwhere(['branch_id'=>$model1->frombranch]) ->andWhere(['>', 'receivedquantity', 0])->limit(1)->orderBy([
  'receiveddate' => SORT_DESC,
])->one();
				 
				 	
				
				
             	echo'<tr>
             <td>'.$i.'</td>
             <td>'.$value->product_name.$form->field($model, 'transferstockid[]')->hiddenInput(['value'=>$value->transferstockid])->label(false).$form->field($model, 'transferstockid')->hiddenInput(['name'=>'stockid[]','value'=>$modelstock->stockid])->label(false).'</td>
                 
             <td width="50px">'.$value->transferstockquantity.'</td>
             <td width="50px">'.$modelstock->quantity.'</td>';
             
            
	echo '<td>'.$form->field($model, 'receivedquantity[]')->textInput(['id'=>'receivedquantity'.$i,'name'=>'receivedquantity'.$i,'value'=>$originalstock->receivedquantity,'class'=>'form-control','readonly'=>'true', 'required'=>true])->label(false).'</td>';		 
			 
          
 echo '<td>'.$form->field($model, 'batchnumber[]')->textInput(['id'=>'batchnumber'.$i,'name'=>'batchnumber'.$i,'value'=>$originalstock->batchnumber,'class'=>'form-control','readonly'=>'true', 'required'=>true])->label(false).'</td>';
			   
			   
			   
           echo '  <td width="130px">'.$form->field($model, 'manufacturedate[]')->textInput(['id'=>'manufacturedate'.$i,
           'name'=>'manufacturedate'.$i,
           'class' => 'form-control datepicker3', 
           'placeholder' => 'DD-MM-YYYY',
           'onkeypress'=>'return false', 
           'bootstrap-datepicker data-date-autoclose' => "true", 
           'data-required' => "true",
    
'data-date-format' => "dd-mm-yyyy",
'readonly'=>'true',
'value'=>$originalstock->manufacturedate,
     'required'=>true])->label(false).'</td>';
	 
	 
	 
            echo ' <td width="130px">'.$form->field($model, 'purchasedate[]')->textInput(['id'=>'purchasedate'.$i,
            'name'=>'purchasedate'.$i,
            'class' => 'form-control datepicker3', 
            'placeholder' => 'DD-MM-YYYY', 
            'onkeypress'=>'return false',
            'bootstrap-datepicker data-date-autoclose' => "true", 
            'data-required' => "true",
  
     'data-date-format' => "dd-mm-yyyy",
     'readonly'=>'true',
'value'=>$originalstock->purchasedate,
     'required'=>true])->label(false).'</td>';
	 
	
             echo  '<td width="130px">'.$form->field($model, 'expiredate[]')->textInput(['id'=>'expiredate'.$i,
             'name'=>'expiredate'.$i,
             'class' => 'form-control datepicker3', 
             'placeholder' => 'DD-MM-YYYY',
             'onkeypress'=>'return false',
            
             'data-required' => "true",
              'readonly'=>'true',
'value'=>$originalstock->expiredate,
    'required'=>true])->label(false).'</td> ';
	  echo ' <td width="50px">'.$form->field($model, 'receivedquantity[]')->textInput([
	  'id'=>'approvedquantity'.$i,
	  'name'=>'approvedquantity'.$i,
	  'placeholder'=>' Qty',
	 'class' => 'form-control approvedqty', 
	 'datacls' => 'calcprice' . $i, 
  'dataprice' => $originalstock->priceperquantity,
	  'onkeypress'=>'return isNumber(event)', 'required'=>true])->label(false).'</td>';
	  
	  echo ' <td width="50px">'.$form->field($model, 'receivedquantity[]')->textInput([
	  'id'=>'priceperquantity'.$i,
	  'name'=>'priceperquantity'.$i,
	  'placeholder'=>' Qty',
	  'class'=>'form-control',
	   'onkeypress'=>'return isNumber(event)', 
	  'required'=>true,'readonly'=>'true',
	  'value'=>$originalstock->priceperquantity])->label(false).'</td>';
	  
             echo '<td>'.$form->field($model, 'purchaseprice[]')->textInput([
             'id' => 'calcprice' . $i . '1', 
          'class' => 'form-control pricez',
             'name'=>'purchaseprice'.$i,
             'placeholder'=>'Price', 
           
             'required'=>true])->label(false).'</td>';
			     
             echo '</tr>';
			 
			 
			 }
			 $i++;
              
                  }
              }

echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
<td style="text-align:right;">Total</td>
<td style="text-align:right;"><span id="total">Rs.0</span><input type="hidden" id="totalprice" name="totalprice" /></td></tbody>
		 </table>
        </div>';
             ?>
             	</tbody>
                </table>
                 <div class="form-group pull-right" >
        <?= Html::Button('Update', ['class' => 'btn btn-default waves-effect waves-light update_req',]) ?>
    
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
		  
	$(document).ready(function()
 {	  
		  
		  $('body').on("input",'.approvedqty',function(evt){		
	
 	
   var self = $(this);
   self.val(self.val().replace(/[^0-9]/g, ''));
   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
   {
     evt.preventDefault();
   }
   var valz=$(this).val();
   var attz=$(this).attr('datacls');
   var perprice=$(this).attr('dataprice');
   var totalprice=(perprice)*(valz);
   $("#"+attz).text("Rs."+totalprice);
   $("#"+attz+"1").val(totalprice);
   var totla_each = 0;
   $('.pricez').each(function(){
   	 totla_each += parseFloat(this.value) || 0;
   
});
$("#total").text("Rs."+totla_each);
$("#totalprice").val(totla_each);

 });
  });
		  
		  
		  
        </script>