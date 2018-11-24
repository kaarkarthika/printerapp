<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payment_method".
 *
 * @property string $pm_autoid
 * @property string $methodname
 * @property string $methodkey
 * @property string $refundmode
 * @property string $methodorder
 * @property string $timestamp
 */
class PaymentMethod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        //    [['methodname', 'methodkey', 'refundmode', 'methodorder'], 'required'],
            [['methodorder'], 'integer'],
            [['timestamp'], 'safe'],
            [['methodname', 'methodkey', 'refundmode'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pm_autoid' => Yii::t('app', 'Pm Autoid'),
            'methodname' => Yii::t('app', 'Methodname'),
            'methodkey' => Yii::t('app', 'Methodkey'),
            'refundmode' => Yii::t('app', 'Refundmode'),
            'methodorder' => Yii::t('app', 'Methodorder'),
            'timestamp' => Yii::t('app', 'Timestamp'),
        ];
    }
}
