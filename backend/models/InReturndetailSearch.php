<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InReturndetail;

/**
 * InReturndetailSearch represents the model behind the search form of `backend\models\InReturndetail`.
 */
class InReturndetailSearch extends InReturndetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['return_detailid', 'return_id', 'stockid', 'stockresponseid', 'productid', 'compositionid', 'unitid', 'productqty'], 'integer'],
            [['sale_detailid', 'returndate', 'brandcode', 'stock_code', 'batchnumber', 'expiredate', 'discount_type', 'is_active', 'updated_by', 'created_at', 'updated_on', 'updated_ipaddress'], 'safe'],
            [['price', 'gstvalue', 'cgstvalue', 'sgstvalue', 'discountvalue', 'mrp', 'priceperqty', 'gst_percentage', 'cgst_percentage', 'sgst_percentage', 'discount_percentage', 'gstrate', 'discountrate', 'gstvalueperquantity', 'discountvalueperquantity'], 'number'],
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
        $query = InReturndetail::find();

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
            'return_detailid' => $this->return_detailid,
            'return_id' => $this->return_id,
            'stockid' => $this->stockid,
            'stockresponseid' => $this->stockresponseid,
            'returndate' => $this->returndate,
            'productid' => $this->productid,
            'compositionid' => $this->compositionid,
            'unitid' => $this->unitid,
            'expiredate' => $this->expiredate,
            'productqty' => $this->productqty,
            'price' => $this->price,
            'gstvalue' => $this->gstvalue,
            'cgstvalue' => $this->cgstvalue,
            'sgstvalue' => $this->sgstvalue,
            'discountvalue' => $this->discountvalue,
            'mrp' => $this->mrp,
            'priceperqty' => $this->priceperqty,
            'gst_percentage' => $this->gst_percentage,
            'cgst_percentage' => $this->cgst_percentage,
            'sgst_percentage' => $this->sgst_percentage,
            'discount_percentage' => $this->discount_percentage,
            'gstrate' => $this->gstrate,
            'discountrate' => $this->discountrate,
            'gstvalueperquantity' => $this->gstvalueperquantity,
            'discountvalueperquantity' => $this->discountvalueperquantity,
            'created_at' => $this->created_at,
            'updated_on' => $this->updated_on,
        ]);

         $query->andFilterWhere(['like', 'stock_code', $this->stock_code])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress])
              ->andFilterWhere(['like', 'unit.unitvalue', $this->unitid])
            
              ->andFilterWhere(['like', 'in_salesreturn.return_invoicenumber', $this->return_id])
                ->andFilterWhere(['like', 'in_salesreturn.mrnumber', $this->return_id]);
            
        return $dataProvider;
    }
}
