<?php

namespace backend\controllers;

use Yii;
use backend\models\Sales;
use backend\models\AuthProjectModule;
use backend\models\ServiceuserLogin;
use backend\models\Patienttype;
use backend\models\Patient;
use backend\models\Product;
use backend\models\Composition;
use backend\models\Unit;
use backend\models\Saledetail;
use backend\models\Stockrequest;
use backend\models\Vendor;
use backend\models\Stockmaster;
use backend\models\StockmasterSearch;
use backend\models\SalesSearch;
use backend\models\PatientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\CompanyBranch;
use backend\models\BranchAdmin;
use backend\models\Productgrouping;
use backend\models\Physicianmaster;
use backend\models\Producttype;
use backend\models\Insurance;
use backend\models\Company;
use backend\models\StockresponseSearch;
use backend\models\Stockresponse;
use backend\models\Newpatient;
use backend\models\SubVisit;
use backend\models\TaxgroupingLog;
use common\models\LoginForm;
use backend\models\AutoidTable;
use backend\models\Salesreturn;
use backend\models\Returndetail;
use yii\db\Query;

class SalesController extends Controller {
	public function behaviors() {
		return ['verbs' => ['class' => VerbFilter::className(), 'actions' => ['delete' => ['POST'], ], ], 'access' => ['class' => AccessControl::className(), 'rules' => [['allow' => true, 'roles' => ['@'], ], ], ], ];
	}

	public function beforeAction($action) {
		return BranchAdmin::checkbeforeaction();
	}

	public function actionIndex() {
		
		
		
		$searchModel = new SalesSearch();
		$dataProvider = $searchModel -> search(Yii::$app -> request -> queryParams);
		return $this -> render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, ]);
	}

	public function actionView($id) 
	{
		$model=$this -> findModel($id);
			
		$sale_detail=Saledetail::find()->where(['opsaleid' => $id]) -> asArray() ->all();
		
		$product_map=ArrayHelper::map($sale_detail,'opsale_detailid','productid');
		$composition_map=ArrayHelper::map($sale_detail,'opsale_detailid','compositionid');
		
		$product=Product::find()->where(['IN','productid',$product_map])->asArray()->all();
		$composition=Composition::find()->where(['IN','composition_id',$composition_map])->asArray() ->all();
		
		$product_index=ArrayHelper::index($product,'productid');
		$composition_index=ArrayHelper::index($composition,'composition_id');
		
		$Newpatient=Newpatient::find()->where(['mr_no'=>$model->mrnumber])->one();
		
		$insurance=Insurance::find()->where(['insurance_typeid'=>$model->insurancetype])->asArray()->one();
		 $result = (!empty($insurance)) ? $insurance['insurance_type'] :'NIL';
		
		
		$result_string.='<table class="table table-bordered">
					    <thead>
					      <tr>
					      	<th>MR Number</th>
					        <th>Name</th>
					        <th>DOB</th>
					        <th>Age</th>
					        <th>Gender</th>
					        <th>Phone Number</th>
					        <th>Bill Number</th>
					        <th>Invoice Date</th>
					        <th>Physician Name</th>
					        <th>Insurance Type</th>
					      </tr>
					    </thead>';
		$result_string.='<tbody>
					      <tr>
					        <td>'.$model->mrnumber.'</td>
					        <td>'.$Newpatient->patientname.'</td>
					        <td>'.date('d-m-Y',strtotime($Newpatient->dob)).'</td>
					        <td>'.$this->actionGetage($Newpatient->dob).'</td>
					        <td>'.$Newpatient->pat_sex.'</td>
					        <td>'.$Newpatient->pat_mobileno.'</td>
					        <td>'.$model->billnumber.'</td>
					        <td>'.date('d-m-Y',strtotime($model->invoicedate)).'</td>
					        <td>'.$model->physicianname.'</td>
					        <td>'.$result.'</td>
					      </tr>
					    </tbody>
					  </table><br>';
		
		$result_string.='<table class="table table-bordered">
					    <thead>
					      <tr>
					      	<th>Product</th>
					        <th>BatchNO</th>
					        <th>Expire Date</th>
					        <th>Sale Date</th>
					        <th>Qty</th>
					        <th>Price</th>
					        <th>GST(%)</th>
					        <th>GST(Amt)</th>
					        
					        <th>MRP</th>
					        <th>Invoice Date</th>
					        <th>Action</th>
					      </tr>
					    </thead><tbody>';
		
		if(!empty($sale_detail))
		{
			foreach ($sale_detail as $key => $value) 
			{
				$result_string.='<tr>';
				$result_string.='<td>'.$product_index[$value['productid']]['productname'].'</td>';
				$result_string.='<td>'.$value['batchnumber'].'</td>';
				
				$result_string.='<td>'.date('d-m-Y',strtotime($value['expiredate'])).'</td>';
				$result_string.='<td>'.date('d-m-Y',strtotime($value['saledate'])).'</td>';
				$result_string.='<td>'.$value['productqty'].'</td>';
				$result_string.='<td>'.$value['price'].'</td>';
				$result_string.='<td>'.$value['gstrate'].'</td>';
				$result_string.='<td>'.$value['gstvalue'].'</td>';
				$result_string.='<td>'.$value['total_price_perqty'].'</td>';
				$result_string.='<td>'.date('d-m-Y H:i:s',strtotime($value['saledate'])).'</td>';
				$result1=($value['return_status']=='Y') ? '<td><button class="btn btn-xs btn-success" title="Returned" disabled type="button">Returned</button></td>' :'<td><button class="btn btn-xs btn-danger opsale_id" title="Return" data_id='.$value['opsale_detailid'].'  type="button">Return</button></td>';
				$result_string.=$result1;
				$result_string.='</tr>';	
			}
			$result_string.='</tbody></table>';
		}
		
	
		return $this -> renderAjax('view', ['model' => $this -> findModel($id),'composition_index'=>$composition_index,'product_index'=>$product_index,'result_string'=>$result_string ]);
	}


	 
		/* public function actionCreate1() {
	 	$model = new Patient();
			
	 	 if (Yii::$app->request->post()) {
	 	 	
	 
			$session = Yii::$app->session;
			$role=$session['authUserRole'];
			$companybranchid=$session['branch_id'];
  			$model -> is_active = 1;
			$dob = Yii::$app -> request -> post('Patient')['dob'];
			$model -> dob = date("Y-m-d", strtotime($dob));
			$session = Yii::$app -> session;
			
			$model -> updated_by = $session['user_id'];
			$model -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			$model -> updated_on = date("Y-m-d H:i:s");
			$model -> age = Yii::$app -> request -> post('Patient')['age'];
			$model -> firstname = trim(ucwords(Yii::$app -> request -> post('Patient')['firstname']));
			$model -> lastname = trim(ucwords(Yii::$app -> request -> post('Patient')['lastname']));
			$model -> address = trim(ucwords(Yii::$app -> request -> post('Patient')['address']));
			$emailid=trim(strtolower(Yii::$app -> request -> post('Patient')['emailid']));
			$model -> emailid = trim(strtolower(Yii::$app -> request -> post('Patient')['emailid']));
			$pmno=trim(Yii::$app -> request -> post('Patient')['patient_mobilenumber']);
			$model -> patient_mobilenumber =$pmno;
			$model -> guardian_name = trim(ucwords(Yii::$app -> request -> post('Patient')['guardian_name']));
			$model -> guardian_mobilenumber = trim(Yii::$app -> request -> post('Patient')['guardian_mobilenumber']);
			$physician = trim(ucwords(Yii::$app -> request -> post('Patient')['physicianname']));
			$model -> physicianname = $physician;
			$model -> notes = trim(ucwords(Yii::$app -> request -> post('Patient')['notes']));
			$model -> gender = Yii::$app -> request -> post('Patient')['gender'];
			$ptype= Yii::$app -> request -> post('Patient')['patient_type'];
			$model -> patient_type =$ptype;
			$model -> insurance_type = Yii::$app -> request -> post('Patient')['insurance_type'];
			$model -> reference_number = Yii::$app -> request -> post('Patient')['reference_number'];
			$mrnumber=Yii::$app -> request -> post('Patient')['medicalrecord_number'];
			
		
		    if($ptype==2)
			{
				
				if($mrnumber=="")
				{
					$patientmax = Patient::find()->max('patient_id');
				$patientmax+=1;
				$mrnumber="MRN".$patientmax;
					
				}
			}
			$model -> medicalrecord_number = $mrnumber;
			$patientdata=Patient::find()->where(['medicalrecord_number'=>$mrnumber])->one();
			$patientdata1=Patient::find()->where(['patient_mobilenumber'=>$pmno])->one();
			$patientdata2=Patient::find()->where(['patient_mobilenumber'=>$pmno])->one();
			$patientdata3=Patient::find()->where(['emailid'=>$emailid])->one();
			if(count($patientdata)>0)
			{
				
				echo  "MR";
			}
		 if(count($patientdata1)>0)
			{
				
				echo "MN";
			}
			
			 if($ptype==1)
			{
				if($mrnumber=="")
				{
					echo "R";
					
				}
			}
			
		   if($model->save())
			{
				echo  "Y";
			}
		
			
		
			}
	
	
	
	else{
		$pmodel = new Patient();
		$patientmax = Patient::find() -> max('patient_id');
		$patientmax = $patientmax + 1;
		$physicianlist=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
		$patient_type = ArrayHelper::map(Patienttype::find() -> asArray() -> all(), 'patient_typeid', 'patient_typename');
		$companylist = ArrayHelper::map(CompanyBranch::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'branch_id', 'branch_name');
		$brandlist=ArrayHelper::map(Productgrouping::find()-> where(['is_active' => 1]) -> asArray() -> all(), 'productgroupid', 'brandcode');
		$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		
		
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		
		
		
		$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
		$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		$stockcodelist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'stock_code');
		$branchlist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
	    $productgrouplist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'brandcode');
		$insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
		$model = new Stockmaster();
        $session = Yii::$app->session;
		$userid=$session['user_id'];
        $userdata=BranchAdmin::find()->where(['ba_autoid'=>$userid])->one();
        $companybranchid=$userdata->ba_branchid;
		$searchModel = new StockresponseSearch();
        $dataProvider = $searchModel->customstocksearch_np(Yii::$app->request->queryParams);
        return $this->render('sales', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'model' => $model, 'vendorlist' => $vendorlist, 'productlist'=>$productlist,'branchlist'=>$branchlist,
             'productgrouplist'=>$productgrouplist,'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,'unitlist'=>$unitlist,
             'stockcodelist'=>$stockcodelist,'pmodel'=>$pmodel,'patient_type'=>$patient_type,'patientmax'=>$patientmax,
            'companylist'=>$companylist,'brandlist'=>$brandlist,'physicianlist'=>$physicianlist,'insurancelist'=>$insurancelist,
           
        ]); 
       
       
       
   $product=new Product();
		
		
        return $this->render('billing', [
        		'productname'=>$productname,
        		'model'=>$product,
        ]); 
	}
	 } 
*/
 public function actionAjaxbillnumber()
    {
        //echo "<pre>"; print_r($_POST); die;
        if(!empty($_POST['query']))
        {
            $Newpatient=Sales::find()->where(['LIKE','billnumber',$_POST['query']])->asArray()->all();
             
            $result =false;
            if(!empty($Newpatient))
            {
                foreach ($Newpatient as $key => $value) { 
                     $result[] =array('bill_no'=>$value['billnumber']); 
                } 
            }  
                return json_encode($result);
            } 
    }

    public function actionOpdetails($id)
    {

         $value=Sales::find()->where(['billnumber'=>$id])->asArray()->one();
            
             $fetch_array=array();
             if(!empty($value))
            {       

            $sales_detail=Saledetail::find()->where(['opsaleid'=>$value['opsaleid']])->asArray()->all();
           

            $in_sales_detail=Saledetail::find()->where(['opsaleid'=>$value['opsaleid']])->asArray()->all();
                $in_sales=ArrayHelper::index($in_sales_detail,'productid');

                $product_map=ArrayHelper::map($sales_detail,'opsale_detailid','productid');
                $product=Product::find()->select(['productid','productname'])->where(['IN','productid',$product_map])->asArray()->all();
               //$product_index=ArrayHelper::index($product,'productid');
               // $product_json=json_encode($product_index);
                
              // echo "<pre>"; print_r($in_sales); die;

                    $insurance="";
                    $insurancelist = Insurance::findOne($value['insurancetype']);
                    if($insurancelist){
                        $insurance = $insurancelist->insurance_type;
                    }
                    $fetch_array[0]=array( 'opsaleid'=>$value['opsaleid'],'mr_no'=>$value['mrnumber'],'ip_no'=>$value['ip_no'],
                    'patient_name'=>$value['name'],'dob' =>$value['dob'],
                    'gender'=>$value['gender'],'physicianname' => $value['physicianname'],
                    'insurancetype'=>$insurance,'address'=>$value['address'],
                    'city'=>$value['city'],'district'=>$value['district'],'state'=>$value['state'],
                    'pincode'=>$value['pincode'],'phone_no'=>$value['phonenumber']); 
                    if(!empty($product)){
                        //echo count($product); die;
                        foreach ($product as $key => $values) {  
                        $fetch_array[1][] = array('productid'=>$values['productid'],
                        'productname'=>$values['productname'],'salesauto_id'=>$in_sales[$values['productid']]['opsale_detailid']); 
                        } 
                    }
                   // echo "<pre>"; print_r($fetch_array); die;
            }
            return json_encode($fetch_array);
    }
    


	 public function actionCreate() {
	 	$product=new Product();
		$patient=new Newpatient();
		//$patientdata=new Newpatient();
		/*if ($patient->load(Yii::$app->request->post()))
		{
			
				if(Yii::$app->request->isAjax){
												
	                  Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	            	  return ActiveForm::validate($patient);
	             }
		}*/
		
	 
       
       
    $subvisit=SubVisit::find()->where(['mr_number'=>$mrnumber])->andWhere(['date(created_at)' => date('Y-m-d')])->all();

	
	$saledatainc=Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
	if(!empty($saledatainc))
	{
		$saleincrement=$saledatainc->opsaleid+1;	
		$billformat = "ECDR".($saleincrement);
	}
		
        return $this->render('billing', [
        		'productname'=>$productname,
        		'model'=>$product,
        		'billformat' => $billformat,
        		'patient' => $patient,
        ]); 
	
	 } 
	public function actionCreatedummy() {
	$product=new Product();
		$patient=new Newpatient();
		//$patientdata=new Newpatient();
		if ($patient->load(Yii::$app->request->post()))
			{
			
				if(Yii::$app->request->isAjax){
												
	                  Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	            	  return ActiveForm::validate($patient);
	             }
			}
		
	 
       
       
    
	
	$saledatainc=Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
	if(!empty($saledatainc))
	{
		$saleincrement=$saledatainc->opsaleid+1;	
		$billformat = "ECGR".($saleincrement);
	}
		
        return $this->render('billing2', [
        		'productname'=>$productname,
        		'model'=>$product,
        		'billformat' => $billformat,
        		'patient' => $patient,
        ]); 
	
	
	}
	
/*	 public function actionCreatedummy4() {
	 	$model = new Patient();
		
	 	 if (Yii::$app->request->post()) 
	 	 {
	 	 		//echo "<pre>";	
	 			//print_r($_POST);die;
			
			if($_POST['saved_bill'] == 'save_bill')
			{
				
			}
				
				
			$session = Yii::$app->session;
			$role=$session['authUserRole'];
			$companybranchid=$session['branch_id'];
  			$model -> is_active = 1;
			$dob = Yii::$app -> request -> post('Patient')['dob'];
			$model -> dob = date("Y-m-d", strtotime($dob));
			$session = Yii::$app -> session;
			
			$model -> updated_by = $session['user_id'];
			$model -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			$model -> updated_on = date("Y-m-d H:i:s");
			$model -> age = Yii::$app -> request -> post('Patient')['age'];
			$model -> firstname = trim(ucwords(Yii::$app -> request -> post('Patient')['firstname']));
			$model -> lastname = trim(ucwords(Yii::$app -> request -> post('Patient')['lastname']));
			$model -> address = trim(ucwords(Yii::$app -> request -> post('Patient')['address']));
			$emailid=trim(strtolower(Yii::$app -> request -> post('Patient')['emailid']));
			$model -> emailid = trim(strtolower(Yii::$app -> request -> post('Patient')['emailid']));
			$pmno=trim(Yii::$app -> request -> post('Patient')['patient_mobilenumber']);
			$model -> patient_mobilenumber =$pmno;
			$model -> guardian_name = trim(ucwords(Yii::$app -> request -> post('Patient')['guardian_name']));
			$model -> guardian_mobilenumber = trim(Yii::$app -> request -> post('Patient')['guardian_mobilenumber']);
			$physician = trim(ucwords(Yii::$app -> request -> post('Patient')['physicianname']));
			$model -> physicianname = $physician;
			$model -> notes = trim(ucwords(Yii::$app -> request -> post('Patient')['notes']));
			$model -> gender = Yii::$app -> request -> post('Patient')['gender'];
			$ptype= Yii::$app -> request -> post('Patient')['patient_type'];
			$model -> patient_type =$ptype;
			$model -> insurance_type = Yii::$app -> request -> post('Patient')['insurance_type'];
			$model -> reference_number = Yii::$app -> request -> post('Patient')['reference_number'];
			$mrnumber=Yii::$app -> request -> post('Patient')['medicalrecord_number'];
			
		
		    if($ptype==2)
			{
				
				if($mrnumber=="")
				{
					$patientmax = Patient::find()->max('patient_id');
				$patientmax+=1;
				$mrnumber="MRN".$patientmax;
					
				}
			}
			$model -> medicalrecord_number = $mrnumber;
			$patientdata=Patient::find()->where(['medicalrecord_number'=>$mrnumber])->one();
			$patientdata1=Patient::find()->where(['patient_mobilenumber'=>$pmno])->one();
			$patientdata2=Patient::find()->where(['patient_mobilenumber'=>$pmno])->one();
			$patientdata3=Patient::find()->where(['emailid'=>$emailid])->one();
			if(count($patientdata)>0)
			{
				
				echo  "MR";
			}
		 if(count($patientdata1)>0)
			{
				
				echo "MN";
			}
			
			 if($ptype==1)
			{
				if($mrnumber=="")
				{
					echo "R";
					
				}
			}
			
		   if($model->save())
			{
				echo  "Y";
			}
		
			
		
			}
	
	else{
		/*$pmodel = new Patient();
		$patientmax = Patient::find() -> max('patient_id');
		$patientmax = $patientmax + 1;
		$physicianlist=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
		$patient_type = ArrayHelper::map(Patienttype::find() -> asArray() -> all(), 'patient_typeid', 'patient_typename');
		$companylist = ArrayHelper::map(CompanyBranch::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'branch_id', 'branch_name');
		$brandlist=ArrayHelper::map(Productgrouping::find()-> where(['is_active' => 1]) -> asArray() -> all(), 'productgroupid', 'brandcode');
		$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		
		
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		
		
		
		$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
		$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		$stockcodelist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'stock_code');
		$branchlist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
	    $productgrouplist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'brandcode');
		$insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
		$model = new Stockmaster();
        $session = Yii::$app->session;
		$userid=$session['user_id'];
        $userdata=BranchAdmin::find()->where(['ba_autoid'=>$userid])->one();
        $companybranchid=$userdata->ba_branchid;
		$searchModel = new StockresponseSearch();
        $dataProvider = $searchModel->customstocksearch_np(Yii::$app->request->queryParams);
        return $this->render('sales', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'model' => $model, 'vendorlist' => $vendorlist, 'productlist'=>$productlist,'branchlist'=>$branchlist,
             'productgrouplist'=>$productgrouplist,'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,'unitlist'=>$unitlist,
             'stockcodelist'=>$stockcodelist,'pmodel'=>$pmodel,'patient_type'=>$patient_type,'patientmax'=>$patientmax,
            'companylist'=>$companylist,'brandlist'=>$brandlist,'physicianlist'=>$physicianlist,'insurancelist'=>$insurancelist,
           
        ]); 
       
       
       
    $product=new Product();
		
		
        return $this->render('billing2', [
        		'productname'=>$productname,
        		'model'=>$product,
        ]); 
	}
	 } */


	//24/02/18 Coding  Start
	
	public function actionFetchmrnumber($mrnumber)
	{
		$mrnumber = json_decode($mrnumber);
		
		
		$fetch_element=array();
		$insurance_id='';$insurances_name='';$id='';$name='';
		$subvisit=SubVisit::find()->where(['mr_number'=>$mrnumber])->orderBy(['sub_id' => SORT_DESC])->one();
		
		if(!empty($subvisit))
		{
			//$subvisit=SubVisit::find()->where(['mr_number'=>$mrnumber])->orderBy(['sub_id' => SORT_DESC])->one();
			$patientdata=Newpatient::find()->where(['patientid'=>$subvisit->pat_id])->one();
			
			
				$patient_name=$patientdata->patientname;
				$patient_mobile_number=$patientdata->pat_mobileno;
				$consultant_doctor=$subvisit->consultant_doctor;
				$doctor_name=Physicianmaster::find()->where(['id'=>$consultant_doctor])->one();
				if(!empty($doctor_name))
				{
					$doctor_name_fetch=$doctor_name->physician_name;
				}
				$insurance_type=$subvisit->insurance_type;
				if($insurance_type != '')
				{
					$insurance=Insurance::find()->where(['insurance_typeid'=>$insurance_type])->andWhere(['is_active'=>1])->one();
					$insurance_id=$insurance->insurance_typeid;
					$insurances_name=$insurance->insurance_type;
				}
				
				$dob=date('d-m-Y',strtotime($patientdata->dob));
				
				$fetch_element[0]=$patient_name;
				$fetch_element[1]=$patient_mobile_number;
				$fetch_element[2]=$doctor_name_fetch;
				$fetch_element[3]=$dob;
				$fetch_element[4]="<option value='$insurance_id'>$insurances_name</option>";
				$fetch_element[5]='<option value='.$patientdata->pat_sex.'>'.$patientdata->pat_sex.'</option>';
				$fetch_element[6]=$patientdata->pat_address;
				$fetch_element[7]=$patientdata->temporary_blocked;
				
				return json_encode($fetch_element);
			
			
		}
		else {
			return 'invalid';		
		}	
	}


	//Updated Tablet
	public function actionUpdateTablet($tablet_id,$tablet_qty,$tablet_type)
	{
		
		$tablet_id_array = explode(",", $tablet_id);
		$tablet_qty_array = explode(",", $tablet_qty);
		$tablet_type_array = explode(",", $tablet_type);
		
		/*$overallstock=Stockresponse::find()->where(['IN','stockresponseid',$tablet_id_array])->orderBy(['expiredate'=>SORT_ASC])->all();
		foreach ($overallstock as $key => $value)
		{
			$value->updated_tablet='Y';
			$value->temp_tab_type=$tablet_type_array[$key];
			$value->temp_tab_value=$tablet_qty_array[$key];
			$value->save();	
		}*/
		
		return json_encode($tablet_id_array);
		
	}
	
	
	
	
	
	public function actionMedicinefetch($product_id)
	{
			$Stock_code=Stockmaster::find() -> where(['is_active' => 1])-> andWhere(['productid'=> $product_id]) -> all();
				
			if(!empty($Stock_code))
			{	
				foreach ($Stock_code as $key)
				{
					$stock_p_id[]=$key['stockid'];
				}
				
				//Session of Branch Id
				$session = Yii::$app->session;
				$branch_id=$session['branch_id'];
				
				$overallstock=Stockresponse::find()->where(['IN','stockid',$stock_p_id])->andWhere(['!=', 'total_no_of_quantity', 0])->andWhere(['branch_id'=>$branch_id])->orderBy(['expiredate'=>SORT_ASC])->asArray()->all();
				//$overallstock=Stockresponse::find()->where(['IN','stockid',$stock_p_id])->andWhere(['!=', 'total_no_of_quantity', 0])->orderBy(['expiredate'=>SORT_ASC])->asArray()->all();
					//print_r($stock_p_id);die;
				$productlist=Product::find()->where(['is_active'=>1])-> andWhere(['productid'=> $product_id])->asArray()->one();
				
				$tax_groupinglog=TaxgroupingLog::find()->where(['is_active'=>1])-> andWhere(['taxgroupid'=> $productlist['hsn_code']])->asArray()->one();
				
				
				//$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->andWhere(['unitname'=>$productlist['product_typeid']])->asArray()->all(), 'unitid', 'unitvalue');
			
				if(!empty($productlist))
				{
					$productid=$productlist['productid'];
					$productname=$productlist['productname'];
					$composition_id=$productlist['composition_id'];
					$Composition=Composition::find()->where(['is_active'=>1])-> andWhere(['composition_id' => $composition_id]) ->asArray()->one();
					if(!empty($Composition))
					{
						$composition_name=$Composition['composition_name'];
						
					}
				}
				
				
				
				
				if(!empty($overallstock))
				{
						$result_string='';
							
						$sl_no=1;
						$tab_num=500;
						
						
						$result_string.='<div class="table-responsive"><table class="table table-bordered table-striped">';
						$result_string.='<thead><tr>';
						$result_string.='<th  width="10%" class="text-center">#</th>';
						$result_string.='<th  class="text-center">Batch</th>';
						$result_string.='<th  class="text-center" width="10%">Mfg Date</th>';
						$result_string.='<th  class="text-center">Exp Date</th>';
						$result_string.='<th  class="text-center">Price/Unit</th>';
						$result_string.='<th  class="text-center">Availability</th>';
						$result_string.='<th  class="text-center">Required Qty</th>';
						
						$result_string.='<th  class="text-center">Product Qty</th>';
						$result_string.='<th  class="text-center">Total Units</th>';
						$result_string.='</tr></thead>';
						$result_string.='<tbody>';		
						
						$tot_avail_qty;
						$prime_id=array();	
						foreach ($overallstock as $key) 
						{
							
							$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->andWhere(['unitid'=>$key['unitid']])->asArray()->all(), 'unitid', 'unitvalue');
							if(!empty($key))
							{
								
								$date_now=date('Y-m-d');
								$date_expire=date('Y-m-d',strtotime($key['expiredate']));
								$date_exp=date_create($date_expire);
								$threemonth_expire=date_sub($date_exp,date_interval_create_from_date_string("90 days"));
								$threemonth_expire1=date_format($threemonth_expire,"Y-m-d");
								
								
								
								if ($key['total_no_of_quantity'] < 0)
								{
								
								}
								else 
								{
								if($threemonth_expire1 <= $date_now)
								{
									
								$Stock_brand=Stockmaster::find() -> where(['is_active' => 1])-> andWhere(['stockid'=> $key['stockid']]) -> one();
								
								//New Unit Code
								$percentage=$tax_groupinglog['tax'];
								$mrp=$key['mrpperunit'];
								//$multi=100*$mrp;
								$newprice=100*$mrp/(100+$percentage);
								$calculation = number_format($newprice,2, '.', '');
								
								
								
								$result_string.='<tr class="exp">';
								
								$result_string.='<th class="text-center">'.$sl_no.'</th>';
								$result_string.='<th class="hide" id="prd_name'.$key['stockresponseid'].'">'.$productname."/".$composition_name.'</th>';
								
								$result_string.='<input type="hidden" class="form-control" name="stock_id_hide[]" data-id='.$key['stockresponseid'].' id="stock_id'.$key['stockresponseid'].'" value='.$key['stockid'].'>';
								$result_string.='<input type="hidden" class="form-control" name="product_hide[]" data-id='.$key['stockresponseid'].' id="product_id'.$key['stockresponseid'].'" value='.$productid.'>';
								$result_string.='<input type="hidden" class="form-control" name="brand_hide[]" data-id='.$key['stockresponseid'].' id="brandcode_id'.$key['stockresponseid'].'" value='.$Stock_brand->brandcode.'>';
								$result_string.='<input type="hidden" class="form-control" name="stockcode_hide[]" data-id='.$key['stockresponseid'].' id="stockcode_id'.$key['stockresponseid'].'" value='.$Stock_brand->stockcode.'>';
								$result_string.='<input type="hidden" class="form-control" name="composition_hide[]" data-id='.$key['stockresponseid'].' id="composition_id'.$key['stockresponseid'].'" value='.$Stock_brand->compositionid.'>';
								$result_string.='<input type="hidden" class="form-control" name="unitid_hide[]" data-id='.$key['stockresponseid'].' id="unit_id'.$key['stockresponseid'].'" value='.$Stock_brand->unitid.'>';
								
									
								$result_string.='<th class="hide prd_name1">'.$productname."/".$composition_name.'</th>';
								$result_string.='<th class="hide" id="batchnumber'.$key['stockresponseid'].'">'.$key['batchnumber'].'</th>';
								$result_string.='<th class="hide" id="total_qty'.$key['stockresponseid'].'">'.$key['total_no_of_quantity'].'</th>';
								
								$result_string.='<th class="hide" id="gst_sale_percent'.$key['stockresponseid'].'">'.$percentage.'</th>';
								
								
								$result_string.='<th  id="batch_id'.$key['stockresponseid'].'">'.$key['batchnumber'].'</th>';
								$result_string.='<th class="text-center" id="manu_date_id'.$key['stockresponseid'].'">'.date('d-m-Y',strtotime($key['manufacturedate'])).'</th>';
								$result_string.='<th class="text-center" id="expire_date_id'.$key['stockresponseid'].'">'.date('d-m-Y',strtotime($key['expiredate'])).'</th>';
								
								
								
								$result_string.='<th class="text-center" id="mrp_id'.$key['stockresponseid'].'">'.$calculation.'</th>';
								$result_string.='<th  class="text-center" id="quanity_id'.$key['stockresponseid'].'">'.$key['total_no_of_quantity'].'</th>';
								
								$result_string.='<th width="14%">';
								$valop=$tab_num+$sl_no;
								if($valop == 501)
								{
									$result_string.='<input type="text" class="form-control required_qty tabenter_acc tabenter'.$valop.' number focus_first " name="required_qty_enter[]" data-id='.$key['stockresponseid'].' id="required_id'.$key['stockresponseid'].'"  tabindex="'.$valop.'">';	
								}
								else
								{
									$result_string.='<input type="text" class="form-control required_qty  tabenter_acc tabenter'.$valop.' number" name="required_qty_enter[]" data-id='.$key['stockresponseid'].' id="required_id'.$key['stockresponseid'].'"  tabindex="'.$valop.'">';									
								}
								$valop=$valop+1;
								
								
								$result_string.='<input id="getunitvalue'.$key['stockresponseid'].'"  type="hidden" name="selected_value" data-bind="bs-drp-sel-value" value="">';
								
								$result_string.='</th>';
								
								$result_string.='<th width="14%">';
							
								$result_string.='<select  id="data_unit'.$key['stockresponseid'].'" class="form-control unitvalue tabenter_acc tabenter'.$valop.'" data-unit="'.$key['stockresponseid'].'" role="menu" tabindex="'.$valop.'">';
								
								foreach ($unitlist as $key1 => $val) 
								{
									    $result_string.='<option data-unit-name="'.$val.'" value="'.$key1.'">'.$val.'</option>';		
									
								}
								$result_string.='</select>';
								
								$result_string.='<span id="validated_field'.$key['stockresponseid'].'" style="color:red;display:none">Req.Quantity type</span>';
								$result_string.='<input id="data_no_of_unit'.$key['stockresponseid'].'"  type="hidden" class="no_of_unit" >';
								$result_string.='<input id="data-unit-name'.$key['stockresponseid'].'"  type="hidden">';
								
								$result_string.='</th>';
								
								$result_string.='<th width="15%">';
								
								
								$result_string.='<input id="total_unit'.$key['stockresponseid'].'"  type="text" class="form-control total_unit" readonly>';
								
								$result_string.='</th>';
								
								$result_string.='</tr>';
								$tot_avail_qty=$tot_avail_qty+$key['total_no_of_quantity'];
								$prime_id[]=$key['stockresponseid'];
							}
							else if($threemonth_expire1 >= $date_now)
							{ 
									
								
								$Stock_brand=Stockmaster::find() -> where(['is_active' => 1])-> andWhere(['stockid'=> $key['stockid']]) -> one();
								
								//New Unit Code
								$percentage=$tax_groupinglog['tax'];
								$mrp=$key['mrpperunit'];
								//$multi=100*$mrp;
								$newprice=100*$mrp/(100+$percentage);
								$calculation = number_format($newprice,2, '.', '');
								
								
								
								$result_string.='<tr>';
								$result_string.='<th class="text-center">'.$sl_no.'</th>';
								$result_string.='<th class="hide" id="prd_name'.$key['stockresponseid'].'">'.$productname."/".$composition_name.'</th>';
								
								$result_string.='<input type="hidden" class="form-control" name="stock_id_hide[]" data-id='.$key['stockresponseid'].' id="stock_id'.$key['stockresponseid'].'" value='.$key['stockid'].'>';
								$result_string.='<input type="hidden" class="form-control" name="product_hide[]" data-id='.$key['stockresponseid'].' id="product_id'.$key['stockresponseid'].'" value='.$productid.'>';
								$result_string.='<input type="hidden" class="form-control" name="brand_hide[]" data-id='.$key['stockresponseid'].' id="brandcode_id'.$key['stockresponseid'].'" value='.$Stock_brand->brandcode.'>';
								$result_string.='<input type="hidden" class="form-control" name="stockcode_hide[]" data-id='.$key['stockresponseid'].' id="stockcode_id'.$key['stockresponseid'].'" value='.$Stock_brand->stockcode.'>';
								$result_string.='<input type="hidden" class="form-control" name="composition_hide[]" data-id='.$key['stockresponseid'].' id="composition_id'.$key['stockresponseid'].'" value='.$Stock_brand->compositionid.'>';
								$result_string.='<input type="hidden" class="form-control" name="unitid_hide[]" data-id='.$key['stockresponseid'].' id="unit_id'.$key['stockresponseid'].'" value='.$Stock_brand->unitid.'>';
								
								
								
								
								
								$result_string.='<th class="hide prd_name1">'.$productname."/".$composition_name.'</th>';
								$result_string.='<th class="hide" id="batchnumber'.$key['stockresponseid'].'">'.$key['batchnumber'].'</th>';
								$result_string.='<th class="hide" id="total_qty'.$key['stockresponseid'].'">'.$key['total_no_of_quantity'].'</th>';
								
								$result_string.='<th class="hide" id="gst_sale_percent'.$key['stockresponseid'].'">'.$percentage.'</th>';
								
								
								$result_string.='<th  id="batch_id'.$key['stockresponseid'].'">'.$key['batchnumber'].'</th>';
								$result_string.='<th class="text-center" id="manu_date_id'.$key['stockresponseid'].'">'.date('d-m-Y',strtotime($key['manufacturedate'])).'</th>';
								$result_string.='<th class="text-center" id="expire_date_id'.$key['stockresponseid'].'">'.date('d-m-Y',strtotime($key['expiredate'])).'</th>';
								
								//$result_string.='<th class="text-center" id="mrp_id'.$key['stockresponseid'].'">'.$key['mrpperunit'].'</th>';
								$result_string.='<th class="text-center" id="mrp_id'.$key['stockresponseid'].'">'.$calculation.'</th>';
								$result_string.='<th  class="text-center" id="quanity_id'.$key['stockresponseid'].'">'.$key['total_no_of_quantity'].'</th>';
								
								$result_string.='<th width="14%">';
								$valop=$tab_num+$sl_no;
								if($valop == 501)
								{
									
										$result_string.='<input type="text" class="form-control required_qty tabenter_acc tabenter'.$valop.' number focus_first " name="required_qty_enter[]" data-id='.$key['stockresponseid'].' id="required_id'.$key['stockresponseid'].'"  tabindex="'.$valop.'">';
									
								}
								else
								{
									
									    $result_string.='<input type="text" class="form-control required_qty  tabenter_acc tabenter'.$valop.' number" name="required_qty_enter[]" data-id='.$key['stockresponseid'].' id="required_id'.$key['stockresponseid'].'"  tabindex="'.$valop.'">';
									
								}
								$valop=$valop+1;
								
								
								$result_string.='<input id="getunitvalue'.$key['stockresponseid'].'"  type="hidden" name="selected_value" data-bind="bs-drp-sel-value" value="">';
								
								$result_string.='</th>';
								
								$result_string.='<th width="14%">';
							
								$result_string.='<select  id="data_unit'.$key['stockresponseid'].'" class="form-control unitvalue tabenter_acc tabenter'.$valop.'" data-unit="'.$key['stockresponseid'].'" role="menu" tabindex="'.$valop.'">';
								
								foreach ($unitlist as $key1 => $val) 
								{
									
									    $result_string.='<option data-unit-name="'.$val.'" value="'.$key1.'">'.$val.'</option>';		
											
								}
								$result_string.='</select>';
								
								$result_string.='<span id="validated_field'.$key['stockresponseid'].'" style="color:red;display:none">Req.Quantity type</span>';
								$result_string.='<input id="data_no_of_unit'.$key['stockresponseid'].'"  type="hidden" class="no_of_unit" >';
								$result_string.='<input id="data-unit-name'.$key['stockresponseid'].'"  type="hidden">';
								
								$result_string.='</th>';
								
								$result_string.='<th width="15%">';
								
								
								$result_string.='<input id="total_unit'.$key['stockresponseid'].'"  type="text" class="form-control total_unit" readonly>';
								
								$result_string.='</th>';
								
								$result_string.='</tr>';
								$tot_avail_qty=$tot_avail_qty+$key['total_no_of_quantity'];
								$prime_id[]=$key['stockresponseid'];
							}	
								}
							}
								$sl_no++;$tab_num++;
						}
						$prime_id=implode(',', $prime_id);
						
						
						$result_string.='</tbody> 
											
											<input id="total_available_qty" value="'.$tot_avail_qty.'" type="hidden" class="form-control">
											<input id="prime_id_conv" value="'.$prime_id.'"  type="hidden" class="form-control">
						
						 </table></div>';
					}
			}
			else
			{
				$result_string='NULL';	
			}
			
			return json_encode($result_string);
		
			
	}

	public function actionTemptabletfetch()
    {
    		$Sale=Sales::find()->where(['sales_type' => 'T'])->orderBy(['opsaleid' => SORT_DESC])->all();
			
			$result_string='';
			$result_string.='<div class="table-responsive"><table class="table table-bordered table-striped">';
						$result_string.='<thead style="font-style:normal";><tr>';
						$result_string.='<th rowspan="2" width="1%" class="text-center">#</th>';
						$result_string.='<th rowspan="2" width="5%"  class="text-center">Bill No</th>';
						$result_string.='<th rowspan="2" class="text-center" >Date & Time</th>';
						$result_string.='<th rowspan="2" class="text-center">No of Items</th>';
						$result_string.='<th rowspan="2" class="text-center">Total Amount</th>';
						$result_string.='<th colspan="2" class="text-center">Action</th>';
						
						$result_string.='</tr><tr>';
						$result_string.='<th  class="text-center">SELECT</th>';
						$result_string.='<th  class="text-center">VIEW</th>';
						
						$result_string.='</tr></thead>';
						$result_string.='<tbody id="search_filter"  style="font-style:normal;font-weight:normal;">';
			
			$sno=1;
			foreach ($Sale as $key => $value)
			{
				$Sale_detail=Saledetail::find()->where(['opsaleid' => $value['opsaleid']])->andWhere(['return_status'=>'N'])->one();
				
					$result_string.='<tr>';
					$result_string.='<td  class="text-center">'.$sno.'</td>';
					$result_string.='<td  class="text-center">'.$value['billnumber'].'</td>';
					$result_string.='<td  class="text-center">'.date('d-m-Y H:i:s',strtotime($value['invoicedate'])).'</td>';
					$result_string.='<td  class="text-center">'.$value['tot_no_of_items'].'</td>';
					$result_string.='<td  class="text-center">'.$value['overalltotal'].'</td>';
					$result_string.='<td  class="text-center"><button class="btn btn-success btn-xs temp_select" id="temp_tablet_select'.$value['opsaleid'].'" temp_selectid='.$value['opsaleid'].'  type="button"><i class="fa fa-plus"></i></button></td>';
					$result_string.='<td  class="text-center"><button type="button" class="btn btn-warning btn-xs temp_view" id="temp_tablet_view'.$value['opsaleid'].'" temp_viewid='.$value['opsaleid'].'   data-toggle="modal" data-target="#inner-modal"><i class="fa fa-eye"></i></button></td>';
					$result_string.='</tr>';
				$sno++;	
			}
			$result_string.='</tbody></table>';
			return json_encode($result_string);
	}

	//Temp Tablet
	public function actionTemptabletindividual($id)
    {
    		$Sale=Sales::find()->where(['opsaleid' => $id])->one();
			$Sale_detail=Saledetail::find()->where(['opsaleid' => $id])->andWhere(['return_status'=>'N'])->all();
			$result_string1='';
			$ot=array();
			if(!empty($Sale_detail))
			{
				
				$slno=1;$row=0;
				
				$temp_sales_id=array();
				foreach ($Sale_detail as $key => $value)
				{
					$overallstock=Stockresponse::find()->where(['stockresponseid' => $value['stockresponseid']])->one();
					
					$Stock_code=Stockmaster::find() -> where(['stockid'=> $value['stockid']]) ->one();
					
					$Product = Product::find()->where(['productid'=> $Stock_code->productid ])->one();
					$Composition=Composition::find()->where(['is_active'=>1])-> andWhere(['composition_id' => $Product->composition_id]) ->asArray()->one();
				
					$result_string1.='<tr  class="save_data_table" data-id='.$value['stockresponseid'].' id="table_del'.$value['stockresponseid'].'">';
					$result_string1.='<td class="hide">'.$slno.'</td>';
					$result_string1.='<td><div class="trunctext wd100">'.$Product->productname."/".$Composition['composition_name'].'</div></td>';
								
					
					$result_string1.='<td>'.$overallstock->batchnumber.'</td>';
					$result_string1.='<td>'.date('d-m-Y',strtotime($overallstock->expiredate)).'</td>';
					$result_string1.='<td class="quantity_add" id="quantity_add'.$value['stockresponseid'].'">'.$value['productqty'].'</td>';
					$result_string1.='<td id="unit_value_medicine'.$value['stockresponseid'].'">'.$value['medicine_type_ins'].'</td>';
					$result_string1.='<td>
										  <input type="hidden" name="sales_details[]" id="sales_details'.$value['stockresponseid'].'" value='.$value['opsale_detailid'].'>
										  <input type="hidden" name="medicine_type_ins[]" id="medicine_type_ins'.$value['stockresponseid'].'" value='.$value['medicine_type_ins'].'>
										  <input type="hidden" name="tablet_tot_unit_ins[]" id="tablet_tot_unit'.$value['stockresponseid'].'" value='.$value['tablet_tot_unit_ins'].'>
										  <input type="hidden" name="tablet_type[]" id="tablet_type'.$value['stockresponseid'].'" value="'.$value['tablet_type'].'">
										  <input type="hidden" name="mrp_rate_per_unit[]" value="'.$value['mrpperunit'].'">
										  <input type="hidden" name="stock_id[]" value="'.$value['stockid'].'">
										  <input type="hidden" name="unit_id[]" value="'.$value['unitid'].'">
										  <input type="hidden" name="composition_id[]" value="'.$value['compositionid'].'">
										  <input type="hidden" name="stockcode_id[]" value="'.$value['stock_code'].'">
										  <input type="hidden" name="brandcode_id[]" value="'.$value['brandcode'].'">
										  <input type="hidden" name="product_name_id[]" value="'.$value['productid'].'">
										  <input type="hidden" name="expire_date_id[]" value="'.$value['expiredate'].'">
										  <input type="hidden" name="batchnumber[]" value="'.$value['batchnumber'].'">
										  <input type="hidden" name="product_name[]" value="'.$Product->productname."/".$Composition['composition_name'].'">
										  <input type="hidden" name="quantity[]" value="'.$value['productqty'].'">
										  <input type="hidden" name="primeid[]" value="'.$value['stockresponseid'].'">
										  <input type="text" name="price[]" class="price_mrp text-right form-control" data_price_mrp="'.$value['stockresponseid'].'" value='.$value['priceperqty'].' id="price'.$value['stockresponseid'].'">	
									  </td>';
					$result_string1.='<td><ul class="donate-now">
											<input type="hidden" name="discount_method[]" id="disc_method'.$value['stockresponseid'].'">
											<li><input type="radio" disabled="disabled"  name="desc'.$value['stockresponseid'].'" data_flat='.$value['stockresponseid'].' id="flat_discount'.$value['stockresponseid'].'" class="deselect flat testrad"  onchange="descChanged('.$value['stockresponseid'].')">
											<label for="flat_discount'.$value['stockresponseid'].'" class="w-50 text-center testrad">F</label></li><li>
											<input type="radio"  disabled="disabled" id="percent'.$value['stockresponseid'].'" data-deselect='.$value['stockresponseid'].' class="deselect percent testrad" name="desc'.$value['stockresponseid'].'"  onchange="descChanged('.$value['stockresponseid'].')" >
											<label for="percent'.$value['stockresponseid'].'" class="w-50 text-center testrad">%</label></li></ul></td>';
					$result_string1.='<td><div class="input-group"> <input type="text"  disabled="disabled" name="discount_value[]" data_disc_value='.$value['stockresponseid'].' id="enabledisc'.$value['stockresponseid'].'" class="enabledisc disctxt w-50" readonly></div>
					
										</td>';						
					$result_string1.='<td class="w-xss"><input type="hidden" class="form-control" data_gst_percent='.$value['stockresponseid'].' name="gst_percent[]" id="gst_percent'.$value['stockresponseid'].'" value="'.$value['gstrate'].'">
														<input type="text" name="discountext_value[]"  disabled="disabled" id="disc_amount'.$value['stockresponseid'].'" class="add_discount text-right disctxt w-50" readonly>
														
									  </td>';
					
					$result_string1.='<td><input type="text" class="form-control" data_igst_percent='.$value['stockresponseid'].' id="igst_percent'.$value['stockresponseid'].'" value="0" readonly></td>';
					
					
					$result_string1.='<td><input type="text"  class="form-control" data_igst_value='.$value['stockresponseid'].' id="igst_value'.$value['stockresponseid'].'" value="0" readonly></td>';
					
					$result_string1.='<td class="w-xss"><input type="text"  class="form-control cgst_percent text-right" name="cgst_percent[]" data_cgst_percent='.$value['stockresponseid'].' id="cgst_percent'.$value['stockresponseid'].'" value="'.$value['cgst_percent'].'" readonly></td>';
					
					$result_string1.='<td><input type="text"  class="form-control cgst_value text-right" name="cgst_value[]" data_cgst_value='.$value['stockresponseid'].' id="cgst_value'.$value['stockresponseid'].'" value="'.$value['cgstvalue'].'"  readonly></td>';
					
					$result_string1.='<td class="w-xss"><input type="text"  class="form-control sgst_percent" name="sgst_percent[]" data_sgst_percent='.$value['stockresponseid'].' id="sgst_percent'.$value['stockresponseid'].'"  value="'.$value['sgst_percent'].'"  readonly></td>';
					
					$result_string1.='<td><input type="text"  class="form-control sgst_value text-right" name="sgst_value[]" data_sgst_value='.$value['stockresponseid'].' id="sgst_value'.$value['stockresponseid'].'" value="'.$value['sgstvalue'].'"   readonly></td>';
					
					$result_string1.='<td><input type="text"  class="form-control total_amt_cal text-right" name="total_amt_cal[]" data_total='.$value['stockresponseid'].' id="total_amount'.$value['stockresponseid'].'" value="'.$value['total_price_perqty'].'"    readonly></td>';
					
					$result_string1.='<td class="text-center"><button type="button" class="btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow" data_delete_row='.$value['stockresponseid'].' id="delrow'.$value['stockresponseid'].'"><i class="fa fa-remove"></i></button></td>';
					
					$result_string1.='</tr>';
					
					$slno++;	
					$row++;	
									
				}

				$ot[0]=$result_string1;
				$ot[1]=$Sale->tot_quantity;
				$ot[2]=$Sale->tot_no_of_items;
				$ot[3]=$Sale->totalgstvalue;
				$ot[4]=$Sale->totaldiscountvalue;
				$ot[5]=$Sale->total;
				$ot[6]=$Sale->total;
				$ot[7]=$Sale->overalltotal;
				$ot[8]=$row;
				$ot[9]=$Sale->opsaleid;
				$ot[10]=$Sale->overalldiscountpercent;
			}
			else
			{
				$ot[0]='NULL';
			}
			
			return json_encode($ot);
	}
	
	public function actionGetunitquantity($id)
    {
    	$unit_id = json_decode($id);
		$rows=Unit::find()->where(['unitid'=>$unit_id])->one();
		$get_name=array();
		$get_name[0]=$rows->no_of_unit;
		$get_name[1]=$rows->unitvalue;
		
       return json_encode($get_name);
	}

	//Fetch Bill Number
	public function actionGetbillcounter($id)
    {
    	
    	$yu=trim($id," ");
		$Sale=Sales::find()->where(['LIKE','billnumber',$yu])->andWhere(['sales_type' => 'T'])->all();
		$result_string='';
			
			$sno=1;
			foreach ($Sale as $key => $value)
			{
				$result_string.='<tr>';
				$result_string.='<td  class="text-center">'.$sno.'</td>';
				$result_string.='<td  class="text-center">'.$value['billnumber'].'</td>';
				$result_string.='<td  class="text-center">'.date('d-m-Y H:i:s',strtotime($value['invoicedate'])).'</td>';
				$result_string.='<td  class="text-center">'.$value['tot_no_of_items'].'</td>';
				$result_string.='<td  class="text-center">'.$value['overalltotal'].'</td>';
				$result_string.='<td  class="text-center"><button class="btn btn-success btn-xs temp_select" id="temp_tablet_select'.$value['opsaleid'].'" temp_selectid='.$value['opsaleid'].'  type="button"><i class="fa fa-plus"></i></button></td>';
				$result_string.='<td  class="text-center"><button type="button" class="btn btn-warning btn-xs temp_view" id="temp_tablet_view'.$value['opsaleid'].'" temp_viewid='.$value['opsaleid'].'   data-toggle="modal" data-target="#inner-modal"><i class="fa fa-eye"></i></button></td>';
				$result_string.='</tr>';
				$sno++;	
			}

			return json_encode($result_string);
	}
	
	
	public function actionSaveddata()
    {
    	$saledata = new Sales();
    	$patientdata=new Newpatient();
		
		//Session of Branch Id
		$session = Yii::$app->session;
		$branch_id=$session['branch_id'];
		$saleid='';
    	
    	
    	if($_POST)
		{
			
		 	$primary_id=$_POST['primeid'];
			$quantity=$_POST['quantity'];
			$price=$_POST['price'];
			$discount_method=$_POST['discount_method'];
			$discount_value=$_POST['discount_value'];
			$discoun_type=$_POST['discountext_value'];
			$gst_percent=$_POST['gst_percent'];
			$cgst_percent=$_POST['cgst_percent'];
			$cgst_value=$_POST['cgst_value'];
			$sgst_percent=$_POST['sgst_percent'];
			$sgst_value=$_POST['sgst_value'];
			$total_amt_cal=$_POST['total_amt_cal'];
			$total_net_amount=$_POST['total_net_amount'];
			
			$total_disc_original=$_POST['total_disc_original'];
			$overall_discount_percent=$_POST['overall_discount_percent'];
			
			$total_gst=$_POST['total_gst'];
			$batchnumber=$_POST['batchnumber'];
			$product_name_id=$_POST['product_name_id'];
			$brandcode_id=$_POST['brandcode_id'];
			$stockcode_id=$_POST['stockcode_id'];
			$composition_id=$_POST['composition_id'];
			$unit_id=$_POST['unit_id'];
			$stock_id=$_POST['stock_id'];
			$expire_date_id=$_POST['expire_date_id'];
			$mrp_rate_per_unit=$_POST['mrp_rate_per_unit'];
			$total_items=$_POST['total_items'];
			$product_name=$_POST['product_name'];
			$tablet_type=$_POST['tablet_type'];
			$total_quantity=$_POST['total_quantity'];
			$medicine_type_ins=$_POST['medicine_type_ins'];
			$tablet_tot_unit_ins=$_POST['tablet_tot_unit_ins'];
			
			
			$overall_discount_type=$_POST['overall_discount_type'];
			$overall_sub_total=$_POST['total_sub_total'];
					
			if($_POST['patient'] == 'inpatient')
			{
				
				$subvisit=SubVisit::find()->where(['mr_number'=>$_POST['mr_number']])->andWhere(['date(created_at)'=>date('Y-m-d')])->orderBy(['sub_id' => SORT_DESC])->one();
				$patientdata=Newpatient::find()->where(['patientid'=>$subvisit->pat_id])->one();
				
				//Entry Tablet
				if($_POST['get_temp_no'] == '')
				{
				
					
					
					
								$medical_record_number=$_POST['mr_number'];
								
								$In_pat_name=$_POST['in_patient'];
								$In_pat_mob=$_POST['in_patient_mobile'];
								$In_doctor_name=$_POST['in_doctor_name'];
								$In_insurance_type=$_POST['insurance_type'];
								$In_date_of_birth=date('Y-m-d',strtotime($_POST['date_of_birth']));
								
								//New Insert 23/08/2018
								$saledata->patient_id=$patientdata->patientid;
								$saledata->subvisit_id=$subvisit->sub_id;
								$saledata->subvisit_num=$subvisit->sub_visit;
								$saledata->gender=$_POST['gender'];
								$saledata->address=$_POST['Address'];
								
								
								
								$saledata->mrnumber=$medical_record_number;
								$saledata->branch_id=$branch_id;
								$saledata->sales_type='I';
								$saledata->name=$In_pat_name;
								$saledata->dob=$In_date_of_birth;
								$saledata->physicianname=$In_doctor_name;
								$saledata->insurancetype=$In_insurance_type;
								$saledata->patienttype=1;
								$saledata->phonenumber=$In_pat_mob;
								$saledata->tot_no_of_items=$total_items;
								$saledata->tot_quantity=$total_quantity;
								
								
								$saledatainc=Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
								$saleincrement=$saledatainc->saleincrement+1;
								$billformat = "ECDR".($saleincrement);
								$saledata->saleincrement=$saleincrement;
								$saledata -> billnumber = $billformat;
								$saledata -> invoicedate = date("Y-m-d h:i:s");
								$saledata -> total = $total_net_amount;
								foreach ($primary_id as $key => $value)
								{
									$totalcgstvalue+= $cgst_value[$key];
									$totalsgstvalue+= $sgst_value[$key];
									
									$totalsgstpercent+= $sgst_percent[$key];
									$totalcgstpercent+= $cgst_percent[$key];
								}
								$total_gst_value=$totalcgstvalue+$totalsgstvalue;
								$total_gst_percent=$totalcgstpercent+$totalsgstpercent;
								
								$saledata -> total_gst_percent = $total_gst_percent;
								$saledata -> total_cgst_percent = $totalcgstpercent;
								$saledata -> total_sgst_percent = $totalsgstpercent;
								
								
								$saledata -> totalgstvalue = $total_gst_value;
								$saledata -> totalcgstvalue = $totalcgstvalue;
								$saledata -> totalsgstvalue = $totalsgstvalue;
								$saledata -> totaldiscountvalue = $total_disc_original;
								$saledata -> totaltaxableamount = $total_gst;
								$saledata -> overall_sub_total = $overall_sub_total;
								
								$saledata -> overalltotal = $total_net_amount;
								$saledata -> paid_status = 'Paid';
								$saledata -> updated_by = $session['user_id'];
								$saledata -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
								$saledata -> updated_on = date("Y-m-d H:i:s");
								
								//new Code
								$saledata -> overalldiscountpercent = $overall_discount_percent;
								$saledata -> overalldiscountamount = $total_disc_original;
								$saledata -> overalldiscounttype = $overall_discount_type;
								$saledata -> created_at = date("Y-m-d H:i:s");
								
								if($saledata ->save())
								{
									$saleid = $saledata -> opsaleid;
									$i = 1;
									foreach ($primary_id as $key => $value)
									{
										
										$Saledetail = new Saledetail();
										$Saledetail -> opsaleid = $saleid;
										$Saledetail -> stockid = $stock_id[$key];
										$Saledetail -> stockresponseid = $value;
										$Saledetail -> price = $price[$key];
										
										$Saledetail -> saledate = date('Y-m-d h:i:s');
										$Saledetail -> productid =  $product_name_id[$key];
										$Saledetail -> batchnumber =  $batchnumber[$key];
										$Saledetail -> brandcode = $brandcode_id[$key];
										$Saledetail -> stock_code = $stockcode_id[$key];
										$Saledetail -> compositionid = $composition_id[$key];
										$Saledetail -> unitid = $unit_id[$key];
										$Saledetail -> productqty = $quantity[$key];
										$Saledetail -> priceperqty = $price[$key];
										$Saledetail -> expiredate = date('Y-m-d',strtotime($expire_date_id[$key]));
										
										$Saledetail -> discountvalueperquantity = $discoun_type[$key];
										
										$total_gst_value= $cgst_value[$key]+$sgst_value[$key];
										
										$Saledetail -> gstrate = $gst_percent[$key];
										
										$Saledetail -> gstvalue = $total_gst_value;
										$Saledetail -> cgstvalue = $cgst_value[$key];
										$Saledetail -> sgstvalue = $sgst_value[$key];
										$Saledetail -> discountvalue = $discount_value[$key];
										$Saledetail -> discount_type = $discount_method[$key];
										$Saledetail -> mrpperunit = $mrp_rate_per_unit[$key];
										$Saledetail -> sgst_percent = $sgst_percent[$key];
										$Saledetail -> cgst_percent = $cgst_percent[$key];
										
										$Saledetail -> total_price_perqty = $total_amt_cal[$key];
										
										$Saledetail -> product_name = $product_name[$key];
										
										$Saledetail -> tablet_type = $tablet_type[$key];
										$Saledetail -> 	medicine_type_ins = $medicine_type_ins[$key];						
										$Saledetail -> 	tablet_tot_unit_ins = $tablet_tot_unit_ins[$key];
										
										
										$Saledetail -> is_active = 1;
										$Saledetail -> updated_by = $session['user_id'];
										$Saledetail -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
										$Saledetail -> updated_on = date("Y-m-d H:i:s");
										$Saledetail -> 	created_at = date("Y-m-d H:i:s");
										if($Saledetail -> save())
										{
											
										}
										else {
											print_r($Saledetail->getErrors());
							                 die;	
										}
										
									}
								}	
								else {
										print_r($saledata->getErrors());
										die;	
									 }
								
									$overallstock=Stockresponse::find()->where(['IN','stockresponseid',$primary_id])->all();
									$overallstock_array=ArrayHelper::toArray($overallstock);
										
										if(!empty($overallstock_array))
										{
											foreach ($overallstock_array as $key => $value)
											{
													$Stock_brand=Stockmaster::find() -> where(['is_active' => 1])-> andWhere(['stockid'=> $value['stockid']]) -> one();
													$overallstock_updated=Stockresponse::find()->where(['stockresponseid'=> $value['stockresponseid']])->one();
													$Stock_brand_array=ArrayHelper::toArray($Stock_brand);
													$current_quantity=$value['total_no_of_quantity'];
													$updated_quantity=$quantity;
													$nw_quantity=$current_quantity-$updated_quantity[$key];
													$overallstock_updated->total_no_of_quantity=$nw_quantity;
													$overallstock_updated->sales_status='Y';
													
													if($overallstock_updated->save())
													{
														$stock_quantity=$Stock_brand->total_no_of_quantity;
														$updated_stock_quantity=$stock_quantity-$updated_quantity[$key];
														$Stock_brand->total_no_of_quantity=$updated_stock_quantity;
														if($Stock_brand->save())
														{
															
														}
														else 
														{
															print_r($Stock_brand->getErrors());die;
														}
												    }
													else 
													{
														print_r($overallstock_updated->getErrors());die;
													}	
											}
										}
										$saledatainc=Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
										return "Y=".$saledatainc->opsaleid;	
				}
				elseif ($_POST['get_temp_no'] != '') 
				{
					
					$sales_details=$_POST['sales_details'];
					$session = Yii::$app->session;
					$saledetaildata=Saledetail::find()->where(['IN','opsale_detailid',$sales_details])->all();
					if(!empty($saledetaildata))
					{
						
						foreach ($saledetaildata as $key => $value)
						{
							
							$value->medicine_type_ins= $_POST['medicine_type_ins'][$key];
							$value->tablet_tot_unit_ins= $_POST['tablet_tot_unit_ins'][$key];
							$value->tablet_type= $_POST['tablet_type'][$key];
							$value->mrpperunit= $_POST['mrp_rate_per_unit'][$key];
							$value->stockid= $_POST['stock_id'][$key];
							$value->unitid= $_POST['unit_id'][$key];
							$value->compositionid= $_POST['composition_id'][$key];
							$value->stock_code= $_POST['stockcode_id'][$key];
							$value->brandcode= $_POST['brandcode_id'][$key];
							$value->productid= $_POST['product_name_id'][$key];
							$value->expiredate= $_POST['expire_date_id'][$key];
							$value->batchnumber= $_POST['batchnumber'][$key];
							$value->product_name= $_POST['product_name'][$key];
							$value->productqty= $_POST['quantity'][$key];
							$value->stockresponseid= $_POST['primeid'][$key];
							$value->priceperqty= $_POST['price'][$key];
							$value->discount_type= $_POST['discount_method'][$key];
							$value->discountvalue= $_POST['discount_value'][$key];
							$value->gstrate= $_POST['gst_percent'][$key];
							$value->discountvalueperquantity= $_POST['discountext_value'][$key];
							$value->cgst_percent= $_POST['cgst_percent'][$key];
							$value->cgstvalue= $_POST['cgst_value'][$key];
							$value->sgst_percent= $_POST['sgst_percent'][$key];
							$value->sgstvalue= $_POST['sgst_value'][$key];
							$value->total_price_perqty= $_POST['total_amt_cal'][$key];
							$value -> is_active = 1;
							$value -> updated_by = $session['user_id'];
							$value -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
							$value -> updated_on = date("Y-m-d H:i:s");
							
							
							if($value->save())
							{
								
							}	
							else {
								print_r($value->getErrors());
								                 die;
							}
						}
					
						$saletempinsert=Sales::find()->where(['opsaleid' => $_POST['get_temp_no']])->one();
						if(!empty($saletempinsert))
						{
							$saletempinsert=Sales::find()->where(['opsaleid' => $_POST['get_temp_no']])->one();
							$saletempinsert->branch_id=$branch_id;
							$saletempinsert->sales_type='I';
							//$saletempinsert->return_status='Y';
							
							//New Code Temp
							$saletempinsert->mrnumber=$_POST['mr_number'];
							
							$saletempinsert->name=$_POST['in_patient'];
							$saletempinsert->phonenumber=$_POST['in_patient_mobile'];
							$saletempinsert->physicianname=$_POST['in_doctor_name'];
							$saletempinsert->insurancetype=$_POST['insurance_type'];
							$saletempinsert->dob=date('Y-m-d',strtotime($_POST['date_of_birth']));
							
							if($saletempinsert->save())
							{
								/*$overallstock=Stockresponse::find()->where(['IN','stockresponseid',$_POST['primeid']])->all();
								$overallstock_array=ArrayHelper::toArray($overallstock);
									
									if(!empty($overallstock_array))
									{
										foreach ($overallstock_array as $key => $value)
										{
												$Stock_brand=Stockmaster::find() -> where(['is_active' => 1])-> andWhere(['stockid'=> $value['stockid']]) -> one();
												$overallstock_updated=Stockresponse::find()->where(['stockresponseid'=> $value['stockresponseid']])->one();
												$Stock_brand_array=ArrayHelper::toArray($Stock_brand);
												$current_quantity=$value['total_no_of_quantity'];
												$updated_quantity=$quantity;
												$nw_quantity=$current_quantity+$updated_quantity[$key];
												$overallstock_updated->total_no_of_quantity=$nw_quantity;
												if($overallstock_updated->save())
												{
													$stock_quantity=$Stock_brand->total_no_of_quantity;
													$updated_stock_quantity=$stock_quantity+$updated_quantity[$key];
													$Stock_brand->total_no_of_quantity=$updated_stock_quantity;
													if($Stock_brand->save())
													{
														
													}
													else 
													{
														print_r($Stock_brand->getErrors());die;
													}
												}
												else 
												{
													print_r($overallstock_updated->getErrors());die;
												}	
										}
									}*/
									
									return "Y=OPTEMPSAVED";							
							}
						}		
					}
						
				}	
					
			}
			else if($_POST['patient'] == 'outpatient')
			{
			
				
				if($_POST['get_temp_no'] == '')
				{
					
					$Mrnumber=$_POST['Newpatient']['mr_no'];
					$patient_name=$_POST['patient_name'];
					$mobile_number=$_POST['mobile_number'];
					$doctor_name=$_POST['doctor_name'];
					$insurance_type_ins=$_POST['insurance_type_ins'];
					$patientdata->mr_no=$Mrnumber;
					$patientdata->patientname=$patient_name;
					$patientdata->pat_mobileno=$mobile_number;
					$patientdata->doctor_name=$doctor_name;
					$patientdata->insurance_type_id=$insurance_type_ins;
					
					
					$patientdata->updated_at=date("Y-m-d h:i:s");
					$patientdata->create_at=date("Y-m-d h:i:s");
					
					$patientdata->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
					$session = Yii::$app->session;
					$branch_id=$session['branch_id'];
					$patientdata->user_role=$session['user_id'];
					$patientdata->branch_id=$branch_id;
					
					
					if($patientdata->save())
					{
						$out_patient=Newpatient::find()->orderBy(['patientid'=>SORT_DESC])->one();
						$out_patient_array=ArrayHelper::toArray($out_patient);
						
						$Out_Firstname=$out_patient_array['patientname'];
						$Out_Mobilenumber=$out_patient_array['pat_mobileno'];
						$Out_Physicianname=$out_patient_array['doctor_name'];
						$Out_Primeid=$out_patient_array['patientid'];
						
									$saledata->branch_id=$branch_id;
									$saledata->sales_type='O';
									$saledata->mrnumber=$Mrnumber;
									$saledata->name=$Out_Firstname;
									$saledata->patient_id=$Out_Primeid;
									$saledata->physicianname=$Out_Physicianname;
									$saledata->patienttype=2;
									$saledata->phonenumber=$Out_Mobilenumber;
									$saledatainc=Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
									$saleincrement=$saledatainc->saleincrement+1;
									$billformat = "ECGR".($saleincrement);
									$saledata->saleincrement=$saleincrement;
									$saledata->tot_no_of_items=$total_items;
									
									$saledata->tot_quantity=$total_quantity;
									
									$saledata -> billnumber = $billformat;
									$saledata -> invoicedate = date("Y-m-d h:i:s");
									$saledata -> total = $total_net_amount;
									foreach ($primary_id as $key => $value)
									{
										$totalcgstvalue+= $cgst_value[$key];
										$totalsgstvalue+= $sgst_value[$key];
										
										$totalsgstpercent+= $sgst_percent[$key];
										$totalcgstpercent+= $cgst_percent[$key];	
									}
									
									$total_gst_percent=$totalcgstpercent+$totalsgstpercent;
									$total_gst_value=$totalcgstvalue+$totalsgstvalue;
									
									$saledata -> total_gst_percent = $total_gst_percent;
									$saledata -> total_cgst_percent = $totalcgstpercent;
									$saledata -> total_sgst_percent = $totalsgstpercent;
									
									
									$saledata -> totalgstvalue = $total_gst_value;
									$saledata -> totalcgstvalue = $totalcgstvalue;
									$saledata -> totalsgstvalue = $totalsgstvalue;
									$saledata -> totaldiscountvalue = $total_disc_original;
									$saledata -> totaltaxableamount = $total_gst;
									$saledata -> overalltotal = $total_net_amount;
									
									$saledata -> paid_status = 'Paid';
									$saledata -> updated_by = $session['user_id'];
									$saledata -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
									$saledata -> updated_on = date("Y-m-d H:i:s");
									
									//new Code
								$saledata -> overalldiscountpercent = $overall_discount_percent;
								$saledata -> overalldiscountamount = $total_disc_original;
								$saledata -> overalldiscounttype = $overall_discount_type;
								$saledata -> 	created_at =date("Y-m-d H:i:s");
								$saledata -> overall_sub_total = $overall_sub_total;
									
									if($saledata -> save())
									{
										$saleid = $saledata -> opsaleid;
										$i = 1;
										foreach ($primary_id as $key => $value)
										{
											
											$Saledetail = new Saledetail();
											$Saledetail -> opsaleid = $saleid;
											$Saledetail -> stockid = $stock_id[$key];
											$Saledetail -> stockresponseid = $value;
											$Saledetail -> price = $price[$key];
											
											$Saledetail -> saledate = date('Y-m-d h:i:s');
											$Saledetail -> productid =  $product_name_id[$key];
											$Saledetail -> batchnumber =  $batchnumber[$key];
											$Saledetail -> brandcode = $brandcode_id[$key];
											$Saledetail -> stock_code = $stockcode_id[$key];
											$Saledetail -> compositionid = $composition_id[$key];
											$Saledetail -> unitid = $unit_id[$key];
											$Saledetail -> productqty = $quantity[$key];
											$Saledetail -> priceperqty = $price[$key];
											$Saledetail -> expiredate = date('Y-m-d',strtotime($expire_date_id[$key]));
											
											$Saledetail -> discountvalueperquantity = $discoun_type[$key];
											
											$Saledetail -> gstrate = $gst_percent[$key];
											
											$total_gst_value= $cgst_value[$key]+$sgst_value[$key];
											
											$Saledetail -> gstvalue = $total_gst_value;
											$Saledetail -> cgstvalue = $cgst_value[$key];
											$Saledetail -> sgstvalue = $sgst_value[$key];
											$Saledetail -> discountvalue = $discount_value[$key];
											$Saledetail -> discount_type = $discount_method[$key];
											$Saledetail -> mrpperunit = $mrp_rate_per_unit[$key];
											
											$Saledetail -> sgst_percent = $sgst_percent[$key];
											$Saledetail -> cgst_percent = $cgst_percent[$key];
											$Saledetail -> total_price_perqty = $total_amt_cal[$key];
											
											$Saledetail -> product_name = $product_name[$key];
											$Saledetail -> tablet_type = $tablet_type[$key];
											$Saledetail -> 	medicine_type_ins = $medicine_type_ins[$key];
											$Saledetail -> 	tablet_tot_unit_ins = $tablet_tot_unit_ins[$key];
							
											
											$Saledetail -> is_active = 1;
											$Saledetail -> updated_by = $session['user_id'];
											$Saledetail -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
											$Saledetail -> updated_on = date("Y-m-d H:i:s");
											$Saledetail -> 	created_at = date("Y-m-d H:i:s");
											
											if($Saledetail -> save())
											{
												
											}
											else {
												print_r($Saledetail->getErrors());
								                 die;	
											}
											
										}
								}
							}
			
								$overallstock=Stockresponse::find()->where(['IN','stockresponseid',$primary_id])->all();
								$overallstock_array=ArrayHelper::toArray($overallstock);
									
									if(!empty($overallstock_array))
									{
										foreach ($overallstock_array as $key => $value)
										{
												$Stock_brand=Stockmaster::find() -> where(['is_active' => 1])-> andWhere(['stockid'=> $value['stockid']]) -> one();
												$overallstock_updated=Stockresponse::find()->where(['stockresponseid'=> $value['stockresponseid']])->one();
												$Stock_brand_array=ArrayHelper::toArray($Stock_brand);
												$current_quantity=$value['total_no_of_quantity'];
												$updated_quantity=$quantity;
												$nw_quantity=$current_quantity-$updated_quantity[$key];
												$overallstock_updated->total_no_of_quantity=$nw_quantity;
												$overallstock_updated->sales_status='Y';
												if($overallstock_updated->save())
												{
													$stock_quantity=$Stock_brand->total_no_of_quantity;
													$updated_stock_quantity=$stock_quantity-$updated_quantity[$key];
													$Stock_brand->total_no_of_quantity=$updated_stock_quantity;
													if($Stock_brand->save())
													{
														
													}
													else 
													{
														print_r($Stock_brand->getErrors());die;
													}
												}
												else 
												{
													print_r($overallstock_updated->getErrors());die;
												}	
										}
									}
									$saledatainc=Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
									return "Y=".$saledatainc->opsaleid;
				}
				else if($_POST['get_temp_no'] != '') 
				{
					$sales_details=$_POST['sales_details'];
					$session = Yii::$app->session;
					$saledetaildata=Saledetail::find()->where(['IN','opsale_detailid',$sales_details])->all();
					if(!empty($saledetaildata))
					{
						//print_r($_POST);die;
						foreach ($saledetaildata as $key => $value)
						{
							//$value->return_status= 'Y';
							$value->medicine_type_ins= $_POST['medicine_type_ins'][$key];
							$value->tablet_tot_unit_ins= $_POST['tablet_tot_unit_ins'][$key];
							$value->tablet_type= $_POST['tablet_type'][$key];
							$value->mrpperunit= $_POST['mrp_rate_per_unit'][$key];
							$value->stockid= $_POST['stock_id'][$key];
							$value->unitid= $_POST['unit_id'][$key];
							$value->compositionid= $_POST['composition_id'][$key];
							$value->stock_code= $_POST['stockcode_id'][$key];
							$value->brandcode= $_POST['brandcode_id'][$key];
							$value->productid= $_POST['product_name_id'][$key];
							$value->expiredate= $_POST['expire_date_id'][$key];
							$value->batchnumber= $_POST['batchnumber'][$key];
							$value->product_name= $_POST['product_name'][$key];
							$value->productqty= $_POST['quantity'][$key];
							$value->stockresponseid= $_POST['primeid'][$key];
							$value->priceperqty= $_POST['price'][$key];
							$value->discount_type= $_POST['discount_method'][$key];
							$value->discountvalue= $_POST['discount_value'][$key];
							$value->gstrate= $_POST['gst_percent'][$key];
							$value->discountvalueperquantity= $_POST['discountext_value'][$key];
							$value->cgst_percent= $_POST['cgst_percent'][$key];
							$value->cgstvalue= $_POST['cgst_value'][$key];
							$value->sgst_percent= $_POST['sgst_percent'][$key];
							$value->sgstvalue= $_POST['sgst_value'][$key];
							$value->total_price_perqty= $_POST['total_amt_cal'][$key];
							$value -> is_active = 1;
							$value -> updated_by = $session['user_id'];
							$value -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
							$value -> updated_on = date("Y-m-d H:i:s");
							
							
							if($value->save())
							{
								
							}	
							else {
								print_r($value->getErrors());
								                 die;
							}
						}
						$salesadding=Saledetail::find()->where(['opsaleid'=>$_POST['get_temp_no']])->andWhere(['return_status'=>'N'])->all();
						if(!empty($salesadding))
						{
							$cgstvalue_add;
							$sgstvalue_add;
							$gstvalue_add;
							$tot_no_items;
							$tot_no_items=0;
							$priceperqty_add=0;
							$tablet_tot_unit_ins_add=0;
							$discountvalueperquantity_add=0;
							$total_price_perqty_add=0;
							$over_all_amount_add=0;
							$session = Yii::$app->session;
							$branch_id=$session['branch_id'];
							foreach ($salesadding as $key => $value) 
							{
									
								$cgstvalue_add+=$value->cgstvalue;
								$sgstvalue_add+=$value->sgstvalue;
								$tot_no_items++;
								$priceperqty_add+=$value->priceperqty;
								$tablet_tot_unit_ins_add+=$value->tablet_tot_unit_ins;
								$discountvalueperquantity_add+=$value->discountvalueperquantity;
								$total_price_perqty_add+=$value->total_price_perqty;
								$over_all_amount_add+=$value->total_price_perqty;
							}
							
							$gstvalue_add=$sgstvalue_add+$cgstvalue_add;
							
							$saletempinsert=Sales::find()->where(['opsaleid' => $_POST['get_temp_no']])->one();
							if(!empty($saletempinsert))
							{
								$saletempinsert->branch_id=$branch_id;
								$saletempinsert->sales_type='O';
								$saletempinsert->return_status='Y';
								$saletempinsert->name=$_POST['patient_name'];
								$saletempinsert->phonenumber=$_POST['mobile_number'];
								$saletempinsert->physicianname=$_POST['doctor_name'];
								$saletempinsert->total=$priceperqty_add;
								$saletempinsert->tot_no_of_items=$tot_no_items;
								$saletempinsert->tot_quantity=$tablet_tot_unit_ins_add;
								$saletempinsert->totalgstvalue=$gstvalue_add;
								$saletempinsert->totalcgstvalue=$cgstvalue_add;
								$saletempinsert->totalsgstvalue=$sgstvalue_add;
								$saletempinsert->totaltaxableamount=$total_price_perqty_add;
								$saletempinsert->overalltotal=$over_all_amount_add;
								
								
								if($saletempinsert->save())
								{
									
									/*$overallstock=Stockresponse::find()->where(['IN','stockresponseid',$_POST['primeid']])->all();
									$overallstock_array=ArrayHelper::toArray($overallstock);
									
									if(!empty($overallstock_array))
									{
										foreach ($overallstock_array as $key => $value)
										{
												$Stock_brand=Stockmaster::find() -> where(['is_active' => 1])-> andWhere(['stockid'=> $value['stockid']]) -> one();
												$overallstock_updated=Stockresponse::find()->where(['stockresponseid'=> $value['stockresponseid']])->one();
												$Stock_brand_array=ArrayHelper::toArray($Stock_brand);
												$current_quantity=$value['total_no_of_quantity'];
												$updated_quantity=$quantity;
												$nw_quantity=$current_quantity+$updated_quantity[$key];
												$overallstock_updated->total_no_of_quantity=$nw_quantity;
												if($overallstock_updated->save())
												{
													$stock_quantity=$Stock_brand->total_no_of_quantity;
													$updated_stock_quantity=$stock_quantity+$updated_quantity[$key];
													$Stock_brand->total_no_of_quantity=$updated_stock_quantity;
													if($Stock_brand->save())
													{
														
													}
													else 
													{
														print_r($Stock_brand->getErrors());die;
													}
												}
												else 
												{
													print_r($overallstock_updated->getErrors());die;
												}	
										}
									}*/
									
									return "Y=OPTEMPSAVED";	
									
								}
								else {
									print_r($saletempinsert->getErrors());
								                 die;
								}
							}
							
						}
						else if(empty($salesadding))
						{
							
							$saletempinsert=Sales::find()->where(['opsaleid' => $_POST['get_temp_no']])->one();
							$saletempinsert->branch_id=$branch_id;
							$saletempinsert->sales_type='O';
							$saletempinsert->return_status='Y';
							$saletempinsert->name=$_POST['patient_name'];
							$saletempinsert->phonenumber=$_POST['mobile_number'];
							$saletempinsert->physicianname=$_POST['physicianname'];
							
							if($saletempinsert->save())
							{
								$overallstock=Stockresponse::find()->where(['IN','stockresponseid',$_POST['primeid']])->all();
								$overallstock_array=ArrayHelper::toArray($overallstock);
									
									if(!empty($overallstock_array))
									{
										foreach ($overallstock_array as $key => $value)
										{
												$Stock_brand=Stockmaster::find() -> where(['is_active' => 1])-> andWhere(['stockid'=> $value['stockid']]) -> one();
												$overallstock_updated=Stockresponse::find()->where(['stockresponseid'=> $value['stockresponseid']])->one();
												$Stock_brand_array=ArrayHelper::toArray($Stock_brand);
												$current_quantity=$value['total_no_of_quantity'];
												$updated_quantity=$quantity;
												$nw_quantity=$current_quantity+$updated_quantity[$key];
												$overallstock_updated->total_no_of_quantity=$nw_quantity;
												if($overallstock_updated->save())
												{
													$stock_quantity=$Stock_brand->total_no_of_quantity;
													$updated_stock_quantity=$stock_quantity+$updated_quantity[$key];
													$Stock_brand->total_no_of_quantity=$updated_stock_quantity;
													if($Stock_brand->save())
													{
														
													}
													else 
													{
														print_r($Stock_brand->getErrors());die;
													}
												}
												else 
												{
													print_r($overallstock_updated->getErrors());die;
												}	
										}
									}
									
									return "Y=OPTEMPSAVED";							
							}
						}		
					}
						
				}
					
			}
			else if($_POST['patient'] == 'temppatient')
			{
				
								$saledata->branch_id=$branch_id;
								$saledata->sales_type='T';
								$saledatainc=Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
								$saleincrement=$saledatainc->saleincrement+1;
								$billformat = "ECSR". ($saleincrement);
								$saledata->saleincrement=$saleincrement;
								$saledata -> billnumber = $billformat;
								$saledata -> invoicedate = date("Y-m-d h:i:s");
								$saledata -> total = $total_net_amount;
								foreach ($primary_id as $key => $value)
								{
									$totalcgstvalue+= $cgst_value[$key];
									$totalsgstvalue+= $sgst_value[$key];	
								}
								$total_gst_value=$totalcgstvalue+$totalsgstvalue;
								$saledata -> totalgstvalue = $total_gst_value;
								$saledata->tot_no_of_items=$total_items;
								
								$saledata->tot_quantity=$total_quantity;
								
								$saledata -> totalcgstvalue = $totalcgstvalue;
								$saledata -> totalsgstvalue = $totalsgstvalue;
								$saledata -> totaldiscountvalue = $total_disc_original;
								$saledata -> totaltaxableamount = $total_gst;
								$saledata -> overalltotal = $total_net_amount;
								$saledata -> paid_status = 'Paid';
								$saledata -> updated_by = $session['user_id'];
								$saledata -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
								$saledata -> updated_on = date("Y-m-d H:i:s");
								
								//new Code
								$saledata -> overalldiscountpercent = $overall_discount_percent;
								$saledata -> overalldiscountamount = $total_disc_original;
								$saledata -> overalldiscounttype = $overall_discount_type;
								$saledata -> 	created_at = date('Y-m-d H:i:s');
								$saledata -> overall_sub_total = $overall_sub_total;
								
								if($saledata -> save())
								{
									$saleid = $saledata -> opsaleid;
									$i = 1;
									foreach ($primary_id as $key => $value)
									{
										
										$Saledetail = new Saledetail();
										$Saledetail -> opsaleid = $saleid;
										$Saledetail -> stockid = $stock_id[$key];
										$Saledetail -> stockresponseid = $value;
										$Saledetail -> price = $price[$key];
										
										$Saledetail -> saledate = date('Y-m-d h:i:s');
										$Saledetail -> productid =  $product_name_id[$key];
										$Saledetail -> batchnumber =  $batchnumber[$key];
										$Saledetail -> brandcode = $brandcode_id[$key];
										$Saledetail -> stock_code = $stockcode_id[$key];
										$Saledetail -> compositionid = $composition_id[$key];
										$Saledetail -> unitid = $unit_id[$key];
										$Saledetail -> productqty = $quantity[$key];
										$Saledetail -> priceperqty = $price[$key];
										$Saledetail -> expiredate = date('Y-m-d',strtotime($expire_date_id[$key]));
										
										$Saledetail -> discountvalueperquantity = $discoun_type[$key];
										
										$Saledetail -> gstrate = $gst_percent[$key];
										
										$total_gst_value= $cgst_value[$key]+$sgst_value[$key];
										
										$Saledetail -> gstvalue = $total_gst_value;
										$Saledetail -> cgstvalue = $cgst_value[$key];
										$Saledetail -> sgstvalue = $sgst_value[$key];
										$Saledetail -> discountvalue = $discount_value[$key];
										$Saledetail -> discount_type = $discount_method[$key];
										$Saledetail -> mrpperunit = $mrp_rate_per_unit[$key];
										
										$Saledetail -> sgst_percent = $sgst_percent[$key];
										$Saledetail -> cgst_percent = $cgst_percent[$key];
										$Saledetail -> total_price_perqty = $total_amt_cal[$key];
										
										$Saledetail -> 	product_name = $product_name[$key];
										$Saledetail ->  tablet_type = $tablet_type[$key];
										$Saledetail -> 	medicine_type_ins = $medicine_type_ins[$key];
										$Saledetail -> 	tablet_tot_unit_ins = $tablet_tot_unit_ins[$key];
						
										
										$Saledetail -> is_active = 1;
										$Saledetail -> updated_by = $session['user_id'];
										$Saledetail -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
										$Saledetail -> updated_on = date("Y-m-d H:i:s");
										$Saledetail -> 	created_at = date("Y-m-d H:i:s");
										if($Saledetail -> save())
										{
											
										}
										else {
											print_r($Saledetail->getErrors());
							                 die;	
										}
										
									}
								}

									$overallstock=Stockresponse::find()->where(['IN','stockresponseid',$primary_id])->all();
									$overallstock_array=ArrayHelper::toArray($overallstock);
									
									if(!empty($overallstock_array))
									{
										foreach ($overallstock_array as $key => $value)
										{
												$Stock_brand=Stockmaster::find() -> where(['is_active' => 1])-> andWhere(['stockid'=> $value['stockid']]) -> one();
												$overallstock_updated=Stockresponse::find()->where(['stockresponseid'=> $value['stockresponseid']])->one();
												$Stock_brand_array=ArrayHelper::toArray($Stock_brand);
												$current_quantity=$value['total_no_of_quantity'];
												$updated_quantity=$quantity;
												$nw_quantity=$current_quantity-$updated_quantity[$key];
												$overallstock_updated->total_no_of_quantity=$nw_quantity;
												$overallstock_updated->sales_status='Y';
												
												if($overallstock_updated->save())
												{
													$stock_quantity=$Stock_brand->total_no_of_quantity;
													$updated_stock_quantity=$stock_quantity-$updated_quantity[$key];
													$Stock_brand->total_no_of_quantity=$updated_stock_quantity;
													if($Stock_brand->save())
													{
														
													}
													else 
													{
														print_r($Stock_brand->getErrors());die;
													}
												}
												else 
												{
													print_r($overallstock_updated->getErrors());die;
												}	
										}
									}
									$saledatainc=Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
								
									return "Y=".$saledatainc->opsaleid;

			}
		
		}
	}
	
	
	public function actionReturnsalestablet()
    {
    	$session = Yii::$app->session;
		$user_id=$session['user_id'];
		
    	if($_POST)
		{
			$sale_return=Sales::find()->where(['opsaleid' => $_POST['get_temp_no']])->one();
			
			if(!empty($sale_return))
			{
				
				$sale_return->return_status = 'Y';
				$sale_return->tot_quantity = $_POST['total_quantity'];
				$sale_return->overall_sub_total = $_POST['total_sub_total'];
				$sale_return->overalltotal = $_POST['total_net_amount'];
				$sale_return->updated_by = $user_id;
				$sale_return->updated_on = date('Y-m-d H:i:s');
				$sale_return->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
				
				if($sale_return -> save())
				{
					$saledetaildata=Saledetail::find()->where(['IN','opsale_detailid',$_POST['sales_details']])->all();
					
					$stock_id=array();
					if(!empty($saledetaildata))
					{
						foreach ($saledetaildata as $key => $value) 
						{
							if($_POST['remove_qty'][$key] != '')
							{
								$value->return_status = 'Y';
								$value->return_date = date('Y-m-d H:i:s');
								$value->productqty = $_POST['remove_qty'][$key];
								$value->price = $_POST['price'][$key];
								$value->priceperqty = $_POST['price'][$key];
								$value->total_price_perqty = $_POST['total_amt_cal'][$key];
								$value->updated_by = $user_id;
								$value->updated_on = date('Y-m-d');
								$value->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
								if($value->save())
								{
									$stock_id[]=$_POST['primeid'][$key];
								}
								else 
								{
									print_r($value->getErrors());die;
								}
							}
						}
						
						if(!empty($stock_id))
						{
							//Stock Insert
							$overallstock=Stockresponse::find()->where(['IN','stockresponseid',$stock_id])->all();
							$overallstock_array=ArrayHelper::toArray($overallstock);
							
							if(!empty($overallstock_array))
							{
								foreach ($overallstock_array as $key => $value)
								{
										$Stock_brand=Stockmaster::find() -> where(['is_active' => 1])-> andWhere(['stockid'=> $value['stockid']]) -> one();
										$overallstock_updated=Stockresponse::find()->where(['stockresponseid'=> $value['stockresponseid']])->one();
										$Stock_brand_array=ArrayHelper::toArray($Stock_brand);
										$current_quantity=$value['total_no_of_quantity'];
										$updated_quantity=$_POST['remove_qty'];
										$nw_quantity=$current_quantity+$updated_quantity[$key];
										$overallstock_updated->total_no_of_quantity=$nw_quantity;
										if($overallstock_updated->save())
										{
											$stock_quantity=$Stock_brand->total_no_of_quantity;
											$updated_stock_quantity=$stock_quantity+$updated_quantity[$key];
											$Stock_brand->total_no_of_quantity=$updated_stock_quantity;
											if($Stock_brand->save())
											{
												
											}
											else 
											{
												print_r($Stock_brand->getErrors());die;
											}
										}
										else 
										{
											print_r($overallstock_updated->getErrors());die;
										}	
								}
							}
							
							return "Return";
						}
					}
				}
				else
				{
					print_r($sale_return->getErrors());die;
				}
			}
		}
	}
	
	public function actionHistmrnumberpdf($id)
    {
    	$saledatainc=Sales::find()->where(['mrnumber'=> $id])->orderBy(['invoicedate'=>SORT_ASC])->asArray()->all();
		
		if(!empty($saledatainc))
		{
			//Product Type Fetch
			$sale_type_map = ArrayHelper::map($saledatainc, 'opsaleid', 'mrnumber');
			//Get Opsale ID Primary ID
			$sale_get_key=array_keys($sale_type_map);
			
			$sale_type_in = Saledetail::find()->where(['IN','opsaleid',$sale_get_key])->asArray()->all();
			$sale_type_index=ArrayHelper::index($sale_type_in,'opsale_detailid');
			
			$patientdata=Newpatient::find()->where(['mr_no'=>$id])->asArray()->one();
			
			$subvisit_last_date = SubVisit::find()->where(['mr_number'=>$patientdata['mr_no']])->orderBy(['sub_id'=>SORT_DESC])->asArray()->one();
			
			$insurancedata=Insurance::find()->where(['insurance_typeid'=>$subvisit_last_date['insurance_type']])->asArray()->one();
			
			
				//print_r($insurancedata['insurance_type']);die;		
						$result_string='<div class="pat-details"><span>Patient Name: '.$patientdata['patientname'].'</span><span>Mobile Number: '.$patientdata['pat_mobileno'].'</span><span>Insurance: '.$insurancedata['insurance_type'].'</span></div>';
						
						$result_string.='<a href="'.Yii::$app->homeUrl .'?r=sales/returntabletpdf&id='.urlencode(base64_encode($id)).'" target="_blank" class="btn btn-xs  btn-warning" style="float:right"  data-toggle="tooltip", data-placement="left", title="PDF">PDF</a><br><br>';
						$result_string.='<table  class="table table-bordered" ><thead><tr>';
						
						$result_string.='<th rowspan="2"  class="text-center">SNO</th>';
						$result_string.='<th rowspan="2"  class="text-center">Bill Number</th>';
						$result_string.='<th rowspan="2"  class="text-center">Invoice Date</th>';
						$result_string.='<th rowspan="2"  class="text-center">Total Items</th>';
						
						$result_string.='<th rowspan="2"  class="text-center">Total Tax Amount</th>';
						$result_string.='<th rowspan="2"  class="text-center">Total Discount</th>';
						$result_string.='<th rowspan="2"  class="text-center">Total Amount</th>';
						$result_string.='<th colspan="2"  class="text-center">Action</th>';
						$result_string.='</tr>';
						
						$result_string.='</thead><tbody>';
						$sno=1;
			
							//Total Code
							$filter_sales=array();
							foreach ($saledatainc as $key => $value) 
							{
								$filter_sal[]=date('Y-m-d',strtotime($value['invoicedate']));	
							}
							$filter_sal_rem=array_unique($filter_sal);
							
							//Value Sales
							$val_items=0;
							$val_tax=0;
							$val_disc=0;
							$val_amunt=0;
							
							
							
							//Value Sales Array
							$fill_value_items=array();
							$fill_value_tax=array();
							$fill_value_disc=array();
							$fill_value_amunt=array();
							
							
							$sal_inc=0;
						
							foreach ($filter_sal_rem as $key => $value) 
							{
								$saledatainc_vval=Sales::find()->where(['date(invoicedate)'=> $value])->andWhere(['mrnumber'=> $id])->asArray()->all();
								
								foreach ($saledatainc_vval as $key_tot => $value_tot) 
								{
									$val_items=$val_items+$value_tot['tot_no_of_items'];
									$val_tax=$val_tax+$value_tot['totaltaxableamount'];
									$val_disc=$val_disc+$value_tot['overalldiscountamount'];
									$val_amunt=$val_amunt+$value_tot['overalltotal'];
								}
								$fill_value_items[]=$val_items;
								$fill_value_tax[]=$val_tax;
								$fill_value_disc[]=$val_disc;
								$fill_value_amunt[]=$val_amunt;
								
								$val_items=0;
								$val_tax=0;
								$val_disc=0;
								$val_amunt=0;
							}
					
			
			$inv_date=date('d-m-Y',strtotime($saledatainc[0]['invoicedate']));
							
			foreach ($saledatainc as $key => $value) 
			{
					$change_date=date('d-m-Y',strtotime($value['invoicedate']));
					
					if($change_date == $inv_date)
					{
						$result_string.='<tr><td class="text-center" style="font-size:12px;">'.$sno.'</td>';
						$result_string.='<td class="text-center" style="font-size:12px;">'.$value['billnumber'].'</td>';					
						$result_string.='<td class="text-center" style="font-size:12px;">'.date('d-m-Y',strtotime($value['invoicedate'])).'</td>';
						$result_string.='<td class="text-right" style="font-size:12px;">'.$value['tot_no_of_items'].'</td>';					
						
						$result_string.='<td class="text-right" style="font-size:12px;">'.$value['totaltaxableamount'].'</td>';
						$result_string.='<td class="text-right" style="font-size:12px;">'.$value['overalldiscountamount'].'</td>';
						$result_string.='<td class="text-right" style="font-size:12px;">'.$value['overalltotal'].'</td>';
						if($value['return_status'] == 'Y')
						{
							$result_string.='<td class="text-center" style="font-size:12px;"><a href="'.Yii::$app->homeUrl .'?r=sales/viewtablet&id='.urlencode(base64_encode($value['opsaleid'])).'&mrnumber='.urlencode(base64_encode($id)).'" class="btn btn-xs  btn-primary" style="background:#563d7c!important;" target="_blank"  data-toggle="tooltip", data-placement="left", title="View">View</a>&nbsp;&nbsp;<button type="button" class="btn btn-xs  btn-danger return_val" value="'.$value['opsaleid'].'"  data-toggle="tooltip" data-placement="left", title="Returned" disabled>Returned</button></td>';
						}
						else if($value['return_status'] == 'N') 
						{
							$result_string.='<td class="text-center" style="font-size:12px;"><a href="'.Yii::$app->homeUrl .'?r=sales/viewtablet&id='.urlencode(base64_encode($value['opsaleid'])).'&mrnumber='.urlencode(base64_encode($id)).'" class="btn btn-xs  btn-primary" style="background:#563d7c!important;" target="_blank"  data-toggle="tooltip", data-placement="left", title="View">View</a>&nbsp;&nbsp;<button type="button" class="btn btn-xs  btn-info return_val" value="'.$value['opsaleid'].'"  data-toggle="tooltip" data-placement="left", title="Return">Return</button></td>';
						}
						
						$result_string.='</tr>';
					}
					else if($change_date != $inv_date)
					{
						$inv_date=date('d-m-Y',strtotime($value['invoicedate']));
						
						$result_string.='<tr><td colspan="3" class="text-center" style="color:green;font-size:14px;"><b>Total</b></td>';
						$result_string.='<td class="text-right" style="color:green;font-size:14px;"><b>'.$fill_value_items[$sal_inc].'</b></td>';					
						$result_string.='<td class="text-right" style="color:green;font-size:14px;"><b>'.$fill_value_tax[$sal_inc].'</b></td>';
						$result_string.='<td class="text-right" style="color:green;font-size:14px;"><b>'.$fill_value_disc[$sal_inc].'</b></td>';
						$result_string.='<td class="text-right" style="color:green;font-size:14px;"><b>'.$fill_value_amunt[$sal_inc].'</b></td>';
						$result_string.='<td></td>';
						$result_string.='</tr>';
						
						$result_string.='<tr><td class="text-center" style="font-size:12px;">'.$sno.'</td>';
						$result_string.='<td class="text-center" style="font-size:12px;">'.$value['billnumber'].'</td>';					
						$result_string.='<td class="text-center" style="font-size:12px;">'.date('d-m-Y',strtotime($value['invoicedate'])).'</td>';
						$result_string.='<td class="text-right" style="font-size:12px;">'.$value['tot_no_of_items'].'</td>';					
						
						$result_string.='<td class="text-right" style="font-size:12px;">'.$value['totaltaxableamount'].'</td>';
						$result_string.='<td class="text-right" style="font-size:12px;">'.$value['overalldiscountamount'].'</td>';
						$result_string.='<td class="text-right" style="font-size:12px;">'.$value['overalltotal'].'</td>';
						if($value['return_status'] == 'Y')
						{
							$result_string.='<td class="text-center" style="font-size:12px;"><a href="'.Yii::$app->homeUrl .'?r=sales/viewtablet&id='.urlencode(base64_encode($value['opsaleid'])).'&mrnumber='.urlencode(base64_encode($id)).'" class="btn btn-xs  btn-primary" style="background:#563d7c!important;" target="_blank"  data-toggle="tooltip", data-placement="left", title="View">View</a>&nbsp;&nbsp;<button type="button" class="btn btn-xs  btn-danger return_val" value="'.$value['opsaleid'].'"  data-toggle="tooltip" data-placement="left", title="Returned" disabled>Returned</button></td>';
						}
						else if($value['return_status'] == 'N') 
						{
							$result_string.='<td class="text-center" style="font-size:12px;"><a href="'.Yii::$app->homeUrl .'?r=sales/viewtablet&id='.urlencode(base64_encode($value['opsaleid'])).'&mrnumber='.urlencode(base64_encode($id)).'" class="btn btn-xs  btn-primary" style="background:#563d7c!important;" target="_blank"  data-toggle="tooltip", data-placement="left", title="View">View</a>&nbsp;&nbsp;<button type="button" class="btn btn-xs  btn-info return_val" value="'.$value['opsaleid'].'"  data-toggle="tooltip" data-placement="left", title="Return">Return</button></td>';
						}
						$result_string.='</tr>';
						
						$sal_inc++;
					}
					$sno++;
			}

						$result_string.='<tr><td colspan="3" class="text-center" style="color:green;font-size:14px;"><b>Total</b></td>';
						$result_string.='<td class="text-right" style="color:green;font-size:14px;"><b>'.end($fill_value_items).'</b></td>';					
						$result_string.='<td class="text-right" style="color:green;font-size:14px;"><b>'.end($fill_value_tax).'</b></td>';
						$result_string.='<td class="text-right" style="color:green;font-size:14px;"><b>'.end($fill_value_disc).'</b></td>';
						$result_string.='<td class="text-right" style="color:green;font-size:14px;"><b>'.end($fill_value_amunt).'</b></td>';
						$result_string.='<td></td>';
						$result_string.='</tr>';
						
						$result_string.='<tr><td colspan="3" class="text-center" style="color:blue;font-size:16px;"><b>Grant Total</b></td>';
						$result_string.='<td class="text-right" style="color:blue;font-size:16px;"><b>'.array_sum($fill_value_items).'</b></td>';					
						$result_string.='<td class="text-right" style="color:blue;font-size:16px;"><b>'.array_sum($fill_value_tax).'</b></td>';
						$result_string.='<td class="text-right" style="color:blue;font-size:16px;"><b>'.array_sum($fill_value_disc).'</b></td>';
						$result_string.='<td class="text-right" style="color:blue;font-size:16px;"><b>'.array_sum($fill_value_amunt).'</b></td>';
						$result_string.='<td></td>';
						$result_string.='</tr>';
						
			$result_string.='<tbody></table>';	
					
		}
		else 
		{
			$result_string='<div class="text-center" style="color:red;font-size:20px;">No Records Found</div>';	
			
		}
		
		return $result_string;
	}
	
	
	public function actionViewtablet($id,$mrnumber)
    {
    	$sale_id=base64_decode(urldecode($id));
		
		$mrnumber_dec=base64_decode(urldecode($mrnumber));
		
		
		$query = new Query;
		$query	->select(['*'])->from('sales')->join(	'INNER JOIN',  'saledetail','sales.opsaleid =saledetail.opsaleid')->where(['sales.opsaleid'=>$sale_id])->andWhere(['sales.mrnumber'=>$mrnumber_dec])->orderBy(['sales.invoicedate'=>SORT_ASC])->all(); 
		
		$command = $query->createCommand();
		$in_send_data = $command->queryAll();
		
		if(!empty($in_send_data))
		{	
				//Product Type Fetch
				$product_type_map = ArrayHelper::map($in_send_data, 'opsale_detailid', 'productid');
				$product_type_in = Product::find()->where(['IN','productid',$product_type_map])->asArray()->all(); 
				$product_type_index=ArrayHelper::index($product_type_in,'productid');
				
			
						$result_string='<table  class="table table-bordered" ><thead><tr>';
						
						$result_string.='<th  class="text-center">SNO</th>';
						$result_string.='<th   class="text-center">Bill Number</th>';
						$result_string.='<th class="text-center">Item Description</th>';
						$result_string.='<th class="text-center">HSN Code</th>';
						$result_string.='<th class="text-center">Batch No</th>';
						$result_string.='<th class="text-center">Expire Date</th>';
						$result_string.='<th class="text-center">Qty</th>';
						$result_string.='<th class="text-center">Mrp</th>';
						$result_string.='<th class="text-center">Discount</th>';
						$result_string.='<th class="text-center">Amount</th>';
						$result_string.='<th class="text-center">Action</th>';
						$result_string.='</tr>';
						
						$result_string.='</thead><tbody>';
						$sno=1;
						foreach ($in_send_data as $key => $value) 
						{
							$result_string.='<tr><td class="text-center" style="font-size:12px;">'.$sno.'</td>';
							$result_string.='<td class="text-center" style="font-size:12px;">'.$value['billnumber'].'</td>';					
							$result_string.='<td class="text-center" style="font-size:12px;">'.$product_type_index[$value['productid']]['productname'].'</td>';
							$result_string.='<td class="text-center" style="font-size:12px;">'.$product_type_index[$value['productid']]['hsn_code'].'</td>';					
							
							$result_string.='<td class="text-center" style="font-size:12px;">'.$value['batchnumber'].'</td>';
							$result_string.='<td class="text-center" style="font-size:12px;">'.date('d-m-Y',strtotime($value['expiredate'])).'</td>';
							$result_string.='<td class="text-right" style="font-size:12px;">'.$value['productqty'].'</td>';
							$result_string.='<td class="text-right" style="font-size:12px;">'.$value['mrpperunit'].'</td>';
							if($value['discountvalueperquantity'] == '')
							{
								$result_string.='<td class="text-right" style="font-size:12px;">0</td>';
							}
							else
							{
								$result_string.='<td class="text-right" style="font-size:12px;">'.$value['discountvalueperquantity'].'</td>';
							}
							$result_string.='<td class="text-right" style="font-size:12px;">'.$value['total_price_perqty'].'</td>';
							$result_string.='<td class="text-center" style="font-size:12px;"><a href="'.Yii::$app->homeUrl .'?r=sales/returntablet&id='.urlencode(base64_encode($value['opsaleid'])).'" class="btn btn-xs  btn-info"  data-toggle="tooltip", data-placement="left", title="Return">Return</a></td>';
						
							$result_string.='</tr>';
							$sno++;
						}
						$result_string.='</tbody></table>';
						
						return $this->render('printeditform', [
            				'result_string' => $result_string,
            			]);
		}
	}

	//Tablet Return
	public function actionReturntablet($id)
    {
    		$Sale=Sales::find()->where(['opsaleid' => $id])->one();
			$Sale_detail=Saledetail::find()->where(['opsaleid' => $id])->andWhere(['return_status'=>'N'])->all();
			$result_string1='';
			$ot=array();
			if(!empty($Sale_detail))
			{
				
				$slno=1;$row=0;
				
				$temp_sales_id=array();
				foreach ($Sale_detail as $key => $value)
				{
					$overallstock=Stockresponse::find()->where(['stockresponseid' => $value['stockresponseid']])->one();
					
					$Stock_code=Stockmaster::find() -> where(['stockid'=> $value['stockid']]) ->one();
					
					$Product = Product::find()->where(['productid'=> $Stock_code->productid ])->one();
					$Composition=Composition::find()->where(['is_active'=>1])-> andWhere(['composition_id' => $Product->composition_id]) ->asArray()->one();
				
					$result_string1.='<tr  class="save_data_table" data-id='.$value['stockresponseid'].' id="table_del'.$value['stockresponseid'].'">';
					$result_string1.='<td class="hide">'.$slno.'</td>';
					$result_string1.='<td><div class="trunctext wd100">'.$Product->productname."/".$Composition['composition_name'].'</div></td>';
								
					
					$result_string1.='<td>'.$overallstock->batchnumber.'</td>';
					$result_string1.='<td>'.date('d-m-Y',strtotime($overallstock->expiredate)).'</td>';
					$result_string1.='<td class="quantity_add" id="quantity_add'.$value['stockresponseid'].'" style="color:red;font-weight:bold;">'.$value['productqty'].'</td>';
					$result_string1.='<td id="unit_value_medicine'.$value['stockresponseid'].'">'.$value['medicine_type_ins'].'</td>';
					$result_string1.='<td>
										  <input type="hidden" name="sales_details[]" id="sales_details'.$value['stockresponseid'].'" value='.$value['opsale_detailid'].'>
										  <input type="hidden" name="medicine_type_ins[]" id="medicine_type_ins'.$value['stockresponseid'].'" value='.$value['medicine_type_ins'].'>
										  <input type="hidden" name="tablet_tot_unit_ins[]" id="tablet_tot_unit'.$value['stockresponseid'].'" value='.$value['tablet_tot_unit_ins'].'>
										  <input type="hidden" name="tablet_type[]" id="tablet_type'.$value['stockresponseid'].'" value="'.$value['tablet_type'].'">
										  <input type="hidden" name="mrp_rate_per_unit[]" value="'.$value['mrpperunit'].'">
										  <input type="hidden" name="stock_id[]" value="'.$value['stockid'].'">
										  <input type="hidden" name="unit_id[]" value="'.$value['unitid'].'">
										  <input type="hidden" name="composition_id[]" value="'.$value['compositionid'].'">
										  <input type="hidden" name="stockcode_id[]" value="'.$value['stock_code'].'">
										  <input type="hidden" name="brandcode_id[]" value="'.$value['brandcode'].'">
										  <input type="hidden" name="product_name_id[]" value="'.$value['productid'].'">
										  <input type="hidden" name="expire_date_id[]" value="'.$value['expiredate'].'">
										  <input type="hidden" name="batchnumber[]" value="'.$value['batchnumber'].'">
										  <input type="hidden" name="product_name[]" value="'.$Product->productname."/".$Composition['composition_name'].'">
										  <input type="hidden" name="quantity[]" value="'.$value['productqty'].'">
										  <input type="hidden" name="primeid[]" value="'.$value['stockresponseid'].'">
										  <input type="text" name="price[]" class="price_mrp text-right form-control" data_price_mrp="'.$value['stockresponseid'].'" value='.$value['priceperqty'].' id="price'.$value['stockresponseid'].'">	
									  </td>';
					$result_string1.='<td><ul class="donate-now">
											<input type="hidden" name="discount_method[]" id="disc_method'.$value['stockresponseid'].'">
											<li><input type="radio"  disabled="disabled" name="desc'.$value['stockresponseid'].'" data_flat='.$value['stockresponseid'].' id="flat_discount'.$value['stockresponseid'].'" class="deselect flat testrad"  onchange="descChanged('.$value['stockresponseid'].')">
											<label for="flat_discount'.$value['stockresponseid'].'" class="w-50 text-center testrad">F</label></li><li>
											<input type="radio"  disabled="disabled" id="percent'.$value['stockresponseid'].'" data-deselect='.$value['stockresponseid'].' class="deselect percent testrad" name="desc'.$value['stockresponseid'].'"  onchange="descChanged('.$value['stockresponseid'].')" >
											<label for="percent'.$value['stockresponseid'].'" class="w-50 text-center testrad">%</label></li></ul></td>';
					$result_string1.='<td><div class="input-group"> <input type="text" name="discount_value[]" data_disc_value='.$value['stockresponseid'].'  disabled="disabled" id="enabledisc'.$value['stockresponseid'].'" class="enabledisc disctxt w-50" readonly></div>
					
										</td>';						
					$result_string1.='<td class="w-xss"><input type="hidden" class="form-control" data_gst_percent='.$value['stockresponseid'].' name="gst_percent[]" id="gst_percent'.$value['stockresponseid'].'" value="'.$value['gstrate'].'">
														<input type="text" name="discountext_value[]" id="disc_amount'.$value['stockresponseid'].'"  disabled="disabled" class="add_discount text-right disctxt w-50" readonly>
														
									  </td>';
					
					$result_string1.='<td><input type="text" class="form-control" data_igst_percent='.$value['stockresponseid'].' id="igst_percent'.$value['stockresponseid'].'" value="0" readonly></td>';
					
					
					$result_string1.='<td><input type="text"  class="form-control" data_igst_value='.$value['stockresponseid'].' id="igst_value'.$value['stockresponseid'].'" value="0" readonly></td>';
					
					$result_string1.='<td class="w-xss"><input type="text"  class="form-control cgst_percent text-right" name="cgst_percent[]" data_cgst_percent='.$value['stockresponseid'].' id="cgst_percent'.$value['stockresponseid'].'" value="'.$value['cgst_percent'].'" readonly></td>';
					
					$result_string1.='<td><input type="text"  class="form-control cgst_value text-right" name="cgst_value[]" data_cgst_value='.$value['stockresponseid'].' id="cgst_value'.$value['stockresponseid'].'" value="'.$value['cgstvalue'].'"  readonly></td>';
					
					$result_string1.='<td class="w-xss"><input type="text"  class="form-control sgst_percent" name="sgst_percent[]" data_sgst_percent='.$value['stockresponseid'].' id="sgst_percent'.$value['stockresponseid'].'"  value="'.$value['sgst_percent'].'"  readonly></td>';
					
					$result_string1.='<td><input type="text"  class="form-control sgst_value text-right" name="sgst_value[]" data_sgst_value='.$value['stockresponseid'].' id="sgst_value'.$value['stockresponseid'].'" value="'.$value['sgstvalue'].'"   readonly></td>';
					
					$result_string1.='<td><input type="text"  class="form-control total_amt_cal text-right" name="total_amt_cal[]" data_total='.$value['stockresponseid'].' id="total_amount'.$value['stockresponseid'].'" value="'.$value['total_price_perqty'].'"    readonly></td>';
					
					$result_string1.='<td class="text-center" style="width:110px;">
					<input type="hidden"  class="form-control" name="static_total"  id="static_total_amount'.$value['stockresponseid'].'" value="'.$value['total_price_perqty'].'">
					<input type="hidden" name="static_price[]" class="form-control"  value='.$value['priceperqty'].' id="static_price'.$value['stockresponseid'].'">
					<input type="hidden" name="static_product[]" class="form-control"  value='.$value['productqty'].' id="static_product'.$value['stockresponseid'].'">
					
					<input  type="text" style="float:left;width:60px;" name="remove_qty[]" class="text-center form-control number qtyreturnstatus" data_qty_check="'.$value['stockresponseid'].'" id="remove_qty'.$value['stockresponseid'].'" onChange="QtyValidation('.$value['stockresponseid'].')"  onkeyup="QtyValidation('.$value['stockresponseid'].')">
					<button type="button" disabled="disabled" class="btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow" data_delete_row='.$value['stockresponseid'].' id="delrow'.$value['stockresponseid'].'"><i class="fa fa-remove"></i></button></td>';
					
					
									 
					
					$result_string1.='</tr>';
					
					$slno++;	
					$row++;	
									
				}

				$ot[0]=$result_string1;
				$ot[1]=$Sale->tot_quantity;
				$ot[2]=$Sale->tot_no_of_items;
				$ot[3]=$Sale->totalgstvalue;
				$ot[4]=$Sale->totaldiscountvalue;
				$ot[5]=$Sale->total;
				$ot[6]=$Sale->total;
				$ot[7]=$Sale->overalltotal;
				$ot[8]=$row;
				$ot[9]=$Sale->opsaleid;
				$ot[10]=$Sale->overalldiscountpercent;
				$ot[11]=$Sale->overalldiscountamount;
				$ot[12]=$Sale->overalldiscounttype;
				
			}
			else
			{
				$ot[0]='NULL';
			}
			
			return json_encode($ot);
	}
	
	
	//Tablet Return
	public function actionSingletabletreturn($id)
    {
    		
			$Sale_detail=Saledetail::find()->where(['opsale_detailid' => $id])->andWhere(['return_status'=>'N'])->all();
			$Sale=Sales::find()->where(['opsaleid' => $Sale_detail[0]['opsaleid']])->one();
			
			$newpatient=Newpatient::find()->where(['mr_no'=>$Sale->mrnumber])->asArray()->one();
			
			$patient_name=$Sale->name;
			$dob_patient=date('d-m-Y',strtotime($Sale->dob));
			$doctor_name=$Sale->physicianname;
			$mr_number=$Sale->mrnumber;
			$mob_number=$Sale->phonenumber;
			$bill_number=$Sale->billnumber;
			$gender='<option value='.$newpatient['pat_sex'].'>'.$newpatient['pat_sex'].'</option>';
			$address=$newpatient['pat_address'];
			
			if(!empty($Sale->insurancetype))
			{
				$Insurance_qry=Insurance::find()->where(['insurance_typeid'=>$Sale->insurancetype])->asArray()->one();
				$insurance='<option value='.$Insurance_qry['insurance_typeid'].'>'.$Insurance_qry['insurance_type'].'</option>';
			}
			else 
			{
				$insurance='';
			}
		
			$result_string1='';
			$ot=array();
			if(!empty($Sale_detail))
			{
				
				$slno=1;$row=0;
				
				$temp_sales_id=array();
				foreach ($Sale_detail as $key => $value)
				{
					$overallstock=Stockresponse::find()->where(['stockresponseid' => $value['stockresponseid']])->one();
					
					$Stock_code=Stockmaster::find() -> where(['stockid'=> $value['stockid']]) ->one();
					
					$Product = Product::find()->where(['productid'=> $Stock_code->productid ])->one();
					$Composition=Composition::find()->where(['is_active'=>1])-> andWhere(['composition_id' => $Product->composition_id]) ->asArray()->one();
				
					$result_string1.='<tr  class="save_data_table" data-id='.$value['stockresponseid'].' id="table_del'.$value['stockresponseid'].'">';
					$result_string1.='<td class="hide">'.$slno.'</td>';
					$result_string1.='<td><div class="trunctext wd100">'.$Product->productname."/".$Composition['composition_name'].'</div></td>';
								
					
					$result_string1.='<td>'.$overallstock->batchnumber.'</td>';
					$result_string1.='<td>'.date('d-m-Y',strtotime($overallstock->expiredate)).'</td>';
					$result_string1.='<td class="quantity_add" id="quantity_add'.$value['stockresponseid'].'" style="color:red;font-weight:bold;">'.$value['productqty'].'</td>';
					$result_string1.='<td id="unit_value_medicine'.$value['stockresponseid'].'">'.$value['medicine_type_ins'].'</td>';
					$result_string1.='<td>
										  <input type="hidden" name="sales_details[]" id="sales_details'.$value['stockresponseid'].'" value='.$value['opsale_detailid'].'>
										  <input type="hidden" name="medicine_type_ins[]" id="medicine_type_ins'.$value['stockresponseid'].'" value='.$value['medicine_type_ins'].'>
										  <input type="hidden" name="tablet_tot_unit_ins[]" id="tablet_tot_unit'.$value['stockresponseid'].'" value='.$value['tablet_tot_unit_ins'].'>
										  <input type="hidden" name="tablet_type[]" id="tablet_type'.$value['stockresponseid'].'" value="'.$value['tablet_type'].'">
										  <input type="hidden" name="mrp_rate_per_unit[]" value="'.$value['mrpperunit'].'">
										  <input type="hidden" name="stock_id[]" value="'.$value['stockid'].'">
										  <input type="hidden" name="unit_id[]" value="'.$value['unitid'].'">
										  <input type="hidden" name="composition_id[]" value="'.$value['compositionid'].'">
										  <input type="hidden" name="stockcode_id[]" value="'.$value['stock_code'].'">
										  <input type="hidden" name="brandcode_id[]" value="'.$value['brandcode'].'">
										  <input type="hidden" name="product_name_id[]" value="'.$value['productid'].'">
										  <input type="hidden" name="expire_date_id[]" value="'.$value['expiredate'].'">
										  <input type="hidden" name="batchnumber[]" value="'.$value['batchnumber'].'">
										  <input type="hidden" name="product_name[]" value="'.$Product->productname."/".$Composition['composition_name'].'">
										  <input type="hidden" name="quantity[]" value="'.$value['productqty'].'">
										  <input type="hidden" name="primeid[]" value="'.$value['stockresponseid'].'">
										  <input type="text" name="price[]" readonly class="price_mrp text-right form-control" data_price_mrp="'.$value['stockresponseid'].'" value='.$value['mrpperunit'].' id="price'.$value['stockresponseid'].'">	
									  </td>';
					$result_string1.='<td><ul class="donate-now">
											<input type="hidden" name="discount_method[]" id="disc_method'.$value['stockresponseid'].'">
											<li><input type="radio"  disabled="disabled" name="desc'.$value['stockresponseid'].'" data_flat='.$value['stockresponseid'].' id="flat_discount'.$value['stockresponseid'].'" class="deselect flat testrad"  onchange="descChanged('.$value['stockresponseid'].')">
											<label for="flat_discount'.$value['stockresponseid'].'" class="w-50 text-center testrad">F</label></li><li>
											<input type="radio"  disabled="disabled" id="percent'.$value['stockresponseid'].'" data-deselect='.$value['stockresponseid'].' class="deselect percent testrad" name="desc'.$value['stockresponseid'].'"  onchange="descChanged('.$value['stockresponseid'].')" >
											<label for="percent'.$value['stockresponseid'].'" class="w-50 text-center testrad">%</label></li></ul></td>';
					$result_string1.='<td><div class="input-group"> <input type="text" name="discount_value[]" data_disc_value='.$value['stockresponseid'].' value="'.$value['discountvalue'].'"  id="enabledisc'.$value['stockresponseid'].'" class="enabledisc disctxt w-50" readonly></div>
					
										</td>';						
					$result_string1.='<td class="w-xss"><input type="hidden" class="form-control" data_gst_percent='.$value['stockresponseid'].' name="gst_percent[]" id="gst_percent'.$value['stockresponseid'].'" value="'.$value['gstrate'].'">
														<input type="text" name="discountext_value[]" id="disc_amount'.$value['stockresponseid'].'" class="add_discount text-right disctxt w-50" value="'.$value['discountvalueperquantity'].'"   readonly>
														
									  </td>';
					
					$result_string1.='<td><input type="text" class="form-control" data_igst_percent='.$value['stockresponseid'].' id="igst_percent'.$value['stockresponseid'].'" value="0" readonly></td>';
					
					
					$result_string1.='<td><input type="text"  class="form-control" data_igst_value='.$value['stockresponseid'].' id="igst_value'.$value['stockresponseid'].'" value="0" readonly></td>';
					
					$result_string1.='<td class="w-xss"><input type="text"  class="form-control cgst_percent text-right" name="cgst_percent[]" data_cgst_percent='.$value['stockresponseid'].' id="cgst_percent'.$value['stockresponseid'].'" value="'.$value['cgst_percent'].'" readonly></td>';
					
					$result_string1.='<td><input type="text"  class="form-control cgst_value text-right" name="cgst_value[]" data_cgst_value='.$value['stockresponseid'].' id="cgst_value'.$value['stockresponseid'].'" value="'.$value['cgstvalue'].'"  readonly></td>';
					
					$result_string1.='<td class="w-xss"><input type="text"  class="form-control sgst_percent" name="sgst_percent[]" data_sgst_percent='.$value['stockresponseid'].' id="sgst_percent'.$value['stockresponseid'].'"  value="'.$value['sgst_percent'].'"  readonly></td>';
					
					$result_string1.='<td><input type="text"  class="form-control sgst_value text-right" name="sgst_value[]" data_sgst_value='.$value['stockresponseid'].' id="sgst_value'.$value['stockresponseid'].'" value="'.$value['sgstvalue'].'"   readonly></td>';
					
					$result_string1.='<td><input type="text"  class="form-control total_amt_cal text-right" name="total_amt_cal[]" data_total='.$value['stockresponseid'].' id="total_amount'.$value['stockresponseid'].'" value="'.$value['total_price_perqty'].'"    readonly></td>';
					
					$result_string1.='<td class="text-center" style="width:110px;">
					<input type="hidden"  class="form-control" name="static_total"  id="static_total_amount'.$value['stockresponseid'].'" value="'.$value['total_price_perqty'].'">
					<input type="hidden" name="static_price[]" class="form-control"  value='.$value['mrpperunit'].' id="static_price'.$value['stockresponseid'].'">
					<input type="hidden" name="static_product[]" class="form-control"  value='.$value['productqty'].' id="static_product'.$value['stockresponseid'].'">
					
					<input  type="text" style="float:left;width:60px;" name="remove_qty[]" class="text-center form-control number qtyreturnstatus" data_qty_check="'.$value['stockresponseid'].'" id="remove_qty'.$value['stockresponseid'].'"  onkeyup="QtyValidation1('.$value['stockresponseid'].',event)">
					<button type="button" disabled="disabled" class="btn-xs btn-sm btn-icon btn-danger  delrow" data_delete_row='.$value['stockresponseid'].' id="delrow'.$value['stockresponseid'].'"><i class="fa fa-remove"></i></button></td>';
					
					
									 
					
					$result_string1.='</tr>';
					
					$slno++;	
					$row++;	
									
				}

				$ot[0]=$result_string1;
				$ot[1]=$Sale->tot_quantity;
				$ot[2]=$Sale->tot_no_of_items;
				$ot[3]=$Sale->totalgstvalue;
				$ot[4]=$Sale->totaldiscountvalue;
				$ot[5]=$Sale->total;
				$ot[6]=$Sale->total;
				$ot[7]=$Sale->overalltotal;
				$ot[8]=$row;
				$ot[9]=$Sale->opsaleid;
				$ot[10]=$Sale->overalldiscountpercent;
				$ot[11]=$Sale->overalldiscountamount;
				$ot[12]=$Sale->overalldiscounttype;
				$ot[13]=$patient_name;
				$ot[14]=$dob_patient;
				$ot[15]=$doctor_name;
				$ot[16]=$mr_number;
				$ot[17]=$mob_number;
				$ot[18]=$bill_number;
				$ot[19]=$insurance;
				$ot[20]=$gender;
				$ot[21]=$address;
			}
			else
			{
				$ot[0]='NULL';
			}
			
			return json_encode($ot);
	}
	
	
	
	//Tablet Return
	public function actionSinglereturntablet($id)
    {
    		
			$Sale_detail=Saledetail::find()->where(['opsale_detailid' => $id])->andWhere(['return_status'=>'N'])->one();
			$Sale=Sales::find()->where(['opsaleid' => $Sale_detail->opsaleid])->one();
			$result_string1='';
			$ot=array();
			if(!empty($Sale_detail))
			{
				
				$slno=1;$row=0;
				
				$temp_sales_id=array();
				foreach ($Sale_detail as $key => $value)
				{
					$overallstock=Stockresponse::find()->where(['stockresponseid' => $value['stockresponseid']])->one();
					
					$Stock_code=Stockmaster::find() -> where(['stockid'=> $value['stockid']]) ->one();
					
					$Product = Product::find()->where(['productid'=> $Stock_code->productid ])->one();
					$Composition=Composition::find()->where(['is_active'=>1])-> andWhere(['composition_id' => $Product->composition_id]) ->asArray()->one();
				
					$result_string1.='<tr  class="save_data_table" data-id='.$value['stockresponseid'].' id="table_del'.$value['stockresponseid'].'">';
					$result_string1.='<td class="hide">'.$slno.'</td>';
					$result_string1.='<td><div class="trunctext wd100">'.$Product->productname."/".$Composition['composition_name'].'</div></td>';
								
					
					$result_string1.='<td>'.$overallstock->batchnumber.'</td>';
					$result_string1.='<td>'.date('d-m-Y',strtotime($overallstock->expiredate)).'</td>';
					$result_string1.='<td class="quantity_add" id="quantity_add'.$value['stockresponseid'].'" style="color:red;font-weight:bold;">'.$value['productqty'].'</td>';
					$result_string1.='<td id="unit_value_medicine'.$value['stockresponseid'].'">'.$value['medicine_type_ins'].'</td>';
					$result_string1.='<td>
										  <input type="hidden" name="sales_details[]" id="sales_details'.$value['stockresponseid'].'" value='.$value['opsale_detailid'].'>
										  <input type="hidden" name="medicine_type_ins[]" id="medicine_type_ins'.$value['stockresponseid'].'" value='.$value['medicine_type_ins'].'>
										  <input type="hidden" name="tablet_tot_unit_ins[]" id="tablet_tot_unit'.$value['stockresponseid'].'" value='.$value['tablet_tot_unit_ins'].'>
										  <input type="hidden" name="tablet_type[]" id="tablet_type'.$value['stockresponseid'].'" value="'.$value['tablet_type'].'">
										  <input type="hidden" name="mrp_rate_per_unit[]" value="'.$value['mrpperunit'].'">
										  <input type="hidden" name="stock_id[]" value="'.$value['stockid'].'">
										  <input type="hidden" name="unit_id[]" value="'.$value['unitid'].'">
										  <input type="hidden" name="composition_id[]" value="'.$value['compositionid'].'">
										  <input type="hidden" name="stockcode_id[]" value="'.$value['stock_code'].'">
										  <input type="hidden" name="brandcode_id[]" value="'.$value['brandcode'].'">
										  <input type="hidden" name="product_name_id[]" value="'.$value['productid'].'">
										  <input type="hidden" name="expire_date_id[]" value="'.$value['expiredate'].'">
										  <input type="hidden" name="batchnumber[]" value="'.$value['batchnumber'].'">
										  <input type="hidden" name="product_name[]" value="'.$Product->productname."/".$Composition['composition_name'].'">
										  <input type="hidden" name="quantity[]" value="'.$value['productqty'].'">
										  <input type="hidden" name="primeid[]" value="'.$value['stockresponseid'].'">
										  <input type="text" name="price[]" class="price_mrp text-right form-control" data_price_mrp="'.$value['stockresponseid'].'" value='.$value['priceperqty'].' id="price'.$value['stockresponseid'].'">	
									  </td>';
					$result_string1.='<td><ul class="donate-now">
											<input type="hidden" name="discount_method[]" id="disc_method'.$value['stockresponseid'].'">
											<li><input type="radio"  name="desc'.$value['stockresponseid'].'" data_flat='.$value['stockresponseid'].' id="flat_discount'.$value['stockresponseid'].'" class="deselect flat testrad"  onchange="descChanged('.$value['stockresponseid'].')">
											<label for="flat_discount'.$value['stockresponseid'].'" class="w-50 text-center testrad">F</label></li><li>
											<input type="radio" id="percent'.$value['stockresponseid'].'" data-deselect='.$value['stockresponseid'].' class="deselect percent testrad" name="desc'.$value['stockresponseid'].'"  onchange="descChanged('.$value['stockresponseid'].')" >
											<label for="percent'.$value['stockresponseid'].'" class="w-50 text-center testrad">%</label></li></ul></td>';
					$result_string1.='<td><div class="input-group"> <input type="text" name="discount_value[]" data_disc_value='.$value['stockresponseid'].' id="enabledisc'.$value['stockresponseid'].'" class="enabledisc disctxt w-50" readonly></div>
					
										</td>';						
					$result_string1.='<td class="w-xss"><input type="hidden" class="form-control" data_gst_percent='.$value['stockresponseid'].' name="gst_percent[]" id="gst_percent'.$value['stockresponseid'].'" value="'.$value['gstrate'].'">
														<input type="text" name="discountext_value[]" id="disc_amount'.$value['stockresponseid'].'" class="add_discount text-right disctxt w-50" readonly>
														
									  </td>';
					
					$result_string1.='<td><input type="text" class="form-control" data_igst_percent='.$value['stockresponseid'].' id="igst_percent'.$value['stockresponseid'].'" value="0" readonly></td>';
					
					
					$result_string1.='<td><input type="text"  class="form-control" data_igst_value='.$value['stockresponseid'].' id="igst_value'.$value['stockresponseid'].'" value="0" readonly></td>';
					
					$result_string1.='<td class="w-xss"><input type="text"  class="form-control cgst_percent text-right" name="cgst_percent[]" data_cgst_percent='.$value['stockresponseid'].' id="cgst_percent'.$value['stockresponseid'].'" value="'.$value['cgst_percent'].'" readonly></td>';
					
					$result_string1.='<td><input type="text"  class="form-control cgst_value text-right" name="cgst_value[]" data_cgst_value='.$value['stockresponseid'].' id="cgst_value'.$value['stockresponseid'].'" value="'.$value['cgstvalue'].'"  readonly></td>';
					
					$result_string1.='<td class="w-xss"><input type="text"  class="form-control sgst_percent" name="sgst_percent[]" data_sgst_percent='.$value['stockresponseid'].' id="sgst_percent'.$value['stockresponseid'].'"  value="'.$value['sgst_percent'].'"  readonly></td>';
					
					$result_string1.='<td><input type="text"  class="form-control sgst_value text-right" name="sgst_value[]" data_sgst_value='.$value['stockresponseid'].' id="sgst_value'.$value['stockresponseid'].'" value="'.$value['sgstvalue'].'"   readonly></td>';
					
					$result_string1.='<td><input type="text"  class="form-control total_amt_cal text-right" name="total_amt_cal[]" data_total='.$value['stockresponseid'].' id="total_amount'.$value['stockresponseid'].'" value="'.$value['total_price_perqty'].'"    readonly></td>';
					
					$result_string1.='<td class="text-center" style="width:110px;">
					<input type="hidden"  class="form-control" name="static_total"  id="static_total_amount'.$value['stockresponseid'].'" value="'.$value['total_price_perqty'].'">
					<input type="hidden" name="static_price[]" class="form-control"  value='.$value['priceperqty'].' id="static_price'.$value['stockresponseid'].'">
					<input type="hidden" name="static_product[]" class="form-control"  value='.$value['productqty'].' id="static_product'.$value['stockresponseid'].'">
					
					<input  type="text" style="float:left;width:60px;" name="remove_qty[]" class="text-center form-control number qtyreturnstatus" data_qty_check="'.$value['stockresponseid'].'" id="remove_qty'.$value['stockresponseid'].'" onChange="QtyValidation('.$value['stockresponseid'].')"  onkeyup="QtyValidation('.$value['stockresponseid'].')">
					<button type="button" disabled="disabled" class="btn-xs btn-sm btn-icon btn-danger waves-effect waves-light delrow" data_delete_row='.$value['stockresponseid'].' id="delrow'.$value['stockresponseid'].'"><i class="fa fa-remove"></i></button></td>';
					
					
									 
					
					$result_string1.='</tr>';
					
					$slno++;	
					$row++;	
									
				}

				$ot[0]=$result_string1;
				$ot[1]=$Sale->tot_quantity;
				$ot[2]=$Sale->tot_no_of_items;
				$ot[3]=$Sale->totalgstvalue;
				$ot[4]=$Sale->totaldiscountvalue;
				$ot[5]=$Sale->total;
				$ot[6]=$Sale->total;
				$ot[7]=$Sale->overalltotal;
				$ot[8]=$row;
				$ot[9]=$Sale->opsaleid;
				$ot[10]=$Sale->overalldiscountpercent;
				$ot[11]=$Sale->overalldiscountamount;
				$ot[12]=$Sale->overalldiscounttype;
				
			}
			else
			{
				$ot[0]='NULL';
			}
			
			return json_encode($ot);
	}
	
	
	
	//OP Returns New Code Alban 24-08-2018
	public function actionOpreturns($id="")
    {
    	if(is_numeric($id))
		{
		   $id=$id;
		}
		else
		{
		   $id=base64_decode(urldecode($id));
		}	
		$product=new Product();
		$patient=new Newpatient();
		$session = Yii::$app->session;
		
		if(Yii::$app -> request -> post())
		{
			
			$saledata_updated=Sales::find()->where(['opsaleid'=>Yii::$app -> request -> post('SALE_ID')])->one();
			
			if(!empty($saledata_updated))
			{
				$previous_net_amount=$saledata_updated->overalltotal;
				$previous_quantity=$saledata_updated->tot_quantity;
				
				//PREVIOUS GST PERCENTAGE
				$previous_gst_percentage=$saledata_updated->total_gst_percent;
				$previous_cgst_percentage=$saledata_updated->total_cgst_percent;
				$previous_sgst_percentage=$saledata_updated->total_sgst_percent;
				
				//PREVIOUS GST VALUE
				$previous_gst_value=$saledata_updated->totalgstvalue;
				$previous_cgst_value=$saledata_updated->totalcgstvalue;
				$previous_sgst_value=$saledata_updated->totalsgstvalue;
				
				//Discount Amount
				$previous_discount_percentage=$saledata_updated->overalldiscountpercent;
				$previous_discount_value=$saledata_updated->overalldiscountamount;
				
				$saledata_updated->overalltotal=$previous_net_amount-$_POST['total_net_amount'];
				$saledata_updated->tot_quantity=$previous_quantity-$_POST['total_quantity'];
				$saledata_updated->totalgstvalue=$previous_gst_value-$_POST['total_gst'];
				$saledata_updated->totalcgstvalue=$previous_cgst_value-array_sum($_POST['cgst_value']);
				$saledata_updated->totalsgstvalue=$previous_sgst_value-array_sum($_POST['sgst_value']);
				
				if(!empty($previous_discount_percentage))
				{
					$saledata_updated->overalldiscountamount=$previous_discount_value-$_POST['total_disc_original'];
					$saledata_updated->overalldiscountpercent=$previous_discount_percentage-$_POST['overall_discount_percent'];
				}
				
				if($saledata_updated->save())
				{
					if(!empty($_POST['primeid']))
					{
						foreach ($_POST['primeid'] as $key => $value) 
						{
							$saledetails_updated=Saledetail::find()->where(['opsale_detailid'=>$value])->one();
							
							$previous_saledetail_product=$saledetails_updated->productqty;
							$previous_saledetail_priceperqty=$saledetails_updated->priceperqty;
							$previous_saledetail_gstvalue=$saledetails_updated->gstvalue;
							$previous_saledetail_cgstvalue=$saledetails_updated->cgstvalue;
							$previous_saledetail_sgstvalue=$saledetails_updated->sgstvalue;
							$previous_saledetail_total_price_perqty=$saledetails_updated->total_price_perqty;
							
							//Discount
							$previous_saledetail_discountvalue=$saledetails_updated->discountvalue;
							$previous_saledetail_discountvalueperquantity=$saledetails_updated->discountvalueperquantity;
							
							
							//Updated
							$saledetails_updated->productqty=$previous_saledetail_product-$_POST['quantity'][$key];
							$saledetails_updated->priceperqty=$previous_saledetail_priceperqty-$_POST['price'][$key];
							$saledetails_updated->gstvalue=$previous_saledetail_gstvalue-($_POST['cgst_value'][$key]+$_POST['sgst_value'][$key]);
							$saledetails_updated->cgstvalue=$previous_saledetail_cgstvalue-$_POST['cgst_value'][$key];
							$saledetails_updated->sgstvalue=$previous_saledetail_sgstvalue-$_POST['sgst_value'][$key];
							$saledetails_updated->total_price_perqty=$previous_saledetail_total_price_perqty-$_POST['total_amt_cal'][$key];
							if(!empty($previous_saledetail_discountvalue))
							{
								$saledetails_updated->discountvalue=$previous_saledetail_discountvalue-$_POST['discount_value'][$key];
								$saledetails_updated->discountvalueperquantity=$previous_saledetail_discountvalueperquantity-$_POST['discountext_value'][$key];
								
							}
							if($saledetails_updated->save())
							{
								
								$stockdetails_updated=Stockmaster::find()->where(['stockid'=>$_POST['stock_id'][$key]])->one();
								$add_total_qty=$stockdetails_updated->total_no_of_quantity+$_POST['quantity'][$key];
								Stockmaster::updateAll(['total_no_of_quantity' => $add_total_qty,'updated_on' => date('Y-m-d H:i:s'),'updated_ipaddress'=> $_SERVER['REMOTE_ADDR'],'updated_by'=>$session['user_id']], ['stockid' => $_POST['stock_id'][$key]]);
							
								$overallstock_updated=Stockresponse::find()->where(['stockresponseid'=> $_POST['stock_respose_id'][$key]])->one();
								$add_overall_total_qty=$overallstock_updated->total_no_of_quantity+$_POST['quantity'][$key];
								Stockresponse::updateAll(['total_no_of_quantity' => $add_overall_total_qty,'updated_on' => date('Y-m-d H:i:s'),'updated_ipaddress'=> $_SERVER['REMOTE_ADDR'],'updated_by'=>$session['user_id']], ['stockresponseid' => $_POST['stock_respose_id'][$key]]);
							
							}
							
							
						}

						
						$auto_get=AutoidTable::find()->where(['auto'=>9])->asArray()->one();
						$autoget=$auto_get['start_num'];
						$inc_value=$autoget+1;
					   	$rtno = str_pad($autoget, 6, "0", STR_PAD_LEFT);
						
						
						$salesreturn=new Salesreturn();
						
						$salesreturn->saleid = $saledata_updated->	opsaleid;
						$salesreturn->return_invoicenumber = $rtno;
						$salesreturn->patient_type = $saledata_updated->patienttype;
						$salesreturn->returndate = date('Y-m-d H:i:s');
						$salesreturn->name = $saledata_updated->name;
						$salesreturn->mrnumber = $saledata_updated->mrnumber;
						$salesreturn->patient_id = $saledata_updated->patient_id;
						$salesreturn->sub_visit_id = $saledata_updated->subvisit_id;
						$salesreturn->subvisit_num = $saledata_updated->subvisit_num;
						
						
						$salesreturn->branch_id = $session['branch_id'];
						$salesreturn->unit_price = array_sum($_POST['price']);
						$salesreturn->return_qty = array_sum($_POST['quantity']);
						$salesreturn->total = $_POST['total_net_amount'];
						$salesreturn->totalgstvalue = array_sum($_POST['sgst_value'])+array_sum($_POST['cgst_value']);
						$salesreturn->totalcgstvalue = array_sum($_POST['cgst_value']);
						$salesreturn->totalsgstvalue = array_sum($_POST['sgst_value']);
						
						$salesreturn->totalcgstpercentage = array_sum($_POST['cgst_percent']);
						$salesreturn->totalsgstpercentage = array_sum($_POST['sgst_percent']);
						$salesreturn->totalgstpercentage = array_sum($_POST['gst_percent']);
						if(!empty($_POST['discount_value']))
						{
							$salesreturn->totaldiscountpercentage = array_sum($_POST['discount_value']);
							$salesreturn->totaldiscountvalue = array_sum($_POST['discountext_value']);
						}
						
						
						$salesreturn->paid_status = 'Y';
						$salesreturn->is_active = 1;
						$salesreturn->updated_by = $session['user_id'];
						$salesreturn->created_at = date('Y-m-d H:i:s');
						$salesreturn->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
						
						if($salesreturn->save())
						{
							foreach ($_POST['primeid'] as $key => $value) 
							{
								$saledetails_updated=Saledetail::find()->where(['opsale_detailid'=>$value])->one();
								//Returndetails
								$returndetails=new Returndetail();
								$returndetails->return_id = $salesreturn->return_id;
								$returndetails->sale_detailid = $saledetails_updated->opsale_detailid;
								$returndetails->stockid = $saledetails_updated->stockid;
								$returndetails->stockresponseid = $saledetails_updated->stockresponseid;
								$returndetails->returndate = date('Y-m-d H:i:s');
								$returndetails->productid = $saledetails_updated->productid;
								$returndetails->brandcode = $saledetails_updated->brandcode;
								$returndetails->stock_code = $saledetails_updated->stock_code;
								$returndetails->compositionid = $saledetails_updated->compositionid;
								$returndetails->unitid = $saledetails_updated->unitid;
								$returndetails->batchnumber = $saledetails_updated->batchnumber;
								$returndetails->expiredate = date('Y-m-d',strtotime($saledetails_updated->expiredate));
								
								$returndetails->productqty =$_POST['quantity'][$key];
								$returndetails->price = $_POST['price'][$key];
								//$returndetails->discount_type = $sale_details->price;
								$returndetails->gstvalue = $_POST['cgst_value'][$key]+$_POST['sgst_value'][$key];
								$returndetails->cgstvalue =  $_POST['cgst_value'][$key];
								$returndetails->sgstvalue = $_POST['sgst_value'][$key];
								if(!empty($_POST['discount_value']))
								{
									$returndetails->discountvalue = $_POST['discountext_value'][$key];
									$returndetails->discountrate = $_POST['discount_value'][$key];
								}
								$returndetails->priceperqty =  $_POST['price'][$key];
								$returndetails->mrp =  $_POST['total_amt_cal'][$key];
								$returndetails->gst_percentage = $_POST['gst_percent'][$key];
								$returndetails->cgst_percentage =  $_POST['cgst_percent'][$key];
								$returndetails->sgst_percentage = $_POST['sgst_percent'][$key];
							
								$returndetails->is_active = 1;
								$returndetails->updated_by = $session['user_id'];
								$returndetails->created_at = date('Y-m-d H:i:s');
								$returndetails->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
								if($returndetails->save())
								{
									
								}
							}

							$valid_sub_number=AutoidTable::updateAll(['start_num' => $inc_value,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 9]);
							if($valid_sub_number == 1)
							{
								return 'Saved';
							}							
						}
					}
				}

			}
		}
		else
		{
			
			$saledatainc=Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
			if(!empty($saledatainc))
			{
				$saleincrement=$saledatainc->opsaleid+1;	
				$billformat = "ECDR".($saleincrement);
			}
			//print_r($id);
			$sales=Sales::find()->where(['opsaleid'=>$id])->asArray()->one();
			$sales_detail=Saledetail::find()->where(['opsaleid'=>$id])->asArray()->all();
		
			$sales_index=ArrayHelper::index($sales_detail,'opsale_detailid');
			$sales_json=json_encode($sales_index);
			
		
			
			
			//GET PATIENT NAME
			$newpatient=Newpatient::find()->where(['mr_no'=>$sales['mrnumber']])->one();
			
			//GET INSURANCE
			$ins=Insurance::find()->where(['insurance_typeid'=>$sales['insurancetype']])->one();
			$insurance_name=(!empty($ins)) ?  $ins->insurance_type: '';
			$insurance_type=(!empty($ins)) ?  $ins->insurance_typeid: '';
			
			//GET SELECTED PRODUCT
			$product_map=ArrayHelper::map($sales_detail,'opsale_detailid','productid');
			$product=Product::find()->where(['IN','productid',$product_map])->asArray()->all();
			$product_index=ArrayHelper::index($product,'productid');
			$product_json=json_encode($product_index);
			
			//GET UNIT
			$unit_map=ArrayHelper::map($sales_detail,'opsale_detailid','unitid');
			$unit=Unit::find()->where(['IN','unitid',$unit_map])->asArray()->all();
			$unit_index=ArrayHelper::index($unit,'unitid');
			$unit_json=json_encode($unit_index);
			
			//GET COMPOSITION
			$composition_map=ArrayHelper::map($sales_detail,'opsale_detailid','compositionid');
			$composition=Composition::find()->where(['IN','composition_id',$composition_map])->asArray()->all();
			$composition_index=ArrayHelper::index($composition,'composition_id');
			$composition_json=json_encode($composition_index);
			
			
	        return $this->render('billreturns', [
	        		'productname'=>$productname,
	        		'model'=>$product,
	        		'billformat' => $billformat,
	        		'patient' => $patient,
	        		'sales' => $sales,
	        		'sales_detail' => $sales_detail,
	        		'product_map' => $product_map,
	        		'product' => $product,
	        		'product_index' => $product_index,
	        		'newpatient' => $newpatient,
	        		'insurance_type' => $insurance_type,
	        		'insurance_name' => $insurance_name,
	        		'sales_json' => $sales_json,
	        		'product_json' => $product_json,
	        		'composition_json' => $composition_json,
	        		'unit_json' => $unit_json,
	        		
	        ]);
		}
	}
    	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function actionReturntabletpdf($id)
    {
    	$ENC_id=base64_decode(urldecode($id));
    	
    	$query = new Query;
		$query	->select(['*'])->from('sales')->join(	'INNER JOIN',  'saledetail','sales.opsaleid =saledetail.opsaleid')->where(['sales.mrnumber'=>$ENC_id])->orderBy(['sales.invoicedate'=>SORT_ASC])->all(); 
		
		$command = $query->createCommand();
		$in_send_data = $command->queryAll();
		
		if(!empty($in_send_data))
		{	
							
				//Product Type Fetch
				$product_type_map = ArrayHelper::map($in_send_data, 'opsale_detailid', 'productid');
				$product_type_in = Product::find()->where(['IN','productid',$product_type_map])->asArray()->all(); 
				$product_type_index=ArrayHelper::index($product_type_in,'productid');
				
				$inv_date=array();	
				$inv_bill=array();		
				foreach ($in_send_data as $key => $value) 
				{
					$inv_date[]=date('Y-m-d',strtotime($value['invoicedate']));
					$inv_bill[]=$value['billnumber'];
				}
				$inv_date_uniq=array_unique($inv_date);
				$inv_bill_uniq=array_unique($inv_bill);
				
				//Invoice Bill Total Logic
					
				$val_qty_bill=0;
				$val_mrp_bill=0;
				$val_disc_bill=0;
				$val_amt_bill=0;
				
				$arr_qty_bill=array();
				$arr_mrp_bill=array();
				$arr_disc_bill=array();
				$arr_amt_bill=array();
				
				$val_inc_bill=0;
				
				foreach ($inv_bill_uniq as $key => $value) 
				{
					$query2 = new Query;
					$query2	->select(['*'])->from('sales')->join(	'INNER JOIN',  'saledetail','sales.opsaleid =saledetail.opsaleid')->where(['sales.mrnumber'=>$ENC_id])->andWhere(['sales.billnumber'=>$value])->all(); 
					
					$command2 = $query2->createCommand();
					$in_send_data_val_bill = $command2->queryAll();
					foreach ($in_send_data_val_bill as $key2 => $value2) 
					{
						$val_qty_bill=$val_qty_bill+$value2['productqty'];
						$val_mrp_bill=$val_mrp_bill+$value2['mrpperunit'];
						if($value2['discountvalueperquantity'] == '')
						{
							$val_disc_bill=$val_disc_bill+0;
						}
						else {
							$val_disc_bill=$val_disc_bill+$value2['discountvalueperquantity'];
						}
						$val_amt_bill=$val_amt_bill+$value2['total_price_perqty'];
					}
					
					$arr_qty_bill[]=$val_qty_bill;
					$arr_mrp_bill[]=$val_mrp_bill;
					$arr_disc_bill[]=$val_disc_bill;
					$arr_amt_bill[]=ceil($val_amt_bill);
					
					$val_qty_bill=0;
					$val_mrp_bill=0;
					$val_disc_bill=0;
					$val_amt_bill=0;
				}
				
				//Invoice Date Total Logic
				$val_qty=0;
				$val_mrp=0;
				$val_disc=0;
				$val_amt=0;
				
				$arr_qty=array();
				$arr_mrp=array();
				$arr_disc=array();
				$arr_amt=array();
				
				$val_inc=0;
				
				foreach ($inv_date_uniq as $key => $value) 
				{
					$query1 = new Query;
					$query1	->select(['*'])->from('sales')->join(	'INNER JOIN',  'saledetail','sales.opsaleid =saledetail.opsaleid')->where(['sales.mrnumber'=>$ENC_id])->andWhere(['date(sales.invoicedate)'=>$value])->all(); 
					
					$command1 = $query1->createCommand();
					$in_send_data_val = $command1->queryAll();
					foreach ($in_send_data_val as $key1 => $value1) 
					{
						$val_qty=$val_qty+$value1['productqty'];
						$val_mrp=$val_mrp+$value1['mrpperunit'];
						if($value1['discountvalueperquantity'] == '')
						{
							$val_disc=$val_disc+0;
						}
						else {
							$val_disc=$val_disc+$value1['discountvalueperquantity'];
						}
						$val_amt=$val_amt+$value1['total_price_perqty'];
					}
					
					$arr_qty[]=$val_qty;
					$arr_mrp[]=$val_mrp;
					$arr_disc[]=$val_disc;
					$arr_amt[]=ceil($val_amt);
					
					$val_qty=0;
					$val_mrp=0;
					$val_disc=0;
					$val_amt=0;
				}
				
				require ('../../vendor/tcpdf/tcpdf.php');
								$pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
								$pdf->SetCreator(PDF_CREATOR);
								$pdf->SetAuthor('Nicola Asuni');
								$pdf->SetTitle('Invoice');
								$pdf->SetSubject('TCPDF Tutorial');
								$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
								$pdf->SetPrintHeader(false);
								$pdf->SetPrintFooter(false);
								$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
								$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
								$pdf->setFontSubsetting(true);
								$pdf->SetFont('helvetica', '', 8, '', true);
								
								
								
								
								
								$pdf->AddPage("L");
								
								$tbl1='<html><body>
								<div><h2 style="text-align:center;color:red;">Dinesh Medical Center</h2>';
							
								$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
								$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
								$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
								$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
								$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;">MR Number Wise Report</p>';
								//$tbl1.='<p style="border-top:1px solid #000;"></p>';
								
								$tbl1.='</div>';
								
								$tbl1.='<table  CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">';
								$tbl1.='<tr>
						                  <td  width="5%" style="text-align:center;" ><b>SNo</b></td>
						                  <td  width="10%" style="text-align:center;" ><b>Bill Number</b></td>
						                  <td width="18%" ><b>Item Description</b></td>
						                  <td width="13%"><b>HSN Code</b></td>
						                  <td width="9%" ><b>Batch No</b></td>
						                  <td width="9%" ><b>Expire Date</b></td>
						                  <td width="9%"  style="text-align:right;"><b>Qty</b></td>
						                   <td width="9%"  style="text-align:right;"><b>Mrp</b></td>
						                    <td width="9%"  style="text-align:right;" ><b>Discount</b></td>
						                     <td width="9%"  style="text-align:right;"><b>Amount</b></td>
						               </tr></table><hr>';
									   $sno=1;
								
								$inv_date=date('d-m-Y',strtotime($in_send_data['0']['invoicedate']));
								
								$inv_bill_no=$in_send_data['0']['billnumber'];
								
								$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
								               <tr>
								                
								                   <td  width="100%" style="font-size:12px;color:green;" ><b>Invoice Date :'.date('d-m-Y',strtotime($in_send_data['0']['invoicedate'])).'</b></td>
								               </tr></table>';		   
									   
								foreach ($in_send_data as $key => $value) 
								{
									$inv_date_curr=date('d-m-Y',strtotime($value['invoicedate']));
									
									$inv_bill_curr=$value['billnumber'];
									
									if($inv_date_curr == $inv_date)
									{
										
										if($inv_bill_no == $inv_bill_curr)
										{	
											$tbl1.='<table  CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">';
											$tbl1.='<tr>
								                   <td  width="5%" style="text-align:center;" >'.$sno.'</td>
								                   <td  width="10%" style="color:red;text-align:center;" ><b>'.$value['billnumber'].'</b></td>
								                  <td  width="18%">'.$product_type_index[$value['productid']]['productname'].'</td>
								                  <td width="13%">'.$product_type_index[$value['productid']]['hsn_code'].'</td>
								                  <td width="9%" >'.$value['batchnumber'].'</td>
								                  <td  width="9%"  >'.date('d-m-Y',strtotime($value['expiredate'])).'</td>
								                  <td width="9%"  style="text-align:right;" >'.$value['productqty'].'</td>
								              	<td width="9%"   style="text-align:right;">'.$value['mrpperunit'].'</td>';
												if($value['discountvalueperquantity'] == '')
												{
													$tbl1.='<td width="9%"   style="text-align:right;">0</td>';
												}
												else
												{
													$tbl1.='<td width="9%"  style="text-align:right;" >'.$value['discountvalueperquantity'].'</td>';
												}
												$tbl1.='<td width="9%" style="text-align:right;" >'.$value['total_price_perqty'].'</td></tr></table>';
										}
										else if($inv_bill_no != $inv_bill_curr)
										{
											$inv_bill_no=$value['billnumber'];
											$tbl1.='<hr><table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
								               <tr>
								                 <td  width="5%" style="color:brown;" ><b>Bill Tot</b></td>
							                 	 <td  width="10%"></td>
							                  <td  width="18%"></td>
							                  <td width="13%"></td>
							                  <td width="9%" ></td>
							                  <td  width="9%"  ></td>
							                  <td width="9%"  style="color:brown;text-align:right;" ><b>'.$arr_qty_bill[$val_inc_bill].'</b></td>
							              	<td width="9%"   style="color:brown;text-align:right;"><b>'.$arr_mrp_bill[$val_inc_bill].'</b></td>
							              	<td width="9%"   style="color:brown;text-align:right;"><b>'.$arr_disc_bill[$val_inc_bill].'</b></td>
							              	<td width="9%" style="color:brown;text-align:right;" ><b>'.$arr_amt_bill[$val_inc_bill].'</b></td>
							              	</tr></table><hr><table  CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">';
											$tbl1.='<tr>
								                   <td  width="5%" style="text-align:center;" >'.$sno.'</td>
								                   <td  width="10%" style="color:red;text-align:center;" ><b>'.$value['billnumber'].'</b></td>
								                  <td  width="18%">'.$product_type_index[$value['productid']]['productname'].'</td>
								                  <td width="13%">'.$product_type_index[$value['productid']]['hsn_code'].'</td>
								                  <td width="9%" >'.$value['batchnumber'].'</td>
								                  <td  width="9%"  >'.date('d-m-Y',strtotime($value['expiredate'])).'</td>
								                  <td width="9%"  style="text-align:right;" >'.$value['productqty'].'</td>
								              	<td width="9%"   style="text-align:right;">'.$value['mrpperunit'].'</td>';
												if($value['discountvalueperquantity'] == '')
												{
													$tbl1.='<td width="9%"   style="text-align:right;">0</td>';
												}
												else
												{
													$tbl1.='<td width="9%"  style="text-align:right;" >'.$value['discountvalueperquantity'].'</td>';
												}
												$tbl1.='<td width="9%" style="text-align:right;" >'.$value['total_price_perqty'].'</td></tr></table>';
												
												$val_inc_bill++;	
										}
									}
									else if($inv_date_curr != $inv_date)
									{
										$inv_date=date('d-m-Y',strtotime($value['invoicedate']));
										if($inv_bill_no == $inv_bill_curr)
										{	
										$tbl1.='<hr>';
										
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
								               <tr>
								                 <td  width="5%" style="font-size:14px;color:blue;" ><b>Total</b></td>
							                 	 <td  width="10%"></td>
							                  <td  width="18%"></td>
							                  <td width="13%"></td>
							                  <td width="9%" ></td>
							                  <td  width="9%"  ></td>
							                  <td width="9%"  style="font-size:14px;color:blue;text-align:right;" ><b>'.$arr_qty[$val_inc].'</b></td>
							              	<td width="9%"   style="font-size:14px;color:blue;text-align:right;"><b>'. $arr_mrp[$val_inc].'</b></td>
							              	<td width="9%"   style="font-size:14px;color:blue;text-align:right;"><b>'. $arr_disc[$val_inc].'</b></td>
							              	<td width="9%" style="font-size:14px;color:blue;text-align:right;" ><b>'.$arr_amt[$val_inc].'</b></td>
							              	</tr></table>';
										
										$tbl1.='<hr>';
										
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
								               <tr>
								                
								                   <td  width="100%" style="font-size:12px;color:green;" ><b>Invoice Date :'.date('d-m-Y',strtotime($value['invoicedate'])).'</b></td>
								               </tr></table>';
										
										$tbl1.='<table  CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">';
										$tbl1.='<tr>
							                   <td  width="5%" style="text-align:center;" >'.$sno.'</td>
							                     <td  width="10%" style="color:red;text-align:center;" ><b>'.$value['billnumber'].'</b></td>
							                  <td  width="18%">'.$product_type_index[$value['productid']]['productname'].'</td>
							                  <td width="13%">'.$product_type_index[$value['productid']]['hsn_code'].'</td>
							                  <td width="9%" >'.$value['batchnumber'].'</td>
							                  <td  width="9%"  >'.date('d-m-Y',strtotime($value['expiredate'])).'</td>
							                  <td width="9%"  style="text-align:right;" >'.$value['productqty'].'</td>
							              	<td width="9%"   style="text-align:right;">'.$value['mrpperunit'].'</td>';
											if($value['discountvalueperquantity'] == '')
											{
												$tbl1.='<td width="9%"   style="text-align:right;">0</td>';
											}
											else
											{
												$tbl1.='<td width="9%"  style="text-align:right;" >'.$value['discountvalueperquantity'].'</td>';
											}
											$tbl1.='<td width="9%" style="text-align:right;" >'.$value['total_price_perqty'].'</td></tr></table>';
										}
										elseif ($inv_bill_no != $inv_bill_curr) 
										{
											$inv_bill_no=$value['billnumber'];
											$tbl1.='<hr><table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
								               <tr>
								                 <td  width="5%" style="color:brown;" ><b>Bill Tot</b></td>
							                 	 <td  width="10%"></td>
							                  <td  width="18%"></td>
							                  <td width="13%"></td>
							                  <td width="9%" ></td>
							                  <td  width="9%"  ></td>
							                  <td width="9%"  style="color:brown;text-align:right;" ><b>'.$arr_qty_bill[$val_inc_bill].'</b></td>
							              	<td width="9%"   style="color:brown;text-align:right;"><b>'.$arr_mrp_bill[$val_inc_bill].'</b></td>
							              	<td width="9%"   style="color:brown;text-align:right;"><b>'.$arr_disc_bill[$val_inc_bill].'</b></td>
							              	<td width="9%" style="color:brown;text-align:right;" ><b>'.$arr_amt_bill[$val_inc_bill].'</b></td>
							              	</tr></table><hr>';
											
											$tbl1.='<hr>';
										
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
								               <tr>
								                 <td  width="5%" style="font-size:14px;color:blue;" ><b>Total</b></td>
							                 	 <td  width="10%"></td>
							                  <td  width="18%"></td>
							                  <td width="13%"></td>
							                  <td width="9%" ></td>
							                  <td  width="9%"  ></td>
							                  <td width="9%"  style="font-size:14px;color:blue;text-align:right;" ><b>'.$arr_qty[$val_inc].'</b></td>
							              	<td width="9%"   style="font-size:14px;color:blue;text-align:right;"><b>'. $arr_mrp[$val_inc].'</b></td>
							              	<td width="9%"   style="font-size:14px;color:blue;text-align:right;"><b>'. $arr_disc[$val_inc].'</b></td>
							              	<td width="9%" style="font-size:14px;color:blue;text-align:right;" ><b>'.$arr_amt[$val_inc].'</b></td>
							              	</tr></table>';
										
										$tbl1.='<hr>';
										
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
								               <tr>
								                
								                   <td  width="100%" style="font-size:12px;color:green;" ><b>Invoice Date :'.date('d-m-Y',strtotime($value['invoicedate'])).'</b></td>
								               </tr></table>';
										
										$tbl1.='<table  CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">';
										$tbl1.='<tr>
							                   <td  width="5%" style="text-align:center;" >'.$sno.'</td>
							                     <td  width="10%" style="color:red;text-align:center;" ><b>'.$value['billnumber'].'</b></td>
							                  <td  width="18%">'.$product_type_index[$value['productid']]['productname'].'</td>
							                  <td width="13%">'.$product_type_index[$value['productid']]['hsn_code'].'</td>
							                  <td width="9%" >'.$value['batchnumber'].'</td>
							                  <td  width="9%"  >'.date('d-m-Y',strtotime($value['expiredate'])).'</td>
							                  <td width="9%"  style="text-align:right;" >'.$value['productqty'].'</td>
							              	<td width="9%"   style="text-align:right;">'.$value['mrpperunit'].'</td>';
											if($value['discountvalueperquantity'] == '')
											{
												$tbl1.='<td width="9%"   style="text-align:right;">0</td>';
											}
											else
											{
												$tbl1.='<td width="9%"  style="text-align:right;" >'.$value['discountvalueperquantity'].'</td>';
											}
											$tbl1.='<td width="9%" style="text-align:right;" >'.$value['total_price_perqty'].'</td></tr></table>';
											
											$val_inc_bill++;
										}
										$val_inc++;
										
										}
									   $sno++;
								}
								
								$tbl1.='<hr><table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
								               <tr>
								                 <td  width="5%" style="color:brown;" ><b>Bill Tot</b></td>
							                 	 <td  width="10%"></td>
							                  <td  width="18%"></td>
							                  <td width="13%"></td>
							                  <td width="9%" ></td>
							                  <td  width="9%"  ></td>
							                  <td width="9%"  style="color:brown;text-align:right;" ><b>'.end($arr_qty_bill).'</b></td>
							              	<td width="9%"   style="color:brown;text-align:right;"><b>'.end($arr_mrp_bill).'</b></td>
							              	<td width="9%"   style="color:brown;text-align:right;"><b>'.end($arr_disc_bill).'</b></td>
							              	<td width="9%" style="color:brown;text-align:right;" ><b>'.end($arr_amt_bill).'</b></td>
							              	</tr></table><hr>';
											
											$tbl1.='<hr>';
	
								$tbl1.='<hr>';
										
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
								               <tr>
								                 <td  width="5%" style="font-size:14px;color:blue;" ><b>Total</b></td>
							                  <td  width="10%"></td>
							                  <td  width="18%"></td>
							                  <td width="13%"></td>
							                  <td width="9%" ></td>
							                  <td  width="9%"  ></td>
							                  <td width="9%"  style="font-size:14px;color:blue;text-align:right;" ><b>'.end($arr_qty).'</b></td>
							              	<td width="9%"   style="font-size:14px;color:blue;text-align:right;"><b>'. end($arr_mrp).'</b></td>
							              	<td width="9%"   style="font-size:14px;color:blue;text-align:right;"><b>'. end($arr_disc).'</b></td>
							              	<td width="9%" style="font-size:14px;color:blue;text-align:right;" ><b>'.end($arr_amt).'</b></td>
							              	</tr></table>';
										
										$tbl1.='<hr>';
								
								$tbl1.='<hr>';
										
										$tbl1.='<table nobr="true" CELLPADDING="1" CELLSPACING="1" WIDTH="100%" VALIGN="MIDDLE" ALIGN="LEFT">
								               <tr>
								                 <td  width="10%" style="font-size:14px;color:red;" ><b>Grand Total</b></td>
							                  <td  width="5%"></td>
							                  <td  width="15%"></td>
							                  <td width="14%"></td>
							                  <td width="10%" ></td>
							                  <td  width="10%"  ></td>
							                  <td width="9%"  style="font-size:14px;color:red;text-align:right;" ><b>'.array_sum($arr_qty).'</b></td>
							              	<td width="9%"   style="font-size:14px;color:red;text-align:right;"><b>'. array_sum($arr_mrp).'</b></td>
							              	<td width="9%"   style="font-size:14px;color:red;text-align:right;"><b>'. array_sum($arr_disc).'</b></td>
							              	<td width="9%" style="font-size:14px;color:red;text-align:right;" ><b>'.array_sum($arr_amt).'</b></td>
							              	</tr></table>';
										
										$tbl1.='<hr>';

								$tbl1.='</body></html>';
								$pdf->writeHTML($tbl1, true, false, false, false, '');
				    			$pdf->Output('example_001.pdf');
								
								die;
							
		}
	}
	
	
	
	public function actionFetchbillnumber($id)
    {
    	if($id == 'outpatient')
		{
			$saledatainc=Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
			$saleincrement=$saledatainc->opsaleid+1;
			$billformat = "ECGR".($saleincrement);
		}
		else if($id == 'inpatient') 
		{
			$saledatainc=Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
			$saleincrement=$saledatainc->opsaleid+1;
			$billformat = "ECDR".($saleincrement);
		}
		elseif ($id == 'temppatient')
		{
			$saledatainc=Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
			$saleincrement=$saledatainc->opsaleid+1;
			$billformat = "ECSR".($saleincrement);	
		}
        
		return $billformat;
    }
	
	public function actionFetchtempview($id)
    {
    	$saledetaildata=Saledetail::find()->where(['opsaleid'=>$id])->all();
		//echo "<pre>";
		//print_r($saledetaildata);
		if(!empty($saledetaildata))
		{
			$result_string="";
			$result_string.='<table class="table table-bordered">';
			$result_string.='<thead>';
			$result_string.='<th class="text-center">Stock/Drug</th>';
			$result_string.='<th class="text-center">Batch</th>';
			$result_string.='<th class="text-center">Exp Date</th>';
			$result_string.='<th class="text-center">Qty</th>';
			$result_string.='<th class="text-center">Unit Form</th>';
			$result_string.='<th class="text-center">Amount</th>';
			$result_string.='</thead>';
			$result_string.='<tbody>';
				
			foreach ($saledetaildata as $key => $value)
			{
				$Stock_code=Stockmaster::find() -> where(['stockid'=> $value['stockid']]) ->one();
					
				$Product = Product::find()->where(['productid'=> $Stock_code->productid ])->one();
				$Composition=Composition::find()->where(['is_active'=>1])-> andWhere(['composition_id' => $Product->composition_id]) ->one();
				
				$result_string.='<tr>';
				$result_string.='<td  class="text-center">'.$Product->productname."/".$Composition->composition_name.'</td>';
				$result_string.='<td  class="text-center">'.$value['batchnumber'].'</td>';
				$result_string.='<td  class="text-center">'.date('d-m-Y',strtotime($value['expiredate'])).'</td>';
				$result_string.='<td  class="text-center">'.$value['tablet_tot_unit_ins'].'</td>';
			
				$result_string.='<td class="text-center">'.$value['medicine_type_ins'].'</td>';
				$result_string.='<td class="text-center">'.$value['total_price_perqty'].'</td>';
				$result_string.='</tr>';	
			}
			$result_string.='</tbody>';
			$result_string.='</table>';
		}
		
		return $result_string;
    }
	//Alban End

 public function actionDraft()
    {
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('draft', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }




	 public function actionCountersale() {
	 	
		$salemodel=new Sales();
	 if (Yii::$app->request->post() ) 
	 {
		$session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
		$saledata=Sales::find()->where(['paid_status'=>'UnPaid'])->andwhere(['branch_id'=>$companybranchid])->all();
		$brandcode=$_POST['brandcode'];
		foreach ($brandcode as $key => $value) {
        $stockresponseid=Yii::$app -> request -> post('stockresponseid')[$key];
		$saleunits=Yii::$app -> request -> post('totalunits')[$key];
		$overallstock=Stockresponse::find()->where(['stockresponseid'=>$stockresponseid])->one();
		$overallquantity=$overallstock->total_no_of_quantity;
		foreach($saledata as $k)
										{
										  $saleid=$k->opsaleid;
											$saledetaildata=Saledetail::find()->where(['opsaleid'=>$saleid])->andwhere(['stockresponseid'=>$stockresponseid])->all();
											foreach($saledetaildata as $l)
											{
											$currentqty+=$l->productqty;	
										    }
										}
										$availableqty[]=$overallquantity-$currentqty-$saleunits; 
				        }				
				
				foreach($availableqty as $checkqty)
				{
					if($checkqty>=0)
					{
						$status=1;
					}
					else{
						$status=0;
					}
				}
            if($status)		
			{
			$mrnumber=Yii::$app -> request -> post('Patient')['medicalrecord_number'];
			$model=Patient::find()->where(['medicalrecord_number'=>$mrnumber])->one();
			if($model)
			{
			}
			else{
				$model = new Patient();
			$model -> is_active = 1;
			$model -> medicalrecord_number = Yii::$app -> request -> post('Patient')['medicalrecord_number'];
			$model -> updated_by = $session['user_id'];
			$model -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			$model -> updated_on = date("Y-m-d H:i:s");
			$model -> firstname = trim(ucwords(Yii::$app -> request -> post('Patient')['firstname']));
			$model -> patient_mobilenumber = trim(Yii::$app -> request -> post('Patient')['patient_mobilenumber']);
			$model -> patient_type = 2;
			$model->insurance_type=3;
			$ptype="OP";
			$model->save();
			}
			
			if ($model -> save()) {
			$salemodel -> name = $model->firstname. " ".$model->lastname;
			$salemodel -> mrnumber = $model -> medicalrecord_number;
			$salemodel -> phonenumber = $model -> patient_mobilenumber;
			$saledatainc=	Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
			$saleincrement=$saledatainc->saleincrement+1;
		    $billformat = "P/INV/" . $ptype . "/" . date("Y") . "/" . date("m") . "/" . ($saleincrement);
			$salemodel->saleincrement=$saleincrement;
			$salemodel -> billnumber = $billformat;
			$branchid =trim(Yii::$app -> request -> post('branch_id'));
			$salemodel -> branch_id = $branchid;
			$salemodel -> invoicedate = date("Y-m-d");
			$salemodel -> total = Yii::$app -> request -> post('totalprice');
			$salemodel -> updated_by = $session['user_id'];
			$salemodel -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			$salemodel -> updated_on = date("Y-m-d H:i:s");
			$brandcode=$_POST['brandcode'];
			$totaldiscountvalue=0;$totalgstvalue=0;$totaltaxableamount=0;
				foreach ($brandcode as $key => $value) {
				$totaldiscountvalue+= Yii::$app -> request -> post('discount_value')[$key];
				$totalgstvalue+= Yii::$app -> request -> post('gst_value')[$key];
				$totaltaxableamount+= Yii::$app -> request -> post('taxableamount')[$key];
				
				}
			$salemodel->totalgstvalue=$totalgstvalue;
			$salemodel->totalcgstvalue=$totalgstvalue/2;
			$salemodel->totalsgstvalue=$totalgstvalue/2;
			$salemodel->totaldiscountvalue=$totaldiscountvalue;
			$salemodel->paid_status="UnPaid";
			$salemodel->overalldiscounttype=Yii::$app -> request -> post('overalldiscounttype');
			$salemodel->overalldiscountpercent=Yii::$app -> request -> post('overalldiscount');
			$salemodel->overalldiscountamount=Yii::$app -> request -> post('overalldiscountamount');
			$salemodel->overalltotal=Yii::$app -> request -> post('overalltotal');
			$salemodel->totaltaxableamount=$totaltaxableamount;
			$salemodel -> patienttype=2;
			
							if($salemodel->save())
							{
				$saleid = $salemodel -> opsaleid;
				$brandcode=$_POST['brandcode'];
				$i=1;
				foreach ($brandcode as $key => $value) {
					$model1 = new Saledetail();
					$model1 -> opsaleid = $saleid;
					$model1 -> saledate = date('Y-m-d');
					$model1 -> productid = Yii::$app -> request -> post('productid')[$key];
					$model1 -> brandcode =  Yii::$app -> request -> post('brandcode')[$key];
					$model1 -> stock_code =  Yii::$app -> request -> post('stock_code')[$key];
					$model1 -> compositionid = Yii::$app -> request -> post('compositionid')[$key];
					$model1 -> unitid = Yii::$app -> request -> post('unitid')[$key];
					$productqty = Yii::$app -> request -> post('totalunits')[$key];
					$model1 -> productqty = $productqty;
					$priceperqty = Yii::$app -> request -> post('priceperqty')[$key];
					$model1 -> priceperqty = $priceperqty;
					$gstrate = Yii::$app -> request -> post('gst')[$key];
					$model1 -> gstrate=$gstrate;
					$discountrate = Yii::$app -> request -> post('discount')[$key];
					$model1 -> discountrate=$discountrate;
					$model1->gstvalueperquantity=($priceperqty * $gstrate)/100;
					$model1->discountvalueperquantity=($priceperqty * $discountrate)/100;
					$model1 -> price =  number_format(Yii::$app -> request -> post('price')[$key],2);
					$model1 -> expiredate =  date("Y-m-d",strtotime(Yii::$app -> request -> post('expiredate')[$key]));
					$batchnumber = Yii::$app -> request -> post('batchnumber')[$key];
					$model1 -> batchnumber = $batchnumber;
					$model1 -> is_active = 1;
					$model1 -> updated_by = $session['user_id'];
					$model1 -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
					$model1 -> updated_on = date("Y-m-d H:i:s");
					$model1->gstvalue=number_format(Yii::$app -> request -> post('gst_value')[$key],2);
					$model1->cgstvalue=$model1->gstvalue/2;
					$model1->sgstvalue=$model1->gstvalue/2;
					$model1->discountvalue=number_format(Yii::$app -> request -> post('discount_value')[$key],2);
					$increment=Yii::$app -> request -> post('dataincrement')[$key];
					$model1->discount_type=Yii::$app -> request -> post('discounttype_np'.$increment);
					$model1->stockid=Yii::$app -> request -> post('stockid')[$key];
					$model1->stockresponseid=Yii::$app -> request -> post('stockresponseid')[$key];
					$model1->taxableamount=number_format(Yii::$app -> request -> post('taxableamount')[$key],2);
					$model1->mrpperunit=number_format(Yii::$app -> request -> post('realmrp')[$key]);
					$model1 -> save();
					$i++;
				}
				}
                     else
					 	{
					 		print_r($salemodel->getErrors());
			                 die;
					 	}
			} 
			else {
				print_r($model->getErrors());
				die;
				if (count($model -> getErrors()) > 0) {
					Yii::$app -> getSession() -> setFlash('success', 'Patient Already Exists');
					return $this -> redirect(['sales']);
				}
			}
				return "Y=".$saleid;
			
			}	

          else
		  	{
		  		return "A";
		  	}
            
	}
	
	
	else{
		
		   $pmodel = new Patient();
			$patientmax = Patient::find() -> max('patient_id');
			$patientmax = $patientmax + 1;
			$physicianlist=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
			$patient_type = ArrayHelper::map(Patienttype::find() -> asArray() -> all(), 'patient_typeid', 'patient_typename');
			$companylist = ArrayHelper::map(CompanyBranch::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'branch_id', 'branch_name');
			$brandlist=ArrayHelper::map(Productgrouping::find()-> where(['is_active' => 1]) -> asArray() -> all(), 'productgroupid', 'brandcode');
		$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
		$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		$stockcodelist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'stock_code');
		$branchlist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
	    $productgrouplist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'brandcode');
		$insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
		 $model = new Stockmaster();
        $session = Yii::$app->session;
		$userid=$session['user_id'];
        $userdata=BranchAdmin::find()->where(['ba_autoid'=>$userid])->one();
        $companybranchid=$userdata->ba_branchid;
		  $searchModel = new StockresponseSearch();
        $dataProvider = $searchModel->customstocksearch_np(Yii::$app->request->queryParams);
        return $this->render('countersale', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'model' => $model, 'vendorlist' => $vendorlist, 'productlist'=>$productlist,'branchlist'=>$branchlist,
             'productgrouplist'=>$productgrouplist,'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,'unitlist'=>$unitlist,
             'stockcodelist'=>$stockcodelist,'pmodel'=>$pmodel,'patient_type'=>$patient_type,'patientmax'=>$patientmax,
            'companylist'=>$companylist,'brandlist'=>$brandlist,'physicianlist'=>$physicianlist,'insurancelist'=>$insurancelist,
           
        ]);
	}
	 } 




	
		public function actionReturnsalessingletablet() 
		{
			if($_POST)	
			{
				
				$session = Yii::$app->session;
				$branch_id=$session['branch_id'];
				
				$stock_id=$_POST['stock_id'][0];
				
				$sale_details=Saledetail::find()->where(['opsale_detailid'=>$_POST['sales_details'][0]])->one();
				$sales=Sales::find()->where(['opsaleid'=>$sale_details->opsaleid])->one();
				if(!empty($sale_details))
				{
					$existing_qty=$sale_details->productqty;
					$existing_price=$sale_details->total_price_perqty;
					
					$sale_details->return_status='Y';
					$sale_details->return_date=date('Y-m-d H:i:s');
					$sale_details->productqty=$existing_qty-$_POST['remove_qty'][0];
					$sale_details->total_price_perqty=$existing_price-$_POST['total_net_amount'];
					if($sale_details->save())
					{
						$sales->overalltotal=$sales->overalltotal-$_POST['total_net_amount'];
						$sales->tot_quantity=$sales->tot_quantity-$existing_qty;
						if($sales->save())
						{
							if(!empty($stock_id))
							{
								//Stock Insert
								$overallstock=Stockresponse::find()->where(['stockresponseid'=>$stock_id])->one();
								$overallstock_array=ArrayHelper::toArray($overallstock);
								
								if(!empty($overallstock_array))
								{
									
											$Stock_brand=Stockmaster::find() -> where(['is_active' => 1])-> andWhere(['stockid'=> $overallstock_array['stockid']]) -> one();
											$overallstock_updated=Stockresponse::find()->where(['stockresponseid'=> $overallstock_array['stockresponseid']])->one();
											$Stock_brand_array=ArrayHelper::toArray($Stock_brand);
											$current_quantity=$overallstock_array['total_no_of_quantity'];
											$updated_quantity=$_POST['remove_qty'][0];
											$nw_quantity=$current_quantity+$updated_quantity;
											$overallstock_updated->total_no_of_quantity=$nw_quantity;
											if($overallstock_updated->save())
											{
												$stock_quantity=$Stock_brand->total_no_of_quantity;
												$updated_stock_quantity=$stock_quantity+$updated_quantity;
												$Stock_brand->total_no_of_quantity=$updated_stock_quantity;
												if($Stock_brand->save())
												{
													$auto_get=AutoidTable::find()->where(['auto'=>9])->asArray()->one();
													$autoget=$auto_get['start_num'];
													$inc_value=$autoget+1;
												   	$rtno = str_pad($autoget, 6, "0", STR_PAD_LEFT);
													
													
													$salesreturn=new Salesreturn();
													
													$salesreturn->saleid = $sales->	opsaleid;
													$salesreturn->return_invoicenumber = $rtno;
													$salesreturn->patient_type = $sales->patienttype;
													$salesreturn->returndate = date('Y-m-d H:i:s');
													$salesreturn->name = $sales->name;
													$salesreturn->mrnumber = $sales->mrnumber;
													$salesreturn->branch_id = $branch_id;
													$salesreturn->total = $_POST['total_net_amount'];
													$salesreturn->totalgstvalue = $sales->totalgstvalue;
													$salesreturn->totalcgstvalue = $sales->totalcgstvalue;
													$salesreturn->totalsgstvalue = $sales->totalsgstvalue;
													$salesreturn->totaldiscountvalue = $sales->overalldiscountamount;
													$salesreturn->totalcgstpercentage = $sales->total_cgst_percent;
													$salesreturn->totalsgstpercentage = $sales->total_sgst_percent;
													$salesreturn->totalgstpercentage = $sales->total_gst_percent;
													$salesreturn->totaldiscountpercentage = $sales->overalldiscountpercent;
													$salesreturn->paid_status = 'Y';
													$salesreturn->is_active = 1;
													$salesreturn->updated_by = $session['user_id'];
													$salesreturn->created_at = date('Y-m-d H:i:s');
													$salesreturn->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
													if($salesreturn->save())
													{
														$valid_sub_number=AutoidTable::updateAll(['start_num' => $inc_value,'updated_at' => date('Y-m-d H:i:s'),'ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto' => 9]);
														
														
														$returndetails=new Returndetail();
														$returndetails->return_id = $salesreturn->return_id;
														$returndetails->sale_detailid = $sale_details->opsale_detailid;
														$returndetails->stockid = $sale_details->stockid;
														$returndetails->stockresponseid = $sale_details->stockresponseid;
														$returndetails->returndate = date('Y-m-d H:i:s');
														$returndetails->productid = $sale_details->productid;
														$returndetails->brandcode = $sale_details->brandcode;
														$returndetails->stock_code = $sale_details->stock_code;
														$returndetails->compositionid = $sale_details->compositionid;
														$returndetails->unitid = $sale_details->unitid;
														$returndetails->batchnumber = $sale_details->batchnumber;
														$returndetails->expiredate = date('Y-m-d',strtotime($sale_details->expiredate));
														$returndetails->productqty = $sale_details->productqty;
														$returndetails->price = $sale_details->price;
														//$returndetails->discount_type = $sale_details->price;
														$returndetails->gstvalue = $sale_details->gstvalue;
														$returndetails->cgstvalue =  $sale_details->cgstvalue;
														$returndetails->sgstvalue = $sale_details->sgstvalue;
														$returndetails->discountvalue = $sale_details->discountvalueperquantity;
														$returndetails->priceperqty =  $sale_details->priceperqty;
														$returndetails->mrp =  $sale_details->mrpperunit;
														$returndetails->gst_percentage = $sale_details->gstrate;
														$returndetails->cgst_percentage =  $sale_details->cgst_percent;
														$returndetails->sgst_percentage = $sale_details->sgst_percent;
														$returndetails->discount_percentage = $sale_details->discountvalue;
														$returndetails->is_active = 1;
														$returndetails->updated_by = $session['user_id'];
														$returndetails->created_at = date('Y-m-d H:i:s');
														$returndetails->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
														
														if($returndetails->save())
														{
															return 'Singletablet';
														}
														else 
														{
															print_r($returndetails->getErrors());die;
														}
													}
													else 
													{
														print_r($salesreturn->getErrors());die;
													}
											
												
												}
												else 
												{
													print_r($Stock_brand->getErrors());die;
												}
											}
											else 
											{
												print_r($overallstock_updated->getErrors());die;
											}	
									
								}
								
								
							}
					}
					else 
					{
						print_r($sales->getErrors());die;
					}
				}
				else 
				{
					print_r($sale_details->getErrors());die;
				}			
			}
		}
		}
	
		
	public function actionDelete($id) {
		$this -> findModel($id) -> delete();

		return $this -> redirect(['index']);
	}

	public function actionSearch() {

		$searchModel = new PatientSearch();
		$datatables = array();
		$patientno = Yii::$app -> request -> post('patientmobileno');
		$mrno = Yii::$app -> request -> post('mrno');
		$patient_name = Yii::$app -> request -> post('patient_name');
		$patienttype = Yii::$app -> request -> post('patienttype');
		if($patientno!="" || $mrno!="" || $patient_name!="")
		{
			 $dataProvider = $searchModel -> search1(Yii::$app -> request -> queryParams, $patientno, $mrno, $patient_name);
			$datatables = $dataProvider -> getModels();
		}
		else{
			$datatables="";
		}
	    
			
		    if($datatables)
			{
				foreach($datatables as $value)
			{
				$pid=$value['patient_id'];
			}
				 
				
		
			}
			else {
				     $pid="";
				
			}
			
	 	 
			
		
		
		$companylist = ArrayHelper::map(CompanyBranch::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'branch_id', 'branch_name');
		$rows = Stockmaster::find() -> where(['is_active' => 1]) -> all();
		
		$brandlist=ArrayHelper::map(Productgrouping::find()-> where(['is_active' => 1]) -> asArray() -> all(), 'productgroupid', 'brandcode');
		 $pmodel = new Patient();
			$patientmax = Patient::find() -> max('patient_id');
			$patientmax = $patientmax + 1;
			$physicianlist=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
			$companylist = ArrayHelper::map(CompanyBranch::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'branch_id', 'branch_name');
		$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
		$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		$stockcodelist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'stock_code');
		 $smodel = new Stockmaster();
	    $session = Yii::$app->session;
		$userid=$session['user_id'];
        $userdata=BranchAdmin::find()->where(['ba_autoid'=>$userid])->one();
        $companybranchid=$userdata->ba_branchid;
		
		
		 $searchModel = new StockresponseSearch();
        $dataProvider = $searchModel->customstocksearch(Yii::$app->request->queryParams,$insuranceid);
	   $branchlist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
	    $productgrouplist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'brandcode');
		$insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
		$physicianlist=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
		
		echo $this->renderAjax('wizardform', [
              
                'pid'=>$pid,
                 'companylist'=>$companylist,
                'physicianlist'=> $physicianlist,
                'patienttype'=>$patienttype,
                 'brandlist'=>$brandlist,
                 'searchModel' => $searchModel,
                 'dataProvider' => $dataProvider, 'smodel' => $smodel, 'vendorlist' => $vendorlist, 'productlist'=>$productlist,'branchlist'=>$branchlist,
                 'productgrouplist'=>$productgrouplist,'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,'unitlist'=>$unitlist,
                 'stockcodelist'=>$stockcodelist,'pmodel'=>$pmodel,'patientmax'=>$patientmax,
            'companylist'=>$companylist,'physicianlist'=>$physicianlist,'insurancelist'=>$insurancelist,
            ]);
		 
		
			
		

	}

	public function actionPatientdetails($id) {
		$model = new Sales();
		$patient_details1 = Patient::find() -> where(['patient_id' => $id]) -> one();
		$companylist = ArrayHelper::map(CompanyBranch::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'branch_id', 'branch_name');
		$rows = Stockmaster::find() -> where(['is_active' => 1]) -> all();
		
		$brandlist=ArrayHelper::map(Productgrouping::find()-> where(['is_active' => 1]) -> asArray() -> all(), 'productgroupid', 'brandcode');
		 $pmodel = new Patient();
			$patientmax = Patient::find() -> max('patient_id');
			$patientmax = $patientmax + 1;
			$physicianlist=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
			$patient_type = ArrayHelper::map(Patienttype::find() -> asArray() -> all(), 'patient_typeid', 'patient_typename');
			$companylist = ArrayHelper::map(CompanyBranch::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'branch_id', 'branch_name');
		$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
		$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		$stockcodelist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'stock_code');
		 $smodel = new Stockmaster();
	    $session = Yii::$app->session;
		$userid=$session['user_id'];
        $userdata=BranchAdmin::find()->where(['ba_autoid'=>$userid])->one();
        $companybranchid=$userdata->ba_branchid;
		
		 $insuranceid=$patient_details1->insurance_type;
		 $searchModel = new StockresponseSearch();
        $dataProvider = $searchModel->customstocksearch(Yii::$app->request->queryParams,$insuranceid);
	   $branchlist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
	    $productgrouplist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'brandcode');
		$insurancelist=ArrayHelper::map(Insurance::find()->where(['is_active'=>1])->asArray()->all(), 'insurance_typeid', 'insurance_type');
		$physicianlist=ArrayHelper::map(Physicianmaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'physician_name');
		
		echo $this->renderAjax('wizardform', [
                'model' => $model,
                 'patient_details1'=>$patient_details1,
                 'companylist'=>$companylist,
                'physicianlist'=> $physicianlist,
                
                 'brandlist'=>$brandlist,
                 'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'smodel' => $smodel, 'vendorlist' => $vendorlist, 'productlist'=>$productlist,'branchlist'=>$branchlist,
             'productgrouplist'=>$productgrouplist,'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,'unitlist'=>$unitlist,
             'stockcodelist'=>$stockcodelist,'pmodel'=>$pmodel,'patient_type'=>$patient_type,'patientmax'=>$patientmax,
            'companylist'=>$companylist,'physicianlist'=>$physicianlist,'insurancelist'=>$insurancelist,
            ]);


	}

	/*public function actionSavesales() {
		
		$model = new Sales();
		if (Yii::$app -> request -> post()) 
		{
			
			$mrnumber=trim(Yii::$app -> request -> post('Patient')['medicalrecord_number']);
			$patientdata=Patient::find()->where(['medicalrecord_number'=>$mrnumber])->one();
			$patienttype=Yii::$app -> request -> post('patienttype');
			$firstname=Yii::$app -> request -> post('Patient')['firstname'];	
			$lastname=Yii::$app -> request -> post('Patient')['lastname'];	
		    $dob=date("Y-m-d",strtotime(Yii::$app -> request -> post('Patient')['dob']));	
			$age=Yii::$app -> request -> post('Patient')['age'];	
			$address=Yii::$app -> request -> post('Patient')['address'];	
			$gender=Yii::$app -> request -> post('Patient')['gender'];	
			$emailid=Yii::$app -> request -> post('Patient')['emailid'];	
			$mobilenumber=Yii::$app -> request -> post('Patient')['patient_mobilenumber'];	
			$guardianname=Yii::$app -> request -> post('Patient')['guardianname'];	
			$guardianmobilenumber=Yii::$app -> request -> post('Patient')['guardian_mobilenumber'];	
			$physicianname=Yii::$app -> request -> post('Patient')['physicianname'];	
		    $insurancetype=Yii::$app -> request -> post('Patient')['insurance_type'];	
			$ref=Yii::$app -> request -> post('Patient')['reference_number'];	
			$notes=Yii::$app -> request -> post('Patient')['notes'];	
			
			
			
			if($patientdata)
			{
			if($patienttype!=""){$patientdata->patient_type=$patienttype;}
			    else{$patientdata->patient_type="";}
				
				if($firstname!=""){$patientdata->firstname=$firstname;}
			    else{$patientdata->firstname="";}
				
				if($lastname!=""){$patientdata->lastname=$lastname;}
			    else{$patientdata->lastname="";}
				
				if($dob!=""){$patientdata->dob=$dob;}
			    else{$patientdata->dob="";}
				
				if($age!=""){$patientdata->age=$age;}
			    else{$patientdata->age="";}
				
				
				
				if($address!=""){$patientdata->address=$address;}
			    else{$patientdata->address="";}
				
				if($gender!=""){$patientdata->gender=$gender;}
			    else{$patientdata->gender="";}
				
				 if($emailid!=""){$patientdata->emailid=$emailid;}
				 else{$patientdata->emailid="";}
				 
				  if($guardianname!=""){$patientdata->guardian_name=$guardianname;}
				 else{$patientdata->guardian_name="";}
				 
				 
				  if($guardianmobilenumber!=""){$patientdata->guardian_mobilenumber=$guardianmobilenumber;}
				  else{$patientdata->guardian_mobilenumber="";}
				  
				  
				  if($physicianname!=""){$patientdata->physicianname=$physicianname;}
				   else{$patientdata->physicianname="";}
				   
				 if($insurancetype!=""){$patientdata->insurance_type=$insurancetype;}
				 else{$patientdata->insurance_type="";}
			  
				   if($refno!=""){$patientdata->reference_number=$refno;}
				   else{$patientdata->reference_number="";}
				   
				    if($notes!=""){$patientdata->notes=$notes;}
				   else{$patientdata->notes="";}
				    $patientdata->is_active=1;
				   $session = Yii::$app->session;
				    $patientdata->updated_by=$session['user_id'];
				 
				 $patientdata->updated_on=date("Y-m-d h:i:s");
				 $patientdata->updated_ipaddress=$_SERVER['REMOTE_ADDR'];	
				
				
			}
			
			else 
			{
				
				$patientdata=new Patient();
				
				if($patienttype!=""){$patientdata->patient_type=$patienttype;}
			    else{$patientdata->patient_type="";}
				
				if($firstname!=""){$patientdata->firstname=$firstname;}
			    else{$patientdata->firstname="";}
				
				if($lastname!=""){$patientdata->lastname=$lastname;}
			    else{$patientdata->lastname="";}
				
				if($dob!=""){$patientdata->dob=$dob;}
			    else{$patientdata->dob="";}
				
				if($age!=""){$patientdata->age=$age;}
			    else{$patientdata->age="";}
				
				if($mrnumber!=""){$patientdata->medicalrecord_number=$mrnumber;}
			    else{$patientdata->medicalrecord_number="";}
				
				if($address!=""){$patientdata->address=$address;}
			    else{$patientdata->address="";}
				
				if($gender!=""){$patientdata->gender=$gender;}
			    else{$patientdata->gender="";}
				
				 if($emailid!=""){$patientdata->emailid=$emailid;}
				 else{$patientdata->emailid="";}
				 
				 
				  if($mobilenumber!=""){$patientdata->patient_mobilenumber=$mobilenumber;}
				 else{$patientdata->patient_mobilenumber="";}
				 
				 
				  if($guardianname!=""){$patientdata->guardian_name=$guardianname;}
				 else{$patientdata->guardian_name="";}
				 
				 
				  if($guardianmobilenumber!=""){$patientdata->guardian_mobilenumber=$guardianmobilenumber;}
				  else{$patientdata->guardian_mobilenumber="";}
				  
				  
				  if($physicianname!=""){$patientdata->physicianname=$physicianname;}
				   else{$patientdata->physicianname="";}
				   
				 if($insurancetype!=""){$patientdata->insurance_type=$insurancetype;}
				 else{$patientdata->insurance_type="";}
			  
				   if($refno!=""){$patientdata->reference_number=$refno;}
				   else{$patientdata->reference_number="";}
				   
				    if($notes!=""){$patientdata->notes=$notes;}
				   else{$patientdata->notes="";}
				    $patientdata->is_active=1;
				   $session = Yii::$app->session;
				    $patientdata->updated_by=$session['user_id'];
				 
				 $patientdata->updated_on=date("Y-m-d h:i:s");
				 $patientdata->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
				 
				 
				 
				 
				 
			}
	    if($patientdata->save())
		{
			
		}
		else{
				print_r($patientdata->getErrors());die;
		}
	
		
		$session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
		$saledata=Sales::find()->where(['paid_status'=>'UnPaid'])->andwhere(['branch_id'=>$companybranchid])->all();
		
	    $brandcode=$_POST['brandcode'];
		
		
		
		foreach ($brandcode as $key => $value) {
        $stockresponseid=Yii::$app -> request -> post('stockresponseid')[$key];
		$saleunits=Yii::$app -> request -> post('totalunits')[$key];
		$overallstock=Stockresponse::find()->where(['stockresponseid'=>$stockresponseid])->one();
		$overallquantity=$overallstock->total_no_of_quantity;
		foreach($saledata as $k)
										{
										  $saleid=$k->opsaleid;
											$saledetaildata=Saledetail::find()->where(['opsaleid'=>$saleid])->andwhere(['stockresponseid'=>$stockresponseid])->all();
											foreach($saledetaildata as $l)
											{
											$currentqty+=$l->productqty;	
										    }
										}
										$availableqty[]=$overallquantity-$currentqty-$saleunits; 
				        }				
				
				foreach($availableqty as $checkqty)
				{
					if($checkqty>=0)
					{
						$status=1;
					}
					else{
						
						$status=0;
					}
					
				}
				
				if($status)
				{
				
				
			$model -> name = $patientdata->firstname.' '.$patientdata->lastname;
			$model -> mrnumber = $patientdata->medicalrecord_number;
			$pdata=Patient::find()->where(['medicalrecord_number'=>$model->mrnumber])->one();
			$model -> emailid = $patientdata->emailid;
			$model -> gender = Yii::$app -> request -> post('Patient')['gender'];
			$model -> phonenumber = trim(Yii::$app -> request -> post('Patient')['patient_mobilenumber']);
			$saledatainc=	Sales::find()->orderBy(['opsaleid' => SORT_DESC])->one();
			$saleincrement=$saledatainc->saleincrement+1;
			$ptype=Yii::$app -> request -> post('patienttype');
			if($ptype==1)
			{
				$billformat = "P/INV/IP/" . date("Y") . "/" . date("m") . "/" . ($saleincrement);
			}
			else{
				$billformat = "P/INV/OP/" . date("Y") . "/" . date("m") . "/" . ($saleincrement);
			}
		    
			$model->saleincrement=$saleincrement;
			$model -> billnumber = $billformat;
			$model -> branch_id = Yii::$app -> request -> post('branch_id');
			$dob = Yii::$app -> request -> post('Patient')['dob'];
			$model -> dob = date("Y-m-d H:i:s", strtotime($dob));
			$model -> invoicedate =  date("Y-m-d h:i:s");
			$model -> total = Yii::$app -> request -> post('totalprice');
			$model -> patienttype = $ptype;
			$model -> insurancetype = $insurancetype;
			$brandcode=$_POST['brandcode'];
			$totaldiscountvalue=0;$totalgstvalue=0;$totaltaxableamount=0;
				foreach ($brandcode as $key => $value) {
					$totaldiscountvalue+= Yii::$app -> request -> post('discount_value')[$key];
				    $totalgstvalue+= Yii::$app -> request -> post('gst_value')[$key];
					$totaltaxableamount+= Yii::$app -> request -> post('taxableamountep')[$key];
				}
			$model->totalgstvalue=$totalgstvalue;
			$model->totalcgstvalue=$totalgstvalue/2;
			$model->totalsgstvalue=$totalgstvalue/2;
			$model->totaldiscountvalue=$totaldiscountvalue;
			$model -> updated_by = $session['user_id'];
			$model -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			$model -> updated_on = date("Y-m-d H:i:s");
			$model->paid_status="UnPaid";
			$model->overalldiscounttype=Yii::$app -> request -> post('overalldiscounttypeep');
			$model->overalldiscountpercent=Yii::$app -> request -> post('overalldiscountep');
			$model->overalldiscountamount=Yii::$app -> request -> post('overalldiscountamountep');
			$model->overalltotal=Yii::$app -> request -> post('overalltotalep');
			$model->totaltaxableamount=$totaltaxableamount;
			if ($model -> save())
			 {
				$saleid = $model -> opsaleid;
				$i = 1;
				$brandcode=$_POST['brandcode'];
			
				foreach ($brandcode as $key => $value) {
					$model1 = new Saledetail();
					$model1 -> opsaleid = $saleid;
					$model1 -> saledate = date('Y-m-d h:i:s');
					$model1 -> productid =  Yii::$app -> request -> post('productid')[$key];
					$model1 -> batchnumber =  Yii::$app -> request -> post('batchnumber')[$key];
					$model1 -> brandcode =  Yii::$app -> request -> post('brandcode')[$key];
					$model1 -> stock_code =  Yii::$app -> request -> post('stock_code')[$key];
					$model1 -> compositionid = Yii::$app -> request -> post('compositionid')[$key];
					$model1 -> unitid = Yii::$app -> request -> post('unitid')[$key];
					$productqty = Yii::$app -> request -> post('totalunits')[$key];
					$model1 -> productqty = $productqty;
					$priceperqty = Yii::$app -> request -> post('priceperqty')[$key];
					$model1 -> priceperqty = $priceperqty;
					$gstrate = Yii::$app -> request -> post('gst')[$key];
					$model1 -> gstrate=$gstrate;
					$discountrate = Yii::$app -> request -> post('discount')[$key];
					$model1 -> discountrate=$discountrate;
					$model1->gstvalueperquantity=($priceperqty * $gstrate)/100;
					$model1->discountvalueperquantity=($priceperqty * $discountrate)/100;
					$model1 -> price =  number_format(Yii::$app -> request -> post('price')[$key],2);
					$model1 -> expiredate =  date("Y-m-d",strtotime(Yii::$app -> request -> post('expiredate')[$key]));
					$model1 -> is_active = 1;
					$model1 -> updated_by = $session['user_id'];
					$model1 -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
					$model1 -> updated_on = date("Y-m-d H:i:s");
					$model1->gstvalue=number_format(Yii::$app -> request -> post('gst_value')[$key],2);
					$model1->cgstvalue=$model1->gstvalue/2;
					$model1->sgstvalue=$model1->gstvalue/2;
					$model1->discountvalue=number_format(Yii::$app -> request -> post('discount_value')[$key],2);
					$increment=Yii::$app -> request -> post('dataincrement')[$key];
					$model1->discount_type=Yii::$app -> request -> post('discounttype'.$increment);
					$model1->stockid=Yii::$app -> request -> post('stockid')[$key];
					$model1->stockresponseid=Yii::$app -> request -> post('stockresponseid')[$key];
					$model1->taxableamount=number_format(Yii::$app -> request ->post('taxableamountep')[$key],2);
					$model1->mrpperunit=number_format(Yii::$app -> request ->post('realmrp_ep')[$key],2);
					$model1 -> save();
					$i++;
					
					
				}
				echo "Y=".$saleid;
			}

         }

         else
		 	{
		 		return "A";
		 	}

		}

	}*/

	public function actionGetproduct($id)
	 {

		$rows = Stockmaster::find() -> where(['vendorid' => $id]) -> andwhere(['is_active' => 1]) -> all();
		if (count($rows) > 0) {
			foreach ($rows as $row) {
				$rows1 = Product::find() -> where(['productid' => $row -> productid]) -> one();
				if ($rows1 -> productid != "") {
					echo "<option value='$rows1->productid'>$rows1->productname</option>";
				}

			}
		} else {
			echo "<option>Product Not Available for this Vendor.</option>";
		}
	}

	public function actionProductdetails() {
		$model = new Saledetail();
		$unitlist = ArrayHelper::map(Unit::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'unitid', 'unitvalue');
		$brandcode=Yii::$app -> request -> post('Stockrequest')['brandcode'];
		
		$branch =Yii::$app -> request -> post('Stockrequest')['branch_id'];
		 $form = ActiveForm::begin(['id'=>'sales-form']);
		if ($brandcode != "") {
			/* echo $this->renderAjax('productdetail', [
                'model' => $model,
                 'product'=>$product,
                 'branch'=>$branch,
                 'unitlist'=>$unitlist,
            ]);*/
          
			echo '<table id="datatable-buttons" class="table table-striped table-bordered">
             <thead>
             <tr>
             <th>S.No</th>
             <th>Product</th>
             <th>Composition</th>
             <th>Brandcode</th>
              <th>Stockcode</th>
             <th>Unit</th>
             <th>Quantity</th>
             <th>Price/Qty</th>
             <th>Price</th>
             </tr>
             </thead>
             <tbody>';

			$i = 1;
			$vendor_name = "";
			$product_name = "";
			$rows = "";
		
			foreach ($brandcode as $key => $value) {
				
				$branddata = Productgrouping::find() -> where(['productgroupid'=>$value]) -> one();
				
				if($branddata)
				{
					$pid=$branddata->productid;
					$product_name = Product::find() -> where(['productid' => $pid]) -> one();
				}
				
				$composition = Composition::find() -> where(['composition_id' => $product_name -> composition_id]) -> one();
				$unitlist = Unit::find() -> where(['unitid' => $product_name -> unit]) -> one();
				$rows = Stockmaster::find() -> where(['productid' => $pid]) -> andwhere(['branch_id' => $branch]) -> andwhere(['is_active' => 1]) -> one();
            ?>
			<tr>
  <td><?php echo $i;?></td>
  <td><?php echo $product_name ->productname;echo $form -> field($model, 'productid[]')->hiddenInput(['value'=>$pid])->label(false);?></td>
  <td><?php echo $composition -> composition_name;echo $form -> field($model, 'compositionid[]') -> hiddenInput(['value' => $composition -> composition_id]) -> label(false);?></td>
    <td><?php echo $branddata->brandcode;echo $form -> field($model, 'brandcode[]')->hiddenInput(['value'=>$branddata->brandcode])->label(false);?></td>
      <td><?php echo $branddata->stock_code;echo $form -> field($model, 'stock_code[]')->hiddenInput(['value'=>$branddata->stock_code])->label(false);?></td>
  <td><?php echo $unitlist -> unitvalue; echo $form -> field($model, 'unitid[]') -> hiddenInput(['value' => $unitlist -> unitid]) -> label(false);?></td>
  
  <td><?php echo $form -> field($model, 'productqty[]') -> textInput([
  'id' => 'productqty' . $i, 
  'name' => 'productqty' . $i, 
  'class' => 'form-control productqty', 
  'required' => true, 
  'placeholder' => 'Quantity', 
  'datacls' => 'calcprice' . $i, 
  'dataprice' => $rows -> priceperqty]) -> label(false);?></td>
  
  <td>Rs.<?php echo $rows -> priceperqty;echo $form -> field($model, 'priceperqty[]') -> hiddenInput([
  'id' => 'priceperqty' . $i, 
  'name' => 'priceperqty' . $i,
  'value' => $rows -> priceperqty]) -> label(false);?></td>
  
  <td><?php echo $form -> field($model, 'price[]') -> textInput([
  'id' => 'calcprice' . $i . '1', 
  'class' => 'form-control pricez',
  'style'=>"text-align:right;",
  'readonly'=>true,]) -> label(false);?></td>
    </tr>
    <?php
				$i++;

			} 
echo '
<td style="text-align:right;">Total</td>
<td style="text-align:right;"><span id="total">Rs.0</span><input type="hidden" id="totalprice" name="totalprice" /></td></tbody>
		 </table>
        </div>';
			ActiveForm::end();
		}
	}
	public function actionProductdetails1() {

		$model = new Saledetail();
		$unitlist = ArrayHelper::map(Unit::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'unitid', 'unitvalue');
		$brandcode=Yii::$app -> request -> post('Stockrequest')['brandcode'];
		$branch =Yii::$app -> request -> post('Stockrequest')['branch_id'];
		//echo $brandcode;die;
		 $form = ActiveForm::begin(['id'=>'sales-form']);
		if ($brandcode != "") {
			/*echo $this->renderAjax('productdetail1', [
                'model' => $model,
                 'product'=>$product,
                 'branch'=>$branch,
                 'unitlist'=>$unitlist,
            ]);*/
          
			echo '<table id="datatable-buttons" class="table table-striped table-bordered">
             <thead>
             <tr>
             <th>S.No</th>
             <th>Product</th>
             <th>Composition</th>
             <th>Brandcode</th>
              <th>Stockcode</th>
             <th>Unit</th>
             <th>Quantity</th>
             <th>Price/Qty</th>
             <th>Price</th>
             </tr>
             </thead>
             <tbody>';

			$i = 1;
			$vendor_name = "";
			$product_name = "";
			$rows = "";
		
			foreach ($brandcode as $key => $value) {
				
				$branddata = Productgrouping::find() -> where(['productgroupid'=>$value]) -> one();
				
				if($branddata)
				{
					$pid=$branddata->productid;
					$product_name = Product::find() -> where(['productid' => $pid]) -> one();
				}
				$composition = Composition::find() -> where(['composition_id' => $product_name -> composition_id]) -> one();
				$unitlist = Unit::find() -> where(['unitid' => $product_name -> unit]) -> one();
				$rows = Stockmaster::find() -> where(['productid' => $pid]) -> andwhere(['branch_id' => $branch]) -> andwhere(['is_active' => 1]) -> one();
            ?>
			<tr>
  <td><?php echo $i;?></td>
  <td><?php echo $product_name ->productname;echo $form -> field($model, 'productid[]')->hiddenInput(['value'=>$pid])->label(false);?></td>
  <td><?php echo $composition -> composition_name;echo $form -> field($model, 'compositionid[]') -> hiddenInput(['value' => $composition -> composition_id]) -> label(false);?></td>
    <td><?php echo $branddata->brandcode;echo $form -> field($model, 'brandcode[]')->hiddenInput(['value'=>$branddata->brandcode])->label(false);?></td>
      <td><?php echo $branddata->stock_code;echo $form -> field($model, 'stock_code[]')->hiddenInput(['value'=>$branddata->stock_code])->label(false);?></td>
  <td><?php echo $unitlist -> unitvalue; echo $form -> field($model, 'unitid[]') -> hiddenInput(['value' => $unitlist -> unitid]) -> label(false);?></td>
  <td><?php echo $form -> field($model, 'productqty[]') -> textInput(['id' => 'productqty' . $i, 'name' => 'productqty' . $i, 'class' => 'form-control productqty1', 'required' => true, 'placeholder' => 'Quantity', 'datacls1' => 'calcpricz' . $i, 'dataprice1' => $rows -> priceperqty]) -> label(false);?></td>
  <td>Rs.<?php echo $rows -> priceperqty;echo $form -> field($model, 'priceperqty[]') -> hiddenInput(['id' => 'priceperqty' . $i, 'name' => 'priceperqty' . $i,'value' => $rows -> priceperqty]) -> label(false);?></td>
  <td><?php echo $form -> field($model, 'price[]') -> textInput(['id' => 'calcpricz' . $i . '1', 'class' => 'form-control pricez1','style'=>"text-align:right;",'readonly'=>true,]) -> label(false);?></td>
    </tr>
    <?php
				$i++;

			} 
echo '
<td style="text-align:right;">Total</td>
<td style="text-align:right;"><span id="total1">Rs.0</span><input type="hidden" id="totalprice1" name="totalprice" /></td></tbody>
		 </table>';
		 ActiveForm::end();
			
		}
	}

	public function actionProductdetail_np($id,$price,$branch_id,$ptype,$autonumber) 
	{

		$model = new Saledetail();
		$unitlist = ArrayHelper::map(Unit::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'unitid', 'unitvalue');
		if ($id != "") {
			echo $this->renderAjax('productdetail_np', 
			[
                 'model' => $model,
                 'product'=>$product,
                 'unitlist'=>$unitlist,
                 'branch_id'=>$branch_id,
                 'stockresponseid'=>$id,
                 'price'=>$price,
                 'autonumber'=>$autonumber,
                 'ptype'=>$ptype,
            ]);
		}
	}
	
	
		public function actionProductdetail_countersale($id,$price,$branch_id,$autonumber) {

		$model = new Saledetail();
		$unitlist = ArrayHelper::map(Unit::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'unitid', 'unitvalue');
	    if ($id != "") {
			echo $this->renderAjax('productdetail_countersale', [
                'model' => $model,
                 'product'=>$product,
                 'unitlist'=>$unitlist,
                 'branch_id'=>$branch_id,
                 'stockresponseid'=>$id,
                 'price'=>$price,
                 'autonumber'=>$autonumber,
            ]);
		}
	}
	
	public function actionProductdetail_ep($id,$branch_id,$ptype,$autonumber)
	 {

		$model = new Saledetail();
		$unitlist = ArrayHelper::map(Unit::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'unitid', 'unitvalue');
		//print_r($unitlist);die;
		$branch =$price;
		if ($id != "") {
			echo $this->renderAjax('productdetail_ep', [
                 'model' => $model,
                 'product'=>$product,
                 'branch'=>$branch,
                 'unitlist'=>$unitlist,
                 'branch_id'=>$branch_id,
                 'stockresponseid'=>$id,
                 'autonumber'=>$autonumber,
                 'ptype'=>$ptype,
            ]);
		}
	}
	
	
	
	public function actionProductdetail_epsaledetail($id,$price,$branch_id,$ptype,$autonumber) {

		$model = new Saledetail();
		$unitlist = ArrayHelper::map(Unit::find() -> where(['is_active' => 1]) -> asArray() -> all(), 'unitid', 'unitvalue');
		$branch =$price;
		if ($id != "") {
			echo $this->renderAjax('productdetail_epsaledetail', [
                'model' => $model,
                 'product'=>$product,
                 'branch'=>$branch,
                 'unitlist'=>$unitlist,
                 'branch_id'=>$branch_id,
                 'stockresponseid'=>$id,
                 'price'=>$price,
                 'autonumber'=>$autonumber,
                 'ptype'=>$ptype,
            ]);
		}
	}
	
	
	

	public function actionSavedetails() {
		//echo"<pre>";
		//print_r(Yii::$app -> request -> post());die;
		$searchModel = new StockmasterSearch();
		$datatables = array();
		$patientno = Yii::$app -> request -> post('brandcode');
	    $dataProvider = $searchModel -> search(Yii::$app -> request -> queryParams);
		$datatables = $dataProvider -> getModels();
		return $this->renderAjax('newpatient', ['datatables'=>$datatables ]);
		
	
	}
	/*public function actionAddpatient() {
		
		$model = new Patient();
		$salemodel=new Sales();
		
	

		if ($model -> load(Yii::$app -> request -> post())) {
			$model -> is_active = 1;
			$dob = Yii::$app -> request -> post('Patient')['dob'];
			$model -> dob = date("Y-m-d", strtotime($dob));
			$session = Yii::$app -> session;
			$model -> medicalrecord_number = Patient::find()->max('patient_id')+1;
			$model -> updated_by = $session['user_id'];
			$model -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			$model -> updated_on = date("Y-m-d H:i:s");
			$model -> age = date("Y") - date("Y", strtotime($dob));
			$model -> firstname = trim(ucwords(Yii::$app -> request -> post('Patient')['firstname']));
			$model -> lastname = trim(ucwords(Yii::$app -> request -> post('Patient')['lastname']));
			$model -> address = trim(ucwords(Yii::$app -> request -> post('Patient')['address']));
			$model -> emailid = trim(strtolower(Yii::$app -> request -> post('Patient')['emailid']));
			$model -> patient_mobilenumber = trim(Yii::$app -> request -> post('Patient')['patient_mobilenumber']);
			$model -> guardian_name = trim(ucwords(Yii::$app -> request -> post('Patient')['guardian_name']));
			$model -> guardian_mobilenumber = trim(Yii::$app -> request -> post('Patient')['guardian_mobilenumber']);
			$physician = trim(ucwords(Yii::$app -> request -> post('Patient')['physicianname']));
			 if($physician!='') {
			 	
			 	$physiciancol = Physicianmaster::find()->where(['id'=>$physician])->one();
				
					 $physiciantitle = $physiciancol->physician_name;
				
				
			 }
			$model -> physicianname = $physiciantitle;
			$model -> notes = trim(ucwords(Yii::$app -> request -> post('Patient')['notes']));
			
			$model -> gender = Yii::$app -> request -> post('Patient')['gender'];
			$model -> patient_type = Yii::$app -> request -> post('Patient')['patient_type'];
			$model -> insurance_type = Yii::$app -> request -> post('Patient')['insurance_type'];
			if($model->patient_type==1)
			{
				$ptype="IP";
			}
			else{
				$ptype="OP";
			}
			
			//sale model 
			
			
		
			
			if ($model -> save()) {
				echo "hai";die;
				$salemodel -> name = $model->firstname. " ".$model->lastname;
			$salemodel -> mrnumber = $model -> medicalrecord_number;
		
			$salemodel -> emailid = $model -> emailid;
			$salemodel -> gender = $model -> gender;
			$salemodel -> phonenumber = $model -> patient_mobilenumber;
			$saleid_max = Sales::find() -> max('opsaleid');
		    $billformat = "P/INV/" . $ptype . "/" . date("Y") . "/" . date("m") . "/" . ($saleid_max + 1);
			$salemodel -> billnumber = $billformat;
			$branchid = trim(Yii::$app -> request -> post('Stockrequest')['branch_id']);
			$salemodel -> branch_id = $branchid;
			$salemodel -> dob = $model -> dob;
			$salemodel -> physicianname =$model -> physicianname;
			$salemodel -> invoicedate = date("Y-m-d");
			$salemodel -> total = Yii::$app -> request -> post('totalprice');
			$salemodel -> updated_by = $session['user_id'];
			$salemodel -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			$salemodel -> updated_on = date("Y-m-d H:i:s");
			
				
				
							if($salemodel->save())
							{
								
				$saleid = $salemodel -> opsaleid;
				$i = 1;
				$productid=Yii::$app -> request -> post('Saledetail')['productid'];
				foreach ($productid as $key => $value) {
					
					$model1 = new Saledetail();
					$model1 -> opsaleid = $saleid;
					$model1 -> saledate = date('Y-m-d');
					$model1 -> productid = $value;
					
					$model1 -> brandcode =  Yii::$app -> request -> post('Saledetail')['brandcode'][$key];
					$model1 -> stock_code =  Yii::$app -> request -> post('Saledetail')['stock_code'][$key];
					$model1 -> compositionid = Yii::$app -> request -> post('Saledetail')['compositionid'][$key];
					$model1 -> unitid = Yii::$app -> request -> post('Saledetail')['unitid'][$key];
					$productqty = Yii::$app -> request -> post('productqty-' . $i);
					$model1 -> productqty = $productqty;
					$model1 -> price = Yii::$app -> request -> post('price-' . $i);
					$priceperqty = Yii::$app -> request -> post('priceperqty-' . $i);
					$model1 -> priceperqty = $priceperqty;
					$model1 -> is_active = 1;
					$model1 -> updated_by = $session['user_id'];
					$model1 -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
					$model1 -> updated_on = date("Y-m-d H:i:s");
					if ($model1 -> save()) {

						$stockmodel = Stockmaster::find() -> where(['productid' => $value]) -> andwhere(['branch_id' => $branchid]) -> one();
						$stockmodel -> quantity = $stockmodel -> quantity - $productqty;
						$stockmodel -> updated_on = date("Y-m-d H:i:s");
						$stockmodel -> save();
					}
					

					$i++;
				}

				echo "Y";
				
				}
                    
			} 
			
			
			else {
				

				if (count($model -> getErrors()) > 0) {
					Yii::$app -> getSession() -> setFlash('success', 'Patient Already Exists');
					return $this -> redirect(['create']);
				}

			}

		}

	}
	*/
	   public function actionAudit()
    {
    	
		
    	if($_POST){
    	
    	$Model = Stockmaster::find()->where(['stockid'=>$_POST['editableKey']])->one();
		if(count($Model)>0){
			//print_r($_POST);
			//die;
			$post = [];
			 $posted = current($_POST['Stockmaster']);
      $post['Stockmaster'] = $posted;
      if ($Model->load($post)) {
			
			
			$Model->save();
			 $output = '';
            
           $out = Json_encode(['output'=>$output, 'message'=>'']); 
           }
		      echo $out;
		      return;
			
		}
		
	}
	
	
	else{
		$vendorlist=ArrayHelper::map(Vendor::find()->where(['is_active'=>1])->asArray()->all(), 'vendorid', 'vendorname');
		$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
		$producttypelist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
		$compositionlist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
		$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		$stockcodelist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'stock_code');
		
		
		
		 $model = new Stockmaster();
        $searchModel = new StockmasterSearch();
       $dataProvider = $searchModel->auditsearch(Yii::$app->request->queryParams);
	   
	   
	   $branchlist=ArrayHelper::map(CompanyBranch::find()->where(['is_active'=>1])->asArray()->all(), 'branch_id', 'branch_name');
	    $productgrouplist=ArrayHelper::map(Productgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'productgroupid', 'brandcode');
        return $this->render('_form', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'model' => $model, 'vendorlist' => $vendorlist, 'productlist'=>$productlist,'branchlist'=>$branchlist,
             'productgrouplist'=>$productgrouplist,'producttypelist'=>$producttypelist,'compositionlist'=>$compositionlist,'unitlist'=>$unitlist,
             'stockcodelist'=>$stockcodelist,
           
           
            
           
        ]);
	}
    }
	
	
	
	
	/*public function actionPdfprint() {
		echo "sdfs";die;
		$model = new Patient();
		$salemodel=new Sales();

		if ($model -> load(Yii::$app -> request -> post())) {
			$model -> is_active = 1;
			$dob = Yii::$app -> request -> post('Patient')['dob'];
			$model -> dob = date("Y-m-d", strtotime($dob));
			$session = Yii::$app -> session;
			$model -> medicalrecord_number = Patient::find()->max('patient_id')+1;
			$model -> updated_by = $session['user_id'];
			$model -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			$model -> updated_on = date("Y-m-d H:i:s");
			$model -> age = date("Y") - date("Y", strtotime($dob));
			$model -> firstname = trim(ucwords(Yii::$app -> request -> post('Patient')['firstname']));
			$model -> lastname = trim(ucwords(Yii::$app -> request -> post('Patient')['lastname']));
			$model -> address = trim(ucwords(Yii::$app -> request -> post('Patient')['address']));
			$model -> emailid = trim(strtolower(Yii::$app -> request -> post('Patient')['emailid']));
			$model -> patient_mobilenumber = trim(Yii::$app -> request -> post('Patient')['patient_mobilenumber']);
			$model -> guardian_name = trim(ucwords(Yii::$app -> request -> post('Patient')['guardian_name']));
			$model -> guardian_mobilenumber = trim(Yii::$app -> request -> post('Patient')['guardian_mobilenumber']);
			$physician = trim(ucwords(Yii::$app -> request -> post('Patient')['physicianname']));
			 if($physician!='') {
			 	
			 	$physiciancol = Physicianmaster::find()->where(['id'=>$physician])->one();
				
					 $physiciantitle = $physiciancol->physician_name;
				
				
			 }
			$model -> physicianname = $physiciantitle;
			$model -> notes = trim(ucwords(Yii::$app -> request -> post('Patient')['notes']));
			
			$model -> gender = Yii::$app -> request -> post('Patient')['gender'];
			$model -> patient_type = Yii::$app -> request -> post('Patient')['patient_type'];
			$model -> insurance_type = Yii::$app -> request -> post('Patient')['insurance_type'];
			if($model->patient_type==1)
			{
				$ptype="IP";
			}
			else{
				$ptype="OP";
			}
			
			//sale model 
			
			
			
			
			if ($model -> save()) {
				$salemodel -> name = $model->firstname. " ".$model->lastname;
			$salemodel -> mrnumber = $model -> medicalrecord_number;
			
			$salemodel -> emailid = $model -> emailid;
			$salemodel -> gender = $model -> gender;
			$salemodel -> phonenumber = $model -> patient_mobilenumber;
			$saleid_max = Sales::find() -> max('opsaleid');
		    $billformat = "P/INV/" . $ptype . "/" . date("Y") . "/" . date("m") . "/" . ($saleid_max + 1);
			$salemodel -> billnumber = $billformat;
			$branchid = trim(Yii::$app -> request -> post('Stockrequest')['branch_id']);
			$salemodel -> branch_id = $branchid;
			$salemodel -> dob = $model -> dob;
			$salemodel -> physicianname =$model -> physicianname;
			$salemodel -> invoicedate = date("Y-m-d");
			$salemodel -> total = Yii::$app -> request -> post('totalprice');
			$salemodel -> updated_by = $session['user_id'];
			$salemodel -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
			$salemodel -> updated_on = date("Y-m-d H:i:s");
			
				
				
							if($salemodel->save())
							{
								
				$saleid = $salemodel -> opsaleid;
				$i = 1;
				$productid=Yii::$app -> request -> post('Saledetail')['productid'];
				foreach ($productid as $key => $value) {
					$product = Product::find() -> where(['productid' => $value]) -> one();
					$model1 = new Saledetail();
					$model1 -> opsaleid = $saleid;
					$model1 -> saledate = date('Y-m-d');
					$model1 -> productid = $value;
					$model1 -> stock_code = $product -> stock_code;
					$model1 -> compositionid = Yii::$app -> request -> post('Saledetail')['compositionid'][$key];
					$model1 -> unitid = Yii::$app -> request -> post('Saledetail')['unitid'][$key];
					$productqty = Yii::$app -> request -> post('productqty' . $i);
					$model1 -> productqty = $productqty;
					$model1 -> price = Yii::$app -> request -> post('Saledetail')['price'][$key];
					$priceperqty = Yii::$app -> request -> post('priceperqty' . $i);
					$model1 -> priceperqty = $priceperqty;
					$model1 -> is_active = 1;
					$model1 -> updated_by = $session['user_id'];
					$model1 -> updated_ipaddress = $_SERVER['REMOTE_ADDR'];
					$model1 -> updated_on = date("Y-m-d H:i:s");
					if ($model1 -> save()) {

						$stockmodel = Stockmaster::find() -> where(['productid' => $value]) -> andwhere(['branch_id' => $branchid]) -> one();
						$stockmodel -> quantity = $stockmodel -> quantity - $productqty;
						$stockmodel -> updated_on = date("Y-m-d H:i:s");
						$stockmodel -> save();
					}
					

					$i++;
				}

				echo "Y";
				
				}
                     else
					 	{
					 		print_r($salemodel->getErrors());
			                 die;
					 	}
			} 
			
			
			else {
				print_r($model->getErrors());
				die;

				if (count($model -> getErrors()) > 0) {
					Yii::$app -> getSession() -> setFlash('success', 'Patient Already Exists');
					return $this -> redirect(['create']);
				}

			}

		}

	}*/
	

	protected function findModel($id) {
		if (($model = Sales::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	 public function actionGetage($dob)
    {
		 $date1 =$dob;
         $date2 =date("Y-m-d");
         $diff = abs(strtotime($date2) - strtotime($date1));
         $years = floor($diff / (365*60*60*24));
         $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
         $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		 // return $years." years - ".$months." months "." - ".$days." days";
		  return $years;
	}
	
	
	
	
	
	public function actionInvoice($id) {
   			
   		require ('../../vendor/tcpdf/tcpdf.php');
	    $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->setFontSubsetting(true);
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->AddPage();

$saledata=Sales::find()->where(['opsaleid'=>$id])->one();
$saledetaildata=Saledetail::find()->where(['opsaleid'=>$id])->all();

$patientdata=Newpatient::find()->where(['mr_no'=>$saledata->mrnumber])->one();
$insurancetype=$patientdata->insurance_type_id;
$insurancedata=Insurance::find()->where(['insurance_typeid'=>$insurancetype])->one();
$insurance_type="";
if($insurancedata){
    $insurance_type = $insurancedata->insurance_type;
}
$unitlist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
$productlist=ArrayHelper::map(Product::find()->where(['is_active'=>1])->asArray()->all(), 'productid', 'productname');
$gender=$saledata->gender;
$drid=$saledata->physicianname;

$drdata=Physicianmaster::find()->where(['id'=>$drid])->one();
if($gender=="M"){$gen="Male";}else if($gender=="F"){$gen="Female";}else{$gen="Transgender";}

$session = Yii::$app->session;
$companybranchid=$session['branch_id'];
$companybranchdata=CompanyBranch::find()->where(['branch_id'=>$companybranchid])->one();
$companydata=Company::find()->where(['company_code'=>'C001'])->one();
$companyname=$companybranchdata->branch_name;
$address=$companybranchdata->address1;
$gstin=$companybranchdata->gst_number;



if (preg_match("/op/i", $saledata->billnumber)) {
   $pt="OP";
} else {
    $pt="IP";
}
$title="(A UNIT OF CARAMEL HEALTHCAREPVT LTD)";
$headertable='<table cellspacing="0" cellpadding="1" >';
$headertable.='<tr ><td style="text-align:center;font-size:18px;" colspan="12" ><b>'.strtoupper($companyname).'</b></td></tr>';
$headertable.='<tr ><td style="text-align:center;font-size:12px;" colspan="12" >'.$title.'</td></tr>';
$headertable.='<tr ><td style="text-align:center;font-size:12px;" colspan="12" ><p>'.strtoupper($address).'</p></td></tr>';
$headertable.='<tr><td colspan="3"><b>DL NO : '.$companydata->dln1.'</b></td><td colspan="3"><b>'.$companydata->dln2.'</b></td>
<td colspan="3"><b>'.$companydata->dln3.'</b></td><td colspan="3"><b>Gstin : '.$gstin.'</b></td></tr><tr><td></td></tr>';
if($saledata->patienttype==1)
{
	$pt="IP";
}

$headertable.='<tr ><td style="text-align:center;font-size:12px;" colspan="12" ><b>'.strtoupper($pt. " PHARMACY SALES").'</b></td></tr>';

$headertable.='</table>';
$pdf->writeHTML($headertable, true, false, false, false, '');

$tbl1 = '<table cellspacing="0" cellpadding="1"  border="1" style="text-align:center;">
 
   <tr><td colspan="10">
   <table>
     
   <tr>
   <td colspan="1" style="text-align:left;" >Bill No </td><td colspan="6" style="text-align:left;"> : '.$saledata->billnumber.'</td> 
   <td colspan="2" style="text-align:right;" >Bill Date : </td>  <td>'.date("d/m/Y",strtotime($saledata->invoicedate)).'</td>
   </tr>
    <tr>
   <td colspan="1" style="text-align:left;" >Patient Name </td><td colspan="6" style="text-align:left;"> : '.strtoupper($saledata->name).'</td> 
 <td colspan="2" style="text-align:right;" >Time: </td>  <td>'.date("h:i:s",strtotime($saledata->invoicedate)).'</td>
   </tr>
      <tr>
   <td colspan="1" style="text-align:left;" >MR Number</td><td colspan="6" style="text-align:left;"> : '.$saledata->mrnumber.'</td> 

   </tr>
      <tr>
   <td colspan="1" style="text-align:left;" >Dr Name :</td><td colspan="6" style="text-align:left;"> : '.strtoupper($saledata->physicianname).'</td> 

   </tr>
      <tr>
   <td colspan="1" style="text-align:left;" > Type </td><td colspan="6" style="text-align:left;"> : '.strtoupper($insurance_type).'</td> 

   </tr>
   <tr><td></td></tr>
   </table>
   </td>
     </tr>
<tr><td ><b>S.No</b></td><td style="width:100px;"><b>Item <br>Description</b></td><td width="50"><b>HSN Code</b></td><td width="50" ><b>Batch No</b></td><td width="60"><b>EXP</b></td><td width="30"><b>Qty</b></td>
<td width="30"><b>Mrp </b></td><td width="40"><b>Disc</b></td><td width="40"><b>Amount</b></td><td width="206">
<table>
<tr ><td colspan="2" style="border-bottom:1px solid #000;border-right:1px solid #000;"><b>CGST</b></td>
<td colspan="2" style="border-bottom:1px solid #000;border-right:1px solid #000;"><b>SGST</b></td>
<td colspan="2" style="border-bottom:1px solid #000;"><b>IGST</b></td>
</tr>
<tr><td style="font-size:10px;">Rate</td><td style="">Amt</td>
<td >Rate</td><td >Amt</td>
<td >Rate</td><td >Amt</td>
</tr>
</table>

</td>
</thead></tr>';

$i=0;
$totalrate=0;
$totaldiscount=0;
$totalgst=0;
$netrate=0;
$mrp=0;
$totalcgstrate=0;
$totalsgstrate=0;
$mrptotal=0;
$totalgstrate=0;
$totalgstvalue=0;
foreach($saledetaildata as $k)
{
$gstvalueperqty=$k->gstvalueperquantity;
$discountvalueperqty=$k->productqty*$k->discountvalueperquantity;
$mrpperunit=$gstvalueperqty+$k->priceperqty;
$gstvalue=$gstvalueperqty*$k->productqty;
$mrp=$mrpperunit*$k->productqty;
$unitid[]=$k->unitid;
$newunitdata=array_intersect_key($unitlist, array_flip($unitid));
$unitval=array_values($newunitdata);
$productid[]=$k->productid;
$newproductdata=array_intersect_key($productlist, array_flip($productid));
$productval=array_values($newproductdata);
$productdata=Product::find()->where(['productid'=>$k->productid])->one();
$hsncode=$productdata->hsn_code;
$pdata=Product::find()->where(['is_active'=>1])->andwhere(['productid'=>$k->productid])->one();
$ptypeid=$pdata->product_typeid;
$ptypedata=Producttype::find()->where(['is_active'=>1])->andwhere(['product_typeid'=>$ptypeid])->one();
$type=$ptypedata->product_type;
$mrptotal+=$mrp;
$tbl1.= '<tr>
	<td >'.++$i.'</td><td>'.$productval[0].'</td><td>'.$hsncode.'</td><td>'.$k->batchnumber.'</td><td>'.date("d-m-Y",strtotime($k->expiredate)).'</td><td>'.$k->productqty.'</td>
	<td align="center">'.number_format($k->mrpperunit,2).'</td><td align="center">'.number_format($k->discountvalue,2).'</td>
	<td align="center">'.number_format($k->priceperqty,2).'</td><td>
	<table>
<tr><td style="font-size:10px;">'.number_format($k->cgst_percent,2).'</td><td>'.number_format($k->cgstvalue,2).'</td>
<td >'.number_format($k->sgst_percent,2).'</td><td >'.number_format($k->sgstvalue,2).'</td>
<td >0</td><td >0</td>
</tr>
</table></td></tr>';
$hsncode="";
$totalrate+=number_format($k->price,2);
$totalgstrate+=($k->gstrate/2);
$totalgstvalue+=($gstvalue/2);
$totaldiscount+=$discountvalueperqty;
$totalgst+=$gstvalue;
$newunitdata=array(); $unitid=array();$unitval="";
$newproductdata=array(); $productid=array();$productval="";
$totalcgstrate+=$k->cgst_percent;
$totalsgstrate+=$k->sgst_percent;
} 
$tbl1.='<tr><td colspan="8" style="text-align:right;"> Total Amount  </td><td>'.number_format($saledata->total,2).'</td><td width="206">
<table>
<tr><td style="font-size:10px;">'.number_format($totalcgstrate,2).'</td><td style="">'.number_format($saledata->totalcgstvalue,2).'</td>
<td style="font-size:10px;">'.number_format($totalsgstrate,2).'</td><td style="">'.number_format($saledata->totalsgstvalue,2).'</td>
<td >0</td><td >0</td>
</tr>
</table>
</td>
</thead></tr></table>';
$pdf->writeHTML($tbl1, true, false, false, false, '');
$words='<table><tr><td colspan="16" align="left"><b>Amount in Words : </b> Rupees '.ucwords($this->actionReadnumber(round($saledata->total))).' only </td></tr></table>';
$pdf->writeHTML($words, true, false, false, false, '');
$pdf->Output('example_001.pdf');

    }

public  function actionReadnumber($num, $depth=0)
{
    $num = (int)$num;
    $retval ="";
    if ($num < 0) 
        return "negative " + $this->actionReadnumber(-$num, 0);
    if ($num > 99)
    {
        if ($num > 999) 
            $retval .= $this->actionReadnumber($num/1000, $depth+3);

        $num %= 1000; 
        if ($num > 99) 
            $retval .= $this->actionReadnumber($num/100, 2)." hundred \n";
        $retval .=$this->actionReadnumber($num%100, 1);                   
    }
    else 
    {
        $mod = floor($num / 10);
        if ($mod == 0) 
        {
            if ($num == 1) $retval.="one";
            else if ($num == 2) $retval.="two";
            else if ($num == 3) $retval.="three";
            else if ($num == 4) $retval.="four";
            else if ($num == 5) $retval.="five";
            else if ($num == 6) $retval.="six";
            else if ($num == 7) $retval.="seven";
            else if ($num == 8) $retval.="eight";
            else if ($num == 9) $retval.="nine";
        }
        else if ($mod == 1) 
        {
            if ($num == 10) $retval.="ten";
            else if ($num == 11) $retval.="eleven";
            else if ($num == 12) $retval.="twelve";
            else if ($num == 13) $retval.="thirteen";
            else if ($num == 14) $retval.="fourteen";
            else if ($num == 15) $retval.="fifteen";
            else if ($num == 16) $retval.="sixteen";
            else if ($num == 17) $retval.="seventeen";
            else if ($num == 18) $retval.="eighteen";
            else if ($num == 19) $retval.="nineteen";
        }
        else
        {
            if ($mod == 2) $retval.="twenty ";
            else if ($mod == 3) $retval.="thirty ";
            else if ($mod == 4) $retval.="forty ";
            else if ($mod == 5) $retval.="fifty ";
            else if ($mod == 6) $retval.="sixty ";
            else if ($mod == 7) $retval.="seventy ";
            else if ($mod == 8) $retval.="eighty ";
            else if ($mod == 9) $retval.="ninety ";
            if (($num % 10) != 0)
            {
                $retval = rtrim($retval); 
                $retval .= "-";
            }
            $retval.=$this->actionReadnumber($num % 10, 0);
        }
    }
    if ($num != 0)
    {
        if ($depth == 3)
            $retval.=" thousand\n";
        else if ($depth == 6)
            $retval.=" million\n";
        if ($depth == 9)
            $retval.=" billion\n";
    }
    return $retval;
}

	public function actionGetexistingusers($id) 
	{
		
	 $ot=array();
	 
	         $patientdata= Patient::find()->where(['medicalrecord_number'=>$id])->one();
			 if($patientdata)
			 {
			   $ot[0]=$patientdata->patient_mobilenumber;
			   $ot[1]=$patientdata->firstname;
			    return json_encode($ot);
			 	
			 }
			 else {
				  return "";
			 }
			 
	

	}
	
	public function actionGetexistingusersfrommobile($id) 
	{
		$ot=array();
	 	$patientdata= Patient::find()->where(['patient_mobilenumber'=>$id])->one();
		if($patientdata)
		{
			$ot[0]=$patientdata->medicalrecord_number;
			$ot[1]=$patientdata->firstname;
			return json_encode($ot);
		}
		else 
		{
			return "";
		}
	}
	
	
	public function actionPatientkey($id) 
	{
		$un_send_data1=Newpatient::find()->where(['LIKE','patientname',$id])->orWhere(['LIKE','pat_mobileno',$id])->orWhere(['LIKE','par_relationname',$id])->limit(10)->all();
		$in_qry=ArrayHelper::map($un_send_data1,'patientid','patientid');
		$in_qry_index=ArrayHelper::index($un_send_data1,'patientid');
		$un_send_data=SubVisit::find()->where(['IN','pat_id',$in_qry])->all();
		if(!empty($un_send_data))
		{
			$result_string='';
			foreach ($un_send_data as $key => $value) 
			{
				$result_string.='<tr><td>'.$value['mr_number'].'</td>';
				$result_string.='<td>'.$in_qry_index[$value['pat_id']]['pat_inital_name'].' '.$in_qry_index[$value['pat_id']]['patientname'].'</td>';
				$result_string.='<td>'.$in_qry_index[$value['pat_id']]['pat_mobileno'].'</td>';
				$result_string.='<td>'.$in_qry_index[$value['pat_id']]['pat_address'].'</td>';
				$result_string.='<td>'.date('d-F-Y h:i A',strtotime($value['created_at'])).'</td>';
				$result_string.='<td><button type="button" id="patient_data'.$value['sub_id'].'" onclick="Select_Patient('.$value['sub_id'].')" class="btn btn-xs btn-danger" title="select"><span class="glyphicon glyphicon-ok"></span></button></td><tr>';
			}
		}
		else 
		{
				$result_string.='<div class="text-center" style="color:red;font-size:20px;">No Records Found</div>';
		}
			
			return json_encode($result_string);
	}

public function actionPatientkey1($id) 
	{
		$un_send_data1=Newpatient::find()->where(['mr_no'=>$id])->asArray()->one();
		//echo"<pre>";print_r($un_send_data1); die;
		if(!empty($un_send_data1))
		{  
			$result_string='';
			
				$result_string.='<tr><td> MR NUMBER </td><td>'.$un_send_data1['mr_no'].'</td></tr>';
				$result_string.='<tr><td> Patient Name </td><td>'.$un_send_data1['pat_inital_name'].'.'.$un_send_data1['patientname'].'</td></tr>';
				$result_string.='<tr><td> Patient Age </td><td>'.$un_send_data1['pat_age'].'</td></tr>';
				$result_string.='<tr><td> Gender </td><td>'.$un_send_data1['pat_sex'].'</td></tr>';
				$result_string.='<tr><td> Marital Status </td><td>'.$un_send_data1['pat_marital_status'].'</td></tr>';
				$result_string.='<tr><td> Relation </td><td>'.$un_send_data1['pat_relation'].''.$un_send_data1['par_relationname'].'</td></tr>';
				$result_string.='<tr><td> Address </td><td>'.$un_send_data1['pat_address'].'</td></tr>';
				$result_string.='<tr><td> City </td><td>'.$un_send_data1['pat_city'].'</td></tr>';
				$result_string.='<tr><td> Distict </td><td>'.$un_send_data1['pat_distict'].'</td></tr>';
				$result_string.='<tr><td> State </td><td>'.$un_send_data1['pat_state'].'</td></tr>';
				$result_string.='<tr><td> Pin Code </td><td>'.$un_send_data1['pat_pincode'].'</td></tr>';
				$result_string.='<tr><td> Phone Number </td><td>'.$un_send_data1['pat_phone'].'</td></tr>';
				$result_string.='<tr><td> Mobile Number </td><td>'.$un_send_data1['pat_mobileno'].'</td></tr>';
				$result_string.='<tr><td> Email Address </td><td>'.$un_send_data1['pat_email'].'</td></tr>';
				//$result_string.='<tr><td><button type="button" id="patient_data'.$value['sub_id'].'" onclick="Select_Patient('.$value['sub_id'].')" class="btn btn-xs btn-danger" title="select"><span class="glyphicon glyphicon-ok"></span></button></td><tr>';
		
		}
		else 
		{
				$result_string.='<div class="text-center" style="color:red;font-size:20px;">No Records Found</div>';
		}
			
			return json_encode($result_string);
	}


	public function actionPatientvalueset($id) 
	{
		
		$query = new Query;
		$query	->select(['*'])->from('newpatient')->join('INNER JOIN',  'sub_visit','newpatient.mr_no =sub_visit.mr_number')->where(['sub_visit.sub_id'=>$id])->one(); 
		$command = $query->createCommand();
		$un_send_data = $command->queryAll();
		
		if(!empty($un_send_data))
		{
			$set_patient_data=array();
			$set_patient_data[0]=$un_send_data[0]['patientname'];
			$set_patient_data[1]=$un_send_data[0]['pat_mobileno'];
			
			$last_physician_number=$un_send_data[0]['consultant_doctor'];
			if(!empty($last_physician_number))
			{
				$physicaindata=Physicianmaster::find()->where(['id'=>$last_physician_number])->asArray()->one();
				$set_patient_data[2]=$physicaindata['physician_name'];
			}
			else 
			{
				$set_patient_data[2]='';
			}
			$insurance_number=$un_send_data[0]['insurance_type'];
			if(!empty($insurance_number))
			{
				$insurancedata=Insurance::find()->where(['insurance_typeid'=>$insurance_number])->asArray()->one();
				$set_patient_data[3]='<option value='.$insurancedata['insurance_typeid'].'>'.$insurancedata['insurance_type'].'</option>';
			}
			else 
			{
				$set_patient_data[3]='';
			}
			
			$set_patient_data[4]=date('d-m-Y',strtotime($un_send_data[0]['dob']));
			$set_patient_data[5]=$un_send_data[0]['mr_no'];
			$set_patient_data[6]=$un_send_data[0]['patientid'];
			$set_patient_data[7]='<option value='.$un_send_data[0]['pat_sex'].'>'.$un_send_data[0]['pat_sex'].'</option>';
			$set_patient_data[8]=$un_send_data[0]['pat_address'];
			
			
			return json_encode($set_patient_data);
		}
	}
	
	
	 public function actionSalesopd() {
	 	 
		$searchModel = new SalesSearch();
		$dataProvider = $searchModel -> search(Yii::$app -> request -> queryParams);
		return $this -> render('patientadd', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, ]);
	 }
	 
	public function actionUserwise1()
  	{	
		require ('../../vendor/tcpdf/tcpdf.php');
						$pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
						$pdf->SetCreator(PDF_CREATOR);
						$pdf->SetAuthor('Nicola Asuni');
						$pdf->SetTitle('Invoice');
						$pdf->SetSubject('TCPDF Tutorial');
						$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
						$pdf->SetPrintHeader(false);
						$pdf->SetPrintFooter(false);
						$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
						$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
						$pdf->setFontSubsetting(true);
						$pdf->SetFont('helvetica', '', 8, '', true);
						$pdf->AddPage();
						$tbl1='<div><div><h2 style="text-align:center;">USER WISE COLLECTION PHARMACY</h2></div>';
						$tbl1.='<div><div><h2 style="text-align:center;">3-7-125-1, BAKARAPURAM, PULIVENDULA</h2></div>';
						$tbl1.='<div><h2 style="text-align:center;">08568-286189</h2></div>';
						$tbl1.='<div><h2 style="text-align:center;">ITEM WISE PURCHASE REPORT</h2></div>';
						$tbl1.='<div><h2 style="text-align:center;"><u>RK,NRSR</u></h2></div></div>';
						$tbl1.='<div><h3>From Date &nbsp;&nbsp;&nbsp;'.date('d-m-Y',strtotime($fromDate)).' &nbsp;&nbsp;&nbsp;&nbsp;To Date &nbsp;&nbsp;&nbsp;'.date('d-m-Y',strtotime($toDate)).'</h3></div><br>';
						$tbl1.='<p>________________________________________________________________________________________________________________________</p>'; 
						$tbl1.='<table ><thead ><tr><th><h3>Sno</h3></th><th><h3>BatchNo</h3></th><th><h3>Qty</h3></th><th><h3>Free</h3></th><th><h3>Rate</h3></th><th><h3>MRP</h3></th><th><h3>Total</h3></th></tr></thead>';
				    	$tbl1.='<tr colspan="7"><p style="padding-bottom:50px;">________________________________________________________________________________________________________________________</p></tr><tbody>';
						$pdf->writeHTML($tbl1, true, false, false, false,'');
		    			$pdf->Output('example_001.pdf');
	}

	
	
	//sankar
	public function actionSaleshis($fromdate,$todate) {
		
	$fromda=date_create($fromdate);
	$from_day=date_format($fromda,"Y-m-d H:i:s");
	$toda=date_create($todate);
	$to_day=date_format($toda,"Y-m-d H:i:s");
	
	$saledata=Sales::find()->where(['between', 'invoicedate', $from_day, $to_day ])->all();
	//echo"<pre>";	print_r($saledata); die;
	$result_string='';
			$result_string.='<div class="table-responsive">
			<table class="table table-bordered table-striped">';
						$result_string.='<thead style="font-style:normal";><tr>';
						$result_string.='<th rowspan="2" width="1%" class="text-center">mrnumber</th>';
						$result_string.='<th rowspan="2" width="5%"  class="text-center">Name</th>';
						$result_string.='<th rowspan="2" class="text-center" >DOB</th>';
						$result_string.='<th rowspan="2" class="text-center">Physician Name</th>';
						$result_string.='<th rowspan="2" class="text-center">Phone Number</th>';
						$result_string.='<th rowspan="2" class="text-center">Paid Status</th>';
						$result_string.='<th rowspan="2" class="text-center">Total Amount</th>';
						//$result_string.='<th colspan="2" class="text-center">Action</th>';
						//$result_string.='</tr><tr>';
						// $result_string.='<th  class="text-center">SELECT</th>';
						// $result_string.='<th  class="text-center">VIEW</th>';
						 $result_string.='</tr></thead>';
						$result_string.='<tbody id="search_filter"  style="font-style:normal;font-weight:normal;">';
			
			$sno=1;
			foreach ($saledata as $key => $value)
			{ 
				$Sale_detail=Saledetail::find()->where(['opsaleid' => $value['opsaleid']])->andWhere(['return_status'=>'N'])->one();
				
					$result_string.='<tr>';
					$result_string.='<td  class="text-center">'.$value->mrnumber.'</td>';
					$result_string.='<td  class="text-center">'.$value->name.'</td>';
					$result_string.='<td  class="text-center">'.$value->dob.'</td>';
					$result_string.='<td  class="text-center">'.$value->physicianname.'</td>';
					$result_string.='<td  class="text-center">'.$value->phonenumber.'</td>';
					$result_string.='<td  class="text-center">'.$value->paid_status.'</td>';
					$result_string.='<td  class="text-center">'.$value->overall_sub_total.'</td>';
					// $result_string.='<td  class="text-center"><button class="btn btn-default btn-xs temp_select" id="temp_tablet_select'.$value['opsaleid'].'" temp_selectid='.$value['opsaleid'].'  type="button"><i class="fa fa-plus"></i></button></td>';
					// $result_string.='<td  class="text-center"><button type="button" class="btn btn-warning btn-xs temp_view" id="temp_tablet_view'.$value['opsaleid'].'" temp_viewid='.$value['opsaleid'].'   data-toggle="modal" data-target="#inner-modal"><i class="fa fa-eye"></i></button></td>';
					 $result_string.='</tr>';
				$sno++;	
			}
			$result_string.='</tbody></table>';
			return json_encode($result_string);
		}
	
	
	
	
	
	//Master Layout
	public function actionMaster()
    { 
        $session = Yii::$app->session; 
		
        $_SESSION['menu_master']='FRONT';
		$model = new LoginForm();
       	return $this->redirect(['/site/index']);
    }

	public function actionDashboard()
    { 
        $session = Yii::$app->session;
		
		 
        $_SESSION['menu_master']='BACK';
		 $model = new LoginForm();
         return $this->redirect(['/site/index']);  
    }

	public function actionRights($id)
    { 
        $session = Yii::$app->session;
		
		$_SESSION['menu_rights_session']=$id;
		$model = new LoginForm();
        return $this->redirect(['/site/index']);  
    }
	
}