<?php
namespace api\modules\v1\controllers;
use Yii;
use api\controllers\BaseController;
use api\modules\v1\models\Shipping;
use api\modules\v1\models\User;
use yii\filters\auth\HttpBasicAuth;
use api\modules\v1\models\Repertory;
use yii\data\ActiveDataProvider;

class ShippingController extends BaseController
{
	public $modelClass = 'api\modules\v1\models\Shipping';
	
	
	
	public function actions()
	{
		$actions = parent::actions();
		unset($actions['create'],$actions['index'],$actions['view'],$actions['delete'],$actions['update']);
		return $actions;
	}
	
	public function actionIndex($page=0, $pageSize=0, $where='')
	{
		$model = $this->modelClass;
		$query = $model::find();
		return new ActiveDataProvider([
				'query' => $query->orderBy('id desc'),
				'pagination' => [
						'pageSize' => $pageSize,
				],
		]);
		
	}
	
	public function actionView($id)
	{
		$model = $this->findModel($id);
		$user = User::findOne($model->user_id);
		
		$data = $model->attributes;
		$data['username'] = $user->username;
		
		return $data;
	}
	
	public function actionStat()
	{
		$data = Yii::$app->request->post();
		
		$sql = "SELECT product_name, SUM(number) as 'total' FROM ".Shipping::tableName()." WHERE status = 'check' ";
		
		
		//$sql = Shipping::find()->where(['status'=>'check']);
		foreach ($data as $v)
		{
			if(isset($data['pname']))
			{
				$sql .= " AND product_name='$data[pname]' "; //$sql->andWhere(['product_name'=>$data['pname']]);
			}
			if($data['sdate']&&$data['edate'])
			{
				$sql .= " AND created_at > ".strtotime($data['sdate'])." AND created_at < ".strtotime($data['edate']);
				//$sql = $sql->andWhere(['>','created_at',strtotime($data['sdate'])])
				//	->andWhere(['<','created_at',strtotime($data['edate'])]);
			}
		}
		
		$sql .= ' GROUP BY product_name';
		
		//$stat = $sql->all();
		$command = Yii::$app->db->createCommand($sql);
		return $command->queryAll();
		
	}
	
	public function actionCreate()
	{
		$post = Yii::$app->request->post();
		$repertory = Repertory::find()->where(['id'=>$post['repertory_id']])->one();
		
		if($repertory->remaining < $post['number'])
		{
			echo json_encode(array('status'=>false,'error_code'=>400,'message'=>'库存不足,库存数量:'.$repertory->remaining),JSON_PRETTY_PRINT);
			exit;
		}
		$model = new $this->modelClass;
		$model->attributes = Yii::$app->request->post();
		$model->username = Yii::$app->user->identity->username;
		$model->product_type = 'product';
		$model->save();
		return $model;
	}
	
	public function actionUpdate($id)
	{
		//审核确认出货
		$model = $this->findModel($id);
		$status = $model->status;
		$model->status = Yii::$app->request->post()['status'];
		$model->check_username = Yii::$app->user->identity->username;
		//扣除库存
		if($status !='check' && $model->save())
		{
			$repertory = Repertory::find()->where(['id'=>$model->repertory_id])->one();
			if($repertory->remaining < $model->number)
			{
				echo json_encode(array('status'=>false,'error_code'=>400,'message'=>'库存不足,库存数量:'.$repertory->remaining),JSON_PRETTY_PRINT);
				exit;
			}
			
			$repertory->remaining -= $model->number;
			$repertory->shipmented_at = time();
			$repertory->save();
		}
		return $model;
	}
	
	/* function to find the requested record/model */
	protected function findModel($id)
	{
		if (($model = Shipping::findOne($id)) !== null) {
			return $model;
		} else {
	
			$this->setHeader(400);
			echo json_encode(array('status'=>0,'error_code'=>400,'message'=>'Bad request'),JSON_PRETTY_PRINT);
			exit;
		}
	}
}