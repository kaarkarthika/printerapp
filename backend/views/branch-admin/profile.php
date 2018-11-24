<?php


use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\CompanyBranch;
use backend\models\States;
$this->title = 'Profile';

?>	
<div class="container">
						
							<div class="col-sm-12">
								<h4 class="page-title"> <?= Html::encode($this->title) ?></h4>
								<ol class="breadcrumb">
									 <li><a href="<?php echo Yii::$app->request->BaseUrl;?>">Home</a></li>
									 <li><a href="#"><?php echo $this->title;?></a></li>
								</ol>
							</div>
					
						
            
                            <div class="col-md-12">
                                <div class="profile-detail card-box">
                                    <div>
                                      
                                        <h4 class="text-uppercase font-600">About Me</h4>
                                       
                                        
                                       <?php $session = Yii::$app->session;
									    
										$bid= $session['branch_id'];
									   
									$data = CompanyBranch::find() -> where(['branch_id'=>$bid])-> one();
									
									 
								
									
								
									?>


                                    

                                        <div class="text-center">
                                            <p><strong >Branch Name :</strong> <span ><?php echo $data->branch_name; ?></span></p>

                                            <p><strong >Branch Code :</strong><span ><?php echo $data->branch_code; ?></span></p>

                                            <p><strong >Address 1 :</strong> <span ><?php echo $data->address1; ?></span></p>

                                            <p><strong>Address 2 :</strong> <span class="m-l-15"><?php echo $data->address2; ?></span></p>
                                            
                                            <p><strong>City :</strong> <span class="m-l-15"><?php echo $data->city; ?></span></p>
                                            
                                         
                                            <p><strong>Pincode :</strong> <span class="m-l-15"><?php echo $data->pincode; ?></span></p>
                                            
                                            <p><strong>GST Number :</strong> <span class="m-l-15"><?php echo $data->gst_number; ?>%</span></p>

                                        </div>


                                        
                                    </div>

                                </div>

                               
                            </div>


                   </div>

   