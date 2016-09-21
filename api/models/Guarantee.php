<?php
namespace api\models;

use Yii;


/**
 * User model
 *
  * This is the model class for table "{{%product_guarantee}}".

 * @property integer $id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $product_name
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
           [['checkd', 'product_name'], 'string'],
           [['user_name'], 'string', 'max' => 180],
           [['distributor'], 'string', 'max' => 30],
           [['company', 'email'], 'string', 'max' => 100],
           [['project_location'], 'string', 'max' => 250],
           [['phone'], 'string', 'max' => 20],
           [['project_photo'], 'string', 'max' => 150],
       ];
   }

}
