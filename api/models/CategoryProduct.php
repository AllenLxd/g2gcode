<?php
namespace api\models;

use Yii;


class CategoryProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_category}}';
    }

    /**
    * @inheritdoc
    */


}
