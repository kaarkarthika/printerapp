<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MedicalRecordingCharge;

/**
 * MedicalRecordingChargeSearch represents the model behind the search form of `backend\models\MedicalRecordingCharge`.
 */
class MedicalRecordingChargeSearch extends MedicalRecordingCharge
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid'], 'integer'],
            [['amount', 'hsncode','hsncode1', 'updated_at', 'user_id', 'updated_ipaddress', 'name'], 'safe'],
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
        $query = MedicalRecordingCharge::find();

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
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'amount', $this->amount])
            //->andFilterWhere(['like', 'hsncode', $this->hsncode])
			->andFilterWhere(['like','hsncode1', $this->hsncodemaster->hsncode])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
