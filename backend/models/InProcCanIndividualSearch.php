<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InProcCanIndividual;

/**
 * InProcCanIndividualSearch represents the model behind the search form of `backend\models\InProcCanIndividual`.
 */
class InProcCanIndividualSearch extends InProcCanIndividual
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['can_id'], 'integer'],
            [['can_treat_id', 'can_proc_ind_id', 'treat_id', 'user_id', 'ipaddress', 'created_at', 'updated_at'], 'safe'],
            [['qty', 'unit_price', 'mrp', 'gst_percent', 'cgst_percent', 'sgst_percent', 'gst_value', 'cgst_value', 'sgst_value', 'dis_value', 'dis_percent', 'total_price'], 'number'],
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
        $query = InProcCanIndividual::find();

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
            'qty' => $this->qty,
            'unit_price' => $this->unit_price,
            'mrp' => $this->mrp,
            'gst_percent' => $this->gst_percent,
            'cgst_percent' => $this->cgst_percent,
            'sgst_percent' => $this->sgst_percent,
            'gst_value' => $this->gst_value,
            'cgst_value' => $this->cgst_value,
            'sgst_value' => $this->sgst_value,
            'dis_value' => $this->dis_value,
            'dis_percent' => $this->dis_percent,
            'total_price' => $this->total_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'can_treat_id', $this->can_treat_id])
            ->andFilterWhere(['like', 'can_proc_ind_id', $this->can_proc_ind_id])
            ->andFilterWhere(['like', 'treat_id', $this->treat_id])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'ipaddress', $this->ipaddress]);

        return $dataProvider;
    }
}
