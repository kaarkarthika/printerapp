<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LabTesting;

/**
 * LabTestingSearch represents the model behind the search form of `backend\models\LabTesting`.
 */
class LabTestingSearch extends LabTesting
{
    /**
     * @inheritdoc
     */
     public $category_name;
	 public $lab_subcategory;
	 public $unit_name;
	 public $referencevalue;
	  public $hsncode;
    public function rules()
    {
        return [
            [['autoid', 'testgroupid', 'cat_id', 'subcat_id', 'unit_id', 'created_at', 'updated_at'], 'integer'],
            [['test_name', 'price', 'isactive', 'created_date', 'updated_date','category_name','lab_subcategory','unit_name','method','description','hsncode','result_type','result_type_val' ], 'safe'],
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
        $query = LabTesting::find()->joinWith(['category']);

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
            'autoid' => $this->autoid,
            'testgroupid' => $this->testgroupid,
            'cat_id' => $this->cat_id,
            'subcat_id' => $this->subcat_id,
            'unit_id' => $this->unit_id,
            'created_at' => $this->created_at,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'test_name', $this->test_name])
            ->andFilterWhere(['like', 'price', $this->price])
			->andFilterWhere(['like', 'lab_category.category_name', $this->category_name])
			->andFilterWhere(['like', 'lab_subcategory.lab_subcategory', $this->lab_subcategory])
			->andFilterWhere(['like', 'lab_unit.unit_name', $this->unit_name])
			->andFilterWhere(['like','taxgrouping.hsncode', $this->hsncode])
            ->andFilterWhere(['like', 'isactive', $this->isactive]);

        return $dataProvider;
    }


	
}
