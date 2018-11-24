<?php

namespace backend\controllers;

use Yii;
use backend\models\Manufacturermaster;
use backend\models\ManufacturermasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\BranchAdmin;
use yii\filters\AccessControl;

/**
 * ManufacturermasterController implements the CRUD actions for Manufacturermaster model.
 */
class ManufacturermasterController extends Controller
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
     * Lists all Manufacturermaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ManufacturermasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Manufacturermaster model.
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
     * Creates a new Manufacturermaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
    
    public function actionCreate()
    {
        $model = new Manufacturermaster();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    } */
	public function actionCreate()
    {
    	
               $model = new Manufacturermaster();
		
       if ($model->load(Yii::$app->request->post()) )
	    {
	    	//print_r(Yii::$app->request->post());die;
        	 $session = Yii::$app->session;
		     $manufacturername=trim(ucwords(Yii::$app->request->post('Manufacturermaster')['manufacturer_name']));
			 $manufacturerdescription=trim(Yii::$app->request->post('Manufacturermaster')['manufacturer_description']);
			  $model->updatedby=$session['user_id'];
			 $model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			 $model->updatedon=date("Y-m-d H:i:s");
			 $model->manufacturer_name=$manufacturername;
			 $model->manufacturer_description=$manufacturerdescription;
			 $model->is_active=Yii::$app->request->post('Manufacturermaster')['is_active'];
		
			 	    if($model->save())   {echo "S";  }
                    else {echo "N";}
               
			 
			 
			 
	       
			
			
	   }
        
        else {
        	
			
			
            return $this->renderAjax('create', ['model' => $model ]);
                
                
           
        }
    }

    /**
     * Updates an existing Manufacturermaster model.
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
		    $manufacturername=trim(ucwords(Yii::$app->request->post('Manufacturermaster')['manufacturer_name']));
			 $manufacturerdescription=trim(Yii::$app->request->post('Manufacturermaster')['manufacturer_description']);
			  $model->updatedby=$session['user_id'];
			 $model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			 $model->updatedon=date("Y-m-d H:i:s");
			 $model->manufacturer_name=$manufacturername;
			 $model->manufacturer_description=$manufacturerdescription;
			$model->save();
		
			 
			 
			
			 	    if($model->save())   {echo "U";  }
                    else {echo "N";}
               
			 
			 
			 
	       
			
			
	   }
	   
	   else {
        	
            return $this->renderAjax('update', [ 'model' => $model]);
               
                 
           
        }
    }
    
    /**
     * Deletes an existing Manufacturermaster model.
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
     * Finds the Manufacturermaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Manufacturermaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Manufacturermaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
