<?php

namespace app\modules\product\controllers;

use Yii;
use app\modules\product\models\Product;
use app\modules\product\models\ProductCategory;
use app\modules\product\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\libs\Common;
use app\components\CommonController;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends CommonController
{
    public function actions()
    {
        return [
            'upload' => ['class' => 'kucha\ueditor\UEditorAction'],
            'config' => [
                'imageUrlPrefix' => $_SERVER['HTTP_HOST'],
                'imagePathFormat' => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}"
            ]
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $category = ProductCategory::find()->select(['id', 'name'])->where(['level'=>0])->indexBy('id')->all();

        $data = Yii::$app->request->post();

        if($data)
        {
            //$data['Product']['parent_id2'] = $data['Product']['id'];
            //unset($data['Product']['id']);

            $picFile = Common::uploadFile('Product[pic]');
            unset($data['Product']['pic']);
            if($picFile) $data['Product']['pic'] = $picFile['path'];
            $data['Product']['supply'] = implode(',', $data['Product']['supply']);
            if ($model->load($data) && $model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['/product/product/view', 'id' => $model->id]);
            }
            else{
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }

        }

        return $this->render('/create', [
            'model' => $model,
            'category' => $category,
            'childCategory' => [],
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $category = ProductCategory::find()->select(['id', 'name'])->where(['level'=>0])->indexBy('id')->all();
        $childCategory = ProductCategory::find()->select(['id','name'])->where(['root'=>$model->category_id])->asArray()->indexBy('id')->all();
        if($childCategory){
            unset($childCategory[$model->category_id]);
        }else{
            $childCategory = [];
        }
        $model->supply = explode(',', $model->supply);

        $data = Yii::$app->request->post();
        if ($data) {
            $picFile = Common::uploadFile('Product[pic]');
            unset($data['Product']['pic']);
            $data['Product']['pic'] = $picFile ? $picFile['path'] : $model->pic;
            $data['Product']['supply'] = implode(',', $data['Product']['supply']);

            if ($model->load($data) && $model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
            }
            return $this->redirect(['/product/product/view', 'id' => $model->id]);
        } else {
            return $this->render('/update', [
                'model' => $model,
                'category' => $category,
                'childCategory' => $childCategory,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
