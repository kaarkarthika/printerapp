<?php
namespace backend\models;
use Yii;
use backend\models\Producttype;
use backend\models\BranchAdmin;
class Product extends \yii\db\ActiveRecord
{
    public $producttypename;
	public $active;
	public $compositionname;
	public $hidden1;
	public $tax;
    public static function tableName()
    {
        return 'product';
    }
    public function rules()
    {
        return [
            [['productname', 'product_typeid','minstock','maxstock','reorderlevelstock','composition_id','manufacturer_id','unit','hsn_code'], 'required'],
           
           [['is_active','minstock','maxstock','gst'], 'integer'],
            [['updatedon','sort_description','composition_id','product_code','hsn_code','manufacturer_id','reorderlevelstock','unit','product_typeid', 'updatedby', 'updated_ipaddress','productname','hidden1','gst'], 'safe'],
            [['productname'], 'unique'],
             [['minstock'], 'compare', 'compareAttribute' => 'maxstock', 'operator' => '<=', 'type' => 'number'],
             
			
        ];
    }
    public function attributeLabels()
    {
        return [
            'productid' => 'Product',
            'productname' => 'Product Name',
            'product_typeid' => 'Product Type',
            'is_active' => 'Active',
            'updatedby' => 'Updatedby',
            'updatedon' => 'Updatedon',
            'updated_ipaddress' => 'Updated Ipaddress',
            'sort_description' => 'Short Description',
            'composition_id' => 'Composition',
            'minstock' => 'Minimum Stock',
            'product_code' => 'Product Code',
            'reorderlevelstock' => 'Re Order Level Stock',
            'maxstock' => 'Maximum Stock',
            'manufacturer_id'=>'Manufacturer',
            'hsn_code'=>'HSN Code',
            
        ];
    }
	public function afterFind() {
	 parent::afterFind();	
	}
	 public function getProducttype()
{
        return $this->hasOne(Producttype::className(), ['product_typeid' => 'product_typeid']);
}
 public function getComposition()
{
        return $this->hasOne(Composition::className(), ['composition_id' => 'composition_id']);
}
 public function getProduct()
    {
         return $this->hasOne(Product::className(), ['productid' => 'productid']);
    }

public function getManufacturer()
    {
         return $this->hasOne(Manufacturermaster::className(), ['id' => 'manufacturer_id']);
    }

public function getTaxgroup()
    {
         return $this->hasOne(Taxgrouping::className(), ['taxgroupid' => 'hsn_code']);
    }
	
	public function getTaxgrouphsn()
    {
         return $this->hasOne(TaxgroupingLog::className(), ['taxgroupid' => 'hsn_code']);
    }

}