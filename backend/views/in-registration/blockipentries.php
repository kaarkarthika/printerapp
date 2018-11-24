<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\InBedno;
use backend\models\InRoomtypes;
use backend\models\InRoomno;
use backend\models\InCategory;
use backend\models\InFloormaster;
use yii\helpers\ArrayHelper;


?>
<link href="<?php echo Url::base(); ?>/validation_plugin/site-demos.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="<?php echo Url::base(); ?>/boot/bootstrap3-typeahead.min.js"></script>  

<link rel="stylesheet" type="text/css" media="screen" href="ubold/dist/css/select2.css" />

<script  src="ubold/dist/js/select2.js"></script>


<style>

table.dataTable th.focus,
table.dataTable td.focus {
  outline: none;
}
.patient_details .form-group label.error {
    text-align: right;
    float: right;
}
.dataTables_wrapper .dataTables_paginate .paginate_button{
	    padding: 0;
}
table#example tr.selected td {
    background: #4e60e8;
    color: #fff;
}
.patient_details {
    border: 1px solid #eee;     margin-bottom: 20px;
}
.patient_details .head {
    background: #dadada;
 
    padding: 3px 0;
    font-size: 12px;
}
button.btn.btn-success.physician {
    padding: 1px 4px;
}
.patient_details .head span {
    background: #dadada;
    position: relative;
    /*top: -10px;
    left: 15px; */
    padding: 3px 15px;
    font-weight: bold;
    color: #000;
}
.form-group label.control-label {
    font-size: 12px;
}
.form-group {
    margin-bottom: 0;
}
.patient_details .form-group label.control-label {
    width: 37%;
    float: left;
    text-align: right;
    margin-right: 10px;
}
.patient_details .form-group input,.patient_details .form-group select,.patient_details .form-group textarea {
    padding: 0 8px;
    height: 25px;
    width: 56%;
    border-top: none;
    border-left: none;
    border-right: none;
}
.dob {
    float: right;
    margin-bottom: 6px;
}
.dob input{
	border-top: none;
    border-left: none;
    border-right: none;
}
.mid-width {
    width: 12.5%;
}
.form-group textarea {
     
    min-height: 90px;
}
.patient_btn {
    padding: 0 0 10px 0;
}
.patient_btn>.form-group{
	float: right;
}
.form-group.field-inregistration-mr_no,.form-group.field-inregistration-bed_no,.form-group.field-inregistration-room_no,
.form-group.field-inregistration-consultant_dr,.form-group.field-inregistration-dr_unit,.form-group.field-inregistration-speciality,
.form-group.field-inregistration-co_consultant{
    width: 84%;
    float: left;
}
.form-group.field-inregistration-address label.control-label,.form-group.field-inregistration-remarks label.control-label {
    text-align: left;
}

.patient_details .col-md-3 .form-group {
    padding: 0 10px;
}
.patient_details .col-md-3 {
    padding: 0 0;
    border-right: 1px solid #eee;
    min-height: 500px;
}
.ogs_name{
	display: none;
}
</style>
<div class="in-registration-form">


<?php $form = ActiveForm::begin(); ?>
 <!-- <div class="row patient_btn">
 	    <div class="form-group">
        <!--?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success physician' : 'btn btn-primary updatephysician']) ? 
    	<button type="button" class="btn btn-success" id='saves_sucess' onclick="SaveIPForm();">Save</button>
    	<span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     	<span id="loadtexts" style="display: none; "></span>
    </div>

 </div>	-->   
    <div class="row "> <!-- .patient_details1 -->
	<!-- <div class="col-md-12" style="padding: 3px 15px; background: #bdbaba;color: #000;">
	<div class="head">
		<span> Patient Details </span>
		<span style="margin-left: 63%;">Date & Time: <?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date('d-m-Y').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date('h:i:s A'); ?> </span>
	</div>
</div>  -->
      <div class="col-sm-3  br-rt">
	    <?= $form->field($model, 'ip_no')->textInput(['class'=>'ipnumber form-control cus-fld number','autocomplete'=>"off",'maxlength' => true,'required'=> true])->label('IP No') ?>
		<?= $form->field($model, 'mr_no')->hiddenInput(['maxlength' => true,'required'=> true])->label(false) ?>
		<?= $form->field($model, 'patient_name')->textInput(['required'=> true])
		->label('Name') ?>
		<?= $form->field($model, 'age')->textInput([ 'required'=> true])->label('Age') ?>
		<?= $form->field($model, 'address')->textArea(['required'=> true])->label('Address') ?>
		<?= $form->field($model, 'phone_no')->textInput(['required'=> true])->label('Phone Number') ?>
      </div>
      <div class="col-sm-6 br-rt">
         <div class="col-sm-6">
		    <?= $form->field($model, 'mlc_no')->textInput(['required' => false])->label('MLC No') ?>
		    <?= $form->field($model, 'bed_no')->textInput(['required' => true])->label('Bed No') ?>
            <?= $form->field($model, 'patient_type')->dropDownList(['discharge_on_request' => 'Discharge On Request'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true])->label('Type') ?>
            <?= $form->field($model, 'hospital')->textInput(['required' => true])->label('Hospital') ?>	
		</div>

		<div class="col-sm-6  ">
		    <?= $form->field($model, 'admit_date')->textInput(['readonly' => true,'required'=> true])->label('Admission Date & Time') ?> 
		    <div class="row">
		      <div class="col-sm-12">
		         <label>Discharge Date & Time</label>
	          </div>
	          <div class="col-sm-6" >
			     <?= $form->field($model, 'discharge_date')->textInput(['maxlength' => true,'required'=> true,
			'value'=>date('d-m-Y')])->label(false) ?>		 
	          </div>
	          <div class="col-sm-6"  >
			     <?= $form->field($model, 'discharge_date')->textInput(['maxlength' => true,'required'=> true,
			'value'=>date('h:i:s A')])->label(false) ?>		 
	          </div>
	        </div>
		
	        <?= $form->field($model, 'doctor_name')->textInput(['required'=> true])->label('Con Dr 1') ?>
		    <?= $form->field($model, 'doctor_name_2')->textInput(['required'=> true])->label('Con Dr 2') ?>
        </div>
        <div class="col-sm-12">
           <?= $form->field($model, 'remarks')->textarea(['row'=>1,'required' => true])->label('Remarks') ?>
        </div>
       </div>

       <div class="col-sm-3">
	      <div class="c panel panel-border panel-custom" style="margin-top:45%;">
			<div class="panel-heading" hidden="">
			  <h5 class="box-title">   </h5> 
		    </div>  
	        <div class="panel-body" style="padding:20px;">
			  <div class="row">
			    <div class="col-sm-12">
			      <div class="form-group"> 
    	            <button type="button" class="btn btn-success col-sm-8" id='saves_sucess' onclick="SaveIPForm();">Save</button>
			  	    <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
					<span id="loadtexts" style="display: none; "></span>
                  </div>
			    </div>
			  </div>
			  <br>
			  <div class="row">
			    <div class="col-sm-12">
				  <a href="<?php echo Yii::$app->request->BaseUrl;?>/index.php?r=in-registration/index" class="btn col-sm-8   btn-default btn-default1" Title="BACK To Grid">Back to Grid </a> 
				</div>
			   </div>
		    </div>
		  </div>	
        </div>




<!--

<div class="col-md-12" style="padding: 10px;">
	
	<div class="col-md-1" style="width: 7%;">
		<span>IP No.</span>
	</div>
	<div class="col-md-2">
		<?//= $form->field($model, 'ip_no')->textInput(['class'=>'ipnumber form-control cus-fld number','autocomplete'=>"off",'maxlength' => true,'required'=> true])->label(false) ?>
		<?//= $form->field($model, 'mr_no')->hiddenInput(['maxlength' => true,'required'=> true])->label(false) ?>
	</div>
	<div class="col-md-1">
		<span>Name</span>
	</div>
	<div class="col-md-2">
		<?//= $form->field($model, 'patient_name')->textInput(['required'=> true])->label(false) ?>
	</div>
	<div class="col-md-2">
		<span>Discharge Date & Time:</span>
	</div>
	<div class="col-md-2" style="width: 13%;">
			<?//= $form->field($model, 'discharge_date')->textInput(['maxlength' => true,'required'=> true,'value'=>date('d-m-Y')])->label(false) ?>
		 
	</div>
	<div class="col-md-2" style="width: 13%;">
			<?//= $form->field($model, 'discharge_date')->textInput(['maxlength' => true,'required'=> true,'value'=>date('h:i:s A')])->label(false) ?>
		 
	</div>
	<div class="col-md-1">
	</div>
</div>
 

 
<div class="col-md-12">
	 
 	<div class="col-md-1" style="width: 7%;">
		<span>Address</span>
	</div>
	<div class="col-md-3" style="width: 17%;">
		<?//= $form->field($model, 'address')->textInput(['required'=> true])->label(false) ?>
	</div>
 	<div class="col-md-1" style="width: 4%;">
		<span>Age</span>
	</div>
	<div class="col-md-1">
   <?//= $form->field($model, 'age')->textInput([ 'required'=> true])->label(false) ?>
  </div>  
	<div class="col-md-2" style="width: 14%;">
		<?//= $form->field($model, 'sex')->textInput(['required' => true])->label(false) ?>	
	</div>
	<div class="col-md-2" style="width: 15%;">
		<span>Admit Date & Time:</span>
	</div>
	<div class="col-md-2" style="width: 13%;">
			<?//= $form->field($model, 'admit_date')->textInput(['readonly' => true,'required'=> true])->label(false) ?> 
	</div>
	<div class="col-md-2" style="width: 13%;">
			<?//= $form->field($model, 'admit_time')->textInput(['readonly' => true,'required'=> true])->label(false) ?> 
	</div>
 </div>

 
<div class="col-md-12">
	 
 	<div class="col-md-1" style="width: 7%;">
		<span>Phone</span>
	</div>
	<div class="col-md-2" style="width: 12%;">
		<?//= $form->field($model, 'phone_no')->textInput(['required'=> true])->label(false) ?>
	</div>
 	<div class="col-md-1" style="width: 4%;">
		<span>Type</span>
	</div>
	<div class="col-md-2" >
   <?//= $form->field($model, 'patient_type')->dropDownList(['discharge_on_request' => 'Discharge On Request'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true])->label(false) ?>
  </div> 
  <div class="col-md-2" style="width: 6%;">
		<span>Hospital</span>
	</div> 
	<div class="col-md-3" style="width: 16%;">
		<?//= $form->field($model, 'hospital')->textInput(['required' => true])->label(false) ?>	
	</div>
		 
	<div class="col-md-2" style="width: 4%;">
		<span>Date:</span>
	</div>
	<div class="col-md-2" style="width: 13%;">
			<?//= $form->field($model, 'created_at')->textInput(['readonly' => true,'required'=> true,'value'=>date('d-m-Y')])->label(false) ?> 
	</div>
	<div class="col-md-2" style="width: 13%;">
			<?//= $form->field($model, 'created_at')->textInput(['readonly' => true,'required'=> true,'value'=>date('h:i:s A')])->label(false) ?> 
	</div>

 </div>
 
 
<div class="col-md-12">
	 
 	<div class="col-md-1" style="width: 7%;">
		<span>Con. Dr.</span>
	</div>
	<div class="col-md-2">
		<?//= $form->field($model, 'doctor_name')->textInput(['required'=> true])->label(false) ?>
	</div>
 	<div class="col-md-1" style="width: 8%;">
		<span>Con. Dr.2</span>
	</div>
	<div class="col-md-2" style="width: 21%;">
   <?//= $form->field($model, 'doctor_name_2')->textInput(['required'=> true])->label(false) ?>
  </div> 
  <div class="col-md-1">
		<span>MLC No.</span>
	</div> 
	<div class="col-md-1" style="width: 12%;">
		<?//= $form->field($model, 'mlc_no')->textInput(['required' => false])->label(false) ?>	
	</div>
	 <div class="col-md-1">
		<span>Bed No.</span>
	</div> 
	<div class="col-md-1" style="width: 10%;">
		<?//= $form->field($model, 'bed_no')->textInput(['required' => true])->label(false) ?>	
	</div>
 </div>
 
  <div class="col-md-12">
	
	<div class="col-md-1" style="width: 7%;">
		<span>Remarks</span>
	</div> 
	<div class="col-md-6">
		<?//= $form->field($model, 'remarks')->textarea(['row'=>1,'required' => true])->label(false) ?>	
	</div>

</div>  -->

     <div id="load1" style='display:none;text-align: center;'><img  class="load-image"  src="<?= Url::to('@web/loader1.gif') ?>" /></div> <div class="row">  
    
    <?php ActiveForm::end(); ?>
   
</div>
</div>
 
 
	 
		

<script>
function Patient_bed() 
{
	$modal = $('#patient_hist-modal');
	$modal.modal('show');
}
 
$(document).ready(function() {
	//$(".pagination > li > a").attr("href", "javascript:void(0)");
	var url=('<?php echo Url::base('http'); ?>');
	var ajax_url=url+'/index.php?r=in-registration/jqgrid';
	
    var disable_buttons = function(){
    $("._edit_save_btn").unbind("click").click(function(e){
        // disable all other buttons but selected
        $("._edit_save_btn").not(this).prop('disabled', true);  
    });
};


//call the above function on dataTable init and page change events like:

    
  $('#example').dataTable( {
    	// 'ajax': ajax_url,
    	   'stateSave': true,
		"responsive": true,
		//"paging": false,
 // "bInfo" : false,
		"language": {
			"paginate": {
			  "previous": '<i class="fa fa-angle-left"></i>',
			  "next": '<i class="fa fa-angle-right"></i>'
			},
			
			 "drawCallback": function () {
        $('#example_paginate > .pagination a').addClass('myNewClassName');
    },
			
		}
	} );
	 
 	
    $('#example tbody').on( 'click', 'tr', function () {
        
    } );
 
    
}); 

function MRNUMBER(data,event)
{
	if(data.value === '')
	{
		EmptyPatientDetails();
	}
	else if(event.keyCode === 13 && data.value !== '')
	{
		$('#load1').show();
		$.ajax({	
	     type: "POST",
		 url: "<?php echo Yii::$app->homeUrl . "?r=in-registration/mr-number-fetch&id=";?>"+data.value,
	     success: function (result) 
	     { //alert(result);
	     	$('#load1').hide();
	     	var obj = JSON.parse(result);
     		if(obj[0] === 'Empty')
     		{
     			EmptyPatientDetails();
     			$('#treatmentoverall-mrnumber').focus('');
     			Alertment('Invalid MR Number !!! Check It');
     		}
     		else if(obj[0] === 'Set')
     		{
     			//EmptyPatientDetails();
     			$('#select#inregistration-name_initial').val(obj[2]['pat_inital_name']);
     			$('input#inregistration-patient_name').val(obj[2]['patientname']);
     			$('input#inregistration-dob').val(obj[2]['dob']);
     			$('select#inregistration-sex').val(obj[2]['pat_sex']);
     			$('select#inregistration-marital_status').val(obj[2]['pat_marital_status']);
     			$('select#inregistration-relation_suffix').val(obj[2]['pat_relation']);
     			$('input#inregistration-relative_name').val(obj[2]['par_relationname']);
     			$('textarea#inregistration-address').val(obj[2]['pat_address']);
     			$('textarea#inregistration-bed_no').val(obj[2]['bed_no']);
     			$('textarea#inregistration-ip_no').val(obj[2]['ip_no']);
     			$('input#inregistration-city').val(obj[2]['pat_city']);
     			$('input#inregistration-district').val(obj[2]['pat_distict']);
     			$('input#inregistration-state').val(obj[2]['pat_state']);
     			$('input#inregistration-pincode').val(obj[2]['pat_pincode']);
     			$('input#inregistration-phone_no').val(obj[2]['pat_phone']);
     			$('input#inregistration-mobile_no').val(obj[2]['pat_mobileno']);
     			$('input#inregistration-religion').val(obj[2]['pat_religion']);
     			
     			alert(obj[2]);
     			
			}
	     }
		 });
	}	
}



function SaveIPForm()
{
	var valid=$("#w0").valid();  
	$('#load1').show();
	if(valid == true)
	{
		$('#load1').hide();
		if (confirm('Are You Sure to Save ?')) {
		$.ajax({
	            type: "POST",
	            url: "<?php echo Yii::$app->homeUrl . "?r=in-registration/blockipentries";?>",
	            data: $("#w0").serialize(),
	            success: function (result) 
	            { 
	            	$('#load1').hide();
	  			 	var data = JSON.parse(result); 
	  			 	//$('#blockipentries-patient_type').val(data[0]['patient_type']);
	  			 	$('#blockipentries-registered').val(data['registered']);
	  			 	$('#blockipentries-panel_type').val(data['panel_type']);
	  			 	$('#blockipentries-mr_no').val(data['mr_no']);
	  			 	$('#blockipentries-name_initial').val(data['name_initial']);
	  			 	$('#blockipentries-patient_name').val(data['patient_name']);
	  			 	$('#blockipentries-age').val(data['age']);
	  			 	$('#blockipentries-sex').val(data['sex']);
	  			 	$('#blockipentries-marital_status').val(data['marital_status']);
	  			 	$('#blockipentries-relation_suffix').val(data['relation_suffix']);
	  			 	$('#blockipentries-relative_name').val(data['relative_name']);
	  			 	$('#blockipentries-address').val(data['address']);
	  			 	$('#blockipentries-city').val(data['city']);
	  			 	$('#blockipentries-district').val(data['district']);
	  			 	$('#blockipentries-state').val(data['state']);
	  			 	
	  			 	$('#blockipentries-pincode').val(data['pincode']);
	  			 	$('#blockipentries-phone_no').val(data['phone_no']);
	  			 	$('#blockipentries-mobile_no').val(data['mobile_no']);
	  			 	$('#blockipentries-country').val(data['country']);
	  			 //	$('#blockipentries-religion').val(data['religion']);
	  			 	$('#blockipentries-hospital').val(data['hospital']);
	  			 	
	  			 	$('#blockipentries-paytype').val(data['paytype']);
	  			 	$('#blockipentries-bed_no').val(data['bed_no']);
	  			 	$('#blockipentries-room_no').val(data['room_no']);
	  			 	$('#blockipentries-floor_no').val(data['floor_no']);
	  			 	$('#blockipentries-room_type').val(data['room_type']);
	  			 	$('#blockipentries-doctor_name').val(data['doctor_name']);
	  			 	$('#blockipentries-doctor_name_2').val(data['doctor_name_2']);
	  			 	$('#blockipentries-dr_unit').val(data['dr_unit']);
	  			 	$('#blockipentries-speciality').val(data['speciality']);
	  			 	$('#blockipentries-co_consultant').val(data['co_consultant']);
	  			 	$('#blockipentries-remarks').val(data['remarks']);
	  			 	 
					var fromDate = new Date(data['admit_date']); 
					var fromTime = new Date(data['admit_time']); 
    			    var createddate = formatDate(fromDate);
    			    var createdtime = formatDate2(fromDate);
    			   //  alert(fromDate);
   					var createtime = formatAMPM(fromTime);
					$('#blockipentries-admit_date').val(createddate);
					$('#blockipentries-admit_time').val(createtime); 
	            }
			}); 
	}
}
else{

		alert("Required Fields.");
	}
}


$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
           	SaveIPForm();
            break;
        case 'f':
            event.preventDefault();
            alert('ctrl-f');
            break;
        case 'g':
            event.preventDefault();
            alert('ctrl-g');
            break;
        case 'c':
            event.preventDefault();
            alert('ctrl-c');
            break;
        }
    }
});


 
$(".mrnumber").typeahead({
	
	source: function(query,result) {
	  		$.ajax({
	  			url:'<?php echo Yii::$app->homeUrl . "?r=in-registration/ajaxfetch1";?>',
	  			method:'POST',
	  			data:{query:query},
	  			dataType:'json',
	  			success:function(data)
	  			{
	  				result($.map(data, function(item){
	  				return item.mr_no;
	  			  }));
	  				
	  			}
	  		})
	},
	autoSelect: true,
	displayText: function(result)
	{
		 return result;
	},
	afterSelect: function(result) 
	{  $('#load1').show();
		$.ajax({
	  			url:'<?php echo Yii::$app->homeUrl . "?r=in-registration/ajaxsinglefetch1&id=";?>'+result,
	  			method:'POST',
	  			dataType:'json',
	  			success:function(data) 
	  			{  // alert(data);
	  				//data1 = JSON.parse(data[0]); alert(data1);
	  			    $('#load1').hide();
	  				$('#inregistration-name_initial').val(data['name_initial']);
					$('#inregistration-patient_name').val(data['patient_name']);
					$('#inregistration-mr_no').val((data['mr_no']));
					$('#inregistration-dob').val(Agecalc(data['dob']));
					$('#inregistration-sex').val(data['sex']);
					 $('#inregistration-ip_no').val(data['ip_no']);
					$('#inregistration-bed_no').val(data['bed_no']);
					$('#inregistration-marital_status').val(data['marital_status']);
					$('#inregistration-relation_suffix').val(data['pat_relation']);
					$('#inregistration-relative_name').val(data['relative_name']);
					$('#inregistration-address').val(data['address']+',  '+data['city']+',  '+data['district']+',  '+data['state']+',  '+data['pincode']);
					$('#inregistration-city').val(data['city']);
					$('#inregistration-district').val(data['district']);
					$('#inregistration-state').val(data['state']);
					$('#inregistration-pincode').val(data['pincode']);
					$('#inregistration-phone_no').val(data['phone_no']);
					$('#inregistration-mobile_no').val(data['mobile_no']);
   				}
	  		})
	  }
});

$(".ipnumber").typeahead({
	
	source: function(query,result) {
	  		$.ajax({
	  			url:'<?php echo Yii::$app->homeUrl . "?r=in-registration/ajaxipnumber";?>',
	  			method:'POST',
	  			data:{query:query},
	  			dataType:'json',
	  			success:function(data)
	  			{
	  				result($.map(data, function(item){
	  				return item.ip_no;
	  			  }));
	  				
	  			}
	  		})
	},
	autoSelect: true,
	displayText: function(result)
	{
		 return result;
	},
	afterSelect: function(result) 
	{  $('#load1').show();
		$.ajax({
	  			url:'<?php echo Yii::$app->homeUrl . "?r=in-registration/ajaxipnumberselectblockipentries&id=";?>'+result,
	  			method:'POST',
	  			dataType:'json',
	  			success:function(data)
	  			{   $('#load1').hide();
	  			 	
	  			 	//$('#blockipentries-patient_type').val(data[0]['patient_type']);
	  			 	$('#blockipentries-registered').val(data[0]['registered']);
	  			 	$('#blockipentries-panel_type').val(data[0]['panel_type']);
	  			 	$('#blockipentries-mr_no').val(data[0]['mr_no']);
	  			 	$('#blockipentries-name_initial').val(data[0]['name_initial']);
	  			 	$('#blockipentries-patient_name').val(data[0]['patient_name']);
	  			 	$('#blockipentries-age').val(Agecalc(data[0]['dob']));
	  			 	$('#blockipentries-sex').val(data[0]['sex']);
	  			 	$('#blockipentries-marital_status').val(data[0]['marital_status']);
	  			 	$('#blockipentries-relation_suffix').val(data[0]['relation_suffix']);
	  			 	$('#blockipentries-relative_name').val(data[0]['relative_name']);
	  			 	$('#blockipentries-address').val(data[0]['address']+', '+data[0]['city']+', '+data[0]['state']+', '+data[0]['pincode']);
	  			 	$('#blockipentries-city').val(data[0]['city']);
	  			 	$('#blockipentries-district').val(data[0]['district']);
	  			 	$('#blockipentries-state').val(data[0]['state']);
	  			 	
	  			 	$('#blockipentries-pincode').val(data[0]['pincode']);
	  			 	$('#blockipentries-phone_no').val(data[0]['phone_no']);
	  			 	$('#blockipentries-mobile_no').val(data[0]['mobile_no']);
	  			 	$('#blockipentries-country').val(data[0]['country']);
	  			 	$('#blockipentries-religion').val(data[0]['religion']);
	  			 	$('#blockipentries-hospital').val(data[3]['patient_type']);
	  			 	
	  			 	$('#blockipentries-paytype').val(data[0]['paytype']);
	  			 	$('#blockipentries-bed_no').val(data[0]['bed_no']);
	  			 	$('#blockipentries-room_no').val(data[0]['room_no']);
	  			 	$('#blockipentries-floor_no').val(data[0]['floor_no']);
	  			 	$('#blockipentries-room_type').val(data[0]['room_type']);
	  			 	$('#blockipentries-doctor_name').val(data[1]['physician_name']);
	  			 	$('#blockipentries-doctor_name_2').val(data[2]['physician_name']);
	  			 	$('#blockipentries-dr_unit').val(data[0]['dr_unit']);
	  			 	$('#blockipentries-speciality').val(data[0]['speciality']);
	  			 	$('#blockipentries-co_consultant').val(data[0]['co_consultant']);
	  			 	
					
					var fromDate = new Date(data[0]['created_date']); 
    			    var createddate = formatDate(fromDate);
    			    var createdtime = formatDate2(fromDate);
    			     //alert(createdtime);
   					var createtime = formatAMPM(fromDate);
					$('#blockipentries-admit_date').val(createddate);
					$('#blockipentries-admit_time').val(createtime);
					
	  			
	  			}
	  		})
	  }
});
function formatAMPM(date) {
	//var date = new Date();
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var sec = date.getSeconds();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  sec = sec < 60 ? '0'+sec : sec;
  var strTime = hours + ':' + minutes + ':' + sec + ' ' + ampm;
  return strTime;
}
  function formatDate2(date) 
{
     var d = new Date(date),
     month = '' + (d.getHours() + 1),
     day = '' + d.getMinutes(),
     year = d.getSeconds();
	 
     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

     return [month,day, year].join(':');
 }
  
function Agecalc(date) {
	var now = new Date();
  var today = new Date(now.getYear(),now.getMonth(),now.getDate());
  var yearNow = now.getYear();
  var monthNow = now.getMonth();
  var dateNow = now.getDate();
  var dateString=formatDate1(date);	
  var dob = new Date(dateString.substring(6,10),dateString.substring(0,2)-1,dateString.substring(3,5));
  var yearDob = dob.getYear();
  var monthDob = dob.getMonth();
  var dateDob = dob.getDate();
  var age = {};
  var ageString = "";
  var yearString = "";
  var monthString = "";
  var dayString = "";
  yearAge = yearNow - yearDob;
  if (monthNow >= monthDob)
    var monthAge = monthNow - monthDob;
  else {
    yearAge--;
    var monthAge = 12 + monthNow -monthDob;
  }

  if (dateNow >= dateDob)
    var dateAge = dateNow - dateDob;
  else {
    monthAge--;
    var dateAge = 31 + dateNow - dateDob;

    if (monthAge < 0) {
      monthAge = 11;
      yearAge--;
    }
  }
  age = {years: yearAge,months: monthAge,days: dateAge};
  if ( age.years > 1 ) yearString = " years";
  else yearString = " year";
  if ( age.months> 1 ) monthString = " months";
  else monthString = " month";
  if ( age.days > 1 ) dayString = " days";
  else dayString = " day";
  if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.years;
  else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
    ageString = "Only " + age.days + dayString + " old!";
  else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
    ageString = age.years + yearString + " old. Happy Birthday!!";
  else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.years;
  else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.months + monthString + " and " + age.days + dayString + " old.";
  else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
    ageString = age.years;
  else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.months + monthString + " old.";
  else ageString = "Oops! Could not calculate age!";
	
	$('#year_dob').val(age.years);
	$('#month_dob').val(age.months);
	$('#date_dob').val(age.days);
	return ageString;
}
//Date Format
function formatDate(date) 
{
     var d = new Date(date),
     month = '' + (d.getMonth() + 1),
     day = '' + d.getDate(),
     year = d.getFullYear();
	 
     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

     return [day, month, year].join('-');
 }
   function formatDate2(date) 
{
     var d = new Date(date),
     month = '' + (d.getHours() + 1),
     day = '' + d.getMinutes(),
     year = d.getSeconds();
	 
     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

     return [month,day, year].join(':');
 }
 
 function formatDate1(date) 
{
     var d = new Date(date),
     month = '' + (d.getMonth() + 1),
     day = '' + d.getDate(),
     year = d.getFullYear();
	 
     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

     return [month,day, year].join('/');
 }
 
 function EmptyESC(data,event)
 {
 	if(data.value === '' || event.keyCode === 27)
	{
		$('#inregistration-name_initial').val('');
		$('#inregistration-patient_name').val('');
		$('#inregistration-dob').val('');
		$('#inregistration-sex').val('');
		$('#inregistration-marital_status').val('');
		$('#inregistration-relation_suffix').val('');
		$('#inregistration-relative_name').val('');
		$('#inregistration-address').val('');
		$('#inregistration-city').val('');
		$('#inregistration-district').val('');
		$('#inregistration-state').val('');
		$('#inregistration-pincode').val('');
		$('#inregistration-phone_no').val('');
		$('#inregistration-mobile_no').val('');
		$('#inregistration-mr_no').val('');
	}
 }
</script>	

  <script type="text/javascript"> 
    
        $(document).ready(function() {
			
			
			$("body").on('click', '.patient_fetch_details', function ()
    		{
				$modal = $('#patient_details');
	   			$modal.modal('show');  
			});
		});
		 
		jQuery('#tree').jqGrid({
				url:"<?php echo Yii::$app->homeUrl . '?r=in-registration/jqgrid'; ?>",
				 
				 colNames: ['mr_no', 'patientname', "par_relationname", "pat_mobileno"],
				 colModel:[
					{
						"name":"mr_no",
						"index":"mr_no",
						"sorttype":"int",
						"id":"mr",
						//"key":true,
						//"hidden":true,
						"label":"MR No",
						"width":50
					},{
						"name":"patientname",
						"index":"patientname",
						"id":"patientname1",
						"sorttype":"string",
						"label":"Patient Name",
						"width":170
					},{
						"name":"par_relationname",
						"index":"par_relationname",
						"id":"par_relationname1",
						"sorttype":"string",
						"label":"Relation Name",
						"width":170
					},{
						"name":"pat_mobileno",
						"index":"pat_mobileno",
						"id":"pat_mobileno1",
						"sorttype":"string",
						"label":"Mobile No",
						"width":170
					}
				],
				"width":"780",
				"hoverrows":false,
				"viewrecords":false,
				"gridview":true,
				"height":"auto",
				"sortname":"lft",
				"loadonce":true,
				"rowNum":100,
				"scrollrows":true,
				// enable tree grid
				"treeGrid":true,
				// which column is expandable
				"ExpandColumn":"name",
				// datatype
				"treedatatype":"json",
				// the model used
				"treeGridModel":"nested",
				// configuration of the data comming from server
				"treeReader":{
					"left_field":"lft",
					"right_field":"rgt",
					"level_field":"level",
					"leaf_field":"isLeaf",
					"expanded_field":"expanded",
					"loaded":"loaded",
					"icon_field":"icon"
				},
				"sortorder":"asc",
				"datatype":"json",
				"pager":"#pager",
				rowNum: 20
               // pager: "#jqGridPager"
			}); 
			$("#tree").jqGrid('filterToolbar', { searchOnEnter: false, stringResult: true, defaultSearch:   "cn" });
	 
function Patientdetailsprint()
 {
 	
	var mrnumber=$("#inregistration-mr_no").val();
	if(mrnumber==""){
		Alertment('Invalid MR NUMBER');		
	}else{
		$.ajax({
        type: "POST",
        url: "<?php echo Yii::$app->homeUrl . "?r=in-registration/patient-print&id=";?>"+mrnumber,
        success: function (result) 
        { 
        	var url = "<?php echo Yii::$app->homeUrl . "?r=in-registration/patient-print&id=";?>"+mrnumber;
        	window.open(url,'_blank');
         }
    	});
	}
 }
function Patienttypemodule(){
	if($('#inregistration-type').val()=="3"){
		$(".ogs_name").css("display", "block");
	}else{
		$(".ogs_name").css("display", "none");
	}
}
function Alertment(message)
{
	$.alert({
    		title: 'Alert!',
    		content: message,
    		type: 'red',
    		theme: 'material',
    		escapeKey: true,
    		backgroundDismiss: true,
    		typeAnimated: true,
		});
}
    </script>
  
