<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InvoiceTable;

/**
 * InvoiceTableSerach represents the model behind the search form of `backend\models\InvoiceTable`.
 */
class InvoiceTableSerach extends InvoiceTable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['bill_number', 'bill_date', 'company_name', 'gstin_no', 'amt_in_words', 'created_date', 'updated_date', 'user_id', 'updated_ipaddress'], 'safe'],
            [['total_ampunt', 'total_gst_percent', 'total_cgst_percent', 'total_sgst_percent'], 'number'],
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
        $query = InvoiceTable::find()->orderBy(['id'=>SORT_DESC]);

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
            'bill_date' => $this->bill_date,
            'total_ampunt' => $this->total_ampunt,
            'total_gst_percent' => $this->total_gst_percent,
            'total_cgst_percent' => $this->total_cgst_percent,
            'total_sgst_percent' => $this->total_sgst_percent,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'bill_number', $this->bill_number])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'gstin_no', $this->gstin_no])
            ->andFilterWhere(['like', 'amt_in_words', $this->amt_in_words])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
