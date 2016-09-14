<?php
namespace api\modules\v1\controllers;
use Yii;
use api\controllers\BaseController;
use api\modules\v1\models\Repertory;
use api\modules\v1\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\data\ActiveDataProvider;
use api\modules\v1\models\Shipping;

class RepertoryController extends BaseController
{
	public $modelClass = 'api\modules\v1\models\Repertory';
	
	
	
	public function actions()
	{
		$actions = parent::actions();
		unset($actions['create'],$actions['index'],$actions['view'],$actions['delete'],$actions['update']);
		return $actions;
	}
	
	public function actionIndex($page, $pageSize)
	{
		$query = Repertory::find()->where(['>','remaining',0]);
		return new ActiveDataProvider([
				'query' => $query->orderBy('id desc'),
				'pagination' => [
						'pageSize' => $pageSize,
				],
		]);		
	}
	
	public function actionGetOne()
	{
		return Repertory::find()->where(['id' => Yii::$app->request->post('id')])->one();
	}
	
	public function actionView($id)
	{
		return Shipping::find()->where(['repertory_id'=>$id])->orderBy('id desc')->all();
	}
	
	
	/* function to find the requested record/model */
	protected function findModel($id)
	{
		if (($model = Repertory::findOne($id)) !== null) {
			return $model;
		} else {
	
			$this->setHeader(400);
			echo json_encode(array('status'=>0,'error_code'=>400,'message'=>'Bad request'),JSON_PRETTY_PRINT);
			exit;
		}
	}
}