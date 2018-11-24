<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "invoicereturn_payment".
 *
 * @property integer $invoicepaymentreturnid
 * @property integer $branchid
 * @property integer $returnid
 * @property string $patientname
 * @property integer $patient_mobilenumber
 * @property string $mrnumber
 * @property string $return_reason
 * @property string $referencenumber
 * @property string $paymentmethod
 * @property string $invoicenumber
 * @property double $paymentamount
 * @property string $timestamp
 * @property string $updated_timestamp
 */
class InvoicereturnPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoicereturn_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branchid', 'returnid', 'patientname', 'patient_mobilenumber', 'mrnumber', 'referencenumber', 'paymentmethod', 'invoicenumber', 'paymentamount', 'timestamp'], 'required'],
            [['branchid', 'returnid', 'patient_mobilenumber'], 'integer'],
            [['paymentamount'], 'number'],
            [['timestamp', 'updated_timestamp'], 'safe'],
            [['patientname', 'referencenumber'], 'string', 'max' => 100],
            [['mrnumber', 'return_reason', 'paymentmethod', 'invoicenumber'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'invoicepaymentreturnid' => Yii::t('app', 'Invoicepaymentreturnid'),
            'branchid' => Yii::t('app', 'Branchid'),
            'returnid' => Yii::t('app', 'Returnid'),
            'patientname' => Yii::t('app', 'Patientname'),
            'patient_mobilenumber' => Yii::t('app', 'Patient Mobilenumber'),
            'mrnumber' => Yii::t('app', 'Mrnumber'),
            'return_reason' => Yii::t('app', 'Return Reason'),
            'referencenumber' => Yii::t('app', 'Referencenumber'),
            'paymentmethod' => Yii::t('app', 'Paymentmethod'),
            'invoicenumber' => Yii::t('app', 'Invoicenumber'),
            'paymentamount' => Yii::t('app', 'Paymentamount'),
            'timestamp' => Yii::t('app', 'Timestamp'),
            'updated_timestamp' => Yii::t('app', 'Updated Timestamp'),
        ];
    }
    public function getBranch()
			{
			        return $this->hasOne(CompanyBranch::className(), ['branch_id' => 'branchid']);
			}

}
