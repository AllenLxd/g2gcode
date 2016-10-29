<?php

namespace api\controllers;

use \Yii;
use \api\controllers\BaseController;
use yii\data\ActiveDataProvider;

class CategoryProductController extends BaseController
{
	public $modelClass = 'api\models\CategoryProduct';

	public function actions()
	{
		$actions = parent::actions();
		unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
		return $actions;
	}

	public function actionIndex()
	{
		$modelClass = $this->modelClass;
		$model = $modelClass::find()->indexBy('id')->asArray()->all();

        $tree = array();
        foreach($model as $item){
            if(isset($model[$item['parent']])){
                $model[$item['parent']]['son'][] = &$model[$item['id']];
            }else{
                $tree[] = &$model[$item['id']];
            }
        }
        return $tree;
	}

	public function actionView($id)
	{
		$modelClass = $this->modelClass;
		return $modelClass::find()->select(['username','email','telephone','created_at'])->where(['id'=>$id])->one();
	}

	protected function findModel($id)
	{
		$modelClass = $this->modelClass;
		if (($model = $modelClass::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function checkAccess($action, $model = null, $params = [])
	{

	}


}
