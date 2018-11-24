<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Treatment;

/**
 * TreatmentSearch represents the model behind the search form about `backend\models\Treatment`.
 */
class TreatmentSearch extends Treatment
{
    /**
     * @inheritdoc
     */
     public $hsncode1;
    public function rules()
    {
        return [
        	//[['amount'], 'number'],
            [['id','amount'], 'integer'],
            [['treatment_name',  'created_at', 'updated_at', 'user_id', 'updated_ipaddress', 'userrole','is_active'], 'safe'],
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
        $query = Treatment::find();

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
	
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
               'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'treatment_name', $this->treatment_name])
            //->andFilterWhere(['like', 'amount', $this->amount])
			//->andFilterWhere(['like', 'is_active', $this->amount])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress])
            ->andFilterWhere(['like', 'userrole', $this->userrole]);
	//	print_r($query->createCommand()->getRawSql());die;
        return $dataProvider;
    }
}
