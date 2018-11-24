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
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Url::base(); ?>/jq_grid/css/datatables.min.css" />  

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
    height: 46px;
    min-height: 30px;
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
	   
	<div class=" ">
		  <div class=" ">
		     <div class="c panel panel-border ">
			     
	            <div class="panel-body"> 
	                 <div class="row">
					    <div class="col-sm-12">					    							
						 
							<div class="col-md-1">
			
		</div>

		 
		<div class="col-md-1" >
			<span>Search By </span>
		</div>
		<div class="col-md-1">
		</div>
		<div class="col-md-1" style="width: 7.333333%;">
			<span>MR NO</span>
		</div>
		<div class="col-md-3">
			<?= $form->field($model, 'mr_no')->textInput(['class'=>'mrnumber form-control cus-fld number','autocomplete'=>"off",'maxlength' => true,'onkeyup'=>'EmptyESC(this,event);','required'=> true])
			->label(false) ?>
			<span class="input-group-btn">
				<button type="button" class="btn btn-default btn-flat btn  patient_fetch_details "><i class="ssearch glyphicon glyphicon-search"></i></button>
			</span>
		</div>
		<div class="col-md-1" style="width: 4.333333%;">
			<span>IPNO</span>
		</div>
		<div class="col-md-1">
			<?= $form->field($model, 'ip_no')->textInput()->label(false) ?>
		</div>
		<div class="col-md-1" style="width: 2.333333%;">
		</div>
		<div class="col-md-1" style="width: 7.333333%;">
			<span>Bed No</span>
		</div>
		<div class="col-md-2" style="width: 9.5%">
				<?= $form->field($model, 'bed_no')->textInput(['maxlength' => true,'required'=> true])->label(false) ?>
			<!-- <span class="btn " onmousedown="Patient_bed()"><i class="ssearch glyphicon glyphicon-search"></i></span> -->
		</div>
		<div class="col-md-1">
		</div>
						
						</div>
 
						
					 </div>
				</div>
			  </div>
			</div>

			
			 <div class="row">
<div class="col-sm-5">
   <div class="c panel panel-border panel-custom">
      <div class="panel-heading">
         <!-- <h5 class="box-title"><strong>Room Details</strong></h5>  -->
      </div>
      <div class="panel-body">
         <div class="row">
            <div class="form-group">
               <label class="control-label">Search by Patient Name</label>
               <?= $form->field($model, 'patient_name')->textInput(['required'=> true])->label(false) ?>
            </div>
            <div class="form-group">
              <label class="control-label">Husb / Father Name</label>
               <?= $form->field($model, 'relative_name')->textInput(['required'=> true])->label(false) ?>
            </div>
            <div class="form-group">
               <div class="row">
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label class="control-label" for="newpatient-pat_age">YEAR</label>
                        <input type="text" placeholder="YYYY" name="year_dob" readonly="readonly" id="year_dob" class="form-control year_dob">  
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label class="control-label" for="newpatient-pat_age">MONTH</label>
                        <input type="text" placeholder="MM" name="month_dob" readonly="readonly" id="month_dob" class="form-control month_dob"> 
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group ">
                        <label class="control-label" for="newpatient-pat_age">DATE</label>
                        <input type="text" placeholder="DD" name="date_dob" readonly="readonly" id="date_dob" class="form-control date_dob"> 
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label">Marital Status</label>
               <?= $form->field($model, 'marital_status')->dropDownList([ 'Married' => 'Married', 'Unmarried' => 'Unmarried','Widow'=>'Widow'], ['class' => '  form-control w-cus ','required'=> true,'tabindex'=>338,'required'=> true])->label(false) ?>
            </div>
         </div>
      </div>
   </div>
</div>
 
<div class="col-sm-5">
   <div class="c panel panel-border panel-custom">
      <div class="panel-heading">
         <!-- <h5 class="box-title"><strong>Room Details</strong></h5>  -->
      </div>
      <div class="panel-body">
         <div class="row">
            <div class="form-group">
              <label class="control-label">Address</label>
              <?= $form->field($model, 'address')->textarea(['rows' => 1,'required' => true,'class' => 'form-control txtaddress'])->label(false) ?>	
            </div>
            <div class="form-group">
            	<div class="row">
            	<div class="col-sm-6">
              <label class="control-label">Phone Number1</label>
               <?= $form->field($model, 'phone_no')->textInput(['required' => true])->label(false) ?></div>
           
                <div class="col-sm-6">
              <label class="control-label">Phone Number2</label>
              <?= $form->field($model, 'mobile_no')->textInput(['required' => true])->label(false) ?>	</div>
          </div>
            </div>
   
            <div class="form-group">
              <label class="control-label">Patient Type</label>
              <?= $form->field($model, 'patient_type')->dropDownList([ 'opd' => 'OPD','ipd' => 'IPD'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true])->label(false) ?>	
            </div>
         </div>
      </div>
   </div>
</div>
 		 
			  
 
				 <div class="col-sm-2">
		     <div class="c panel panel-border panel-custom"  >
			    <div class="panel-heading" hidden>
			        <h5 class="box-title">   </h5> 
		        </div>  
	            <div class="panel-body"  >
				   <div class="row">
				     <div class="col-sm-12">
					   <div class="row">
					      <div class="form-group"> 
    	                    <button type="button" class="btn btn-success b-width" id='saves_sucess' onclick="SaveIPForm();">Save</button>
    	                    <span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     	<span id="loadtexts" style="display: none; "></span>
						  </div>
						 </div><br>

						 <div class="row">

						   <div class="form-group">						 
							<button type="button" class="btn btn-info b-width" id='print_sucess' onclick="Patientdetailsprint();"> Patient Details</button>
						   </div>
                         </div><br>


						 <div class="row">

						   <div class="form-group">						 
							<button type="button" class="btn  btn-warning b-width" onclick='Refresh()'>Refresh</button> 
						   </div>
                         </div><br>
						 <div class="row">
                           <div class="form-group">
    	                    <button type='reset' class="btn inp btn-default b-width"  onclick='clearForm();'>Clear</button> 
                           </div>
						   
						 </div>
							 
						  <br>
						<div class="row">
						  <div class="form-group">
						     <a href="<?php  echo Yii::$app->request->BaseUrl;?>/index.php?r=in-registration/index" class="btn btn-bk btn-default b-width " Title="BACK To Grid">Back to Grid </a> 
 </div>
				        </div>
                         </div>
					 </div>
				   </div>
				  
		        </div>
		     </div>
		   </div> 
		 </div>
 

<?php ActiveForm::end(); ?>
 
<div id="patient_details" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Patient Details</h4>
      </div>
      <div class="modal-body">
      	<div class="" id="patient_history_report">
      
      <table id="reg_table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>MR Number</th>
                <th>Patient name</th>
                <th>Relation Name</th>
                <th>Mobile Number</th>
            </tr>
        </thead>
        
    </table>		
		</div>
      </div>
      <div class="inp modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>   
</div>

 <div id="load1" style='display:none;text-align: center;'><img  class="load-image"  src="<?= Url::to('@web/loader1.gif') ?>" /></div> <div class="row">  
    <div class="col-md-12 hide">
       	<?php 
     	if($model->isNewRecord){$model->is_active = 1;	}?> 
     		<?= $form->field($model, 'is_active', [
    		'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
			])->checkbox([],false) ?>
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
	if(valid == true)
	{

		if (confirm('Are You Sure to Save ?')) {
		$.ajax({
	            type: "POST",
	            url: "<?php echo Yii::$app->homeUrl . "?r=in-registration/create";?>",
	            data: $("#w0").serialize(),
	            success: function (result) 
	            { 
	            	
	            	
	            }
			});
	}
		
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
					$('#inregistration-dob').val((data['dob']));
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
  var now = new Date();
  var today = new Date(now.getYear(),now.getMonth(),now.getDate());
  var yearNow = now.getYear();
  var monthNow = now.getMonth();
  var dateNow = now.getDate();
  var dateString=formatDate1(data['dob']);	
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
    ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString + " old.";
  else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
    ageString = "Only " + age.days + dayString + " old!";
  else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
    ageString = age.years + yearString + " old. Happy Birthday!!";
  else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.years + yearString + " and " + age.months + monthString + " old.";
  else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.months + monthString + " and " + age.days + dayString + " old.";
  else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
    ageString = age.years + yearString + " and " + age.days + dayString + " old.";
  else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.months + monthString + " old.";
  else ageString = "Oops! Could not calculate age!";
	
	$('#year_dob').val(age.years);
	$('#month_dob').val(age.months);
	$('#date_dob').val(age.days);
	  			}
	  		})
	  }
});


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
			jtable_pd();
			
			$("body").on('click', '.patient_fetch_details', function ()
    		{
				$modal = $('#patient_details');
	   			$modal.modal('show');  
			});
		});
		 
	
function PatientDetailsFetch(data)
{
	
	
	$.ajax({
        type: "POST",
        
        url:'<?php echo Yii::$app->homeUrl . "?r=in-registration/ajaxpatientinfo&id=";?>'+data,
        success: function (data1) 
        { 
        	
        	var data = $.parseJSON(data1);
        			$('#inregistration-name_initial').val(data['name_initial']);
					$('#inregistration-patient_name').val(data['patient_name']);
					$('#inregistration-mr_no').val((data['mr_no']));
					$('#inregistration-dob').val((data['dob']));
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
        	
        
        	
        	$modal = $('#patient_details');
        	$modal.modal('hide');
        }
	});
}	 
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
$("body").on('click', '.patient_fetch_details', function ()
{
	$modal = $('#patient_details');
	$modal.modal('show');
	setTimeout(function(){ 
	var table_as = $("#reg_table").DataTable();
	table_as.ajax.reload( function (json) {table_as.cell( ':eq(0)' ).focus();} );}, 1000);
});
function jtable_pd(){
  var url=('<?php echo Url::base('http'); ?>');
  var ajax_url=url+'/index.php?r=in-registration/jqgrid';
  var table_reg= $('#reg_table').DataTable( {
        "processing": true,
        "serverSide": true,
         "ajax": {
        	"url": ajax_url,
        	 "type": "POST"
        	},
        	keys: {
           		keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */ ]
        	},
        	"columns": [
            { "data": "mrno","defaultContent": '<input type="text" value="0" />' },
            { "data": "pname","defaultContent": "NA" },
            { "data": "rname","defaultContent":"NA" },
            { "data": "mno","defaultContent": '<input type="text" value="0" />'  },
        	],
        initComplete: function() {
		   this.api().row( {order: 'current' }, 0).select();
 
		}
    });
   $('#reg_table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      //  table_reg.row(cell.index().row).select();
      //  $('#reg_table_filter input').val("");
         $('#reg_table_filter input').focus();
    });
  $('#reg_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
        
       
        var table_as = $("#reg_table").DataTable();
        if(key === 13){
        	
        	$('#reg_table thead').on( 'click', 'th', function () {
				  var columnData = table_as.column( this ).data();
  				alert(columnData);
				} );
    				
            var data_reg = table_as.row(cell.index().row).data();
			// var cell = table_reg.cell( this );
		    // alert(data_reg.join(','));             // FOR DEMONSTRATION ONLY
            // $("#example-console").html(data.join(', '));
            // $('#reg_table_filter input').val("");
          	 $('#reg_table_filter input').focus();
        }
    }); 
    
$('#reg_table').on( 'click', 'tr', function () {
    var data = table_reg.row( this ).id();
 	PatientDetailsFetch(data);
});

$('#reg_table').on('key.dt', function(e, datatable, key, cell, originalEvent){
     if(key === 13){
      // var id = table_reg.row(this).id();
        var data = table_reg.row(cell.index().row).id();
   		PatientDetailsFetch(data);
 	}
});    
    
}


    </script>
 
