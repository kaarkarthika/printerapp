<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\Transferstock;
use backend\models\Stockmaster;
use backend\models\Stockresponse;
use backend\models\CompanyBranch;
use backend\models\Transferstockapprove;
use backend\models\Unit;
use backend\models\Vendor;
$this->title="Approve Transfer Stock Request";

?>
<style>
#load{display:none;position:fixed;left:128px;top:27px;width:100%;height:100%;z-index:9999;margin-top:20%}input.error{background:#fbe3e4;border:1px solid #fbc2c4;color:#8a1f11}	
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
 <?php $form = ActiveForm::begin(['id'=>'addform', 'method' => 'post']); ?>
<div id="load"  align="center"><img src="<?= Url::to('@web/dmc2.gif') ?>" />Loading...</div>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
	<div class="panel-heading"></div>
<div class="panel-body">
<table class="table table-striped table-bordered">
<thead><th>Requested Branch</th><th>Approved Branch</th><th>Request Code</th><th>Request date</th></thead>
   	<tr>
   		<td>
   			<?php $frombranchdata = CompanyBranch::find()->where(['branch_id'=>$model1->frombranch])->one();
			 echo $frombranchdata->branch_name;
            echo $form->field($model, 'frombranch')->hiddeninput(['readonly'=>true,'value'=>$model1->frombranch,])->label(false); ?>
   		</td>
   		<td>
   		<?php $tobranchdata = CompanyBranch::find()->where(['branch_id'=>$model1->tobranch])->one();
			 echo $tobranchdata->branch_name;
   echo $form->field($model, 'tobranch')->hiddeninput(['readonly'=>true,'value'=>$model1->tobranch,])->label(false); ?>	
   		</td>
   	
   		<td>
   			 <?= $form->field($model, 'transferstock_requestcode')->textinput(['readonly'=>true,'value'=>$model1->transferstock_requestcode])->label(false); ?>
   		</td>
   		<td>
   			 <?= $form->field($model1, 'transferstockdate')->textinput(['readonly'=>true,'value'=>date('d/m/Y',strtotime($model1->transferstockdate))])->label(false); ?>
   		</td>
   	</tr>
   </table>
<?php
             	$i=1;
				
				//echo '<pre>';
				if(count($model2)>0)
				{
				
				echo '<table  class="table table-striped table-bordered">
             <thead>
             <tr><th>#</th><th>Product Name</th><th>Vendor</th> <th>Transfer Stock Request Quantity</th><th>Total Stock for this Batch Number</th><th>Unit</th>
        <th>Batch Number</th><th>Expire Date</th> <th>MRP</th><th>Purchase Price</th> <th>Action</th></tr>
             </thead><tbody>';
				
				
				foreach ($model2 as $key => $value) 
				{
				 $modelz = Transferstock::find()->where(['transferstockid'=>$value->transferstockid])->one();	 
				
				 $unitdata=Unit::find()->where(['unitid'=>$modelz->unit])->one();
				
				$modelxz=Transferstockapprove::find()->where(['transferstockid'=>$value->transferstockid])->one();
	//Prasanth Code			
  		$modelstock = Stockmaster::find()->where(['productid'=>$modelz->productid])->andwhere(['branch_id'=>$model1->tobranch])->all();	 
		//print_r($modelstock);die;
    //Alban Code			
    //$modelstock = Stockmaster::find()->where(['productid'=>$modelz->productid])->andwhere(['branch_id'=>$model1->frombranch])->all();	 
	//echo '<pre>';
				//	print_r($modelstock);die;
    
    //	print_r($model1->tobranch);die;	
	foreach($modelstock as $stockreldata)
	{
	
				 $stockid=$stockreldata->stockid;
				 $vendorid=$stockreldata->vendorid;
				 $vendordata=Vendor::find()->where(['vendorid'=>$vendorid])->one();
				 $vendorname=$vendordata->vendorname;
	//Prasanth Code			 
	$originalstock=Stockresponse::find()->where(['stockid'=>$stockid])->andwhere(['branch_id'=>$model1->tobranch]) ->orderBy(['receiveddate' => SORT_DESC])->all();

	//Alban Code
	//$originalstock=Stockresponse::find()->where(['stockid'=>$stockid])->andwhere(['branch_id'=>$model1->frombranch]) ->orderBy(['receiveddate' => SORT_DESC])->all();
	
	
					
				if($stockid)
				{
					
				if($originalstock)
					{
							foreach($originalstock as $os)
						{
$approvedmodel=Transferstockapprove::find()->where(['transferstockid'=>$value->transferstockid])->andwhere(['batchnumber' =>$os->batchnumber])->one();

if(!$approvedmodel)
{
									
									$qty=$os->total_no_of_quantity;
									if($qty==0)
									{
										$class="danger";
									}
									else{
										$class="default";
									}
										echo' <tr class="'.$class.'">
										<td>'.$i.'</td>
										<td>'.$modelz->product_name.'</td>
										<td>'.$vendorname.'</td>
										<td width="50px">'.$modelz->transferstockquantity."-".$unitdata->unitvalue.'</td>
										
										<td>'.$os->total_no_of_quantity.'</td><td>'.$unitdata->unitvalue.'</td>
										<td>'.$os->batchnumber.'</td>
									    <td>'.date("d/m/Y",strtotime($os->expiredate)).'</td>
										<td>Rs.'.$os->mrpperunit.'</td><td>Rs.'.$os->mrp.'</td>
										<td>';
										
									if($qty==0)
									{
										echo "Please maintain stock";
									}	
									else{
										echo '<button type="button" id="btnsubmit'.$i.'" dataincrement="'.$i.'" class="btn btn-sm btn-icon btn-primary waves-effect waves-light choose_apstock"data-tsid='.$value->transferstockid.'
										data-id='.$os->stockresponseid.'>
										<i class="fa fa-plus"></i>
										</button>';
									}
										
										echo '</td></tr>';
										$i++;
								}
else{
	echo
 "<tr><td>".$i."</td><td>".$modelz->product_name."</td><td>".$vendorname."</td> <td>".$modelz->transferstockquantity."</td>
							 <td >".$modelstock->quantity."</td><td colspan='9'>Already Approved that product.</td>
							</tr>";
}

								
								}
								}

								else{
								echo
 "<tr><td>".$i."</td><td>".$modelz->product_name."</td> <td>".$modelz->transferstockquantity."</td>
							 <td >".$modelstock->quantity."</td><td colspan='9'>Opening Balance Only Assigned.</td>
							</tr>";
							 $i++;
						} 
					
						
           }



           else{
        echo "<tr><td>".$i."</td><td>".$modelz->product_name."</td> <td>".$modelz->transferstockquantity."</td>
							<td colspan='10'>Stock Not Available.</td>
							</tr>";
							 $i++;
           }
           
           }
		   
		   
		   
			
              }	





                  echo "</tbody></table>"	;
				  
				  
				}
				
				
				else{
								
							
				
					
					echo '<table  class="table table-striped table-bordered">
             <thead>
             <tr><th>#</th> <th>Product Name</th> <th>Transfer Stock Request Quantity</th><th>Overall stock for this batch Number</th>
        <th>Batch Number</th><th>Manufacture Date</th><th>Purchase Date</th><th>Expire Date</th> <th>Unit</th><th>Price/Qty</th><th>Purchase Price</th></tr>
             </thead>
             <tbody>'; 
					
          	foreach ($model2 as $key => $value) {
             		
					
             		$unitdata=Unit::find()->where(['unitid'=>$value->unit])->one();
             		
				
				 $modelstock = Stockmaster::find()->where(['productid'=>$value->productid])->andwhere(['vendorid'=>$value->vendorid])->andwhere(['branch_id'=>$model1->tobranch])
				 ->one();	 
				 $stockid=$modelstock->stockid;
				
				
				if($stockid)
				{
					
				
				 $originalstock=Stockresponse::find()->where(['stockid'=>$stockid])->andwhere(['branch_id'=>$model1->tobranch]) ->andWhere(['>', 'receivedquantity', 0])->limit(1)->orderBy([
  'receiveddate' => SORT_DESC,
])->one();

           if($originalstock)
		   {
		   	
		   
				
				
             	echo'<tr>
             <td>'.$i.'</td>
             <td>'.$value->product_name.$form->field($model, 'transferstockid[]')->hiddenInput(['id'=>'transferstockid'.$i,'name'=>'transferstockid'.$i,
             'value'=>$value->transferstockid])->label(false).'</td>
                 
             <td width="50px">'.$value->transferstockquantity.'</td>';
            
             
            
	echo '<td>'.$form->field($model, 'updated_ipaddress[]')->textInput(['id'=>'receivedquantity'.$i,'name'=>'receivedquantity'.$i,'value'=>$originalstock->receivedquantity,'class'=>'form-control','readonly'=>'true', 'required'=>true])->label(false).'</td>';		 
			 
          
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
	
	
	  echo ' <td width="50px">'.$form->field($model, 'approvedquantity[]')->textInput([
	  'id'=>'approvedquantity'.$i,
	  'name'=>'approvedquantity'.$i,
	  'placeholder'=>' Qty',
	 'class' => 'form-control approvedqty', 
	 'datacls' => 'calcprice' . $i, 
     'dataprice' => $originalstock->priceperquantity,
	  'onkeypress'=>'return isNumber(event)', 'required'=>true])->label(false).'</td>';
	   echo '<td>'.$unitdata->unitvalue.'</td>';
	  
	  echo ' <td width="50px">'.$form->field($model, 'updated_ipaddress[]')->textInput([
	  'id'=>'priceperquantity'.$i,
	  'name'=>'priceperquantity'.$i,
	  'placeholder'=>' Qty',
	  'class'=>'form-control',
	   'onkeypress'=>'return isNumber(event)', 
	  'required'=>true,'readonly'=>'true',
	  'value'=>$originalstock->priceperquantity])->label(false).'</td>';
	  
             echo '<td>'.$form->field($model, 'pricepertransferstock[]')->textInput([
             'id' => 'calcprice' . $i . '1', 
          'class' => 'form-control pricez',
             'name'=>'purchaseprice'.$i,
             'placeholder'=>'Price', 
           'readonly'=>true,
             'required'=>true])->label(false).'</td>';
			     
             echo '</tr>';
			  $i++;
             }
			 
			 }
			
              
                  }

echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
<td style="text-align:right;">Total</td>
<td style="text-align:right;"><span id="total">Rs.0</span><input type="hidden" id="totalprice" name="totalprice" /></td></tr></tbody>
		 </table>';

              } ?>
              
      <table id="approvedgrid"  class="table table-striped table-hover table-bordered">
         <thead id="approvedform_theaddata" style="display:none;">
             <tr><th>Product Name</th><th>Vendor</th> <th>Request Quantity</th>
        <th>Batch Number</th><th>Approved Quantity</th><th>Unit</th><th>Total Units</th> <th>Price/Qty</th><th>Total Price</th><th>Action</th></tr>
             </thead>  <?php $i=0;?>

         <tbody  id="approvedform_griddetails" >

        </tbody>

		 </table>

     </div>
  <div class="form-group pull-right" id="approvedbtn" style="display:none;">
        <?php echo Html::Button('Update', ['class' => 'btn btn-primary waves-effect waves-light update_req']) ?>
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
   	var rowCount = $('#approvedgrid tr').length-1;
   	var k=0;
  for(var i=0;i<=rowCount;i++)
  {
  	 	var totalstock=parseInt($("#totalstock" + i).val());
  	 	 var uq_1=$("#totalunits" + i).val();
          if(uq_1>totalstock)
          {
          	var k=1;
          }
  }
   if(k==0)
   {
   	$form_container.submit();
   }   	
   else{
   alert("Check approved Quantity units is greater than Stock");
   }
	
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
 	var o=0;
	$('body').on("click",'.choose_apstock',function(){
		
	var dataid=$(this).attr('data-id');
	var datatsid=$(this).attr('data-tsid');
	var inc=$(this).attr('dataincrement');
	 $("#load").show();
	 $("#btnsubmit"+ inc).prop('disabled', true);
	
	$.ajax({
        url:'<?php echo Yii::$app->homeUrl ?>?r=transferstock/approvedformdetail&id='+dataid+'&transferstockid='+datatsid+'&autonumber='+inc,
        type: "post",
        success: function (data) {
        	
        	 $("#load").hide();
     
        $('#approvedform_theaddata').show();
          $('#approvedbtn').show();
        
         var r = $("#approvedform_griddetails").append(data);
         
        }
     });
	
	})
 
  });  
  
  
  
  
        </script>