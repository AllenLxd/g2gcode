<?php

namespace app\modules\product\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $list_img
 * @property string $pro_img
 * @property string $info
 * @property string $content
 * @property integer $created_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'content'], 'required'],
            [['category_id', 'created_at'], 'integer'],
            [['content'], 'string'],
            [['name', 'info'], 'string', 'max' => 1000],
            [['list_img', 'pro_img'], 'string', 'max' => 90],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'name' => Yii::t('app', 'Name'),
            'list_img' => Yii::t('app', '列表图片'),
            'pro_img' => Yii::t('app', '产品图片'),
            'info' => Yii::t('app', '介绍内容'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}