<?php

namespace backend\controllers;

use Yii;
use backend\models\ProductPackagemaster;
use backend\models\ProductPackagemasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ProductPackageLog;
use backend\models\Product;
use yii\helpers\ArrayHelper;

/**
 * ProductPackagemasterController implements the CRUD actions for ProductPackagemaster model.
 */
class ProductPackagemasterController extends Controller
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
     * Lists all ProductPackagemaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductPackagemasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductPackagemaster model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductPackagemaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductPackagemaster();
		$package_log=new ProductPackageLog();
        if (Yii::$app->request->post()) 
        {
        	
			$model->pack_name=$_POST['ProductPackagemaster']['pack_name'];
			$model->is_active=$_POST['ProductPackagemaster']['is_active'];
			$model->created_at=date('Y-m-d H:i:s');
			$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			if($model->save())
			{
				if(!empty($_POST['ProductID']))
				{
					foreach ($_POST['ProductID'] as $key => $value) 
					{
						$package_log_ins=new ProductPackageLog();
						$package_log_ins->pack_id=$model->id;
						$package_log_ins->product_id=$value;
						$package_log_ins->qty=$_POST['ProductQty'][$key];
						$package_log_ins->created_at=date('Y-m-d H:i:s');
						$package_log_ins->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
						if($package_log_ins->save())
						{
							
						}	
						else 
						{
							print_r($package_log_ins->getErrors());die;
						}
					}
				}
				
				return 'save';
			}
			else 
			{
				print_r($model->getErrors());
				die;
			}
        } 
        else 
        {
        	
			
			 $productlist=Product::find()->where(['is_active'=>1])->asArray()->all();
			 
			  
			 	 							
			  foreach ($productlist as $key => $value)
			  {
					$productlist_col_val[] = array('productname' => $value['productname'],'productid' => $value['productid']);
			  }
				$productlist_col_json = json_encode($productlist_col_val);
			
            return $this->render('create', [
                'model' => $model,
                'package_log' => $package_log,
                'productlist_col_json' =>$productlist_col_json,
            ]);
        }
    }

    /**
     * Updates an existing ProductPackagemaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$package_log=new ProductPackageLog();
		$package_log_hist=ProductPackageLog::find()->select(['id'=>'id','pack_id'=>'pack_id','product_id'=>'product_id','qty'=>'qty'])->where(['pack_id'=>$id])->asArray()->all();
		//echo '<pre>';
		//print_r($package_log_hist);die;
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            return $this->redirect(['view', 'id' => $model->id]);
        } 
        else 
        {
        	 $productlist=Product::find()->asArray()->all();
			 $productlist_index=ArrayHelper::index($productlist,'productid');
			  
			 	 							
			  foreach ($productlist as $key => $value)
			  {
					$productlist_col_val[] = array('productname' => $value['productname'],'productid' => $value['productid']);
			  }
				$productlist_col_json = json_encode($productlist_col_val);
			  
  $result_string='';
  if(!empty($package_log_hist))
  {
  	foreach ($package_log_hist as $key => $value) 
  	{
		$result_string.='<tr id="producttbl'.$value['product_id'].'" class="producttbl" data-id='.$value['product_id'].'><td class="text-center"><input type="hidden"  data-id='.$value['product_id'].' name="ProductID[]" class="form-control productid" id="productid'.$value['product_id'].'" value='.$value['product_id'].'>
<input type="text"  data-id='.$value['product_id'].' style="text-align:center;" readonly value='.$productlist_index[$value['product_id']]['productname'].' name="ProductName[]" class="form-control productname" id="productname'.$value['product_id'].'"></td>
<td class="text-center"><input type="text"  data-id='.$value['product_id'].' style="text-align:center;" readonly name="ProductQty[]" value='.$value['qty'].' class="form-control productqty" id="productqty'.$value['product_id'].'"></td>
<td class="text-center"><button data-id='.$value['product_id'].' onclick="ProductRemove('.$value['product_id'].','.$value['id'].');" class="remove btn btn-danger btn-xs productremove" id="productremove'.$value['product_id'].'" type="button"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></button></td>
</tr>';  
	}
  }
			  
			  	
            return $this->render('update', [
                'model' => $model,
                'package_log' => $package_log,
                'productlist_col_json' =>$productlist_col_json,
                'package_log_hist' => $package_log_hist,
                'result_string' =>$result_string,
            ]);
        }
    }
    
    
	public function actionDeleteproduct($id,$packid)
	{
		if(!empty($id))
		{
			//ProductPackagemaster::updateAll(['pack_name' => $_POST['pack_name']], ['id' => $packid]);
			$product_package_log=ProductPackageLog::find()->where(['id'=>$id])->one();
			if($product_package_log->delete())
			{
				$package_log_hist=ProductPackageLog::find()->where(['pack_id'=>$packid])->all();
				
				 $productlist=Product::find()->asArray()->all();
			 	$productlist_index=ArrayHelper::index($productlist,'productid');
				
				 $result_string='';
				  if(!empty($package_log_hist))
				  {
				  	foreach ($package_log_hist as $key => $value) 
				  	{
						$result_string.='<tr id="producttbl'.$value['product_id'].'" class="producttbl" data-id='.$value['product_id'].'><td class="text-center"><input type="hidden"  data-id='.$value['product_id'].' name="ProductID[]" class="form-control productid" id="productid'.$value['product_id'].'" value='.$value['product_id'].'>
				<input type="text"  data-id='.$value['product_id'].' style="text-align:center;" readonly value='.$productlist_index[$value['product_id']]['productname'].' name="ProductName[]" class="form-control productname" id="productname'.$value['product_id'].'"></td>
				<td class="text-center"><input type="text"  data-id='.$value['product_id'].' style="text-align:center;" readonly name="ProductQty[]" value='.$value['qty'].' class="form-control productqty" id="productqty'.$value['product_id'].'"></td>
				<td class="text-center"><button data-id='.$value['product_id'].' onclick="ProductRemove('.$value['product_id'].','.$value['id'].');" class="remove btn btn-danger btn-xs productremove" id="productremove'.$value['product_id'].'" type="button"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></button></td>
				</tr>';  
					}
				  }
					$fetch_array=array();
					$fetch_array[0]='save';
					$fetch_array[1]=$result_string;
					return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
			}
		}
	}
	
	public function actionSavedproduct($id)
	{
		if($_POST)
		{
			
			ProductPackagemaster::updateAll(['pack_name' => $_POST['pack_name']], ['id' => $id]);
			
			$product_package_log=new ProductPackageLog();
			$product_package_log->pack_id=$id;
			$product_package_log->product_id=$_POST['productid'];
			$product_package_log->qty=$_POST['qty'];
			$product_package_log->created_at=date('Y-m-d H:i:s');
			$product_package_log->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
			
			if($product_package_log->save())
			{
				$package_log_hist=ProductPackageLog::find()->where(['pack_id'=>$id])->all();
				
				$productlist=Product::find()->asArray()->all();
			 	$productlist_index=ArrayHelper::index($productlist,'productid');
				
				 $result_string='';
				  if(!empty($package_log_hist))
				  {
				  	foreach ($package_log_hist as $key => $value) 
				  	{
						$result_string.='<tr id="producttbl'.$value['product_id'].'" class="producttbl" data-id='.$value['product_id'].'><td class="text-center"><input type="hidden"  data-id='.$value['product_id'].' name="ProductID[]" class="form-control productid" id="productid'.$value['product_id'].'" value='.$value['product_id'].'>
										<input type="text"  data-id='.$value['product_id'].' style="text-align:center;" readonly value='.$productlist_index[$value['product_id']]['productname'].' name="ProductName[]" class="form-control productname" id="productname'.$value['product_id'].'"></td>
										<td class="text-center"><input type="text"  data-id='.$value['product_id'].' style="text-align:center;" readonly name="ProductQty[]" value='.$value['qty'].' class="form-control productqty" id="productqty'.$value['product_id'].'"></td>
										<td class="text-center"><button data-id='.$value['product_id'].' onclick="ProductRemove('.$value['product_id'].','.$value['id'].');" class="remove btn btn-danger btn-xs productremove" id="productremove'.$value['product_id'].'" type="button"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></button></td>
										</tr>';  
					}
				  }
					$fetch_array=array();
					$fetch_array[0]='save';
					$fetch_array[1]=$result_string;
					return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
			}
		}
	}
	
	

    /**
     * Deletes an existing ProductPackagemaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductPackagemaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductPackagemaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductPackagemaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
