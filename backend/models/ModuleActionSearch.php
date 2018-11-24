<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ModuleAction;

/**
 * ModuleActionSearch represents the model behind the search form about `backend\models\ModuleAction`.
 */
class ModuleActionSearch extends ModuleAction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actionid', 'is_active'], 'integer'],
            [['action_name', 'action_key', 'action_value', 'updatedby', 'updatedon', 'updated_ipaddress'], 'safe'],
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
        $query = ModuleAction::find();

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
            'actionid' => $this->actionid,
            'is_active' => $this->is_active,
            'updatedon' => $this->updatedon,
        ]);

        $query->andFilterWhere(['like', 'action_name', $this->action_name])
            ->andFilterWhere(['like', 'action_key', $this->action_key])
            ->andFilterWhere(['like', 'action_value', $this->action_value])
            ->andFilterWhere(['like', 'updatedby', $this->updatedby])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
}
