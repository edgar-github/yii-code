<?php


namespace app\admin\controllers;


use app\admin\services\LanguageTableService;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

/**
 * Class LangController
 * @package app\admin\controllers
 */
class LangController extends Controller
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
                        'actions' => ['index', 'download', 'cron-clear-csv', 'cache-clear'],
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
        $this->view->title = 'Language translations table';

        $langService = new LanguageTableService();

        $files = $langService->getFiles();

        return $this->render('index', compact('files'));
    }

    /**
     * Route /admin/lang-download
     *
     * @param string $lang
     * @param string $file
     * @param bool $mainFileDownload
     *
     * @return string
     */
    public function actionDownload(string $lang, string $file, bool $mainFileDownload = false)
    {
        $langService = new LanguageTableService();

        if(!$mainFileDownload) {
            if (file_exists($path = $langService->getLangFilePath($lang, $file))) {
                return \Yii::$app->response->sendFile($path, $langService->getFileName($file));
            }
        } else {
            if (file_exists($path = $langService->getLangFilePath($langService::RU, $file))) {
                return \Yii::$app->response->sendFile($path, $langService::getMainLang() . '_' . $langService->getFileName($file));
            }
        }

        return '';
    }


    /**
     * Роут занимается удалением временних файлов csv
     * из папки uploads/csv
     *
     * @author Grigor Grigoryan <grigor.g@kpigroups.com>
     */
    public function actionCronClearCsv()
    {
        $pathName = \Yii::$app->basePath . '/web/csv';

        $filesRemoved = false;

        Yii::$app->session->setFlash('FilesRemoved', 'The Folder Is Already Empty, Or Something Went Wrong');

        $countOfFiles = 0;

        if (file_exists($pathName)) {
            $files = glob($pathName . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                    $filesRemoved = true;
                    $countOfFiles++;
                }
            }
        }

        if($filesRemoved) {
            Yii::$app->session->setFlash('FilesRemoved', $countOfFiles . ' File(s) Removed Successfully');
        }

        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);

    }

    /**
     * Роут для очистки кеша всего сайта
     *
     * @author Grigor Grigoryan <grigor.g@kpigroups.com>
     */
    public function actionCacheClear()
    {
        Yii::$app->cache->flush();

        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }


}