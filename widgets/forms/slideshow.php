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

    <?= Html::a('Добавить изображение', ['items/create', 'wid' => $widget->id]) ?>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => \worstinme\widgets\widgets\models\SlideshowItems::find()->where(['widget_id' => $widget->id]),
            'sort' => false,
            'pagination' => false,
        ]),
        'options' => [
            'class' => 'uk-table',
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
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($model) {
                    return \worstinme\widgets\helpers\ImageHelper::thumbnailImg(Yii::$app->widgets->basePath . $model->image, 40, 40);
                },
            ],
            'imageAlt',
            'imageTitle',
            'caption',
            'sort',
            [
                'label' => '',
                'format' => 'raw',
                'value' => function ($model) use ($widget) {
                    return Html::a('<i uk-icon="icon:trash"></i>', ['items/delete', 'id' => $model->id],['data'=>['method'=>'post','confirm'=>'confirm?']]);
                }
            ],

        ]
    ]) ?>

<?php endif; ?>

<?= $form->field($model, 'height')->textInput(['class'=>'uk-input','placeholder' => 'Высота']); ?>

<?= $form->field($model, 'autoplay')->checkbox(['class' => 'uk-checkbox']); ?>

<?= $form->field($model, 'hiddenNav')->checkbox(['class' => 'uk-checkbox']); ?>

<?php Pjax::end(); ?>

<?php $script = <<<JAVASCRIPT

$.pjax.defaults.scrollTo = false;

JAVASCRIPT;

$this->registerJs($script, $this::POS_READY);