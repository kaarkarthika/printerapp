<?php

namespace backend\controllers;

use Yii;
use backend\models\Patient;
use backend\models\PatientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Patienttype;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\BranchAdmin;

class PatientController extends Controller
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

               // ...
           ],
       ],
        ];
    }


 public function beforeAction($action) {
          return BranchAdmin::checkbeforeaction();
	}
   
    public function actionIndex()
    {
        $searchModel = new PatientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$patienttype=ArrayHelper::map(Patienttype::find()->asArray()->all(), 'patient_typeid', 'patient_typename');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'patienttype'=>$patienttype,
            
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
        $model = new Patient();

        if ($model->load(Yii::$app->request->post()) ) {
        	$model->is_active=1;
			$dob=Yii::$app->request->post('Patient')['dob'];
		    $model->dob=date("Y-m-d",strtotime($dob));
			$session = Yii::$app->session;
        	$model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			$model->age=date("Y")-date("Y",strtotime($dob));    
			$model->firstname=trim(ucwords(Yii::$app->request->post('Patient')['firstname']));
			$model->lastname=trim(ucwords(Yii::$app->request->post('Patient')['lastname']));
			$model->address=trim(ucwords(Yii::$app->request->post('Patient')['address']));
			$model->emailid=trim(strtolower(Yii::$app->request->post('Patient')['emailid']));
			$model->patient_mobilenumber=trim(Yii::$app->request->post('Patient')['patient_mobilenumber']);
			$model->guardian_name=trim(ucwords(Yii::$app->request->post('Patient')['guardian_name']));
			$model->guardian_mobilenumber=trim(Yii::$app->request->post('Patient')['guardian_mobilenumber']);
			$model->physicianname=trim(ucwords(Yii::$app->request->post('Patient')['physicianname']));
			$model->notes=trim(ucwords(Yii::$app->request->post('Patient')['notes']));
			if($model->save())
            {
                Yii::$app->getSession()->setFlash('success','Patient created successfully');
				 return $this->redirect(['index']);
            }
            else {
        	$patienttype=ArrayHelper::map(Patienttype::find()->asArray()->all(), 'patient_typeid', 'patient_typename');
			$patientmax = Patient::find()->max('patient_id');
		
				$patientmax=$patientmax+1;
            return $this->render('create', [
                'model' => $model,
                'patienttype'=>$patienttype,
                'patientmax'=>$patientmax,
            ]);
        }
           
        } 
        
        else {
        	$patienttype=ArrayHelper::map(Patienttype::find()->asArray()->all(), 'patient_typeid', 'patient_typename');
			$patientmax = Patient::find()->max('patient_id');
				
				$patientmax=$patientmax+1;
            return $this->render('create', [
                'model' => $model,
                'patienttype'=>$patienttype,
                'patientmax'=>$patientmax,
            ]);
        }
    }

  
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
        	
			$dob=Yii::$app->request->post('Patient')['dob'];
		    $model->dob=date("Y-m-d",strtotime($dob));
			$session = Yii::$app->session;
        	$model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			$model->age=date("Y")-date("Y",strtotime($dob));    
			$model->firstname=trim(ucwords(Yii::$app->request->post('Patient')['firstname']));
			$model->lastname=trim(ucwords(Yii::$app->request->post('Patient')['lastname']));
			$model->address=trim(ucwords(Yii::$app->request->post('Patient')['address']));
			$model->emailid=trim(strtolower(Yii::$app->request->post('Patient')['emailid']));
			$model->patient_mobilenumber=trim(Yii::$app->request->post('Patient')['patient_mobilenumber']);
			$model->guardian_name=trim(ucwords(Yii::$app->request->post('Patient')['guardian_name']));
			$model->guardian_mobilenumber=trim(Yii::$app->request->post('Patient')['guardian_mobilenumber']);
			$model->physicianname=trim(ucwords(Yii::$app->request->post('Patient')['physicianname']));
			$model->notes=trim(ucwords(Yii::$app->request->post('Patient')['notes']));
			 if($model->save())
            {
                Yii::$app->getSession()->setFlash('success','Patient Updated successfully');
				return $this->redirect(['index']);
            }
			 else{
			 	$patienttype=ArrayHelper::map(Patienttype::find()->asArray()->all(), 'patient_typeid', 'patient_typename');
            return $this->render('update', [
                'model' => $model,
                'patienttype'=>$patienttype,
            ]);
			 }
            
        } 
        
        else {
        	$patienttype=ArrayHelper::map(Patienttype::find()->asArray()->all(), 'patient_typeid', 'patient_typename');
            return $this->render('update', [
                'model' => $model,
                'patienttype'=>$patienttype,
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
        if (($model = Patient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
