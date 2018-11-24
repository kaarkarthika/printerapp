<?php

namespace backend\controllers;

use Yii;
use backend\models\Stickynotes;
use backend\models\StickynotesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\StickyNotesDetails;
/** 
 * StickynotesController implements the CRUD actions for Stickynotes model.
 */
class StickynotesController extends Controller
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
     * Lists all Stickynotes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StickynotesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Stickynotes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Stickynotes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stickynotes();
		$session=Yii::$app->session;

        if ($_POST) {
        	
        	$model->notetitle=$_POST['notetitle'];
			$model->colorscheme=$_POST['radio'];
			$model->branch_id=$session['branch_id'];
        	$model->updated_on=date("Y-m-d H:i:s");
			$model->save();
				 return $this->redirect(['index']);
		
           
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionAddnotes()
    {
        $model = new StickyNotesDetails();
		$session=Yii::$app->session;

        if ($_POST) {
        	
        	$model->group_id=$_POST['group'];
			$model->notes_description=$_POST['note'];
			$model->branch_id=$session['branch_id'];
        	$model->created_at=date("Y-m-d H:i:s");
			if($model->save()){
				$notes_list=StickyNotesDetails::find()->where(['group_id'=>$model->group_id])->all();
				$content = "";
				if($notes_list){
					foreach($notes_list as $k){
						$check="";
						$check_num=0;
						if($k->notes_check==1){
							$check="checked";
							$check_num=1;
						}
						
						$content.='<div class="checkbox checkbox-black">
        <input id="notedesc_'.$k->autoid.'" data-id='.$k->autoid.' data-group='.$group_id.' data-group1='.$check_num.' type="checkbox" value='.$k->notes_check.' class="check_strike"  '.$check.'>
            <label class="strikethrough" for="checkbox2">'.$k->notes_description.'</label>
      </div>
       <a data-id="deletedesc_'.$k->autoid.'"  id="delete_desc_'.$k->autoid.'" class="btn-icon pull-right" ><i class="fa fa-remove"></i></a>';
      
      
      					  
								  
						
					}
				}
				
				return $content;
				
			}
           
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionChecknote($id)
    {
    	
        $model = StickyNotesDetails::find()->where(['autoid'=>$id])->one();
		$session=Yii::$app->session;
		$group_id=$_POST['group'];
		$check_num_11=$_POST['check_num'];
		$model->notes_check=0;
		if($check_num_11==0){
			$model->notes_check=1;
		}
        	
			if($model->save()){
				$notes_list=StickyNotesDetails::find()->where(['group_id'=>$group_id])->orderBy(['notes_check'=>SORT_ASC])->all();
				$content = "";
				if($notes_list){
					foreach($notes_list as $k){
						$check="";
						$check_num=0;
						if($k->notes_check==1){
							$check="checked";
							$check_num=1;
						}
$content.='<div class="checkbox checkbox-black">
        <input id="notedesc_'.$k->autoid.'" data-id='.$k->autoid.' data-group='.$group_id.' data-group1='.$check_num.' type="checkbox" value='.$k->notes_check.' class="check_strike"  '.$check.'>
            <label class="strikethrough" for="checkbox2">'.$k->notes_description.'</label>
      </div>';
						
					}
				}
				
				return $content;
				
			}
           
        
    }

    /**
     * Updates an existing Stickynotes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->noteid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Stickynotes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		$t1=StickyNotesDetails::deleteAll(['group_id'=>$id]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Stickynotes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stickynotes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stickynotes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
}
