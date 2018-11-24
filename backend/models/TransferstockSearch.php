<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Transferstock;

/**
 * TransferstockSearch represents the model behind the search form about `backend\models\Transferstock`.
 */
class TransferstockSearch extends Transferstock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transferstockid', 'productid',     'updated_by'], 'integer'],
            [['transferstockdate', 'updated_on', 'updated_ipaddress','approvedateval'], 'safe'],
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
         $query = Transferstock::find()->where(['transferstock.status'=>'Requested'])->orderBy(['transferstockid'=>SORT_DESC]);

        $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
	
		if($role=="Super")
		{
			
		}
		else{
			  $query->andFilterWhere(['frombranch' =>$companybranchid]);
			
		} 
		$query->joinWith(['stockval']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
           
            return $dataProvider;
        }
    if(!empty($this->transferstockdate))
	{
		$tsd=date('Y-m-d', strtotime($this->transferstockdate));
		 $query->andFilterWhere(['transferstockdate' =>$tsd]);
	}
	
	 if(!empty($this->approvedateval))
	{
		$tsd=date('Y-m-d', strtotime($this->approvedateval));
		 $query->andFilterWhere(['transferstockapprove.approveddate' =>$tsd]);
	}
	
	
        $query->andFilterWhere([
            'transferstockid' => $this->transferstockid,
            'productid' => $this->productid,
            'frombranch' => $this->frombranch,
            'tobranch' => $this->tobranch,
            'transferstockquantity' => $this->transferstockquantity,
            
        ]);

        $query->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }











  public function approvesearch($params)
    {
        $query = Transferstock::find()->where(['status'=>'Approved'])->orwhere(['status'=>'Requested'])->orderBy(['transferstockid'=>SORT_DESC]);
        $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
	
		if($role=="Super")
		{
			
		}
		else{
			  $query->andFilterWhere(['tobranch' =>$companybranchid]);
			
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
		
		 if(!empty($this->transferstockdate))
	{
		$tsd=date('Y-m-d', strtotime($this->transferstockdate));
		 $query->andFilterWhere(['transferstockdate' =>$tsd]);
	}

        // grid filtering conditions
        $query->andFilterWhere([
            'transferstockid' => $this->transferstockid,
            'productid' => $this->productid,
            'frombranch' => $this->frombranch,
            'tobranch' => $this->tobranch,
            'transferstockquantity' => $this->transferstockquantity,
           
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
    public function receivesearch($params)
    {
         $query = Transferstock::find()->where(['status'=>'Approved'])->orwhere(['status'=>'Received'])->orderBy(['transferstockid'=>SORT_DESC]);

        $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
	
		if($role=="Super")
		{
			
		}
		else{
			  $query->andFilterWhere(['frombranch' =>$companybranchid]);
			
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
		
		
		
		 if(!empty($this->transferstockdate))
	{
		$tsd=date('Y-m-d', strtotime($this->transferstockdate));
		 $query->andFilterWhere(['transferstockdate' =>$tsd]);
	}

        // grid filtering conditions
        $query->andFilterWhere([
            'transferstockid' => $this->transferstockid,
            'productid' => $this->productid,
            'frombranch' => $this->frombranch,
            'tobranch' => $this->tobranch,
            'transferstockquantity' => $this->transferstockquantity,
          
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }
  public function returnsearch($params)
    {
         $query = Transferstock::find()->where(['status'=>'Received'])->orwhere(['status'=>'Returned'])->orderBy(['transferstockid'=>SORT_DESC]);

        $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
	
		if($role=="Super")
		{
			
		}
		else{
			  $query->andFilterWhere(['frombranch' =>$companybranchid]);
			
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
		
		
		
		 if(!empty($this->transferstockdate))
	{
		$tsd=date('Y-m-d', strtotime($this->transferstockdate));
		 $query->andFilterWhere(['transferstockdate' =>$tsd]);
	}

        // grid filtering conditions
        $query->andFilterWhere([
            'transferstockid' => $this->transferstockid,
            'productid' => $this->productid,
            'frombranch' => $this->frombranch,
            'tobranch' => $this->tobranch,
            'transferstockquantity' => $this->transferstockquantity,
         
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }


public function returnapprovesearch($params)
    {
         $query = Transferstock::find()->where(['status'=>'Returned'])->orwhere(['status'=>'ReturnApproved'])->orderBy(['transferstockid'=>SORT_DESC]);

        $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
	
		if($role=="Super")
		{
			
		}
		else{
			  $query->andFilterWhere(['tobranch' =>$companybranchid]);
			
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
		
		
		
		 if(!empty($this->transferstockdate))
	{
		$tsd=date('Y-m-d', strtotime($this->transferstockdate));
		 $query->andFilterWhere(['transferstockdate' =>$tsd]);
	}

        // grid filtering conditions
        $query->andFilterWhere([
            'transferstockid' => $this->transferstockid,
            'productid' => $this->productid,
            'frombranch' => $this->frombranch,
            'tobranch' => $this->tobranch,
            'transferstockquantity' => $this->transferstockquantity,
         
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }

  
}
