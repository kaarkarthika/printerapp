<?php
namespace backend\models;
use Yii;
class InvoicePayment extends \yii\db\ActiveRecord
{
   
    public static function tableName()
    {
        return 'invoice_payment';
    }

  
    public function rules()
    {
        return [
       
            [['branchid', 'saleid'], 'integer'],
            [['paymentamount'], 'number'],
            [['timestamp', 'updated_timestamp'], 'safe'],
            [['paymentmethod', 'invoicenumber', 'cardtype', 'cardholdername', 'referencenumber'], 'string', 'max' => 255],
        ];
    }

  
    public function attributeLabels()
    {
        return [
            'invoicepaymentid' => Yii::t('app', 'Invoicepaymentid'),
            'branchid' => Yii::t('app', 'Branchid'),
            'saleid' => Yii::t('app', 'Saleid'),
            'paymentmethod' => Yii::t('app', 'Paymentmethod'),
            'invoicenumber' => Yii::t('app', 'Invoicenumber'),
            'paymentamount' => Yii::t('app', 'Paymentamount'),
            'cardtype' => Yii::t('app', 'Cardtype'),
            'cardholdername' => Yii::t('app', 'Cardholdername'),
            'referencenumber' => Yii::t('app', 'Referencenumber'),
            'timestamp' => Yii::t('app', 'Timestamp'),
            'updated_timestamp' => Yii::t('app', 'Updated Timestamp'),
        ];
    }


         public function getBranch()
			{
			        return $this->hasOne(CompanyBranch::className(), ['branch_id' => 'branchid']);
			}

 public function getPaymentmethod1()
			{
			        return $this->hasOne(Paymentmethod::className(), ['pm_autoid' => 'paymentmethod']);
			}
}
