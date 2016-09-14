<?php
namespace api\modules\v1\controllers;
use Yii;
use api\controllers\BaseController;
use api\modules\v1\models\Lampbead;
use api\modules\v1\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\data\ActiveDataProvider;

class LampbeadController extends BaseController
{
	public $modelClass = 'api\modules\v1\models\Lampbead';
	
	
	
	public function actions()
	{
		$actions = parent::actions();
		unset($actions['index'],$actions['create'],$actions['view'],$actions['delete'],$actions['update']);
		return $actions;
	}
	
	public function actionIndex($page=0, $pageSize=0, $where='')
	{
		//获取有库存的灯珠
		if($where=='repertory' && $page==0 && $page==0)
		{
			return Lampbead::find()->where(['>','remaining',0])->all();
		}
		return new ActiveDataProvider([
				'query' => Lampbead::find()->orderBy('id desc'),
				'pagination' => [
						'pageSize' => $pageSize,
				],
		]);
	}
	
	public function actionGetOne()
	{
		return $this->findModel(Yii::$app->request->post()['id']);
	}
	
	public function actionView($id)
	{
		$model = $this->findModel($id);
		$user = User::findOne($model->user_id);
		
		$data = $model->attributes;
		$data['username'] = $user->username;
		
		return $data;
	}
	public function actionCreate()
	{
			
		$model = new $this->modelClass;
		$model->attributes = Yii::$app->request->post();
		$model->lamp_code = $model->attributes['lamp_code'];
		$model->order_no = 'G2G' . date('Ymd') . $model->attributes['lamp_code'];
		$model->username = Yii::$app->user->identity->username;
		$model->remaining = $model->attributes['number'];
		$model->save();
	}
	
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$model->remaining = Yii::$app->request->post()['remaining'];
		$model->order_no = Yii::$app->request->post()['order_no'];
		$model->lamp_code = Yii::$app->request->post()['lamp_code'];
		$model->supplier = Yii::$app->request->post()['supplier'];
		$model->username = Yii::$app->request->post()['username'];
		//print_r($model);die;
		return $model->save();
	}
	
	/* function to find the requested record/model */
	protected function findModel($id)
	{
		if (($model = Lampbead::findOne($id)) !== null) {
			return $model;
		} else {
	
			$this->setHeader(400);
			echo json_encode(array('status'=>0,'error_code'=>400,'message'=>'Bad request'),JSON_PRETTY_PRINT);
			exit;
		}
	}
}