<?php

namespace backend\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class StockrequestSearch extends Stockrequest
{
    public function rules()
    {
        return [
            [['requestid', 'vendorid',  'unitid', 'is_active','requestincrement'], 'integer'],
            [['requestcode','brandcode','vendor_name', 'requesttype','requestdate',  'updated_by', 'updated_on', 'updated_ipaddress'], 'safe'],
        ];
    }
    public function scenarios()
    {
    
        return Model::scenarios();
    }

    public function search($params)
    {
    	   $query = Stockrequest::find()->where(['LIKE','requesttype','vendorstock'])->joinwith(['product','vendor'])->orderBy(['requestid'=>SORT_DESC]);
		   $query->andFilterWhere(['stockrequest.is_active'=>1]);
		   
		$session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
		if($role=="Super")
		{
		}
		
		else{ $query->andFilterWhere(['stockrequest.branch_id' =>$companybranchid]);} 
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		$dataProvider->sort->attributes['vendor'] = [
       
        'asc' => ['vendor.vendorid' => SORT_ASC],
        'desc' => ['vendor.vendorid' => SORT_DESC],
    ];
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
		
		
        $query->andFilterWhere(['productid' => $this->productid,  'quantity' => $this->quantity, 'unitid' => $this->unitid ]);
        $query->andFilterWhere(['like', 'requestcode', $this->requestcode])
            ->andFilterWhere(['like', 'brandcode', $this->brandcode])
			 ->andFilterWhere(['like', 'productname', $this->product_name])
			  ->andFilterWhere([ 'vendor.vendorid'=>$this->vendorid]);
			  
			  
			    if(!empty($this->requestdate))
	{
		 $tsd=date('Y-m-d', strtotime($this->requestdate));
		 $query->andFilterWhere(['requestdate' =>$tsd]);
	}
			  
			  
        return $dataProvider;
    }

 public function reportsearch($params)
    {
    	$query = Stockrequest::find()->joinwith(['product','vendor']);
		$session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
		if($role=="Super")
		{
		}
		
		else{ $query->andFilterWhere(['stockrequest.branch_id' =>$companybranchid]);} 
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		$dataProvider->sort->attributes['vendor'] = [
       
        'asc' => ['vendor.vendorid' => SORT_ASC],
        'desc' => ['vendor.vendorid' => SORT_DESC],
    ];
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
		if(!empty($this->requestdate))
		{
		$rdate=$this->requestdate;
		$res = explode("/", $rdate);
      $changedDate = $res[2]."-".$res[1]."-".$res[0];	
	     $query->andFilterWhere(['productid' => $this->productid,  'quantity' => $this->quantity, 'unitid' => $this->unitid, 'requestdate' =>$changedDate ]);
		}
		
     
        $query->andFilterWhere([ 'requestcode'=> $this->requestcode])
            ->andFilterWhere(['like', 'brandcode', $this->brandcode])
			 ->andFilterWhere(['like', 'productname', $this->product_name])
			  ->andFilterWhere(['like', 'vendor.vendorid', $this->vendorid]);
        return $dataProvider;
    }


 public function returnsearch($params)
    {
    	   $query = Stockrequest::find()->joinwith(['product','vendor'])->groupBy(['requestcode']);
		   $query->andFilterWhere(['stockrequest.is_active'=>0]);
		   
		$session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
		if($role=="Super")
		{
		}
		
		else{ $query->andFilterWhere(['stockrequest.branch_id' =>$companybranchid]);} 
        $dataProvider = new ActiveDataProvider(['query' => $query]);
		$dataProvider->sort->attributes['vendor'] = [
        'asc' => ['vendor.vendorid' => SORT_ASC],
        'desc' => ['vendor.vendorid' => SORT_DESC],
    ];
	
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
		echo $this->vendorid;die;
        $query->andFilterWhere(['productid' => $this->productid,  'quantity' => $this->quantity, 'unitid' => $this->unitid, 'requestdate' => $this->requestdate ]);
        $query->andFilterWhere(['like', 'requestcode', $this->requestcode])
            ->andFilterWhere(['like', 'brandcode', $this->brandcode])
			 ->andFilterWhere(['like', 'productname', $this->product_name])
			  ->andFilterWhere([ 'vendor.vendorid'=>$this->vendorid]);
        return $dataProvider;
		
    }




 public function customsearch($branchid,$requestcode,$vendorid,$fromdate,$todate,$start)
    {
    	  $query = Stockrequest::find()->where(['branch_id'=>$branchid])->andFilterWhere(['requesttype'=>"vendorstock"]);
		  if($vendorid!="")
		   {
		 	    $query->andFilterWhere(['vendorid'=>$vendorid]);
		   }
		   if($requestcode!="")
		   {
		   	$query->andFilterWhere(['requestcode'=>$requestcode]);
		   }
		   
		    if($fromdate!="" && $todate!="")
		   {
			   	$fromdate=date("Y-m-d",strtotime($fromdate));
				$todate=date("Y-m-d",strtotime($todate));
			   	$query->andFilterWhere(['between', 'requestdate',$fromdate,$todate]);
		   }
		    $query-> groupBy(['requestcode'])->orderBy(['updated_on'=>SORT_DESC])->limit($start);
		    $dataProvider = new ActiveDataProvider(['query' => $query]);
            return $dataProvider;
			
			
		
    }









}