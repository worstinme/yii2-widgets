<?php

namespace worstinme\widgets;

use Yii;

class Module extends \yii\base\Module
{
    /** @var string The Widgets admin layout. */
    public $layout = '@worstinme/widgets/views/layouts/widgets.php';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'worstinme\widgets\controllers';

    public function getNav()
    {
        return array_filter([
            ['label' => Yii::t('widgets', 'NAV_WIDGETS'), 'url' => ['/widgets/default/index'], 'items' => [
                ['label' => Yii::t('widgets', 'NAV_WIDGET_CREATE'), 'url' => ['/widgets/default/create']],
            ]],
        ]);
    }
}
