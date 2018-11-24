<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\OpMoneyreceipt;

/**
 * OpMoneyreceiptSearch represents the model behind the search form of `backend\models\OpMoneyreceipt`.
 */
class OpMoneyreceiptSearch extends OpMoneyreceipt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid'], 'integer'],
            [['amount', 'recovery_amt', 'total_amt', 'org_disc_amt'], 'number'],
            [['tds', 'service_tax_amount', 'amount','request_date', 'post_discount', 'dis_allowed_amt', 'paid_by', 'patient_name', 'paid_amount','mr_number', 'amount_words', 'payment_by', 'towards', 'auth_by', 'bank_name', 'remarks', 'status', 'mr_type','created_at', 'updated_at', 'user_id', 'updated_ipaddress'], 'safe'],
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
        $query = OpMoneyreceipt::find()->orderBy(['autoid'=>SORT_DESC]);

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
          //  'mr_type' => $this->mr_type,
            'amount' => $this->amount,
            'request_date' => $this->request_date,
            'recovery_amt' => $this->recovery_amt,
            'total_amt' => $this->total_amt,
            'org_disc_amt' => $this->org_disc_amt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'tds', $this->tds])
            ->andFilterWhere(['like', 'service_tax_amount', $this->service_tax_amount])
            ->andFilterWhere(['like', 'post_discount', $this->post_discount])
            ->andFilterWhere(['like', 'mr_type', $this->mr_type])
            ->andFilterWhere(['like', 'mr_number', $this->mr_number])
            ->andFilterWhere(['like', 'dis_allowed_amt', $this->dis_allowed_amt])
            ->andFilterWhere(['like', 'paid_by', $this->paid_by])
            ->andFilterWhere(['like', 'paid_amount', $this->paid_amount])
            ->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'total_amt', $this->total_amt])
            ->andFilterWhere(['like', 'patient_name', $this->patient_name])
            ->andFilterWhere(['like', 'amount_words', $this->amount_words])
            ->andFilterWhere(['like', 'payment_by', $this->payment_by])
            ->andFilterWhere(['like', 'towards', $this->towards])
            ->andFilterWhere(['like', 'auth_by', $this->auth_by])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
