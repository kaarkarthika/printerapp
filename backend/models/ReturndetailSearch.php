<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Returndetail;

/**
 * ReturndetailSearch represents the model behind the search form about `backend\models\Returndetail`.
 */
class ReturndetailSearch extends Returndetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['return_detailid', 'return_id', 'productid','product_name', 'composition_name','mrnumber','returninv','unitname','compositionid', 'unitid', 'productqty', 'is_active', 'updated_by'], 'integer'],
            [['returndate', 'stock_code', 'updated_on', 'updated_ipaddress'], 'safe'],
            [['price', 'priceperqty'], 'number'],
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
        $query = Returndetail::find();

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
            'returndate' => $this->returndate,
           'productid' => $this->productid,
             'compositionid' => $this->compositionid,
           
            'unitid' => $this->unitid,
            'productqty' => $this->productqty,
            'price' => $this->price,
            'priceperqty' => $this->priceperqty,
            'is_active' => $this->is_active,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'stock_code', $this->stock_code])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress])
			  ->andFilterWhere(['like', 'unit.unitvalue', $this->unitid])
			
			  ->andFilterWhere(['like', 'salesreturn.return_invoicenumber', $this->return_id])
			    ->andFilterWhere(['like', 'salesreturn.mrnumber', $this->return_id]);
			

        return $dataProvider;
    }
}
