<?php

namespace api\modules\v1\models;

use \Yii;


class ProductModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_model}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_name','lamp_number','wastage_rate'], 'required'],
        	[['ic','ic_number','ic_wastage_rate'],'safe']
        ];
    }


}
