<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\models\Stickynotes;
use backend\models\StickyNotesDetails;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StickynotesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stickynotes');
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
				input[type=checkbox]:checked + label.strikethrough{
					text-decoration: line-through;
					color:#f4f8fb;
				}
				.btn{padding:8px 14px;}
				.portal-footer-default{
						padding: 10px 15px;
						background: #f4f8fb;
						border-top: 0px;
				}
				.portal-default{
				background: #f4f8fb;
				}
				.lavendar_bg{background-color:#ac91e8!important;}
				.teal_bg{background-color:#8bc9bc!important;}
				.skyblue_bg{background-color:#7edcea!important;}
				.orange_bg{background-color:#fbd087!important;}
				.green_bg{background-color:#91d579!important;}
				.red_bg{background-color:#ff7d7d!important;}	
				.portal-custom{
					background-color:#5fbeaa;			
				}
				.portal-info{
					background-color:#34d3eb;			
				}
				
				.portal-warning{
					background-color:#ffbd4a;			
				}
				.portal-success{
					background-color:#81c868;			
				}
				
				.portal-error{
				background-color:#f05050;
				}
				.portal-black{
				background-color:#6f52ae;
				}
				.portlet .portlet-heading a{color:#fff;}
				.portlet .portlet-body{border-radius:0px!important;}
				
				/*********** CHECK BOX ***********/
				
				.checkbox-black input[type="checkbox"]:checked + label::before {
					background-color: #6f52ae;
					border-color: #6f52ae;					 
				}
				.checkbox-error input[type="checkbox"]:checked + label::before {
					background-color: #f05050;
					border-color: #f05050;					 
				}				
				
				.checkbox label{color:#fff;}
				.checkbox-black label::after,.checkbox-custom label::after,.checkbox-info label::after,.checkbox-error label::after{color:#fff;}
				
				/************* Radio *************/
				.radio-purple label::after{background-color:#6f52ae}
				
				.draggable-box{cursor:move;}
				
				.scrollstyle {
			    overflow-x: visible;
			    
			    height: 171px;
			    overflow-x: scroll;
			     overflow-x: hidden;
			}
			</style>

<div class="container">
	
 	<div class="row">
							<div class="col-sm-12">
                               <!-- <div class="btn-group pull-right m-t-15">
                                	
                            
                	 <?php
                	 $session = Yii::$app->session;
                	 if($session[Yii::$app->controller->id]!=""){
                	 	if($companycount==0){
                	 if(in_array('a', $session[Yii::$app->controller->id])) {
                	 
                	
						 	echo Html::button(' Add Sticky Notes',['class' => 'btn btn-default dropdown-toggle  waves-effect waves-light  addstickynotes']);
					 } }} ?>
                             </div>-->
                                
                                	 
								<div class="btn-group pull-right m-t-15">
								<a style="float:right;" class="btn btn-default  waves-effect waves-light"href="" data-toggle="modal" data-target=".bs-example-modal-sm"> 
												<!--<i class="fa fa-plus fa-lg"></i> &nbsp; -->Add  Panel </a>
									<!-- <button type="button" class="btn btn-default dropdown-toggle addrole waves-effect waves-light"> Add Role</button> -->
								</div>
								<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
									
								</ol>
							</div>
						</div>




					<div class="row">
							<div class=" ">
								<div class="panel panel-border panel-custom">
									<div class="panel-heading">
									   <div class=" ">
										 
										</div>
									</div>
									<div class="panel-body">
										<!-- Begin page -->
		<div id="wrapper">


			<!-- ============================================================== -->
			<!-- Start right Content here -->
			<!-- ============================================================== -->
			<div class="">
				<!-- Start content -->
				<div class="content">
					<div class="container">
						<div class="row">	
							
							
							<!---------- MODAL -------->
							<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                            	<?php $form = ActiveForm::begin(['id'=>'stickynoteform']); ?>
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="mySmallModalLabel">Choose panel Color</h4>
                                                </div>
                                                <div class="modal-body">
                                                <div class=" ">
                                                	<div>
                                                		<label class="text">
		                                                       Title
		                                                    </label>
		                                                   <input type="text" id="example-input1-group2 " name="notetitle" class="form-control" placeholder="Title ">
		                                                    
		                                                </div>
		                                                <div class="radio radio-purple">
		                                                    <input type="radio" name="radio" id="radio1" value="1" checked="">
		                                                    <label for="radio1"  >
		                                                       Purple
		                                                    </label>
		                                                </div>
		                                                <div class="radio radio-custom">
		                                                    <input type="radio" name="radio" id="radio2" value="2">
		                                                    <label for="radio2"  >
		                                                        Light Teal
		                                                    </label>
		                                                </div>
		                                                
		                                                <div class="radio radio-success">
		                                                    <input type="radio" name="radio" id="radio4" value="3">
		                                                    <label for="radio4"  >
		                                                         Light Green
		                                                    </label>
		                                                </div>
		                                                <div class="radio radio-info">
		                                                    <input type="radio" name="radio" id="radio5" value="4">
		                                                    <label for="radio5" >
		                                                        
																Sky blue
		                                                    </label>
		                                                </div>
		                                                <div class="radio radio-danger">
		                                                    <input type="radio" name="radio" id="radio6" value="5">
		                                                    <label for="radio6"  >
		                                                        
																Red
		                                                    </label>
		                                                </div>
		                                                <div class="radio radio-warning">
		                                                    <input type="radio" name="radio" id="radio7" value="6">
		                                                    <label for="radio7"  >
		                                                        Orange
		                                                    </label>
		                                                </div>
		                                                 
		                                           
		                                            </div>
                                                </div>
												
				 <div class="modal-footer">
				  
				      <?= Html::Button('OK', ['class' => 'btn btn-sm btn-primary','id'=>'addnotes']) ?>
				 </div>
												<?php ActiveForm::end(); ?>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
							<!---------- MODAL  Ends-------->
							
 		<!----------------- loop start	 --------------------------->
 		<?php
 		$session=Yii::$app->session;
 		$notes_details=Stickynotes::find()->where(['branch_id'=>$session['branch_id']])->all();
		foreach($notes_details as $det){
			$color=$det->colorscheme;
			if($color==1){
				$h1="portlet-heading portal-default portal-black";
				$h3="portlet-body lavendar_bg scrollstyle";
				$h2="portal-footer-default portal-black";
			}else if($color==2){
				$h1="portlet-heading portal-custom";
				$h3="portlet-body teal_bg scrollstyle";
				$h2="portal-footer-default portal-custom";
			}else if($color==3){
				$h1="portlet-heading portal-default portal-info";
				$h3="portlet-body skyblue_bg scrollstyle";
				$h2="portal-footer-default portal-info";
			}else if($color==4){
				$h1="portlet-heading portal-default portal-warning";
				$h3="portlet-body orange_bg scrollstyle";
				$h2="portal-footer-default portal-warning";
			}else if($color==5){
				$h1="portlet-heading portal-default portal-success";
				$h3="portlet-body green_bg scrollstyle";
				$h2="portal-footer-default portal-success";
			}else if($color==6){
				$h1="portlet-heading portal-default portal-error";
				$h3="portlet-body red_bg scrollstyle";
				$h2="portal-footer-default portal-error";
			}
 		?>			
							<div class="col-lg-4 draggable-box_11">
								
								<div class="portlet">
									<!-- /primary heading -->
									<div class="<?= $h1;?>">
										<h3 class="portlet-title text-white"> <?= strtoupper($det->notetitle);?> </h3>
										<div class="portlet-widgets">
											<!-- <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a> -->
											<span class="divider"></span>
											<!-- <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default1"><i class="ion-minus-round"></i></a> -->
											
											
												
											<span class="divider"></span>
											<!-- <a href="javascript:;" data-toggle="" onclick="$.Notification.confirm('white','bottom right')"><i class="ion-close-round"></i></a> -->
								<a href="javascript:;" data-toggle="" id="t1"  data-id="<?= $det->noteid;?>"><i class="ion-close-round"></i></a>
										</div>
										<div class="clearfix"></div>
									</div>
									<div id="bg-default1" class="panel-collapse collapse in">
										<div class="<?= $h3;?>" id="totalnotes_<?= $det->noteid;?>">
										<?php
										$notes_list=StickyNotesDetails::find()->where(['group_id'=>$det->noteid])->orderBy(['notes_check'=>SORT_ASC])->all();
										if($notes_list){
										foreach($notes_list as $k){
											$check="";
											$check_num=0;
											
											if($k->notes_check==1){
												$check="checked";
												$check_num=1;
											}
										?>	
										
											 <div class="checkbox checkbox-black">
											
	                                            <input id="notedesc_<?= $k->autoid ?>" type="checkbox" data-id="<?= $k->autoid ?>"  value="<?= $k->notes_check ?>" 
	                                            class="check_strike" <?= $check;?> data-group="<?= $det->noteid ?>" data-group1="<?= $check_num ?>">
	                                           
	                                            
	                                            
	                                            <label class="strikethrough" for="checkbox2"><?= $k->notes_description;?></label>
	                                             <a data-id='deletedesc_<?= $k->autoid ?>'  id='delete_desc_<?= $k->autoid ?>' 
	                                            	class=' btn-icon pull-right' >
 <i class="fa fa-remove"></i></a>
	                                            
	                                        </div>
	                                        
	                                        
											
										<?php
										}
										} ?>	
										
											 
										</div>
										
										<div  class="<?= $h3;?>" id="totalnotes1_<?= $det->noteid;?>" style="display:none;">
											
										</div>
										
										<div  class="<?= $h3;?>" id="totalnotes12_<?= $det->noteid;?>" style="display:none;">
											
										</div>
										
									</div>
									<div class="<?= $h2; ?>">
									<div class="row">
									  <div class="col-lg-3">
										<button type="button" class="btn btn-white waves-effect waves-light showBtn" id="showbtn_<?= $det->noteid; ?>" data-id="<?= $det->noteid;?>">
                                                   <i class="fa fa-plus"></i>
                                        </button>
									  </div>
										
										
										<div class="addtask  input-group col-lg-9" id="addtask_<?= $det->noteid; ?>">
										    <input type="text" id="example-input1-group2" name="example-input1-group2"  class="form-control addnote_<?= $det->noteid;?>" placeholder="Add ">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn waves-effect waves-light btn-success addrecord" data-id="<?= $det->noteid;?>"><i class="fa fa-check"></i></button>
												<button type="button" class="btn waves-effect waves-light btn-danger cancelBtn" id="cancelbtn_<?= $det->noteid; ?>" data-id="<?= $det->noteid;?>"><i class="fa fa-times"></i></button>
                                            </span>           
                                        </div>
										</div>
									</div>
								</div>
								
						
								<!-- /Portlet -->
							</div>
							<?php } ?>
				<!------------------------ loop end ----------------------------->			
							
							<!-- <div class="col-lg-4">
								<div class="portlet">
									
									<div class="portlet-heading portal-custom ">
										<h3 class="portlet-title text-white"> Custom </h3>
										<div class="portlet-widgets">
											<a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
											<span class="divider"></span>
											<a data-toggle="collapse" data-parent="#accordion1" href="#bg-default2"><i class="ion-minus-round"></i></a>
											<span class="divider"></span>
											<a href="javascript:;" data-toggle="remove"  ><i class="ion-close-round"></i></a>
										</div>
										<div class="clearfix"></div>
									</div>
									<div id="bg-default2" class="panel-collapse collapse in">
										<div class="portlet-body teal_bg">
											 <div class="checkbox checkbox-custom">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-custom">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-custom">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough"  for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-custom">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-custom">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											 
										</div>
									</div>
									<div class="portal-footer-default portal-custom">
									<div class="row">
									  <div class="col-lg-3">
										<button type="button" class="btn btn-white waves-effect waves-light showBtn ">
                                                   <i class="fa fa-plus"></i>
                                        </button>
									  </div>
										
										
										<div class="addtask  input-group col-lg-9">
										    <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Add ">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn waves-effect waves-light btn-success"><i class="fa fa-check"></i></button>
												<button type="button" class="btn waves-effect waves-light btn-danger cancelBtn"><i class="fa fa-times"></i></button>
                                            </span>           
                                        </div>
										</div>
									</div>
								</div>
								
							</div>
							
							<div class="col-lg-4">
								<div class="portlet">
									
									<div class="portlet-heading portal-default portal-info">
										<h3 class="portlet-title text-white"> Info </h3>
										<div class="portlet-widgets">
											<a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
											<span class="divider"></span>
											<a data-toggle="collapse" data-parent="#accordion1" href="#bg-default3"><i class="ion-minus-round"></i></a>
											<span class="divider"></span>
											<a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
										</div>
										<div class="clearfix"></div>
									</div>
									<div id="bg-default3" class="panel-collapse collapse in">
										<div class="portlet-body skyblue_bg">
											 <div class="checkbox checkbox-info">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-info">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-info">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough"  for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-info">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-info">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											 
										</div>
									</div>
									<div class="portal-footer-default portal-info">
									<div class="row">
									  <div class="col-lg-3">
										<button type="button" class="btn btn-white waves-effect waves-light showBtn ">
                                                   <i class="fa fa-plus"></i>
                                        </button>
									  </div>
										
										
										<div class="addtask  input-group col-lg-9">
										    <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Add ">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn waves-effect waves-light btn-success"><i class="fa fa-check"></i></button>
												<button type="button" class="btn waves-effect waves-light btn-danger cancelBtn"><i class="fa fa-times"></i></button>
                                            </span>           
                                        </div>
										</div>
									</div>
								</div>
								
							</div>
							
							<div class="col-lg-4">
								<div class="portlet">
								
									<div class="portlet-heading portal-default portal-warning">
										<h3 class="portlet-title text-white"> Warning </h3>
										<div class="portlet-widgets">
											<a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
											<span class="divider"></span>
											<a data-toggle="collapse" data-parent="#accordion1" href="#bg-default4"><i class="ion-minus-round"></i></a>
											<span class="divider"></span>
											<a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
										</div>
										<div class="clearfix"></div>
									</div>
									<div id="bg-default4" class="panel-collapse collapse in">
										<div class="portlet-body orange_bg">
											 <div class="checkbox checkbox-warning">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-warning">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-warning">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough"  for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-warning">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-warning">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											 
										</div>
									</div>
									<div class="portal-footer-default portal-warning">
									<div class="row">
									  <div class="col-lg-3">
										<button type="button" class="btn btn-white waves-effect waves-light showBtn ">
                                                   <i class="fa fa-plus"></i>
                                        </button>
									  </div>
										
										
										<div class="addtask  input-group col-lg-9">
										    <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Add ">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn waves-effect waves-light btn-success"><i class="fa fa-check"></i></button>
												<button type="button" class="btn waves-effect waves-light btn-danger cancelBtn"><i class="fa fa-times"></i></button>
                                            </span>           
                                        </div>
										</div>
									</div>
								</div>
								
							</div>
							
							<div class="col-lg-4">
								<div class="portlet">
								
									<div class="portlet-heading portal-default portal-success">
										<h3 class="portlet-title text-white"> Success </h3>
										<div class="portlet-widgets">
											<a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
											<span class="divider"></span>
											<a data-toggle="collapse" data-parent="#accordion1" href="#bg-default5"><i class="ion-minus-round"></i></a>
											<span class="divider"></span>
											<a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
										</div>
										<div class="clearfix"></div>
									</div>
									<div id="bg-default5" class="panel-collapse collapse in">
										<div class="portlet-body green_bg">
											 <div class="checkbox checkbox-success">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-success">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-success">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough"  for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-success">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-success">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											 
										</div>
									</div>
									<div class="portal-footer-default portal-success">
									<div class="row">
									  <div class="col-lg-3">
										<button type="button" class="btn btn-white waves-effect waves-light showBtn ">
                                                   <i class="fa fa-plus"></i>
                                        </button>
									  </div>
										
										
										<div class="addtask  input-group col-lg-9">
										    <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Add ">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn waves-effect waves-light btn-success"><i class="fa fa-check"></i></button>
												<button type="button" class="btn waves-effect waves-light btn-danger cancelBtn"><i class="fa fa-times"></i></button>
                                            </span>           
                                        </div>
										</div>
									</div>
								</div>
							
							</div>
							<div class="col-lg-4">
								<div class="portlet">
									
									<div class="portlet-heading portal-default portal-error">
										<h3 class="portlet-title text-white"> Error </h3>
										<div class="portlet-widgets">
											<a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
											<span class="divider"></span>
											<a data-toggle="collapse" data-parent="#accordion1" href="#bg-default6"><i class="ion-minus-round"></i></a>
											<span class="divider"></span>
											<a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
										</div>
										<div class="clearfix"></div>
									</div>
									<div id="bg-default6" class="panel-collapse collapse in">
										<div class="portlet-body red_bg">
											 <div class="checkbox checkbox-error">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-error">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-error">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough"  for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-error">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											
											<div class="checkbox checkbox-error">
	                                            <input id="checkbox2" type="checkbox">
	                                            <label class="strikethrough" for="checkbox2">Check me out !</label>
	                                        </div>
											 
										</div>
									</div>
									<div class="portal-footer-default portal-error">
									<div class="row">
									  <div class="col-lg-3">
										<button type="button" class="btn btn-white waves-effect waves-light showBtn ">
                                                   <i class="fa fa-plus"></i>
                                        </button>
									  </div>
										
										
										<div class="addtask disabled  input-group col-lg-9">
										    <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Add ">
                                            <span class="input-group-btn" >
                                                <button type="button" class="btn waves-effect waves-light btn-success"><i class="fa fa-check"></i></button>
												<button type="button" class="btn waves-effect waves-light btn-danger cancelBtn"><i class="fa fa-times"></i></button>
                                            </span>           
                                        </div>
										</div>
									</div>
								</div>
								
							</div> -->
							
							

							 

						</div>
						<!-- end row -->

					</div>
					<!-- container -->

				</div>
				<!-- content -->

				 

			</div>
			<!-- ============================================================== -->
			<!-- End Right content here -->
			<!-- ============================================================== -->

			
		</div>
										<!--
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'noteid',
            'notetitle',
            'notedesc:ntext',
            'is_active',
            'colorscheme',
            // 'updated_by',
            // 'updated_on',
            // 'updated_ipaddress',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>-->
<!-- enter your Content Here-->

</div>
</div>
</div>
</div>












</div>
		<!-- <script type="text/javascript">
		   $(document).ready(function(){
		   $('.addtask').hide();
		   $('.showBtn').click(function() {
		  
				$('.addtask').show();
				$('.showBtn').prop("disabled",true);
			});
			$('.cancelBtn').click(function(){
				$('.showBtn').prop("disabled",false);
				$('.addtask').hide();
			})
		   })		
		</script> -->
		
		<script type="text/javascript">
		   $(document).ready(function(){
		   $('.addtask').hide();
		   $('.showBtn').click(function() {
		  x=$(this).attr('data-id');
				$('#addtask_'+x).show();
				$('#showbtn_'+x).prop("disabled",true);
			});
			$('.cancelBtn').click(function(){
				y=$(this).attr('data-id');
				$('#showbtn_'+y).prop("disabled",false);
				$('#addtask_'+y).hide();
			})
		   })		
		</script>
<script>
    $(document).ready(function(){

         	$('body').on("click",".addunit",function(){
             var PageUrl = '<?php echo Yii::$app->homeUrl;?>?r=unit/create';
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-plus"></i>Add Unit</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(PageUrl);
             return false(); });
     $('body').on("click",".modalView",function(){
          
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>View Unit</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false();  });

 	  $('body').on("click",".updatedata",function(){
            
            $('#operationalheader').html('<span> <i class="fa fa-fw fa-sitemap"></i> Update Unit</span>');
                  $('#operationalmodal').modal('show').find('#modalContenttwo').load($(this).attr('value'));
             return false();});
            
 });
 
 
 $(document).on('click','#addnotes',function(event){

         var form = $('#stickynoteform');
$.ajax({
    
    url : '<?php echo Url::toRoute(['stickynotes/create']); ?>',
    type: 'post',
    data: form.serialize(),
     success : function(response){
     
    }
   })
});

 $(document).on('click','.addrecord',function(event){
	x=$(this).attr('data-id');
	is_valid="ok";
	noteval=$(".addnote_"+x).val();
	if(noteval==''){
		is_valid="no";
		alert("Note cannot be blank");
	}
if(is_valid=='ok'){	
         var form = $('#stickynoteform');
$.ajax({
    
    url : '<?php echo Url::toRoute(['stickynotes/addnotes']); ?>',
    type: 'post',
    data: 'group='+x+'&note='+noteval,
     success : function(response){
     
     	$("#totalnotes1_"+x).show();
     	$("#totalnotes1_"+x).html(response);
     	$("#totalnotes_"+x).hide();
     	$(".addnote_"+x).val("");
     
    }
   })
  }
   
});

 $(document).on('click','#t1',function(event){
	x=$(this).attr('data-id');
	
if(confirm("Want to delete?")){
         var form = $('#stickynoteform');
$.ajax({
    
  //  url : '<?php echo Url::toRoute(['stickynotes/delete&id=']); ?>'+x,
    url:'<?php echo Yii::$app->homeUrl . '?r=stickynotes/delete&id='; ?>'+x ,
  
    type: 'post',
    data: 'group='+x,
     success : function(response){
     
    }
   })
  }
});

$(document).on('click','.check_strike',function(event){
	z=x=$(this).val();
	
	x=$(this).attr("data-id");
	y=$(this).attr("data-group");
	y1=$(this).attr("data-group1");
	
    var form = $('#stickynoteform');
	$.ajax({
	    url:'<?php echo Yii::$app->homeUrl . '?r=stickynotes/checknote&id='; ?>'+x ,
	    type: 'post',
	    data: 'group='+y+'&check_num='+y1,
	    success : function(response){
	    	
	    	$("#totalnotes_"+y).hide();
	     	$("#totalnotes1_"+y).hide();
	    	$("#totalnotes12_"+y).show();
	     	$("#totalnotes12_"+y).html(response);
	     	
	     	//$(".addnote_"+x).val("");
	     
	    }
	   })
  
});
</script>
<script type="text/javascript">
 $(document).ready(function(){
function endMove() {
    $(this).removeClass('movable');
}
function startMove() {
    $('.movable').on('mousemove', function(event) {
        var thisX = event.pageX - $(this).width() / 2,
            thisY = event.pageY - $(this).height() / 2;

        $('.movable').offset({
            left: thisX,
            top: thisY
        });
    });
}
$(document).ready(function() {
    $(".draggable-box").on('mousedown', function() {
        $(this).addClass('movable');
        startMove();
    }).on('mouseup', function() {
        $(this).removeClass('movable');
        endMove();
    });
});
});

</script>
