<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Vendor;

class VendorSearch extends Vendor
{
   
    public function rules()
    {
        return [
            [['vendorid'], 'integer'],
            [['updated_by', 'vendorname','vendorcode','updated_on','is_active', 'updated_ipaddress'], 'safe'],
        ];
    }

    
    public function scenarios()
    {
      
        return Model::scenarios();
    }

  
    public function search($params)
    {
        $query = Vendor::find();
		

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
           
            return $dataProvider;
        }

     
        $query->andFilterWhere([
            'vendorid' => $this->vendorid,
            'is_active' => $this->is_active,
            'updated_on' => $this->updated_on,
        ]);

        $query
        ->andFilterWhere(['like', 'vendorname', $this->vendorname])
            ->andFilterWhere(['like', 'vendorcode', $this->vendorcode])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
