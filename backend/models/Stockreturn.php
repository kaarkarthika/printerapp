<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "stockreturn".
 *
 * @property integer $stockreturnid
 * @property integer $stockrequestid
 * @property string $request_code
 * @property integer $stockid
 * @property integer $branch_id
 * @property string $batchnumber
 * @property integer $receivedquantity
 * @property integer $total_no_of_quantity
 * @property integer $unitid
 * @property string $receiveddate
 * @property double $purchaseprice
 * @property double $priceperquantity
 * @property string $manufacturedate
 * @property string $expiredate
 * @property string $purchasedate
 * @property string $stock_status
 * @property string $returndate
 * @property integer $returnquantity
 * @property integer $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class Stockreturn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stockreturn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stockrequestid', 'request_code', 'stockid', 'branch_id', 'batchnumber', 'receivedquantity', 'total_no_of_quantity', 'unitid', 'receiveddate', 'purchaseprice', 'priceperquantity', 'manufacturedate', 'expiredate', 'purchasedate', 'returndate', 'returnquantity', 'updated_by', 'updated_on', 'updated_ipaddress'], 'required'],
            [['stockrequestid', 'stockid', 'branch_id', 'receivedquantity', 'total_no_of_quantity', 'unitid', 'returnquantity', 'updated_by'], 'integer'],
            [['receiveddate', 'manufacturedate', 'expiredate', 'purchasedate', 'returndate', 'updated_on'], 'safe'],
            [['purchaseprice', 'priceperquantity'], 'number'],
            [['request_code'], 'string', 'max' => 200],
            [['batchnumber'], 'string', 'max' => 100],
            [['stock_status'], 'string', 'max' => 10],
            [['updated_ipaddress'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stockreturnid' => Yii::t('app', 'Stockreturnid'),
            'stockrequestid' => Yii::t('app', 'Stockrequestid'),
            'request_code' => Yii::t('app', 'Request Code'),
            'stockid' => Yii::t('app', 'Stockid'),
            'branch_id' => Yii::t('app', 'Branch ID'),
            'batchnumber' => Yii::t('app', 'Batchnumber'),
            'receivedquantity' => Yii::t('app', 'Receivedquantity'),
            'total_no_of_quantity' => Yii::t('app', 'Total No Of Quantity'),
            'unitid' => Yii::t('app', 'Unitid'),
            'receiveddate' => Yii::t('app', 'Receiveddate'),
            'purchaseprice' => Yii::t('app', 'Purchaseprice'),
            'priceperquantity' => Yii::t('app', 'Priceperquantity'),
            'manufacturedate' => Yii::t('app', 'Manufacturedate'),
            'expiredate' => Yii::t('app', 'Expiredate'),
            'purchasedate' => Yii::t('app', 'Purchasedate'),
            'stock_status' => Yii::t('app', 'Stock Status'),
            'returndate' => Yii::t('app', 'Returndate'),
            'returnquantity' => Yii::t('app', 'Returnquantity'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_ipaddress' => Yii::t('app', 'Updated Ipaddress'),
        ];
    }
}
