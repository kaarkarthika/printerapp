<?php

namespace backend\controllers;

use Yii;
use backend\models\BranchManagement;
use backend\models\ServiceuserLogin;
use backend\models\BranchManagementSearch;
use backend\models\AuthProjectModule;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use backend\models\BranchAdmin;


/**
 * BranchManagementController implements the CRUD actions for BranchManagement model.
 */
class BranchManagementController extends Controller
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
         'access' => [
           'class' => AccessControl::className(),
           'rules' => [
               [
                   'allow' => true,
                   'roles' => ['@'],
               ],

               // ...
           ],
       ],


       ];
    }
 
 public function beforeAction($action) {
          return BranchAdmin::checkbeforeaction();
	}

    public function actionIndex()
    {
        $searchModel = new BranchManagementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BranchManagement model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BranchManagement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BranchManagement();
        $adminmodel=new TansiBranchAdmin();

        $session = Yii::$app->session;
      //  print_r(Yii::$app->request->post());
        //Yii::$app->request->isAjax
        if ($model->load(Yii::$app->request->post())) {
            $model->branch_create_date=date("Y-m-d h:i:s");
            $model->service_center_id=$session['servicecenter_id'];
            $ba_code=$model->branch_code;
			if(Yii::$app->request->isAjax){
				 Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
              return ActiveForm::validate($model);
			}
           if($model->save())
           {

            $adminmodel->ba_branchid=$model->primaryKey;
            $adminmodel->ba_code=$ba_code;
            $name=Yii::$app->request->post('BranchManagement')['username'];
            $password_hash=Yii::$app->request->post('BranchManagement')['password'];

            $adminmodel->password_hash = Yii::$app->security->generatePasswordHash($password);
            $adminmodel->ba_name=$name;
            $adminmodel->ba_createdat=date("Y-m-d h:i:s");
            $imgupload = new TansiBranchImage();
            $imgupload->file_location = UploadedFile::getInstances($model, 'image_upload');   
              foreach( $imgupload->file_location as $key_file=>$onefile){
            
            $tmp=$onefile->baseName ;    
            $tmp=str_replace(" ", "-", $tmp);
            $tmp=str_replace("'", "", $tmp);
            $tmp=str_replace('"', "", $tmp);
            $img_path=$model->branch_id.'_' .$tmp; 
              
             $onefile->saveAs('uploads/'. $img_path. '.' . $onefile->extension);
             $imgupload->branch_id = $model->branch_id;
              $imgupload->create_at = date("Y-m-d H:i:s");  
             $imgupload->file_location = 'uploads/'. $img_path . '.' . $onefile->extension;

           
             $imgupload->save();
             $imgupload = new TansiBranchImage();
            if($adminmodel->save())
            {
                
            }
           

           }

          
			
            	return $this->redirect(['index']);
				
             
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BranchManagement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model1 = TansiBranchAdmin::find()->where(['ba_branchid'=>$id])->one();

        if ($model->load(Yii::$app->request->post())) {

             $password_old=$model1->password_hash;
             $model->username=Yii::$app->request->post('TansiBranchAdmin')['ba_name'];
            $model->password=$password_old;
            if(Yii::$app->request->isAjax){
				 Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
              return ActiveForm::validate($model);
			}
             if($model->save())
             {
                $model1->ba_name=Yii::$app->request->post('TansiBranchAdmin')['ba_name'];
               $model1->save();
             }
            //  print_r("fasdbs");
            // exit();
              //-------image upload--------
              //$impyy = TansiBranchImage::deleteall([ 'branch_id'=> $id ]);
            $imgupload = new TansiBranchImage();
            $imgupload->file_location = UploadedFile::getInstances($model, 'image_upload');   
              foreach( $imgupload->file_location as $key_file=>$onefile){
            
            $tmp=$onefile->baseName ;    
            $tmp=str_replace(" ", "-", $tmp);
            $tmp=str_replace("'", "", $tmp);
            $tmp=str_replace('"', "", $tmp);
            $img_path=$id.'_' .$tmp; 
              
             $onefile->saveAs('uploads/'. $img_path. '.' . $onefile->extension);
             $imgupload->branch_id = $id;
              $imgupload->create_at = date("Y-m-d H:i:s");  
             $imgupload->file_location = 'uploads/'. $img_path . '.' . $onefile->extension;

           
             $imgupload->save();
             $imgupload = new TansiBranchImage();
              }

            return $this->redirect(['index']);
        } else {
              $mody = TansiBranchImage::find()->select('file_location')->where(['branch_id'=>$id])->asArray()->all(); 
            $ids = ArrayHelper::getColumn($mody, 'file_location');
            
            $model->image_upload =  $ids;
            return $this->render('update', [
                'model' => $model,
                'model1' => $model1,
            ]);
        }
    }
//image delete ajax
    public function actionImageDelete($id)
    {
      
        $mode = TansiBranchImage::find()->where(['and',['branch_id'=>$id],['file_location'=>$_POST['key']]])->one();
        $mode->delete();
       // print_r($mode);
        return json_encode (json_decode ("{}"));
    }

    /**
     * Deletes an existing BranchManagement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       // $this->findModel($id)->delete();
        $model = BranchManagement::findOne($id);
        $model->branch_status='n';
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BranchManagement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BranchManagement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BranchManagement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
