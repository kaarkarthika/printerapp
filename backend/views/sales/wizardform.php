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
use backend\models\Sales;
use backend\models\Saledetail;
use backend\models\Patient;
$datatables = $dataProvider->getModels();
?>
<style>
	
	.dataTables_wrapper .dataTables_length {
float: left;
}
div.dataTables_wrapper div.dataTables_filter{float:left !important;text-align: left;
width:600px  !important;}
</style>

<?php $form = ActiveForm::begin(['id' => 'wizard-validation-form1']);?>
<div class="col-sm-12">
<div class="panel panel-border panel-inverse">
<div class="panel-heading">
 </div>
 <div class="panel-body">
		
		<?php if($pid!="")
			{
				$model = Patient::find() -> where(['patient_id' => $pid]) -> one();
				echo '<div class="row"><h4>Patient Exists.Update Patient Below and make Sale.</h4></div>';
			} 

			else
				{
					$model=new Patient();
					echo '<div class="row"><h4>No Patient Found.Add New Patient Below and make Sale.</h4></div>';
				}
				
				
				
				?>
				<div class="clearfix" style="margin-top:30px;"></div>
				 <div class="col-md-3">
 
		<?= $form -> field($model, 'medicalrecord_number') -> textInput(['maxlength' => true, 'class' => 'required form-control', 'id' => 'mr','readonly'=>$readonly,
		]);?>
	
 </div>
		 <div class="col-md-3">	
 
		<?= $form -> field($model, 'firstname') -> textInput(['maxlength' => true, 'class' => 'required form-control', 'id' => 'firstname', 'readonly'=>$readonly,
		]);?>
		
 </div>
 	 <div class="col-md-3">	
 
		<?= $form -> field($model, 'lastname') -> textInput(['maxlength' => true, 'class' => 'required form-control', 'id' => 'lastname',  'readonly'=>$readonly,
		]);?>
		
 </div>
 					 <div class="col-md-3">	
<?php echo $form -> field($model, 'emailid') -> textinput(['id' => 'emailid' ]) ;
		?>
 </div>
 <div class="clearfix"></div>

 
   <div class="col-md-3">
    	<?= $form->field($model, 'patient_mobilenumber',['enableAjaxValidation' => true])->textInput(['maxlength' => 10,'required'=>'true', 'id'=>'phonenumber','onkeypress'=>'return isNumber(event)', 

])->label("Patient PhoneNo"); ?>
    		
    </div>
  <div class="col-md-3">       	  
  <?php   //echo $form->field($model, 'gender')->radioList(  ['M' => 'Male', "F" => 'Female','T'=>'Transgender']);
  
  echo $form->field($model, 'gender')->dropDownList(
							 ['M' => 'Male', "F" => 'Female','T'=>'Transgender'],
								['prompt'=>'--Gender--','id'=>'pgender']);
  
  
   ?>
    </div> 
 <div class="col-md-3">
 <?= $form->field($model, 'physicianname')->dropdownlist($physicianlist,['prompt'=>'--Physician--','required'=>'true','id'=>'physicianname'])->label("Physician Name *") ?>
</div>
<div class="col-md-3">
<?php if(!$model->isNewRecord)
    	{$dob= $model->dob;
    		$model->dob=date("d/m/Y",strtotime($dob));}
    		?>
    		 <?= $form->field($model, 'dob')->textInput(['maxlength' => true,'required'=>'true','data-provide' => "datepicker", 
           'id'=>'dateofbirth1', 'onchange'=>'
                                                    $.get( "'.Url::toRoute('getage').'", { dob: $(this).val() } )
                                                        .done(function( data ) 
                                                        {
                                                           $("#age1").val(data);
														   $("#age1").load();                              
                                                        }
                                                    );'])->label("DOB *"); 
                                                    
             ?>        
     
 </div>
 <div class="clearfix"></div>
 <div class="col-md-3">
       <?php echo $form->field($model, 'insurance_type')->dropdownlist($insurancelist,['id'=>'insurancetype1',
       'class'=>'insurancetype form-control',
      'required'=>'true','value'=>''])->label("Insurance Type *");?>
      </div>
      
         <div class="col-md-3" id="refer" style="display:none;">
      	 <?=$form->field($model, 'reference_number')->textInput(['maxlength' => true,'id'=>'refnumber'])->label("Reference Number"); ?>
      	
      </div>
  <div class="col-md-3">
      	 <?= $form->field($model, 'guardian_name')->textInput(['maxlength' => true,'id'=>'guardian_name'])->label("Guardian Name"); ?>
      	
      </div>
          <div class="col-md-3">
    <?= $form->field($model, 'guardian_mobilenumber')->textInput(['maxlength' => 10, 'onkeypress'=>'return isNumber(event)','id'=>'gua_phonenumber'])->label("Guardian Mobile Number"); ?>
  </div>

       <div class="col-md-3">
   	 <?= $form->field($model, 'address')->textarea(['rows' => 1,'placeholder' =>'Address','id'=>'address']); ?>
   </div> 
       <div class="col-md-3">
   	 <?= $form->field($model, 'notes')->textarea(['rows' => 1,'placeholder' =>'Short Notes','id'=>'shortnotes']); ?>
   </div> 
   <div class="col-md-3">
   	 <?php echo $form->field($model, 'age')->textInput(['maxlength' => true,'readonly'=>'true','placeholder'=>'Age','readonly'=>'true','id'=>'age1'])->label("Age"); ?>
	<input type="hidden" name="patienttype" id="patienttype" value="<?php echo $patienttype;?>" />
   </div>
	</div>
	</div>
	</div>	
		 
	<div class="col-sm-12">
<div class="panel panel-border panel-inverse"  id="addsalepanel">
<div class="panel-heading">
	<h3>Search Stock from Your Branch</h3>
 </div>
 <div class="panel-body">
  <table id="datatable-fixed-col4" class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>  <th>Add</th>
                                      <th >Stock&Type</th>
                                      <th>Batch No</th>
                                      <th>Available Stock</th>
                                      <th>Stock<br>
                                      	Code</th>
                                      <th>Composition</th>
                                      <th>Brand</th>
                                      <th>Unit</th>
                                      <th>Expire Date</th>
                                      <th>MRP/Unit</th>
                                </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                	if(count($datatables)>0){
                                		$i=1;
										
											 $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
	
						
										
										$saledata=Sales::find()->where(['paid_status'=>'UnPaid'])->andwhere(['branch_id'=>$companybranchid])->all();
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
									    $producttypeid[]=$value->stockbrandcode->product->product_typeid;
										$newproducttypedata=array_intersect_key($producttypelist, array_flip($producttypeid));
									    $producttypeval=array_values($newproducttypedata);
										//composition
										
										$compositionid[]=$value->stockbrandcode->compositionid;
										$newcompositiondata=array_intersect_key($compositionlist, array_flip($compositionid));
									    $compositionval=array_values($newcompositiondata);
										
										//unit
										$unitid[]=$value->stockbrandcode->unitid;
										$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
									    $unitval=array_values($newunitdata);
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
										if($availableqty>0)
										{
										     echo "<tr>";
											
									  echo"<td><button type='button' id='buttonsubmit".$i."' dataincrement='".$i."' class='btn-xs btn-sm btn-icon btn-default waves-effect waves-light choose_ep' 
									  data-id='".$value->stockresponseid."'>
								  <i class='fa fa-plus'></i>
								 </button></td>";		
                               echo "<td>".$value->stockbrandcode->product->productname."-".$producttypeval[0]."</td> <td>".$value->batchnumber."</td><td>".$availableqty."</td>
                                <td>".$value->stockbrandcode->stockcode."</td> <td>".$compositionval[0]."</td>
                                  <td>".$value->stockbrandcode->brandcode."</td>";
								 echo "<td>".$unitval[0]."</td>";
								 	echo "<td>".date("d/m/y",strtotime($value->expiredate))."</td>";
								   echo "<td>".number_format($value->mrpperunit,2)."</td>";
								   
							 echo "<input type='hidden' name='branch_id' class='branchid' value='".$value->branch_id."'/>";
								    $newbranchdata=array(); $branchid=array(); $branchval="";
								    $newvendordata=array();  $vendorid=array();  $vendorval="";
									$newproductdata=array(); $productid=array();$productval="";
									$newproducttypedata=array(); $producttypeid=array();$producttypeval="";
									$newcompositiondata=array(); $compositionid=array();$compositionval="";
									$newunitdata=array(); $unitid=array();$stockcodeval="";
                                    
                                 echo"</tr>";	
										}
										
                            
								 $i++;
                               } 

	} ?>
                                
                                </tbody>
                            </table>
               </div></div>
                      
  
  <div class="panel panel-border panel-inverse" style="white-space: nowrap;
  overflow-x: visible;
  overflow-y: hidden;

  width:auto; " >
<div class="panel-heading">
 </div>
 <div class="panel-body">                  			
                             <table id="productgrid_ep" class="table table-striped table-hover table-bordered">
             <thead id="ep_theaddata" style="display:none;">
             <th>Stock /
           Drug</th>
             <th>Brand/<br>Stock<br>Code</th>
              <th>Batch/<br>Avail<br>Stock</th>
             <th>Quantity</th>
              <th>UnitForm</th>
              <th>TotalUnits</th>
             <th>Price/Qty</th>
			<th id="gstperep">GST (%)</th>
              <th id="gstvalep">GSTValue</th>
               <th> Disc<br>Type</th>
              <th> Disc</th>
                <th>Disc. <br>Value</th>
             <th>Total<br>Price</th>
              <th></th>
             </thead>  
             
             
             
<tbody id="formdetails_ep">
</tbody>
<tr id="totalprice_ep_row" style="display:none;">
	<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td id="totalprice_ep_gstlabel">Tot.Gst</td>
	<td style="text-align:right;" id="td1"><span id="totalgstep">Rs.0</span></td>
	<td id="td2"></td><td id="td3">Total</td>
<td style="text-align:right;"><span id="totaldiscountep">Rs.0</span></td>
<td style="text-align:right;"><span id="total_ep">Rs.0</span>
<input type="hidden" id="totalprice_ep" name="totalprice" /></td><td></td>
</tr>

    
     <tr id="totalprice_ep_label" style="display:none;"><td></td><td></td><td></td><td></td><td></td><td></td>
     	<td></td><td id="totalprice_ep_cgstlabel">Tot.Cgst </td>
	<td id="totalcgstep" style="text-align:right;">Rs.0</td>
	<td><b>Overall <br>Disc. <br>Type</b></td><td><b>Disc(%)<br>Amt</b></td>
    <td><b>Overall <br>Disc.</b></td>
    <td><b>Overall <br>Total</b></td><td></td></tr>
    
    
<tr id="ovaralltotalprice_ep" style="display:none;"> <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
<td id="totalprice_ep_sgstlabel" style="display:none;text-align:right;">Tot.Sgst</td>

<td id="totalsgstep" style="text-align:right;">Rs 0</td>

<td>Flat <input class="overalldiscounttype_ep"  name="overalldiscounttypeep" value="flat" type="radio" checked="true"><br>
 %<input class="overalldiscounttype_ep"  name="overalldiscounttypeep" value="percent"  type="radio" ></td>
  <td>
 <input type="text" name="overalldiscountep" placeholder="Discount" class="form-control overalldiscountpercentep" required="true"   id="overalldiscountpercentep"  value="0" />
 </td>
 <td>
 <input type="text"  readonly="true" name="overalldiscountamountep" value="0" class="form-control overalldiscountamountep"   required="true" id="overalldiscountamountep"/>
 </td>
 <td>
 <input type="text" name="overalltotalep"  readonly="true" required="true"   value="0" class="form-control overalltotalep" id="overalltotalep" required="true" readonly="true" /> 
 </td><td></td></tr>
 
<tr id="btn_ep" style="display:none;"><td colspan="11" align="right">
	 <span id="loadtex1" style="display: none; "></span>
	 <?= Html::Button($pmodel->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-save "></i>Update', ['class' => $pmodel->isNewRecord ? 'btn btn-success savevalue_ep' : 'btn btn-primary ',
	 'id'=>'submitbutton']) ?>
</td> <td><p id="invoice1" style="display:none;"><td id="rem1"></td><td id="rem2"></td></p>
	</td></tr>
 </table>
</div>
</div>
</div>
</div>
<?php	ActiveForm::end();?>
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
 
$('#datatable-fixed-col4').DataTable().on( 'search.dt', function () {
	var value = $('.dataTables_filter input').val();
 if(value!="")
 {
 	
 	 $(".dataTables_scroll").show();
         $(".dataTables_info").show();
 }
 else{
 	 $(".dataTables_scroll").hide();
         $(".dataTables_info").hide();
 }
   
} );   
        

	});
</script>



<script>
 $(document).ready(function()
 {
 	
 	 $(".dataTables_scroll").hide();
         $(".dataTables_info").hide();
             var val = $('#insurancetype1').val();
        
        var rowCount = $('#productgrid_ep tr').length;
        $('#productgrid_ep tr').hide();

        	      if(val == 3 || val=="") 
        { $('#refer').hide();
         $("#datatable-fixed-col4").dataTable().fnDestroy();
         
         
              
          $("#datatable-fixed-col4").length && $("#datatable-fixed-col4").DataTable({
             scrollY: "200px",
            scrollX: false,
            scrollCollapse: true,
             columns: [
    { "orderable": false },
    { "orderable": false },
   { "orderable": false },
    { "orderable": false }, { "orderable": false }, { "orderable": false },
  
    { "orderable": false },
     { "orderable": false },
    null,null
  ],
            
          
            "order": [[ 9, "desc" ]],
            paging:false,
            
           "language": {
                searchPlaceholder: "Search Stock From Products",
                search: "",

            },
            "dom": '<"top"f>rt<"bottom"ilp><"clear">'
       });
       $(".dataTables_scroll").hide();
         $(".dataTables_info").hide();
        }
         else 
         {   $('#refer').show();
             $("#datatable-fixed-col4").dataTable().fnDestroy();
           
         	 $("#datatable-fixed-col4").length && $("#datatable-fixed-col4").DataTable({
             scrollY: "200px",
            scrollX: false,
            scrollCollapse: true,
             columns: [
    { "orderable": false },
    { "orderable": false },
   { "orderable": false },
    { "orderable": false }, { "orderable": false }, { "orderable": false },
  
    { "orderable": false },
     { "orderable": false },
    null,null
  ],
            
             "language": {
                searchPlaceholder: "Search Stock From Products",
                search: "",

            },
            "dom": '<"top"f>rt<"bottom"ilp><"clear">',
            paging:false,
          
            "order": [[ 9, "asc" ]],
           
       });
       
       
       
       
       
        $(".dataTables_scroll").hide();
         $(".dataTables_info").hide();
         }
         
 	 $(document.body).on('change', '#insurancetype1', function ()
 	  {
        var val = $('#insurancetype1').val();
       
        var rowCount = $('#productgrid_ep tr').length;
        $('#productgrid_ep tr').hide();

        	      if(val == 3 || val=="") 
        { $('#refer').hide();
         $("#datatable-fixed-col4").dataTable().fnDestroy();
         
         
              
          $("#datatable-fixed-col4").length && $("#datatable-fixed-col4").DataTable({
             scrollY: "200px",
            scrollX: false,
            scrollCollapse: true,
             columns: [
    { "orderable": false },
    { "orderable": false },
   { "orderable": false },
    { "orderable": false }, { "orderable": false }, { "orderable": false },
  
    { "orderable": false },
     { "orderable": false },
    null,null
  ],
            
          
            "order": [[ 9, "asc" ]],
            paging:false,
            
           "language": {
                searchPlaceholder: "Search Stock From Products",
                search: "",

            },
            "dom": '<"top"f>rt<"bottom"ilp><"clear">'
       });
       $(".dataTables_scroll").hide();
         $(".dataTables_info").hide();
        }
         else 
         {   $('#refer').show();
             $("#datatable-fixed-col4").dataTable().fnDestroy();
           
         	 $("#datatable-fixed-col4").length && $("#datatable-fixed-col4").DataTable({
             scrollY: "200px",
            scrollX: false,
            scrollCollapse: true,
             columns: [
    { "orderable": false },
    { "orderable": false },
   { "orderable": false },
    { "orderable": false }, { "orderable": false }, { "orderable": false },
  
    { "orderable": false },
     { "orderable": false },
    null,null
  ],
            
             "language": {
                searchPlaceholder: "Search Stock From Products",
                search: "",

            },
            "dom": '<"top"f>rt<"bottom"ilp><"clear">',
            paging:false,
          
            "order": [[ 9, "desc" ]],
           
       });
       
       
       
       
       
        $(".dataTables_scroll").hide();
         $(".dataTables_info").hide();
         }
        
  
    });
    

    
    });
</script>