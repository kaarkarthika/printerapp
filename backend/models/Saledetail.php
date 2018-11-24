<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "saledetail".
 *
 * @property integer $opsale_detailid
 * @property string $opsaleid
 * @property string $saledate
 * @property integer $productid
 * @property string $stock_code
 * @property integer $compositionid
 * @property integer $unitid
 * @property integer $productqty
 * @property double $price
 * @property double $priceperqty
 * @property integer $is_active
 * @property integer $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Saledetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
        public $product_name,$billnumber,$mrnumber,$composition_name,$unitname;
	
    public static function tableName()
    {
        return 'saledetail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['opsaleid', 'saledate', 'productid', 'stock_code', 'compositionid', 'unitid', 'productqty', 'price', 'priceperqty'], 'required'],
            [['saledate', 'updated_on','discount_type'], 'safe'],
           // [['productid', 'compositionid', 'unitid', 'productqty', 'is_active', 'updated_by'], 'integer'],
            [['price', 'priceperqty'], 'number'],
           // [['opsaleid'], 'string', 'max' => 200],
            [['stock_code', 'updated_ipaddress','discount_type'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'opsale_detailid' => 'Opsale Detail Id',
            'opsaleid' => 'Opsaleid',
            'saledate' => 'Sales Date',
            'productid' => 'Product',
            'stock_code' => 'Stock Code',
            'compositionid' => 'Composition',
            'unitid' => 'Unit',
            'productqty' => 'Quantity',
            'price' => 'Price',
            'billnumber'=>'Invoice',
             'mrnumber'=>'Medical Record Number',
            'priceperqty' => 'Individual Price',
            'is_active' => 'Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
	public function afterFind() {
		
		
		if(isset($this->product)){
         $this->product_name = $this->product->productname;
		
		 }
		 else{
		 	$this->product_name ="Not Available";
			 
		 }
		 
		 if(isset($this->composition)){
         $this->composition_name = $this->composition->composition_name;
		
		 }
		 else{
		 	$this->composition_name ="Not Available";
			 
		 }
		  if(isset($this->unit)){
         $this->unitname = $this->unit->unitvalue;
		
		 }
		 else{
		 	$this->unitname ="Not Available";
			 
		 }
		 if(isset($this->sales)){
         $this->billnumber = $this->sales->billnumber;
			   $this->mrnumber = $this->sales->mrnumber;
		
		 }
		 else{
		 	$this->billnumber ="Not Available";
			 
		 }
		 
		 
		 
		 
		 
		 
	 parent::afterFind();	
	}
    
	 public function getProduct()
    {
         return $this->hasOne(Product::className(), ['productid' => 'productid']);
    }
	
	
	 public function getComposition()
    {
         return $this->hasOne(Composition::className(), ['composition_id' => 'compositionid']);
    }
public function getUnit()
    {
         return $this->hasOne(Unit::className(), ['unitid' => 'unitid']);
    }
 public function getSales()
    {
         return $this->hasOne(Sales::className(), ['opsaleid' => 'opsaleid']);
    }
	
	
}
