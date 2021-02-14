<?php

/**
 * @var int $status
 * @var array $missingVariables
 */

use app\admin\services\LanguageTableService;

?>

<?php if ($status === LanguageTableService::STATUS_NOT_FULL) : ?>
    <div class="not-full-hidden">
        <div class="alert-max">
            <?php foreach ($missingVariables as $missingVariable) : ?>
                <div><?= $missingVariable ?></div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
