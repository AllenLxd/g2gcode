<?php
/**
 * User: 260101081@qq.com
 * Date: 16/10/31 上午8:40
 */
namespace api\controllers;

use api\models\CategoryProduct;

class ProductController extends BaseController
{
    public $modelClass = 'api\models\Product';
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
        return $actions;
    }

    public function actionIndex($cid=0)
    {
        $modelClass = $this->modelClass;
        $categoryInfo = CategoryProduct::findOne($cid);
        if(!$categoryInfo) return [];
        $allChild = CategoryProduct::find()
            ->select(['id'])
            ->where(['root'=>$categoryInfo->id])
            ->andWhere(['>','lft',$categoryInfo->lft])
            ->andWhere(['<','rgt',$categoryInfo->rgt])
            ->indexBy('id')
            ->asArray()
            ->all();
        if(!$allChild) return [];

        return $modelClass::find()->where(['in','category_id',array_keys($allChild)])->andWhere(['status'=>1])->all();
    }

    public function actionView($id)
    {
        $modelClass = $this->modelClass;
        return $modelClass::findOne($id);
    }

    public function checkAccess($action, $model = null, $params = [])
    {

    }
}