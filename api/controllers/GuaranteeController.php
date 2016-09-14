<?php

namespace api\controllers;

use \Yii;
use \api\controllers\BaseController;
use yii\data\ActiveDataProvider;

class GuaranteeController extends BaseController
{
	public $modelClass = 'api\models\Guarantee';

	public function actions()
	{
		$actions = parent::actions();
		unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
		return $actions;
	}

	public function actionCreate()
	{
		$model = new $this->modelClass();
		$data = Yii::$app->getRequest()->getBodyParams();
		$model->load($data, '');
		$model->completion_date = strtotime($data['date']);

		$model->user_id = Yii::$app->user->identity->id;
		$model->user_name = Yii::$app->user->identity->username;

		if (!$model->save())
		{
			Yii::$app->response->statusCode = 400;
		}
		return $model;
	}



	public function actionIndex()
	{
		$modelClass = $this->modelClass;
		return new ActiveDataProvider([
				'query' => $modelClass::find()->where(['user_id'=>Yii::$app->user->identity->id]),
				'pagination' => [
						'pageSize' => 30,
						],
				]);

	}

	public function actionView($id)
	{
		$modelClass = $this->modelClass;
		return $modelClass::find()->select(['username','email','telephone','created_at'])->where(['id'=>$id])->one();
	}

	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$data = Yii::$app->request->post();
		if(isset($data['password']))
		{
			$data['password_hash'] = Yii::$app->security->generatePasswordHash($data['password']);
			unset($data['password']);
		}
		$model->attributes = $data;
		if (!$model->save())
		{
			return $model->getFirstErrors()[0];
		}
		return $model;
	}

	public function actionDelete($id)
	{
		return $this->findModel($id)->delete();
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
