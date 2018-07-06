<?php
/**
 * Created by PhpStorm.
 * User: worst
 * Date: 24.02.2018
 * Time: 13:33
 */

?>

<?= $form->field($model,'caption')->textarea(['class'=>'uk-textarea'])?>

<?= $form->field($model,'title')->textInput(['class'=>'uk-input'])?>

<?= $form->field($model,'url')->textInput(['class'=>'uk-input'])?>

<?= $form->field($model,'imageAlt')->textInput(['class'=>'uk-input'])?>

<?= $form->field($model,'imageTitle')->textInput(['class'=>'uk-input'])?>

<?=$form->field($model, "image")->widget(\mihaildev\elfinder\InputFile::className(), [
    'language'      => 'ru',
    'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
    'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
    'options'=>['class'=>'uk-form-width-large uk-input'],
    'buttonOptions'=>['class'=>'uk-button uk-button-primary'],
]);?>