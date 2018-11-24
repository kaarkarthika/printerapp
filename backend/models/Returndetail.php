<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "returndetail".
 *
 * @property integer $return_detailid
 * @property integer $return_id
 * @property string $returndate
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
class Returndetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
      public $product_name;
	  public $composition_name;
	  public $unitname;
	  public $returninv;
	  public $mrnumber;
    public static function tableName()
    {
        return 'returndetail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['return_id', 'returndate', 'productid', 'stock_code',  'productqty', 'price', 'priceperqty'], 'required'],
            [['return_id', 'productid', 'compositionid', 'unitid', 'productqty', 'is_active', 'updated_by'], 'integer'],
            [['returndate', 'updated_on'], 'safe'],
            [['price', 'priceperqty'], 'number'],
            [['stock_code', 'updated_ipaddress'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'return_detailid' => 'Return Detailid',
            'return_id' => 'Return ID',
            'returndate' => 'Returndate',
            'productid' => 'Productid',
            'stock_code' => 'Stock Code',
            'compositionid' => 'Compositionid',
            'unitid' => 'Unitid',
            'productqty' => 'Productqty',
            'price' => 'Price',
            'priceperqty' => 'Priceperqty',
            'is_active' => 'Is Active',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
            'returninv'=>'Invoice Number',
            'mrnumber'=>'Medical Record Number',
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
		  if(isset($this->salesreturn)){
         $this->returninv = $this->salesreturn->return_invoicenumber;
			  $this->mrnumber=$this->salesreturn->mrnumber;
		
		 }
		 else{
		 	$this->returninv ="Not Available";
			 
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

 public function getSalesreturn()
    {
         return $this->hasOne(Salesreturn::className(), ['return_id' => 'return_id']);
    }
	




}
