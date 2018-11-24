<?php
namespace backend\controllers;
use Yii;
use backend\models\CompanyGst;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\CompanyGstSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Company;
use backend\models\States;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use backend\models\BranchAdmin;
class CompanyGstController extends Controller
{
   
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
                            'access' => [
           'class' => AccessControl::className(),
           'rules' => [
               [
                   'allow' => true,
                   'roles' => ['@'],
               ],

           ],
       ],
        ];
    }
	
 public function beforeAction($action) {
          return BranchAdmin::checkbeforeaction();
	}

    public function actionIndex()
    {
        $searchModel = new CompanyGstSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

   
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

 
    public function actionCreate()
    {
        $model = new CompanyGst();

        if ($model->load(Yii::$app->request->post())) {
        	
			$cmpname=Yii::$app->request->post('CompanyGst')['company_id'];
			$state=Yii::$app->request->post('CompanyGst')['stateid'];
			
			$gstup=CompanyGst::find()->where(['company_id'=>$cmpname])->andwhere(['stateid'=>$state])->one();
			
			if(count($gstup)==1){
				echo"E";
			}
			
			else{
				$gstin=Yii::$app->request->post('CompanyGst')['gst'];
				$gstlength=strlen($gstin);
				
           $session = Yii::$app->session;
        	$model->updatedby=$session['user_id'];
			$model->updatedipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updatedon=date("Y-m-d H:i:s");
			
			if($gstlength==15)
			{
				if($model->save()){
				
				echo"Y";
			}else{
				echo"N";
			}
			}
			else{
				
					echo "V";
				
			}
			
		
			}
        } else {
        	$companylist=ArrayHelper::map(Company::find()->where(['is_active'=>1])->asArray()->all(), 'company_id', 'company_name');
			$statelist=ArrayHelper::map(States::find()->asArray()->all(), 'stateid', 'state_name');
			
            return $this->renderAjax('create', [
                'model' => $model,
                 'companylist'=>$companylist,
                 'statelist'=>$statelist, 
            ]);
        }
    }

  
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
      if ($model->load(Yii::$app->request->post())) {
        	
			$cmpname=Yii::$app->request->post('CompanyGst')['company_id'];
			$state=Yii::$app->request->post('CompanyGst')['stateid'];
			
			$gstdata=CompanyGst::find()->where(['gstid'=>$id])->one();
			
			$gstin=Yii::$app->request->post('CompanyGst')['gst'];
				$gstlength=strlen($gstin);
				
				
			
			if(count($gstdata)==1){
				if($cmpname==($gstdata->company_id) && $state==($gstdata->stateid))
				{
						if($gstlength==15)
			{
					
			$session = Yii::$app->session;
        	$model->updatedby=$session['user_id'];
			$model->updatedipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updatedon=date("Y-m-d H:i:s");
			$model->company_id=$cmpname;
			$model->stateid=$state;
			$model->gst=$gstin;
			
				$model->save();echo "Y";
			
			}
				}
				else{
					$gstup=CompanyGst::find()->where(['company_id'=>$cmpname])->andwhere(['stateid'=>$state])->one();
							if(count($gstup)==1){
				echo"E";
			}
			
			else{
				$gstin=Yii::$app->request->post('CompanyGst')['gst'];
				$gstlength=strlen($gstin);
				
          
			
			if($gstlength==15)
			{
				$session = Yii::$app->session;
        	$model->updatedby=$session['user_id'];
			$model->updatedipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updatedon=date("Y-m-d H:i:s");
			$model->company_id=$cmpname;
			$model->stateid=$state;
			$model->gst=$gstin;	
					
				if($model->save()){
				
				echo"Y";
			}else{
				echo"N";
				print_r($model);die;
			}
			}
			else{
				
					echo "V";
				
			}
			
		
			}
					
					
				}
			}
			
			
        } else {
        	$companylist=ArrayHelper::map(Company::find()->where(['is_active'=>1])->asArray()->all(), 'company_id', 'company_name');
			$statelist=ArrayHelper::map(States::find()->asArray()->all(), 'stateid', 'state_name');
            return $this->renderAjax('update', [
                'model' => $model,
                'companylist'=>$companylist,
                 'statelist'=>$statelist,
            ]);
        }
    }

  
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

  
    protected function findModel($id)
    {
        if (($model = CompanyGst::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
