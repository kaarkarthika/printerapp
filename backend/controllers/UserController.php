<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) 
        {
          
            $user_data = User::find()->where(['username' => $_POST['User']['username']])->one();
            if(empty($user_data))
            {
                
                $model->username=$_POST['User']['username'];
                $model->name=$_POST['User']['name'];
                $model->user_type=$_POST['User']['user_type'];

                $model->password_hash=Yii::$app->security->generatePasswordHash($_POST['User']['password_hash']);
                $model->status=10;
                if($model->save())
                {
                    Yii::$app->session->setFlash('success', 'Profile Saved Successfully');
                    return $this->redirect(['index']);
                }
                else
                {
                    print_r($model->getErrors());die;
                }
            }
            else
            {

                Yii::$app->session->setFlash('danger', 'User Name Already Exist');
                return $this->redirect(['create']);
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('create', [
            'model' => $model,
        ]);    
        }
        
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $id=base64_decode(urldecode($id));
        $model = $this->findModel($id);
        $session = Yii::$app->session;
       if ($model->load(Yii::$app->request->post())) 
        {
           
            $fetch_record=User::find()->where(['id'=> $id])->asArray()->one();
           

            $model->username=$_POST['User']['username'];
            $model->name=$_POST['User']['name'];
            if($session['user_type']=='A')
            {
                  $model->user_type=$model->user_type;   
            }
            else
            {
                $model->user_type=$_POST['User']['user_type'];   
            }   
            if(!empty($_POST['User']['password_hash']))
            {
              
                $model->password_hash=Yii::$app->security->generatePasswordHash($_POST['User']['password_hash']);
            }
            else if(empty($_POST['User']['password_hash']))
            {
                
                $model->password_hash=$fetch_record['password_hash'];
            }
            $model->status=10;
            if($model->save())
            {
                if($session['user_type']=='S')
                {
                    Yii::$app->session->setFlash('success', 'Profile Update Successfully');
                    return $this->redirect(['index']);
                }
                else if($session['user_type']=='A')
                {
                    Yii::$app->session->setFlash('success', 'Profile Update Successfully');
                    // return $this->redirect(['update','id'=>$id]);
                    return $this->refresh();
                }
            }
            else
            {
                print_r($model->getErrors());die;
            }
            
        }
        else
        {
                 return $this->render('update', [
                'model' => $model,
            ]);
        }
       
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
