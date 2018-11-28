<?php

namespace backend\controllers;

use Yii;
use backend\models\InCategorygroup;
use backend\models\InCategorygroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\TaxgroupingLog;
use yii\helpers\ArrayHelper;
use backend\models\InRoomtypes;
use backend\models\InCategory;
use backend\models\InCategoryReference;

/**
 * InCategorygroupController implements the CRUD actions for InCategorygroup model.
 */
class InCategorygroupController extends Controller
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
     * Lists all InCategorygroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InCategorygroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InCategorygroup model.
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
     * Creates a new InCategorygroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InCategorygroup();
		$model_cat = new InCategoryReference();
		$session = Yii::$app->session;
		// $tax_grouping=ArrayHelper::map(TaxgroupingLog::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
		$tax_grouping=ArrayHelper::map(TaxgroupingLog::find()->where(['is_active'=>1])->andWhere(['auto_id'=>170])->asArray()->all(), 'taxgroupid', 'hsncode');
		$category_list=ArrayHelper::map(InCategory::find()->where(['is_active'=>1])->asArray()->all(), 'autoid', 'category_name');
		$roomtype_list=ArrayHelper::map(InRoomtypes::find()->where(['is_active'=>1])->asArray()->all(), 'autoid', 'room_types');

        if ($model->load(Yii::$app->request->post()) ) {
			
		  $model->category_id = Yii::$app->request->post('InCategorygroup')['category_id'];
			$model->room_typeid = Yii::$app->request->post('InCategorygroup')['room_typeid'];
			$model->total = $_POST['total'];
			$model->is_active = Yii::$app->request->post('InCategorygroup')['is_active'];
			$model->created_date = date('Y-m-d H:i:s');
			$model->user_id = $session['user_id'];
			$model->user_role	= $session['authUserRole'];
         	$model ->ipaddress = $_SERVER['REMOTE_ADDR'];
			
			 if($model->save())
			 {
			 	$model_cat->category_id=$model->autoid;
				$model_cat->dr_visit_price=$_POST['dr_price'];
				$model_cat->dr_visit_hsn_code=$_POST['hsncode_dr'];
				$model_cat->nurse_price=$_POST['nurse_price'];
				$model_cat->nurse_hsn_code=$_POST['hsncode_nurse'];
				
				$model_cat->service_charge=$_POST['service_price'];
				$model_cat->service_hsn=$_POST['hsncode_service'];
				
				$model_cat->room_price=$_POST['room_price'];
				$model_cat->room_hsn=$_POST['hsncode_service'];
				
				
				$model_cat->created_date = date('Y-m-d H:i:s');
				$model_cat->user_id = $session['user_id'];
				$model_cat->user_role	= $session['authUserRole'];
         		$model_cat->ipaddress = $_SERVER['REMOTE_ADDR'];
				$model_cat->save();
				//print_r($model); 	print_r($model_cat); die;
			 }
             else 
             {
             	echo "0";
			 }		        	
            return $this->redirect(['index', 'id' => $model->autoid]);
        }

		
        return $this->render('create', [
            'model' => $model,
            'tax_grouping' => $tax_grouping,
            'category_list' =>$category_list,
            'roomtype_list'=>$roomtype_list,
          ]);
    }

    /**
     * Updates an existing InCategorygroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model_cat =InCategoryReference::find()->where(['category_id'=>$id])->asArray()->one();
		
		//print_r($model_cat); die;
		$session = Yii::$app->session;
		//$tax_grouping=ArrayHelper::map(TaxgroupingLog::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
		$tax_grouping=ArrayHelper::map(TaxgroupingLog::find()->where(['is_active'=>1])->andWhere(['auto_id'=>170])->asArray()->all(), 'taxgroupid', 'hsncode');
		$category_list=ArrayHelper::map(InCategory::find()->where(['is_active'=>1])->asArray()->all(), 'autoid', 'category_name');
		$roomtype_list=ArrayHelper::map(InRoomtypes::find()->where(['is_active'=>1])->asArray()->all(), 'autoid', 'room_types');
		$cat_ref=InCategoryReference::find()->where(['category_id'=>$id])->asArray()->one();
		$room_price=InRoomtypes::find()->where(['is_active'=>1])->andWhere(['autoid'=>$model->room_typeid])->asArray()->one();
		
		$tax_hsncode=TaxgroupingLog::find()->where(['is_active'=>1])->andWhere(['taxgroupid'=>$room_price['hsn_code']])->asArray()->one();
		$dr_hsncode=TaxgroupingLog::find()->where(['is_active'=>1])->andWhere(['taxgroupid'=>$cat_ref['dr_visit_hsn_code']])->asArray()->one();
		$nur_hsncode=TaxgroupingLog::find()->where(['is_active'=>1])->andWhere(['taxgroupid'=>$cat_ref['nurse_hsn_code']])->asArray()->one();
		
		$room_typeval[0]=$room_price['price'];
		$room_typeval[1]=$tax_hsncode['hsncode'];
		$room_typeval[2]=$dr_hsncode['hsncode'];
		$room_typeval[3]=$nur_hsncode['hsncode'];
		
        if ($model->load(Yii::$app->request->post()) ) {
			$model_catup =InCategoryReference::find()->where(['category_id'=>$id])->one();
		  $model->category_id = Yii::$app->request->post('InCategorygroup')['category_id'];
			$model->room_typeid = Yii::$app->request->post('InCategorygroup')['room_typeid'];
			$model->total = $_POST['total'];
			$model->is_active = Yii::$app->request->post('InCategorygroup')['is_active'];
			
			$model->user_id = $session['user_id'];
			$model->user_role	= $session['authUserRole'];
         	$model ->ipaddress = $_SERVER['REMOTE_ADDR'];
		
			 if($model->save())
			 { //print_r($_POST['nurse_price']); die;
			 	//$model_cat->category_id=$id;
				$model_catup->dr_visit_price=$_POST['dr_price'];
				$model_catup->dr_visit_hsn_code=$_POST['hsncode_dr'];
				$model_catup->nurse_price=$_POST['nurse_price'];
				$model_catup->nurse_hsn_code=$_POST['hsncode_nurse'];
				
				$model_catup->service_charge=$_POST['service_price'];
				$model_catup->service_hsn=$_POST['hsncode_service'];
				
				$model_catup->room_price=$_POST['room_price'];
				$model_catup->room_hsn=$_POST['hsncode_service'];
				
				$model_catup->user_id = $session['user_id'];
				$model_catup->user_role= $session['authUserRole'];
         		$model_catup->ipaddress = $_SERVER['REMOTE_ADDR'];
				$model_catup->save();
				 			
			 }
             else 
             {
             	echo "0";
			 }		        	
			
            return $this->redirect(['index', 'id' => $model->autoid]);
        }
        

        return $this->render('update', [
            'model' => $model,
             'tax_grouping' => $tax_grouping,
            'category_list' =>$category_list,
            'roomtype_list'=>$roomtype_list,
            'cat_ref'=>$cat_ref,
            'room_typeval'=>$room_typeval,
        ]);
    }

    /**
     * Deletes an existing InCategorygroup model.
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
     * Finds the InCategorygroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InCategorygroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InCategorygroup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	public function actionGetroomprice($roomtype)
   	{
   	   if($roomtype != '')
	   {
	 	 $room_price=InRoomtypes::find()->where(['autoid'=>$roomtype])->asArray()->one();
		 $tax_hsncode=TaxgroupingLog::find()->where(['is_active'=>1])->andWhere(['taxgroupid'=>$room_price['hsn_code']])->asArray()->one();
		 //echo"<pre>";print_r($tax_hsncode['hsncode']); die;
		 $resp[0]=$room_price['price'];
		 $resp[1]=$tax_hsncode['hsncode'];
		 return  json_encode($resp);
	   }

    }
}
