<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InRoomtypes;

/**
 * InRoomtypesSearch represents the model behind the search form of `backend\models\InRoomtypes`.
 */
class InRoomtypesSearch extends InRoomtypes
{
    /**
     * @inheritdoc
     */
     public $hsncode1;
    public function rules()
    {
        return [
            [['autoid'], 'integer'],
            [['room_types', 'hsn_code', 'is_active', 'created_date', 'updated_date', 'user_id', 'userrole', 'ipaddress'], 'safe'],
            [['price'], 'number'],
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
        $query = InRoomtypes::find();
	//	$query->joinWith(['taxgrouphsn']);

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
            'price' => $this->price,
            'hsn_code'=>$this->hsn_code,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'room_types', $this->room_types])
            //->andFilterWhere(['like', 'hsn_code', $this->hsn_code])
           // ->andFilterWhere(['like','hsncode', $this->hsncodemaster->hsncode])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'userrole', $this->userrole])
            ->andFilterWhere(['like', 'ipaddress', $this->ipaddress]);

        return $dataProvider;
    }
}
