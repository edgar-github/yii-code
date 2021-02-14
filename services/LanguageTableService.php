<?php

namespace app\admin\services;


use app\admin\models\LanguageModel;

/**
 * Class LanguageTableService
 * @package app\admin\services
 */
class LanguageTableService
{
    const ICON_EXISTS = '<svg version="1" width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                     enable-background="new 0 0 48 48">
                    <circle fill="#4CAF50" cx="24" cy="24" r="21"/>
                    <polygon fill="#CCFF90" points="34.6,14.6 21,28.2 15.4,22.6 12.6,25.4 21,33.8 37.4,17.4"/>
                </svg>';

    const ICON_NOT_FULL = '<svg id="Capa_1" enable-background="new 0 0 512 512" height="30px" viewBox="0 0 512 512" width="30px" xmlns="http://www.w3.org/2000/svg">
                    <g><g><path d="m458.694 421.735c-.119 0-.239-.003-.358-.009-2.43-.115-4.651-1.402-5.961-3.451l-13.453-21.039c-2.231-3.489-1.212-8.127 2.278-10.358 3.487-2.232 8.128-1.212 10.358 2.278l7.753 12.124 5.193-6.632c2.555-3.261 7.27-3.833 10.529-1.281 3.261 2.554 3.835 7.268 1.281 10.529l-11.717 14.963c-1.424 1.82-3.605 2.876-5.903 2.876z" fill="#61aab7"/></g><g><path d="m39.624 421.735c-2.302 0-4.483-1.059-5.908-2.881l-11.695-14.963c-2.551-3.264-1.973-7.978 1.29-10.528 3.264-2.549 7.977-1.972 10.528 1.29l5.274 6.748 17.279-26.162c2.281-3.457 6.933-4.407 10.392-2.124 3.456 2.282 4.407 6.935 2.124 10.392l-23.025 34.862c-1.33 2.014-3.548 3.264-5.959 3.36-.1.004-.2.006-.3.006z" fill="#61aab7"/></g>
                        <path d="m234.073 101.31-156.338 211.038c-13.341 18.009-.486 43.532 21.927 43.532h312.676c22.413 0 35.269-25.523 21.927-43.532l-156.338-211.038c-10.909-14.727-32.945-14.727-43.854 0z" fill="#da4a54"/>
                        <path d="m434.266 312.348-156.339-211.038c-8.807-11.888-24.861-14.173-36.462-6.868 2.77 1.744 5.289 4.03 7.392 6.868l156.338 211.038c13.341 18.009.485 43.532-21.927 43.532h29.071c22.412 0 35.268-25.523 21.927-43.532z" fill="#d82e3d"/>
                        <path d="m148.788 300.432 104.468-141.02c1.365-1.843 4.123-1.843 5.488 0l104.469 141.02c1.67 2.254.061 5.448-2.744 5.448h-208.937c-2.805 0-4.414-3.194-2.744-5.448z" fill="#f6e266"/>
                        <path d="m363.213 300.432-104.469-141.02c-1.365-1.843-4.123-1.843-5.489 0l-9.849 13.296 94.619 127.724c1.67 2.254.061 5.448-2.744 5.448h25.188c2.805 0 4.414-3.194 2.744-5.448z" fill="#ffd064"/>
                        <g fill="#544f57"><path d="m135.929 355.88h74.739v28.43h-74.739z"/><path d="m301.333 355.88h74.739v28.43h-74.739z"/></g><path d="m193.169 355.88h17.499v28.43h-17.499z" fill="#454045"/>
                        <path d="m358.573 355.88h17.499v28.43h-17.499z" fill="#454045"/><path d="m406.214 414.235h-300.427v-17.112c0-7.077 5.737-12.813 12.813-12.813h274.8c7.077 0 12.813 5.737 12.813 12.813v17.112z" fill="#afaab4"/>
                        <path d="m393.401 384.31h-23.631c7.077 0 12.813 5.737 12.813 12.813v17.112h23.631v-17.112c0-7.076-5.737-12.813-12.813-12.813z" fill="#8b818e"/><g>
                            <path d="m504.5 421.735h-497c-4.143 0-7.5-3.357-7.5-7.5s3.357-7.5 7.5-7.5h497c4.143 0 7.5 3.357 7.5 7.5s-3.357 7.5-7.5 7.5z" fill="#78d0b1"/></g></g></svg>';

    const ICON_MISSES = '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" width="18px" height="18px" xml:space="preserve">
                    <g><g><path d="M436.3,75.7C388,27.401,324.101,0,256,0C115.343,0,0,115.116,0,256c0,140.958,115.075,256,256,256
			c140.306,0,256-114.589,256-256C512,187.899,484.6,123.999,436.3,75.7z M256,451c-107.786,0-195-86.985-195-195
			c0-42.001,13.2-81.901,37.5-114.901l272.401,272.1C337.899,437.8,298.001,451,256,451z M413.2,370.899L141.099,98.5
			C174.101,74.2,213.999,61,256,61c107.789,0,195,86.985,195,195C451,297.999,437.8,337.899,413.2,370.899z"/></g></g>
                    <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                </svg>';


    const STATUS_EXISTS = 1;
    const STATUS_MISSES = 2;
    const STATUS_NOT_FULL = 3;


    const CZ = 'cz';
    const EN = 'en';
    const ID = 'id';
    const MS = 'ms';
    const RU = 'ru';
    const SK = 'sk';
    const IT = 'it';

    /**
     * @var array
     */
    private $files = [];


    /**
     * @var string
     */
    private static $langAlias;

    public function __construct()
    {
        self::$langAlias = \Yii::getAlias('@app') . '/langs';
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        $full = [];

        foreach (self::getLangs() as $lang) {
            foreach ($this->getBasicFiles() as $basicFile) {
                $full[$basicFile][$lang] = (new LanguageModel([
                    'lang' => $lang,
                    'file' => $basicFile,
                    'mainLangAlias' => self::$langAlias
                ]))->compareLangFilesWithBasic();
            }
        }

        return $full;
    }

    /**
     * @param int $type
     * @return string
     */
    public static function getIconByType(int $type): string
    {
        return [
            self::STATUS_EXISTS => self::ICON_EXISTS,
            self::STATUS_NOT_FULL => self::ICON_NOT_FULL,
            self::STATUS_MISSES => self::ICON_MISSES,
        ][$type];
    }

    /**
     * @param int $type
     * @return string
     */
    public static function getHtmlClassByType(int $type): string
    {
        return [
            self::STATUS_EXISTS => '',
            self::STATUS_NOT_FULL => 'selectable',
            self::STATUS_MISSES => 'is-missing',
        ][$type];
    }

    /**
     * @return string
     */
    public static function getMainLang(): string
    {
        return self::RU;
    }

    /**
     * @return array
     */
    public function getBasicFiles()
    {
        $ruPath = $this->getMainPath();

        $this->getHierarchyFiles($ruPath);

        return $this->removePathMainPart($ruPath);
    }

    /**
     * @param string $file
     * @return string
     */
    public function getFileName(string $file): string
    {
        $parts = explode('/', $file);
        $partsCount = count($parts);

        return $parts[$partsCount - 1];
    }

    /**
     * @param string $lang
     * @param string $file
     * @return string
     */
    public function getLangFilePath(string $lang, string $file): string
    {
        return $this->getLangAlias() . '/' . $lang . $file;
    }

    /**
     * @return string
     */
    public function getLangAlias(): string
    {
        return self::$langAlias;
    }


    /**
     * @return array
     */
    public static function getLangs(): array
    {
        return [
            self::CZ => self::CZ,
            self::EN => self::EN,
            self::ID => self::ID,
            self::MS => self::MS,
            self::SK => self::SK,
            self::IT => self::IT,
        ];
    }

    /**
     * @param array $langs
     * @return string
     */
    public static function getFileFoldersStatus(array $langs): string
    {
        $allFilesExist = true;
        foreach ($langs as $lang) {
            if($lang['status'] !== self::STATUS_EXISTS) {
                $allFilesExist = false;
            }
        }

        return $allFilesExist ? 'hov-full-column' : 'hov-full-column-false';
    }

    /**
     * @return string
     */
    private function getMainPath(): string
    {
        return self::$langAlias . '/' . self::RU;
    }

    /**
     * @param string $removePath
     * @return array
     */
    private function removePathMainPart(string $removePath): array
    {
        $newFiles = [];
        foreach ($this->files as $file) {
            $newFiles[] = str_replace($removePath, "", $file);
        }

        return $newFiles;
    }


    /**
     * @param string $path
     * @return array
     */
    private function getHierarchyFiles(string $path): array
    {
        $this->getHierarchy($path);

        return $this->files;
    }


    /**
     * @param string $path
     */
    private function getHierarchy(string $path)
    {
        $files = scandir($path);

        unset($files[array_search('.', $files, true)]);
        unset($files[array_search('..', $files, true)]);

        // prevent empty ordered elements
        if (count($files) < 1)
            return;

        foreach ($files as $file) {
            if (is_dir($path . '/' . $file)) {
                $this->getHierarchy($path . '/' . $file);
            } else {
                $this->files[] = $path . '/' . $file;
            }
        }
    }
}