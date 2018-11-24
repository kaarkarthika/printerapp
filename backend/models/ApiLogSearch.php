<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ApiLog;

/**
 * ApiLogSearch represents the model behind the search form about `backend\models\ApiLog`.
 */
class ApiLogSearch extends ApiLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid'], 'integer'],
            [['event_key', 'request_data', 'response_data', 'created_at', 'status', 'modified_at'], 'safe'],
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
        $query = ApiLog::find()->orderBy(['autoid'=>SORT_DESC]);

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
            'autoid' => $this->autoid,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'event_key', $this->event_key])
            ->andFilterWhere(['like', 'request_data', $this->request_data])
            ->andFilterWhere(['like', 'response_data', $this->response_data])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
