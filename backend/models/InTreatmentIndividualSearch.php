<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InTreatmentIndividual;

/**
 * InTreatmentIndividualSearch represents the model behind the search form of `backend\models\InTreatmentIndividual`.
 */
class InTreatmentIndividualSearch extends InTreatmentIndividual
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ind_id', 'qty'], 'integer'],
            [['treat_ove_id', 'return_status', 'return_date', 'treatment_id', 'user_id', 'user_role', 'ipaddress', 'created_at', 'updated_at'], 'safe'],
            [['rate', 'mrp', 'gstpercent', 'gstvalue', 'cgst_percent', 'cgst_value', 'sgst_percent', 'sgst_value', 'discountvalue', 'discount_percent', 'total_price'], 'number'],
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
        $query = InTreatmentIndividual::find();

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
            'ind_id' => $this->ind_id,
            'return_date' => $this->return_date,
            'qty' => $this->qty,
            'rate' => $this->rate,
            'mrp' => $this->mrp,
            'gstpercent' => $this->gstpercent,
            'gstvalue' => $this->gstvalue,
            'cgst_percent' => $this->cgst_percent,
            'cgst_value' => $this->cgst_value,
            'sgst_percent' => $this->sgst_percent,
            'sgst_value' => $this->sgst_value,
            'discountvalue' => $this->discountvalue,
            'discount_percent' => $this->discount_percent,
            'total_price' => $this->total_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'treat_ove_id', $this->treat_ove_id])
            ->andFilterWhere(['like', 'return_status', $this->return_status])
            ->andFilterWhere(['like', 'treatment_id', $this->treatment_id])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'user_role', $this->user_role])
            ->andFilterWhere(['like', 'ipaddress', $this->ipaddress]);

        return $dataProvider;
    }
}
