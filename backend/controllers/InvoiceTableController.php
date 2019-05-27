<?php

namespace backend\controllers;

use Yii;
use backend\models\InvoiceTable;
use backend\models\InvoiceTableSerach;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\InvoiceRefTbl;
use backend\models\Taxmaster;
use backend\models\CustomerMaster;
use yii\helpers\ArrayHelper;
use backend\models\AutoIdtable;
use backend\models\InvoiceTableLog;

use backend\models\InvoiceRefTblLog;
use backend\models\Configuration;
use backend\models\DeliveryRef;
use backend\models\Delivery;
use backend\models\ConfigYear;

/**
 * InvoiceTableController implements the CRUD actions for InvoiceTable model.
 */
class InvoiceTableController extends Controller
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
     * Lists all InvoiceTable models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvoiceTableSerach();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReindex()
    {

        $searchModel = new InvoiceTableSerach();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        Yii::$app->session->setFlash('success', 'Record Saved Successfully');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InvoiceTable model.
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
     * Creates a new InvoiceTable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InvoiceTable();

        $invoice_ref=new  InvoiceRefTbl();

        $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

        $tax_master_percent=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxvalue');

        $customer_master= CustomerMaster::find()->asArray()->all();

        $session = Yii::$app->session;

        if ($model->load(Yii::$app->request->post())) 
        {
             //echo '<pre>';
            //print_r($_POST);die;
            $customer_master_one= CustomerMaster::findOne($_POST['custId']);
             $config=$this->findConfiguration();
                $fetch_array=array();

            $curr_year=$this->ConfigReset();
            $AutoIdtable=AutoIdtable::findOne(2);

            $autoget=$AutoIdtable->number_field;
            $inc_value=$autoget+1;
            $rtno = str_pad($autoget, 4, "0", STR_PAD_LEFT);
            $rtno='INV-'.$curr_year.'-'.$rtno;
            if($customer_master_one['gst'] == '')
            {
              CustomerMaster::updateAll(['gst'=>$_POST['InvoiceTable']['gstin_no'] ,'user_id' => $session['headlinestv_id'],'updated_ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto_id' => $_POST['custId'] ]);
            }


            $model->bill_number=$rtno;
            $model->bill_date=date('Y-m-d H:i:s');
            $model->company_name=$_POST['InvoiceTable']['company_name'];
            $model->company_id=$_POST['custId'];
            $model->customer_name=$_POST['InvoiceTable']['customer_name'];
            $model->gstin_no=$_POST['InvoiceTable']['gstin_no'];
            $model->total_ampunt=array_sum($_POST['InvoiceRefTbl']['amount_table']);
            $model->tax_type=$_POST['InvoiceTable']['tax_type'];
            $model->tax_id=$_POST['InvoiceTable']['tax_id'];
            if($_POST['InvoiceTable']['tax_type'] == 'GST')
            {
                $model->total_gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                $model->total_cgst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2;
                $model->total_sgst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2;
            }
            else if($_POST['InvoiceTable']['tax_type'] == 'IGST')
            {
                $model->total_gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
            }
            $model->created_date=date('Y-m-d H:i:s');
            $model->user_id=$session['headlinestv_id'];
            $model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
            
            if($model->save())
            {
                $invoice_table_log = new InvoiceTableLog();
                $invoice_table_log->invoice_id = $model->id;
                $invoice_table_log->bill_number=$rtno;
                $invoice_table_log->bill_date=date('Y-m-d H:i:s');
                $invoice_table_log->company_name=$_POST['InvoiceTable']['company_name'];
                //$invoice_table_log->customer_name=$_POST['InvoiceTable']['customer_name'];
                $invoice_table_log->gstin_no=$_POST['InvoiceTable']['gstin_no'];
                $invoice_table_log->total_ampunt=array_sum($_POST['InvoiceRefTbl']['amount_table']);
               // $invoice_table_log->amt_in_words=;
             
                $invoice_table_log->tax_type=$_POST['InvoiceTable']['tax_type'];
                $invoice_table_log->tax_id=$_POST['InvoiceTable']['tax_id'];
                if($_POST['InvoiceTable']['tax_type'] == 'GST')
                {
                    $invoice_table_log->total_gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                    $invoice_table_log->total_cgst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2;
                    $invoice_table_log->total_sgst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2;
                }
                else if($_POST['InvoiceTable']['tax_type'] == 'IGST')
                {
                   $invoice_table_log->total_gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                }
                $invoice_table_log->created_date=date('Y-m-d H:i:s');
                $invoice_table_log->user_id=$session['headlinestv_id'];
                $invoice_table_log->updated_ipaddress=$_SERVER['REMOTE_ADDR'];

                if($invoice_table_log->save())
                {
                    foreach ($_POST['InvoiceRefTbl']['description_table'] as $key => $value) 
                    {
                        $invoice_ref_tbl= new InvoiceRefTbl();
                        $invoice_ref_tbl->invoice_id=$model->id;
                        $invoice_ref_tbl->sac_code=$config['SAC CODE']['value'];
                        $invoice_ref_tbl->bill_number=$rtno;
                        $invoice_ref_tbl->bill_date=date('Y-m-d H:i:s');
                        $invoice_ref_tbl->description=$value;
                        $invoice_ref_tbl->amount=$_POST['InvoiceRefTbl']['amount_table'][$key];
                        $invoice_ref_tbl->gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                       // $invoice_ref_tbl->cgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                       // $invoice_ref_tbl->sgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                        $invoice_ref_tbl->created_date=date('Y-m-d H:i:s');
                        $invoice_ref_tbl->user_id=$session['headlinestv_id'];
                        $invoice_ref_tbl->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
                            
                        if($invoice_ref_tbl->save())
                        {
                            $invoice_ref_tbl_log= new InvoiceRefTblLog();
                            $invoice_ref_tbl_log->invoice_table_log_id=$invoice_table_log->auto_id;
                            $invoice_ref_tbl_log->invoice_ref_id=$invoice_ref_tbl->id;
                            $invoice_ref_tbl_log->bill_number=$rtno;
                            $invoice_ref_tbl_log->bill_date=date('Y-m-d H:i:s');
                            $invoice_ref_tbl_log->sac_code=$config['SAC CODE']['value'];
                            $invoice_ref_tbl_log->description=$value;
                            $invoice_ref_tbl_log->amount=$_POST['InvoiceRefTbl']['amount_table'][$key];
                            $invoice_ref_tbl_log->gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                           // $invoice_ref_tbl_log->cgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                            //$invoice_ref_tbl_log->sgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                            
                            
                            $invoice_ref_tbl_log->created_date=date('Y-m-d H:i:s');
                            $invoice_ref_tbl_log->user_id=$session['headlinestv_id'];
                            $invoice_ref_tbl_log->updated_ipaddress=$_SERVER['REMOTE_ADDR'];

                            if($invoice_ref_tbl_log->save())
                            {

                            }
                            else
                            {
                                echo '<pre>';
                                print_r($invoice_ref_tbl_log->getErrors());die;
                            }
                        }
                        else
                        {
                            print_r($invoice_ref_tbl->getErrors());die;
                        }
                    }
                }
                

            } 
            else
            {
                print_r($model->getErrors());die;
            }

            AutoIdtable::updateAll(['number_field' => $inc_value], ['id' => 2]);

            if(!empty($_POST['CONVERTDC']))
            {
                Delivery::updateAll(['convert_status' => 'IV', 'convert_id'=> $model->id], ['id' => $_POST['CONVERTDC']]);
            }

            $fetch_array[0]='okay';
            $fetch_array[1]=$rtno;
            
            return json_encode($fetch_array);
        }
        else
        {
            return $this->render('create', [
                'model' => $model,
                'invoice_ref' => $invoice_ref,
                'tax_master' => $tax_master,
                'customer_master' => $customer_master,
             ]);
        }

    }


  public function actionConvertinvoice($id)
  {
      $delivery=Delivery::find()->where(['id'=>$id])->asArray()->one();

      $delivery_ref=DeliveryRef::find()->where(['delivery_id'=>$id])->asArray()->all();
      
      if($delivery['convert_status'] == 'IV')
      {
            $model = $this->findModel($delivery['convert_id']);

            $invoice_ref=new InvoiceRefTbl();

            $invoice_ref_fetch=$this->findInvoiceRefTblModel($delivery['convert_id']);

            $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

            $tax_master_percent=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxvalue');

            $customer_master= CustomerMaster::find()->asArray()->all();

            $session = Yii::$app->session;

            return $this->render('_formconvert', [
                'model' => $model,
                'invoice_ref' => $invoice_ref,
                'tax_master' => $tax_master,
                'customer_master' => $customer_master,
                'delivery' => $delivery,
                'delivery_ref' => $delivery_ref,
                'invoice_ref_fetch' => $invoice_ref_fetch,
             ]);
      }
      else if($delivery['convert_status'] == '')
      {
            $model = new InvoiceTable();

            $invoice_ref=new  InvoiceRefTbl();

            $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

            $tax_master_percent=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxvalue');

            $customer_master= CustomerMaster::find()->asArray()->all();

            $session = Yii::$app->session;

            return $this->render('_formconvert', [
                'model' => $model,
                'invoice_ref' => $invoice_ref,
                'tax_master' => $tax_master,
                'customer_master' => $customer_master,
                'delivery' => $delivery,
                'delivery_ref' => $delivery_ref
             ]);
      }

  }


    public function actionPrintsave()
    {
        $model = new InvoiceTable();

        $invoice_ref=new  InvoiceRefTbl();

        $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

        $tax_master_percent=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxvalue');

        $customer_master= CustomerMaster::find()->asArray()->all();

        $session = Yii::$app->session;

        if ($model->load(Yii::$app->request->post())) 
        {
             //echo '<pre>';
            //print_r($_POST);die;
            $customer_master_one= CustomerMaster::findOne($_POST['custId']);
            $config=$this->findConfiguration();
            $fetch_array=array();
            
            $curr_year=$this->ConfigReset();
            $AutoIdtable=AutoIdtable::findOne(2);

            $autoget=$AutoIdtable->number_field;
            $inc_value=$autoget+1;
            $rtno = str_pad($autoget, 4, "0", STR_PAD_LEFT);
            $rtno='INV-'.$curr_year.'-'.$rtno;
            if($customer_master_one['gst'] == '')
            {
              CustomerMaster::updateAll(['gst'=>$_POST['InvoiceTable']['gstin_no'] ,'user_id' => $session['headlinestv_id'],'updated_ipaddress'=> $_SERVER['REMOTE_ADDR']], ['auto_id' => $_POST['custId'] ]);
            }


            $model->bill_number=$rtno;
            $model->bill_date=date('Y-m-d H:i:s');
            $model->company_name=$_POST['InvoiceTable']['company_name'];
            $model->company_id=$_POST['custId'];
            $model->customer_name=$_POST['InvoiceTable']['customer_name'];
            $model->gstin_no=$_POST['InvoiceTable']['gstin_no'];
            $model->total_ampunt=array_sum($_POST['InvoiceRefTbl']['amount_table']);
            $model->tax_type=$_POST['InvoiceTable']['tax_type'];
            $model->tax_id=$_POST['InvoiceTable']['tax_id'];
            if($_POST['InvoiceTable']['tax_type'] == 'GST')
            {
                $model->total_gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                $model->total_cgst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2;
                $model->total_sgst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2;
            }
            else if($_POST['InvoiceTable']['tax_type'] == 'IGST')
            {
                $model->total_gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
            }
            $model->created_date=date('Y-m-d H:i:s');
            $model->user_id=$session['headlinestv_id'];
            $model->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
            
            if($model->save())
            {
                $invoice_table_log = new InvoiceTableLog();
                $invoice_table_log->invoice_id = $model->id;
                $invoice_table_log->bill_number=$rtno;
                $invoice_table_log->bill_date=date('Y-m-d H:i:s');
                $invoice_table_log->company_name=$_POST['InvoiceTable']['company_name'];
                //$invoice_table_log->customer_name=$_POST['InvoiceTable']['customer_name'];
                $invoice_table_log->gstin_no=$_POST['InvoiceTable']['gstin_no'];
                $invoice_table_log->total_ampunt=array_sum($_POST['InvoiceRefTbl']['amount_table']);
               // $invoice_table_log->amt_in_words=;
             
                $invoice_table_log->tax_type=$_POST['InvoiceTable']['tax_type'];
                $invoice_table_log->tax_id=$_POST['InvoiceTable']['tax_id'];
                if($_POST['InvoiceTable']['tax_type'] == 'GST')
                {
                    $invoice_table_log->total_gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                    $invoice_table_log->total_cgst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2;
                    $invoice_table_log->total_sgst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2;
                }
                else if($_POST['InvoiceTable']['tax_type'] == 'IGST')
                {
                   $invoice_table_log->total_gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                }
                $invoice_table_log->created_date=date('Y-m-d H:i:s');
                $invoice_table_log->user_id=$session['headlinestv_id'];
                $invoice_table_log->updated_ipaddress=$_SERVER['REMOTE_ADDR'];

                if($invoice_table_log->save())
                {
                    foreach ($_POST['InvoiceRefTbl']['description_table'] as $key => $value) 
                    {
                        $invoice_ref_tbl= new InvoiceRefTbl();
                        $invoice_ref_tbl->invoice_id=$model->id;
                        $invoice_ref_tbl->sac_code=$config['SAC CODE']['value'];
                        $invoice_ref_tbl->bill_number=$rtno;
                        $invoice_ref_tbl->bill_date=date('Y-m-d H:i:s');
                        $invoice_ref_tbl->description=$value;
                        $invoice_ref_tbl->amount=$_POST['InvoiceRefTbl']['amount_table'][$key];
                        $invoice_ref_tbl->gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                       // $invoice_ref_tbl->cgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                       // $invoice_ref_tbl->sgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                        $invoice_ref_tbl->created_date=date('Y-m-d H:i:s');
                        $invoice_ref_tbl->user_id=$session['headlinestv_id'];
                        $invoice_ref_tbl->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
                            
                        if($invoice_ref_tbl->save())
                        {
                            $invoice_ref_tbl_log= new InvoiceRefTblLog();
                            $invoice_ref_tbl_log->invoice_table_log_id=$invoice_table_log->auto_id;
                            $invoice_ref_tbl_log->invoice_ref_id=$invoice_ref_tbl->id;
                            $invoice_ref_tbl_log->bill_number=$rtno;
                            $invoice_ref_tbl_log->bill_date=date('Y-m-d H:i:s');
                            $invoice_ref_tbl_log->sac_code=$config['SAC CODE']['value'];
                            $invoice_ref_tbl_log->description=$value;
                            $invoice_ref_tbl_log->amount=$_POST['InvoiceRefTbl']['amount_table'][$key];
                            $invoice_ref_tbl_log->gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                           // $invoice_ref_tbl_log->cgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                            //$invoice_ref_tbl_log->sgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                            
                            
                            $invoice_ref_tbl_log->created_date=date('Y-m-d H:i:s');
                            $invoice_ref_tbl_log->user_id=$session['headlinestv_id'];
                            $invoice_ref_tbl_log->updated_ipaddress=$_SERVER['REMOTE_ADDR'];

                            if($invoice_ref_tbl_log->save())
                            {

                            }
                            else
                            {
                                echo '<pre>';
                                print_r($invoice_ref_tbl_log->getErrors());die;
                            }
                        }
                        else
                        {
                            print_r($invoice_ref_tbl->getErrors());die;
                        }
                    }

                    AutoIdtable::updateAll(['number_field' => $inc_value], ['id' => 2]);

                    if(!empty($_POST['CONVERTDC']))
                    {
                        Delivery::updateAll(['convert_status' => 'IV', 'convert_id'=> $model->id], ['id' => $_POST['CONVERTDC']]);
                    }

                    $fetch_array[0]='okay';
                    $fetch_array[1]=$model->id;
                    
                    return json_encode($fetch_array);


                }
                

            } 
            else
            {
                print_r($model->getErrors());die;
            }

           
        }
    }


    /**
     * Updates an existing InvoiceTable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $invoice_ref= new InvoiceRefTbl();

        $invoice_ref_fetch=$this->findInvoiceRefTblModel($id);

        

        $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

        $customer_master= CustomerMaster::find()->asArray()->all();

        $session = Yii::$app->session;

          $tax_master_percent=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxvalue');
           $config=$this->findConfiguration();
        if ($model->load(Yii::$app->request->post())) 
        {
            $fetch_array=array();
            InvoiceTable::updateAll(['total_ampunt' => array_sum($_POST['InvoiceRefTbl']['amount_table']),'tax_type'=>$_POST['InvoiceTable']['tax_type'],'tax_id'=>$_POST['InvoiceTable']['tax_id'],'total_gst_percent'=> $tax_master_percent[$_POST['InvoiceTable']['tax_id']],'total_cgst_percent'=> $_POST['InvoiceTable']['tax_type'] == 'GST' ? $tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2 : null, 'total_sgst_percent'=> $_POST['InvoiceTable']['tax_type'] == 'GST' ? $tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2 : null ,'user_id'=>$session['headlinestv_id'],'updated_ipaddress'=>$_SERVER['REMOTE_ADDR']], ['id' => $id]);


            InvoiceRefTbl::deleteAll(['invoice_id' => $id]);

                $invoice_table_log = new InvoiceTableLog();
                $invoice_table_log->invoice_id = $id;
                $invoice_table_log->bill_number= $model->bill_number;
                $invoice_table_log->bill_date=$model->bill_date;
                $invoice_table_log->company_name=$_POST['InvoiceTable']['company_name'];
                $invoice_table_log->gstin_no=$_POST['InvoiceTable']['gstin_no'];
                $invoice_table_log->total_ampunt=array_sum($_POST['InvoiceRefTbl']['amount_table']);
                $invoice_table_log->tax_type=$_POST['InvoiceTable']['tax_type'];
                $invoice_table_log->tax_id=$_POST['InvoiceTable']['tax_id'];
                if($_POST['InvoiceTable']['tax_type'] == 'GST')
                {
                    $invoice_table_log->total_gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                    $invoice_table_log->total_cgst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2;
                    $invoice_table_log->total_sgst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2;
                }
                else if($_POST['InvoiceTable']['tax_type'] == 'IGST')
                {
                   $invoice_table_log->total_gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                }
                $invoice_table_log->created_date=date('Y-m-d H:i:s');
                $invoice_table_log->user_id=$session['headlinestv_id'];
                $invoice_table_log->updated_ipaddress=$_SERVER['REMOTE_ADDR'];

                if($invoice_table_log->save())
                {
                    foreach ($_POST['InvoiceRefTbl']['description_table'] as $key => $value) 
                    {
                        $invoice_ref_tbl= new InvoiceRefTbl();
                        $invoice_ref_tbl->invoice_id=$model->id;
                        $invoice_ref_tbl->sac_code=$config['SAC CODE']['value'];
                        $invoice_ref_tbl->bill_number=$model->bill_number;
                        $invoice_ref_tbl->bill_date=$model->bill_date;
                        $invoice_ref_tbl->description= $value;
                        $invoice_ref_tbl->amount=$_POST['InvoiceRefTbl']['amount_table'][$key];
                        $invoice_ref_tbl->gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                       // $invoice_ref_tbl->cgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                       // $invoice_ref_tbl->sgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                        $invoice_ref_tbl->created_date=date('Y-m-d H:i:s');
                        $invoice_ref_tbl->user_id=$session['headlinestv_id'];
                        $invoice_ref_tbl->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
                            
                        if($invoice_ref_tbl->save())
                        {

                            $invoice_ref_tbl_log= new InvoiceRefTblLog();
                            $invoice_ref_tbl_log->invoice_table_log_id=$invoice_table_log->auto_id;
                            $invoice_ref_tbl_log->invoice_ref_id=$invoice_ref_tbl->id;
                            $invoice_ref_tbl_log->bill_number=$model->bill_number;
                            $invoice_ref_tbl_log->bill_date=$model->bill_date;
                            $invoice_ref_tbl_log->sac_code=$config['SAC CODE']['value'];
                            $invoice_ref_tbl_log->description=$value;;
                            $invoice_ref_tbl_log->amount=$_POST['InvoiceRefTbl']['amount_table'][$key];
                            $invoice_ref_tbl_log->gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                           // $invoice_ref_tbl_log->cgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                            //$invoice_ref_tbl_log->sgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                            
                            
                            $invoice_ref_tbl_log->created_date=date('Y-m-d H:i:s');
                            $invoice_ref_tbl_log->user_id=$session['headlinestv_id'];
                            $invoice_ref_tbl_log->updated_ipaddress=$_SERVER['REMOTE_ADDR'];

                            if($invoice_ref_tbl_log->save())
                            {

                            }
                            else
                            {
                                echo '<pre>';
                                print_r($invoice_ref_tbl_log->getErrors());die;
                            }
                        }
                        else
                        {
                            echo '<pre>';
                            print_r($invoice_ref_tbl->getErrors());die;   
                        }

                    }
                       $fetch_array[0]='okay';
                       $fetch_array[1]=$id;
                       return json_encode($fetch_array);
                }
                else
                {
                    echo '<pre>';
                    print_r($invoice_table_log->getErrors());die;
                }

             
           
            //return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('update', [
             'model' => $model,
             'invoice_ref' => $invoice_ref,
             'tax_master' => $tax_master,
             'customer_master' => $customer_master,
             'invoice_ref_fetch' =>$invoice_ref_fetch,
            ]);
        }
        
    }

 public function actionUpdateprint($id)
 {
        $model = $this->findModel($id);

        $invoice_ref= new InvoiceRefTbl();

        $invoice_ref_fetch=$this->findInvoiceRefTblModel($id);

        

        $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

        $customer_master= CustomerMaster::find()->asArray()->all();

        $session = Yii::$app->session;

        $tax_master_percent=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxvalue');
        $config=$this->findConfiguration();
        if ($model->load(Yii::$app->request->post())) 
        {
            $fetch_array=array();
            InvoiceTable::updateAll(['total_ampunt' => array_sum($_POST['InvoiceRefTbl']['amount_table']),'tax_type'=>$_POST['InvoiceTable']['tax_type'],'tax_id'=>$_POST['InvoiceTable']['tax_id'],'total_gst_percent'=> $tax_master_percent[$_POST['InvoiceTable']['tax_id']],'total_cgst_percent'=> $_POST['InvoiceTable']['tax_type'] == 'GST' ? $tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2 : null, 'total_sgst_percent'=> $_POST['InvoiceTable']['tax_type'] == 'GST' ? $tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2 : null ,'user_id'=>$session['headlinestv_id'],'updated_ipaddress'=>$_SERVER['REMOTE_ADDR']], ['id' => $id]);


            InvoiceRefTbl::deleteAll(['invoice_id' => $id]);

                $invoice_table_log = new InvoiceTableLog();
                $invoice_table_log->invoice_id = $id;
                $invoice_table_log->bill_number= $model->bill_number;
                $invoice_table_log->bill_date=$model->bill_date;
                $invoice_table_log->company_name=$_POST['InvoiceTable']['company_name'];
                $invoice_table_log->gstin_no=$_POST['InvoiceTable']['gstin_no'];
                $invoice_table_log->total_ampunt=array_sum($_POST['InvoiceRefTbl']['amount_table']);
                $invoice_table_log->tax_type=$_POST['InvoiceTable']['tax_type'];
                $invoice_table_log->tax_id=$_POST['InvoiceTable']['tax_id'];
                if($_POST['InvoiceTable']['tax_type'] == 'GST')
                {
                    $invoice_table_log->total_gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                    $invoice_table_log->total_cgst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2;
                    $invoice_table_log->total_sgst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']]/2;
                }
                else if($_POST['InvoiceTable']['tax_type'] == 'IGST')
                {
                   $invoice_table_log->total_gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                }
                $invoice_table_log->created_date=date('Y-m-d H:i:s');
                $invoice_table_log->user_id=$session['headlinestv_id'];
                $invoice_table_log->updated_ipaddress=$_SERVER['REMOTE_ADDR'];

                if($invoice_table_log->save())
                {
                    foreach ($_POST['InvoiceRefTbl']['description_table'] as $key => $value) 
                    {
                        $invoice_ref_tbl= new InvoiceRefTbl();
                        $invoice_ref_tbl->invoice_id=$model->id;
                        $invoice_ref_tbl->sac_code=$config['SAC CODE']['value'];
                        $invoice_ref_tbl->bill_number=$model->bill_number;
                        $invoice_ref_tbl->bill_date=$model->bill_date;
                        $invoice_ref_tbl->description= $value;
                        $invoice_ref_tbl->amount=$_POST['InvoiceRefTbl']['amount_table'][$key];
                        $invoice_ref_tbl->gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                       // $invoice_ref_tbl->cgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                       // $invoice_ref_tbl->sgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                        $invoice_ref_tbl->created_date=date('Y-m-d H:i:s');
                        $invoice_ref_tbl->user_id=$session['headlinestv_id'];
                        $invoice_ref_tbl->updated_ipaddress=$_SERVER['REMOTE_ADDR'];
                            
                        if($invoice_ref_tbl->save())
                        {

                            $invoice_ref_tbl_log= new InvoiceRefTblLog();
                            $invoice_ref_tbl_log->invoice_table_log_id=$invoice_table_log->auto_id;
                            $invoice_ref_tbl_log->invoice_ref_id=$invoice_ref_tbl->id;
                            $invoice_ref_tbl_log->bill_number=$model->bill_number;
                            $invoice_ref_tbl_log->bill_date=$model->bill_date;
                            $invoice_ref_tbl_log->sac_code=$config['SAC CODE']['value'];
                            $invoice_ref_tbl_log->description=$value;;
                            $invoice_ref_tbl_log->amount=$_POST['InvoiceRefTbl']['amount_table'][$key];
                            $invoice_ref_tbl_log->gst_percent=$tax_master_percent[$_POST['InvoiceTable']['tax_id']];
                           // $invoice_ref_tbl_log->cgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                            //$invoice_ref_tbl_log->sgst_percent=$_POST['InvoiceRefTbl']['gst_percent'][$key]/2;
                            
                            
                            $invoice_ref_tbl_log->created_date=date('Y-m-d H:i:s');
                            $invoice_ref_tbl_log->user_id=$session['headlinestv_id'];
                            $invoice_ref_tbl_log->updated_ipaddress=$_SERVER['REMOTE_ADDR'];

                            if($invoice_ref_tbl_log->save())
                            {

                            }
                            else
                            {
                                echo '<pre>';
                                print_r($invoice_ref_tbl_log->getErrors());die;
                            }
                        }
                        else
                        {
                            echo '<pre>';
                            print_r($invoice_ref_tbl->getErrors());die;   
                        }

                    }
                       $fetch_array[0]='okay';
                       $fetch_array[1]=$id;
                       return json_encode($fetch_array);
                }
                else
                {
                    echo '<pre>';
                    print_r($invoice_table_log->getErrors());die;
                }

             
           
            //return $this->redirect(['view', 'id' => $model->id]);
        }
 }


  public function actionPrint($id)
  { 


    $invoice_main_tbl=InvoiceTable::find()->where(['id'=>$id])->asArray()->one();


    $invoice_ref_tbl=InvoiceRefTbl::find()->where(['invoice_id'=>$id])->asArray()->all();
    
    $invoice_ref_tbl_index=ArrayHelper::index($invoice_ref_tbl,'id');

    $customer_master=CustomerMaster::find()->where(['auto_id'=>$invoice_main_tbl['company_id']])->asArray()->one();
   
    $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');

    $config=$this->findConfiguration();
    


    require ('../../vendor/tcpdf/tcpdf.php');
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('SUNITHA');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 8, '', true);
        $pdf->SetMargins(false, false, false, true); // set the margins
        $pdf->Image('images/invoice.png', 0, 0, 4000, 4500 , 'PNG'); 
        $pdf->AddPage();
        
		$pdf->setCellPaddings(0,0,0,0);
        
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(1);
$pdf->SetFooterMargin(1); 
        
          //$pdf->Image('images/delivery.png', 0, 0, 3500, 4500 , 'PNG');
		  
		//  $img_file ="http://192.168.1.71/2019/sunitha_printers/backend/web/images/invoice.png";
        //$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
		  
          // $pdf->Image('images/letters1.png', 70, 38, 50, 4, 'PNG');
        $tbl1='<html>
        <head>
          <style>
          .serialno{
          	
          	padding-left:100px;
          }
          </style>
        </head>
        <body style="font-size:11px;"><p></p>
        
        ';  
        $tbl1.='<table style="font-size:12px;">
            <tbody>
                   <tr>
                   <td style="width:93.5%;"><p style="line-height:1.0;text-align:right;"><b> SI NO : '.$invoice_main_tbl['bill_number'].' </b></p></td>
                   </tr>
                   </tbody>
            </table>
            <table style="font-size:12px;">
            <tbody>
            </table > <p></p><p></p><p></p><p></p>
            <p></p><p></p><p></p>
                <table style="font-size:12px;">
            <tbody> 
              <tr>
                  <td style="width:8%;"></td> 
                  <td style="width:50%;" ><p style="line-height:1.3;"><br/>
              		  <B>'.ucwords($customer_master['company_name']).'</B> 
                		<br/> '.$customer_master['address'].'<br/>
                		'.$customer_master['city'].',<br/>'.$customer_master['state'].'-'.$customer_master['pincode'].'.<br/></p></td>
                <td style="width:35%;text-align:right;"><B>Date :  '.date('d/m/Y',strtotime($invoice_main_tbl['bill_date'])).' </B></td>
              </tr>
              <tr>
                <td style="width:8%;"></td>
                <td ><b>GSTIN : '.$customer_master['gst'].' </b></td>
              </tr>
            </tbody>
            </table >
            <br/><br/><p></p><p></p><p></p>
            <table style="font-size:12px;line-height:1.7;width:100%" class="production">
            <tbody>';
                   $k=1;
				   $x=215;
				    $y=18;
                   foreach ($invoice_ref_tbl_index as $key => $value) 
                   {
                   	 $split_amount=number_format($value['amount'],2);
					 $amount_val=explode('.', $split_amount);
                      $tbl1.='<tr> 
                      <td style="width:12%;text-align:Center;" class="serialno">'.$k.'</td>
                      <td style="width:12%;text-align:left;">'.$value['sac_code'].'</td>
                      <td style="width:48%;text-align:left;">'.ucwords($value['description']).'</td>
                      <td style="width:18%;text-align:right">'.$amount_val[0].'</td>
                      <td style="width:9%;text-align:right" > '.$amount_val[1].'</td>
                      </tr>';
					  $x=$x+35;
					 $y=1;	 
					  $k++;
				   }
                   
				   $split_invoiceamt=number_format($invoice_main_tbl['total_ampunt'],2);
				   $invoiceamt=explode('.', $split_invoiceamt);
              $tbl1.='<tr><td><p></p><p></p></td></tr>
              		<tr> 
                      <td></td>
                      <td></td>
                      <td style="text-align:right"><b>TOTAL</b></td>
                      <td style="text-align:right">'.$invoiceamt[0].'</td>
                      <td style="text-align:right" >'.$invoiceamt[1].'</td>
                      </tr>';  
                  
             $tbl1.='</tbody>
            </table>
            <table style="font-size:13px;line-height:1.7" class="production">
            <tbody>';
            if($invoice_main_tbl['tax_type'] == 'GST')
            {    
                $div=$invoice_main_tbl['total_gst_percent']/2;
                $calc=($invoice_main_tbl['total_ampunt']*$div)/100;
                $total=($calc*2)+$invoice_main_tbl['total_ampunt'];
				$split_cal=number_format($calc,2);
				$calc_amt=explode('.', $split_cal);
                $tbl1.='<tr> 
                      <td style="width:12%;" >  </td>
                      <td style="width:12%;" >  </td>
                      <td style="width:48%;text-align:right"  > <b>CGST '.$div.'% </b></td>
                      <td style="width:18%;text-align:right" > '.$calc_amt[0].' </td>
                      <td style="width:9%;text-align:right" >'.$calc_amt[1].'</td>
                   </tr>
                   <tr> 
                      <td>  </td>
                      <td>  </td>
                      <td style="text-align:right"> <b>SGST '.$div.'%</b> </td>
                      <td style="text-align:right"> '.$calc_amt[0].' </td>
                      <td style="text-align:right" >'.$calc_amt[1].' </td>
                   </tr>';
            }
            else if($invoice_main_tbl['tax_type'] == 'IGST')
            {
                $div=$invoice_main_tbl['total_gst_percent'];
                $calc=($invoice_main_tbl['total_ampunt']*$div)/100;
                $calc=number_format($calc,2);
                $total=$calc+$invoice_main_tbl['total_ampunt'];

                $cal_ist=explode('.', $calc);
                $tbl1.='<tr> 
                      <td style="width:12%;" >  </td>
                      <td style="width:12%;" >  </td>
                      <td style="width:48%;text-align:right"  > IGST '.$invoice_main_tbl['total_gst_percent'].'% </td>
                      <td style="width:18%;text-align:right" > '.$cal_ist[0].' </td>
                      <td style="width:9%;text-align:right" > '.$cal_ist[1].' </td>
                   </tr>';
                   
            
            } 
				$split_totla=number_format($total,2);
				$total_value=explode('.', $split_totla);
				//print_r($total_value); die;
				$pdf->writeHTML($tbl1, true, false, false, false, '');
			 $tbl1.=' </tbody>
            </table>';
			$tbl2='<table style="font-size:13px;line-height:1.7" class="production">
            <tbody>
			       <tr> 
                      <td style="width:12%;">  </td>
                      <td style="width:12%;">  </td>
                      <td style="width:48%;text-align:right;"></td>
                      <td style="width:18%;text-align:right;"><b> '.$total_value[0].'  </b></td>
                      <td style="width:9%;text-align:right" >'.$total_value[1].'</td>
                   </tr>
            
            </tbody>
            </table></body></html>';
            $pdf->SetXY(50, 257);
        $pdf->writeHTML($tbl2, true, false, false, false, '');
		
		// $granttotal=number_format($total,2);
			// $pdf->SetXY(180,266,true);
			// $pdf->Cell(120, 0, $granttotal, 0, 0);
		
		 $labincharge=$this->actionReadnumber($total,0);
			$pdf->SetXY(30,267,true);
			$pdf->Cell(100, 0, $labincharge." ONLY", 0, 0);
    
        $pdf->Output('sunithaprinter1.pdf');        
  
  }

 

  public function actionPrintpreview($data)
  { 

   // echo '<pre>';
   

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

    //echo '<pre>';
     //print_r($creative_array);die;

    $customer_master=CustomerMaster::find()->where(['auto_id'=>$creative_array['custId'][0]])->asArray()->one();
   
    //$tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxgroup');
    
    $tax_master=ArrayHelper::map(Taxmaster::find()->where(['is_active'=>1])->asArray()->all(),'taxid','taxvalue');
    

    require ('../../vendor/tcpdf/tcpdf.php');
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('SUNITHA');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 8, '', true);
        $pdf->SetMargins(0, false, 0, true); // set the margins 
        $pdf->AddPage();
         
         $pdf->Image('images/watermark.png', 20, 80, 180, 150, 'PNG');
      $pdf->setCellPaddings(0,0,0,0);
        
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
       $pdf->SetHeaderMargin(1);
       $pdf->SetFooterMargin(1); 
        
          //$pdf->Image('images/delivery.png', 0, 0, 3500, 4500 , 'PNG');
          
        //  $img_file ="http://192.168.1.71/2019/sunitha_printers/backend/web/images/invoice.png";
        //$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
          
          // $pdf->Image('images/letters1.png', 70, 38, 50, 4, 'PNG');
        $tbl1='<html>
        <head>
          <style>
          .serialno{
            
            padding-left:100px;
          }
          </style>
        </head>
        <body style="font-size:11px;"><p></p>
        
        ';  
        $tbl1.='<table style="font-size:12px;">
            <tbody>
                   <tr>
                   <td style="width:93.5%;"><p style="line-height:1.0;text-align:right;"><b> SI NO : NIL </b></p></td>
                   </tr>
                   </tbody>
            </table>
            <table style="font-size:12px;">
            <tbody>
            </table > <p></p><p></p><p></p><p></p>
            <p></p><p></p><p></p>
                <table style="font-size:12px;">
            <tbody> 
              <tr>
                  <td style="width:8%;"></td> 
                  <td style="width:50%;" ><p style="line-height:1.3;"><br/>
                      <B>'.ucwords($customer_master['company_name']).'</B> 
                        <br/> '.$customer_master['address'].'<br/>
                        '.$customer_master['city'].',<br/>'.$customer_master['state'].'-'.$customer_master['pincode'].'.<br/></p></td>
                <td style="width:35%;text-align:right;"><B>Date :  '.date('d/m/Y').' </B></td>
              </tr>
              <tr>
                <td style="width:8%;"></td>
                <td ><b>GSTIN : '.$customer_master['gst'].' </b></td>
              </tr>
            </tbody>
            </table >
            <br/><br/><p></p><p></p><p></p>
            <table style="font-size:12px;line-height:1.7;width:100%" class="production">
            <tbody>';
                   $k=1;
                   $x=215;
                    $y=18;
                   foreach ($creative_array['InvoiceRefTbl[description_table][]'] as $key => $value) 
                   {
                     $split_amount=number_format($creative_array['InvoiceRefTbl[amount_table][]'][$key],2);
                     $amount_val=explode('.', $split_amount);
                      $tbl1.='<tr> 
                      <td style="width:12%;text-align:Center;" class="serialno">'.$k.'</td>
                      <td style="width:12%;text-align:left;">'.$config['SAC CODE']['value'].'</td>
                      <td style="width:48%;text-align:left;">'.ucwords($value).'</td>
                      <td style="width:18%;text-align:right">'.$amount_val[0].'</td>
                      <td style="width:9%;text-align:right" > '.$amount_val[1].'</td>
                      </tr>';
                      $x=$x+35;
                     $y=1;   
                      $k++;
                   }
                   $tot=array_sum($creative_array['InvoiceRefTbl[amount_table][]']);
                   $split_invoiceamt=number_format($tot,2);
                   $invoiceamt=explode('.', $split_invoiceamt);
              $tbl1.='<tr><td><p></p><p></p></td></tr>
                    <tr> 
                      <td></td>
                      <td></td>
                      <td style="text-align:right"><b>TOTAL</b></td>
                      <td style="text-align:right">'.$invoiceamt[0].'</td>
                      <td style="text-align:right" >'.$invoiceamt[1].'</td>
                      </tr>';  
                  
             $tbl1.='</tbody>
            </table>
            <table style="font-size:13px;line-height:1.7" class="production">
            <tbody>';
            if($creative_array['InvoiceTable[tax_type]'][0] == 'GST')
            {    
                $div=$tax_master[$creative_array['InvoiceTable[tax_id]'][0]]/2;
                $calc=($tot*$div)/100;
                $total=($calc*2)+$tot;
                $split_cal=number_format($calc,2);
                $calc_amt=explode('.', $split_cal);
                $tbl1.='<tr> 
                      <td style="width:12%;" >  </td>
                      <td style="width:12%;" >  </td>
                      <td style="width:48%;text-align:right"  > <b>CGST '.$div.'% </b></td>
                      <td style="width:18%;text-align:right" > '.$calc_amt[0].' </td>
                      <td style="width:9%;text-align:right" >'.$calc_amt[1].'</td>
                   </tr>
                   <tr> 
                      <td>  </td>
                      <td>  </td>
                      <td style="text-align:right"> <b>SGST '.$div.'%</b> </td>
                      <td style="text-align:right"> '.$calc_amt[0].' </td>
                      <td style="text-align:right" >'.$calc_amt[1].' </td>
                   </tr>';
            }
            else if($creative_array['InvoiceTable[tax_type]'][0] == 'IGST')
            {
                $div=$tax_master[$creative_array['InvoiceTable[tax_id]'][0]];
                $calc=($tot*$div)/100;
                $calc=number_format($calc,2);
                $total=$calc+$tot;

                $cal_ist=explode('.', $calc);
                $tbl1.='<tr> 
                      <td style="width:12%;" >  </td>
                      <td style="width:12%;" >  </td>
                      <td style="width:48%;text-align:right"  > IGST '.$div.'% </td>
                      <td style="width:18%;text-align:right" > '.$cal_ist[0].' </td>
                      <td style="width:9%;text-align:right" > '.$cal_ist[1].' </td>
                   </tr>';
                   
            
            } 
                $split_totla=number_format($total,2);
                $total_value=explode('.', $split_totla);
                //print_r($total_value); die;
                $pdf->writeHTML($tbl1, true, false, false, false, '');
             $tbl1.=' </tbody>
            </table>';
            $tbl2='<table style="font-size:13px;line-height:1.7" class="production">
            <tbody>
                   <tr> 
                      <td style="width:12%;">  </td>
                      <td style="width:12%;">  </td>
                      <td style="width:48%;text-align:right;"></td>
                      <td style="width:18%;text-align:right;"><b> '.$total_value[0].'  </b></td>
                      <td style="width:9%;text-align:right" >'.$total_value[1].'</td>
                   </tr>
            
            </tbody>
            </table></body></html>';
        $pdf->SetXY(50, 257);
        $pdf->writeHTML($tbl2, true, false, false, false, '');
        
        
        
         $labincharge=$this->actionReadnumber($total,0);
         $pdf->SetXY(30,267,true);
         $pdf->Cell(100, 0, $labincharge."ONLY", 0, 0);      
         
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
            else if ($num == 2) $retval.="two ";
            else if ($num == 3) $retval.="three ";
            else if ($num == 4) $retval.="four ";
            else if ($num == 5) $retval.="five ";
            else if ($num == 6) $retval.="six ";
            else if ($num == 7) $retval.="seven ";
            else if ($num == 8) $retval.="eight ";
            else if ($num == 9) $retval.="nine ";
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
    return strtoupper($retval);
}

    /**
     * Deletes an existing InvoiceTable model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $check=$this->findModel($id);

        Delivery::updateAll(['convert_status' => '', 'convert_id'=> ''], ['convert_id' => $id , 'convert_status' => 'IV']);

        if($check->delete())
        {
             return $this->redirect(['index']);     
        }
       
    }

    /**
     * Finds the InvoiceTable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InvoiceTable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InvoiceTable::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    protected function findInvoiceRefTblModel($id)
    {
        
        $InvoiceRefTbl=InvoiceRefTbl::find()->where(['invoice_id'=>$id])->asArray()->all();

        if(!empty($InvoiceRefTbl))
        {
            return $InvoiceRefTbl;
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
