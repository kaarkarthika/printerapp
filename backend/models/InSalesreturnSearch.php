<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InSalesreturn;

/**
 * InSalesreturnSearch represents the model behind the search form of `backend\models\InSalesreturn`.
 */
class InSalesreturnSearch extends InSalesreturn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['return_id', 'saleid', 'branch_id', 'returnincrement'], 'integer'],
            [['return_invoicenumber', 'patient_type', 'returndate', 'name', 'mrnumber', 'patient_id', 'sub_visit_id', 'subvisit_num', 'return_qty', 'unit_price', 'paid_status', 'is_active', 'updated_by', 'created_at', 'updated_on', 'updated_ipaddress'], 'safe'],
            [['total', 'totalgstvalue', 'totalcgstvalue', 'totalsgstvalue', 'totaldiscountvalue', 'totalcgstpercentage', 'totalsgstpercentage', 'totalgstpercentage', 'totaldiscountpercentage'], 'number'],
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
        $query = InSalesreturn::find();

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
            'return_id' => $this->return_id,
            'saleid' => $this->saleid,
            'returndate' => $this->returndate,
            'branch_id' => $this->branch_id,
            'returnincrement' => $this->returnincrement,
            'total' => $this->total,
            'totalgstvalue' => $this->totalgstvalue,
            'totalcgstvalue' => $this->totalcgstvalue,
            'totalsgstvalue' => $this->totalsgstvalue,
            'totaldiscountvalue' => $this->totaldiscountvalue,
            'totalcgstpercentage' => $this->totalcgstpercentage,
            'totalsgstpercentage' => $this->totalsgstpercentage,
            'totalgstpercentage' => $this->totalgstpercentage,
            'totaldiscountpercentage' => $this->totaldiscountpercentage,
            'created_at' => $this->created_at,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'return_invoicenumber', $this->return_invoicenumber])
            ->andFilterWhere(['like', 'patient_type', $this->patient_type])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mrnumber', $this->mrnumber])
            ->andFilterWhere(['like', 'patient_id', $this->patient_id])
            ->andFilterWhere(['like', 'sub_visit_id', $this->sub_visit_id])
            ->andFilterWhere(['like', 'subvisit_num', $this->subvisit_num])
            ->andFilterWhere(['like', 'return_qty', $this->return_qty])
            ->andFilterWhere(['like', 'unit_price', $this->unit_price])
            ->andFilterWhere(['like', 'paid_status', $this->paid_status])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
