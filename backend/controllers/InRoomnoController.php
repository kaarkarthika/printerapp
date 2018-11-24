<?php

namespace backend\controllers;

use Yii;
use backend\models\InRoomno;
use backend\models\InRoomnoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\InFloormaster;
use backend\models\InRoomtypes;
/**
 * InRoomnoController implements the CRUD actions for InRoomno model.
 */
class InRoomnoController extends Controller
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
     * Lists all InRoomno models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$floormaster = ArrayHelper::map(InFloormaster::find()->where(['is_active'=>'1'])->all(), 'autoid', 'floor_no');
		$roomtypes = ArrayHelper::map(InRoomtypes::find()->where(['is_active'=>'1'])->all(), 'autoid', 'room_types');
		$searchModel = new InRoomnoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'floormaster'=> $floormaster,
            'roomtypes' => $roomtypes,
        ]);
    }

    /**
     * Displays a single InRoomno model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new InRoomno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InRoomno();
		$session = Yii::$app->session;
        if ($model->load(Yii::$app->request->post())) 
        {
           $model->room_no =Yii::$app->request->post('InRoomno')['room_no'];
           $model->floorid =Yii::$app->request->post('InRoomno')['floorid'];
           $model->	roomtypeid =Yii::$app->request->post('InRoomno')['roomtypeid'];
           $model->	is_active =Yii::$app->request->post('InRoomno')['is_active'];
           $model->	created_date = date('Y-m-d H:i:s');
		   $model->user_id = $session['user_id'];
		   $model-> user_role	= $session['authUserRole'];
           $model -> ipaddress = $_SERVER['REMOTE_ADDR'];
		   
		   if($model->save())   
		   {
			 	echo "S";  
		   }
	       else 
	       {
	         	echo "N";
		   }
		      return $this->redirect(['index', 'id' => $model->autoid]);
		 
        }
		else 
		{
			$floormaster = ArrayHelper::map(InFloormaster::find()->where(['is_active'=>'1'])->all(), 'autoid', 'floor_no');
			$roomtypes = ArrayHelper::map(InRoomtypes::find()->where(['is_active'=>'1'])->all(), 'autoid', 'room_types');
			
			return $this->renderAjax('create', [
            'model' => $model,
            'floormaster'=> $floormaster,
            'roomtypes' => $roomtypes,
        ]);
		}
        
    }

    /**
     * Updates an existing InRoomno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->room_no =Yii::$app->request->post('InRoomno')['room_no'];
           $model->floorid =Yii::$app->request->post('InRoomno')['floorid'];
           $model->	roomtypeid =Yii::$app->request->post('InRoomno')['roomtypeid'];
           $model->	is_active =Yii::$app->request->post('InRoomno')['is_active'];
           $model->	created_date = date('Y-m-d H:i:s');
		   $model->user_id = $session['user_id'];
		   $model-> user_role	= $session['authUserRole'];
           $model -> ipaddress = $_SERVER['REMOTE_ADDR'];
		   
		   if($model->save())   
		   {
			 	echo "S";  
		   }
	       else 
	       {
	         	echo "N";
		   }
		      return $this->redirect(['index', 'id' => $model->autoid]);
		   
        }
		else {
			$floormaster = ArrayHelper::map(InFloormaster::find()->where(['is_active'=>'1'])->all(), 'autoid', 'floor_no');
			$roomtypes = ArrayHelper::map(InRoomtypes::find()->where(['is_active'=>'1'])->all(), 'autoid', 'room_types');
			
			return $this->renderAjax('update', [
            'model' => $model,
            'floormaster'=> $floormaster,
            'roomtypes' => $roomtypes,
        ]);
		}
        
    }

    /**
     * Deletes an existing InRoomno model.
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
     * Finds the InRoomno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InRoomno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InRoomno::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
