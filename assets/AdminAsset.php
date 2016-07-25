<?php

namespace worstinme\widgets\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $sourcePath = '@worstinme/widgets/assets';

    public $css = [
        'css'=>'css/admin.css',
    ];

    public $js = [
        
    ];

    public $depends = [
        'worstinme\uikit\UikitAsset',
    ];

    public $publishOptions = [
        'forceCopy'=> YII_ENV_DEV ? true : false,
    ];
}