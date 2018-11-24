<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\IpMoneyreceipts;

/**
 * IpMoneyreceiptsSearch represents the model behind the search form of `backend\models\IpMoneyreceipts`.
 */
class IpMoneyreceiptsSearch extends IpMoneyreceipts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid'], 'integer'],
            [['transaction_type', 'ip_no', 'mr_no', 'bed_no', 'total_paid', 'name', 'mobile_no', 'bill_number', 'pancard_no', 'cardholder_name', 'service_tax', 'admission_status', 'prev_cashpaid', 'bill_amount', 'amount', 'total_amount', 'mode_of_payment', 'card_cheque_no', 'bank_name', 'payment_details', 'amount_in_words', 'remark', 'default_amount', 'status', 'created_at', 'updated_at', 'user_id', 'ip_address', 'updated_ipaddress'], 'safe'],
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
        $query = IpMoneyreceipts::find();

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
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'transaction_type', $this->transaction_type])
            ->andFilterWhere(['like', 'ip_no', $this->ip_no])
            ->andFilterWhere(['like', 'mr_no', $this->mr_no])
            ->andFilterWhere(['like', 'bed_no', $this->bed_no])
            ->andFilterWhere(['like', 'total_paid', $this->total_paid])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
            ->andFilterWhere(['like', 'bill_number', $this->bill_number])
            ->andFilterWhere(['like', 'pancard_no', $this->pancard_no])
            ->andFilterWhere(['like', 'cardholder_name', $this->cardholder_name])
            ->andFilterWhere(['like', 'service_tax', $this->service_tax])
            ->andFilterWhere(['like', 'admission_status', $this->admission_status])
            ->andFilterWhere(['like', 'prev_cashpaid', $this->prev_cashpaid])
            ->andFilterWhere(['like', 'bill_amount', $this->bill_amount])
            ->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'total_amount', $this->total_amount])
            ->andFilterWhere(['like', 'mode_of_payment', $this->mode_of_payment])
            ->andFilterWhere(['like', 'card_cheque_no', $this->card_cheque_no])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'payment_details', $this->payment_details])
            ->andFilterWhere(['like', 'amount_in_words', $this->amount_in_words])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'default_amount', $this->default_amount])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
