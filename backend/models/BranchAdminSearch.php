<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BranchAdmin;


class BranchAdminSearch extends BranchAdmin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ba_autoid', 'status'], 'integer'],
            [['ba_branchid', 'ba_code', 'auth_key', 'password_hash', 'ba_name','branchname' ,'ba_status', 'password_reset_token', 'ba_timestamp', 'ba_createdat'], 'safe'],
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

  
    public function search($params)
    {
        $query = BranchAdmin::find();
        $query->joinWith(['company']);
		$session = Yii::$app->session;
		$role=$session['authUserRole'];
	
		if($role=="Super")
		{
			
		}
		else{
			 $query->andFilterWhere([ 'ba_branchid'=>$session['branch_id']]);
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
            'ba_autoid' => $this->ba_autoid,
            'status' => $this->status,
            'ba_timestamp' => $this->ba_timestamp,
            'ba_createdat' => $this->ba_createdat,
        ]);

        $query->andFilterWhere(['like', 'ba_branchid', $this->ba_branchid])
            ->andFilterWhere(['like', 'ba_code', $this->ba_code])
            ->andFilterWhere(['like', 'branch_management.branch_name', $this->branchname])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'ba_name', $this->ba_name])
            ->andFilterWhere(['like', 'ba_status', $this->ba_status])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token]);

        return $dataProvider;
    }
}
