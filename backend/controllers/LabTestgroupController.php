<?php

namespace backend\controllers;

use Yii;
use backend\models\LabTestgroup;
use backend\models\LabTestgroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Testgroup;
use backend\models\TestgroupSearch;
use backend\models\LabTesting;
use yii\helpers\ArrayHelper;
/**
 * LabTestgroupController implements the CRUD actions for LabTestgroup model.
 */
class LabTestgroupController extends Controller
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
        ];
    }

    /**
     * Lists all LabTestgroup models.
     * @return mixed
     */
    public function actionIndex()
    {
    	//print_r("test"); die;
		$model = new Testgroup();
		$model_group = new LabTestgroup();
		$searchModel = new TestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
 		$testingmodel = new LabTesting();
		$testgrouplist=ArrayHelper::map(Testgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testlist=ArrayHelper::map(LabTesting::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'test_name');
      
   		if(!empty($_POST)){
   			//	echo "<pre>"; print_r($_POST); die;
			$lab_count=count($_POST['hid_testname']);
			
			for($i=0;$i<$lab_count;$i++){
				$model_group= new LabTestgroup();
				$model_group->testgroupid=$_POST['LabTesting']['test_name'];
				
				$model_group->test_nameid=$_POST['hid_testname'][$i];
				$model_group->save();
			}
   		//	echo "<pre>"; print_r($_POST); die;    
   		 	$model1=Testgroup::find()->Where(['autoid'=>$_POST['TestgroupSearch']['testgroupname']])->one();
			if(!empty($_POST['hid_testname'])){
				$test_name=implode(",",$_POST['hid_testname']);	
			}
		  	$model1->testnameid=$test_name;
			$model1->hsncode=$_POST['TestgroupSearch']['hsncode'];
		  	$model1->price=$_POST['TestgroupSearch']['price'];
			if($model1->save()){} else {  //print_r($model->getErrors());  
			}
			$model_test=LabTesting::find()->Where(['autoid'=>$_POST['LabTesting']['test_name']])->one();
			$model_test->testgroupid=$_POST['TestgroupSearch']['testgroupname'];
			$model_test->save();
			
			return $this->redirect(['index']);
		}
       
        return $this->render('index', [
            'model' => $model,
             'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'testingmodel' => $testingmodel,
            'testlist' =>$testlist,
            'testgrouplist' => $testgrouplist,
        ]);
		
        
    }

    /**
     * Displays a single LabTestgroup model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
    	 // print_r("test1212"); print_r($model_group); 
		  
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LabTestgroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LabTestgroup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->autoid]);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LabTestgroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->autoid]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LabTestgroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LabTestgroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LabTestgroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LabTestgroup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
