<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LabUnit;

/**
 * LabUnitSearch represents the model behind the search form of `backend\models\LabUnit`.
 */
class LabUnitSearch extends LabUnit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auto_id'], 'integer'],
            [['unit_name', 'unit_value', 'unit_type', 'referencesymbol', 'isactive', 'created_at', 'created_date', 'update_at', 'update_date'], 'safe'],
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
        $query = LabUnit::find();

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
            'auto_id' => $this->auto_id,
            'created_date' => $this->created_date,
            'update_date' => $this->update_date,
        ]);

        $query->andFilterWhere(['like', 'unit_name', $this->unit_name])
            ->andFilterWhere(['like', 'unit_value', $this->unit_value])
            ->andFilterWhere(['like', 'unit_type', $this->unit_type])
            ->andFilterWhere(['like', 'referencesymbol', $this->referencesymbol])
            ->andFilterWhere(['like', 'isactive', $this->isactive])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'update_at', $this->update_at]);

        return $dataProvider;
    }
}
