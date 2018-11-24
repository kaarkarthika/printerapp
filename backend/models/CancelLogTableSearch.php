<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CancelLogTable;

/**
 * CancelLogTableSearch represents the model behind the search form of `backend\models\CancelLogTable`.
 */
class CancelLogTableSearch extends CancelLogTable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cancel_id'], 'integer'],
            [['cancel_ran_id', 'cancel_trans_type', 'cancel_type', 'subvisitno', 'mrnumber', 'opd_type', 'towards', 'refund_type', 'payment_mode', 'amt_words', 'reason_cancelled', 'created_at', 'updated_at', 'ip_address', 'user_id'], 'safe'],
            [['hospital_fees', 'doctor_fees', 'cancel_amt', 'paid'], 'number'],
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
        $query = CancelLogTable::find();

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
            'cancel_id' => $this->cancel_id,
            'hospital_fees' => $this->hospital_fees,
            'doctor_fees' => $this->doctor_fees,
            'cancel_amt' => $this->cancel_amt,
            'paid' => $this->paid,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'cancel_ran_id', $this->cancel_ran_id])
            ->andFilterWhere(['like', 'cancel_trans_type', $this->cancel_trans_type])
            ->andFilterWhere(['like', 'cancel_type', $this->cancel_type])
            ->andFilterWhere(['like', 'subvisitno', $this->subvisitno])
            ->andFilterWhere(['like', 'mrnumber', $this->mrnumber])
            ->andFilterWhere(['like', 'opd_type', $this->opd_type])
            ->andFilterWhere(['like', 'towards', $this->towards])
            ->andFilterWhere(['like', 'refund_type', $this->refund_type])
            ->andFilterWhere(['like', 'payment_mode', $this->payment_mode])
            ->andFilterWhere(['like', 'amt_words', $this->amt_words])
            ->andFilterWhere(['like', 'reason_cancelled', $this->reason_cancelled])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'user_id', $this->user_id]);

        return $dataProvider;
    }
}
