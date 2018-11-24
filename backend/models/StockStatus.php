<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "stock_status".
 *
 * @property integer $stock_statusid
 * @property string $stock_statustype
 * @property integer $is_active
 * @property integer $updated_by
 * @property string $updated_on
 * @property string $updated_ipaddress
 */
class StockStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stock_statustype', 'is_active', 'updated_by', 'updated_on', 'updated_ipaddress'], 'required'],
            [['is_active', 'updated_by'], 'integer'],
            [['updated_on'], 'safe'],
            [['stock_statustype', 'updated_ipaddress'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stock_statusid' => Yii::t('app', 'Stock Statusid'),
            'stock_statustype' => Yii::t('app', 'Stock Statustype'),
            'is_active' => Yii::t('app', 'Is Active'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_ipaddress' => Yii::t('app', 'Updated Ipaddress'),
        ];
    }
}
