<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\CompanyBranch;
use backend\models\Vendor;
use backend\models\Product;
use backend\models\Productgrouping;
use backend\models\Unit;
use backend\models\Composition;
use yii\helpers\Url;

use backend\models\Stockresponse;
use yii\helpers\ArrayHelper;
use backend\models\VendorBranch;

?>

	
<?php $form = ActiveForm::begin(['action' => ['savestock'], 'id' => 'stock-form1']);

 

$i = 1;
$company_data = CompanyBranch::find() -> where(['branch_id' => $branch]) -> one();



$branchname = $company_data -> branch_name;
$vendordata = Vendor::find() -> where(['vendorid' => $vendorid]) -> one();



$vendorname = $vendordata -> vendorname;
$modelreceive=new Stockresponse();



$unitlist=ArrayHelper::map(Unit::find()->asArray()->all(), 'unitid', 'unitvalue');


$vendorbranchlist=VendorBranch::find()->where(['vendorid'=>$vendorid])->all();
	
			if(count($vendorbranchlist)>0){
				
				
			foreach ($vendorbranchlist as  $value1) {
				$vendorbranchids[]=$value1->vendor_branchid;
				
			}
			}
if(count($vendorbranchids)>0)
{
	$vendorbranchlistnew=ArrayHelper::map(VendorBranch::find()->where(['is_active'=>1])->andwhere(['IN', 'vendor_branchid', $vendorbranchids])->asArray()->all(),
 'vendor_branchid', 'branchname');
}

 
//print_r($vendorbranchlistnew);die;		
?>

	<?php echo '<table id="datatable-fix-col" class="table table-bordered table-striped">
 <tr><td><b>Company Branch </td><td> ' . $branchname . '</b></td><td>
<b>Vendor </td><td> ' . $vendorname . '</b></td></tr>
</table>';
$tab_index=1001;
	foreach ($products as $key => $value) {
		
		if(($i%2)==0)
		{
			$class="success";
		}
		else{
			$class="info";
		}
		$productdata = Product::find() -> where(['productid' => $value]) -> one();
		$compositionid = $productdata -> composition_id;
		$unitid = $productdata -> unit;
		$compositiondata = Composition::find() -> where(['composition_id' => $compositionid]) -> one();
		
		
		$rows = Productgrouping::find() -> where(['vendorid' => $vendorid]) -> andwhere(['productid' => $value]) -> andwhere(['is_active' => 1]) -> one();
		echo $form -> field($model, 'productid[]') -> hiddenInput(['value' => $value]) -> label(false);
		echo $form -> field($model, 'branch_id') -> hiddenInput(['value' => $branch]) -> label(false);
			echo $form -> field($model, 'vendorid') -> hiddenInput(['value' => $vendorid]) -> label(false);
		echo $form -> field($model, 'vendorid') -> hiddenInput(['value' => $vendorid]) -> label(false);
		
		
		
		
		
		
		
		
		
		
	
		echo $form -> field($model, 'productgroupid[]') -> hiddenInput(['id' => 'productgroupid' . $i, 'name' => 'productgroupid' . $i, 'value' => $rows -> productgroupid]) -> label(false);
		echo $form -> field($model, 'brandcode[]') -> hiddenInput(['id' => 'brandcode' . $i, 'name' => 'brandcode' . $i, 'value' => $rows -> brandcode]) -> label(false);
		echo $form -> field($model, 'stockcode[]') -> hiddenInput(['id' => 'stockcode' . $i, 'name' => 'stockcode' . $i, 'value' => $rows -> stock_code]) -> label(false); 
		echo $form -> field($model, 'compositionid[]') -> hiddenInput(['id' => 'compositionid'.$i, 'name' => 'compositionid' . $i, 'value' => $compositionid]) -> label(false);
	
		echo $form -> field($model, 'unitquantity[]') -> hiddenInput(['id' => 'unitquantity'.$i, 'name'=>'unitquantity'.$i,'value'=>$unitqty]) -> label(false);
		
		echo '<div class="panel panel-border panel-'.$class.'">
									<div class="panel-heading">
										<h3 class="panel-title">Add Stock- '.$i.'</h3>
									</div>
									<div class="panel-body">';
									
									
											echo "<table class='table table-bordered ".$class."'><tr><td><b>Stock Name</b>: ".$productdata -> productname .
											"</td><td><b>&nbsp;&nbsp;&nbsp;Brandcode </b>: ".$rows -> brandcode ."</td>
                      <td><b>Drug </b> :" . $compositiondata -> composition_name . "</td>
              <td><b>Stock Code </b>:" . $rows -> stock_code . "</td></tr>";
			  
			  
			  
		echo " <tr>";
		if(count($vendorbranchlistnew)>0)
		{
			echo   '<td><b>Vendor Branch:</b>'
          .$form->field($model, 'vendor_branchid[]')->dropdownlist($vendorbranchlistnew,['prompt'=>'--Vendor Branch--','required'=>'true',
          'id'=>'vendor_branchid'.$i,'dataincrement'=>$i,'class'=>'vendor_branchid form-control tabind','tabindex'=>$tab_index++,
          'onchange'=>' $.get( "'.Url::toRoute('getigstcalculation').'", { id: $(this).val(),dataid:$(this).attr("dataincrement") } )
                                                        .done(function(data)
														 {	
														    var json = JSON.parse(data);
															var data2=json.dataid;
                                                            var data1=json.igstpercent;
														     $("#igstpercent"+data2).val(data1);
                                                        }
                                                    );'])->label(false);
		}
		
		   
           
		echo "<td><b>Quantity :</b> " . $form -> field($model, 'quantity[]') -> textInput(['id' => 'receivedquantity' . $i, 'name' => 'quantity' . $i, 'placeholder' => 'Qty', 'required' => true, 'class' => 'form-control receivedqty tabind', 
		'dataincrement' => $i,'value'=>0,'tabindex'=>$tab_index++]) -> label(false) . "</td>";
		
		
			  echo "<td>";
					    echo $form->field($modelreceive, 'unitid[]')->dropdownlist($unitlist,['prompt'=>'--Unit--','required'=>'true',
          'id'=>'unitid'.$i,'dataincrement'=>$i,'class'=>'unitid form-control tabind','tabindex'=>$tab_index++,
            'onchange'=>' $.get( "'.Url::toRoute('getunitquantity').'", { id: $(this).val(),dataid:$(this).attr("dataincrement") } )
                                                        .done(function(data)
														 {
														     var json = JSON.parse(data);
															var data2=json.dataid;
                                                            var data1=json.noofunit;
															var rq=$("#receivedquantity"+data2).val();
															var tu=parseFloat(rq)*data1;
															$("#totalunits"+data2).val(tu); 
															 $("#unitquantity"+data2).val(data1);
                                                        }
                                                    );'
          
          
          
          ])->label("Choose Unit"); 
		echo "</td>";
		
		   echo '<td><b>Total Units :</b>' . $form -> field($model, 'total_no_of_quantity[]') -> textInput(['class' => 'totalunits form-control tabind', 'name' => 'totalunits' . $i, 'id' => 'totalunits' . $i, 'readonly' => 'true','value'=>0,'tabindex'=>$tab_index++]) -> label(false) . '</td>';
          echo "<tr><td> <b>Batch Number </b> :" .$form -> field($model, 'batchnumber[]') -> textInput(['id' => 'batchnumber' . $i, 
		'name' => 'batchnumber' . $i, 
		 'class' => 'form-control batchno tabind', 
		 'required' => true,'tabindex'=>$tab_index++]) ->label(false) ;
		echo  "</td>";
		

		echo '  <td><b>Manufacture Date </b> :' . $form -> field($model, 'manufacturedate[]') -> textInput(['id' => 'manufacturedate' . $i, 
		'name' => 'manufacturedate' . $i, 'class' => 'form-control datepicker3 tabind', 
		 'bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true", 
		 'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'tabindex'=>$tab_index++]) -> label(false) . '</td>';

		echo '  <td><b>Expire Date :</b> ' . $form -> field($model, 'expiredate[]') -> textInput(['id' => 'expiredate' . $i, 
		'name' => 'expiredate' . $i, 
		'class' => 'form-control datepicker3 tabind', 
		'bootstrap-datepicker data-date-autoclose' => "true", 
		'data-required' => "true", 
		'data-provide' => "datepicker", 
		'data-date-format' => "dd-mm-yyyy",
		 'required' => true,'tabindex'=>$tab_index++]) -> label(false) . '</td>';
		 echo "<td>";
		 
	 echo $form->field($modelreceive, 'purchasedate[]')->textInput(['id'=>'purchasedate'.$i,'class' => 'form-control datepicker3 tabind', 'placeholder' => 'DD-MM-YYYY', 'bootstrap-datepicker data-date-autoclose' => "true", 'data-required' => "true",
     'data-provide' => "datepicker", 'data-date-format' => "dd-mm-yyyy",'required'=>true,'value'=>date("d-m-Y"),'tabindex'=>$tab_index++])->label("Purchase Date");
     echo "</td>"; 
		
   echo "</tr>";
   
   
echo "<tr><td>";

	 echo $form->field($modelreceive, 'purchaseprice[]')->textInput(['id'=>'purchaseprice'.$i,
		   	'dataincrement'=>$i,
		    'placeholder'=>'Price',
		      'value'=>0,
		     'class'=>"form-control purchaseprice tabind",
		     'required'=>true,'tabindex'=>$tab_index++])->label("Purchase Price");
		     echo "</td><td>";
													
echo $form->field($modelreceive, 'priceperquantity[]')->textInput(['id'=>'priceperquantity'.$i,
		   		    'dataincrement'=>$i,
		    'placeholder'=>'priceperquantity',
		      'value'=>0,
		     'class'=>"form-control priceperquantity tabind",
		     'required'=>true,'tabindex'=>$tab_index++])->label("Price Per Quantity");
		   echo "</td><td>";
		   
		   
			  echo $form->field($modelreceive, 'mrp[]')->textInput(['id'=>'mrp'.$i,'class'=>"form-control mrpval tabind", 'dataincrement'=>$i,'placeholder'=>'MRP Value',
			'value'=>0, 'required'=>true,'tabindex'=>$tab_index++])->label("MRP");
												 
	  echo "</td><td>";
	echo $form->field($modelreceive, 'mrpperunit[]')->textInput(['id'=>'mrpperunit'.$i,  'dataincrement'=>$i,'value'=>0,
			'placeholder'=>'MRP/Unit', 'class'=>"form-control mrpperunit tabind",'required'=>true,'tabindex'=>$tab_index++])->label("MRP PER UNIT");
	  echo "</td></tr>";
 
 echo "<tr><td>";
 
 echo $form->field($modelreceive, 'gstpercent[]')->textInput(['id'=>'gstpercent'.$i, 'placeholder'=>'GST (%)',
		  'dataincrement'=>$i,  'class'=>"form-control gstpercent tabind",  'value'=>$productdata->gst,'required'=>true,'tabindex'=>$tab_index++])->label("Gst %");
	 echo "</td><td>";	  
	 
 echo $form->field($modelreceive, 'gstvalue[]')->textInput([
   'id'=>'gstvalue'.$i, 'dataincrement'=>$i,  'value'=>0, 'placeholder'=>'GST Value',  'class'=>"form-control tabind", 'readonly'=>'true','required'=>true,'tabindex'=>$tab_index++])->label("Gst Value");
   
    echo "</td><td>";	  

   echo $form->field($modelreceive, 'cgstpercent[]')->textInput(['id'=>'cgstpercent'.$i,
			  'dataincrement'=>$i,
			   'value'=>0,'placeholder'=>'CGST (%)', 'readonly'=>true,
			   'class'=>"form-control cgstpercent tabind",'required'=>true,'tabindex'=>$tab_index++])->label("Cgst %");
			     echo "</td><td>";	
											 echo $form->field($modelreceive, 'cgstvalue[]')->textInput([
               'id'=>'cgstvalue'.$i,
               'dataincrement'=>$i,
               'placeholder'=>'CGST Value',
               'class'=>"form-control cgstvalue tabind",
               'readonly'=>'true',  'value'=>0,
               'required'=>true,'tabindex'=>$tab_index++])->label("Cgst Value");
               
                 echo "</td></tr>";	
               echo "<tr><td>";	    
                 
           echo $form->field($modelreceive, 'sgstpercent[]')->textInput(['id'=>'sgstpercent'.$i,
			  'dataincrement'=>$i,
			   'placeholder'=>'SGST (%)','readonly'=>true,
			    'value'=>0,
			   'class'=>"form-control sgstpercent tabind",
			   'required'=>true,'tabindex'=>$tab_index++])->label("Sgst %");
			   echo "</td><td>";	
			  
			  echo $form->field($modelreceive, 'sgstvalue[]')->textInput([
              'id'=>'sgstvalue'.$i,'dataincrement'=>$i,  'value'=>0, 'placeholder'=>'SGST Value','readonly'=>'true',
               'class'=>"form-control sgstvalue tabind",'required'=>true,'tabindex'=>$tab_index++])->label("Sgst Value");
									   
				 echo "</td><td>";									  
												  
						echo $form->field($modelreceive, 'igstpercent[]')->textInput([
			   'id'=>'igstpercent'.$i, 'dataincrement'=>$i, 'value'=>0, 'placeholder'=>'IGST (%)', 
			   'class'=>"form-control igstpercent tabind",'required'=>true,'tabindex'=>$tab_index++])->label("Igst %");
			   echo "</td><td>";	
			   
			   
			   
	echo $form->field($modelreceive, 'igstvalue[]')->textInput([
              'id'=>'igstvalue'.$i, 'dataincrement'=>$i,'placeholder'=>'IGST Value',
               'class'=>"form-control tabind",'value'=>0, 'readonly'=>'true',
               'required'=>true,'tabindex'=>$tab_index++])->label("Igst Value");
		
		
		
		  echo "</td><tr><td>";
   echo	$form->field($modelreceive, 'discountpercent[]')->textInput(['id'=>'discountpercent'.$i,
             'dataincrement'=>$i,
             'placeholder'=>'Discount (%)', 
             'class'=>"form-control discountpercent tabind",
              'value'=>0,
             'required'=>true,'tabindex'=>$tab_index++])->label("Discount %"); 
             
             echo "</td><td>";	
		echo $form->field($modelreceive, 'discountvalue[]')->textInput([
              'id'=>'discountvalue'.$i,
             'value'=>$discountvalue,
              'placeholder'=>'Discount Value',
               'class'=>"form-control tabind",  'value'=>0,
               'required'=>true,'tabindex'=>$tab_index++])->label("Discount Value");
		  
		  
		  
		  
		echo "</td><td></td><td></td></tr>";
		
		
		
		
		
		
		
		$i++;
										
									echo '</table></div>
								</div><div class="clearfix"></div>';
		
		


	} ?>

	<?php echo "<table><tr>";
	echo Html::Button('Save Direct Stock', ['class' => 'btn btn-default waves-effect waves-light save_stock']);
	echo "</td></tr> </table>";
	ActiveForm::end();
	?>

<script type="text/javascript">

		$('#stock-form1').on('keydown', '.tabind', function (event) {
   	
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




	   $(document).on('change keyup click', '.receivedqty,.batchno,.unitid,.discountpercent,.gstpercent,.igstpercent', function ()
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
          var v4=parseFloat(v1)*v3;
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
         
          if(v24==0)
          {
          	 var mrpperunit=0;
          }
          else
          { var mrpperunit=(v24/v11).toFixed(2);
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
  
           $(document).on('change keyup click', '.mrpval', function ()
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
         
           var v21=$("#mrp" + inc).val();
        
          if(v21!="")
          {
          var v12=(v21/v11).toFixed(2);
          	 $("#mrpperunit" + inc).val(v12);
          }
  });
  
  
  
  
  
  
  
  
  
</script>