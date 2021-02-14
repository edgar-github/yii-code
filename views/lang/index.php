<?php
/**
 * @var \yii\web\View $this ;
 * @var array $files ;
 */

use app\admin\services\LanguageTableService;

$this->registerCssFile('/admin-files/libs/animate/animate.css');
$this->registerCssFile('/admin-files/libs/select2/select2.min.css');
$this->registerCssFile('/admin-files/libs/perfect-scrollbar/perfect-scrollbar.css');
$this->registerCssFile('/admin-files/css/util.css');
$this->registerCssFile('/admin-files/css/main-lang.css');


$this->registerJsFile('/admin-files/libs/bootstrap/js/popper.js', ['depends' => \yii\web\YiiAsset::class]);
$this->registerJsFile('/admin-files/libs/select2/select2.min.js', ['depends' => \yii\web\YiiAsset::class]);
$this->registerJsFile('/admin-files/js/main-lang.js', ['depends' => \yii\web\YiiAsset::class]);

?>


<div class="table100 ver2 m-b-110">
    <table data-vertable="ver2">
        <thead>
        <tr class="row100 head">
            <th class="column100 column1" data-column="column1">Page Path</th>
            <th class="column100 column2" data-column="column2">Ru</th>
            <?php $i = 3;
            foreach (LanguageTableService::getLangs() as $language) : ?>
                <th class="column100 column<?= $i ?>" data-column="column<?= $i ?>"><?= $language ?></th>
                <?php $i++; endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($files as $file => $langs) : ?>
            <tr class="row100">
                <td class="column100 column1 <?= LanguageTableService::getFileFoldersStatus($langs) ?>" data-column="column1"><?= $file ?></td>
                <td class="column100 column2" data-column="column2">
                    <?= LanguageTableService::ICON_EXISTS ?>
                </td>
                <?php $i = 3;
                foreach (LanguageTableService::getLangs() as $language) : ?>
                    <td
                            data-lang="<?= $language ?>"
                            data-file="<?= $file ?>"
                            class="column100 column<?= $i ?> <?= LanguageTableService::getHtmlClassByType($langs[$language]['status']) ?>" data-column="column<?= $i ?>">
                        <?= LanguageTableService::getIconByType($langs[$language]['status']) ?>
                        <?= $this->render('sections/missing-variables', [
                                'missingVariables' => $langs[$language]['missingVariables'],
                                'status' => $langs[$language]['status']
                        ]) ?>
                    </td>
                    <?php $i++; endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>