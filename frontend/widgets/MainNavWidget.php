<?php

namespace frontend\widgets;

use yii\base\Widget;

class MainNavWidget extends Widget
{
    public function run()
    {
        $html = '';

        $items = [];
        foreach ($items as $item) {
            $html .= \sprintf('<li><a href="/%s">%s</a></li>', $item['path'], $item['auth_name']);
        }

        return $html;
    }
}
