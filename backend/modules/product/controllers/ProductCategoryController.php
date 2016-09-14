<?php

namespace app\modules\product\controllers;

use Yii;
use app\modules\product\models\ProductCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * ProductCategoryController implements the CRUD actions for ProductCategory model.
 */
class ProductCategoryController extends Controller
{
public function actions() {
    return [
      	'nodeChildren' => [
        'class' => 'gilek\gtreetable\actions\NodeChildrenAction',
        'treeModelName' => ProductCategory::className()
    ],
    'nodeCreate' => [
        'class' => 'gilek\gtreetable\actions\NodeCreateAction',
        'treeModelName' => ProductCategory::className()
    ],
    'nodeUpdate' => [
        'class' => 'gilek\gtreetable\actions\NodeUpdateAction',
        'treeModelName' => ProductCategory::className()
    ],
    'nodeDelete' => [
        'class' => 'gilek\gtreetable\actions\NodeDeleteAction',
        'treeModelName' => ProductCategory::className()
    ],
    'nodeMove' => [
        'class' => 'gilek\gtreetable\actions\NodeMoveAction',
        'treeModelName' => ProductCategory::className()
      ],
    ];
 }

	public function actionIndex() {
		return $this->render('@gilek/gtreetable/views/widget', [
			'options' => [
	        	'manyroots' => true,
	       		'draggable' => true,
    		],
			'columnName' => '产品分类管理'
		]);
  	}

  	public function actionChildCategory() {
  		$out = [];
  		if ($id = Yii::$app->request->post()['depdrop_all_params']) {
  			$list = ProductCategory::find()->select(['id','name'])->where(['root'=>$id])->all();

  			$selected  = null;
  			if ($id != null && count($list) > 0) {
  				$selected = '';
  				foreach ($list as $k => $v) {
  					if($id['product-category_id'] !=$v->id) $out[$v->id] = ['id' => $v->id, 'name' => $v->name];
  					if ($k == 0) {
  						$selected = $v->id;
  					}
  				}

  				echo Json::encode(['output' => $out, 'selected'=>$selected]);
  				return;
  			}
  		}
  		echo Json::encode(['output' => '', 'selected'=>'']);
  	}
}
