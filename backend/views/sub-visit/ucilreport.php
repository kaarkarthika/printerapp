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
   $this->title = Yii::t('app', 'UCIL Report List');
   
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
   .panel.panel-border.panel-inverse {
   height: 600px;
   }
   .table-condensed > tbody > tr > td{
    padding: 0px!important;
   }

   /*.bootstrap-datetimepicker-widget table td.day{
    background-color: #062e4f!important;
   }*/

</style>
</style>
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
</div>

       <div class="container">
            <div class="row">
             <div class='col-md-4'>
                     <div class="c panel panel-border panel-custom">
                       <div class="panel-heading">
                   <div class="panel-body">
                     <?php $form = ActiveForm::begin(['action'=>['ucilreport'],'options' =>['target'=>'_blank']]); ?>

                 <!--     <fieldset class="scheduler-border"> -->

                        <h5 class="box-title" style="margin-top: 0px;"><strong>UCIL Report</strong></h5>
    
                        <div class="row" >
                           <div class='col-sm-6'>
                              <div class="form-group">
                                 <label>From</label>
                                 <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control cus-fld"  name="fromDate"   required>
                                    <span class="input-group-addon cus-fld">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class='col-sm-6'>
                              <div class="form-group">
                                 <label>To</label>
                                 <div class='input-group date' id='datetimepicker2' >
                                    <input type='text' class="form-control cus-fld" name="toDate" required>
                                    <span class="input-group-addon cus-fld">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                 </div>
                              </div>
                           </div>
                             <div class='col-sm-2'></div>
                           <div class='col-sm-7'>
                              <?= Html::submitButton(' PRINT UCIL REPORT ', ['class' => 'btn btn-success btn-sm ','style'=>'position:relative;','name'=>"UCIL_REPORT","value"=>1,"data-toggle"=>"tooltip","title"=>"UCIL REPORT"]) ?>
                           </div>
                        </div>
          <!--            </fieldset> -->
                     <?php ActiveForm::end(); ?>
                  </div></div></div></div>







                  <div class='col-md-4'>
                    <div class="c panel panel-border panel-custom">
                       <div class="panel-heading">
                   <div class="panel-body">
                     <?php $form = ActiveForm::begin(['action'=>['ucilreportstaff'],'options' =>['target'=>'_blank']]); ?>
                     <!-- <fieldset class="scheduler-border"> -->
                      <!--   <legend class="scheduler-border form-head ">UCIL Report Staff Wise</legend> -->
                          <h5 class="box-title" style="margin-top: 0px;"><strong>UCIL OP BILLS REPORT</strong></h5>
    
                        <!-- <div class="panel-heading" style="border-top: 3px solid #5fbeaa!important;">Itemwise Purchase Report</div> -->      
                        <div class="row" >
                           <div class='col-sm-6'>
                              <div class="form-group">
                                 <label>From</label>
                                 <div class='input-group date' id='datetimepicker3'>
                                    <input type='text' class="form-control cus-fld"  name="fromDate"   required>
                                    <span class="input-group-addon cus-fld">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class='col-sm-6'>
                              <div class="form-group">
                                 <label>To</label>
                                 <div class='input-group date' id='datetimepicker4' >
                                    <input type='text' class="form-control cus-fld" name="toDate" required>
                                    <span class="input-group-addon cus-fld">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                 </div>
                              </div>
                           </div>
                            <div class='col-sm-1'></div>
                           <div class='col-md-10'>
                              <?= Html::submitButton('PRINT UCIL OP BILLS REPORT', ['class' => 'btn btn-success btn-sm ','style'=>'position:relative; ','name'=>"UCIL_REPORT_STAFF","value"=>1,"data-toggle"=>"tooltip","title"=>"UCIL OP BILLS REPORT"]) ?>
                           </div>
                        </div>
                    <!--  </fieldset> -->
                     <?php ActiveForm::end(); ?>
                  </div></div></div></div>








                  <div class='col-md-4'>
                     <div class="c panel panel-border panel-custom">
                       <div class="panel-heading">
                   <div class="panel-body">

                     <?php $form = ActiveForm::begin(['action'=>['ucilopbills'],'options' =>['target'=>'_blank']]); ?>
                    <!--  <fieldset class="scheduler-border"> -->
                       <!--  <legend class="scheduler-border form-head ">UCIL OP BILLS REPORT</legend> -->
                         <h5 class="box-title" style="margin-top: 0px;"><strong>UCIL Report Staff Wise</strong></h5>
                        <div class="row" >
                           <div class='col-sm-6'>
                              <div class="form-group">
                                 <label>From</label>
                                 <div class='input-group date' id='datetimepicker5'>
                                    <input type='text' class="form-control cus-fld"  name="fromDate"   required>
                                    <span class="input-group-addon cus-fld">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class='col-sm-6'>
                              <div class="form-group">
                                 <label>To</label>
                                 <div class='input-group date' id='datetimepicker6' >
                                    <input type='text' class="form-control cus-fld" name="toDate" required>
                                    <span class="input-group-addon cus-fld">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                 </div>
                              </div>
                           </div>
                            <div class='col-sm-1'></div>
                           <div class='col-md-10'>
                              <?= Html::submitButton('PRINT UCIL REPORT STAFF WISE', ['class' => 'btn btn-success btn-sm    ','style'=>'position:relative;','name'=>"UCIL_REPORT_STAFF","value"=>1,"data-toggle"=>"tooltip","title"=>"UCIL REPORT STAFF WISE"]) ?>
                           </div>
                        </div>
                   <!--   </fieldset> -->
                     <?php ActiveForm::end(); ?>
                  </div></div></div></div>

               </div>
            </div>
 
<script type="text/javascript">
   $(function () {
       $('#datetimepicker1').datetimepicker({
    format: 'DD-MM-YYYY'
   });
       $('#datetimepicker2').datetimepicker({
           useCurrent: false, //Important! See issue #1075
           format: 'DD-MM-YYYY'
       });
       $("#datetimepicker1").on("dp.change", function (e) {
           $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
       });
       $("#datetimepicker2").on("dp.change", function (e) {
           $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
       });
       
       
        $('#datetimepicker3').datetimepicker({
    format: 'DD-MM-YYYY'
   });
       $('#datetimepicker4').datetimepicker({
           useCurrent: false, //Important! See issue #1075
           format: 'DD-MM-YYYY'
       });
       $("#datetimepicker3").on("dp.change", function (e) {
           $('#datetimepicker4').data("DateTimePicker").minDate(e.date);
       });
       $("#datetimepicker4").on("dp.change", function (e) {
           $('#datetimepicker3').data("DateTimePicker").maxDate(e.date);
       });
       
        $('#datetimepicker5').datetimepicker({
    format: 'DD-MM-YYYY'
   });
       $('#datetimepicker6').datetimepicker({
           useCurrent: false, //Important! See issue #1075
           format: 'DD-MM-YYYY'
       });
       $("#datetimepicker5").on("dp.change", function (e) {
           $('#datetimepicker6').data("DateTimePicker").minDate(e.date);
       });
       $("#datetimepicker6").on("dp.change", function (e) {
           $('#datetimepicker5').data("DateTimePicker").maxDate(e.date);
       });
       
   });
</script>