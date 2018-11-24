<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

use yii\helpers\ArrayHelper;
?>
<footer>
            
            <div class="container-fluid bg-dark-gray footer-bottom">
                <div class="container">
                    <div class="row margin-three">
                        <!-- copyright -->
                        <div class="col-md-6 col-sm-6 col-xs-12 copyright text-left letter-spacing-1 xs-text-center xs-margin-bottom-one">
                            &copy; <?php echo date("Y"); ?> SWiM. ALL RIGHTS RESERVED.
                        </div>
                      
                    </div>
                </div>
            </div>
            <!-- scroll to top -->
            <a href="javascript:;" class="scrollToTop"><i class="fa fa-angle-up"></i></a>
            <!-- scroll to top End... -->
        </footer>


           <div class="clearfix"></div>
               
                   <div class="modal fade rs_mypopup" id="solnwiz_login_popup" tabindex="-1" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                          </div>
                          <div class="modal-body">
    
                            <div class="rs_popup_form">
                                <div class="rs_popup_form_header logolog text-center">
                                	
                                    <img src="<?= Url::to('@web/frontend/web/images/logo-white.png') ?>" class="img-responsive" alt="">

                                </div>
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter Your Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                      <button type="button" class="btn btn-secondary highlight-button  loginbtn">Login</button>
                                      <button type="button" class="btn btn-secondary highlight-button  loginbtn">Sign Up</button>
                                    </div>
                                </form>

                            </div>
                          </div>

                        </div>
                      </div>
                    </div>


		 <script>
            $(document).ready(function(){

                $('#login_popup').click(function(){
                    $('#solnwiz_signup_popup').modal('hide');
                    $('#solnwiz_login_popup').modal('show');
                });

                $('#signup_popup').click(function(){
                    $('#solnwiz_login_popup').modal('hide');
                    $('#solnwiz_signup_popup').modal('show');
                });
            });

        </script>