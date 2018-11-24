<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sales;

/**
 * SalesSearch represents the model behind the search form about `backend\models\Sales`.
 */
class SalesSearch extends Sales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['opsaleid','patienttype','insurancetype'], 'integer'],
            [['name', 'dob', 'gender', 'mrnumber',  'address','patienttype', 'physicianname','phonenumber', 'invoicedate','billnumber', 'updated_by', 'updated_on', 'updated_ipaddress',
            'paid_status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
    
        return Model::scenarios();
    }

  
    public function search($params)
    {
       //echo "<pre>"; print_r($params); die;
        if(!empty($params['SalesSearch']['invoicedate']) && !empty($params['SalesSearch']['updated_on']))
            {
                $f=$params['SalesSearch']['invoicedate'];
                $f = explode('/', $f);
                $f1 = implode('-', $f);
                $t=$params['SalesSearch']['updated_on']; 
                $t = explode('/', $t);
                $t1 = implode('-', $t);
                $fromdate=date("Y-m-d",strtotime($f1));
                $todate=date("Y-m-d",strtotime($t1)); // echo $fromdate.'<br>'.$todate; die;
                $query = Sales::find()->where(['between', 'invoicedate',$fromdate.' 00:00:00', $todate.' 23:59:59'])
                ->orderBy(['opsaleid'=>SORT_DESC]); 
               //echo $query->createCommand()->getRawSql();
               // die; 
            }else{
                $query = Sales::find()->orderBy(['opsaleid'=>SORT_DESC]);
            }
       $session = Yii::$app->session;
		$role=$session['authUserRole'];
	
		if($role=="Super")
		{
		}
		else{
			 $query->andFilterWhere([ 'branch_id'=>$session['branch_id']]);
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
            'opsaleid' => $this->opsaleid,
            'dob' => $this->dob,
            //'invoicedate' => $this->invoicedate,
            //'updated_on' => $this->updated_on,
            
        ]);
            if(!empty($this->invoicedate) && !empty($this->updated_on))
                {
                    $f=$params['SalesSearch']['invoicedate'];
                    $t=$params['SalesSearch']['updated_on']; 
                    $t = explode('/', $t);
                    $t1 = implode('-', $t);
                    $fromdate=date("Y-m-d",strtotime($f));
                    $todate=date("Y-m-d",strtotime($t1));
                    $query->andFilterWhere(['between', 'invoicedate',$fromdate.' 00:00:00', $todate.' 23:59:59']);
                }
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'mrnumber', $this->mrnumber])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phonenumber', $this->phonenumber])
			->andFilterWhere(['like', 'physicianname', $this->physicianname])
            ->andFilterWhere(['like', 'billnumber', $this->billnumber])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);
           // echo "<pre>"; print_r($dataProvider); die;
        return $dataProvider;
    }


    public function customsearch($params)
    {
        $query = Sales::find();
       $session = Yii::$app->session;
		$role=$session['authUserRole'];
	
		if($role=="Super")
		{
			
		}
		else{
			 $query->andFilterWhere([ 'branch_id'=>$session['branch_id']]);
		}

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) 
        {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'opsaleid' => $this->opsaleid,
            'dob' => $this->dob,
            'invoicedate' => $this->invoicedate,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'mrnumber', $this->mrnumber])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phonenumber', $this->phonenumber])
			->andFilterWhere(['like', 'physicianname', $this->physicianname])
            ->andFilterWhere(['like', 'billnumber', $this->billnumber])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
			 ->andFilterWhere(['like', 'paid_status', $this->paid_status])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }

    public function reportsearch($params)
    {
        $query = Sales::find()->orderBy(['opsaleid'=>SORT_DESC]);

       $session = Yii::$app->session;
		$role=$session['authUserRole'];
	
		if($role=="Super")
		{
		}
		else
		{$query->andFilterWhere(['branch_id'=>$session['branch_id']]);}

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
           
        ]);

        $this->load($params);

        if (!$this->validate()) {
            
            return $dataProvider;
        }
        $query->andFilterWhere([
            'opsaleid' => $this->opsaleid,
            'dob' => $this->dob,
            
        ]);
		
		
		
		
	if(!empty($this->invoicedate) && !empty($this->updated_on))
	{
		$f=$this->invoicedate;
		$t=$this->updated_on;
	    $fromdate=date("Y-m-d",strtotime($f));
	    $todate=date("Y-m-d",strtotime($t));
	    $query->andFilterWhere(['between', 'invoicedate',$fromdate, $todate]);
	}
	
	$query->andFilterWhere(['like', 'name', trim($this->name)])->andFilterWhere(['like', 'gender', trim($this->gender)])
    ->andFilterWhere(['like', 'mrnumber', trim($this->mrnumber)])->andFilterWhere(['like', 'address', $this->address])
        ->andFilterWhere(['like', 'phonenumber', $this->phonenumber])->andFilterWhere(['like', 'physicianname', $this->physicianname])
        ->andFilterWhere(['like', 'billnumber', $this->billnumber])->andFilterWhere(['like', 'updated_by', $this->updated_by])
	->andFilterWhere([ 'paid_status'=>$this->paid_status])->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);
	$query->andFilterWhere([ 'patienttype'=>$this->patienttype]);
	$query->andFilterWhere(['insurancetype'=>$this->insurancetype]);

        return $dataProvider;
    }


}
