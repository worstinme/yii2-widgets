<?php
/**
 * Created by PhpStorm.
 * User: worst
 * Date: 24.02.2018
 * Time: 13:33
 */

?>

<?= $form->field($model, 'title')->textInput(['class' => 'uk-input']) ?>

<?= $form->field($model, 'open')->checkbox(['class' => 'uk-checkbox']) ?>

<?= \mihaildev\ckeditor\CKEditor::widget([
    'model' => $model,
    'attribute' => 'content',
    'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions(['elfinder', 'path' => '/'], [
        'preset' => 'standart',
        'allowedContent' => true,
        'height' => '400px',
        'toolbar' => [
            ['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', 'Styles', 'Font', 'FontSize', 'Format', 'TextColor', 'BGColor', '-', 'Blockquote', 'CreateDiv', '-', 'Image', 'Table', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Outdent', 'Indent', '-', 'RemoveFormat', 'Source', 'Maximize']
        ],
    ])
]) ?>