<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
    	'menus' => [
    		'class' => 'app\modules\menus\Module',
    	],
    	'pages' => [
    		'class' => 'app\modules\pages\Module',
    	],
        'users' => [
            'class' => 'app\modules\users\Module',
        ],
        'guarantee' => [
            'class' => 'app\modules\guarantee\Module',
        ],
        'product' => [
            'class' => 'app\modules\product\Module',
        ],
        'stat' => [
            'class' => 'app\modules\stat\Module',
        ],
        'cfg' => [
            'class' => 'app\modules\cfg\Module',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
    	'view' => [
    		'theme' => [
    			'pathMap' => [
    				'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
    			],
    		],
    	],
    	'assetManager' => [
    		'bundles' => [
    			'dmstr\web\AdminLteAsset' => [
    				'skin' => 'skin-red-light',
    				//"skin-blue",
    					//"skin-black",
    					//"skin-red",
    					//"skin-yellow",
    					//"skin-purple",
    					//"skin-green",
    					//"skin-blue-light",
    					//"skin-black-light",
    					//"skin-red-light",
    					//"skin-yellow-light",
    					//"skin-purple-light",
    					//"skin-green-light"
    			],
    		],
    	],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'viewPath' => '@backend/mail',
            'useFileTransport' => false,//set this property to false to send mails to real email addresses
            //comment the following array to send mail using php's mail function
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.263.net',
                'username' => 'admin@bnboxes.com',
                'password' => '1KK65O8B',
                'port' => '25',
                'encryption' => 'tls',
            ],
            'messageConfig'=>[
                'charset'=>'UTF-8',
                'from'=>['admin@bnboxes.com'=>'admin']
            ],
        ],

        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
