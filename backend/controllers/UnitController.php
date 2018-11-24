<?php
namespace backend\controllers;
use Yii;
use backend\models\Unit;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\UnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\models\Producttype;
use backend\models\BranchAdmin;
class UnitController extends Controller
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
        $searchModel = new UnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$items = ArrayHelper::map(Producttype::find()->all(), 'product_typeid', 'product_type');
		//print_r($dataProvider);die;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'items'=>$items,
        ]);
    }

    /**
     * Displays a single Unit model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Unit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */ 
     public function actionCreate()
	{
	       $model = new Unit();

			if ($model->load(Yii::$app->request->post()))
			{
		
			$session = Yii::$app->session;
			$model->updated_by=$session['user_id'];
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			$model->is_active=Yii::$app->request->post('Unit')['is_active'];
			$model->is_tablet=Yii::$app->request->post('Unit')['is_tablet'];
			
			if($model->save()){echo "Y";}else{echo "N";}
			}

			else {
		$items = ArrayHelper::map(Producttype::find()->where([
		'is_active'=>'1'])->all(), 'product_typeid', 'product_type');
		return $this->renderAjax('create', ['model' => $model,'items'=>$items]);
		
		}
		}

    /**
     * Updates an existing Unit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */ 
     
     
     public function actionUpdate($id)
	{
	$model = $this->findModel($id);
	if ($model->load(Yii::$app->request->post()))
	{
	$session = Yii::$app->session;
	$model->updated_by=$session['user_id'];
	$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
	$model->updated_on=date("Y-m-d H:i:s");
	$model->is_active=Yii::$app->request->post('Unit')['is_active'];
	$model->is_tablet=Yii::$app->request->post('Unit')['is_tablet'];
	if($model->save()){echo "Y";}else{echo "N";}
	}

	else {
			$items = ArrayHelper::map(Producttype::find()->where([
			'is_active'=>'1'])->all(), 'product_typeid', 'product_type');
			return $this->renderAjax('update', [
			'model' => $model,
			'items'=>$items,
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
        if (($model = Unit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
