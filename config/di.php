<?php

use benbanfa\user\ServiceProvider as UserServiceProvider;
use benbanfa\user\UserDirectory;
use common\models\User;
use yii\di\Container;

UserServiceProvider::register(Yii::$container);

Yii::$container->setSingleton(UserDirectory::class, function (Container $container) {
    return new UserDirectory(Yii::$app->security, ['userClass' => User::class]);
});
