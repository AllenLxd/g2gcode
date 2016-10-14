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
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = Yii::$app->runAction('product/product-category/nodeChildren',['id'=>(int)$id,'isReturn'=>true]);

            //print_r($list);die;
            $selected  = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['id'], 'name' => $account['name']];
                    if ($i == 0) {
                        $selected = $account['id'];
                    }
                }
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected'=>$selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected'=>'']);
  	}
}
