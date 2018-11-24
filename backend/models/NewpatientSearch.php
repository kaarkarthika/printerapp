<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Newpatient;

/**
 * NewpatientSearch represents the model behind the search form of `backend\models\Newpatient`.
 */
class NewpatientSearch extends Newpatient
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patientid', 'pat_age'], 'integer'],
            [['ucil_id','mr_no', 'patientname', 'pat_inital_name', 'pat_sex', 'pat_marital_status', 'pat_relation', 'par_relationname', 'pat_address', 'pat_city', 'pat_distict', 'pat_state', 'pat_pincode', 'pat_phone', 'pat_mobileno', 'pat_email', 'pat_source', 'pat_occupation', 'pat_education', 'pat_nationality', 'pat_religion', 'pat_type', 'updated_at', 'create_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Newpatient::find()->orderBy(['patientid'=>SORT_DESC]);
		
	//	$query->joinWith(['subvisit']);
        
        
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
	
	
		//print_r($_GET);die;
		
		if(isset($_GET['NewpatientSearch']['ucil_id'])  && $_GET['NewpatientSearch']['ucil_id'] != '')
		{
			$ucil_no=$_GET['NewpatientSearch']['ucil_id'];
			$query->andFilterWhere(['like','ucil_emp_id',$ucil_no]);
		}
	
        // grid filtering conditions
        $query->andFilterWhere([
            'patientid' => $this->patientid,
            'pat_age' => $this->pat_age,
            'updated_at' => $this->updated_at,
            'create_at' => $this->create_at,
        ]);

      /*  $query->andFilterWhere(['like', 'mr_no', $this->mr_no])
            ->andFilterWhere(['like', 'patientname', $this->patientname])
            ->andFilterWhere(['like', 'pat_inital_name', $this->pat_inital_name])
            ->andFilterWhere(['like', 'pat_sex', $this->pat_sex])
            ->andFilterWhere(['like', 'pat_marital_status', $this->pat_marital_status])
            ->andFilterWhere(['like', 'pat_relation', $this->pat_relation])
            ->andFilterWhere(['like', 'par_relationname', $this->par_relationname])
            ->andFilterWhere(['like', 'pat_address', $this->pat_address])
            ->andFilterWhere(['like', 'pat_city', $this->pat_city])
            ->andFilterWhere(['like', 'pat_distict', $this->pat_distict])
            ->andFilterWhere(['like', 'pat_state', $this->pat_state])
            ->andFilterWhere(['like', 'pat_pincode', $this->pat_pincode])
            ->andFilterWhere(['like', 'pat_phone', $this->pat_phone])
            ->andFilterWhere(['like', 'pat_mobileno', $this->pat_mobileno])
            ->andFilterWhere(['like', 'pat_email', $this->pat_email])
            ->andFilterWhere(['like', 'pat_source', $this->pat_source])
            ->andFilterWhere(['like', 'pat_occupation', $this->pat_occupation])
            ->andFilterWhere(['like', 'pat_education', $this->pat_education])
            ->andFilterWhere(['like', 'pat_nationality', $this->pat_nationality])
            ->andFilterWhere(['like', 'pat_religion', $this->pat_religion])
            ->andFilterWhere(['like', 'pat_type', $this->pat_type]);
           */ 
		
		 $query->andFilterWhere(['like', 'mr_no', $this->mr_no])
			    ->andFilterWhere(['like', 'patientname', $this->patientname])
				->andFilterWhere(['like', 'pat_mobileno', $this->pat_mobileno]);
				//->andFilterWhere(['ucil_id'=> $this->subvisit->ucil_emp_id])
				
				// echo $query->createCommand()->getRawSql();die;
        return $dataProvider;
    }
}
