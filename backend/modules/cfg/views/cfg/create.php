<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\module\hospital\models\Hospital */

$this->title = '添加新闻';
$this->params['breadcrumbs'][] = ['label' => '新闻管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-success">
    <div class="panel-heading"><?= Html::encode($this->title)?></div>
    <div class="panel-body">
    <p></p>
    </div>
    <?= $this->render('_form', [
        'model' => $model,           
    ]) ?>

</div>



