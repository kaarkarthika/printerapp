<?php

namespace backend\controllers;

use Yii;
use backend\models\Taxgrouping;
use backend\models\ServiceuserLogin;
use backend\models\AuthProjectModule;
use backend\models\TaxgroupingSearch;
use yii\web\Controller;
use backend\models\Product;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\models\BranchAdmin;
use backend\models\Taxmaster;
use backend\models\TaxgroupingLog;

class TaxgroupingController extends Controller
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
                                  'access' => [
           'class' => AccessControl::className(),
           'rules' => [
               [
                   'allow' => true,
                   'roles' => ['@'],
               ],

           ],
       ],
        ];
    }
	
	 

 public function beforeAction($action) {
          return BranchAdmin::checkbeforeaction();
	}
  

   
    public function actionIndex()
    {
        $searchModel = new TaxgroupingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$taxmaster=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(), 'taxid', 'taxgroup');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'taxmaster' => $taxmaster,
        ]);
    }

   
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

  
    public function actionCreate()
    {
        $model = new Taxgrouping();

       if ($model->load(Yii::$app->request->post()))
		{
        	$active=Yii::$app->request->post('Taxgrouping')['is_active'];
			 $groupid=Yii::$app->request->post('Taxgrouping')['groupid'];
			 $taxgroupdata=Taxmaster::find()->where(['taxid'=>$groupid])->one();
			  $hsncode=Yii::$app->request->post('Taxgrouping')['hsncode'];
			  $effected_date=date('Y-m-d',strtotime(Yii::$app->request->post('Taxgrouping')['effect_date']));
			  $group_name=Yii::$app->request->post('Taxgrouping')['groupname'];
			 $tax=$taxgroupdata->taxvalue;
			 $session = Yii::$app->session;
			 
			 
				 $model->groupid=$groupid;
				 $model->hsncode=$hsncode;
				 $model->tax=$tax;
				 $model->groupname=$group_name;
				 $model->effect_date=$effected_date; 
				
				$model->is_active=$active;
		        $model->updated_by=$session['user_id'];
				$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
				$model->updated_on=date("Y-m-d H:i:s");
				$taxgroupdata=Taxgrouping::find()->where(['hsncode'=>$hsncode])->andWhere(['groupid'=>$model->groupid])->one();
				
			
			if(empty($taxgroupdata))
			{
				if($model->save())
				{
					TaxgroupingLog::updateAll(['is_active'=>0],['hsncode'=>$model->hsncode,'is_active'=>1,'groupid'=>$model->groupid]);
					
					 $taxmaster=Taxmaster::find()->where(['taxid'=>$model->groupid])->asArray()->one();
					
					$taxgroupinglog = new TaxgroupingLog();
					$taxgroupinglog->taxgroupid = $model->taxgroupid;
					$taxgroupinglog->hsncode = $model->hsncode;
					$taxgroupinglog->groupid = $model->groupid;
					$taxgroupinglog->tax=$taxmaster['taxvalue'];
	        		$taxgroupinglog->additional_tax=$taxmaster['additionaltax'];
					$taxgroupinglog->last_effected_date = $model->effect_date;
					$taxgroupinglog->is_active = $model->is_active;
					$taxgroupinglog->updated_by = $model->updated_by;
					$taxgroupinglog->created_at = date('Y-m-d H:i:s');
					$taxgroupinglog->updated_ipaddress = $model->updated_ipaddress;
					if($taxgroupinglog->save())
					{
						echo "Y";
					}
					else 
					{
						print_r($taxgroupinglog->getErrors());die;	
					}
				}
				
			}
			else if(!empty($taxgroupdata))
			{
				echo "E";
			}
			else
			{
				 print_r($model->getErrors());  
				 echo "N";
			}
        }  else {
        	
			
			
        		$productlist=ArrayHelper::map(Product::find()->groupBy('hsn_code')->where(['is_active'=>1])->asArray()->all(), 'hsn_code', 'hsn_code');
				$taxgrouplist=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(), 'taxid', 'taxgroup');
			
            return $this->renderAjax('create', [
                'model' => $model,
                'productlist'=>$productlist,
                'taxgrouplist'=>$taxgrouplist,
            ]);
        }
    }

   
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
 		if ($model->load(Yii::$app->request->post()))
		 {
        	$active=Yii::$app->request->post('Taxgrouping')['is_active'];
			$active=Yii::$app->request->post('Taxgrouping')['is_active'];
			 $groupid=Yii::$app->request->post('Taxgrouping')['groupid'];
			 $taxgroupdata=Taxmaster::find()->where(['taxid'=>$groupid])->one();
			  $hsncode=Yii::$app->request->post('Taxgrouping')['hsncode'];
			  $effected_date=date('Y-m-d',strtotime(Yii::$app->request->post('Taxgrouping')['effect_date']));
			  
			  $group_name=Yii::$app->request->post('Taxgrouping')['groupname'];
			 $tax=$taxgroupdata->taxvalue;
			 $session = Yii::$app->session;
			 
			 
				$model->groupid=$groupid;
				$model->hsncode=$hsncode;
				$model->tax=$tax;
				$model->groupname=$group_name;
				$model->effect_date=$effected_date; 
				$model->is_active=$active;
		        $model->updated_by=$session['user_id'];
				$model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
				$model->updated_on=date("Y-m-d H:i:s");
				$taxgroupdata=Taxgrouping::find()->where(['hsncode'=>$hsncode])->andWhere(['groupid'=>$model->groupid])->one();
				
				$taxgroupdata_effect_date=Taxgrouping::find()->where(['hsncode'=>$hsncode])->andWhere(['groupid'=>$model->groupid])->andWhere(['LIKE','effect_date',$effected_date])->one();
				
			if(empty($taxgroupdata) || empty($taxgroupdata_effect_date))
			{
				if($model->save())
				{
					TaxgroupingLog::updateAll(['is_active'=>0],['hsncode'=>$model->hsncode,'is_active'=>1,'groupid'=>$model->groupid]);
					
					$taxmaster=Taxmaster::find()->where(['taxid'=>$model->groupid])->asArray()->one();
					$taxgroupinglog = new TaxgroupingLog();
					$taxgroupinglog->taxgroupid = $model->taxgroupid;
					$taxgroupinglog->hsncode = $model->hsncode;
					$taxgroupinglog->groupid = $model->groupid;
					$taxgroupinglog->tax=$taxmaster['taxvalue'];
					$taxgroupinglog->additional_tax=$taxmaster['additionaltax'];
					$taxgroupinglog->last_effected_date = $model->effect_date;
					$taxgroupinglog->is_active = $model->is_active;
					$taxgroupinglog->updated_by = $model->updated_by;
					$taxgroupinglog->created_at = date('Y-m-d H:i:s');
					$taxgroupinglog->updated_ipaddress = $model->updated_ipaddress;
					if($taxgroupinglog->save())
					{
						echo "Y";
					}
					else 
					{
						print_r($taxgroupinglog->getErrors());die;	
					}
				}
				else 
				{
					print_r($model->getErrors());die;	
				}
			}
			else if(!empty($taxgroupdata) || !empty($taxgroupdata_effect_date))
			{
				echo "E";
			}
			else
			{
				
				echo "N";
			}
        } 
       
        
        else {
        		$productlist=ArrayHelper::map(Product::find()->groupBy('hsn_code')->where(['is_active'=>1])->asArray()->all(), 'hsn_code', 'hsn_code');
			$taxgrouplist=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(), 'taxid', 'taxgroup');
            return $this->renderAjax('update', [
                'model' => $model,
                'productlist'=>$productlist,
                 'taxgrouplist'=>$taxgrouplist,
            ]);
        }
    }

   
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

  
    protected function findModel($id)
    {
        if (($model = Taxgrouping::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
