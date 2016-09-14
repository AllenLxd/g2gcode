<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\module\hospital\models\Hospital */

$this->title = '修改新闻';
$this->params['breadcrumbs'][] = ['label' => '新闻管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-success">
    <div class="panel-heading"><?= Html::encode($this->title)?></div>
    <div class="panel-body">
    <p></p>
    </div>
    <div class="hospital-form">

    <?php $form = ActiveForm::begin(['layout'=>'horizontal','options'=>['enctype'=>'multipart/form-data']]); ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'content')->widget('pjkui\kindeditor\Kindeditor',[]) ?>

    <div class="form-group">
        <label class="control-label col-sm-3" for="hospital-content"></label>
        <div class="col-sm-6">
            <?= Html::submitButton($model->isNewRecord ? '<span class=" glyphicon glyphicon-modal-window" aria-hidden="true"></span> 保 存' : '<span class=" glyphicon glyphicon-modal-window" aria-hidden="true"></span> 保 存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
