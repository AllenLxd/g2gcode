@@ -1,86 +0,0 @@
<?php
use yii\helpers\Html;
use kartik\growl\Growl;
/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') {
/**
 * Do not use this code in your template. Remove it.
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="<?= \dmstr\helpers\AdminLteHelper::skinClass() ?>">
    <?php $this->beginBody() ?>

    <?php foreach(Yii::$app->session->getAllFlashes() as $message):; ?>
        <?php
            echo Growl::widget([
                    'type' => (!empty($message['type'])) ? $message['type'] : 'danger' ,
                    'title' => (!empty ($message ['title'])) ? Html::encode ($message['title']) : '系统提示',
                    'icon' => (!empty ($message ['icon'] )) ? $message['icon'] : 'glyphicon glyphicon-info-sign',
                    'body' => (!empty ($message ['message'])) ? Html::encode ($message['message']) : 'Message Not Set! ' ,
                    'showSeparator' => true,
                    'delay' => 1 , //多个提示出有效，每个提示显示时候间隔
                    'pluginOptions' => [
                        'delay' => (!empty($message['delay'])) ? $message['delay'] : 0, // This delay is how long the message shows for
                        'placement' => [
                            'from' => 'top',
                            'align' => 'center' ,
                        ]
                    ]
            ]);
        ?>
    <?php endforeach; ?>

    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
