<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CompanyBranch;

/**
 * CompanyBranchSearch represents the model behind the search form about `backend\models\CompanyBranch`.
 */
class CompanyBranchSearch extends CompanyBranch
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_id', 'company_id',  'is_active'], 'integer'],
            [['branch_code','company_name', 'branch_name', 'address1', 'address2', 'address3', 'city', 'state', 'pincode'], 'safe'],
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
        $query = CompanyBranch::find()->joinwith('comp') ;
		$session = Yii::$app->session;
		$role=$session['authUserRole'];
	
		if($role=="Super")
		{
			
		}
		else{
			 $query->andFilterWhere([ 'branch_id'=>$session['branch_id']]);
		}
		
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
                    'sort' => [
                'defaultOrder' => [
            'company_id' => SORT_ASC,
            'is_head_office'=>SORT_DESC,
        ]
    ],
            
            
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'branch_id' => $this->branch_id,
            'company_id' => $this->company_id,
        ]);

        $query->andFilterWhere(['like', 'branch_code', $this->branch_code])
            ->andFilterWhere(['like', 'branch_name', $this->branch_name])
			->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'address3', $this->address3])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'pincode', $this->pincode])
           
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
