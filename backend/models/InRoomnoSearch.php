<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InRoomno;

/**
 * InRoomnoSearch represents the model behind the search form of `backend\models\InRoomno`.
 */
class InRoomnoSearch extends InRoomno
{
    /**
     * @inheritdoc
     */
   //    public $floorname;
//	 public $roomtype1;
    public function rules()
    {
        return [
            [['autoid'], 'integer'],
            [['room_no', 'floorid', 'roomtypeid', 'created_date', 'updated_date', 'user_id', 'user_role', 'ipaddress','roomtype1','floorname'], 'safe'],
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
        $query = InRoomno::find()->joinWith('floor')->joinWith('roomtype');
		

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
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'room_no', $this->room_no])
            
            ->andFilterWhere(['like', 'in_floormaster.floor_no', $this->floorname])
			->andFilterWhere(['like', 'in_roomtypes.room_types', $this->roomtype1])
            
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'user_role', $this->user_role])
            ->andFilterWhere(['like', 'ipaddress', $this->ipaddress]);

        return $dataProvider;
    }
}
