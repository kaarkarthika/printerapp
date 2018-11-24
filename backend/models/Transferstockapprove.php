<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transferstockapprove".
 *
 * @property integer $transferstockapproveid
 * @property integer $transferstockid
 * @property string $transferstock_requestcode
 * @property string $approveddate
 * @property string $batchnumber
 * @property string $manufacturedate
 * @property string $expiredate
 * @property string $purchasedate
 * @property integer $approvedquantity
 * @property double $priceperquantity
 * @property double $pricepertransferstock
 * @property integer $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Transferstockapprove extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transferstockapprove';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transferstockid', 'transferstock_requestcode', 'approveddate', 'batchnumber', 'manufacturedate', 'expiredate', 'purchasedate', 'approvedquantity', 'priceperquantity', 'pricepertransferstock', 'updated_by', 'updated_on', 'updated_ipaddress'], 'required'],
            [['transferstockid', 'approvedquantity', 'updated_by'], 'integer'],
            [['approveddate', 'manufacturedate', 'expiredate', 'purchasedate', 'updated_on'], 'safe'],
            [['priceperquantity', 'pricepertransferstock'], 'number'],
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
            'transferstockapproveid' => 'Transferstockapproveid',
            'transferstockid' => 'Transferstockid',
            'transferstock_requestcode' => 'Transferstock Requestcode',
            'approveddate' => 'Approveddate',
            'batchnumber' => 'Batchnumber',
            'manufacturedate' => 'Manufacturedate',
            'expiredate' => 'Expiredate',
            'purchasedate' => 'Purchasedate',
            'approvedquantity' => 'Approvedquantity',
            'priceperquantity' => 'Priceperquantity',
            'pricepertransferstock' => 'Pricepertransferstock',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'updated_ipaddress' => 'Updated Ipaddress',
        ];
    }
}
