<?php

namespace api\controllers;

use \Yii;
use \api\controllers\BaseController;
use yii\data\ActiveDataProvider;
use \api\models\SignupForm;
use \common\models\LoginForm;

class UserController extends BaseController
{
	public $modelClass = 'common\models\User';
	
	public function actions()
	{
		$actions = parent::actions();
		unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
		return $actions;
	}

	
	public function actionLogin()
	{
		$model = new LoginForm();
		if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {

            return [
            	'auth_key'=>Yii::$app->user->identity->getAuthKey(),
            	'id'=>Yii::$app->user->identity->id,
            	'username'=>Yii::$app->user->identity->username,
            ];

        } else {

        	die(json_encode(['status'=>false, 'error_code'=>400,'message'=>$model->getErrors()]));	
        }
	}
	public function actionSignup()
	{
		$model = new SignupForm();
		if($model->load(Yii::$app->getRequest()->getBodyParams(), ''))
		{
			if ($user = $model->signup()) {

				if (Yii::$app->getUser()->login($user)) {
                    return $user;
                }
			}
			//print_r($model->getErrors());
		}
		
	}
	public function actionLogout()
    {
        Yii::$app->user->logout();
        return [];
    }

	public function actionCreate()
	{
		$model = new $this->modelClass();
		$model->load(Yii::$app->getRequest()->getBodyParams(), '');
		$model->password_hash = Yii::$app->security->generatePasswordHash(Yii::$app->getRequest()->getBodyParams()['password']);	
		$model->auth_key = Yii::$app->security->generateRandomString();
		if (!$model->save())
		{
			Yii::$app->response->statusCode = 400;
		}
		return $model;
	}
	
	
	
	public function actionIndex($page, $pageSize)
	{
		$modelClass = $this->modelClass;		
		return new ActiveDataProvider([
				'query' => $modelClass::find(),
				'pagination' => [
						'pageSize' => $pageSize,
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
