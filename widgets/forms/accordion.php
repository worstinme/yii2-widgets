<?php

use yii\helpers\Html;
use mihaildev\elfinder\InputFile;
use yii\widgets\Pjax;

?>


<?php if ($widget->isNewRecord) : ?>
    <div class="uk-alert uk-alert-warning">
        Дополнительные настройки будут доступны после сохранения виджета
    </div>
<?php else: ?>

    <?= Html::a('Добавить блок', ['items/create', 'wid' => $widget->id]) ?>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => \worstinme\widgets\widgets\models\AccordionItems::find()->where(['widget_id' => $widget->id])->orderBy('sort'),
            'sort' => false,
            'pagination' => false,
        ]),
        'tableOptions' => [
            'class' => 'uk-table uk-table-small uk-table-middle uk-table-condensed uk-table-striped',
        ],
        'layout' => '{items}',
        'columns' => [
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($model) use ($widget) {
                    return Html::a($model->title, ['items/update', 'wid' => $widget->id, 'id' => $model->id]);
                }
            ],
            [
                'class' => '\worstinme\widgets\helpers\SortColumn',
                'url' => ['items/sort'],
            ],
            ['label' => '',
            'format' => 'raw',
            'value' => function ($model) use ($widget) {
                return Html::a('<i uk-icon="icon:trash"></i>', ['items/delete', 'id' => $model->id], ['data' => ['method' => 'post', 'confirm' => 'confirm?']]);
            }
        ],

    ]
    ]) ?>

<?php endif; ?>


<?= $form->field($model, 'collapsible')->checkbox(['class' => 'uk-checkbox']); ?>

<?= $form->field($model, 'multiple')->checkbox(['class' => 'uk-checkbox']); ?>

<?= $form->field($model, 'animation')->checkbox(['class' => 'uk-checkbox']); ?>

<?= $form->field($model, 'duration')->textInput(['class' => 'uk-input']); ?>

<?= $form->field($model, 'transition')->textInput(['class' => 'uk-input']); ?>