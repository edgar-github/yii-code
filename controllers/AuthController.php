<?php


namespace app\admin\controllers;


use app\admin\models\LoginForm;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Class AdminController
 * @package app\controllers
 */
class AuthController extends Controller
{
    public $layout = 'login';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    /**
     * Route /admin/auth/login/
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if($admin = User::findUserByCredentials($model->username, $model->password)) {
                \Yii::$app->user->login($admin);

                $this->redirect(['site/index']);
            }
        }

        return $this->render('login', compact('model'));
    }

    /**
     * Route /admin/auth/logout/
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout(true);

        return $this->redirect(['auth/login']);
    }

}