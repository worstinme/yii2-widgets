<?php

use yii\helpers\Html;
use conquer\codemirror\CodemirrorWidget;
use conquer\codemirror\CodemirrorAsset;

echo $form->field($model, 'content')->widget(
    CodemirrorWidget::className(),
    [
        'assets' => [
            CodemirrorAsset::ADDON_EDIT_CLOSETAG,
            CodemirrorAsset::ADDON_FOLD_XML_FOLD,
            CodemirrorAsset::MODE_XML,
            CodemirrorAsset::MODE_JAVASCRIPT,
            CodemirrorAsset::MODE_CSS,
            CodemirrorAsset::MODE_HTMLMIXED,
        ],
        'settings' => [
            'lineNumbers' => true,
            'mode' => 'text/html',
            'autoCloseTags' => true,
        ],
    ]
); ?>