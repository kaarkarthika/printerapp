<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AuthUserRole;

/**
 * AuthUserRoleSearch represents the model behind the search form about `backend\models\AuthUserRole`.
 */
class AuthUserRoleSearch extends AuthUserRole
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ur_autoid', 'sortorder'], 'integer'],
            [['rolename', 'rolecode', 'timestamp'], 'safe'],
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
        $query = AuthUserRole::find();

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
            'ur_autoid' => $this->ur_autoid,
            'sortorder' => $this->sortorder,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'rolename', $this->rolename])
            ->andFilterWhere(['like', 'rolecode', $this->rolecode]);

        return $dataProvider;
    }
}
