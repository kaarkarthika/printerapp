<?php

namespace backend\controllers;

use Yii;
use backend\models\Emailtemplate;
use backend\models\EmailtemplateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\CompanyBranch;

/**
 * EmailtemplateController implements the CRUD actions for Emailtemplate model.
 */
class EmailtemplateController extends Controller
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
     * Lists all Emailtemplate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmailtemplateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	/* public function actionCompose()
    {
        $searchModel = new EmailtemplateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('compose', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/
	
	 public function actionCompose()
    {
        $model = new Emailtemplate();
		$session=Yii::$app->session;

        if ($model->load(Yii::$app->request->post())) {
        
        	
        	$model->email_status=$_POST['emailkey'];
			$model->branch_id=$session['branch_id'];
			$model->message=$_POST['message_content'];
			//echo $session['branch_id'];exit;
			$fetch_email=CompanyBranch::find()->where(['branch_id'=>$session['branch_id']])->one();
			$model->userfrom=$fetch_email->email_id;
			$model->isread="U";	
			$model->created_at=date("Y-m-d H:i:s");
			$model->datesent=date("Y-m-d H:i:s");
			if($model->save()){
				return $this->redirect(['index']);
			}else{
				
			}
            
        } else {
            return $this->render('compose', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single Emailtemplate model.
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
     * Creates a new Emailtemplate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Emailtemplate();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->emailid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Emailtemplate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->emailid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Emailtemplate model.
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
     * Finds the Emailtemplate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Emailtemplate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Emailtemplate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
