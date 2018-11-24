<?php

namespace backend\controllers;

use Yii;
use backend\models\LabPayment;
use backend\models\LabPaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\Testgroup;
use backend\models\LabTesting; 
use backend\models\TaxgroupingLog; 
use backend\models\LabPaymentPrime; 
/**
 * LabPaymentController implements the CRUD actions for LabPayment model.
 */
class LabPaymentController extends Controller
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
     * Lists all LabPayment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LabPaymentSearch();
        $dataProvider = $searchModel->searchlabtest(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LabPayment model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	
	
	
	
    /**
     * Creates a new LabPayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LabPayment();
		$main = new  LabPaymentPrime();
		$labtesting=ArrayHelper::map(LabTesting::find()->where(['isactive'=>'1'])->all(), 'autoid', 'test_name');
		$testgroup=ArrayHelper::map(Testgroup::find()->where(['isactive'=>'1'])->all(),'autoid','testgroupname');
		
        if ($model->load(Yii::$app->request->post())) 
        {
        	$lap_payment=Yii::$app->request->post('LabPayment')['lab_common_id'];
			
			if(empty($lap_payment))
			{
				Yii::$app->getSession()->setFlash('error', 'Lab Test Not Inserting.');
				return $this->redirect(['lab-payment/index']);
			}
			else if(!empty($lap_payment))
			{echo '<pre>';
				print_r(Yii::$app->request->post());die;
				foreach ($lap_payment as $key => $value) 
				{
					$split_group=explode('_', $value);
					$split_group_d[]=explode('_', $value);
					if($split_group[0] == 'LabTesting')
					{
						$lab_array[]=$split_group[1];
					}
					elseif ($split_group[0] == 'TestGroup') 
					{
						$group_array[]=$split_group[1];
					}
				}
				
				if(!empty($lab_array))
				{
					$lab_testing=LabTesting::find()->where(['IN','autoid',$lab_array])->asArray()->all();
					$lab_testing_index=ArrayHelper::index($lab_testing,'autoid');
					
				}
				if(!empty($group_array))
				{
					$test_group=Testgroup::find()->where(['IN','autoid',$group_array])->asArray()->all();
					$test_group_index=ArrayHelper::index($lab_testing,'autoid');
				}
				
				foreach ($split_group_d as $key => $value) 
				{
					$labpayment=new LabPayment();
					if($value[0] == 'LabTesting')
					{
						//$labpayment->
					}
					elseif ($value[0] == 'TestGroup') 
					{
						
					}
					print_r($value);	
				}
								die;
				
				Yii::$app->getSession()->setFlash('success', 'Lab Success fully Inserted');
				return $this->redirect(['lab-payment/index']);
			}
        	
        }
		else 
		{
			 return $this->render('create', [
	            'model' => $model,
	            'labtesting' => $labtesting,
	            'testgroup'=>$testgroup,
	            'main' =>  $main,
        	]);
		}
       
    }
	
	
	public function actionLabset($id)
    {
       if($id != '')
	   {
	   		$split_group=explode('_', $id);
			$result_string='';
			if($split_group[0] == 'LabTesting')
			{
				$lab_testing=LabTesting::find()->where(['autoid'=>$split_group[1]])->asArray()->one();
				
				
				
				$hsn_code=$lab_testing['hsncode'];
				$tax_grouping_log=TaxgroupingLog::find()->where(['taxgroupid'=>$hsn_code])->andWhere(['is_active'=>1])->one();
				$percentage=$tax_grouping_log['tax'];
				
				$gstpercent_divided=$percentage/2;
				
				$calculation=($lab_testing['price']*$percentage)/100;
				
				if(!empty($lab_testing))
				{
					$result_string.='<tr class="calculation" id="lab_test'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'">';
					$result_string.='<td style="text-align:center" id="lab_name'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'">'.$lab_testing['test_name'].'<input type="hidden" name="LabPayment[lab_common_id][]" value="'.$id.'" ></td>';
				    $result_string.='<td style="text-align:center" id="price_test_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'">'.number_format($lab_testing['price'],2, '.', '').'</td>';
				   
					//$result_string.='<td  style="text-align:center" id="gst_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'">'.number_format($calculation,2, '.', '').'</td>';
				   $result_string.='<td  style="text-align:center" id="cgst_per_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'">'.number_format($gstpercent_divided,2, '.', '').'</td>';
				   $result_string.='<td  style="text-align:center" id="sgst_per_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'">'.number_format($gstpercent_divided,2, '.', '').'</td>';
				   
				   $result_string.='<td  style="text-align:center" id="cgst_amt_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'">'.number_format(($lab_testing['price']*$gstpercent_divided/100),2, '.', '').'</td>';
				   $result_string.='<td  style="text-align:center" id="sgst_amt_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'">'.number_format(($lab_testing['price']*$gstpercent_divided/100),2, '.', '').'</td>';
				   
				    $result_string.='<td  style="text-align:center" id="net_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'">'.number_format($calculation+$lab_testing['price'],2, '.', '').'</td>';
					$result_string.='<td  style="text-align:center"  id="remove_lab'.$lab_testing['autoid'].'" dataid="LabTesting_'.$lab_testing['autoid'].'"><button dataid="LabTesting_'.$lab_testing['autoid'].'" class="remove btn btn-danger btn-xs" type="button"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></button></td>';
					$result_string.='</tr>';
				}
			
			}
			elseif ($split_group[0] == 'TestGroup') 
			{
				$testgroup=Testgroup::find()->where(['autoid'=>$split_group[1]])->asArray()->one();
				
				$hsn_code=$testgroup['hsncode'];
				$tax_grouping_log=TaxgroupingLog::find()->where(['taxgroupid'=>$hsn_code])->andWhere(['is_active'=>1])->one();
				$percentage=$tax_grouping_log['tax'];
				$gstpercent_divided=$percentage/2;
				
				$calculation=($testgroup['price']*$percentage)/100;
				
				if(!empty($testgroup))
				{
					$result_string.='<tr class="calculation"  id="test_group'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'">';
					$result_string.='<td style="text-align:center" id="test_group_name'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'">'.$testgroup['testgroupname'].'<input type="hidden" value="'.$id.'"  name="LabPayment[lab_common_id][]"></td>';
				    $result_string.='<td style="text-align:center" id="price_test_group'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'">'.number_format($testgroup['price'],2, '.', '').'</td>';
				   
					//$result_string.='<td style="text-align:center" id="gst_test_group'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'">'.number_format($calculation,2, '.', '').'</td>';
				     $result_string.='<td  style="text-align:center" id="cgst_per_test'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'">'.number_format($gstpercent_divided,2, '.', '').'</td>';
				   	 $result_string.='<td  style="text-align:center" id="sgst_per_test'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'">'.number_format($gstpercent_divided,2, '.', '').'</td>';
				   
				   	 $result_string.='<td  style="text-align:center" id="cgst_amt_test'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'">'.number_format(($testgroup['price']*$gstpercent_divided/100),2, '.', '').'</td>';
				     $result_string.='<td  style="text-align:center" id="sgst_amt_test'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'">'.number_format(($testgroup['price']*$gstpercent_divided/100),2, '.', '').'</td>';
				  
				     $result_string.='<td style="text-align:center" id="net_test_group'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'">'.number_format($calculation+$testgroup['price'],2, '.', '').'</td>';
					 $result_string.='<td style="text-align:center" id="remove_test_group'.$testgroup['autoid'].'" dataid="TestGroup_'.$testgroup['autoid'].'"><button dataid="TestGroup_'.$testgroup['autoid'].'"  class="remove btn btn-danger btn-xs"  type="button"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></button></td>';
					 $result_string.='</tr>';
				}
			
			}

			return $result_string;
	   
		}   
    }
	
	
	public function actionSavedata()
    {
    	if($_POST)
		{
			echo '<pre>';
			print_r($_POST);die;
		}
	}
	
    /**
     * Updates an existing LabPayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->autoid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LabPayment model.
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
     * Finds the LabPayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LabPayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LabPayment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
