<?php

namespace backend\controllers;

use Yii;
use backend\models\Chat;
use backend\models\ChatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\BranchAdmin;
/**
 * ChatController implements the CRUD actions for Chat model.
 */
class ChatController extends Controller
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
     * Lists all Chat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Chat model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Chat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Chat();
		$session=Yii::$app->session;
        if ($_POST) {
        	
        	$model->from_user=$session['user_id'];
			$model->to_user=$_POST['touser'];
		    $model->message=utf8_encode($_POST['note']); 
        	$model->created_at=date("Y-m-d H:i:s");
			if($model->save()){
				$from_user_fetch=BranchAdmin::find()->where(['ba_autoid'=>$model->from_user])->one();
				$from_user_name=$from_user_fetch->ba_name;
				$content.='<li class="clearfix odd t123">
                           <div class="conversation-text">
                              <div class="ctext-wrap">
                                 <i>'.ucwords($from_user_name).'</i>
                                 <p>
                                 '.utf8_decode($model->message).'
                                 </p>
                                  <p>
                                 '.date("d-M-y h:i A",strtotime($model->created_at)).'
                                 </p>
                              </div>
                           </div>
                        </li>';
			}
			return $content;
           // return $this->redirect(['view', 'id' => $model->autoid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Chat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->autoid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionChatbox($id){
	return $this->renderAjax('chatbox', [
                'id' => $id,'model'=>$model,
            ]);
	}

    /**
     * Deletes an existing Chat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Chat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Chat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
