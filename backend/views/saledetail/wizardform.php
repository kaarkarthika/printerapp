<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use backend\models\Vendor;
use backend\models\Product;
use backend\models\Composition;
use backend\models\Unit;
use backend\models\Stockmaster;
use backend\models\Stockrequest;
use yii\helpers\Url;
use backend\models\Saledetail;
use backend\models\Sales;
use backend\models\Stockresponse;
use yii\helpers\ArrayHelper;
use backend\models\Taxgrouping;
$datatables = $dataProvider->getModels();
$this->title = Yii::t('app', 'Update Sales');

?>
<style>
	
	.dataTables_wrapper .dataTables_length {
float: left;
}
div.dataTables_wrapper div.dataTables_filter{float:left !important;text-align: left;
width:600px  !important;}
</style>
<div class="container">
   <div class="row">
<div class="col-sm-12">
<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#">Update Sales</a></li>
									
								</ol>
							</div>
						</div>
<div class="col-sm-12">
<div class="panel panel-border panel-inverse">
<div class="panel-heading">
 </div>
 <div class="panel-body">
 
		<?php $form = ActiveForm::begin(['id' => 'wizard-validation-form1']);?>
		<?= $form -> field($salesmodel, 'emailid') -> hiddeninput(['id' => 'emailid', 'readonly' => true, 'value' => $patient_details1 -> emailid]) -> label(false);
		$ptype=$patient_details1 -> patient_type;
	
		?>
		 <div class="col-md-3">
 <div class="form-group ">
		<?= $form -> field($salesmodel, 'mrnumber') -> textInput(['maxlength' => true, 'class' => 'required form-control', 'id' => 'mr', 'readonly' => true, 'value' => $patient_details1 -> medicalrecord_number]);?>
		</div>
 </div>
 
 	 <div class="col-md-3">
 <div class="form-group ">
		<?= $form -> field($salesmodel, 'invoicedate') -> textInput(['maxlength' => true, 'class' => 'required form-control', 'id' => 'mr', 'readonly' => true, 'value' => date("d-m-Y h:i:s",strtotime($salesmodel -> invoicedate))]);?>
		</div>
 </div>
 <div class="col-md-3 ">
 <div class="form-group ">

	<?= $form -> field($salesmodel, 'patienttype') -> dropDownList(['1' => 'InPatient', '2' => 'OutPatient'], ['class' => 'required form-control','disabled'=>'disabled' ,'id' => 'patienttype', 'value' =>$ptype]);?>	
		
</div>



 </div>
 
 
 
 
 	 <div class="col-md-3">
 <div class="form-group ">
		<?= $form -> field($salesmodel, 'billnumber') -> textInput(['maxlength' => true, 'class' => 'required form-control',  'readonly' => true, 'value' => $salesmodel -> billnumber]);?>
		</div>
 </div>
 
 
 
		 <div class="col-md-3">	
 <div class="form-group">

		<?= $form -> field($salesmodel, 'name') -> textInput(['maxlength' => true, 
		'class' => 'required form-control',
		 'id' => 'name', 
		 'value' => $patient_details1 -> firstname . " " . $patient_details1 -> lastname]);?>
		</div>
 </div>
 

 
    <div class="col-md-3">
    	
    	<?php if(!$pmodel->isNewRecord)
    	{$dob= $pmodel->dob;
    		$pmodel->dob=date("d-m-Y",strtotime($dob));}?>
    		 <?= $form->field($salesmodel, 'dob')->textInput(['maxlength' => true,'data-provide' => "datepicker", "value"=>date("d-m-Y",strtotime($salemodel->dob)),
             'data-date-format' => "dd-mm-yyyy",'id'=>'dateofbirth'])->label("DOB"); ?>
    		
    		
    </div>
 <div class="col-md-3 ">
 <div class="form-group ">
		<?= $form -> field($salesmodel, 'gender') -> dropDownList(['M' => 'Male', 'F' => 'Female', 'T' => 'TransGender'], ['prompt' => 'Select',  'value' => $patient_details1 -> gender]);?>

		 </div>
 </div>

 <div class="col-md-3 ">
 <div class="form-group ">
	<?= $form -> field($salesmodel, 'phonenumber') ->textInput(['maxlength' => true, 'class' => 'required form-control', 'id' => 'phone', 'value' => $patient_details1 -> patient_mobilenumber])->label("Phone Number");?>
		<?php //$ptype=$patient_details1->ptype;?>
	</div>
 </div>
	 <div class="col-md-3">	
 <div class="form-group">

		<?= $form -> field($salesmodel, 'emailid') -> textInput(['maxlength' => true, 
		'class' => ' form-control',
		 'id' => 'name', 
		 'value' => $salesmodel->emailid ]);?>
		</div>
 </div>
 

</div>
</div>

 </div>
 <div class="col-sm-12">
<div class="panel panel-border panel-inverse">
<!--<div class="panel-heading">
	<h3>Search Stock from Your Branch</h3>
</div>-->

 <div class="panel-body">


  <!-- <table id="datatable-fixed-col4" class="table table-striped table-hover table-bordered">
                   <thead>
                                <tr>
                                	<th>Action</th>
                                   <th>Stock & Type</th>
                                     <th>Batch No</th>
                                      <th>Available Stock</th>
                                    <th>Stockcode</th>
                                      <th>Composition</th>
                                    <th>Brand</th>
                                      <th>Unit Form</th>
                                      <th>Expire Date</th>
                                       <th>MRP/Unit</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                	
                                	 $session = Yii::$app->session;
		                             $role=$session['authUserRole'];
		                             $companybranchid=$session['branch_id'];
									 $saledata=Sales::find()->where(['paid_status'=>'UnPaid'])->andwhere(['branch_id'=>$companybranchid])->all();
									  $saledata1=Sales::find()->where(['opsaleid'=>$saleid])->one();
									 $salesinputid=$saleid;
									 
                                	
                                	if(count($datatables)>0){
                                		
									$stockaudit1=Saledetail::find()->where(['opsaleid' => $saleid]) ->asArray()->all();	
										
										
            	
              	                        foreach ($datatables as $key => $value) {
                                		$branchid[]=$value->branch_id;
										$newbranchdata=array_intersect_key($branchlist, array_flip($branchid));
									    $branchval=array_values($newbranchdata);
										
										$vendorid[]=$value->stockbrandcode->vendorid;
										$newvendordata=array_intersect_key($vendorlist, array_flip($vendorid));
									    $vendorval=array_values($newvendordata);
										
										$productid[]=$value->stockbrandcode->productid;
										$newproductdata=array_intersect_key($productlist, array_flip($productid));
									    $productval=array_values($newproductdata);
										
										$pdata=Product::find()->where(['is_active'=>1])->andwhere(['productid'=>$value->stockbrandcode->productid])->one();
										
										$productgroupid[]=$value->stockbrandcode->productgroupid;
										$newproductgroupdata=array_intersect_key($productgrouplist, array_flip($productgroupid));
									    $productgroupval=array_values($newproductgroupdata);
										
										$stockcodeid[]=$value->stockbrandcode->productgroupid;
										$newstockcodedata=array_intersect_key($stockcodelist, array_flip($stockcodeid));
									    $stockcodeval=array_values($newstockcodedata);
										
										if($pdata)
										{
										//produc type		
											$producttypeid[]=$pdata->product_typeid;
										$newproducttypedata=array_intersect_key($producttypelist, array_flip($producttypeid));
									    $producttypeval=array_values($newproducttypedata);
										
										
										//composition
										
										$compositionid[]=$pdata->composition_id;
										$newcompositiondata=array_intersect_key($compositionlist, array_flip($compositionid));
									    $compositionval=array_values($newcompositiondata);
										
										//unit
										$unitid[]=$pdata->unit;
										$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
									    $unitval=array_values($newunitdata);
										
										}
										
										
										 $stockresponseid=$value->stockresponseid;
										$currentqty=0;
										foreach($saledata as $k)
										{
										  $saleid=$k->opsaleid;
											$saledetaildata=Saledetail::find()->where(['opsaleid'=>$saleid])->andwhere(['stockresponseid'=>$value->stockresponseid])->all();
											foreach($saledetaildata as $l)
											{
											$currentqty+=$l->productqty;	
										    }
										}
										$availableqty=($value->total_no_of_quantity)-$currentqty;
										
										$xdata=Saledetail::find()->where(['opsaleid'=>$saleid])->andwhere(['stockresponseid'=>$value->stockresponseid])->one();
										
										$availableqty=$availableqty+$xdata->productqty;
										
									
									$disabled="";
									foreach($stockaudit1 as $sdk)
									{
										if(($sdk["stockresponseid"])==($value->stockresponseid)){$disabled="disabled";}
									}
									
										
									//choose_ep=existing patient	
								if(($value->total_no_of_quantity)>0)
								{		
                                 echo "<tr>";	
								 $i=$value->stockresponseid;
								  echo"<td><button type='button' id='buttonsubmit".$i."'  dataincrement='".$i."'  $disabled class='btn btn-xs btn-icon btn-default waves-effect waves-light choose_ep'  data-id='".$value->stockresponseid."' >
								  <i class='fa fa-plus'></i>
								 </button></td>";
                                echo " <td>".$productval[0]."-".$producttypeval[0]."</td> <td>".$value->batchnumber."</td><td>".$availableqty."</td>
                                <td>".$stockcodeval[0]."</td> <td>".$compositionval[0]."</td>
                                  <td>".$productgroupval[0]."</td>";
								 echo "<td>".$unitval[0]."</td>";
								  echo "<td>".date("d/m/Y",strtotime($value->expiredate))."</td>";
								   echo "<td>".number_format($value->mrpperunit,2)."</td>";
								
								
								 
								
								
								    echo "<input type='hidden' name='branch_id' class='branchid' value='".$value->branch_id."'/>";
								    $newbranchdata=array(); $branchid=array(); $branchval="";
								    $newvendordata=array();  $vendorid=array();  $vendorval="";
									$newproductdata=array(); $productid=array();$productval="";
									$newproductgroupdata=array(); $productgroupid=array();$productgroupval="";
									$newproducttypedata=array(); $producttypeid=array();$producttypeval="";
									$newcompositiondata=array(); $compositionid=array();$compositionval="";
									$newstockcodedata=array(); $stockcodeid=array();$unitval="";
									$newunitdata=array(); $unitid=array();$stockcodeval="";
                                    
                                 echo"</tr>";
                                 }
								 $i++;
                               } 




} 







?>
                                
                                </tbody>
                            </table>-->
                          <div class="row">
                                                	<div class="panel panel-border panel-inverse">
                                                		<div class="panel-heading">
                                                		
                                                		</div>
                                                		<div class="panel-body">      
                                                			 <div  style="white-space: nowrap;
  overflow-x: visible;
  overflow-y: hidden;

  width: auto; ">          
                     			
                             <table id="productgrid_ep" class="table table-striped table-hover table-bordered">
             <thead id="ep_theaddata">
          
             <th>Stock Info</th>
             <th>Quantity</th>
              <th>UnitForm</th>
              <th>TotalUnits</th>
             <th>Price/Qty</th>
             <?php if($ptype==2)
			 { ?>
			 	 <th>GST (%)</th>
              <th>GST Value</th>
		<?php	 }?>
             
               <th> Disc <br>Type</th>
              <th> Discount</th>
                <th>Disc.Value</th>
             <th>Total Price</th><th></th>
             </thead>  
             <tbody id="formdetails_ep">

             <?php
                 $stockaudit=Saledetail::find()->where(['opsaleid' => $saleid]) ->all();
		         $session = Yii::$app->session;
		                             $role=$session['authUserRole'];
		                             $companybranchid=$session['branch_id'];
									 $saledata=Sales::find()->where(['paid_status'=>'UnPaid'])->andwhere(['branch_id'=>$companybranchid])->all();
                
           		 foreach($stockaudit as $k)
					{
				       $pid=$k->productid;
				       $product_data = Product::find() -> where(['productid' => $pid]) -> one();
					   $hsncode=$product_data->hsn_code;
				       $tax=$k->gstrate;
					 $composition = Composition::find() -> where(['composition_id' => $k -> compositionid]) -> one();
					 $unitlist = Unit::find() -> where(['unitid' => $k -> unitid]) -> one();
					 $unitid=$k->unitid;
					 $stockreceivedata=Stockresponse::find()->where(['stockresponseid'=>$k->stockresponseid])->one();
					 $unitlist1=ArrayHelper::map(Unit::find()->where(['unitname'=>$product_data->product_typeid])->asArray()->all(), 'unitid', 'unitvalue');
				
            ?>
			<tr id="productrowdata<?php $i=$k->stockresponseid;?>">
 <!-- <td><?php echo $autonumber;?></td>-->
  <td><?php echo "<b>Stock Name :</b> ".$product_data ->productname; echo Html::input('hidden', 'productid[]', $pid); echo "<br>";
echo "<b>Drug : </b>".$composition ->composition_name;echo "<br>";
  echo Html::input('hidden', 'compositionid[]', $k -> compositionid); 
  
  echo "<b>Brandcode :</b> $k->brandcode"; echo Html::input('hidden', 'brandcode[]', $k->brandcode);echo " &nbsp;  &nbsp;  &nbsp;  &nbsp;     "; 
   echo " <b>Stock code : </b> $k->stock_code"; echo Html::input('hidden', 'stock_code[]', $k->stock_code); echo "<br>";
   echo "<b> Batch No : </b> $k->batchnumber"; echo Html::input('hidden', 'batchnumber[]', $k->batchnumber);echo " &nbsp;  &nbsp;  &nbsp;  &nbsp;     "; 
 echo Html::input('hidden', 'expiredate[]', $k->expiredate); 

									$currentqty=0;
										foreach($saledata as $kk)
										{
										  $saleid=$kk->opsaleid;
											$saledetaildata=Saledetail::find()->where(['opsaleid'=>$saleid])->andwhere(['stockresponseid'=>$k->stockresponseid])->all();
											foreach($saledetaildata as $l)
											{
											$currentqty+=$l->productqty;	
										    }
										}
										$availableqty=($stockreceivedata->total_no_of_quantity)-$currentqty;
										
										$xdata=Saledetail::find()->where(['opsaleid'=>$saleid])->andwhere(['stockresponseid'=>$k->stockresponseid])->one();
										
										$availableqty=$availableqty+$xdata->productqty;
	
echo "<b>Avail.Qty : </b>  $availableqty";?></td>

 <td style="width:100px;">
 <input type="text" name="productqty[]"  readonly="true" dataincrement="<?php echo $i; ?>" class="form-control productqty_ep" id="quantity_ep<?php echo $i;?>"  value="<?php echo ($k->productqty/$unitlist -> no_of_unit);?>" required="true" placeholder="Quantity" 
 />
 
  <input type="hidden"  name="stockid[]"   value="<?php echo $k->stockid;?>"/>
 <input type="hidden"  name="stockresponseid[]"  value="<?php echo $k->stockresponseid;?>" />
  <input type="hidden"  name="availablestockid[]"  dataincrement="<?php echo $i;?>"  id="availablestock<?php echo $i;?>" value="<?php echo $stockreceivedata->total_no_of_quantity;?>" />
 </td>
<td>
 	
 <?php   
	echo  Html::dropDownList('unitid[]', null,$unitlist1,  ['options' => [$unitlist->unitid => ['Selected'=>'selected']],  'id'=>'unitid'.$i,'dataincrement'=>$i,'class'=>'unitid form-control','required'=>'true',
	'prompt'=>'--  Unit--', "disabled"=>"disabled",
	'onchange'=>'$.get( "'.Url::toRoute('transferstock/getunitquantity').'", { id: $(this).val(),dataid:$(this).attr("dataincrement") } )
                                                        .done(function( data ) {
                                                        	 $("#unitquantity'.$i.'").val(data);
															 var rq=$("#quantity_ep'.$i.'").val();
														          var uq= $("#unitquantity'.$i.'").val();
														          var tu=rq*uq;
														          $("#totalunits'.$i.'").val(tu);
															  } );']) ;									
														
														
	?>
 	<input type="hidden" name="unitquantity[]" id="unitquantity<?php echo $i; ?>" dataincrement="<?php echo $i; ?>" value="<?php echo $unitlist -> no_of_unit; ?>"/>
 </td>
  <td>
 <input type="text"  name="totalunits[]"  dataincrement="<?php echo $i; ?>"  value="<?php echo $k->productqty;?>" value="0" class="form-control totalunits" required="true" readonly="true" placeholder="Total Units" id="totalunits<?php echo $i; ?>"  style="text-align:right;"/>
 
 </td>
  <td>
 <input type="text"  name="priceperqty[]" value="<?php echo number_format($k->priceperqty,2);?>" dataincrement="<?php echo $i; ?>" 
 class="form-control itemprice" required="true" readonly="true" placeholder="Price" id="item_price_ep<?php echo $i;?>"  style="text-align:right;"/>
 
  <input type="hidden" min="0" name="realmrp_ep[]"  value="<?php echo $k->mrpperunit;?>" 
 dataincrement="<?php echo $i;?>" required="true" placeholder="Price" class="form-control " id="item_price_realep<?php echo $i;?>"   style="text-align:right;"/>
  
  <input type="hidden" name="saleid"  id="saleid" value="<?php echo $saleid;?>"
 required="true" placeholder="Price" class="form-control "   style="text-align:right;"/>
 
 </td>
 
  <?php if($ptype==2)
 { ?>
 	<td style="width:100px;">
 <input type="text" min="0" name="gst[]" class="form-control gstpercent" readonly="true" dataincrement="<?php echo $i; ?>" placeholder="GST" value="<?php echo $k->gstrate; ?>"  required="true" id="gst_ep<?php echo $i; ?>"   style="text-align:right;"/>
 </td>
 
  <td style="width:100px;">
 <input type="text" min="0" readonly="true" name="gst_value[]"  value="<?php echo $k->gstvalue;?>" class="form-control gstvalue" dataincrement="<?php echo $i; ?>"  required="true" id="gst_value<?php echo $i; ?>"   style="text-align:right;"/>

 
 </td>
<?php }

	else
	{
 ?>
 	
 <input type="hidden"  name="gst[]" class="form-control gstpercent" readonly="true" dataincrement="<?php echo $i; ?>" value="0" placeholder="GST"   required="true" id="gst_ep<?php echo $i; ?>"   style="text-align:right;"/>

 <input type="hidden"  readonly="true" name="gst_value[]" class="form-control gstvalue" value="0" dataincrement="<?php echo $i; ?>"  required="true" id="gst_value<?php echo $i; ?>"   style="text-align:right;"/>

<?php } 
?>
 

 <td><?php 
 	
 	if($k->discount_type!="Empty")
 	{
 		$discounttype="flat";
 	}
	else if($k->discount_type!="flat")
 	{
 		$discounttype="flat";
 	}
	else 
 	{
 		$discounttype="percent";
 	}
 	?>
 Flat <input class="discounttype" disabled="disabled" id="discounttype<?php echo $i;?>" <?php if ($discounttype == 'flat') echo 'checked="checked"'; ?> name="discounttype<?php echo $i;?>" value="flat" type="radio" >
 	<br>% <input class="discounttype" disabled="disabled" id="discounttype<?php echo $i;?>" <?php if ($discounttype == 'percent') echo 'checked="checked"'; ?> name="discounttype<?php echo $i;?>" value="percent"  type="radio">
 		
 		
 	
 </td>
  <td>
 <input type="text" min="0" name="discount[]"  readonly="true" dataincrement="<?php echo $i;?>" value="<?php echo $k->discountrate;?>" placeholder="Discount" class="form-control discountpercent discount_ep" required="true" id="discount_ep<?php echo $i;?>" value="0"  style="text-align:right;"/>
 <input type="hidden" name="dataincrement[]" value="<?php echo $i;?>"/>
 
 </td>
 <td style="width:100px;">
 <input type="text" min="0" readonly="true" name="discount_value[]" class="form-control discountvalue" value="<?php echo $k->discountvalue;?>" dataincrement="<?php echo $i;?>"  required="true" id="discount_value<?php echo $i;?>"   style="text-align:right;"/>
 </td>
  <td style="width:100px;">
 <input type="text" name="price[]"  placeholder="Total Price"  value="<?php echo $k->price;?>" class="form-control price_ep" id="total_price_ep<?php echo $i;?>" required="true" readonly="true"  style="text-align:right;"/> 
 </td>
 <td><!--<button type='button' data-id='productrowdata<?php echo $i;?>' dataincrement="<?php echo $i;?>" class='btn btn-xs btn-icon btn-danger waves-effect waves-light deleteproduct_ep' >
 <i class="fa fa-remove"></i></button>-->
</td>
 </tr>

    <?php 
    $increment++;?>
   
	<?php
	
	
	
    
	}   ?>
             
	</tbody>
<tr id="totalprice_ep_row" > <td colspan="4"></td>
	
	<?php if($ptype==2)
			 { ?><td colspan="2" align="right">Total Gst</td> <?php } ?>
	 <td><?php if($ptype==2)
			 { ?><span id="totalgstep">Rs.<?php echo $saledata1->totalgstvalue;?></span> <?php } ?></td>
	
<td colspan="3" align="center"><span id="totaldiscountep"> Total Discount Rs.<?php echo $saledata1->totaldiscountvalue;?></span></td>
<td colspan="2" align="left"><span id="total_ep"> Total Price Rs.<?php echo $saledata1->total;?></span><input type="hidden" id="totalprice_ep" name="totalprice" value="<?php echo $saledata1->total;?>" /></td>
</tr>
<?php if($ptype==2)
{ ?>
	

<tr id="totalprice_ep_cgst" > <td colspan="6" align="right">Total Cgst</td>
	<td colspan='6'><span id="totalcgstep"> Rs.<?php echo $saledata1->totalcgstvalue;?></span></td> </tr>

<tr id="totalprice_ep_sgst"> <td colspan="6" align="right">Total Sgst</td>
	<td colspan="6"><span id="totalsgstep">Rs.<?php echo $saledata1->totalsgstvalue;?></span></td></tr>
<?php } 
if($saledata1->overalldiscounttype=="flat")
{
	$fchecked=1;

}
else
{
	$fchecked=0;
	
}

?>

    <tr id="totalprice_ep_label"><td colspan="6" align="right"><b>Overall Discount Type</b></td>
	
	
	<td><b>Disc % or Amt</b></td>
    <td><b>Overall  Disc</b></td>
    <td colspan="2"><b>Overall Total</b></td><?php if($ptype==2)
			 { ?><td colspan="2"></td> <?php } ?></tr>
    
    
<tr id="ovaralltotalprice_ep" > <td colspan="6" align="right">
Flat <input class="overalldiscounttype_ep" id="overalldiscounttype_ep" name="overalldiscounttypeep" value="flat" type="radio" readonly="true"
<?php echo ($fchecked==1) ?  "checked" : "" ;  ?>>
 Percentage <input class="overalldiscounttype_ep" id="overalldiscounttype_ep" name="overalldiscounttypeep" value="percent"  type="radio" 
 <?php echo ($fchecked==0) ?  "checked" : "" ;  ?>></td>
  <td>
 <input type="text" name="overalldiscountep" placeholder="Discount" readonly="true" class="form-control overalldiscountpercentep" required="true"   id="overalldiscountpercentep"  
 value="<?php echo $saledata1->overalldiscountpercent;?>" />
 </td>
 <td>
 <input type="text"  readonly="true" name="overalldiscountamountep" value="<?php echo $saledata1->overalldiscountamount;?>" class="form-control overalldiscountamountep"   required="true" id="overalldiscountamountep"/>
 </td>
 <td colspan="2">
 <input type="text" name="overalltotalep"  readonly="true" required="true"   value="<?php echo $saledata1->overalltotal;?>" class="form-control overalltotalep" id="overalltotalep" required="true" readonly="true" /> 
</td><?php if($ptype==2)
			 { ?><td colspan="2"></td> <?php } ?></tr>
<tr id="btn_ep" ><td colspan="8" align="right">
	 <span id="loadtex1" style="display: none; "></span>
	 <?= Html::Button($pmodel->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Update' : '<i class="fa fa-fw fa-save "></i>Update', ['class' => $pmodel->isNewRecord ? 'btn btn-sm btn-success savevalue_ep' : 'btn btn-primary ']) ?>
	
    
</td> <td colspan="2"><a target="_blank" class="btn btn-default" href="<?php echo Yii::$app->homeUrl."?r=sales/invoice&id=". $salesinputid;?>">Invoice</a>
    
	</td><?php if($ptype==2)
			 { ?><td colspan="2"></td> <?php } ?></tr>

 </table>
 </div>
</div>
</div>
</div>
	<?php	ActiveForm::end();?>
</div>
</div>
</div>
</div>
<script>
 $(document).ready(function()
 {
$('#datatable-fixed-col4').DataTable
({
            scrollY: "200px",
            scrollX: false,
            scrollCollapse: true,
            paging: false,
             "language": {
                searchPlaceholder: "Search Stock From Products",
                search: "",

            },
            
             columns: [
    { "orderable": false },
    { "orderable": false },
   { "orderable": false },
    { "orderable": false }, { "orderable": false }, { "orderable": false },
  
    { "orderable": false },
     { "orderable": false },
    null,null
  ],
            
            "dom": '<"top"f>rt<"bottom"ilp><"clear">'
        });
 
  

	  
	   $('body').on("click",'.savevalue_ep',function(){
 var form = $("#wizard-validation-form1");
 var formData = form.serialize();
 $form_container=$("#wizard-validation-form1");
   	 $form_container.validate().settings.ignore = ":disabled,:hidden";
   var chkform=$form_container.valid();
   
   var saleid = "<?php echo $salesinputid;?>";
  
 
   if(chkform==true){
$.ajax({
        url:'<?php echo Yii::$app->homeUrl ?>?r=saledetail/savesales&saleid='+saleid,
        type: 'post',
       data: formData,
        success: function (data) {
        	$("#load").show();
        if(data=="Y")
	    {
	    	$("#load").hide();
		$("#loadtex1").text("Successfully Saved.");
		$("#loadtex1").css('color','green ');
	    $("#loadtex1").show(4);
		}
        }
     });
    }

	});
	  
	  
	  
	$('body').on("click",'.choose_ep',function()
	{
    var y = $('#productgrid_ep >tbody >tr').length;
	var dataid=$(this).attr('data-id');
	var price = $('.price').val();
	var branch = $('.branchid').val();
	var ptype = $('#patienttype').val();
	$("#load").fadeIn("slow");
	var inc = $(this).attr('dataincrement');
	$("#buttonsubmit"+ inc).prop('disabled', true);
	$.ajax(
		{
        url:'<?php echo Yii::$app->homeUrl ?>?r=saledetail/productdetail_ep&id='+dataid+"&branch_id="+branch+"&ptype="+ptype+"&autonumber="+inc,
        type: "post",
        success: function (data)
         {
      $('#ep_theaddata').show();
        var r = $("#formdetails_ep").append(data);
         $('#totalprice_ep_row').show();
         $('#totalprice_ep_cgst').show();
         $('#totalprice_ep_sgst').show();
         $('#totalprice_ep_label').show();
         $('#ovaralltotalprice_ep').show();
         $('#btn_ep').show();
         $("#load").fadeOut("slow");
       if(data=="Y"){
		        	 $("#load").fadeOut("slow");	
		        	}
        $("#load").fadeOut("slow");
        $("#gen").attr('disabled',true).selectpicker('refresh');
        $("#vendor_idz").selectpicker('refresh');
        $("#product_idz").selectpicker('refresh');
        $("#formdetails").fadeIn("slow");
        }
     }
     );
	})
	})
</script>
<script>
	$(document).ready(function() {
			$(function() {
			$('body').on("blur input change", '.productqty_ep,.itemprice,.gstpercent,.discountpercent,.overalldiscountpercentep', function(e) 
			{
				var inc = $(this).attr('dataincrement');
				var unitquantity = $("#unitquantity" + inc).val();
				var quan = $("#quantity_ep" + inc).val();
				var customprice = $("#item_price_realep" + inc).val();
				var gstpercent = $("#gst_ep" + inc).val();
				mrpprice=(customprice/(1+(0.01*gstpercent))).toFixed(3);				
				$("#item_price_ep" + inc).val(mrpprice);
				var price = mrpprice;
				var totalunit = (quan * unitquantity);
				$("#totalunits" + inc).val(totalunit);
			      total = totalunit * price;
				$("#taxableamountep" + inc).val(total);
				var discount = $("#discount_ep" + inc).val();
				if (gstpercent == "") {
					gstvalue = 0;
				} else {
					gstvalue = ((total * gstpercent) / 100).toFixed(2);
					$("#gst_value" + inc).val(gstvalue);
				}
				var discounttype = $("#wizard-validation-form1 input[name='discounttype" + inc + "']:checked").val();
				if (discounttype == "percent") {
					var discountrate = discount / 100;
					discountvalue = (total * discountrate).toFixed(2);
				} else {
					discountvalue = discount;
				}
				var newtotal = total + parseFloat(gstvalue) - (discountvalue);
				rowtotal = newtotal.toFixed(2);
				$("#total_price_ep" + inc).val(rowtotal);
				$("#discount_value" + inc).val(discountvalue);
				var e = 0;
				$('.price_ep').each(function() {
					e += parseFloat(this.value) || 0;
				});
				$("#total_ep").text("Total Price :Rs." + e.toFixed(2));
				var totalstock=$("#availablestock" + inc).val();
          if(totalunit>totalstock)
          {
          	   swal({
                title: "Are you sure?",
                text: "Check Your Units is greater than Available Stock",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: "Yes",
                closeOnConfirm: false
            });
          }
				var totaldiscount = 0;
				$('.discountvalue').each(function() {
					totaldiscount += parseFloat(this.value) || 0;
				});
				$("#totaldiscountep").text("Total Discount: Rs." + totaldiscount.toFixed(2));
				var totalgst = 0;
				$('.gstvalue').each(function() {
					totalgst += parseFloat(this.value) || 0;
				});
				$("#totalgstep").text("Total Gst :Rs." + totalgst.toFixed(2));
				var totalcgstep = totalgst / 2;
				$("#totalcgstep").text("Total CGst :Rs." + totalcgstep.toFixed(2));
				$("#totalsgstep").text("Total SGst :Rs." + totalcgstep.toFixed(2));
				var totalprice1=e.toFixed(2);
				$("#totalprice_ep").val(totalprice1);
				var overalldiscount = $("#overalldiscountpercentep").val();
				var overalldiscounttype = $("#wizard-validation-form1 input[name='overalldiscounttypeep']:checked").val();
				if (overalldiscounttype == "percent") 
				{
					var overalldiscountrate = overalldiscount / 100;
					overalldiscountvalue = (totalprice1 * overalldiscountrate).toFixed(2);
				} 
				else 
				{
				overalldiscountvalue = overalldiscount;
				}
				var overalltotal = (totalprice1-(overalldiscountvalue)).toFixed(2);
				$("#overalldiscountamountep").val(overalldiscountvalue);
				$("#overalltotalep").val(overalltotal);
			});
		});
		
		
		$(".deleteproduct_ep").click(function() {
			var inc = $(this).attr('dataincrement');
            $("#buttonsubmit"+ inc).prop('disabled', false);
            	$(this).parent().parent().remove();
			var patienttype = "<?php echo $ptype;?>";
			if(patienttype==1)
			{
				var rowCount = $('#productgrid_ep tr').length;
			if (rowCount ==5) {
				$('#ep_theaddata').hide();
				$('#totalprice_ep_row').hide();
				$('#totalprice_ep_cgst').hide();
				$('#totalprice_ep_sgst').hide();
				$('#btn_ep').hide();
				$('#totalprice_ep_label').hide();
                $("#ovaralltotalprice_ep").hide();
			}
			}
				else
			{
				var rowCount = $('#productgrid_ep tr').length ;
			if (rowCount==5) {
				$('#ep_theaddata').hide();
				$('#totalprice_ep_row').hide();
				$('#totalprice_ep_cgst').hide();
				$('#totalprice_ep_sgst').hide();
				$('#totalprice_ep_label').hide();
                $("#ovaralltotalprice_ep").hide();
				$('#btn_ep').hide();
			}
			}
			
		
			var e = 0;
			$('.price_ep').each(function() {
				e += parseFloat(this.value) || 0;
			});
			 var totalprice1=e.toFixed(2);
			$("#total_ep").text("Rs." +totalprice1);
			$("#totalprice_ep").val(totalprice1);
			var overalldiscount = $("#overalldiscountpercentep").val();
			var overalldiscounttype = $("#wizard-validation-form1 input[name='overalldiscounttypeep']:checked").val();
			if (overalldiscounttype == "percent") 
				{
			var overalldiscountrate = overalldiscount / 100;
			overalldiscountvalue = (totalprice1 * overalldiscountrate).toFixed(2);
				} 
				else 
				{
			overalldiscountvalue = overalldiscount;
				}
			var overalltotal = (totalprice1-(overalldiscountvalue)).toFixed(2);
			$("#overalldiscountamountep").val(overalldiscountvalue);
			$("#overalltotalep").val(overalltotal);
		});
	}); 
</script>
