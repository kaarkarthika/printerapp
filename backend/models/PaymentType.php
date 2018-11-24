<?php
namespace backend\models;
use Yii;
class PaymentType extends \yii\db\ActiveRecord
{
   
    public static function tableName()
    {
        return 'paymenttype';
    }

    public function rules()
    {
        return [
            [['paymenttype', 'is_active', 'updated_by', 'updated_on', 'updated_ipaddress'], 'required'],
            [['is_active', 'updated_by'], 'integer'],
            [['updated_on'], 'safe'],
            [['paymenttype', 'updated_ipaddress'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payment_type_id' => Yii::t('app', 'Payment Type ID'),
            'paymenttype' => Yii::t('app', 'Payment Type'),
            'is_active' => Yii::t('app', 'Active'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_ipaddress' => Yii::t('app', 'Updated Ipaddress'),
        ];
    }
}
