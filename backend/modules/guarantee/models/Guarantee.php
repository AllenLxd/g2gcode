<?php

namespace app\modules\guarantee\models;

use Yii;

/**
 * This is the model class for table "{{%product_guarantee}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $user_name
 * @property string $product_name
 * @property string $distributor
 * @property integer $warranty
 * @property integer $labor
 * @property integer $quantity
 * @property string $company
 * @property string $project_location
 * @property integer $completion_date
 * @property string $email
 * @property string $phone
 * @property string $project_photo
 * @property string $checkd
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
            [['user_id', 'warranty', 'labor', 'quantity', 'completion_date', 'created_at'], 'integer'],
            [['checkd'], 'string'],
            [['user_name'], 'string', 'max' => 180],
            [['product_name'], 'string', 'max' => 90],
            [['distributor'], 'string', 'max' => 30],
            [['company', 'email'], 'string', 'max' => 100],
            [['project_location'], 'string', 'max' => 250],
            [['phone'], 'string', 'max' => 20],
            [['project_photo'], 'string', 'max' => 150],
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
            'user_name' => Yii::t('app', '用户名'),
            'product_name' => Yii::t('app', '产品名称'),
            'distributor' => Yii::t('app', '分销商'),
            'warranty' => Yii::t('app', '质保'),
            'labor' => Yii::t('app', '劳保'),
            'quantity' => Yii::t('app', '数量'),
            'company' => Yii::t('app', '公司'),
            'project_location' => Yii::t('app', '项目应该地址'),
            'completion_date' => Yii::t('app', '完工时间'),
            'email' => Yii::t('app', '邮箱'),
            'phone' => Yii::t('app', '电话'),
            'project_photo' => Yii::t('app', '项目照片'),
            'checkd' => Yii::t('app', '审核'),
            'created_at' => Yii::t('app', '创建于'),
        ];
    }
}