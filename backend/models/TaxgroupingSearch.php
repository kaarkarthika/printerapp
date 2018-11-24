<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Taxgrouping;

class TaxgroupingSearch extends Taxgrouping
{
   
    public function rules()
    {
        return [[['taxgroupid','is_active'], 'integer'],[['groupid','hsncode','tax', 'updated_by', 'updated_on', 'updated_ipaddress','groupname','effect_date'], 'safe'],
        ];
    }

   
    public function scenarios()
    {
     return Model::scenarios();
    }
	
	
  
    public function search($params)
    {
        $query = Taxgrouping::find();
		$query->joinWith(['taxmaster']);
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $this->load($params);
			
		
		if(isset($_GET['TaxgroupingSearch']['effect_date']) && $_GET['TaxgroupingSearch']['effect_date'] != '')
		{
			
			//$query->joinWith(['jobname']);
			$job_no=date('Y-m-d',strtotime($_GET['TaxgroupingSearch']['effect_date']));	
			$query->andFilterWhere([ 'effect_date'=>$job_no]);
		}
			
		
        if (!$this->validate()) { return $dataProvider;}
        $query->andFilterWhere([ 'taxgroupid' => $this->taxgroupid, 'taxgrouping.is_active' => $this->is_active,'tax' => $this->tax,'hsncode' => $this->hsncode,'groupid'=> $this->taxmaster->taxid]);
       
       	
       	//echo $query->createCommand()->getRawSql();die;
        return $dataProvider;
    }
}