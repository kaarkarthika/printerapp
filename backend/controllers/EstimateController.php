<?php

namespace backend\controllers;

use Yii;
use backend\models\Estimate;
use backend\models\EstimateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\CustomerMaster;
use backend\models\AutoIdtable;
use backend\models\EstimateMainTblLog;
use backend\models\EstimateLog;
use backend\models\EstimateMainTbl;
use backend\models\EstimateMainTblSearch;
use yii\helpers\ArrayHelper;
use backend\models\Taxmaster;
use backend\models\ConfigYear;
use backend\models\Configuration;
use yii\helpers\Html;
/**
 * EstimateController implements the CRUD actions for Estimate model.
 */
class EstimateController extends Controller
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

    public function beforeAction($action) {
   $this->enableCsrfValidation = true;
   return parent::beforeAction($action);
}

    /**
     * Lists all Estimate models.
     * @return mixed
     */
    public function actionIndex1()
    {
        $searchModel = new EstimateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     public function actionIndex()
    {
        $EstimateMainTbl= new EstimateMainTbl();
        $searchModel = new EstimateMainTblSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_main_tbl', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReindex()
    {
        $EstimateMainTbl= new EstimateMainTbl();
        $searchModel = new EstimateMainTblSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        Yii::$app->session->setFlash('success', 'Record Saved Successfully');
        return $this->render('index_main_tbl', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Estimate model.
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
     * Creates a new Estimate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Estimate();
        $customer_master= CustomerMaster::find()->asArray()->all();
        $session = Yii::$app->session;

         $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

         $tax_master_fetch=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxvalue');

         $estimate_main_tbl_create=new EstimateMainTbl();

        if (Yii::$app->request->post()) 
        {
          
            $fetch_array=array();
            if(!empty($_POST['custId']))
            {
                $customer_master_one= CustomerMaster::findOne($_POST['custId']);

                if($customer_master_one->company_name == $_POST['EstimateMainTbl']['company_name'])
                {
                    $curr_year=$this->ConfigReset();
                    $AutoIdtable=AutoIdtable::findOne(1);
                    
                    $config=$this->findConfiguration();

                    

                    $autoget=$AutoIdtable->number_field;
                    $inc_value=$autoget+1;
                    $rtno = str_pad($autoget, 4, "0", STR_PAD_LEFT);
                    $rtno='EST-'.$curr_year.'-'.$rtno;
                    

                    $estimate_main_tbl=new EstimateMainTbl();
                    $estimate_main_tbl->customer_id=$_POST['custId'];
                    $estimate_main_tbl->company_name=$_POST['EstimateMainTbl']['company_name'];
                    $estimate_main_tbl->customer_name=$_POST['EstimateMainTbl']['customer_name'];
                    $estimate_main_tbl->bill_number=$rtno;
                    $estimate_main_tbl->gst=$_POST['EstimateMainTbl']['gst'];
                    $estimate_main_tbl->gst_type=$_POST['EstimateMainTbl']['gst_type'];

                    if($_POST['EstimateMainTbl']['gst_type'] == 'GST')
                    {
                        $tax_value=$tax_master_fetch[$_POST['EstimateMainTbl']['gst']];
                        $estimate_main_tbl->gst_percent=$tax_value;
                        $estimate_main_tbl->cgst_percent=$tax_value/2;
                        $estimate_main_tbl->sgst_percent=$tax_value/2;
                    }
                    else if($_POST['EstimateMainTbl']['gst_type'] == 'IGST')
                    {
                        $estimate_main_tbl->gst_percent=$tax_master_fetch[$_POST['EstimateMainTbl']['gst']];
                        $estimate_main_tbl->cgst_percent=null;
                        $estimate_main_tbl->sgst_percent=null;
                    }

                    $estimate_main_tbl->sac=$config['SAC CODE']['value'];
                    $estimate_main_tbl->total_amount=array_sum($_POST['EstimateAmount']);
                    $estimate_main_tbl->created_at=date('Y-m-d H:i:s');
                    $estimate_main_tbl->user_id=$session['headlinestv_id'];
                    $estimate_main_tbl->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
                    
                    if($estimate_main_tbl->save())
                    {
                        $estimate_main_tbl_log=new EstimateMainTblLog();
                        $estimate_main_tbl_log->estimate_main_tbl_id=$estimate_main_tbl->id;   
                        $estimate_main_tbl_log->customer_id=$_POST['custId'];
                        $estimate_main_tbl_log->company_name=$_POST['EstimateMainTbl']['company_name'];
                        $estimate_main_tbl_log->customer_name=$_POST['EstimateMainTbl']['customer_name'];
                        $estimate_main_tbl_log->bill_number=$rtno;
                        $estimate_main_tbl_log->gst=$_POST['EstimateMainTbl']['gst'];
                        $estimate_main_tbl_log->sac=$config['SAC CODE']['value'];
                        $estimate_main_tbl_log->total_amount=array_sum($_POST['EstimateAmount']);
                        $estimate_main_tbl_log->created_at=date('Y-m-d H:i:s');
                        $estimate_main_tbl_log->user_id=$session['headlinestv_id'];
                        $estimate_main_tbl_log->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
                        if($estimate_main_tbl_log->save())
                        {
                            foreach ($_POST['EstimateTypeValue'] as $key => $value) 
                            {
                               $Estimate = new Estimate();
                               $Estimate->est_main_id=$estimate_main_tbl->id;
                               $Estimate->customer_id= $estimate_main_tbl->customer_id;
                               $Estimate->company_name=$_POST['EstimateMainTbl']['company_name'];
                               $Estimate->customer_name=$_POST['EstimateMainTbl']['customer_name'];
                               $Estimate->bill_number=$estimate_main_tbl->bill_number;
                               $Estimate->particular_field=$value;
                               $Estimate->amount  =$_POST['EstimateAmount'][$key];
                               $Estimate->created_at  =date('Y-m-d H:i:s');
                               $Estimate->user_id  =$session['headlinestv_id'];
                               $Estimate->updated_ipaddress  =$_SERVER['REMOTE_ADDR'];
                               
                               if($Estimate->save())
                               {
                                   $Estimate_log = new EstimateLog();
                                   $Estimate_log->estimate_main_tbl_log= $estimate_main_tbl_log->auto_id;
                                   $Estimate_log->estimate_id=$Estimate->auto_id;
                                   $Estimate_log->customer_id= $Estimate->customer_id;

                                   $Estimate_log->company_name=  $Estimate->company_name;
                                   $Estimate_log->customer_name=  $Estimate->customer_name;
                                   

                                   $Estimate_log->bill_number=$Estimate->bill_number;
                                   $Estimate_log->particular_field=$value;
                                   $Estimate_log->amount  =$_POST['EstimateAmount'][$key];
                                   $Estimate_log->created_at  =date('Y-m-d H:i:s');
                                   $Estimate_log->user_id  =$session['headlinestv_id'];
                                   $Estimate_log->updated_ipaddress  =$_SERVER['REMOTE_ADDR'];

                                   if($Estimate_log->save())
                                   {

                                   }
                                   else
                                   {
                                        echo '<pre>';
                                        //print_r('EstimateLog');
                                        print_r($Estimate->getErrors());die;
                                   }
                               }
                               else
                               {
                                    echo '<pre>';
                                   // print_r('Estimate');
                                    print_r($Estimate->getErrors());die;
                               }

                            }

                             AutoIdtable::updateAll(['number_field' => $inc_value], ['id' => 1]);


                           $fetch_array[0]='okay';
                          $fetch_array[1]=$rtno;
                          return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                          //return $this->redirect(array('estimate/print','id'=>$estimate_main_tbl->id,'_blank'));
                           


                            // return $this->redirect(['print','id'=>$estimate_main_tbl->id],['target'=>'_blank']);

                             //echo Html::a('View', ['print', 'id' =>  $estimate_main_tbl->id], ['target'=>'_blank']);

                        }
                        else
                        {
                            echo '<pre>';
                            //print_r('EstimateMainTblLog');
                            print_r($estimate_main_tbl_log->getErrors());die;
                        }
                    }
                    else
                    {
                        echo '<pre>';
                        //print_r('EstimateMainTbl');
                        print_r($estimate_main_tbl->getErrors());die;
                    }
                   
                    //$fetch_array[0]='okay';
                    //$fetch_array[1]=$rtno;
                    //return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

                }
                else
                {
                    $fetch_array[0]='invalid';

                    return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                }
            }
            else
            {
                $fetch_array[0]='invalid';

                 return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
            }

 
        }
        else
        {
            return $this->render('create', [
              'model' => $model,
              'customer_master' => $customer_master,
              'tax_master' => $tax_master,
              'estimate_main_tbl_create'=> $estimate_main_tbl_create
            ]);    
        }
        
    }


    public function actionSaveprint()
    { 
         $model = new Estimate();
        $customer_master= CustomerMaster::find()->asArray()->all();
         $session = Yii::$app->session;

         $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

         $tax_master_fetch=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxvalue');

         $estimate_main_tbl_create=new EstimateMainTbl();

        if (Yii::$app->request->post())
        {

           
            $fetch_array=array();
            if(!empty($_POST['custId']))
            {
                $customer_master_one= CustomerMaster::findOne($_POST['custId']);

                if($customer_master_one->company_name == $_POST['EstimateMainTbl']['company_name'])
                {
                     $config=$this->findConfiguration();

                    $curr_year=$this->ConfigReset();
                    $AutoIdtable=AutoIdtable::findOne(1);
                    //echo '<pre>';
                   // print_r($_POST);die;

                    $autoget=$AutoIdtable->number_field;
                    $inc_value=$autoget+1;
                    $rtno = str_pad($autoget, 4, "0", STR_PAD_LEFT);
                    $rtno='EST-'.$curr_year.'-'.$rtno;
                    

                    $estimate_main_tbl=new EstimateMainTbl();
                    $estimate_main_tbl->customer_id=$_POST['custId'];
                    $estimate_main_tbl->company_name=$_POST['EstimateMainTbl']['company_name'];
                    $estimate_main_tbl->customer_name=$_POST['EstimateMainTbl']['customer_name'];
                    $estimate_main_tbl->bill_number=$rtno;
                    $estimate_main_tbl->gst=$_POST['EstimateMainTbl']['gst'];
                    $estimate_main_tbl->gst_type=$_POST['EstimateMainTbl']['gst_type'];

                    if($_POST['EstimateMainTbl']['gst_type'] == 'GST')
                    {
                        $tax_value=$tax_master_fetch[$_POST['EstimateMainTbl']['gst']];
                        $estimate_main_tbl->gst_percent=$tax_value;
                        $estimate_main_tbl->cgst_percent=$tax_value/2;
                        $estimate_main_tbl->sgst_percent=$tax_value/2;
                    }
                    else if($_POST['EstimateMainTbl']['gst_type'] == 'IGST')
                    {
                        $estimate_main_tbl->gst_percent=$tax_master_fetch[$_POST['EstimateMainTbl']['gst']];
                        $estimate_main_tbl->cgst_percent=null;
                        $estimate_main_tbl->sgst_percent=null;
                    }

                    $estimate_main_tbl->sac=$config['SAC CODE']['value'];
                    $estimate_main_tbl->total_amount=array_sum($_POST['EstimateAmount']);
                    $estimate_main_tbl->created_at=date('Y-m-d H:i:s');
                    $estimate_main_tbl->user_id=$session['headlinestv_id'];
                    $estimate_main_tbl->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
                    
                    if($estimate_main_tbl->save())
                    {
                        $estimate_main_tbl_log=new EstimateMainTblLog();
                        $estimate_main_tbl_log->estimate_main_tbl_id=$estimate_main_tbl->id;   
                        $estimate_main_tbl_log->customer_id=$_POST['custId'];
                        $estimate_main_tbl_log->company_name=$_POST['EstimateMainTbl']['company_name'];
                        $estimate_main_tbl_log->customer_name=$_POST['EstimateMainTbl']['customer_name'];
                        $estimate_main_tbl_log->bill_number=$rtno;
                        $estimate_main_tbl_log->gst=$_POST['EstimateMainTbl']['gst'];
                        $estimate_main_tbl_log->sac=$config['SAC CODE']['value'];
                        $estimate_main_tbl_log->total_amount=array_sum($_POST['EstimateAmount']);
                        $estimate_main_tbl_log->created_at=date('Y-m-d H:i:s');
                        $estimate_main_tbl_log->user_id=$session['headlinestv_id'];
                        $estimate_main_tbl_log->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
                        if($estimate_main_tbl_log->save())
                        {
                            foreach ($_POST['EstimateTypeValue'] as $key => $value) 
                            {
                               $Estimate = new Estimate();
                               $Estimate->est_main_id=$estimate_main_tbl->id;
                               $Estimate->customer_id= $estimate_main_tbl->customer_id;
                               $Estimate->company_name=$_POST['EstimateMainTbl']['company_name'];
                               $Estimate->customer_name=$_POST['EstimateMainTbl']['customer_name'];
                               $Estimate->bill_number=$estimate_main_tbl->bill_number;
                               $Estimate->particular_field=$value;
                               $Estimate->amount  =$_POST['EstimateAmount'][$key];
                               $Estimate->created_at  =date('Y-m-d H:i:s');
                               $Estimate->user_id  =$session['headlinestv_id'];
                               $Estimate->updated_ipaddress  =$_SERVER['REMOTE_ADDR'];
                               
                               if($Estimate->save())
                               {
                                   $Estimate_log = new EstimateLog();
                                   $Estimate_log->estimate_main_tbl_log= $estimate_main_tbl_log->auto_id;
                                   $Estimate_log->estimate_id=$Estimate->auto_id;
                                   $Estimate_log->customer_id= $Estimate->customer_id;

                                   $Estimate_log->company_name=  $Estimate->company_name;
                                   $Estimate_log->customer_name=  $Estimate->customer_name;
                                   

                                   $Estimate_log->bill_number=$Estimate->bill_number;
                                   $Estimate_log->particular_field=$value;
                                   $Estimate_log->amount  =$_POST['EstimateAmount'][$key];
                                   $Estimate_log->created_at  =date('Y-m-d H:i:s');
                                   $Estimate_log->user_id  =$session['headlinestv_id'];
                                   $Estimate_log->updated_ipaddress  =$_SERVER['REMOTE_ADDR'];

                                   if($Estimate_log->save())
                                   {

                                   }
                                   else
                                   {
                                        echo '<pre>';
                                        //print_r('EstimateLog');
                                        print_r($Estimate->getErrors());die;
                                   }
                               }
                               else
                               {
                                    echo '<pre>';
                                   // print_r('Estimate');
                                    print_r($Estimate->getErrors());die;
                               }

                            }

                             AutoIdtable::updateAll(['number_field' => $inc_value], ['id' => 1]);


                          $fetch_array[0]='okay';
                          $fetch_array[1]= $estimate_main_tbl->id;
                          return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

                        }
                        else
                        {
                            echo '<pre>';
                            //print_r('EstimateMainTblLog');
                            print_r($estimate_main_tbl_log->getErrors());die;
                        }
                    }
                    else
                    {
                        echo '<pre>';
                        //print_r('EstimateMainTbl');
                        print_r($estimate_main_tbl->getErrors());die;
                    }
                   
                    //$fetch_array[0]='okay';
                    //$fetch_array[1]=$rtno;
                    //return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

                }
                else
                {
                    $fetch_array[0]='invalid';

                    return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                }
            }
            else
            {
                $fetch_array[0]='invalid';

                 return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
            }

 
        }

    }


    /**
     * Updates an existing Estimate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        //$model = $this->findModel($id);
        

        $estimate=$this->findEstimateTable($id);
        $customer_master= CustomerMaster::find()->asArray()->all();
        $session = Yii::$app->session;
        $model=new Estimate();
        $customer_master_single_fetch=CustomerMaster::find()->where(['auto_id'=>$estimate['customer_id']])->asArray()->one();
        $Estimate=Estimate::find()->where(['est_main_id'=>$id])->asArray()->all();

        $estimate_main_tbl_create=EstimateMainTbl::findOne($id);
        $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

        $tax_master_fetch=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxvalue');

        if ($estimate->load(Yii::$app->request->post())) 
        {
          
             $config=$this->findConfiguration();
            EstimateMainTbl::updateAll(['gst'=>$_POST['EstimateMainTbl']['gst'] ,'gst_type'=>$_POST['EstimateMainTbl']['gst_type'] ,'gst_percent'=> $tax_master_fetch[$_POST['EstimateMainTbl']['gst']] ,'cgst_percent'=> $_POST['EstimateMainTbl']['gst_type'] == 'GST' ? $tax_master_fetch[$_POST['EstimateMainTbl']['gst']]/2 : null,'sgst_percent'=> $_POST['EstimateMainTbl']['gst_type'] == 'GST' ? $tax_master_fetch[$_POST['EstimateMainTbl']['gst']]/2 : null,'sac'=>$config['SAC CODE']['value'],'total_amount' => array_sum($_POST['EstimateAmount']),'user_id' => $session['headlinestv_id'],'updated_ipaddress'=> $_SERVER['REMOTE_ADDR']], ['id' => $id ]);
            
            Estimate::deleteAll(['est_main_id' => $id]);
            

            $estimate_main_tbl_log=new EstimateMainTblLog();
            $estimate_main_tbl_log->estimate_main_tbl_id=$id;   
            $estimate_main_tbl_log->customer_id=$estimate['customer_id'];
            $estimate_main_tbl_log->company_name=$_POST['EstimateMainTbl']['company_name'];
            $estimate_main_tbl_log->customer_name=$_POST['EstimateMainTbl']['customer_name'];
            $estimate_main_tbl_log->bill_number=$_POST['EstimateMainTbl']['bill_number'];
            $estimate_main_tbl_log->gst=$_POST['EstimateMainTbl']['gst'];
            $estimate_main_tbl_log->sac=$config['SAC CODE']['value'];
            $estimate_main_tbl_log->total_amount=array_sum($_POST['EstimateAmount']);
            $estimate_main_tbl_log->created_at=date('Y-m-d H:i:s');
            $estimate_main_tbl_log->user_id=$session['headlinestv_id'];
            $estimate_main_tbl_log->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
            if($estimate_main_tbl_log->save())
            {
                foreach ($_POST['EstimateTypeValue'] as $key => $value) 
                {
                       $Estimate = new Estimate();
                       $Estimate->est_main_id= $estimate->id;
                       $Estimate->customer_id=  $estimate->customer_id;
                       $Estimate->company_name=  $_POST['EstimateMainTbl']['company_name'];
                       $Estimate->customer_name=  $_POST['EstimateMainTbl']['customer_name'];
                       $Estimate->bill_number= $estimate->bill_number;
                       $Estimate->particular_field=$value;
                       $Estimate->amount  =$_POST['EstimateAmount'][$key];
                       $Estimate->created_at  =date('Y-m-d H:i:s');
                       $Estimate->user_id  =$session['headlinestv_id'];
                       $Estimate->updated_ipaddress  =$_SERVER['REMOTE_ADDR'];
                       
                       if($Estimate->save())
                       {
                           $Estimate_log = new EstimateLog();
                           $Estimate_log->estimate_main_tbl_log= $estimate_main_tbl_log->auto_id;
                           $Estimate_log->estimate_id=$Estimate->auto_id;
                           $Estimate_log->customer_id= $estimate->customer_id;

                           $Estimate_log->company_name=  $_POST['EstimateMainTbl']['company_name'];
                           $Estimate_log->customer_name=  $_POST['EstimateMainTbl']['customer_name'];

                           $Estimate_log->bill_number=$estimate->bill_number;
                           $Estimate_log->particular_field=$value;
                           $Estimate_log->amount  =$_POST['EstimateAmount'][$key];
                           $Estimate_log->created_at  =date('Y-m-d H:i:s');
                           $Estimate_log->user_id  =$session['headlinestv_id'];
                           $Estimate_log->updated_ipaddress  =$_SERVER['REMOTE_ADDR'];

                           if($Estimate_log->save())
                           {

                           }
                           else
                           {
                                echo '<pre>';
                                //print_r('EstimateLog');
                                print_r($Estimate->getErrors());die;
                           }

                       }
                }


                 $fetch_array[0]='okay';

            return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

            }
            else
            {
                echo '<pre>';
                print_r($estimate_main_tbl_log->getErrors());die;
            }

           
            
        }
        else
        {
            return $this->render('updateform', [
                'estimate' => $estimate,
                'customer_master' => $customer_master,
                'model'=>$model,
                'customer_master_single_fetch'=>$customer_master_single_fetch,
                'Estimate' =>$Estimate,
                'tax_master' => $tax_master,
                'estimate_main_tbl_create'=> $estimate_main_tbl_create
            ]);   
        }
        
    }


    public function actionUpdateprint($id)
    {
        $estimate=$this->findEstimateTable($id);
        $customer_master= CustomerMaster::find()->asArray()->all();
        $session = Yii::$app->session;
        $model=new Estimate();
        $customer_master_single_fetch=CustomerMaster::find()->where(['auto_id'=>$estimate['customer_id']])->asArray()->one();
        $Estimate=Estimate::find()->where(['est_main_id'=>$id])->asArray()->all();

        $estimate_main_tbl_create=EstimateMainTbl::findOne($id);
        $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

        $tax_master_fetch=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxvalue');

        if ($estimate->load(Yii::$app->request->post())) 
        {
          
             $config=$this->findConfiguration();
            EstimateMainTbl::updateAll(['gst'=>$_POST['EstimateMainTbl']['gst'] ,'gst_type'=>$_POST['EstimateMainTbl']['gst_type'] ,'gst_percent'=> $tax_master_fetch[$_POST['EstimateMainTbl']['gst']] ,'cgst_percent'=> $_POST['EstimateMainTbl']['gst_type'] == 'GST' ? $tax_master_fetch[$_POST['EstimateMainTbl']['gst']]/2 : null,'sgst_percent'=> $_POST['EstimateMainTbl']['gst_type'] == 'GST' ? $tax_master_fetch[$_POST['EstimateMainTbl']['gst']]/2 : null,'sac'=>$config['SAC CODE']['value'],'total_amount' => array_sum($_POST['EstimateAmount']),'user_id' => $session['headlinestv_id'],'updated_ipaddress'=> $_SERVER['REMOTE_ADDR']], ['id' => $id ]);
            
            Estimate::deleteAll(['est_main_id' => $id]);
            

            $estimate_main_tbl_log=new EstimateMainTblLog();
            $estimate_main_tbl_log->estimate_main_tbl_id=$id;   
            $estimate_main_tbl_log->customer_id=$estimate['customer_id'];
            $estimate_main_tbl_log->company_name=$_POST['EstimateMainTbl']['company_name'];
            $estimate_main_tbl_log->customer_name=$_POST['EstimateMainTbl']['customer_name'];
            $estimate_main_tbl_log->bill_number=$_POST['EstimateMainTbl']['bill_number'];
            $estimate_main_tbl_log->gst=$_POST['EstimateMainTbl']['gst'];
            $estimate_main_tbl_log->sac=$config['SAC CODE']['value'];;
            $estimate_main_tbl_log->total_amount=array_sum($_POST['EstimateAmount']);
            $estimate_main_tbl_log->created_at=date('Y-m-d H:i:s');
            $estimate_main_tbl_log->user_id=$session['headlinestv_id'];
            $estimate_main_tbl_log->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
            if($estimate_main_tbl_log->save())
            {
                foreach ($_POST['EstimateTypeValue'] as $key => $value) 
                {
                       $Estimate = new Estimate();
                       $Estimate->est_main_id= $estimate->id;
                       $Estimate->customer_id=  $estimate->customer_id;
                       $Estimate->company_name=  $_POST['EstimateMainTbl']['company_name'];
                       $Estimate->customer_name=  $_POST['EstimateMainTbl']['customer_name'];
                       $Estimate->bill_number= $estimate->bill_number;
                       $Estimate->particular_field=$value;
                       $Estimate->amount  =$_POST['EstimateAmount'][$key];
                       $Estimate->created_at  =date('Y-m-d H:i:s');
                       $Estimate->user_id  =$session['headlinestv_id'];
                       $Estimate->updated_ipaddress  =$_SERVER['REMOTE_ADDR'];
                       
                       if($Estimate->save())
                       {
                           $Estimate_log = new EstimateLog();
                           $Estimate_log->estimate_main_tbl_log= $estimate_main_tbl_log->auto_id;
                           $Estimate_log->estimate_id=$Estimate->auto_id;
                           $Estimate_log->customer_id= $estimate->customer_id;

                           $Estimate_log->company_name=  $_POST['EstimateMainTbl']['company_name'];
                           $Estimate_log->customer_name=  $_POST['EstimateMainTbl']['customer_name'];

                           $Estimate_log->bill_number=$estimate->bill_number;
                           $Estimate_log->particular_field=$value;
                           $Estimate_log->amount  =$_POST['EstimateAmount'][$key];
                           $Estimate_log->created_at  =date('Y-m-d H:i:s');
                           $Estimate_log->user_id  =$session['headlinestv_id'];
                           $Estimate_log->updated_ipaddress  =$_SERVER['REMOTE_ADDR'];

                           if($Estimate_log->save())
                           {

                           }
                           else
                           {
                                echo '<pre>';
                                //print_r('EstimateLog');
                                print_r($Estimate->getErrors());die;
                           }

                       }
                }


                 $fetch_array[0]='okay';
                 $fetch_array[1]=$id;
            return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

            }
            else
            {
                echo '<pre>';
                print_r($estimate_main_tbl_log->getErrors());die;
            }

           
            
        }
    }


    /**
     * Deletes an existing Estimate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findEstimateTable($id)->delete();
        Estimate::deleteAll(['est_main_id' => $id]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Estimate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Estimate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Estimate::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    protected function findEstimateTable($id)
    {
        if (($model = EstimateMainTbl::findOne($id)) !== null) {
            return $model;
        }
    }

    protected function findConfiguration()
    {
        $config=ArrayHelper::index(Configuration::find()->asArray()->all(),'key_drop');
        if(!empty($config))
        {
            return $config;
        }
        
    }


  public function actionPrint($id)
  {
  
    $estimate_main_tbl=EstimateMainTbl::find()->where(['id'=>$id])->asArray()->one();

    $config=$this->findConfiguration();
    $estimate=Estimate::find()->where(['est_main_id'=>$id])->asArray()->all();
    
    $estimate_index=ArrayHelper::index($estimate,'auto_id');

    

    $customer_master=CustomerMaster::find()->where(['auto_id'=>$estimate_main_tbl['customer_id']])->asArray()->one();
   
    $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

     $tax_master_value=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxvalue');

    require ('../../vendor/tcpdf/tcpdf.php');
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('SUNITHA');
        $pdf->SetTitle('ESTIMATE');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 8, '', true);
        $pdf->SetMargins(10, false, 10, true); // set the margins 
        $pdf->AddPage();
        
        $pdf->Image('images/sp.png', 21, 10, 18, 18, 'PNG');
         $pdf->Image('images/letters.png', 19, 27, 24, 4, 'PNG');

        $tbl1='<html>
        <head>
        </head>
        <body style="font-size:12px;">';  
        $tbl1.='<table style="font-size:14px;">
                 <tbody>
                   <tr><td></td>
                   <td>
                    <p style="text-align:right;line-height:1.2">
                    '.$config['street']['value'].' <br/>
              '.$config['area']['value'].','.$config['district']['value'].' - '.$config['pincode']['value'].'. <br/>
              Phone : '.$config['primary_phno']['value'].' / '.$config['secondary_ph_no']['value'].' <br/>
              Website : '.$config['website']['value'].' <br/>
              Email : '.$config['primary_email']['value'].' <br/>
               </p>
                   </td>
                   </tr>
                 </tbody>
            </table>  <hr> 
            <table  style="width100%;">
                 <tbody>
                   <tr>
                   <td style="width:75%;">
                        <p style=""><b>To</b><br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($customer_master['company_name']).'<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($customer_master['address']).'<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($customer_master['city']).'<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($customer_master['state']).'-'.$customer_master['pincode'].'<br/></p>
                    </td>
                    <td style="width:30%;">
                    <p style="line-height:1.7;">SI NO : '.$estimate_main_tbl['bill_number'].'</p>
                        <p style="line-height:1.7;"> DATE : '.date('d-m-Y',strtotime($estimate_main_tbl['created_at'])).'</p>
                    </td>
                   </tr>
                 </tbody>
            </table>
            <p >&nbsp;&nbsp;&nbsp;Dear Sir, <p>
            <p style="text-align:center;line-height:1.0;"><b> ESTIMATE </b><p>

            <table >
             <thead>
               	  <tr>
                   	<td colspan="2" style="width:10%;border-top:1px solid #000;line-height:1.7;"><p style="line-height:1.7;"><b>SI NO</b></P></td>
                   	<td colspan="2" style="width:65%;border-top:1px solid #000;line-height:1.7;"><p style="line-height:1.7;"><b>PARTICULARS</b></p></td>
                   	<td colspan="2" style="text-align:right;width:22%;border-top:1px solid #000;line-height:1.7;"><p style="line-height:1.7;"><b>AMOUNT</b></p></td>
                   	<td colspan="2" style="text-align:right;width:3%;border-top:1px solid #000;line-height:1.7;"><p style="line-height:1.7;"><b></b></p></td>
                   </tr>
                   <tr>
                  	 	<td  style="text-align:right;width:90%;border-bottom:1px solid #000;line-height:1.7"> <B> Rs </B></td>
                   		<td  style="text-align:right;width:8%;border-bottom:1px solid #000;line-height:1.7"> <B>  P </B></td>
                   		<td  style="text-align:right;width:2%;border-bottom:1px solid #000;line-height:1.7"></td>
                   </tr>
             </thead>
            <tbody style="text-align:center; " >
            
            ';

            $tbl1.='
            		
                   <tr>
                   <td style="width:10%;"><p style="line-height:3;"></P></td>
                   <td style="width:65%;"><p style="line-height:3;"><b>Charges for Printing and Supply of</b></p></td>
                   <td style="text-align:right;width:20%;"><p style="line-height:3;"></p></td>
                   </tr>
                   
                    ';


              $k=1;
              $calc_array=array();
              foreach ($estimate_index as $key => $value) {
                $calc_array[]=$value['amount'];
				 $value_val = number_format($value['amount'],2);
				 $total=explode('.', $value_val);	          
                  $tbl1.='<tr> <td style="width:10%;"><p style="line-height:1.7;">'.$k.'</P></td>
                   <td style="width:60%;"><p style="line-height:1.7;text-align:left">'.ucwords($value['particular_field']).'</p></td>
                   <td style="width:20%;"><p style="line-height:1.7;text-align:right;">'.$total[0].'</p></td>
                   <td style="width:8%;"><p style="line-height:1.7;text-align:right;">'.$total[1].'</p></td>
                   </tr>';
                   $k++;
                }


                

               
                $cal=array_sum($calc_array);
				$split_tot=explode('.', number_format($cal,2));
                  $tbl1.='<hr><tr> <td style="width:10%;"><p style="line-height:1.7;"></p></td>
                   <td style="width:60%;"><p style="line-height:1.7;text-align:right"> TOTAL </p></td>
                   <td style="width:21%;"><p style="line-height:1.7;text-align:right;">'.$split_tot[0].'</p></td>
                   <td style="width:8%;"><p style="line-height:1.7;text-align:right;">'.$split_tot[1].'</p></td>
                   </tr></tbody>';
			//print_r($cal); die;

                if($estimate_main_tbl['gst_type'] == 'IGST')
                {   
                    $tax_master_value_id = $tax_master_value[$estimate_main_tbl['gst']];

                    $overall_per=($cal*$tax_master_value_id)/100;

                    $overall_cal=$overall_per+$cal;
					$split_Ist=explode('.', number_format($overall_per,2));
				   $split_granttot=explode('.', number_format($overall_cal,2));
				   
                    //print_r($overall_cal);die;
                     $tbl1.='<tfood><tr>  
                     			<td style="width:10%;line-height:1.7;"></td>
                             	<td style="width:60%;line-height:1.7;text-align:right">IGST '.$tax_master_value_id.' %</td>
                    			<td style="width:21%;line-height:1.7;text-align:right">'.$split_Ist[0].'</td>
                    			<td style="width:8%;text-align:right;line-height:1.7;">'.$split_Ist[1].'</td>   
                      		</tr>
                      		<tr>  
                     			<td style="width:10%;line-height:1.7;text-align:center"><B>SAC '.$config['SAC CODE']['value'].'</B></td>
                             	<td style="width:60%;line-height:1.7;text-align:right"><b>GRANT TOTAL</b></td>
                    			<td style="width:21%;line-height:1.7;text-align:right">'.$split_granttot[0].'</td>
                    			<td style="width:8%;text-align:right;line-height:1.7;">'.$split_granttot[1].'</td>   
                      		</tr>
                    	
                       </tfood>  
                      </table>';
                }
                else if($estimate_main_tbl['gst_type'] == 'GST')
                {
                    $tax_master_value_id = $tax_master_value[$estimate_main_tbl['gst']]/2;
                    
                    $overall_per=($cal*$tax_master_value[$estimate_main_tbl['gst']])/100;

                     $overall_per_divide=$overall_per/2;

                    $overall_cal=$overall_per+$cal;

                   // print_r($overall_per_divide);die;
                   $split_gst=explode('.', number_format($overall_per_divide,2));
				   $split_granttot=explode('.', number_format($overall_cal,2));

                     $tbl1.='<tfood>                        <tr>  
                     		<td style="width:10%;line-height:1.7;"></td>
                        	<td style="width:60%;line-height:1.7;text-align:right">SGST '. $tax_master_value_id.' %</td>
                        	<td style="width:21%;line-height:1.7;text-align:right">'.$split_gst[0].' </td>
                        	<td style="width:8%;text-align:right;line-height:1.7;">'.$split_gst[1].'</td>    
                        </tr>
                        <tr>
                        	<td style="width:10%;line-height:1.7;"></td>
                        	<td style="width:60%;line-height:1.7;text-align:right">CGST  '. $tax_master_value_id.' %</td>
                        	<td style="width:21%;line-height:1.7;text-align:right">'.$split_gst[0].' </td>
                        	<td style="width:8%;text-align:right;line-height:1.7;">'.$split_gst[1].'</td>    
                        </tr>
                        <tr>
                        	<td style="width:10%;line-height:1.7;text-align:center"><B>SAC '.$config['SAC CODE']['value'].'</B></td>
                        	<td style="width:60%;line-height:1.7;text-align:right"><B>GRAND TOTAL</B></td>
                        	<td style="width:21%;line-height:1.7;text-align:right">'.$split_granttot[0].' </td>
                        	<td style="width:8%;line-height:1.7;text-align:right">'.$split_granttot[1].' </td>    
                        </tr>  
                         
                      </tfood>  </table>';
                }

        $pdf->writeHTML($tbl1, true, false, false, false, '');       
            $tbl2='<p></p><p></p><table style="font-size:12px;text-align:center;">
            <tbody style="text-align:center;">
                   <tr>
                   <td style="width:70%;"><p style="line-height:1.7;"></P></td>
                   <td style="width:30%;"><p style="line-height:1.7;"><b>Yours sincerely </b><br/> For Sunitha Printers</p><p></p><p></p><p></p> <p>Partner</p></td>
                   </tr>
                 </tbody>
                </table>';
        $pdf->SetXY(50, 220);
        $pdf->writeHTML($tbl2, true, false, false, false, '');
    
        
        $pdf->Output('estimate.pdf');        
  
  }


public function actionPrintpreview($data)
  {
    
   

    $array_data=(array)json_decode($data);
    
    if(!empty($array_data))
    {
        foreach ($array_data as $key => $value) 
        {
            $convert_array[]=(array)$value;
        }
      
        foreach ($convert_array as $key => $value) 
        {
            $creative_array[$value['name']][]=$value['value'];
        }
    }

    $config=$this->findConfiguration();
    

    if(isset($creative_array['custId'][0]))
    {
        $customer_master=CustomerMaster::find()->where(['auto_id'=>$creative_array['custId'][0]])->asArray()->one();
    }
    
   // echo '<pre>';
   // print_r($creative_array);die;

    $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

     $tax_master_value=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxvalue');

    require ('../../vendor/tcpdf/tcpdf.php');
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('SUNITHA');
        $pdf->SetTitle('ESTIMATE');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 8, '', true);
        $pdf->SetMargins(10, false, 10, true); // set the margins 
        $pdf->AddPage();
        
        $pdf->Image('images/sp.png', 21, 10, 18, 18, 'PNG');
        $pdf->Image('images/letters.png', 19, 27, 24, 4, 'PNG');
        $pdf->Image('images/watermark.png', 20, 80, 180, 150, 'PNG');




        $tbl1='<html>
        <head>
        </head>
        <body style="font-size:12px;">';  
        $tbl1.='<table style="font-size:14px;">
                 <tbody>
                   <tr><td></td>
                   <td>
                    <p style="text-align:right;line-height:1.2">
                    '.$config['street']['value'].' <br/>
              '.$config['area']['value'].','.$config['district']['value'].' - '.$config['pincode']['value'].'. <br/>
              Phone : '.$config['primary_phno']['value'].' / '.$config['secondary_ph_no']['value'].' <br/>
              Website : '.$config['website']['value'].' <br/>
              Email : '.$config['primary_email']['value'].' <br/>
               </p>
                   </td>
                   </tr>
                 </tbody>
            </table>  <hr> <p><p/>
            <table >
                 <tbody>
                   <tr>
                   <td style="width:85%;"><p style="">&nbsp;&nbsp;&nbsp;<b>To</b><br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($customer_master['company_name']).'<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($customer_master['address']).'<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($customer_master['city']).'<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($customer_master['state']).'-'.$customer_master['pincode'].'<br/></p></td>
                   <td style="width:20%;"><p style="line-height:1.7;">SI NO : NIL</p>
                   <p>DATE : '.date('d-m-Y').'</p>
                   </td>
                   </tr>
                 </tbody>
            </table>
            <p >&nbsp;&nbsp;&nbsp;Dear Sir, <p>
            <p style="text-align:center;line-height:1.0;"><b> ESTIMATE </b><p>

            <table >
             <thead>
                  <tr>
                    <td colspan="2" style="width:10%;border-top:1px solid #000;line-height:1.7;"><p style="line-height:1.7;"><b>SI NO</b></P></td>
                    <td colspan="2" style="width:65%;border-top:1px solid #000;line-height:1.7;"><p style="line-height:1.7;"><b>PARTICULARS</b></p></td>
                    <td colspan="2" style="text-align:right;width:22%;border-top:1px solid #000;line-height:1.7;"><p style="line-height:1.7;"><b>AMOUNT</b></p></td>
                    <td colspan="2" style="text-align:right;width:3%;border-top:1px solid #000;line-height:1.7;"><p style="line-height:1.7;"><b></b></p></td>
                   </tr>
                   <tr>
                        <td  style="text-align:right;width:90%;border-bottom:1px solid #000;line-height:1.7"> <B> Rs </B></td>
                        <td  style="text-align:right;width:8%;border-bottom:1px solid #000;line-height:1.7"> <B>  P </B></td>
                        <td  style="text-align:right;width:2%;border-bottom:1px solid #000;line-height:1.7"></td>
                   </tr>
             </thead>
            <tbody style="text-align:center; " >
            
            ';

            $tbl1.='
                    
                   <tr>
                   <td style="width:10%;"><p style="line-height:3;"></P></td>
                   <td style="width:65%;"><p style="line-height:3;"><b>Charges for Printing and Supply of</b></p></td>
                   <td style="text-align:right;width:20%;"><p style="line-height:3;"></p></td>
                   </tr>
                   
                    ';


              $k=1;
              $calc_array=array();
              foreach ($creative_array['EstimateTypeValue[]'] as $key => $value) {
                $calc_array[]=$creative_array['EstimateAmount[]'][$key];
                 $value_val = number_format($creative_array['EstimateAmount[]'][$key],2);
                 $total=explode('.', $value_val);             
                  $tbl1.='<tr> <td style="width:10%;"><p style="line-height:1.7;">'.$k.'</P></td>
                   <td style="width:60%;"><p style="line-height:1.7;text-align:left">'.ucwords($value).'</p></td>
                   <td style="width:20%;"><p style="line-height:1.7;text-align:right;">'.$total[0].'</p></td>
                   <td style="width:8%;"><p style="line-height:1.7;text-align:right;">'.$total[1].'</p></td>
                   </tr>';
                   $k++;
                }


                

               
                $cal=array_sum($calc_array);
                $split_tot=explode('.', number_format($cal,2));
                  $tbl1.='<hr><tr> <td style="width:10%;"><p style="line-height:1.7;"></p></td>
                   <td style="width:60%;"><p style="line-height:1.7;text-align:right"> TOTAL </p></td>
                   <td style="width:21%;"><p style="line-height:1.7;text-align:right;">'.$split_tot[0].'</p></td>
                   <td style="width:8%;"><p style="line-height:1.7;text-align:right;">'.$split_tot[1].'</p></td>
                   </tr></tbody>';
            //print_r($cal); die;

                if($creative_array['EstimateMainTbl[gst_type]'][0] == 'IGST')
                {   
                    $tax_master_value_id = $tax_master_value[$creative_array['EstimateMainTbl[gst]'][0]];

                    $overall_per=($cal*$tax_master_value_id)/100;

                    $overall_cal=$overall_per+$cal;
                    $split_Ist=explode('.', number_format($overall_per,2));
                   $split_granttot=explode('.', number_format($overall_cal,2));
                   
                    //print_r($overall_cal);die;
                     $tbl1.='<tfood><tr>  
                                <td style="width:10%;line-height:1.7;"></td>
                                <td style="width:60%;line-height:1.7;text-align:right">IGST '.$tax_master_value_id.' %</td>
                                <td style="width:21%;line-height:1.7;text-align:right">'.$split_Ist[0].'</td>
                                <td style="width:8%;text-align:right;line-height:1.7;">'.$split_Ist[1].'</td>   
                            </tr>
                            <tr>  
                                <td style="width:10%;line-height:1.7;text-align:center"><B>SAC '.$config['SAC CODE']['value'].'</B></td>
                                <td style="width:60%;line-height:1.7;text-align:right"><b>GRANT TOTAL</b></td>
                                <td style="width:21%;line-height:1.7;text-align:right">'.$split_granttot[0].'</td>
                                <td style="width:8%;text-align:right;line-height:1.7;">'.$split_granttot[1].'</td>   
                            </tr>
                        
                       </tfood>  
                      </table>';
                }
                else if($creative_array['EstimateMainTbl[gst_type]'][0] == 'GST')
                {
                    $tax_master_value_id = $tax_master_value[$creative_array['EstimateMainTbl[gst]'][0]]/2;
                    
                    $overall_per=($cal*$tax_master_value[$creative_array['EstimateMainTbl[gst]'][0]])/100;

                     $overall_per_divide=$overall_per/2;

                    $overall_cal=$overall_per+$cal;

                   // print_r($overall_per_divide);die;
                   $split_gst=explode('.', number_format($overall_per_divide,2));
                   $split_granttot=explode('.', number_format($overall_cal,2));

                     $tbl1.='<tfood>                        <tr>  
                            <td style="width:10%;line-height:1.7;"></td>
                            <td style="width:60%;line-height:1.7;text-align:right">SGST '. $tax_master_value_id.' %</td>
                            <td style="width:21%;line-height:1.7;text-align:right">'.$split_gst[0].' </td>
                            <td style="width:8%;text-align:right;line-height:1.7;">'.$split_gst[1].'</td>    
                        </tr>
                        <tr>
                            <td style="width:10%;line-height:1.7;"></td>
                            <td style="width:60%;line-height:1.7;text-align:right">CGST  '. $tax_master_value_id.' %</td>
                            <td style="width:21%;line-height:1.7;text-align:right">'.$split_gst[0].' </td>
                            <td style="width:8%;text-align:right;line-height:1.7;">'.$split_gst[1].'</td>    
                        </tr>
                        <tr>
                            <td style="width:10%;line-height:1.7;text-align:center"><B>SAC '.$config['SAC CODE']['value'].'</B></td>
                            <td style="width:60%;line-height:1.7;text-align:right"><B>GRAND TOTAL</B></td>
                            <td style="width:21%;line-height:1.7;text-align:right">'.$split_granttot[0].' </td>
                            <td style="width:8%;line-height:1.7;text-align:right">'.$split_granttot[1].' </td>    
                        </tr>  
                         
                      </tfood>  </table>';
                }

        $pdf->writeHTML($tbl1, true, false, false, false, '');       
            $tbl2='<p></p><p></p><table style="font-size:12px;text-align:center;">
            <tbody style="text-align:center;">
                   <tr>
                   <td style="width:70%;"><p style="line-height:1.7;"></P></td>
                   <td style="width:30%;"><p style="line-height:1.7;"><b>Yours sincerely </b><br/> For Sunitha Printers</p><p></p><p></p><p></p> <p>Partner</p></td>
                   </tr>
                 </tbody>
                </table>';
        $pdf->SetXY(50, 220);
        $pdf->writeHTML($tbl2, true, false, false, false, '');
    
        
        $pdf->Output('estimate.pdf');        
  
 
  
  }

  public function ConfigReset()
  {
        $curr_year=date('Y');
        $ConfigYear=ConfigYear::find()->where(['id'=> 1])->asArray()->one();

        if($ConfigYear['curr_year'] != $curr_year)
        {
            ConfigYear::updateAll(['curr_year' => $curr_year],['id'=>1]);
            AutoIdtable::updateAll(['number_field' => 1]);

            return $curr_year;
        }
        else if($ConfigYear['curr_year'] == $curr_year)
        {
            return $curr_year;
        }
   } 


}
