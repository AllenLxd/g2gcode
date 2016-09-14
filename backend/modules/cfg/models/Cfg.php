<?php

namespace app\modules\cfg\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property string $id
 * @property string $site_url
 * @property string $site_name
 * @property string $site_logo
 * @property string $logo_alt
 * @property string $mail_form
 * @property string $mail_address
 * @property string $mail_username
 * @property string $mail_userpass
 * @property string $mail_name
 * @property string $google_map_lat
 * @property string $google_map_lng
 */
class Cfg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'name', 'logo','qq', 'tel', 'fax', 'email', 'wechat', 'address'], 'required'],
        	['logo', 'file', 'extensions' => ['png', 'jpg','jpeg', 'gif'], 'maxSize' => 1024*1024*2],
        	['logo', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => '网站网址',
            'name' => '网站全称',
            'logo' => '网站LOGO',
            'qq' => 'QQ',
            'tel' => '联系电话',
            'fax' => '传真',
            'email' => '邮箱',
            'wechat' => '微信',
            'address' => '地址',
        ];
    }
}
