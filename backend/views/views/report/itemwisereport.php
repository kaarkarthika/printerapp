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


$session = Yii::$app->session;
$this->title = Yii::t('app', 'Report List');

?>


<style>
.panel-border .panel-body form {
    height: 150px;
    width: 100% !important;
}
	.kv-editable-link{
		border-bottom: 0px !important;
	}
	.pagination{display:none;}
	  fieldset.scheduler-border {
    border: 1px solid #dee6e4 !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
   /* -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;*/
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
	.form-head{background-color: #5fbeaa;
    color: #fff;}
 .cus-fld{
height: 25px !important;
    margin-right: 15px;
    margin-bottom: 10px;
    padding: 0px 10px;
 }
	
</style>

</style>
	<div class="row">
<div class="col-sm-12">

<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
<ol class="breadcrumb">
 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
 <li><a href="#"><?php echo $this->title;?></a></li>
</ol>
</div>
</div>

<div class="container">
<div class="panel panel-border panel-inverse">
<div class="panel-heading"> </div>      
       <div class="panel-body" >
       	
       	      	<div class="container">  	
    <div class="row">
    <div class='col-md-12'>
    	<div class='col-md-12'>
    	
    	<?php $form = ActiveForm::begin(['action'=>['itemwise'],'options' =>['target'=>'_blank']]); ?>
	   <fieldset class="scheduler-border">
							<legend class="scheduler-border form-head ">Itemwise Purchase Report</legend>
<!-- <div class="panel-heading" style="border-top: 3px solid #5fbeaa!important;">Itemwise Purchase Report</div> -->      
       <div class=" " >
    <div class='col-md-2'>
    	
        <div class="form-group">
        	<label>From</label>
            <div class='input-group date' id='datetimepicker6'>
            	
                <input type='text' class="form-control cus-fld"  name="fromDate"   required>
                <span class="input-group-addon cus-fld">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-2'>
        <div class="form-group">
        	<label>To</label>
            <div class='input-group date' id='datetimepicker7' >
                <input type='text' class="form-control cus-fld" name="toDate" required>
                <span class="input-group-addon cus-fld">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
   
    <div class='col-md-1'>
	
    <?= Html::submitButton(' ', ['class' => 'btn btn-success btn-sm fa fa-print','style'=>'position:relative;top:20px','name'=>"Item_purchase","value"=>1,"data-toggle"=>"tooltip","title"=>"Item Purchase PDF"]) ?>
    </div>
    </div>
    
   
     
     
    
</fieldset>
<?php ActiveForm::end(); ?>
</div>
<div class='col-md-12'>
	
 <?php $form = ActiveForm::begin(['action'=>['userwise'],'options' =>['target'=>'_blank']]); ?>

 <fieldset class="scheduler-border">
							<legend class="scheduler-border form-head  ">Userwise Sales Report</legend>
	
    
    	
		
		
		
		 
<!-- <div class="panel-heading" style="border-top: 3px solid #5fbeaa!important;">Userwise Sales Report</div>       -->
       <div class=" " >
		<div class='col-md-3'>
    	
        <div class="form-group">
        	<label>From</label>
            <div class='input-group date' id='datetimepicker11'>
            	
                <input type='text' class="form-control cus-fld"  name="fromDate1"   required>
                <span class="input-group-addon cus-fld">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-3'>
        <div class="form-group">
        	<label>To</label>
            <div class='input-group date' id='datetimepicker12' >
                <input type='text' class="form-control cus-fld" name="toDate1" required>
                <span class="input-group-addon cus-fld">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    
    <div class='col-md-3'>
    	<label>User Name</label>
    <select id="user_idz" class="selectpicker " name="Username[id][]" multiple="" size="4" title="Select Product" required data-style="btn-default btn-custom cus-fld" data-live-search="true" aria-required="true" tabindex="-98" aria-invalid="false" >
    	
		<?php foreach($username as $key => $value ){ ?>
				<option value="<?php echo $key; ?>"><?php echo $value;?></option>	
		<?php } ?>
    	
    </select>
    </div>
    <div class='col-md-2'>
    <?= Html::submitButton('', ['class' => 'btn btn-success btn-sm fa fa-print','style'=>'position:relative;top:20px','name'=>"User_wise_report","value"=>2,"data-toggle"=>"tooltip","title"=>"User wise Report PDF"]) ?>
    </div>
    </div>  
   
	</fieldset>
	 <?php ActiveForm::end(); ?>
	</div>
	<div class='col-md-12'>
	
	  <?php $form = ActiveForm::begin(['action'=>['itemwisesale'],'options' =>['target'=>'_blank']]); ?>
	 <fieldset class="scheduler-border">
							<legend class="scheduler-border form-head ">Itemwise Sales Report</legend>
   
    <div class=' '>
	
	 
<!-- <div class="panel-heading" style="border-top: 3px solid #5fbeaa!important;">Itemwise Sales Report</div>       -->
       <div class=" " >
    	<div class='col-md-3'>
    	
        <div class="form-group">
        	<label>From</label>
            <div class='input-group date' id='datetimepicker13'>
            	
                <input type='text' class="form-control cus-fld"  name="fromDate2"   required>
                <span class="input-group-addon cus-fld">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-3'>
        <div class="form-group">
        	<label>To</label>
            <div class='input-group date' id='datetimepicker14' >
                <input type='text' class="form-control cus-fld" name="toDate2" required>
                <span class="input-group-addon cus-fld">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
     
    <div class='col-md-3'>
    <?= Html::submitButton('', ['class' => 'btn btn-success btn-sm fa fa-print','style'=>'position:relative;top:20px','name'=>"Supplier_wise_report","value"=>3,"data-toggle"=>"tooltip","title"=>"Item Sale PDF"]) ?>
    </div>
    </div>
     
    </div>
   



   
   
    </fieldset>
     <?php ActiveForm::end(); ?>
    </div>
    <div class='col-md-6'>
      <?php $form = ActiveForm::begin(['action'=>['pricelistpdf'],'options' =>['target'=>'_blank']]); ?>
    
	 <fieldset class="scheduler-border col-sm-12">
							<legend class="scheduler-border form-head ">Medicine wise Report </legend>
    
    
    
    
     <div class='col-md-8'>
    <label>Branch Name</label>		
	<select id="branch_name" class="form-control selectpicker " name="Branch[branchnamepricelist]" data-style="btn-default btn-custom cus-fld" data-live-search="true" aria-required="true" tabindex="-98"  required>
		<option value="">--Select Item--</option>
		<?php foreach($companylist as $key => $value ){ ?>
				<option value="<?php echo $key; ?>"><?php echo $value;?></option>	
		<?php } ?>
			
	</select>
    </div>
    <div class='col-md-3'>
    <?= Html::submitButton('', ['class' => 'btn btn-success btn-sm fa fa-print','style'=>'position:relative;top:20px','name'=>"Pricelist","value"=>4,"data-toggle"=>"tooltip","title"=>"PriceList"]) ?>
    </div>
    
    
     </fieldset>
	<?php ActiveForm::end(); ?> </div>
   <div class='col-md-6'>
	 <div class="col-sm-1"></div>
	
	   <?php $form = ActiveForm::begin(['action'=>['supplierpdf'],'options' =>['target'=>'_blank']]); ?>
	 <fieldset class="scheduler-border col-sm-12">
	<legend class="scheduler-border form-head ">Supplier wise Report </legend>
   
    
     
    	<div class='col-md-5'>
        <div class=" ">
        	<label>From</label>
            <div class='input-group date' id='datetimepicker15'>
            	
                <input type='text' class="form-control cus-fld"  name="fromDate3"   required>
                <span class="input-group-addon cus-fld">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-5'>
        <div class=" ">
        	<label>To</label>
            <div class='input-group date' id='datetimepicker16' >
                <input type='text' class="form-control cus-fld" name="toDate3" required>
                <span class="input-group-addon cus-fld">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-2'>
    <?= Html::submitButton('', ['class' => 'btn btn-default btn-sm fa fa-print','style'=>'position:relative;top:20px','name'=>"Supplier","value"=>5,"data-toggle"=>"tooltip","title"=>"Supplier"]) ?>
    </div>
    </fieldset>
   <?php ActiveForm::end(); ?>
   </div>
   <div class='col-md-6'>
    
    <?php $form = ActiveForm::begin(['action'=>['gstpurchaseexcel'],'options' =>['target'=>'_blank']]); ?>
	 <fieldset class="scheduler-border col-sm-12">
	<legend class="scheduler-border form-head ">Purchase GST Report </legend>
   
    
     
    	<div class='col-md-5'>
        <div class=" ">
        	<label>From</label>
            <div class='input-group date' id='datetimepicker17'>
            	
                <input type='text' class="form-control cus-fld"  name="fromDate_GST"   required>
                <span class="input-group-addon cus-fld">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-5'>
        <div class=" ">
        	<label>To</label>
            <div class='input-group date' id='datetimepicker18' >
                <input type='text' class="form-control cus-fld" name="toDate_GST" required>
                <span class="input-group-addon cus-fld">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-2'>
    <?= Html::submitButton('', ['class' => 'btn btn-default btn-sm fa fa-print','style'=>'position:relative;top:20px','name'=>"GST","value"=>6,"data-toggle"=>"tooltip","title"=>"GST Purchase Report"]) ?>
    </div>
    
    
   </fieldset>
   <?php ActiveForm::end(); ?>
   
   
    <?php $form = ActiveForm::begin(['action'=>['gstsalesexcel'],'options' =>['target'=>'_blank']]); ?>
	 <fieldset class="scheduler-border col-sm-12">
	<legend class="scheduler-border form-head ">Sales GST Report </legend>
   
    
     
    	<div class='col-md-5'>
        <div class=" ">
        	<label>From</label>
            <div class='input-group date' id='datetimepicker19'>
            	
                <input type='text' class="form-control cus-fld"  name="fromDate_GST_sales"   required>
                <span class="input-group-addon cus-fld">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-5'>
        <div class=" ">
        	<label>To</label>
            <div class='input-group date' id='datetimepicker20' >
                <input type='text' class="form-control cus-fld" name="toDate_GST_sales" required>
                <span class="input-group-addon cus-fld">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-2'>
    <?= Html::submitButton('', ['class' => 'btn btn-default btn-sm fa fa-print','style'=>'position:relative;top:20px','name'=>"sales_GST","value"=>7,"data-toggle"=>"tooltip","title"=>"GST Sales Report"]) ?>
    </div>
    
    
   </fieldset>
   <?php ActiveForm::end(); ?>
   
   
    
   </div>
    
    
</div>
        </div>
</div>
</div>
</div>
</div>
                        	 
<script type="text/javascript">
    $(function () {
        $('#datetimepicker6').datetimepicker({
  
  format: 'DD-MM-YYYY'
});
        $('#datetimepicker7').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            format: 'DD-MM-YYYY'
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
        
        
         $('#datetimepicker11').datetimepicker({
  
 format: 'DD-MM-YYYY HH:mm:ss'
});
        $('#datetimepicker12').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            format: 'DD-MM-YYYY HH:mm:ss'
        });
        $("#datetimepicker11").on("dp.change", function (e) {
            $('#datetimepicker12').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker12").on("dp.change", function (e) {
            $('#datetimepicker11').data("DateTimePicker").maxDate(e.date);
        });
        
        
         $('#datetimepicker13').datetimepicker({
  			format: 'DD-MM-YYYY'
		});
       $('#datetimepicker14').datetimepicker({
       		 useCurrent: false,
			 format: 'DD-MM-YYYY'
		});
		
		 $("#datetimepicker13").on("dp.change", function (e) {
            $('#datetimepicker14').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker14").on("dp.change", function (e) {
            $('#datetimepicker13').data("DateTimePicker").maxDate(e.date);
        }); 
        
        
         $('#datetimepicker15').datetimepicker({
  			format: 'DD-MM-YYYY'
		});
       $('#datetimepicker16').datetimepicker({
       		 useCurrent: false,
			 format: 'DD-MM-YYYY'
		});
		
		 $("#datetimepicker15").on("dp.change", function (e) {
            $('#datetimepicker16').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker16").on("dp.change", function (e) {
            $('#datetimepicker15').data("DateTimePicker").maxDate(e.date);
        });
        
        
         $('#datetimepicker17').datetimepicker({
  			format: 'DD-MM-YYYY'
		});
        $('#datetimepicker18').datetimepicker({
       		 useCurrent: false,
			 format: 'DD-MM-YYYY'
		});
		
		$("#datetimepicker17").on("dp.change", function (e) {
            $('#datetimepicker18').data("DateTimePicker").minDate(e.date);
        });
        
        $("#datetimepicker18").on("dp.change", function (e) {
            $('#datetimepicker17').data("DateTimePicker").maxDate(e.date);
        });
        
        
         $('#datetimepicker19').datetimepicker({
  			format: 'DD-MM-YYYY'
		});
        $('#datetimepicker20').datetimepicker({
       		 useCurrent: false,
			 format: 'DD-MM-YYYY'
		});
		
		$("#datetimepicker19").on("dp.change", function (e) {
            $('#datetimepicker20').data("DateTimePicker").minDate(e.date);
        });
        
        $("#datetimepicker20").on("dp.change", function (e) {
            $('#datetimepicker19').data("DateTimePicker").maxDate(e.date);
        });
        
         
    });
</script>