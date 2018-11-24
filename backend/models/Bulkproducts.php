<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bulkproducts".
 *
 * @property string $bulkproductid
 * @property string $bulkproductname
 * @property string $productidz
 * @property string $productnamez
 * @property string $created_at
 * @property string $updated_on
 * @property integer $updated_by
 * @property integer $status
 */
class Bulkproducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bulkproducts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bulkproductname', 'productidz', 'productnamez', 'created_at', 'updated_on', 'updated_by', 'status'], 'required'],
            [['bulkproductname',  'productnamez'], 'string'],
            [['created_at', 'updated_on'], 'safe'],
            [['updated_by', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bulkproductid' => Yii::t('app', 'Bulkproductid'),
            'bulkproductname' => Yii::t('app', 'Group product '),
            'productidz' => Yii::t('app', ' Choose Product List'),
            'productnamez' => Yii::t('app', 'Productnamez'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
