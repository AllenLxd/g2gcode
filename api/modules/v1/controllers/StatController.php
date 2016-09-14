<?php
namespace api\modules\v1\controllers;
use Yii;
use api\controllers\BaseController;
use api\modules\v1\models\Lampbead;
use yii\filters\auth\HttpBasicAuth;
use yii\data\ActiveDataProvider;
use api\modules\v1\models\Repertory;

class StatController extends BaseController
{
	public $modelClass = 'api\modules\v1\models\LampbeadShipping';



	public function actions()
	{
		$actions = parent::actions();
		unset($actions['index'],$actions['create'],$actions['view'],$actions['delete'],$actions['update']);
		return $actions;
	}

	public function actionCreate()
	{

	}

	public function actionIndex($type)
	{
		switch ($type)
		{
			case 'lamp':
				$sql = "SELECT lamp_code, SUM(remaining) as 'total' FROM ".Lampbead::tableName()." GROUP BY lamp_code";
				$command = Yii::$app->db->createCommand($sql);
				return $command->queryAll();
				break;
			case 'repertory':
				$sql = "SELECT product_name, SUM(remaining) as 'total' FROM ".Repertory::tableName()." GROUP BY product_name";
				$command = Yii::$app->db->createCommand($sql);
				return $command->queryAll();
				break;
		}
	}
}