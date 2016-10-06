f<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
	'modules' => [],
    'components' => [
    	'urlManager' => [
    		'enablePrettyUrl' => true,
	        'showScriptName' => false,
	        'enableStrictParsing' => false,
	        'rules' => [
	            [
	                'class' => 'yii\rest\UrlRule',
	                'controller' => [
                        'user',
                        'guarantee',
	                	'category-product',
	                ],
	                'pluralize'=>false
	            ],
	        ],
    	],
    	'response' => [
    		'class' => 'yii\web\Response',
    		'format' => yii\web\Response::FORMAT_JSON,

    		'on beforeSend' => function ($event) {
    			$response = $event->sender;
    			//print_r($response->getHeaders());
    			$response->getHeaders()->remove('www-authenticate'); // THIS
		        $response->formatters['html'] = 'yii\web\JsonResponseFormatter';
		        $response->data = [
		            'success' => $response->isSuccessful,
		            'data'    => $response->data,
		        	'pages'   => $response->headers
		        ];
    			$response->statusCode = 200;
    		},
    	],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        	'enableSession' => true,
        	'loginUrl' => null
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
    ],
    'params' => $params,
];
