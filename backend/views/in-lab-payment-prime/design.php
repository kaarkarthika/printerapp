<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LabPaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lab Payments';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
 	<div class="row">
							<div class="col-sm-12">
                                <div class="btn-group pull-left m-t-15">
                                	
                         <h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
							
				<div class="btn-group pull-right m-t-15">
   <?= Html::a('Create Lab Payment', ['create'], ['class' => 'btn btn-success']) ?>
</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-border panel-custom">
									<div class="panel-heading" style="    padding: 0;">
									
									</div>
								<div class="panel-body" style="    padding: 0 10px;">
									<div class="row pro-mot-std">
										<div class="col-md-12 mot_std">
											<p >ProceduresMOT Std</p>
										</div>
										<div class="col-md-11" style="padding:0">
										<div class="col-sm-3 patient_details" style="border-right: 1px solid #d6c8c8;">
											<p>patient details</p>
											<div class="inner-des">
												<span>Bill No</span>
												<span class="form-control"> <input type="text" name="lname"></span> 
												<span>Source Type</span>
												<span class="form-control"><input type="text" name="lname"></span>
												<span>MR No:</span>
												<span class="form-control"><input type="text" name="lname"></span>
											</div>
										
											
										</div>
										<div class="col-sm-3 " style="border-right: 1px solid #d6c8c8;">
											<div class="inner-des">
												<span>Name Initial</span>
												<span class="form-control"> <input type="text" name="lname"></span> 
												<span>Source Type</span>
												<span class="form-control"><input type="text" name="lname"></span>
												<span>MR No:</span>
												<span class="form-control"><input type="text" name="lname"></span>
											</div>
										</div>
										<div class="col-sm-3 " style="border-right: 1px solid #d6c8c8;">
											<div class="inner-des">
												<span>Bill No</span>
												<span class="form-control"> <input type="text" name="lname"></span> 
												<span>Source Type</span>
												<span class="form-control"><input type="text" name="lname"></span>
												<span>MR No:</span>
												<span class="form-control"><input type="text" name="lname"></span>
												<span>MR No:</span>
												<span class="form-control"><input type="text" name="lname"></span>
												<span>MR No:</span>
												<span class="form-control"><input type="text" name="lname"></span>
											</div>
										</div>
										<div class="col-sm-3" style="border-right: 1px solid #d6c8c8;">
											<div class="inner-des">
												<span>Bill No</span>
												<span class="form-control"> <input type="text" name="lname"></span> 
												<span>Source Type</span>
												<span class="form-control"><input type="text" name="lname"></span>
												<span>MR No:</span>
												<span class="form-control"><input type="text" name="lname"></span>
											</div>
										
										</div>
										
										<div class="col-md-12 mot_std">
											<p >TEST GRID (Control + Enter For New Row)<input type="text" name="lname" style="width: 13%;"></p>
										</div>	
										<div class="col-sm-3 patient_details" style="border-right: 1px solid #d6c8c8;">
											<p>FINANICAL DETAILS</p>
											<div class="inner-des">
												<span>Bill No</span>
												<span class="form-control"> <input type="text" name="lname"></span> 
												<span>Source Type</span>
												<span class="form-control"><input type="text" name="lname"></span>
												<span>MR No:</span>
												<span class="form-control"><input type="text" name="lname"></span>
											</div>
										
											
										</div>
										<div class="col-sm-3 " style="border-right: 1px solid #d6c8c8;">
											<div class="inner-des">
												<span>Name Initial</span>
												<span class="form-control"> <input type="text" name="lname"></span> 
												<span>Source Type</span>
												<span class="form-control"><input type="text" name="lname"></span>
												<span>MR No:</span>
												<span class="form-control"><input type="text" name="lname"></span>
											</div>
										</div>
										<div class="col-sm-3 " style="border-right: 1px solid #d6c8c8;">
											<div class="inner-des">
												<span>Bill No</span>
												<span class="form-control"> <input type="text" name="lname"></span> 
												<span>Source Type</span>
												<span class="form-control"><input type="text" name="lname"></span>
												<span>MR No:</span>
												<span class="form-control"><input type="text" name="lname"></span>
												<span>MR No:</span>
												<span class="form-control"><input type="text" name="lname"></span>
												<span>MR No:</span>
												<span class="form-control"><input type="text" name="lname"></span>
											</div>
										</div>
										<div class="col-sm-3" style="border-right: 1px solid #d6c8c8;">
											<div class="inner-des">
												<span>Bill No</span>
												<span class="form-control"> <input type="text" name="lname"></span> 
												<span>Source Type</span>
												<span class="form-control"><input type="text" name="lname"></span>
												<span>MR No:</span>
												<span class="form-control"><input type="text" name="lname"></span>
											</div>
										</div>
											</div>
								        <div class="col-md-1 button-select">
								        	<button type="button" class="btn btn-success">Save</button>
								        	<button type="button" class="btn btn-success">Clear</button>
								        	<button type="button" class="btn btn-success">Close</button>
								        	<button type="button" class="btn btn-success">Search</button>
								        	<button type="button" class="btn btn-success">Tracking </button>
								        	<button type="button" class="btn btn-success">Print <br> PROCOM </button>
								        		 
								        </div>
									</div>	
								</div>
							</div>
						</div>
<style>
.mot_std{
	background: #bef0ff;
    padding: 10px 10px;
}
.mot_std p{
	color:#000;
	font-weight:bold;
}
.patient_details p:first-child {
    background: #fdffae;
    padding: 5px 5px;
}
.patient_details {
    padding: 0;
}
.inner-des span {
   width: 37%;
    float: left;
    font-size: 12px;
    margin: 3px 0px;
    text-align: right;
    margin-right: 10px;
}
input[type="text"] {
    width: 100%;
}
.inner-des span.form-control {
    padding: 0 !important;width: 55%;
    height: 25px;
}
.patient_details .inner-des {
    padding: 0 10px;
}
.pro-mot-std .col-sm-3 {
       min-height: 160px;
    border-bottom: 1px solid #dcd8d8;
}
.button-select button {
    margin: 3px 0;     width: 100%;
}
.button-select {
    margin: 30px 0;
}
</style>

 <script>
 
$("#wrapper").addClass("enlarged");
$("#wrapper").addClass("forced");
$(".list-unstyled").css("display","none");
 
</script>