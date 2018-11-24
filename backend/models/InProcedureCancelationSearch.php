<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InProcedureCancelation;

/**
 * InProcedureCancelationSearch represents the model behind the search form of `backend\models\InProcedureCancelation`.
 */
class InProcedureCancelationSearch extends InProcedureCancelation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['can_id', 'can_tot_items', 'can_qty'], 'integer'],
            [['treat_id', 'name', 'dob', 'gender', 'physician_name', 'mr_number', 'pat_id', 'subvisit_id', 'subvisit_num', 'ins_type', 'treat_bill', 'can_bill', 'treat_invoice_date', 'cancel_invoice_date', 'reason_cancel', 'authority', 'user_id', 'user_role', 'created_at', 'updated_at', 'ipaddress'], 'safe'],
            [['cancel_unitprice', 'can_gst_percent', 'can_cgst_percent', 'can_sgst_percent', 'can_gst_amt', 'can_cgst_amt', 'can_sgst_amt', 'can_dis_percent', 'can_dis_value', 'can_due_amt', 'can_total', 'return_amt', 'balance_amt'], 'number'],
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
        $query = InProcedureCancelation::find();

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
            'can_id' => $this->can_id,
            'dob' => $this->dob,
            'treat_invoice_date' => $this->treat_invoice_date,
            'cancel_invoice_date' => $this->cancel_invoice_date,
            'cancel_unitprice' => $this->cancel_unitprice,
            'can_tot_items' => $this->can_tot_items,
            'can_qty' => $this->can_qty,
            'can_gst_percent' => $this->can_gst_percent,
            'can_cgst_percent' => $this->can_cgst_percent,
            'can_sgst_percent' => $this->can_sgst_percent,
            'can_gst_amt' => $this->can_gst_amt,
            'can_cgst_amt' => $this->can_cgst_amt,
            'can_sgst_amt' => $this->can_sgst_amt,
            'can_dis_percent' => $this->can_dis_percent,
            'can_dis_value' => $this->can_dis_value,
            'can_due_amt' => $this->can_due_amt,
            'can_total' => $this->can_total,
            'return_amt' => $this->return_amt,
            'balance_amt' => $this->balance_amt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'treat_id', $this->treat_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'physician_name', $this->physician_name])
            ->andFilterWhere(['like', 'mr_number', $this->mr_number])
            ->andFilterWhere(['like', 'pat_id', $this->pat_id])
            ->andFilterWhere(['like', 'subvisit_id', $this->subvisit_id])
            ->andFilterWhere(['like', 'subvisit_num', $this->subvisit_num])
            ->andFilterWhere(['like', 'ins_type', $this->ins_type])
            ->andFilterWhere(['like', 'treat_bill', $this->treat_bill])
            ->andFilterWhere(['like', 'can_bill', $this->can_bill])
            ->andFilterWhere(['like', 'reason_cancel', $this->reason_cancel])
            ->andFilterWhere(['like', 'authority', $this->authority])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'user_role', $this->user_role])
            ->andFilterWhere(['like', 'ipaddress', $this->ipaddress]);

        return $dataProvider;
    }
}
