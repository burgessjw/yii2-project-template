<?php

use Bbf\User\UserModule;
use yii\filters\ContentNegotiator;
use yii\web\Response;

$config = [
    'id' => 'app-frontend',
    'basePath' => XII_ROOT.'/frontend',
    'runtimePath' => XII_ROOT.'/runtime/frontend',
    'bootstrap' => [
        [
            'class' => ContentNegotiator::class,
            'formats' => [
                'text/html' => Response::FORMAT_HTML,
                'application/json' => Response::FORMAT_JSON,
            ],
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf',
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_id',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => '_ss',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'raddy/<resourceId>' => 'raddy/resource/index',
                'raddy/<resourceId>/<id>/edit' => 'raddy/resource/edit',
                'raddy/<resourceId>/new' => 'raddy/resource/new',
            ],
        ],
        'view' => [
            'class' => 'yii\web\View',
            'renderers' => [
                'twig' => [
                    'class' => 'yii\twig\ViewRenderer',
                    'cachePath' => '@runtime/Twig/cache',
                    'options' => [
                        'auto_reload' => true,
                    ],
                    'globals' => [
                        'html' => ['class' => '\yii\helpers\Html'],
                    ],
                    'uses' => ['yii\bootstrap'],
                ],
            ],
        ],
    ],
    'modules' => [
        // 'user' => UserModule::class,
        'raddy' => [
            'class' => \benbanfa\raddy\Module::class,
            'mainNavWidget' => \frontend\widgets\MainNavWidget::class,
            'subNavWidget' => \frontend\widgets\SubNavWidget::class,
        ],
    ],
    'container' => [
        'singletons' => [
            \benbanfa\raddy\ResourceRegistry::class => function () {
                return new \benbanfa\raddy\ResourceRegistry([
                    'resources' => [
                        'student' => \frontend\resources\StudentResource::class,
                    ],
                ]);
            },
        ],
    ],
    'controllerNamespace' => 'frontend\controllers',
];

if (YII_DEBUG) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
