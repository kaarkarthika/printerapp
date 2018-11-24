<?php

namespace backend\models;

use Yii;
use backend\models\BranchAdmin;
class Productgrouping extends \yii\db\ActiveRecord
{
   
     public $product_name;
	 public $vendor_name;
	 
    public static function tableName()
    {
        return 'productgrouping';
    }

  
    public function rules()
    {
        return [
            [['productid', 'vendorid'], 'required'],
           // [['productid', 'vendorid', 'is_active'], 'integer'],
            [['updated_on','updated_by','updated_ipaddress','stock_code','brandcode','hsn_code'], 'safe'],
            //[['brandcode'], 'string', 'max' => 50],
          
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'productgroupid' => 'Productgroupid',
            'productid' => 'Product',
            'vendorid' => 'Vendor',
            'is_active' => 'Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
            'brandcode'=>'BrandCode',
            'stock_code'=>'Stock Code',
            'hsn_code' => 'HSN Code',
           
        ];
    }
	
		public function afterFind() {
		
		
		if(isset($this->product)){
         $this->product_name = $this->product->productname;
		
		 }
		 else{
		 	$this->product_name ="Not Available";
			 
		 }
		 
		 if(isset($this->vendor)){
         $this->vendor_name = $this->vendor->vendorname;
		
		 }
		 else{
		 	$this->vendor_name ="Not Available";
			 
		 }
		
       
		 
		 
		 
		 
	
		 
		 $BranchAdmin=BranchAdmin::find()->where(['ba_autoid'=>$this->updated_by]) ->one(); 
		 $this->updated_by = $BranchAdmin->ba_name;
		if($this->updated_on!="0000-00-00 00:00:00"){
			$this->updated_on=date('d-m-Y H:i:s',strtotime($this->updated_on));
		}
		
	 parent::afterFind();	
	}
    
	 public function getProduct()
    {
         return $this->hasOne(Product::className(), ['productid' => 'productid']);
    }
	
	 public function getProduct1()
    {
         return $this->hasOne(Product::className(), ['productid' => 'productid']);
    }
	 public function getVendor()
    {
         return $this->hasOne(Vendor::className(), ['vendorid' => 'vendorid']);
    }
	 
	
}
