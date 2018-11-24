<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transferstockreturn".
 *
 * @property integer $transferstockreturnid
 * @property integer $transferstockid
 * @property string $transferstock_requestcode
 * @property integer $transferstockreceiveid
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
class Transferstockreturn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transferstockreturn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transferstockid', 'transferstock_requestcode', 'stockid_tobranch','transferstockreceiveid', 'batchnumber', 'returnquantity', 'unit', 'pricepertransferstock', 'returndate', 'priceperquantity', 'total_no_of_quantity', 'manufacturedate', 'expiredate', 'purchasedate', 'updated_by', 'updated_on', 'updated_ipaddress'], 'required'],
            [['transferstockid', 'transferstockreceiveid','stockid_tobranch', 'returnquantity', 'unit', 'total_no_of_quantity', 'updated_by'], 'integer'],
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
            'transferstockreturnid' => Yii::t('app', 'Transferstockreturnid'),
            'transferstockid' => Yii::t('app', 'Transferstockid'),
            'transferstock_requestcode' => Yii::t('app', 'Transferstock Requestcode'),
            'transferstockreceiveid' => Yii::t('app', 'Transferstockreceiveid'),
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
