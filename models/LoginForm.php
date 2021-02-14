<?php

namespace app\admin\models;

/**
 * Class LoginForm
 */
class LoginForm extends \yii\base\Model
{
    public $username;
    public $password;


    public function rules()
    {
        return [
            [['username', 'password'], 'string'],
            [['username', 'password'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя админа',
            'password' => 'Пароль',
        ];
    }
}