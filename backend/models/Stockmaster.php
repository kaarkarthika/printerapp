<?php

namespace backend\models;

use Yii;

class Stockmaster extends \yii\db\ActiveRecord
{
   
     public $product_name;
     public $companybranch;
	 public $vendor_name;
	 public $stock_code;
	 public $compositionname;
    public static function tableName()
    {
        return 'stockmaster';
    }

   
    public function rules()
    {
        return [
            [['productid', 'vendorid','compositionid','unitid'], 'required'],
            [['productid', 'vendorid', 'is_active','compositionid','total_no_of_quantity'], 'integer'],
            [['price', 'quantity'], 'number'],
            [['updated_on','manufacturing_date','expiry_date','compositionid','companybranch','brandcode','opening_balance','updated_by', 'updated_ipaddress','serialnumber'], 'safe'],
         
        ];
    }

    public function attributeLabels()
    {
        return [
            'stockid' => 'Stockid',
            'productid' => 'Product',
            'vendorid' => 'Vendor',
            'brandcode' => 'Brand',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'manufacturin_date'=>'Manufacturing Date',
            'expiry_date'=>'Expiry Date',
            'serialnumber'=>'Serial No',
            'is_active' => 'Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
            'opening_balance'=>'Opening Balance',
            'stockcode'=>'StockCode',
            'compositionname'=>'Composition',
            'branch_id'=>'Branch Name',
            'companybranch'=>'Branch',
            'stock_code'=>'StockCode'
        ];
    }
	
	public function afterFind() {
		
		
		if(isset($this->product)){
         $this->product_name = $this->product->productname;
		
		 }
		 else{
		 	$this->product_name ="Not Available";
			 
		 }
		 
		 if(isset($this->vendor)>0){
         $this->vendor_name = $this->vendor->vendorname;
		
		 }
		 else{
		 	$this->vendor_name ="Not Available";
			 
		 }
		
		 
		if($this->updated_on!="0000-00-00 00:00:00"){
			$this->updated_on=date('d-m-Y H:i:s',strtotime($this->updated_on));
		}
		$this->stock_code=$this->product->product_code;
		 $this->companybranch=$this->company->branch_name;
		  $this->compositionname=$this->composition->composition_name;
		  
		
		
	 parent::afterFind();	
	}
	
	 public function getProduct()
    {
         return $this->hasOne(Product::className(), ['productid' => 'productid']);
    }
	
	
	
	 public function getVendor()
    {
         return $this->hasOne(Vendor::className(), ['vendorid' => 'vendorid']);
    }
	
	public function getProductgrouping()
    {
         return $this->hasOne(Productgrouping::className(), ['productgroupid' => 'productgroupid']);
    }
	
     public function getCompany()
    {
         return $this->hasOne(CompanyBranch::className(), ['branch_id' => 'branch_id']);
    }
	
	 public function getStockresponse()
    {
         return $this->hasOne(Stockresponse::className(), ['stockid' => 'stockid']);
    }
	public function getComposition()
    {
         return $this->hasOne(Composition::className(), ['composition_id' => 'compositionid']);
    }
	
}