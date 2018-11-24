<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Stockmaster;
use backend\models\BranchAdmin;

/**
 * StockmasterSearch represents the model behind the search form about `backend\models\Stockmaster`.
 */
class StockmasterSearch extends Stockmaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
	   [['stockid', 'productid', 'branch_id','vendorid', 'compositionid', 'is_active','unitid','total_no_of_quantity'], 'integer'],
        [['brandcode','vendor_name','product_name','branch_id','productid','compositionname','compositionid','stockcode', 'brandcode','companybranch','updated_by','serialnumber' ,'updated_on', 'updated_ipaddress'], 'safe'],
          
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
        $query = Stockmaster::find()->joinwith(['product','vendor','productgrouping']);
        $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
		
		if(isset($_GET['StockmasterSearch']['branch_id']) && ($_GET['StockmasterSearch']['branch_id']!=""))
		{$branchid=$_GET['StockmasterSearch']['branch_id'];} 
	
		if($role=="Super")
		{
			$query->andFilterWhere(['stockmaster.branch_id' =>$branchid]);
		}
		else{
			  $query->andFilterWhere(['branch_id' =>$companybranchid]);
		} 
      
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		$dataProvider->sort->attributes['vendor'] = [
       
        'asc' => ['vendor.vendorid' => SORT_ASC],
        'desc' => ['vendor.vendorid' => SORT_DESC],
    ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

       
        $query->andFilterWhere([
            'stockid' => $this->stockid,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'is_active' => $this->is_active,
            'updated_on' => $this->updated_on,
            'serialnumber' => $this->serialnumber,
             'compositionid'=>$this->compositionid,
           
        ]);

        $query
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
			->andFilterWhere(['like', 'product.stock_code', $this->stock_code])
			->andFilterWhere(['like','productgrouping.brandcode',$this->brandcode])
			->andFilterWhere([ 'vendor.vendorid'=>$this->vendorid])
		
			->andFilterWhere(['product.productid'=>$this->productid])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);
 
        return $dataProvider;
    }


public function auditsearch($params)
    {
        $query = Stockmaster::find()->joinwith(['product','vendor','productgrouping','stockresponse']);
        $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
		
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
		if($role=="Super")
		{
			
		}
		else{
			  $query->andFilterWhere(['stockmaster.branch_id' =>$companybranchid]);
		} 
        $query->andFilterWhere([
            'stockid' => $this->stockid,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'is_active' => $this->is_active,
            'updated_on' => $this->updated_on,
            'serialnumber' => $this->serialnumber,
          'compositionid'=>$this->compositionid,
            
        ]);
	
	if(!empty($this->updated_ipaddress))
	{
		$daterange=explode("-",$this->updated_ipaddress);
	  $fromdate=date("Y-m-d",strtotime($daterange[0]));
	  $todate=date("Y-m-d",strtotime($daterange[1]));
	   $query->andFilterWhere(['between', 'stockresponse.expiredate',$fromdate, $todate]);
	}
	 
	
        $query
			  ->andFilterWhere(['like', 'productgrouping.stock_code', trim($this->stock_code)])
			  ->andFilterWhere(['like','productgrouping.brandcode',trim($this->brandcode)])
			
	          ->andFilterWhere([ 'vendorid'=>$this->vendorid])
		
	          ->andFilterWhere(['productid'=>$this->productid]);
			  
			
			  
            
        return $dataProvider;
    }


    public function stocksearch($params)
    {
    	
       $query = Stockmaster::find()->select(['*'])->joinwith(['stockresponse']);
	   
	  
        $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
	
		if($role=="Super")
		{
			
		}
		else{
			  $query->andFilterWhere(['stockresponse.branch_id' =>$companybranchid]);
			
		} 
      
		
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		$dataProvider->sort->attributes['vendor'] = [
       
        'asc' => ['vendor.vendorid' => SORT_ASC],
        'desc' => ['vendor.vendorid' => SORT_DESC],
    ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

       
        $query->andFilterWhere([
            'stockid' => $this->stockid,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'is_active' => $this->is_active,
            'updated_on' => $this->updated_on,
            'serialnumber' => $this->serialnumber,
             'compositionid'=>$this->compositionid,
             'productid'=>$this->productid,
             'vendorid'=>$this->vendorid,
             'brandcode'=>trim($this->brandcode),
              'stockcode'=>trim($this->stockcode),
           
        ]);
		
		
		if(!empty($this->updated_ipaddress))
	{
		$exp=$this->updated_ipaddress;
		$daterange=explode("-",$exp);
	  $fromdate=date("Y-m-d",strtotime($daterange[0]));
	  $todate=date("Y-m-d",strtotime($daterange[1]));
	   $query->andFilterWhere(['between', 'stockresponse.expiredate',$fromdate, $todate]);
	}

		
           
 
        return $dataProvider;
    }




}