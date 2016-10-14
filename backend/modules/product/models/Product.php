<?php

namespace app\modules\product\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $pic
 * @property integer $guarantee_time
 * @property integer $labor_time
 * @property string $supply
 * @property string $video1
 * @property string $video2
 * @property string $video3
 * @property string $video4
 * @property string $content
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $category2_id;
    public $category3_id;

    public static function tableName()
    {
        return '{{%product}}';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'supply', 'content'], 'required'],
            [['category_id','category2_id', 'guarantee_time', 'labor_time'], 'integer'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 1000],
            ['pic', 'file', 'extensions' => ['png', 'jpg','jpeg', 'gif'], 'maxSize' => 1024*1024*1],
            [['video1', 'video2', 'video3', 'video4'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', '子分类'),
            'category3_id' => Yii::t('app', '大分类'),
            'name' => Yii::t('app', '产品名称'),
            'pic' => Yii::t('app', '产品图片'),
            'guarantee_time' => Yii::t('app', '质保时间'),
            'labor_time' => Yii::t('app', '劳保时间'),
            'supply' => Yii::t('app', '购买渠道'),
            'video1' => Yii::t('app', '介绍视频地址'),
            'video2' => Yii::t('app', '安装视频地址'),
            'video3' => Yii::t('app', '劳保视频地址'),
            'video4' => Yii::t('app', '购买视频地址'),
            'content' => Yii::t('app', '内容'),
        ];
    }
}
