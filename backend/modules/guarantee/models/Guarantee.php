<?php

namespace app\modules\guarantee\models;

use Yii;

/**
 * This is the model class for table "{{%product_guarantee}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $product_id
 * @property string $checkd
 * @property string $buyer_name
 * @property string $buy_by
 * @property string $state
 * @property string $city
 * @property string $street
 * @property integer $complete_at
 * @property integer $created_at
 */
class Guarantee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_guarantee}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'complete_at', 'created_at'], 'integer'],
            [['checkd', 'buy_by'], 'required'],
            [['checkd'], 'string'],
            [['user_name', 'buyer_name'], 'string', 'max' => 180],
            [['buy_by'], 'string', 'max' => 60],
            [['state', 'city'], 'string', 'max' => 150],
            [['street'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'user_name' => Yii::t('app', 'User Name'),
            'product_id' => Yii::t('app', 'Product ID'),
            'checkd' => Yii::t('app', 'Checkd'),
            'buyer_name' => Yii::t('app', 'Buyer Name'),
            'buy_by' => Yii::t('app', '哪里购买（哪个分销商）'),
            'state' => Yii::t('app', 'State'),
            'city' => Yii::t('app', 'City'),
            'street' => Yii::t('app', 'Street'),
            'complete_at' => Yii::t('app', '完工时间'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
