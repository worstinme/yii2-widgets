<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([]); ?>

<?=\mihaildev\ckeditor\CKEditor::widget([
    'model'=>$model,
    'attribute'=>'content',
    'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],[
        'preset' => 'standart',
        'allowedContent' => true,
        'height'=>'400px',
        'toolbar' => [
            ['Bold', 'Italic','Underline','-','NumberedList', 'BulletedList', '-', 'Link', 'Unlink','Styles','Font','FontSize','Format','TextColor','BGColor','-','Blockquote','CreateDiv','-','Image','Table','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Outdent','Indent','-','RemoveFormat','Source','Maximize']
        ],
    ])
])?>

<?php ActiveForm::end(); ?>