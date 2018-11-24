<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ServiceLog;

/**
 * TansiServiceLogSearch represents the model behind the search form about `backend\models\TansiServiceLog`.
 */
class ServiceLogSearch extends ServiceLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slog_id', 'service_id', 'branch_id'], 'integer'],
            [['created_date', 'changes'], 'safe'],
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
        $query = ServiceLog::find();

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
            'slog_id' => $this->slog_id,
            'created_date' => $this->created_date,
            'service_id' => $this->service_id,
            'branch_id' => $this->branch_id,
        ]);

        $query->andFilterWhere(['like', 'changes', $this->changes]);

        return $dataProvider;
    }
}
