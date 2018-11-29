<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\LabTesting;
use backend\models\LabTestingSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\LabUnitSearch;
use backend\models\LabSubcategory;
use backend\models\LabCategory;
use backend\models\LabCategorySearch;
use backend\models\LabUnit;
use backend\models\LabSubcategorySearch;
use backend\models\LabReferenceVal;
use backend\models\LabMulChoice;
use backend\models\Taxgrouping;
use yii\helpers\ArrayHelper;

/**
 * LabTestingController implements the CRUD actions for LabTesting model.
 */
class LabTestingController extends Controller
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
     * Lists all LabTesting models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$model = new LabTesting();
		
    	$catmodel = new LabCategorySearch();
        $searchModel = new LabTestingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$subcatmodel=new LabSubcategorySearch();
		$unitmodel=new LabUnitSearch();
		$catgorylist=ArrayHelper::map(LabCategory::find()->where(['isactive'=>1])->asArray()->all(), 'auto_id', 'category_name');
		$subcatgorylist=ArrayHelper::map(LabSubcategory::find()->where(['isactive'=>1])->asArray()->all(), 'auto_id', 'lab_subcategory');
		$unitlist=ArrayHelper::map(LabUnit::find()->where(['isactive'=>1])->asArray()->all(), 'auto_id', 'unit_name');
		$tax_grouping=ArrayHelper::map(Taxgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
	
			 
		if(!empty($_POST)){
			//echo"<pre>"; print_r($_POST); die;
			 $model->cat_id= $_POST['LabCategorySearch']['category_name'];
		   $model->subcat_id= $_POST['LabSubcategorySearch']['lab_subcategory'];
		   $model->test_name= $_POST['LabTestingSearch']['test_name'];
		   $model->referencevalue= $_POST['LabTestingSearch']['referencevalue'];
		   $model->price= $_POST['LabTestingSearch']['price'];
		   $model->hsncode= $_POST['LabTestingSearch']['hsncode'];
		   $model->isactive= $_POST['LabTestingSearch']['isactive'];
		   $model->unit_id= $_POST['LabUnitSearch']['unit_name']; 
		   if($model->save()){
		   	
		   // else {  print_r($model->getErrors());die;  }
		 	$id = Yii::$app->db->getLastInsertID();
			$count_value=count($_POST[hid_ref_name]);
			for($i=0;$i<$count_value;$i++){
				$refmodel = new LabReferenceVal();
				$refmodel->reference_name=$_POST[hid_ref_name][$i];
				$refmodel->reference_value=$_POST[hid_ref_val][$i];
				$refmodel->test_id=$id;
				if($refmodel->save()){
				}else{
					print_r($refmodel->getErrors()); die;
				}
			}
				
		   }	
		} 
		return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
             'catgorylist' => $catgorylist,
            'subcatgorylist'=>$subcatgorylist,
              'model' => $model,
              'catmodel'=>$catmodel,
              'subcatmodel' => $subcatmodel,
              'unitmodel'=>$unitmodel,
              'unitlist'=>$unitlist,
              'tax_grouping'=>$tax_grouping,
        ]);
		
    }

    /**
     * Displays a single LabTesting model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
    	$refmodel=LabReferenceVal::find()->where(['test_id'=>$id])->all();	
 		$mulmodel=LabMulChoice::find()->where(['test_id'=>$id])->all();
		
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'refmodel' => $refmodel,  'mulmodel' => $mulmodel,
        ]);
    }

    
    
    public function actionCreate()
    {
    	$model = new LabTesting();
		$catmodel = new LabCategorySearch();
        $searchModel = new LabTestingSearch();
		
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$subcatmodel=new LabSubcategorySearch();
		$unitmodel=new LabUnitSearch();
		$catgorylist=ArrayHelper::map(LabCategory::find()->where(['isactive'=>1])->asArray()->all(), 'auto_id', 'category_name');
		$subcatgorylist=ArrayHelper::map(LabSubcategory::find()->where(['isactive'=>1])->asArray()->all(), 'auto_id', 'lab_subcategory');
		$unitlist=ArrayHelper::map(LabUnit::find()->where(['isactive'=>1])->asArray()->all(), 'auto_id', 'unit_name');
		$tax_grouping=ArrayHelper::map(Taxgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
		
		if(Yii::$app->request->post())
		{
			// echo "<pre>"; print_r($_POST); die;
		   $model->cat_id= $_POST['LabCategorySearch']['category_name'];
		   $model->subcat_id= $_POST['LabSubcategorySearch']['lab_subcategory'];
		   $model->test_name= $_POST['LabTestingSearch']['test_name'];
		   //  $model->price= $_POST['LabTestingSearch']['price'];
		   // $model->hsncode= $_POST['LabTestingSearch']['hsncode'];
		   $model->method= $_POST['LabTestingSearch']['method'];      
		   $model->description= $_POST['LabTestingSearch']['description'];       
		   $model->result_type= $_POST['LabTestingSearch']['result_type'];       
		   $model->result_type_val= $_POST['LabTestingSearch']['result_type_val'];      
		   
		   $model->isactive= $_POST['LabTestingSearch']['isactive'];
		   $model->unit_id= $_POST['LabUnitSearch']['unit_name'];
		   $model->created_date=date('Y-m-d H:i:s'); 
		   
		   if($model->save())
		   {
		   	//print_r($_POST['hid_ref_age']);
			
			if(is_array($_POST['hid_ref_age'])){
				$count_val=count($_POST['hid_ref_age']);
			} else{
				$count_val=1;
			}
		   			for($i=0;$i<$count_val;$i++){
						if($_POST['hid_ref_agefrom_cal'][$i]=="Day"){
								$days_from[$i]=$_POST['hid_ref_age'][$i];
						}else if($_POST['hid_ref_agefrom_cal'][$i]=="Month"){
								$days_from[$i]=($_POST['hid_ref_age'][$i] * 30);
								
						}else if($_POST['hid_ref_agefrom_cal'][$i]=="Year"){
								$days_from[$i]=($_POST['hid_ref_age'][$i]*365);
						}
						if($_POST['hid_ref_ageto_cal'][$i]=="Day"){
								$days_to[$i]=$_POST['hid_ref_range'][$i];
						}else if($_POST['hid_ref_ageto_cal'][$i]=="Month"){
								$days_to[$i]=($_POST['hid_ref_range'][$i] * 30);
								$days_to[$i]=$days_to[$i]+29;
						}else if($_POST['hid_ref_ageto_cal'][$i]=="Year"){
								$days_to[$i]=($_POST['hid_ref_range'][$i]*365)+364;
						}
				}	   	  
		   	  
		 	 if($_POST['LabTestingSearch']['result_type']=="numeric")
		  	 {  
		   		$reference_name=$_POST['hid_ref_name'];
				$data=array(); 
		   		foreach ($reference_name as $key => $value) 
		   		{
		   			$data[]=[$model->autoid,$value,$_POST['hid_ref_gen'][$key],$_POST['hid_ref_agefrom_cal'][$key],
		   			$_POST['hid_ref_ageto_cal'][$key],$_POST['hid_ref_age'][$key],$_POST['hid_ref_range'][$key],$days_from[$key],
		   			$days_to[$key],$_POST['hid_ref_from'][$key],$_POST['hid_ref_to'][$key]];       // ss code
				}
				
				$data_count=count($data);
				
				//$status_count=Yii::$app->db->createCommand()->batchInsert('lab_reference_val', ['test_id','reference_name', 'gender','age','range','ref_from','ref_to'],$data)->execute();
				$status_count=Yii::$app->db->createCommand()->batchInsert('lab_reference_val', ['test_id','reference_name', 'gender','agefrom_cal','ageto_cal','age','range','days_from','days_to','ref_from','ref_to'],$data)->execute();       // ss code
				
				if($status_count == $data_count)
				{
					Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
					return $this->redirect(['index', 'id' => $model->autoid]);
				}
				else
				{
					return $this->redirect(['index', 'id' => $model->autoid]);
					Yii::$app->getSession()->setFlash('error', 'Reference Table Not Insert Successfully');
				}
			 }elseif($_POST['LabTestingSearch']['result_type']=="multichoice"){
			 	$mul_name=$_POST['hid_mul_text'];
				$data=array(); 
		   			foreach ($mul_name as $key => $value) 
		   			{
		   				$data[]=[$model->autoid,$value,$_POST['hid_norm'][$key]];       // ss code
					}
				$data_count=count($data);
				$status_count=Yii::$app->db->createCommand()->batchInsert('lab_mul_choice', ['test_id','mulname','normal_value'],$data)->execute();       // ss code
				if($status_count == $data_count)
				{
					Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
					return $this->redirect(['index', 'id' => $model->autoid]);
				}
				else
				{
					return $this->redirect(['index', 'id' => $model->autoid]);
					Yii::$app->getSession()->setFlash('error', 'Multichoice Table Not Insert Successfully');
				}
			 }
			/* elseif($_POST['LabTestingSearch']['result_type']=="posneg"){
			 	$freetext=$_POST['hid_free_text'];
				$data=array(); 
		   			foreach ($freetext as $key => $value) 
		   			{
		   				$data[]=[$model->autoid,$value];       // ss code
					}
				$data_count=count($data);
				$status_count=Yii::$app->db->createCommand()->batchInsert('lab_mul_choice', ['test_id','mulname'],$data)->execute();       // ss code
				if($status_count == $data_count)
				{
					Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
					return $this->redirect(['index', 'id' => $model->autoid]);
				}
				else
				{
					return $this->redirect(['index', 'id' => $model->autoid]);
					Yii::$app->getSession()->setFlash('error', 'Multichoice Table Not Insert Successfully');
				}
			 } */
			 
			else{
	 			return $this->redirect(['index', 'id' => $model->autoid]);
				}
					$res[0]="saved";
						$res[1]="2";
					return json_encode($res);
			              
		   }
		   else 
		   {
			   print_r($model->getErrors());die;
		   }
		}
		else 
		{ 
				return $this->render('create', [
	            'searchModel' => $searchModel,
	           
	            'dataProvider' => $dataProvider,
	            'catgorylist' => $catgorylist,
	            'subcatgorylist'=>$subcatgorylist,
	            'model' => $model,
	            'catmodel'=>$catmodel,
	            'subcatmodel' => $subcatmodel,
	            'unitmodel'=>$unitmodel,
	            'unitlist'=>$unitlist,
	            'tax_grouping'=>$tax_grouping,
	        	]);	
		}
	}
    
	public function actionTestnamecheck($testname)
   	{
   	
	   if($testname != '')
	   {
	 	 $lab_testing=LabTesting::find()->where(['test_name'=>$testname])->asArray()->one();
	   	 if(!empty($lab_testing)){
		 	return true;
		 }else{
		 	return false;
		 }
	   }

    }
  
	public function actionUpdate($id)
    {
    	$model = $this->findModel($id);
		
		$model1=LabTesting::find()->where(['autoid'=>$id])->asArray()->one();
		$model->hsncode=$model1['hsncode'];
		
		$catmodel = new LabCategory();
        $searchModel = new LabTestingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$subcatmodel=new LabSubcategory();
		$unitmodel=new LabUnit();
		$catgorylist=ArrayHelper::map(LabCategory::find()->where(['isactive'=>1])->asArray()->all(), 'auto_id', 'category_name');
		$subcatgorylist=ArrayHelper::map(LabSubcategory::find()->where(['isactive'=>1])->asArray()->all(), 'auto_id', 'lab_subcategory');
		$unitlist=ArrayHelper::map(LabUnit::find()->where(['isactive'=>1])->asArray()->all(), 'auto_id', 'unit_name');
		$tax_grouping=ArrayHelper::map(Taxgrouping::find()->where(['is_active'=>1])->asArray()->all(), 'taxgroupid', 'hsncode');
		$refmodel=LabReferenceVal::find()->where(['test_id'=>$id])->all();
		$mulmodel=LabMulChoice::find()->where(['test_id'=>$id])->all();
		
		if(Yii::$app->request->post())
		{ 
		 
		   $model->cat_id= $_POST['LabTesting']['cat_id'];
		   $model->subcat_id= $_POST['LabTesting']['subcat_id'];
		   $model->test_name= $_POST['LabTesting']['test_name'];
		   //$model->hsncode= $_POST['LabTesting']['hsncode'];
		   $model->method= $_POST['LabTesting']['method'];               // ss code
		   $model->description= $_POST['LabTesting']['description'];      // ss code
		   $model->result_type= $_POST['LabTesting']['result_type'];       // ss code
		   $model->result_type_val= $_POST['LabTesting']['result_type_val'];       // ss code
		   $model->isactive= $_POST['LabTesting']['isactive'];
		   $model->unit_id= $_POST['LabTesting']['unit_id'];
		   //$model->price= $_POST['LabTesting']['price'];
		
		   if($model->save())
		   {
		   	
				if(is_array($_POST['hid_ref_age'])){
				$count_val=count($_POST['hid_ref_age']);
			} else{
				$count_val=1;
			}
			 	for($i=0;$i<$count_val;$i++){
						if($_POST['hid_ref_agefrom_cal'][$i]=="Day"){
								$days_from[$i]=$_POST['hid_ref_age'][$i];
						}else if($_POST['hid_ref_agefrom_cal'][$i]=="Month"){
								$days_from[$i]=($_POST['hid_ref_age'][$i] * 30);
								
						}else if($_POST['hid_ref_agefrom_cal'][$i]=="Year"){
								$days_from[$i]=($_POST['hid_ref_age'][$i]*365);
						}
						if($_POST['hid_ref_ageto_cal'][$i]=="Day"){
								$days_to[$i]=$_POST['hid_ref_range'][$i];
						}else if($_POST['hid_ref_ageto_cal'][$i]=="Month"){
								$days_to[$i]=($_POST['hid_ref_range'][$i] * 30);
								$days_to[$i]=$days_to[$i]+29;
						}else if($_POST['hid_ref_ageto_cal'][$i]=="Year"){
								$days_to[$i]=($_POST['hid_ref_range'][$i]*365)+364;
						}
					}
		   
		   
		  if(isset($days_from)){
		  	$count_dayfrom=count($days_from);
		  } 
		if(isset($days_to)){
			  $count_dayto=count($days_to);
		}	   
		 
		   	if($count_dayto > $count_dayfrom){
		   		 $count_val=$count_dayto;
		   	}
		   	else{
		   		$count_val=$count_dayfrom;
		   	}
			for($i=0;$i<$count_val;$i++){
				if($days_to[$i]<$days_from[$i]){
					Yii::$app->getSession()->setFlash('success', 'Age value is wrong Please Check .');  
					return $this->redirect(['index', 'id' => $model->autoid]);
				}
			}
		   
		 	if($_POST['LabTesting']['result_type']=="numeric"){
		   		$reference_name=$_POST['hid_ref_name'];
				$data=array(); 
		   		foreach ($reference_name as $key => $value) 
		   		{
		   			$data[]=[$model->autoid,$value,$_POST['hid_ref_gen'][$key],$_POST['hid_ref_agefrom_cal'][$key],$_POST['hid_ref_ageto_cal'][$key],$_POST['hid_ref_age'][$key],$_POST['hid_ref_range'][$key],$days_from[$key],$days_to[$key],$_POST['hid_ref_from'][$key],$_POST['hid_ref_to'][$key]];       // ss code
		   			
				}
			 //echo"<pre>"; print_r($data); die;
				$data_count=count($data);
				$del_count=Yii::$app->db->createCommand()->delete('lab_reference_val', ['test_id'=>$model->autoid])->execute();       // ss code
				$status_count=Yii::$app->db->createCommand()->batchInsert('lab_reference_val', ['test_id','reference_name', 'gender','agefrom_cal','ageto_cal','age','range','days_from','days_to','ref_from','ref_to'],$data)->execute();       // ss code
				if($status_count == $data_count)
				{
					Yii::$app->getSession()->setFlash('success', 'Updated Successfully.');  
					return $this->redirect(['index', 'id' => $model->autoid]);
				}
				else
				{
					return $this->redirect(['index', 'id' => $model->autoid]);
					Yii::$app->getSession()->setFlash('error', 'Reference Table Not Insert Successfully');
				}
			}elseif($_POST['LabTesting']['result_type']=="multichoice"){
			 	 
			 	$mul_name=$_POST['hid_mul_text'];
				$data=array(); 
		   		foreach ($mul_name as $key => $value) 
		   		{
		   			$data[]=[$model->autoid,$value,$_POST['hid_norm'][$key]];       // ss code
				}
				
				$data_count=count($data);
					
					$del_count=Yii::$app->db->createCommand()->delete('lab_mul_choice', ['test_id'=>$model->autoid])->execute();       // ss code
					//$status_count=Yii::$app->db->createCommand()->batchInsert('lab_mul_choice', ['test_id','mulname'],$data)->execute();       // ss code
					$status_count=Yii::$app->db->createCommand()->batchInsert('lab_mul_choice', ['test_id','mulname','normal_value'],$data)->execute();       // ss code
				
				if($status_count == $data_count)
				{
					Yii::$app->getSession()->setFlash('success', 'Update Successfully.');  
					return $this->redirect(['index', 'id' => $model->autoid]);
				}
				else
				{
					return $this->redirect(['index', 'id' => $model->autoid]);
					Yii::$app->getSession()->setFlash('error', 'Multichoice Table Not Insert Successfully');
				}
			 }/* elseif($_POST['LabTesting']['result_type']=="posneg"){ 
			 	$freetext=$_POST['hid_free_text'];
				$data=array(); 
		   			foreach ($freetext as $key => $value) 
		   			{
		   				$data[]=[$model->autoid,$value];      
					}
				$data_count=count($data);
				$del_count=Yii::$app->db->createCommand()->delete('lab_mul_choice', ['test_id'=>$model->autoid])->execute(); 
				$status_count=Yii::$app->db->createCommand()->batchInsert('lab_mul_choice', ['test_id','mulname'],$data)->execute();       // ss code
				if($status_count == $data_count)
				{
					Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
					return $this->redirect(['index', 'id' => $model->autoid]);
				}
				else
				{
					return $this->redirect(['index', 'id' => $model->autoid]);
					Yii::$app->getSession()->setFlash('error', 'Multichoice Table Not Insert Successfully');
				}
			 } */
			 else{
			 		return $this->redirect(['index', 'id' => $model->autoid]);
			 }
		   }
			else {
				print_r($model->getErrors());die;
			}	
		}
		else 
		 { //echo"<pre>";  print_r($tax_grouping); die;
				  return $this->render('update', [
			            'model' => $model,
			            'catgorylist' => $catgorylist,
			            'subcatgorylist'=>$subcatgorylist,
			            'catmodel'=>$catmodel,
			            'subcatmodel' => $subcatmodel,
			            'unitmodel'=>$unitmodel,
			            'unitlist'=>$unitlist,
			            'tax_grouping'=>$tax_grouping,
			            'refmodel' => $refmodel,
			            'mulmodel' => $mulmodel,
       			  ]);
		}
		
	}
	
	
	
	public function actionGetsubcategory($id)
    {
    	$subcatgorylist=LabSubcategory::find()->where(['category_id'=>$id])->asArray()->all();
		if(!empty($subcatgorylist))
		{
			$result_string='';
			foreach ($subcatgorylist as $key => $value) 
			{
				$result_string.='<option value='.$value['auto_id'].'>'.$value['lab_subcategory'].'</option>';
			}
			echo $result_string;
		}
		
	}

    /**
     * Deletes an existing LabTesting model.
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
     * Finds the LabTesting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LabTesting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LabTesting::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
