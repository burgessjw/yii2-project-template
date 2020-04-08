<?php

namespace frontend\widgets;

use dmstr\widgets\Menu;
use Yii;
use yii\base\Widget;

class SubNavWidget extends Widget
{
    public function run()
    {
        return Menu::widget([
            'defaultIconHtml' => '',
            'items' => [
                [
                    'label' => '学生管理',
                    'url' => '#',
                    'items' => [
                        ['label' => '学生列表', 'url' => ['/raddy/student']],
                    ],
                ],
                // more item ...
            ],
        ]);
    }
}
