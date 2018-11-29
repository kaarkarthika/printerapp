<?php

namespace backend\controllers;

use Yii;
use backend\models\MainTestgroup;
use backend\models\MainTestgroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Testgroup;
use backend\models\TestgroupSearch;
use backend\models\LabTesting;
use backend\models\LabTestgroup;
use backend\models\Taxgrouping;
use backend\models\LabAddgroup;
use yii\helpers\ArrayHelper;

/**
 * MainTestgroupController implements the CRUD actions for MainTestgroup model.
 */
class MainTestgroupController extends Controller
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
     * Lists all MainTestgroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MainTestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MainTestgroup model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
         $testgroupname =MainTestgroup::find()->all();
		 $testname =Testgroup::find()->all();
		 $testgroup=LabAddgroup::find()->Where(['mastergroupid'=>$id])->all();
		 $grouplist1=ArrayHelper::map($testgroup, 'autoid', 'testgroupid');
		 $testname_det=Testgroup::find()->where(['IN','autoid',$grouplist1])->all();
		 $testname_det_index=ArrayHelper::index($testname_det,'autoid');
		
	 	return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'testname_det_index'=>$testname_det_index,
            //'grouplist_det_index'=>$grouplist_det_index
        ]);
	   
    }

    /**
     * Creates a new MainTestgroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     
     public function actionTestnamecheck($testname)
   	{
   	
	   if($testname != '')
	   {
	 	 $lab_testing=MainTestgroup::find()->where(['testgroupname'=>$testname])->asArray()->one();
	   	 if(!empty($lab_testing)){
		 	return true;
		 }else{
		 	return false;
		 }
	   }

    }
	
    public function actionCreate()
    {
        $model = new MainTestgroup();
		
		$tax_grouping=ArrayHelper::map(Taxgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
		
 		if(!empty($_POST)){
   	     
   	       $model = new MainTestgroup();
		   $model->testgroupname=$_POST['MainTestgroup']['testgroupname'];
		   $model->isactive=$_POST['MainTestgroup']['isactive'];
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

    /**
     * Updates an existing MainTestgroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$testgroupname =MainTestgroup::find()->all();
		$model_group = new LabTestgroup();
		$searchModel = new MainTestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$testname =LabTesting::find()->all();
		$testingmodel = new LabTesting();
		$testgrouplist=ArrayHelper::map(MainTestgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testlist=ArrayHelper::map(LabTesting::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'test_name');
		$tax_grouping=ArrayHelper::map(Taxgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
		$resultgroup=MainTestgroup::find()->Where(['autoid'=>$id])->all();
		$model->autoid=$resultgroup[0]['autoid'];
		$testgroup=LabTestgroup::find()->Where(['testgroupid'=>$id])->all();
	   	$grouplist=ArrayHelper::map($testgroup, 'autoid', 'testgroupid');
	   	$grouplist1=ArrayHelper::map($testgroup, 'autoid', 'test_nameid');
		$grouplist_det=LabTesting::find()->where(['IN','autoid',$grouplist])->all();
		$grouplist_det_index=ArrayHelper::index($grouplist_det,'autoid');
		$testname_det=LabTesting::find()->where(['IN','autoid',$grouplist1])->all();
		$testname_det_index=ArrayHelper::index($testname_det,'autoid');
		
		 $testgroupname =MainTestgroup::find()->all();
		 $testname =Testgroup::find()->all();
		 $testgroup=LabAddgroup::find()->Where(['mastergroupid'=>$id])->all();
		 $grouplist1=ArrayHelper::map($testgroup, 'autoid', 'testgroupid');
		 $testname_det=Testgroup::find()->where(['IN','autoid',$grouplist1])->all();
		 $testname_det_index=ArrayHelper::index($testname_det,'autoid');
		
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->autoid]);
        }
 //echo"<pre>"; print_r($testname_det_index); die;
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

    /**
     * Deletes an existing MainTestgroup model.
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
     * Finds the MainTestgroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MainTestgroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MainTestgroup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	public function actionMakegroupmaster()
    {
        $model = new MainTestgroup();
		$model_group = new LabAddgroup();
		$searchModel = new MainTestgroupSearch();
        $dataProvider = $searchModel->search1(Yii::$app->request->queryParams);
 
 		$testingmodel = new LabTesting();
		$testgrouplist=ArrayHelper::map(MainTestgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testlist=ArrayHelper::map(LabTesting::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'test_name');
		
		$test_list_tbl=  LabTesting::find()->where(['isactive'=>1])->asArray()->all();
		$group_list_tbl=LabAddgroup::find()->where(['testgroupid'=>$id])->asArray()->all();
		
		 $testgroup=LabAddgroup::find()->asArray()->all();
		 
		 $grouplist=ArrayHelper::map($testgroup, 'autoid', 'testgroupid');
		 $grouplist1=ArrayHelper::map($testgroup, 'autoid', 'test_nameid');
		
		$array_index_key=ArrayHelper::index($group_list_tbl,'test_nameid');
		if(!empty($_POST)){
   			if(isset($_POST['MainTestgroup']))
			{
				$test_group_name=$_POST['MainTestgroup']['testgroupname'];
			    $lab_testgroup=LabAddgroup::find()->where(['testgroupid'=>$test_group_name])->one();
							
				if(!empty($lab_testgroup))
				{
		          $data=array();
				  $date_id=date('Y-m-d H:i:s');
					
				  $data[]=[$test_group_name,$_POST['MainTestgroup']['test_name'],$date_id];
				  
				  $data_count=count($data);
					
				  $status_count=Yii::$app->db->createCommand()->batchInsert('lab_addgroup', ['testgroupid','test_nameid', 'created_date'],$data)->execute();
					
				  if($status_count == $data_count)
					{
						Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
						return $this->redirect(['makegroupmaster']);
					}
					else
					{
						Yii::$app->getSession()->setFlash('error', 'Reference Table Not Insert Successfully');
						return $this->redirect(['makegroupmaster']);
					}
				}
				
			}
			else
			{
					Yii::$app->getSession()->setFlash('error', 'Check Box Not Seleted! Data Not Inserting');		
					return $this->redirect(['makegroupmaster']);
			}
		}else {  //echo"<pre>"; print_r($testgrouplist); die;
	    return $this->render('mastergroup', [
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
	
	public function actionAddcreate()
    {  //echo"<pre>"; print_r($_POST	); die;
    	$model = new MainTestgroup();
		$model_group = new LabAddgroup();
		$searchModel = new MainTestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
 		$testingmodel = new Testgroup();
		$testgrouplist=ArrayHelper::map(MainTestgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testgroup=ArrayHelper::map(Testgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
		$testgroup_list_tbl=Testgroup::find()->where(['isactive'=>1])->asArray()->all();
	
		$mastergroup_list_tbl=LabAddgroup::find()->where(['mastergroupid'=>$id])->asArray()->all();
		$array_index_key=ArrayHelper::index($mastergroup_list_tbl,'testgroupid');
		
		foreach ($testgroup_list_tbl as $key => $value) {
		      		if(array_key_exists($value['autoid'],$array_index_key)) {
					}else{
						$res_value2[].=$value; 
						$res_value[ $value['autoid']].=$value['testgroupname'];
					}
				} 
		
		if($_POST)
		{
		  if(!empty($_POST['test_name']))
			{ 	
			$res=array();		
			if(!empty($_POST['test_name'])){
				$res=$_POST['test_name'];
			}
		  		
			$id=$_POST['MainTestgroupSearch']['testgroupname'];
				//LabTestgroup::deleteAll(['testgroupid'=>$id]);
				$data=array();
				$date_id=date('Y-m-d H:i:s');
				
				foreach ($res as $key => $value) 
				{
					$data[]=[$id, $value,$date_id];
				} 
			 // echo"<pre>";	print_r($data); die;
				$data_count=count($data);
				$status_count=Yii::$app->db->createCommand()->batchInsert('lab_addgroup', ['mastergroupid','testgroupid', 'created_date'],$data)->execute();
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
					return $this->redirect(['makegroupmaster']);
					Yii::$app->getSession()->setFlash('error', 'Reference Table Not Insert Successfully');
				}
				
			}
			else if(!empty($_POST['MainTestgroupSearch']))
			{ 
				$test_group_name=$_POST['MainTestgroupSearch']['testgroupname'];
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
						//Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
						//return $this->refresh();
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
					   location.reload().delay(5000);
					return $this->refresh();
				}
			}else
			{
					Yii::$app->getSession()->setFlash('error', 'Check Box Not Seleted! Data Not Inserting');
					   location.reload().delay(5000);		
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
	
	public function actionGrouptest($id,$ret=1){
		
		$model = new MainTestgroup();
		$model_group = new LabAddgroup();
		$searchModel = new MainTestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 		$testingmodel = new Testgroup();
		$testgrouplist=ArrayHelper::map(MainTestgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testlist=ArrayHelper::map(Testgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
		$test_list_tbl=  Testgroup::find()->where(['isactive'=>1])->asArray()->all();
		
		$group_list_tbl=LabAddgroup::find()->where(['mastergroupid'=>$id])->asArray()->all();
		$array_index_key=ArrayHelper::index($group_list_tbl,'testgroupid');
		$test_list_tbl_val=ArrayHelper::index($test_list_tbl,'autoid');
		//echo"<pre>";  print_r($id); die;
	//if(!empty($array_index_key)){
		foreach ($test_list_tbl as $key => $value) {
		      		if(array_key_exists($value['autoid'],$array_index_key)) {
		      			
					}else{
						$res_value2[].=$value; // print_r($value);
						$res_value[ $value['autoid']].=$value['testgroupname'];
						$select_opt.="<option value="."'".$value['autoid']."'".">".$value['testgroupname']."</option>";
					}
				} 
	//}
	$res_str['drop']=$select_opt;
//echo"<pre>";  print_r($select_opt); die; 
$res_str['tbl'].="<table class='table table-striped table-bordered' id='list_val' style=' margin-top: 20px;margin-bottom: 0; '>";
    			$res_str['tbl'].="<thead>";
      			$res_str['tbl'].="<tr>";
        			$res_str['tbl'].="<th style='text-align: center;'>SNO</th>";
        			$res_str['tbl'].="<th style='text-align: center;'>Test Name</th>";
        			$res_str['tbl'].="<th style='text-align: center;'>Action</th>";
      			$res_str['tbl'].="</tr>";
    			$res_str['tbl'].="</thead>";
    		$res_str['tbl'].="<tbody>";
			
	if(!empty($group_list_tbl)){
	  		$i++;	
			
     foreach ($group_list_tbl as $key => $value) {
       	if(array_key_exists($value['testgroupid'],$test_list_tbl_val)) {
       		$testgroupid=$test_list_tbl_val[$value['testgroupid']]['testgroupname'];
		
	   	}else{
	   		$testgroupid="-";
	   	}
      
      	$res_str['tbl'].='<tr><td style="text-align: center;">'. $i++ .'</td>
      	<td style="text-align: center;">'. $testgroupid .'</td>
      	<td style="text-align:center"><span class="remove_li rem_item" data-id="'.$value['autoid'].'" data-toggle="tooltip" title="Remove">X</span>	
       	</td>';
    	  $res_str['tbl'].='</tr>';
      }  
		}else{
      	$res_str['tbl'].="<tr><td style='text-align: center;'> No Records</td></tr>";
       }
		$res_str['tbl'].="<tbody></table>";
	 if($ret==1){
			return json_encode($res_str);
		}else{
			return ($res_str['tbl']);
		}
	}
	
	public function actionRemove($id,$rid='')
    {
    	echo"<pre>";
		 print_r($id);
		 print_r($rid);
		die;
		
    	$model = new MainTestgroup();
		$model_group = new LabAddgroup();
		$searchModel = new MainTestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
 		$testingmodel = new Testgroup();
		$testgrouplist=ArrayHelper::map(MainTestgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$testlist=ArrayHelper::map(Testgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
		$test_list_tbl=  Testgroup::find()->where(['isactive'=>1])->asArray()->all();
		$group_list_tbl=LabAddgroup::find()->where(['mastergroupid'=>$id])->asArray()->all();
		$array_index_key=ArrayHelper::index($group_list_tbl,'testgroupid');
		
		$main_test=MainTestgroup::find()->select(['price'])->where(['isactive'=>1])->andWhere(['autoid'=>$id])->asArray()->one();
		$main_testprice=$main_test['price'];
		
		foreach ($test_list_tbl as $key => $value) {
		      		if(array_key_exists($value['autoid'],$array_index_key)) {
					}else{
						$res_value2[].=$value; 
						$res_value[ $value['autoid']].=$value['testgroupname'];
					}
				} 
			 
	
	
		if($id!="")
		{
				if(LabAddgroup::deleteAll(['autoid'=>$id])){
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


	public function actionAdd($id)
     {
    	$model = new MainTestgroup();
		$model_group = new LabAddgroup();
		$searchModel = new MainTestgroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
 		$testingmodel = new Testgroup();
		$testgrouplist=ArrayHelper::map(MainTestgroup::find()->where(['isactive'=>1])->asArray()->all(), 'autoid', 'testgroupname');
 		$test_list_tbl=  Testgroup::find()->where(['isactive'=>1])->asArray()->all();
		$group_list_tbl=LabAddgroup::find()->where(['mastergroupid'=>$id])->asArray()->all();
		$array_index_key=ArrayHelper::index($group_list_tbl,'testgroupid');
		$test_list_tbl=ArrayHelper::index($test_list_tbl,'autoid');
		
		foreach ($test_list_tbl as $key => $value) {
		      		if(array_key_exists($value['autoid'],$array_index_key)) {
					}else{
						$res_value2[].=$value; 
						$res_value[ $value['autoid']].=$value['testgroupname'];
					}
				} 
			$ret_list_html=$this->actionGrouptest($id,"no"); 
	     	
		if($_POST)
		{
		 	
		 if(!empty($_POST['test_name']))
			{
			$res=array();		
				if(!empty($_POST['test_name'])){
					$res=$_POST['test_name'];
				}
				$total_price=0;
				foreach ($_POST['test_name'] as $key => $val) {
				  $price_val=Testgroup::find()->select(['price','hsncode'])->where(['isactive'=>1])->andWhere(['autoid'=>$val])->asArray()->one();
				  $tot_price=$price_val['price'];
				  $total_price+=$tot_price;
				}
				
				$price_prev=MainTestgroup::find()->where(['autoid'=>$id])->asArray()->one();
				$total_price=$total_price+$price_prev['price'];
								
			/*	print_r($price_val['hsncode']);
				print_r($total_price);
				die;			
			*/		
		  		$id=$_POST['MainTestgroupSearch']['testgroupname'];
				$data=array();
				$date_id=date('Y-m-d H:i:s');
				foreach ($res as $key => $value) 
				{
					$data[]=[$id, $value,$date_id];
				}
				$data_count=count($data);
				$status_count=Yii::$app->db->createCommand()->batchInsert('lab_addgroup', ['mastergroupid','testgroupid', 'created_date'],$data)->execute();
				$status_count1=Yii::$app->db->createCommand()->update('main_testgroup', ['price'=>$total_price,'hsncode'=>$price_val['hsncode']],'autoid='.$id.'')->execute();
				
				if($status_count == $data_count)
				{
					//Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
					return $this->refresh();
				}
				else
				{
					return $this->redirect(['makegroupmaster']);
					Yii::$app->getSession()->setFlash('error', 'Reference Table Not Insert Successfully');
				}
				
			}
			else if(!empty($_POST['MainTestgroupSearch']))
			{ 
				$test_group_name=$_POST['MainTestgroupSearch']['testgroupname'];
			    $lab_testgroup=LabAddgroup::find()->where(['mastergroupid'=>$test_group_name])->one();
				 
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
					
					$status_count=Yii::$app->db->createCommand()->batchInsert('lab_addgroup', ['mastergroupid','testgroupid', 'created_date'],$data)->execute();
					
					if($status_count == $data_count)
					{
						//Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
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
	
	
	
}
