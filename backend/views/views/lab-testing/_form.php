<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\LabTesting */ 
/* @var $form yii\widgets\ActiveForm */ 

?>
<?php  $form = ActiveForm::begin(['id'=>"labtesting"]); ?>
<div class="section-cat">
	<div class="category-pannel row">
<div class="lab-testing-form">

    <div class="row"> 	
	<div class="col-sm-3"> 
		
		
			 <?php if($model->isNewRecord){  ?>
		 <?php 
     
     echo $form->field($catmodel, 'category_name')->dropDownList($catgorylist,['prompt'=>'--Select Category--','data-live-search'=>'true','class'=>'form-control selectpicker tabind','data-style'=>'btn-default btn-custom', 'onchange'=>'
                                                    $.get( "'.Url::toRoute('getsubcategory').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                        	
															$("#labsubcategorysearch-lab_subcategory").html(data);	
                                                              $("#labsubcategorysearch-lab_subcategory").selectpicker("refresh");                                            
                                                        }
                                                    );'])->label('Select Category');?>
		
			 <?php }else{ ?>
			 	
			 	
			 	 <?php 
     
     echo $form->field($model, 'cat_id')->dropDownList($catgorylist,['prompt'=>'--Select Category--','data-live-search'=>'true','class'=>'form-control selectpicker tabind','data-style'=>'btn-default btn-custom', 'onchange'=>'
                                                    $.get( "'.Url::toRoute('getsubcategory').'", { id: $(this).val() } )
                                                        .done(function( data ) {
                                                        	
															$("#labsubcategorysearch-lab_subcategory").html(data);	
                                                              $("#labsubcategorysearch-lab_subcategory").selectpicker("refresh");                                            
                                                        }
                                                    );'])->label('Select Category');?>
			 	
			 	
			 	<?php } ?>
	
   	</div>
   	<div class="col-sm-3">
			 <?php if($model->isNewRecord){  ?>
 				<?= $form->field($subcatmodel, 'lab_subcategory')->dropdownlist([],['prompt'=>'Select Sub Category','class'=>'selectpicker', 'data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'required' => true])->label('Select Subcategory') ?>   	
			<?php }else{ ?>
					<?= $form->field($model, 'subcat_id')->dropdownlist($subcatgorylist,['prompt'=>'Select Sub Category','class'=>'selectpicker', 'data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'required' => true])->label('Select Subcategory') ?>  
    		<?php } ?>
	</div>
	<div class="col-sm-3">
			
			<?php if($model->isNewRecord){  ?>
				<?= $form->field($unitmodel, 'unit_name')->dropdownlist($unitlist,['prompt'=>'Select unit','class'=>'selectpicker', 'data-live-search'=>'true',
    		 		'data-style'=>"btn-default btn-custom1",'required' => true])->label('Select Unit') ?>
   			<?php }else{ ?>
   				<?= $form->field($model, 'unit_id')->dropdownlist($unitlist,['prompt'=>'Select unit','class'=>'selectpicker', 'data-live-search'=>'true',
    		 		'data-style'=>"btn-default btn-custom1",'required' => true])->label('Select Unit') ?>
   			<?php }?>
   				
    </div>
	</div>
	<div class="row">
		<div class="col-sm-3">
				<?= $form->field($model, 'test_name')->textInput(['maxlength' => true,'required' => true]) ?>
					<Span class="test_msg_price" style="color:red"></span>		
		</div>
		<div class="col-sm-3">
			<?= $form->field($model, 'price')->textInput(['maxlength' => true,'required' => true])->label('Price') ?>
			<Span class="test_msg_alert" style="color:red"></span>
		</div>	
		<div class="col-sm-3">
		 	
    		<?= $form->field($model, 'hsncode')->dropdownlist($tax_grouping,['prompt'=>'Select HSN CODE','class'=>'selectpicker', 'data-live-search'=>'true',
    		 'data-style'=>"btn-default btn-custom1",'required' => true])->label('HSN Code') ?>
    	</div>
    	<div class="col-sm-3" style="    position: relative;    top: 05px;">
    
       <?php 
     	if($model->isNewRecord){
     	$model->isactive = 1;
     	}?> 
    <?= $form->field($model, 'isactive', [
    'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px;'>{input}<label>Active</label></div>{error}",
])->checkbox([],false) ?>
		    <!-- <?= $form->field($model, 'isactive')->dropDownList([ 'A' => 'Active', 'I' => 'In Active', ], ['prompt' => '']) ?> -->
    </div>
   </div> 
  <div class="row">
		<div class="col-sm-2">
	<Label>Reference Value</label>
		</div>
		<div class="col-sm-3">
	 <button class="btn btn-primary btn-lg" id="myBtn" >
       ADD
    </button>
 </div> 
 </div>
 
 <div class="row refernce-content">
 		<div class="col-sm-12">
 	<table id="list1" class="list_val1" align="Center" border="1">
					<tr>
				
					  	<td>Reference Name</td>
					  	<td>Gender</td>
					  	<td>Age From</td>
					  	<td>Age To</td>
					  	<td>Range from </td>
					  	<td>Range To </td>
					  	<td>Action</td>
				</tr>
				<tr>
					<td><input type='text' id="idea" class="idea" name="idea" /></td>
					<td>
						<select name="gender" id="gender" class="refval bootstrap-select btn-group dropdown-toggle filter-option" >
						  <option value="">-- Select --</option>	
						  <option value="male">Male</option>
						  <option value="female">Female</option>
						  <option value="both">Both</option>
						</select
						</td>
					<td><input type='text' id="age" class="age" name="age"  /></td>
					<td><input type='text' id="range" class="range" name="range"  /></td>
					<td><input type='text' id="range_from" class="range_from" name="range_from"  /></td>
					<td><input type='text' id="range_to" class="range_to" name="range_to"  /></td>
					<td>	<input type='button' class="btn btn-success" value = ' +' id = 'adddata'></td>
				</tr>
				</table>
				
					<div class="alert_msg" style="color:red"></div>
					  <table id="list" class="list_val" align="Center">
					  	<tr>
					  		
					  	<td>Reference Name</td>
					  	<td>Gender</td>
					  	 	<td>Age From</td>
					  	<td>Age To</td>
					  	<td>Range from </td>
					  	<td>Range To </td>
					  	<td>Action</td>
					  	</tr>
			
    <?php  $i=1;
    if(!empty($refmodel)){ //echo "<pre>"; print_r($refmodel); die;
    	 foreach ($refmodel as $key => $value) {
	 		?>
	 		<tr>
	 			
	 			<td><?php echo $value ->reference_name ?><input type="hidden" id="hid_ref_name<?php echo $i;?>" name="hid_ref_name[]" value="<?php echo $value ->reference_name ?>">	</td>	
	 			<td><?php echo $value ->gender ?>	<input type="hidden" id="hid_ref_gen<?php echo $i;?>" name="hid_ref_gen[]" value="<?php echo $value ->gender ?>"></td>
	 			<td><?php echo $value ->age ?>	<input type="hidden" id="hid_ref_age<?php echo $i;?>" name="hid_ref_age[]" value="<?php echo $value ->age ?>"></td>
	 			<td><?php echo $value ->range ?> <input type="hidden" id="hid_ref_range<?php echo $i;?>" name="hid_ref_range[]" value="<?php echo $value ->range ?>">	</td>
	 			<td><?php echo $value ->ref_from ?>	<input type="hidden" id="hid_ref_from<?php echo $i;?>" name="hid_ref_from[]" value="<?php echo $value ->ref_from ?>"></td>
	 			<td><?php echo $value ->ref_to ?>	<input type="hidden" id="hid_ref_to<?php echo $i;?>" name="hid_ref_to[]" value="<?php echo $value ->ref_to ?>"></td>
	 			<td><span class="remove_li" data-toggle="tooltip" title="Remove">X</span>	</td>
	 		</tr>	 
		<?php  $i++;}
    	}else{ ?>
    		<tr class="noresult">
	 			<td colspan='8' class="noresult" > No Records	</td>
	 		</tr>
     <?php	}
    	?>
    </table> 
			   </div>
 </div></div>
   <div class="row">
    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success savecategory' : 'btn btn-primary updatecategory']) ?>
    
     <span id="loadtex" style="display: none; "></span>
     </div>
    

<!-- Modal -->
<!-- <div class="modal " id="myModal123" tabindex="0" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Reference Value Option 
            </div>
            <div class="modal-body">
             
				<table id="list1" class="list_val1" align="Center" border="1">
					<tr>
					
					  	<td>Reference Name</td>
					  	<td>Gender</td>
					  	<td>Age</td>
					  	<td>Range Value</td>
					  	<td>Range from </td>
					  	<td>Range To </td>
					  	<td>Action</td>
					<td>	</td>
				</tr>
				<tr>
					<td><input type='text' id="idea" class="idea" name="idea" /></td>
					<td><input type='text' id="refval" class="refval" name="refval" /></td>
					<td><input type='text' id="gender" class="refval" name="refval" /></td>
					<td><input type='text' id="age" class="age" name="age" /></td>
					<td><input type='text' id="range_from" class="range_from" name="range_from" /></td>
					<td><input type='text' id="range_to" class="range_to" name="range_to" /></td>
					<td>	<input type='button' class="btn btn-success" value = 'Add +' id = 'adddata'></td>
				</tr>
				</table>
				
					<div class="alert_msg" style="color:red"></div>
					  <table id="list" class="list_val" align="Center">
					  	<tr>
					  	<td>S.NO</td>
					  	<td>Reference Name</td>
					  	<td>Gender</td>
					  	<td>Age</td>
					  	<td>Range Value</td>
					  	<td>Range from </td>
					  	<td>Range To </td>
					  	<td>Action</td>
					  	</tr>
					  </table> 
			   </div>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div> -->
   

</div></div>
	</div>
 <?php ActiveForm::end(); ?>
<style>
input#adddata {
    width: 34px;
}
.row.refernce-content {
    margin-top: 50px;
}
.refernce-content input {
    width: 130px;
}
table#list tbody tr:nth-child(odd) td {
    background: #e2e2e2 !important;
 }
table#list tbody>tr:first-child td {
    background: #ff8f8f !important;
    color: #ffff;
}
button#myBtn{display:none;}
.lab-testing-update .refernce-content{display:block}

.modal .modal-dialog .modal-content .modal-footer{    border: none;}
button#myBtn {
    padding: 5px 10px;
    font-size: 14px;
}
table#list1, table#list {
    width: 100%;
    text-align: center;     margin-bottom: 25px;
}
table#list1 td,table#list td {
    padding: 7px 7px;
}
.modal .modal-dialog .modal-content .modal-body{
	margin-top: 20px;
}
span.remove_li {
    cursor: pointer;
    background: #f00;
    padding: 4px 8px;
    border-radius: 6px;
    color: #fff;
}
table#list,table#list td {
    border: 1px solid #b5b5b5;
    background: #efefef;
}
table#list1 {
    border: 1px solid #dadada;
}
</style>
<script>
	$(document).ready(function () {

     // Attach Button click event listener 
    $("#myBtn").click(function(){
    	
    	var testname=$("input#labtestingsearch-test_name").val();
    	var testprice=$("input#labtestingsearch-price").val();
    	
    	if(testname=="" || testprice==""){
    		if(testname == ""){
    			 $(".test_msg_alert").html('Required');
    		}
    		if(testprice==""){
    			$(".test_msg_price").html('Required');
    		}
    	}else{
    		//$('#myModal123').modal('show');	
    		  $(".refernce-content").css("display","block");
    	}
		
		return false;
    });
    
    $(document).ready(function() {

     var $fs='<?php echo $i; ?>';
    $('#adddata').click(function(){ 
	    var text = $("#idea").val();
	    $(".noresult").css("display","none");
	    var refgen = $("#gender").val();
	    var refage = $("#age").val();
	    var refrange = $("#range").val();
	    var reffrom = $("#range_from").val();
	    var refto = $("#range_to").val();
	    
	    if(text!=""){
	    //$fa='<input type="hidden" id="hid_val'+$fs+'" name="hid_ref_val[]" value="'+refval+'" >';
	    $fa_val='<input type="hidden" id="hid_ref_name'+$fs+'" name="hid_ref_name[]" value="'+text+'" >';
	    $fa_gen='<input type="hidden" id="hid_ref_gen'+$fs+'" name="hid_ref_gen[]" value="'+refgen+'" >';
	    $fa_age='<input type="hidden" id="hid_ref_age'+$fs+'" name="hid_ref_age[]" value="'+refage+'" >';
	    $fa_range='<input type="hidden" id="hid_ref_range'+$fs+'" name="hid_ref_range[]" value="'+refrange+'" >';
	    $fa_ran_from='<input type="hidden" id="hid_ref_from'+$fs+'" name="hid_ref_from[]" value="'+reffrom+'" >';
	    $fa_ran_to='<input type="hidden" id="hid_ref_to'+$fs+'" name="hid_ref_to[]" value="'+refto+'" >';
	    
	    $cls='<span class="remove_li" data-toggle="tooltip" title="Remove">X</span>';	    
	    var li = "<tr><td>"+ text +$fa_val+ " </td><td>"+refgen+$fa_gen+ "</td><td>"+refage+$fa_age+ " </td><td>"+refrange+$fa_range+ " </td><td>"+reffrom+$fa_ran_from+ " </td><td>"+refto+$fa_ran_to+ " </td><td>" + $cls +"</td></tr>";  //alert(li);

	    $(".list_val").append(li); 
	   	 $fs++; $( "#idea" ).focus();
	      document.getElementById('idea').value = "";
	    document.getElementById('gender').value = "";
	    document.getElementById('age').value = "";
	    document.getElementById('range').value = "";
	    document.getElementById('range_from').value = "";
	    document.getElementById('range_to').value = "";
	   
	    }else{
	    	  document.getElementById('idea').value = "";
	      document.getElementById('idea').value = "";
	    document.getElementById('gender').value = "";
	    document.getElementById('age').value = "";
	    document.getElementById('range').value = "";
	    document.getElementById('range_from').value = "";
	    document.getElementById('range_to').value = "";
	    
			$(".alert_msg").html("Required");
			$( "#idea" ).focus();
	    	//alert('');
	    }
	});
    
   $('body').on('click','.remove_li', function(){ 	
    	$(this).closest('tr').remove();
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
});

	$('#labtesting-form').on('beforeSubmit', function(e) {
		
	$("#load").show();
    $(".savecategory").attr('disabled','disabled');
    var form = $(this);
    var formData = form.serialize();
    
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
        $("#load").hide(4);
	    	$("#loadtex").text("Successfully Saved.");
			$("#loadtex").css('color','green ');
	  		$("#loadtex").show(4);
	    
        },
       
    });
}).on('submit', function(e){
    e.preventDefault();
});
	

	

</script>
 
