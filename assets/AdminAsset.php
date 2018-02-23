<?php

namespace worstinme\widgets\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $sourcePath = '@worstinme/widgets/assets';

    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/css/uikit.min.css',
        'css/admin.css',
    ];

    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit-icons.min.js',
        'https://use.fontawesome.com/e6846ff8c8.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

    public function init()
    {
        if (YII_ENV_DEV) {

            $this->publishOptions = [
                'forceCopy'=> true,
            ];

        }

        parent::init();
    }
}