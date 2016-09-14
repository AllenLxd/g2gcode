<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use \kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\module\hospital\models\Hospital */
/* @var $form yii\widgets\ActiveForm */
?>

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

