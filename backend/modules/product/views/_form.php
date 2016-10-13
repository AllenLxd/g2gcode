<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\select2\Select2;
use \kartik\depdrop\DepDrop;
use \kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-info">
    <div class="box-header with-border">
        <h5 class="box-title"><?= $this->title; ?></h5>
    </div>

    <?php $form = ActiveForm::begin([
                'options' => ['class'=>'form-horizontal','enctype'=>'multipart/form-data'],
                'fieldConfig' => [
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
                ]
            ]); ?>
<div class="box-body">
    <?=
        $form->field($model, 'category3_id')->widget(Select2::classname(), [
            'options' => ['placeholder' => '请选择分类 ...'],

            'data' => ArrayHelper::map($category, 'id', 'name'),
        ]);
    ?>

    <?=
        $form->field($model, 'category2_id')->widget(DepDrop::classname(), [
            'type' => DepDrop::TYPE_SELECT2,
            'data' => ArrayHelper::map($childCategory, 'id', 'name'),
            'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
            'pluginOptions'=>[
                'depends'=>['product-category3_id'],
                'placeholder' => '请选择分类 ...',
                'url' => Url::to(['product-category/child-category']),
                'loadingText' => '加载中 ...',
            ]
        ])->label('子类');
    ?>

    <?=
    $form->field($model, 'category_id')->widget(DepDrop::classname(), [
        'type' => DepDrop::TYPE_SELECT2,
        'data' => ArrayHelper::map($childCategory, 'id', 'name'),
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'depends'=>['product-category2_id'],
            'placeholder' => '请选择分类 ...',
            'url' => Url::to(['product-category/child-category']),
            'loadingText' => '加载中 ...',
        ]
    ])->label('子类');
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?=
        $form->field($model, 'pic')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
            ],
            'pluginOptions' =>[
                'showUpload' => false,
                'showRemove' => false,
                'showPreview' => false,
                'showCaption' => true,
                'allowedFileExtensions'=>['jpg','jpeg','png'],
            ],

        ]);
    ?>

    <?=
        $form->field($model, 'guarantee_time')->widget(Select2::classname(), [
            'options' => ['placeholder' => '请选择时间...'],
            'data' => [1=>'1年',2=>'2年',3=>'3年',4=>'4年',5=>'5年'],
        ]);
    ?>
    <?=
        $form->field($model, 'labor_time')->widget(Select2::classname(), [
            'options' => ['placeholder' => '请选择时间...'],
            'data' => [1=>'1年',2=>'2年',3=>'3年',4=>'4年',5=>'5年'],
        ]);
    ?>

    <?= $form->field($model, 'supply')->checkboxList(['Pioneer'=>'Pioneer','Denco'=>'Denco','Wensco'=>'Wensco']) ?>

    <?= $form->field($model, 'video1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'content')->widget('kucha\ueditor\UEditor',[]);?>
</div>
<div class="box-footer">
    <a href="<?= Url::to(['product/index']);?>" class="btn btn-info fa fa-reply"></a>
    <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
</div>
    <?php ActiveForm::end(); ?>

</div>
