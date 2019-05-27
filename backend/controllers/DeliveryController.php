<?php

namespace backend\controllers;

use Yii;
use backend\models\Delivery;
use backend\models\DeliverySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Taxmaster;
use backend\models\DeliveryRef;
use backend\models\CustomerMaster;
use yii\helpers\ArrayHelper;
use backend\models\AutoIdtable;
use backend\models\DeliveryLog;
use backend\models\DeliveryRefLog;
use backend\models\Configuration;
use backend\models\DeliveryAddressMaster;
use backend\models\EstimateMainTbl;
use backend\models\Estimate;
use backend\models\ConfigYear;

/**
 * DeliveryController implements the CRUD actions for Delivery model.
 */
class DeliveryController extends Controller
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

    public function beforeAction($action) 
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Delivery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DeliverySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReindex()
    {
        $searchModel = new DeliverySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        Yii::$app->session->setFlash('success', 'Record Saved Successfully');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays a single Delivery model.
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
     * Creates a new Delivery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Delivery();

        $delivery_ref= new DeliveryRef();

$tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

        $customer_master= CustomerMaster::find()->asArray()->all();

         $session = Yii::$app->session;

          $tax_master_index=ArrayHelper::index(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid');
          $tax_master_index_json=json_encode($tax_master_index);

        if ($model->load(Yii::$app->request->post())) 
        {
            
            $fetch_array=array();
            $curr_year=$this->ConfigReset();
            $AutoIdtable=AutoIdtable::findOne(3);
            

           
            $autoget=$AutoIdtable->number_field;
            $inc_value=$autoget+1;
            $rtno = str_pad($autoget, 4, "0", STR_PAD_LEFT);
            $rtno='DL-'.$curr_year.'-'.$rtno;
            $model->company_name = $_POST['Delivery']['company_name'];
            $model->cust_id = $_POST['custId'];
            $model->cust_name = $_POST['Delivery']['cust_name'];
            $model->gstin_no = $_POST['Delivery']['gstin_no'];
            $model->state = $_POST['Delivery']['state'];
            $model->state_code = $_POST['Delivery']['state_code'];
            $model->address = $_POST['Delivery']['address'];
            $model->bill_no = $rtno;
            $model->gst_type = $_POST['Delivery']['gst_type'];
            
            $model->bill_date = date('Y-m-d H:i:s');
            $model->tot_qty = array_sum($_POST['DeliveryRef']['qty_table']);
            $model->tot_amt = array_sum($_POST['DeliveryRef']['amount_table']);
            $model->transport = $_POST['Delivery']['transport'];
            $model->vehicle_num = $_POST['Delivery']['vehicle_num'];
            $model->remarks = $_POST['Delivery']['remarks'];
            $model->c_date = date('Y-m-d H:i:s');
            $model->user_id = $session['headlinestv_id'];
            $model->ipaddrss = $_SERVER['REMOTE_ADDR'];
            
            $model->delivery_select = $_POST['Delivery']['delivery_select'];
            $model->delivery_address = $_POST['Delivery']['delivery_address'];
            

            if($model->save())
            {  


                $delivery_log = new DeliveryLog();

                $delivery_log->delivery_id=$model->id;
               
                $delivery_log->cust_id = $_POST['custId'];
                $delivery_log->cust_name = $_POST['Delivery']['cust_name'];
                $delivery_log->gstin_no = $_POST['Delivery']['gstin_no'];
                $delivery_log->state = $_POST['Delivery']['state'];
                $delivery_log->state_code = $_POST['Delivery']['state_code'];
                $delivery_log->address = $_POST['Delivery']['address'];
                $delivery_log->bill_no = $rtno;
                $delivery_log->bill_date = date('Y-m-d H:i:s');
                $delivery_log->tot_qty = array_sum($_POST['DeliveryRef']['qty_table']);
                $delivery_log->tot_amt = array_sum($_POST['DeliveryRef']['amount_table']);
                $delivery_log->transport = $_POST['Delivery']['transport'];
                $delivery_log->vehicle_num = $_POST['Delivery']['vehicle_num'];
                $delivery_log->remarks = $_POST['Delivery']['remarks'];
                $delivery_log->c_date = date('Y-m-d H:i:s');
                $delivery_log->user_id = $session['headlinestv_id'];
                $delivery_log->ipaddrss = $_SERVER['REMOTE_ADDR'];

                $delivery_log->delivery_select = $_POST['Delivery']['delivery_select'];
                $delivery_log->delivery_address = $_POST['Delivery']['delivery_address'];

                if($delivery_log->save())
                {
                    if(!empty($_POST['DeliveryRef']['description_table']))
                    {
                        foreach ($_POST['DeliveryRef']['description_table'] as $key => $value) 
                        {
                            $delivery_ref = new  DeliveryRef();
                            $delivery_ref-> delivery_id = $model->id;
                            $delivery_ref-> bill_number  = $rtno;
                            $delivery_ref-> bill_date  = date('Y-m-d H:i:s');
                            $delivery_ref-> description  = $value;
                            $delivery_ref-> qty  = $_POST['DeliveryRef']['qty_table'][$key];
                            $delivery_ref-> hsn  = $_POST['DeliveryRef']['hsn_table'][$key];
                            $delivery_ref-> gst_rate  = $_POST['DeliveryRef']['gst_rate_table'][$key];
                            $delivery_ref-> amount  = $_POST['DeliveryRef']['amount_table'][$key];
                            $delivery_ref-> c_date  = date('Y-m-d H:i:s');
                            $delivery_ref-> user_id  =  $session['headlinestv_id'];
                            $delivery_ref-> ipaddress  = $_SERVER['REMOTE_ADDR'];
                            
                            if($delivery_ref->save())
                            {
                                $delivery_ref_log = new  DeliveryRefLog();
                                $delivery_ref_log-> delivery_id = $model->id;
                                $delivery_ref_log-> delivery_log_tbl_id  = $delivery_log->id;
                                $delivery_ref_log-> delivery_ref_id  = $delivery_ref->auto_id;
                                $delivery_ref_log-> bill_number  = $rtno;
                                $delivery_ref_log-> bill_date  = date('Y-m-d H:i:s');
                                $delivery_ref_log-> description  = $value;
                                $delivery_ref_log-> qty  = $_POST['DeliveryRef']['qty_table'][$key];
                                $delivery_ref_log-> hsn  = $_POST['DeliveryRef']['hsn_table'][$key];
                                $delivery_ref_log-> gst_rate  = $_POST['DeliveryRef']['gst_rate_table'][$key];
                                $delivery_ref_log-> amount  = $_POST['DeliveryRef']['amount_table'][$key];
                                $delivery_ref_log-> c_date  = date('Y-m-d H:i:s');
                                $delivery_ref_log-> user_id  =  $session['headlinestv_id'];
                                $delivery_ref_log-> ipaddress  = $_SERVER['REMOTE_ADDR'];

                                if($delivery_ref_log->save())
                                {

                                }
                                else
                                {
                                    print_r($delivery_ref_log->getErrors());die;
                                }
                            }   
                            else
                            {
                               print_r($delivery_ref->getErrors());
                               die; 
                            }                                         
                        }

                        AutoIdtable::updateAll(['number_field' => $inc_value], ['id' => 3]);

                        if(!empty($_POST['CONVERTDC']))
                        {
                            EstimateMainTbl::updateAll(['convert_status' => 'DC', 'convert_delivery_id'=> $model->id], ['id' => $_POST['CONVERTDC']]);
                        }


                        $fetch_array[0]='okay';
                        $fetch_array[1]=$rtno;
                        
                        return json_encode($fetch_array);
                    }
                }
                else
                {
                    print_r($delivery_log->getErrors());die;
                }
            }
            else
            {

                print_r($model->getErrors());die;
            }
            
            

          //  return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('create', [
            'model' => $model,
            'delivery_ref' => $delivery_ref,
            'tax_master' => $tax_master,
            'customer_master' => $customer_master,
            'tax_master_index_json' => $tax_master_index_json,
             'tax_master_index' => $tax_master_index,
            ]);
        }   
        
    }


    public function actionConvertdc($id='')
    {
       
            $estimate_main_tbl=EstimateMainTbl::find()->where(['id'=>$id])->asArray()->one();

            $estimate=Estimate::find()->where(['est_main_id'=>$id])->asArray()->all();


            $model = new Delivery();

            $delivery_ref= new DeliveryRef();

            $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

            $customer_master= CustomerMaster::find()->asArray()->all();

            $customer_master_fetch = CustomerMaster::find()->where(['auto_id'=>$estimate_main_tbl['customer_id']])->asArray()->one();

            $delivery_address_master=DeliveryAddressMaster::find()->where(['cust_id'=>$estimate_main_tbl['customer_id']])->asArray()->all();
            $delivery_address_master_json=json_encode($delivery_address_master);

            $session = Yii::$app->session;

            $tax_master_index=ArrayHelper::index(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid');


            $tax_master_index_json=json_encode($tax_master_index);

               return $this->render('_formconvert', [
                'model' => $model,
                'delivery_ref' => $delivery_ref,
                'tax_master' => $tax_master,
                'customer_master' => $customer_master,
                'tax_master_index_json' => $tax_master_index_json,
                 'tax_master_index' => $tax_master_index,
                 'estimate_main_tbl' => $estimate_main_tbl,
                 'estimate' => $estimate,
                 'customer_master_fetch'=>$customer_master_fetch,
                 'delivery_address_master_json'=>$delivery_address_master_json
                ]);
    } 


    public function actionPrintsave()
    {
        $model = new Delivery();

        $delivery_ref= new DeliveryRef();

$tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

        $customer_master= CustomerMaster::find()->asArray()->all();

         $session = Yii::$app->session;

          $tax_master_index=ArrayHelper::index(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid');
          $tax_master_index_json=json_encode($tax_master_index);

        if ($model->load(Yii::$app->request->post())) 
        {
            
            
            $fetch_array=array();
             $curr_year=$this->ConfigReset();
            $AutoIdtable=AutoIdtable::findOne(3);
            


           
            $autoget=$AutoIdtable->number_field;
            $inc_value=$autoget+1;
            $rtno = str_pad($autoget, 4, "0", STR_PAD_LEFT);
            $rtno='DL-'.$curr_year.'-'.$rtno;
            $model->company_name = $_POST['Delivery']['company_name'];
            $model->cust_id = $_POST['custId'];
            $model->cust_name = $_POST['Delivery']['cust_name'];
            $model->gstin_no = $_POST['Delivery']['gstin_no'];
            $model->state = $_POST['Delivery']['state'];
            $model->state_code = $_POST['Delivery']['state_code'];
            $model->address = $_POST['Delivery']['address'];
            $model->bill_no = $rtno;
            $model->gst_type = $_POST['Delivery']['gst_type'];
            
            $model->bill_date = date('Y-m-d H:i:s');
            $model->tot_qty = array_sum($_POST['DeliveryRef']['qty_table']);
            $model->tot_amt = array_sum($_POST['DeliveryRef']['amount_table']);
            $model->transport = $_POST['Delivery']['transport'];
            $model->vehicle_num = $_POST['Delivery']['vehicle_num'];
            $model->remarks = $_POST['Delivery']['remarks'];
            $model->c_date = date('Y-m-d H:i:s');
            $model->user_id = $session['headlinestv_id'];
            $model->ipaddrss = $_SERVER['REMOTE_ADDR'];
            
            $model->delivery_select = $_POST['Delivery']['delivery_select'];
            $model->delivery_address = $_POST['Delivery']['delivery_address'];


            if($model->save())
            {  


                $delivery_log = new DeliveryLog();

                $delivery_log->delivery_id=$model->id;
               
                $delivery_log->cust_id = $_POST['custId'];
                $delivery_log->cust_name = $_POST['Delivery']['cust_name'];
                $delivery_log->gstin_no = $_POST['Delivery']['gstin_no'];
                $delivery_log->state = $_POST['Delivery']['state'];
                $delivery_log->state_code = $_POST['Delivery']['state_code'];
                $delivery_log->address = $_POST['Delivery']['address'];
                $delivery_log->bill_no = $rtno;
                $delivery_log->bill_date = date('Y-m-d H:i:s');
                $delivery_log->tot_qty = array_sum($_POST['DeliveryRef']['qty_table']);
                $delivery_log->tot_amt = array_sum($_POST['DeliveryRef']['amount_table']);
                $delivery_log->transport = $_POST['Delivery']['transport'];
                $delivery_log->vehicle_num = $_POST['Delivery']['vehicle_num'];
                $delivery_log->remarks = $_POST['Delivery']['remarks'];
                $delivery_log->c_date = date('Y-m-d H:i:s');
                $delivery_log->user_id = $session['headlinestv_id'];
                $delivery_log->ipaddrss = $_SERVER['REMOTE_ADDR'];

                $delivery_log->delivery_select = $_POST['Delivery']['delivery_select'];
                $delivery_log->delivery_address = $_POST['Delivery']['delivery_address'];


                if($delivery_log->save())
                {
                    if(!empty($_POST['DeliveryRef']['description_table']))
                    {
                        foreach ($_POST['DeliveryRef']['description_table'] as $key => $value) 
                        {
                            $delivery_ref = new  DeliveryRef();
                            $delivery_ref-> delivery_id = $model->id;
                            $delivery_ref-> bill_number  = $rtno;
                            $delivery_ref-> bill_date  = date('Y-m-d H:i:s');
                            $delivery_ref-> description  = $value;
                            $delivery_ref-> qty  = $_POST['DeliveryRef']['qty_table'][$key];
                            $delivery_ref-> hsn  = $_POST['DeliveryRef']['hsn_table'][$key];
                            $delivery_ref-> gst_rate  = $_POST['DeliveryRef']['gst_rate_table'][$key];
                            $delivery_ref-> amount  = $_POST['DeliveryRef']['amount_table'][$key];
                            $delivery_ref-> c_date  = date('Y-m-d H:i:s');
                            $delivery_ref-> user_id  =  $session['headlinestv_id'];
                            $delivery_ref-> ipaddress  = $_SERVER['REMOTE_ADDR'];
                            
                            if($delivery_ref->save())
                            {
                                $delivery_ref_log = new  DeliveryRefLog();
                                $delivery_ref_log-> delivery_id = $model->id;
                                $delivery_ref_log-> delivery_log_tbl_id  = $delivery_log->id;
                                $delivery_ref_log-> delivery_ref_id  = $delivery_ref->auto_id;
                                $delivery_ref_log-> bill_number  = $rtno;
                                $delivery_ref_log-> bill_date  = date('Y-m-d H:i:s');
                                $delivery_ref_log-> description  = $value;
                                $delivery_ref_log-> qty  = $_POST['DeliveryRef']['qty_table'][$key];
                                $delivery_ref_log-> hsn  = $_POST['DeliveryRef']['hsn_table'][$key];
                                $delivery_ref_log-> gst_rate  = $_POST['DeliveryRef']['gst_rate_table'][$key];
                                $delivery_ref_log-> amount  = $_POST['DeliveryRef']['amount_table'][$key];
                                $delivery_ref_log-> c_date  = date('Y-m-d H:i:s');
                                $delivery_ref_log-> user_id  =  $session['headlinestv_id'];
                                $delivery_ref_log-> ipaddress  = $_SERVER['REMOTE_ADDR'];

                                if($delivery_ref_log->save())
                                {

                                }
                                else
                                {
                                    print_r($delivery_ref_log->getErrors());die;
                                }
                            }   
                            else
                            {
                               print_r($delivery_ref->getErrors());
                               die; 
                            }                                         
                        }

                        AutoIdtable::updateAll(['number_field' => $inc_value], ['id' => 3]);

                         if(!empty($_POST['CONVERTDC']))
                        {
                            EstimateMainTbl::updateAll(['convert_status' => 'DC', 'convert_delivery_id'=> $model->id], ['id' => $_POST['CONVERTDC']]);
                        }


                        $fetch_array[0]='okay';
                        $fetch_array[1]=$model->id;
                        
                        return json_encode($fetch_array);
                    }
                }
                else
                {
                    print_r($delivery_log->getErrors());die;
                }
            }
            else
            {

                print_r($model->getErrors());die;
            }
            
            

          //  return $this->redirect(['view', 'id' => $model->id]);
        }
    }



    /**
     * Updates an existing Delivery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $findDeliveryRef = $this->findDeliveryRef($id);

        $delivery_ref= new DeliveryRef();

        $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

        $customer_master= CustomerMaster::find()->asArray()->all();

         $session = Yii::$app->session;

         $tax_master_index=ArrayHelper::index(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid');
          $tax_master_index_json=json_encode($tax_master_index);

          $Deliveryaddress_update=$this->actionDeliveryaddress($model->cust_id);

        if ($model->load(Yii::$app->request->post())) 
        {
           


          

            Delivery::updateAll(['tot_qty' => array_sum($_POST['DeliveryRef']['qty_table']) ,'tot_amt' => array_sum($_POST['DeliveryRef']['amount_table']) ,'transport'=> $_POST['Delivery']['transport'],'vehicle_num'=> $_POST['Delivery']['vehicle_num'],'remarks'=> $_POST['Delivery']['remarks']], ['id' => $id]);

            DeliveryRef::deleteAll(['delivery_id' => $id]);

                $delivery_log = new DeliveryLog();
                $delivery_log->delivery_id=$model->id;
                $delivery_log->cust_id =  $model->cust_id;
                $delivery_log->cust_name = $_POST['Delivery']['cust_name'];
                $delivery_log->gstin_no = $_POST['Delivery']['gstin_no'];
                $delivery_log->state = $_POST['Delivery']['state'];
                $delivery_log->state_code = $_POST['Delivery']['state_code'];
                $delivery_log->address = $_POST['Delivery']['address'];
                $delivery_log->bill_no = $model->bill_no;
                $delivery_log->bill_date =  $model->bill_date;
                $delivery_log->tot_qty = array_sum($_POST['DeliveryRef']['qty_table']);
                $delivery_log->tot_amt = array_sum($_POST['DeliveryRef']['amount_table']);
                $delivery_log->transport = $_POST['Delivery']['transport'];
                $delivery_log->vehicle_num = $_POST['Delivery']['vehicle_num'];
                $delivery_log->remarks = $_POST['Delivery']['remarks'];
                $delivery_log->c_date = date('Y-m-d H:i:s');
                $delivery_log->user_id = $session['headlinestv_id'];
                $delivery_log->ipaddrss = $_SERVER['REMOTE_ADDR'];


                $delivery_log->delivery_select = $_POST['Delivery']['delivery_select'];
                $delivery_log->delivery_address = $_POST['Delivery']['delivery_address'];

                if($delivery_log->save())
                {
                    if(!empty($_POST['DeliveryRef']['description_table']))
                    {
                        foreach ($_POST['DeliveryRef']['description_table'] as $key => $value) 
                        {
                            $delivery_ref = new  DeliveryRef();
                            $delivery_ref-> delivery_id = $model->id;
                            $delivery_ref-> bill_number  =$model->bill_no;
                            $delivery_ref-> bill_date  = $model->bill_date;
                            $delivery_ref-> description  = $value;
                            $delivery_ref-> qty  = $_POST['DeliveryRef']['qty_table'][$key];
                            $delivery_ref-> hsn  = $_POST['DeliveryRef']['hsn_table'][$key];
                            $delivery_ref-> gst_rate  = $_POST['DeliveryRef']['gst_rate_table'][$key];
                            $delivery_ref-> amount  = $_POST['DeliveryRef']['amount_table'][$key];
                            $delivery_ref-> c_date  = date('Y-m-d H:i:s');
                            $delivery_ref-> user_id  =  $session['headlinestv_id'];
                            $delivery_ref-> ipaddress  = $_SERVER['REMOTE_ADDR'];
                            
                            if($delivery_ref->save())
                            {
                                $delivery_ref_log = new  DeliveryRefLog();
                                $delivery_ref_log-> delivery_id = $model->id;
                                $delivery_ref_log-> delivery_log_tbl_id  = $delivery_log->id;
                                $delivery_ref_log-> delivery_ref_id  = $delivery_ref->auto_id;
                                $delivery_ref_log-> bill_number  = $model->bill_no;
                                $delivery_ref_log-> bill_date  = $model->bill_date;
                                $delivery_ref_log-> description  = $value;
                                $delivery_ref_log-> qty  =  $_POST['DeliveryRef']['qty_table'][$key];
                                $delivery_ref_log-> hsn  =  $_POST['DeliveryRef']['hsn_table'][$key];
                                $delivery_ref_log-> gst_rate  = $_POST['DeliveryRef']['gst_rate_table'][$key];
                                $delivery_ref_log-> amount  =  $_POST['DeliveryRef']['amount_table'][$key];
                                $delivery_ref_log-> c_date  = date('Y-m-d H:i:s');
                                $delivery_ref_log-> user_id  =  $session['headlinestv_id'];
                                $delivery_ref_log-> ipaddress  = $_SERVER['REMOTE_ADDR'];

                                if($delivery_ref_log->save())
                                {

                                }
                                else
                                {
                                    print_r($delivery_ref_log->getErrors());die;
                                }
                            }   
                            else
                            {
                               print_r($delivery_ref->getErrors());
                               die; 
                            }                                         
                        }

                        $fetch_array[0]='okay';
                        $fetch_array[1]=$rtno;
                        
                        return json_encode($fetch_array);

                    }
                }
                else
                {
                    print_r($delivery_log->getErrors());die;
                }

            
          
        }
        else
        {
            return $this->render('update', [
            'model' => $model,
            'delivery_ref' => $delivery_ref,
            'tax_master' => $tax_master,
            'customer_master' => $customer_master,
            'findDeliveryRef' => $findDeliveryRef,
             'tax_master_index_json' => $tax_master_index_json,
             'tax_master_index' => $tax_master_index,
             'Deliveryaddress_update'=>$Deliveryaddress_update
            ]);  
        }
       
    }


    public function actionDeliveryaddress($id)
    {

        $delivery_address_master= DeliveryAddressMaster::find()->where(['cust_id'=>$id])->asArray()->all();
        $fetch_array=array();
        if(!empty($delivery_address_master))
        {
            foreach ($delivery_address_master as $key => $value) 
            {
                $fetch_array[]=array('auto_id'=>$value['id'],'delivery_address'=>$value['delivery_address'].','.$value['city'].','.$value['state'].','.$value['pincode']);    
            }

           
        }

         return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }




    public function actionUpdateprint($id)
    {
         $model = $this->findModel($id);

        $findDeliveryRef = $this->findDeliveryRef($id);

        $delivery_ref= new DeliveryRef();

        $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

        $customer_master= CustomerMaster::find()->asArray()->all();

         $session = Yii::$app->session;

         $tax_master_index=ArrayHelper::index(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid');
          $tax_master_index_json=json_encode($tax_master_index);

        if ($model->load(Yii::$app->request->post())) 
        {

            $fetch_array=array();

            

            Delivery::updateAll(['tot_qty' => array_sum($_POST['DeliveryRef']['qty_table']) ,'tot_amt' => array_sum($_POST['DeliveryRef']['amount_table']) ,'transport'=> $_POST['Delivery']['transport'],'vehicle_num'=> $_POST['Delivery']['vehicle_num'],'remarks'=> $_POST['Delivery']['remarks']], ['id' => $id]);

            DeliveryRef::deleteAll(['delivery_id' => $id]);

                $delivery_log = new DeliveryLog();
                $delivery_log->delivery_id=$model->id;
                $delivery_log->cust_id =  $model->cust_id;
                $delivery_log->cust_name = $_POST['Delivery']['cust_name'];
                $delivery_log->gstin_no = $_POST['Delivery']['gstin_no'];
                $delivery_log->state = $_POST['Delivery']['state'];
                $delivery_log->state_code = $_POST['Delivery']['state_code'];
                $delivery_log->address = $_POST['Delivery']['address'];
                $delivery_log->bill_no = $model->bill_no;
                $delivery_log->bill_date =  $model->bill_date;
                $delivery_log->tot_qty = array_sum($_POST['DeliveryRef']['qty_table']);
                $delivery_log->tot_amt = array_sum($_POST['DeliveryRef']['amount_table']);
                $delivery_log->transport = $_POST['Delivery']['transport'];
                $delivery_log->vehicle_num = $_POST['Delivery']['vehicle_num'];
                $delivery_log->remarks = $_POST['Delivery']['remarks'];
                $delivery_log->c_date = date('Y-m-d H:i:s');
                $delivery_log->user_id = $session['headlinestv_id'];
                $delivery_log->ipaddrss = $_SERVER['REMOTE_ADDR'];

                $delivery_log->delivery_select = $_POST['Delivery']['delivery_select'];
                $delivery_log->delivery_address = $_POST['Delivery']['delivery_address'];

                if($delivery_log->save())
                {
                    if(!empty($_POST['DeliveryRef']['description_table']))
                    {
                        foreach ($_POST['DeliveryRef']['description_table'] as $key => $value) 
                        {
                            $delivery_ref = new  DeliveryRef();
                            $delivery_ref-> delivery_id = $model->id;
                            $delivery_ref-> bill_number  =$model->bill_no;
                            $delivery_ref-> bill_date  = $model->bill_date;
                            $delivery_ref-> description  = $value;
                            $delivery_ref-> qty  = $_POST['DeliveryRef']['qty_table'][$key];
                            $delivery_ref-> hsn  = $_POST['DeliveryRef']['hsn_table'][$key];
                            $delivery_ref-> gst_rate  = $_POST['DeliveryRef']['gst_rate_table'][$key];
                            $delivery_ref-> amount  = $_POST['DeliveryRef']['amount_table'][$key];
                            $delivery_ref-> c_date  = date('Y-m-d H:i:s');
                            $delivery_ref-> user_id  =  $session['headlinestv_id'];
                            $delivery_ref-> ipaddress  = $_SERVER['REMOTE_ADDR'];
                            
                            if($delivery_ref->save())
                            {
                                $delivery_ref_log = new  DeliveryRefLog();
                                $delivery_ref_log-> delivery_id = $model->id;
                                $delivery_ref_log-> delivery_log_tbl_id  = $delivery_log->id;
                                $delivery_ref_log-> delivery_ref_id  = $delivery_ref->auto_id;
                                $delivery_ref_log-> bill_number  = $model->bill_no;
                                $delivery_ref_log-> bill_date  = $model->bill_date;
                                $delivery_ref_log-> description  = $value;
                                $delivery_ref_log-> qty  =  $_POST['DeliveryRef']['qty_table'][$key];
                                $delivery_ref_log-> hsn  =  $_POST['DeliveryRef']['hsn_table'][$key];
                                $delivery_ref_log-> gst_rate  = $_POST['DeliveryRef']['gst_rate_table'][$key];
                                $delivery_ref_log-> amount  =  $_POST['DeliveryRef']['amount_table'][$key];
                                $delivery_ref_log-> c_date  = date('Y-m-d H:i:s');
                                $delivery_ref_log-> user_id  =  $session['headlinestv_id'];
                                $delivery_ref_log-> ipaddress  = $_SERVER['REMOTE_ADDR'];

                                if($delivery_ref_log->save())
                                {

                                }
                                else
                                {
                                    print_r($delivery_ref_log->getErrors());die;
                                }
                            }   
                            else
                            {
                               print_r($delivery_ref->getErrors());
                               die; 
                            }                                         
                        }

                        $fetch_array[0]='okay';
                        $fetch_array[1]=$model->id;
                       
                        return json_encode($fetch_array);

                    }
                }
                else
                {
                    print_r($delivery_log->getErrors());die;
                }

            
          
        }
    }

    /**
     * Deletes an existing Delivery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $check=$this->findModel($id);

        EstimateMainTbl::updateAll(['convert_status' => '', 'convert_delivery_id'=> ''], ['convert_delivery_id' => $id , 'convert_status' => 'DC']);

        if($check->delete())   
        {
            return $this->redirect(['index']);
        }
        
    }

    /**
     * Finds the Delivery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Delivery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Delivery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    protected function findDeliveryRef($id)
    {
        if (($DeliveryRef = DeliveryRef::find()->where(['delivery_id'=>$id])->asArray()->all()) !== null) {
            return $DeliveryRef;
        }

       // throw new NotFoundHttpException('The requested page does not exist.');
    }


    protected function findConfiguration()
    {
        $config=ArrayHelper::index(Configuration::find()->asArray()->all(),'key_drop');
        if(!empty($config))
        {
            return $config;
        }
        
    }


  public function actionPrintpreview($data)
  {
    //echo '<pre>';
       

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
   
    //echo '<pre>';
    // print_r($creative_array['custId']);die;
    $config=$this->findConfiguration();

     $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxvalue');
     $customer_master=CustomerMaster::find()->where(['auto_id'=>$creative_array['custId'][0]])->asArray()->one();
     //echo '<pre>';
     //print_r($creative_array['cust_id'][0]);die;

    

    require ('../../vendor/tcpdf/tcpdf.php');
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('DMC');
        $pdf->SetTitle('Delivery Challan');
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
      
        $pdf->Image('images/watermark.png', 20, 80, 180, 150, 'PNG');
        $tbl1='<html>
        <head>
        </head>
        <body class="main" style="font-size:11px;border:1px solid #000;">';  
        $tbl1.='<p></p><p></p><p></p>
        <table ><tbody>
           <tr> 
            <td style="width:15%;"></td> 
            <td style="font-size:13px;width:35%;"><b> NIL</b></td> 
            <td style="text-align:right;width:46%;font-size:13px;"> <b> '.date('d/m/Y').'</b> </td>
           </tr></tbody>
        </table><p></p><p></p> <p></p><p></p><p></p><p></p><br><br><br>
        <table style="font-size:12px;"><tbody>
           <tr> 
                <td style="width:55%;line-height:1.0;font-size:13px;"></td>
                <td style="width:45%;line-height:1.2;font-size:13px;"><br><b>'.ucwords($customer_master['company_name']).'</b></td> 
           </tr>
           <tr> 
                <td style="width:20%;line-height:1.0;font-size:13px;"></td>
                <td style="width:70%;line-height:1.7;font-size:11px;">'.$customer_master['gst'].' </td> 
           </tr>
           <tr> 
                <td style="width:20%;line-height:1.0;font-size:13px;"></td>
                <td style="width:70%;line-height:1.7;font-size:11px;">'.$customer_master['state'].' </td> 
           </tr>
           <tr> 
                <td style="width:20%;line-height:1.0;font-size:13px;"></td>
                <td style="width:70%;line-height:1.7;font-size:11px;">'.$customer_master['state_code'].'<br/> </td> 
           </tr>
          </tbody>
        </table><br/><br/><br/>
        <table style="font-size:11px;"><tbody>
           <tr> 
           <td style="width:05%;line-height:1.3;"></td>
           <td style="width:50%;line-height:1.3;">'.$config['Company Name']['value'].', <br/>'.$config['street']['value'].',<br/>'.$config['area']['value'].','.$config['district']['value'].' - '.$config['pincode']['value'].'. <br/>Phone : '.$config['primary_phno']['value'].' / '.$config['secondary_ph_no']['value'].' </td> 
           <td style="width:49%;line-height:1.3;"><br/>'.ucwords($creative_array['Delivery[company_name]'][0]).'<br/>'.$creative_array['Delivery[delivery_address]'][0].'<br/></td></tr></tbody>
        </table>
        <br/><br/><br/><br/><br/><br/>
        
        <table style="font-size:12px;" class="tbl-pro"><thead>';
          $k=1;
          foreach ($creative_array['DeliveryRef[description_table][]'] as $key => $value) 
          {    
               $split_amt=explode('.', number_format($creative_array['DeliveryRef[amount_table][]'][$key],2));
               $tbl1.=' <tr> 
                   <td style="width:5%;line-height:1.7;font-size:13px;text-align:center;">'.$k.'</td>
                   <td style="width:50%;line-height:1.7;font-size:13px;">'.ucwords($value).'</td> 
                   <td style="width:10%;text-align:center;">'.$creative_array['DeliveryRef[qty_table][]'][$key].'</td>
                   <td style="width:10%;text-align:center;">'.$creative_array['DeliveryRef[hsn_table][]'][$key].'</td>
                   <td style="width:10%;text-align:center;">'.$tax_master[$creative_array['DeliveryRef[gst_rate_table][]'][$key]]."%".'</td>
                   <td style="width:7%;text-align:right;">'.$split_amt[0].'</td>
                   <td style="width:8%;text-align:right;">'.$split_amt[1].'</td>
                   </tr>';
           $k++;
          }
         $transport_array=array(0=>'For Sale/Purchase',1=>'For Shipment',2=>'Transfer to Branch',3=>'For Execution of works contract',4=>'For Labour Work Processing');
        $fetch=array(0=>'unchecked',1=>'unchecked',2=>'unchecked',3=>'unchecked',4=>'unchecked');

        if(isset($transport_array[$creative_array['Delivery[transport]'][0]]))
        {
            $fetch_trans=$transport_array[$creative_array['Delivery[transport]'][0]];
        }
        else
        {
            $fetch_trans='-';
        }

    $tbl1.='</tbody>
        </table>
        </body>
            </html>';
           
            if($fetch_trans=="For Sales/Purchase"){
                $pdf->Image('images/tick.png', 15, 245, 4, 4, 'PNG');   
            }
            if($fetch_trans=="For Shipment"){
                $pdf->Image('images/tick.png', 57, 245, 4, 4, 'PNG');
            }
            if($fetch_trans=="Transfer to Branch" || $fetch_trans=="Head Office" || $fetch_trans=="Consignment agent"   ){
                $pdf->Image('images/tick.png', 90, 245, 4, 4, 'PNG');   
            }
            if($fetch_trans=="For Execution of works contact"){
                $pdf->Image('images/tick.png', 130, 245, 4, 4, 'PNG');  
            }
            if($fetch_trans=="For Labour Work Processing"){
                $pdf->Image('images/tick.png', 165, 245, 4, 4, 'PNG');  
            }
            $pdf->writeHTML($tbl1, true, false, false, false, '');
            $labincharge=$creative_array['Delivery[vehicle_num]'][0];
            $pdf->SetXY(120,252,true);
            $pdf->Cell(100, 0, $labincharge, 0, 0);
            $remark=$creative_array['Delivery[remarks]'][0];
            $pdf->SetXY(60,258,true);
            $pdf->Cell(100, 0, $remark, 0, 0);
            // $pdf->Cell(28, 185, $delivery_main_tbl['vehicle_num'], 0, $ln=0, 'C', 0, '', 0, false, 'T', 'C');
        /* if($fetch_trans=="Transfer to Branch"){
                
        } */    
        
        
    
        
        $pdf->Output('sunithaprinter1.pdf');        
  
  }


  public function actionPrint($id)
  {
    

    $delivery_main_tbl=Delivery::find()->where(['id'=>$id])->asArray()->one();
    $delivery_ref_tbl=DeliveryRef::find()->where(['delivery_id'=>$id])->asArray()->all();
    $delivery_ref_index=ArrayHelper::index($delivery_ref_tbl,'auto_id');
	//echo"<pre>";print_r($delivery_main_tbl); die;
    $customer_master=CustomerMaster::find()->where(['auto_id'=>$delivery_main_tbl['cust_id']])->asArray()->one();
    $config=$this->findConfiguration();
    $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');
    require ('../../vendor/tcpdf/tcpdf.php');
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('DMC');
        $pdf->SetTitle('Delivery Challan');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        $pdf->SetMargins(10, false, 10, true); // set the margins 
        $pdf->AddPage();
		//$pdf->Image('images/delivery.png', 0, 0, 3500, 4500 , 'PNG');
        // $pdf->Image('images/sp.png', 108, 38, 25, 23, 'PNG');
        // $pdf->Image('images/letters1.png', 132, 38, 50, 4, 'PNG');
          //$pdf->SetFontSize(11);
		
		/*$billno="SI NO : ".$delivery_main_tbl['bill_no'];
		$date="Date : 16-2-2019";
		$pdf->Cell(28, 35, $billno, 0, $ln=0, 'C', 0, '', 0, false, 'T', 'C');
		$pdf->Cell(298, 34, $date, 0, $ln=0, 'C', 0, '', 0, false, 'T', 'C');
		$companyaddress=$customer_master['company_name'];*/
		
		
        $tbl1='<html>
        <head>
        </head>
        <body class="main" style="font-size:11px;border:1px solid #000;">';  
        $tbl1.='<p></p><p></p><p></p>
        <table ><tbody>
           <tr> 
           	<td style="width:15%;"></td> 
           	<td style="font-size:13px;width:35%;"><b> '.$delivery_main_tbl['bill_no'].'</b></td> 
           	<td style="text-align:right;width:46%;font-size:13px;"> <b> '.date('d/m/Y').'</b> </td>
           </tr></tbody>
        </table><p></p><p></p> <p></p><p></p><p></p><p></p><br><br><br>
        <table style="font-size:12px;"><tbody>
           <tr> 
           		<td style="width:55%;line-height:1.0;font-size:13px;"></td>
          		<td style="width:45%;line-height:1.2;font-size:13px;"><br><b>'.ucwords($customer_master['company_name']).'</b></td> 
           </tr>
           <tr> 
           		<td style="width:20%;line-height:1.0;font-size:13px;"></td>
          		<td style="width:70%;line-height:1.7;font-size:11px;">'.$customer_master['gst'].' </td> 
           </tr>
           <tr> 
           		<td style="width:20%;line-height:1.0;font-size:13px;"></td>
          		<td style="width:70%;line-height:1.7;font-size:11px;">'.$customer_master['state'].' </td> 
           </tr>
           <tr> 
           		<td style="width:20%;line-height:1.0;font-size:13px;"></td>
          		<td style="width:70%;line-height:1.7;font-size:11px;">'.$customer_master['state_code'].'<br/> </td> 
           </tr>
          </tbody>
        </table><br/><br/><br/>
        <table style="font-size:11px;"><tbody>
           <tr> 
           <td style="width:05%;line-height:1.3;"></td>
           <td style="width:50%;line-height:1.3;">'.$config['Company Name']['value'].', <br/>'.$config['street']['value'].',<br/>'.$config['area']['value'].','.$config['district']['value'].' - '.$config['pincode']['value'].'. <br/>Phone : '.$config['primary_phno']['value'].' / '.$config['secondary_ph_no']['value'].' </td> 
           <td style="width:49%;line-height:1.3;"><br/>'.ucwords($delivery_main_tbl['company_name']).'<br/>'.$delivery_main_tbl['delivery_address'].'<br/></td></tr></tbody>
        </table>
        <br/><br/><br/><br/><br/><br/>
        
        <table style="font-size:12px;" class="tbl-pro"><thead>';
          $k=1;
          foreach ($delivery_ref_index as $key => $value) 
          {   $split_amt=explode('.', number_format($value['amount'],2));
               $tbl1.=' <tr> 
                   <td style="width:5%;line-height:1.7;font-size:13px;text-align:center;">'.$k.'</td>
                   <td style="width:50%;line-height:1.7;font-size:13px;">'.ucwords($value['description']).'</td> 
                   <td style="width:10%;text-align:center;">'.$value['qty'].'</td>
                   <td style="width:10%;text-align:center;">'.$value['hsn'].'</td>
                   <td style="width:10%;text-align:center;">'.$tax_master[$value['gst_rate']].'</td>
                   <td style="width:7%;text-align:right;">'.$split_amt[0].'</td>
                   <td style="width:8%;text-align:right;">'.$split_amt[1].'</td>
                   </tr>';
           $k++;
          }
         $transport_array=array(0=>'For Sale/Purchase',1=>'For Shipment',2=>'Transfer to Branch',3=>'For Execution of works contract',4=>'For Labour Work Processing');
        $fetch=array(0=>'unchecked',1=>'unchecked',2=>'unchecked',3=>'unchecked',4=>'unchecked');

        if(isset($transport_array[$delivery_main_tbl['transport']]))
        {
            $fetch_trans=$transport_array[$delivery_main_tbl['transport']];
        }
        else
        {
            $fetch_trans='-';
        }

    $tbl1.='</tbody>
        </table>
        </body>
            </html>';
           
			if($fetch_trans=="For Sales/Purchase"){
				$pdf->Image('images/tick.png', 15, 245, 4, 4, 'PNG');	
			}
			if($fetch_trans=="For Shipment"){
				$pdf->Image('images/tick.png', 57, 245, 4, 4, 'PNG');
			}
			if($fetch_trans=="Transfer to Branch" || $fetch_trans=="Head Office" || $fetch_trans=="Consignment agent"   ){
				$pdf->Image('images/tick.png', 90, 245, 4, 4, 'PNG');	
			}
			if($fetch_trans=="For Execution of works contact"){
				$pdf->Image('images/tick.png', 130, 245, 4, 4, 'PNG');	
			}
			if($fetch_trans=="For Labour Work Processing"){
				$pdf->Image('images/tick.png', 165, 245, 4, 4, 'PNG');	
			}
			$pdf->writeHTML($tbl1, true, false, false, false, '');
			$labincharge=$delivery_main_tbl['vehicle_num'];
			$pdf->SetXY(120,252,true);
			$pdf->Cell(100, 0, $labincharge, 0, 0);
			$remark=$delivery_main_tbl['remarks'];
			$pdf->SetXY(60,258,true);
			$pdf->Cell(100, 0, $remark, 0, 0);
			
        
        
    
        
        $pdf->Output('sunithaprinter1.pdf');        
  
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
