<?php

use yii\helpers\Html;
use app\assets\AdminAsset;

AdminAsset::register($this)

?>

<?php $this->beginPage() ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <?= $this->render('@app/views/layouts/metricks/header'); ?>

        <?= Html::csrfMetaTags() ?>

        <title><?= Html::encode($this->title) ?></title>

        <?php if (Html::encode($this->metaDescription) != ''): ?>
            <meta name="description" content="<?= Html::encode($this->metaDescription); ?>">
        <?php endif ?>

        <?php if (Html::encode($this->metaKeywords) != ''): ?>
            <meta name="keywords" content="<?= Html::encode($this->metaKeywords); ?>">
        <?php endif ?>

        <?php $this->head() ?>
    </head>
    <body>

    <?php $this->beginBody() ?>

    <div class="page-wrapper chiller-theme toggled">

        <?= $this->render('../sections/sidebar'); ?>

        <main class="page-content">
            <div class="container-fluid">
                <?= Yii::$app->session->getFlash('FilesRemoved'); ?>
                <h2><?=$this->title ?></h2>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php $this->endBody() ?>

    <?= $this->render('@app/views/layouts/metricks/footer'); ?>
    </body>
    </html>
<?php $this->endPage() ?>