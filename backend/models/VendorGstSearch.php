<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VendorGst;

/**
 * VendorGstSearch represents the model behind the search form about `backend\models\VendorGst`.
 */
class VendorGstSearch extends VendorGst
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vendor_gst_id', 'vendor_id',  'state', 'is_active', 'updated_by'], 'integer'],
            [['gst_tax', 'updated_on', 'updated_ipaddress'], 'safe'],
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
        $query = VendorGst::find();

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
            'vendor_gst_id' => $this->vendor_gst_id,
            'vendor_id' => $this->vendor_id,
            'is_active' => $this->is_active,
            'state' => $this->state
           
           
        ]);

        $query->andFilterWhere(['like', 'gst_tax', $this->gst_tax]);
         

        return $dataProvider;
    }
}
