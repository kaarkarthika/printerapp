<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InTreatmentOverall;

/**
 * InTreatmentOverallSearch represents the model behind the search form of `backend\models\InTreatmentOverall`.
 */
class InTreatmentOverallSearch extends InTreatmentOverall
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tot_no_of_items', 'tot_quantity'], 'integer'],
            [['refund_status', 'name', 'dob', 'age', 'gender', 'physicianname', 'mrnumber', 'patient_id', 'subvisit_id', 'subvisit_num', 'insurancetype', 'address', 'phonenumber', 'billnumber', 'invoicedate', 'overalldiscounttype', 'subtotval', 'remarks', 'discount_authority', 'user_id', 'user_role', 'created_at', 'updated_at', 'ipaddress'], 'safe'],
            [['total', 'total_gst_percent', 'total_cgst_percent', 'total_sgst_percent', 'totalgstvalue', 'totalcgstvalue', 'totalsgstvalue', 'totaldiscountvalue', 'overalldiscountpercent', 'overalldiscountamount', 'overall_due_amount', 'overall_sub_total', 'overall_net_amount', 'overalltotal'], 'number'],
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
        $query = InTreatmentOverall::find();

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
            'id' => $this->id,
            'invoicedate' => $this->invoicedate,
            'total' => $this->total,
            'tot_no_of_items' => $this->tot_no_of_items,
            'tot_quantity' => $this->tot_quantity,
            'total_gst_percent' => $this->total_gst_percent,
            'total_cgst_percent' => $this->total_cgst_percent,
            'total_sgst_percent' => $this->total_sgst_percent,
            'totalgstvalue' => $this->totalgstvalue,
            'totalcgstvalue' => $this->totalcgstvalue,
            'totalsgstvalue' => $this->totalsgstvalue,
            'totaldiscountvalue' => $this->totaldiscountvalue,
            'overalldiscountpercent' => $this->overalldiscountpercent,
            'overalldiscountamount' => $this->overalldiscountamount,
            'overall_due_amount' => $this->overall_due_amount,
            'overall_sub_total' => $this->overall_sub_total,
            'overall_net_amount' => $this->overall_net_amount,
            'overalltotal' => $this->overalltotal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'refund_status', $this->refund_status])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'dob', $this->dob])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'physicianname', $this->physicianname])
            ->andFilterWhere(['like', 'mrnumber', $this->mrnumber])
            ->andFilterWhere(['like', 'patient_id', $this->patient_id])
            ->andFilterWhere(['like', 'subvisit_id', $this->subvisit_id])
            ->andFilterWhere(['like', 'subvisit_num', $this->subvisit_num])
            ->andFilterWhere(['like', 'insurancetype', $this->insurancetype])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phonenumber', $this->phonenumber])
            ->andFilterWhere(['like', 'billnumber', $this->billnumber])
            ->andFilterWhere(['like', 'overalldiscounttype', $this->overalldiscounttype])
            ->andFilterWhere(['like', 'subtotval', $this->subtotval])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'discount_authority', $this->discount_authority])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'user_role', $this->user_role])
            ->andFilterWhere(['like', 'ipaddress', $this->ipaddress]);

        return $dataProvider;
    }
}
