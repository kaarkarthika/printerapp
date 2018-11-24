<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property integer $invoiceid
 * @property string $receipt_number
 * @property integer $patient_type
 * @property integer $payment_type
 * @property string $invoicenumber
 * @property double $tax
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['receipt_number', 'patient_type', 'payment_type', 'invoicenumber', 'tax'], 'required'],
            [['patient_type', 'payment_type'], 'integer'],
            [['tax'], 'number'],
            [['receipt_number'], 'string', 'max' => 20],
            [['invoicenumber'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'invoiceid' => 'Invoiceid',
            'receipt_number' => 'Receipt Number',
            'patient_type' => 'Patient Type',
            'payment_type' => 'Payment Type',
            'invoicenumber' => 'Invoice Number',
            'tax' => 'Tax',
        ];
    }
}
