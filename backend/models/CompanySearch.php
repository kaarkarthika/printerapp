<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Company;

/**
 * CompanySearch represents the model behind the search form about `backend\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'is_active'], 'integer'],
            [['company_code', 'company_name', 'company_type', 'cin', 'pan', 'dln1', 'dln2', 'dln3', 'updated_by', 'updated_on', 'updated_ipaddress'], 'safe'],
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
        $query = Company::find();

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
            'company_id' => $this->company_id,
            'is_active' => $this->is_active,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'company_code', $this->company_code])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'company_type', $this->company_type])
            ->andFilterWhere(['like', 'cin', $this->cin])
            ->andFilterWhere(['like', 'pan', $this->pan])
            ->andFilterWhere(['like', 'dln1', $this->dln1])
            ->andFilterWhere(['like', 'dln2', $this->dln2])
            ->andFilterWhere(['like', 'dln3', $this->dln3])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
