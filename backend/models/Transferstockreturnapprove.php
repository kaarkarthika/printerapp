<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transferstockreturnapprove".
 *
 * @property integer $transferstockreturnapproveid
 * @property integer $transferstockid
 * @property integer $stockid_frombranch
 * @property string $transferstock_requestcode
 * @property integer $transferstockreturnid
 * @property string $batchnumber
 * @property integer $returnquantity
 * @property integer $unit
 * @property double $pricepertransferstock
 * @property string $returndate
 * @property double $priceperquantity
 * @property integer $total_no_of_quantity
 * @property string $manufacturedate
 * @property string $expiredate
 * @property string $purchasedate
 * @property integer $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Transferstockreturnapprove extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transferstockreturnapprove';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transferstockid', 'stockid_frombranch', 'transferstock_requestcode', 'transferstockreturnid', 'batchnumber', 'returnquantity', 'unit', 'pricepertransferstock', 'returndate', 'priceperquantity', 'total_no_of_quantity', 'manufacturedate', 'expiredate', 'purchasedate', 'updated_by', 'updated_on', 'updated_ipaddress'], 'required'],
            [['transferstockid', 'stockid_frombranch', 'transferstockreturnid', 'returnquantity', 'unit', 'total_no_of_quantity', 'updated_by'], 'integer'],
            [['pricepertransferstock', 'priceperquantity'], 'number'],
            [['returndate', 'manufacturedate', 'expiredate', 'purchasedate', 'updated_on'], 'safe'],
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
            'transferstockreturnapproveid' => Yii::t('app', 'Transferstockreturnapproveid'),
            'transferstockid' => Yii::t('app', 'Transferstockid'),
            'stockid_frombranch' => Yii::t('app', 'Stockid Frombranch'),
            'transferstock_requestcode' => Yii::t('app', 'Transferstock Requestcode'),
            'transferstockreturnid' => Yii::t('app', 'Transferstockreturnid'),
            'batchnumber' => Yii::t('app', 'Batchnumber'),
            'returnquantity' => Yii::t('app', 'Returnquantity'),
            'unit' => Yii::t('app', 'Unit'),
            'pricepertransferstock' => Yii::t('app', 'Pricepertransferstock'),
            'returndate' => Yii::t('app', 'Returndate'),
            'priceperquantity' => Yii::t('app', 'Priceperquantity'),
            'total_no_of_quantity' => Yii::t('app', 'Total No Of Quantity'),
            'manufacturedate' => Yii::t('app', 'Manufacturedate'),
            'expiredate' => Yii::t('app', 'Expiredate'),
            'purchasedate' => Yii::t('app', 'Purchasedate'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_ipaddress' => Yii::t('app', 'Updated Ipaddress'),
        ];
    }
}
