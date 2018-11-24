<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Testgroup */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Test Grouping';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">
   <div class="row">
<div class="col-sm-12">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
						</div>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-border panel-custom">
<div class="panel-heading">

</div>
<div class="panel-body" style="height:600px;">
<div class="testgroup-form">

    <?php $form = ActiveForm::begin(['id'=>'testgroup-form']); ?>
 	<div class="row"> 	
		<div class="col-sm-3"> 
	<!-- <input type="hidden" name="auto_id" class="auto_id" value="<?php echo $autoid; ?>"> -->	
    <?= $form->field($model, 'testgroupname')->dropdownlist($testgrouplist,['prompt'=>'Select Category','class'=>'selectpicker testgroupname', 'data-live-search'=>'true',
     'data-style'=>"btn-default btn-custom1",'required' => true]); ?>
     	</div>
		<table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th style="text-align: center;">SNO</th>
        <th style="text-align: center;">Test Name</th>
        <th style="text-align: center;">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(!empty($test_list_tbl))
	  {
	  	$i++;
        foreach ($test_list_tbl as $key => $value) {
      ?>
      <tr><td style="text-align: center;"> <?php echo $i++;?></td>
      <td style="text-align: center;"> <?php echo $value['test_name'];?></td>
      <td style="text-align: center;"> <input type="checkbox" class="check_class" name="Checked[]" value="<?php echo $value['autoid'];?>"></td>
      </tr>
     
      <?php }} ?>
    </tbody>
  </table>
		
	<button type="submit" style="float: right;" class="btn btn-success " value="Submit">Submit</button>
	
   	</div>
	<?php ActiveForm::end(); ?>

</div>
</div>
</div>
</div>
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
/*	$('#testgroup-form').on('beforeSubmit', function(e) {
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
    });*/
</script>