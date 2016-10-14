<?php

namespace app\modules\cfg\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property integer $id
 * @property string $url
 * @property string $name
 * @property string $logo
 * @property string $tel
 * @property string $fax
 * @property string $estimate_email
 * @property string $accounting_email
 * @property string $tech_support_email
 * @property string $customer_service_email
 * @property string $address
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
            [['url', 'name', 'tel', 'fax', 'address'], 'required'],
            [['url', 'name', 'tel'], 'string', 'max' => 100],
            [['logo', 'address'], 'string', 'max' => 150],
            [['fax'], 'string', 'max' => 50],
            [['estimate_email', 'accounting_email', 'tech_support_email', 'customer_service_email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'name' => Yii::t('app', 'Name'),
            'logo' => Yii::t('app', 'Logo'),
            'tel' => Yii::t('app', 'Tel'),
            'fax' => Yii::t('app', 'Fax'),
            'estimate_email' => Yii::t('app', 'Estimate Email'),
            'accounting_email' => Yii::t('app', 'Accounting Email'),
            'tech_support_email' => Yii::t('app', 'Tech Support Email'),
            'customer_service_email' => Yii::t('app', 'Customer Service Email'),
            'address' => Yii::t('app', 'Address'),
        ];
    }
}
