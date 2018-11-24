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
$datatables = $dataProvider->getModels();
$session = Yii::$app->session;
use backend\models\Sales;
use backend\models\Saledetail;
use backend\models\Patient;																																				
$this->title = Yii::t('app', 'Sales');
?>
<style>
	.kv-editable-link{
		border-bottom: 0px !important;
	}
	.pagination{display:none;}
	form.appointment_details .form-control {
    width: 58%;
    margin-bottom: 5px;
}
form.appointment_details>.col-md-12 {
    background: #fff;
    margin: 6px 0;
    padding: 10px 10px;
        border-top: 3px solid #5fbeaa;
}
form.appointment_details label {
    top: 8px;
    position: relative;
}
form.appointment_details h4 {
    font-weight: 600;
}
.headtitle h3 {
    background: #a9daff;
    padding: 10px;
    font-weight: 600;
}
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
 <div class="container">
	<div class="box">
		 <div class="headtitle">
		 		<h3>Private OPD Std</h3>
		 </div>
		 <div class="row">	<form name="appointment_details" class="appointment_details" method="post" action="">
		 	<div class="col-md-12">
		 	
		 		 <div class="formdetails">
		 			<h4>Appointment Detils</h4>
				 		<label class="col-md-2">App Ref No</label>
				 		<input type="text" class="col-md-3 form-control " name="ApptRefNo" id="ApptRfNo" placeholder=""/>
				 		
				 	</div>
				 </div>
				 	<div class="col-md-12">
				 	
				 	<div class="patient_details">
				 	<h4>Patient Detail</h4>
				 	<div class="col-md-4">
				 		<label class="col-md-5">MR.No</label>
				 		<input class="col-md-8 form-control " type="text" name="mr_no" id="mr_no" placeholder=""/>
				 			
				 		<label class="col-md-5">Age</label>
				 		<input type="text" class="col-md-8 form-control " required name="pat_age" id="pat_age" placeholder=""/>
				 			
				 		<label class="col-md-5">Marital status</label>
				 		<!--<input type="text" class="col-md-8 form-control " name="pat_m_status" id="pat_m_status" placeholder=""/>-->
				 		<select class="col-md-8 form-control " me="pat_m_status" required id="pat_m_status">
				 			<option value="">- Select -</option>
							  <option value="married">Married</option>
							  <option value="single">Single</option>
							  <option value="widowed">Widowed</option>
							  <option value="divorced">Divorced</option>
							  
						</select>
				 		
				 		<label class="col-md-5">City</label>
				 		<input type="text" class="col-md-8 form-control " required name="pat_city" id="pat_city" placeholder=""/>
						
				 			
				 		<label class="col-md-5">pincode</label>
				 		<input type="text" class="col-md-8 form-control " required name="pat_pincode" id="pat_pincode" placeholder=""/>
						
				 		
				 			
				 		<label class="col-md-5">Email</label>
				 		<input type="email" class="col-md-8 form-control " onblur="validateEmail(this); attern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" 
        required="required" name="pat_email" id="pat_email" placeholder=""/>
        
        				
				 		<label class="col-md-5">Occupation</label>
				 		<input type="text" class="col-md-8 form-control " name="pat_occupation" id="pat_occupation" placeholder=""/>
				 			
				 			<label class="col-md-5">Religion</label>
				 		<input type="text" class="col-md-8 form-control " name="pat_region" id="pat_region" placeholder=""/>
				 		
				 	</div>	
				 	<div class="col-md-4">
				 		
				 		<label  class="col-md-5" >Name Inital</label>
				 		<!--<input type="text"   class="col-md-8 form-control " name="nameinital" id="nameinital" placeholder=""/>-->
				 		<select class="col-md-8 form-control " name="nameinital" id="nameinital" required>
				 			<option value="">- Select -</option>
							  <option value="Mr">Mr</option>
							  <option value="Miss">Miss</option>
							  <option value="Mrs">Mrs</option>
							  <option value="Dr">Dr</option>
							</select>
				 		
				 		<label class="col-md-5">Relation</label>
				 		<!--<input type="text" class="col-md-8 form-control " name="pat_relation" id="pat_relation" placeholder=""/>-->
				 		<select class="col-md-8 form-control " name="pat_relation" required id="pat_relation">
				 			<option value="">- Select -</option>
							  <option value="wife">Wife</option>
							  <option value="mother">Mother</option>
							  <option value="son">Son</option>
							  <option value="father">Father</option>
							  <option value="Brother">Brother</option>
							  <option value="Sister">Sister</option>
							  <option value="Uncle">Uncle</option>
							</select>
				 		
				 		<label class="col-md-5">Sex</label>
				 		<!--<input type="text" class="col-md-8 form-control " name="pat_sex" id="pat_sex" placeholder=""/>-->
				 		<select class="col-md-8 form-control " name="pat_sex"  required id="pat_sex">
				 			<option value="">- Select -</option>
							  <option value="Female">Female</option>
							  <option value="Male">Male</option>
							  <option value="Other">Other</option>
						</select>
				 		
				 		<label class="col-md-5">District</label>
				 		<input type="text" class="col-md-8 form-control " name="pat_district" id="pat_district" placeholder=""/>
				 			
				 		<label class="col-md-5">Phone</label>
				 		<input type="text" class="col-md-8 form-control " name="pat_phone" onkeypress="javascript:return isNumber(event)" id="pat_phone" placeholder=""/>
				 			
				 		<label class="col-md-5">Mobil _no</label>
				 		<input type="text" class="col-md-8 form-control " name="pat_mobile"  onkeypress="javascript:return isNumber(event)" id="pat_mobile" placeholder=""/>
				 			
				 		<label class="col-md-5">Education</label>
				 		<input type="text" class="col-md-8 form-control " name="pat_education" id="pat_education" placeholder=""/>
				 			
				 		<label class="col-md-5">Type</label>
				 		<!--<input type="text" class="col-md-8 form-control " name="pat_type" id="pat_type" placeholder=""/>-->
				 		<select class="col-md-8 form-control " name="pat_type" id="pat_type" required >
				 			<option value="">- Select -</option>
							  <option value="hospital">Hospital</option>
							  
						</select>
				 			
				 	</div>	
				 	<div class="col-md-4">
				 		
			 			<label  class="col-md-5">Name</label>
				 		<input type="text"  class="col-md-8 form-control " required	 name="pat_name" id="pat_name" placeholder=""/>
				 			
				 		<label class="col-md-5">Relation Name</label>
				 		<input type="text" class="col-md-8 form-control " name="pat_relation_name" id="pat_relation_name" placeholder=""/>
								
				 		<label class="col-md-5">Address</label>
				 		<input type="text" class="col-md-8 form-control " required name="pat_address" id="pat_address" placeholder=""/>
				 			
				 		<label class="col-md-5">State</label>
				 		<input type="text" class="col-md-8 form-control " name="pat_state" id="pat_state" placeholder=""/>
				 			
				 		<label class="col-md-5">Mobil _no</label>
				 		<input type="text" class="col-md-8 form-control " required name="pat_mobile" onkeypress="javascript:return isNumber(event)" id="pat_mobile" placeholder=""/>
				 			
				 		<label class="col-md-5">Source</label>
				 		<input type="text" class="col-md-8 form-control " name="pat_source" id="pat_source" placeholder=""/>
				 			
				 			<label class="col-md-5">Nationality </label>
				 		<input type="text" class="col-md-8 form-control " name="pat_nationality" id="pat_nationality" placeholder=""/>
				 		
				 	</div>
				 		
			 </div>
			 </div>
		 	<div class="col-md-12"> 
		 		<div class="realative_details">
				 	<h4>Relative Details</h4>
				 		
				 		<div class="col-md-4">
				 			<label class="col-md-5">DOB</label>
				 			<input class="col-md-8 form-control " type="text" name="rel_dob" id="rel_dob" placeholder=""/>
				 			
				 			<label class="col-md-5">Qulaification</label>
				 			<input type="text" class="col-md-8 form-control " name="rel_qulatification" id="rel_qulatification" placeholder=""/>
							
					 		<label class="col-md-5">Annual Income</label>
				 			<!--<input type="text" class="col-md-8 form-control " name="rel_annual_income" id="rel_annual_income" placeholder=""/>-->				 			<select class="col-md-8 form-control " name="rel_annual_income" id="rel_annual_income" >
				 			<option value="">- Select -</option>
							  <option value="1less"> < 1 Lakh  </option>
							  <option value="1grater"> 1 Lakh > </option>
							  <option value="50less"> < 50 Lakh  </option>
							  <option value="50grater"> 50 Lakh > </option>
							</select>
				 		
				 		</div>
				 		
				 		<div class="col-md-4">
				 			<label  class="col-md-5" >Mobile NO</label>
				 			<input type="text"   class="col-md-8 form-control " onkeypress="javascript:return isNumber(event)" name="rel_mobile_no" id="rel_mobile_no" placeholder=""/>
				 			
				 			<label class="col-md-5">Occupation</label>
				 			<input type="text" class="col-md-8 form-control " name="rel_occupation" id="rel_occupation" placeholder=""/>
				 		
				 		</div>
				 		
				 		<div class="col-md-4">
				 			<label  class="col-md-5">Email </label>
				 			<input type="email"  class="col-md-8 form-control " onblur="validateEmail(this); name="rel_email" id="rel_email" placeholder=""/>
				 			
				 			<label class="col-md-5">Religion</label>
					 		<input type="text" class="col-md-8 form-control " name="rel_region" id="rel_region" placeholder=""/>
				 		
				 		</div>
				
				 	</div>
		 	</div>
		 	<div class="col-md-12">
		 		<div class="realative_details">
				 	<h4>Consultant Details</h4>
				 		
				 	<div class="col-md-4">
				 			
				 		<label class="col-md-5">Timing *</label>
				 		<input class="col-md-8 form-control " type="text" required name="con_timing" id="con_timing" placeholder=""/>
				 			
				 			<label class="col-md-5">Turn No</label>
				 		<input type="text" class="col-md-8 form-control "  name="con_turn_no" id="con_turn_no" placeholder=""/>
				 			
				 	</div>
				 	<div class="col-md-4">
				 			
				 		<label  class="col-md-5" >Consulant *</label>
				 		<input type="text"   class="col-md-8 form-control " required name="con_consulant" id="con_consulant" placeholder=""/>
				 			
				 	</div>
				 	<div class="col-md-4">
				 			
				 		<label  class="col-md-5">Department *</label>
				 		<input type="text"  class="col-md-8 form-control "  required name="con_department" id="con_department" placeholder=""/>
				 			
				 	</div>	
				
				 	</div>
				 </div>
				 <div class="col-md-12">
				 	<div class="realative_details">
				 	<h4>Finacial Details</h4>
				 	
				 		<div class="col-md-4">
				 			<label class="col-md-5">Total amount</label>
				 			<input class="col-md-8 form-control " required type="text" name="fin_total_amount" id="fin_total_amount" placeholder=""/>
				 			
				 			<label class="col-md-5">Net Amount</label>
				 			<input type="text" class="col-md-8 form-control " name="fin_net_amount" id="fin_net_amount" placeholder=""/>
				 			
				 			
				 			<label class="col-md-5">Payment Mode	</label>
				 			<!--<input type="text" class="col-md-8 form-control " name="fin_payment_mode" id="fin_payment_mode" placeholder=""/>-->
				 			<select class="col-md-8 form-control " name="pat_type" id="pat_type" >
				 				<option value="">- Select -</option>
								  <option value="cash">Cash</option>
								  <option value="cheque">Cheque</option>
								  <option value="online">Online</option>
							 </select>
						
				 			<label class="col-md-5">Remarks	</label>
				 			<input type="text" class="col-md-8 form-control " name="fin_remarks" id="fin_remarks" placeholder=""/>
				 			
				 			<label class="col-md-5">PAN Card No	</label>
				 			<input type="text" class="col-md-8 form-control " name="fin_pan_card" id="fin_pan_card" placeholder=""/>
				 			
						</div>
						<div class="col-md-4">
				 			<label  class="col-md-5" >Less Disc (%)</label>
				 			<input type="text"   class="col-md-8 form-control " name="fin_less_disc" id="fin_less_disc" placeholder=""/>
				 			
				 			<label class="col-md-5">Paid Amount	</label>
				 			<input type="text" class="col-md-8 form-control " name="fin_paid_amount" id="fin_paid_amount" placeholder=""/>
				 			
				 			<label class="col-md-5">Emergency	</label>
				 			<!--<input type="text" class="col-md-8 form-control " name="fin_emergency" id="fin_emergency" placeholder=""/>-->
				 			<input  type="checkbox" class="col-md-8 form-control " name="fin_emergency" id="fin_emergency">
				 			
				 			<label class="col-md-5">Pay category	</label>
				 	
				 			<select class="col-md-8 form-control " name="fin_pay_cat" id="fin_pay_cat" >
				 				<option value="">- Select -</option>
								  <option value="payable">Payable</option>
								 
							 </select>
				 			
				 			<label class="col-md-5">Aadhar Card No	</label>
				 			<input type="text" class="col-md-8 form-control " name="fin_adhar_card" id="fin_adhar_card" placeholder=""/>
				 		</div>
				 		<div class="col-md-4">
				 			<label  class="col-md-5">Less Discount</label>
				 			<input type="text"  class="col-md-8 form-control " name="fin_less_discount" id="fin_less_discount" placeholder=""/>
				 			
				 			<label class="col-md-5">Due Amount	</label>
				 			<input type="text" class="col-md-8 form-control " name="fin_due_amount" id="fin_due_amount" placeholder=""/>
				 			
				 			<label class="col-md-5">Discount By	</label>
				 			<input type="text" class="col-md-8 form-control " required name="fin_discount" id="fin_discount" placeholder=""/>
				 			
				 			<label class="col-md-5">Annual	</label>
				 			<input type="text" class="col-md-8 form-control " name="fin_annuval" id="fin_annuval" placeholder=""/>
				 	
				 		</div>				 	
				 	
				 	</div>
				 	</div>
				 	<div class="col-md-12 text-right" style="    border: none;    margin-top: 0;    position: relative;    top: -6px;">
				 		<button type="submit" class="btn btn-default ">Save</button>
				 	</div>		
				 		
				 </form>
		 	</div>
		 	
		 </div>
		
		 
	</div>
</div>
<script>
	function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    } 
    function validateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(emailField.value) == false) 
        {
            alert('Invalid Email Address');
            return false;
        }

        return true;

}
</script>