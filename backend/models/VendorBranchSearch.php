<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VendorBranch;

class VendorBranchSearch extends VendorBranch
{
    public function rules()
    {
        return [
            [['vendor_branchid', 'is_headoffice', 'is_active'], 'integer'],
            [['vendorid', 'branchcode', 'branchname', 'address1', 'address2', 'bankname','accnumber','ifsccode','address3','vendor_name', 
            'city', 'state', 'pincode', 'branch_emailid','branch_phonenumber','gstnumber', 'updated_by', 'updated_on', 'updated_ipaddress'], 'safe'],
        ];
    }

  
    public function scenarios()
    {
       
        return Model::scenarios();
    }

   
    public function search($params)
    {
        $query = VendorBranch::find();
		$query->joinWith(['states']);
		$query->joinWith(['vendor']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
             'sort' => [
                'defaultOrder' => [
            'vendorid' => SORT_ASC,
            'is_headoffice'=>SORT_DESC,
        ]
    ],
        ]);
		

        $this->load($params);

        if (!$this->validate()) {
          
            return $dataProvider;
        }

      
        $query->andFilterWhere([
            'vendor_branchid' => $this->vendor_branchid,
            'is_headoffice' => $this->is_headoffice,
            'is_active' => $this->is_active,
            
        ]);

        $query->andFilterWhere(['vendor.vendorid'=>$this->vendorid])
            ->andFilterWhere(['like', 'branchcode', trim($this->branchcode)])
            ->andFilterWhere(['like', 'branchname', trim($this->branchname)])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'city', trim($this->city)])
			  ->andFilterWhere(['like', 'branch_phonenumber', $this->branch_phonenumber])
			    ->andFilterWhere(['like', 'branch_emailid', $this->branch_emailid])
				 ->andFilterWhere(['like', 'vendor.vendorname', trim($this->vendor_name)])
            ->andFilterWhere(['like', 'states.state_name', $this->state])
            ->andFilterWhere(['like', 'pincode', $this->pincode])
			  ->andFilterWhere(['like', 'bankname', $this->bankname])
			   ->andFilterWhere(['like', 'accnumber', $this->accnumber])
			    ->andFilterWhere(['like', 'ifsccode', $this->ifsccode])
            ->andFilterWhere(['like', 'gstnumber', $this->gstnumber]);
           

        return $dataProvider;
    }
}
