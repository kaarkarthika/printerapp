<?php

namespace backend\controllers;
use app\models\VisitorForm;
use Yii;
use backend\models\Testgroup;
use backend\models\TestgroupSearch;
use backend\models\LabTesting;
use backend\models\LabTestgroup;
use backend\models\Taxgrouping;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * TestgroupController implements the CRUD actions for Testgroup model.
 */
class TestgroupController extends Controller
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
     * Lists all Testgroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Testgroup model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
    	// echo"<pre>";
		 $testgroupname =Testgroup::find()->all();
		 $testname =LabTesting::find()->all();
		  
    	 $testgroup=LabTestgroup::find()->Where(['testgroupid'=>$id])->all();
		 
		 $grouplist=ArrayHelper::map($testgroup, 'autoid', 'testgroupid');
		 $grouplist1=ArrayHelper::map($testgroup, 'autoid', 'test_nameid');
		
		 $grouplist_det=LabTesting::find()->where(['IN','autoid',$grouplist])->all();
		 $grouplist_det_index=ArrayHelper::index($grouplist_det,'autoid');
		 
		 $testname_det=LabTesting::find()->where(['IN','autoid',$grouplist1])->all();
		 $testname_det_index=ArrayHelper::index($testname_det,'autoid');
		
		//  print_r($testname_det_index); die;
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'testname_det_index'=>$testname_det_index,
            'grouplist_det_index'=>$grouplist_det_index
        ]);
    }

    /**
     * Creates a new Testgroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Testgroup();
		
		$tax_grouping=ArrayHelper::map(Taxgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
		
 		if(!empty($_POST)){
   	      
   	       $model = new Testgroup();
		   $model->testgroupname=$_POST['Testgroup']['testgroupname'];
		   
		   $model->isactive=$_POST['Testgroup']['isactive'];
		   if($model->save()){}else{
		  	 	print_r($model->getErrors());die;
		   } 
		    if ($model->load(Yii::$app->request->post()) && $model->save()) {
	            return $this->redirect(['index', 'id' => $model->autoid]);
	        }
		}
        return $this->renderAjax('create', [
            'model' => $model,
            'tax_grouping'=>$tax_grouping,
			
        ]);
    }

 public function actionTestgroupmaster()
    {
        $model = new Testgroup();
		$model_group = new LabTestgroup();
		$searchModel = new TestgroupSearch();
        $dataProvider = $searchModel->search1(Yii::$app->request->queryParams);
 
 		$testingmodel = new LabTesting();
		$testgrouplist=ArrayHelper::map(Testgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testlist=ArrayHelper::map(LabTesting::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'test_name');
		
		$test_list_tbl=  LabTesting::find()->where(['isactive'=>1])->asArray()->all();
		$group_list_tbl=LabTestgroup::find()->where(['testgroupid'=>$id])->asArray()->all();
		
		 $testgroup=LabTestgroup::find()->asArray()->all();
		 
		 $grouplist=ArrayHelper::map($testgroup, 'autoid', 'testgroupid');
		 $grouplist1=ArrayHelper::map($testgroup, 'autoid', 'test_nameid');
		// echo"<pre>";		 print_r($testgroup); die;
		$array_index_key=ArrayHelper::index($group_list_tbl,'test_nameid');
		if(!empty($_POST)){
   			if(isset($_POST['Testgroup']))
			{
				$test_group_name=$_POST['Testgroup']['testgroupname'];
			    $lab_testgroup=LabTestgroup::find()->where(['testgroupid'=>$test_group_name])->one();
							
				if(!empty($lab_testgroup))
				{
		          
					$data=array();
					$date_id=date('Y-m-d H:i:s');
					
					//foreach ($_POST['Testgroup']['test_name'] as $key => $value)					{
						
						$data[]=[$test_group_name,$_POST['Testgroup']['test_name'],$date_id];
				//	echo"<pre>";print_r($data);   die;  
					$data_count=count($data);
					
					$status_count=Yii::$app->db->createCommand()->batchInsert('lab_testgroup', ['testgroupid','test_nameid', 'created_date'],$data)->execute();
					
					if($status_count == $data_count)
					{
						Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
						return $this->redirect(['testgroupmaster']);
					}
					else
					{
						Yii::$app->getSession()->setFlash('error', 'Reference Table Not Insert Successfully');
						return $this->redirect(['testgroupmaster']);
					}
				}
				/*else 
				{
					Yii::$app->getSession()->setFlash('error', 'Group Name Already Exist');
					return $this->redirect(['testgroupmaster']);
				} */
			}
			else
			{
					Yii::$app->getSession()->setFlash('error', 'Check Box Not Seleted! Data Not Inserting');		
					return $this->redirect(['testgroupmaster']);
			}
		}else {  //print_r($searchModel); die;
	    return $this->render('testgroup', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'testingmodel' => $testingmodel,
            'testlist' =>$testlist,
            'testgrouplist' => $testgrouplist,
        ]);
		
		}
		//return $this->render('_testform', ['model' => $searchModel,'testingmodel' => $testingmodel, 'testlist' => $testlist,'testgrouplist'=>$testgrouplist ]); 
		
    }

	public function actionTestnamecheck($testname)
   	{
   	
	   if($testname != '')
	   {
	 	 $lab_testing=Testgroup::find()->where(['testgroupname'=>$testname])->asArray()->one();
	   	 if(!empty($lab_testing)){
		 	return true;
		 }else{
		 	return false;
		 }
	   }

    }
		
	public function actionAdd($id)
    {
    	$model = new Testgroup();
		$model_group = new LabTestgroup();
		$searchModel = new TestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
 		$testingmodel = new LabTesting();
		$testgrouplist=ArrayHelper::map(Testgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		//$testlist=ArrayHelper::map(LabTesting::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'test_name');
		$test_list_tbl=  LabTesting::find()->where(['isactive'=>1])->asArray()->all();
		$group_list_tbl=LabTestgroup::find()->where(['testgroupid'=>$id])->asArray()->all();
		$array_index_key=ArrayHelper::index($group_list_tbl,'test_nameid');
		$test_list_tbl=ArrayHelper::index($test_list_tbl,'autoid');
		
		if(!empty($test_list_tbl)){
			
		foreach ($test_list_tbl as $key => $value) {
		      		if(array_key_exists($value['autoid'],$array_index_key)) {
					}else{
						$res_value2[].=$value; 
						$res_value[ $value['autoid']].=$value['test_name'];
					}
				}  }
			$ret_list_html=$this->actionGrouptest($id,"no"); 
	     		
		if($_POST)
		{
		 
		 
		 if(!empty($_POST['test_name']))
			{
			$res=array();		
			if(!empty($_POST['Checked'])){
				$check=$_POST['Checked'];
			}else{
				$check=array();
			}
			if(!empty($_POST['test_name'])){
				$testname=$_POST['test_name'];
			}
		  		$res=array_merge($testname,$check);
				
				$id=$_POST['TestgroupSearch']['testgroupname'];
				//LabTestgroup::deleteAll(['testgroupid'=>$id]);
				$data=array();
				$date_id=date('Y-m-d H:i:s');
				
				foreach ($res as $key => $value) 
				{
					$data[]=[$id, $value,$date_id];
				} 
				//print_r($res); die;
				$data_count=count($data);
				$status_count=Yii::$app->db->createCommand()->batchInsert('lab_testgroup', ['testgroupid','test_nameid', 'created_date'],$data)->execute();
				if($status_count == $data_count)
				{
					Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
					return $this->refresh();
				}
				else
				{
					return $this->redirect(['testgroupmaster']);
					Yii::$app->getSession()->setFlash('error', 'Reference Table Not Insert Successfully');
				}
				
			}
			else if(!empty($_POST['TestgroupSearch']))
			{ 
				$test_group_name=$_POST['TestgroupSearch']['testgroupname'];
			    $lab_testgroup=LabTestgroup::find()->where(['testgroupid'=>$test_group_name])->one();
				 
				if(!empty($lab_testgroup))
				{ 
					if(!empty($_POST['test_name'])){
						$data=array();
						$date_id=date('Y-m-d H:i:s');
					foreach ($_POST['test_name'] as $key => $value) 
					{
						$data[]=[$test_group_name,$value,$date_id];
					}
					$data_count=count($data);
					
					$status_count=Yii::$app->db->createCommand()->batchInsert('lab_testgroup', ['testgroupid','test_nameid', 'created_date'],$data)->execute();
					
					if($status_count == $data_count)
					{
						Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
						return $this->refresh();
					}
					else
					{
						Yii::$app->getSession()->setFlash('error', 'Reference Table Not Insert Successfully');
						return $this->refresh();
					}
				} else{
					 	return $this->refresh();
					}
				}
				else 
				{
					Yii::$app->getSession()->setFlash('error', 'Group Name Already Exist');
					return $this->refresh();
				}
			} }
		else {
			$searchModel->testgroupname='';
			if($id){ $searchModel->testgroupname=$id; 	}
			//echo"<pre>";print_r($testgrouplist); die; 
			return $this->render('_testform', ['array_index_key'=>$array_index_key,
			'test_list_tbl'=>$test_list_tbl,
			'group_list_tbl'=>$group_list_tbl,
			'model' => $searchModel,
			'res_value'=>$res_value,
			'testingmodel' => $testingmodel, 
			'ret_list_html'=>$ret_list_html,
			'testlist' => $testlist,
			'testgrouplist'=>$testgrouplist ]);
		}
	}
	public function actionRemove($id,$rid='')
    {
    	$model = new Testgroup();
		$model_group = new LabTestgroup();
		$searchModel = new TestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
 		$testingmodel = new LabTesting();
		$testgrouplist=ArrayHelper::map(Testgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testlist=ArrayHelper::map(LabTesting::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'test_name');
		$test_list_tbl=  LabTesting::find()->where(['isactive'=>1])->asArray()->all();
		$group_list_tbl=LabTestgroup::find()->where(['testgroupid'=>$id])->asArray()->all();
		$array_index_key=ArrayHelper::index($group_list_tbl,'test_nameid');

$remove_tbl=LabTestgroup::find()->where(['autoid'=>$id])->asArray()->one();
$removetest=Testgroup::find()->where(['autoid'=>$remove_tbl['testgroupid']])->asArray()->one();
	
		$priceval=$remove_tbl['price'];
		$totalval1=$removetest['price']-$priceval;
		$status_count1=Yii::$app->db->createCommand()->update('testgroup', ['price'=>$totalval1],'autoid='.$remove_tbl['testgroupid'].'')->execute();
		foreach ($test_list_tbl as $key => $value) {
		      		if(array_key_exists($value['autoid'],$array_index_key)) {
					}else{
						$res_value2[].=$value; 
						$res_value[ $value['autoid']].=$value['test_name'];
					}
				} 
			 
	//	echo"<pre>"; print_r($res_value);	die;
	
		if($id!="")
		{
				if(LabTestgroup::deleteAll(['autoid'=>$id])){
					echo true;
				}else{
					echo "Error";
				}

			
		}else {
			$searchModel->testgroupname='';
			if($id){ $searchModel->testgroupname=$id; 	}
			//echo"<pre>";print_r($testgrouplist); die; 
			return $this->render('_testform', ['array_index_key'=>$array_index_key,
			'test_list_tbl'=>$test_list_tbl,
			'model' => $searchModel,
			'res_value'=>$res_value,
			'testingmodel' => $testingmodel, 
			'testlist' => $testlist,
			'testgrouplist'=>$testgrouplist ]);
		}
	}

	
	public function actionCheck($id,$gid){

		$model = new Testgroup();
		$model_group = new LabTestgroup();
		$searchModel = new TestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 		$testingmodel = new LabTesting();
		$testgrouplist=ArrayHelper::map(Testgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testlist=ArrayHelper::map(LabTesting::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'test_name');
		$test_list_tbl=  LabTesting::find()->where(['isactive'=>1])->asArray()->all();
		$group_list_tbl=LabTestgroup::find()->where(['testgroupid'=>$gid])->asArray()->all();
		$array_index_key=ArrayHelper::index($group_list_tbl,'test_nameid');
		 if(array_key_exists($id,$array_index_key)){
				return true;	
		  	}
		
		}
public function actionSelecttest($id){

		$model = new Testgroup();
		$model_group = new LabTestgroup();
		$searchModel = new TestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 		$testingmodel = new LabTesting();
		$testgrouplist=ArrayHelper::map(Testgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testlist=ArrayHelper::map(LabTesting::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'test_name');
		$test_list_tbl=  LabTesting::find()->where(['isactive'=>1])->asArray()->all();
		$group_list_tbl=LabTestgroup::find()->where(['testgroupid'=>$id])->asArray()->all();
		$array_index_key=ArrayHelper::index($group_list_tbl,'test_nameid');
		//echo "<pre>";
		foreach ($test_list_tbl as $key => $value) {
      		if(array_key_exists($value['autoid'],$array_index_key)) {
      		      	// print_r($value);
			}else{
				 $res_value[]=$value; 
			}
		} 
		$testlist1=ArrayHelper::map($res_value, 'autoid', 'test_name');
				
			$res_str.="<label class='control-label' for='testgroupsearch-testgroupname'>Select Testing</label>";
			$res_str.="<select id='user_idz' class='selectpicker' name='test_name[]' multiple='' style='color: #fff !important;' size='4' title='Select Testing' data-style='btn-default btn-custom cus-fld' data-live-search='true' aria-required='true' tabindex='-98' aria-invalid='false' >";
    		 foreach($testlist1 as $key => $value ){ 
					$res_str1.=" <option value=".$key.">". $value ."</option>";	
			 }
    	$res_str.="</select>";
         print_r($res_str);
		
		}
	public function actionGrouptest($id,$ret=1){

		$model = new Testgroup();
		$model_group = new LabTestgroup();
		$searchModel = new TestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 		$testingmodel = new LabTesting();
		$testgrouplist=ArrayHelper::map(Testgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testlist=ArrayHelper::map(LabTesting::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'test_name');
		$test_list_tbl=  LabTesting::find()->where(['isactive'=>1])->asArray()->all();
		$group_list_tbl=LabTestgroup::find()->where(['testgroupid'=>$id])->asArray()->all();
		$array_index_key=ArrayHelper::index($group_list_tbl,'test_nameid');
		$test_list_tbl_val=ArrayHelper::index($test_list_tbl,'autoid');
		
		if(!empty($test_list_tbl)){
		foreach ($test_list_tbl as $key => $value) {
		      		if(array_key_exists($value['autoid'],$array_index_key)) {
					}else{
						$res_value2[].=$value; 
						$res_value[ $value['autoid']].=$value['test_name'];
						$select_opt.="<option value="."'".$value['autoid']."'".">".$value['test_name']."</option>";
					}
				} 
		}
	$res_str['drop']=$select_opt;
//echo"<pre>";  print_r($group_list_tbl); die; 
$res_str['tbl'].="<table class='table table-striped table-bordered' id='list_val' style=' margin-top: 20px;margin-bottom: 0; '>";
    			$res_str['tbl'].="<thead>";
      			$res_str['tbl'].="<tr>";
        			$res_str['tbl'].="<th style='text-align: center;'>SNO</th>";
        			$res_str['tbl'].="<th style='text-align: center;'>Test Name</th>";
					$res_str['tbl'].="<th style='text-align: center;'>Price</th>";
        			$res_str['tbl'].="<th style='text-align: center;'>Action</th>";
      			$res_str['tbl'].="</tr>";
    			$res_str['tbl'].="</thead>";
    		$res_str['tbl'].="<tbody class='fetch_data'>";
		if(!empty($group_list_tbl)){
	  		$i++;	
		
		
     foreach ($group_list_tbl as $key => $value) {
     	//print_r($value); 
       	if(array_key_exists($value['test_nameid'],$test_list_tbl_val)) {
       		$testgroupid=$test_list_tbl_val[$value['test_nameid']]['test_name'];
		}else{
	   		$testgroupid="-";
	   	}
      
      	$res_str['tbl'].='<tr><td style="text-align: center;">'. $i++ .'</td>
      	<td style="text-align: center;">'. $testgroupid .'</td>
      	<td style="text-align: center;">'. $value['price'] .'</td>
      	<td style="text-align:center"><span class="remove_li rem_item" data-id="'.$value['autoid'].'" data-toggle="tooltip" title="Remove">X</span>	
       	</td>';
    	  $res_str['tbl'].='</tr>';
      }  //die;
		}else{
      	$res_str['tbl'].="<table class='table table-striped table-bordered cls-norecors'  align='center'><tr class='no-records'><td style='text-align: center;'> No Records</td></tr> </table>";
       }
			/*foreach ($test_list_tbl as $key => $value) {
      		      if(array_key_exists($value['autoid'],$array_index_key)) { 
      				$res_str['tbl'].="<tr><td style='text-align: center;'>". $i++ ."</td>";
      				$res_str['tbl'].="	<td style='text-align: center;'> ". $value['test_name']."</td>";
      				$res_str['tbl'].="	<td style='text-align:center'><span class='remove_li' data-toggle='tooltip' title='Remove'>X</span><input type='checkbox' class='check_class' style='visibility: hidden;' id='check_class' name='Checked[]' checked value=". $value['autoid']."></td></tr>";
					
    			}
			}
			}else{ 
      				$res_str['tbl'].="<tr><td style='text-align: center;'> No Records</td></tr>";
      			}
			*/
			$res_str['tbl'].="<tbody></table>";
			
		// print_r($res_str);
		 if($ret==1){
			return json_encode($res_str);
		}else{
			return ($res_str['tbl']);
		}
	}

	public function actionAddcreate()
    {
    	$model = new Testgroup();
		$model_group = new LabTestgroup();
		$searchModel = new TestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
 		$testingmodel = new LabTesting();
		$testgrouplist=ArrayHelper::map(Testgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testlist=ArrayHelper::map(LabTesting::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'test_name');
		$test_list_tbl=LabTesting::find()->where(['isactive'=>1])->asArray()->all();
		$group_list_tbl=LabTestgroup::find()->where(['testgroupid'=>$id])->asArray()->all();
		$array_index_key=ArrayHelper::index($group_list_tbl,'test_nameid');
	
		if(!empty($test_list_tbl)){
		foreach ($test_list_tbl as $key => $value) {
		      		if(array_key_exists($value['autoid'],$array_index_key)) {
					}else{
						$res_value2[].=$value; 
						$res_value[ $value['autoid']].=$value['test_name'];
					}
				} 
		} 
		if(empty($res_value)){
			
		}
				 		 
		if($_POST)
		{
			if(!empty($_POST['hid_testname']))
			{
			$res=array();		
			// if(!empty($_POST['Checked'])){
				// $check=$_POST['Checked'];
			// }else{
				// $check=array();
			// }
			if(!empty($_POST['hid_testname'])){
				$testname=$_POST['hid_testname'];
			}
			if(!empty($_POST['hid_price'])){
				$hid_price=$_POST['hid_price'];
			}
				//$res=array_merge($testname,$check);
				
				$id=$_POST['TestgroupSearch']['testgroupname'];
				//LabTestgroup::deleteAll(['testgroupid'=>$id]);
				$data=array();
					
				$date_id=date('Y-m-d H:i:s');
				$totalval=0;
				
				foreach ($hid_price as $key1 => $price) {
					$totalval=$totalval+$price;	
				}
				
				foreach ($testname as $key => $value) 
				{
					$data[]=[$id, $value,$hid_price[$key],$date_id];
					
				} 
		
				$group_test_tbl=Testgroup::find()->where(['autoid'=>$id])->asArray()->one();
				$priceval=$group_test_tbl['price'];
				$totalval=$totalval+$priceval;
				$data_count=count($data);
				$status_count=Yii::$app->db->createCommand()->batchInsert('lab_testgroup', ['testgroupid','test_nameid','price', 'created_date'],$data)->execute();
				$status_count1=Yii::$app->db->createCommand()->update('testgroup', ['price'=>$totalval],'autoid='.$id.'')->execute();
				
								
				if($status_count == $data_count)
				{
					//Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
					//return $this->refresh();
					
					$res[0]="saved";
					$res[1]="2";
					return json_encode($res);
				}
				else
				{
					return $this->redirect(['testgroupmaster']);
					Yii::$app->getSession()->setFlash('error', 'Reference Table Not Insert Successfully');
				}
				
			}
			else if(!empty($_POST['TestgroupSearch']))
			{ 
				$test_group_name=$_POST['TestgroupSearch']['testgroupname'];
			    $lab_testgroup=LabTestgroup::find()->where(['testgroupid'=>$test_group_name])->one();
				 
				if(!empty($lab_testgroup))
				{ 
					if(!empty($_POST['test_name'])){
						$data=array();
						$date_id=date('Y-m-d H:i:s');
						//$totalval="0";
					foreach ($_POST['test_name'] as $key => $value) 
					{
						$data[]=[$test_group_name,$value,$date_id];
						
					}
					$data_count=count($data);
					
					$status_count=Yii::$app->db->createCommand()->batchInsert('lab_testgroup', ['testgroupid','test_nameid', 'created_date'],$data)->execute();
					
					if($status_count == $data_count)
					{
						//Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
						return $this->refresh();
						$res[0]="saved";
						$res[1]="2";
						return json_encode($res);
					}
					else
					{
						Yii::$app->getSession()->setFlash('error', 'Reference Table Not Insert Successfully');
						return $this->refresh();
					}
				} else{
					 	return $this->refresh();
					}
				}
				else 
				{
					Yii::$app->getSession()->setFlash('error', 'Group Name Already Exist');
					return $this->refresh();
				}
			}else
			{
					Yii::$app->getSession()->setFlash('error', 'Check Box Not Seleted! Data Not Inserting');		
					return $this->refresh();
			}
		}
		else {
			return $this->render('_testform2', [
			'test_list_tbl'=>$test_list_tbl,
			'model' => $searchModel,
			'testingmodel' => $testingmodel, 
			'group_list_tbl'=>$group_list_tbl,
			'array_index_key'=>$array_index_key,
			'testlist' => $testlist,
			'res_value'=>$res_value,
			'testgrouplist'=>$testgrouplist ]);
		}
	}
	
	

    /**
     * Updates an existing Testgroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
	 
    public function actionUpdate($id)
    {
    	
		$model = $this->findModel($id);
 		$testgroupname =Testgroup::find()->all();
		$model_group = new LabTestgroup();
		$searchModel = new TestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$testname =LabTesting::find()->all();
		$testingmodel = new LabTesting();
		$testgrouplist=ArrayHelper::map(Testgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testlist=ArrayHelper::map(LabTesting::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'test_name');
		$tax_grouping=ArrayHelper::map(Taxgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
		
		$resultgroup=Testgroup::find()->Where(['autoid'=>$id])->all();
		$model->autoid=$resultgroup[0]['autoid'];
		// $resultgroup_det=ArrayHelper::map($resultgroup_indec, 'autoid', 'autoid');
		// $resultgroup=ArrayHelper::index($resultgroup_det,'autoid');
		
		//echo "<pre>"; print_r($resultgroup_indec); die;
      
	   $testgroup=LabTestgroup::find()->Where(['testgroupid'=>$id])->all();
	   $grouplist=ArrayHelper::map($testgroup, 'autoid', 'testgroupid');
	   $grouplist1=ArrayHelper::map($testgroup, 'autoid', 'test_nameid');
		
		 $grouplist_det=LabTesting::find()->where(['IN','autoid',$grouplist])->all();
		 $grouplist_det_index=ArrayHelper::index($grouplist_det,'autoid');
		 
		 $testname_det=LabTesting::find()->where(['IN','autoid',$grouplist1])->all();
		 $testname_det_index=ArrayHelper::index($testname_det,'autoid');
		
		//echo "<pre>"; print_r($testname_det_index); die;
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->autoid]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
             'testname_det_index'=>$testname_det_index,
             '$grouplist_det_index'=>$grouplist_det_index,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'testingmodel' => $testingmodel,
            'testlist' =>$testlist,
            'testgrouplist' => $testgrouplist,
            'resultgroup' => $resultgroup,
              'tax_grouping'=>$tax_grouping,
        ]);
    }

 	public function actionUpdatemaster($id)
    {
    	$model = $this->findModel($id);
 		$testgroupname =Testgroup::find()->all();
		$model_group = new LabTestgroup();
		$searchModel = new TestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$testname =LabTesting::find()->all();
		$testingmodel = new LabTesting();
		$testgrouplist=ArrayHelper::map(Testgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testlist=ArrayHelper::map(LabTesting::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'test_name');
		$tax_grouping=ArrayHelper::map(Taxgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
		
		$resultgroup=Testgroup::find()->Where(['autoid'=>$id])->all();
		$model->autoid=$resultgroup[0]['autoid'];
		// $resultgroup_det=ArrayHelper::map($resultgroup_indec, 'autoid', 'autoid');
		// $resultgroup=ArrayHelper::index($resultgroup_det,'autoid');
		
		//echo "<pre>"; print_r($resultgroup_indec); die;
      
	   $testgroup=LabTestgroup::find()->Where(['testgroupid'=>$id])->all();
	   $grouplist=ArrayHelper::map($testgroup, 'autoid', 'testgroupid');
	   $grouplist1=ArrayHelper::map($testgroup, 'autoid', 'test_nameid');
		
		 $grouplist_det=LabTesting::find()->where(['IN','autoid',$grouplist])->all();
		 $grouplist_det_index=ArrayHelper::index($grouplist_det,'autoid');
		 
		 $testname_det=LabTesting::find()->where(['IN','autoid',$grouplist1])->all();
		 $testname_det_index=ArrayHelper::index($testname_det,'autoid');
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->autoid]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
             'testname_det_index'=>$testname_det_index,
             '$grouplist_det_index'=>$grouplist_det_index,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'testingmodel' => $testingmodel,
            'testlist' =>$testlist,
            'testgrouplist' => $testgrouplist,
            'resultgroup' => $resultgroup,
              'tax_grouping'=>$tax_grouping,
        ]);
    }    /**
     *public function actionUpdatemaster($id)
    {
    	$model = $this->findModel($id);
 		$testgroupname =Testgroup::find()->all();
		$model_group = new LabTestgroup();
		$searchModel = new TestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$testname =LabTesting::find()->all();
		$testingmodel = new LabTesting();
		$testgrouplist=ArrayHelper::map(Testgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testlist=ArrayHelper::map(LabTesting::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'test_name');
		$tax_grouping=ArrayHelper::map(Taxgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
		
		$resultgroup=Testgroup::find()->Where(['autoid'=>$id])->all();
		$model->autoid=$resultgroup[0]['autoid'];
		// $resultgroup_det=ArrayHelper::map($resultgroup_indec, 'autoid', 'autoid');
		// $resultgroup=ArrayHelper::index($resultgroup_det,'autoid');
		
		//echo "<pre>"; print_r($resultgroup_indec); die;
      
	   $testgroup=LabTestgroup::find()->Where(['testgroupid'=>$id])->all();
	   $grouplist=ArrayHelper::map($testgroup, 'autoid', 'testgroupid');
	   $grouplist1=ArrayHelper::map($testgroup, 'autoid', 'test_nameid');
		
		 $grouplist_det=LabTesting::find()->where(['IN','autoid',$grouplist])->all();
		 $grouplist_det_index=ArrayHelper::index($grouplist_det,'autoid');
		 
		 $testname_det=LabTesting::find()->where(['IN','autoid',$grouplist1])->all();
		 $testname_det_index=ArrayHelper::index($testname_det,'autoid');
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->autoid]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
             'testname_det_index'=>$testname_det_index,
             '$grouplist_det_index'=>$grouplist_det_index,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'testingmodel' => $testingmodel,
            'testlist' =>$testlist,
            'testgrouplist' => $testgrouplist,
            'resultgroup' => $resultgroup,
              'tax_grouping'=>$tax_grouping,
        ]);
    }   
	 * 
	 * 
	 *  Deletes an existing Testgroup model.
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
     * Finds the Testgroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Testgroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Testgroup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
