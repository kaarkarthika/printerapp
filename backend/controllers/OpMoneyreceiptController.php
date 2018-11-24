<?php

namespace backend\controllers;

use Yii;
use backend\models\OpMoneyreceipt;
use backend\models\OpMoneyreceiptSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\AuthorityMaster;
use backend\models\Paymenttype;
use yii\helpers\ArrayHelper;
/**
 * OpMoneyreceiptController implements the CRUD actions for OpMoneyreceipt model.
 */
class OpMoneyreceiptController extends Controller
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
     * Lists all OpMoneyreceipt models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OpMoneyreceiptSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OpMoneyreceipt model.
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
     * Creates a new OpMoneyreceipt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OpMoneyreceipt();
		$authority=ArrayHelper::map(AuthorityMaster::find()->where(['isactive'=>1])->all(),'autoid','authorityname');
		$paymenttype=ArrayHelper::map(Paymenttype::find()->where(['is_active'=>1])->all(),'payment_type_id','paymenttype');
		
        if ($model->load(Yii::$app->request->post())) 
        {
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'authority' => $authority,
            'paymenttype' => $paymenttype,
        ]);
    }

    /**
     * Updates an existing OpMoneyreceipt model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
    	
		$id=base64_decode(urldecode($id));
        $model = $this->findModel($id);

        $authority=ArrayHelper::map(AuthorityMaster::find()->where(['isactive'=>1])->all(),'autoid','authorityname');
        $paymenttype=ArrayHelper::map(Paymenttype::find()->where(['is_active'=>1])->all(),'payment_type_id','paymenttype');
        if ($model->load(Yii::$app->request->post())) 
        {
        	
            //return $this->redirect(['index']);
            $model->total_amt =$_POST['OpMoneyreceipt']['total_amt'];
			$model->org_disc_amt =$_POST['OpMoneyreceipt']['org_disc_amt'];
			$model->amount_words =$_POST['OpMoneyreceipt']['amount_words'];
			$model->payment_by =$_POST['OpMoneyreceipt']['payment_by'];
			$model->towards =$_POST['OpMoneyreceipt']['towards'];
			$model->auth_by =$_POST['OpMoneyreceipt']['auth_by'];
			$model->bank_name =$_POST['OpMoneyreceipt']['bank_name'];
			$model->remarks =$_POST['OpMoneyreceipt']['remarks'];
			if($model->save())
			{
				return $this->redirect(['index']);
			}
			else {
				print_r($model->getErrors());die;
			}
        }
		
        return $this->render('update', [
            'model' => $model,
            'authority' => $authority,
            'paymenttype' => $paymenttype,
        ]);
    }

    /**
     * Deletes an existing OpMoneyreceipt model.
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
     * Finds the OpMoneyreceipt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return OpMoneyreceipt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OpMoneyreceipt::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
