<?php

use yii\helpers\Html;
use yii\helpers\Json;
use \worstinme\widgets\helpers\ActiveForm;

$this->title = 'Создание дополнительного элемента к виджету';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="items-create">

    <h1><?=$this->title?></h1>

    <?php $form = ActiveForm::begin() ?>

    <?= $this->render($model->formView, [
        'model' => $model,
        'widget' => $widget,
        'form' => $form,
    ]); ?>

    <div class="uk-margin">
        <div class="uk-form-controls">
            <?=Html::submitButton('Сохранить',['class'=>'uk-button uk-button-success'])?>
        </div>
    </div>

    <?php ActiveForm::end() ?>

</div>