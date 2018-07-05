<?php

use yii\helpers\Html;
use mihaildev\elfinder\InputFile;
use yii\widgets\Pjax;

?>

<?php Pjax::begin(['id' => 'pjax', 'timeout' => 5000, 'options' => ['data-uk-observe' => true]]); ?>

<?php if ($widget->isNewRecord) : ?>
    <div class="uk-alert uk-alert-warning">
        Дополнительные настройки будут доступны после сохранения виджета
    </div>
<?php else: ?>

    <?= Html::a('Добавить группу с табличными данными', ['items/create', 'wid' => $widget->id]) ?>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => \worstinme\widgets\widgets\models\TableItems::find()->where(['widget_id' => $widget->id])->orderBy('sort'),
            'sort' => false,
            'pagination' => false,
        ]),
        'tableOptions' => [
            'class' => 'uk-table uk-table-small uk-table-middle uk-table-condensed uk-table-striped',
        ],
        'layout' => '{items}',
        'columns' => [
            [
                'attribute' => 'id',
                'format' => 'raw',
                'value' => function ($model) use ($widget) {
                    return Html::a('<i uk-icon="icon:file-edit"></i>', ['items/update', 'wid' => $widget->id, 'id' => $model->id]);
                }
            ],
            [
                'attribute' => 'name',
            ],
            [
                'class' => '\worstinme\widgets\helpers\SortColumn',
                'url' => ['items/sort'],
            ],
            [
                'label' => '',
                'format' => 'raw',
                'value' => function ($model) use ($widget) {
                    return Html::a('<i uk-icon="icon:trash"></i>', ['items/delete', 'id' => $model->id], ['data' => ['method' => 'post', 'confirm' => 'confirm?']]);
                }
            ],

        ]
    ]) ?>

<?php endif; ?>

<?= $form->field($model, 'columns')->textInput(['class' => 'uk-input', 'placeholder' => 'Количество колонок']); ?>
<?= $form->field($model, 'columnNames')->textInput(['class' => 'uk-input', 'placeholder' => 'Наименование колонок через |']); ?>
<?= $form->field($model, 'chunk')->textInput(['class' => 'uk-input', 'placeholder' => 'Количество строк в группе']); ?>

<?php Pjax::end(); ?>

<?php $script = <<<JAVASCRIPT

$.pjax.defaults.scrollTo = false;

JAVASCRIPT;

$this->registerJs($script, $this::POS_READY);