<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LabPayment;

/**
 * LabPaymentSearch represents the model behind the search form of `backend\models\LabPayment`.
 */
class LabPaymentSearch extends LabPayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoid', 'lab_testgroup', 'lab_testing', 'user_id'], 'integer'],
            [['mr_number', 'paid_status', 'pay_mode', 'created_at', 'updated_at', 'ip_address'], 'safe'],
            [['total_amount', 'discount_amount', 'net_amount', 'refund_amount'], 'number'],
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
        $query = LabPayment::find();

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
            'lab_testgroup' => $this->lab_testgroup,
            'lab_testing' => $this->lab_testing,
            'total_amount' => $this->total_amount,
            'discount_amount' => $this->discount_amount,
            'net_amount' => $this->net_amount,
            'refund_amount' => $this->refund_amount,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'mr_number', $this->mr_number])
            ->andFilterWhere(['like', 'paid_status', $this->paid_status]);
           // ->andFilterWhere(['like', 'towards', $this->towards])
           // ->andFilterWhere(['like', 'pay_mode', $this->pay_mode])
           // ->andFilterWhere(['like', 'cancellation', $this->cancellation])
           // ->andFilterWhere(['like', 'ip_address', $this->ip_address]);

        return $dataProvider;
    }

	
	
	

}
