<?php

/**
 *
 * @var $model LoginForm
 *
 */

use app\admin\models\LoginForm;
use app\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="admin-login">
    <div class="login-page">
        <div class="form">
            <?php $form = ActiveForm::begin([
                'action' => ['auth/login'],
                'method' => 'post'
            ]); ?>
            <?= $form->field($model, 'username')->textInput(['placeholder' => 'Имя админа'])->label(false) ?>
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>
            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>