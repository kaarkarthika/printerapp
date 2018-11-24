<?php

namespace backend\controllers;

use Yii;
use backend\models\Physicianmaster;
use backend\models\PhysicianmasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\AuthProjectModule;
use backend\models\BranchAdmin;
use yii\helpers\ArrayHelper;
use backend\models\Specialistdoctor;
use backend\models\SchedulerTable;
use yii\filters\AccessControl;
/**
 * PhysicianmasterController implements the CRUD actions for Physicianmaster model.
 */
class PhysicianmasterController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all Physicianmaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhysicianmasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Physicianmaster model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Physicianmaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     
    public function actionCreate()
    {
        $model = new Physicianmaster();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/
    public function actionCreate()
    {
    	
         $model = new Physicianmaster();
		
       if ($model->load(Yii::$app->request->post()) )
	    {
	    	
        	 $session = Yii::$app->session;
		     $physicianname=trim(ucwords(Yii::$app->request->post('Physicianmaster')['physician_name']));
			 $qualification=trim(Yii::$app->request->post('Physicianmaster')['qualification']);
			 $specialist=Yii::$app->request->post('Physicianmaster')['specialist'];
			
			 $model->updatedby=$session['user_id'];
			 $model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			 $model->updatedon=date("Y-m-d H:i:s");
			 $model->physician_name=$physicianname;
			 $model->qualification=$qualification;
			 $model->specialist=$specialist;
		   
			 if($model->save())   
			 {
			 	echo "S";  
			 }
             else 
             {
             	echo "N";
			 }
	   }
        
        else {
			$speciallist = ArrayHelper::map(Specialistdoctor::find()->where(['is_active'=>'1'])->all(), 's_id', 'specialist');	
            return $this->renderAjax('create', ['model' => $model ]);
        }
    }

    /**
     * Updates an existing Physicianmaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }*/
	public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) )
	    {
        	 $session = Yii::$app->session;
		    $physicianname=trim(ucwords(Yii::$app->request->post('Physicianmaster')['physician_name']));
			 $qualification=trim(Yii::$app->request->post('Physicianmaster')['qualification']);
			 $specialist=trim(Yii::$app->request->post('Physicianmaster')['specialist']);
			 $model->updatedby=$session['user_id'];
			 $model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			 $model->updatedon=date("Y-m-d H:i:s");
			 $model->physician_name=$physicianname;
			 $model->qualification=$qualification;
			 $model->specialist=$specialist;
		
			 
			 
			
			 	    if($model->save())   {echo "U";  }
                    else {echo "N";}
               
			 
			 
			 
	       
			
			
	   }
	   
	   else {
        	
            return $this->renderAjax('update', [ 'model' => $model]);
               
                 
           
        }
    }
	
	
	public function actionTimetable($id)
    {
    	$id=base64_decode(urldecode($id));
        $model = $this->findModel($id);
      	
      	return $this->render('timetable', [ 'model' => $model]);
    }
	
	public function actionTimetableschedule($id)
    {
    	if($_POST)
		{
			$in_data=$_POST['jsondata'];
			$json_data=json_decode($in_data,TRUE);
			
			$start='';
			$end='';
			$title='';
			$backgroundColor='';
			$borderColor='';
			$textColor='';
			$session = Yii::$app->session;
			
			SchedulerTable::updateAll(['status' => 'W'], ['physican_master_id' => $id]);
			 
			foreach ($json_data as $key => $value) 
			{
				if(!empty($value['periods']))
				{
					foreach ($value['periods'] as $key1 => $value1) 
					{
						$start=$value1['start'];
						$end=$value1['end'];
						$title=$value1['title'];
						$backgroundColor=$value1['backgroundColor'];
						$borderColor=$value1['borderColor'];
						$textColor=$value1['textColor'];	
					
						$schduler= new SchedulerTable();
						
						$schduler->	status = 'N';
						$schduler->physican_master_id = $id;
						$schduler->day = $value['day'];
						$schduler->start = $start;
						$schduler->end = $end;
						$schduler->title = $title;
						$schduler->backgroundColor = $backgroundColor;
						$schduler->borderColor = $borderColor;
						$schduler->textColor = $textColor;
						$schduler->created_at = date('Y-m-d H:i:s');
						$schduler->updated_at = date('Y-m-d H:i:s');
						$schduler->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
						$schduler->user_id = $session['user_id'];
						if($schduler->save())
						{
							
						}
						else 
						{
							print_r($schduler->getErrors());die;	
						}
					}
				}
				else if(empty($value['periods']))
				{
					$schduler= new SchedulerTable();
					$schduler->	status = 'N';
					$schduler->physican_master_id = $id;
					$schduler->day = $value['day'];
					$schduler->start = null;
					$schduler->end = null;
					$schduler->title = null;
					$schduler->backgroundColor = null;
					$schduler->borderColor = null;
					$schduler->textColor = null;
					$schduler->created_at = date('Y-m-d H:i:s');
					$schduler->updated_at = date('Y-m-d H:i:s');
					$schduler->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
					$schduler->user_id = $session['user_id'];
					if($schduler->save())
					{
						
					}
					else 
					{
						print_r($schduler->getErrors());die;	
					}
				}	
			}

			
			
			$json_val=json_encode($_POST['jsondata'],TRUE);
			$model = $this->findModel($id);
			$model->timetable = $json_val;
			if($model->save())
			{
				echo 'Y';
			}
			else 
			{
				echo 'N';	
			}
			
		}
    }
	
	
	
    /**
     * Deletes an existing Physicianmaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Physicianmaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Physicianmaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Physicianmaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
