<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LabReferenceVal;

/**
 * LabReferenceValSearch represents the model behind the search form of `backend\models\LabReferenceVal`.
 */
class LabReferenceValSearch extends LabReferenceVal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid', 'test_id', 'created_at', 'created_date', 'updated_at', 'updated_date'], 'integer'],
            [['reference_name', 'reference_value'], 'safe'],
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
        $query = LabReferenceVal::find();

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
            'test_id' => $this->test_id,
            'created_at' => $this->created_at,
            'created_date' => $this->created_date,
            'updated_at' => $this->updated_at,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'reference_name', $this->reference_name])
            ->andFilterWhere(['like', 'reference_value', $this->reference_value]);

        return $dataProvider;
    }
}
