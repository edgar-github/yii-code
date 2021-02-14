<?php


namespace app\admin\controllers;


use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Class AdminController
 * @package app\controllers
 */
class SiteController extends Controller
{
    public $layout = 'main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['seeAdmin'],
                    ],
                ],
            ],
        ];
    }

    public function __construct($id, $module, $config = [])
    {
        \Yii::$app->user->loginUrl = ['admin/auth/login'];

        parent::__construct($id, $module, $config);
    }

    /**
     * Route /admin/
     */
    public function actionIndex()
    {
        $this->view->title = 'Home Page';
        return $this->render('index');
    }

}