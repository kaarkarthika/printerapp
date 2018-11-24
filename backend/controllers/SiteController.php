<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\User;
use common\models\ServiceCentreAdmin;
use backend\models\AdminLog;
use common\models\BranchAdmin;
use backend\models\InvoicePaymentDetails;

class SiteController extends Controller
{
   
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','notaccess'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
	

  
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex($id='')
    {
        $session = Yii::$app->session;
		if($session['user_logintype']==""){
			 Yii::$app->user->logout();
        	$session = Yii::$app->session;
        	$session->destroy();
			 return $this->goHome();
		}else{
				
        	return $this->render('index');
		}
    }

    public function actionLogin()
    {
       

        
    	$this->layout='loginLayout';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $adminlog = new AdminLog();

        $model1 = new ServiceCentreAdmin();
        $model2 = new BranchAdmin();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $username = Yii::$app->request->post('LoginForm')['username'];
            $user_data = User::find()->where(['username' => $username])->one();
            if(count($user_data)>0)
            {
                $adminlog->user_id=$user_data['id'];
                $adminlog->action="Login Successful";
                $adminlog->save();
            }
            

            $_SESSION['headlinestv_id'] = $user_data['id'];
            $_SESSION['user_name'] = $user_data['username'];
            $_SESSION['user_type'] = $user_data['user_type']; 
            return $this->goHome(); //goBack changed as goHome
        }elseif ($model->load(Yii::$app->request->post()) && $model1->login()) {    
            $username = Yii::$app->request->post('LoginForm')['username'];
            $user_data = ServiceCentreAdmin::find()->where(['username' => $username])->one();  
            return $this->goHome();
           // return $this->goHome(); //goBack changed as goHome
        } 
        elseif ($model->load(Yii::$app->request->post()) && $model2->login()) { 
            $username = Yii::$app->request->post('LoginForm')['username'];
            $user_data = BranchAdmin::find()->where(['ba_name' => $username])->one();   
            return $this->goHome();
           // return $this->goHome(); //goBack changed as goHome
        } 
        else {
        	
		//	die;
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        $session = Yii::$app->session;
        $session->destroy();
        return $this->goHome();
    }
	
	
	
	  public function actionNotaccess()
    {
    	$this->layout='loginLayout';
		  return $this->render('notaccess', [
              
            ]);
	}
	public function actionProfile()
    {
        $searchModel = new BranchAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('profile', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
            
        ]);
    }

    
}
