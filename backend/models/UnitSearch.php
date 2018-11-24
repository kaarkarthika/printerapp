<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Unit;

/**
 * UnitSearch represents the model behind the search form about `backend\models\Unit`.
 */
class UnitSearch extends Unit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unitid','no_of_unit', 'is_active'], 'integer'],
            [['unitname', 'updated_by','unitvalue','unit_name', 'updated_on', 'updated_ipaddress'], 'safe'],
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
        $query = Unit::find()->joinWith(['producttype']);

        // add conditions that should always apply here
		
		
		if(isset($_GET['UnitSearch']['unit_name']))
		{
			$prd_type=$_GET['UnitSearch']['unit_name'];
			$query->andFilterWhere(['producttype.product_typeid'=> $prd_type]);
			//echo $query->createCommand()->getRawSql(); die;
		}
		
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
            'unitid' => $this->unitid,
            'is_active' => $this->is_active,
            'updated_on' => $this->updated_on,
             'no_of_unit' => $this->no_of_unit,
        ]);

        //$query->andFilterWhere(['like', 'unit.unitname', $this->unitname])
			//->andFilterWhere(['like', 'unit.unitname', $this->unitname])
		   $query->andFilterWhere(['like', 'unitvalue', $this->unitvalue])
		   //->andFilterWhere(['like', 'producttype.product_type', $this->unit_name])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
