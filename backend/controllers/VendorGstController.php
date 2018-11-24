<?php
namespace backend\controllers;
use Yii;
use backend\models\VendorGst;
use backend\models\VendorGstSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Vendor;
use backend\models\States;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use backend\models\BranchAdmin;

class VendorGstController extends Controller {

	public function behaviors() {
		return ['verbs' => ['class' => VerbFilter::className(), 'actions' => ['delete' => ['POST'], ], ], 'access' => ['class' => AccessControl::className(), 'rules' => [['allow' => true, 'roles' => ['@'], ],

		]]];
	}

	public function beforeAction($action) {
		return BranchAdmin::checkbeforeaction();
	}

	public function actionIndex() {
		$searchModel = new VendorGstSearch();
		$dataProvider = $searchModel -> search(Yii::$app -> request -> queryParams);
		$vendorlist = ArrayHelper::map(Vendor::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'vendorid', 'vendorname');
			$statelist = ArrayHelper::map(States::find() -> asArray() -> all(), 'stateid', 'state_name');

		return $this -> render('index', ['searchModel' => $searchModel, 'vendorlist'=>$vendorlist,'statelist'=>$statelist,'dataProvider' => $dataProvider, ]);
	}

	public function actionView($id) {
		return $this -> renderAjax('view', ['model' => $this -> findModel($id), ]);
	}

	public function actionCreate() {
		$model = new VendorGst();
		if ($model -> load(Yii::$app -> request -> post())) 
		{
			$session = Yii::$app -> session;
			$model -> updated_by = $session['user_id'];
			$model -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			$model -> updated_on = date("Y-m-d H:i:s");
			$gstin = Yii::$app -> request -> post('VendorGst')['gst_tax'];
			$gstlength = strlen($gstin);
              if ($gstlength == 15) 
              {
              	$vendorid = Yii::$app -> request -> post('VendorGst')['vendor_id'];
			$state = Yii::$app -> request -> post('VendorGst')['state'];
                     $vendordata = VendorGst::find() -> where(['vendor_id' => $vendorid]) -> andwhere(['state' => $state]) -> one();
					 
					  $vendorgstdata = VendorGst::find() -> where(['gst_tax' => $gstin])-> one();
				
			if (count($vendordata)==1)
			{echo "A";
			} 
			
			else if (count($vendorgstdata)==1)
			{echo "A";
			} 
			
			
			
			else  {$model->save();echo "Y";} 
				} 
				else 
				{
					echo "V";
				}
			

		} 
		else 
		{
			$vendorlist = ArrayHelper::map(Vendor::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'vendorid', 'vendorname');
			$statelist = ArrayHelper::map(States::find() -> asArray() -> all(), 'stateid', 'state_name');
			return $this -> renderAjax('create', ['model' => $model, 'vendorlist' => $vendorlist, 'statelist' => $statelist]);

		}
	}

	public function actionUpdate($id) {
		$model = $this -> findModel($id);

		if ($model -> load(Yii::$app -> request -> post())) 
		{
			$session = Yii::$app -> session;
			$model -> updated_by = $session['user_id'];
			$model -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			$model -> updated_on = date("Y-m-d H:i:s");
			$gstin = Yii::$app -> request -> post('VendorGst')['gst_tax'];
			$gstlength = strlen($gstin);
              if ($gstlength == 15) 
              {
              	$vendorid = Yii::$app -> request -> post('VendorGst')['vendor_id'];
			$state = Yii::$app -> request -> post('VendorGst')['state'];
                     $vendordata = VendorGst::find() -> where(['vendor_gst_id' => $id])  -> one();
				
			if (count($vendordata)==1)
			{
				if($vendorid==($vendordata->vendor_id) && $state==($vendordata->state))
				{
					$model->save();echo "Y";
				}
				else
				{
					 $vendordata1 = VendorGst::find() -> where(['vendor_id' => $vendorid]) -> andwhere(['state' => $state]) -> one();
				
			if (count($vendordata1)==1)
			{echo "A";
			} 
			else  {$model->save();echo "Y";} 
				}
			
			
			} 
		
				} 
				else 
				{
					echo "V";
				}
			

		}  else {
			$vendorlist = ArrayHelper::map(Vendor::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'vendorid', 'vendorname');
			$statelist = ArrayHelper::map(States::find() -> asArray() -> all(), 'stateid', 'state_name');
			return $this -> renderAjax('update', ['model' => $model, 'vendorlist' => $vendorlist, 'statelist' => $statelist]);
		}
	}

	public function actionDelete($id) {
		$this -> findModel($id) -> delete();
		return $this -> redirect(['index']);
	}

	protected function findModel($id) {
		if (($model = VendorGst::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
