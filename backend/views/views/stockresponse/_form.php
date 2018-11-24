<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\Stockrequest;
use backend\models\Stockmaster;
 use backend\models\Taxgrouping;
 use backend\models\Product;
 use backend\models\Unit;
 use backend\models\VendorBranch;
 use yii\helpers\ArrayHelper;
$this->title="Update Stock Received";
?>
<style>#load{display:none;position:fixed;left:128px;top:27px;width:100%;height:100%;z-index:9999;margin-top:20%}input.error{background:#fbe3e4;border:1px solid #fbc2c4;color:#8a1f11}.a{cursor:default}
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
 <?php $form = ActiveForm::begin(['id'=>'addform','method' => 'post']);?>
<div id="load"  align="center"><img src="<?= Url::to('@web/dmc2.gif') ?>" />Loading...</div>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">
</div>
<div class="panel-body">
    <div class="col-md-2">
    	<label>Vendor</label>
     	<?= $form->field($model1, 'vendor_name')->textinput(['readonly'=>true])->label(false) ?>
    </div>
    <div class="col-md-3">
			<label>Request Code</label>
   <?= $form->field($model, 'request_code')->textinput(['readonly'=>true,'value'=>$model1->requestcode])->label(false); ?>
    </div>
    <div class="col-md-2">
			<label>Request Date</label>
   <?= $form->field($model1, 'requestdate')->textinput(['readonly'=>true,'value'=>date('d-m-Y',strtotime($model1->requestdate))])->label(false); ?>
    </div>
    <div class="col-md-2">
			<label>Receive Date</label>
   <?php echo $form->field($model, 'receiveddate')->textinput(['class' => 'form-control datepicker3', 
   'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'value'=>date('d-m-Y'),'onkeypress'=>'return false', 
   'bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true"])->label(false);?>
    </div>
</div>
<div class="container">
             	<?php $i=1;
				if(count($model3)>0){
					?> 
			 <table id="tablesample" class="table table-striped table-bordered" >
			 	
			 	<?php
			 					foreach ($model3 as $key => $value) {
					
				
				$modelz = Stockrequest::find()->where(['requestid'=>$value->stockrequestid])->one();
					 $modelstock = Stockmaster::find()->where(['productid'=>$modelz->productid])->andwhere(['vendorid'=>$modelz->vendorid])->
				 andwhere(['branch_id'=>$modelz->branch_id])->one();	
				 $stockmodel=new Stockmaster(); 
				
				$pdata= Product::find()->where(['productid'=>$modelz->productid])->one();
				$producttype=$pdata->product_typeid;
				
				$hsncode=$pdata->hsn_code;
				if($hsncode)
				{
					$taxdata=Taxgrouping::find()->where(['hsncode'=>$hsncode])->one();
				$gstpercent=$taxdata->tax;
				
				$cgstpercent=$gstpercent/2;
				$sgstpercent=$gstpercent/2;
				$igstpercent=0;
				}
					else {
						 $gstpercent=0;
						$cgstpercent=0;
				        $sgstpercent=0;
						$igstpercent=0;
					}
					$unitdata=Unit::find()->where(['unitid'=>$pdata->unit])->one();
					$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->andwhere(['unitname'=>$producttype])->asArray()->all(), 'unitid', 'unitvalue');
					 
             	echo $form->field($model, 'stockrequestid[]')->hiddenInput(['value'=>$value->stockrequestid])->label(false);
             	echo $form->field($model, 'stockid[]')->hiddenInput(['id'=>'stockid'.$i,'value'=>$modelstock->stockid])->label(false);
			
        	$vendorbranchlist=VendorBranch::find()->where(['vendorid'=>$modelz->vendorid])->all();
			
			if(count($vendorbranchlist)>0){
			foreach ($vendorbranchlist as  $value1) {
				$vendorbranchids[]=$value1->vendor_branchid;
				
			}
			}
			 $vendorbranchlistnew=ArrayHelper::map(VendorBranch::find()->where(['is_active'=>1])->andwhere(['in', 'vendor_branchid', $vendorbranchids])->asArray()->all(), 'vendor_branchid', 'branchname');
			?> 
			 <tr>
			<td class="col-md-4">	 
					         <div class="col-md-12"><b><h4 class="text-danger"><center>Received Quantity Information</center></h4></b></div>		
					         <div class="clearfix" style="padding-bottom:30px;"></div>
               <div class="col-md-6">  Stock Name :</div><div class="col-md-6">
               <?php echo	$modelz->product_name;?>
               </div>
                <div class="col-md-6">  Vendor Branch :</div><div class="col-md-6">
               <?php echo $form->field($stockmodel, 'vendor_branchid[]')->dropdownlist($vendorbranchlistnew,['prompt'=>'--Vendor Branch--','required'=>'true',
          'id'=>'vendor_branchid'.$i,'dataincrement'=>$i,'class'=>'vendor_branchid form-control tabind','tabindex'=>1001,'value'=>$modelstock->vendor_branchid,
          'onchange'=>' $.get( "'.Url::toRoute('getigstcalculation').'", { id: $(this).val(),dataid:$(this).attr("dataincrement") } )
                                                        .done(function(data)
														 {
														    	
																
														    var json = JSON.parse(data);
															var data2=json.dataid;
                                                            var data1=json.igstpercent;
													       
															
														$("#igstpercent"+data2).val(data1);
															
															
															
                                                        }
                                                    );'
          
          ])->label(false);?>
           </div>
                     <div class="col-md-6">  Request Quantity :</div><div class="col-md-6">
               <?php
                echo $modelz->quantity."-".$unitdata->unitvalue;
                echo $form->field($model, 'productgroupid[]')->hiddenInput(['value'=>$modelz->productgroupid])->label(false); 
               ?>
               	
               </div>
                <div class="col-md-6">  Received Quantity :</div><div class="col-md-6">
               	
               <?php 
                echo $form->field($model, 'receivedquantity[]')->textInput(['id'=>'receivedquantity'.$i,
                'dataincrement'=>$i,
                'placeholder'=>'Received Quantity',
                'class'=>'form-control receivedqty tabind',
                'tabindex'=>1002,
                 'onkeypress'=>'return isNumber(event)', 
                 'required'=>true,'value'=>$value->receivedquantity])->label(false);
               ?>
               	
               </div>
                <div class="col-md-6">  Free Quantity :</div><div class="col-md-6">
               	
               <?php 
                echo $form->field($model, 'receivedfreequantity[]')->textInput(['id'=>'receivedfreequantity'.$i,
                'dataincrement'=>$i,
                'placeholder'=>'Received Free Quantity',
                'class'=>'form-control receivedfreeqty tabind', 
                'tabindex'=>1003,
                'onkeypress'=>'return isNumber(event)',
                 'required'=>true,'value'=>$value->receivedfreequantity])->label(false);
               ?>
               	
               </div>
                <div class="col-md-6">  Unit Form :</div><div class="col-md-6">
               	
               <?php echo
          $form->field($model, 'unitid[]')->dropdownlist($unitlist,['prompt'=>'--Unit--','required'=>'true',
          'id'=>'unitid'.$i,'dataincrement'=>$i,'class'=>'unitquantity form-control tabind','tabindex'=>1004,'value'=>$unitdata->unitid,
           'onchange'=>'
                                                    $.get( "'.Url::toRoute('getunitquantity').'", { id: $(this).val(),dataid:$(this).attr("dataincrement") } )
                                                        .done(function( data ) 
                                                        {
                                                           var json = JSON.parse(data);
															var data2=json.dataid;
                                                            var data1=json.noofunit;
															var rq=$("#receivedquantity"+data2).val();
															if(rq==""){rq=0;}
															var rq1=$("#receivedfreequantity"+data2).val();
															if(rq1==""){rq1=0;}
															var tu=(parseFloat(rq)+parseFloat(rq1))*data1;
															$("#totalunits"+data2).val(tu); 
															 $("#unitquantity"+data2).val(data1);                                                  
                                                        }
                                                    );'
          
          
          
          ])->label(false)
           .$form->field($model, 'updated_ipaddress[]')->hiddenInput(['id'=>'unitquantity'.$i,'dataincrement'=>$i,'value'=>$unitdata->no_of_unit,
           'class'=>'form-control'])->label(false);?>
        
               	
               </div>
                 <div class="col-md-6">  Total Units :</div><div class="col-md-6">
               	
               <?php  echo $form->field($model, 'total_no_of_quantity[]')->textInput(['class'=>'totalunits form-control tabind',
               'tabindex'=>1005,'value'=>$value->total_no_of_quantity,
               'id'=>'totalunits'.$i,'readonly'=>'true'])->label(false);?>
               	
               </div>
                 <div class="col-md-6">Purchase Price</div><div class="col-md-6">
               	
               <?php  echo $form->field($model, 'purchaseprice[]')->textInput(['id'=>'purchaseprice'.$i,
			 'placeholder'=>'Purchase Price', 
			   'dataincrement'=>$i,
			 'class'=>"form-control purchaseprice tabind",
			 'tabindex'=>1006,
			 'required'=>true,
			 'value'=>$value->purchaseprice])->label(false);?>
               	
               </div>
                <div class="col-md-6">Price Per Quantity</div><div class="col-md-6">
               	
               <?php echo $form->field($model, 'priceperquantity[]')->textInput(['id'=>'priceperquantity'.$i,
		   		    'dataincrement'=>$i,
		    'placeholder'=>'priceperquantity',
		     'class'=>"form-control priceperquantity tabind",
		     'tabindex'=>1007,
		     'value'=>$value->priceperquantity,
		     'required'=>true])->label(false);?>
               </div>
               
                    <div class="col-md-12">
					 <?php echo '
             	<button type="button" class="btn btn-sm btn-icon btn-default waves-effect waves-light addstock" >
									 <i class="fa fa-plus"></i>
									 </button> '; 
												  echo '
             	
									<button type="button" class="btn btn-sm btn-icon btn-default waves-effect waves-light removebutton" id="removebutton'.$i.'">
									<i class="fa fa-trash"></i>
									 </button>'; ?></div>
              </td>
              
              
          
              
              
              
              <td class="col-md-4">	        	
					        	
					         <div class="col-md-12"><b><h4 class="text-danger"><center> Batch Information</center></h4></b></div>		
					         <div class="clearfix" style="padding-bottom:30px;"></div>
               <div class="col-md-6">  Batch Number :</div><div class="col-md-6">
               <?php	 echo $form->field($model, 'batchnumber[]')->textInput(['id'=>'batchnumber'.$i,'placeholder'=>'Batch Number', 'dataincrement'=>$i,
            'class'=>'form-control batchno tabind',  'tabindex'=>1008,'required'=>true,'value'=>$value->batchnumber])->label(false);?>
               	
               	
               </div>
               
                <div class="col-md-6">  Manufacture Date :</div><div class="col-md-6">
               <?php	 echo $form->field($model, 'manufacturedate[]')->textInput(['id'=>'manufacturedate'.$i,'class' => 'form-control datepicker3 tabind','tabindex'=>1009 ,'placeholder' => 'DD-MM-YYYY','onkeypress'=>'return false', 'bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'value'=>date('d-m-Y',strtotime($value->manufacturedate))])->label(false);?>
               	
               	
               </div>
               
                <div class="col-md-6">  Expire Date :</div><div class="col-md-6">
               <?php	 
                echo $form->field($model, 'expiredate[]')->textInput(['id'=>'expiredate'.$i,'class' => 'form-control datepicker3 tabind','tabindex'=>1010 ,'placeholder' => 'DD-MM-YYYY', 'onkeypress'=>'return false','bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true,'value'=>date('d-m-Y',strtotime($value->expiredate))])->label(false);
               
               ?>
               </div>
               
                <div class="col-md-6"> Purchase  Date :</div><div class="col-md-6">
               <?php	 
                
            echo $form->field($model, 'purchasedate[]')->textInput(['id'=>'purchasedate'.$i,'class' => 'form-control datepicker3 tabind', 'tabindex'=>1011 ,'placeholder' => 'DD-MM-YYYY', 'onkeypress'=>'return false', 'bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true,'value'=>date('d-m-Y',strtotime($value->purchasedate))])->label(false);
               
               ?>
               	
               	
               </div>
               
                <div class="col-md-6">  Discount(%) :</div><div class="col-md-6">
               <?php	 
               echo $form->field($model, 'discountpercent[]')->textInput(['id'=>'discountpercent'.$i,
			'placeholder'=>'Discount (%)',
			'value'=>$value->discountpercent,
			 'class'=>"form-control discountpercent tabind",
			 'tabindex'=>1012 ,
			   'dataincrement'=>$i,
			 'required'=>true])->label(false);
               
               ?>
               </div>
               <div class="col-md-6">  Discount Value :</div><div class="col-md-6">
               <?php	 
                echo $form->field($model, 'discountvalue[]')->textInput(['id'=>'discountvalue'.$i,  'dataincrement'=>$i,'placeholder'=>'Discount Value',
              'value'=>$value->discountvalue, 'readonly'=>'true','class'=>"form-control tabind",'tabindex'=>1013 ,'required'=>true])->label(false);
               
               ?>
               </div>
               <div class="col-md-6">MRP</div><div class="col-md-6">	
												  <?php 
												  echo $form->field($model, 'mrp[]')->textInput(['id'=>'mrp'.$i,'class'=>"form-control mrpval tabind",'tabindex'=>1014 ,'dataincrement'=>$i,'placeholder'=>'MRP Value',
			'value'=>$value->mrp, 'class'=>"form-control",'required'=>true])->label(false);
												  ?> 
												  </div><div class="col-md-6">MRP Per Unit</div><div class="col-md-6">	
	<?php 
	echo $form->field($model, 'mrpperunit[]')->textInput(['id'=>'mrpperunit'.$i,  'dataincrement'=>$i,'value'=>$value->mrpperunit,
			'placeholder'=>'MRP/Unit', 'class'=>"form-control mrpperunit tabind",'tabindex'=>1015,'required'=>true])->label(false);
	?>
			 
			 </div>
              </td>
                  <td class="col-md-4">	        	
					        	
					         <div class="col-md-12"><b><h4 class="text-danger"><center>GST Information</center></h4></b></div>		
					         <div class="clearfix" style="padding-bottom:30px;"></div>
               <div class="col-md-6">  GST % :</div><div class="col-md-6">
               	<?php	echo $form->field($model, 'gstpercent[]')->textInput(['id'=>'gstpercent'.$i,  'dataincrement'=>$i,'placeholder'=>'GST (%)',
               	'value'=>$value->gstpercent,
		  'class'=>"form-control gstpercent tabind",'tabindex'=>1016,'required'=>true])->label(false);?>
               	
               	
               </div>
               <div class="col-md-6">  GST Value:</div><div class="col-md-6">
               	<?php	echo $form->field($model, 'gstvalue[]')->textInput(['id'=>'gstvalue'.$i,'placeholder'=>'GST Value', 
              'dataincrement'=>$i,'readonly'=>'true', 'value'=>$value->gstvalue,'class'=>"form-control tabind",'tabindex'=>1017,'required'=>true])->label(false);?>
               	
               	
               </div>
               <div class="col-md-6">  CGST % :</div><div class="col-md-6">
               	<?php	  echo $form->field($model, 'cgstpercent[]')->textInput(['id'=>'cgstpercent'.$i,  'readonly'=>true,
			   'dataincrement'=>$i,'value'=>$value->cgstpercent,'placeholder'=>'CGST (%)', 'class'=>"form-control cgstpercent tabind",'tabindex'=>1018,
			   'required'=>true])->label(false);?>
               	
               	
               </div>
               <div class="col-md-6">  CGST Value:</div><div class="col-md-6">
               	<?php	
               	 echo $form->field($model, 'cgstvalue[]')->textInput(['id'=>'cgstvalue'.$i,
               'dataincrement'=>$i,'placeholder'=>'CGST Value','value'=>$value->cgstvalue,'readonly'=>'true', 
               'class'=>"form-control cgstvalue tabind",'tabindex'=>1019,'required'=>true])->label(false);
               	
               	?>
               	
               	
               </div>
               <div class="col-md-6">  SGST % :</div><div class="col-md-6">
               	<?php	
               	  echo $form->field($model, 'sgstpercent[]')->textInput(['id'=>'sgstpercent'.$i, 'readonly'=>true,
			    'dataincrement'=>$i,'placeholder'=>'SGST (%)','value'=>$value->sgstpercent,
			    'class'=>"form-control sgstpercent tabind",
			    'tabindex'=>1020,
			    'required'=>true])->label(false);
               	?>
               	
               	
               </div>
               <div class="col-md-6">  SGST Value:</div><div class="col-md-6">
               	<?php	
               	 echo $form->field($model, 'sgstvalue[]')->textInput(['id'=>'sgstvalue'.$i,  
              'dataincrement'=>$i,'placeholder'=>'SGST Value','value'=>$value->sgstvalue,
               'readonly'=>'true','class'=>"form-control sgstvalue tabind",'tabindex'=>1021,'required'=>true])->label(false);
               	?>
               	
               	
               </div>
               <div class="col-md-6">  IGST % :</div><div class="col-md-6">
               	<?php	
               		echo $form->field($model, 'igstpercent[]')->textInput(['id'=>'igstpercent'.$i,  'dataincrement'=>$i,'value'=>$value->igstpercent,
			'placeholder'=>'IGST (%)', 'class'=>"form-control tabind",'tabindex'=>1022,'required'=>true])->label(false);
               	?>
               	
               	
               </div>
               <div class="col-md-6">  IGST Value:</div><div class="col-md-6">
               	<?php	 echo $form->field($model, 'igstvalue[]')->textInput(['id'=>'igstvalue'.$i,  'dataincrement'=>$i,'value'=>$value->igstvalue,
               	'placeholder'=>'IGST Value',
               'class'=>"form-control tabind",'tabindex'=>1023,'required'=>true])->label(false);?>
               </div>
              </td>
              
              
              
              
             </tr>
              
              
			 
			
        <?php  
	 
 echo '</tr>';
			 $i++;
			 
			 
              }	


echo '</table>';


				}
				else
				
				
				{ ?>
					
			 <table id="tablesample" class="table table-striped table-bordered" >
					
					<?php
					
					
             	foreach ($model2 as $key => $value) {
				 $modelstock = Stockmaster::find()->where(['productid'=>$value->productid])->andwhere(['vendorid'=>$value->vendorid])->
				 andwhere(['branch_id'=>$value->branch_id])->one();	 
				$pdata= Product::find()->where(['productid'=>$value->productid])->one();
				$hsncode=$pdata->hsn_code;
				$producttype=$pdata->product_typeid;
				$unitdata=Unit::find()->where(['unitid'=>$value->unitid])->one();
				$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->andwhere(['unitname'=>$producttype])->asArray()->all(), 'unitid', 'unitvalue');
				if($hsncode)
				{
					$taxdata=Taxgrouping::find()->where(['hsncode'=>$hsncode])->one();
				$gstpercent=$taxdata->tax;
				$cgstpercent=$gstpercent/2;
				$sgstpercent=$gstpercent/2;
				$igstpercent=0;
				$discountpercent=0;
				$discountvalue=0;
				$freeqty=0;
				$mrp=0;
				$mrpperunit=0;
						
				}
					else {
						 $gstpercent=0;
						$cgstpercent=0;
				        $sgstpercent=0;
						$igstpercent=0;
						$discountpercent=0;
						$discountvalue=0;
						$freeqty=0;
						$mrp=0;
						$mrpperunit=0;
					}
					 $stockmodel=new Stockmaster();
					 
					
			 $list="";
        	$vendorbranchlist=VendorBranch::find()->where(['vendorid'=>$value->vendorid])->all();
			
			if(count($vendorbranchlist)>0){
				
				
			foreach ($vendorbranchlist as  $value1) {
				$vendorbranchids[]=$value1->vendor_branchid;
				
			}
			}
			
$vendorbranchlistnew=ArrayHelper::map(VendorBranch::find()->where(['is_active'=>1])->andwhere(['in', 'vendor_branchid', $vendorbranchids])->asArray()->all(),
 'vendor_branchid', 'branchname');
 

			 
         
	?>	 
	<tr style="border:1px solid #000;">
			<td class="col-md-4">	        	
					        	
					         <div class="col-md-12"><b><h4 class="text-danger"><center>Received Quantity Information</center></h4></b></div>		
					         <div class="clearfix" style="padding-bottom:30px;"></div>
               <div class="col-md-6">  Stock Name :</div><div class="col-md-6">
<?php 
 echo $value->product_name;
 echo $form->field($model, 'stockrequestid[]')->hiddenInput(['value'=>$value->requestid])->label(false);
            echo  $form->field($model, 'productgroupid[]')->hiddenInput(['value'=>$value->productgroupid])->label(false);
            echo  $form->field($model, 'stockid[]')->hiddenInput(['id'=>'stockid'.$i,
             'value'=>$modelstock->stockid,'data-stockid'=>$modelstock->stockid])->label(false);
             
             echo $form->field($model, 'updated_ipaddress[]')->hiddenInput(['id'=>'unitquantity'.$i,'class'=>'unitquantity form-control'])->label(false);?>
			</div>
											
											<div class="col-md-6">  Vendor Branch :</div><div class="col-md-6">
<?php 
 echo $form->field($stockmodel, 'vendor_branchid[]')->dropdownlist($vendorbranchlistnew,['prompt'=>'--Vendor Branch--','required'=>'true',
          'id'=>'vendor_branchid'.$i,'dataincrement'=>$i,'class'=>'vendor_branchid form-control tabind','tabindex'=>1001,
               'onchange'=>' $.get( "'.Url::toRoute('getigstcalculation').'", { id: $(this).val(),dataid:$(this).attr("dataincrement") } )
                                                        .done(function(data)
														 {
														    	
																
														    var json = JSON.parse(data);
															var data2=json.dataid;
                                                            var data1=json.igstpercent;
													       
															
														$("#igstpercent"+data2).val(data1);
															
															
															
                                                        }
                                                    );'
          
          
          ])->label(false);?>	
			</div>
		<div class="col-md-6">  Request Quantity :</div><div class="col-md-6">	
								
								<?php echo $value->quantity."-".$unitdata->unitvalue;?> </div>
								 <div class="clearfix" style="padding-bottom:30px;"></div>
								
									<div class="col-md-6">  Received Quantity :</div><div class="col-md-6">			<?php 
 
   echo $form->field($model, 'receivedquantity[]')->textInput(['id'=>'receivedquantity'.$i,
             'data-receivedquantity'=>'receivedquantity'.$i, 'dataincrement'=>$i,
             'placeholder'=>' Qty','class'=>'form-control receivedqty tabind','tabindex'=>1002, 
             'onkeypress'=>'return isNumber(event)', 'required'=>true])->label(false);
   
   ?>
</div><div class="col-md-6">  Free Quantity :</div><div class="col-md-6">	<?php 
	echo $form->field($model, 'receivedfreequantity[]')->textInput(['id'=>'receivedfreequantity'.$i, 'dataincrement'=>$i,
                       'data-receivedfreequantity'=>'receivedfreequantity'.$i,
                       'placeholder'=>' Free Qty','class'=>'form-control receivedfreeqty tabind','tabindex'=>1003,'value'=>$freeqty,
                        'onkeypress'=>'return isNumber(event)', 'required'=>true])->label(false);	 	
									?></div><div class="col-md-6">  Unit Form :</div><div class="col-md-6">
										
													 <?php 		  
					    echo $form->field($model, 'unitid[]')->dropdownlist($unitlist,['prompt'=>'--Unit--','required'=>'true',
          'id'=>'unitid'.$i,'dataincrement'=>$i,'class'=>'unitid form-control tabind','tabindex'=>1004,
            'onchange'=>' $.get( "'.Url::toRoute('getunitquantity').'", { id: $(this).val(),dataid:$(this).attr("dataincrement") } )
                                                        .done(function(data)
														 {
														     var json = JSON.parse(data);
															var data2=json.dataid;
                                                            var data1=json.noofunit;
													       
															
															var rq=$("#receivedquantity"+data2).val();
															if(rq==""){rq=0;}
															var rq1=$("#receivedfreequantity"+data2).val();
															if(rq1==""){rq1=0;}
															
															var tu=(parseFloat(rq)+parseFloat(rq1))*data1;
															$("#totalunits"+data2).val(tu); 
															 $("#unitquantity"+data2).val(data1);
															
															
                                                        }
                                                    );'
          
          
          
          ])->label(false); ?>
													
												</div><div class="col-md-6"> Total Units:</div><div class="col-md-6">
													<?php echo $form->field($model, 'total_no_of_quantity[]')->textInput(['class'=>'totalunits form-control tabind',
													'tabindex'=>1005,'id'=>'totalunits'.$i,'value'=>0,
													'readonly'=>'true'])->label(false);?>
													
			   
			   </div><div class="col-md-6">  Purchase Price :</div><div class="col-md-6">
			   <?php 
			 echo $form->field($model, 'purchaseprice[]')->textInput(['id'=>'purchaseprice'.$i,
		   	'dataincrement'=>$i,
		    'placeholder'=>'Price',
		      'value'=>0,
		     'class'=>"form-control purchaseprice tabind",
		     'tabindex'=>1006,
		     'required'=>true])->label(false);
													?>
												</div>
													<div class="col-md-6"> Price Per Quantity :</div><div class="col-md-6"><?php 
												  	  echo $form->field($model, 'priceperquantity[]')->textInput(['id'=>'priceperquantity'.$i,
		   		    'dataincrement'=>$i,
		    'placeholder'=>'priceperquantity',
		      'value'=>0,
		     'class'=>"form-control priceperquantity tabind",
		     'tabindex'=>1007,
		     'required'=>true])->label(false);?>
		     </div>
		     <div class="col-md-12">
					 <?php echo '
             	<button type="button" class="btn btn-sm btn-icon btn-default waves-effect waves-light addstock" >
									 <i class="fa fa-plus"></i>
									 </button> '; 
												  echo '
             	<button type="button" class="btn btn-sm btn-icon btn-default waves-effect waves-light removebutton">
									<i class="fa fa-trash"></i>
									 </button>'; 	 	
												  	
												  	?></div>
												  </td>
										
					 
					 		
							
							
							<td class="col-md-4">
								<div class="col-md-12"><b><h4 class="text-danger"><center>Batch Information</center></h4></b></div>		
					         <div class="clearfix" style="padding-bottom:30px;"></div>
							<div class="col-md-6">Batch Number</div><div class="col-md-6">
							 	
 <?php echo $form->field($model, 'batchnumber[]')->textInput(['id'=>'batchnumber'.$i,'placeholder'=>'Batch No','class'=>'form-control batchno tabind','tabindex'=>1008 ,
		      'dataincrement'=>$i,'required'=>true])->label(false);?>
		      
		      </div><div class="col-md-6">Manufacture Date</div><div class="col-md-6">
 <?php   echo $form->field($model, 'manufacturedate[]')->textInput(['id'=>'manufacturedate'.$i,'class' => 'form-control datepicker3 tabind', 'tabindex'=>1009,'placeholder' => 'DD-MM-YYYY', 'bootstrap-datepicker data-date-autoclose' => "true", 
		  'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true])->label(false);?>
												
							  </div><div class="col-md-6">Expired Date</div><div class="col-md-6">					
											
											<?php 	  $year = date('Y');
    $yearEnd ='31-12-'.$year;
echo $form->field($model, 'expiredate[]')->textInput(['id'=>'expiredate'.$i,'class' => 'form-control datepicker3 tabind', 'tabindex'=>1010,'placeholder' => 'DD-MM-YYYY','bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true,'value'=>$yearEnd])->label(false);
     
     
     
     ?> </div><div class="col-md-6">Purchase Date</div><div class="col-md-6">	
	<?php echo $form->field($model, 'purchasedate[]')->textInput(['id'=>'purchasedate'.$i,'class' => 'form-control datepicker3 tabind', 'tabindex'=>1011, 'placeholder' => 'DD-MM-YYYY', 'bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true,'value'=>date("d-m-Y")])->label(false);?>
													
												 </div><div class="col-md-6">Discount %</div><div class="col-md-6">	
													
													
												
													
												<?php echo	$form->field($model, 'discountpercent[]')->textInput(['id'=>'discountpercent'.$i,
             'dataincrement'=>$i,
             'placeholder'=>'Discount (%)', 
             'class'=>"form-control discountpercent tabind",
             'tabindex'=>1012,
             'value'=>$discountpercent,
             'required'=>true])->label(false);?>
												 </div><div class="col-md-6">Discount Value</div><div class="col-md-6">	
													<?php echo $form->field($model, 'discountvalue[]')->textInput([
              'id'=>'discountvalue'.$i,
             'value'=>$discountvalue,
              'placeholder'=>'Discount Value',
               'class'=>"form-control tabind",
               'tabindex'=>1013,
               'required'=>true])->label(false);?>
												 </div><div class="col-md-6">MRP</div><div class="col-md-6">	
												  <?php echo $form->field($model, 'mrp[]')->textInput(['id'=>'mrp'.$i,
             
              'placeholder'=>'MRP Value', 
              'class'=>"form-control mrpval tabind",
              'tabindex'=>1014,
              'dataincrement'=>$i,
              'value'=>0,
              'required'=>true])->label(false);?> </div><div class="col-md-6">MRP Per Unit</div><div class="col-md-6">	
	<?php echo $form->field($model, 'mrpperunit[]')->textInput(['id'=>'mrpperunit'.$i,
			
			 'placeholder'=>'MRP/Unit', 
			 'class'=>"form-control mrpperunit tabind",
			 'tabindex'=>1015,
			 'dataincrement'=>$i,
			 'value'=>0,
			 'required'=>true])->label(false);?>
			 
			 </div>
											</td>
											
											
											<td class="col-md-4">
												
												 <div class="col-md-12"><b><h4 class="text-danger"><center>GST Information</center></h4></b></div>		
					         <div class="clearfix" style="padding-bottom:30px;"></div>
												<div class="col-md-6">Gst %</div>
												<div class="col-md-6">
<?php echo $form->field($model, 'gstpercent[]')->textInput(['id'=>'gstpercent'.$i, 'placeholder'=>'GST (%)',
		  'dataincrement'=>$i, 'value'=>$gstpercent, 'class'=>"form-control gstpercent tabind",'tabindex'=>1016,'required'=>true])->label(false);?>	
		  </div>
	<div class="col-md-6">Gst Value</div><div class="col-md-6">
				
				
				
 <?php echo $form->field($model, 'gstvalue[]')->textInput([
   'id'=>'gstvalue'.$i, 'dataincrement'=>$i, 'placeholder'=>'GST Value',  'class'=>"form-control tabind",'tabindex'=>1017 ,'readonly'=>'true','required'=>true])->label(false);?>
												
										</div><div class="col-md-6">CGST %</div><div class="col-md-6">
											
											<?php echo $form->field($model, 'cgstpercent[]')->textInput(['id'=>'cgstpercent'.$i,
			  'dataincrement'=>$i,
			   'value'=>$cgstpercent,'placeholder'=>'CGST (%)', 'readonly'=>true,
			   'class'=>"form-control cgstpercent tabind",'tabindex'=>1018,'required'=>true])->label(false);?></div>
												
											<div class="col-md-6">CGST Value</div><div class="col-md-6">
													 <?php echo $form->field($model, 'cgstvalue[]')->textInput([
               'id'=>'cgstvalue'.$i,
               'dataincrement'=>$i,
               'placeholder'=>'CGST Value',
               'class'=>"form-control cgstvalue tabind",
               'tabindex'=>1019,
               'readonly'=>'true',
               'required'=>true])->label(false);
               
               
               ?>
					</div><div class="col-md-6">SGST Percent</div><div class="col-md-6">
												
												<?php echo $form->field($model, 'sgstpercent[]')->textInput(['id'=>'sgstpercent'.$i,
			  'dataincrement'=>$i,
			   'placeholder'=>'SGST (%)','readonly'=>true,
			   'value'=>$sgstpercent,
			   'class'=>"form-control sgstpercent tabind" ,
			   'tabindex'=>1020,
			   'required'=>true])->label(false);
			   ?>
			   </div><div class="col-md-6">SGST Value</div><div class="col-md-6">
													
													
													<?php echo $form->field($model, 'sgstvalue[]')->textInput([
              'id'=>'sgstvalue'.$i,'dataincrement'=>$i, 'placeholder'=>'SGST Value','readonly'=>'true',
               'class'=>"form-control sgstvalue tabind",'tabindex'=>1021,'required'=>true])->label(false);?>
									   </div><div class="col-md-6">IGST Percent</div><div class="col-md-6">
												  
												  
												  <?php echo $form->field($model, 'igstpercent[]')->textInput([
			   'id'=>'igstpercent'.$i, 'dataincrement'=>$i, 'value'=>0, 'placeholder'=>'IGST (%)', 
			   'class'=>"form-control igstpercent tabind",'tabindex'=>1022,'required'=>true])->label(false);?>
			   </div><div class="col-md-6">IGST Value</div><div class="col-md-6">	
			   	
			   							
	<?php echo $form->field($model, 'igstvalue[]')->textInput([
              'id'=>'igstvalue'.$i, 'dataincrement'=>$i,'placeholder'=>'IGST Value',
               'class'=>"form-control tabind",'tabindex'=>1023,'value'=>0, 'readonly'=>'true',
               'required'=>true])->label(false);?>
							</div></td>
							
											
											
											
											
											
											
											
									
									
		</tr>	  
		<?php	 
			 $i++;
              }

         
               echo' </table>';
			   
			   

              }
             ?>
             	
                 <div class="form-group pull-left" >
        <?= Html::submitButton('Update', ['class' => 'btn btn-default waves-effect waves-light update_req']) ?>
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

     jQuery(function($) {$('.autonumber').autoNumeric('init');});
		  
	  $(document).ready(function()
  {	 	 
		$("#tablesample tr:first").find('.removebutton').hide();
		
		
		 $('body').on('click', '.addstock', function()
		  {
		 		var length=$('#tablesample tr').length;
		 		
		 	$("#tablesample tr").find('.removebutton').show();
		 		
		 			
		 		
		 	var newlength=length+1;
                $(this).closest('tr').clone().insertAfter("tr:last").find("input,select,button").each(function() {
                $(this).attr({
			      'id': function(_, id) { var newid = id.replace(/[^A-Za-z]+/g, '');
			      	return newid + newlength },
			      'dataincrement': function(_, dataincrement) 
			      { 
			      	var length=$('#tablesample tr').length;
			      	return length 
			      	},
				    });
				  }).end().appendTo("table");
				  
				  
				
				  
				  
				});

 $(document).on('click', 'button.removebutton', function ()
  { 
		     $(this).closest('tr').remove();
		     return false;
 }); 
	});	 
        </script>
        
<script>
   $(document).on('change keyup click', '.receivedqty,.batchno,.receivedfreeqty,.unitid,.discountpercent,.gstpercent,.igstpercent,.mrpval', function ()
   {
          var inc=$(this).attr('dataincrement');
          var v1=$("#receivedquantity" + inc).val();
          if(v1=="")
          {
          	v1=0;
          }
          var v2=$("#receivedfreequantity" + inc).val();
           if(v2=="")
          {
          	v2=0;
          }
          var v3=$("#unitquantity" + inc).val();
          if(v3=="")
          {
          	v3=0;
          }
          var v4=(parseFloat(v1)+parseFloat(v2))*v3;
          $("#totalunits" + inc).val(v4);
          var v11=parseFloat(v1)*v3;
          var v12=$("#purchaseprice" + inc).val();
          var v24=$("#mrp" + inc).val();
          v6=$("#discountpercent" + inc).val();
          if(v6=="")
          {
          	v6=0;
          	v7=0;
          }
          else
          {
          	  v7=((v12*v6)/100).toFixed(2);
          }
        
          $("#discountvalue" + inc).val(v7);
          var gstpercent=$("#gstpercent" + inc).val();
          var gstvalue=((v24*gstpercent)/100).toFixed(2);
          var cgstpercent=gstpercent/2;
          var cgstvalue=(gstvalue/2).toFixed(2);
          $("#gstvalue" + inc).val(gstvalue);
          $("#cgstpercent" + inc).val(cgstpercent);
          $("#cgstvalue" + inc).val(cgstvalue);
          $("#sgstpercent" + inc).val(cgstpercent);
          $("#sgstvalue" + inc).val(cgstvalue);
          var igstpercent=$("#igstpercent" + inc).val();
          var igstvalue=((v24*igstpercent)/100).toFixed(2);
          $("#igstvalue" + inc).val(igstvalue);
          var  mrp = parseFloat($("#mrp" + inc).val());
          if(mrp==0)
          {
          	 var mrpperunit=0;
          }
          else
          { var mrpperunit=(mrp/v11).toFixed(2);
          }
          $("#mrpperunit" + inc).val(mrpperunit);
  });
  
  
     $(document).on('change keyup click', '.purchaseprice', function ()
   {
          var inc=$(this).attr('dataincrement');
          var v1=$("#receivedquantity" + inc).val();
          if(v1=="")
          {
          	v1=0;
          }
          var v3=$("#unitquantity" + inc).val();
          if(v3=="")
          {
          	v3=0;
          }
          var v11=parseFloat(v1)*v3;
           var v12=$("#purchaseprice" + inc).val();
            var v24=$("#mrp" + inc).val();
          if(v12!=0)
          {
          var v14=(v12/v11).toFixed(2);
          	 $("#priceperquantity" + inc).val(v14);
         
          }
           v6=$("#discountpercent" + inc).val();
          if(v6=="")
          {
          	v6=0;
          	v7=0;
          }
             else{  v7=((v12*v6)/100).toFixed(2);}
               $("#discountvalue" + inc).val(v7);
               var gstpercent=$("#gstpercent" + inc).val();
               var gstvalue=((v24*gstpercent)/100).toFixed(2);
               var cgstpercent=gstpercent/2;
               var cgstvalue=(gstvalue/2).toFixed(2);
               $("#gstvalue" + inc).val(gstvalue);
               $("#cgstpercent" + inc).val(cgstpercent);
               $("#cgstvalue" + inc).val(cgstvalue);
               $("#sgstpercent" + inc).val(cgstpercent);
               $("#sgstvalue" + inc).val(cgstvalue);
               var igstpercent=$("#igstpercent" + inc).val();
               var igstvalue=((v24*igstpercent)/100).toFixed(2);
               $("#igstvalue" + inc).val(igstvalue);
   
  });
  
  
       $(document).on('change keyup click', '.priceperquantity', function ()
   {
          var inc=$(this).attr('dataincrement');
          var v1=$("#receivedquantity" + inc).val();
          if(v1=="")
          {
          	v1=0;
          }
          var v3=$("#unitquantity" + inc).val();
          if(v3=="")
          {
          	v3=0;
          }
          var v11=parseFloat(v1)*v3;
          
           var v21=$("#priceperquantity" + inc).val();
          if(v21!="")
          {
             var v12=(v21*v11).toFixed(2);
          	 $("#purchaseprice" + inc).val(v12);
          }
            v6=$("#discountpercent" + inc).val();
          if(v6=="")
          {
          	v6=0;
          	v7=0;
          }
          else{ v7=((v12*v6)/100).toFixed(2);}
           $("#discountvalue" + inc).val(v7);
           var gstpercent=$("#gstpercent" + inc).val();
           var v24=$("#mrp" + inc).val();
           var gstvalue=((v24*gstpercent)/100).toFixed(2);
           var cgstpercent=gstpercent/2;
           var cgstvalue=(gstvalue/2).toFixed(2);
           $("#gstvalue" + inc).val(gstvalue);
           $("#cgstpercent" + inc).val(cgstpercent);
           $("#cgstvalue" + inc).val(cgstvalue);
           $("#sgstpercent" + inc).val(cgstpercent);
           $("#sgstvalue" + inc).val(cgstvalue);
           var igstpercent=$("#igstpercent" + inc).val();
           var igstvalue=((v24*igstpercent)/100).toFixed(2);
           $("#igstvalue" + inc).val(igstvalue);
   
  });
         $(document).on('change keyup click', '.mrpperunit', function ()
   {
          var inc=$(this).attr('dataincrement');
          var v1=$("#receivedquantity" + inc).val();
          if(v1=="")
          {
          	v1=0;
          }
          var v3=$("#unitquantity" + inc).val();
          if(v3=="")
          {
          	v3=0;
          }
          var v11=parseFloat(v1)*v3;
           var v21=$("#mrpperunit" + inc).val();
          if(v21!="")
          {
          var v12=(v21*v11).toFixed(2);
          	 $("#mrp" + inc).val(v12);
          }
  });
   $('[tabindex="1001"]').focus();
  	$('#addform').on('keydown', '.tabind', function (event) {
   	
    if (event.which == 13) {
    	
        event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('tabindex'));
        $('[tabindex="' + (index + 1).toString() + '"]').focus();
    }
    else if(event.which == 8)
    {
    	event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('tabindex'));
        $('[tabindex="' + (index - 1).toString() + '"]').focus();
    }
});
</script>