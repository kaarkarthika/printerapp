<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Insurance;

/**
 * InsuranceSearch represents the model behind the search form about `backend\models\Insurance`.
 */
class InsuranceSearch extends Insurance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insurance_typeid',  'is_active', 'updated_by'], 'integer'],
            [['updated_on', 'updated_ipaddress'], 'safe'],
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
        $query = Insurance::find();

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
            'insurance_typeid' => $this->insurance_typeid,
            'insurance_type' => $this->insurance_type,
            'is_active' => $this->is_active,
            'updated_on' => $this->updated_on,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
