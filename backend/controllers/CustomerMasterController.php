<?php

namespace backend\controllers;

use Yii;
use backend\models\CustomerMaster;
use backend\models\CustomerMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ContactTable;
use backend\models\DeliveryAddressMaster;
/**
 * CustomerMasterController implements the CRUD actions for CustomerMaster model.
 */
class CustomerMasterController extends Controller
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
     * Lists all CustomerMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReindex()
    {
        $searchModel = new CustomerMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        Yii::$app->session->setFlash('success', 'Record Saved Successfully');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CustomerMaster model.
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
     * Creates a new CustomerMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CustomerMaster();

        $contactable = new ContactTable();
        $session = Yii::$app->session;

        $delivery_address_master = new DeliveryAddressMaster();


        if ($model->load(Yii::$app->request->post())) 
        {
            

            $fetch_array=array();
            
            $model->company_name = $_POST['CustomerMaster']['company_name'];
            $model->customer_name = $_POST['CustomerMaster']['customer_name'];
            $model->phone_no = $_POST['CustomerMaster']['phone_no'];
            $model->gst = $_POST['CustomerMaster']['gst'];
           // $model->state_code = $_POST['CustomerMaster']['state_code'];

            $model->city = $_POST['CustomerMaster']['city'];
            $model->state = $_POST['CustomerMaster']['state'];
            $model->pincode = $_POST['CustomerMaster']['pincode'];
            $model->address = $_POST['CustomerMaster']['address'];
            
            $model->created_date = date('Y-m-d H:i:s');
            $model->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
            $model->user_id = $session['headlinestv_id'];

            if($model->save())
            {


                if(!empty($_POST['DeliveryAddressMaster']))
                {
                 foreach ($_POST['DeliveryAddressMaster']['delivery_address'] as $key => $value) 
                    {
                        if(!empty($value) || $value != '')
                        {
                            $delivery_address_ins = new DeliveryAddressMaster();
                            $delivery_address_ins->cust_id=$model->auto_id;
                            $delivery_address_ins->delivery_address =$value;
                            $delivery_address_ins->city =$_POST['DeliveryAddressMaster']['city'][$key];
                            $delivery_address_ins->state =$_POST['DeliveryAddressMaster']['state'][$key];
                            $delivery_address_ins->pincode =$_POST['DeliveryAddressMaster']['pincode'][$key];
                            $delivery_address_ins->created_date =date('Y-m-d H:i:s');
                            $delivery_address_ins->user_id =$session['headlinestv_id'];
                            $delivery_address_ins->ipaddress =$_SERVER['REMOTE_ADDR'];

                            if($delivery_address_ins->save())
                            {

                            }
                            else
                            {   
                                echo '<pre>';
                                print_r($delivery_address_ins->getErrors());die;
                            }
                            
                        }
                    }

                }





                if(!empty($_POST['ContactTable']))
                {
                    foreach ($_POST['ContactTable']['contact_name'] as $key => $value) 
                    {
                        $contactable_save = new ContactTable();
                        $contactable_save->customer_id = $model->auto_id;
                        $contactable_save->contact_name = $_POST['ContactTable']['contact_name'][$key];
                        $contactable_save->contact_number = $_POST['ContactTable']['contact_number'][$key];
                        $contactable_save->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
                        $contactable_save->user_id = $session['headlinestv_id'];
                        $contactable_save->created_date = date('Y-m-d H:i:s');

                        if($contactable_save->save())
                        {

                        }
                        else
                        {
                            echo '<pre>';
                            print_r($contactable_save->getErrors());die;
                        }
                    }
                }
            }
            else
            {
                echo '<pre>';
                print_r($model->getErrors());die;
            }
            $fetch_array[0]='okay';
            return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        }
        else
        {
            return $this->render('create', [
            'model' => $model,
            'contactable' => $contactable,
            'delivery_address_master' => $delivery_address_master,
             ]);
        }
        
    }

    /**
     * Updates an existing CustomerMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $contactable_fetch=$this->findContactTable($id);
        $contactable=new ContactTable();

        $delivery_address_master = new DeliveryAddressMaster();
        $delivery_address_master_fetch=$this->findDeliveryAddressMaster($id);

        

        if ($model->load(Yii::$app->request->post())) 
        {
            $fetch_array=array();

            ContactTable::deleteAll(['customer_id' => $id]);

            DeliveryAddressMaster::deleteAll(['cust_id'=>$id]);

            $model->company_name = $_POST['CustomerMaster']['company_name'];
            $model->customer_name = $_POST['CustomerMaster']['customer_name'];
            $model->phone_no = $_POST['CustomerMaster']['phone_no'];
            $model->gst = $_POST['CustomerMaster']['gst'];
           // $model->state_code = $_POST['CustomerMaster']['state_code'];
            $model->city = $_POST['CustomerMaster']['city'];
            $model->state = $_POST['CustomerMaster']['state'];
            $model->pincode = $_POST['CustomerMaster']['pincode'];
            $model->address = $_POST['CustomerMaster']['address'];
           
            $model->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
            $model->user_id = $session['headlinestv_id'];

            if($model->save())
            {


                if(!empty($_POST['DeliveryAddressMaster']))
                {
                 foreach ($_POST['DeliveryAddressMaster']['delivery_address'] as $key => $value) 
                    {
                        if(!empty($value) || $value != '')
                        {
                            $delivery_address_ins = new DeliveryAddressMaster();
                            $delivery_address_ins->cust_id=$model->auto_id;
                            $delivery_address_ins->delivery_address =$value;
                            $delivery_address_ins->city =$_POST['DeliveryAddressMaster']['city'][$key];
                            $delivery_address_ins->state =$_POST['DeliveryAddressMaster']['state'][$key];
                            $delivery_address_ins->pincode =$_POST['DeliveryAddressMaster']['pincode'][$key];
                            $delivery_address_ins->created_date =date('Y-m-d H:i:s');
                            $delivery_address_ins->user_id =$session['headlinestv_id'];
                            $delivery_address_ins->ipaddress =$_SERVER['REMOTE_ADDR'];

                            if($delivery_address_ins->save())
                            {

                            }
                            else
                            {   
                                echo '<pre>';
                                print_r($delivery_address_ins->getErrors());die;
                            }
                            
                        }
                    }

                }




                if(!empty($_POST['ContactTable']))
                {
                    foreach ($_POST['ContactTable']['contact_name'] as $key => $value) 
                    {
                        $contactable_save = new ContactTable();
                        $contactable_save->customer_id = $model->auto_id;
                        $contactable_save->contact_name = $_POST['ContactTable']['contact_name'][$key];
                        $contactable_save->contact_number = $_POST['ContactTable']['contact_number'][$key];
                        $contactable_save->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
                        $contactable_save->user_id = $session['headlinestv_id'];
                        

                        if($contactable_save->save())
                        {

                        }
                        else
                        {
                            echo '<pre>';
                            print_r($contactable_save->getErrors());die;
                        }
                    }
                }
            }
            else
            {
                echo '<pre>';
                print_r($model->getErrors());die;
            }
            $fetch_array[0]='okay';

            return json_encode($fetch_array, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
           
        }
        else
        {
            return $this->render('updateform', [
            'model' => $model,
            'contactable' => $contactable,
            'contactable_fetch' => $contactable_fetch,
            'delivery_address_master' => $delivery_address_master,
            'delivery_address_master_fetch'=>$delivery_address_master_fetch,
        ]);   
        }
        
    }

    /**
     * Deletes an existing CustomerMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        ContactTable::deleteAll(['customer_id' => $id]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the CustomerMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CustomerMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    protected function findContactTable($id)
    {
        $data_array=array();
        $contactable = ContactTable::find()->where(['customer_id'=>$id])->asArray()->all();
        if (!empty($contactable)) 
        {
            $data_array[0]='okay';
            $data_array[1]=$contactable;
            
            return $data_array;
        }
        else
        {
            $data_array[0]='empty';
            return $data_array;
        }
      
    }

    protected function findDeliveryAddressMaster($id)
    {
       
        $delivery_address_master = DeliveryAddressMaster::find()->where(['cust_id'=>$id])->asArray()->all();
        if (!empty($delivery_address_master)) 
        {
           return $delivery_address_master;
        }
    }


}
