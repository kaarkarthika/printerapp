<?php
namespace backend\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Productgrouping;
class ProductgroupingSearch extends Productgrouping
{
  
    public function rules()
    {
        return [
            [['productgroupid', 'productid', 'vendorid', 'is_active'], 'integer'],
            [['updated_by',  'product_name', 'vendor_name','stock_code','hsn_code','updated_on', 'updated_ipaddress','brandcode'], 'safe'],
        ];
    }
    public function scenarios()
    {
       
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Productgrouping::find()->joinwith(['product','vendor']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
                       'sort' => [
                'defaultOrder' => [
            'vendorid' => SORT_ASC,
           
        ]
    ],
            
        ]);
        $this->load($params);

        if (!$this->validate()) {
          
            return $dataProvider;
        }

        $query->andFilterWhere([
            'productgroupid' => $this->productgroupid,
            'stock_code'=>$this->stock_code,
            'product.productid' => $this->productid,
            'vendor.vendorid' => $this->vendorid,
            'brandcode' => $this->brandcode,
            'is_active' => $this->is_active,
            'updated_on' => $this->updated_on,
        ]);
        return $dataProvider;
    }
}