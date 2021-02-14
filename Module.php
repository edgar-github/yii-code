<?php

namespace app\admin;

use  yii\base\Module as BaseModule;

/**
 * Class Module
 * @package app\admin
 */
class Module extends BaseModule
{
    public $controllerNamespace = 'app\admin\controllers';

    public function init()
    {
        parent::init();

        \Yii::configure($this, require __DIR__ . '/config/web.php');
    }
}