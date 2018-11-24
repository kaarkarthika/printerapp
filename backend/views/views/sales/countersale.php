<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\CompanyBranch;
use backend\models\Vendor;
use backend\models\Product;
use backend\models\Composition;
use backend\models\Unit;
use backend\models\Stockmaster;
use backend\models\Stockrequest;
use backend\models\Physicianmaster;
use backend\models\Sales;
use backend\models\Saledetail;
$datatables = $dataProvider->getModels();
$session = Yii::$app->session;
$this->title = Yii::t('app', 'Sales');
?>
<style>
	.kv-editable-link{
		border-bottom: 0px !important;
	}
	.pagination{display:none;}
	
</style>
<style>
	
	.dataTables_wrapper .dataTables_length {
float: left;
}
div.dataTables_wrapper div.dataTables_filter{float:left !important;text-align: left;
width:600px  !important;}
</style>

<style>
	#load{display:none;position:fixed;left:128px;top:27px;width:100%;height:100%;z-index:9999;margin-top:20%}
	.dt-buttons{display:none;}
	.wizard .actions{display:none;}
	#datatable-buttons_filter{text-align:left;}
	.chooseaction1:hover{background-color: #ffffff !important;color:#5fbeaa !important}
	.chooseaction1{background-color: #5fbeaa !important;color:#ffffff !important}
	div.dataTables_wrapper div.dataTables_filter input {width:345px !important}
</style>

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

<div class="container">
<div id="load"  align="center"><img src="<?= Url::to('@web/dmc.gif') ?>" />Loading...</div>
<div class="row">
<div class="panel panel-border panel-inverse">
<div class="panel-heading"></div>
                                                		<div class="panel-body">
										  <?php $form = ActiveForm::begin(['id'=>'wizard-validation-form']); ?>
            <div class="clearfix"></div>
            
              <div class="col-md-3">
              	
              	
    	 <?= $form->field($pmodel, 'medicalrecord_number')->textInput(['maxlength' => true,'required'=>'true','id'=>'mrnumber',
    	 'onchange'=>' $.get( "'.Url::toRoute('getexistingusers').'", { id: $(this).val() } )
                                                        .done(function( data ) {
														var obj = $.parseJSON(data);
                                                        $("#mobilenumber").val(obj[0]); 
                                                        $("#firstname").val(obj[1]);                       
                                                        }
                                                    );'])
    	 ->label("Medical Record Number"); ?>
    	
    </div>
      	   	  <div class="col-md-3">
<?= $form->field($pmodel, 'patient_mobilenumber')->textInput(['maxlength' => 10,'required'=>'true','id'=>'mobilenumber',
  'onchange'=>' $.get( "'.Url::toRoute('getexistingusersfrommobile').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                         var obj = $.parseJSON(data);
                                                         $("#mrnumber").val(obj[0]); 
                                                         $("#firstname").val(obj[1]);                      
                                                        }
                                                    );' ])->label("Patient Phone Number"); ?>
        </div>
    <div class="col-md-3">
    	 <?= $form->field($pmodel, 'firstname')->textInput(['maxlength' => true,'required'=>'true','id'=>'firstname'])->label("First Name *"); ?>
    </div>
    <div class="form-group clearfix">
     </div>
                                                <div class="row">
                                                	<div class="panel panel-border panel-inverse">
                                                		<div class="panel-heading">
                                                		</div>
       <div class="panel-body">
       <table id="datatable-fixed-col3" class="table table-striped table-hover">
       <thead>
       <tr>
          <th>Add</th>
       <th>Stock & Type</th>
       <th>Batch No / Current Stock</th>
       <th>Stock/Brand Code</th>
       <th>Composition</th>
       <th>Unit</th>
        <th>Expire Date</th>
        <th>MRP /Unit</th>
     
        </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                	if(count($datatables)>0){
                                				 $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
	
						
										
										$saledata=Sales::find()->where(['paid_status'=>'UnPaid'])->andwhere(['branch_id'=>$companybranchid])->all();
                                		$i=1;
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
										$compositionid[]=$value->stockbrandcode->compositionid;
										$newcompositiondata=array_intersect_key($compositionlist, array_flip($compositionid));
									    $compositionval=array_values($newcompositiondata);
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
									   echo"<td><button type='button' dataincrement='".$i."' id='btnsubmit".$i."' class='btn-xs btn-sm btn-icon btn-default waves-effect waves-light choose_np' data-id='".$value->stockresponseid."'>
									 <i class='fa fa-plus'></i>
									 </button></td>";
	                            
	                              echo "  <td>".$value->stockbrandcode->product->productname.'-'.$producttypeval[0]."</td> 
	                              <td>".$value->batchnumber."/".$availableqty."</td>
	                                 <td>".$value->stockbrandcode->stockcode."/".$value->stockbrandcode->brandcode."</td>
	                                 <td>".$compositionval[0]."</td>
	                                 ";
									 echo "<td>".$unitval[0]."</td>";
									 echo "<td>".date("d/m/Y",strtotime($value->expiredate))."</td>";
								   echo "<td>".number_format($value->mrpperunit,2)."</td>";
									
									 echo "<input type='hidden' name='branch_id' class='branchid' value='".$value->branch_id."'/>";
    
                                    //Set empty value after
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
} ?>
                                
                                </tbody>
                            </table>
                                                			
                                                		</div>
                                                	</div>
                                                </div>
                            <div class="clearfix"></div>
                           
                       <div class="row">
                                                	<div class="panel panel-border panel-inverse">
                                                		<div class="panel-heading">
                                                		
                                                		</div>
                                                		<div class="panel-body">      
                                                			 <div  style="white-space: nowrap;
  overflow-x: visible;
  overflow-y: hidden;

  width: auto; ">             
                            
                     <table id="productgrid_np" class="table table-striped table-hover table-bordered">
             <thead id="np_theaddata" style="display:none;">
           <!--  <th>S.No</th>-->
             <th>Stock Info</th>
            
             <th>Quantity</th>
              <th>UnitForm</th>
                <th>TotalUnits</th>
             <th>Price/Qty</th>
              <th id="gstper">GST %</th>
                <th id="gstval">GST Value</th>
               <th> Disc.Type</th>
              <th> Disc %</th>
               <th> Disc. <br>Value</th>
             <th>Total Price</th>
             <th></th>
             </thead>  <?php $i=0;?>
         <tbody  id="formdetails_np" >

</tbody>
<tr id="totalprice_np_row" style="display:none;"><td></td><td></td><td></td><td></td><td></td><td>Total Gst</td>
	<td style="text-align:right;" id="td1"><span id="totalgstnp">Rs.0</span></td>
	<td id="td2"></td><td id="td3">Tot.Disc</td>
<td style="text-align:right;"><span id="totaldiscountnp">Rs.0</span></td>
<td style="text-align:right;"><span id="total_np">Tot.Price :Rs.0</span>
	
	
	<input type="hidden" id="totalprice_np" name="totalprice" /></td><td></td></tr>


    
     <tr id="totalprice_np_label" style="display:none;"><td></td><td></td><td></td><td></td>
     	<td></td><td >Tot.Cgst </td>
	<td id="totalprice_np_cgst" style="display:none;text-align:right;"><span id="totalcgstnp">Rs.0</span></td>
	<td><b>Overall <br>Discount <br>Type</b></td><td><b>Disc(%)<br>Amt</b></td>
    <td><b>Overall <br>Discount</b></td>
    <td><b>Overall <br>Total</b></td><td></td></tr>
    
    
<tr id="ovaralltotalprice_np" style="display:none;"><td></td><td></td><td></td><td></td><td></td>
<td>Tot.SGST </td>
	<td id="totalprice_np_sgst" style="display:none;text-align:right;"><span id="totalsgstnp">Rs.0</span></td>	
	
<td>Flat <input class="overalldiscounttype_np" id="overalldiscounttype_np" name="overalldiscounttype" value="flat" type="radio" checked="true">
 %<input class="overalldiscounttype_np" id="overalldiscounttype_np" name="overalldiscounttype" value="percent"  type="radio" ></td>
  <td>
 <input type="text" name="overalldiscount[]" placeholder="Discount" class="form-control overalldiscountpercent" required="true"   id="overalldiscountpercent"  value="0" />
 </td>
 <td>
 <input type="text"  readonly="true" name="overalldiscountamount[]" value="0" class="form-control overalldiscountamount"   required="true" id="overalldiscountamount"/>
 </td>
 <td>
 <input type="text" name="overalltotal[]"  readonly="true" required="true"   value="0" class="form-control overalltotal" id="overalltotal" required="true" readonly="true" /> 
 </td><td></td></tr>
 
 
<tr id="btn_np" style="display:none;"><td colspan="6" align="right">
	 <span id="loadtex" style="display: none; "></span>
 <?= Html::Button($pmodel->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-save "></i>Update', ['class' => $pmodel->isNewRecord ? 'btn btn-success savevalue_np' : 'btn btn-primary ']) ?>
 <td ><p id="invoice" style="display:none;"></p>
	</td><td></td><td></td><td></td><td></td><td></td>
	</tr>
		 </table>
        </div>
</div>
</div>
</div> <?php ActiveForm::end(); ?>
                        	</div>
                    	</div>

</div>
</div>

</div>
</div>

<script>
    $(document).ready(function()
    {
             $('body').on("click",".modalView",function()
             {
             var PageUrl = $(this).attr('value');
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Stock Audit</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false();
            });
           });
         
</script>

<script>

function alphaOnly(event) {
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8);
};
 $(document).ready(function()
 {
 $('body').on("click",'.savevalue_np',function(){
		 	
 var form = $("#wizard-validation-form");
 var formData = form.serialize();
 $form_container=$("#wizard-validation-form");
   	 $form_container.validate().settings.ignore = ":disabled,:hidden";
   var chkform=$form_container.valid();
   if(chkform==true){
   	 	var k=0;
var inps = document.getElementsByName('dataincrement[]');
for (var i = 0; i <inps.length; i++) {
var inp=inps[i];
var inc=inp.value;
var totalstock=parseFloat($("#availablestock" + inc).val());
var uq_1=parseFloat($("#totalunits" + inc).val());
  if(uq_1>totalstock)
          {
          
          	var k=1;
          }
          
           if(uq_1<=0)
          {
          	var k=2;
          }
}

var overalltotal=parseFloat($("#overalltotal").val());
if(overalltotal<=0)
{
	k=3;
}

  if(k==0)
  {
  	$.ajax({
        url:'<?php echo Yii::$app->homeUrl ?>?r=sales/countersale',
        type: 'post',
       data: formData,
        success: function (data) {
        	$("#load").show();
if(data=="A"){
$("#load").hide();
$("#loadtex").text("Some Stock Recently Assigned to Sale. Stock Not available Now.");
$("#loadtex").css('color','green ');
$("#loadtex").show(4);
		}
		
		else{
			 var data1=data.split("=")[0];
        	var data2=data.split("=")[1];
        	
        	        if(data1=="Y")
	    {
	    	
	    $("#load").hide();
$(".savevalue_np").hide();
$("#loadtex").text("Successfully Saved.");
$("#loadtex").css('color','green ');
$("#loadtex").show(4);
$("#invoice").show();
$("#invoice").find('a.btn').remove();
$("#invoice").append("<a target='_blank' class='btn btn-default' href='<?php echo Yii::$app->homeUrl ?>
	?r=sales/invoice&id="+data2+"'>Invoice</a>" );
	}
	}
	}
	});
	}
	
	 else if(k==2){
  	   swal({
                title: "Are you sure?",
                text: "Total Units Required Some Stock",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: "Yes",
                closeOnConfirm: false
            });
   }
   
    else if(k==3){
  	   swal({
                title: "Are you sure?",
                text: "Overall Total Less than zero",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: "Yes",
                closeOnConfirm: false
            });
   }
	else
	{
		
	swal({
	title: 
 "Are you sure?",
                text: "Check Your Units is greater than Available Stock",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: "Yes",
                closeOnConfirm: false
            });
   }
    }
	});
	
	$('body').on("click",'.choose_np',function(){
	var y = $('#productgrid_np >tbody >tr').length;
	var dataid=$(this).attr('data-id');
	var price = $('.price').val();
	var branch = $('.branchid').val();
	$("#load").fadeIn("slow");
	$("#formdetails").fadeOut("slow");
	var inc = $(this).attr('dataincrement');
	 var form = $("#wizard-validation-form");
	 var formData = form.serialize();
// $form_container=$("#wizard-validation-form");
  // 	 $form_container.validate().settings.ignore = ":disabled,:hidden";
   	  $("#load").fadeOut("slow");	
  // var chkform=$form_container.valid();
  // if(chkform==true){
		$("#btnsubmit"+ inc).prop('disabled', true);
	    $('#np_theaddata').show();
        $('#totalprice_np_row').show();
        $('#btn_np').show();
        $('#totalprice_np_cgst').show();
        $('#totalprice_np_sgst').show();
        $('#totalprice_np_label').show();
        $("#ovaralltotalprice_np").show();
   		$.ajax({
   			
       url:'<?php echo Yii::$app->homeUrl ?>?r=sales/productdetail_countersale&id='+dataid+"&price="+price+"&branch_id="+branch+"&autonumber="+inc,
        type: "post",
        success: function (data) {
       // $("#formdetails1").empty();
       
        var r = $("#formdetails_np").append(data);
       if(data=="Y"){
		        	 $("#load").fadeOut("slow");	
		        	 noti();
		        	// $("#formdetails1").fadeOut("slow");
		        	}

         $("#load").fadeOut("slow");
          $("#gen").attr('disabled',true).selectpicker('refresh');
        $("#vendor_idz").selectpicker('refresh');
        $("#product_idz").selectpicker('refresh');
        $("#formdetails").fadeIn("slow");
        }
     });
  // }
   	
   //	else{
	//		swal("Please Fill Required Fields!");
	//		$("#load").fadeOut("slow");	
	//	    $("#formdetails").fadeIn("slow");
		//       }
	})
	
	<?php 
if(isset($_GET['status'])){?>
 noti();
<?php }?>
});


function noti () {
	
  $.Notification.autoHideNotify('custom', 'top right', 'Successfully Added.');
}
$('body').on("click",'.demo',function(e){
return false;
	
});
</script> 
<script>
 $(document).ready(function()
 {
$('#datatable-fixed-col3').DataTable({
            scrollY: "200px",
            scrollX: false,
            scrollCollapse: true,
                       paging: false,
             "language": {
                searchPlaceholder: "Search Stock From Products",
                search: "",

            },
            "dom": '<"top"f>rt<"bottom"ilp><"clear">',
            
             columns: [
    { "orderable": false },
    { "orderable": false },
   { "orderable": false },
   
    { "orderable": false }, { "orderable": false }, { "orderable": false },
  
   null,null
   
  ],
         
        });
 
    });
</script>	