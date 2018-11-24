<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Stockreturn;

/**
 * StockreturnSearch represents the model behind the search form about `backend\models\Stockreturn`.
 */
class StockreturnSearch extends Stockreturn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stockreturnid', 'stockrequestid', 'stockid', 'branch_id', 'receivedquantity', 'total_no_of_quantity', 'unitid', 'returnquantity', 'updated_by'], 'integer'],
            [['request_code', 'batchnumber', 'receiveddate', 'manufacturedate', 'expiredate', 'purchasedate', 'stock_status', 'returndate', 'updated_on', 'updated_ipaddress'], 'safe'],
            [['purchaseprice', 'priceperquantity'], 'number'],
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
        $query = Stockreturn::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
           
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'stockreturnid' => $this->stockreturnid,
            'stockrequestid' => $this->stockrequestid,
            'stockid' => $this->stockid,
            'branch_id' => $this->branch_id,
            'receivedquantity' => $this->receivedquantity,
            'total_no_of_quantity' => $this->total_no_of_quantity,
            'unitid' => $this->unitid,
            'receiveddate' => $this->receiveddate,
            'purchaseprice' => $this->purchaseprice,
            'priceperquantity' => $this->priceperquantity,
            'manufacturedate' => $this->manufacturedate,
            'expiredate' => $this->expiredate,
            'purchasedate' => $this->purchasedate,
            'returndate' => $this->returndate,
            'returnquantity' => $this->returnquantity,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'request_code', $this->request_code])
            ->andFilterWhere(['like', 'batchnumber', $this->batchnumber])
            ->andFilterWhere(['like', 'stock_status', $this->stock_status])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
