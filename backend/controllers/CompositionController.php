<?php

namespace backend\controllers;

use Yii;
use backend\models\Composition;
use backend\models\CompositionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\BranchAdmin;
use backend\models\Product;
use yii\helpers\ArrayHelper;
use backend\models\Manufacturermaster;
use yii\data\ActiveDataProvider;
use backend\models\Unit;
use backend\models\Producttype;

class CompositionController extends Controller
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
            'access' => [ 'class' => AccessControl::className(),'rules' => [ ['allow' => true, 'roles' => ['@']  ]] ],
        ];
    }

   
    public function actionIndex()
    {
        $searchModel = new CompositionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

   
    public function actionView($id)
    {
        return $this->renderAjax('view', [ 'model' => $this->findModel($id), ]);
    }
	
	 public function actionViewproduct($id)
    {
        return $this->renderAjax('viewproducts', [ 'model' => $this->findModel($id), ]);
    }
	
 public function beforeAction($action) {
          return BranchAdmin::checkbeforeaction();
	}
 
 
 
 public function actionBulkdelete(){
 	
   
    $selection=(array)Yii::$app->request->post('selection');
	foreach($selection as $id){$this->findModel($id)->delete();}	
	return "Y";
    }

    
    public function actionCreate()
    {
        $model = new Composition();

        if (Yii::$app->request->post()) {
        	$model->composition_name=trim(ucwords(Yii::$app->request->post('Composition')['composition_name']));
        	$session = Yii::$app->session;
			$model->updated_by=$session['user_id'];
			$agestart=Yii::$app->request->post('Composition')['agestart'];
			$ageend=Yii::$app->request->post('Composition')['age_end'];
			$model->agestart=$agestart;
			$model->age_end=$ageend;
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			if($agestart<$ageend)
			{
			if($model->save()){
				echo "Y";
			}else{
				
				echo "N";
			}	
			}
			else{
				echo "W";
			}
			
           
        } 
        
        
        else {
            return $this->renderAjax('create', [ 'model' => $model, ]);
        }
    }
	
	
	
	
	
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
        	$model->composition_name=trim(ucwords(Yii::$app->request->post('Composition')['composition_name']));
        	$session = Yii::$app->session;
			$model->updated_by=$session['user_id'];
			$agestart=Yii::$app->request->post('Composition')['agestart'];
			$ageend=Yii::$app->request->post('Composition')['age_end'];
			
			$model->agestart=$agestart;
			$model->age_end=$ageend;
			
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			$model->updated_on=date("Y-m-d H:i:s");
			if($agestart<$ageend)
			{
			if($model->save()){
				echo "Y";
			}else{
				
				echo "N";
			}	
			}
			else{
				echo "W";
			}
			
           
        } 
		
		
		
        else {
            return $this->renderAjax('update', [ 'model' => $model, ]);
               }
    }
   
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

   
    protected function findModel($id)
    {
        if (($model = Composition::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	public function actionExcelexport() {
		
		$objPHPExcel = new \PHPExcel();

		$sheet = 0;

		$objPHPExcel -> setActiveSheetIndex($sheet);
		
	
		$all_post_key = array("Sl. No.","composition_name","agestart","age_end");
		
		$r=0;
		$objPHPExcel -> getActiveSheet() -> setTitle("Composition_Details")		
		-> setCellValue('A1', "S.No") 		  
		-> setCellValue('B1', "Composition Name") 
		-> setCellValue('C1', "From Age") 
		-> setCellValue('D1',"To Age");
		
		
		
		$un_send_data = Composition::find()-> all();
		
		
		$row = 2;
		$slno=1;			
		foreach($un_send_data as $one_data){
			$r_a=65;$r_a1=64;			
			foreach($all_post_key as $one_field){
				$cell_char=chr($r_a);
				if($r_a1>=65){
					$cell_char=chr($r_a1).chr($r_a);
				}
				if($one_field=='Sl. No.'){
					$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
				}
					
				
					else{
						$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $one_data->$one_field);
					}
					
					
				
				if($r_a>=90){
					$r_a=64;
					$r_a1++;					
				}
				$r_a++;
			}
			$slno++;			
			$row++;
		}
 $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

		header('Content-Type: application/vnd.ms-excel');
        $filename = "Stock List Details_".date("d-m-Y-His").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');		
		 $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');  
		 return $this->redirect(['index']);
		
	}


	public function actionExceldownload($id,$name) {
		
		$objPHPExcel = new \PHPExcel();

		$sheet = 0;
		$mlist=ArrayHelper::map(Manufacturermaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'manufacturer_name');

		$objPHPExcel -> setActiveSheetIndex($sheet);
		$title= " Composition [".$name."] consider Products";
		
	
		$all_post_key = array("productid","productname","hsn_code","manufacturer_id");
		
		$r=0;
		$objPHPExcel -> getActiveSheet() -> setTitle("Composition Consider Products")	
		-> setCellValue('A1', $title) 			
		-> setCellValue('A2', "S.No") 		  
		-> setCellValue('B2', "Product Name") 
	
		-> setCellValue('C2',"Hsn Code")
		-> setCellValue('D2',"Manufacturer");
		
		$objPHPExcel->getActiveSheet()->mergeCells('A1:Z1');
		
		$productcompositiondata = Product::find()->where(['composition_id'=>$id])->all();
		
		
		$row = 3;
		$slno=1;			
		foreach($productcompositiondata as $one_data){
			$r_a=65;$r_a1=64;			
			foreach($all_post_key as $one_field){
				$cell_char=chr($r_a);
				if($r_a1>=65){
					$cell_char=chr($r_a1).chr($r_a);
				}
				if($one_field=='productid'){
					
					$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
				}
				if($one_field=='manufacturer_id'){
					
					$mid[]=$one_data->manufacturer_id;
					$mdata=array_intersect_key($mlist, array_flip($mid));
					$mval=array_values($mdata);
					$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $mval[0]);
					$mdata=array(); $mid=array();$mval="";
				}
					
				
					else{
						$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $one_data->$one_field);
					}
					
					
				
				if($r_a>=90){
					$r_a=64;
					$r_a1++;					
				}
				$r_a++;
			}
			$slno++;			
			$row++;
		}
 $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

		header('Content-Type: application/vnd.ms-excel');
        $filename = "Composition_".date("d-m-Y-His").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');		
		 $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');  
		 return $this->redirect(['index']);
		
	}

public function actionExcelexportproducts() {
		
		$objPHPExcel = new \PHPExcel();
		$sheet = 0;
		$mlist=ArrayHelper::map(Manufacturermaster::find()->where(['is_active'=>1])->asArray()->all(), 'id', 'manufacturer_name');
		$clist=ArrayHelper::map(Composition::find()->where(['is_active'=>1])->asArray()->all(), 'composition_id', 'composition_name');
		$ulist=ArrayHelper::map(Unit::find()->where(['is_active'=>1])->asArray()->all(), 'unitid', 'unitvalue');
		$ptlist=ArrayHelper::map(Producttype::find()->where(['is_active'=>1])->asArray()->all(), 'product_typeid', 'product_type');
		$objPHPExcel -> setActiveSheetIndex($sheet);
		$all_post_key = array("productid","composition_id","is_active","productname","product_typeid","unit","hsn_code","manufacturer_id","minstock","maxstock","reorderlevelstock","sort_description");
		$r=0;
		$objPHPExcel -> getActiveSheet() -> setTitle("Composition-Products")	
		-> setCellValue('A1', "S.No") 		 
		-> setCellValue('B1', "Composition (Drug)") 
		-> setCellValue('C1', "P.Sl.No") 
		-> setCellValue('D1', "Stock Name")
		-> setCellValue('E1', "Stock Type")
		-> setCellValue('F1',"Unit")
		-> setCellValue('G1',"Hsncode")
		-> setCellValue('H1',"Manufacturer")
		-> setCellValue('I1',"Min Stock")
		-> setCellValue('J1',"Max Stock")
		-> setCellValue('K1',"Reorder Level Stock")
		-> setCellValue('L1',"Short desccription");
$objPHPExcel->getActiveSheet()->getStyle("A1:L1")->getFont()->setBold(true)->setName('Verdana')->setSize(10)->getColor()->setRGB('ff0000');
		
		$un_send_data = Product::find()->orderBy(['composition_id'=>SORT_ASC])->all();
		
		
		$row = 3;
		$slno=0;	
		$pno=0;	
			$k=0;
			$comp="";
		foreach($un_send_data as $one_data){
			$r_a=65;$r_a1=64;		
			
			if($comp=="" || $comp!=$one_data->composition_id)
				{
					$compdup=true;
					$comp=$one_data->composition_id;
					$slno++;	
					$pno=1;	
				}
				else{
					$compdup=false;
					$pno++;
				}
				
			foreach($all_post_key as $one_field){
				$cell_char=chr($r_a);
				if($r_a1>=65){
					$cell_char=chr($r_a1).chr($r_a);
				}
				
			 
			    
				
				
				if($one_field=='productid'){
						if($compdup)
						{
							$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
						}
						else{
							$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, "");
						}
					
					
					
					
				}
				
				
				else if($one_field=='is_active'){
						
							$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row,$pno);
						
					
					
					
				}
				else if($one_field=='product_typeid'){
					
					$product_typeid[]=$one_data->product_typeid;
					$product_typedata=array_intersect_key($ptlist, array_flip($product_typeid));
					$product_typeval=array_values($product_typedata);
					$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $product_typeval[0]);
					$product_typedata=array(); $product_typeid=array();$product_typeval="";
				}
				else if($one_field=='unit'){
					
					$unitid[]=$one_data->unit;
					$unitdata=array_intersect_key($ulist, array_flip($unitid));
					$unitval=array_values($unitdata);
					$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $unitval[0]);
					$product_typedata=array(); $unitid=array();$unitval="";
				}
				
				
				
				
				
				
				
				
		       else if($one_field=='composition_id'){
		         	
				   
					
					$cid[]=$one_data->composition_id;
				   
					
				  
				   $cdata=array_intersect_key($clist, array_flip($cid));
					$cval=array_values($cdata);
					
					
					if($compdup)
					{
						$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $cval[0]);
						
						
					}
					else{
						$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, "");
					}
						  
					
					$cdata=array(); $cid=array();$cval="";
				   
				    
				   
					
				}
			   
			   
				else if($one_field=='manufacturer_id'){
					
					$mid[]=$one_data->manufacturer_id;
					$mdata=array_intersect_key($mlist, array_flip($mid));
					$mval=array_values($mdata);
					$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $mval[0]);
					$mdata=array(); $mid=array();$mval="";
				}
				
					
				
					else{
						$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $one_data->$one_field);
					}
					
					
				
				if($r_a>=90){
					$r_a=64;
					$r_a1++;					
				}
				$r_a++;
			}



				
			$row++;
			
			$k++;
			
		}



 $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

		header('Content-Type: application/vnd.ms-excel');
        $filename = "Composition_Products".date("d-m-Y-His").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');		
		 $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');  
		 return $this->redirect(['index']);
		
	}





	
}
