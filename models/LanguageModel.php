<?php


namespace app\admin\models;


use app\admin\services\LanguageTableService;
use yii\base\Model;

/**
 * Class LanguageModel
 * @package app\admin\models
 */
class LanguageModel extends Model
{
    /**
     * @var string
     */
    public $lang;

    /**
     * @var string
     */
    public $mainLangAlias;

    /**
     * @var string
     */
    public $file;


    /**
     * @return array
     */
    public function compareLangFilesWithBasic(): array
    {
        return [
            'status' => $this->getFileStatus(),
            'missingVariables' => $this->getFileMissingVariables(),
        ];
    }

    /**
     * @return array
     */
    private function getFileMissingVariables(): array
    {
        /** @var array $main */
        $main = include $this->mainLangAlias . '/' . LanguageTableService::RU . $this->file;

        if(!$this->checkFileExists() || !$current = include $this->mainLangAlias . '/' . $this->lang . $this->file) {
            return array_keys($main);
        }

        return $this->diffLangArrays($main, $current ?? []);
    }

    /**
     * @param array $main
     * @param array $current
     * @return array
     */
    private function diffLangArrays(array $main, array $current = []): array
    {
        $diff = [];

        foreach($main as $key => $value) {
            if(!isset($current[$key]) || $main[$key] === $current[$key]) {
                $diff[] = $key;
            }
        }

        return $diff;
    }

    /**
     * @return int
     */
    private function getFileStatus(): int
    {
        if(!$this->checkFileExists()) {
            return LanguageTableService::STATUS_MISSES;
        }

        return $this->getFileMissingVariables() ? LanguageTableService::STATUS_NOT_FULL : LanguageTableService::STATUS_EXISTS;
    }

    /**
     * @return bool
     */
    private function checkFileExists(): bool
    {
        return file_exists($this->mainLangAlias . '/' . $this->lang . $this->file);
    }
}