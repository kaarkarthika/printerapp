<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ServiceAdvisor;

/**
 * TansiServiceAdvisorSearch represents the model behind the search form about `backend\models\TansiServiceAdvisor`.
 */
class ServiceAdvisorSearch extends TansiServiceAdvisor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sa_autoid'], 'integer'],
            [['sa_branch', 'sa_name', 'sa_code', 'sa_shift_from','branchname' ,'sa_shift_to', 'sa_status', 'customer_id', 'sa_time_id', 'sa_timestamp'], 'safe'],
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
        $query = ServiceAdvisor::find();
        $query->joinWith(['branch']);

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
            'sa_autoid' => $this->sa_autoid,
            'sa_shift_from' => $this->sa_shift_from,
            'sa_shift_to' => $this->sa_shift_to,
            'sa_timestamp' => $this->sa_timestamp,
        ]);

        $query->andFilterWhere(['like', 'sa_branch', $this->sa_branch])
            ->andFilterWhere(['like', 'sa_name', $this->sa_name])
            ->andFilterWhere(['like', 'branch_management.branch_name', $this->branchname])
            ->andFilterWhere(['like', 'sa_code', $this->sa_code])
            ->andFilterWhere(['like', 'sa_status', $this->sa_status])
            ->andFilterWhere(['like', 'customer_id', $this->customer_id])
            ->andFilterWhere(['like', 'sa_time_id', $this->sa_time_id]);

        return $dataProvider;
    }
}
