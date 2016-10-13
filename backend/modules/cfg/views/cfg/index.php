<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $searchModel backend\module\hospital\models\SearchHospital */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '网站参数';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="panel panel-success">
    <div class="panel-heading"><?= Html::encode($this->title)?></div>
    <div class="panel-body">
    <p></p>
    </div>
    <div class="hospital-form">

    <?php $form = ActiveForm::begin(['layout'=>'horizontal','options'=>['enctype'=>'multipart/form-data']]); ?>
    
    	<?= $form->field($model, 'url') ?>
    	<?= $form->field($model, 'name') ?>
    	  
    	<?= 
	        $form->field($model, 'logo')->widget(FileInput::classname(), [
	            'options' => [
	                'accept' => 'image/*',
	            ],
	            'pluginOptions' =>[
	                'showUpload' => false,
	                'showRemove' => false,
	                'showPreview' => true,
	                'showCaption' => true,
	                'allowedFileExtensions'=>['jpg','jpeg','png','gif'],
	            ],
	            
	        ]); 
	    ?>
	    <?php if($model->logo):?>
	    <div class="form-group field-cfg-google_map_lat required">
			<label for="cfg-google_map_lat" class="control-label col-sm-3"></label>
			<div class="col-sm-6">
			<img width="150" src="<?= '/uploads/' . $model->logo;?>">
			</div>
		</div>  
		<?php endif;?>
    	<?= $form->field($model, 'tel') ?>
    	<?= $form->field($model, 'fax') ?>
		<?= $form->field($model, 'estimate_email') ?>
		<?= $form->field($model, 'accounting_email') ?>
		<?= $form->field($model, 'tech_support_email') ?>
		<?= $form->field($model, 'customer_service_email') ?>
		<?= $form->field($model, 'address') ?>
    	
    	<div class="form-group field-cfg-google_map_lat required">
			<label for="cfg-google_map_lat" class="control-label col-sm-3"></label>
			<div class="col-sm-6">
			<?= Html::submitButton('保 存', ['class' => 'btn btn-success']) ?>
			</div>
		</div>      
		
    <?php ActiveForm::end(); ?>

</div>

</div>
        

