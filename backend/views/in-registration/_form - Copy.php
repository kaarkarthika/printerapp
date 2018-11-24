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
  <div class="row patient_btn">
 	    <div class="form-group">
        <!--?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success physician' : 'btn btn-primary updatephysician']) ?-->
    	<button type="button" class="btn btn-success" id='saves_sucess' onclick="SaveIPForm();">Save</button>
    	<span id="loadphysician" style="display: none;"><img src="<?= Url::to('@web/loader.gif') ?>" />Loading...</span>
     	<span id="loadtexts" style="display: none; "></span>
    </div>

 </div>	   
<div class="row patient_details">
	<div class="col-md-3 ">
	<div class="head">
		<Span> Patient Details </span>
	</div>
		<?= $form->field($model, 'patient_type')->dropDownList([ 'opd' => 'OPD','ipd' => 'IPD'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true])->label('Patient Type') ?>
		<?= $form->field($model, 'registered')->dropDownList([ 'Booked' => 'Booked', 'UnBooked' => 'UnBooked'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true])->label('Registered') ?>
		<?= $form->field($model, 'panel_type')->dropDownList([ 'cash' => 'Cash', 'credit' => 'Credit'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true])->label('Panel Type') ?>
		<?= $form->field($model, 'mr_no')->textInput(['class'=>'mrnumber form-control cus-fld number','autocomplete'=>"off",'maxlength' => true,'onkeyup'=>'EmptyESC(this,event);','required'=> true]) ?>
		<span class="btn patient_fetch_details" type='button' ><i class="ssearch glyphicon glyphicon-search"></i></span>
		<!-- <?= $form->field($model, 'ip_no')->textInput() ?> -->
		<?= $form->field($model, 'name_initial')->dropDownList([ 'Mr' => 'Mr', 'Miss' => 'Miss','Baby' => 'Baby','Mrs' => 'Mrs','Master' => 'Master','Baby Of' => 'Baby Of','Empty' => 'Empty','Dr' => 'Dr','Ms.' => 'Ms.'],['class' => 'form-control col-sm-6 w-cus', 'style'=>' ', 'placeholder'=>'Name Inital','tabindex'=>332 ,'required'=> true,'onchange'=>'AutomaticInitial()'])->label('Inital') ?>
		<?= $form->field($model, 'patient_name')->textInput(['required'=> true]) ?>
		<div class="form-group">
		<?= $form->field($model, 'dob')->textInput(['class' => ' col-sm-6 form-control w-cus ' ,'placeholder'=>'DD-MM-YYYY','tabindex'=>334,'required'=> true])->label('DOB')?>
		<div class="dob">
			<input type="text" placeholder="YYYY" name="year_dob" readonly="readonly" id="year_dob" class="form-group year_dob" style="width:39px;" >year's
			<input type="text" placeholder="MM" name="month_dob" readonly="readonly" id="month_dob" class="form-group month_dob" style="width:48px;" >month
			<input type="text" placeholder="DD" name="date_dob" readonly="readonly" id="date_dob" class="form-group date_dob" style="width:39px;" >day
		</div>
		</div> <br/>
	    <?= $form->field($model, 'sex')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female'], ['class' => '  form-control w-cus','style'=>' ','tabindex'=>339,'required'=> true])->label('Gender') ?>
	    <?= $form->field($model, 'marital_status')->dropDownList([ 'Married' => 'Married', 'Unmarried' => 'Unmarried','Widow'=>'Widow'], ['class' => '  form-control w-cus ','required'=> true,'tabindex'=>338,'required'=> true])->label('Mar Stat') ?>
	</div>
	<div class="col-md-3 ">
		<?= $form->field($model, 'relation_suffix')->dropDownList([ 'S/O' => 'S/O', 'D/O' => 'D/O','W/O' => 'W/O','H/O'=>'H/O','C/O'=>'C/O','Empty'=>'Empty','Sis/O'=>'Sis/O','B/O'=>'B/O','M/O'=>'M/O','F/O'=>'F/O','Self'=>'Self'], ['class' => ' form-control col-sm-6 w-cus','style'=>' ','tabindex'=>336,'required'=> true,'onchange'=>'AutomaticRelation()'])->label('Relation') ?>
	    <?= $form->field($model, 'relative_name')->textInput(['required' => true]) ?>
	 	<?= $form->field($model, 'address')->textarea(['rows' => 1,'required' => true]) ?>		
 	    <?= $form->field($model, 'city')->textInput(['required' => true]) ?>
	    <?= $form->field($model, 'district')->textInput(['required' => true]) ?>
		<?= $form->field($model, 'state')->textInput(['required' => true]) ?>
		<?= $form->field($model, 'pincode')->textInput() ?>
		<?= $form->field($model, 'phone_no')->textInput() ?><br />
		<?= $form->field($model, 'mobile_no')->textInput(['required' => true]) ?>
		
  </div>
	<div class="col-md-3 ">
		<?= $form->field($model, 'country')->textInput() ?>
		<?= $form->field($model, 'religion')->textInput() ?>
		<?= $form->field($model, 'type')->dropDownList($patienttype, ['title'=>'Patient Type','class' => '  form-control w-cus','style'=>' ','tabindex'=>352,'required'=> true,'onchange'=>'Patienttypemodule(this.value);'])->label('Pat Type') ?>
		<div class="ogs_name" >
			<?= $form->field($model, 'refered_name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'ucil_from')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'ucil_to')->textInput(['maxlength' => true]) ?>
		</div>	
		<div class="head">
			<Span> Room Details </span>
		</div>
		<?= $form->field($model, 'paytype')->dropDownList(['Economy' => 'ECONOMY'], ['class' => '  form-control w-cus ','style'=>' ','tabindex'=>338,'required'=> true])->label('Pay Type') ?>
		<?= $form->field($model, 'bed_no')->textInput(['maxlength' => true,'required'=> true]) ?>
		<span class="btn " onmousedown="Patient_bed()"><i class="ssearch glyphicon glyphicon-search"></i></span>
			<?= $form->field($model, 'room_no')->textInput(['maxlength' => true,'required'=> true]) ?>
		<span class="btn "><i class="ssearch glyphicon glyphicon-search"></i></span>
		<?= $form->field($model, 'floor_no')->textInput(['maxlength' => true,'required'=> true]) ?>
		<?= $form->field($model, 'room_type')->textInput(['maxlength' => true,'required'=> true]) ?>
		<!--<input type="hidden" name="bedid" id="bedid"  >
		<input type="hidden" name="roomnoid" id="roomnoid" >
		<input type="hidden" name="roomtypeid" id="roomtypeid" >
		<input type="hidden" name="floorid" id="floorid" > -->
		<input type="hidden" name="bedid" id="bedid"  value="100">
		<input type="hidden" name="roomnoid" id="roomnoid"  value="400">
		<input type="hidden" name="roomtypeid" id="roomtypeid" value="300" >
		<input type="hidden" name="floorid" id="floorid" value="200" >
		
		
	</div>
	<div class="col-md-3">
		<div class="head" style="font-size: 12px;">
			<Span> Admission Under Doctor Details </span>
		</div>
		<!-- <?= $form->field($model, 'consultant_dr')->dropDownList($physicianmaster, ['class' => '  form-control w-cus','prompt'=>'-DoctorName-'  ,'style'=>' ','tabindex'=>360,'onblur'=>'Specialization(this.value);', 'onclick' => 'Specialization(this.value);','required'=>true])->label('Consultant') ?> -->
		<?= $form->field($model, 'consultant_dr')->dropDownList($physicianmaster, ['class' => '  form-control w-cus','prompt'=>'-DoctorName-'  ,'style'=>' ','tabindex'=>360,'required'=>true])->label('Consultant') ?>
		<span class="btn "><i class="ssearch glyphicon glyphicon-search"></i></span>
		<?= $form->field($model, 'dr_unit')->textInput(['maxlength' => true,'required'=> true]) ?>
		<span class="btn "><i class="ssearch glyphicon glyphicon-search"></i></span>
    	<?= $form->field($model, 'speciality')->textInput(['maxlength' => true,'required'=> true]) ?>
    	<span class="btn "><i class="ssearch glyphicon glyphicon-search"></i></span>
    	<?= $form->field($model, 'co_consultant')->textInput(['maxlength' => true]) ?>
    	<span class="btn "><i class="ssearch glyphicon glyphicon-search"></i></span>
    	
	</div>
</div>
    
<div id="load1" style='display:none;text-align: center;position: relative;'><img  style="width:15%;margin:auto;    position: absolute; left: 34%;top: 55px;z-index: 9999;"  src="<?= Url::to('@web/loader1.gif') ?>" /></div> <div class="row">  
    <div class="col-md-12 hide">
       	<?php 
     	if($model->isNewRecord){$model->is_active = 1;	}?> 
     		<?= $form->field($model, 'is_active', [
    		'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
			])->checkbox([],false) ?>
	</div>

    <!-- <?= $form->field($model, 'created_date')->textInput() ?>
    <?= $form->field($model, 'updated_date')->textInput() ?>
    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'userrole')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?>
    <label for="search_cells">
		Search Grid: 
	</label>
<input id="search_cells" name="filterInput" type="search"/>
	<table id="jqGrid"></table>
	<div id="jqGridPager"></div>  -->
    

<!--- Test -->

    
<!--- test end ------>



    <?php ActiveForm::end(); ?>
   
</div>
</div>





	<table id="example" class="table table-striped table-bordered nowrap display" style="width:100%">
				<thead>
				  <tr>
				  	<th>BED NO</th>
				    <th>ROOM NO</th>
				    <th>ROOM TYPES</th>
				    <th>BED CHARAGE</th>
				    
				    <!-- <th>Action</th> -->
				  </tr>
				</thead>
				<tbody id='set_patient_data'>
					<?php  if(!empty($bed_list)){
						foreach($bed_list as $bed_val) { 
						$room_list=InRoomno::find()->where(['is_active'=>1])->andWhere(['autoid'=>$bed_val['room_id']])->asArray()->one();
						$roomtype_list=InRoomtypes::find()->where(['is_active'=>1])->andWhere(['autoid'=>$room_list['roomtypeid']])->asArray()->one();
						$floor_list=InFloormaster::find()->where(['is_active'=>1])->andWhere(['autoid'=>$room_list['floorid']])->asArray()->one();
						//echo"<pre>";print_r($room_list);print_r($roomtype_list);print_r(); die;
					?>
					<tr id='<?php echo $bed_val['autoid']; ?>'>
						<td><?php echo $bed_val['bedno']; ?><input type="hidden" name="bedid" id="bedid<?php echo $bed_val['autoid']; ?>" value="<?php echo $bed_val['bedno']; ?>"></td>
						<td><?php echo $room_list['room_no']; ?><input type="hidden" name="roomid" id="roomid<?php echo $bed_val['autoid']; ?>" value="<?php echo $room_list['autoid']; ?>"></td>
						<td><?php echo $roomtype_list['room_types']; ?><input type="hidden" name="roomtypeid<?php echo $bed_val['autoid']; ?>" id="roomtypeid<?php echo $bed_val['autoid']; ?>" value="<?php echo $roomtype_list['autoid']; ?>"></td>
						<td><?php echo $roomtype_list['price']; ?><input type="hidden" name="floorid" id="floorid<?php echo $bed_val['autoid']; ?>" value="<?php echo $floor_list['autoid']; ?>"></td>
						
						<!-- <td><button type="button" class='btn btn-xs btn-success select_sub_visit' onclick="SubVisitFetch(<?php echo $value['sub_id']?>,<?php echo $value['mr_number']?>);" >Select</button></td> -->
					</tr>
				<?php } } ?>	
				</tbody>
		</table>


 <!--table id="example1" class="dataTable" style="width:100%">
        <thead>
            <tr>
                <th>MR Number</th>
                <th>Patient name</th>
                <th>Relarion Name</th>
                <th>Mobile Number</th>
                
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table-->

<div id="patient_hist-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header tmp-head">
        <button type="button" class="close tmp-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Patient Bed List</h4>
      </div>
      <div class="modal-body">
      	
      	
        <div class="" id="patient_history_report">
            	<table id="example1" class="table table-striped table-bordered nowrap display" style="width:100%">
				<thead>
				  <tr>
				  	<th>BED NO</th>
				    <th>ROOM NO</th>
				    <th>ROOM TYPES</th>
				    <th>BED CHARAGE</th>
				    
				    <!-- <th>Action</th> -->
				  </tr>
				</thead>
				<tbody id='set_patient_data'>
					<?php  if(!empty($bed_list)){
						foreach($bed_list as $bed_val) { 
						$room_list=InRoomno::find()->where(['is_active'=>1])->andWhere(['autoid'=>$bed_val['room_id']])->asArray()->one();
						$roomtype_list=InRoomtypes::find()->where(['is_active'=>1])->andWhere(['autoid'=>$room_list['roomtypeid']])->asArray()->one();
						$floor_list=InFloormaster::find()->where(['is_active'=>1])->andWhere(['autoid'=>$room_list['floorid']])->asArray()->one();
						//echo"<pre>";print_r($room_list);print_r($roomtype_list);print_r(); die;
					?>
					<tr id='<?php echo $bed_val['autoid']; ?>'>
						<td><?php echo $bed_val['bedno']; ?><input type="hidden" name="bedid" id="bedid<?php echo $bed_val['autoid']; ?>" value="<?php echo $bed_val['bedno']; ?>"></td>
						<td><?php echo $room_list['room_no']; ?><input type="hidden" name="roomid" id="roomid<?php echo $bed_val['autoid']; ?>" value="<?php echo $room_list['autoid']; ?>"></td>
						<td><?php echo $roomtype_list['room_types']; ?><input type="hidden" name="roomtypeid<?php echo $bed_val['autoid']; ?>" id="roomtypeid<?php echo $bed_val['autoid']; ?>" value="<?php echo $roomtype_list['autoid']; ?>"></td>
						<td><?php echo $roomtype_list['price']; ?><input type="hidden" name="floorid" id="floorid<?php echo $bed_val['autoid']; ?>" value="<?php echo $floor_list['autoid']; ?>"></td>
						
						<!-- <td><button type="button" class='btn btn-xs btn-success select_sub_visit' onclick="SubVisitFetch(<?php echo $value['sub_id']?>,<?php echo $value['mr_number']?>);" >Select</button></td> -->
					</tr>
				<?php } } ?>	
				</tbody>
				</table>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 	



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
            	<table id="tree"></table>
    			<div id="pager"></div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

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
	
	
	/* $('#example1').dataTable( {
    	"bProcessing": true,
    	"serverSide" : true,
    	"ajax":{
    		url :ajax_url,
    		type : "POST"
    	}
	} );
	*/
    	 
 /*    $('#example').on('key-focus.dt', function(e, datatable, cell){
        
        $(table.row(cell.index().row).node()).addClass('selected');
    });

    $('#example').on('key-blur.dt', function(e, datatable, cell){
        $(table.row(cell.index().row).node()).removeClass('selected');
    });
        
    $('#example').on('key.dt', function(e, datatable, key, cell, originalEvent){
        if(key === 13){
            var data = table.row(cell.index().row).data();
            $("#example-console").html(data.join(', '));
        }
    });       
 		
*/
    
    


 	/*("#example tbody tr").on("click", "td", function() {
     	var a=$(this).closest('tr').attr('id');
     	
     	
     	var tdval=$(this).closest('tr');
     	var bed_no=tdval.find("td:eq(0)").text();
     	var room_no=tdval.find("td:eq(1)").text();
     	var room_types=tdval.find("td:eq(2)").text();
     	var flor_no=tdval.find("td:eq(3)").text();
     	
     	//Prime Id
     	var bed_id=$('#bedid'+a).val();
     	var room_id=$('#roomid'+a).val();
     	var room_type=$('#roomtypeid'+a).val();
     	var flor_id=$('#floorid'+a).val();
     	
     	
     	
     	$('#inregistration-bed_no').val(bed_no);
     	$('#inregistration-room_no').val(room_no);
     	$('#inregistration-floor_no').val(flor_no);
     	$('#inregistration-room_type').val(room_types);
     	
     	$('#bedid').val(bed_id);
     	$('#roomnoid').val(room_id);
     	$('#roomtypeid').val(room_type);
     	$('#floorid').val(flor_id);
     	
     	
     	
     	$modal = $('#patient_hist-modal');
		$modal.modal('hide');
     	
  }); */
 	
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
	  			url:'<?php echo Yii::$app->homeUrl . "?r=in-registration/ajaxfetch";?>',
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
	  			url:'<?php echo Yii::$app->homeUrl . "?r=in-registration/ajaxsinglefetch&id=";?>'+result,
	  			method:'POST',
	  			dataType:'json',
	  			success:function(data)
	  			{   $('#load1').hide();
	  				$('#inregistration-name_initial').val(data['pat_inital_name']);
					$('#inregistration-patient_name').val(data['patientname']);
					$('#inregistration-dob').val((data['dob']));
					$('#inregistration-sex').val(data['pat_sex']);
					$('#inregistration-marital_status').val(data['pat_marital_status']);
					$('#inregistration-relation_suffix').val(data['pat_relation']);
					$('#inregistration-relative_name').val(data['par_relationname']);
					$('#inregistration-address').val(data['pat_address']);
					$('#inregistration-city').val(data['pat_city']);
					$('#inregistration-district').val(data['pat_distict']);
					$('#inregistration-state').val(data['pat_state']);
					$('#inregistration-pincode').val(data['pat_pincode']);
					$('#inregistration-phone_no').val(data['pat_phone']);
					$('#inregistration-mobile_no').val(data['pat_mobileno']);
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
			
	 //		var filter;
     //       $("#jqGrid").jqGrid({
				
    //            url: '<?php echo Yii::$app->homeUrl . '?r=in-registration/jqgrid'; ?>',
        /*        mtype: "GET",
                datatype: "json",
				colModel: [
                    {   label : "MR NO",
						//sorttype: 'integer',
						name: 'mr_no', id:'mr_no',
						key: true, 
						//width: 75 ,
						colmenu : true,
						searchoptions : {
							searchOperMenu : true,
							sopt : ['eq','gt','lt','ge','le']
						}
					},
                    {
						label : "Patient Name",
						//sorttype: 'integer',
						name: 'patientname', 
						key: true, 
					//	width: 75 ,
						colmenu : true,
						searchoptions : {
							searchOperMenu : true,
							sopt : ['eq','gt','lt','ge','le']
						}
                    },
                    { 
						label : "Relation Name",
						//sorttype: 'integer',
						name: 'par_relationname', 
						key: true, 
					//	width: 75 ,
						colmenu : true,
						searchoptions : {
							searchOperMenu : true,
							sopt : ['eq','gt','lt','ge','le']
						}
                    },                    
                    {
						label : "Mobile No",
						//sorttype: 'integer',
						name: 'pat_mobileno', 
						key: true, 
					//	width: 75 ,
						colmenu : true,
						searchoptions : {
							searchOperMenu : true,
							sopt : ['eq','gt','lt','ge','le']
						}
                    },
                   
                ],
				loadonce: true,
				viewrecords: true,
                width: 780,
                height: 250,
                rowNum: 10,
				colMenu : true,
				shrinkToFit : false,
                pager: "#jqGridPager"
            });
			// activate the toolbar searching
			$('#jqGrid').jqGrid('navGrid',"#jqGridPager", {                
                search: false, // show search button on the toolbar
                add: false,
                edit: false,
                del: false,
                refresh: true
            });
          $('#jqGrid').jqGrid('filterToolbar', { searchOnEnter: true, enableClear: false });
          $.noConflict();
			var timer;
			jQuery( document ).ready(function( $ ) {

			$("#search_cells").on("keyup", function() {
				var self = this;
				if(timer) { clearTimeout(timer); }
				timer = setTimeout(function(){
					//timer = null;
					//alert(self.value);
					$("#jqGrid").jqGrid('filterInput', self.value);
				},0);
			});
		}); 
   
 

  $("#search_cells").click(function() {
    var searchFiler = $("#search_cells").val(), grid = $("#jqGrid"), f;
	alert(searchFiler);
	alert(grid);

    if (searchFiler.length === 0) {
        grid[0].p.search = false;
        $.extend(grid[0].p.postData,{filters:""});
    }   
    	f = {groupOp:"OR",rules:[]};
    	f.rules.push({field:"mr_no",op:"cn",data:searchFiler});
    	f.rules.push({field:"patientname",op:"cn",data:searchFiler});
    	grid[0].p.search = true;
    	$.extend(grid[0].p.postData,{filters:JSON.stringify(f)});
    	grid.trigger("reloadGrid",[{page:1,current:true}]);
});
*/

function Patienttypemodule(){
	if($('#inregistration-type').val()=="3"){
		$(".ogs_name").css("display", "block");
	}else{
		$(".ogs_name").css("display", "none");
	}
}
    </script>
 
