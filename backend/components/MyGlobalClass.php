<?php 
namespace backend\components;
use Yii;
use yii\helpers\Html;
class MyGlobalClass extends \yii\base\Component{
    public function init() {
    		$session=Yii::$app->session;
			$request = Yii::$app->request;
				
		  	$s_G=$_SERVER['QUERY_STRING'];
			$s_G=trim($s_G);
			if(($s_G!=""  && $s_G!='r=site%2Flogin') && $session['user_logintype']==""){
				echo '<center>';
				
				echo "</br>";
				echo '<a>'
                      . Html::beginForm(['/site/login'], 'post')
                      . Html::submitButton(
                          'Go To Login Page --> <i class="fa fa-fw fa-sign-out"></i> ',
                          ['class' => 'btn btn-default lgutbtn btn-flat']
                      )
                      . Html::endForm()
                      . '</a>';
					  
					  echo "You're being timed out due to inactivity.<br>Otherwise,You will logged off automatically.";
                      echo "<br>";
					   echo "<br>";
					  echo '© 2019 Sunitha Printers. All rights reserved.';
					  echo '<center>';
                     $session->destroy();   
			die;
			}else{
				
			}

        parent::init();
    }
}
 ?>