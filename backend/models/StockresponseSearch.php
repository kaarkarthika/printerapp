<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Stockresponse;
class StockresponseSearch extends Stockresponse
{
   
    public function rules()
    {
        return [
            [['stockresponseid', 'stockrequestid', 'stockid', 'receivedquantity', 'receivedfreequantity','updated_by'], 'integer'],
            [[ 'receiveddate', 'manufacturedate', 'purchasedate', 'sales_status', 'updated_on'], 'safe'],
            [['purchaseprice', 'priceperquantity','discountpercent','discountvalue','gstpercent','gstvalue','cgstpercent','cgstvalue','sgstpercent','sgstvalue'
            ,'igstpercent','igstvalue','mrp'], 'number'],
        ];
    }

  
    public function scenarios()
    {
       
        return Model::scenarios();
    }

 
    public function search($params)
    {
    	
        $query = Stockresponse::find()->joinwith(['stockbrandcode'])->orderBy(['stockrequestid'=>SORT_DESC]);
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

        $this->load($params);

        if (!$this->validate()) {
           
            return $dataProvider;
        }
		
		 $requestcode="";$vendorid="";$requestdate="";
		 
if(isset($_GET['StockresponseSearch']['request_code']) && ($_GET['StockresponseSearch']['request_code']!="")){
	$requestcode=$_GET['StockresponseSearch']['request_code'];
} 


if($requestcode)
{
	$query->andFilterWhere([
            'request_code'=>$requestcode]);
}
else{
	$query->andFilterWhere([
            'request_code'=>$this->request_code,]);
}

        $query->andFilterWhere([
            'stockresponseid' => $this->stockresponseid,
            'stockrequestid' => $this->stockrequestid,
            'request_code'=>$this->request_code,
            'stockid' => $this->stockid,
              'stockcode' => $this->stockcode,
            'receivedquantity' => $this->receivedquantity,
            'receiveddate' => $this->receiveddate,
            'purchaseprice' => $this->purchaseprice,
            'priceperquantity' => $this->priceperquantity,
            'manufacturedate' => $this->manufacturedate,
            'expiredate' => $this->expiredate,
            'purchasedate' => $this->purchasedate,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere([ 'stockresponse.batchnumber'=>$this->batchnumber])
            ->andFilterWhere(['like', 'sales_status', $this->sales_status])
			->andFilterWhere(['like', 'unitid', $this->unitid])
            ->andFilterWhere(['like', 'updated_ipaddress', $this->updated_ipaddress]);

        return $dataProvider;
    }

    public function stocksearch($params)
    {
        	
		$branchid=""; 
	if(isset($_GET['StockresponseSearch']['branch_id']) && ($_GET['StockresponseSearch']['branch_id']!="")){
		$branchid=$_GET['StockresponseSearch']['branch_id'];
			
		}
if(isset($_GET['StockresponseSearch']['productname']) && ($_GET['StockresponseSearch']['productname']!="")){
$productname=$_GET['StockresponseSearch']['productname'];
	
} 
else {$productname=$this->productname;}




			
if(isset($_GET['StockresponseSearch']['vendorname']) && ($_GET['StockresponseSearch']['vendorname']!="")){
	$vendorname=$_GET['StockresponseSearch']['vendorname'];
} 
else {
	$vendorname=$this->vendorname;
}
 
	
		
			
        $query = Stockresponse::find()->joinwith(['stockbrandcode'])->orderBy(['stockid'=>SORT_ASC,'stockrequestid'=>SORT_DESC]);
		 	 $session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
		
		
	
		if(!empty($branchid))
		{
			 $query->andFilterWhere(['stockresponse.branch_id' =>$branchid]);
		}
		else if($role=="Super")
		{
			
		}
		else{
			  $query->andFilterWhere(['stockresponse.branch_id' =>$companybranchid]);
			
		} 
		

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
           
            return $dataProvider;
        }
		
	

        $query->andFilterWhere([
            'stockresponseid' => $this->stockresponseid,
            'stockrequestid' => $this->stockrequestid,
          
            'stockid' => $this->stockid,
            'receivedquantity' => $this->receivedquantity,
            'receiveddate' => $this->receiveddate,
            'purchaseprice' => $this->purchaseprice,
            'priceperquantity' => $this->priceperquantity,
            'purchasedate' => $this->purchasedate,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
           'stockmaster.productid' => $productname,
            'stockmaster.vendorid' => $vendorname,
             'stockmaster.compositionid' => $this->compositionname,
            
            
        ]);
		$query->andFilterWhere(["LIKE",'stockmaster.brandcode',$this->brandcode]);
		$query->andFilterWhere(["LIKE",'stockmaster.stockcode',$this->stockcode]);

        $query->andFilterWhere(['like', 'stockresponse.batchnumber', $this->batchnumber])
            ->andFilterWhere(['like', 'sales_status', $this->sales_status])
			->andFilterWhere(['like', 'stockresponse.unitid', $this->unitid])
			->andFilterWhere(['like', 'stockresponse.branch_id', $this->companybranch]);
			
			
				if(!empty($this->expiredate) && !empty($this->manufacturedate))
	{
		$f=$this->expiredate;
		$t=$this->manufacturedate;
		
	  $fromdate=date("Y-m-d",strtotime($f));
	  $todate=date("Y-m-d",strtotime($t));
	   $query->andFilterWhere(['between', 'stockresponse.expiredate',$fromdate, $todate]);
	}
        return $dataProvider;
    }


         public function customstocksearch($params,$insuranceid)
    {
      	
        $query = Stockresponse::find()->joinwith(['stockbrandcode'])->orderBy(['stockid'=>SORT_ASC,'stockrequestid'=>SORT_DESC]);
		$session = Yii::$app->session;
		$role=$session['authUserRole'];
		$companybranchid=$session['branch_id'];
		if($role=="Super")
		{
			
		}
		else{
			  $query->andFilterWhere(['stockresponse.branch_id' =>$companybranchid]);
		} 
		
	
		if($insuranceid==3)
		{
			$query->orderBy(['mrpperunit'=>SORT_DESC]);
		}


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
           
            return $dataProvider;
        }

        $query->andFilterWhere([
            'stockresponseid' => $this->stockresponseid,
            'stockrequestid' => $this->stockrequestid,
            'stockid' => $this->stockid,
            'receivedquantity' => $this->receivedquantity,
            'receiveddate' => $this->receiveddate,
            'purchaseprice' => $this->purchaseprice,
            'priceperquantity' => $this->priceperquantity,
            'purchasedate' => $this->purchasedate,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
            'stockmaster.productid' => $this->productname,
            'stockmaster.vendorid' => $this->vendorname,
             'stockmaster.compositionid' => $this->compositionname,
               'sales_status' => 0,
            
        ]);
		$query->andFilterWhere(["LIKE",'stockmaster.brandcode',$this->brandcode]);
		$query->andFilterWhere(["LIKE",'stockmaster.stockcode',$this->stockcode]);

        $query->andFilterWhere(['like', 'stockresponse.batchnumber', $this->batchnumber])
            ->andFilterWhere(['like', 'sales_status', $this->sales_status])
			->andFilterWhere(['like', 'stockresponse.unitid', $this->unitid]);
			
				if(!empty($this->expiredate) && !empty($this->manufacturedate))
	{
		$f=$this->expiredate;
		$t=$this->manufacturedate;
		
	  $fromdate=date("Y-m-d",strtotime($f));
	  $todate=date("Y-m-d",strtotime($t));
	   $query->andFilterWhere(['between', 'stockresponse.expiredate',$fromdate, $todate]);
	}
        return $dataProvider;
    }







         public function customstocksearch_np($params)
    {
      	
        $query = Stockresponse::find()->joinwith(['stockbrandcode'])->orderBy(['stockid'=>SORT_ASC,'stockrequestid'=>SORT_DESC]);
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
            'pagination'=>false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
           
            return $dataProvider;
        }

        $query->andFilterWhere([
            'stockresponseid' => $this->stockresponseid,
            'stockrequestid' => $this->stockrequestid,
            'stockid' => $this->stockid,
           
            'receivedquantity' => $this->receivedquantity,
            'receiveddate' => $this->receiveddate,
            'purchaseprice' => $this->purchaseprice,
            'priceperquantity' => $this->priceperquantity,
            'purchasedate' => $this->purchasedate,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
            'stockbrandcode.productid' => $this->productname,
            'stockbrandcode.vendorid' => $this->vendorname,
             'stockbrandcode.compositionid' => $this->compositionname,
            
        ]);
		$query->andFilterWhere(["LIKE",'stockbrandcode.brandcode',$this->brandcode]);
		$query->andFilterWhere(["LIKE",'stockbrandcode.stockcode',$this->stockcode]);

        $query->andFilterWhere(['like', 'stockresponse.batchnumber', $this->batchnumber])
            ->andFilterWhere(['like', 'sales_status', $this->sales_status])
			->andFilterWhere(['like', 'stockresponse.unitid', $this->unitid]);
			
				if(!empty($this->expiredate) && !empty($this->manufacturedate))
	{
		$f=$this->expiredate;
		$t=$this->manufacturedate;
		
	  $fromdate=date("Y-m-d",strtotime($f));
	  $todate=date("Y-m-d",strtotime($t));
	   $query->andFilterWhere(['between', 'stockresponse.expiredate',$fromdate, $todate]);
	}
        return $dataProvider;
    }













    public function stockapisearch($params,$branchid,$stockcode)
    {
        
        $query = Stockresponse::find()->joinwith(['stockbrandcode'])->orderBy(['stockid'=>SORT_ASC,'stockrequestid'=>SORT_DESC]);
		if(!empty($branchid))
		{
			  $query->andFilterWhere(['stockresponse.branch_id'=>$branchid]);
		} 
        $dataProvider = new ActiveDataProvider(['query'=>$query,'pagination'=>false]);
        
		$query->andFilterWhere(["LIKE",'stockmaster.stockcode',$stockcode]);
        return $dataProvider;
    }
	  



}