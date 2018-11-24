<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Testgroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="testgroup-form">

    <?php $form = ActiveForm::begin(['id'=>'testgroup-form']); ?>
 <div class="row"> 	
	<div class="col-sm-2"> 
	<!-- <input type="hidden" name="auto_id" class="auto_id" value="<?php echo $autoid; ?>"> -->	
    <?= $form->field($model, 'testgroupname')->dropdownlist($testgrouplist,['prompt'=>'Select Category','class'=>'selectpicker testgroupname', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom1",'required' => true]); ?>
     	</div>
   	<div class="col-sm-2">
    <?= $form->field($model, 'price')->textInput(['required' => true]) ?>
    	</div>
    	<div class="col-sm-2">
		 	<?= $form->field($model, 'hsncode')->textInput(['maxlength' => true,'required' => true]) ?>
    		
    	</div>
   	<div class="col-sm-3">
    <?= $form->field($testingmodel, 'test_name')->dropdownlist($testlist,['prompt'=>'Select Category','class'=>'selectpicker', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom1",'required' => true]); ?>
   
    <!-- <?= $form->field($testingmodel, 'test_name')->dropdownlist([],['id'=>'autoid','title'=>'Select testname','data-live-search'=>'true','required'=>'true',
   'class'=>'selectpicker form-control','data-style'=>"btn-default btn-custom",'multiple'=>true,  'data-selected-text-format'=>'count > 2'
 	 ]); ?> -->
    	</div>
    		<div class="col-sm-3" style="top: 23px;">
    				<input type='button' class="btn btn-success" value = 'Add +' id = 'adddata'>
    			 <!-- <?= Html::Button('<i class="fa fa-fw fa-close"></i> Close', ['class' => 'btn btn-danger closez', 'data-dismiss'=>"modal" ,'aria-hidden'=>"true"]) ?> -->
    			<?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-fw fa-save"></i>Save' : '<i class="fa fa-fw fa-edit "></i>Update', ['class' => $model->isNewRecord ? 'btn btn-success savecategory' : 'btn btn-primary updatecategory']) ?>
   		</div>	
   	</div>
   	<div class="row test_group">
   		    <div class="modal-body">
             		  <table id="list" class="list_val table table-striped table-bordered detail-view" align="Center" >
             		  	 <thead>
					  	<tr>
					  	<td> Test Name</td>
					  	<td>Action</td>
					  	</tr>
					  	</thead>
					  </table> 
			 	</div>
        
   	</div>
     <span id="loadtex" style="display: none; "></span>

    <?php ActiveForm::end(); ?>

</div>
<style>
	.field-labtesting-test_name,.test_group,input#adddata{
		display:none;
	}
	input#adddata{		     float: left;    margin-right: 15px;	}
	table#list td {
    	    text-align: center;
	}
	table#list thead td {
    	background: #ff8888;
    	color: #fff;
	}
	table#list {
    	width: 40%;
    	margin: auto;
	}
	span.remove_li {
    cursor: pointer;
    background: #f00;
    padding: 4px 8px;
    border-radius: 6px;
    color: #fff;
}
</style>
<script>
	$('#testgroup-form').on('beforeSubmit', function(e) {
	$("#load").show();
    $(".savecategory").attr('disabled','disabled');
    var form = $(this);
    var formData = form.serialize();
    alert(form.attr("action"));
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

$( ".testgroupname" ).change(function() {  
  $(".field-labtesting-test_name").css("display","block");
  $("input#adddata").css("display","block");
  $("button.btn.dropdown-toggle.btn-default.btn-custom1").css("pointer-events", "none");
   $("button.btn.dropdown-toggle.bs-placeholder.btn-default.btn-custom1").css("pointer-events", "auto"); 
}); 
$( "input#testgroupsearch-price" ).change(function() {
	$('input#testgroupsearch-price').attr('readonly', true);
});
var $fs=1;
  $('#adddata').click(function(){ 
  	$(".test_group").css("display","block"); 
	    var text = $("select#labtesting-test_name").val();
		 if(text!=""){
	    $fa='<input type="hidden" id="hid_val'+$fs+'" name="hid_testname[]" value="'+text+'" >';
	    $cls='<span class="remove_li" data-toggle="tooltip" title="Remove">X</span>';	    
	    var li = "<tr><td>"+ text +$fa+ " </td><td>" + $cls +"</td></tr>";  // alert(li);
	    $(".list_val").append(li); 
	   	 $fs++; $( "select#labtesting-test_name" ).focus();
	      
	    }
	});
     $('body').on('click','.remove_li', function(){ 	
    	$(this).closest('tr').remove();
    });
</script>