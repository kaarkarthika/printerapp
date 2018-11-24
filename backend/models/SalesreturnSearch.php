<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Salesreturn;
class SalesreturnSearch extends Salesreturn
{
	public function rules()
    {
        return [
            [['return_id', 'patient_type', 'is_active', 'updated_by'], 'integer'],
            [['return_invoicenumber', 'name', 'returndate', 'mrnumber','paid_status', 'updated_on', 'updated_ipaddress'], 'safe'],
        ];
    }
   
    public function scenarios()
    {
     return Model::scenarios();
    }
 
    public function search($params)
    {
        $query = Salesreturn::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'return_id' => $this->return_id,
            'patient_type' => $this->patient_type,
            'is_active' => $this->is_active,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'return_invoicenumber', $this->return_invoicenumber]) ->andFilterWhere(['like', 'mrnumber', $this->mrnumber])
        ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
	
	public function reportsearch($params)
    {
        $query = Salesreturn::find()->orderBy(['return_id'=>SORT_DESC]);
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'return_id' => $this->return_id,
            'patient_type' => $this->patient_type,
            'is_active' => $this->is_active,
            'updated_by' => $this->updated_by,
          
        ]);
		
		if(!empty($this->returndate) && !empty($this->updated_on))
		{
			$f=$this->returndate;
			$t=$this->updated_on;
		    $fromdate=date("Y-m-d",strtotime($f));
		    $todate=date("Y-m-d",strtotime($t));
		    $query->andFilterWhere(['between', 'returndate',$fromdate, $todate]);
		}

        $query->andFilterWhere(['like', 'return_invoicenumber', $this->return_invoicenumber]) ->andFilterWhere(['like', 'mrnumber', $this->mrnumber])
        ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress])->andFilterWhere(['like', 'name', $this->name])->
		andFilterWhere(['like', 'paid_status', $this->paid_status]);

        return $dataProvider;
	}
	
	
}
