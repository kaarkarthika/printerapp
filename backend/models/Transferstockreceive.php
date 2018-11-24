<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transferstockreceive".
 *
 * @property integer $transferstockreceiveid
 * @property integer $transferstockid
 * @property string $transferstock_requestcode
 * @property string $batchnumber
 * @property integer $receivedquantity
 * @property integer $total_no_of_quantity
 * @property string $receiveddate
 * @property double $purchaseprice
 * @property double $priceperquantity
 * @property string $manufacturedate
 * @property string $expiredate
 * @property string $purchasedate
 * @property integer $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Transferstockreceive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transferstockreceive';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transferstockid', 'transferstock_requestcode', 'batchnumber', 'receivedquantity', 'pricepertransferstock', 'receiveddate',  'priceperquantity', 'manufacturedate', 'expiredate', 'purchasedate', 'updated_by', 'updated_on', 'updated_ipaddress'], 'required'],
            [['transferstockid', 'receivedquantity',  'updated_by'], 'integer'],
            [['receiveddate', 'manufacturedate', 'expiredate','pricepertransferstock', 'purchasedate', 'updated_on'], 'safe'],
            [[ 'priceperquantity'], 'number'],
            [['transferstock_requestcode'], 'string', 'max' => 200],
            [['batchnumber'], 'string', 'max' => 100],
            [['updated_ipaddress'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'transferstockreceiveid' => 'Transferstockreceiveid',
            'transferstockid' => 'Transferstockid',
            'transferstock_requestcode' => 'Transferstock Requestcode',
            'batchnumber' => 'Batchnumber',
            'receivedquantity' => 'Receivedquantity',
         
            'receiveddate' => 'Receiveddate',
          
            'priceperquantity' => 'Priceperquantity',
            'manufacturedate' => 'Manufacturedate',
            'expiredate' => 'Expiredate',
            'purchasedate' => 'Purchasedate',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
