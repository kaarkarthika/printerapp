<?php
namespace backend\controllers;
use Yii;
use backend\models\Transferstock;
use backend\models\TransferstockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Arrayhelper;
use yii\filters\AccessControl;
use backend\models\CompanyBranch;
use backend\models\Vendor;
use backend\models\Productgrouping;
use backend\models\Stockmaster;
use backend\models\Product;
use yii\widgets\ActiveForm;
use backend\models\BranchAdmin;
use yii\helpers\Html;
use backend\models\Transferstockdetails;
use backend\models\Transferstockreceive;
use backend\models\Transferstockapprove;
use backend\models\Stockresponse;
use backend\models\Unit;
use backend\models\Transferstockreturn;
use backend\models\VendorBranch;
use backend\models\Transferstockreturnapprove;


class TransferstockController extends Controller {
	public function behaviors() {
		return ['verbs' => ['class' => VerbFilter::className(), 'actions' => ['delete' => ['POST'], ], ], 'access' => ['class' => AccessControl::className(), 'rules' => [['allow' => true, 'roles' => ['@']]]]];
	}

	public function beforeAction($action) {
		return BranchAdmin::checkbeforeaction();
	}

	public function actionIndex() {
		$searchModel = new TransferstockSearch();
		$dataProvider = $searchModel -> search(Yii::$app -> request -> queryParams);

		return $this -> render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, ]);
	}

	public function actionApprovedformdetail($id, $transferstockid, $autonumber) {

		return $this -> renderAjax('ts_approvedformdetail', ['id' => $id, 'model' => $model, 'transferstockid' => $transferstockid, 'autonumber' => $autonumber]);
	}

	public function actionApprove() {
		$searchModel = new TransferstockSearch();
		$dataProvider = $searchModel -> approvesearch(Yii::$app -> request -> queryParams);
		
		return $this -> render('approve', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, ]);
	}

	public function actionReceive() {
		$searchModel = new TransferstockSearch();
		$dataProvider = $searchModel -> receivesearch(Yii::$app -> request -> queryParams);

		return $this -> render('receive', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, ]);
	}
	
	public function actionReturn() {
		$searchModel = new TransferstockSearch();
		$dataProvider = $searchModel -> returnsearch(Yii::$app -> request -> queryParams);

		return $this -> render('return', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, ]);
	}
	
	
	
	
	public function actionReturnapprove() 
	{
		$searchModel = new TransferstockSearch();
		$dataProvider = $searchModel -> returnapprovesearch(Yii::$app -> request -> queryParams);
		return $this -> render('returnapprove', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, ]);
	}
	
	
	
	
	public function actionView($id) {
		return $this -> renderAjax('view', ['model' => $this -> findModel($id), ]);
	}

	public function actionCreate() {
		$model = new Transferstock();
		if ($model -> load(Yii::$app -> request -> post()) && $model -> save()) {
			return $this -> redirect(['view', 'id' => $model -> transferstockid]);
		} else {

			$company = Stockmaster::find() -> select('branch_id') -> distinct() -> all();
			foreach ($company as $companydata) {
				$cd[] = $companydata -> branch_id;
			}
			$session = Yii::$app -> session;
			$role = $session['authUserRole'];
			$branchid = $session['branch_id'];
         if(isset($session['branch_id']))
		 {
		 	$companylist = ArrayHelper::map(CompanyBranch::find() -> where(['is_active' => 1]) ->  asArray() -> all(), 'branch_id', 'branch_name');
			$companylist1 = ArrayHelper::map(CompanyBranch::find() -> where(['is_active' => 1]) -> andwhere(['IN', 'branch_id', $cd]) -> andwhere(['NOT IN', 'branch_id', $branchid]) -> asArray() -> all(), 'branch_id', 'branch_name');
			$vendorlist = ArrayHelper::map(Vendor::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'vendorid', 'vendorname');
			$productlist = ArrayHelper::map(Product::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'productid', 'productname');
		    return $this -> render('create', ['model' => $model, 'companylist' => $companylist, 'companylist1' => $companylist1, 'vendorlist' => $vendorlist,
		    'productlist' => $productlist,]);
			
			
		 }
		}
	}

	public function actionGetproduct($id) {
		$session = Yii::$app -> session;
		$companybranchid = $session['branch_id'];

		$rows = Stockmaster::find() -> select('productid') -> distinct() -> where(['vendorid' => $id]) -> andwhere(['is_active' => 1]) -> all();

		if (count($rows) > 0) {

			foreach ($rows as $row) {

				$rows1 = Product::find() -> where(['productid' => $row -> productid]) -> one();
				if ($rows1 -> productid != "") {
					echo "<option value='$rows1->productid'>$rows1->productname</option>";
				} else {

					echo "<option >----</option>";
				}
			}
		}

	}

	public function actionGettobranch($id) {
	
		$branchlist = CompanyBranch::find() -> where(['is_active' => 1]) -> andwhere(['NOT IN', 'branch_id', $id])  -> all();
		if (count($branchlist) > 0) {
			foreach ($branchlist as $row) {
				echo "<option value='$row->branch_id'>$row->branch_name</option>";
			}
		}

	}

	public function actionAddtransferstock() {

		$model = new Transferstock();
		
		$products = Yii::$app -> request -> post('Transferstock')['productid'];
		

		$frombranch = Yii::$app -> request -> post('Transferstock')['frombranch'];
		if (!empty($frombranch)) {
			$frombranchdata = CompanyBranch::find() -> where(['branch_id' => $frombranch]) -> one();
			$frombranchname = $frombranchdata -> branch_name;
		} else {
			$frombranchname = "";
		}

		$tobranch = Yii::$app -> request -> post('Transferstock')['tobranch'];
		if (!empty($tobranch)) {
			$tobranchdata = CompanyBranch::find() -> where(['branch_id' => $tobranch]) -> one();
			$tobranchname = $tobranchdata -> branch_name;
		} else {
			$tobranchname = "";
		}

		if ($products != "") {

			echo $this -> renderAjax('gridform', ['model' => $model,  'products' => $products,  'frombranch' => $frombranch, 'tobranch' => $tobranch, 'frombranchname' => $frombranchname, 'tobranchname' => $tobranchname, ]);

		}

	}

	public function actionSavetransferstock() {

		$productid = Yii::$app -> request -> post('Transferstock')['productid'];
		$frombranch = Yii::$app -> request -> post('Transferstock')['frombranch'];
		$tobranch = Yii::$app -> request -> post('Transferstock')['tobranch'];
		
		if ($productid != "") {
			$session = Yii::$app -> session;
			$userid = $session['user_id'];
			$ip = $_SERVER['REMOTE_ADDR'];
			$i = 1;
			$transferstockrequestdata=	Transferstock::find()->orderBy(['transferstockid' => SORT_DESC])->one();
			$transferstockincrement=$transferstockrequestdata->transferstockincrement+1;
			$rc = "TS/" . date("Y") . "/" . date('m') . "/" . ($transferstockincrement);
			foreach ($productid as $key => $value) {
				$transfermodel = new Transferstock();
				$quantity = Yii::$app -> request -> post('transferstockquantity' . $i);
				$transfermodel ->frombranch = $frombranch;
				$transfermodel -> tobranch = $tobranch;
				$transfermodel -> transferstockdate = date("Y-m-d");
				$transfermodel -> transferstock_requestcode = $rc;
				$transfermodel -> status = "Requested";
				$transfermodel -> productid = $value;
				$transfermodel -> transferstockquantity = $quantity;
				$transfermodel -> unit = Yii::$app -> request -> post('Transferstock')['unit'][$key];
				$transfermodel->transferstockincrement=$transferstockincrement;
				$transfermodel->total_no_of_quantity= Yii::$app -> request -> post('totalunits' . $i);
				$transfermodel -> updated_by = $userid;
				$transfermodel -> updated_ipaddress = $ip;
				$transfermodel -> updated_on = date("Y-m-d H:i:s");
				$transfermodel -> save();
				++$i;
			}

		}

                
                   Yii::$app->getSession()->setFlash('success','Request Added successfully');
				  return $this->redirect(['index']);




	}

	public function actionUpdate($id) {
		$model = $this -> findModel($id);

		if ($model -> load(Yii::$app -> request -> post())) {

			$productid = Yii::$app -> request -> post('Transferstock')['productid'];

			$transferstockid = Yii::$app -> request -> post('Transferstock')['transferstockid'];

			if ($transferstockid) {
				$session = Yii::$app -> session;
				$userid = $session['user_id'];
				$ip = $_SERVER['REMOTE_ADDR'];

				$i = 1;

				foreach ($transferstockid as $key => $value) 
				{
					$transfermodel = Transferstock::findOne($value);
					$quantity = Yii::$app -> request -> post('transferstockquantity' . $i);
					$transfermodel -> transferstockquantity = $quantity;
					$transfermodel -> unit = Yii::$app -> request -> post('Transferstock')['unit'][$key];
					$transfermodel -> total_no_of_quantity = Yii::$app -> request -> post('totalunits' . $i);
					$transfermodel -> save();
					++$i;
				}

			}
          Yii::$app->getSession()->setFlash('success','Request Updated successfully');
			return $this -> redirect(['index']);

		} else {
			return $this -> render('update', ['model' => $model, ]);
		}
	}

	public function actionDelete($id) {
		$this -> findModel($id) -> delete();

		return $this -> redirect(['index']);
	}

	protected function findModel($id) {
		if (($model = Transferstock::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionTransferstockapprove($id) {
		

		$model1 = Transferstock::find() -> where(['transferstockid' => $id]) -> one();
		$requestcode = $model1 -> transferstock_requestcode;
		$model2 = "";
		if ($model1 != "") {
			$model2 = Transferstock::find() -> where(['transferstockid' => $id]) -> all();

		}
		$model = Transferstockapprove::find() -> where(['transferstockid' => $id]) -> one();
		if ($model == "") {
			$model = new Transferstockapprove();
		}
		if ($model -> load(Yii::$app -> request -> post())) {
			$session = Yii::$app -> session;

			$data = Yii::$app -> request -> post('approvedquantity');
			foreach ($data as $key => $value) {
				
				$responseid = Yii::$app -> request -> post('responseid')[$key];
				$transferstockid = Yii::$app -> request -> post('transferstockid')[$key];
				$model = new Transferstockapprove();
				$approveddata = Stockresponse::find() -> where(['stockresponseid' => $responseid]) -> one();
				$session = Yii::$app -> session;
				$model -> approveddate = date("Y-m-d");
				$model -> transferstockid = $transferstockid;
				$model -> transferstock_requestcode = Yii::$app -> request -> post('Transferstockapprove')['transferstock_requestcode'];
				$batchnumber = $approveddata -> batchnumber;
				$model -> batchnumber = $batchnumber;
				$model -> expiredate = $approveddata -> expiredate;
					
				if($approveddata -> purchasedate != '')
				{
					$model -> purchasedate = $approveddata -> purchasedate;
				}
				else {
					$model -> purchasedate = date('Y-m-d');
				}
				if($approveddata -> manufacturedate != '')
				{
					$model -> manufacturedate = $approveddata -> manufacturedate;
					
				}
				else {
					$model -> manufacturedate = date('Y-m-d');
				}
				
				
				$totalprice=Yii::$app -> request -> post('totalprice')[$key];
				$model -> pricepertransferstock = $totalprice;
				$model -> priceperquantity = Yii::$app -> request -> post('priceperquantity')[$key];
				$approvedquantity=Yii::$app -> request -> post('approvedquantity')[$key];
				$model -> approvedquantity = $approvedquantity;
				$unitquantity=Yii::$app -> request -> post('unitquantity')[$key];
				$unit=Yii::$app -> request -> post('unit')[$key];
				$totalapprovedquantity=$unitquantity*$approvedquantity;
				$model->unitquantity=$unitquantity;
				$model->unit=$unit;
				$model->totalapprovedquantity=$totalapprovedquantity;
				$model -> updated_by = $session['user_id'];
				$model -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
				$model -> updated_on = date("Y-m-d H:i:s");
				$model->stockid=$approveddata->stockid;
				$model->stockresponseid=$approveddata->stockresponseid;
				$gstrate=$approveddata->gstpercent;
				$model->gstrate=$gstrate;
				$model->gstvalue=($gstrate*$totalprice)/100;
				$discountrate=$approveddata->discountpercent;
				$model->discountrate=$discountrate;
				$model->discountvalue=($discountrate*$totalprice)/100;
				$data = Transferstock::find() -> where(['transferstockid' => $transferstockid]) -> one();
				$productid = $data -> productid;
				$vendorid = Yii::$app -> request -> post('vendorid')[$key];
				$frombranchid=$data -> frombranch;
				$branchid = $data -> tobranch;
				$transferstockapprovedmodel = Transferstockapprove::find() -> where(['transferstockid' => $transferstockid]) -> one();
				if ($model -> save()) {
					$transferstockrequestmodel = Transferstock::find() -> where(['transferstockid' => $transferstockid]) -> andwhere(['status' => 'Requested']) -> one();
				   if ($transferstockrequestmodel) {
							//stockmaster
		$stockmaster = Stockmaster::find() ->where(['stockid' => $model->stockid]) -> one();
		$stockmaster -> quantity = $stockmaster -> quantity - $model -> approvedquantity;
		$stockmaster -> total_no_of_quantity = $stockmaster -> total_no_of_quantity - $model -> totalapprovedquantity;
		$stockmaster->price=$stockmaster->price-$model->pricepertransferstock;
		$stockmaster -> updated_on = date("Y-m-d H:i:s");
		if(($stockmaster->total_no_of_quantity)>=0)
		{
			$stockmaster -> save();
		}
		$stockreceivemaster = Stockresponse::find() -> where(['stockresponseid' => $model -> stockresponseid])->one();
		$stockreceivemaster -> receivedquantity = $stockreceivemaster -> receivedquantity - $model -> approvedquantity;
		$stockreceivemaster -> total_no_of_quantity = $stockreceivemaster -> total_no_of_quantity - $model->totalapprovedquantity;
		$stockreceivemaster -> updated_on = date("Y-m-d H:i:s");
		$stockreceivemaster->mrp=$stockreceivemaster->mrp-$model->pricepertransferstock;
		if(($stockreceivemaster->total_no_of_quantity) >=0)
		{
		$stockreceivemaster -> save();
		}
					
					if ($stockmaster -> save() && $stockreceivemaster -> save())
					{
						$transferstockrequestmodel -> status = "Approved";
						$transferstockrequestmodel -> save();
						$result=1;
					}
					}
				}
				else {
					print_r($model->getErrors());die;	
				}
			}
            if($result)
			{
				Yii::$app -> getSession() -> setFlash('success', 'Transfer Stock Approved  successfully');
			}
			
			return $this -> redirect('?r=transferstock/approve');

		} else {

			return $this->render('ts_approvegridform', ['model' => $model, 'requestcode' => $requestcode, 'model1' => $model1, 'model2' => $model2, 'model3' => $model3, ]);
		}
	}

	public function actionTransferstockreceive($id) {
		$model1 = Transferstock::find() -> where(['transferstockid' => $id]) -> one();
		$requestcode = $model1 -> transferstock_requestcode;
		$model2 = "";
		if ($model1 != "") {
			$model2 = Transferstock::find() -> where(['transferstock_requestcode' => $model1 -> transferstock_requestcode]) -> all();
		}
		$model = Transferstockapprove::find() -> where(['transferstock_requestcode' => $requestcode]) -> one();
		if ($model == "") {
			$model = new Transferstockapprove();
		}

		if ($model -> load(Yii::$app -> request -> post())) {

			$session = Yii::$app -> session;
			$i = 1;
			foreach (Yii::$app->request->post() as $key => $value) {
				$transferstockapproveid= Yii::$app -> request -> post('transferstockapproveid' . $i);

				$modeltsk = Transferstockreceive::find() -> where(['transferstockapproveid' => $transferstockapproveid]) -> one();

				if ($modeltsk == "") {
					$modeltsk = new Transferstockreceive();
				}

				$session = Yii::$app -> session;

				$modeltsk -> receiveddate = date("Y-m-d");

				$expiredate = Yii::$app -> request -> post('expiredate' . $i);
				$modeltsk -> transferstockid = Yii::$app -> request -> post('transferstockid' . $i);
				$modeltsk -> transferstock_requestcode = Yii::$app -> request -> post('Transferstockapprove')['transferstock_requestcode'];
				$batchnumber = Yii::$app -> request -> post('batchnumber' . $i);
				$modeltsk -> batchnumber = $batchnumber;
				$modeltsk -> expiredate = date("Y-m-d", strtotime($expiredate));
				$purchaseddate = Yii::$app -> request -> post('purchasedate' . $i);
				$modeltsk -> purchasedate = date("Y-m-d", strtotime($purchaseddate));
				$manufacturedate = Yii::$app -> request -> post('manufacturedate' . $i);
				$modeltsk -> manufacturedate = date("Y-m-d", strtotime($manufacturedate));
				$purchaseprice = Yii::$app -> request -> post('purchaseprice' . $i);
				$modeltsk -> pricepertransferstock = $purchaseprice;
				$priceperquantity = Yii::$app -> request -> post('priceperquantity' . $i);
				$modeltsk -> priceperquantity = $priceperquantity;
				$unit = Yii::$app -> request -> post('unit' . $i);
				$modeltsk -> unit = $unit;
				$unitdata = Unit::find() -> where(['unitid' => $unit]) -> one();
				$noofunits = $unitdata -> no_of_unit;
				$approvedquantity = Yii::$app -> request -> post('approvedquantity' . $i);
				$modeltsk -> receivedquantity = $approvedquantity;
				$modeltsk -> total_no_of_quantity = $noofunits * $approvedquantity;
				$modeltsk -> updated_by = $session['user_id'];
				$modeltsk -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
				$modeltsk -> updated_on = date("Y-m-d H:i:s");
				$modeltsk->transferstockapproveid=$transferstockapproveid;
				$data = Transferstock::find() -> where(['transferstockid' => $modeltsk -> transferstockid]) -> one();
				$approvedata = Transferstockapprove::find() -> where(['transferstockid' => $modeltsk -> transferstockid]) -> one();
				
				$productid = $data -> productid;
				$stockid = $approvedata -> stockid;
				$stockdata=Stockmaster::find() -> where(['stockid' => $stockid])->one();
				$vendorid=$stockdata->vendorid;
				$tobranchid = $data -> tobranch;
				$frombranchid = $data -> frombranch;
				$status=Yii::$app -> request -> post('status' . $i);
				$modeltsk->status=$status;
				if($status=="Received")
				{
		
				$transferstockreceivedmodel = Transferstockreceive::find() -> where(['transferstockid' => $modeltsk -> transferstockid]) -> one();
				if ($modeltsk -> save()) {
				$transferstockapprovemodel = Transferstock::find() -> where(['transferstockid' => $modeltsk->transferstockid]) -> andwhere(['status' => 'Approved'])->one();
					if($transferstockapprovemodel)
					{
						 $transferstockapprovemodel -> status = "Received";
						 $transferstockapprovemodel -> save();
					}
				 $stock = Stockmaster::find() -> where(['productid' => $productid]) -> andwhere(['vendorid' => $vendorid]) -> andwhere(['branch_id' => $frombranchid]) -> one();
						    $approvedbranch = Stockmaster::find() -> where(['productid' => $productid]) -> andwhere(['vendorid' => $vendorid]) -> andwhere(['branch_id' => $frombranchid]) -> one();
							
							if(empty($stock))
							{
								$stock=new Stockmaster();
								$stockdata=Stockmaster::find()->orderBy(['stockid' => SORT_DESC])->one();
								 $stock->serialnumber=$stockdata->stockid+1;
								 $qty=0;
								 $priceperqty=0;
								 $price=0;
								 $totalqty=0;
							}
							else{
								
								if($transferstockreceivedmodel)
								{
							    $qty=$stock->quantity-$transferstockreceivedmodel->receivedquantity;
								$price=$stock->price-$transferstockreceivedmodel->pricepertransferstock;
								$totalqty=$stock->total_no_of_quantity-$transferstockreceivedmodel->total_no_of_quantity;
								}
								else{
									 $qty=$stock->quantity;
								
								$price=$stock->price;
								$totalqty=$stock->total_no_of_quantity;
								}
								
							}
							          $pdata=Product::find()->where(['productid'=>$productid])->one();
									  $pgroupdata=Productgrouping::find()->where(['productid'=>$productid])->andwhere(['vendorid'=>$vendorid])->one();
						              $stock->branch_id=$frombranchid;
									  $stock-> productgroupid=$pgroupdata->productgroupid;
									  $stock->vendorid=$vendorid;
									  $vendordata=VendorBranch::find()->where(['vendorid'=>$vendorid])->one();
									  $stock->vendor_branchid=$vendordata->vendor_branchid;
									  $stock->productid=$productid;
									  $stock->unitid=$pdata->unit;
									  $unitdata=Unit::find()->where(['unitid'=>$pdata->unit])->one();
									  $stock->brandcode=$pgroupdata->brandcode;
									  $stock->stockcode=$pgroupdata->stock_code;
									  $stock->price=$price+$modeltsk -> pricepertransferstock;
									  $stock->quantity=$qty+$modeltsk -> receivedquantity;
									  $stock->priceperqty=$priceperqty+$modeltsk -> priceperquantity;
									  $stock->unitquantity=$unitdata->no_of_unit;
									  $stock->is_active=1;
									  $session = Yii::$app->session;
									  $stock->updated_by=$session['user_id'];
									  $stock->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
									  $stock->updated_on=date("Y-m-d H:i:s");
									  $stock->batchnumber=$modeltsk->batchnumber;
									  $stock->expiredate=$modeltsk -> expiredate;
									  $stock->manufacturedate=$modeltsk -> manufacturedate;
									  $stock->compositionid=$pdata->composition_id;
									  $stock->total_no_of_quantity=$totalqty+$modeltsk -> total_no_of_quantity;
									 	
									
									 if($stock->save())
									 {
									 	
									
									 	$stockaudit = Stockresponse::find()->where(['stockrequestid'=>$modeltsk->transferstockid])->
									 	andwhere(['request_code'=>$modeltsk -> transferstock_requestcode])->one();	
										$approveddata=Transferstockapprove::find()->where(['transferstockapproveid'=>$modeltsk->transferstockapproveid])->one();
										
	   
						    if($stockaudit=="")
						    {
						   		$stockaudit=new Stockresponse();
								$stockaudit->stockrequestid=$modeltsk->transferstockid;
								$stockaudit->request_code=$modeltsk -> transferstock_requestcode;
								$stockaudit->stockid=$stock->stockid;
								$stockaudit->branch_id=$frombranchid;
								$stockaudit->batchnumber=$modeltsk -> batchnumber ;
								$stockaudit->receivedquantity=$modeltsk -> receivedquantity;
								$stockaudit->receiveddate=date("Y-m-d");
								$stockaudit->manufacturedate=$modeltsk -> manufacturedate;
								$stockaudit->expiredate=$modeltsk -> expiredate;
								$stockaudit->purchasedate=$modeltsk -> purchasedate;
								$stockaudit->receivedquantity=$modeltsk -> receivedquantity;
								$session = Yii::$app->session;
								$stockaudit->updated_by=$session['user_id'];
								//$stockaudit->updated_by="55";
								$stockaudit->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
								$stockaudit->updated_on=date("Y-m-d H:i:s");
								$stockaudit->unitid=$modeltsk -> unit;
								$stockaudit->receivedfreequantity=0;
								$stockaudit->total_no_of_quantity=$modeltsk -> total_no_of_quantity;
								  
						   }
                           else
						   	{
						   		$stockaudit->receivedquantity=$stockaudit->receivedquantity-$transferstockreceivedmodel->receivedquantity+$modeltsk -> receivedquantity;
								$stockaudit->total_no_of_quantity=$stockaudit->total_no_of_quantity-$transferstockreceivedmodel->total_no_of_quantity+$modeltsk -> total_no_of_quantity;
								
						   	}
							
							    $stockaudit->priceperquantity=$modeltsk -> priceperquantity;
							    $stockaudit->purchaseprice=$modeltsk -> pricepertransferstock;
								$stockaudit->mrpperunit=$modeltsk -> priceperquantity;
								$stockaudit->mrp=$modeltsk -> pricepertransferstock;
								$discountrate=$approveddata->discountrate;
								$stockaudit->discountpercent=$discountrate;
								$price=$modeltsk->pricepertransferstock;
								$stockaudit->discountvalue=($discountrate*$price)/100;
								$gstrate=$approveddata->gstrate;
								$stockaudit->gstpercent=$gstrate;
								$stockaudit->gstvalue=($gstrate*$price)/100;
								$stockaudit->cgstpercent=$gstrate/2;
								$stockaudit->sgstpercent=$gstrate/2;
								$stockaudit->igstpercent=0;
								$stockaudit->cgstvalue=($gstrate*$price)/200;
								$stockaudit->sgstvalue=($gstrate*$price)/200;
								$stockaudit->igstvalue=($gstrate*$price)/200;
							    $stockaudit->save();
									 }
				

				}

                  Yii::$app -> getSession() -> setFlash('success', 'Transfer Stock Received  successfully');

               }


              else 
			  	{
			  		
					Yii::$app -> getSession() -> setFlash('success', 'Transfer Stock Not Received  successfully');
			  	}
			        
             

				$i++;
			}

			
			return $this -> redirect('?r=transferstock/receive');

		} else {

			return $this -> render('ts_receivegridform', ['model' => $model, 'requestcode' => $requestcode, 'model1' => $model1, 'model2' => $model2, 'model3' => $model3, ]);
		}
	}

	public function actionTransferstockreturn($id) {

		$model1 = Transferstock::find() -> where(['transferstockid' => $id]) -> one();
		$requestcode = $model1 -> transferstock_requestcode;
		$model2 = "";
		if ($model1 != "") {
			$model2 = Transferstock::find() -> where(['transferstock_requestcode' => $model1 -> transferstock_requestcode]) -> all();
		}

		$model = Transferstockreceive::find() -> where(['transferstock_requestcode' => $requestcode]) -> one();
		if ($model == "") {
			$model = new Transferstockreceive();
		}
		if ($model -> load(Yii::$app -> request -> post())) {
			$session = Yii::$app -> session;
			$i = 1;
			foreach (Yii::$app->request->post() as $key => $value) {
				$transferstockreceiveid= Yii::$app -> request -> post('transferstockreceiveid' . $i);

				$modeltsk = Transferstockreturn::find() -> where(['transferstockreceiveid'=>$transferstockreceiveid]) -> one();

				if ($modeltsk == "") {
					$modeltsk = new Transferstockreturn();
				}

				$session = Yii::$app -> session;

				$modeltsk -> returndate = date("Y-m-d");

				$expiredate = Yii::$app -> request -> post('expiredate' . $i);
				$transferstockid=Yii::$app -> request -> post('transferstockid' . $i);
				$transferstockdata=Transferstock::find() -> where(['transferstockid' =>$transferstockid]) -> one();
				$modeltsk -> transferstockid = $transferstockid;
				$modeltsk -> transferstock_requestcode = Yii::$app -> request -> post('Transferstockreceive')['transferstock_requestcode'];
				$batchnumber = Yii::$app -> request -> post('batchnumber' . $i);
				$modeltsk -> batchnumber = $batchnumber;
				$modeltsk -> expiredate = date("Y-m-d", strtotime($expiredate));
				$purchaseddate = Yii::$app -> request -> post('purchasedate' . $i);
				$modeltsk -> purchasedate = date("Y-m-d", strtotime($purchaseddate));
				$manufacturedate = Yii::$app -> request -> post('manufacturedate' . $i);
				$modeltsk -> manufacturedate = date("Y-m-d", strtotime($manufacturedate));
				$purchaseprice = Yii::$app -> request -> post('purchaseprice' . $i);
				$modeltsk -> pricepertransferstock = $purchaseprice;
				$priceperquantity = Yii::$app -> request -> post('priceperquantity' . $i);
				$modeltsk -> priceperquantity = $priceperquantity;
				$unit = Yii::$app -> request -> post('unit' . $i);
				$modeltsk -> unit = $unit;
				$unitdata = Unit::find() -> where(['unitid' => $unit]) -> one();
				$noofunits = $unitdata -> no_of_unit;
				$returnquantity = Yii::$app -> request -> post('returnquantity' . $i);
				$modeltsk -> returnquantity = $returnquantity;
				$modeltsk -> total_no_of_quantity = $noofunits * $returnquantity;
				$modeltsk -> updated_by = $session['user_id'];
				$modeltsk -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
				$modeltsk -> updated_on = date("Y-m-d H:i:s");
				$modeltsk->transferstockreceiveid=Yii::$app -> request -> post('transferstockreceiveid' . $i);
				$modeltsk->stockid_tobranch=$transferstockdata->tobranch;
				$data = Transferstock::find() -> where(['transferstockid' => $transferstockid]) -> one();
				$productid = $data -> productid;
				$approvedata = Transferstockapprove::find() -> where(['transferstockid' => $modeltsk -> transferstockid]) -> one();
				$tobranchid = $data -> tobranch;
				$frombranchid = $data -> frombranch;
				$stockid = $approvedata -> stockid;
				$stockdata=Stockmaster::find() -> where(['stockid' => $stockid])->one();
				$vendorid=$stockdata->vendorid;
				$transferstockreceiveid=$modeltsk->transferstockreceiveid;
				
				
				
				      $returndata=Transferstockreturn::find() -> where(['transferstockid' => $transferstockid]) -> one();
                     	$returnqty=$returndata->returnquantity;
						 $totalqty=$returndata->total_no_of_quantity;
						 $price=$returndata->pricepertransferstock;
				
				if ($modeltsk -> save()) {

					$transferstockapprovemodel = Transferstock::find() -> where(['transferstockid' => $transferstockid]) -> andwhere(['status' => 'Received']) -> one();
					$transferstockreturnmodel = Transferstock::find() -> where(['transferstockid' => $transferstockid]) -> andwhere(['status' => 'Returned']) -> one();
				  
				  
				  	$approveddata=Transferstockapprove::find()->where(['transferstock_requestcode'=>$modeltsk -> transferstock_requestcode])
						->andwhere(['transferstockid'=>$transferstockid])->one();
					if ($transferstockapprovemodel) {
						$transferstockapprovemodel -> status = "Returned";
						$transferstockapprovemodel -> save();
						
						
					
						
						
						
						
						
					// from branch
					$stockauditfrombranch=Stockresponse::find()->where(['stockrequestid'=>$transferstockid])->andwhere(['request_code'=>$modeltsk -> transferstock_requestcode])->
					andwhere(['branch_id'=>$frombranchid])->one();
					if($stockauditfrombranch)
					{
						$stockmasterfb = Stockmaster::find() -> where(['stockid' => $stockauditfrombranch->stockid]) -> one();
						 if ($stockmasterfb) {
						 	
					 	// 	Stock reduce from parent Table from frombranch
							 $stockmasterfb -> quantity = $stockmasterfb -> quantity - $modeltsk -> returnquantity;
							 $stockmasterfb->total_no_of_quantity=$stockmasterfb -> total_no_of_quantity-$modeltsk -> total_no_of_quantity;
							 $stockmasterfb->price=$stockmasterfb->price-$modeltsk -> pricepertransferstock;
							 $stockmasterfb -> updated_on = date("Y-m-d H:i:s");
							 $stockmasterfb -> save();
							 
								// 	Stock reduce from Child Table  from frombranch
						 $stockauditfrombranch->receivedquantity= $stockauditfrombranch->receivedquantity-$modeltsk -> returnquantity;
						 $stockauditfrombranch->total_no_of_quantity= $stockauditfrombranch->total_no_of_quantity-$modeltsk -> total_no_of_quantity;
					     $stockauditfrombranch->purchaseprice= $stockauditfrombranch->purchaseprice-$modeltsk -> pricepertransferstock;
						 $stockauditfrombranch->save();
						 }
					}
					
					
					/* $stockaudittobranch=Stockresponse::find()->where(['stockresponseid'=>$approveddata->stockresponseid])->andwhere(['branch_id'=>$tobranchid])->one();
					if($stockaudittobranch)
					{
						$stockmastertb = Stockmaster::find() -> where(['stockid' => $stockaudittobranch->stockid]) -> one();
						 if ($stockmastertb) {
						 	
						// 	Stock reduce from parent Table tobranch
							 $stockmastertb -> quantity = $stockmastertb -> quantity + $modeltsk -> returnquantity;
							   $stockmastertb->total_no_of_quantity= $stockmastertb -> total_no_of_quantity+$modeltsk -> total_no_of_quantity;
							   $stockmastertb->price= $stockmastertb->price+$modeltsk -> pricepertransferstock;
							 $stockmastertb -> updated_on = date("Y-m-d H:i:s");
							 $stockmastertb -> save();
								// 	Stock reduce from Child Table  tobranch
							 
							    $stockaudittobranch->receivedquantity= $stockaudittobranch->receivedquantity+$modeltsk -> returnquantity;
								 $stockaudittobranch->total_no_of_quantity= $stockaudittobranch->total_no_of_quantity+$modeltsk -> total_no_of_quantity;
								  $stockaudittobranch->purchaseprice= $stockaudittobranch->purchaseprice+$modeltsk -> pricepertransferstock;
								  $stockaudittobranch->save();
						 }
					} */



					}

                     else if ($transferstockreturnmodel) {
                     	
						
						
                       
						
					$stockauditfrombranch=Stockresponse::find()->where(['stockrequestid'=>$transferstockid])->andwhere(['request_code'=>$modeltsk -> transferstock_requestcode])->
					andwhere(['branch_id'=>$frombranchid])->one();
					
					
					
					if($stockauditfrombranch)
					{
						$stockmasterfb = Stockmaster::find() -> where(['stockid' => $stockauditfrombranch->stockid]) -> one();
						 if ($stockmasterfb) {
						 	
							
						 	
						// 	Stock reduce from parent Table from frombranch
							 $stockmasterfb -> quantity = $stockmasterfb -> quantity+$returnqty -$modeltsk -> returnquantity;
							  $stockmasterfb->total_no_of_quantity=$stockmasterfb -> total_no_of_quantity+$totalqty-$modeltsk -> total_no_of_quantity;
							  $stockmasterfb->price=$stockmasterfb->price+$price-$modeltsk -> pricepertransferstock;
							 $stockmasterfb -> updated_on = date("Y-m-d H:i:s");
							
							 $stockmasterfb -> save();
								// 	Stock reduce from Child Table  from frombranch
							 
							    $stockauditfrombranch->receivedquantity= $stockauditfrombranch->receivedquantity+$returnqty-$modeltsk -> returnquantity;
								 $stockauditfrombranch->total_no_of_quantity= $stockauditfrombranch->total_no_of_quantity+$totalqty-$modeltsk -> total_no_of_quantity;
								  $stockauditfrombranch->purchaseprice= $stockauditfrombranch->purchaseprice+$price-$modeltsk -> pricepertransferstock;
								  $stockauditfrombranch->save();
						 }
					}
					
					
					/*$stockaudittobranch=Stockresponse::find()->where(['stockresponseid'=>$approveddata->stockresponseid])->andwhere(['branch_id'=>$tobranchid])->one();
					
				
					if($stockaudittobranch)
					{
						$stockmastertb = Stockmaster::find() -> where(['stockid' => $stockaudittobranch->stockid]) -> one();
						 if ($stockmastertb) {
						 	
						// 	Stock reduce from parent Table tobranch
							 $stockmastertb -> quantity = $stockmastertb -> quantity-$returnqty +$modeltsk -> returnquantity;
							  $stockmastertb->total_no_of_quantity=$stockmastertb -> total_no_of_quantity-$totalqty+$modeltsk -> total_no_of_quantity;
							   $stockmastertb->price=$stockmastertb->price-$price+$modeltsk -> pricepertransferstock;
							 $stockmastertb -> updated_on = date("Y-m-d H:i:s");
							 $stockmastertb -> save();
								// 	Stock reduce from Child Table  tobranch
							 
							    $stockaudittobranch->receivedquantity= $stockaudittobranch->receivedquantity-$returnqty+$modeltsk -> returnquantity;
								 $stockaudittobranch->total_no_of_quantity= $stockaudittobranch->total_no_of_quantity-$totalqty+$modeltsk -> total_no_of_quantity;
								  $stockaudittobranch->purchaseprice= $stockaudittobranch->purchaseprice-$price+$modeltsk -> pricepertransferstock;
								  $stockaudittobranch->save();
						 }
					} */

					}
				}

				$i++;
			}

			Yii::$app -> getSession() -> setFlash('success', 'Transfer Stock Returned  successfully');
			return $this -> redirect('?r=transferstock/return');

		} else {

			return $this -> render('ts_returngridform', ['model' => $model, 'requestcode' => $requestcode, 'model1' => $model1, 'model2' => $model2, 'model3' => $model3, ]);
		}
	}


	public function actionTransferstockreturnapprove($id) {

		$model1 = Transferstock::find() -> where(['transferstockid' => $id]) -> one();
		$requestcode = $model1 -> transferstock_requestcode;
		$model2 = "";
		if ($model1 != "") {
			$model2 = Transferstock::find() -> where(['transferstock_requestcode' => $model1 -> transferstock_requestcode]) -> all();
		}

		$model = Transferstockreturn::find() -> where(['transferstock_requestcode' => $requestcode]) -> one();
		if ($model == "") {
			$model = new Transferstockreturn();
		}
		if ($model -> load(Yii::$app -> request -> post())) {
			$session = Yii::$app -> session;
			$i = 1;
			foreach (Yii::$app->request->post() as $key => $value) {
				$transferstockreturnid= Yii::$app -> request -> post('transferstockreturnid' . $i);

				$modeltsk = Transferstockreturnapprove::find() -> where(['transferstockreturnid'=>$transferstockreturnid]) -> one();

				if ($modeltsk == "") {
					$modeltsk = new Transferstockreturnapprove();
				}

				$session = Yii::$app -> session;

				$modeltsk -> returndate = date("Y-m-d");

				$expiredate = Yii::$app -> request -> post('expiredate' . $i);
				$transferstockid=Yii::$app -> request -> post('transferstockid' . $i);
				$transferstockdata=Transferstock::find() -> where(['transferstockid' =>$transferstockid]) -> one();
				$modeltsk -> transferstockid = $transferstockid;
				$modeltsk -> transferstock_requestcode = Yii::$app -> request -> post('Transferstockreturn')['transferstock_requestcode'];
				$batchnumber = Yii::$app -> request -> post('batchnumber' . $i);
				$modeltsk -> batchnumber = $batchnumber;
				$modeltsk -> expiredate = date("Y-m-d", strtotime($expiredate));
				$purchaseddate = Yii::$app -> request -> post('purchasedate' . $i);
				$modeltsk -> purchasedate = date("Y-m-d", strtotime($purchaseddate));
				$manufacturedate = Yii::$app -> request -> post('manufacturedate' . $i);
				$modeltsk -> manufacturedate = date("Y-m-d", strtotime($manufacturedate));
				$purchaseprice = Yii::$app -> request -> post('purchaseprice' . $i);
				$modeltsk -> pricepertransferstock = $purchaseprice;
				$priceperquantity = Yii::$app -> request -> post('priceperquantity' . $i);
				$modeltsk -> priceperquantity = $priceperquantity;
				$unit = Yii::$app -> request -> post('unit' . $i);
				$modeltsk -> unit = $unit;
				$unitdata = Unit::find() -> where(['unitid' => $unit]) -> one();
				$noofunits = $unitdata -> no_of_unit;
				$returnquantity = Yii::$app -> request -> post('returnquantity' . $i);
				$modeltsk -> returnquantity = $returnquantity;
				$modeltsk -> total_no_of_quantity = $noofunits * $returnquantity;
				$modeltsk -> updated_by = $session['user_id'];
				$modeltsk -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
				$modeltsk -> updated_on = date("Y-m-d H:i:s");
				$modeltsk->transferstockreturnid=Yii::$app -> request -> post('transferstockreturnid' . $i);
				$modeltsk->stockid_frombranch=$transferstockdata->frombranch;
				$data = Transferstock::find() -> where(['transferstockid' => $transferstockid]) -> one();
				$productid = $data -> productid;
				$approvedata = Transferstockapprove::find() -> where(['transferstockid' => $modeltsk -> transferstockid]) -> one();
				$tobranchid = $data -> tobranch;
				$frombranchid = $data -> frombranch;
				$stockid = $approvedata -> stockid;
				$stockdata=Stockmaster::find() -> where(['stockid' => $stockid])->one();
				$vendorid=$stockdata->vendorid;
				$transferstockreturnid=$modeltsk->transferstockreturnid;
				 $returndata=Transferstockreturnapprove::find() -> where(['transferstockid' => $transferstockid]) -> one();
                     	$returnqty=$returndata->returnquantity;
						 $totalqty=$returndata->total_no_of_quantity;
						 $price=$returndata->pricepertransferstock;
				
				if ($modeltsk -> save()) {

					
					$transferstockreturnmodel = Transferstock::find() -> where(['transferstockid' => $transferstockid]) -> andwhere(['status' => 'Returned']) -> one();
				  $transferstockreturnapprovemodel = Transferstock::find() -> where(['transferstockid' => $transferstockid]) -> andwhere(['status' => 'ReturnApproved']) -> one();
				  
				  	$approveddata=Transferstockapprove::find()->where(['transferstock_requestcode'=>$modeltsk -> transferstock_requestcode])
						->andwhere(['transferstockid'=>$transferstockid])->one();
					if ($transferstockreturnmodel) {
						$transferstockreturnmodel -> status = "ReturnApproved";
						$transferstockreturnmodel -> save();
					 $stockaudittobranch=Stockresponse::find()->where(['stockresponseid'=>$approveddata->stockresponseid])->andwhere(['branch_id'=>$tobranchid])->one();
					if($stockaudittobranch)
					{
						$stockmastertb = Stockmaster::find() -> where(['stockid' => $stockaudittobranch->stockid]) -> one();
						 if ($stockmastertb) {
						 	
						// 	Stock reduce from parent Table tobranch
							 $stockmastertb -> quantity = $stockmastertb -> quantity + $modeltsk -> returnquantity;
							   $stockmastertb->total_no_of_quantity= $stockmastertb -> total_no_of_quantity+$modeltsk -> total_no_of_quantity;
							   $stockmastertb->price= $stockmastertb->price+$modeltsk -> pricepertransferstock;
							 $stockmastertb -> updated_on = date("Y-m-d H:i:s");
							 $stockmastertb -> save();
								// 	Stock reduce from Child Table  tobranch
							 
							    $stockaudittobranch->receivedquantity= $stockaudittobranch->receivedquantity+$modeltsk -> returnquantity;
								 $stockaudittobranch->total_no_of_quantity= $stockaudittobranch->total_no_of_quantity+$modeltsk -> total_no_of_quantity;
								  $stockaudittobranch->purchaseprice= $stockaudittobranch->purchaseprice+$modeltsk -> pricepertransferstock;
								  $stockaudittobranch->save();
						 }
					} 



					}

                     else if ($transferstockreturnapprovemodel) {
					$stockaudittobranch=Stockresponse::find()->where(['stockresponseid'=>$approveddata->stockresponseid])->andwhere(['branch_id'=>$tobranchid])->one();
					if($stockaudittobranch)
					{
						$stockmastertb = Stockmaster::find() -> where(['stockid' => $stockaudittobranch->stockid]) -> one();
						 if ($stockmastertb) {
						// 	Stock reduce from parent Table tobranch
							 $stockmastertb -> quantity = $stockmastertb -> quantity-$returnqty +$modeltsk -> returnquantity;
							  $stockmastertb->total_no_of_quantity=$stockmastertb -> total_no_of_quantity-$totalqty+$modeltsk -> total_no_of_quantity;
							   $stockmastertb->price=$stockmastertb->price-$price+$modeltsk -> pricepertransferstock;
							 $stockmastertb -> updated_on = date("Y-m-d H:i:s");
							 $stockmastertb -> save();
								// 	Stock reduce from Child Table  tobranch
							 
							    $stockaudittobranch->receivedquantity= $stockaudittobranch->receivedquantity-$returnqty+$modeltsk -> returnquantity;
								 $stockaudittobranch->total_no_of_quantity= $stockaudittobranch->total_no_of_quantity-$totalqty+$modeltsk -> total_no_of_quantity;
								  $stockaudittobranch->purchaseprice= $stockaudittobranch->purchaseprice-$price+$modeltsk -> pricepertransferstock;
								  $stockaudittobranch->save();
						 }
					} 

					}
				}

				$i++;
			}

			Yii::$app -> getSession() -> setFlash('success', 'Transfer Stock ReturnApprove Added  successfully');
			return $this -> redirect('?r=transferstock/returnapprove');

		} else {

			return $this -> render('ts_returnapprovegridform', ['model' => $model, 'requestcode' => $requestcode, 'model1' => $model1, 'model2' => $model2, 'model3' => $model3, ]);
		}
	}




 public function actionGetunitquantity($id,$dataid)
    {
    	
		$rows=Unit::find()->where(['unitid'=>$id])->one();
        return $rows->no_of_unit;
		
	}
}
