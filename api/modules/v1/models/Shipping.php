<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "factory".
 *
 * @property string $id
 * @property string $zh_name
 * @property string $en_name
 */
class Shipping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_logs';
    }

    public function getUser()
    {
    	return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'number', 'repertory_id','product_name', 'shipping_type', 'number'], 'required'],
        	[['created_at','number'],'number'],
        	[['order_no'],'string'],
        	['created_at', 'default','value'=>time()],
        ];
    }

    
}
